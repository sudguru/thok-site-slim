<?php
class Mapper {
    protected $db;
    public function __construct($db) {
        $this->db = $db;
    }
}
