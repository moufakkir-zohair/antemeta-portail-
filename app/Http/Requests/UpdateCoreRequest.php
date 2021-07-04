<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
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
            'core_username'=>'required|min:5|max:255|unique:cores,core_username,'. $this->core->id,
            'core_passhash'=>'required'
        ];
    }
}
