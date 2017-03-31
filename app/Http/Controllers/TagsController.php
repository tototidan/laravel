<?php

namespace App\Http\Controllers;

use App\Tag;
use App\User;
use App\user_tag;
use Illuminate\Http\Request;

use App\Http\Requests;
use PhpParser\Node\Expr\Empty_;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
        $this->validate($request, Tag::$rules["create"]); //Valide avec le model
        $status_create = Tag::create($input); //Permet de créer un utilisateur
        if($status_create) //Si création réussie
        {
            return redirect()->back()->with("success", "Tag créé avec succés")->withInput();
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
    public function show()
    {
        $tags = Tag::get();

        return view("admin/users/addtags", compact("tags"));
    }

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
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        if(Tag::where("id","=",$id)->exists())
        {
           $test =  Tag::destroy($id);
           if ($test == 1)
           {
               return redirect()->back()->with("success","Suppression effectuer avec succées")->withInput();
           }
           else
           {
               return redirect()->back()->with("Danger","Une erreur c'est produite , veuillez réessayez plus tard")->withInput();
           }
        }
        else
        {

        }
    }

    public function assignTagToUser(Request $request)
    {
        $input = $request->all();
        if(User_tag::where("user_id","=",$input["user_id"])->where("tag_id","=",$input["tag_id"])->exists() != null)
        {
            return redirect()->back();
        }
        else
        {
            if(User::where("id","=",$input["user_id"])->exists() != null && Tag::where("id","=",$input["tag_id"])->exists() != null)
            {
                $test = User::find($input["user_id"]);
                $test->tags()->attach($input["tag_id"]);
                return redirect()->back()->with("success","Relation créé avec succées")->withInput();
            }
            else
            {
                return redirect()->back()->with("danger","Une erreur inconnue s'est produite")->withInput();
            }
        }
    }

    public function debindTagToUser(Request $request)
    {
        $input = $request->all();
        if(User_tag::where("user_id","=",$input["user_id"])->where("tag_id","=",$input["tag_id"])->exists() != null)
        {
            $test = User::find($input["user_id"]);
            $test->tags()->detach($input["tag_id"]);
            return redirect()->back()->with("success","Relation détruite avec succées")->withInput();
        }
        else
        {
            return redirect()->back()->with("danger","Une erreur c'est produite , veuillez réessayez plus tard")->withInput();
        }
    }


    public function showUserTag(Request $request)
    {
        $input = $request->all();

        if(ISSET($input['id']) and !EMPTY($input['id']))
        {
            if(User::where("id","=",$input["id"])->exists() != null)
            {
                $users = User::where("id","=",$input["id"])->with("tags")->get();
                $listId = user_tag::where("user_id","=",$input["id"])->get(["tag_id"]);
                $listId = $listId->toArray();

                $tag = Tag::whereNotIn("id", $listId)->get();
                $tag = $tag->toArray();


                return View("admin/users/bindTag", compact("users","tag"));
            }
            else
            {
                return redirect()->back()->with("danger","Une erreur c'est produite , veuillez réessayez plus tard")->withInput();
            }
        }
        else
        {
            return redirect()->back()->with("danger","Une erreur c'est produite , veuillez réessayez plus tard")->withInput();
        }
    }
}
