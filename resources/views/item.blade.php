<main>
    <h2 class="text-center fw-bold mt-3">Item Management</h2>

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
                    <tbody id="itemTable" style="cursor: pointer"></tbody>
                </table>
            </div>
        </div>

        <!-- Item Form -->
        <div class="col-5 p-5 m-3 shadow-lg border-light rounded">
            <div class="mb-2">
                <label for="txtSearchItem" class="form-label fw-bold">Search Item</label>
                <div class="d-flex">
                    <input class="form-control me-2" id="txtSearchItem" type="text">
                    <button class="btn btn-outline-success" id="btnSearchItem" type="button">Search</button>
                </div>
            </div>
            <form id="itemForm">
                <div class="mb-2">
                    <label for="txtItemCode" class="form-label fw-bold">Item Code</label>
                    <input class="form-control" id="txtItemCode" name="code" type="text" required readonly>
                    <div id="txtItemCodeError" class="text-danger mt-1"></div>
                </div>
                <div class="mb-2">
                    <label for="txtItemDescription" class="form-label fw-bold">Description</label>
                    <input class="form-control" id="txtItemDescription" name="description" type="text" required>
                    <div id="txtItemDescriptionError" class="text-danger mt-1"></div>
                </div>
                <div class="mb-2">
                    <label for="txtItemUnitPrice" class="form-label fw-bold">Unit Price</label>
                    <input class="form-control" id="txtItemUnitPrice" name="unitPrice" type="number" step="0.01"
                           required>
                    <div id="txtItemUnitPriceError" class="text-danger mt-1"></div>
                </div>
                <div class="mb-2">
                    <label for="txtItemQtyOnHand" class="form-label fw-bold">Qty On Hand</label>
                    <input class="form-control" id="txtItemQtyOnHand" name="qtyOnHand" type="number" step="1" required>
                    <div id="txtItemQtyOnHandError" class="text-danger mt-1"></div>
                </div>
                <div class="d-flex justify-content-center mt-4">
                    <button class="btn btn-outline-primary mx-2 w-100" id="btnSaveItem" type="submit">Save</button>
                    <button class="btn btn-outline-warning mx-2 w-100" id="btnUpdateItem" type="button">Update
                    </button>
                    <button class="btn btn-outline-danger mx-2 w-100" id="btnDeleteItem" type="button">Delete
                    </button>
                    <button class="btn btn-outline-secondary mx-2 w-100" id="btnGetAllItems" type="button">Get
                        All
                    </button>
                    <button class="btn btn-outline-info mx-2 w-100" id="btnResetItem" type="reset">Reset</button>
                </div>
            </form>
        </div>

    </div>
