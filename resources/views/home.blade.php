@extends('layouts.app')

@section('content')
<style>
    .container img {
        max-width:200px;
        max-height:150px;
        width: auto;
        height: auto;
    }
    .card-titles {
        width: 13rem; 
        float: left; 
        margin-right: 1%
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card col-md-12">
                <div class="card-header">
                   
                    <div class="card card-titles">
                        <img class="card-img-top" src="img/api.jpg" alt="dashboard">
                    </div>
                    <b>End-point resource colaborador</b>
                    <p class="card-text"><b>VERBO GET.</b>
                        <ul>
                            <li>[LISTA] - <b>http://localhost:8000/api/Colaborador</b></li>
                            <li>[PESQUISA] - <b>http://localhost:8000/api/Colaborador/{id}</b></li>
                            <li>[PESQUISA CPF] - <b>http://localhost:8000/api/Colaborador/{cpf}/SearchCpf</b></li>
                            <li>[COLABORADOR COM HISTORICO DE SALARIO] - <b>http://localhost:8000/api/Colaborador/{id}/salario</b></li>
                        </ul>
                    </p>
                    <p class="card-text"><b>VERBO POST.</b>
                        <ul>
                            <li>[INSERIR] - <b>http://localhost:8000/api/Colaborador</b></li>
                            <li> [JSON] - <br>
                            {
                                "id": 2,
                                "nome": "Paulo Antonio Vital",
                                "email": "pauloavital@gmail.com",
                                "cpf": "28125988891",
                                "rg": "290007071",
                                "nascimento": "1979-06-17",
                                "cep": 14708021,
                                "endereco": "Antonio Agostinho Pupo",
                                "numero": "311",
                                "cidade": "Bebedouro",
                                "estado": "SP",
                                "created_at": "2022-01-08 19:15:43",
                                "updated_at": "2022-01-08 19:15:43"
                            }
                            </li>
                        </ul>
                    </p>
                    <p class="card-text"><b>VERBO PUT.</b>
                        <ul>
                            <li>[ATUALIZAR] - <b>http://localhost:8000/api/Colaborador/{id}</b></li>
                            <li> [JSON] - <br>
                            {
                                "id": 2,
                                "nome": "Paulo Antonio Vital Atualizar",
                                "email": "pauloavital@gmail.com",
                                "cpf": "28125988891",
                                "rg": "290007071",
                                "nascimento": "1979-06-17",
                                "cep": 14708021,
                                "endereco": "Antonio Agostinho Pupo",
                                "numero": "311",
                                "cidade": "Bebedouro",
                                "estado": "SP",
                                "created_at": "2022-01-08 19:15:43",
                                "updated_at": "2022-01-08 19:15:43"
                            }
                            </li>
                        </ul>
                    </p>
                    <p class="card-text"><b>VERBO DELETE.</b>
                        <ul>
                            <li>[DELETAR] - <b>http://localhost:8000/api/Colaborador/{id}</b></li>
                        </ul>
                    </p>
                    <hr>
                    <b>End-point resource salario</b>
                    <p class="card-text"><b>VERBO GET.</b>
                        <ul>
                            <li>[LISTA] - <b>http://localhost:8000/api/Salario</b></li>
                            <li>[PESQUISA] - <b>http://localhost:8000/api/Salario/{id}</b></li>
                        </ul>
                    </p>
                    <p class="card-text"><b>VERBO POST.</b>
                        <ul>
                            <li>[INSERIR] - <b>http://localhost:8000/api/Salario</b></li>
                            <li> [JSON] - <br>
                            {
                                "id_colaborador": 2,
                                "salario": 11000
                            }
                            </li>
                        </ul>
                    </p>
                    <p class="card-text"><b>VERBO PUT.</b>
                        <ul>
                            <li>[ATUALIZAR] - <b>http://localhost:8000/api/Salario/{id}</b></li>
                            <li> [JSON] - <br>
                            {
                                "id_colaborador": 2,
                                "salario": 22000
                            }
                            </li>
                        </ul>
                    </p>
                    <p class="card-text"><b>VERBO DELETE.</b>
                        <ul>
                            <li>[DELETAR] - <b>http://localhost:8000/api/Salario/{id}</b></li>
                        </ul>
                    </p>
                </div>
                <a href="Teste-Pasquali.postman_collection.json" target="_blank">Api-Collection</a>
            </div>
            
        </div>
    </div>
</div>
@endsection