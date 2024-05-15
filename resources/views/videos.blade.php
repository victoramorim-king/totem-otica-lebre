@extends('layouts.app')

@section('content')
<div class="container">
    <!-- TELA DE EDIÇÃO DE BOTÕES -->

    <div class="divider-screen">
        <div class="content">
            <!-- CRIAR E LIMPAR BOTÃO -->
            <a class="editable-btn create-and-clear-buttons">
                <div class="button-grid">
                    <div class="add-video-btn">
                        <button class="add-image-button">
                            <div class="button-content">
                                <p>+</p>
                                <p>Video</p>
                            </div>
                        </button>
                        <input type="file" id="image-input" style="display: none;">
                    </div>
                </div>
            </a>
            <div class="create-and-clear-buttons action-btn-container">
                <button class="clear-button create-button">Limpar</button>
                <button class="add-button create-button" id="adicionarVideo">Adicionar</button>
            </div>

            <!-- ALTERAR E DESATIVAR BOTÃO -->
            <video class="galery-videos change-and-disable-buttons mudarLink" muted src=""></video>

            <div class="change-and-disable-buttons action-btn-container" style="display: none;">
                <button class="create-button green-button" id="desativar">Desativar</button>
                <button class="create-button green-button voltar">Voltar</button>
            </div>

        </div>
        <!-- TELA DO TOTEM -->

        <section class="container">
            <div class="title-container">
                <p class="title">Videos</p>
            </div>
            <div class="grid-container listarVideos"></div>
        </section>
    </div>
</div>
@endsection