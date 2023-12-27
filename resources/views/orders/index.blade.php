<x-app-layout>

    <div class="container">
        <div class="row mt-4" id="border-line">

            @foreach ($campuses as $campus)
                <div class="col-md-4">
                    <div class="box">

                        <img src= "{{ asset('assets/images/campus.jpg') }}" style="width: 50px; height: 50px;"
                            alt= "printing">

                        <a href="campus-pekan.php">
                            <h5>{{ $campus->name }}</h5>
                        </a>

                        <p>{{ $campus->outlets->count() }} printing service outlets at {{ $campus->name }}</p>

                    </div>
                </div>
            @endforeach

        </div>
    </div>

</x-app-layout>
