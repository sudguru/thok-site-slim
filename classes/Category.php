<?php
class Category extends Mapper {
  public function getCategories() {
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
}
