<!-- ==========================================================================
     Site Footer: Nagaldham Farm (Same-to-Same Reference Layout)
     ========================================================================== -->
<footer class="site-footer" id="footer" itemscope itemtype="https://schema.org/WPFooter">
    <!-- Faint botanical leaf watermark background elements -->
    

    <!-- Main Footer Columns -->
    <div class="footer-main-container">
        <div class="footer-grid">
            <!-- Column 1: Brand Logo, About & Social Icons -->
            <div class="footer-col footer-col-brand">
                <a href="{{ url('/') }}" class="footer-logo-link" aria-label="Nagaldham Farm Homepage">
                    <img src="{{ asset('assets/img/logo.png') }}" alt="Krishna Gaushala Nagaldham - Pure By Nature" class="footer-logo-img" width="180" height="85" loading="lazy">
                </a>
                <p class="footer-brand-desc">
                    Natural dairy and farm products for a healthier and happier life. Bringing purity from our farms to your family.
                </p>
                <div class="footer-social-links" aria-label="Follow us on social media">
                    @if(config('settings.facebook'))
                    <a href="{{ config('settings.facebook') }}" target="_blank" rel="noopener noreferrer" class="social-icon-btn" aria-label="Facebook">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
                        </svg>
                    </a>
                    @endif

                    @if(config('settings.instagram'))
                    <a href="{{ config('settings.instagram') }}" target="_blank" rel="noopener noreferrer" class="social-icon-btn" aria-label="Instagram">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/>
                            <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/>
                        </svg>
                    </a>
                    @endif

                    @if(config('settings.youtube'))
                    <a href="{{ config('settings.youtube') }}" target="_blank" rel="noopener noreferrer" class="social-icon-btn" aria-label="YouTube">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                        </svg>
                    </a>
                    @endif

                    @if(config('settings.whatsapp_wa'))
                    <a href="https://wa.me/{{ config('settings.whatsapp_wa') }}" target="_blank" rel="noopener noreferrer" class="social-icon-btn" aria-label="WhatsApp">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.816 9.816 0 0 0 12.04 2zm.01 1.67c2.2 0 4.26.86 5.82 2.42a8.18 8.18 0 0 1 2.41 5.82c0 4.54-3.7 8.24-8.24 8.24-1.42 0-2.82-.37-4.06-1.08l-.29-.17-3.02.79.81-2.94-.19-.3A8.17 8.17 0 0 1 3.8 11.91c0-4.54 3.7-8.24 8.25-8.24zm4.52 11.55c-.25-.13-1.47-.72-1.7-.81-.23-.08-.39-.13-.56.13-.17.25-.64.81-.79.97-.14.17-.29.19-.54.06-.25-.13-1.06-.39-2.02-1.24-.75-.67-1.25-1.49-1.4-1.74-.14-.25-.02-.39.11-.51.11-.11.25-.29.37-.43.13-.15.17-.25.25-.42.08-.17.04-.32-.02-.45-.06-.13-.56-1.35-.77-1.85-.2-.49-.41-.42-.56-.43h-.48c-.17 0-.44.06-.67.32-.23.25-.88.86-.88 2.1s.9 2.44 1.03 2.61c.13.17 1.77 2.7 4.29 3.79.6.26 1.07.41 1.44.53.6.19 1.15.16 1.58.1.48-.07 1.47-.6 1.68-1.18.21-.58.21-1.07.15-1.18-.07-.1-.23-.17-.48-.29z"/>
                        </svg>
                    </a>
                    @endif
                </div>
            </div>

            <!-- Column 2: Quick Links -->
            <div class="footer-col footer-col-links">
                <h3 class="footer-col-title">Quick Links</h3>
                <ul class="footer-nav-list">
                    <li><a href="{{ url('/') }}" class="footer-link">Home</a></li>
                    <li><a href="{{ route('product') }}" class="footer-link">Products</a></li>
                    <li><a href="{{ url('/#about') }}" class="footer-link">About Us</a></li>
                    <li><a href="{{ url('/#process') }}" class="footer-link">Our Farm</a></li>
                    <li><a href="{{ url('/#blog') }}" class="footer-link">Blog</a></li>
                    <li><a href="{{ url('/#cta-contact') }}" class="footer-link">Contact</a></li>
                </ul>
            </div>

            <!-- Column 3: Our Products -->
            <div class="footer-col footer-col-links">
                <h3 class="footer-col-title">Our Products</h3>
                <ul class="footer-nav-list">
                    <li><a href="{{ route('product') }}" class="footer-link">Gir Cow Ghee</a></li>
                    <li><a href="{{ route('product') }}" class="footer-link">Traditional Sweets</a></li>
                    <li><a href="{{ route('product') }}" class="footer-link">Colostrum Powder</a></li>
                    <li><a href="{{ route('product') }}" class="footer-link">Cow Dung Products</a></li>
                    <li><a href="{{ route('product') }}" class="footer-link">Combo Packages</a></li>
                    <li><a href="{{ route('product') }}" class="footer-link">All Products</a></li>
                </ul>
            </div>

            <!-- Column 4: Contact Us -->
            <div class="footer-col footer-col-contact">
                <h3 class="footer-col-title">Contact Us</h3>
                <div class="footer-contact-list">
                    <!-- Address / Location -->
                    <div class="footer-contact-item">
                        <span class="contact-icon" aria-hidden="true">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                                <circle cx="12" cy="10" r="3"/>
                            </svg>
                        </span>
                        @if(config('settings.addres_link'))
                        <a href="{{ config('settings.addres_link') }}" target="_blank" rel="noopener noreferrer" class="contact-text-link">
                            {{ config('settings.address', '123 Farm Road, Gujarat, India') }}
                        </a>
                        @else
                        <span class="contact-text">{{ config('settings.address', '123 Farm Road, Gujarat, India') }}</span>
                        @endif
                    </div>

                    <!-- Phone Number -->
                    <div class="footer-contact-item">
                        <span class="contact-icon" aria-hidden="true">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                            </svg>
                        </span>
                        <a href="tel:{{ config('settings.contact_tel', '+919876543210') }}" class="contact-text-link">
                            {{ config('settings.contact', '+91 98765 43210') }}
                        </a>
                    </div>

                    <!-- Email -->
                    <div class="footer-contact-item">
                        <span class="contact-icon" aria-hidden="true">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="2" y="4" width="20" height="16" rx="2"/>
                                <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
                            </svg>
                        </span>
                        <a href="mailto:{{ config('settings.email', 'support@gauamrit.com') }}" class="contact-text-link">
                            {{ config('settings.email', 'support@gauamrit.com') }}
                        </a>
                    </div>

                    <!-- Working Hours -->
                    <div class="footer-contact-item">
                        <span class="contact-icon" aria-hidden="true">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"/>
                                <polyline points="12 6 12 12 16 14"/>
                            </svg>
                        </span>
                        <span class="contact-text">Mon - Sat: 9:00 AM - 6:00 PM</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Copyright Strip (Dark Green) -->
    <div class="footer-bottom-bar">
        <div class="footer-bottom-container">
            <p class="footer-copyright">
                &copy; {{ date('Y') }} Nagaldham Farm. All Rights Reserved.
            </p>
            <div class="footer-legal-links">
                <a href="#privacy" class="footer-legal-link">Privacy Policy</a>
                <a href="#terms" class="footer-legal-link">Terms &amp; Conditions</a>
                <a href="#shipping" class="footer-legal-link">Shipping Policy</a>
            </div>
        </div>
    </div>
</footer>
