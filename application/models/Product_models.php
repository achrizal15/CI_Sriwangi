<?php
class Product_models extends CI_Model
{
    public function deleteRow($id)
    {
        $this->db->delete("product", ["product_id" => $id]);

        return $this->db->affected_rows();
    }
    public function editProduct($id, $data)
    {
        $this->db->update('product', $data, ["product_id" => $id]);
        return $this->db->affected_rows();
    }
    public function getallProduct($id = 0)
    {
        if ($id == 0) {
            $product = $this->db->query("SELECT product.* , satuan.satuan_name, category.category_name FROM product 
            INNER JOIN category ON product.category_id = category.category_id
            INNER JOIN satuan ON product.satuan_id = satuan.satuan_id ORDER BY product_id ASC")->result_array();
        } else {
            $product = $this->db->query("SELECT * FROM product WHERE product_id=?", [$id])->row();
        }
        return  $product;
    }
}
