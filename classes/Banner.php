<?php
class Banner extends Mapper {
  
  public function getBanners() {
      $sql = "SELECT * from banners order by display_order";
      $stmt = $this->db->query($sql);
      return $stmt->fetchAll(PDO::FETCH_OBJ);
  }


  public function getBanner($id) {
      $sql = "SELECT * from banners where id = $id";
      $stmt = $this->db->query($sql);
      return $stmt->fetch(PDO::FETCH_OBJ);
  }


  public function updateBanner($b) {
      // old position
      $old_position = $this->getOldPostion($b->id);
      if($old_position != $b->position) {
        $display_order = $this->getRowCountByPostion($b->position) + 1;
        $sql = "UPDATE banners  SET position = ?, display_order = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array($b->position, $display_order, $b->id));
        return $stmt->rowCount();
      } else {
        return 0;
      }
  }

  public function reorder($newBannersArray) {
    // $this->logger->addInfo(print_r($newBannersArray,true));
    $i = 0;
    foreach ($newBannersArray as $banner) {
      // $this->logger->addInfo($banner['id']);
      $i++;
      $sql = "UPDATE banners set display_order = ? where id = ?";
      $stmt = $this->db->prepare($sql);
      $stmt->execute(array($i, $banner['id']));
    }
    return;
  }

  public function addBanner($banner, $position, $id) {
      $display_order = $this->getRowCountByPostion($position) + 1;
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

  private function getRowCountByPostion($position) {
      $sql = "SELECT id from banners where position = ?";
      $stmt = $this->db->prepare($sql);
      $stmt->execute(array($position));
      return $stmt->rowCount();
  }

  private function getOldPostion($id) {
      $sql = "SELECT position from banners where id = ?";
      $stmt = $this->db->prepare($sql);
      $stmt->execute(array($b->id));
      $row = $stmt->fetch(PDO::FETCH_OBJ);
      return $row->position;
  }
}
