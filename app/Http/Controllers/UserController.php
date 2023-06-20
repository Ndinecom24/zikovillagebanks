<?php

namespace App\Http\Controllers;

use App\Models\Employee\PHCMSEmployee;
use App\Models\PhrisUserDetails;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User:: orderBy('id', 'ASC')->get();


        return view('users.index', compact(['users']))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    public function getStaffDetails(Request $request)
    {

        $user = PHCMSEmployee::on('oracle_isd')->where('con_per_no', $request->staff_no)->first();

        if ($user) {
            $data = ['success' => true, 'employee' => $user];
        } else {
            $data = ['success' => false, 'message' => 'Employee not found'];
        }

        return response()->json($data);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required'],
            'staff_no' => ['required'],
            'email' => ['required'],
            'usertype' => ['required'],
            'password' => ['required'],
        ]);

        $users = User::updateOrCreate(
            [
                'name' => $request->name,
                'staff_no' => $request->staff_no,
                'email' => $request->email,
                'usertype' => $request->usertype,
                'password' => Hash::make($request->password)
            ],
            [
                'name' => $request->name,
                'staff_no' => $request->staff_no,
                'email' => $request->email,
                'usertype' => $request->usertype,
                'password' =>  Hash::make($request->password)
            ]
        );
        return redirect()->route('user.index')
            ->with('message', 'Submitted Successfully');
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
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
