<?php

namespace Kevinpurwito\LaravelMailcoachApi;

use Illuminate\Support\Facades\Http;
use Kevinpurwito\LaravelMailcoachApi\Data\InputSubscriberData;
use Kevinpurwito\LaravelMailcoachApi\Data\SubscriberData;

class MailcoachApi
{
    public string $url = '';
    public string $token = '';

    public function __construct(string $url, string $token)
    {
        $this->url = $url;
        $this->token = $token;
    }

    public function getSubscribers(int $listId, array $filter = []): object|array
    {
        $url = $this->url . '/api/email-lists/' . $listId . '/subscribers?1=1';

        if (isset($filter['email'])) {
            $url .= '&filter[email]=' . $filter['email'];
        }
        if (isset($filter['status'])) {
            $url .= '&filter[status]=' . $filter['status'];
        }
        if (isset($filter['search'])) {
            $url .= '&filter[search]=' . $filter['search'];
        }

        return Http::acceptJson()->contentType('application/json')->withToken($this->token)->get($url)->object();
    }

    public function findSubscriber(int $listId, string $email): SubscriberData
    {
        $filter = ['email' => $email];

        $data = collect($this->getSubscribers($listId, $filter)->data)->first();

        return SubscriberData::from($data);
    }

    public function getSubscriber(int $id): SubscriberData|string
    {
        $url = $this->url . '/api/subscribers/' . $id;

        $response = Http::acceptJson()->contentType('application/json')->withToken($this->token)->get($url);

        if ($response->failed()) {
            return $response->body();
        }

        return SubscriberData::from($response->object()->data);
    }

    public function addSubscriber(int $listId, InputSubscriberData $data): SubscriberData|string
    {
        $url = $this->url . '/api/email-lists/' . $listId . '/subscribers';

        $response = Http::acceptJson()->contentType('application/json')->withToken($this->token)->post($url, $data->toArray());

        if ($response->failed()) {
            return $response->body();
        }

        return SubscriberData::from($response->object()->data);
    }

    public function updateSubscriber(int $id, InputSubscriberData $data): SubscriberData|string
    {
        $url = $this->url . '/api/subscribers/' . $id;

        $response = Http::acceptJson()->contentType('application/json')->withToken($this->token)->patch($url, $data->toArray());

        if ($response->failed()) {
            return $response->body();
        }

        return SubscriberData::from($response->object()->data);
    }

    public function deleteSubscriber(int $id): bool
    {
        $url = $this->url . '/api/subscribers/' . $id;

        $response = Http::acceptJson()->contentType('application/json')->withToken($this->token)->delete($url);

        if ($response->successful()) {
            return true;
        }

        return false;
    }

    public function resubscribe(int $id): bool
    {
        $url = $this->url . '/api/subscribers/' . $id . '/subscribe';

        $response = Http::acceptJson()->contentType('application/json')->withToken($this->token)->post($url);

        if ($response->successful()) {
            return true;
        }

        return false;
    }

    public function unsubscribe(int $id): bool
    {
        $url = $this->url . '/api/subscribers/' . $id . '/unsubscribe';

        $response = Http::acceptJson()->contentType('application/json')->withToken($this->token)->post($url);

        if ($response->successful()) {
            return true;
        }

        return false;
    }

    public function confirmSubscriber(int $id): bool
    {
        $url = $this->url . '/api/subscribers/' . $id . '/confirm';

        $response = Http::acceptJson()->contentType('application/json')->withToken($this->token)->post($url);

        if ($response->successful()) {
            return true;
        }

        return false;
    }

    public function resendConfirmationSubscriber(int $id): bool
    {
        $url = $this->url . '/api/subscribers/' . $id . '/resend-confirmation';

        $response = Http::acceptJson()->contentType('application/json')->withToken($this->token)->post($url);

        if ($response->successful()) {
            return true;
        }

        return false;
    }
}
