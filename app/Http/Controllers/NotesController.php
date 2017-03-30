<?php

namespace App\Http\Controllers;

use App\Note;
use Illuminate\Http\Request;

use App\Http\Requests;

class NotesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $this->validate($request, Note::$rules["create"]); //Valide avec le model
        $status_create = Note::create($input); //Permet de créer un utilisateur
        if($status_create) //Si création réussie
        {
            return redirect()->back()->with("success", "Note créé aves succés ")->withInput();
        }
        else
        {
            return redirect()->back()->with("danger", "Une erreur est survenue, merci de bien vouloir recommencer")->withInput(); //renvois erreur et le commande de l'utilisateur
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {


        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {

        $input = $request->all();
        $note_update = Note::findOrFail($id);
        $this->validate($request, Note::$rules["update"]);
        $status_create = $note_update->update($input);
        if($status_create)
        {
            return redirect()->back()->with("success", "Notes mise a jour avec succées ")->withInput();
        }
        else
        {
            return redirect()->back()->with("danger", "Erreur lors de la modification , veuillez réessayez")->withInput(); //renvois erreur et le commande de l'utilisateur
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
        //
    }
}
