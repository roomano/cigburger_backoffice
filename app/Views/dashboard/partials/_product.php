<div class="col-xxl-6 col-12 ">
    <div class="content-box shadow overflow-hidden <?= $product->availability ? '' : 'product-unvailable' ?>">
        <div class="d-flex">
            <div>
                <?php if (file_exists('assets/images/products/' . $product->image)) : ?>
                    <img src="<?= base_url('assets/images/products/' . $product->image) ?>" class="img-fluid" alt="<?= $product->image ?>">
                <?php else : ?>
                    <img src="<?= base_url('assets/images/products/no_image.png') ?>" class="img-fluid" alt="No image">
                <?php endif; ?>
            </div>
            <div class="ms-4 w-100">
                <h3 class="m-0"><strong><?= $product->name ?></strong></h3>
                <p class="m-0"><?= $product->description ?></p>
                <p class="m-0 opacity-50"><?= $product->category ?></p>
                <?php if ($product->promotion == 0) : ?>
                    <h3 class="m-0 text-primary"><strong><?= formatPrice($product->price) . 'MZN' ?></strong></h3>
                <?php else : ?>
                    <h3 class="m-0"><span class="text-muted text-decoration-line-through"><?= formatPrice($product->price) . 'MZN' ?></span>/<span class="text-primary"><strong><?= formatPrice(calculatePromotion($product->price, $product->promotion)) . 'MZN' ?></strong></span></h3>
                <?php endif; ?>

                <div class="my-2">
                    <?php if (!$product->availability) : ?>
                        <span class="badge fs-4 bg-danger">Produto indisponível</span>
                    <?php else : ?>
                        <!-- promotion -->
                        <?php if ($product->promotion > 0) : ?>
                            <span class="badge bg-success">(Com promoção de <?= intval($product->promotion) ?> %)</span>
                        <?php endif; ?>
                        <!-- stock -->
                        <span class="badge bg-dark">
                            <?= $product->stock ?>
                            <?= $product->stock == 1 ? 'unidade' : 'unidades' ?>
                        </span>
                        <?php if ($product->stock <= $product->stock_min_limit) : ?>
                            <span class="badge bg-danger">Stock reduzido</span>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>



                <div class="text-end align-items-bottom">
                    <a href="<?= site_url('/products/edit/' . encrypt($product->id)) ?>" class="btn btn-sm btn-outline-secondary px-3 m-1"><i class="fa-regular fa-pen-to-square me-2"></i>Editar</a>
                    <a href="<?= site_url('/stock/movement/' . encrypt($product->id)) ?>" class="btn btn-sm btn-outline-secondary px-3 m-1"><i class="fa-solid fa-cubes-stacked me-2"></i>Stock</a>
                    <a href="<?= site_url('/products/delete/' . encrypt($product->id)) ?>" class="btn btn-sm btn-outline-secondary px-3 m-1"><i class="fa-regular fa-trash-can me-2"></i>Eliminar</a>
                </div>
            </div>

        </div>
    </div>

</div>