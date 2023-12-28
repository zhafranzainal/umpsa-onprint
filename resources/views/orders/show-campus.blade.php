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

            @foreach ($categories as $category)
                <div class="col-md-3">
                    <div class="card">

                        <img class="card-img-top img-fluid" src="{{ asset($category->image) }}" alt="Card image cap">

                        <div class="card-body">

                            <p class="card-text">
                                {{ $category->name }}
                            </p>

                            <p class="card-cost">RM{{ $category->price }}</p>
                            <a href="{{ route('orders.create') }}"><button>Add to Cart</button></a>

                        </div>

                    </div>
                </div>
            @endforeach

        </div>

    </div>

</x-app-layout>
