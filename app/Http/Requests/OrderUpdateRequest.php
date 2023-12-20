<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderUpdateRequest extends FormRequest
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
            'outlet_id' => ['required', 'exists:outlets,id'],
            'package_id' => ['required', 'exists:packages,id'],
            'delivery_option_id' => ['required', 'exists:delivery_options,id'],
            'transaction_id' => ['required', 'exists:transactions,id'],
            'document_file' => ['required', 'max:255', 'string'],
            'quantity' => ['required', 'numeric'],
            'total_price' => ['required', 'numeric'],
            'point' => ['required', 'numeric'],
            'status' => [
                'required',
                'in:pending,ordered,prepared,picked up,completed',
            ],
            'qr_code' => ['required', 'max:255', 'string'],
        ];
    }
}
