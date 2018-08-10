<?php

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
     * @JsonPropertyName name
     * 
     * @var string
     */
    private $name = '';

    /**
     * @JsonPropertyName email
     * 
     * @var string
     */
    private $email = '';

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

}
