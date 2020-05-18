<?php
class Purchase_model extends CI_Model
{
    private $_table = 'purchase';

    public $NOFAKTUR;
    public $SUPLIER_ID;
    public $PRODUCT_ID;
    public $QTY;
    public $PURCHASE_PRICE;
    public $PURCHASE_DATE;
    public $DELIVERY_DATE;
    public $ARRIVAL_DATE;

    public function rules()
    {
        return [
            [
                'field' => 'suplier',
                'label' => 'Suplier',
                'rules' => 'required'
            ],
            [
                'field' => 'product',
                'label' => 'Product',
                'rules' => 'required'
            ]
        ];
    }

    public function save()
    {
        $this->load->library('cek_transaksi');

        $post   = $this->input->post();

        $this->SUPLIER_ID       = $post['suplier'];
        $this->PRODUCT_ID       = $post['product'];
        $this->QTY              = $post['qty'];
        $this->PURCHASE_PRICE   = $post['hargabeli'];
        $this->PURCHASE_DATE    = $post['tglpo'];
        $this->DELIVERY_DATE    = $post['tglkirim'];
        $this->ARRIVAL_DATE     = $post['tglsampai'];

        $jml    = $this->getDataByDate($this->PURCHASE_DATE)->num_rows();

        $jml    += 1;
        if (strlen($jml) == 1) {
            $nofak  = "P." . date('mY') . ".00" . $jml;
        } else if (strlen($jml) == 2) {
            $nofak  = "P." . date('mY') . ".0" . $jml;
        } else {
            $nofak  = "P." . date('mY') . "." . $jml;
        }

        $this->NOFAKTUR = $nofak;

        //histori transaksi
        $get_produk = $this->db->get_where('product_item', ['ID' => $post['product']])->row_array();

        $qty     = $post['qty'];
        $harga   = $post['hargabeli'];

        $nominal = $qty * $harga;
        $ket     = "Pembelian produk $get_produk[PRODUCT_NAME]";

        $trans = [
            'tgl'           => date('Y-m-d'),
            'ket'           => $ket,
            'id_trans'      => $nofak,
            'trans_type'    => $post['tipe'],
            'nominal'       => $nominal,
            'kredit'        => 'yes',
            'debet'         => 'no',
        ];

        $this->cek_transaksi->transaksi($trans);

        //update stock produk
        $stok = $qty + $get_produk['STOCK'];
        $this->db->update('product_item', ['STOCK' => $stok], ['ID' => $post['product']]);

        return $this->db->insert($this->_table, $this);
    }

    public function edit()
    {
        $post   = $this->input->post();

        $data_update = [
            'SUPLIER_ID'       => $post['suplier'],
            'PRODUCT_ID'       => $post['product'],
            'QTY'              => $post['qty'],
            'PURCHASE_PRICE'   => $post['hargabeli'],
            'PURCHASE_DATE'    => $post['tglpo'],
            'DELIVERY_DATE'    => $post['tglkirim'],
            'ARRIVAL_DATE'     => $post['tglsampai']
        ];

        $this->NOFAKTUR = $post['nofaktur'];

        $this->db->where('NOFAKTUR', $this->NOFAKTUR);
        return $this->db->update($this->_table, $data_update);
    }

    public function getDataByDate($date)
    {
        //$this->db->where($this->PURCHASE_DATE, $date);
        //return $this->db->get_where($this->_table, ['PURCHASE_DATE' => $date]);
        $query = $this->db->query("SELECT * FROM `purchase` WHERE DATE_FORMAT(`PURCHASE_DATE`, 'm%Y%') = DATE_FORMAT('$date', 'm%Y%')");
        return $query;
    }

    public function getDateRange($date1, $date2)
    {
        //$query = $this->db->query("SELECT * FROM `purchase` WHERE `PURCHASE_DATE` BETWEEN '$date1' AND '$date2' ORDER BY ");
        //return $query->result_array();
        $this->db->select("purchase.`NOFAKTUR`, purchase.`SUPLIER_ID`, purchase.`PRODUCT_ID`, 
        purchase.`QTY`, purchase.`PURCHASE_PRICE`, (purchase.`QTY` * purchase.`PURCHASE_PRICE`) AS SUBTOTAL, 
        purchase.`PURCHASE_DATE`, suplier.SUPLIER_NAME, product_item.PRODUCT_NAME");
        $this->db->from($this->_table);
        $this->db->join('suplier', 'suplier.ID = purchase.SUPLIER_ID', 'left');
        $this->db->join('product_item', 'product_item.ID = purchase.PRODUCT_ID', 'left');
        $this->db->where("purchase.`PURCHASE_DATE` BETWEEN '$date1' AND '$date2'");

        return $this->db->get()->result_array();
    }

    public function getAll()
    {
        $this->db->select('purchase.`NOFAKTUR`, purchase.`SUPLIER_ID`, purchase.`PRODUCT_ID`, 
        purchase.`QTY`, purchase.`PURCHASE_PRICE`, purchase.`PURCHASE_DATE`, purchase.`DELIVERY_DATE`, 
        purchase.`ARRIVAL_DATE`, suplier.ID, suplier.SUPLIER_NAME, product_item.ID, 
        product_item.PRODUCT_NAME');
        $this->db->from($this->_table);
        $this->db->join('suplier', 'suplier.ID = purchase.SUPLIER_ID', 'left');
        $this->db->join('product_item', 'product_item.ID = purchase.PRODUCT_ID', 'left');
        $this->db->order_by('purchase.PURCHASE_DATE', 'DESC');

        return $this->db->get()->result_array();
    }

    public function getDataById($nofak)
    {
        $this->db->select('purchase.`NOFAKTUR`, purchase.`SUPLIER_ID`, purchase.`PRODUCT_ID`, 
        purchase.`QTY`, purchase.`PURCHASE_PRICE`, purchase.`PURCHASE_DATE`, purchase.`DELIVERY_DATE`, 
        purchase.`ARRIVAL_DATE`, suplier.ID as supID, suplier.SUPLIER_NAME, product_item.ID as productID, 
        product_item.PRODUCT_NAME');
        $this->db->from($this->_table);
        $this->db->join('suplier', 'suplier.ID = purchase.SUPLIER_ID', 'left');
        $this->db->join('product_item', 'product_item.ID = purchase.PRODUCT_ID', 'left');
        $this->db->where('purchase.NOFAKTUR', $nofak);
        $this->db->order_by('purchase.PURCHASE_DATE', 'DESC');

        return $this->db->get()->row_array();
    }
}
