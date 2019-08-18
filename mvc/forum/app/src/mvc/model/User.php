<?php

class User
{
    const TYPE_NORMAL_USER = 1;
    const TYPE_MODERATOR_USER = 2;
    const TYPE_ADMIN_USER = 3;

    public function __construct($id = 0, $type = self::TYPE_NORMAL_USER, $username = "", $email = "", $password = "", $creation_date = "", $description = "", $signature = "", $image = "", $url = "", $name = "", $last_seen = "", $birthday = "")
    {
        $this->id = $id;
        $this->type = $type;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->creation_date = $creation_date;
        $this->description = $description;
        $this->signature = $signature;
        $this->image = $image;
        $this->setUrl();
        $this->name = $name;
        $this->last_seen = $last_seen;
        $this->birthday = $birthday;
    }

    public function setId($id) { $this->id = $id; }
    public function getId() { return $this->id; }
    public function setType($type) { $this->type = $type; }
    public function getType() { return $this->type; }
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

    public function setDescription($description) { $this->description = $description; }
    public function getDescription() { return $this->description; }
    public function setSignature($signature) { $this->signature = $signature; }
    public function getSignature() { return $this->signature; }
    public function setImage($image) { $this->image = $image; }
    public function getImage() { return $this->image; }
    public function getUrl() { return $this->url; }
    public function setUrl() { $this->url = encodeUrlFromName($this->getUsername()); }
}