<?php

$t="php my ";
print "<h2>PHP is Fun!</h2>";
print "Hello world!<br>";
print "<h3>". $t. "</h3>";
print "I'm about to learn PHP!";

$x = 5985;
var_dump($x);

$cars = array("Volvo","BMW","Toyota");
var_dump($cars);

class Car {
    function Car() {
        $this->model = "VW";
		//$model="hh";
    }
}

// create an object
$herbie = new Car();

// show object properties
echo $herbie->model;

$x = "Hello world!";
$x = null;
var_dump($x);

echo strlen("Hello world!");
echo "<br>";
echo str_word_count("Hello world!");
echo "<br>";
echo "<br>";
echo strrev("Hello world!");
echo "<br>";
echo str_replace("world", "Dolly", "Hello world!");
echo "<br>";
//define("GREETING", "Welcome to W3Schools.com!");
define("GREETING", "Welcome !");
echo GREETING;
echo "<br>";echo "<br>";
$txt1 = "Hello";
$txt2 = "world!";
$txt1=$txt1.$txt2;
#$txt1 .= $txt2;
echo $txt1.$txt2;

?>
