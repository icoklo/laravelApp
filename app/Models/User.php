<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	// indicates if the model should be timestamped
	public $timestamps = false;

	public function fullName()
	{
		// pristupas stupcima iz baze kao varijablama s istim imenom kakvo je i definirano u tablici iz baze
		return $this->ime . " ". $this->prezime;
	}

}
