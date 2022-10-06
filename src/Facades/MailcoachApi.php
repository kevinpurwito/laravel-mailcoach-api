<?php

namespace Kevinpurwito\LaravelMailcoachApi\Facades;

use Illuminate\Support\Facades\Facade;

class MailcoachApi extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'MailcoachApi';
    }
}
