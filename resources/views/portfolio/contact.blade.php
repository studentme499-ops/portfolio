@extends('layouts.app')

@section('title', 'Contact — Amiri Bajuun')

@section('content')

<div class="container" style="padding: 70px 0;">
    <div style="max-width: 560px; margin: 0 auto;">
        <span class="badge" style="display: block; width: fit-content;">GET IN TOUCH</span>
        <h1 style="font-size: 38px; margin-bottom: 16px;">Let's Work Together</h1>
        <p style="color: var(--text-muted); font-size: 14px; margin-bottom: 32px;">
            Have a project in mind, or looking to expand your engineering squad?
            Send a message and I'll get back within 24 hours.
        </p>

        <form style="background: var(--bg-card); border: 1px solid var(--border); border-radius: 10px; padding: 32px;">
            <div class="form-grid">
                <div class="input-group">
                    <label>Name</label>
                    <input type="text" placeholder="Your name">
                </div>
                <div class="input-group">
                    <label>Email</label>
                    <input type="email" placeholder="you@example.com">
                </div>
            </div>

            <div class="input-group">
                <label>Subject</label>
                <input type="text" placeholder="What's this about?">
            </div>

            <div class="input-group">
                <label>Message</label>
                <textarea rows="5" placeholder="Tell me about your project..."></textarea>
            </div>

            <button type="submit" class="btn-primary">Send Message</button>
        </form>
    </div>
</div>

@endsection
