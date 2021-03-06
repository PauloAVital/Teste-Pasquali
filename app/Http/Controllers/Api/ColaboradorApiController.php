<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Colaborador;
use App\Models\Salario;
use Illuminate\Support\Facades\Validator;
use Exception;

class ColaboradorApiController extends Controller
{
    
    public function __construct(Colaborador $colaborador,
                                Salario $salario,
                                Request $Request)
    {
        $this->colaborador = $colaborador;
        $this->salario = $salario;
        $this->request = $Request;
    }
    
    /**
     * Traz a lista de colaboradores.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $data = $this->colaborador->all();

            if(!$data->isEmpty()) {
                return response()->json($data);
            } else {
                return response()->json(['error'=> 'Nada Encontrado', 404]);
            }

        } catch (Exception $e) {
            return response()->json(['error'=> $e->getMessage(), 400]);
        }
    }

    /**
     * Realiza o cadastro do colaborador.
     * @return \Illuminate\Http\Response
     */
  
    public function store(Request $request)
    {   
        try {
            $dataForm =  $request->all();
        
            $retornoValida = $this->validarApi($dataForm);
            if ($retornoValida != '') {
                echo $retornoValida; 
            } else {
                $data = $this->colaborador->create($dataForm);        
                return response()->json($data, 200); 
            }
        } catch (Exception $e) {
            return response()->json(['error'=> $e->getMessage(), 400]);
        }
    }

    /**
     * Realiza a pesquisa de um colaborador especifico.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            if (!$data = $this->colaborador->find($id)) {
                return response()->json(['error'=> 'Nada Encontrado', 404]);
            } else {
                return response()->json($data);
            }
        } catch (Exception $e) {
            return response()->json(['error'=> $e->getMessage(), 400]);
        }
    }

    /**
     * Atualiza os dados do Colaborador
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            if (!$data = $this->colaborador->find($id)){
                return response()->json(['error'=> 'Nada Encontrado', 404]);
            } else {
                $dataForm =  $request->all();
                $retornoValida = $this->validarApi($dataForm, $id);
    
                if ($retornoValida != '') {
                    echo $retornoValida; 
                } else {
                    $data->update($dataForm);        
                    return response()->json($data, 200); 
                }
            }
        } catch (Exception $e) {
            return response()->json(['error'=> $e->getMessage(), 400]);
        }
    }

    /**
     * Delete o Colaborador.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            if (!$data = $this->colaborador->find($id)){
                return response()->json(['error'=> 'Nada Encontrado', 404]);
            } else {
                $data->delete();
    
                return response()->json(['success'=> 'Deletado com Sucesso']);
            }
        } catch (Exception $e) {
            return response()->json(['error'=> $e->getMessage(), 400]);
        }
    }

    /**
     * Fun????o que valida dados para cadastro de colaborador.
     *
     * @return \Illuminate\Http\Response
     */
    private function validarApi($dataForm, $id = null) {        

        try {
            $messages = [
                'cpf.required' => 'informe o cpf',
                'cpf.integer' => 'cpf tem que conter apenas numeros',
                'cpf.unique' => 'cpf duplicado',
                'email.required' => 'informe o email',
                'email.unique' => 'email duplicado',
            ];
    
            $rules = [
                'cpf' => 'required',
                'email' => 'required'
            ];
    
            $regras = ($id != null) ? $rules : $this->colaborador->rules();
    
            $validator = Validator::make($dataForm, $regras, $messages);
    
            if ($validator->fails()) {
                return  response()->json([ 
                            "valida" => false,
                            "erros" => $validator->errors()
                        ]);
            }
            return; 
        } catch (Exception $e) {
            return response()->json([
                "valida" => false,
                "erros" => $e->getMessage()]);
        }      
    }

    /**
     * Busca um colaborador especifico pelo CPF.
     *
     * @param  int  $cpf
     * @return \Illuminate\Http\Response
     */

    public function getsearchCpf($cpf) {
        try {
            if (!$data = $this->colaborador::where('cpf', $cpf)->get(['*'])) {
                return response()->json(['error'=> 'Nada Encontrado', 404]);
            } else {
                return response()->json($data);
            }
        } catch (Exception $e) {
            return response()->json(['error'=> $e->getMessage(), 400]);
        }
    }

    /**
     * Busca um Colaborador especifico e traz hist??rio de salario.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function salario($id) {
        try {
            if (!$data = $this->colaborador->with('salario')->find($id)){
                return response()->json(['error'=> 'Nada Encontrado', 404]);
            } else {
                return response()->json($data);
            }
        } catch (Exception $e) {
            return response()->json(['error'=> $e->getMessage(), 400]);
        }
    }
}
