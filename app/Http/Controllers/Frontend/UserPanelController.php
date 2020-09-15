<?php

namespace App\Http\Controllers\Frontend;

use App\Cat;
use App\Http\Controllers\Controller;
use App\Http\Requests\NormalUserEditRequest;
use App\Photo;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class UserPanelController extends Controller
{

    public function index($id)
    {
        $user = User::findorfail($id);
        $categories = Cat::all();

        return view('frontend.user.index', compact(['user', 'categories']));
    }


    public function update(NormalUserEditRequest $request, $id)
    {

        $user = User::findorfail($id);

        if (Hash::check($request->input('password'), $user->password)) {
            // dd($request);

            if ($file = $request->file('photo')) {

                // first deleting the old photo if was exist

                if ($photo = Photo::find($user->photo_id)) {

                    if (file_exists(public_path() . $user->photo->path)) {
                        unlink(public_path() . $user->photo->path);
                    }
                } else {
                    $photo = new photo();
                }

                $name = Str::random(10) . time() . $file->getClientOriginalName();
                $file->move('images', $name);
                $photo->name = $file->getClientOriginalName();
                $photo->path = $name;
                $photo->user_id = Auth::id();
                $photo->save();

                $user->photo_id = $photo->id;

            }

            $user->name = $request->input('name');
            if (trim($request->input('new_password') != '')) {
                $user->password = bcrypt($request->input('new_password'));
            }
            $user->save();

            Session::flash('update_user', 'user updated successfully');
            return back();

        } else {
            Session::flash('update_user', 'the password does not match');
            return back();
        }
    }
}
