<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;
use App\Models\admin\RoomModel;

class RoomRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    private $room;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required| max:255'
        ];
    }

    public function messages(){
        return [
            'required' => 'Bạn chưa nhập :attribute.',
            'max' => ':attribute không được vượt quá 255 ký tự'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'tên phòng',
            
        ];
    }
    public function withValidator($validator )
    {
        $validator->after(function ($validator) {
            $data = $validator->getData();
            $id = $data['id'];
            $room_code = $data['name'];
            $this -> room = new RoomModel();
            $dataOld = $this -> room -> findRoomById($id);
            $dataNew = $this -> room -> checkRoomByCode($room_code);
            $room_code_old = $dataOld -> room_code;
            
            if(!empty($dataNew)){
                if($dataNew->room_code != $room_code_old){
                    $validator->errors()->add(
                        'check_room',
                        'Tên phòng đã tồn tại.'
                    ) ;
                }
                
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
