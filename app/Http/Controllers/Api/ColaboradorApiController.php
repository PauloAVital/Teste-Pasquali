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
     * Display a listing of the resource.
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

  
    public function store(Request $request)
    {   
        $dataForm =  $request->all();
        
        $retornoValida = $this->validarApi($dataForm);
        if ($retornoValida != '') {
            echo $retornoValida; 
        } else {
            $data = $this->colaborador->create($dataForm);        
            return response()->json($data, 200); 
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
        if (!$data = $this->colaborador->find($id)) {
            return response()->json(['error'=> 'Nada Encontrado', 404]);
        } else {
            return response()->json($data);
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$data = $this->colaborador->find($id)){
            return response()->json(['error'=> 'Nada Encontrado', 404]);
        } else {
            $data->delete();

            return response()->json(['success'=> 'Deletado com Sucesso']);
        }
    }

    private function validarApi($dataForm, $id = null) {        
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
    }

    public function getsearchCpf($cpf) {
        if (!$data = $this->colaborador::where('cpf', $cpf)->get(['*'])) {
            return response()->json(['error'=> 'Nada Encontrado', 404]);
        } else {
            return response()->json($data);
        }
    }

    public function vincularSalario(Request $request, $id) {
        if (!$data = $this->colaborador->find($id)){
            return response()->json(['error'=> 'Nada Encontrado', 404]);
        } else {
            $dataForm = array(
                "id_colaborador" => $data->id,
                "salario" => $request->salario
            );

            $data = $this->salario->create($dataForm);        
            return response()->json($data, 200); 
        }
    }

    public function salario($id) {
        if (!$data = $this->colaborador->with('salario')->find($id)){
            return response()->json(['error'=> 'Nada Encontrado', 404]);
        } else {
            return response()->json($data);
        }
    }
}
