@extends('layouts.admin')

@section('title', 'Users — Amiri CMS')

@section('content')

<div class="page-header">
    <h1>Users</h1>
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">+ New User</a>
</div>

<div class="panel">
    <div class="panel-body">
        <form method="GET" style="margin-bottom: 14px;">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Search by name..." class="search-box" style="width: 280px;">
        </form>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>2FA</th>
                        <th>Status</th>
                        <th style="text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($items as $item)
                        <tr>
                            <td>
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <div style="width: 30px; height: 30px; background: var(--accent); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 11px; font-weight: 700;">
                                        {{ collect(explode(' ', $item->name))->map(fn ($w) => strtoupper(mb_substr($w, 0, 1)))->take(2)->implode('') }}
                                    </div>
                                    <strong>{{ $item->name }}</strong>
                                </div>
                            </td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->role->name ?? '—' }}</td>
                            <td>
                                @if ($item->id === auth()->id() || $item->two_factor_enabled)
                                    <span class="badge {{ $item->two_factor_enabled ? 'badge-success' : 'badge-muted' }}">{{ $item->two_factor_enabled ? 'On' : 'Off' }}</span>
                                @else
                                    <span class="badge badge-muted">Off</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge {{ $item->is_active ? 'badge-success' : 'badge-muted' }}">{{ $item->is_active ? 'Active' : 'Inactive' }}</span>
                            </td>
                            <td style="text-align: right; white-space: nowrap;">
                                <a href="{{ route('admin.users.edit', $item) }}" class="btn btn-sm">Edit</a>
                                @if ($item->id !== auth()->id())
                                    <form method="POST" action="{{ route('admin.users.destroy', $item) }}" style="display: inline;" onsubmit="return confirm('Delete this user?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="empty-state">No users found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="margin-top: 14px;">{{ $items->links() }}</div>
    </div>
</div>

@endsection