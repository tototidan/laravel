<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class AdminsController extends Controller
{
    public function adminpp(Request $request)
    {

        $input = $request->all();

        if(ISSET($input['id']) and !EMPTY($input['id']))
        {

            if(User::where('id',$input['id'])->exists() != null)
            {
                $user = User::with("Commentaires",'tags' , 'notes')->where('id',$input['id'])->get();
                $users = $user->toArray();

                $coeff = 0;
                $note = 0;
                if (count($users[0]['notes']) > 0)
                {
                    foreach ($users[0]['notes'] as $test) {
                        $coeff += $test['coeff'];
                        $note += $test['note'];
                    }

                    $moyenne = round($note / $coeff, 2);
                }
                else
                {
                    $moyenne = "pas de note";
                }

                return view("admin/users/adminpp", compact("users","moyenne"));
            } //TODO: sinon , return la vue de base
            else
            {
                $users=User::get();
                return view("admin/users/index", compact("users"));
            }
        }
        else
        {
            $users=User::get();
            return view("admin/users/index", compact("users"));
        }

    }

    public function admin()
    {
        $users = User::get();
        return view("admin/users/index", compact("users"));
    }
}
