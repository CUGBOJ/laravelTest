<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed nickname
 * @property mixed school
 * @property mixed email
 * @property mixed password
 * @property mixed avatar
 * @property mixed username
 * @property mixed regenerate_avatar
 * @property mixed register
 * @property mixed old_oj_account
 * @property mixed student_id
 * @property mixed gender
 * @property mixed major
 * @property mixed info
 */
class UserUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nickname' => 'required|between:3,25|regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9-_]+$/u',
            'email' => 'email|max:255|nullable',
            'password' => 'nullable|confirmed|between:6,15',
            'school' => 'max:20|nullable',
            'avatar' => 'max:100'
        ];
    }

    public function messages()
    {
        return [
            'email.email' =>'请输入有效的email的地址',
            'nickname.regex' => '昵称只支持中英文、数字、横杆和空格下划线。',
            'nickname.between' => '昵称必须介于 3 - 25 个字符之间。',
            'password.confirmed' => '密码与确认密码必须一致',
            'password.min' => '密码至少6位,至多15位',
            'avatar'=>'头像尺寸过大',
        ];
    }
}
