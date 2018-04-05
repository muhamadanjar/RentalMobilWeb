<?php

namespace App\Traits;

trait RedirectsUsers
{
    /**
     * Get the post register / login redirect path.
     *
     * @return string
     */
    public function redirectPath()
    {
        if (method_exists($this, 'redirectTo')) {
            return $this->redirectTo();
        }
        if(auth()->user()->isRole('superadmin') || auth()->user()->isRole('admin')){
            $this->redirectTo = '/backend';
        }

        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/';
    }
}
