<?php

namespace JsonSerializer\Test;

/**
 * JsonSerializerTest
 * 
 * @package denisyfrolov/json-serializer
 * @author Denis Frolov <denisyfrolov@hotmail.com>
 */
class JsonSerializerTest extends \PHPUnit\Framework\TestCase
{
    private $customer;
    private $product;
    private $product2;
    private $order;
    private $orderNonSerializable;

    public function setUp()
    {
        $this->customer = new Customer();
        $this->customer->setName('Test Customer Name');
        $this->customer->setEmail('example@email.com');
        $this->customer->addAddress('Address 1');
        $this->customer->addAddress('Address 2');

        $this->product = new Product();
        $this->product->setName('Test Product 1 Name');
        $this->product->setQuantity(2);
        $this->product->setPrice(10.52);

        $this->product2 = new Product();
        $this->product2->setName('Test Product 2 Name');
        $this->product2->setQuantity(4);
        $this->product2->setPrice(11.53);

        $this->order = new Order();
        $this->order->setOrderId(12345);
        $this->order->setCustomer($this->customer);
        $this->order->addProduct($this->product);
        $this->order->addProduct($this->product2);

        $this->orderNonSerializable = new OrderNonSerializable();
        $this->orderNonSerializable->setOrderId(12345);
        $this->orderNonSerializable->setCustomer($this->customer);
        $this->orderNonSerializable->addProduct($this->product);
        $this->orderNonSerializable->addProduct($this->product2);
    } 
    
    public function testJsonSerialization()
    {
        $this->assertEquals($this->order->jsonSerialize(), '{"order_id":' . (string)$this->order->getOrderId() . ',"customer":{"name":"' . (string)$this->order->getCustomer()->getName() . '","email":"' . (string)$this->order->getCustomer()->getEmail() . '","addresses":["' . (string)$this->order->getCustomer()->getAddresses()[0] . '","' . (string)$this->order->getCustomer()->getAddresses()[1] . '"]},"products":[{"name":"' . (string)$this->order->getProducts()[0]->getName() . '","quantity":' . (string)$this->order->getProducts()[0]->getQuantity() . ',"price":' . (string)$this->order->getProducts()[0]->getPrice() . ',"amount":' . (string)$this->order->getProducts()[0]->getAmount() . '},{"name":"' . (string)$this->order->getProducts()[1]->getName() . '","quantity":' . (string)$this->order->getProducts()[1]->getQuantity() . ',"price":' . (string)$this->order->getProducts()[1]->getPrice() . ',"amount":' . (string)$this->order->getProducts()[1]->getAmount() . '}]}'); 
    }

    public function testExceptionNonSerializable()
    {
        $this->expectException(\Exception::class);
        $this->orderNonSerializable->jsonSerialize(); 
    }
    
}