<?php

class Produk_model extends CI_Model
{
    public function getAllProduk()
    {
        return $this->db->get('product_item')->result();
    }

    public function addProduk()
    {
        $data = array(
            "CAT_ID" => $this->input->post('kategoriid', true),
            "PRODUCT_NAME" => $this->input->post('productname', true),
            "SELL_PRICE" => $this->input->post('sellprice', true),
            "STOCK" => $this->input->post('stock', true),
            "STOCK_LIMIT" => $this->input->post('stocklimit', true)
        );

        $this->db->insert('product_item',  $data);
    }

    public function delProduk($id)
    {
        $this->db->where('ID', $id);
        $this->db->delete('product_item');
    }

    public function getProdukById($id)
    {
        return $this->db->get_where('product_item', ['ID' => $id])->row();
    }

    public function editProduk()
    {
        $data = array(
            "CAT_ID" => $this->input->post('kategoriid', true),
            "PRODUCT_NAME" => $this->input->post('productname', true),
            "SELL_PRICE" => $this->input->post('sellprice', true),
            "STOCK" => $this->input->post('stock', true),
            "STOCK_LIMIT" => $this->input->post('stocklimit', true)
        );

        $this->db->where('ID', $this->input->post('id'));
        $this->db->update('product_item',  $data);
    }

    public function updateStock($data)
    {
        $this->db->where('ID', $data['ID']);
        return $this->db->update('product_item', $data);
    }
}
