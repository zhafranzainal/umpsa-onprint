@php $editing = isset($complaint) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.select name="delivery_id" label="Delivery" required>
            @php $selected = old('delivery_id', ($editing ? $complaint->delivery_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Delivery</option>
            @foreach($deliveries as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea
            name="description"
            label="Description"
            maxlength="255"
            required
            >{{ old('description', ($editing ? $complaint->description : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="status" label="Status">
            @php $selected = old('status', ($editing ? $complaint->status : 'open')) @endphp
            <option value="open" {{ $selected == 'open' ? 'selected' : '' }} >Open</option>
            <option value="resolved" {{ $selected == 'resolved' ? 'selected' : '' }} >Resolved</option>
            <option value="reopened" {{ $selected == 'reopened' ? 'selected' : '' }} >Reopened</option>
            <option value="closed" {{ $selected == 'closed' ? 'selected' : '' }} >Closed</option>
        </x-inputs.select>
    </x-inputs.group>
</div>
