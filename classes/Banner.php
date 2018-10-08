<?php
class Banner extends Mapper {
  
  public function getBanners() {
      $sql = "SELECT * from banners";
      $stmt = $this->db->query($sql);
      return $stmt->fetchAll(PDO::FETCH_OBJ);
  }


  public function getBanner($id) {
      $sql = "SELECT * from banners where id = $id";
      $stmt = $this->db->query($sql);
      return $stmt->fetch(PDO::FETCH_OBJ);
  }


  public function updateBanner($b) {
      $sql = "UPDATE banners  SET position = ? WHERE id = ?";
      $stmt = $this->db->prepare($sql);
      $stmt->execute(array($b->position, $b->id));
      return $stmt->rowCount();
  }

  public function addBanner($banner, $position, $id) {
      $sql = "SELECT id from banners where position = ?";
      $stmt = $this->db->prepare($sql);
      $stmt->execute(array($position));
      $display_order = $stmt->rowCount() + 1;

      $sql = "INSERT INTO banners(display_order, position, banner) values(?,?,?)";

      $stmt = $this->db->prepare($sql);
      $stmt->execute(array($display_order, $position, $banner));
      return $stmt->rowCount();
  }


  public function deleteBanner($id) {
      $sql = "DELETE from banners where id = ?";
      $stmt = $this->db->prepare($sql);
      $stmt->execute(array($id));
      return $stmt->rowCount();
  }
}
