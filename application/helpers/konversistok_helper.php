<?php
function stock($jmlitem)
{
    //$jmlproduk  = 2345;

    $to_lusin   = floor($jmlitem / 12);
    $sisa_pcs   = $jmlitem - ($to_lusin * 12);

    $to_gross   = floor($to_lusin / 12);
    $sisa_lusin = $to_lusin - ($to_gross * 12);

    $str = "";
    if ($to_gross > 0) {
        $str .= $to_gross . " gross ";
        if ($sisa_lusin > 0) {
            $str .= $sisa_lusin . " doz";
            if ($sisa_pcs > 0) {
                $str .= "<br/>" . $sisa_pcs . " pcs";
            }
        }
    } else {
        if ($to_lusin > 0) {
            $str .= $to_lusin . " doz";

            if ($sisa_pcs > 0) {
                $str .= " " . $sisa_pcs . " pcs";
            }
        } else {
            $str .= " " . $jmlitem . " pcs";
        }
    }

    return $str;
}
