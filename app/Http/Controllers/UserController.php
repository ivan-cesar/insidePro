<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use App\Models\Fonction;

use App\Models\User;
//use App\Models\Country;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

	public function __construct(){
        $this->middleware('auth');
		View::share( 'section_title', 'Module utilisateur' );
		View::share( 'menu', 'users' );	
		
		View::share( 'nbDirector', User::where("role",4)->count());
		View::share( 'nbManager', User::where("role",3)->count());
		View::share( 'nbuser', User::where("role",2)->count());
		View::share( 'nbUser', User::where("role",1)->count());
		View::share( 'fonctions', Fonction::all());
		
		view::share('users',User::all());
		
		$this->middleware('auth');
 
    }

	
	public function index(){
		$data['page_title'] = "Liste des utilisateurs - ";
		$data['page_description'] = "";
		$data['users'] = User::orderBy("id","DESC")->get();
		
		User:logs("Affichage de la liste des utilisateurs");
		
		return view('users.index',$data);
    }
	
	public function create(){
		$data['page_title'] = "Ajouter un utilisateur - ";
		$data['page_description'] = "";
		
		User:logs("Affichage de la page de creation d'un utilisateur");
		
		return view('users.create',$data);
    }

	public function store(Request $request){

		//dd($request->all());
		$this->validate(request(),[
			  "nom" => "required",
			  "prenoms" => "required",
			  "email" => "required|email|max:255|unique:users",
			  "adresse" => "required",
			  "fonction" => "required",
			  "telephone" => "required",
			  "debut" => "required|date",
			  "role" => "required|integer",
		]);
		


		$usr = new User;
		$usr->name = htmlspecialchars($request->nom);
		$usr->prenoms = htmlspecialchars($request->prenoms);
		$usr->email = htmlspecialchars($request->email);
		$usr->telephone = htmlspecialchars($request->telephone);
		$usr->avatars = "/images/avatars/avatar.png";
		$usr->role = htmlspecialchars($request->role);
		$usr->fonction_id = htmlspecialchars($request->fonction);
		$usr->debut = htmlspecialchars($request->debut);
		$usr->adresse = htmlspecialchars($request->adresse);
		$usr->statut = 1;
		$usr->created_by = Auth::user()->nom.' '.Auth::user()->prenoms;
		
		$password = '1234567890';
		$usr->password = Hash::make($password);

		$user['nom'] = htmlspecialchars($request->nom);
		$user['prenoms'] = htmlspecialchars($request->prenoms);
		$user['email'] =   htmlspecialchars($request->email);
		$user['pass'] = $password;
		
		$roleValues=[2,3,4];
		
		$users = User::whereIn('role',$roleValues)
						->where('statut',1)
						->get();

		if($usr->save()){
			/*
			@Mail::send('emails.notification',$user, function($message) use($user) {
				$message->from('infos@inside.com','PROPULSE GROUP')->to($user['email'])->subject('Accès INSIDE PROPULSE GROUP ');
			});
			
			foreach ($users as $user){
			   $user['emailuser'] = $user->email;
			   @Mail::send('emails.notifuser', $user, function($message) use($user) {
					$message->from('infos@propulsegroup.com','PROPULSE GROUP')
					   ->to($user['emailuser'])
					   ->subject('Un nouvel utilisateur a été enregistré');
			   });
			}
			*/

			session()->flash('type', 'alert-success');
			session()->flash('message', 'Utilisateur crée avec succès');
			return redirect()->route('users.index');
		}else{
			session()->flash('type', 'alert-danger');
			session()->flash('message', 'Une erreur s\'est produite à la création, veuillez réessayer');
			return back();
		}
	}


	

	public function edit(Request $request){
		$data['page_title'] = "Modifier un utilisateur - ";
		$data['page_description'] = " ";
		
		$data['user'] = User::where(['id' => $request->id ])->first();
		if(empty($data['user'])){
			session()->flash('type', 'alert-danger');
            session()->flash('message', 'Utilisateur introuvable');
			return back();
		}
		
		//User:logs("Affichage de la page de modification d'un utilisateur");
		
		return view('users.edit',$data);
	}

	public function update(Request $request){

		$this->validate(request(),[
		      "id" => "required",			  
			  "nom" => "required",
			  "prenoms" => "required",
			  "adresse" => "required",
			  "fonction" => "required",
			  "telephone" => "required",
			  "debut" => "required|date",
			  "role" => "nullable|integer",
		]);

		$id = htmlspecialchars($request->id);
		$data["name"] = htmlspecialchars($request->nom);
		$data["prenoms"] = htmlspecialchars($request->prenoms);
		$data["fonction_id"] = htmlspecialchars($request->fonction);
		$data["telephone"] = htmlspecialchars($request->telephone);
		$data["debut"] = htmlspecialchars($request->debut);
		$data["adresse"] = htmlspecialchars($request->adresse);
		
        /*if ($request->file()){
            $file = $request->file('avatars');
            $ext = strtolower($file->getClientOriginalExtension());
            $avatar = time().'_'.Str::slug($request->prenoms).'_erp.'.$ext;
            $request->avatars->move('images/avatars', $avatar);
            $data["avatars"] = '/images/avatars/'.$avatar;
        }*/
		
		if ($request->role){
            $data["role"] = htmlspecialchars($request->role);
        }
		//test de l'enregistrement suivi d'un message selon cas
		if(User::where([ 'id' => $id ])->update($data)){
			session()->flash('type', 'alert-success');
			session()->flash('message', 'Utilisateur modifié avec succès');
			return redirect()->route('users.index');;
		}else{
			session()->flash('type', 'alert-danger');
			session()->flash('message', 'Erreur lors de la modification');
			return back();
		}

	}

	
	public function editstate(Request $request){
        $id = htmlspecialchars($request->id);
        $user =User::where('id',$id)->first();

        if(!$user){
			session()->flash('type', 'alert-danger');
            session()->flash('message', 'Utilisateur introuvable');
			return back();            
        }
		if($user->statut==1){
			$user->statut =0;
			$user->save();
			session()->flash('type', 'alert-success');
			session()->flash('message', 'Compte utilisateur désactivé avec succès');
			//User:logs("Désactivation du compte utilisateur:".$user->nom .' '.$user->prenoms);
			return redirect()->route('users.index');
		}else{
			$user->statut =1;
			$user->save();
			session()->flash('type', 'alert-success');
			session()->flash('message', 'Compte utilisateur activé avec succès');
			//User::logs("Activation du compte utilisateur : ".$user->nom .' '.$user->prenoms);
			return redirect()->route('users.index');
		}
		
    }
	
	public function destroy(Request $request){
        //
        $id = htmlspecialchars($request->id);
        $user = User::where(['id' => $id])->first();

        if(!$user){
			
			session()->flash('type', 'alert-danger');
			session()->flash('message', "Utilisateur introuvable");
			return back();
		}
		$user->delete();	
		
		session()->flash('type', 'alert-success');
		session()->flash('message', 'Utilisateur supprimé avec succès');			
		return back();
    }

}