<?php

declare(strict_types=1);


namespace App\ACS\Entities;


use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class ParameterInfoCollection extends Collection
{
    public function filterByChunkCount(int $minCount = 1, int $maxCount = 99): ParameterInfoCollection {
        return $this->filter(function (ParameterInfoStruct $item) use ($minCount, $maxCount) {
            $count = count(array_filter(explode('.', $item->name)));
            return $count >= $minCount && $count <= $maxCount;
        });
    }

    public function filterEndsWithDot(): ParameterInfoCollection {
        return $this->filter(fn(ParameterInfoStruct $item) => Str::endsWith('.', $item->name));
    }
}
