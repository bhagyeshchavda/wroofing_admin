<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMailSettings extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'mail_username' => 'required|max:50',
            'mail_password' => 'required|max:50',
            'from_address' => 'required|max:150|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            'umail_subject' => 'required',
            'umail_template' => 'required',
            'amail_subject' => 'required',
            'amail_template' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'mail_username.required' => 'The Username is required.',
            'mail_username.max' => 'The Username may not be greater than 50 characters.',
            'mail_password.required' => 'The Password is required.',
            'mail_password.max' => 'The Password may not be greater than 100 characters.',
            'from_address.required' => 'The from_address is required',
            'from_address.max' => 'The from_address may not be greater than 100 characters.',
            'from_address.regex' => 'The From Address must be type of Email',
            'umail_subject.required' => 'The user mail subject is required',
            'umail_template.required' => 'The user mail template is required',
            'amail_subject.required' => 'The admin mail subject is required',
            'amail_template.required' => 'The admin mail template is required',
        ];
    }
}
