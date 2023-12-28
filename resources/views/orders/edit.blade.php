<x-app-layout>

    <div class="container" id="card">
        <div class="row">
            <div class="col">
                <div class="card p-4" id="cards">

                    <a href="{{ route('campuses.index') }}" class="button">
                        @lang('crud.common.back')
                    </a>

                    <br>
                    <h5 class="text-dark pl-4">@lang('crud.orders.edit_title')</h5>

                    <x-form method="PUT" action="{{ route('orders.update', $order) }}" class="mt-4">

                        @include('orders.form-inputs')

                        <div class="mt-10">
                            <button type="submit" class="button button-primary float-right">
                                @lang('crud.common.update')
                            </button>
                        </div>

                        @foreach ($errors->all() as $error)
                            <span class="text-danger">{{ $error }}</span><br>
                        @endforeach

                    </x-form>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
