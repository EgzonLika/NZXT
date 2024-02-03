<?php
include_once 'Database.php';
    Class User
    {
        private $id;
        private $Name;
        private $LastName;
        private $email;
        private $Username;
        private $Password;
        private $role;
        private $cart;

        function __construct($id,$Name,$LastName,$email, $Username, $Password,$role,$cart)
        {
            $this->id =$id;
            $this->Name = $Name;
            $this->LastName = $LastName;
            $this->email = $email;
            $this->Username = $Username;
            $this->Password = $Password;
            $this->role = $role;
            $this->cart = $cart;
        }
        function getCartId()
        {
            return $this->cart;
        }
        function getRole()
        {
            return $this->role;
        }
        function getId()
        {
            return $this->id;
        }
        function getName()
        {
            return $this->Name;
        }
        function setName($NewName)
        {
            $this->Name = $NewName;
        }
        function getLastName()
        {
            return $this->LastName;
        }
        function setLastName($NewLastName)
        {
            $this->LastName = $NewLastName;
        }
        function getEmail()
        {
            return $this->email;
        }
        function setEmail($NewEmail)
        {
            $this->email=$NewEmail;
        }
        function getUsername()
        {
            return $this->Username;
        }
        function setUsername($NewUsername)
        {
            $this->Username=$NewUsername;
        }
        function getPassword()
        {
            return $this->Password;
        }
        function setPassword($NewPassword)
        {
            $this->Password = $NewPassword;
        }
    }
?>