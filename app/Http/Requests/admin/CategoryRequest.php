<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class CategoryRequest extends FormRequest
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
            'name' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Bạn chưa nhập thông tin :attribute.'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'danh mục phim'
        ];
    }
    // public function withValidator($validator)
    // {
    //     $validator->after(function ($validator) {


    //         if ($validator->errors()->count() > 0) {
    //             $validator->errors()->add(
    //                 'msg',
    //                 'Vui lòng kiểm tra lại dữ liệu.'
    //             );
    //         }
    //     });
    // }
    public function after(): array
    {
        return [
            function (Validator $validator) {
                if ($validator->errors()->count() > 0) {
                    $validator->errors()->add(
                    'msg',
                    'Vui lòng kiểm tra lại dữ liệu.'
                    );
                }
            }
        ];
    }
}
?>