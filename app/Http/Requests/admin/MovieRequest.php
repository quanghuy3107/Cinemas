<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class MovieRequest extends FormRequest
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
            'movie_name' => 'required',
            'director' => 'required',
            'performers' => 'required',
            'movie_duration' => 'required | integer | min:0',
            'image' => 'required ',
            'start_date' => 'required',
            'end_date' => 'required ',
            'genre' => 'required ',
        ];
    }

    public function messages(){
        return [
            'movie_name.required' => 'Bạn chưa nhập :attribute.',
            'director.required' => 'Bạn chưa nhập :attribute.',
            'performers.required' => 'Bạn chưa nhập :attribute.',
            'movie_duration.required' => 'Bạn chưa nhập :attribute.',
            'movie_duration.integer' => 'Thời lượng phim phải là số nguyên.',
            'movie_duration.min' => 'Thời lượng phim phải lớn hơn 0.',
            'image.required' => 'Bạn chưa nhập :attribute.',
            // 'image.image' => 'Sai định dạng file.',
            'start_date.required' => 'Bạn chưa nhập :attribute.',
            'end_date.required' => 'Bạn chưa nhập :attribute.',
            'genre.required' => 'Bạn chưa nhập :attribute.',
        ];
    }

    public function attributes()
    {
        return [
            'movie_name' => 'tên phim',
            'director' => 'đạo diễn',
            'performers' => 'diễn viên',
            'movie_duration' => 'thời lượng phim',
            'image' => 'ảnh',
            'start_date' => 'thời gian bắt đầu',
            'end_date' => 'thời gian kết thúc',
            'genre' => 'thể loại',
        ];
    }

    public function withValidator($validator )
    {
        $validator->after(function ($validator) {
            $data = $validator->getData();
            if($data['end_date'] < $data['start_date']){
                $validator->errors()->add(
                    'end_date',
                    'Ngày kết thúc phải lớn hơn ngày bắt đầu.'
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
