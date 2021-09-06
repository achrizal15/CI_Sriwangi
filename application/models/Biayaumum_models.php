<?php
class Biayaumum_models extends CI_Model
{
  public function tambahData($data)
  {
    $sql = "INSERT INTO biayaumum VALUES(?,?,?,?,?)";
    $this->db->query($sql, $data);
    $idLst = $this->db->insert_id();
    $this->db->insert('pengeluaran', ["biayaumum_id" => $idLst, "pengeluaran_date" => time(), "pengeluaran_rincian" => "Biaya umum"]);
    return  $this->db->affected_rows();
  }
  public function deleteDataBiayaUmum($id)
  {
    $this->db->delete('biayaumum', ["biayaumum_id" => $id]);
    return $this->db->affected_rows();
  }
  public function editDataBiayaUmum($id, $data)
  {
    $this->db->update("biayaumum", $data, ['biayaumum_id' => $id]);
    return $this->db->affected_rows();
  }
  public function get_biayaUmum($id = 0)
  {
    if ($id == 0) {
      $biayaumum =  $this->db->get('biayaumum')->result();
    } else {
      $biayaumum =  $this->db->get_where('biayaumum', ['biayaumum_id' => $id])->row();
    }
    return $biayaumum;
  }
}
