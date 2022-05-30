<?php

namespace App\Http\Controllers;

use App\Models\Captain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Hash;

class CaptainController extends Controller
{

    /**
     * Update the specified captain in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function updateCaptain(Request $request)
    {
        $captain_id = $request->input('captain_id');
        $captain = Captain::find($captain_id);
        // dd($captain_id);
        $allowedfileExtension = ['jpg', 'png', 'jpeg'];

        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $file_size = $request->file('img')->getSize();
            if ($file_size <= '2000000') {
                $fields = Validator::make($request->all(), [
                    'first_name' => 'string|max:255',
                    'last_name' => 'string|max:255',
                    'phone' => 'digits:11|max:11',
                    'email' => 'email|max:255',
                    'vehicle' => 'max:255',
                    'licence_plate' => 'max:255',
                    'password' => 'max:255|min:8',
                    'img' => '',

                ]);
                if ($fields->fails()) {
                    redirect()->back()->with(['message', $fields->errors()->toJson()]);
                }
                $extenstion = $file->getClientOriginalExtension();
                $check = in_array($extenstion, $allowedfileExtension);
                if ($check) {
                    $filename = time() . '.' . $extenstion;
                    $file->move('uploads/images/captains/', $filename);


                    if ($captain) {
                        $captain->update(array_merge(
                            $fields->validated(),
                            [
                                'password' => Hash::make($request->password),
                                'img' => 'uploads/images/captains/' . $filename,
                            ]
                        ));
                        // return response(['Success' => 'Updated Successfully']);
                        return redirect()->back()->with('Success', 'Updated Successfully.');
                    } else {
                        // return response(['Success' => 'No data updated.']);
                        return redirect()->back()->with('Warning', 'No data updated.');
                    }

                    return redirect()->back()->with('Success', 'Captian added successfully');
                    // return response(['Success' => 'Captian added successfully']);
                }
                return redirect()->back()->with('Error', 'Wrong file type, only (png, jpg,jpeg) are allowed');
                // return response(['result' => 'Very large file, Max size allowed is 1.9 mb']);

            }
            return redirect()->back()->with('Error', 'Very large file, Max size allowed is 1.9 MB');
            // return response(['result' => 'Very large file, Max size allowed is 1.9 mb']);
        }
        $fields = Validator::make($request->all(), [
            'first_name' => 'string|max:255',
            'last_name' => 'string|max:255',
            'phone' => 'digits:11|max:11',
            'email' => 'email|max:255',
            'vehicle' => 'max:255',
            'licence_plate' => 'max:255',
            'password' => 'max:255|min:8',
            'img' => '',

        ]);
        if ($fields->fails()) {
            redirect()->back()->with(['message', $fields->errors()->toJson()]);
        }

        if ($captain) {
            $captain->update(array_merge(
                $fields->validated(),
                [
                    'password' => Hash::make($request->password),
                ]
            ));
            // return response(['Success' => 'Updated Successfully']);
            return redirect()->back()->with('Success', 'Updated Successfully.');
        } else {
            // return response(['Success' => 'No data updated.']);
            return redirect()->back()->with('Warning', 'No data updated.');
        }
    }

    /**
     * Remove the specified center from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $captain_id = $request->input('delete_captain_id');
        $captain = Captain::find($captain_id);

        if ($captain) {
            $captain->delete();
            // return response()->json(['result' => 'works']);
            return redirect()->back()
                ->with('Success', 'Captain Deleted Successfully.');
        } else {
            // return response()->json(['result' => $captain]);
            return redirect()->back()
                ->with('Error', 'Record Faild to Deleted');
        }
    }


    /**
     * Return overview view with array search results of captains
     * @param Request $request
     * @return View|array
     */

    public function search(Request $request)
    {

        $admin = $request->user()->first_name;
        $search_text = $request->input('search');


        if (isset($search_text)) {
            $captains = Captain::where('first_name', 'LIKE', '%' . $search_text . '%')
                ->orWhere('last_name', 'LIKE', '%' . $search_text . '%')
                ->orWhere('phone', 'LIKE', '%' . $search_text . '%')
                ->orWhere('email', 'LIKE', '%' . $search_text . '%')
                ->orWhere('vehicle', 'LIKE', '%' . $search_text . '%')
                ->orWhere('licence_plate', 'LIKE', '%' . $search_text . '%')
                ->orderBy('created_at', 'desc')
                ->paginate(10);

            $captains->appends($request->all());

            // return response()->json(['captains' => $captains]);
            return View::make('dashboard.captains.overview',  [
                'captains' => $captains,
                'admin' => $admin
            ]);
        }
        $captains =  Captain::orderBy('created_at', 'desc')->paginate(10);


        // return response()->json(['captains' => $captains]);
        return View::make('dashboard.captains.overview',  [
            'captains' => $captains,
            'admin' => $admin
        ]);
    }


    public function getCaptainTrips($id)
    {
        $captain_trips = Captain::find($id)->trip;

        return response()->json(['Captain Trips' => $captain_trips]);
    }





    public function captainTrips(Request $request)
    {

        $captain_id = $request->user()->id;
        $captain_trips = Captain::find($captain_id)->trip;

        return response()->json(['Captain trips' => $captain_trips]);
    }


    /**
     * Return overview view with array of captains
     * @param Request $request
     * @return View|array
     */

    public function getCaptains(Request $request)
    {
        $admin = $request->user()->first_name;
        $captains = Captain::orderBy('created_at', 'desc')->paginate(10);


        return View::make('dashboard.captains.overview',  [
            'captains' => $captains,
            'admin' => $admin
        ]);
        // return response()->json(['captains' => $captains]);
    }



    /**
     * Return profile view with captain details
     * @param Request $request
     * @return View
     */

    public function getCaptainProfile($id)
    {
        $captain = Captain::find($id);

        $trips = $captain->trip;


        // return View::make('dashboard.captains.profile',  ['captain' => $captain]);
        return response()->json(['captain' => $captain]);
    }


    /**
     * Return profile view with captain details
     * @param Request $request
     * @return View
     */

    public function editCaptain($id)
    {
        $captain = Captain::find($id);

        // $trips = $captain->trip;


        // return View::make('dashboard.captains.profile',  ['captain' => $captain]);
        return response()->json(['status' => 200, 'captain' => $captain]);
    }
}
