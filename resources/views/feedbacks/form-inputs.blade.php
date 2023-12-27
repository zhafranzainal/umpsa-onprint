@php $editing = isset($feedback) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.select name="complaint_id" label="Complaint" required>
            @php $selected = old('complaint_id', ($editing ? $feedback->complaint_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Complaint</option>
            @foreach($complaints as $value => $label)
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
            >{{ old('description', ($editing ? $feedback->description : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>
</div>
