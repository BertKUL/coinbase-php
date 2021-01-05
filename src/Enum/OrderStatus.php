<?php

namespace Coinbase\Wallet\Enum;

/**
 * Supported order statuses.
 */
class OrderStatus
{
    const OPEN = 'open';
    const PENDING = 'pending';
    const ACTIVE = 'active';

    private function __construct()
    {
    }
}
