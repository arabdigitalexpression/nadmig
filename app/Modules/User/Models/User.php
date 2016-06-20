<?php namespace App\Modules\User\Models;


use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Config;
class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword, EntrustUserTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['email', 'name', 'password', 'picture', 'birthday', 'governorate', 'website', 'facebook', 'twitter', 'instagram', 'confirmation_code', 'confirmed'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['logged_in_at', 'logged_out_at'];

    /**
     * Set password encrypted
     *
     * @param $password
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] =  Hash::make($password);
    }

    /**
     * Set the ip address attribute.
     *
     * @param $ip
     * @return string
     */
    public function setIpAddressAttribute($ip)
    {
        $this->attributes['ip_address'] = inet_pton($ip);
    }


    /**
     * Get the ip address attribute.
     *
     * @param $ip
     * @return string
     */
    public function getIpAddressAttribute($ip)
    {
        return $ip ? inet_ntop($ip) : "";
    }
    public function reservations()
    {
        return $this->hasMany('App\Modules\Reservation\Models\Reservation');
    }
    public function manageOrganization()
    {
        return $this->hasOne('App\Modules\Organization\Models\Organization', 'manager_id');
    }
    public function manageSpace()
    {
        return $this->hasOne('App\Modules\Space\Models\Space', 'manager_id');
    }

}
