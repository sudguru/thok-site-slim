<?php
class Setting extends Mapper {
  


  public function getSetting($id) {
      $sql = "SELECT * from settings where id = $id";
      $stmt = $this->db->query($sql);
      return $stmt->fetch(PDO::FETCH_OBJ);
  }


  public function updateSetting($s) {
      $sql = "UPDATE settings  SET site_name = ?, phone1 = ?, phone2 = ?, address =?, email = ?, order_email = ?, description = ? WHERE id = ?";
      $stmt = $this->db->prepare($sql);
      $stmt->execute(array($s->site_name, $s->phone1, $s->phone2, $s->address, $s->email, $s->order_email, $s->description, $s->id));
      return $stmt->rowCount();
  }


}
