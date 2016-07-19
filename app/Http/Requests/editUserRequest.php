<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

// ova klasa sluzi za validaciju jeli korisnik unio POST parametre kod unosa korisnika i kod editiranja podataka korisnika
class editUserRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		// return false;
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'ime' => 'required',
			'prezime' => 'required',
		];
	}

}
