<?php

namespace B ;

include "autoload.php" ;


// -> use start from root 
use A\Person;
// use B\Person ;

use function A\hello;



$p1 = new Person();
$p2 = new \B\Person();

hello(); 


$p1->name = "Qusay";
$p2->name = "Rawaa";

$p1->setAge(20);
$p2->setAge(44);

$p1->setCountry("al swyadia");
$p2->setCountry("Damas");


echo "<pre>";
var_dump($p1, $p2);


echo Person::$country . "<br>" ;
echo \B\Person::$country ;

