<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Grafik extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function penjualan()
    {
        $year  = date('Y');

        $qry_month_by_year  = $this->db->query("SELECT DATE_FORMAT(`TGL`, '%M') AS BULAN FROM `trans_history` WHERE YEAR(`TGL`) = YEAR(`TGL`) = YEAR(CURDATE()) GROUP BY DATE_FORMAT(`TGL`, '%M') ORDER BY DATE_FORMAT(`TGL`, '%m %Y') ASC");
        $data_month_by_year = $qry_month_by_year->result_array();

        $query = $this->db->query("SELECT DATE_FORMAT(TGL, '%M') AS PERIODE, SUM(`DEBET`) AS HASIL, SUM(KREDIT) AS PENGELUARAN FROM `trans_history` WHERE YEAR(`TGL`) = YEAR(CURDATE()) GROUP BY DATE_FORMAT(TGL, '%M %Y') ORDER BY DATE_FORMAT(`TGL`, '%m %Y') ASC");
        $data = $query->result_array();

        $x = [];

        $i = 0;
        foreach ($data as $row) {
            $x['label'][] = $row['PERIODE'];
            $x['value'][] = (int) $row['HASIL'];
            $x['spending'][] = (int) $row['PENGELUARAN'];
            $i++;
        }

        $x['chart_data']   = json_encode($x);

        //return $x;
        print_r(var_dump($x));
    }
}
