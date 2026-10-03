<!-- ==========================================================================
     Site Header: GauAmrit / Nagaldham Farm (Clean Navigation & Call Button)
     ========================================================================== -->
<header class="site-header" id="siteHeader" role="banner">
    <div class="header-container">
        <!-- 1. Brand Logo: Krishna Gaushala Nagaldham Official Logo -->
        <a href="{{ route('home') }}" class="header-brand" aria-label="Krishna Gaushala Nagaldham - Pure by Nature Homepage">
            <img src="{{ asset('assets/img/logo.png') }}" 
                 alt="Krishna Gaushala Nagaldham - Pure By Nature" 
                 class="header-logo-img" 
                 width="110" 
                 height="72" 
                 loading="eager"
                 fetchpriority="high">
        </a>

        <!-- 2. Desktop Navigation (Center Links) -->
        <nav class="header-nav" id="desktopNav" aria-label="Main Navigation">
            <ul class="header-nav-list">
                <li class="nav-item">
                    <a href="{{ url('/') }}" class="nav-link {{ request()->routeIs('home') || request()->is('/') ? 'active' : '' }}">Home</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('product') }}" class="nav-link {{ request()->routeIs('product') ? 'active' : '' }}">Products</a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/#about') }}" class="nav-link">About Us</a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/#process') }}" class="nav-link">Our Farm</a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/#blog') }}" class="nav-link">Blog</a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/#cta-contact') }}" class="nav-link">Contact</a>
                </li>
            </ul>
        </nav>

        <!-- 3. Right Action: Simple Premium Call Button -->
        <div class="header-actions">
            <a href="tel:{{ config('settings.contact_tel') }}" class="header-call-btn" id="headerCallBtn" aria-label="Call {{ config('settings.contact', '+91 99257 90544') }}">
                <span class="call-btn-icon" aria-hidden="true">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                    </svg>
                </span>
                <span class="call-btn-text">{{ config('settings.contact') }}</span>
            </a>

            <!-- Mobile Hamburger Button -->
            <button type="button" class="header-hamburger-btn" id="mobileMenuToggle" aria-label="Toggle navigation menu" aria-expanded="false" aria-controls="mobileDrawer">
                <span class="hamburger-bar bar-1"></span>
                <span class="hamburger-bar bar-2"></span>
                <span class="hamburger-bar bar-3"></span>
            </button>
        </div>
    </div>
</header>

<!-- ==========================================================================
     Mobile Navigation Drawer
     ========================================================================== -->
<div class="header-mobile-drawer" id="mobileDrawer" aria-hidden="true" role="dialog" aria-modal="true">
    <div class="drawer-backdrop" id="mobileDrawerBackdrop"></div>
    <div class="mobile-drawer-panel">
        <div class="mobile-drawer-header">
            <a href="{{ route('home') }}" class="mobile-drawer-brand" aria-label="Krishna Gaushala Nagaldham Homepage">
                <img src="{{ asset('assets/img/logo.png') }}" 
                     alt="Krishna Gaushala Nagaldham - Pure By Nature" 
                     class="mobile-drawer-logo-img" 
                     width="95" 
                     height="63"
                     loading="eager">
            </a>
            <button type="button" class="modal-close-icon" id="closeMobileDrawer" aria-label="Close navigation menu">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>

        <nav class="mobile-nav-body" aria-label="Mobile Navigation">
            <ul class="mobile-nav-list">
                <li><a href="{{ url('/') }}" class="mobile-nav-link {{ request()->routeIs('home') || request()->is('/') ? 'active' : '' }}">Home</a></li>
                <li><a href="{{ route('product') }}" class="mobile-nav-link {{ request()->routeIs('product') ? 'active' : '' }}">Products</a></li>
                <li><a href="{{ url('/#about') }}" class="mobile-nav-link">About Us</a></li>
                <li><a href="{{ url('/#process') }}" class="mobile-nav-link">Our Farm</a></li>
                <li><a href="{{ url('/#blog') }}" class="mobile-nav-link">Blog</a></li>
                <li><a href="{{ url('/#cta-contact') }}" class="mobile-nav-link">Contact</a></li>
            </ul>

            <div class="mobile-drawer-bottom">
                <a href="tel:{{ config('settings.contact_tel', '+919925790544') }}" class="mobile-call-btn">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                    </svg>
                    <span>Call: {{ config('settings.contact', '+91 99257 90544') }}</span>
                </a>

                <a href="https://wa.me/{{ config('settings.whatsapp_wa', '919925790544') }}?text={{ rawurlencode('Hello Nagaldham Farm, I would like to inquire about your pure Gir cow products.') }}" target="_blank" rel="noopener noreferrer" class="mobile-wa-btn">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.816 9.816 0 0 0 12.04 2zm.01 1.67c2.2 0 4.26.86 5.82 2.42a8.18 8.18 0 0 1 2.41 5.82c0 4.54-3.7 8.24-8.24 8.24-1.42 0-2.82-.37-4.06-1.08l-.29-.17-3.02.79.81-2.94-.19-.3A8.17 8.17 0 0 1 3.8 11.91c0-4.54 3.7-8.24 8.25-8.24zm4.52 11.55c-.25-.13-1.47-.72-1.7-.81-.23-.08-.39-.13-.56.13-.17.25-.64.81-.79.97-.14.17-.29.19-.54.06-.25-.13-1.06-.39-2.02-1.24-.75-.67-1.25-1.49-1.4-1.74-.14-.25-.02-.39.11-.51.11-.11.25-.29.37-.43.13-.15.17-.25.25-.42.08-.17.04-.32-.02-.45-.06-.13-.56-1.35-.77-1.85-.2-.49-.41-.42-.56-.43h-.48c-.17 0-.44.06-.67.32-.23.25-.88.86-.88 2.1s.9 2.44 1.03 2.61c.13.17 1.77 2.7 4.29 3.79.6.26 1.07.41 1.44.53.6.19 1.15.16 1.58.1.48-.07 1.47-.6 1.68-1.18.21-.58.21-1.07.15-1.18-.07-.1-.23-.17-.48-.29z"/>
                    </svg>
                    <span>WhatsApp Us</span>
                </a>

                <div class="mobile-contact-card">
                    <p class="mobile-contact-loc">{{ config('settings.address', 'Moniya, Visavadar, Gujarat') }}</p>
                </div>
            </div>
        </nav>
    </div>
</div>
