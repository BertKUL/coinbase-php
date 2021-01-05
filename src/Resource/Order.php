<?php

namespace Coinbase\Wallet\Resource;

use Coinbase\Wallet\ActiveRecord\OrderActiveRecord;
use Coinbase\Wallet\Enum\OrderStatus;
use Coinbase\Wallet\Enum\OrderType;
use Coinbase\Wallet\Enum\ResourceType;
use Coinbase\Wallet\Value\Money;

class Order extends Resource
{
    use OrderActiveRecord;

    /**
     * @var string
     * @see OrderType
     */
    private $type;

    /** @var Money */
    private $price;
    /** @var string */
    private $product_id;
    /** @var string */
    private $side;
    /** @var string */
    private $stp;
    /** @var string */
    private $time_in_force;
    /** @var string */
    private $post_only;
    /** @var Money */
    private $fill_fees;
    /** @var Money */
    private $filled_size;
    /** @var Money */
    private $executed_value;
    /** @var boolean */
    private $settled;
    /**
     * @var string
     * @see OrderStatus
     */
    private $status;

    /** @var \DateTime */
    private $createdAt;

    //for new orders
    private $size;
    private $funds;

    /**
     * Creates an order reference.
     *
     * @param string $orderId The order id
     *
     * @return Order An order reference
     */
    public static function reference($orderId)
    {
        return new static('/v2/orders/' . $orderId);
    }

    public function __construct($resourcePath = null)
    {
        parent::__construct(ResourceType::ORDER, $resourcePath);
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getProduct_id()
    {
        return $this->product_id;
    }

    public function setProduct_id($product_id)
    {
        $this->product_id = $product_id;
    }


    public function getSide()
    {
        return $this->side;
    }

    public function setSide($side)
    {
        $this->side = $side;
    }

    public function getStp()
    {
        return $this->stp;
    }

    public function getTime_in_force()
    {
        return $this->time_in_force;
    }

    public function getPost_only()
    {
        return $this->post_only;
    }

    public function getFill_fees()
    {
        return $this->fill_fees;
    }

    public function getFilled_size()
    {
        return $this->filled_size;
    }
    //base currency
    public function setSize($amount)
    {
        $this->size = $amount;
    }
    //quote currency
    public function setFunds($amount)
    {
        $this->funds = $amount;
    }

    public function getExecuted_value()
    {
        return $this->executed_value;
    }

    public function getSettled()
    {
        return $this->settled;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}
