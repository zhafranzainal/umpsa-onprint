<div class="top-header bg-primary">
    <div class="container">
        <div class="row">

            <div class="col-md-7 mt-2">
                <ul>
                    <li><a href="{{ route('dashboard') }}">Home</a></li>
                    <li><a href="{{ route('orders.index') }}">Order</a></li>
                    <li><a href="(4) Payment/payment.php">Payment</a></li>
                    <li><a href="{{ route('deliveries.index') }}">Delivery</a></li>
                    <li><a href="(6) Sales and Admin/admin.html">Sales and Admin</a></li>
                </ul>
            </div>

            @if (Route::has('login'))
                <div class="col-md-5 mt-2 ">
                    @auth
                        <h6>Welcome to OnPrint!</h6>
                    @else
                        <h6><a href="{{ route('login') }}" style="color: white;">Login</a></h6>
                    @endauth
                </div>
            @endif

        </div>
    </div>
</div>

<div class="container mt-4" id="top-logo">
    <div class="row">

        <div class="col-md-2" style="right: 5%;">
            <nav class="navbar navbar-light">
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('assets/images/logo.png') }}" width="auto" height="50">
                </a>
            </nav>
        </div>

        <div class="col-md-7" id="searchbar">
            <div class="input-group mt-3">
                <input type="text" class="form-control" placeholder="Search" aria-label="Search"
                    aria-describedby="button-addon2">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="button" id="button-addon2"><i
                            class="fas fa-search"></i></button>
                </div>
            </div>
        </div>

        <div class="col-md-3 mt-2" id="icons">

            <a href="{{ route('profile.show') }}">
                <div class="circle float-right" title="Manage Profile">
                    <i class="fas fa-user text-primary"></i>
                </div>
            </a>

            <a href="(3) Printing Order/cart.html">
                <div class="circle float-right mr-2">
                    <i class="fas fa-shopping-cart text-primary"></i>
                    <sup><span class="badge badge-danger" style="width: 23px;">0</span></sup>
                </div>
            </a>

        </div>

    </div>
</div>
<hr>

<div class="container" style="height: 30px;">
    <nav class="navbar navbar-expand-lg navbar-light" style="height: 30px;">

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse pl-4" id="navbarNav">
            <ul class="navbar-nav">

                <li class="nav-item dropdown">

                    <a class="nav-link dropdown" data-toggle="dropdown" href="#" role="button"
                        aria-haspopup="true" aria-expanded="false"> <span> ≡ All Category</span></a>

                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Comb Bind Notebook</a>
                        <a class="dropdown-item" href="#">Tape Bind Notebook</a>
                        <a class="dropdown-item" href="#">Certificate Printing</a>
                        <a class="dropdown-item" href="#">Thesis Hard Cover</a>
                        <a class="dropdown-item" href="#">Poster</a>
                    </div>

                </li>

                <li class="nav-item dropdown">

                    <a class="nav-link dropdown" data-toggle="dropdown" href="#" role="button"
                        aria-haspopup="true" aria-expanded="false">
                        Campus
                    </a>

                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="(3) Printing Order/campus-pekan.php">UMP Pekan</a>
                        <a class="dropdown-item" href="(3) Printing Order/campus-gambang.php">UMP Gambang</a>
                    </div>

                </li>

            </ul>
        </div>
    </nav>

</div>
<hr>
