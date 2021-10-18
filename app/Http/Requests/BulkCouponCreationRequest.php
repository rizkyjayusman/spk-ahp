<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BulkCouponCreationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'type' => 'required|integer',
            'product_id' => 'required|integer',
            // 'prefix' => 'required|string',
            'expired_at' => 'required|date|date_format:Y-m-d',
            'size' => 'required|integer|min:1|max:5000',
        ];
    }
}
