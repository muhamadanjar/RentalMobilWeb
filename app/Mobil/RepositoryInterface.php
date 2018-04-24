<?php namespace App\Mobil;

interface RepositoryInterface {
    public function all();
    public function find($id);
    public function delete($id);
    public function countmobil();
    public function updatestatusmobil($id);
    public function updatebystatus($id,$status);
    public function mobilavailable();
    public function autoNumber($table,$primary,$prefix);
    public function checkstatus($id);
    public function getDriverInfo($id);
    public function getDriverLocation();
    public function getDatatableData();
}