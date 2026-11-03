@extends('templates.layoutApp')

@push('style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tabulator-tables@6.6.1/dist/css/tabulator_bootstrap5.min.css"
crossorigin="anonymous" />
@endpush

@section('content')
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="mb-0 fs-3">Product List</h1>
            </div>
            <div class="col-sm-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Product List</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">

                    <div class="card-header p-3">
                        <div class="d-flex justify-content-between align-items-center">

                            <button type="button" class="btn btn-primary"
                                data-bs-toggle="modal"
                                data-bs-target="#createProductModal">
                                <i class="bi bi-plus-circle me-1"></i>
                                PRODUCT
                            </button>

                            <div class="input-group" style="max-width: 250px;">
                                <span class="input-group-text bg-white">
                                    <i class="bi bi-search"></i>
                                </span>

                                <input id="table-filter"
                                    type="search"
                                    class="form-control"
                                    placeholder="Filter rows...">
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="d-flex gap-2 mb-3">
                            <button id="export-csv" type="button" class="btn btn-sm btn-outline-secondary">
                                <i class="bi bi-filetype-csv me-1"></i>
                                Export CSV
                            </button>

                            <button id="export-json" type="button" class="btn btn-sm btn-outline-secondary">
                                <i class="bi bi-filetype-json me-1"></i>
                                Export JSON
                            </button>

                            <button id="print-table" type="button" class="btn btn-sm btn-outline-secondary">
                                <i class="bi bi-printer me-1"></i>
                                Print
                            </button>

                            {{-- <button id="sort-asc" type="button" class="btn btn-sm btn-outline-primary">
                                ASC ↑
                            </button>

                            <button id="sort-desc" type="button" class="btn btn-sm btn-outline-primary">
                                DSC ↓
                            </button> --}}
                        </div>

                        <div id="product-table" aria-label="Products"></div>

                        <div id="table-pagination"
                            class="d-flex flex-wrap gap-2 justify-content-end mt-2">
                        </div>
                    </div>

                    <div class="card-footer">The footer of the card</div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modal')
    @include('products.modal')
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/tabulator-tables@6.6.1/dist/js/tabulator.min.js"
    crossorigin="anonymous"></script>

<script>
document.addEventListener('DOMContentLoaded', () => {

    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

    const table = new Tabulator('#product-table', {
        index: 'id',
        ajaxURL: "{{ route('products.api') }}",
        layout: 'fitColumns',
        filterMode: 'local',
        pagination: 'local',
        paginationElement: document.getElementById('table-pagination'),
        paginationSize: 10,
        paginationSizeSelector: [10, 25, 50, 100],
        movableColumns: true,

        columns: [
            {
                title: 'ID',
                field: 'id',
                width: 80,
                headerSort: true
            },
            {
                title: 'Product Name',
                field: 'name'
            },
            {
                title: 'Price',
                field: 'price',
                formatter: function(cell) {
                    return 'Rp ' + Number(cell.getValue()).toLocaleString('id-ID');
                }
            },
            {
                title: 'Stock',
                field: 'stock',
                width: 120
            },
            {
                title: 'Aksi',
                field: 'id',
                formatter: function() {
                    return `
                        <button type="button" class="btn btn-warning btn-sm btn-edit">
                            Edit
                        </button>
                        <button type="button" class="btn btn-danger btn-sm btn-delete">
                            Hapus
                        </button>
                    `;
                },
                cellClick: function(e, cell) {
                    const id = cell.getRow().getData().id;

                    if (e.target.closest('.btn-edit')) {
                        editProduct(id);
                    }

                    if (e.target.closest('.btn-delete')) {
                        deleteProduct(id);
                    }
                },
                headerSort: false,
                width: 200,
                hozAlign: 'center'
            }
        ]
    });

    table.on('renderComplete', () => {
        document.querySelectorAll('#table-pagination button').forEach((button) => {
            button.classList.add('btn', 'btn-sm', 'btn-outline-secondary');
        });
    });

    // document.getElementById('sort-asc').addEventListener('click', () => {
    // table.setSort('id', 'asc');
    // });

    // document.getElementById('sort-desc').addEventListener('click', () => {
    //     table.setSort('id', 'desc');
    // });

    document.getElementById('table-filter').addEventListener('input', (e) => {
        const value = e.target.value;

        if (value) {
            table.setFilter('name', 'like', value);
        } else {
            table.clearFilter();
        }
    });

    document.getElementById('export-csv').addEventListener('click', () => {
        table.download('csv', 'products.csv');
    });

    document.getElementById('export-json').addEventListener('click', () => {
        table.download('json', 'products.json');
    });

    document.getElementById('print-table').addEventListener('click', () => {
        table.print(false, true);
    });

    const createForm = document.getElementById('createProductForm');

    createForm.addEventListener('submit', async function(e) {
        e.preventDefault();

        try {
            const response = await fetch("{{ route('products.store') }}", {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: new FormData(createForm)
            });

            const result = await response.json();

            if (!response.ok) throw result;

            await table.addData([result.data], true);

            bootstrap.Modal.getInstance(
                document.getElementById('createProductModal')
            ).hide();

            createForm.reset();

            alert('Product berhasil ditambahkan!');

        } catch (error) {
            showError(error);
        }
    });

    window.editProduct = async function(id) {
        try {
            const response = await fetch(`/products/${id}/edit`, {
                headers: {
                    'Accept': 'application/json'
                }
            });

            const product = await response.json();

            if (!response.ok) throw product;

            document.getElementById('edit-product-id').value = product.id;
            document.getElementById('edit-name').value = product.name;
            document.getElementById('edit-price').value = product.price;
            document.getElementById('edit-stock').value = product.stock;

            new bootstrap.Modal(
                document.getElementById('editProductModal')
            ).show();

        } catch (error) {
            showError(error);
        }
    };

    const editForm = document.getElementById('editProductForm');

    editForm.addEventListener('submit', async function(e) {
        e.preventDefault();

        const id = document.getElementById('edit-product-id').value;

        try {
            const formData = new FormData(editForm);
            formData.append('_method', 'PUT');

            const response = await fetch(`/products/${id}`, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: formData
            });

            const result = await response.json();

            if (!response.ok) throw result;

            await table.updateData([result.data]);

            bootstrap.Modal.getInstance(
                document.getElementById('editProductModal')
            ).hide();

            alert('Product berhasil diperbarui!');

        } catch (error) {
            showError(error);
        }
    });

    window.deleteProduct = async function(id) {
        if (!confirm('Apakah kamu yakin ingin menghapus product ini?')) {
            return;
        }

        try {
            const response = await fetch(`/products/${id}`, {
                method: 'DELETE',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                }
            });

            const result = await response.json();

            if (!response.ok) throw result;

            await table.deleteRow(id);

            alert('Product berhasil dihapus!');

        } catch (error) {
            showError(error);
        }
    };

    function showError(error) {
        if (error.errors) {
            alert(Object.values(error.errors).flat().join('\n'));
        } else {
            alert(error.message || 'Terjadi kesalahan!');
        }
    }

});
</script>
@endpush