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

        $this->load->library('cek_transaksi');

        not_login();
    }

    public function add_to_cart()
    {
        $id = $this->input->post('product_id');
        $qty = $this->input->post('quantity');
        $name = $this->input->post('product_name');

        //cek
        $detail    = $this->produk_model->getProdukById($id);

        if (empty($detail) || $qty <= 0) {
            $message = '';
            $message .= '<tr><td colspan="5">';
            $message .= '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Maaf, </strong> Item produk belum di pilih atau qty kurang dari 1
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
            $message .= '</td></tr>';

            echo $message;
        } else {
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
                $price = $this->input->post('product_price');

                if ($price > 0) {
                    $data = array(
                        'id' => $id,
                        'name' => $name,
                        'price' => $this->input->post('product_price'),
                        'qty' => $qty,
                    );
                    $this->cart->insert($data);
                    echo $this->show_cart();
                } else {
                    $message = '';
                    $message .= '<tr><td colspan="5">';
                    $message .= '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>ERROR, </strong> transaksi tidak tersimpan, silahkan masukkan harga dengan benar...!!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
                    $message .= '</td></tr>';
                    echo $message;
                }
            }
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
        $posttgl    = $this->input->post('tglbeli');
        $tglbeli    = date('Y-m-d', strtotime($posttgl)); //str d/m/Y
        //$tglbeli    = date('Y-m-d'); //str d-m-Y
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

        $selling_detail   = json_encode($cart);
        if ($metode == 'kredit') {
            $status = 'belum';

            if ($jmlcicilan <= 0) {

                $this->cart->destroy();
                $this->session->set_flashdata('info', '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>WARNING, </strong> transaksi tidak tersimpan, jumlah cicilan tidak di isi dengan benar ...!!!! 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>');

                redirect(base_url('index.php/admin/master/selling/add'));
            } else {
                //$jatuhtempo = date('Y') . "-" . date('m') . "-10"; // dibuat pertgl 10
                $tagihan = $total / $jmlcicilan;

                for ($i = 1; $i <= $jmlcicilan; $i++) {

                    $create_date = date('Y-m-d', strtotime("+$i month", strtotime($tglbeli)));

                    /*if (date('m', strtotime($create_date)) == 2) {
                    if (date('d', strtotime($tglbeli)) == 30 || date('d', strtotime($tglbeli)) == 31) {
                        //cek hari jatuh tempo di bln februari
                        //$hari   = cal_days_in_month(CAL_GREGORIAN, date('m', strtotime($create_date)), date('Y', strtotime($create_date)));
                        $hari   = date('t', mktime(0, 0, 0, date('m', strtotime($create_date)), 1, date('Y', strtotime($create_date))));
                        $jatuhtempo = date('Y', strtotime($create_date)) . "-" . date('m', strtotime($create_date)) . "-" . $hari;
                    }
                } else {
                    $jatuhtempo = date('Y-m-d', strtotime("+$i months", strtotime($tglbeli)));
                }*/


                    //save to installment
                    $data_installment  = [
                        'INVOICE'       => $invoice,
                        'JATUH_TEMPO'   => $create_date,
                        //'JATUH_TEMPO'   => $jatuhtempo,
                        'TAGIHAN'       => $tagihan,
                        'TGL_BAYAR'     => '0000-00-00',
                        'NOMINAL'       => 0
                    ];
                    $this->installment_model->save($data_installment);
                }

                //catat history transaksi kredit
                /*$ket   = "transaksi penjualan kredit invoice $invoice";

            $data  = json_decode($selling_detail, true);

            $total = 0;
            foreach ($data as $item) {
                $total += $item['subtotal'];
            }

            $trans = [
                'tgl'           => date('Y-m-d'),
                'ket'           => $ket,
                'id_trans'      => $invoice,
                'trans_type'    => $this->input->post('tipe'),
                'nominal'       => $total,
                'kredit'        => 'yes',
                'debet'         => 'no',
            ];

            $this->cek_transaksi->transaksi($trans);*/
            }
        } else {
            $status = 'lunas';

            //catat history transaksi non kredit
            $ket   = "transaksi penjualan invoice $invoice";

            $data  = json_decode($selling_detail, true);

            $total = 0;
            foreach ($data as $item) {
                $total += $item['subtotal'];
            }

            $trans = [
                'tgl'           => $tglbeli,
                'ket'           => $ket,
                'id_trans'      => $invoice,
                'trans_type'    => $this->input->post('tipe'),
                'nominal'       => $total,
                'kredit'        => 'no',
                'debet'         => 'yes',
            ];

            $this->cek_transaksi->transaksi($trans);
        }

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

    function hapus_penjualan($invoice = null)
    {
        if ($invoice == null) {
            redirect(base_url());
        } else {
            //ambil data produk yg di beli
            $barang = $this->selling_model->getByInvoice($invoice);

            $details = json_decode($barang['PRODUCT_DETAIL'], true);
            //print_r(var_dump($details));

            //looping array barang
            $rp_pendapatan = 0;
            foreach ($details as $list) {
                //echo "Id : $list[id], name : $list[name], price : $list[price], qty: $list[qty], subtotal: $list[subtotal]";

                $getstock   = $this->produk_model->getProdukById($list['id']);
                $newstock   = $list['qty'] + $getstock->STOCK;

                //update stok barang
                $produk_update = [
                    'ID'    => $list['id'],
                    'STOCK' => $newstock
                ];
                $this->produk_model->updateStock($produk_update);

                //akumulasi subtotal untung pengurangan pendapatan
                $rp_pendapatan += $list['subtotal'];
            }

            //mengurangi pendapatan penjualan
            $getsaldo   = $this->transaksi_model->getLastTrans();
            $lastsaldo  = $getsaldo['SALDO'];
            $newsaldo   = $lastsaldo - $rp_pendapatan;

            $update_transaksi   = [
                'TGL'           => date('Y-m-d'),
                'KETERANGAN'    => "pembatalan penjualan invoice #$invoice",
                'ID_TRANS'      => 0,
                'TRANS_TYPE'    => 'pembatalan',
                'KREDIT'        => $rp_pendapatan,
                'DEBET'         => 0,
                'SALDO'         => $newsaldo
            ];
            $this->transaksi_model->save($update_transaksi);

            //hapus transaksi penjualan
            $hapus = $this->selling_model->delete($invoice);

            if ($hapus) {
                //echo "terhapus";
                $this->session->set_flashdata('info', '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Succses, </strong> data terhapus ... 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>');

                redirect(base_url('index.php/admin/master/selling/list'));
            } else {
                //echo "gagal";
                $this->session->set_flashdata('info', '
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Warning, </strong> data gagal terhapus ... 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>');

                redirect(base_url('index.php/admin/master/selling/list'));
            }
        }
    }
}
