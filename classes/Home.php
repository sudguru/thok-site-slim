<?php
class Home extends Mapper {
  
  public function getTopSlides() {
      $sql = "SELECT * from banners where position='Home Main' order by display_order";
      $stmt = $this->db->query($sql);
      return $stmt->fetchAll(PDO::FETCH_OBJ);
  }

  public function getSubSlides() {
      $sql = "SELECT * from banners where position='Home Sub Main' order by display_order";
      $stmt = $this->db->query($sql);
      return $stmt->fetchAll(PDO::FETCH_OBJ);
  }


  public function getBannerasdf($id) {
      $sql = "SELECT * from banners where id = $id";
      $stmt = $this->db->query($sql);
      return $stmt->fetch(PDO::FETCH_OBJ);
  }


}
