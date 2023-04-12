<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class couponStoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'coupon_name'=>'required|string|max:255|unique:coupons,coupon_name',
            'discount_percentage'=>'required|numeric',
            'perchase_amount'=>'required|numeric',
            'validity_till'=>'required|date',
            'is_active'=>'nullable',
        ];
    }
}
