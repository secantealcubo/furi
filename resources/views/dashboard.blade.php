@extends('layouts.master')
@section('css')
@endsection
@section('head')
@endsection
@section('content')
<div>
    <!-- HEADER -->
    <div class="header">
       <div class="container-fluid">
          <!-- Body -->
          <div class="header-body">
             <div class="row align-items-end">
                <div class="col">
                   <!-- Pretitle -->
                   <h6 class="header-pretitle text-secondary">
                      {{ config('app.name') }}
                   </h6>
                   <!-- Title -->
                   <h1 class="header-title">
                      Inicio
                   </h1>
                </div>
             </div>
             <!-- / .row -->
          </div>
          <!-- / .header-body -->
       </div>
    </div>
    <!-- / .header -->
    <!-- CARDS -->
    <div class="container-fluid">
       <div class="row">
          <div class="col-12 col-xl-12">
             <div class="row">
                @if(\Auth::user()->can('ver usuarios'))
                <div class="col-12 col-lg-6 col-xl">
                   <!-- Hours -->
                   <a href="{{ url('/usuarios') }}">
                   <div class="card">
                      <div class="card-body">
                         <div class="row align-items-center">
                            <div class="col text-center">
                               <span class="h1 fe-solid fe fe-users text-muted mb-3"></span>
                               <h4 class="card-title">
                                  Usuarios
                               </h4>
                            </div>
                         </div>
                      </div>
                   </div>
                   </a>
                </div>
                @endif
                @if(\Auth::user()->can('ver roles'))
                <div class="col-12 col-lg-6 col-xl">
                   <!-- Hours -->
                   <a href="{{ url('/roles') }}">
                   <div class="card">
                      <div class="card-body">
                         <div class="row align-items-center">
                            <div class="col text-center">
                               <span class="h1 fe-solid fe fe-book text-muted mb-3"></span>
                               <h4 class="card-title">
                                  Roles
                               </h4>
                            </div>
                         </div>
                      </div>
                   </div>
                   </a>
                </div>
                @endif
             </div>
          </div>
       </div>
    </div>
 </div>
@section('js')
@endsection
@endsection