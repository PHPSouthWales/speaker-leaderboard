<?php

declare(strict_types=1);

namespace App\Tests\Console\Command;

use App\Console\Command\LeaderboardCommand;
use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Console\Tester\CommandTester;

final class LeaderboardCommandTest extends WebTestCase
{
    /** @test */
    public function it_generates_a_leaderboard_of_speakers(): void
    {
        $command = $this->getContainer()->get(LeaderboardCommand::class);
        $commandTester = new CommandTester($command);

        $commandTester->execute([]);
    }

    private function getContainer(): ContainerInterface
    {
        $this->bootKernel();

        return self::$container;
    }
}
