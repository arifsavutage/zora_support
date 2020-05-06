<?php

class Suplier_model extends CI_Model
{
    public function getAllSuplier()
    {
        return $this->db->get('suplier')->result();
    }

    public function addSuplier()
    {
        $data = array(
            "SUPLIER_NAME" => $this->input->post('supliername', true),
            "SUPLIER_ADDRESS" => $this->input->post('suplieraddress', true),
            "SUPLIER_PHONE" => $this->input->post('suplierphone', true)
        );

        $this->db->insert('suplier',  $data);
    }

    public function delSuplier($id)
    {
        $this->db->where('ID', $id);
        $this->db->delete('suplier');
    }

    public function getSuplierById($id)
    {
        return $this->db->get_where('suplier', ['ID' => $id])->row();
    }

    public function editSuplier()
    {
        $data = array(
            "SUPLIER_NAME" => $this->input->post('supliername', true),
            "SUPLIER_ADDRESS" => $this->input->post('suplieraddress', true),
            "SUPLIER_PHONE" => $this->input->post('suplierphone', true)
        );

        $this->db->where('ID', $this->input->post('id'));
        $this->db->update('suplier',  $data);
    }

}