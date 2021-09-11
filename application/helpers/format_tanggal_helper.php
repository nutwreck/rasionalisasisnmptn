<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('format_indo_date')) {
  function format_indo_date($date){
    date_default_timezone_set('Asia/Jakarta');
    // array hari dan bulan
    $Bulan = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
    
    // pemisahan tahun, bulan, tanggal
    $tahun = substr($date,0,4);
    $bulan = substr($date,5,2);
    $tgl = substr($date,8,2);
    $result = $tgl." ".$Bulan[(int)$bulan-1]." ".$tahun;

    return $result;
  }
}