<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use App\Kendaraan;
use App\Sewa;
class ReservationCtrl extends Controller
{
    public function __construct(Sewa $sewa) {
        $this->sewa = $sewa;
    }
}
