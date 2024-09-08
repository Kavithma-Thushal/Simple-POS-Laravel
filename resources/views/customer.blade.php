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
            <form action="{{ route('save-customer') }}" method="POST">
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
                    <button class="btn btn-outline-warning mx-2 w-100" id="btnUpdateCustomer" type="button">Update</button>
                    <button class="btn btn-outline-danger mx-2 w-100" id="btnDeleteCustomer" type="button">Delete</button>
                    <button class="btn btn-outline-secondary mx-2 w-100" id="btnLoadAllCustomers" type="button">Load All</button>
                    <button class="btn btn-outline-info mx-2 w-100" id="btnResetCustomer" type="reset">Reset</button>
                </div>
            </form>
        </div>

    </div>
</main>
