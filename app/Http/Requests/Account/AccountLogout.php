<?php

namespace App\Http\Requests\Account;

use Illuminate\Foundation\Http\FormRequest;

class AccountLogout extends FormRequest
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

    public function process()
    {
        try {
            $this->user()->currentAccessToken()->delete();
            return response(['message' => 'Account logout successfull']);
        } catch (\Exception $ex) {
            if(env('APP_ENV')=='local')
            return response(['error' => $ex->getMessage()]);
        }

    }

}
