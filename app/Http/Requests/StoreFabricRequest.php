<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFabricRequest extends FormRequest
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
            'supplier_id' => 'required|exists:suppliers,id',
            'fabric_no' => 'required|string|max:255',
            'composition' => 'required|string|max:255',
            'gsm' => 'required|numeric',
            'qty' => 'required|numeric',
            'cuttable_width' => 'required|numeric',
            'production_type' => 'required|string',
            'construction' => 'nullable|string',
            'color_pantone' => 'nullable|string',
            'weave_type' => 'nullable|string',
            'finish_type' => 'nullable|string',
            'dyeing_method' => 'nullable|string',
            'printing_method' => 'nullable|string',
            'lead_time_days' => 'nullable|integer',
            'moq' => 'nullable|integer',
            'shrinkage' => 'nullable|numeric',
            'remarks' => 'nullable|string',
            'fabric_selected_by' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }
}
