<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class AdminPhotoController extends Controller
{

    private $paginate_per_page = 20;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($PerPagePhoto = $request->input('PerPage')) {     //can get show per page options from a user that apply
            $this->paginate_per_page = $PerPagePhoto;
            session(['PerPagePhoto' => $PerPagePhoto]);
        } elseif ($PerPagePhoto = session('PerPagePhoto')) {  //get show per page options from session
            $this->paginate_per_page = $PerPagePhoto;
        } else {
            session(['PerPagePhoto' => $this->paginate_per_page]);
        }

        $photos = Photo::with('user')->paginate($this->paginate_per_page);

        return view('admin.photos.index', compact(['photos']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.photos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($file = $request->file('file')) {
            $name = Str::random(10) . time() . $file->getClientOriginalName();
            $file->move('images', $name);
            $photo = new Photo();
            $photo->name = $file->getClientOriginalName();
            $photo->path = $name;
            $photo->user_id = Auth::id();
            $photo->save();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if ($PerPage = session('PerPagePhoto')) {     //get show per page options from session
            $this->paginate_per_page = $PerPage;
        }

        //fist check the posts of the photo if was null then delete that
        if (is_null(Photo::findOrFail($id)->posts->first())) {
            $photo = Photo::findOrFail($id);
            if (file_exists(public_path() . $photo->path)) {
                unlink(public_path() . $photo->path);
            }
            $photo->delete();
            Session::flash('delete_file', 'file deleted successfully');

            // this codes is for solving the problem that causes return to the empty page after deleting
            $lastPage = Photo::paginate($this->paginate_per_page)->lastPage(); // Get last page with results.
            if ($request->currentpage > $lastPage) {
                $lastPage_url = url('admin/photos/') . '?page=' . $lastPage; // Manually build true last page URL.
                return redirect($lastPage_url);
            } else {
                return back();
            }
        }

        Session::flash('delete_file', 'failed to delete! this photo belongs to a post');
        return back();


    }

    public function mass_deletion(Request $request)
    {
        $request->validate([
            'checkBoxArray' => 'required',
        ]);

        if ($PerPage = session('PerPagePhoto')) {     //get show per page options from session
            $this->paginate_per_page = $PerPage;
        }

        //$request->checkBoxArray have array of photo ids

        foreach ($request->checkBoxArray as $id) {

            //fist check the posts of the photo if was null then delete that
            if (is_null(Photo::findOrFail($id)->posts->first())) {
                $photo = Photo::findOrFail($id);
                if (file_exists(public_path() . $photo->path)) {
                    unlink(public_path() . $photo->path);
                }
                $photo->delete();
            } else {
                Session::flash('delete_file', 'failed to delete media with id=' . $id . ' this belongs to a post');
                return back();
            }
        }

        Session::flash('delete_file', 'files deleted successfully');

        // this codes is for solving the problem that causes return to the empty page after deleting
        $lastPage = Photo::paginate($this->paginate_per_page)->lastPage(); // Get last page with results.
        if ($request->currentpage > $lastPage) {
            $lastPage_url = url('admin/photos/') . '?page=' . $lastPage; // Manually build true last page URL.
            return redirect($lastPage_url);
        } else {
            return back();
        }
    }
}
