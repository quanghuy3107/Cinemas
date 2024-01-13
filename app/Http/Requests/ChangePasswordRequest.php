<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            // 'oldPassword' => 'required',
            'password' => 'required',
            'confirmPassword' => 'required',
        ];
    }

    public function messages(){
        return [
            // 'oldPassword.required' => 'Bạn chưa nhập :attribute.',
            'password.required' => 'Bạn chưa nhập :attribute.',
            'confirmPassword.required' => 'Bạn chưa nhập :attribute.',
        ];
    }

    public function attributes()
    {
        return [
            'password' => 'mật khẩu',
            // 'oldPassword' => 'mật khẩu cũ',
            'confirmPassword' => 'mật khẩu xác nhận'
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $data = $validator->getData();
            
            if($data['password'] != $data['confirmPassword']){
                $validator->errors()->add(
                    'confirmPassword',
                    'mật khẩu xác nhận không khớp'
                ) ;
            }
            if ($validator->errors()->count() > 0) {
                $validator->errors()->add(
                    'msg',
                    'Vui lòng kiểm tra lại dữ liệu.'
                ) ;
            }
        });
    }
}
