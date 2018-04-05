<?php namespace App\Transaksi;

interface RepositoryInterface {

    function all();
    function find($id);
    function delete($id);
    function post($aksi);
    function getlimit($limit);
    function getDatatableData();
    function countTransaksi();
    function checkstatus($id);
}
