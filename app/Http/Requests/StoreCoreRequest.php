<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StroreCoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
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
            'core_name'=>'required|min:5|max:255',
            'core_url'=>'required',
            'core_username'=>'required|unique:cores|min:5|max:255',
            'core_passhash'=>'required'
        ];
    }
}
