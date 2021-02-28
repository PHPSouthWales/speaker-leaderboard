<?php

declare(strict_types=1);

namespace App\Repository;

use Tightenco\Collect\Support\Collection;

class FakeSpeakerRepository implements SpeakerRepository
{
    public function findAll(): Collection
    {
        return new Collection([
           [
               'speaker_name' => 'Oliver Davies',
               'talk_name' => 'Creating Presentations with rst2pdf (lightning talk)',
           ]
        ]);
    }
}
