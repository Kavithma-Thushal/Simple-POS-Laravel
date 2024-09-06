<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Customer Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>
<main>
    <section id="customerSection">
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
                <form>
                    <div class="mb-2">
                        <label for="txtSearchCustomer" class="form-label fw-bold">Search Customer</label>
                        <div class="d-flex">
                            <input class="form-control me-2" id="txtSearchCustomer" type="text">
                            <button class="btn btn-outline-success" id="btnSearchCustomer"
                                    type="button">Search
                            </button>
                        </div>
                    </div>
                    <div class="mb-2">
                        <label for="txtCustomerId" class="form-label fw-bold">Customer ID</label>
                        <input class="form-control" id="txtCustomerId" type="text" disabled>
                        <div id="txtCusIdError" class="text-danger mt-1"></div>
                    </div>
                    <div class="mb-2">
                        <label for="txtCustomerName" class="form-label fw-bold">Customer Name</label>
                        <input class="form-control" id="txtCustomerName" type="text">
                        <div id="txtCusNameError" class="text-danger mt-1"></div>
                    </div>
                    <div class="mb-2">
                        <label for="txtCustomerAddress" class="form-label fw-bold">Customer Address</label>
                        <input class="form-control" id="txtCustomerAddress" type="text">
                        <div id="txtCusAddressError" class="text-danger mt-1"></div>
                    </div>
                    <div class="mb-2">
                        <label for="txtCustomerSalary" class="form-label fw-bold">Customer Salary</label>
                        <input class="form-control" id="txtCustomerSalary" type="number">
                        <div id="txtCusSalaryError" class="text-danger mt-1"></div>
                    </div>
                    <div class="d-flex justify-content-center mt-4">
                        <button class="btn btn-outline-primary mx-2 w-100" id="btnSaveCustomer" type="button">Save
                        </button>
                        <button class="btn btn-outline-warning mx-2 w-100" id="btnUpdateCustomer"
                                type="button">Update
                        </button>
                        <button class="btn btn-outline-danger mx-2 w-100" id="btnDeleteCustomer"
                                type="button">Delete
                        </button>
                        <button class="btn btn-outline-secondary mx-2 w-100" id="btnLoadAllCustomers"
                                type="button">Load
                            All
                        </button>
                        <button class="btn btn-outline-info mx-2 w-100" id="btnResetCustomer" type="button">Reset
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </section>
</main>

</body>
</html>
