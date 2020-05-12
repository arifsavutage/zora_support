<?php

class Marketing_model extends CI_Model
{
    public function getAllMarketing()
    {
        return $this->db->get('marketing')->result();
    }

    public function addMarketing($data)
    {
        $this->db->insert('marketing',  $data);
    }

    public function delMarketing($id)
    {
        $this->db->where('ID', $id);
        $this->db->delete('marketing');
    }

    public function getMarketingById($id)
    {
        return $this->db->get_where('marketing', ['ID' => $id])->row();
    }

    public function editMarketing($data)
    {
        $this->db->where('ID', $data['ID']);
        $this->db->update('marketing',  $data);
    }

}