<?php

namespace App\Http\Controllers;

use App\Models\Employee\PHCMSEmployee;
use App\Models\PhrisUserDetails;
use App\Models\User;
use App\Rules\StrongPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User:: orderBy('id', 'ASC')->paginate(15);


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
            'email' => ['required', 'email'],
            'password' => ['required', new StrongPassword],
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
                'directorate' => $request->directorate,
                'user_unit' => $request->user_unit,
                'job_title' => $request->job_title,
                'mobile_no' => $request->mobile_no,
                'email' => $request->email,
                'usertype' => $request->usertype,
                'password' =>  Hash::make($request->password),
                'password_change' => config('app.password_not_changed'),
                'total_login' => 0,
                'uuid' => Str::uuid()->toString(),
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
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->back()->with('message', 'User deleted Successfully');

    }


    public function changePassword(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'old_password' => 'required',
            'password' => ['required', 'confirmed', new StrongPassword],
        ]);

        // Verify current password
        if (!Hash::check($request->old_password, $user->password)) {
            return redirect()->back()->withInput()->withErrors(['old_password' => 'The current password you entered is incorrect.']);
        }

        // Ensure new password is different from old
        if ($request->password === $request->old_password) {
            return redirect()->back()->withInput()->withErrors(['password' => 'Your new password must be different from your current password.']);
        }

        $user->password = Hash::make($request->password);
        $user->password_changed = config('app.password_changed');
        $user->save();

        return redirect()->back()->with('message', 'Your password has been updated successfully.');
    }

}
