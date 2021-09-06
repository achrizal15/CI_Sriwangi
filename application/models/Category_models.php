<?php

class Category_models extends CI_Model
{
    public function checkProductCategory($id)
    {
        $this->db->get_where("product", ["category_id" => $id]);
        return $this->db->affected_rows();
    }
}
