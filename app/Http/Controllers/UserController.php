<?php

namespace App\Http\Controllers;

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

    public function getEmployeeData(Request $request): \Illuminate\Http\JsonResponse
    {
        //
        return response()->json([
            'status' => ['statusCode' => 200, 'statusDescription' => 'Managed To Do What I Wanted'],
            'query'=> $request->all(),
            'payload' => [

            ]
        ]);
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
    public function getEmployees(Request $request)
    {

        if ($request->ajax()) {

            $page = (int)$request->draw;

            $resultCount = (int)$request->length;

            $offset = ($page - 1) * $resultCount;

            $search_text = $request->input('search.value');

            //$employees = Employee::select(["con_per_no","name","nrc","job_title","directorate","location","created_at","updated_at"]);
            $employees = User::latest();
//                ->when(Auth::user()->user_group_id == 3, function ($query) {
//                    return $query->where('USER_GROUP_ID', Auth::user()->user_group_id == 3);


            return Datatables::eloquent($employees)
                ->addColumn('status', function (User $user) {
                    return $user->status == 1 ? "Active": "In-active";
                })
                ->addColumn('name', function (User $user) {
                    return $user->name;
                })
//                ->addColumn('bu_code', function (User $employees) {
//                    return $user->bu_code;
//                })
//                ->addColumn('cc_code', function (User $employees) {
//                    return $user->cc_code;
//                })
                ->addColumn('con_per_no', function (User $user) {
                    return $user->con_per_no;
                })
                ->addColumn('nrc', function (User $user) {
                    return $user->nrc;
                })
                ->addColumn('dob', function (User $user) {
                    return $user->dob;
                })
                ->addColumn('sex', function (User $user) {
                    return $user->sex;
                })
                ->addColumn('staff_email', function (User $user) {
                    return $user->staff_email;
                })
                ->addColumn('mobile_no', function (User $user) {
                    return $user->mobile_no;
                })
                ->addColumn('job_code', function (User $user) {
                    return $user->job_code;
                })
                ->addColumn('job_title', function (User $user) {
                    return $user->job_title;
                })
                ->addColumn('grade', function (User $user) {
                    return $user->grade;
                })
                ->addColumn('directorate', function (User $user) {
                    return $user->directorate;
                })
                ->addColumn('location', function (User $user) {
                    return $user->location;
                })
                ->addColumn('station', function (User $user) {
                    return $user->station;
                })
                ->addColumn('pay_point', function (User $user) {
                    return $user->pay_point;
                })
                ->addColumn('functional_section', function (User $user) {
                    return $user->functional_section;
                })
                ->addColumn('contract_type', function (User $user) {
                    return $user->contract_type;
                })
                ->addColumn('con_st_code', function (User $user) {
                    return $user->con_st_code;
                })
                ->addColumn('con_wef_date', function (User $user) {
                    return $user->con_wef_date;
                })
                ->addColumn('con_wet_date', function (User $user) {
                    return $user->con_wet_date;
                })
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = "<div class=\"input-group-prepend\">
                                <button type=\"button\" class=\"btn btn-outline-success dropdown-toggle\"
                                        data-toggle=\"dropdown\">
                                    Action <span class=\"caret\"></span>
                                </button>
                                <div class=\"dropdown-menu\">

                                    <a class=\"dropdown-item\" href=\"users/$row->id/edit \">Edit</a>
                                </div>
                            </div>";

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('users.index');
    }


    public function getManNumbers(Request $request)
    {
        $search = strtolower($request->search);
        $page = (int)$request->page;

        $resultCount = 25;

        $offset = ($page - 1) * $resultCount;

        if ($search == '') {
            $dataset = PhrisUserDetails::
            select('con_per_no', 'name')
                ->where('con_st_code', 'ACT')
                ->orderby('con_per_no', 'asc')
                ->skip($offset)
                ->take($resultCount)
                ->get();

            $count = PhrisUserDetails::count();
        } else {
            $dataset = PhrisUserDetails::
            select('con_per_no', 'name')
                ->where('con_st_code', 'ACT')
//                ->whereRaw("LOWER(con_per_no) LIKE LOWER('%{$search}%')")
                ->where(function ($query) use ($search) {
                    $query->whereRaw("LOWER(con_per_no) LIKE LOWER('%{$search}%')")
                        ->orWhereRaw("LOWER(name) LIKE LOWER('{$search}%')");
                })
                ->orderby('con_per_no', 'asc')
                ->skip($offset)
                ->take($resultCount)
                ->get();

            $count = $dataset->count();
        }


        $endCount = $offset + $resultCount;
        $morePages = $count > $endCount;


        $results = [];
        foreach ($dataset as $item) {
            $results[] = [
                "id" => $item->con_per_no,
                "text" => $item->con_per_no . ":" . $item->name,
            ];
        }


        $response = [
            "results" => $results,
            "pagination" => ["more" => $morePages]
        ];

        return response()->json($response);
    }

    public function getManNumber(Request $request)
    {

        $dataset = PhrisUserDetails::
        select('con_per_no', 'name')
            //->whereRaw("LOWER(con_per_no) LIKE '%{$search}%'")
            ->where('con_per_no', $request->con_per_no)
            ->first();


        $results = [
            "id" => $dataset->con_per_no,
            "text" => $dataset->con_per_no . ":" . $dataset->name
        ];

        return response()->json($results);
    }

    public function getEmployee(Request $request)
    {
        $dataset = PhrisUserDetails::
        select('con_per_no', 'name', 'nrc', 'dob', 'sex', 'staff_email', 'mobile_no', 'job_title', 'grade', 'directorate', 'location', 'station', 'functional_section')
            ->where('con_per_no', $request->man_no)
            ->first();


        $response = ["employee" => $dataset,];

        return response()->json($response);
    }

}
