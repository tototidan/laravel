<?php

namespace App\Http\Controllers;

use App\Note;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class NotesController extends Controller
{

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

    public function destroy($id)
    {
        $count = Note::destroy($id);
        if ($count == 1)
        {
            return redirect()->back()->with("success", "La note a bien été supprimé");
        }
        else
        {
            return redirect()->back()->with("erreur", "Une erreur s'est produite");
        }
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

    public function addnotes(Request $request)
    {
        $input = $request->all();
        if(ISSET($input['id']) and !EMPTY($input['id']))
        {
            if(User::where("id","=",$input['id'])->exists() != null) {

                $users = User::where("id", "=", $input['id'])->with("notes")->get();


                return view("admin/users/addnotes", compact("users"));
            }
            else
            {
                return  abort(404);
            }
        }
        else
        {
            return  abort(404);
        }


    }
}
