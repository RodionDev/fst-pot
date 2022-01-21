<?php
namespace App\Rules;
use Illuminate\Contracts\Validation\Rule;
class ValidColor implements Rule
{
    public function __construct()
    {
    }
    public function passes($attribute, $value)
    {
        if(!empty($value)) {
            $pattern = '/^(#[0-9a-f]{3}|#(?:[0-9a-f]{2}){2,4}|(rgb|hsl)a?\((-?\d+%?[,\s]+){2,3}\s*[\d\.]+%?\))$/i';
            if (preg_match($pattern,$value)) return true;
        }
        return false;
    }
    public function message()
    {
        return 'Bitte geben Sie eine gültige Farbe (HEX, RGB, RGBA) an.';
    }
}
