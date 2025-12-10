@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>People</h1>
    <a href="{{ route('people.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> New Person
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-hover table-striped mb-0">
            <thead class="table-light">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($people as $person)
                <tr>
                    <td class="align-middle">{{ $person->name }}</td>
                    <td class="align-middle">{{ $person->email }}</td>
                    <td class="text-end">
                        <div class="btn-group" role="group">
                            <a href="{{ route('people.show', $person) }}" class="btn btn-sm btn-outline-info" title="Details">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('people.edit', $person) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button type="button" class="btn btn-sm btn-outline-danger" title="Delete" disabled>
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center py-5 text-muted">
                        <i class="fas fa-user-slash fa-2x mb-3"></i><br>
                        Don't have people registered.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">
    {{ $people->links('pagination::bootstrap-5') }}
</div>
@endsection
