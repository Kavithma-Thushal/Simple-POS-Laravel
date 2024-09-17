<main>
    <h2 class="text-center fw-bold mt-3">Order Management</h2>

    <div class="row justify-content-center">

        <!-- Customer Details -->
        <div class="col-3 p-5 m-5 mt-3 shadow-lg border-light rounded">
            <form>
                <h3 class="text-center mb-4">Customer Details</h3>
                <div class="mb-2">
                    <label for="txtPlaceOrderOrderId" class="form-label fw-bold">Order ID</label>
                    <input class="form-control" id="txtPlaceOrderOrderId" type="text" readonly>
                </div>
                <div class="mb-2">
                    <label for="txtPlaceOrderCustomerId" class="form-label fw-bold">Customer ID</label>
                    <select class="form-control" id="txtPlaceOrderCustomerId"
                            onchange="getCustomerDetailsToInputs()"></select>
                </div>
                <div class="mb-2">
                    <label for="txtPlaceOrderCustomerName" class="form-label fw-bold">Customer Name</label>
                    <input class="form-control" id="txtPlaceOrderCustomerName" type="text" readonly>
                </div>
                <div class="mb-2">
                    <label for="txtPlaceOrderCustomerAddress" class="form-label fw-bold">Customer Address</label>
                    <input class="form-control" id="txtPlaceOrderCustomerAddress" type="text" readonly>
                </div>
                <div class="mb-2">
                    <label for="txtPlaceOrderCustomerSalary" class="form-label fw-bold">Customer Salary</label>
                    <input class="form-control" id="txtPlaceOrderCustomerSalary" type="text" readonly>
                </div>
            </form>
        </div>

        <!-- Item Details -->
        <div class="col-3 p-5 m-5 mt-3 shadow-lg border-light rounded">
            <form>
                <h3 class="text-center mb-4">Item Details</h3>
                <div class="mb-2">
                    <label for="txtPlaceOrderItemCode" class="form-label fw-bold">Item Code</label>
                    <select class="form-control" id="txtPlaceOrderItemCode"
                            onchange="getItemDetailsToInputs()"></select>
                </div>
                <div class="mb-2">
                    <label for="txtPlaceOrderItemDescription" class="form-label fw-bold">Item Description</label>
                    <input class="form-control" id="txtPlaceOrderItemDescription" type="text" readonly>
                </div>
                <div class="mb-2">
                    <label for="txtPlaceOrderItemUnitPrice" class="form-label fw-bold">Unit Price</label>
                    <input class="form-control" id="txtPlaceOrderItemUnitPrice" type="text" readonly>
                </div>
                <div class="mb-2">
                    <label for="txtPlaceOrderItemQtyOnHand" class="form-label fw-bold">Qty On Hand</label>
                    <input class="form-control" id="txtPlaceOrderItemQtyOnHand" type="text" readonly>
                </div>
            </form>
        </div>

        <!-- Payment Details -->
        <div class="col-3 p-5 m-5 mt-3 shadow-lg border-light rounded">
            <form>
                <h3 class="text-center mb-4">Payment Details</h3>
                <div class="mb-2">
                    <label for="txtPlaceOrderBuyQty" class="form-label fw-bold">Buy Qty</label>
                    <input class="form-control" id="txtPlaceOrderBuyQty" type="number" min="1" required>
                </div>
                <div class="d-flex justify-content-center mt-4">
                    <button class="btn btn-outline-primary mx-2" id="btnAddToCart" type="button">Add to Cart</button>
                </div>
                <div class="mb-2">
                    <label for="txtPlaceOrderTotal" class="form-label fw-bold">Total</label>
                    <input class="form-control" id="txtPlaceOrderTotal" type="number" readonly>
                </div>
                <div class="d-flex justify-content-center mt-4">
                    <button class="btn btn-outline-success mx-2" id="btnPlaceOrder" type="button">Place Order</button>
                </div>
                <div class="d-flex justify-content-center mt-4">
                    <button class="btn btn-outline-danger mx-2" id="btnCancelOrder" type="button">Cancel Order</button>
                </div>
            </form>
        </div>

    </div>

    <!-- Add to Cart -->
    <div class="row justify-content-center">
        <div class="col-10">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                <tr>
                    <th scope="col" style="width: 200px">Customer ID</th>
                    <th scope="col" style="width: 200px">Item Description</th>
                    <th scope="col" style="width: 200px">Unit Price</th>
                    <th scope="col" style="width: 200px">Buy Qty</th>
                    <th scope="col" style="width: 200px">Total</th>
                    <th scope="col" style="width: 200px">Actions</th>
                </tr>
                </thead>
                <tbody id="orderTable"></tbody>
            </table>
        </div>
    </div>

