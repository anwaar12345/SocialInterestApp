<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserProfile extends FormRequest
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
            return response(['profile' => $this->user()],200);
        } catch (\Exception $ex) {
            if(env('APP_ENV')=='local')
            return response(['error' => $ex->getMessage()]);
        }
    }
}
