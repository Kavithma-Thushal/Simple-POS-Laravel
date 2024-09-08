<main id="customerSection">
    <h1 class="text-center fw-bold m-4">Customer Management</h1>

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
                    <tbody id="customerTable"></tbody>
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
                @csrf
                <div class="mb-2">
                    <label for="txtCustomerId" class="form-label fw-bold">Customer ID</label>
                    <input class="form-control" id="txtCustomerId" name="id" type="text" required>
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
                    <button class="btn btn-outline-secondary mx-2 w-100" id="btnGetAllCustomers" type="button">Load
                        All
                    </button>
                    <button class="btn btn-outline-info mx-2 w-100" id="btnResetCustomer" type="reset">Reset</button>
                </div>
            </form>
        </div>

    </div>
</main>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    $(document).ready(function () {
        const $form = $('#customerForm');
        const $customerTable = $('#customerTable');

        // Save Customer
        $('#btnSaveCustomer').click(function (e) {
            e.preventDefault(); // Prevent form submission

            $.ajax({
                url: '{{ route('customer-save') }}',
                type: 'POST',
                data: $form.serialize(), // Serialize form data
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    alert(data.message);
                    loadCustomers();
                },
                error: function (xhr) {
                    console.error('Error:', xhr.responseText);
                }
            });
        });

        // Search Customer
        $('#btnSearchCustomer').click(function () {
            const query = $('#txtSearchCustomer').val();
            $.ajax({
                url: '{{ route('customer-search') }}',
                type: 'GET',
                data: {query: query},
                success: function (customers) {
                    $customerTable.empty();
                    $.each(customers, function (index, customer) {
                        $customerTable.append(`
                            <tr>
                                <td>${customer.id}</td>
                                <td>${customer.name}</td>
                                <td>${customer.address}</td>
                                <td>${customer.salary}</td>
                            </tr>
                        `);
                    });
                },
                error: function (xhr) {
                    console.error('Error:', xhr.responseText);
                }
            });
        });

        // Update Customer
        $('#btnUpdateCustomer').click(function (e) {
            e.preventDefault(); // Prevent form submission

            $.ajax({
                url: '{{ route('customer-update', '') }}/' + $('#txtCustomerId').val(),
                type: 'PUT',
                data: $form.serialize(), // Serialize form data
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    alert(data.message);
                    loadCustomers();
                },
                error: function (xhr) {
                    console.error('Error:', xhr.responseText);
                }
            });
        });

        // Delete Customer
        $('#btnDeleteCustomer').click(function (e) {
            e.preventDefault(); // Prevent form submission

            $.ajax({
                url: '{{ route('customer-delete', '') }}/' + $('#txtCustomerId').val(),
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    alert(data.message);
                    loadCustomers();
                },
                error: function (xhr) {
                    console.error('Error:', xhr.responseText);
                }
            });
        });

        // Get All Customers
        $('#btnGetAllCustomers').click(function () {
            loadCustomers();
        });

        function loadCustomers() {
            $.ajax({
                url: '{{ route('customers-get-all') }}',
                type: 'GET',
                success: function (customers) {
                    $customerTable.empty();
                    $.each(customers, function (index, customer) {
                        $customerTable.append(`
                            <tr>
                                <td>${customer.id}</td>
                                <td>${customer.name}</td>
                                <td>${customer.address}</td>
                                <td>${customer.salary}</td>
                            </tr>
                        `);
                    });
                },
                error: function (xhr) {
                    console.error('Error:', xhr.responseText);
                }
            });
        }
    });
</script>
