<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check()) //vérifie si utilisateur connecté
        {
           return redirect("");
        }
        else
        {
            return view("login/index");
        }
    }

    public function connexion(Request $request)
    {

        $input = $request->all(); //recupere post et get

        if(isset($input['remember']) && $input["remember"] == true)
        {



            Auth::attempt(array('login' => $input['login'], 'password' =>  $input['password'], true));
        }
        else
        {


            Auth::attempt(array('login' => $input['login'], 'password' => $input['password']));
        }

        if(Auth::check()) //est-il connecté ?
        {

            $currentUser = User::where('login', '=',$input['login'])->get();
            $user = $currentUser->toArray();

            if($user[0]["IsAdmin"] == 1)
            {
                session(["isadmin" => true , "id" => $user[0]["id"] ,  "name" => $user[0]["prenom"]." ".$user[0]["nom"]]);  // on créer trois variables session qui permettent de vérifier si la personne est admin
                                                                                                    // et on met son nom/prenom dans une string
            }
            else
            {
                session(["isadmin" => false , "id" => $user[0]["id"],  "name" => $user[0]["prenom"]." ".$user[0]["nom"]]);
            }

            return redirect(route('users.index'))->with("success", "Connexion réussie");
        }
        else
        {
            return redirect(route('login'))->with("danger", "Identifiant ou mot de passe incorrect");
        }
    }

    public function deconnexion()
    {
        Auth::logout();
        return redirect(route('login'))->with("info", "Vous êtes bien déconnecté");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
}
