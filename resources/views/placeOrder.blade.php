<main id="placeOrderSection">
    <h1 class="text-center fw-bold mt-4">Place Order</h1>

    <div class="row justify-content-center">

        <!-- Customer Details -->
        <div class="col-3 p-5 m-5 shadow-lg border-light rounded">
            <form>
                <h3 class="text-center mb-4">Customer Details</h3>
                <div class="mb-2">
                    <label for="txtPlaceOrderOrderId" class="form-label fw-bold">Order ID</label>
                    <input class="form-control" id="txtPlaceOrderOrderId" type="text" readonly>
                </div>
                <div class="mb-2">
                    <label for="txtPlaceOrderCustomerId" class="form-label fw-bold">Customer ID</label>
                    <select class="form-control" id="txtPlaceOrderCustomerId"
                            onchange="loadCustomerDetailsToInputs()"></select>
                </div>
                <div class="mb-2">
                    <label for="txtPlaceOrderCustomerName" class="form-label fw-bold">Customer Name</label>
                    <input class="form-control" id="txtPlaceOrderCustomerName" type="text">
                </div>
                <div class="mb-2">
                    <label for="txtPlaceOrderCustomerAddress" class="form-label fw-bold">Customer
                        Address</label>
                    <input class="form-control" id="txtPlaceOrderCustomerAddress" type="text">
                </div>
                <div class="mb-2">
                    <label for="txtPlaceOrderCustomerSalary" class="form-label fw-bold">Customer Salary</label>
                    <input class="form-control" id="txtPlaceOrderCustomerSalary" type="text">
                </div>
            </form>
        </div>

        <!-- Item Details -->
        <div class="col-3 p-5 m-5 shadow-lg border-light rounded">
            <form>
                <h3 class="text-center mb-4">Item Details</h3>
                <div class="mb-2">
                    <label for="txtPlaceOrderItemCode" class="form-label fw-bold">Item Code</label>
                    <select class="form-control" id="txtPlaceOrderItemCode"
                            onchange="loadItemDetailsToInputs()"></select>
                </div>
                <div class="mb-2">
                    <label for="txtPlaceOrderItemDescription" class="form-label fw-bold">Item
                        Description</label>
                    <input class="form-control" id="txtPlaceOrderItemDescription" type="text">
                </div>
                <div class="mb-2">
                    <label for="txtPlaceOrderItemUnitPrice" class="form-label fw-bold">Unit Price</label>
                    <input class="form-control" id="txtPlaceOrderItemUnitPrice" type="text">
                </div>
                <div class="mb-2">
                    <label for="txtPlaceOrderItemQtyOnHand" class="form-label fw-bold">Qty On Hand</label>
                    <input class="form-control" id="txtPlaceOrderItemQtyOnHand" type="text">
                </div>
            </form>
        </div>

        <!-- Payment Details -->
        <div class="col-3 p-5 m-5 shadow-lg border-light rounded">
            <form>
                <h3 class="text-center mb-4">Payment Details</h3>
                <div class="mb-2">
                    <label for="txtPlaceOrderBuyQty" class="form-label fw-bold">Buy Qty</label>
                    <input class="form-control" id="txtPlaceOrderBuyQty" type="number">
                </div>
                <div class="d-flex justify-content-center mt-4">
                    <button class="btn btn-outline-primary mx-2" id="btnAddToCart" type="button">Add to Cart
                    </button>
                </div>
                <div class="mb-2">
                    <label for="txtPlaceOrderTotal" class="form-label fw-bold">Total</label>
                    <input class="form-control" id="txtPlaceOrderTotal" type="number" disabled>
                </div>
                <div class="d-flex justify-content-center mt-4">
                    <button class="btn btn-outline-success mx-2" id="btnPlaceOrder" type="button">Place Order
                    </button>
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
    loadCustomerDetailsToInputs();
    getAllCustomersToCombo();

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

                // Add customer ID
                response.forEach(customer => {
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

    function loadCustomerDetailsToInputs() {
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
</script>
