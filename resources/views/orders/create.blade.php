<x-app-layout>

    <div class="container" id="card">
        <div class="row">
            <div class="col-md-8">
                <div class="card p-4" id="cards">

                    <a href="{{ route('orders.index-campus') }}" class="button">
                        @lang('crud.common.back')
                    </a>

                    <form method="POST" action="{{ route('orders.store') }}" class="mt-4">

                        @include('orders.form-inputs')

                        <div class="mt-10">

                            <button type="submit" class="button button-primary float-right">
                                @lang('crud.common.create')
                            </button>

                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
