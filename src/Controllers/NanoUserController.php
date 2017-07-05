<?php namespace NanoSoluctions\NanoConfigs\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

use NanoSoluctions\NanoConfigs\Models\NanoUser;
use NanoSoluctions\NanoConfigs\Models\NanoNivel;
use NanoSoluctions\NanoConfigs\Requests\NanoUserRequest;

class NanoUserController extends NanoController {

    public function __construct(Request $request) {
        parent::__construct();
        parent::checkAcess('accessUsers');

        $this->retorno = array();
        $this->request = $request->except('_token');
        if (!empty($this->request))
            $this->retorno['request'] = $this->request;

        $this->area = 'nano.usuarios';

        if (Session::has('mensagem')) {
            $this->retorno['mensagem'] = Session::get('mensagem');
            Session::pull('mensagem');
        }
    }

    /**
     *   Listagem dos usuários
     */
    public function index() {
        $usuarios = NanoUser::whereNull('lixeira')
                ->orWhereIn('lixeira', ['', 'nao'])
                ->paginate(env('25'));

        $this->retorno['usuarios'] = $usuarios;

        return view("nano.home", $this->retorno);
    }

    /**
     * 	Cadastro de usuários
     */
    public function create() {
        $this->retorno['niveis'] = NanoNivel::all();

        return view($this->area . ".inserir", $this->retorno);
    }

    /**
     * 	Inserir usuário no banco
     */
    public function store() {
        $rules = array(
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'nivel' => 'required'
        );

        $this->retorno['niveis'] = NanoNivel::all();
        if ($this->request['password'] !== $this->request['password_confirmation'] || $this->request['password'] == '') {
            $this->retorno['mensagem'] = [
                'class' => 'alert-danger',
                'text' => 'Campo senha não confere com a confirmação de senha ou está vazio.'
            ];

            return view($this->area . '.inserir')->with($this->retorno);
        }

        $validator = Validator($this->request, $rules);
        if ($validator->fails()) {
            $this->retorno['errors'] = $validator->errors();
            return view($this->area . '.inserir')->with($this->retorno);
        } else {
            $usuario = new NanoUser;
            $usuario->name = $this->request['name'];
            $usuario->email = $this->request['email'];
            $usuario->password = bcrypt($this->request['password']);
            $usuario->login = $this->request['login'];
            $usuario->rg = $this->request['rg'];
            $usuario->cpf = $this->request['cpf'];
            $usuario->nascimento = $this->request['nascimento'];
            $usuario->telefone = $this->request['telefone'];
            $usuario->celular = $this->request['celular'];
            $usuario->endereco = $this->request['endereco'];
            $usuario->bairro = $this->request['bairro'];
            $usuario->cidade = $this->request['cidade'];
            $usuario->uf = $this->request['uf'];
            $usuario->cep = $this->request['cep'];
            $usuario->observacoes = $this->request['observacoes'];
            $usuario->nivel = ($this->request['nivel'] !== '' ? $this->request['nivel'] : 2);
            $usuario->lixeira = 'nao';
            $usuario->agent_id = $this->usuario_logado->id;

            if ($this->request['codImagem'] !== '') {
                $usuario->foto = setUri($usuario->name) . '_' . $usuario->id . '.png';
                $usuario->setImagemFoto($this->request['codImagem'], $usuario->foto);
            }

            if ($usuario->save()) {
                Session::put('mensagem', [
                    'class' => 'alert-success',
                    'text' => 'Usuário criado com sucesso!'
                ]);
                return redirect()->route($this->area . '.index')->with($this->retorno);
            }

            $this->retorno['mensagem'] = [
                'class' => 'alert-danger',
                'text' => 'Houve algum erro durante o processo. Por favor, tente mais tarde.'
            ];
            return view($this->area . '.inserir')->with($this->retorno);
        }
    }

    /**
     * 	Edição de usuários
     */
    public function edit($id) {
        $this->retorno['usuario'] = NanoUser::find($id);
        $this->retorno['niveis'] = NanoNivel::all();

        return view($this->area . '.editar', $this->retorno);
    }

