<?php namespace NanoSoluctions\NanoConfigs\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use NanoSoluctions\NanoConfigs\Controllers\NanoController; 

class NanoLoginController extends NanoController 
{ 
	use AuthenticatesUsers; 
	protected $redirectTo = '/'; 

	public function __construct() { 
		$this->middleware('guest', ['except' => 'logout']); 
	}

	protected function guard() { 
		return Auth::guard('nano'); 
	}

	protected function show() {
		if (Auth::guard('nano')->check()) {
            $this->usuario_logado = Auth::guard('nano')->user();

            return view('nano::home'); 
        }

		return view('nano::auth.login'); 
	}

	protected function login(Request $request){
		if (Auth::guard('nano')->attempt([
				'email' => $request->get('email'), 
				'password' => $request->get('password')
			])) {

            return redirect()->intended('nano/dashboard');
        }else{
        	return 'Não autenticado.';
        }
	}

	protected function logout(){
		Auth::guard('nano')->logout(); 

		return redirect()->intended('login');
	} 
}