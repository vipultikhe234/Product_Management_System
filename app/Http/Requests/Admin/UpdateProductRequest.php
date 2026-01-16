<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3',
            'sku' => ['required', 'string', Rule::unique('products')->ignore($this->product)],
            'price' => 'required|numeric|gt:0',
            'stock' => 'required|integer|gte:0',
            'is_active' => 'boolean',
        ];
    }
}
