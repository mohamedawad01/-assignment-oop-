<?php 

require_once "app.php";



$customers = $mysql->select(" customers ");
echo "<pre>";
print_r($customers);

// echo"</hr>";

// $customer = $mysql->selectOne("select * from customers where customerNumber = 112");
// echo "<pre>";
// print_r($customer);