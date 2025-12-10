@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
        <h3 class="mb-0">{{ $person->name }}</h3>
        <div>
            <a href="{{ route('people.edit', $person) }}" class="btn btn-light btn-sm">Edit</a>
            <a href="{{ route('people.index') }}" class="btn btn-dark btn-sm">Back</a>
        </div>
    </div>
    <div class="card-body">
        <p><strong>Email:</strong> {{ $person->email }}</p>
        <p><strong>Created At:</strong> {{ $person->created_at->format('d/m/Y H:i') }}</p>

        <hr>
        <h4>Contacts</h4>
        <div class="alert alert-secondary">
            Don't have contacts.
        </div>

        <button class="btn btn-success" disabled>Add new contact</button>
    </div>
</div>
@endsection
