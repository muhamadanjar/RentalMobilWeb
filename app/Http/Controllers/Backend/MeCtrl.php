<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Moderator\FormRequests\UpdatePassword;
use App\Moderator\RepositoryInterface;

class MeCtrl extends BackendCtrl
{
    function __construct()
    {
        return parent::__construct();
    }

    public function index()
    {
        $user = Auth::user();

        return view('backend.me.profile', compact('user'));
    }

    public function updatePassword(UpdatePassword $form, RepositoryInterface $moderator)
    {
        $moderator->updatePassword(Auth::user()->id, $form->get('password'));
        return redirect()->route('backend.me.profile')->with('flash.success', 'Password berhasil diperbarui');
    }
}
