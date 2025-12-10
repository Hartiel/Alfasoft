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
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>Contacts</h4>
            <a href="{{ route('contacts.create', ['person_id' => $person->id]) }}" class="btn btn-success btn-sm">
                Add new contact
            </a>
        </div>

        @if($person->contacts->count() > 0)
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Country</th>
                        <th>Number</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($person->contacts as $contact)
                    <tr>
                        <td>+{{ $contact->country_code }}</td>
                        <td>{{ $contact->number }}</td>
                        <td class="text-end">
                            <a href="{{ route('contacts.edit', $contact) }}" class="btn btn-sm btn-warning">Edit</a>

                            <form action="{{ route('contacts.destroy', $contact) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this contact?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="alert alert-secondary">
                No contacts found.
            </div>
        @endif
    </div>
</div>
@endsection
