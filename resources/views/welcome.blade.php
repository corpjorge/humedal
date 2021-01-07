@extends('layouts.app', [
  'class' => 'landing-page sidebar-collapse',
  'classPage' => '',
  'activePage' => '',
  'title' => env('APP_NAME'),
  'pageBackground' => asset("/img/login.jpg")
])

@section('content')

<div class="page-header header-filter clear-filter" data-parallax="true" style="background-image: url('{{ asset('/img/login.jpg') }}'); transform: translate3d(0px, 0px, 0px);">
    <div class="container">
      <div class="row">
        <div class="col-md-8 ml-auto mr-auto">
          <div class="brand">
            <h1>WEATHER</h1>
            <h3 class="title">API YAHOO</h3>
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
                        <h2 class="title">Ciudades</h2>
                        <h5 class="description">Clima actual {{date("l")}}</h5>
                    </div>
                </div> 

                <div  id="app" class="row justify-content-center">
                    <clima-component location="miami"   iframe-url="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d114964.3894384051!2d-80.29949833445895!3d25.78254531068484!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88d9b0a20ec8c111%3A0xff96f271ddad4f65!2sMiami%2C%20Florida%2C%20EE.%20UU.!5e0!3m2!1ses-419!2sco!4v1610050735681!5m2!1ses-419!2sco" ></clima-component>
                    <clima-component location="orlando" iframe-url="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d112222.13492454053!2d-81.43887829488561!3d28.481301846214564!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88e773d8fecdbc77%3A0xac3b2063ca5bf9e!2sOrlando%2C%20Florida%2C%20EE.%20UU.!5e0!3m2!1ses-419!2sco!4v1610050888183!5m2!1ses-419!2sco"></clima-component>
                    <clima-component location="newyork" iframe-url="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d193595.1583091352!2d-74.11976373946234!3d40.69766374859258!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNueva%20York%2C%20EE.%20UU.!5e0!3m2!1ses-419!2sco!4v1610050926929!5m2!1ses-419!2sco"></clima-component>

                    <a href="" class="btn btn-rose btn-raised btn-round">
                        Historial
                    </a>
                </div>  
            </div>
        </div>
    </div>
@endsection
