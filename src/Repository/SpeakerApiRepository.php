<?php

declare(strict_types=1);

namespace App\Repository;

use Tightenco\Collect\Support\Collection;

final class SpeakerApiRepository implements SpeakerRepository
{
    public function findAll(): Collection
    {
        return new Collection();
    }
}
