<?php
class Content extends Mapper {
  
  public function getContents() {
      $sql = "SELECT * from contents";
      $stmt = $this->db->query($sql);
      return $stmt->fetchAll(PDO::FETCH_OBJ);
  }

  public function getContent($id) {
      $sql = "SELECT * from contents where id = $id";
      $stmt = $this->db->query($sql);
      return $stmt->fetch(PDO::FETCH_OBJ);
  }

  public function saveContent($content) {
      $sql = "INSERT into contents(title, slug, content) values (?, ?, ?)";
      $stmt = $this->db->prepare($sql);
      $stmt->execute(array($content->title, $content->slug, $content->content));
      $content->id = $this->db->lastInsertId();
      return $content;
  }

  public function updateContent($content) {
      $sql = "UPDATE contents  SET title = ?, slug = ?, content = ? WHERE id = ?";
      $stmt = $this->db->prepare($sql);
      $stmt->execute(array($content->title, $content->slug, $content->content, $content->id));
      return $stmt->rowCount();
  }


  public function deleteContent($id) {
      $sql = "DELETE from contents where id = ?";
      $stmt = $this->db->prepare($sql);
      $stmt->execute(array($id));
      return $stmt->rowCount();
  }
}
