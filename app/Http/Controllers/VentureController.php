<?php

namespace App\Http\Controllers;

use App\Models\Venture;
use Illuminate\Http\Request;

class VentureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ventures = Venture:: orderBy('id','ASC')->get();

        return view('venture_types.index', compact(['ventures']))
            ->with('i', (request()->input('page', 1) - 1) * 10);

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illumventure_typeinate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'venture_type' => ['required'],

        ]);

        $venture = Venture::updateOrCreate(
            [
                'venture_type' => $request->venture_type,

            ],
            [
                'venture_type' => $request->venture_type,

            ]
        );
        return redirect()->back()
            ->with('message', 'Submitted Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $ventures = Venture::find($id);

        $validatedData = $request->validate([
            'venture_type' => ['required'],

        ]);

        $ventures->update([
            'venture_type' => $request->venture_type,

        ]);

        return redirect()->back()
            ->with('message', 'Venture Updated Successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
