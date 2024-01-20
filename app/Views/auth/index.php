<?php echo $this->extend('layouts/_layout_auth'); ?>

<?php echo $this->section('content'); ?>

<div class="login-box">
    <div class="text-center mb-3">
        <img src="<?php echo base_url("assets/images/logo.png") ?>" alt="Logo">
    </div>


    <form action="#" method="post">
        <div class="mb-3">

            <p class="mb-2">Restaurante</p>
            <select class="form-select" name="select-restaurant" id="select-restaurant">
                <option value=""></option>
                <option value="">Restaurante 1</option>
                <option value="">Restaurante 2</option>
                <option value="">Restaurante 3</option>
            </select>
        </div>
        <hr />
        <div class="mb-3">

            <input class="form-control" type="text" id="text-username" name="text-username" placeholder="Email">
        </div>

        <div class="mb-3">
            <input class="form-control" type="text" id="text-password" name="text-password" placeholder="Senha">
        </div>
        <div class="mb-3">

            <input class="btn-login px-4" type="submit" value="ENTRAR">
        </div>
        <hr />
        <div class="text-center">

            <p>Esqueceu-se da senha? <a class="login-link" href="#">Recuperar senha</a></p>
            <p>Não tem conta? <a class="login-link" href="#">Cadastre-se</a></p>
        </div>
    </form>
</div>

<?php echo $this->endSection(); ?>