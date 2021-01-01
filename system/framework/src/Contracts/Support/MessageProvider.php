<?php

namespace System\Contracts\Support;

interface MessageProvider
{
    /**
     * Get the messages for the instance.
     *
     * @return \System\Contracts\Support\MessageBag
     */
    public function getMessageBag();
}
