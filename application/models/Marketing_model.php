<?php

class Marketing_model extends CI_Model
{
    public function getAllMarketing()
    {
        return $this->db->get('marketing')->result();
    }

    public function addMarketing()
    {
        $data = array(
            "ID_CARD" => $this->input->post('ktpmarketing', true),
            "MARKETING_NAME" => $this->input->post('marketingname', true),
            "MARKETING_ADDRESS" => $this->input->post('alamatmarketing', true),
            "MARKETING_PHONE" => $this->input->post('telpmarketing', true),
            "JOIN_DATE" => date("Y-m-d")
            // "PHOTO" => $this->input->post('suplierphone', true),
            // "SCAN_ID" => $this->input->post('suplierphone', true),
        );

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

    public function editMarketing()
    {
        $data = array(
            // "ID_CARD" => $this->input->post('ktpmarketing', true),
            "MARKETING_NAME" => $this->input->post('marketingname', true),
            "MARKETING_ADDRESS" => $this->input->post('alamatmarketing', true),
            "MARKETING_PHONE" => $this->input->post('telpmarketing', true)
            // "PHOTO" => $this->input->post('', true),
            // "SCAN_ID" => $this->input->post('', true)
        );

        $this->db->where('ID', $this->input->post('id'));
        $this->db->update('marketing',  $data);
    }

}