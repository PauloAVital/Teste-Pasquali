<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Colaborador;
use App\Models\Salario;
use Exception;
use Illuminate\Support\Facades\Validator;

class SalarioApiController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $data = $this->salario->all();

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $dataForm =  $request->all();
       
            $retornoValida = $this->validarApiSalario($dataForm);

            if ($retornoValida != '') {
                echo $retornoValida;
            } else {

                $data = $this->salario->create($dataForm);        
                return response()->json($data, 200); 
            }
        } catch (Exception $e) {
            return response()->json(['error'=> $e->getMessage(), 400]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            if (!$data = $this->salario->find($id)) {
                return response()->json(['error'=> 'Nada Encontrado', 404]);
            } else {
                return response()->json($data);
            }
        } catch (Exception $e) {
            return response()->json(['error'=> $e->getMessage(), 400]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            if (!$data = $this->salario->find($id)){
                return response()->json(['error'=> 'Nada Encontrado', 404]);
            } else {
                $dataForm =  $request->all();
                $retornoValida = $this->validarApiSalario($dataForm, $id);
    
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            if (!$data = $this->salario->find($id)){
                return response()->json(['error'=> 'Nada Encontrado', 404]);
            } else {
                $data->delete();
    
                return response()->json(['success'=> 'Deletado com Sucesso']);
            }
        } catch (Exception $e) {
            return response()->json(['error'=> $e->getMessage(), 400]);
        }
    }

    public function vincularSalario(Request $request, $id) {
        try {
            if (!$data = $this->colaborador->find($id)){
                return response()->json(['error'=> 'Nada Encontrado', 404]);
            } else {
                $dataForm = array(
                    "id_colaborador" => $data->id,
                    "salario" => $request->salario
                );
    
                $retornoValida = $this->validarApiSalario($dataForm);
    
                if ($retornoValida != '') {
                    echo $retornoValida;
                } else {
                    $data = $this->salario->create($dataForm);        
                    return response()->json($data, 200); 
                }
            }
        } catch (Exception $e) {
            return response()->json(['error'=> $e->getMessage(), 400]);
        }
    }

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


    /**
     * Função que valida dados para cadastro de salario.
     *
     * @return \Illuminate\Http\Response
     */
    private function validarApiSalario($dataForm, $id = null) {        
        
        try {
            $messages = [
                'id_colaborador.required' => 'informe o id do Colaborador',
                'id_colaborador.integer' => 'id tem que conter apenas numeros',
                'salario.required' => 'informe o salario',
            ];
    
            $rules = [
                'id_colaborador' => 'required|integer',
                'salario' => 'required'
            ];
    
            $regras = ($id != null) ? $rules : $this->salario->rules();
    
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
}
