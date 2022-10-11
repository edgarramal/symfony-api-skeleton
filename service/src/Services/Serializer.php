<?php

namespace Service\Services;

use Service\Message\DefaultMessage;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Transport\Serialization\SerializerInterface;

class Serializer implements SerializerInterface
{

    private MessagingService $messagingService;

    /**
     * Serializer constructor.
     * @param MessagingService $messagingService
     */
    public function __construct(MessagingService $messagingService)
    {
        $this->messagingService = $messagingService;
    }

    /**
     * Serialize object arrive from queue
     * @param array $encodedEnvelope
     * @return Envelope
     * @throws \Exception
     */
    public function decode(array $encodedEnvelope): Envelope
    {
        $stamps = [];
        if (isset($headers['stamps'])) {
            $stamps = unserialize($encodedEnvelope['headers']['stamps']);
        }

        $messageObject =  new DefaultMessage();
        return new Envelope($messageObject, $stamps);
    }

    /**
     * Encode Object to send it via Queue
     * @param Envelope $envelope
     * @return array
     * @throws \Exception
     */
    public function encode(Envelope $envelope): array
    {
        $message = $envelope->getMessage();
        $headers = [];

        return [
            'body' => $message->jsonSerialize(),
            'headers' => $headers
        ];
    }
}
