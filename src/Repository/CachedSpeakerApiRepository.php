<?php

declare(strict_types=1);

namespace App\Repository;

use Tightenco\Collect\Support\Collection;

final class CachedSpeakerApiRepository implements SpeakerRepository
{
    public function __construct(
        private SpeakerApiRepository $speakerRepository,
    ) {}

    public function findAll(): Collection
    {
        return $this->speakerRepository->findAll();
    }
}
