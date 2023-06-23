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
    public function show()
    {
       return view('users.show');
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


    public function changePassword(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'password' => 'required|min:8|confirmed',
        ]);
        if ($request->password == $request->old_password) {
            return redirect()->back()->withInput()->withErrors(['password' => "Sorry your old password is the same as the new one"]);
        }
        if ($request->password == 'Zesco123' || $request->password == 'zesco123' || $request->password == 'zesco@123' ||
            $request->password == 'Zesco@123' || $request->password == 'Zesco12345' || $request->password == 'zesco12345') {
            return redirect()->back()->withInput()->withErrors(['password' => "Sorry your new password has been listed as too common hence not so much secure.Please change to another password."]);
        }
        if ($user->password == Hash::make($request->password)) {
            return redirect()->back()->withInput()->withErrors(['password' => "Sorry your old password you entered is wrong"]);
        } else {
            $user->password = Hash::make($request->password);
            $user->password_change = config('app.password_not_changed');
            $user->save();
            return redirect()->back()->with('message', 'User Password Updated Successfully');
        }

    }

}
