<?php namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class UserController extends Controller
{
	public function provjeriPostParametre(){
		if(isset($_POST["ime"]) AND isset($_POST["prezime"])){
			// ako su za ime i prezime unesene neke vrijednosti
			if($_POST["ime"] AND $_POST["prezime"]){
				return true;
			}
			else {
				return false;
			}
		}
		else{
			return false;
		}
	}

	public function unosKorisnika(){
		// echo csrf_field();

		$polje = array();
		if($this->provjeriPostParametre()==true){
			$imeKorisnika = $_POST["ime"];
			$prezimeKorisnika = $_POST["prezime"];
			$user = new User;
			$user->ime = $imeKorisnika;
			$user->prezime = $prezimeKorisnika;
			$user->save();
			$poruka = "Korisnik ".$imeKorisnika." ".$prezimeKorisnika." je unesen.";
			$polje = array('kod' => 200, 'poruka' => $poruka);
				// pristup metodi ispis() iz klase Kontroler
			return (new Response($polje,200))->header('Content-Type', 'application/json');
		}
		else{
			$poruka = "Niste unijeli ime i prezime!";
			$polje = array('kod' => 400, 'poruka' => $poruka);
			return (new Response($polje,400))->header('Content-Type', 'application/json');
		}
	}

	public function ispisPodatakaKorisnika($id){
		// ispis podataka odredenog korisnika
		$korisnik = "";
		$poruka = "";

		// jedan korisnik
		$korisnik = User::find($id);
		if($korisnik){
			$polje = array('id' => $korisnik->id, 'Ime' => $korisnik->ime, 'Prezime' => $korisnik->prezime);
			return (new Response($polje,200))->header('Content-Type', 'application/json');
		}
		else {
			$poruka = "Korisnik sa id ". $id . " ne postoji";
			$polje = array('kod' => 400, 'poruka' => $poruka);
			return (new Response($polje,400))->header('Content-Type', 'application/json');
		}
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