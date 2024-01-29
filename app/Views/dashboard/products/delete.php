<?= $this->extend('layouts/_layout_master'); ?>

<?= $this->section('content'); ?>
<?= $this->include('layouts/partials/_page_title'); ?>

<div class="d-flex content-box">
    <div class="p-3">
        <img class="img-fluid" src="<?= base_url('assets/images/products/' . $product->image) ?>" alt="product image">
    </div>
    <div class="p-3">
        <h3 class="text-black mb-3"> <strong><?= $product->name ?></strong> </h3>
        <p class="text-secondary mb-3"><?= $product->description ?></p>
        <p class="text-danger mb-3 fw-bold">Tem a certeza que deseja eliminar o produto?<br />É um processo irreversível</p>
        <div class="d-flex gap-3">
            <a href="<?= site_url('/products') ?>" class="btn btn-outline-secondary px-5"><i class="fas fa-ban me-2"></i>Cancelar</a>
            <a href="#" class="btn btn-danger btnDelete px-5"><i class="fas fa-trash me-2"></i>Eliminar</a>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<script>
    let btnDelete = document.querySelector('.btnDelete');
    btnDelete.addEventListener('click', function(e) {
        e.preventDefault();

        let swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-success me-3",
                cancelButton: "btn btn-danger"
            },
            buttonsStyling: false
        });

        swalWithBootstrapButtons.fire({
            title: "Eliminar?",
            html: "<p class='fs-3'>Eliminar<br/><strong><?= $product->name ?></strong> !</p>",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "SIM, eliminar",
            cancelButtonText: "Cancelar",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= site_url('/products/delete-submit/' . encrypt($product->id)) ?>",
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    type: 'DELETE',
                    success: function(data) {
                        data = JSON.parse(data);

                        Swal.fire({
                            title: data.title,
                            text: data.text,
                            icon: data.icon

                        }).then(() => {
                            window.location.href = '<?= site_url('/products') ?>';
                        })
                    },
                    error: function(data) {
                        data = JSON.parse(data);

                        Swal.fire({
                            title: data.title ?? "Erro ao eliminar o produto!",
                            text: data.text ?? "Tente novamente!",
                            icon: data.status
                        }).then(() => {
                            window.location.href = '<?= site_url('/products') ?>';
                        })
                    }
                })
            }
        });

    });
</script>
<?= $this->endSection(); ?>