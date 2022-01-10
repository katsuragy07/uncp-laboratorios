@extends('layouts.principal')
@section('titulo','Inicio')
@section('contenido')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <div class="btn-list">
                        <a href="#" class="btn btn-primary"> 
                            <i class="fa fa-search"></i> Buscar
                        </a>
                       
                        <a href="#" class="btn btn-success"> 
                            <i class="fa fa-plus"></i> Nuevo
                        </a>

                        <a href="#" class="btn-info"> 
                            <i class="glyphicon glyphicon-edit"></i> Editar
                        </a>

                        <a href="#" class="btn-danger"> 
                            <i class="glyphicon glyphicon-trash"></i> Eliminar
                        </a>

                        <a href="#" class="btn btn-outline-primary">
                            <i class="fa fa-file-pdf-o"></i> Descargar
                        </a>  

                        <a href="#" class="btn btn-outline-success">
                            <i class="fa fa-file-excel-o"></i> Descargar
                        </a>

                    </div>
                </div>

            </div>

            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg">
                            <label class="form-label"> inputs</label>
                            <input class="form-control mb-4" placeholder="Input box" type="text">
                        </div>
                        <div class="col-lg">
                            <label class="form-label"> inputs</label>
                            <input class="form-control mb-4" placeholder="Input box" type="text">
                        </div>
                        <div class="col-lg">
                            <label class="form-label"> inputs</label>
                            <input class="form-control mb-4" placeholder="Input box" type="text">
                        </div>
                        <div class="col-lg "><br>
                           <a href="#" class="btn btn-primary"> 
                                <i class="fa fa-search"></i> Buscar
                            </a>
                           
                            <a href="#" class="btn btn-success"> 
                                <i class="fa fa-plus"></i> Nuevo
                            </a>
                        </div>

                    </div>

                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    Tabla
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
