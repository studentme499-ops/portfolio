@extends('layouts.admin')

@section('title', 'About — Amiri CMS')

@section('content')

<div class="page-header">
    <h1>About Section</h1>
</div>

<form method="POST" action="{{ route('admin.about.update') }}">
    @csrf

    <div class="panel">
        <div class="panel-header"><h3>About Content</h3></div>
        <div class="panel-body">
            <div class="form-grid">
                <div class="form-group">
                    <label>About Title</label>
                    <input type="text" name="title" value="{{ old('title', $about['title'] ?? '') }}">
                </div>
                <div class="form-group">
                    <label>Profile Image URL</label>
                    <input type="text" name="profile_image" value="{{ old('profile_image', $about['profile_image'] ?? '') }}">
                </div>
                <div class="form-group full">
                    <label>Description</label>
                    <textarea name="description" rows="4">{{ old('description', $about['description'] ?? '') }}</textarea>
                </div>
                <div class="form-group full">
                    <label>Biography</label>
                    <textarea name="bio" rows="5">{{ old('bio', $about['bio'] ?? '') }}</textarea>
                </div>
                <div class="form-group">
                    <label>Learn More Text</label>
                    <input type="text" name="learn_more_text" value="{{ old('learn_more_text', $about['learn_more_text'] ?? '') }}">
                </div>
                <div class="form-group">
                    <label>Learn More URL</label>
                    <input type="text" name="learn_more_url" value="{{ old('learn_more_url', $about['learn_more_url'] ?? '') }}">
                </div>
            </div>
        </div>
    </div>

    <div class="panel">
        <div class="panel-header">
            <h3>Statistics</h3>
            <button type="button" class="btn btn-sm" onclick="addStatRow()">+ Add Stat</button>
        </div>
        <div class="panel-body" id="stats-wrap">
            @foreach ($stats as $i => $stat)
                <div class="stat-row" style="display: grid; grid-template-columns: 1fr 2fr 30px; gap: 10px; margin-bottom: 10px;">
                    <input type="text" name="stat_value[]" value="{{ $stat['value'] }}" placeholder="e.g. 5+">
                    <input type="text" name="stat_label[]" value="{{ $stat['label'] }}" placeholder="e.g. Years Experience">
                    <button type="button" class="btn btn-sm btn-danger" onclick="this.closest('.stat-row').remove()">×</button>
                </div>
            @endforeach
        </div>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Save About</button>
    </div>
</form>

<script>
function addStatRow() {
    const wrap = document.getElementById('stats-wrap');
    const row = document.createElement('div');
    row.className = 'stat-row';
    row.style.cssText = 'display: grid; grid-template-columns: 1fr 2fr 30px; gap: 10px; margin-bottom: 10px;';
    row.innerHTML = `
        <input type="text" name="stat_value[]" placeholder="e.g. 5+">
        <input type="text" name="stat_label[]" placeholder="e.g. Years Experience">
        <button type="button" class="btn btn-sm btn-danger" onclick="this.closest('.stat-row').remove()">×</button>`;
    wrap.appendChild(row);
}
</script>

@endsection
