@php $editing = isset($outlet) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.select name="campus_id" label="Campus" required>
            @php $selected = old('campus_id', ($editing ? $outlet->campus_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Campus</option>
            @foreach($campuses as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="name"
            label="Name"
            :value="old('name', ($editing ? $outlet->name : ''))"
            maxlength="255"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>
</div>
