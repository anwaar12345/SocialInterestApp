<?php

namespace App\Http\Requests\Account;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;
class verify extends FormRequest
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
            //
        ];
    }

    public function process() {
        try {

            if (!$this->hasValidSignature()) {
                return response(["message" => "Invalid/Expired url provided."], 401);
            }
        
            $user = User::findOrFail($this->id);
        
            if (!$user->hasVerifiedEmail()) {
                $user->markEmailAsVerified();
            }
        
            return response(['message' => 'Account Verified Successfully']);

        } catch (\Exception $ex) {
            if(env('APP_ENV')=='local')
                return response(['error' => $ex->getMessage()]);
        }
    }
}
