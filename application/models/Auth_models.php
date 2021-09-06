<?php
class Auth_models extends CI_Model
{
    public function setUsers($data)
    {
        $this->db->insert('users', $data);
        return $this->db->error()['code'];
    }
    public function getWhere($data)
    {
        $resul =   $this->db->get_where('users', array('email' => $data));
        return  $resul->row();
    }
}
