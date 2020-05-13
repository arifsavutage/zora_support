<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Sell extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('produk_model');
        $this->load->model('selling_model');
        $this->load->model('installment_model');
    }

    public function add_to_cart()
    {
        $id = $this->input->post('product_id');
        $qty = $this->input->post('quantity');
        $name = $this->input->post('product_name');

        //cek
        $detail    = $this->produk_model->getProdukById($id);

        if ($detail->STOCK < $qty) {

            $message = '';
            $message .= '<tr><td colspan="5">';
            $message .= '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Maaf, </strong> stok ' . $name . ' hanya ' . $detail->STOCK . '.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
            $message .= '</td></tr>';

            echo $message;
        } else {
            $data = array(
                'id' => $id,
                'name' => $name,
                'price' => $this->input->post('product_price'),
                'qty' => $qty,
            );
            $this->cart->insert($data);
            echo $this->show_cart();
        }
    }

    function show_cart()
    {
        $output = '';
        $no = 0;
        foreach ($this->cart->contents() as $items) {
            $no++;
            $output .= '
                <tr>
                    <td>' . $items['name'] . '</td>
                    <td>' . number_format($items['price']) . '</td>
                    <td>' . $items['qty'] . '</td>
                    <td>' . number_format($items['subtotal']) . '</td>
                    <td><button type="button" id="' . $items['rowid'] . '" class="romove_cart btn btn-danger btn-sm">Cancel</button></td>
                </tr>
            ';
        }
        $output .= '
            <tr>
                <th colspan="3">Total</th>
                <th colspan="2">' . 'Rp ' . number_format($this->cart->total()) . '</th>
            </tr>
        ';
        return $output;
    }

    function load_cart()
    {
        echo $this->show_cart();
    }

    function delete_cart()
    {
        $data = array(
            'rowid' => $this->input->post('row_id'),
            'qty' => 0,
        );
        $this->cart->update($data);
        echo $this->show_cart();
    }

    function checkout()
    {
        $idseller   = $this->input->post('idpembeli');
        $type       = $this->input->post('sellertype');
        $metode     = $this->input->post('metode');
        $jmlcicilan = $this->input->post('jmlcicilan');
        $tglbeli    = date('Y-m-d', strtotime($this->input->post('tglbeli'))); //str d-m-Y
        $catatan    = $this->input->post('keterangan');
        $cart       = $this->cart->contents();
        $total      = $this->cart->total();

        //buat nomor invoice
        $sellcheck  = $this->selling_model->getByDate($tglbeli);
        $count      = count($sellcheck) + 1;

        if (strlen($count) == 1) {
            $invoice = date('mY') . "00$count";
        } else if (strlen($count) == 2) {
            $invoice = date('mY') . "0$count";
        } else if (strlen($count) == 3) {
            $invoice = date('mY') . "$count";
        }

        if ($metode == 'kredit') {
            $status = 'belum';

            $jatuhtempo = date('Y') . "-" . date('m') . "-10"; // dibuat pertgl 10
            $tagihan = $total / $jmlcicilan;

            for ($i = 1; $i <= $jmlcicilan; $i++) {
                $create_date = date('Y-m-d', strtotime("+$i months", strtotime($jatuhtempo)));

                //save to installment
                $data_installment  = [
                    'INVOICE'       => $invoice,
                    'JATUH_TEMPO'   => $create_date,
                    'TAGIHAN'       => $tagihan,
                    'TGL_BAYAR'     => '0000-00-00',
                    'NOMINAL'       => 0
                ];
                $this->installment_model->save($data_installment);
            }
        } else {
            $status = 'lunas';
        }

        $selling_detail   = json_encode($cart);

        $datasell   = [
            'INVOICE'       => $invoice,
            'SELLER_ID'     => $idseller,
            'SELLER_TYPE'   => $type,
            'PRODUCT_DETAIL' => $selling_detail,
            'METODE_BAYAR'  => $metode,
            'JML_CICILAN'   => $jmlcicilan,
            'STATUS'        => $status,
            'TGL_BELI'      => $tglbeli,
            'KETERANGAN'    => $catatan
        ];

        $this->selling_model->save($datasell);

        //update stock
        foreach ($this->cart->contents() as $item) :

            $id = $item['id'];

            $detail    = $this->produk_model->getProdukById($id);
            $newstock = $detail->STOCK - $item['qty'];

            $data_stock = [
                'ID'    => $id,
                'STOCK' => $newstock
            ];
            $this->produk_model->updateStock($data_stock);
        endforeach;
        $this->cart->destroy();

        $this->session->set_flashdata('info', '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Succses, </strong> data tersimpan ... 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>');

        redirect(base_url('index.php/admin/master/selling/list'));
    }
}