<x-app-layout>

    <div class="container">
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">

            <div class="carousel-inner">

                <div class="carousel-item active">
                    <img class="d-block w-100" src="{{ asset('assets/images/comb_bind_notebook.jpg') }}" alt="First slide"
                        class="img-fluid">
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

            @foreach ($categories as $category)
                <div class="col-md-3">
                    <div class="card">

                        <img class="card-img-top img-fluid" src="{{ asset($category->image) }}" alt="Card image cap">

                        <div class="card-body">
                            <p class="card-text">
                                {{ $category->name }}
                            </p>
                        </div>

                    </div>
                </div>
            @endforeach

        </div>

    </div>

</x-app-layout>
