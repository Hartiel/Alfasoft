@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card border-warning">
            <div class="card-header bg-warning text-dark">
                <h4 class="mb-0">Edit Contact for {{ $person->name }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('contacts.update', $contact) }}" method="POST">
                    @csrf
                    @method('PUT') <div class="mb-4">
                        <label for="country_code" class="form-label">Country (Code)</label>
                        <select id="country_code" name="country_code" autocomplete="off">
                            <option value="">Select country...</option>
                            @foreach($countries as $country)
                                <option value="{{ $country['code'] }}"
                                    {{ (old('country_code') == $country['code'] || $contact->country_code == $country['code']) ? 'selected' : '' }}>
                                    {{ $country['label'] }}
                                </option>
                            @endforeach
                        </select>
                        @error('country_code')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="number" class="form-label">Phone</label>
                        <div class="input-group">
                            <span class="input-group-text" id="ddi-display">+{{ $contact->country_code }}</span>
                            <input type="text"
                                   class="form-control @error('number') is-invalid @enderror"
                                   id="number"
                                   name="number"
                                   value="{{ old('number', $contact->number) }}"
                                   maxlength="9"
                                   required>
                        </div>
                        <div class="form-text">Must be exactly 9 digits.</div>
                        @error('number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="{{ route('people.show', $person->id) }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-warning">Update Contact</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.bootstrap5.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var control = new TomSelect("#country_code", {
            create: false,
            sortField: { field: "text", direction: "asc" }
        });

        var ddiDisplay = document.getElementById('ddi-display');

        control.on('change', function(value) {
            ddiDisplay.innerText = value ? '+' + value : '+';
        });
    });
</script>
@endpush
