<?php

declare(strict_types=1);

use App\Services\FlashNotifier;

beforeEach(function () {
    $this->flash = app(FlashNotifier::class);
});

test('success adds message with success level', function () {
    $this->flash->success('Gespeichert.');

    expect($this->flash->messages)->toBe([
        ['message' => 'Gespeichert.', 'level' => 'success'],
    ]);
});

test('error adds message with error level', function () {
    $this->flash->error('Fehlgeschlagen.');

    expect($this->flash->messages)->toBe([
        ['message' => 'Fehlgeschlagen.', 'level' => 'error'],
    ]);
});

test('warning adds message with warning level', function () {
    $this->flash->warning('Achtung.');

    expect($this->flash->messages)->toBe([
        ['message' => 'Achtung.', 'level' => 'warning'],
    ]);
});

test('info adds message with info level', function () {
    $this->flash->info('Hinweis.');

    expect($this->flash->messages)->toBe([
        ['message' => 'Hinweis.', 'level' => 'info'],
    ]);
});

test('message defaults to info level', function () {
    $this->flash->message('Default.');

    expect($this->flash->messages)->toBe([
        ['message' => 'Default.', 'level' => 'info'],
    ]);
});

test('multiple messages accumulate', function () {
    $this->flash->success('Erste.');
    $this->flash->error('Zweite.');

    expect($this->flash->messages)->toHaveCount(2)
        ->and($this->flash->messages[0]['level'])->toBe('success')
        ->and($this->flash->messages[1]['level'])->toBe('error');
});

test('clear removes all messages', function () {
    $this->flash->success('Wird gelöscht.');
    $this->flash->clear();

    expect($this->flash->messages)->toBe([]);
});

test('methods return self for chaining', function () {
    $result = $this->flash->success('Eins')->error('Zwei')->warning('Drei');

    expect($result)->toBeInstanceOf(FlashNotifier::class)
        ->and($this->flash->messages)->toHaveCount(3);
});

test('is registered as singleton', function () {
    $a = app(FlashNotifier::class);
    $b = app(FlashNotifier::class);

    $a->success('Test.');

    expect($a)->toBe($b)
        ->and($b->messages)->toHaveCount(1);
});
