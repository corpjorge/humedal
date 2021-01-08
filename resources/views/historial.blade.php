@extends('layouts.app', [
  'class' => 'landing-page sidebar-collapse',
  'classPage' => '',
  'activePage' => '',
  'title' => env('APP_NAME'),
  'pageBackground' => asset("/img/login.jpg")
])

@section('content')

<div class="page-header header-filter clear-filter" data-parallax="true" style="background-image: url('{{ asset('/img/bg-pricing.jpg') }}'); transform: translate3d(0px, 0px, 0px);">
    <div class="container">
      <div class="row">
        <div class="col-md-8 ml-auto mr-auto">
          <div class="brand">
            <h1>WEATHER</h1>
            <h3 class="title">Historial</h3>
          </div>
        </div>
      </div>
    </div>
  </div>
     
{{-- End Head  --}}

 

    <div class="main main-raised">
        <div class="container">
            <div class="section text-center">
                <div class="row">
                    <div class="col-md-8 ml-auto mr-auto">
                        <h2 class="title">Historial</h2>
                        <h5 class="description">Datos de clima históricos</h5>
                    </div>
                </div> 

                <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-rose card-header-icon" style="background: linear-gradient(60deg, #fa5527, #fa5527);">
                  <div class="card-icon">
                    <i class="material-icons">assignment</i>
                  </div>
                  <h4 class="card-title">Historial</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th class="text-center">#</th>                     
                          <th>Ciudad</th>
                          <th>Humedad</th>
                          <th>Viento</th>
                          <th>Máximo</th>
                          <th>Bajo</th>
                          <th class="text-right">Fecha</th>
                        </tr>
                      </thead>
                      <tbody>                         
                      @foreach ($records as $record)            
                        <tr>
                          <td class="text-center">{{$record->id}}</td>
                          <td>{{$record->city}}</td>     
                          <td>{{$record->humedad}}</td>     
                          <td>{{$record->viento}}</td>     
                          <td>{{$record->alta}}</td>     
                          <td>{{$record->baja}}</td>     
                          <td class="text-right">{{$record->created_at}}</td>
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
