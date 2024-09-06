<section id="itemSection">
    <h1 class="text-center fw-bold m-4">Item Management</h1>

    <div class="row">

        <!-- Item Table -->
        <div class="col-6 p-0 m-3 ms-5 shadow-lg border-light rounded">
            <div style="max-height: 400px; overflow-y: auto;">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                    <tr>
                        <th scope="col" class="w-25">Code</th>
                        <th scope="col" class="w-25">Description</th>
                        <th scope="col" class="w-25">Unit Price</th>
                        <th scope="col" class="w-25">Qty On Hand</th>
                    </tr>
                    </thead>
                    <tbody id="itemTable"></tbody>
                </table>
            </div>
        </div>

        <!-- Item Form -->
        <div class="col-5 p-5 m-3 shadow-lg border-light rounded">
            <form>
                <div class="mb-2">
                    <label for="txtSearchItem" class="form-label fw-bold">Search Item</label>
                    <div class="d-flex">
                        <input class="form-control me-2" id="txtSearchItem" type="text">
                        <button class="btn btn-outline-success" id="btnSearchItem" type="button">Search</button>
                    </div>
                </div>
                <div class="mb-2">
                    <label for="txtItemCode" class="form-label fw-bold">Item Code</label>
                    <input class="form-control" id="txtItemCode" type="text" disabled>
                    <div id="txtItemCodeError" class="text-danger mt-1"></div>
                </div>
                <div class="mb-2">
                    <label for="txtItemDescription" class="form-label fw-bold">Item Description</label>
                    <input class="form-control" id="txtItemDescription" type="text">
                    <div id="txtItemDescriptionError" class="text-danger mt-1"></div>
                </div>
                <div class="mb-2">
                    <label for="txtItemUnitPrice" class="form-label fw-bold">Unit Price</label>
                    <input class="form-control" id="txtItemUnitPrice" type="number">
                    <div id="txtItemUnitPriceError" class="text-danger mt-1"></div>
                </div>
                <div class="mb-2">
                    <label for="txtItemQtyOnHand" class="form-label fw-bold">Qty On Hand</label>
                    <input class="form-control" id="txtItemQtyOnHand" type="number">
                    <div id="txtItemQtyOnHandError" class="text-danger mt-1"></div>
                </div>
                <div class="d-flex justify-content-center mt-4">
                    <button class="btn btn-outline-primary mx-2 w-100" id="btnSaveItem"
                            type="button">Save
                    </button>
                    <button class="btn btn-outline-warning mx-2 w-100" id="btnUpdateItem" type="button">Update
                    </button>
                    <button class="btn btn-outline-danger mx-2 w-100" id="btnDeleteItem" type="button">Delete
                    </button>
                    <button class="btn btn-outline-secondary mx-2 w-100" id="btnLoadAllItems" type="button">Load
                        All
                    </button>
                    <button class="btn btn-outline-info mx-2 w-100" id="btnResetItem"
                            type="button">Reset
                    </button>
                </div>
            </form>
        </div>

    </div>
</section>
