<?php namespace NanoSoluctions\NanoConfigs\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

use NanoSoluctions\NanoConfigs\Models\NanoNvaccess;

class NanoController extends BaseController {

    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests;

    public $usuario_logado;

    public function __construct() {
        $this->usuario_logado = Auth::guard('nano')->user();
    }

    /**
     * checkAcess
     * @param string $key Chave de acesso
     * @return boolean
     * @description Checa se o nivel de acesso do usuário logado é permitido para edição
     */
    public function checkAcess($key) {
        $this->acesso = NanoNvaccess::select('nivel')->where('key', '=', $key)->get()->toArray();

        if ($this->acesso) {
            foreach ($this->acesso as $acesso) {
                $acessIds[] = $acesso['nivel'];
            }

            if (in_array($this->usuario_logado->nivel, $acessIds)) {
                return true;
            } else {
                return redirect('erro/403')->send();
            }
        } else {
            return true;
        }
    }

}
