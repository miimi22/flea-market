<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class TradingCommentRequest extends FormRequest
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
            'comment' => 'required|max:400',
            'trading_image' => 'nullable|mimes:jpeg,png',
        ];
    }

    public function messages()
    {
        return [
            'comment.required' => '本文を入力してください',
            'comment.max' => '本文は400文字以内で入力してください',
            'trading_image.mimes' => '画像は「.jpeg」または「.png」形式でアップロードしてください',
        ];
    }
}
