@extends('layout.front')

@section('content')
<!-- Product Page Hero Section -->
<section class="product-hero-section">
    <div class="product-hero-bg-overlay"></div>
    <div class="product-hero-container">
        <div class="product-hero-content">
            <!-- Breadcrumbs -->
            <nav class="product-breadcrumbs">
                <a href="{{ route('home') }}">Home</a>
                <span class="separator">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </span>
                <span class="current">Products</span>
            </nav>

            <h1 class="product-hero-heading">Our Products</h1>
            <h2 class="product-hero-subheading">Pure, Natural & Traditional</h2>
            <p class="product-hero-text">
                Discover the goodness of our Gaushala and organic farm products. Nourishing your family with purity, tradition and the natural care of our Gir cows.
            </p>

            <div class="product-hero-features">
                <div class="product-feature-item">
                    <div class="feature-icon">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 1 8.3C21.12 21.5 13 22 11 20z"></path></svg>
                    </div>
                    <span class="feature-text">100% Natural<br>& Pure</span>
                </div>
                <div class="product-feature-item">
                    <div class="feature-icon">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                    </div>
                    <span class="feature-text">Farm Fresh<br>Quality</span>
                </div>
                <div class="product-feature-item">
                    <div class="feature-icon">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 8H5a2 2 0 0 0-2 2v2c0 4.4 3.6 8 8 8s8-3.6 8-8v-2a2 2 0 0 0-2-2z"></path><path d="M8 8V6a4 4 0 0 1 8 0v2"></path></svg>
                    </div>
                    <span class="feature-text">Traditional<br>Methods</span>
                </div>
                <div class="product-feature-item">
                    <div class="feature-icon">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><path d="M7.5 4.21l4.5 2.6 4.5-2.6"></path><path d="M7.5 19.79V14.6l-4.5-2.6"></path><path d="M21 12l-4.5 2.6v5.19"></path><path d="M3.27 6.96L12 12.01l8.73-5.05"></path><path d="M12 22.08V12"></path></svg>
                    </div>
                    <span class="feature-text">Supports<br>Sustainable Farming</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Shop Section -->
