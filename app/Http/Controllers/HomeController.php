<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\User;
use App\Models\Demande;


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
        View::share('users',User::all());
        View::share('demandes',Demande::all());
        View::share('nbrConge',Demande::where('type_demande', 'conge')->count());
        View::share('nbrPermission',Demande::where('type_demande', 'permission')->count());
		View::share('nbrAchat',Demande::where('type_demande', 'achat')->count());
		View::share('nbrFrais',Demande::where('type_demande', 'frais')->count());
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
}
