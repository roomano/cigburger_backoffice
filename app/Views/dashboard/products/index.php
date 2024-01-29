<?= $this->extend('layouts/_layout_master'); ?>

<?= $this->section('content'); ?>
<?= $this->include('layouts/partials/_page_title'); ?>

<div class="mb-3">
    <a href="<?= site_url('/products/new') ?>" class="btn btn-outline-secondary fw-bold text-dark "><i class="fa-solid fa-plus me-2"></i>Novo produto</a>
</div>
<!-- product list -->
<div class="text-center mt-5">
    <?php if (!empty($products)) : ?>
        <div class="container-fluid mb-5">
            <div class="row">
                <?php foreach ($products as $product) : ?>
                    <?= view('dashboard/partials/_product', ['product' => $product]) ?>
                <?php endforeach; ?>
            </div>
        </div>



    <?php else : ?>
        <h3 class="opacity-50 mb-3">Não existem produtos disponíveis</h3>
        <span class="fs-5">Clique <a href="<?= site_url('/products/new') ?>">aqui</a> para adicionar o primeiro produto do restaurante</span>
    <?php endif; ?>
</div>
<?= $this->endSection(); ?>