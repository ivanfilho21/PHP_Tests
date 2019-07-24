<?php

class User
{
    public function __construct($id = "", $typeId = "", $nickname = "", $name = "", $email = "", $password = "", $last_seen = "", $birthday = "", $creation_date = "")
    {
        $this->id = $id;
        $this->typeId = $typeId;
        $this->nickname = $nickname;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->last_seen = $last_seen;
        $this->birthday = $birthday;
        $this->creation_date = $creation_date;
    }

    public function setId($id) { $this->id = $id; }
    public function getId() { return $this->id; }
    public function setTypeId($typeId) { $this->typeId = $type; }
    public function getTypeId() { return $this->typeId; }
    public function setNickname($nickname) { $this->nickname = $nickname; }
    public function getNickname() { return $this->nickname; }
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