    /**
     * 	Editar usuário no banco
     */
    public function update($id) {
        $this->retorno['request'] = $this->request;
        $this->retorno['niveis'] = NanoNivel::all();
        $this->retorno['usuario'] = NanoUser::find($id);

        $rules = array(
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'login' => 'required'
        );

        if ($this->request['password'] !== $this->request['password_confirmation'] || $this->request['password'] == '') {
            $this->retorno['mensagem'] = [
                'class' => 'alert-danger',
                'text' => 'Campo senha não confere com a confirmação de senha ou está vazio.'
            ];
            
            return view($this->area . '.editar')->with($this->retorno);
        }

        $validator = Validator($this->request, $rules);
        if ($validator->fails()) {
            $this->retorno['errors'] = $validator->errors();

            return view($this->area . '.editar')->with($this->retorno);
        } else {
            $usuario = NanoUser::find($id);
            $usuario->name = $this->request['name'];
            $usuario->email = $this->request['email'];
            $usuario->password = bcrypt($this->request['password']);
            $usuario->login = $this->request['login'];
            $usuario->rg = $this->request['rg'];
            $usuario->cpf = $this->request['cpf'];
            $usuario->nascimento = $this->request['nascimento'];
            $usuario->telefone = $this->request['telefone'];
            $usuario->celular = $this->request['celular'];
            $usuario->endereco = $this->request['endereco'];
            $usuario->bairro = $this->request['bairro'];
            $usuario->cidade = $this->request['cidade'];
            $usuario->uf = $this->request['uf'];
            $usuario->cep = $this->request['cep'];
            $usuario->observacoes = $this->request['observacoes'];
            $usuario->nivel = $this->request['nivel'];
            $usuario->agent_id = $this->usuario_logado->id;

            if ($this->request['codImagem'] !== '') {
                $usuario->setImagemFoto($this->request['codImagem'], $usuario->foto);
                $usuario->foto = setUri($usuario->name) . '_' . $usuario->id . '.png';
            }

            if($usuario->save()){
                Session::put('mensagem', [
                    'class' => 'alert-success',
                    'text' => 'Usuário editado com sucesso!'
                ]);
                return redirect()->route($this->area . '.index')->with($this->retorno);
            }

            $this->retorno['mensagem'] = [
                'class' => 'alert-danger',
                'text' => 'Houve algum erro durante o processo. Por favor, tente mais tarde.'
            ];
            return view($this->area . '.editar')->with($this->retorno);
        }
    }

    /**
     * Desativar usuário
     */
    public function lixeira($id) {
        $usuario = NanoUser::find($id);
        $usuario->lixeira = 'sim';

        if ($usuario->save()) {
            Session::put('mensagem', [
                'class' => 'alert-success',
                'text' => 'Usuário enviado para a lixeira!'
            ]);
        } else {
            Session::put('mensagem', [
                'class' => 'alert-danger',
                'text' => 'Houve algum erro durante o processo. Por favor, tente mais tarde.'
            ]);
        }

        return redirect()->route($this->area . '.index')->with($this->retorno);
    }

    /**
     * Ativar usuário
     */
    public function ativar($id) {
        $usuario = NanoUser::find($id);
        $usuario->lixeira = '';

        if ($usuario->save()) {
            Session::put('mensagem', [
                'class' => 'alert-success',
                'text' => 'Usuário restaurado com sucesso!'
            ]);
        } else {
            Session::put('mensagem', [
                'class' => 'alert-danger',
                'text' => 'Houve algum erro durante o processo. Por favor, tente mais tarde.'
            ]);
        }

        return redirect()->route($this->area . '.index')->with($this->retorno);
    }

    /**
     * 	Deletar usuários
     */
    public function delete($id) {
        if (NanoUser::find($id)->delete()) {
            Session::put('mensagem', [
                'class' => 'alert-success',
                'text' => 'Usuário excluído com sucesso!'
            ]);
        } else {
            Session::put('mensagem', [
                'class' => 'alert-danger',
                'text' => 'Houve algum erro durante o processo. Por favor, tente mais tarde.'
            ]);
        }

        return redirect()->route($this->area . '.index')->with($this->retorno);
    }

}
