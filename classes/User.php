<?php

class User extends Mapper {

    public function validateUser($login) {
        $sql = "SELECT * from users where email = :email and password = :password";
        $stmt = $this->db->prepare($sql);
        $stmt->execute((["email" => $login->username, "password" => $login->password]));
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
}
