Simple PHP serializer for any objects to JSON.
=========================

[![Build Status](https://travis-ci.org/denisyfrolov/json-serializer.svg?branch=master)](https://travis-ci.org/denisyfrolov/json-serializer)
[![Build Status](https://scrutinizer-ci.com/g/denisyfrolov/json-serializer/badges/build.png?b=master)](https://scrutinizer-ci.com/g/denisyfrolov/json-serializer/build-status/master)
[![Code Coverage](https://scrutinizer-ci.com/g/denisyfrolov/json-serializer/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/denisyfrolov/json-serializer/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/denisyfrolov/json-serializer/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/denisyfrolov/json-serializer/?branch=master)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/denisyfrolov/json-serializer/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/code-intelligence)
[![Latest Stable Version](https://poser.pugx.org/denisyfrolov/json-serializer/v/stable)](https://packagist.org/packages/denisyfrolov/json-serializer) 
[![Total Downloads](https://poser.pugx.org/denisyfrolov/json-serializer/downloads)](https://packagist.org/packages/denisyfrolov/json-serializer)
[![License](https://poser.pugx.org/denisyfrolov/json-serializer/license)](https://packagist.org/packages/denisyfrolov/json-serializer) 

- [Installation](#installation)
- [Introduction](#introduction)
- [Features](#features)
- [Serialization](#serialization)
- [Example](#example)
- [Quality](#quality)
- [Contribute](#contribute)
- [Author](#author)


## Installation

Use [Composer](https://getcomposer.org) to install the package:

```json
$ composer require denisyfrolov/json-serializer
```


## Introduction 

**What is serialization?**

In the context of data storage, serialization is the process of translating data structures or object state into a format that can be stored (for example, in a file or memory buffer, or transmitted across a network connection link) and reconstructed later in the same or another computer environment.

    
## Features

This is a very simple class which allows you to serialize any child objects to JSON.

- Recursively serializes all the properties you allow to serialize, including multidimensional arrays of objects of other classes.
- Uses annotations to customize the scheme for serialized objects and to mark which classes and properties should be serialized.
- Allows you to customize JSON's field names.
- Allows you to exclude any property of objects from serialization.
- Allows you to prevent serialization of any properties, classes of which should not be serialized.


## Serialization
Make your class to be inherited from the serializator class `JsonSerializableObject`:

```php
use JsonSerializer\JsonSerializableObject;

class Order extends JsonSerializableObject
{

}
```

Mark your class as serializable using the flag `@JsonSerializable` in an annotations area of the class:

```php
use JsonSerializer\JsonSerializableObject;

/**
 * @JsonSerializable
 */
class Order extends JsonSerializableObject
{

}
```

If your class uses different classes as types for properties you want to serialize, mark all of these classes as serializable too. Otherwise the exception will be thrown: `Class ClassName is not marked as serializable`.

Make getters for all the properties you want to serialize. Also make the properties publicly accessible:

```php
use JsonSerializer\JsonSerializableObject;

/**
 * @JsonSerializable
 */
class Order extends JsonSerializableObject
{
    /**
     * @var integer
     */
    private $orderId = 0;

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
}
```

By default the serializer uses property names as field names in JSON's schema. If you want to customize the names in the schema, use `@JsonPropertyName property_name` keyword in an annotations area of the property:

```php
use JsonSerializer\JsonSerializableObject;

/**
 * @JsonSerializable
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
}
```

To prevent any properties from serialization, mark the properties as **Non Serializable** using keyword `@JsonPropertyNonSerializable` in an annotations area of the property:

```php
use JsonSerializer\JsonSerializableObject;

/**
 * @JsonSerializable
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
     * @JsonPropertyNonSerializable
     * 
     * @var float
     */
    private $amount = 0;

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
     * Get Amount
     *
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * Set Amount
     *
     * @param float $amount
     *
     * @return Order
     */
    public function setAmount(float $amount): Order
    {
        $this->amount = $amount;

        return $this;
    }
}
```

Call `jsonSerialize()` method to serialize your object to JSON format.

```php
require_once '../vendor/autoload.php';

$order = new Order();
$order->setOrderId(12345);
$order->setAmount(100);

print $order->jsonSerialize();
```

**Output**

```json
{
    "order_id": 12345,
    "amount": 100
}
```


### Example

You can find this example with all the classes in `example` folder of the project.

**Code**

```php
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
```

```php
require_once '../vendor/autoload.php';
require_once 'Order.php';
require_once 'Product.php';
require_once 'Customer.php';

$customer = new Customer();
$customer->setName('Test Customer Name');
$customer->setEmail('example@email.com');

$product = new Product();
$product->setName('Test Product 1 Name');
$product->setQuantity(2);
$product->setPrice(10.52);

$product2 = new Product();
$product2->setName('Test Product 2 Name');
$product2->setQuantity(4);
$product2->setPrice(11.53);

$order = new Order();
$order->setOrderId(12345);
$order->setCustomer($customer);
$order->addProduct($product);
$order->addProduct($product2);

print $order->jsonSerialize();
```

**Output**

```json
{
    "order_id": 12345,
    "customer": {
        "name": "Test Customer Name",
        "email": "example@email.com"
    },
    "products": [
        {
            "name": "Test Product 1 Name",
            "quantity": 2,
            "price": 10.52,
            "amount": 21.04
        },
        {
            "name": "Test Product 2 Name",
            "quantity": 4,
            "price": 11.53,
            "amount": 46.12
        }
    ]
}
```


## Quality

To run the PHPUnit tests at the command line, go to the project's root directory and issue `phpunit`.

This library attempts to comply with [PSR-4](http://www.php-fig.org/psr/psr-4/).

If you notice compliance oversights, please send a patch via pull request.


## Contribute

Contributions to the package are always welcome!

* Report any bugs or issues you find on the [issue tracker](https://github.com/denisyfrolov/json-serializer/issues/new).
* You can grab the source code at the package's [Git repository](https://github.com/denisyfrolov/json-serializer).


## Author

* [Denis Y Frolov](https://twitter.com/denisyfrolov)

## License
The code base is licensed under the MIT license.