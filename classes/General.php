<?php
class General extends Mapper {
  
  public function getSettings() {
      $sql = "SELECT * from settings limit 1";
      $stmt = $this->db->query($sql);
      return $stmt->fetch(PDO::FETCH_OBJ);
  }


  public function getBannerasdf($id) {
      $sql = "SELECT * from banners where id = $id";
      $stmt = $this->db->query($sql);
      return $stmt->fetch(PDO::FETCH_OBJ);
  }


}
