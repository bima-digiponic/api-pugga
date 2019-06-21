<?php

function convertDate($data, $format)
{
    if ($data == '-' || $data == null || $data == '') {
        return "-";
    }

    if ($format == 'indo') {
        $dt = explode(" ", $data);
        $date = explode("-", $dt[0]);
        $bulan = ['Jan', 'Feb', 'Mrt', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des'];
//        $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        if (isset($dt[1])) {
            $time = explode(":", $dt[1]);
            $converted = $date[2] . " " . $bulan[(int)($date[1]) - 1] . " " . $date[0] . " - " . $time[0] . ":" . $time[1];
        } else {
            $converted = $date[2] . " " . $bulan[(int)($date[1]) - 1] . " " . $date[0];
        }

    } else if ($format == 'db') {
        // convert input format to YYYY-mm-dd
        $date = explode(" ", $data);
        $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $bln = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'];
        if (strlen($date[1]) == 3) {
            $month = array_search($date[1], $bln) + 1;
        } else {
            $month = array_search($date[1], $bulan) + 1;
        }

        if ($month < 10) {
            $converted = $date[2] . '-0' . $month . '-' . $date[0];
        } else {
            $converted = $date[2] . '-' . $month . '-' . $date[0];
        }
    }

    return $converted;
}

function convertRupiah($angka){
    $hasil_rupiah = "Rp " . number_format($angka,0,',','.');
    return $hasil_rupiah;
}