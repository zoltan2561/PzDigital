<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreInquiryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $publishedProducts = collect(config('pzdigital.products'))
            ->filter(fn (array $product): bool => $product['publication_status'] === 'published' && $product['content_approved'])
            ->keys()
            ->all();

        return [
            'submission_token' => ['required', 'uuid'],
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email:rfc', 'max:254'],
            'company' => ['nullable', 'string', 'max:160'],
            'phone' => ['nullable', 'string', 'max:40'],
            'interest_type' => ['required', Rule::in(['szervizpro', 'foodshop', 'custom_development', 'other'])],
            'product_slug' => ['nullable', Rule::in($publishedProducts)],
            'message' => ['nullable', 'string', 'max:3000', Rule::requiredIf($this->input('interest_type') === 'custom_development')],
            'source_path' => ['nullable', 'string', 'max:180', 'regex:/^\/[A-Za-z0-9\-\/_]*$/'],
            'utm_source' => ['nullable', 'string', 'max:100', 'regex:/^[\pL\pN ._\-]+$/u'],
            'utm_medium' => ['nullable', 'string', 'max:100', 'regex:/^[\pL\pN ._\-]+$/u'],
            'utm_campaign' => ['nullable', 'string', 'max:100', 'regex:/^[\pL\pN ._\-]+$/u'],
            'website' => ['nullable', 'prohibited'],
        ];
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
