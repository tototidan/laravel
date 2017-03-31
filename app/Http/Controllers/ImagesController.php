<?php

namespace App\Http\Controllers;

use App\image;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\File;

class ImagesController extends Controller
{
    public function imageUploadPost(Request $request)

    {

        if ($request->user_id == Session("id"))
        {

            if(Image::where("user_id","=",$request->user_id)->exists() != null)
            {
                $imageToDelete = Image::where("user_id","=",$request->user_id)->get();
                \File::delete($imageToDelete[0]["file_path"]);
                Image::destroy($imageToDelete[0]['id']);

            }
            $this->validate($request, [

                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

            ]);


            $imageName = time() . '.' . $request->image->getClientOriginalExtension();

            $status_create = Image::create(["user_id" => $request->user_id,"file_path" => "image/user/".$imageName]);

            if($status_create)
            {
                $request->image->move(public_path('image/user'), $imageName);
                return redirect()->back()->with("success","Image upload avec succés")->withInput();
            }
            else
            {
                return redirect()->back()->with("danger","Une erreur inconnue s'est produite , veuillez réessayez plus tard")->withInput();
            }




        }
        else
        {
            return redirect()->back()->with("danger","Une erreur inconnue s'est produite , veuillez réessayez plus tard")->withInput();
        }
    }
}
