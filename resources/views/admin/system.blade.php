@extends('layouts.admin')

@section('title', 'System Info — Amiri CMS')

@section('content')

<div class="page-header">
    <h1>System Information</h1>
</div>

<div class="panel" style="max-width: 720px;">
    <div class="panel-body">
        <div class="table-wrap">
            <table>
                <tbody>
                    @foreach ($info as $key => $value)
                        <tr>
                            <td style="width: 40%; color: var(--text-muted);"><strong>{{ $key }}</strong></td>
                            <td>
                                @if ($key === 'Debug Mode')
                                    <span class="badge {{ $value === 'On' ? 'badge-danger' : 'badge-success' }}">{{ $value }}</span>
                                @else
                                    {{ $value }}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection