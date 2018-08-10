<?php

use JsonSerializer\JsonSerializableObject;

/**
 * Order
 * 
 * @JsonSerializable
 * 
 */
class Order extends JsonSerializableObject
{
    /**
     * @JsonPropertyName order_id
     * 
     * @var integer
     */
    private $orderId = 0;

    /**
     * @JsonPropertyName customer
     * 
     * @var Customer
     */
    private $customer;

    /**
     * @JsonPropertyName products
     * 
     * @var array
     */
    private $products = array();

    /**
     * Get OrderId
     *
     * @return int
     */
    public function getOrderId(): int
    {
        return $this->orderId;
    }

    /**
     * Set OrderId
     *
     * @param integer $orderId
     *
     * @return Order
     */
    public function setOrderId(int $orderId): Order
    {
        $this->orderId = $orderId;

        return $this;
    }

    /**
     * Get customer
     *
     * @return Customer
     */
    public function getCustomer(): Customer
    {
        return $this->customer !== null ? $this->customer : new Customer();
    }

    /**
     * Set customer
     *
     * @param Customer $customer
     *
     * @return Order
     */
    public function setCustomer(Customer $customer): Order
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Get Products
     *
     * @return array
     */
    public function getProducts(): array
    {
        return ($this->products !== null and is_array($this->products) and count($this->products) > 0) ? $this->products : array(new Product());
    }

    /**
     * Add Product
     *
     * @param Product $product
     *
     * @return Order
     */
    public function addProduct(Product $product): Order
    {
        $this->products[] = $product;

        return $this;
    }
    
}
