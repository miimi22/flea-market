<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExhibitionRequest extends FormRequest
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
            'product_name' => 'required',
            'product_explanation' => 'required|max:255',
            'product_image' => 'required|mimes:jpeg,png',
            'product_category' => 'required',
            'status' => 'required',
            'product_price' => 'required|integer|min:0',
        ];
    }

    public function messages()
    {
        return [
            'product_name.required' => '商品名を入力してください',
            'product_explanation.required' => '商品説明を入力してください',
            'product_explanation.max' => '商品説明は最大255文字以内で入力してください',
            'product_image.required' => '商品画像をアップロードしてください',
            'product_image.mimes' => '商品画像は「.jpeg」または「.png」形式でアップロードしてください',
            'product_category.required' => '商品のカテゴリーを選択してください',
            'status.required' => '商品の状態を選択してください',
            'product_price.required' => '販売価格を入力してください',
            'product_price.integer' => '販売価格は数字で入力してください',
            'product_price.min' => '販売価格は0円以上で入力してください',
        ];
    }
}
