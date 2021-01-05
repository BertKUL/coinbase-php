<?php

namespace Coinbase\Wallet\Enum;

/**
 * Supported order types.
 */
class OrderType
{
    const LIMIT = 'limit';
    const MARKET = 'market';

    private function __construct()
    {
    }
}
