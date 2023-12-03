<?php

declare(strict_types=1);

namespace App\Models;

class EtfHoldings
{
    public string $symbol;
    public array $holdings = [];

    public function __construct(string $symbol)
    {
        $this->symbol = $symbol;
    }

    public function getSymbol(): string
    {
        return $this->symbol;
    }

    public function getHoldings(): array
    {
        return $this->holdings;
    }

    public function addHolding($holding): void
    {
        $this->holdings[] = $holding;
    }


}