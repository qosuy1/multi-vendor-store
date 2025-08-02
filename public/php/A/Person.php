<?php

namespace A;

//define in
// define('AJYAL', true);

const LARAVEL = 'Laravel A';

function hello()
{
    echo "Hello A";
}

class Person
{
    use \Info;

    const MALE = 'M';
    const FEMALE = 'F';


    public $name;
    protected $gender;
    private $age;

    public static $country;

    public function __construct()
    {
        echo "hi from" . __CLASS__ . "\n";
    }

    public function setCountry($country)
    {
        self::$country = $country;
    }

}