<section class="shop-section">
    <div class="shop-container">
        
        <!-- Top Categories Bar -->
        <div class="shop-categories-row">
            @foreach($categories as $category)
            <div class="shop-category-card">
                <div class="category-img-box">
                    <img src="{{ asset($category['image']) }}" alt="{{ $category['name'] }}">
                </div>
                <div class="category-info">
                    <h3>{{ $category['name'] }}</h3>
                    <p>{{ $category['count'] }} Products</p>
                </div>
                <div class="category-arrow">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </div>
            </div>
            @endforeach
        </div>

        <div class="shop-main-layout">
            <!-- Sidebar -->
            <aside class="shop-sidebar">
                <!-- Search -->
                <div class="sidebar-widget">
                    <h4 class="widget-title">Search Products</h4>
                    <div class="search-box">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                        <input type="text" placeholder="Search products...">
                    </div>
                </div>

                <!-- Categories -->
                <div class="sidebar-widget">
                    <h4 class="widget-title">Categories</h4>
                    <ul class="checkbox-list">
                        <li>
                            <label class="checkbox-label">
                                <input type="checkbox">
                                <span class="checkmark"></span>
                                Gaushala Products (5)
                            </label>
                        </li>
                        <li>
                            <label class="checkbox-label">
                                <input type="checkbox">
                                <span class="checkmark"></span>
                                Sweets (8)
                            </label>
                        </li>
                        <li>
                            <label class="checkbox-label">
                                <input type="checkbox">
                                <span class="checkmark"></span>
                                Organic Farm Products (9)
                            </label>
                        </li>
                    </ul>
                </div>

                <!-- Price Range -->
                <div class="sidebar-widget">
                    <h4 class="widget-title">Price Range</h4>
                    <div class="price-slider-container">
                        <input type="range" min="0" max="2000" value="2000" class="price-slider">
                        <div class="price-range-text">₹0 - ₹2,000</div>
                        <button class="apply-filter-btn">Apply Filter</button>
                    </div>
                </div>

                <!-- Availability -->
                <div class="sidebar-widget">
                    <h4 class="widget-title">Availability</h4>
                    <ul class="checkbox-list">
                        <li>
                            <label class="checkbox-label">
                                <input type="checkbox">
                                <span class="checkmark"></span>
                                In Stock (21)
                            </label>
                        </li>
                        <li>
                            <label class="checkbox-label">
                                <input type="checkbox">
                                <span class="checkmark"></span>
                                Out of Stock (0)
                            </label>
                        </li>
                    </ul>
                </div>

                <!-- Product Type -->
                <div class="sidebar-widget">
                    <h4 class="widget-title">Product Type</h4>
                    <ul class="checkbox-list">
                        <li>
                            <label class="checkbox-label"><input type="checkbox"><span class="checkmark"></span>Ghee (1)</label>
                        </li>
                        <li>
                            <label class="checkbox-label"><input type="checkbox"><span class="checkmark"></span>Pooja Items (2)</label>
                        </li>
                        <li>
                            <label class="checkbox-label"><input type="checkbox"><span class="checkmark"></span>Dairy Products (4)</label>
                        </li>
                        <li>
                            <label class="checkbox-label"><input type="checkbox"><span class="checkmark"></span>Sweets (8)</label>
                        </li>
                        <li>
                            <label class="checkbox-label"><input type="checkbox"><span class="checkmark"></span>Grains & Pulses (7)</label>
                        </li>
                        <li>
                            <label class="checkbox-label"><input type="checkbox"><span class="checkmark"></span>Oils (2)</label>
                        </li>
                    </ul>
                </div>

                <!-- Promo Banner -->
                <div class="sidebar-promo">
                    <img src="{{ asset('assets/img/home-hero.webp') }}" alt="Promo" class="promo-bg">
                    <div class="promo-content">
                        <h5>Pure Products</h5>
                        <h4>From Our Farm</h4>
                        <p>Natural, chemical-free and traditionally prepared for a healthier tomorrow.</p>
                        <a href="#" class="promo-btn">Know Our Farm &rarr;</a>
                    </div>
                </div>
            </aside>

            <!-- Main Product Grid -->
            <div class="shop-content">
                <div class="shop-header">
                    <h2 class="shop-title">All Products</h2>
                    <div class="shop-sort">
                        <select class="sort-select">
                            <option>Sort by: Latest First</option>
                            <option>Price: Low to High</option>
                            <option>Price: High to Low</option>
                        </select>
                    </div>
                </div>

                <div class="products-grid">
                    @foreach($allProducts as $product)
                    <div class="product-card">
                        <div class="product-img-box">
                            <img src="{{ asset($product['image']) }}" alt="{{ $product['name'] }}">
                        </div>
                        <div class="product-details">
                            <span class="product-category-badge">{{ $product['category'] }}</span>
                            <h3 class="product-name">{{ $product['name'] }}</h3>
                            <p class="product-desc">{{ $product['description'] }}</p>
                            <div class="product-bottom">
                                {{-- <div class="price-rating">
                                    <div class="product-price">₹{{ $product['price'] }}</div>
                                    <div class="product-rating">
                                        <div class="stars">
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="#f59e0b" stroke="#f59e0b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="#f59e0b" stroke="#f59e0b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="#f59e0b" stroke="#f59e0b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="#f59e0b" stroke="#f59e0b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="#f59e0b" stroke="#f59e0b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                        </div>
                                        <span class="rating-num">({{ $product['rating'] }})</span>
                                    </div>
                                </div> --}}
                            </div>
                            <div class="product-action-buttons">
                                <a href="#" class="btn-view-more" data-name="{{ $product['name'] }}" data-image="{{ asset($product['image']) }}" data-desc="{{ $product['description'] }}" data-long-desc="{{ $product['long_description'] ?? '' }}">View More <i class="fa fa-arrow-right"></i></a>
                                <a href="#" class="btn-action btn-call"><i class="fa fa-phone"></i></a>
                                <a href="#" class="btn-action btn-wa"><i class="fa-brands fa-whatsapp"></i></a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

    <!-- ==========================================================================
         CTA Section: Stay Connected for a Healthier Tomorrow
         ========================================================================== -->
    <section class="cta-section" id="cta-contact" aria-label="Stay Connected With Nagaldham Farm">
        <!-- Subtle dark ambient gradient on the left so typography is crystal clear -->
        <div class="cta-overlay" aria-hidden="true"></div>

        <div class="cta-container">
            <!-- Left Column: Typography matching reference image -->
            <div class="cta-content">
                <h2 class="cta-title">
                    Stay Connected<br>
                    for a Healthier Tomorrow
                </h2>
                <p class="cta-subtitle">
                    Subscribe to get the latest updates, offers and health tips.
                </p>
            </div>

            <!-- Middle / Right: Call and WhatsApp Action Buttons -->
            <div class="cta-actions">
                <!-- Call Button (Warm Caramel Amber styled like Subscribe button) -->
                <a href="tel:{{ config('settings.contact_tel', '+919925790544') }}" class="cta-btn cta-btn-call" id="ctaCallBtn" aria-label="Call {{ config('settings.contact', '+91 99257 90544') }}">
                    <svg class="cta-btn-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                    </svg>
                    <span>Call: {{ config('settings.contact') }}</span>
                </a>

                <!-- WhatsApp Button (Vivid Green) -->
                <a href="https://wa.me/{{ config('settings.whatsapp_wa') }}" target="_blank" rel="noopener noreferrer" class="cta-btn cta-btn-whatsapp" id="ctaWhatsappBtn" aria-label="Chat on WhatsApp">
                    <svg class="cta-btn-icon" width="19" height="19" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.816 9.816 0 0 0 12.04 2zm.01 1.67c2.2 0 4.26.86 5.82 2.42a8.18 8.18 0 0 1 2.41 5.82c0 4.54-3.7 8.24-8.24 8.24-1.42 0-2.82-.37-4.06-1.08l-.29-.17-3.02.79.81-2.94-.19-.3A8.17 8.17 0 0 1 3.8 11.91c0-4.54 3.7-8.24 8.25-8.24zm4.52 11.55c-.25-.13-1.47-.72-1.7-.81-.23-.08-.39-.13-.56.13-.17.25-.64.81-.79.97-.14.17-.29.19-.54.06-.25-.13-1.06-.39-2.02-1.24-.75-.67-1.25-1.49-1.4-1.74-.14-.25-.02-.39.11-.51.11-.11.25-.29.37-.43.13-.15.17-.25.25-.42.08-.17.04-.32-.02-.45-.06-.13-.56-1.35-.77-1.85-.2-.49-.41-.42-.56-.43h-.48c-.17 0-.44.06-.67.32-.23.25-.88.86-.88 2.1s.9 2.44 1.03 2.61c.13.17 1.77 2.7 4.29 3.79.6.26 1.07.41 1.44.53.6.19 1.15.16 1.58.1.48-.07 1.47-.6 1.68-1.18.21-.58.21-1.07.15-1.18-.07-.1-.23-.17-.48-.29z"/>
                    </svg>
                    <span>WhatsApp Us</span>
                </a>
            </div>
        </div>
    </section>

    @include('partials.front.product_modal')
@endsection
