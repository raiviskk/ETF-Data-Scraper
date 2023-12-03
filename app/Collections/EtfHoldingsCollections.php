<?php

declare(strict_types=1);

namespace App\Collections;


use App\Models\EtfHoldings;

class EtfHoldingsCollections
{
    public array $etfs = [];

    public function __construct(array $etfs = [])
    {
        foreach ($etfs as $etf) {
            if (!$etf instanceof EtfHoldings) {
                continue;
            }
            $this->add($etf);
        }

    }

    public function add(EtfHoldings $etf): void
    {
        $this->etfs[] = $etf;
    }

    public function getAll(): array
    {
        return $this->etfs;
    }
}