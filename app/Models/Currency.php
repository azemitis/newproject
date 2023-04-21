<?php declare(strict_types=1);

namespace App\Models;

class Currency
{
    private string $name;
    private float $value;

    public function __construct(string $name, float $value)
    {
        $this->name = $name;
        $this->value = $value;
    }

//    public function getName(): string
//    {
//        return $this->name;
//    }

    public function getRate(): float
    {
        return $this->value;
    }
}