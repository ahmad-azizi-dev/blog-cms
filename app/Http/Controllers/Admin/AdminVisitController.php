<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Position;
use App\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Stevebauman\Location\Facades\Location;

class AdminVisitController extends Controller
{

    private $paginate_per_page = 25;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $visits = Visit::with('position', 'user', 'visitable')->orderBy('created_at', 'desc')
            ->paginate($this->paginate_per_page);


        return view('admin.visits.index', compact(['visits']));
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $visit = Visit::with('position')->findorfail($id);

        if ($visit->position == null) {

            $position = new Position();
            $position->ip = $visit->ip;
            $position->visit_id = $visit->id;

            $location = Location::get($visit->ip);
            if ($location) {
                $position->countryName = $location->countryName;
                $position->countryCode = Str::lower($location->countryCode);
                $position->regionCode = $location->regionCode;
                $position->regionName = $location->regionName;
                $position->cityName = $location->cityName;
                $position->zipCode = $location->zipCode;
                $position->isoCode = $location->isoCode;
                $position->postalCode = $location->postalCode;
                $position->latitude = $location->latitude;
                $position->longitude = $location->longitude;
                $position->metroCode = $location->metroCode;
                $position->areaCode = $location->areaCode;
                $position->driver = $location->driver;
            }
            $position->save();

        } elseif ($visit->position->countryName == null) {

            $location = Location::get($visit->ip);
            if ($location) {
                $position = Position::findorfail($visit->position->id);
                $position->countryName = $location->countryName;
                $position->countryCode = Str::lower($location->countryCode);
                $position->regionCode = $location->regionCode;
                $position->regionName = $location->regionName;
                $position->cityName = $location->cityName;
                $position->zipCode = $location->zipCode;
                $position->isoCode = $location->isoCode;
                $position->postalCode = $location->postalCode;
                $position->latitude = $location->latitude;
                $position->longitude = $location->longitude;
                $position->metroCode = $location->metroCode;
                $position->areaCode = $location->areaCode;
                $position->driver = $location->driver;

                // fill other columns of saved row positions table
                $position->save();
            }
        }


        $visit = Visit::with('position', 'user', 'visitable')->findorfail($id);

        return view('admin.visits.show', compact(['visit']));
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
        $visit = Visit::findOrFail($id);
        Session::flash('visit', 'log with IP=' . $visit->ip . ' deleted successfully');
        $visit->delete();

        // this codes is for solving the problem that causes return to the empty page after deleting
        $lastPage = Visit::paginate($this->paginate_per_page)->lastPage(); // Get last page with results.
        if ($request->currentpage > $lastPage) {
            $lastPage_url = url('admin/visits/') . '?page=' . $lastPage; // Manually build true last page URL.
            return redirect($lastPage_url);
        } else {
            return back();
        }

    }

    public function mass_deletion(Request $request)
    {
        $request->validate([
            'checkBoxArray' => 'required',
        ]);

        $ids = collect($request->checkBoxArray)->implode('-');

        //$request->checkBoxArray has an array of visit ids

        foreach ($request->checkBoxArray as $id) {
            $visit = Visit::findOrFail($id);
            $visit->delete();
        }

        Session::flash('visit', 'log with IP=' . $ids . ' deleted successfully');

        // this codes is for solving the problem that causes return to the empty page after deleting
        $lastPage = Visit::paginate($this->paginate_per_page)->lastPage(); // Get last page with results.
        if ($request->currentpage > $lastPage) {
            $lastPage_url = url('admin/visits/') . '?page=' . $lastPage; // Manually build true last page URL.
            return redirect($lastPage_url);
        } else {
            return back();
        }
    }
}
