@extends('layouts.app')

@section('content')
<div class="container">


    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <div class="divider-screen">
            <div class="content">
                <!-- CRIAR E LIMPAR BOTÃO -->
                <a class="editable-btn create-and-clear-buttons">
                    <div class="button-grid">
                        <div class="image-container-smaller">
                            <button class="add-image-button">
                                <div class="button-content">
                                    <p>+</p>
                                    <p>Ícone</p>
                                </div>
                            </button>
                            <input type="file" id="image-input" style="display: none;">
                        </div>
                        <div class="text-container">
                            <input class="text-button input-title" id="titulo" name="titulo" type="text"
                                placeholder="Título" />
                        </div>
                    </div>
                </a>
                <div class="create-and-clear-buttons action-btn-container">
                    <button class="clear-button create-button">Limpar</button>
                    <button class="add-button create-button" id="adicionarMenu">Adicionar</button>
                </div>

                <!-- ALTERAR E DESATIVAR BOTÃO -->
                <a class="button change-and-disable-buttons" style="display: none;">
                    <div class="button-grid">
                        <div class="image-container-smaller">
                            <img src="" />
                        </div>
                        <div class="text-container">
                            <input class="text-button input-title" id="tituloAlterar" type="text"
                                placeholder="Título" />
                        </div>
                    </div>
                </a>
                <div class="change-and-disable-buttons action-btn-container" style="display: none;">
                    <button class="create-button green-button" id="alterar">Alterar</button>
                    <button class="create-button green-button" id="desativar">Desativar</button>
                </div>
                <div class="change-and-disable-buttons action-btn-container" style="display: none;">
                    <button class="create-button green-button voltar">Voltar</button>
                </div>


            </div>
            <!-- TELA DO TOTEM -->

            <section class="container">
                <img src="{{ asset('/images/admin/logo.png') }}" id="logo" />

                <nav class="button-group">
                </nav>
            </section>
        </div>
    </div>
@endsection