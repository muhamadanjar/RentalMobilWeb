<?php namespace App\Moderator\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Role;
class User extends Model {

    //use SoftDeletes;

    protected $table = 'users';

    protected $fillable = ['name', 'email', 'password'];

    public function groups(){
        return $this->belongsToMany('App\Moderator\Models\Group', 'acl_users_groups');
    }

    public function roles(){
        return $this->belongsToMany(Role::class,'role_user');
    }

}
