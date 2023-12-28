@php $editing = isset($order) @endphp

<div class="flex flex-wrap">

    <x-inputs.group class="w-full">
        <x-inputs.select name="outlet_id" label="Outlet" required>

            @php $selected = old('outlet_id', ($editing ? $order->outlet_id : '')) @endphp

            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Outlet</option>

            @foreach ($outlets as $value => $label)
                <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }}>{{ $label }}
                </option>
            @endforeach

        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="category_id" label="Category" required>

            @php $selected = old('category_id', ($editing ? $order->category_id : '')) @endphp

            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the category</option>

            @foreach ($categories as $value => $label)
                <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }}>{{ $label }}
                </option>
            @endforeach

        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="delivery_option_id" label="Delivery Option" required>

            @php $selected = old('delivery_option_id', ($editing ? $order->delivery_option_id : '')) @endphp

            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Delivery Option</option>

            @foreach ($deliveryOptions as $value => $label)
                <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }}>{{ $label }}
                </option>
            @endforeach

        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="transaction_id" label="Transaction" required>

            @php $selected = old('transaction_id', ($editing ? $order->transaction_id : '')) @endphp

            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Transaction</option>

            @foreach ($transactions as $value => $label)
                <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }}>{{ $label }}
                </option>
            @endforeach

        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text name="document_file" label="Document File" :value="old('document_file', $editing ? $order->document_file : '')" maxlength="255"
            placeholder="Document File" required></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number name="quantity" label="Quantity" :value="old('quantity', $editing ? $order->quantity : '')" max="255" placeholder="Quantity"
            required></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number name="total_price" label="Total Price" :value="old('total_price', $editing ? $order->total_price : '')" max="255" step="0.01"
            placeholder="Total Price" required></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number name="point" label="Point" :value="old('point', $editing ? $order->point : '')" max="255" placeholder="Point"
            required></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="status" label="Status">

            @php $selected = old('status', ($editing ? $order->status : 'pending')) @endphp

            <option value="pending" {{ $selected == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="ordered" {{ $selected == 'ordered' ? 'selected' : '' }}>Ordered</option>
            <option value="prepared" {{ $selected == 'prepared' ? 'selected' : '' }}>Prepared</option>
            <option value="picked up" {{ $selected == 'picked up' ? 'selected' : '' }}>Picked up</option>
            <option value="completed" {{ $selected == 'completed' ? 'selected' : '' }}>Completed</option>

        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea name="qr_code" label="Qr Code" maxlength="255"
            required>{{ old('qr_code', $editing ? $order->qr_code : '') }}</x-inputs.textarea>
    </x-inputs.group>

</div>
