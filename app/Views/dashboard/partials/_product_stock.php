<div class="col">
    <div class="row content-box <?= $product->availability ? '' : 'product-unvailable' ?>">

        <div class="col-lg-9 col-12 align-items-center">
            <div class="d-flex align-items-center">

                <!-- product image -->
                <div class="me-3">
                    <?php if (file_exists('assets/images/products/' . $product->image)) : ?>
                        <img class="img-fluid stock-image" src="<?= base_url('assets/images/products/' . $product->image) ?>" class="img-fluid" alt="<?= $product->image ?>">
                    <?php else : ?>
                        <img src="<?= base_url('assets/images/products/no_image.png') ?>" class="img-fluid stock-image" alt="No image">
                    <?php endif; ?>
                </div>

                <!-- product name and image -->
                <div class="">
                    <h4 class="mb-0">
                        <strong>
                            <?= $product->name ?>
                        </strong>
                    </h4>
                    <p class="mb-0"><?= $product->description ?></p>
                    <?php if (!$product->availability) : ?>
                        <span class="badge fs-5 bg-danger">Indisponível</span>
                    <?php else : ?>
                        <?php if ($product->stock <= $product->stock_min_limit) : ?>
                            <span class="badge bg-danger">Stock reduzido</span>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>


        <div class="col-lg-3 col-12 text-end align-self-center">
            <!-- current stock -->
            <div class="">
                <h5>Stock actual</h5>
                <h3 class="<?= $product->stock <= $product->stock_min_limit ? "text-danger" : "" ?>"><strong><?= $product->stock ?></strong></h3>
            </div>

        </div>
        <div class="col-12 text-end">
            <a href="<?= site_url('/stock/add/' . encrypt($product->id)) ?>" class="btn btn-outline-success btn-sm px-3 m-1 fw-bold "><i class="fa-solid fa-plus me-2"></i>Adicionar stock</a>
            <a href="<?= site_url('/stock/remove/' . encrypt($product->id)) ?>" class="btn btn-outline-danger btn-sm px-3 m-1 fw-bold "><i class="fa-solid fa-minus me-2"></i>Eliminar stock</a>
            <a href="<?= site_url('/stock/movement/' . encrypt($product->id)) ?>" class="btn btn-outline-secondary btn-sm px-3 m-1 fw-bold "><i class="fa-solid fa-right-left me-2"></i>Entradas e saídas</a>
        </div>
    </div>
</div>