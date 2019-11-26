<?php

declare(strict_types=1);

namespace App\Nats\Consumer;

use Hyperf\Nats\AbstractConsumer;
use Hyperf\Nats\Annotation\Consumer;
use Hyperf\Nats\Message;

/**
 * @Consumer(subject="hyperf", queue="hyperf", name ="DemoConsumer", nums=1)
 */
class DemoConsumer extends AbstractConsumer
{
    public function consume(Message $payload)
    {
        var_dump($payload->getBody());
    }
}
