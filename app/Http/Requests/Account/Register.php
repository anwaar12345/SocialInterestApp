<?php

namespace App\Http\Requests\Account;

use App\Rules\MinimumAgeValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;

class Register extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool|string
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
            'first_name' => 'required|string|max:200',
            'last_name' => 'required|string|max:200',
            'email' => 'required|email|unique:users,email',
            'address' => 'required|string|max:230',
            'dob' => [
                        'required',
                        'date',
                        'date_format:m/d/Y',
                        new MinimumAgeValidationRule(12)
                    ],
            'password' => [
                            'required',
                            Password::min(8)->letters()->mixedCase()->numbers()->symbols(),
                            'max:200' 
                          ],
            'interests' => 'nullable|array',
            'interests.*' => 'distinct|exists:interests,id'
        ];
    }


    public function process()
    {
    try{

        $validatedRequest = $this->safe();
        $interests = implode(',',\DB::table('interests')->whereIn('id',$this->interests ?? [0])->pluck('name')->toArray());
        $interests = (in_array($interests,['',null])) ? null : $interests;
        $user = User::create([
           'first_name' => $validatedRequest['first_name'],
           'last_name' => $validatedRequest['last_name'],
           'email' => $validatedRequest['email'],
           'dob' => Carbon::parse($validatedRequest['dob'])->format('Y-m-d'),
           'address' => $validatedRequest['address'],
           'password' => Hash::make($validatedRequest['password']),
           'interests' => $interests
        ]);   

        if($user)
            $user->sendEmailVerificationNotification();

        return response(['message' => 'Account created successfully.']);

    }catch(\Exception $ex){
        if(env('APP_ENV')=='local')
            return response(['error' => $ex->getMessage()]);
    }    
        
    }

}
 