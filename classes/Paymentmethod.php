<?php
class Paymentmethod extends Mapper {
  
  public function getPaymentmethods() {
      $sql = "SELECT * from payment_methods";
      $stmt = $this->db->query($sql);
      return $stmt->fetchAll(PDO::FETCH_OBJ);
  }

  public function getPaymentmethod($id) {
      $sql = "SELECT * from payment_methods where id = $id";
      $stmt = $this->db->query($sql);
      return $stmt->fetch(PDO::FETCH_OBJ);
  }

  public function savePaymentmethod($pm) {
      $sql = "INSERT into payment_methods(payment_method) values (?)";
      $stmt = $this->db->prepare($sql);
      $stmt->execute(array($pm->payment_method));
      $pm->id = $this->db->lastInsertId();
      return $pm;
  }

  public function updatePaymentmethod($pm) {
      $sql = "UPDATE payment_methods  SET payment_method = ? WHERE id = ?";
      $stmt = $this->db->prepare($sql);
      $stmt->execute(array($pm->payment_method, $pm->id));
      return $stmt->rowCount();
  }


  public function deletePaymentmethod($id) {
      $sql = "DELETE from payment_methods where id = ?";
      $stmt = $this->db->prepare($sql);
      $stmt->execute(array($id));
      return $stmt->rowCount();
  }
}
