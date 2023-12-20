@php $editing = isset($delivery) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.select name="transaction_id" label="Transaction" required>
            @php $selected = old('transaction_id', ($editing ? $delivery->transaction_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Transaction</option>
            @foreach($transactions as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="commission_fee"
            label="Commission Fee"
            :value="old('commission_fee', ($editing ? $delivery->commission_fee : ''))"
            max="255"
            step="0.01"
            placeholder="Commission Fee"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.date
            name="delivered_date"
            label="Delivered Date"
            value="{{ old('delivered_date', ($editing ? optional($delivery->delivered_date)->format('Y-m-d') : '')) }}"
            max="255"
            required
        ></x-inputs.date>
    </x-inputs.group>
</div>
