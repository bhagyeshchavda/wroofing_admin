<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use App\Libraries\General;
use App\Models\User;

use Hash;
use Auth;
use File;

class UserRequest extends FormRequest
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
        $id = $this->id!='' ? $this->id : 'NULL' ;
        $rules = array(
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id.',id,deleted_at,NULL',
            'password' => 'required|min:5|required_with:confirm_password|same:confirm_password',
            'confirm_password' => 'required|min:5',
            'user_type' => 'required',
            'profile_image' => 'image|mimes:jpeg,png,jpg,gif',
        );

        $data = $this->all();  
        if(isset($data['id']) && !empty($data['id'])){
            $rules['password'] = 'nullable|min:5|required_with:confirm_password|same:confirm_password';
            $rules['confirm_password'] = 'nullable|min:5';
        }

        return $rules;
    }
    public function messages(){
        return [
            'first_name.required' => 'First Name field is required.',
            'last_name.required' => 'Last Name field is required.',
            'email.unique' => 'Email has already been taken.',
            'email.required' => 'Email field is required.',
            'password.required' => 'Password Field is required.',
            'confirm_password.required' => 'Confirm password field is required.',
            'profile_image.mimes' => 'Profile picture field must be a file of type: jpeg,png,jpg,gif',
        ];
    }

    protected function getValidatorInstance(){
        $validator = parent::getValidatorInstance();

        $validator->after(function ($validator) {
            $data = $this->all();

            if(isset($data['id']) && !empty($data['id'])){
                $data ['updated_by'] = Auth::id();
                $storedFile = User::SELECT('profile_image')->WHERE('id', $data['id'])->first();
                $storedFileName = ($storedFile->profile_image) ? $storedFile->profile_image : '';
            } else {
                $data['created_by'] = Auth::id();
                $data ['updated_by'] = Auth::id();                
                $storedFileName = '';
            }

            // Password hash make
            if($data['password'] && $data['password']!=''){
                $data['password'] = Hash::make($data['password']);
            }else{
                unset($data['password']);
            }

            // Upload Image
            if(isset($data['profile_image']) && $data['profile_image']){      
                $fileData = General::storagefileupload('user_images', $data['profile_image'], $storedFileName);
                $data['file_original_name'] =  $data['profile_image']->getClientOriginalName();
                $data['profile_image_string'] = $fileData;
            }

            // Delete Image
            if(isset($data['imgdel']) && $data['imgdel']){  
                $storedFile = User::SELECT('profile_image')->WHERE('id', $data['id'])->first();
                $storedFileName = ($storedFile->profile_image) ? $storedFile->profile_image : '';
                $imageUrl =  storage_path('app/public/user_images/'.$storedFileName);
                if (File::exists($imageUrl)) {
                    File::delete($imageUrl);
                }
                $updateFile = User::where('id', $data['id'])->update([
                    'profile_image' => NULL
                ]);
            }

            $this->getInputSource()->replace($data);
        });
        return $validator;
    }
}
