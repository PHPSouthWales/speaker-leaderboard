<?php

namespace App\Repository;

use Tightenco\Collect\Support\Collection;

interface SpeakerRepository
{
    public function findAll(): Collection;
}
