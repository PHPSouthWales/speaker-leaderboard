<?php

declare(strict_types=1);

namespace App\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class LeaderboardCommand extends Command
{
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $table = new Table($output);
        $table->setStyle('borderless');
        $table->setHeaders(['Speaker name', 'Number of talks']);
        $table->addRow(['Oliver Davies', 3]);
        $table->render();

        return 0;
    }
}
