<?php

namespace App\Http\Requests;

use App\Support\MarketingCatalog;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreDemoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'submission_token' => ['required', 'uuid'],
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email:rfc', 'max:254'],
            'company' => ['nullable', 'string', 'max:160'],
            'phone' => ['nullable', 'string', 'max:40'],
            'product_slug' => ['required', Rule::in(app(MarketingCatalog::class)->products()->keys()->all())],
            'message' => ['nullable', 'string', 'max:3000'],
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
            'product_slug.required' => 'Válaszd ki, melyik rendszert szeretnéd kipróbálni.',
            'product_slug.in' => 'A kiválasztott rendszer nem elérhető.',
            'website.prohibited' => 'A beküldés nem sikerült. Kérjük, próbáld újra.',
        ];
    }
}
