<?= $this->extend('layouts/_layout_master'); ?>

<?= $this->section('styles'); ?>
<link rel="stylesheet" href="<?= base_url('assets/libs/datatables/datatables.min.css') ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<?= $this->include('layouts/partials/_page_title'); ?>
<?php if (previous_url() != current_url()) : ?>
    <div class="mb-3">
        <a href="<?= previous_url() ?>" class="btn btn-outline-secondary fw-bold text-dark "><i class="fa-solid fa-arrow-left me-2"></i>voltar</a>
    </div>
<?php endif; ?>
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
            <div class="my-3 d-flex gap-5">
                <div class="row">

                    <div class="col-auto">
                        <a href="<?= site_url('/stock/add/' . encrypt($product->id)) ?>" class="btn btn-outline-success btn-sm px-3 m-1 fw-bold "><i class="fa-solid fa-plus me-2"></i>Adicionar stock</a>
                        <a href="<?= site_url('/stock/remove/' . encrypt($product->id)) ?>" class="btn btn-outline-danger btn-sm px-3 m-1 fw-bold "><i class="fa-solid fa-minus me-2"></i>Eliminar stock</a>
                        <a href="<?= site_url('/products/edit/' . encrypt($product->id)) ?>" class="btn btn-outline-secondary btn-sm px-3 m-1 fw-bold "><i class="fa-solid fa-pen-to-square me-2"></i>Editar produto</a>
                    </div>

                    <div class="col-auto d-inline-flex align-items-center gap-1">
                        <i class="fa-solid fa-filter me-2"></i>
                        <select id="filterSelect" class="form-select" aria-label="Default select example">
                            <option value="<?= encrypt('ALL') ?>">Todos os movimentos</option>
                            <option value="<?= encrypt('IN') ?>">Entradas</option>
                            <option value="<?= encrypt('OUT') ?>">Saídas</option>
                            <optgroup label="Fornecedores">
                                <?php foreach ($suppliers as $supplier) : ?>
                                    <option value="<?= encrypt('stksup_ ' . $supplier) ?>"><?= $supplier ?></option>
                                <?php endforeach; ?>
                            </optgroup>
                        </select>
                    </div>

                </div>

            </div>

            <table class="table table-striped table-bordered" id='movementsTable'>
                <thead class="table-dark">
                    <tr>
                        <th class="text-center">Data do movimento</th>
                        <th class="text-center">Quantidade</th>
                        <th class="text-center">Operação</th>
                        <th class="text-center">Fornecedor</th>
                        <th>Notas</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<script src="<?= base_url('assets/libs/datatables/datatables.min.js') ?>">
</script>

<script>
    $(document).ready(() => {

        $('#movementsTable').DataTable({
            data: <?= json_encode($movements) ?>,
            columns: [{
                    data: 'movement_date',
                    className: 'text-center'
                },
                {
                    data: 'stock_quantity',
                    className: 'text-center'
                },
                {
                    data: 'stock_in_out',
                    className: 'text-center'
                },
                {
                    data: 'stock_supplier',
                    className: 'text-center'
                },
                {
                    data: 'reason'
                },
            ],
            order: [
                [0, 'desc']
            ],
            language: {
                decimal: "",
                emptyTable: "Sem dados disponíveis na tabela.",
                info: "Mostrando _START_ até _END_ de _TOTAL_ registos",
                infoEmpty: "Mostrando 0 até 0 de 0 registos",
                infoFiltered: "(Filtrando _MAX_ total de registos)",
                infoPostFix: "",
                thousands: ",",
                lengthMenu: "Mostrando _MENU_ registos por página.",
                loadingRecords: "Carregando...",
                processing: "Processando...",
                search: "Filtrar:",
                zeroRecords: "Nenhum registro encontrado.",
                paginate: {
                    first: "Primeira",
                    last: "Última",
                    next: "Seguinte",
                    previous: "Anterior"
                },
                aria: {
                    sortAscending: ": ative para classificar a coluna em ordem crescente.",
                    sortDescending: ": ative para classificar a coluna em ordem decrescente."
                }
            }
        })

        let filterSelect = document.querySelector('#filterSelect')
        filterSelect.addEventListener('change', function() {

            <?php if ($selectedFilter == 'IN' || 'OUT') : ?>
                window.location.href = '';
                window.location.href = `<?= current_url() . '?f=' ?>${this.value}`;
            <?php endif; ?>

            <?php if (in_array($selectedFilter, array_values($suppliers))) : ?>
                window.location.href = '';
                window.location.href = `<?= current_url() . '?s=' ?>${this.value}`;
            <?php endif; ?>
        });
    })
</script>
<?= $this->endSection(); ?>