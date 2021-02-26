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
        $response = $this->client->request(
            'GET',
            $_ENV['API_SPEAKER_ENDPOINT_URL'],
            [
                'query' => [
                    'fields[node--talk]' => 'title,field_speakers',
                    'fields[node--person]' => 'title',
                    'include' => 'field_speakers',
                ],
            ],
        )->toArray();

        assert(array_key_exists('data', $response));
        assert(array_key_exists('included', $response));

        return new Collection($response['data']);
    }
}
