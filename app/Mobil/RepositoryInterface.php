<?php namespace App\Mobil;

interface RepositoryInterface {
    public function all();
    public function find();
    public function delete();
    public function autoNumber();
}