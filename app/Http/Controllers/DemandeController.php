<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Demande;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;


class DemandeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     */
     
     	public function __construct(){
        $this->middleware('auth');
		View::share( 'section_title', 'Module utilisateur' );
		View::share( 'menu', 'demandes' );	
		
		View::share( 'nbDirector', User::where("role",4)->count());
		View::share( 'nbManager', User::where("role",3)->count());
		View::share( 'nbuser', User::where("role",2)->count());
		View::share( 'nbUser', User::where("role",1)->count());
		View::share('nbrConge',Demande::where('type_demande', 'conge')->count());
		View::share('nbrPermission',Demande::where('type_demande', 'permission')->count());
		View::share('nbrAchat',Demande::where('type_demande', 'achat')->count());
		View::share('nbrFrais',Demande::where('type_demande', 'frais')->count());

		View::share('users',User::all());
		//View::share('demandes',Demande::all());

    }
     
    public function index()
    {
        $data['page_title'] = "Liste des demandes - ";
		$data['page_description'] = "";
		$data['demandes'] = Demande::orderBy("id","DESC")->get();
		
		//User:logs("Affichage de la liste des utilisateurs");
		
		return view('demandes.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       	$data['page_title'] = "Ajouter une Demande - ";
		$data['page_description'] = "";
		
		//Demande:logs("Affichage de la page de demande de congé");
		
		return view('demandes.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(),[
			  "type" => "required",
			  "date_depart" => "required",
			  "date_retour" => "required",
			  "message" => "required",
			  "filenames" => "required|mimes:jpeg,pdf,png,jpeg,zip"
		]);
		
		    $dmd = new Demande;
    		$dmd->type_demande = htmlspecialchars($request->type);
    		$dmd->date_depart = htmlspecialchars($request->date_depart);
    		$dmd->date_retour = htmlspecialchars($request->date_retour);
    		//$dmd->filenames = $request->file->hashName();
    		$dmd->message = htmlspecialchars($request->message);
    		$dmd->user_id = Auth::user()->id;
    		//Enregistrement de l'image du logo
        
        if(file_exists($request->file('filenames'))){
            $extension = pathinfo($request->file('filenames')->getClientOriginalName(), PATHINFO_EXTENSION);
            $newName = 'logo-'.Carbon::now()->timestamp.'.'.$extension;
            $upload_path = 'public/demandes/';
            if($request->file('filenames')->move($upload_path, $newName)){
                $dmd->fichier  = "http://".$_SERVER['SERVER_NAME']."/public/demandes/".$newName;
            }
        }
    
			if($dmd->save()){

			session()->flash('type', 'alert-success');
			session()->flash('message', 'Demande crée avec succès');
			return redirect()->route('demandes.index');
		}else{
			session()->flash('type', 'alert-danger');
			session()->flash('message', 'Une erreur s\'est produite à la création, veuillez réessayer');
			return back();
		}

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Demande  $demande
     * @return \Illuminate\Http\Response
     */
    public function show(Demande $demande)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Demande  $demande
     * @return \Illuminate\Http\Response
     */
    public function edit(Demande $demande)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Demande  $demande
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Demande $demande)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Demande  $demande
     * @return \Illuminate\Http\Response
     */
    public function destroy(Demande $demande)
    {
        //
    }
}
