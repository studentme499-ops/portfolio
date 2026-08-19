@extends('layouts.admin')

@section('title', 'Homepage — Amiri CMS')

@section('content')

<div class="page-header">
    <h1>Homepage</h1>
</div>

<form method="POST" action="{{ route('admin.homepage.update') }}">
    @csrf

    <div class="panel">
        <div class="panel-header"><h3>Hero Section</h3></div>
        <div class="panel-body">
            <div class="form-grid">
                <div class="form-group">
                    <label>Eyebrow Text</label>
                    <input type="text" name="eyebrow" value="{{ old('eyebrow', $hero['eyebrow'] ?? '') }}">
                </div>
                <div class="form-group">
                    <label>Availability Status</label>
                    <input type="text" name="availability" value="{{ old('availability', $hero['availability'] ?? '') }}">
                </div>
                <div class="form-group full">
                    <label>Main Heading</label>
                    <textarea name="heading" rows="3">{{ old('heading', $hero['heading'] ?? '') }}</textarea>
                </div>
                <div class="form-group full">
                    <label>Description</label>
                    <textarea name="description" rows="4">{{ old('description', $hero['description'] ?? '') }}</textarea>
                </div>
                <div class="form-group">
                    <label>Primary Button Text</label>
                    <input type="text" name="primary_btn" value="{{ old('primary_btn', $hero['primary_btn'] ?? '') }}">
                </div>
                <div class="form-group">
                    <label>Primary Button URL</label>
                    <input type="text" name="primary_url" value="{{ old('primary_url', $hero['primary_url'] ?? '') }}">
                </div>
                <div class="form-group">
                    <label>Secondary Button Text</label>
                    <input type="text" name="secondary_btn" value="{{ old('secondary_btn', $hero['secondary_btn'] ?? '') }}">
                </div>
                <div class="form-group">
                    <label>Secondary Button URL</label>
                    <input type="text" name="secondary_url" value="{{ old('secondary_url', $hero['secondary_url'] ?? '') }}">
                </div>
                <div class="form-group full">
                    <label>Code Editor Content</label>
                    <textarea name="code_editor" rows="8" style="font-family: monospace;">{{ old('code_editor', $hero['code_editor'] ?? '') }}</textarea>
                </div>
            </div>
        </div>
    </div>

    <div class="panel">
        <div class="panel-header"><h3>Homepage Sections</h3></div>
        <div class="panel-body">
            <p style="font-size: 12px; color: var(--text-muted); margin-bottom: 14px;">
                Enable/disable sections and drag to reorder. Order is saved in the order shown.
            </p>

            <div id="sections-sort">
                @foreach ($sections as $i => $section)
                    <div class="section-check" data-key="{{ $section['key'] }}">
                        <input type="hidden" name="sections_order[]" value="{{ $section['key'] }}">
                        <span class="name" style="cursor: grab;">⠿ {{ $section['name'] }}</span>
                        <div class="actions">
                            <label class="form-check">
                                <input type="checkbox" name="sections_enabled[]" value="{{ $section['key'] }}" {{ $section['enabled'] ? 'checked' : '' }}>
                                Enabled
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Save Homepage</button>
    </div>
</form>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const list = document.getElementById('sections-sort');
    if (!list) return;

    let dragEl = null;

    list.querySelectorAll('.section-check .name').forEach(el => {
        el.addEventListener('dragstart', e => {
            dragEl = e.target.closest('.section-check');
            e.dataTransfer.effectAllowed = 'move';
        });
    });

    list.querySelectorAll('.section-check').forEach(el => {
        el.addEventListener('dragover', e => e.preventDefault());
        el.addEventListener('drop', e => {
            e.preventDefault();
            if (!dragEl || dragEl === el) return;
            list.insertBefore(dragEl, el.nextSibling);
        });
    });
});
</script>

@endsection
