<?php echo $this->extend('layouts/_layout_auth'); ?>

<?php echo $this->section('content'); ?>

<div class="login-box">
    <div class="text-center mb-3">
        <img src="<?php echo base_url("assets/images/logo.png") ?>" alt="Logo">
    </div>

    <?= form_open('/auth/login-submit') ?>
    <div class="mb-3">

        <p class="mb-2">Restaurante</p>
        <select class="form-select" name="selectRestaurant" id="selectRestaurant">
            <option value=""></option>
            <?php foreach ($restaurants as $restaurant) : ?>
                <option value="<?= encrypt($restaurant->id) ?>"><?= $restaurant->name ?></option>
            <?php endforeach; ?>
        </select>
        <?php if (isset($validationErrors['selectRestaurant'])) : ?>
            <div class="text-white bg-danger ps-1 mt-2 rounded">
                <span><?= $validationErrors['selectRestaurant'] ?></span>
            </div>
        <?php endif; ?>
    </div>
    <hr />
    <div class="mb-3">

        <input class="form-control" type="text" id="textUsername" name="textUsername" placeholder="Usuário" value="<?= old('textUsername') ?>">
        <?php if (isset($validationErrors['textUsername'])) : ?>
            <div class="text-white bg-danger ps-1 mt-2 rounded">
                <span><?= $validationErrors['textUsername'] ?></span>
            </div>
        <?php endif; ?>
    </div>

    <div class="mb-3">
        <div class="input-group mb-3">
            <input class="form-control" type="password" id="textPassword" name="textPasswrd" placeholder="Senha" value="<?= old('textPasswrd') ?>">

            <button class="btn btn-light" id='btnTooglePasswrdVisibility' type="button"><i class="fa-regular fa-eye"></i><i class="fa-regular fa-eye-slash d-none"></i></button>

        </div>
        <?php if (isset($validationErrors['textPasswrd'])) : ?>
            <div class="text-white bg-danger ps-1 mt-2 rounded">
                <span><?= $validationErrors['textPasswrd'] ?></span>
            </div>
        <?php endif; ?>
    </div>
    <div class="mb-3">

        <input class="btn-login px-4" type="submit" value="ENTRAR">
    </div>
    <hr />
    <div class="text-center">

        <p>Esqueceu-se da senha? <a class="login-link" href="#">Recuperar senha</a></p>
        <p>Não tem conta? <a class="login-link" href="#">Cadastre-se</a></p>
    </div>
    <?= form_close() ?>
</div>

<?php echo $this->endSection(); ?>

<?php echo $this->section('scripts'); ?>
<script>
    let tooglePasswrdVisibility = document.querySelector('#btnTooglePasswrdVisibility');
    let passwrdInput = document.querySelector('#textPassword');
    let iconEyeShow = document.querySelector('.fa-eye');
    let iconEyeHide = document.querySelector('.fa-eye-slash');

    tooglePasswrdVisibility.addEventListener('click', (e) => {
        e.preventDefault()
        if (passwrdInput.type === 'password') {
            passwrdInput.type = 'text'
            iconEyeShow.classList.add('d-none')
            iconEyeHide.classList.remove('d-none')

        } else {

            passwrdInput.type = 'password'
            iconEyeShow.classList.remove('d-none')
            iconEyeHide.classList.add('d-none')
        }
    });
</script>
<?php echo $this->endSection(); ?>