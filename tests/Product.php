<?php

namespace JsonSerializer\Test;

use JsonSerializer\JsonSerializableObject;

/**
 * Product
 * 
 * @JsonSerializable
 * 
 */
class Product extends JsonSerializableObject
{
    /**
     * @JsonPropertyName name
     * 
     * @var string
     */
    private $name = '';

    /**
     * @JsonPropertyName quantity
     * 
     * @var integer
     */
    private $quantity = 0;

    /**
     * @JsonPropertyName price
     * 
     * @var float
     */
    private $price = 0;

    /**
     * @JsonPropertyName amount
     * 
     * @var float
     */
    private $amount = 0;

    public function __toString(): string
    {
        return 'Product ' . (string)$this->getName();
    }

    /**
     * Get Name
     * 
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set Name
     *
     * @param string $name
     *
     * @return Product
     */
    public function setName(string $name): Product
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get Quantity
     *
     * @return integer
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * Set Quantity
     *
     * @param int $quantity
     *
     * @return Product
     */
    public function setQuantity(int $quantity): Product
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get Price
     * 
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * Set Price
     *
     * @param float $price
     *
     * @return Product
     */
    public function setPrice(float $price): Product
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get Amount
     *
     * @return float
     */
    public function getAmount(): float
    {
        return (floatval($this->amount) and $this->amount > 0) ? $this->amount : floatval($this->quantity * $this->price);
    }

    /**
     * Set Amount
     *
     * @param float $amount
     *
     * @return Product
     */
    public function setAmount(float $amount): Product
    {
        $this->amount = $amount;

        return $this;
    }
    
}
