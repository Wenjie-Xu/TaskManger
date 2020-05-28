<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;

class CreateProjectRequest extends FormRequest
{
    protected $errorBag = 'create';//错误包组，因为创建只有一个表单，因此一个即可
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
            // 'name'=>'required|unique:projects', 字符串的写法

            //使用数组的写法，更灵活的限制
            'name'=>[
                'required',
                Rule::unique('projects')->where(function($query){
                    return $query->where('user_id',request()->user()->id);
                })//对当前用户进行表字段限定
            ],
            'thumbnail'=>'image|dimensions:min_width=260,min_height=100|max:2048'
        ];
    }

    // public function messages()
    // {
    //     return [
    //         'name.required'=>'项目名称不能空',
    //         'name.unique'=>'项目名称重复',
    //         'thumbnail.image'=>'上传的文件不是图片',
    //         'thumbnail.dimensions'=>'图片大小不符合规范',
    //         'thumbnail.max'=>'图片最大为2M'
    //     ];
    // }

}
