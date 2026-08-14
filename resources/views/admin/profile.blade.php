@extends('layouts.admin')

@section('title', 'My Profile — Amiri CMS')

@section('content')

<div class="container admin-container">
    <h2 style="margin-bottom: 24px;">My Profile</h2>

    <div class="admin-section">
        <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 32px;">
            <div style="width: 56px; height: 56px; background: var(--accent); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700;">AB</div>
            <div>
                <h3>Amiri Bajuun</h3>
                <p style="font-size: 11px; color: var(--text-muted);">amiri.bajuun@studio.com</p>
            </div>
        </div>

        <form>
            <div class="form-grid">
                <div class="input-group">
                    <label>Full Name</label>
                    <input type="text" value="Amiri Bajuun">
                </div>
                <div class="input-group">
                    <label>Email Address</label>
                    <input type="email" value="amiri.bajuun@studio.com">
                </div>
            </div>

            <div class="input-group">
                <label>Bio</label>
                <textarea rows="4">Architectural visualizer and modernist designer. Specializing in high-end structural renders and ecological interior frameworks.</textarea>
            </div>

            <button type="button" class="btn-primary" style="margin-top: 10px;">Update Profile</button>
        </form>
    </div>
</div>

@endsection
