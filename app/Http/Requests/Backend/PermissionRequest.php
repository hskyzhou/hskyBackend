<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class PermissionRequest extends FormRequest
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
        $id = request()->route()->getParameter('permission');
        return [
            'name' => 'required',
            'slug' => 'required|unique:permissions,slug,' . $id,
            'position' => 'required',
            'status' => 'required'
        ];
    }
}
