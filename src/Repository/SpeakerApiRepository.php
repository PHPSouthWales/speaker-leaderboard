<?php

declare(strict_types=1);

namespace App\Repository;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Tightenco\Collect\Support\Collection;

final class SpeakerApiRepository implements SpeakerRepository
{
    public function __construct(
        private HttpClientInterface $client
    ) {}

    public function findAll(): Collection
    {
        return new Collection();
    }
}
