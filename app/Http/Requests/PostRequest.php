<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'title' => 'required',
            'started_at' => 'required|date|after:tomorrow',
            'ended_at' => 'required|date|after:started_at',
            'description' => 'required',
            'post_type' => 'required|in:formation,stage',
            'category_id' => 'required|integer',
            'teachers' => 'array',
            'teachers.*' => 'int',
            'status' => 'in:published,unpublished',
            'picture' => 'image|mimes:jpg,png,jpeg',
            'price' => 'required|regex:/^\d*(\.\d{1,2})?$/',
            'student_max' => 'required|integer',
        ];
    }
}
