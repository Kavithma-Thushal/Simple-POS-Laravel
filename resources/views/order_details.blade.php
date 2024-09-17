<main>
    <h2 class="text-center fw-bold mt-3">Order Details</h2>

    <div class="row justify-content-center">
        <div class="col-10 mt-3">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                <tr>
                    <th scope="col">Order ID</th>
                    <th scope="col">Customer ID</th>
                    <th scope="col">Item Code</th>
                    <th scope="col">Buy Qty</th>
                    <th scope="col">Total</th>
                </tr>
                </thead>
                <tbody id="orderDetailsTable"></tbody>
            </table>
        </div>
    </div>
</main>

<script>
    $(document).ready(function () {
        loadOrderDetails();

        function loadOrderDetails() {
            $.ajax({
                url: '{{ route('get-order-details') }}',
                method: 'GET',
                success: function (response) {
                    let tableBody = $('#orderDetailsTable');
                    tableBody.empty();

                    response.data.forEach(function (orderDetail) {
                        orderDetail.orderDetailsList.forEach(function (detail) {
                            let row = `<tr>
                                    <td>${orderDetail.orderId}</td>
                                    <td>${orderDetail.customerId}</td>
                                    <td>${detail.itemCode}</td>
                                    <td>${detail.buyQty}</td>
                                    <td>${detail.total}</td>
                                </tr>`;
                            tableBody.append(row);
                        });
                    });
                },
                error: function (error) {
                    $("#orderDetailsTable").empty();
                    let errorRow = `<tr><td colspan="5" class="text-center text-danger">${error.responseJSON.message}</td></tr>`;
                    $("#orderDetailsTable").append(errorRow);
                }
            });
        }
    });
</script>
