<?php namespace App\Transaksi;

interface RepositoryInterface {

    function all();
    function find($id);
    function delete($id);
    function post($aksi);
    function makeSewa($request);
    function getlimit($limit);
    function getDatatableData();
    function countTransaksi();
    function checkstatus($id);
    function setStatusPesanan($id,$status);
    function autoNumber($table, $primary, $prefix);
    function getPesananByCustomer($id);
    function getPesananByCustomerAll($id);
    function statistikPemesanan($statistik);
    function getDataRange($dari,$sampai,$type);
}
