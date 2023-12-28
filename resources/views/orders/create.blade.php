<x-app-layout>

    <div class="container" id="card">
        <div class="row">
            <div class="col">
                <div class="card p-4" id="cards">

                    <a href="{{ route('orders.index-campus') }}" class="button">
                        @lang('crud.common.back')
                    </a>

                    <br>
                    <h5 class="text-dark pl-4">@lang('crud.orders.create_title')</h5>

                    <form method="POST" action="{{ route('orders.store') }}" class="mt-4">
                        @csrf

                        @include('orders.form-inputs')

                        <div class="mt-10">
                            <button type="submit" class="button button-primary float-right">
                                @lang('crud.common.create')
                            </button>
                        </div>

                        @foreach ($errors->all() as $error)
                            <span class="text-danger">{{ $error }}</span><br>
                        @endforeach

                    </form>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
