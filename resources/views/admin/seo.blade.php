@extends('layouts.admin')

@section('title', 'SEO — Amiri CMS')

@section('content')

<div class="page-header">
    <h1>SEO Configuration</h1>
</div>

<form method="POST" action="{{ route('admin.seo.update') }}">
    @csrf

    <div class="panel">
        <div class="panel-header"><h3>Global SEO</h3></div>
        <div class="panel-body">
            <div class="form-grid">
                <div class="form-group">
                    <label>Site Title</label>
                    <input type="text" name="site_title" value="{{ old('site_title', $global['site_title'] ?? '') }}">
                </div>
                <div class="form-group">
                    <label>Author</label>
                    <input type="text" name="author" value="{{ old('author', $global['author'] ?? '') }}">
                </div>
                <div class="form-group full">
                    <label>Meta Description</label>
                    <textarea name="meta_description" rows="2" maxlength="160">{{ old('meta_description', $global['meta_description'] ?? '') }}</textarea>
                    <div class="form-help">Recommendation: keep under 160 characters.</div>
                </div>
                <div class="form-group">
                    <label>Keywords</label>
                    <input type="text" name="keywords" value="{{ old('keywords', $global['keywords'] ?? '') }}">
                </div>
                <div class="form-group">
                    <label>Canonical URL</label>
                    <input type="text" name="canonical_url" value="{{ old('canonical_url', $global['canonical_url'] ?? '') }}">
                </div>
                <div class="form-group">
                    <label>OG Image</label>
                    <input type="text" name="og_image" value="{{ old('og_image', $global['og_image'] ?? '') }}" placeholder="/storage/images/og.png">
                </div>
                <div class="form-group">
                    <label>Favicon</label>
                    <input type="text" name="favicon" value="{{ old('favicon', $global['favicon'] ?? '') }}" placeholder="/favicon.ico">
                </div>
            </div>
        </div>
    </div>

    <div class="panel">
        <div class="panel-header"><h3>Per-Page SEO</h3></div>
        <div class="panel-body">
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Page</th>
                            <th>SEO Title</th>
                            <th>Meta Description</th>
                            <th>OG Image</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pages as $key => $page)
                            <tr>
                                <td>
                                    <input type="hidden" name="page_key[]" value="{{ $key }}">
                                    <input type="text" name="page_label[{{ $key }}]" value="{{ $page['page'] }}" style="min-width: 80px;">
                                </td>
                                <td><input type="text" name="seo_title[{{ $key }}]" value="{{ $page['seo_title'] }}"></td>
                                <td><input type="text" name="meta_description[{{ $key }}]" value="{{ $page['meta_description'] }}"></td>
                                <td><input type="text" name="og_image[{{ $key }}]" value="{{ $page['og_image'] }}"></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Save SEO Settings</button>
    </div>
</form>

@endsection