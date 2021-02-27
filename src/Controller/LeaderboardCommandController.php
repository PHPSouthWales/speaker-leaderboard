<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\SpeakerRepository;
use Tightenco\Collect\Support\Collection;

final class LeaderboardCommandController
{
    public function __construct(
        private SpeakerRepository $speakerRepository
    ) {}

    public function __invoke(): Collection
    {
        $speakers = $this->speakerRepository->findAll();

        return $speakers
            ->groupBy('speaker_name')
            ->map(function (Collection $talkCollection, string $name): array {
                return [
                    'speaker_name' => $name,
                    'talk_count' => $talkCollection->count(),
                ];
            })
            ->sortBy('speaker_name')
            ->sortByDesc('talk_count');
    }
}
