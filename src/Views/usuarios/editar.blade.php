@extends('nano.layout')
@section('content')

<div class="container">
    @if(isset($mensagem))
    <ul class="alert {{ $mensagem['class'] }}">
        <li>{{ $mensagem['text'] }}</li>
    </ul>
    @endif

    @if ($errors->any())
    <ul class="alert alert-warning">
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif

    <div class="row">
        <div class="col-md-12">
            <h1>Usuários / Editar</h1>
        </div>        

        <form name="frm" action="{{ route("nano.usuarios.update", ["id"=> $usuario->id ])}}" method="post" >
            <div class="col-md-6">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">Nome:</label>
                    <div class="col-sm-9">
                        <input name="name" type="text" value="{{ $usuario->name }}" class="form-control" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">E-mail:</label>
                    <div class="col-sm-9">
                        <input name="email" type="email" value="{{ $usuario->email }}" class="form-control" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="telefone" class="col-sm-3 control-label">Telefone:</label>
                    <div class="col-sm-9">
                        <input name="telefone" type="tel" value="{{ $usuario->telefone }}" class="formFone form-control" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="celular" class="col-sm-3 control-label">Celular:</label>
                    <div class="col-sm-9">
                        <input name="celular" type="tel" value="{{ $usuario->celular }}" class="formFone form-control" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="login" class="col-sm-3 control-label">Login:</label>
                    <div class="col-sm-9">
                        <input name="login" type="text" value="{{ $usuario->login }}" class="form-control" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="password" class="col-sm-3 control-label">Senha:</label>
                    <div class="col-sm-9">
                        <input name="password" type="password" value="" class="form-control" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="passwordc" class="col-sm-3 control-label">Repita a senha:</label>
                    <div class="col-sm-9">
                        <input name="password_confirmation" type="password" value="" class="form-control" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="imagem" class="col-sm-3 control-label">Imagem:</label>
                    <div class="col-sm-9">
                        <div class="input-group input-group-sm">
                            <input class="form-control" name="foto" type="text" value="">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-info btn-flat" id="btn-camera" data-toggle="modal" data-target="#modalCamera"><i class="fa fa-camera"></i></button>
                            </span>
                        </div>
                        <p class="text-danger">Clique na câmera e depois em 'ok' para tirar uma foto.</p>
                    </div>
                </div>

                <div class="form-group">
                    <label for="preview" class="col-sm-3 control-label">Preview:</label>
                    <div class="col-sm-9">
                        <div id="imagem-preview"><canvas id="canvas" src="@if($usuario->foto !== ''){{ asset('img/perfil/' . $usuario->foto) }}@endif" width="400" height="300"></canvas></div>
                        <input type="hidden" name="codImagem" value="">
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="rg" class="col-sm-3 control-label">Nascimento:</label>
                    <div class="col-sm-9">
                        <input name="nascimento" type="text" value="{{ $usuario->nascimento }}" class="formDate form-control" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="rg" class="col-sm-3 control-label">RG:</label>
                    <div class="col-sm-9">
                        <input name="rg" type="text" value="{{ $usuario->rg }}" class="formRG form-control" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="cpf" class="col-sm-3 control-label">CPF:</label>
                    <div class="col-sm-9">
                        <input name="cpf" type="text" value="{{ $usuario->cpf }}" class="formCPF form-control" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="endereco" class="col-sm-3 control-label">Endereço:</label>
                    <div class="col-sm-9">
                        <input name="endereco" type="text" value="{{ $usuario->endereco }}" class="form-control" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="bairro" class="col-sm-3 control-label">Bairro:</label>
                    <div class="col-sm-9">
                        <input name="bairro" type="text" value="{{ $usuario->bairro }}" class="form-control" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="cidade" class="col-sm-3 control-label">Cidade:</label>
                    <div class="col-sm-9">
                        <input name="cidade" type="text" value="{{ $usuario->cidade }}" class="form-control" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="cep" class="col-sm-3 control-label">CEP:</label>
                    <div class="col-sm-4">
                        <input name="cep" type="text" value="{{ $usuario->cep }}" class="formCEP form-control" />
                    </div>
                    <label for="uf" class="col-sm-1 control-label">UF:</label>
                    <div class="col-sm-4">
                        <select name="uf" class="form-control">
                            <option value="">Selecione</option>
                            <option value="AC" {{ $usuario->uf == 'AC' ? 'selected=selected' : '' }} >AC</option>
                            <option value="AL" {{ $usuario->uf == 'AL' ? 'selected=selected' : '' }} >AL</option>
                            <option value="AM" {{ $usuario->uf == 'AM' ? 'selected=selected' : '' }} >AM</option>
                            <option value="AP" {{ $usuario->uf == 'AP' ? 'selected=selected' : '' }} >AP</option>
                            <option value="BA" {{ $usuario->uf == 'BA' ? 'selected=selected' : '' }} >BA</option>
                            <option value="CE" {{ $usuario->uf == 'CE' ? 'selected=selected' : '' }} >CE</option>
                            <option value="DF" {{ $usuario->uf == 'DF' ? 'selected=selected' : '' }} >DF</option>
                            <option value="ES" {{ $usuario->uf == 'ES' ? 'selected=selected' : '' }} >ES</option>
                            <option value="GO" {{ $usuario->uf == 'GO' ? 'selected=selected' : '' }} >GO</option>
                            <option value="MA" {{ $usuario->uf == 'MA' ? 'selected=selected' : '' }} >MA</option>
                            <option value="MG" {{ $usuario->uf == 'MG' ? 'selected=selected' : '' }} >MG</option>
                            <option value="MS" {{ $usuario->uf == 'MS' ? 'selected=selected' : '' }} >MS</option>
                            <option value="MT" {{ $usuario->uf == 'MT' ? 'selected=selected' : '' }} >MT</option>
                            <option value="PA" {{ $usuario->uf == 'PA' ? 'selected=selected' : '' }} >PA</option>
                            <option value="PB" {{ $usuario->uf == 'PB' ? 'selected=selected' : '' }} >PB</option>
                            <option value="PE" {{ $usuario->uf == 'PE' ? 'selected=selected' : '' }} >PE</option>
                            <option value="PI" {{ $usuario->uf == 'PI' ? 'selected=selected' : '' }} >PI</option>
                            <option value="PR" {{ $usuario->uf == 'PR' ? 'selected=selected' : '' }} >PR</option>
                            <option value="RJ" {{ $usuario->uf == 'RJ' ? 'selected=selected' : '' }} >RJ</option>
                            <option value="RN" {{ $usuario->uf == 'RN' ? 'selected=selected' : '' }} >RN</option>
                            <option value="RS" {{ $usuario->uf == 'RS' ? 'selected=selected' : '' }} >RS</option>
                            <option value="RO" {{ $usuario->uf == 'RO' ? 'selected=selected' : '' }} >RO</option>
                            <option value="RR" {{ $usuario->uf == 'RR' ? 'selected=selected' : '' }} >RR</option>
                            <option value="SC" {{ $usuario->uf == 'SC' ? 'selected=selected' : '' }} >SC</option>
                            <option value="SE" {{ $usuario->uf == 'SE' ? 'selected=selected' : '' }} >SE</option>
                            <option value="SP" {{ $usuario->uf == 'SP' ? 'selected=selected' : '' }} >SP</option>
                            <option value="TO" {{ $usuario->uf == 'TO' ? 'selected=selected' : '' }} >TO</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="nivel" class="col-sm-3 control-label">Nível:</label>
                    <div class="col-sm-9">
                        <select name="nivel" class="form-control">
                            <option value="">Selecione um:</option>
                            @if(count($niveis) > 0)
                            @foreach($niveis as $nivel)
                            <option value="{{ $nivel->id }}"  {{ $usuario->nivel ==  $nivel->id  ? 'selected=selected' : '' }} >{{ $nivel->nivel }}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="observacoes" class="col-sm-3 control-label">Observações:</label>
                    <div class="col-sm-9">
                        <textarea rows="4" class="form-control" name="observacoes">{{ $usuario->observacoes}}</textarea>
                    </div>
                </div>

                <div class="form-group">
                    <div class="pull-right ">
                        <br>
                        <a href="javascript:history.back(-1)">
                            <button type="button" class="btn btn-default">Voltar</button>
                        </a>
                        <button type="submit"  class="btn btn-primary">SALVAR</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

<!-- Modal Câmera -->
<div class="modal fade" id="modalCamera" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">×</span></button>
                <h3 class="box-title">Preview</strong></h3>
            </div>
            <div class="modal-body">
                <video id="video" autoplay></video>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-primary btn-block" id="okFoto" data-dismiss="modal" value="ok"><b>OK</b></a>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
