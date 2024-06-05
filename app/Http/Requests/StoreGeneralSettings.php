<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreGeneralSettings extends FormRequest
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
            'phone_number' => [
                'bail',
                'nullable',
                'regex:/^[+0-9 ]{5,20}+$/',
            ],
            'website_name' => [
                'bail',
                'nullable',
                'max:50',
            ],
            'facebook_link' => [
                'bail',
                'nullable',
                'max:100',
            ],
            'linkedin_link' => [
                'bail',
                'nullable',
                'max:100',
            ],
            'pinterest_link' => [
                'bail',
                'nullable',
                'max:100',
            ],
            'twitter_link' => [
                'bail',
                'nullable',
                'max:100',
            ],
            'youtube_link' => [
                'bail',
                'nullable',
                'max:100',
            ],
            'header_tagline' => [
                'bail',
                'nullable',
                'max:100',
            ],
            'footer_copyright_text' => [
                'bail',
                'nullable',
                'max:150',
            ],
            'logo' => 'bail|nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'favicon' => 'bail|nullable|mimes:png,ico|max:2048',
            'footer_image' => 'bail|nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'email' => 'bail|nullable|max:150|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'phone_number.regex' => 'The Phone Number must be numeric with + sign min 5 and max 20 digits.',
            'logo.max' => 'The Logo size may not be greater than 2 MB.',
            'logo.mimes' => 'The Logo must be valid jpeg,png,jpg,gif,svg extension',
            'favicon.max' => 'The Favicon size may not be greater than 2 MB.',
            'favicon.mimes' => 'The Favicon must be valid png,ico extension',
            'footer_image.max' => 'The Footer Image size may not be greater than 2 MB.',
            'footer_image.mimes' => 'The Footer Image must be valid jpeg,png,jpg,gif and svg extension',
            'email.regex' => 'The Email field value must be valid email.',

            'website_name.max' => 'The Website Name may not be greater than 50 characters.',
            'facebook_link.max' => 'The Facebook Link may not be greater than 100 characters.',
            'linkedin_link.max' => 'The Linkedin Link may not be greater than 100 characters.',
            'pinterest_link.max' => 'The Pinterest Link may not be greater than 100 characters.',
            'twitter_link.max' => 'The Twitter Link may not be greater than 100 characters.',
            'youtube_link.max' => 'The Youtube Link may not be greater than 100 characters.',
            'header_tagline.max' => 'The Header Tagline may not be greater than 100 characters.',
            'footer_copyright_text.max' => 'The Footer Copyright Text may not be greater than 150 characters.',
        ];
    }
}
