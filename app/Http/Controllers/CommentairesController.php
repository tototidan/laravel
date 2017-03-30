<?php

namespace App\Http\Controllers;

use App\Commentaire;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CommentairesController extends Controller
{

    public function __construct()
    {
        $this->middleware('dataComm', ['only' => ['create', 'store', 'edit', 'delete']]);
        // Alternativly

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $input = $request->all(); //récupère les GET/POST


        $this->validate($request, Commentaire::$rules["create"]); //Valide avec le model
        $status_create = Commentaire::create($input); //Permet de créer un commentaire
        if($status_create) //Si création réussie
        {
            return redirect()->back()->with("success", "Le commentaire a bien été créé");
        }
        else
        {
            return redirect()->back()->with("danger", "Une erreur est survenue, merci de bien vouloir recommencer")->withInput(); //renvois erreur et le commande de l'utilisateur
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $count = Commentaire::destroy($id);
        if ($count == 1)
        {
            return redirect()->back()->with("success", "Le commentaire a bien été supprimé");
        }
        else
        {
            return redirect()->back()->with("erreur", "Le commentaire n'a pas été supprimé");
        }
    }
}