<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Simple POS</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>
<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <div class="navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('customer') }}" target="_blank">Customer</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('item') }}" target="_blank">Item</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('placeOrder') }}" target="_blank">Place Order</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('orderDetails') }}" target="_blank">Order Details</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Dashboard -->
<section id="dashboardSection" class="container-fluid my-5">

    <div class="d-flex justify-content-center">

        <!-- Customer Count -->
        <div class="col-3 m-5">
            <div class="card text-center shadow-lg border-light rounded">
                <div class="card-body">
                    <h3 class="card-title mb-3">Customer Count</h3>
                    <h3 id="customerCount" class="card-text display-5">00</h3>
                </div>
            </div>
        </div>

        <!-- Item Count -->
        <div class="col-3 m-5">
            <div class="card text-center shadow-lg border-light rounded">
                <div class="card-body">
                    <h3 class="card-title mb-3">Item Count</h3>
                    <h3 id="itemCount" class="card-text display-5">00</h3>
                </div>
            </div>
        </div>

        <!-- Order Count -->
        <div class="col-3 m-5">
            <div class="card text-center shadow-lg border-light rounded">
                <div class="card-body">
                    <h3 class="card-title mb-3">Order Count</h3>
                    <h3 id="orderCount" class="card-text display-5">00</h3>
                </div>
            </div>
        </div>
    </div>
</section>

</body>
</html>
