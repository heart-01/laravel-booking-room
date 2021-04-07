<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Auth;
use App\Profiles;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profiles(){
        return $this->hasOne(Profiles::class,'id');
    }

    public function getNotificatIsAdminAttribute(){  //Auth::user()->notificat_is_admin
        return Profiles::where('status_id', '=', 2)->where('id', '=', Auth::user()->id)->first();
    }

    public function getStatusAttribute(){ 
        $users = User::with('profiles')->find(Auth::user()->id);
        return $users->profiles->status_id;
    }
}