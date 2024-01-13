<?php

namespace App\Http\Requests\client;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ChangeInformationRequest extends FormRequest
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
            'name' => 'required | max:255',
            'email' => 'email | required | max:255',
            'password' => 'required',
        ];
    }

    public function messages(){
        return [
            'name.required' => 'Bạn chưa nhập :attribute.',
            'email.required' => 'Bạn chưa nhập :attribute.',
            'email.email' => 'Bạn chưa nhập :attribute.',
            'password.required' => 'Bạn chưa nhập :attribute.',
        ];
    }

    public function attributes()
    {
        return [
            'password' => 'mật khẩu',
            'name' => 'họ và tên',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $data = $validator->getData();
            $user = User::where('email', $data['email'])->first();

            if ($user) {
                if($user->email != $data['email'] ){
                    $validator->errors()->add(
                        'email',
                        'email đã tồn tại trong hệ thống'
                    ) ;
                }
                
            }
            
            if(!Auth::attempt(['id' => Auth::user()->id, 'password' => $data['password']])){
                $validator->errors()->add(
                    'password',
                    'mật khẩu không chính xác'
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
