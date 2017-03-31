<?php

namespace App\Http\Controllers;

use App\Note;
use App\Tag;
use App\User;
use App\user_tag;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Khill\Lavacharts\Laravel\LavachartsFacade as Lava;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $users = User::get();
        $moyenne = round(Note::get()->sum('note') /  Note::get()->sum('coeff'),2);

        return view("front/users/index", compact("users", "moyenne"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() //URL pour créer un utilisateur
    {
        return route("admin/users/index");
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
        $this->validate($request, User::$rules["create"]); //Valide avec le model
        $status_create = User::create($input); //Permet de créer un utilisateur
        if($status_create) //Si création réussie
            {
                return redirect()->back()->with("success", "Utilisateur créé avec succés")->withInput();
            }
            else
            {
                return redirect()->back()->with("danger", "Une erreur est survenue, merci de bien vouloir recommencer")->withInput(); //renvois erreur et le commande de l'utilisateur
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
        $user_update = User::findOrFail($id);
        $this->validate($request, User::$rules["update"]);
        $status_create = $user_update->update($input);
        if($status_create)
        {
            return redirect()->back()->with("success", "Changements appliqués avec succés ")->withInput();
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
        $count = User::destroy($id);
        if ($count == 1)
        {
            return redirect()->back()->with("success", "L'utilisateur a bien été supprimé");
        }
        else
        {
            return redirect()->back()->with("erreur", "L'utilisateur n'a pas été supprimé");
        }
    }

    public function userpp(Request $request)
    {

        $input = $request->all();


        if(ISSET($input['id']) and !EMPTY($input['id']))
        {

            if(User::where('id',$input['id'])->exists() != null) {
                $user = User::with("Commentaires", "tags", 'notes')->where('id', $input['id'])->get(); //get l'uilisateur par son id
                $users = $user->toArray();


                $population = Lava::DataTable();
                $population->addDateColumn("date");
                $population->addNumberColumn('Note'); // créer les info pour le graphique

                $dummyValue = 2000;
                $coeff = 0;
                $note = 0;
                if (count($users[0]['notes']) > 0)
                {
                    foreach ($users[0]['notes'] as $test) {
                        $coeff += $test['coeff'];
                        $note += $test['note'];

                        $population->addRow([(String)$dummyValue, $test["note"]]);
                        $dummyValue++;
                    }

                     $moyenne = round($note / $coeff, 2);
                }
                else
                {
                    $moyenne = "pas de note";
                }

                Lava::AreaChart('Population', $population, [
                    'title' => 'Note',
                    'legend' => [
                        'position' => 'in',

                    ],
                    'width' => 400,
                    'height' => 200

                ]);

                return view("front/users/userpp", compact("users","moyenne"));
            }
            else
            {
                return redirect()->back();
            }
        }
        else
        {
            return redirect()->back();

        }

    }







}
