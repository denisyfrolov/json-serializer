<?php

namespace JsonSerializer\Test;

use JsonSerializer\JsonSerializableObject;

/**
 * Customer
 * 
 * @JsonSerializable
 * 
 */
class Customer extends JsonSerializableObject
{
    /**
     * @var string
     */
    private $name = '';

    /**
     * @JsonPropertyName email
     * 
     * @var string
     */
    private $email = '';

    /**
     * @JsonPropertyName addresses
     * 
     * @var array
     */
    private $addresses = array();

    public function __toString(): string
    {
        return 'Customer ' . (string)$this->getName();
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
     * @return Customer
     */
    public function setName(string $name): Customer
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get Email
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Set Email
     *
     * @param string $email
     *
     * @return Customer
     */
    public function setEmail(string $email): Customer
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get Addresses
     *
     * @return array
     */
    public function getAddresses(): array
    {
        return ($this->addresses !== null and is_array($this->addresses) and count($this->addresses) > 0) ? $this->addresses : array('dfg');
    }

    /**
     * Add Address
     *
     * @param string $address
     *
     * @return Customer
     */
    public function addAddress(string $address): Customer
    {
        $this->addresses[] = $address;

        return $this;
    }

}
