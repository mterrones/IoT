@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="col-lg-12">
                        <div class="row">
                            <form class="form-inline" action="{{url('/newToken')}}">
                                <div class="form-group">
                                <input class="form-control" type="text" value="@if(isset($token)) {{$token}} @endif" disabled>
                                    <button class="btn btn-success m-1">Generar token</button>
                                </div>
                            </form>
                        </div>
                        <br>
                        <div class="row">
                            <label for="">Eventos:</label>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td>Descripción</td>
                                        <td>Destino</td>
                                        <td>Hora</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datas as $data)
                                        <tr>
                                            <td>{{$data->description}}</td>
                                            <td>{{$data->to}}</td>
                                            <td>{{$data->created_at}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
