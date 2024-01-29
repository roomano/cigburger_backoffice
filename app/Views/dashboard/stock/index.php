<?= $this->extend('layouts/_layout_master'); ?>

<?= $this->section('content'); ?>
<?= $this->include('layouts/partials/_page_title'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col">

            <?php if (!empty($products)) : ?>

                <!-- <head>Produtos</head> -->
                <?php foreach ($products as $product) : ?>
                    <?= view('dashboard/partials/_product_stock', ['product' => $product]) ?>
                <?php endforeach; ?>
            <?php else : ?>
                <div class="text-center">

                    <h3 class="opacity-50 mb-3">Não existem produtos disponíveis</h3>
                    <span class="fs-5">Clique <a href="<?= site_url('/products/new') ?>">aqui</a> para adicionar o primeiro produto do restaurante</span>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>

<?= $this->endSection(); ?>