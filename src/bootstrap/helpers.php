<?php

declare(strict_types=1);

use App\Services\FlashNotifier;

function flash(): FlashNotifier
{
    return app(FlashNotifier::class);
}