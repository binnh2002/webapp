<?php

    class Product{

    //table fields
    public $id;
    public $name;
    public $price;
    public $details;
    public $image1;
    public $image2;
    public $image3;
    public $producerID;

    // constructor set default value

    function __construct()
    {
        $id = $name = $details = $image1 = $image2 = $image3 = "";
        $price = $producerID = 0;
    }

}
?>