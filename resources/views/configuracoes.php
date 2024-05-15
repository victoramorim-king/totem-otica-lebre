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
            <p class="profile-text">Meu perfil</p>
            <p class="user-text">Dados do usuário</p>
            <div class="config-container">
                <div class="circle">
                    <p class="letter">
                        R
                    </p>
                    <button id="open-image">
                        <img src="../images/camera.png" />
                    </button>
                    <input type="file" id="image-input" style="display: none;">
                </div>
            </div>
            <div class="grid-forms-container">
                <form action="#" method="post">
                    <div class="form-group">
                        <label for="nome" class="label">Nome</label>
                        <input type="text" id="nome" name="nome" class="input" required>
                    </div>
                    <div class="form-group">
                        <label for="email" class="label">Email</label>
                        <input type="email" id="email" name="email" class="input" required>
                    </div>
                    <div class="form-group">
                        <label for="dataNascimento" class="label">Data de Nascimento</label>
                        <input type="date" id="dataNascimento" class="input" name="dataNascimento">
                    </div>
                    <div class="form-group">
                        <label for="celular" class="label">Celular</label>
                        <input type="tel" id="celular" name="celular" class="input">
                    </div>
                    <div class="form-group">
                        <label for="endereco" class="label">Endereço</label>
                        <input type="text" id="endereco" name="endereco" class="input">
                    </div>
                    <button class="save-btn" type="submit">Salvar</button>
                </form>
                <form>
                    <p class="password-subtitle">ALTERAR SENHA</p>
                    <div class="form-group">
                        <label for="senha" class="label">Nova Senha</label>
                        <input type="password" id="nova-senha" name="nova-senha" required class="input" />
                    </div>
                    <div class="form-group">
                        <label for="senha" class="label">Confirmar Senha</label>
                        <input type="password" id="confirmar-senha" name="confirmar-senha" required class="input" />
                    </div>
                    <button class="save-btn" type="submit">Salvar</button>
                </form>
            </div>
            <div>

            </div>
        </section>
    </div>
    @endsection