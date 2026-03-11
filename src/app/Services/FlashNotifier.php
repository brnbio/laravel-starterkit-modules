<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Container\Attributes\Singleton;
use Inertia\Inertia;

#[Singleton]
final class FlashNotifier
{
    public array $messages = [];

    public function info(string $message): FlashNotifier
    {
        return $this->message($message);
    }

    public function success(string $message): FlashNotifier
    {
        return $this->message($message, 'success');
    }

    public function error(string $message): FlashNotifier
    {
        return $this->message($message, 'error');
    }

    public function warning(string $message): FlashNotifier
    {
        return $this->message($message, 'warning');
    }

    public function message(string $message, string $level = 'info'): FlashNotifier
    {
        $this->messages[] = compact('message', 'level');

        return $this->flash();
    }

    public function clear(): FlashNotifier
    {
        $this->messages = [];

        return $this;
    }

    protected function flash(): FlashNotifier
    {
        Inertia::flash('flash_notification', $this->messages);

        return $this;
    }
}