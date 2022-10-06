<?php

namespace Kevinpurwito\LaravelMailcoachApi\Data;

use Spatie\LaravelData\Data;

class InputSubscriberData extends Data
{
    public function __construct(
        public string      $email,
        public string|null $first_name = null,
        public string|null $last_name = null,
        public array       $extra_attributes = [],
        public array       $tags = [],
        public bool        $skip_confirmation = true, // for insert only
        public bool        $skip_welcome_mail = true, // for insert only
        public bool        $append_tags = true // for update only
    ) {
    }
}
