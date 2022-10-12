<?php

return [
    'url' => strtolower(env('KP_MAILCOACH_API_URL')),

    'token' => env('KP_MAILCOACH_API_TOKEN'),

    'list_id' => intval(env('KP_MAILCOACH_LIST_ID', 1)),
];
