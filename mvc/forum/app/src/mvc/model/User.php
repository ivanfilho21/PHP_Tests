<?php

class User
{
    public function __construct($id = "", $typeId = "", $username = "", $email = "", $password = "", $creation_date = "", $name = "", $last_seen = "", $birthday = "")
    {
        $this->id = $id;
        $this->typeId = $typeId;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->creation_date = $creation_date;
        $this->name = $name;
        $this->last_seen = $last_seen;
        $this->birthday = $birthday;
    }

    public function setId($id) { $this->id = $id; }
    public function getId() { return $this->id; }
    public function setTypeId($typeId) { $this->typeId = $type; }
    public function getTypeId() { return $this->typeId; }
    public function setUsername($username) { $this->username = $username; }
    public function getUsername() { return $this->username; }
    public function setName($name) { $this->name = $name; }
    public function getName() { return $this->name; }
    public function setEmail($email) { $this->email = $email; }
    public function getEmail() { return $this->email; }
    public function setPassword($password) { $this->password = $password; }
    public function getPassword() { return $this->password; }
    public function setLastSeen($last_seen) { $this->last_seen = $last_seen; }
    public function getLastSeen() { return $this->last_seen; }
    public function setBirthday($birthday) { $this->birthday = $birthday; }
    public function getBirthday() { return $this->birthday; }
    public function setCreationDate($creation_date) { $this->creation_date = $creation_date; }
    public function getCreationDate() { return $this->creation_date; }

}