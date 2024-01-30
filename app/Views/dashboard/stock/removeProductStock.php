<?= $this->extend('layouts/_layout_master'); ?>

<?= $this->section('content'); ?>
<?= $this->include('layouts/partials/_page_title'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col content-box p-5">
            <div class="d-flex align-items-center">
                <!-- image -->
                <div class="me-3">
                    <?php if (file_exists('assets/images/products/' . $product->image)) : ?>
                        <img class="img-fluid stock-image" src="<?= base_url('assets/images/products/' . $product->image) ?>" alt="<?= $product->image ?>">
                    <?php else : ?>
                        <img src="<?= base_url('assets/images/products/no_image.png') ?>" class="img-fluid stock-image" alt="No image">
                    <?php endif; ?>

                </div>
                <!-- name and description -->
                <div class="flex-fill me-3">
                    <h4 class="mb-0"><strong> <?= $product->name ?></strong></h4>
                    <p class="mb-0"><?= $product->description ?></p>
                    <?php if (!$product->availability) : ?>
                        <span class="badge bg-danger">Indisponível</span>
                    <?php endif; ?>


                </div>
                <!-- current stock -->
                <div class="text-end">
                    <h5>Stock atual</h5>
                    <h3 class="<?= $product->stock <= $product->stock_min_limit ? 'text-danger' : '' ?>"><strong><?= $product->stock ?></strong></h3>
                </div>
            </div>
            <hr />
            <div class="row">
                <div class="col">
                    <?= form_open('/stock/remove-submit', ['novalidate' => true]) ?>
                    <input type="hidden" name="idProduct" value="<?= encrypt($product->id) ?>">
                    <input type="hidden" name="productName" value="<?= $product->name ?>">
                    <div class="row">
                        <div class="col-sm-2 col-6 mb-3">
                            <label for="textStock" class="form-label">Quantidade</label>
                            <input type="number" min='1' value="<?= old('textStock', 0) ?>" name="textStock" class="form-control text-end">
                            <?= displayError('textStock', $validationErrors) ?>
                        </div>
                        <div class="col-sm-2 col-6 mb-3 align-self-center text-end">
                            <p class="mb-0">Tipo de movimento</p>
                            <h5>Saí da de stock</h5>
                        </div>

                        <div class="row">

                        </div>

                        <div class="row">
                            <div class="col-sm-4 col-12 mb-3">
                                <label for="textDate" class="form-label">Data do movimento</label>
                                <input type="text" name="textDate" id="textDate" value="<?= old('textDate') ?>" class="form-control">
                                <?= displayError('textDate', $validationErrors) ?>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-8 col-12 mb-3">
                                <label for="textReason" class="form-label">Observações</label>
                                <input type="text" name="textReason" id="textReason" value="<?= old('textReason') ?>" class="form-control">
                                <?= displayError('textReason', $validationErrors) ?>


                            </div>
                        </div>
                        <div class="">
                            <a href="<?= site_url('/stock') ?>" class="btn btn-outline-secondary fw-bold px-5"><i class="fas fa-ban me-2"></i>Cancelar</a>
                            <button type="submit" class="btn btn-success fw-bold"><i class="fas fa-check me-2"></i>Registar saída</button>
                        </div>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>

        </div>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        flatpickr('#textDate', {
            dateFormat: 'Y-m-d H:i',
            time_24hr: true,
            enableTime: true,
            maxDate: 'today'
        })
    })

    let swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success me-3",
            cancelButton: "btn btn-danger"
        },
        buttonsStyling: false
    });


    <?php if ($success) : ?>
        Swal.fire({
            title: '<?= $success['title'] ?>',
            html: "<p class='fs-3'><?= $success['text'] ?></strong>!</p>",
            icon: '<?= $success['icon'] ?>',
        }).then(() => {
            window.location = '<?= site_url('/stock') ?>'
        })

    <?php endif; ?>


    <?php if ($serverError) : ?>
        Swal.fire({
            title: 'Oops!',
            html: "<p class='fs-3'><strong><?= $serverError ?></strong></p>",
            icon: 'error',
        })
    <?php endif; ?>
</script>

<?= $this->endSection(); ?>