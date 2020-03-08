<?php

namespace App\Model;

use App\Concerns\HasRoleAccessors;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasRoleAccessors;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'roles';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'status'];

    /**
    * Function for use to exclude the role admin
    */
    public function scopeExcludeAdminRole($query)
    {
        return $query->where('id','!=', '1');
    }
    /*
    *
    * Relation between role and user 
    */
    public function userRole()
    {
        return $this->hasMany('App\User', 'role_id');
    }
}
