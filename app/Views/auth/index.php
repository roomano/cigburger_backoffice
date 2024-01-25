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
                <?php
                $selected = '';
                if (!empty($selectRestaurant) && $selectRestaurant == $restaurant->id) {
                    $selected = 'selected';
                }
                ?>
                <option value="<?= encrypt($restaurant->id) ?>" <?= $selected ?>><?= $restaurant->name ?></option>
            <?php endforeach; ?>
        </select>
        <?= displayError('selectRestaurant', $validationErrors) ?>
    </div>
    <hr />
    <div class="mb-3">

        <input class="form-control" type="text" id="textUsername" name="textUsername" placeholder="Usuário" value="<?= old('textUsername') ?>">
        <?= displayError('textUsername', $validationErrors) ?>
    </div>

    <div class="mb-3">
        <div class="input-group mb-3">
            <input class="form-control" type="password" id="textPasswrd" name="textPasswrd" placeholder="Senha" value="<?= old('textPasswrd') ?>">

            <button class="btn btn-light" id='btnTooglePasswrdVisibility' type="button"><i class="fa-regular fa-eye"></i><i class="fa-regular fa-eye-slash d-none"></i></button>
        </div>
        <?= displayError('textPasswrd', $validationErrors) ?>
    </div>
    <div class="mb-3">

        <input class="btn-login px-4" type="submit" value="ENTRAR">
    </div>
    <?php if (!empty($loginError)) : ?>
        <div class="alert text-center p-1 bg-danger text-white">
            <?= $loginError ?>
        </div>
    <?php endif; ?>
    <?= form_close() ?>
    <hr />
    <div class="text-center">

        <p>Esqueceu-se da senha? <a class="login-link" href="#">Recuperar senha</a></p>
        <p>Não tem conta? <a class="login-link" href="#">Cadastre-se</a></p>
    </div>
    <div class="row selectUsers"></div>
</div>

<?php echo $this->endSection(); ?>

<?php echo $this->section('scripts'); ?>
<script>
    let tooglePasswrdVisibility = document.querySelector('#btnTooglePasswrdVisibility');
    let passwrdInput = document.querySelector('#textPassword');
    let iconEyeShow = document.querySelector('.fa-eye');
    let iconEyeHide = document.querySelector('.fa-eye-slash');

    let wrapper = document.querySelector('.selectUsers');
    let loginData = [{
            username: 'admin_rest1',
            passwrd: 'admin_rest1',
            restaurant: 1,
        },
        {
            username: 'user_rest1',
            passwrd: 'user_rest1',
            restaurant: 1,
        },
        {
            username: 'admin_rest2',
            passwrd: 'admin_rest2',
            restaurant: 2,
        },
        {
            username: 'user_rest2',
            passwrd: 'user_rest2',
            restaurant: 2,
        },
        {
            username: 'admin_rest3',
            passwrd: 'admin_rest3',
            restaurant: 3,
        },
        {
            username: 'user_rest3',
            passwrd: 'user_rest3',
            restaurant: 3,
        },
    ];

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

    const select = document.createElement('select');
    const a = document.createElement('option');
    a.innerText = 'Login rápido';
    select.appendChild(a);
    select.setAttribute('name', 'selectLogin');
    select.classList.add('form-control-sm')
    loginData.forEach((item, index) => {
        const option = document.createElement('option');
        option.setAttribute('value', index);
        option.innerText = `Restaurante ${item.restaurant} - ${item.username}`;
        select.appendChild(option);
    });

    wrapper.appendChild(select);

    select.addEventListener('change', (e) => {
        const index = e.target.value;
        if (index === '' || index.length > 1) return;
        const userName = loginData[index].username;
        const passwrd = loginData[index].passwrd;
        const restaurant = loginData[index].restaurant;

        document.querySelector('#textUsername').value = userName;
        document.querySelector('#textPasswrd').value = passwrd;
        document.querySelector('#selectRestaurant').selectedIndex = restaurant;
    })
</script>
<?php echo $this->endSection(); ?>