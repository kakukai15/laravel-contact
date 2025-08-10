<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $tel1 = $this->input('tel1') ?? '';
        $tel2 = $this->input('tel2') ?? '';
        $tel3 = $this->input('tel3') ?? '';

        $this->merge([
            'tel' => $tel1 . $tel2 . $tel3,
        ]);
    }

    public function rules()
    {
        return [
            'last_name'   => ['required', 'string', 'max:255'],
            'first_name'  => ['required', 'string', 'max:255'],
            'gender'      => ['required', 'in:male,female,other'],
            'email'       => ['required', 'email'],
            'tel1'        => ['required', 'digits_between:2,4'],
            'tel2'        => ['required', 'digits_between:2,4'],
            'tel3'        => ['required', 'digits_between:2,4'],
            'address'     => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'message'     => ['required', 'string', 'max:120'],
        ];
    }

    public function messages()
    {
        return [
            'last_name.required'   => '姓を入力してください',
            'first_name.required'  => '名を入力してください',
            'gender.required'      => '性別を選択してください',
            'gender.in'            => '性別を選択してください',
            'email.required'       => 'メールアドレスを入力してください',
            'email.email'          => 'メールアドレスはメール形式で入力してください',
            'tel.required'         => '電話番号を入力してください',
            'tel.digits_between'   => '電話番号は10桁または11桁の数字で入力してください',
            'address.required'     => '住所を入力してください',
            'category_id.required' => 'お問い合わせの種類を選択してください',
            'category_id.exists'   => 'お問い合わせの種類を選択してください',
            'message.required'     => 'お問い合わせ内容を入力してください',
            'message.max'          => 'お問合せ内容は120文字以内で入力してください',
        ];
    }
}
