<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Online Printing System (OnPrint)</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css"
        integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">

    <link href="https://bootstrap-ecommerce.com/bootstrap-ecommerce-html/images/favicon.ico" rel="shortcut icon"
        type="image/x-icon">

</head>

<body>

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
                            <h6><a href="{{ url('/dashboard') }}" style="color: white;">Dashboard</a></h6>
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

    <div class="container">
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">

            <div class="carousel-inner">

                <div class="carousel-item active">
                    <img class="d-block w-100" src="{{ asset('assets/images/comb_bind_notebook.jpg') }}"
                        alt="First slide" class="img-fluid">

                </div>

                <div class="carousel-item">
                    <img class="d-block w-100" src="{{ asset('assets/images/tape_bind_notebook.jpg') }}"
                        alt="Second slide" class="img-fluid">
                </div>

                <div class="carousel-item">
                    <img class="d-block w-100" src="{{ asset('assets/images/certificate_printing.jpg') }}"
                        alt="Third slide" class="img-fluid">
                </div>

                <div class="carousel-item">
                    <img class="d-block w-100" src="{{ asset('assets/images/thesis_hard_cover.jpg') }}"
                        alt="Fourth slide" class="img-fluid">
                </div>

                <div class="carousel-item">
                    <img class="d-block w-100" src="{{ asset('assets/images/poster.jpg') }}" alt="Fifth slide"
                        class="img-fluid">
                </div>

            </div>

            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

    <div class="container">
        <div class="row mt-4" id="border-line">

            <div class="col-md-4">
                <div class="box">
                    <i class="fas fa-clipboard fa-2x mb-3 mt-4 text-primary"></i>
                    <h5>Make order</h5>
                    <p>Fast and convenient ordering process</p>
                </div>

            </div>

            <div class="col-md-4">
                <div class="box">
                    <i class="fas fa-money-bill fa-2x mb-3 mt-4 text-primary"></i>
                    <h5>Make payment</h5>
                    <p>Fast and convenient payment checkout</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="box">
                    <i class="fas fa-truck fa-2x mb-3 mt-4 text-primary"></i>
                    <h5>Fast delivery</h5>
                    <p>Incredibly fast shipping with affordable price</p>
                </div>
            </div>

        </div>
    </div>

    <br> <br>

    <div class="container cardItem" id="products">

        <h2>Popular Products</h2>
        <br>

        <div class="row">

            <div class="col-md-3">
                <div class="card">

                    <img class="card-img-top img-fluid" src="{{ asset('assets/images/comb_bind_notebook.jpg') }}"
                        alt="Card image cap">

                    <div class="card-body">

                        <p class="card-text"><a href="inner-productpage.html" class="text-dark">Comb Bind
                                Notebook</a>
                        </p>

                        <div class="ratings">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-secondary"></i>
                            <label class="text-secondary ml-3">34 reviews</label>
                        </div>

                        <p class="card-cost">RM179.00</p>

                    </div>

                </div>
            </div>

            <div class="col-md-3">
                <div class="card">

                    <img class="card-img-top img-fluid" src="{{ asset('assets/images/tape_bind_notebook.jpg') }}"
                        alt="Card image cap">

                    <div class="card-body">

                        <p class="card-text"><a href="inner-productpage.html" class="text-dark">Tape Bind
                                Notebook</a>
                        </p>

                        <div class="ratings">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-secondary"></i>
                            <label class="text-secondary ml-3">30 reviews</label>
                        </div>

                        <p class="card-cost">RM280.00</p>

                    </div>

                </div>
            </div>

            <div class="col-md-3">
                <div class="card">

                    <img class="card-img-top img-fluid" src="{{ asset('assets/images/certificate_printing.jpg') }}"
                        alt="Card image cap">

                    <div class="card-body">

                        <p class="card-text"><a href="inner-productpage.html" class="text-dark">Certificate
                                Printing</a>
                        </p>

                        <div class="ratings">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-secondary"></i>
                            <label class="text-secondary ml-3">28 reviews</label>
                        </div>

                        <p class="card-cost">RM56.00</p>

                    </div>

                </div>
            </div>

            <div class="col-md-3">
                <div class="card">

                    <img class="card-img-top img-fluid" src="{{ asset('assets/images/thesis_hard_cover.jpg') }}"
                        alt="Card image cap">

                    <div class="card-body">

                        <p class="card-text"><a href="inner-productpage.html" class="text-dark">Thesis Hard Cover</a>
                        </p>

                        <div class="ratings">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-secondary"></i>
                            <label class="text-secondary ml-3">25 reviews</label>
                        </div>

                        <p class="card-cost">RM179.00</p>

                    </div>

                </div>
            </div>

        </div>

    </div>

    <br>
    <br>

    <footer>
        <br><br>
        <div class="container">
            <div class="row">

            </div>
        </div>
    </footer>

    <footer class="footer pt-5 pb-5" id="footer">
        <div class="container">

            <span class="text-muted float-left">
                <p id="copyright">&copy; 2022 Section 02B GP5</p>
            </span>

            <span class="float-right">
                <p id="footerInfo"> Zhafran | Anishah | Amalin | Hamizah</p>
            </span>

        </div>
    </footer>

</body>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
    integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
</script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
    integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
</script>

<script src="js/script.js"></script>

</html>
