<?php

namespace App\Http\Requests\Account;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class Login extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required|string'
        ];
    }


    public function process()
    {
        try{
            $user = User::where('email', $this->input('email'))
            ->first();
    
            if($user && Hash::check($this->password, $user->password)){
             if(!$user->email_verified_at)
                return response(['message' => 'Please Verify your account'],403);
            return response(['access_token' => $user->createToken('SocialServiceApp')->plainTextToken],200);
    
            }else{
    
            return response(['message' => 'Invalid email or password. Please try again'],400);
    
            } 
        }catch(\Exception $ex){
            if(env('APP_ENV')=='local')
                return response(['error' => $ex->getMessage()]);
        }
    }

}
