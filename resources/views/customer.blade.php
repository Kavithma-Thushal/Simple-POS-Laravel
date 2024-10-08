<main>
    <h2 class="text-center fw-bold mt-3">Customer Management</h2>

    <div class="row">

        <!-- Customer Table -->
        <div class="col-6 p-0 m-3 ms-5 shadow-lg border-light rounded">
            <div style="max-height: 400px; overflow-y: auto;">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                    <tr>
                        <th scope="col" class="w-25">ID</th>
                        <th scope="col" class="w-25">Name</th>
                        <th scope="col" class="w-25">Address</th>
                        <th scope="col" class="w-25">Salary</th>
                    </tr>
                    </thead>
                    <tbody id="customerTable" style="cursor: pointer"></tbody>
                </table>
            </div>
        </div>

        <!-- Customer Form -->
        <div class="col-5 p-5 m-3 shadow-lg border-light rounded">
            <div class="mb-2">
                <label for="txtSearchCustomer" class="form-label fw-bold">Search Customer</label>
                <div class="d-flex">
                    <input class="form-control me-2" id="txtSearchCustomer" type="text">
                    <button class="btn btn-outline-success" id="btnSearchCustomer" type="button">Search</button>
                </div>
            </div>
            <form id="customerForm">
                {{--@csrf--}}
                <div class="mb-2">
                    <label for="txtCustomerId" class="form-label fw-bold">Customer ID</label>
                    <input class="form-control" id="txtCustomerId" name="id" type="text" required readonly>
                    <div id="txtCusIdError" class="text-danger mt-1"></div>
                </div>
                <div class="mb-2">
                    <label for="txtCustomerName" class="form-label fw-bold">Customer Name</label>
                    <input class="form-control" id="txtCustomerName" name="name" type="text" required>
                    <div id="txtCusNameError" class="text-danger mt-1"></div>
                </div>
                <div class="mb-2">
                    <label for="txtCustomerAddress" class="form-label fw-bold">Customer Address</label>
                    <input class="form-control" id="txtCustomerAddress" name="address" type="text" required>
                    <div id="txtCusAddressError" class="text-danger mt-1"></div>
                </div>
                <div class="mb-2">
                    <label for="txtCustomerSalary" class="form-label fw-bold">Customer Salary</label>
                    <input class="form-control" id="txtCustomerSalary" name="salary" type="number" step="0.01" required>
                    <div id="txtCusSalaryError" class="text-danger mt-1"></div>
                </div>
                <div class="d-flex justify-content-center mt-4">
                    <button class="btn btn-outline-primary mx-2 w-100" id="btnSaveCustomer" type="submit">Save</button>
                    <button class="btn btn-outline-warning mx-2 w-100" id="btnUpdateCustomer" type="button">Update
                    </button>
                    <button class="btn btn-outline-danger mx-2 w-100" id="btnDeleteCustomer" type="button">Delete
                    </button>
                    <button class="btn btn-outline-secondary mx-2 w-100" id="btnGetAllCustomers" type="button">Get All
                    </button>
                    <button class="btn btn-outline-info mx-2 w-100" id="btnResetCustomer" type="reset">Reset</button>
                </div>
            </form>
        </div>

    </div>
