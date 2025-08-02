<?php


namespace B;

define('AJYAL', true);

const LARAVEL = 'Laravel B';

function hello()
{
    echo "Hello B";
}

class Person
{
    use \Info ;

    const MALE = 'M';
    const FEMALE = 'F';

    public $name;
    protected $gender;
    private $age;

    public static $country;

    public function __construct()
    {
        echo "hii from : " . __CLASS__ . " \n";
    }


    public function setCountry($country)
    {
        self::$country = $country;
    }

}