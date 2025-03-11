<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
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
            // 'sending_code' => 'required|regex:/^\d{3}-\d{4}$/',
            // 'sending_address' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'sending_code.required' => '郵便番号を入力してください',
            'sending_code.regex' => '郵便番号の形式が正しくありません。例:123-4567',
            'sending_address.required' => '住所を入力してください',
        ];
    }
}
