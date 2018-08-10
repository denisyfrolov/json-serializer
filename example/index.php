<?php 
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

print $order->jsonSerialize() . "\r\n";