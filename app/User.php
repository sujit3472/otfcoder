<?php

namespace App;

use App\Concerns\HasUserAccessors;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, HasUserAccessors;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'phone', 'email', 'password', 'role_id', 'status',  'profile_pic_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $appends = ['avtar'];
    /**
    * Function for use to exclude the role admin
    */
    public function scopeExcludeAdmin($query)
    {
        return $query->where('role_id','!=', '1');
    }

    public function role()
    {
        return $this->belongsTo('App\Model\Role');
    }
}
