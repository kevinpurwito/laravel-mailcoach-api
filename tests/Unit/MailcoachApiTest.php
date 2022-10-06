<?php

namespace Kevinpurwito\LaravelMailcoachApi\Tests\Unit;

use Illuminate\Support\Str;
use Kevinpurwito\LaravelMailcoachApi\Data\InputSubscriberData;
use Kevinpurwito\LaravelMailcoachApi\Data\SubscriberData;
use Kevinpurwito\LaravelMailcoachApi\MailcoachApi;
use Kevinpurwito\LaravelMailcoachApi\Tests\TestCase;

class MailcoachApiTest extends TestCase
{
    protected string $url;
    protected string $token;
    protected int $listId;
    protected int $subscriberId;
    protected string $email;

    public function setUp(): void
    {
        parent::setUp();

        $this->url = env('KP_MAILCOACH_API_URL');
        $this->token = env('KP_MAILCOACH_API_TOKEN');
        $this->listId = intval(env('KP_MAILCOACH_TEST_LIST_ID'));
        $this->subscriberId = intval(env('KP_MAILCOACH_TEST_SUBSCRIBER_ID'));
        $this->email = env('KP_MAILCOACH_TEST_EMAIL');
    }

    /** @test */
    public function it_has_credentials()
    {
        config([
            'kp_mailcoach.url' => 'url',
            'kp_mailcoach.token' => 'token',
        ]);

        $this->assertTrue(config('kp_mailcoach.url') == 'url');
        $this->assertTrue(config('kp_mailcoach.token') == 'token');
    }

    /** @test */
    public function it_shows_a_subscriber()
    {
        $id = $this->subscriberId;

        $subscriber = (new MailcoachApi($this->url, $this->token))->getSubscriber($id);

        $this->assertEquals($id, $subscriber->id);
    }

    /** @test */
    public function it_can_update_a_subscriber()
    {
        $id = $this->subscriberId;

        $data = new InputSubscriberData(
            email: $this->email,
            first_name: 'First',
            last_name: 'Last',
            extra_attributes: ['internal' => true],
            tags: ['internal']
        );

        $subscriber = (new MailcoachApi($this->url, $this->token))->updateSubscriber($id, $data);

        $this->assertEquals($id, $subscriber->id);
        $this->assertEquals('First', $subscriber->first_name);
        $this->assertEquals('Last', $subscriber->last_name);
        $this->assertArrayHasKey('internal', $subscriber->extra_attributes);
        $this->assertContains('internal', $subscriber->tags);
    }

    /** @test */
    public function it_can_subscribe_and_delete_subscriber()
    {
        $email = Str::random(10) . '@' . Str::random(10) . '.com';

        $data = new InputSubscriberData($email);

        $subscriber = (new MailcoachApi($this->url, $this->token))->addSubscriber($this->listId, $data);

        $this->assertTrue($subscriber instanceof SubscriberData);

        $id = $subscriber->id;

        $response = (new MailcoachApi($this->url, $this->token))->deleteSubscriber($id);

        $this->assertTrue($response);
    }

    /** @test */
    public function it_can_unsubscribe_and_resubscribe()
    {
        $id = $this->subscriberId;

        $response = (new MailcoachApi($this->url, $this->token))->unsubscribe($id);

        $this->assertTrue($response);

        $data = new InputSubscriberData($this->email);

        $subscriber = (new MailcoachApi($this->url, $this->token))->addSubscriber($this->listId, $data);

        $this->assertTrue($subscriber instanceof SubscriberData);
    }
}
