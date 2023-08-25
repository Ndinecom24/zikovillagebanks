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
    public function index()
    {

        $applications = IndependentProducer:: orderBy('id', 'ASC')->get();


        return view('home', compact(['applications']))
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
