<?php

namespace Service\Services;

use Service\Message\DefaultMessage;
use Service\Message\ReportGenerationErrorMessage;
use Service\Message\SerializerDecodeErrorMessage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\SerializerStamp;

class MessagingService extends AbstractController
{
    /**
     * @var MessageBusInterface
     */
    private MessageBusInterface $eventBus;

    /**
     * MessagingService constructor.
     * @param MessageBusInterface $eventBus
     */
    public function __construct(MessageBusInterface $eventBus)
    {
        $this->eventBus = $eventBus;
    }

    /**
     * @param object $object
     */
    public function sendMessage(object $object)
    {
        $this->eventBus->dispatch($object);
    }

    /**
     * @param DefaultMessage|ReportGenerationErrorMessage| SerializerDecodeErrorMessage $object
     */
    public function sendReportMessage($object)
    {
        $stamps = new SerializerStamp(['headers' => $object->getApiData()->toArray()]);
        $this->eventBus->dispatch(new Envelope($object, [$stamps]), [$stamps]);
    }
}
