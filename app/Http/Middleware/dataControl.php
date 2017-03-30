<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class dataControl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {



        if($request["auteur_id"] == session("id") )
        {


                if(User::where('id',$request['user_id'])->exists() != null)
                {
                    $request["auteur"] = session("name");
                    return $next($request);
                }
                else
                {
                    return redirect()->back()->with("danger","Impossible de poster ce commentaire , si le problème persiste , veuillez contacter un administrateur")->withInput();
                }
        }
        else
        {
            return redirect()->back()->with("danger","Impossible de poster ce commentaire , si le problème persiste , veuillez contacter un administrateur")->withInput();
        }

        }


}
