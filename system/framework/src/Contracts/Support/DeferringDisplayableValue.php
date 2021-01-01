<?php

namespace System\Contracts\Support;

interface DeferringDisplayableValue
{
    /**
     * Resolve the displayable value that the class is deferring.
     *
     * @return \System\Contracts\Support\Htmlable|string
     */
    public function resolveDisplayableValue();
}
