<?php namespace App\Moderator;


trait RoleTrait
{
    public function groups()
    {
        return $this->belongsToMany('App\Moderator\Models\Group', 'acl_users_groups');
    }
}
