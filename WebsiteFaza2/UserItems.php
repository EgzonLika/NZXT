<?php

    class UserItems
    {
        private $CARTID;
        private $USERID;
        private $ITEMID;
        private $Quantity;

        function __construct($CARTID,$USERID,$ITEMID,$Quantity)
        {
            $this->CARTID = $CARTID;
            $this->USERID = $USERID;
            $this->ITEMID = $ITEMID;
            $this->Quantity = $Quantity;
        }
        function getCartId()
        {
            return $this->CARTID;
        }
        function getUserId()
        {
            return $this->USERID;
        }
        function getItemId()
        {
            return $this->ITEMID;
        }
        function getQuantityy()
        {
            return $this->Quantity;
        }
        function setQuantity($NewQuantity)
        {
            $this->Quantity = $NewQuantity;
        }
    }
?>