<?php

namespace App\Http\Controllers;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use Illuminate\Http\Request;
use Validator;

use App\User;
use App\Role;

use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{	
	public function index() {
		$sentinelUser = Sentinel::getUser();

		if ( !empty($sentinelUser) ) {
			$user = User::where('id','=',$sentinelUser->id)->select('id')->with('сontestants')->first();
		} else {
			$user = null;
		}

		$сontestants = User::select([
				'id',
				'sex',
				'first_name',
				'last_name',
				'file_path',
				'voite_count',
				'description',
			])
			->whereHas('roles',function($role){
				$role->where('slug','=','сontestant');
			})
			->get()->groupBy('sex');

		$data = [
			'сontestants' => $сontestants,
			'user' => $user,
		];

		return view('welcome',$data);
	}

	public function set_voice (Request $request) {
		$sentinelUser = Sentinel::getUser();

		if ( empty($sentinelUser) ) {
			return ['response' => 400, 'text' => 'User not found'];
		}

		$user = User::where('id','=',$sentinelUser->id)->select('id')->first();

		if ( count( $user->сontestants ) > 0 ){
			return ['response' => 400, 'text' => 'Извините, Вы уже оставиляли свой голос'];
		}

		$id = $request->get('id');

		$сontestant = User::where('id','=',$id)->select('id','voite_count')->first();

		if ( empty($сontestant) ) {
			return ['response' => 400, 'text' => 'Contestant not found'];
		}

		$сontestant->voite_count = $сontestant->voite_count + 1;
		$сontestant->save();

		$user->сontestants()->attach($сontestant->id);
		
		return ['response' => 200];
	}

	/**
	 * Регистрация пользователя
	 */
    public function registration (Request $request) {

    	$rules = [
            'email' => 'required|email|unique:users,email',
        ];
        $messages = [
            'email.required' => 'Не указана почта',
            'email.email' => 'Не верный формат почты',
            'email.unique' => 'Данный адрес почты уже занят',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

    	$credentials = [
            'email'    => $request->get("email"),
            'password' => $request->get("password"),
        ];

        $user = Sentinel::register($credentials);

        if ( $user ) {
        	$activation = Activation::create($user);
            $activation->completed = 1;
            $activation->save();

            $role = Sentinel::findRoleBySlug("voiter");
            $role->users()->attach($user);

            Sentinel::authenticateAndRemember([ 'email' => $request->get('email'), 'password' => $request->get('password') ]);

            return redirect('/');
        } else {
            return redirect()->back()->withInput();
        }
    }

    /**
     * Логин
     */
    public function login(Request $request) {
        $user = Sentinel::authenticateAndRemember([ 'email' => $request->get('email'), 'password' => $request->get('password') ]);

        if( $user === false ) {
            return redirect()->back();
        } else {
            return redirect('/');
        }
    }

    /**
     * Логаут
     */
    public function logout() {
        Sentinel::logout();
        return Redirect::to('/');
    }
}
