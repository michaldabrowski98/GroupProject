<?php

namespace App\Shared\Infrastructure\Bus\Query;

use App\Shared\Domain\Bus\Query\Query;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use App\Shared\Domain\Bus\Query\Response;
use Throwable;

class MessengerQueryBus
{
    private MessageBusInterface $queryBus;

    public function __construct(MessageBusInterface $queryBus)
    {
        $this->queryBus = $queryBus;
    }

    /**
     * @throws Throwable
     */
    public function handle(Query $query): Response
    {
        try {
            $response = $this->queryBus->dispatch($query);

            $handled = $response->last(HandledStamp::class);
            return $handled->getResult();
        } catch (HandlerFailedException $e) {
            while ($e instanceof HandlerFailedException) {
                $e = $e->getPrevious();
            }

            throw $e;
        }
    }
}
