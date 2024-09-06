<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Order Details</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>
<main>
    <section id="orderDetailsSection">
        <h1 class="text-center fw-bold mt-4">Order Details</h1>

        <div class="row justify-content-center">
            <div class="col-10 mt-5">
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
    </section>
</main>

</body>
</html>
