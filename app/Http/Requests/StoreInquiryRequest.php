<?php

namespace App\Http\Requests;

use App\Support\MarketingCatalog;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class StoreInquiryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $catalog = app(MarketingCatalog::class);
        $publishedProducts = $catalog->products()->keys()->all();
        $publishedProjects = $catalog->projects()->keys()->all();

        return [
            'submission_token' => ['required', 'uuid'],
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email:rfc', 'max:254'],
            'company' => ['nullable', 'string', 'max:160'],
            'phone' => ['nullable', 'string', 'max:40'],
            'interest_type' => ['required', Rule::in([...$publishedProducts, 'project_reference', 'custom_development', 'other'])],
            'product_slug' => ['nullable', Rule::in($publishedProducts)],
            'project_slug' => ['nullable', Rule::in($publishedProjects)],
            'message' => ['nullable', 'string', 'max:3000', Rule::requiredIf($this->input('interest_type') === 'custom_development')],
            'source_path' => ['nullable', 'string', 'max:180', 'regex:/^\/[A-Za-z0-9\-\/_]*$/'],
            'utm_source' => ['nullable', 'string', 'max:100', 'regex:/^[\pL\pN ._\-]+$/u'],
            'utm_medium' => ['nullable', 'string', 'max:100', 'regex:/^[\pL\pN ._\-]+$/u'],
            'utm_campaign' => ['nullable', 'string', 'max:100', 'regex:/^[\pL\pN ._\-]+$/u'],
            'website' => ['nullable', 'prohibited'],
        ];
    }

    public function after(): array
    {
        return [function (Validator $validator): void {
            $productSlugs = app(MarketingCatalog::class)->products()->keys();
            $interest = $this->string('interest_type')->toString();
            $product = $this->string('product_slug')->toString();
            $project = $this->string('project_slug')->toString();

            if ($productSlugs->contains($interest) && $product !== $interest) {
                $validator->errors()->add('product_slug', 'A kiválasztott termék nem érvényes.');
            }

            if (! $productSlugs->contains($interest) && $product !== '') {
                $validator->errors()->add('product_slug', 'Termék csak termékmegkeresésnél adható meg.');
            }

            if ($interest === 'project_reference' && $project === '') {
                $validator->errors()->add('project_slug', 'A kiválasztott referencia nem érvényes.');
            }

            if ($interest !== 'project_reference' && $project !== '') {
                $validator->errors()->add('project_slug', 'A referencia csak kapcsolódó projektmegkeresésnél adható meg.');
            }
        }];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Kérjük, add meg a neved.',
            'email.required' => 'Kérjük, add meg az e-mail-címed.',
            'email.email' => 'Kérjük, érvényes e-mail-címet adj meg.',
            'interest_type.required' => 'Válaszd ki, mivel kapcsolatban keresel minket.',
            'interest_type.in' => 'A kiválasztott érdeklődési terület nem érvényes.',
            'message.required' => 'Írd le röviden, milyen folyamaton vagy feladaton egyszerűsítenél.',
            'message.max' => 'Az üzenet legfeljebb 3000 karakter lehet.',
            'website.prohibited' => 'A beküldés nem sikerült. Kérjük, próbáld újra.',
        ];
    }
}
