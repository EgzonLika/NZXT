<?php

    class Items{

        private $Image;
        private $Name;
        private $FactoryName = null;
        private $Processor = null;
        private $Graphics = null;
        private $RAM = null;
        private $Price;
        private $Category;
        private $Addedby;

        function __construct($Image,$Name,$FactoryName,$Processor,$Graphics,$RAM,$Price,$Category,$Addedby)
        {
               $this->Image = $Image;
               $this->Name = $Name;
               $this->FactoryName = $FactoryName;
               $this->Processor = $Processor;
               $this->Graphics = $Graphics;
               $this->RAM = $RAM;
               $this->Price = $Price;
               $this->Category = $Category;
               $this->Addedby = $Addedby;
        }
        function getImage()
        {
            return $this->Image;
        }
        function setImage($newImage)
        {
            $this->Image = $newImage;
        }
        function getName()
        {
            return $this->Name;
        }
        function setName($NewName)
        {
            $this->Name = $NewName;
        }
        function getFactoryName()
        {
            return $this->FactoryName;
        }
        function setFactoryName($NewLastName)
        {
            $this->FactoryName = $NewLastName;
        }
        function getProcessor()
        {
            return $this->Processor;
        }
        function setProcessor($NewEmail)
        {
            $this->Processor=$NewEmail;
        }
        function getGraphics()
        {
            return $this->Graphics;
        }
        function setGraphics($NewUsername)
        {
            $this->Graphics=$NewUsername;
        }
        function getRAM()
        {
            return $this->RAM;
        }
        function setRAM($NewPassword)
        {
            $this->RAM = $NewPassword;
        }
        function getPrice()
        {
            return $this->Price;
        }
        function setPrice($NewPrice)
        {
            $this->Price=$NewPrice;
        }
        function getCategory()
        {
            return $this->Category;
        }
        function setCategory($NewCategory)
        {
            $this->Category=$NewCategory;
        }
        function getAddedBy()
        {
            return $this->Addedby;
        }
        function setAddedBy($newAddedBy)
        {
            $this->Addedby = $newAddedBy;
        }
    }

?>