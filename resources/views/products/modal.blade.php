
{{-- MODAL TAMBAH PRODUCT --}}
<div class="modal fade" id="createProductModal" tabindex="-1"
    aria-hidden="true">

    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Tambah Product</h5>
                <button type="button" class="btn-close"
                    data-bs-dismiss="modal"></button>
            </div>

            <form id="createProductForm">
                @csrf

                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label">Product Name</label>
                        <input type="text" name="name"
                            class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Price</label>
                        <input type="number" name="price"
                            class="form-control"
                            min="0" step="1000" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Stock</label>
                        <input type="number" name="stock"
                            class="form-control"
                            min="0" step="1" required>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">Batal</button>

                    <button type="submit" class="btn btn-primary">
                        Simpan Product
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>


{{-- MODAL EDIT PRODUCT --}}
<div class="modal fade" id="editProductModal" tabindex="-1"
    aria-hidden="true">

    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Edit Product</h5>
                <button type="button" class="btn-close"
                    data-bs-dismiss="modal"></button>
            </div>

            <form id="editProductForm">
                @csrf

                <input type="hidden" name="id" id="edit-product-id">

                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label">Product Name</label>
                        <input type="text" name="name"
                            id="edit-name"
                            class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Price</label>
                        <input type="number" name="price"
                            id="edit-price"
                            class="form-control"
                            min="0" step="1000" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Stock</label>
                        <input type="number" name="stock"
                            id="edit-stock"
                            class="form-control"
                            min="0" step="1" required>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">Batal</button>

                    <button type="submit" class="btn btn-warning">
                        Update Product
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
