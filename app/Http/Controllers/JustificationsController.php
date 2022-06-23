<?php

namespace App\Http\Controllers;

use App\Models\Justification;
use Illuminate\Http\Request;

class JustificationsController extends Controller
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
    }
     
    public function index()
    {
        $data['page_title'] = "Liste des demandes - ";
		$data['page_description'] = "";
		$data['demandes'] = Justification::orderBy("id","DESC")->get();
		
		//User:logs("Affichage de la liste des utilisateurs");
		
		return view('justifications.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       	$data['page_title'] = "Ajouter une Justification - ";
		$data['page_description'] = "";
		
		//Demande:logs("Affichage de la page de demande de congé");
		
		return view('justifications.create',$data);
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
		
		    $jst = new Justification;
    		$jst->type_demande = htmlspecialchars($request->type);
    		$jst->date_depart = htmlspecialchars($request->date_depart);
    		$jst->date_retour = htmlspecialchars($request->date_retour);
    		//$dmd->filenames = $request->file->hashName();
    		$jst->message = htmlspecialchars($request->message);
    		$jst->user_id = Auth::user()->id;
    		//Enregistrement de l'image du logo
        
        if(file_exists($request->file('filenames'))){
            $extension = pathinfo($request->file('filenames')->getClientOriginalName(), PATHINFO_EXTENSION);
            $newName = 'logo-'.Carbon::now()->timestamp.'.'.$extension;
            $upload_path = 'public/justifications/';
            if($request->file('filenames')->move($upload_path, $newName)){
                $dmd->fichier  = "http://".$_SERVER['SERVER_NAME']."/public/justifications/".$newName;
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
     * @param  \App\Models\Justification  $justification
     * @return \Illuminate\Http\Response
     */
    public function show(Justification $justification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Justification  $justification
     * @return \Illuminate\Http\Response
     */
    public function edit(Justification $justification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Justification  $justification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Justification $justification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Justification  $justification
     * @return \Illuminate\Http\Response
     */
    public function destroy(Justification $justification)
    {
        //
    }
}
