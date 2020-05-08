<?php

class Agen_model extends CI_Model
{
    public function getAllAgen()
    {
        $this->db->select('marketing_agen.*');
        $this->db->select('marketing.MARKETING_NAME');
        $this->db->select('a_city.city_name');
        $this->db->from('marketing_agen');
        $this->db->join('marketing', 'marketing.ID = marketing_agen.MARKETING_ID', 'left');
        $this->db->join('a_city', 'a_city.id = marketing_agen.AREA', 'left');
        return $query = $this->db->get()->result();
    }

    public function addAgen()
    {
        $data = array(
            "ID_CARD" => $this->input->post('ktpagen', true),
            "AGEN_NAME" => $this->input->post('namaagen', true),
            "AGEN_ADDRESS" => $this->input->post('alamatagen', true),
            "AGEN_PHONE" => $this->input->post('telpagen', true),
            "AREA" => $this->input->post('kabkota', true),
            "MARKETING_ID" => $this->input->post('marketingid', true),
            "JOIN_DATE" => date("Y-m-d")
            // "PHOTO" => $this->input->post('suplierphone', true),
            // "SCAN_ID" => $this->input->post('suplierphone', true),
        );

        $this->db->insert('marketing_agen',  $data);
    }

    public function delAgen($id)
    {
        $this->db->where('ID', $id);
        $this->db->delete('marketing_agen');
    }

    public function getAgenById($id)
    {
        return $this->db->get_where('marketing_agen', ['ID' => $id])->row();
    }

    public function editAgen()
    {
        $data = array(
            "AGEN_NAME" => $this->input->post('namaagen', true),
            "AGEN_ADDRESS" => $this->input->post('alamatagen', true),
            "AGEN_PHONE" => $this->input->post('telpagen', true),
            "AREA" => $this->input->post('kabkota', true),
            "MARKETING_ID" => $this->input->post('marketingid', true)
            // "PHOTO" => $this->input->post('', true),
            // "SCAN_ID" => $this->input->post('', true)
        );

        $this->db->where('ID', $this->input->post('id'));
        $this->db->update('marketing_agen',  $data);
    }

}