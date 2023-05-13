<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Carbon\Carbon;
class MinimumAgeValidationRule implements ValidationRule
{
   protected $minimumAge;

    public function __construct($minimumAge)
    {
        $this->minimumAge = $minimumAge;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $age = Carbon::parse($value)->age;
        if($age < $this->minimumAge)
            $fail('minimum age to register is 12 years');
    }
}
