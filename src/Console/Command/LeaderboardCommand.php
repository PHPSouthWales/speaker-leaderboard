<?php

declare(strict_types=1);

namespace App\Console\Command;

use App\Controller\LeaderboardCommandController;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

final class LeaderboardCommand extends Command
{
    protected static $defaultName = 'php-south-wales:generate-leaderboard';

    public function __construct(
        string $name = null,
        private LeaderboardCommandController $controller
    ) {
        parent::__construct($name);
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $style = new SymfonyStyle($input, $output);

        $response = $this->controller->__invoke();

        $style->info(sprintf(
            '%d talks from %d speakers.',
            $response->pluck('talk_count')->sum(),
            $response->count()
        ));

        $table = new Table($output);
        $table->setStyle('borderless');
        $table->setHeaders(['Speaker name', 'Number of talks']);
        $table->addRows($response->toArray());
        $table->render();

        return 0;
    }
}
