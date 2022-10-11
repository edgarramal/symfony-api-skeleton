<?php

namespace Service\MessageHandler;

use http\Exception;
use Psr\Log\LoggerInterface;
use Service\Message\DefaultMessage;
use Service\Message\ReportGenerationErrorMessage;
use Service\Message\SerializerDecodeErrorMessage;
use Service\Services\MessagingService;
use Symfony\Component\Messenger\Exception\TransportException;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class DefaultMessageHandler implements MessageHandlerInterface
{

    /**
     * @var MessagingService
     */
    private MessagingService $messagingService;

    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    /**
     * ReportHandler constructor.
     * @param MessagingService $messagingService
     * @param LoggerInterface $logger
     */
    public function __construct(MessagingService $messagingService, LoggerInterface $logger)
    {
        $this->messagingService = $messagingService;
        $this->logger = $logger;
    }

    /**
     * @param DefaultMessage $message
     * @throws \Exception
     */
    public function __invoke(DefaultMessage $message)
    {
        throw new \Exception('Not implemented method');
    }
}
