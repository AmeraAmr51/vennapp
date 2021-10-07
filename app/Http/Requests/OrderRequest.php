<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'name'=> 'required',
            'email'=> 'required|email|max:191|unique:users,email',
            'phone'=> 'required|numeric|min:10|unique:users,phone',
            'video_id'=> 'nullable|exists:videos,id',
            'city'=> 'required',
            'user_id'=> 'nullable|exists:users,id',
        ];
    }
}
