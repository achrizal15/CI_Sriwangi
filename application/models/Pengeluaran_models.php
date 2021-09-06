<?php
class Pengeluaran_models extends CI_Model
{
    public function getAll()
    {
        $hasil =  $this->db->query("SELECT pengeluaran.* , product_harga_beli, biayaumum_saldo FROM pengeluaran LEFT JOIN product ON pengeluaran.product_id = product.product_id LEFT JOIN biayaumum ON pengeluaran.biayaumum_id = biayaumum.biayaumum_id")->result_array();
        return $hasil;
    }
}
