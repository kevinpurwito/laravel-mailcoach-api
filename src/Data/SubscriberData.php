<?php

namespace Kevinpurwito\LaravelMailcoachApi\Data;

use Spatie\LaravelData\Data;

class SubscriberData extends Data
{
    public function __construct(
        public int          $id,
        public int          $email_list_id,
        public string       $uuid,
        public string       $email,
        public string|null  $subscribed_at,
        public string|null  $unsubscribed_at,
        public string       $created_at,
        public string       $updated_at,
        public string|null  $first_name = null,
        public string|null  $last_name = null,
        public array|object $extra_attributes = [],
        public array        $tags = [],
    )
    {
        $this->extra_attributes = (array)$extra_attributes;
    }
}
