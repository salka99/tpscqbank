<?php 
namespace App\Validation;

class YearRules
{
    public function validYear(string $year): bool
    {
        return $year >= 1900 && $year <= date('Y');
    }
}
