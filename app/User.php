<?php

namespace aieapV1;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany('aieapV1\Role','role_user');

    }
    public function students()
    {
        return $this->hasOne('aieapV1\Student');

    }


    public function setPasswordAttribute($password)
    {   
        $this->attributes['password'] = bcrypt($password);
    }

    public function hasAnyRole($roles){
        if(is_array($roles)){

            foreach ($roles as $role) {
                if ($this->hasRole($role)){

                    return true;
                }
                
            }
        }
        else { if ($this->hasRole($roles)){

                    return true;
                }
             }
             return false;
         }

         public function hasRole ($role)
         {if ($this->roles()->where('role',$role)->first())
             { 
                return true;

              }
              return false;

         }
          
         
}





