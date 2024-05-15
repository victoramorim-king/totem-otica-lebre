@extends('layouts.app')

@section('content')
<div class="container">


    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <section class="section-container">

            <!-- MENUS -->
            <div class="disabled-title-container">
                <p>Menus</p>
            </div>
            <div class="disabled-content-container menusDesativados"> </div>

            <!-- LENTES -->
            <div class="disabled-title-container">
                <p>Lentes</p>
            </div>
            <div class="disabled-content-container lentesDesativadas"> </div>

            <!-- VIDEOS -->
            <div class="disabled-title-container">
                <p>Videos</p>
            </div>
            <div class="disabled-content-container videosDesativados"></div>

        </section>
    </div>
    @endsection