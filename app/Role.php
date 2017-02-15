<?php

namespace aieapV1;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;
	protected $table='roles';
    public function users()
    {
        return $this->belongsToMany('aieapV1\User','role_user');

    }
}
