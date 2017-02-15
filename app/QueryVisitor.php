<?php

namespace aieapV1;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QueryVisitor extends Model

{

	use SoftDeletes;
    protected $table='queryvisitors';
    protected $dates = ['deleted_at'];
}
