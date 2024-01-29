<!-- main menu -->
<nav class="main-menu p-2">
    <p class="menu-group mb-3"><?= session()->user['restaurantName'] ?></p>
    <a href="<?= site_url('/products') ?>"><i class="fa-solid fa-burger me-2"></i>Produtos</a>
    <a href="<?= site_url('/stock') ?>"><i class="fa-solid fa-cubes-stacked me-2"></i>Stock</a>
    <!--
    <a href=""><i class="fa-solid fa-chart-line me-2"></i>Dados estatísticos</a> -->
</nav>