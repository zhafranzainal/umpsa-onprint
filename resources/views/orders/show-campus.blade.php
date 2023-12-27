<x-app-layout>

    <div class="container">
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">

            <div class="carousel-inner">

                <div class="carousel-item active">
                    <img class="d-block w-100" src="{{ asset('assets/images/umppekan1.jpg') }}"
                        style="width:100px;height:500px;" alt="First slide" class="img-fluid">
                </div>

                <div class="carousel-item">
                    <img class="d-block w-100" src="{{ asset('assets/images/umppekan.jpg') }}"
                        style="width:100px;height:500px;" alt="Second slide" class="img-fluid">
                </div>

                <div class="carousel-item">
                    <img class="d-block w-100" src="{{ asset('assets/images/ump.jpg') }}"
                        style="width:100px;height:500px;" alt="Third slide" class="img-fluid">
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

            @foreach ($campus->outlets as $outlet)
                <div class="col-md-4">
                    <div class="box">
                        <img src="{{ asset('assets/images/printicon.jpg') }}"
                            style="width: 50px; height: 50px; margin-top: 25px; margin-bottom: 15px" alt="printing">
                        <h5>{{ $outlet->name }}</h5>
                        <p>A shop that offers a reasonable price for printing services </p>
                    </div>
                </div>
            @endforeach

        </div>
    </div>

    <br>
    <br>

    <div class="container cardItem" id="products">

        <h2>Popular Packages</h2>
        <br>

        <div class="row">

            <div class="col-md-3">
                <div class="card">

                    <img class="card-img-top img-fluid" src="../../Assets (images)/combbind.jpg"
                        style="width:50px;height:50px;" alt="Card image cap">

                    <div class="card-body">

                        <p class="card-text">
                            <a href="inner-productpage.html" class="text-dark">
                                Comb Bind Notebook
                            </a>
                        </p>

                        <div class="ratings">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-secondary"></i>
                            <label class="text-secondary ml-3">30 reviews</label>
                        </div>

                        <p class="card-cost">RM7.00</p>
                        <a href="cart.php"><button>Add to Cart</button></a>

                        <form action="/action_page.php">
                            <input type="file" id="myFile" name="filename">
                            <input type="submit">
                        </form>

                    </div>

                </div>
            </div>

            <div class="col-md-3">
                <div class="card">
                    <img class="card-img-top img-fluid" src="../../Assets (images)/tapebind.jpg"
                        style="width:50px;height:50px;" alt="Card image cap">
                    <div class="card-body">
                        <p class="card-text"><a href="inner-productpage.html" class="text-dark">Tape Bind Notebook</a>
                        </p>
                        <div class="ratings">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-secondary"></i>
                            <label class="text-secondary ml-3">22 reviews</label>
                        </div>
                        <p class="card-cost">RM5.00</p>
                        <a href="cart.php"><button>Add to Cart</button></a>
                        <form action="/action_page.php">
                            <input type="file" id="myFile" name="filename">
                            <input type="submit">
                        </form>

                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <img class="card-img-top img-fluid" src="../../Assets (images)/thesis.jpg"
                        style="width:50px;height:50px;" alt="Card image cap">
                    <div class="card-body">
                        <p class="card-text"><a href="inner-productpage.html" class="text-dark">Thesis Hard Cover</a>
                        </p>
                        <div class="ratings">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-secondary"></i>
                            <label class="text-secondary ml-3">10 reviews</label>
                        </div>
                        <p class="card-cost">RM15.00</p>
                        <a href="cart.php"><button>Add to Cart</button></a>
                        <form action="/action_page.php">
                            <input type="file" id="myFile" name="filename">
                            <input type="submit">
                        </form>

                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card">

                    <img class="card-img-top img-fluid" src="../../Assets (images)/poster.jpg"
                        style="width:50px;height:50px;" alt="Card image cap">

                    <div class="card-body">

                        <p class="card-text"><a href="inner-productpage.html" class="text-dark">Poster</a></p>

                        <div class="ratings">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-secondary"></i>
                            <label class="text-secondary ml-3">28 reviews</label>
                        </div>

                        <p class="card-cost">RM8.00</p>

                        <a href="cart.php"><button>Add to Cart</button></a>

                        <form action="/action_page.php">
                            <input type="file" id="myFile" name="filename">
                            <input type="submit">
                        </form>

                    </div>

                </div>
            </div>

        </div>

    </div>

</x-app-layout>
