<?php

declare(strict_types=1);

namespace App\Repository;

use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;
use Tightenco\Collect\Support\Collection;

final class CachedSpeakerApiRepository implements SpeakerRepository
{
    public function __construct(
        private CacheInterface $cache,
        private SpeakerApiRepository $speakerRepository,
    ) {}

    public function findAll(): Collection
    {
        return $this->cache->get(
            key: 'api.speaker_info',
            callback: function (ItemInterface $item): Collection {
                $item->expiresAt(date_create('tomorrow'));

                return $this->speakerRepository->findAll();
            });
    }
}
