<?php namespace NanoSoluctions\NanoConfigs\Controllers;

use App\Http\Controllers\Controller; 
use Illuminate\Foundation\Auth\AuthenticatesUsers; 
use Illuminate\Support\Facades\Auth;

class NanoLoginController extends Controller 
{ 
	use AuthenticatesUsers; 
	protected $redirectTo = '/'; 

	public function __construct() { 
		$this->middleware('guest', ['except' => 'logout']); 
	}

	protected function guard() { 
		return Auth::guard('nano'); 
	}

	protected function showLoginForm() {
		if (Auth::guard('nano')->check()) {
            $this->usuario_logado = Auth::guard('nano')->user();
        }
		return view('nano.login'); 
	} 
}