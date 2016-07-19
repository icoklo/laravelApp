<?php namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\editUserRequest;

class UserController extends Controller
{

	public function unosKorisnika(editUserRequest $request){
		// echo csrf_field();

		$polje = array();
		$imeKorisnika = $request->input('ime', 'Default');
		$prezimeKorisnika = $request->input('prezime', 'Default');
		$user = new User;
		$user->ime = $imeKorisnika;
		$user->prezime = $prezimeKorisnika;
		$user->save();
		$poruka = "Korisnik ".$imeKorisnika." ".$prezimeKorisnika." je unesen.";
		$polje = array('kod' => 200, 'poruka' => $poruka);

		return (new Response($polje,200))->header('Content-Type', 'application/json');

	}

	public function editKorisnika(editUserRequest $request,$id){
		// echo "id ".$id;
		$pronadiKorisnika = User::findOrFail($id);
		$poruka = "";

		$staroIme = $pronadiKorisnika->ime;
		$staroPrezime = $pronadiKorisnika->prezime;
		$pronadiKorisnika->ime = $request->input('ime', 'Default');
		$pronadiKorisnika->prezime = $request->input('prezime', 'Default');

		// spremi promjene u bazu
		$pronadiKorisnika->save();

		// Moze i ovakav način
		$poruka = "Stari podaci: {$staroIme} {$staroPrezime}, Novi podaci: {$pronadiKorisnika->fullName()}.";
		$polje = array('kod' => 200, 'poruka' => $poruka);
		return (new Response($polje,200))->header('Content-Type', 'application/json');

	}

	public function ispisPodatakaKorisnika($id){
		// ispis podataka odredenog korisnika
		$korisnik = "";
		$poruka = "";

		// jedan korisnik, ako se ne pronade korisnik vraca se ModelNotFoundException
		$korisnik = User::findOrFail($id);

		$polje = array('id' => $korisnik->id, 'Ime' => $korisnik->ime, 'Prezime' => $korisnik->prezime);
		return (new Response($polje,200))->header('Content-Type', 'application/json');

	}

	public function ispisSvihKorisnika(){
		$korisnici = User::all();
		// $polje = array();

		if($korisnici){
			foreach ($korisnici as $korisnik){
				$polje[] = array('id' => $korisnik->id, 'Ime' => $korisnik->ime, 'Prezime' => $korisnik->prezime);

			}
			return (new Response($polje,200))->header('Content-Type', 'application/json');
		}
		else{
			// ili ispis sljedece poruke ili ispis praznog polja
			// $poruka = "Nema korisnika u bazi";
			// $polje = array('poruka' => $poruka);
			return (new Response($polje,200))->header('Content-Type', 'application/json');
		}
	}

}