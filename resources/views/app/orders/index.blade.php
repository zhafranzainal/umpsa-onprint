<x-app-layout>

    <div class="container">
        <div class="row mt-4" id="border-line">

            <div class="col-md-4">
                <div class="box">
                    <img class="fas fa-truck fa-2x mb-3 mt-4 text-primary" src= "{{ asset('assets/images/campus.jpg') }}"
                        style="width:50px;height:50px;" alt= "printing">
                    <a href="campus-pekan.php">
                        <h5>UMP PEKAN</h5>
                    </a>
                    <p>3 available printing services outlet in UMP PEKAN</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="box">
                    <img class="fas fa-truck fa-2x mb-3 mt-4 text-primary" src= "{{ asset('assets/images/campus.jpg') }}"
                        style="width:50px;height:5s0px;" alt= "printing">
                    <a href="campus-gambang.php">
                        <h5>UMP GAMBANG</h5>
                    </a>
                    <p>3 available printing services outlet in UMP GAMBANG</p>
                </div>
            </div>

        </div>
    </div>

</x-app-layout>