</main>
<script src="{{ asset('assets/js/validation/CustomerValidation.js') }}"></script>
<script>
    $(document).ready(function () {
        getAllCustomersToTable();
        generateCustomerId();
        customerValidation();
        resetCustomerBorders();

        // Save Customer
        $('#btnSaveCustomer').click(function (e) {
            e.preventDefault();

            $.ajax({
                url: '{{ route('save-customer') }}',
                type: 'POST',
                data: $('#customerForm').serialize(),
                // headers: {
                //     'X-CSRF-TOKEN': $('input[name="_token"]').val()
                // },
                success: function (response) {
                    successNotification(response.message);
                    getAllCustomersToTable();
                },
                error: function (error) {
                    errorNotification(error.responseJSON.message);
                    getAllCustomersToTable();
                }
            });
        });

        // Search Customer
        $('#btnSearchCustomer').click(function (e) {
            e.preventDefault();

            $.ajax({
                url: '{{ route('search-customer') }}',
                method: "GET",
                data: {id: $("#txtSearchCustomer").val()},
                success: function (response) {
                    $("#customerTable").empty();

                    let row = `<tr>
                    <td>${response.data.id}</td>
                    <td>${response.data.name}</td>
                    <td>${response.data.address}</td>
                    <td>${response.data.salary}</td>
                </tr>`;

                    $("#customerTable").append(row);
                    generateCustomerId();
                    customerTableListener();
                    clearCustomerInputs();
                },
                error: function (error) {
                    generateCustomerId();
                    clearCustomerInputs();

                    $("#customerTable").empty();
                    let errorRow = `<tr><td colspan="4" class="text-center text-danger">${error.responseJSON.message}</td></tr>`;
                    $("#customerTable").append(errorRow);
                }
            });
        });

        // Update Customer
        $('#btnUpdateCustomer').click(function (e) {
            e.preventDefault();

            $.ajax({
                url: '{{ route('update-customer') }}',
                type: 'PUT',
                data: $('#customerForm').serialize(),
                success: function (response) {
                    successNotification(response.message);
                    getAllCustomersToTable();
                },
                error: function (error) {
                    errorNotification(error.responseJSON.message);
                    getAllCustomersToTable();
                }
            });
        });

        // Delete Customer
        $('#btnDeleteCustomer').click(function (e) {
            e.preventDefault();

            $.ajax({
                url: '{{ route('delete-customer') }}',
                type: 'DELETE',
                data: {id: $("#txtCustomerId").val()},
                success: function (response) {
                    successNotification(response.message);
                    getAllCustomersToTable();
                    clearCustomerInputs();
                },
                error: function (error) {
                    errorNotification(error.responseJSON.message);
                    getAllCustomersToTable();
                }
            });
        });

        // Get All Customers
        $('#btnGetAllCustomers').click(function () {
            getAllCustomersToTable();
        });

        // Reset Customers
        $('#btnResetCustomer').click(function () {
            getAllCustomersToTable();
            generateCustomerId();
        });

        function getAllCustomersToTable() {
            $.ajax({
                url: '{{ route('get-all-customers') }}',
                type: 'GET',
                success: function (response) {
                    $('#customerTable').empty();

                    response.data.forEach(customer => {
                        let id = customer.id;
                        let name = customer.name;
                        let address = customer.address;
                        let salary = customer.salary;

                        let row = `<tr>
                            <td>${id}</td>
                            <td>${name}</td>
                            <td>${address}</td>
                            <td>${salary}</td>
                        </tr>`;

                        $("#customerTable").append(row);
                    });
                    generateCustomerId();
                    customerTableListener();
                    clearCustomerInputs();
                    customerValidation();
                    resetCustomerBorders();
                },
                error: function (error) {
                    $("#customerTable").empty();
                    let errorRow = `<tr><td colspan="4" class="text-center text-danger">${error.responseJSON.message}</td></tr>`;
                    $("#customerTable").append(errorRow);
                }
            });
        }

        function generateCustomerId() {
            $.ajax({
                url: '{{ route('generate-customer-id') }}',
                method: "GET",
                success: function (response) {
                    let lastCustomerId = response.data;

                    // Split and generate new id
                    let parts = lastCustomerId.split('-');
                    let prefix = parts[0];
                    let number = parseInt(parts[1]) + 1;
                    let newCustomerId = prefix + '-' + number.toString().padStart(3, '0');
                    $("#txtCustomerId").val(newCustomerId);
                }
            });
        }

        function customerTableListener() {
            $("#customerTable>tr").on("click", function () {
                let id = $(this).children().eq(0).text();
                let name = $(this).children().eq(1).text();
                let address = $(this).children().eq(2).text();
                let salary = $(this).children().eq(3).text();

                $("#txtCustomerId").val(id);
                $("#txtCustomerName").val(name);
                $("#txtCustomerAddress").val(address);
                $("#txtCustomerSalary").val(salary);

                $("#btnUpdateCustomer").prop("disabled", false);
                $("#btnDeleteCustomer").prop("disabled", false);
            });
        }

        function clearCustomerInputs() {
            $("#txtSearchCustomer").val("");
            $("#txtCustomerName").val("");
            $("#txtCustomerAddress").val("");
            $("#txtCustomerSalary").val("");

            $("#btnSaveCustomer").prop("disabled", true);
            $("#btnUpdateCustomer").prop("disabled", true);
            $("#btnDeleteCustomer").prop("disabled", true);
        }
    });
</script>
