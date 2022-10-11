<?php

namespace Service\Message;

use Service\ReportApiData;

class DefaultMessage implements \JsonSerializable
{

    /**
     * Base64ReportMessage constructor.
     */
    public function __construct()
    {

    }


    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [];
    }
}
