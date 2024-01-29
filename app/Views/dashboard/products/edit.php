<?= $this->extend('layouts/_layout_master'); ?>

<?= $this->section('content'); ?>
<?= $this->include('layouts/partials/_page_title'); ?>


<div class="content-box">
    <?php if ($serverError) : ?>
        <div class="row">
            <div class="col">
                <div class="alert alert-danger p-2">
                    <i class="fa-solid fa-triangle-exclamation me-2"></i><?= $serverError ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?= form_open_multipart('products/edit-submit', ['novalidate' => true]) ?>
    <input type="hidden" name="idProduct" value="<?= encrypt($product->id) ?>">

    <div class="row">

        <div class="col-lg-4 col-12 px-5 pt-5">

            <!-- image -->
            <div class="text-center">
                <img class="product-image img-fluid" id="productImage" src="<?= site_url('assets/images/products/' . $product->image) ?>">
            </div>

            <!-- file upload -->
            <div class="mt-3 text-start">
                <label for="fileImage" class="form-label">Imagem do produto</label>
                <div class="input-group mb-3">
                    <input type="file" name="fileImage" id="fileImage" class="form-control" accept="image/png">
                    <button class="btn btn-outline-secondary" id='removeImage' type="button"><i class="fa-solid fa-x"></i></button>
                </div>
            </div>
            <?= displayError('fileImage', $fileError) ?>
        </div>

        <div class="col-lg-6 col-12 p-5">

            <!-- name -->
            <div class="mb-3">
                <label for="textName" class="form-label">Nome do produto</label>
                <input type="text" name="textName" id="textName" class="form-control" placeholder="Nome do produto" value="<?= old('textName', $product->name) ?>">
                <?= displayError('textName', $validationErrors) ?>
            </div>

            <!-- description -->
            <div class="mb-3">
                <label for="textDescription" class="form-label">Descrição do produto</label>
                <input type="text" name="textDescription" id="textDescription" class="form-control" placeholder="Descrição do produto" value="<?= old('textDescription', $product->description) ?>">
                <?= displayError('textDescription', $validationErrors) ?>

            </div>

            <!-- category and price -->
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="mb-3">
                        <label for="textCategory" class="form-label">Categoria</label>
                        <input list="textCategories" name="textCategory" id="textCategory" class="form-control" placeholder="Categoria" value="<?= old('textCategory', $product->category) ?>">
                        <?= displayError('textCategory', $validationErrors) ?>

                        <datalist id="textCategories">
                            <?php foreach ($categories as $category) : ?>
                                <option value="<?= $category->category ?>">
                                <?php endforeach; ?>
                        </datalist>
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="mb-3">
                        <label for="textPrice" class="form-label">Preço</label>
                        <input type="text" name="textPrice" id="textPrice" class="form-control" placeholder="Preço" value="<?= old('textPrice', preg_replace("/\./", ",", $product->price)) ?>">
                        <?= displayError('textPrice', $validationErrors) ?>

                    </div>
                </div>
            </div>

            <!-- available and promotion -->
            <div class="row">
                <div class="col-lg-6 col-12 align-self-center mb-3">
                    <input type="checkbox" name="checkAvailable" id="checkAvailable" <?= $product->availability ? 'checked' : '' ?>>
                    <label for="checkAvailable" class="form-label">Produto disponível.</label>
                </div>
                <div class="col-lg-6 col-12 mb-3">
                    <label for="textPromotion" class="form-label">Promoção</label>
                    <input type="text" name="textPromotion" id="textPromotion" class="form-control" placeholder="Promoção" value="<?= old('textPromotion', intval($product->promotion)) ?>">
                    <?= displayError('textPromotion', $validationErrors) ?>

                </div>
            </div>

            <!-- stock minimum limit -->
            <div class="row">
                <div class="col-lg-6 col-12 mb-3">
                    <label for="textStockMinimumLimit" class="form-label">Limite mínimo de estoque</label>
                    <input type="text" name="textStockMinimumLimit" id="textStockMinimumLimit" class="form-control" placeholder="Limite mínimo de estoque" value="<?= old('textStockMinimumLimit', $product->stock_min_limit) ?>">
                    <?= displayError('textStockMinimumLimit', $validationErrors) ?>

                </div>

            </div>

        </div>

        <!-- submit -->
        <div class="row">
            <div class="col px-5 pb-5">
                <a href="<?= site_url('/products') ?>" class="btn btn-outline-secondary px-5 fw-bold"><i class="fas fa-ban me-2"></i>Cancelar</a>
                <button type="submit" class="btn btn-outline-success px-5 fw-bold"><i class="fas fa-check me-2 "></i>Editar produto</button>
            </div>
        </div>

        <?= form_close() ?>
    </div>


</div>

<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<script>
    const productImage = document.querySelector('#productImage');
    let fileInput = document.querySelector('#fileImage');
    let file;
    let reader = new FileReader();
    reader.onloadend = function() {
        productImage.src = reader.result;
    }

    fileInput.addEventListener('change', function() {
        file = this.files[0];

        if (file) {
            reader.readAsDataURL(file)
        } else {
            // productImage.removeAttribute('src')
            productImage.src = '<?= site_url('assets/images/products/no_image.png') ?>';
        }
    })
    document.querySelector('#removeImage').addEventListener('click', function(e) {
        e.preventDefault()
        if (file) {
            productImage.src = '<?= site_url('assets/images/products/' . $product->image) ?>';
            clearFileInput(fileInput);
        }
    })

    <?php if (!empty($message)) : ?>

        let swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "fw-bold btn btn-success me-3",
                cancelButton: "fw-bold btn btn-outline-secondary"
            },
            buttonsStyling: false
        });

        swalWithBootstrapButtons.fire({
            title: "Produto atualizado!",
            html: "<p class='fs-3'><strong><?= $message ?></strong>, atualizado ao stock!</p>",
            icon: "success",
            showCancelButton: true,
            confirmButtonText: "Listar produtos",
            cancelButtonText: 'Continuar a editar'

        }).then((result) => {
            if (result.isConfirmed) {

                window.location.href = '<?= site_url('/products') ?>';
            }

        });
    <?php endif; ?>

    function clearFileInput(fileInput) {
        try {
            fileInput.value = null;
        } catch (ex) {}

        if (fileInput.value) {
            fileInput.parentNode.replaceChild(fileInput.cloneNode(true), fileInput);
        }
    }
</script>
<?= $this->endSection(); ?>