<?php namespace NanoSoluctions\NanoConfigs\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

use NanoSoluctions\NanoConfigs\Requests\NanoUserRequest;
use NanoSoluctions\NanoConfigs\NanoConfig;

class NanoHomeController extends NanoController{

    public function __construct(Request $request) {
        parent::__construct();

        $this->middleware('auth');
        $this->retorno = array();
        $this->request = $request->except('_token');

        if (Session::has('mensagem')) {
            $this->retorno['mensagem'] = Session::get('mensagem');
            Session::pull('mensagem');
        }
    }

    /**
     *   Listagem dos usuários
     */
    public function index() {
        return view("nanocms::home", $this->retorno);
    }
}