</main>
<script src="{{ asset('assets/js/validation/ItemValidation.js') }}"></script>
<script>
    $(document).ready(function () {
        generateItemCode();
        getAllItemsToTable();

        // Save Item
        $('#btnSaveItem').click(function (e) {
            e.preventDefault();

            $.ajax({
                url: '{{ route('save-item') }}',
                type: 'POST',
                data: $('#itemForm').serialize(),
                success: function (response) {
                    getAllItemsToTable();
                    successNotification(response.message);
                },
                error: function (error) {
                    getAllItemsToTable();
                    errorNotification(error.responseJSON.message);
                }
            });
        });

        // Search Item
        $('#btnSearchItem').click(function (e) {
            e.preventDefault();

            $.ajax({
                url: '{{ route('search-item') }}',
                method: "GET",
                data: {id: $("#txtSearchItem").val()},
                success: function (response) {
                    $("#itemTable").empty();

                    let row = `<tr>
                    <td>${response.data.code}</td>
                    <td>${response.data.description}</td>
                    <td>${response.data.unitPrice}</td>
                    <td>${response.data.qtyOnHand}</td>
                </tr>`;

                    $("#itemTable").append(row);
                    generateItemCode();
                    itemTableListener();
                    clearItemInputs();
                },
                error: function (error) {
                    generateItemCode();
                    clearItemInputs();

                    $("#itemTable").empty();
                    let errorRow = `<tr><td colspan="4" class="text-center text-danger">${error.responseJSON.message}</td></tr>`;
                    $("#itemTable").append(errorRow);
                }
            });
        });

        // Update Item
        $('#btnUpdateItem').click(function (e) {
            e.preventDefault();

            $.ajax({
                url: '{{ route('update-item') }}',
                type: 'PUT',
                data: $('#itemForm').serialize(),
                success: function (response) {
                    getAllItemsToTable();
                    successNotification(response.message);
                },
                error: function (error) {
                    getAllItemsToTable();
                    errorNotification(error.responseJSON.message);
                }
            });
        });

        // Delete Item
        $('#btnDeleteItem').click(function (e) {
            e.preventDefault();

            $.ajax({
                url: '{{ route('delete-item') }}',
                type: 'DELETE',
                data: {id: $("#txtItemCode").val()},
                success: function (response) {
                    getAllItemsToTable();
                    clearItemInputs();
                    successNotification(response.message);
                },
                error: function (error) {
                    getAllItemsToTable();
                    errorNotification(error.responseJSON.message);
                }
            });
        });

        // Get All Items
        $('#btnGetAllItems').click(function () {
            getAllItemsToTable();
        });

        // Reset Items
        $('#btnResetItem').click(function () {
            getAllItemsToTable();
        });

        function getAllItemsToTable() {
            $.ajax({
                url: '{{ route('get-all-items') }}',
                type: 'GET',
                success: function (response) {
                    $('#itemTable').empty();

                    response.data.forEach(item => {
                        let code = item.code;
                        let description = item.description;
                        let unitPrice = item.unitPrice;
                        let qtyOnHand = item.qtyOnHand;

                        let row = `<tr>
                        <td>${code}</td>
                        <td>${description}</td>
                        <td>${unitPrice}</td>
                        <td>${qtyOnHand}</td>
                    </tr>`;

                        $("#itemTable").append(row);
                    });
                    generateItemCode();
                    itemValidation();
                    resetItemBorders();
                    itemTableListener();
                    clearItemInputs();
                },
                error: function (error) {
                    $("#itemTable").empty();
                    let errorRow = `<tr><td colspan="4" class="text-center text-danger">${error.responseJSON.message}</td></tr>`;
                    $("#itemTable").append(errorRow);
                }
            });
        }

        function generateItemCode() {
            $.ajax({
                url: '{{ route('generate-item-code') }}',
                method: "GET",
                success: function (response) {
                    let lastItemCode = response.data;

                    // Split and generate new code
                    let parts = lastItemCode.split('-');
                    let prefix = parts[0];
                    let number = parseInt(parts[1]) + 1;
                    let newItemCode = prefix + '-' + number.toString().padStart(3, '0');
                    $("#txtItemCode").val(newItemCode);
                }
            });
        }

        function itemTableListener() {
            $("#itemTable>tr").on("click", function () {
                let code = $(this).children().eq(0).text();
                let description = $(this).children().eq(1).text();
                let unitPrice = $(this).children().eq(2).text();
                let qtyOnHand = $(this).children().eq(3).text();

                $("#txtItemCode").val(code);
                $("#txtItemDescription").val(description);
                $("#txtItemUnitPrice").val(unitPrice);
                $("#txtItemQtyOnHand").val(qtyOnHand);

                $("#btnUpdateItem").prop("disabled", false);
                $("#btnDeleteItem").prop("disabled", false);
            });
        }

        function clearItemInputs() {
            $("#txtSearchItem").val("");
            $("#txtItemDescription").val("");
            $("#txtItemUnitPrice").val("");
            $("#txtItemQtyOnHand").val("");

            $("#btnSaveItem").prop("disabled", true);
            $("#btnUpdateItem").prop("disabled", true);
            $("#btnDeleteItem").prop("disabled", true);
        }
    });
</script>
