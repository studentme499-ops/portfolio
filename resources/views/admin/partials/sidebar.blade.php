<aside class="sidebar">
    <div class="sidebar-brand">
        <div class="logo-mark">A</div>
        <strong>AMIRI CMS</strong>
    </div>

    <div class="sidebar-section">
        <div class="sidebar-label">Main</div>
        <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <span class="ic">▦</span><span>Dashboard</span>
        </a>
    </div>

    <div class="sidebar-section">
        <div class="sidebar-label">Website</div>
        <a href="{{ route('admin.homepage') }}" class="sidebar-link {{ request()->routeIs('admin.homepage') ? 'active' : '' }}">
            <span class="ic">⌂</span><span>Homepage</span>
        </a>
        <a href="{{ route('admin.about') }}" class="sidebar-link {{ request()->routeIs('admin.about') ? 'active' : '' }}">
            <span class="ic">◉</span><span>About</span>
        </a>
        <a href="{{ route('admin.technologies.index') }}" class="sidebar-link {{ request()->routeIs('admin.technologies.*') ? 'active' : '' }}">
            <span class="ic">⚙</span><span>Technologies</span>
        </a>
        <a href="{{ route('admin.projects.index') }}" class="sidebar-link {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}">
            <span class="ic">▣</span><span>Projects</span>
        </a>
        <a href="{{ route('admin.services.index') }}" class="sidebar-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
            <span class="ic">◆</span><span>Services</span>
        </a>
        <a href="{{ route('admin.experience.index') }}" class="sidebar-link {{ request()->routeIs('admin.experience.*') ? 'active' : '' }}">
            <span class="ic">▤</span><span>Experience</span>
        </a>
        <a href="{{ route('admin.education.index') }}" class="sidebar-link {{ request()->routeIs('admin.education.*') ? 'active' : '' }}">
            <span class="ic">✎</span><span>Education</span>
        </a>
        <a href="{{ route('admin.certifications.index') }}" class="sidebar-link {{ request()->routeIs('admin.certifications.*') ? 'active' : '' }}">
            <span class="ic">★</span><span>Certifications</span>
        </a>
        <a href="{{ route('admin.testimonials.index') }}" class="sidebar-link {{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}">
            <span class="ic">❝</span><span>Testimonials</span>
        </a>
        <a href="{{ route('admin.navigation.index') }}" class="sidebar-link {{ request()->routeIs('admin.navigation.*') ? 'active' : '' }}">
            <span class="ic">≡</span><span>Navigation</span>
        </a>
    </div>

    <div class="sidebar-section">
        <div class="sidebar-label">Content</div>
        <a href="{{ route('admin.blog.index') }}" class="sidebar-link {{ request()->routeIs('admin.blog.*') ? 'active' : '' }}">
            <span class="ic">✉</span><span>Blog</span>
        </a>
        <a href="{{ route('admin.blog-categories.index') }}" class="sidebar-link {{ request()->routeIs('admin.blog-categories.*') ? 'active' : '' }}">
            <span class="ic">▥</span><span>Categories</span>
        </a>
        <a href="{{ route('admin.media.index') }}" class="sidebar-link {{ request()->routeIs('admin.media.*') ? 'active' : '' }}">
            <span class="ic">▰</span><span>Media Library</span>
        </a>
    </div>

    <div class="sidebar-section">
        <div class="sidebar-label">Communication</div>
        <a href="{{ route('admin.messages.index') }}" class="sidebar-link {{ request()->routeIs('admin.messages.*') ? 'active' : '' }}">
            <span class="ic">✉</span><span>Messages</span>
        </a>
        <a href="{{ route('admin.contact-settings') }}" class="sidebar-link {{ request()->routeIs('admin.contact-settings') ? 'active' : '' }}">
            <span class="ic">☏</span><span>Contact Settings</span>
        </a>
        <a href="{{ route('admin.notifications.index') }}" class="sidebar-link {{ request()->routeIs('admin.notifications.*') ? 'active' : '' }}">
            <span class="ic">🔔</span><span>Notifications</span>
        </a>
    </div>

    <div class="sidebar-section">
        <div class="sidebar-label">Professional</div>
        <a href="{{ route('admin.resume.index') }}" class="sidebar-link {{ request()->routeIs('admin.resume.*') ? 'active' : '' }}">
            <span class="ic">▥</span><span>Resume / CV</span>
        </a>
        <a href="{{ route('admin.social-links.index') }}" class="sidebar-link {{ request()->routeIs('admin.social-links.*') ? 'active' : '' }}">
            <span class="ic">◎</span><span>Social Links</span>
        </a>
    </div>

    <div class="sidebar-section">
        <div class="sidebar-label">Analytics</div>
        <a href="{{ route('admin.analytics') }}" class="sidebar-link {{ request()->routeIs('admin.analytics') ? 'active' : '' }}">
            <span class="ic">↗</span><span>Analytics</span>
        </a>
        <a href="{{ route('admin.activity-logs') }}" class="sidebar-link {{ request()->routeIs('admin.activity-logs') ? 'active' : '' }}">
            <span class="ic">≡</span><span>Activity Logs</span>
        </a>
    </div>

    <div class="sidebar-section">
        <div class="sidebar-label">Administration</div>
        <a href="{{ route('admin.users.index') }}" class="sidebar-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
            <span class="ic">◉</span><span>Users</span>
        </a>
        <a href="{{ route('admin.roles.index') }}" class="sidebar-link {{ request()->routeIs('admin.roles.*') ? 'active' : '' }}">
            <span class="ic">☰</span><span>Roles & Permissions</span>
        </a>
        <a href="{{ route('admin.profile') }}" class="sidebar-link {{ request()->routeIs('admin.profile') ? 'active' : '' }}">
            <span class="ic">☺</span><span>Admin Profile</span>
        </a>
    </div>

    <div class="sidebar-section">
        <div class="sidebar-label">System</div>
        <a href="{{ route('admin.settings') }}" class="sidebar-link {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
            <span class="ic">⚙</span><span>Settings</span>
        </a>
        <a href="{{ route('admin.seo') }}" class="sidebar-link {{ request()->routeIs('admin.seo') ? 'active' : '' }}">
            <span class="ic">⌕</span><span>SEO</span>
        </a>
        <a href="{{ route('admin.security') }}" class="sidebar-link {{ request()->routeIs('admin.security') ? 'active' : '' }}">
            <span class="ic">◈</span><span>Security</span>
        </a>
        <a href="{{ route('admin.backups.index') }}" class="sidebar-link {{ request()->routeIs('admin.backups.*') ? 'active' : '' }}">
            <span class="ic">▦</span><span>Backups</span>
        </a>
        <a href="{{ route('admin.system') }}" class="sidebar-link {{ request()->routeIs('admin.system') ? 'active' : '' }}">
            <span class="ic">▣</span><span>System Info</span>
        </a>
    </div>

    <div class="sidebar-section sidebar-logout">
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="sidebar-link" style="background:none;border:0;width:100%;text-align:left;color:var(--danger);">
                <span class="ic">⏻</span><span>Logout</span>
            </button>
        </form>
    </div>
</aside>
