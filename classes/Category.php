<?php
class Category extends Mapper {
  
  public function getCategories() {
      $sql = "SELECT * from categories";
      $stmt = $this->db->query($sql);
      return $stmt->fetchAll(PDO::FETCH_OBJ);
  }

  public function getRootCategories() {
      $sql = "SELECT * from categories where parent_id = 0 order by category";
      $stmt = $this->db->query($sql);
      return $stmt->fetchAll(PDO::FETCH_OBJ);
  }

  public function getCategory($id) {
      $sql = "SELECT * from categories where id = $id";
      $stmt = $this->db->query($sql);
      return $stmt->fetch(PDO::FETCH_OBJ);
  }

  public function saveCategory($cat) {
      $sql = "INSERT into categories(category, description, parent_id) values (?, ?, ?)";
      $stmt = $this->db->prepare($sql);
      $stmt->execute(array($cat->category, $cat->description, $cat->parent_id));
      $cat->id = $this->db->lastInsertId();
      return $cat;
  }

  public function updateCategory($cat) {
      $sql = "UPDATE categories  SET category = ?, description = ?, parent_id =? WHERE id = ?";
      $stmt = $this->db->prepare($sql);
      $stmt->execute(array($cat->category, $cat->description, $cat->parent_id, $cat->id));
      return $stmt->rowCount();
  }

  public function updateBanner($banner, $id) {
      $sql = "UPDATE categories  SET banner = ? WHERE id = ?";
      $this->logger->addInfo('id ' . $id . ' banner ' . $banner );

      $stmt = $this->db->prepare($sql);
      $stmt->execute(array($banner, $id));
      return $stmt->rowCount();
  }


  public function deleteCategory($id) {
      $sql = "DELETE from categories where id = ?";
      $stmt = $this->db->prepare($sql);
      $stmt->execute(array($id));
      return $stmt->rowCount();
  }
}
