<!-- topbar -->
<?php echo $this->section('styles'); ?>
<link rel="stylesheet" href="<?= base_url('assets/libs/sweetalert2-11/sweetalert.min.css') ?>">
<?php echo $this->endSection(); ?>
<header class="top-bar d-flex justify-content-between align-items-center p-2">
    <div class="d-flex">
        <div class="btn-main-menu me-3"><i class="fa-solid fa-bars"></i></div>
        <a href="<?= site_url('/') ?>"></a:ref>
            <img class="img-fluid top-bar_image" width="52px" src="<?php echo base_url("assets/images/logo.png") ?>" alt="Logo CigBurger Backoffice">
    </div>

    <div class="">
        <i class="fa-regular fa-user me-3"></i><?= session()->user['name'] ?>
        <i class="fa-solid fa-ellipsis-vertical mx-3"></i>
        <a class="me-3 btnLogout" href="<?= site_url('/auth/logout') ?>"><i class="fa-solid fa-arrow-right-from-bracket me-3"></i>sair</a>
    </div>
    <?php echo $this->section('scripts'); ?>
    <script src="<?= base_url('assets/libs/sweetalert2-11/sweetalert.js') ?>"></script>
    <script>
        let btnLogout = document.querySelector('.btnLogout');

        btnLogout.addEventListener('click', (e) => {
            e.preventDefault();

            let swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "btn btn-success me-3",
                    cancelButton: "btn btn-danger"
                },
                buttonsStyling: false
            });

            swalWithBootstrapButtons.fire({
                title: "Sair?",
                html: "<p class='fs-3'>Deseja terminar a sessão <br/><strong><?= session()->user['name'] ?></strong> !</p>",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "SIM, sair",
                cancelButtonText: "Cancelar",
                // reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    console.log(result, "<?= site_url('/auth/logout') ?>");
                    $.ajax({
                        url: "<?= site_url('/auth/logout') ?>",
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        success: function() {
                            location.reload()
                        }
                    })

                    // fetch("<?= site_url('/auth/logout') ?>", {
                    //     method: 'GET',
                    //     headers: {
                    //         "Content-Type": "application/json",
                    //         "X-Requested-With": "XMLHttpRequest"
                    //     }
                    // }).then(() => {
                    //     // location.reload()
                    // })
                }
            });
        })
    </script>
    <?php echo $this->endSection(); ?>

</header>