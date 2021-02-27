<?php

declare(strict_types=1);

namespace App\Console\Command;

use App\Repository\SpeakerRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Tightenco\Collect\Support\Collection;

final class LeaderboardCommand extends Command
{
    protected static $defaultName = 'php-south-wales:generate-leaderboard';

    public function __construct(
        string $name = null,
        private SpeakerRepository $speakerRepository
    ) {
        parent::__construct($name);
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $speakers = $this->speakerRepository->findAll();

        $results = $speakers
            ->groupBy('speaker_name')
            ->map(function (Collection $talkCollection, string $name): array {
                return [
                    'speaker_name' => $name,
                    'talk_count' => $talkCollection->count(),
                ];
            })
            ->sortBy('speaker_name')
            ->sortByDesc('talk_count');

        // @TODO: Display summary (x number of talks from y speakers).

        $table = new Table($output);
        $table->setStyle('borderless');
        $table->setHeaders(['Speaker name', 'Number of talks']);
        $table->addRows($results->toArray());
        $table->render();

        return 0;
    }
}
