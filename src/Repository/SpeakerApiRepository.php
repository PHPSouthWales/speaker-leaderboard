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
        $response = $this->client
            ->request(
                method: 'GET',
                url: $_ENV['API_SPEAKER_ENDPOINT_URL'],
                options: [
                    'query' => [
                        'fields[node--talk]' => 'title,field_speakers',
                        'fields[node--person]' => 'title',
                        'include' => 'field_speakers',
                    ],
                ],
            )
            ->toArray();

        assert(array_key_exists('data', $response));
        assert(array_key_exists('included', $response));

        $talkCollection = new Collection($response['data']);
        $includedCollection = new Collection($response['included']);

        return $talkCollection
            ->map(function (array $talk) use ($includedCollection): array {
                $speaker = $includedCollection->first(function (array $item) use ($talk): bool {
                    if ($item['type'] != 'node--person') {
                        return false;
                    }

                    return $item['id'] == $talk['relationships']['field_speakers']['data'][0]['id'];
                });

                return [$talk, $speaker];
            })
            ->map(function (array $talkAndSpeaker): array {
                [$talk, $speaker] = $talkAndSpeaker;

                return [
                    'speaker_name' => $speaker['attributes']['title'],
                    'talk_name' => $talk['attributes']['title'],
                ];
            });
    }
}
