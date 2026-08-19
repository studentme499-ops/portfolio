@extends('layouts.admin')

@section('title', 'Contact Settings — Amiri CMS')

@section('content')

<div class="page-header">
    <h1>Contact Information</h1>
</div>

<form method="POST" action="{{ route('admin.contact-settings.update') }}">
    @csrf

    <div class="panel">
        <div class="panel-header"><h3>Contact Details</h3></div>
        <div class="panel-body">
            <div class="form-grid">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ old('email', $contact['email'] ?? '') }}">
                </div>
                <div class="form-group">
                    <label>Phone</label>
                    <input type="text" name="phone" value="{{ old('phone', $contact['phone'] ?? '') }}">
                </div>
                <div class="form-group">
                    <label>Location</label>
                    <input type="text" name="location" value="{{ old('location', $contact['location'] ?? '') }}">
                </div>
                <div class="form-group">
                    <label>WhatsApp</label>
                    <input type="text" name="whatsapp" value="{{ old('whatsapp', $contact['whatsapp'] ?? '') }}">
                </div>
                <div class="form-group">
                    <label class="form-check">
                        <input type="checkbox" name="available" value="1" {{ ($contact['available'] ?? false) ? 'checked' : '' }}>
                        Available for work
                    </label>
                </div>
                <div class="form-group">
                    <label>Availability Message</label>
                    <input type="text" name="availability_message" value="{{ old('availability_message', $contact['availability_message'] ?? '') }}">
                </div>
            </div>
        </div>
    </div>

    <div class="panel">
        <div class="panel-header"><h3>Inquiry Settings</h3></div>
        <div class="panel-body">
            <div class="form-grid">
                <div class="form-group">
                    <label>Notification Email</label>
                    <input type="email" name="notification_email" value="{{ old('notification_email', $contact['notification_email'] ?? '') }}">
                </div>
                <div class="form-group full">
                    <label>Auto-Reply Message</label>
                    <textarea name="auto_reply" rows="3">{{ old('auto_reply', $contact['auto_reply'] ?? '') }}</textarea>
                </div>
                <div class="form-group full">
                    <label>Success Message</label>
                    <textarea name="success_message" rows="2">{{ old('success_message', $contact['success_message'] ?? '') }}</textarea>
                </div>
            </div>
        </div>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Save Contact Settings</button>
    </div>
</form>

@endsection
