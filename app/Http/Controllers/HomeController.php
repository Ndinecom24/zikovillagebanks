<?php

namespace App\Http\Controllers;

use App\Models\IndependentProducer;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

//        if (!$request->hasValidSignature()) {
//            abort(401);
//        }

//        $applications = collect([]);

        $applications_counts = IndependentProducer:: orderBy('id', 'ASC')->get();

        if ($request->has('engagement_number')) {

            $applications = IndependentProducer::where('engagement_number', '=', trim($request->get('engagement_number')))
                ->orderBy('id', 'ASC')->get();
        } else {
            $applications = IndependentProducer:: orderBy('id', 'ASC')->get();
        }

        return view('home', compact(['applications', 'applications_counts']))
            ->with('i', (request()->input('page', 1) - 1) * 10);


    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function blank()
    {
        return view('blank');
    }
}
