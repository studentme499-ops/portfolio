@extends('layouts.admin')

@section('title', 'Site Settings — Amiri CMS')

@section('content')

<div class="page-header">
    <h1>Site Settings</h1>
</div>

<form method="POST" action="{{ route('admin.settings.update') }}">
    @csrf

    <div class="panel">
        <div class="panel-header"><h3>General</h3></div>
        <div class="panel-body">
            <div class="form-grid">
                <div class="form-group">
                    <label>Website Name</label>
                    <input type="text" name="website_name" value="{{ old('website_name', $general['website_name'] ?? '') }}">
                </div>
                <div class="form-group">
                    <label>Logo</label>
                    <input type="text" name="logo" value="{{ old('logo', $general['logo'] ?? '') }}" placeholder="/storage/logos/logo.png">
                </div>
                <div class="form-group">
                    <label>Favicon</label>
                    <input type="text" name="favicon" value="{{ old('favicon', $general['favicon'] ?? '') }}" placeholder="/favicon.ico">
                </div>
                <div class="form-group">
                    <label>Timezone</label>
                    <input type="text" name="timezone" value="{{ old('timezone', $general['timezone'] ?? '') }}">
                </div>
                <div class="form-group">
                    <label>Language</label>
                    <input type="text" name="language" value="{{ old('language', $general['language'] ?? '') }}">
                </div>
            </div>
        </div>
    </div>

    <div class="panel">
        <div class="panel-header"><h3>Appearance</h3></div>
        <div class="panel-body">
            <div class="form-grid">
                <div class="form-group">
                    <label>Primary Color</label>
                    <input type="color" name="primary_color" value="{{ old('primary_color', $appearance['primary_color'] ?? '#635bff') }}" style="height: 42px; width: 120px; padding: 4px;">
                </div>
                <div class="form-group">
                    <label class="form-check">
                        <input type="checkbox" name="dark_mode" value="1" {{ ($appearance['dark_mode'] ?? true) ? 'checked' : '' }}>
                        Dark mode
                    </label>
                </div>
            </div>
        </div>
    </div>

    <div class="panel">
        <div class="panel-header"><h3>Footer</h3></div>
        <div class="panel-body">
            <div class="form-group">
                <label>Copyright</label>
                <input type="text" name="copyright" value="{{ old('copyright', $footer['copyright'] ?? '') }}">
            </div>
            <div class="form-group">
                <label>Footer Description</label>
                <textarea name="footer_description" rows="3">{{ old('footer_description', $footer['footer_description'] ?? '') }}</textarea>
            </div>
        </div>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Save Settings</button>
    </div>
</form>

@endsection
