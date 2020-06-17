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
        $query = $this->db->query("SELECT DATE_FORMAT(TGL, '%M') AS PERIODE, SUM(`DEBET`) AS HASIL FROM `trans_history` WHERE `TRANS_TYPE` = 'selling' AND TGL LIKE '%$year%' GROUP BY DATE_FORMAT(TGL, '%M %Y') ORDER BY `ID` ASC");
        $data = $query->result_array();

        $x = [];

        $i = 0;
        foreach ($data as $row) {
            $x['label'][] = $row['PERIODE'];
            $x['value'][] = (int) $row['HASIL'];
            $i++;
        }

        $x['chart_data']   = json_encode($x);

        return $x;
    }
}
