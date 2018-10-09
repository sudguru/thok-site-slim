<?php
class Outlet extends Mapper {
  
  public function getOutlets() {
      $sql = "SELECT * from outlets";
      $stmt = $this->db->query($sql);
      return $stmt->fetchAll(PDO::FETCH_OBJ);
  }

  public function getOutlet($id) {
      $sql = "SELECT * from outlets where id = $id";
      $stmt = $this->db->query($sql);
      return $stmt->fetch(PDO::FETCH_OBJ);
  }

  public function saveOutlet($outlet) {
      $sql = "INSERT into outlets(outlet, description, contact_person, address, phone, email, viber, whatsapp, skype, lat, lng) 
            values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
      $stmt = $this->db->prepare($sql);
      $stmt->execute(array($outlet->outlet, $outlet->description, $outlet->contact_person, $outlet->address, $outlet->phone, $outlet->email, $outlet->viber, $outlet->whatsapp, $outlet->skype, $outlet->lat, $outlet->lng));
      $outlet->id = $this->db->lastInsertId();
      return $outlet;
  }

  public function updateOutlet($outlet) {
      $sql = "UPDATE outlets  SET outlet = ?, description = ?, contact_person = ?, address = ?, phone = ?, email = ?, viber = ?, whatsapp = ?, skype = ?, lat = ?, lng = ? WHERE id = ?";
      $stmt = $this->db->prepare($sql);
      $stmt->execute(array($outlet->outlet, $outlet->description, $outlet->contact_person, $outlet->address, $outlet->phone, $outlet->email, $outlet->viber, $outlet->whatsapp, $outlet->skype, $outlet->lat, $outlet->lng, $outlet->id));
      return $stmt->rowCount();
  }


  public function deleteOutlet($id) {
      $sql = "DELETE from outlets where id = ?";
      $stmt = $this->db->prepare($sql);
      $stmt->execute(array($id));
      return $stmt->rowCount();
  }
}
