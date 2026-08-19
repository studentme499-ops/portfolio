@extends('layouts.admin')

@section('title', 'Roles & Permissions — Amiri CMS')

@section('content')

<div class="page-header">
    <h1>Roles & Permissions</h1>
    <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">+ New Role</a>
</div>

<div class="panel">
    <div class="panel-body">
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Role</th>
                        <th>Slug</th>
                        <th>Users</th>
                        <th>Permissions</th>
                        <th style="text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($items as $item)
                        <tr>
                            <td><strong>{{ $item->name }}</strong></td>
                            <td><code>{{ $item->slug }}</code></td>
                            <td>{{ $item->users_count ?? $item->users->count() }}</td>
                            <td>{{ count($item->permissions ?? []) }} permissions</td>
                            <td style="text-align: right; white-space: nowrap;">
                                <a href="{{ route('admin.roles.edit', $item) }}" class="btn btn-sm">Edit</a>
                                <form method="POST" action="{{ route('admin.roles.destroy', $item) }}" style="display: inline;" onsubmit="return confirm('Delete this role?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="empty-state">No roles yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="margin-top: 14px;">{{ $items->links() }}</div>
    </div>
</div>

@endsection