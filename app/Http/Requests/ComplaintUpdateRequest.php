<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ComplaintUpdateRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'delivery_id' => ['required', 'exists:deliveries,id'],
            'description' => ['required', 'max:255', 'string'],
            'status' => ['required', 'in:open,resolved,reopened,closed'],
        ];
    }
}
