<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSupplierRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'country' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'code' => 'required|string|max:100|unique:suppliers,code',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:200',
            'rep_name' => 'nullable|string|max:50',
            'rep_email' => 'nullable|email',
            'rep_phone' => 'nullable|string|max:50',
        ];
    }
}
