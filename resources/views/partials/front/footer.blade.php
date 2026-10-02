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
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>
                    @endif

                    @if(config('settings.instagram'))
                    <a href="{{ config('settings.instagram') }}" target="_blank" rel="noopener noreferrer" class="social-icon-btn" aria-label="Instagram">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                    @endif

                    @if(config('settings.youtube'))
                    <a href="{{ config('settings.youtube') }}" target="_blank" rel="noopener noreferrer" class="social-icon-btn" aria-label="YouTube">
                        <i class="fa-brands fa-youtube"></i>
                    </a>
                    @endif

                    @if(config('settings.whatsapp_wa'))
                    <a href="https://wa.me/{{ config('settings.whatsapp_wa') }}" target="_blank" rel="noopener noreferrer" class="social-icon-btn" aria-label="WhatsApp">
                        <i class="fa-brands fa-whatsapp"></i>
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
                            <i class="fa-solid fa-location-dot"></i>
                        </span>
                        @if(config('settings.addres_link'))
                        <a href="{{ config('settings.addres_link') }}" target="_blank" rel="noopener noreferrer" class="contact-text-link">
                            {{ config('settings.address', '123 Farm Road, Gujarat, India') }}
                        </a>
                        @else
                        <span class="contact-text">{{ config('settings.address', '123 Farm Road, Gujarat, India') }}</span>
                        @endif
                    </div>

                    <!-- Phone Number 1 -->
                    <div class="footer-contact-item">
                        <span class="contact-icon" aria-hidden="true">
                            <i class="fa-solid fa-phone"></i>
                        </span>
                        <a href="tel:{{ config('settings.contact_tel') }}" class="contact-text-link">
                            {{ config('settings.contact') }}
                        </a>
                    </div>

                    <!-- Phone Number 2 -->
                    <div class="footer-contact-item">
                        <span class="contact-icon" aria-hidden="true">
                            <i class="fa-solid fa-phone"></i>
                        </span>
                        <a href="tel:{{ config('settings.phone_tel') }}" class="contact-text-link">
                            {{ config('settings.phone') }}
                        </a>
                    </div>

                    <!-- Email -->
                    <div class="footer-contact-item">
                        <span class="contact-icon" aria-hidden="true">
                            <i class="fa-solid fa-envelope"></i>
                        </span>
                        <a href="mailto:{{ config('settings.email') }}" class="contact-text-link">
                            {{ config('settings.email') }}
                        </a>
                    </div>

                    <!-- Working Hours -->
                    <div class="footer-contact-item">
                        <span class="contact-icon" aria-hidden="true">
                            <i class="fa-regular fa-clock"></i>
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
            <div class="footer-health-message">
                <p class="footer-copyright">Nourishing your life with pure, farm-fresh goodness for a healthier tomorrow.</p>
            </div>
        </div>
    </div>
</footer>