</main>
<script>
    var cart = [];
    generateOrderId();
    getAllCustomersToCombo();
    getAllItemsToCombo();

    function generateOrderId() {
        $.ajax({
            url: '{{ route('generate-order-id') }}',
            method: "GET",
            success: function (response) {
                let lastOrderId = response.data;

                // Split and generate new id
                let parts = lastOrderId.split('-');
                let prefix = parts[0];
                let number = parseInt(parts[1]) + 1;
                let newOrderId = prefix + '-' + number.toString().padStart(3, '0');
                $("#txtPlaceOrderOrderId").val(newOrderId);
            }
        });
    }

    function getAllCustomersToCombo() {
        $.ajax({
            url: '{{ route('get-all-customers') }}',
            method: "GET",
            success: function (response) {
                let cmbCustomerId = $("#txtPlaceOrderCustomerId");
                cmbCustomerId.empty();

                // Add Disabled Option
                cmbCustomerId.append(
                    $("<option></option>")
                        .attr("value", "")
                        .attr("disabled", "disabled")
                        .attr("selected", "selected")
                        .text("Select a Customer ID")
                );

                // Add Customer ID
                response.data.forEach(customer => {
                    let option = $("<option></option>")
                        .attr("value", customer.id)
                        .text(customer.id);
                    cmbCustomerId.append(option);
                });

            },
            error: function (error) {
                console.log(error.responseJSON.message);
            }
        });
    }

    function getCustomerDetailsToInputs() {
        $.ajax({
            url: '{{ route('search-customer') }}',
            method: "GET",
            data: {id: $("#txtPlaceOrderCustomerId").val()},
            success: function (response) {
                $("#txtPlaceOrderCustomerName").val(response.data.name);
                $("#txtPlaceOrderCustomerAddress").val(response.data.address);
                $("#txtPlaceOrderCustomerSalary").val(response.data.salary);
            },
            error: function (error) {
                console.log(error.responseJSON.message);
            }
        });
    }

    function getAllItemsToCombo() {
        $.ajax({
            url: '{{ route('get-all-items') }}',
            method: "GET",
            success: function (response) {
                let cmbItemCode = $("#txtPlaceOrderItemCode");
                cmbItemCode.empty();

                // Add Disabled Option
                cmbItemCode.append(
                    $("<option></option>")
                        .attr("value", "")
                        .attr("disabled", "disabled")
                        .attr("selected", "selected")
                        .text("Select an Item Code")
                );

                // Add Item Code
                response.data.forEach(item => {
                    let option = $("<option></option>")
                        .attr("value", item.code)
                        .text(item.code);
                    cmbItemCode.append(option);
                });

            },
            error: function (error) {
                console.log(error.responseJSON.message);
            }
        });
    }

    function getItemDetailsToInputs() {
        $.ajax({
            url: '{{ route('search-item') }}',
            method: "GET",
            data: {id: $("#txtPlaceOrderItemCode").val()},
            success: function (res) {
                $("#txtPlaceOrderItemDescription").val(res.data.description);
                $("#txtPlaceOrderItemUnitPrice").val(res.data.unitPrice);
                $("#txtPlaceOrderItemQtyOnHand").val(res.data.qtyOnHand);
            },
            error: function (error) {
                console.log(error.responseJSON.message);
            }
        });
    }

    $("#btnAddToCart").click(function () {

        let customerId = $("#txtPlaceOrderCustomerId").val();
        let itemCode = $("#txtPlaceOrderItemCode").val();
        let itemDescription = $("#txtPlaceOrderItemDescription").val();
        let unitPrice = parseFloat($("#txtPlaceOrderItemUnitPrice").val());
        let buyQty = parseInt($("#txtPlaceOrderBuyQty").val());
        let total = buyQty * unitPrice;

        if (!itemCode || !itemDescription || isNaN(unitPrice) || isNaN(buyQty) || !customerId) {
            errorNotification("Please fill all item details correctly");
            return;
        }

        let existingItem = cart.find(item => item.itemCode === itemCode && item.customerId === customerId);
        if (existingItem) {
            existingItem.buyQty += buyQty;
            existingItem.total = existingItem.buyQty * existingItem.unitPrice;
        } else {
            cart.push({
                customerId: customerId,
                itemCode: itemCode,
                itemDescription: itemDescription,
                unitPrice: unitPrice,
                buyQty: buyQty,
                total: total
            });
        }

        // Disable Customer Combo
        $("#txtPlaceOrderCustomerId").prop('disabled', true);

        // Clear Item Inputs
        $("#txtPlaceOrderItemCode").val('');
        $("#txtPlaceOrderItemDescription").val('');
        $("#txtPlaceOrderItemUnitPrice").val('');
        $("#txtPlaceOrderItemQtyOnHand").val('');
        $("#txtPlaceOrderBuyQty").val('');

        updateCartTable();
    });

    function updateCartTable(itemCode = null, customerId = null) {
        if (itemCode && customerId) {
            cart = cart.filter(item => item.itemCode !== itemCode || item.customerId !== customerId);
        }

        let tableBody = $("#orderTable");
        tableBody.empty();

        let total = 0;
        cart.forEach(item => {
            let row = `<tr>
            <td>${item.customerId}</td>
            <td>${item.itemDescription}</td>
            <td>${item.unitPrice.toFixed(2)}</td>
            <td>${item.buyQty}</td>
            <td>${item.total.toFixed(2)}</td>
            <td><button class="btn btn-outline-danger btn-sm" onclick="updateCartTable('${item.itemCode}', '${item.customerId}')">Remove</button></td>
        </tr>`;
            tableBody.append(row);
            total += item.total;
        });

        $("#txtPlaceOrderTotal").val(total);
    }

    $("#btnPlaceOrder").click(function () {

        let orderId = $("#txtPlaceOrderOrderId").val();
        let customerId = $("#txtPlaceOrderCustomerId").val();

        if (!orderId || !customerId || cart.length === 0) {
            errorNotification("Please fill all fields and add items to the cart");
            return;
        }

        let orderObj = {
            orderId: orderId,
            customerId: customerId,
            orderDetailsList: cart.map(item => ({
                itemCode: item.itemCode,
                buyQty: item.buyQty,
                total: item.total
            }))
        };

        $.ajax({
            url: '{{ route('place-order') }}',
            method: "POST",
            contentType: "application/json",
            data: JSON.stringify(orderObj),
            success: function (response) {
                cart = [];  // Clear cart after successful order
                updateCartTable();
                generateOrderId();
                successNotification(response.message);

                // Enable Customer Combo
                $("#txtPlaceOrderCustomerId").prop('disabled', false);
                $("#txtPlaceOrderCustomerName").prop('disabled', false);
                $("#txtPlaceOrderCustomerAddress").prop('disabled', false);
                $("#txtPlaceOrderCustomerSalary").prop('disabled', false);

                // Clear Customer Inputs
                $("#txtPlaceOrderCustomerId").val('');
                $("#txtPlaceOrderCustomerName").val('');
                $("#txtPlaceOrderCustomerAddress").val('');
                $("#txtPlaceOrderCustomerSalary").val('');
                $("#txtPlaceOrderTotal").val('');
            },
            error: function (error) {
                errorNotification(error.responseJSON.message);
            }
        });
    });

    $("#btnCancelOrder").click(function () {
        // Enable Customer Combo
        $("#txtPlaceOrderCustomerId").prop('disabled', false);

        // Clear Customer Inputs
        $("#txtPlaceOrderCustomerId").val('');
        $("#txtPlaceOrderCustomerName").val('');
        $("#txtPlaceOrderCustomerAddress").val('');
        $("#txtPlaceOrderCustomerSalary").val('');
        $("#txtPlaceOrderTotal").val('');

        // Clear Item Inputs
        $("#txtPlaceOrderItemCode").val('');
        $("#txtPlaceOrderItemDescription").val('');
        $("#txtPlaceOrderItemUnitPrice").val('');
        $("#txtPlaceOrderItemQtyOnHand").val('');
        $("#txtPlaceOrderBuyQty").val('');

        // Empty Table
        $("#orderTable").empty();
    });
</script>
