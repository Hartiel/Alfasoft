@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card border-warning"> <div class="card-header bg-warning text-dark">
                <h4 class="mb-0">Edit person: {{ $person->name }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('people.update', $person) }}" method="POST">
                    @csrf
                    @method('PUT') <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text"
                               class="form-control @error('name') is-invalid @enderror"
                               id="name"
                               name="name"
                               value="{{ old('name', $person->name) }}"
                               required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email"
                               class="form-control @error('email') is-invalid @enderror"
                               id="email"
                               name="email"
                               value="{{ old('email', $person->email) }}"
                               required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('people.index') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-warning">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
