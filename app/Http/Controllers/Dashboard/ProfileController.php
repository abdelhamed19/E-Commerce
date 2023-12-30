<?php
namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Intl\Countries;
use Symfony\Component\Intl\Locales;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        $countries=Countries::getNames();
        $language=Locales::getNames();
        return view("adminpanel.profile.edit", compact("user","language","countries"));
    }
    public function update(Request $request)
    {
        //$user = $request->user();

        $request->validate(Profile::rules());

        $user = Auth::user();

        $user->profile->fill($request->all())->save();

        return redirect()->route("dashboard")->with("success","Profile Updated Successfully"); 
    }
}

// if ($user->profile->firstName)
//   {
//      $user->profile->update($request->all());
//   }

// else 
//   {
//      $request->merge([ "user_id" => $user->id ]);
//      Profile::Create([$request->all()]);
//   }




        // if($user->profile->firstName)
        // {
        //     $user->profile->update($request->all());
        // }
        // else
        // {
        //     $user->profile()->create($request->all());
        // }