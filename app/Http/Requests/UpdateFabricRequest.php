<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFabricRequest extends FormRequest
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
        'supplier_id' => 'nullable|exists:suppliers,id',
        'fabric_no' => 'required|string|max:100',
        'composition' => 'required|string|max:255',
        'gsm' => 'nullable|numeric',
        'qty' => 'required|integer|min:0',
        'production_type' => 'required|in:Sample Yardage,SMS,Bulk',
        'image' => 'nullable|image|max:2048'
    ];
    }
}
