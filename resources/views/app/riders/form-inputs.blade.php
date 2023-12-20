@php $editing = isset($rider) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.select name="user_id" label="User" required>
            @php $selected = old('user_id', ($editing ? $rider->user_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the User</option>
            @foreach($users as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="total_commission"
            label="Total Commission"
            :value="old('total_commission', ($editing ? $rider->total_commission : ''))"
            max="255"
            step="0.01"
            placeholder="Total Commission"
            required
        ></x-inputs.number>
    </x-inputs.group>
</div>
