<?php

namespace App\Http\Controllers;

use App\Models\IndependentProducer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!$request->hasValidSignature()) {
            abort(401);
        }
        $applications_counts = IndependentProducer:: orderBy('id', 'ASC')->get();

        if ($request->has('engagement_number')) {

            $applications = IndependentProducer::where('engagement_number', '=', trim($request->get('engagement_number')))
                ->orderBy('id', 'ASC')->get();
        } else {
            $applications = IndependentProducer:: orderBy('id', 'ASC')->get();
        }


        return view('reports.index', compact(['applications', 'applications_counts']))
            ->with('i', (request()->input('page', 1) - 1) * 10);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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

    public function pieChart(Request $request)
    {
//
//        if (!$request->hasValidSignature()) {
//            abort(401);
//        }
        $ventures = collect([]);


        if ($request->has('type_of_venture')) {




            $ventures = IndependentProducer::
             select ('engagement_number', DB::raw('count(*) as total'), DB::raw('sum(size_of_plant) as amount'))

               -> where('type_of_venture', '=', trim($request->get('type_of_venture')))
                ->groupBy('engagement_number')
                ->get();
//            dd($ventures);
        } else {


            $ventures = IndependentProducer::
            select ('engagement_number', DB::raw('count(*) as total'), DB::raw('sum(size_of_plant) as amount'))
                ->groupBy('engagement_number')
                ->get();
        }


        return view('reports.graphical_reports', compact(['ventures']))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }



}
