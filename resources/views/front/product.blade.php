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
                        <i class="fa-solid fa-leaf fa-2x"></i>
                    </div>
                    <span class="feature-text">100% Natural<br>& Pure</span>
                </div>
                <div class="product-feature-item">
                    <div class="feature-icon">
                        <i class="fa-solid fa-house fa-2x"></i>
                    </div>
                    <span class="feature-text">Farm Fresh<br>Quality</span>
                </div>
                <div class="product-feature-item">
                    <div class="feature-icon">
                        <i class="fa-solid fa-basket-shopping fa-2x"></i>
                    </div>
                    <span class="feature-text">Traditional<br>Methods</span>
                </div>
                <div class="product-feature-item">
                    <div class="feature-icon">
                        <i class="fa-solid fa-cube fa-2x"></i>
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
                        <input type="text" id="product-search" placeholder="Search products...">
                    </div>
                </div>

                <!-- Categories -->
                <div class="sidebar-widget">
                    <h4 class="widget-title">Categories</h4>
                    <ul class="checkbox-list" id="category-filters">
                        @foreach($categories as $category)
                        <li>
                            <label class="checkbox-label">
                                <input type="checkbox" value="{{ $category['name'] }}" class="filter-checkbox category-checkbox">
                                <span class="checkmark"></span>
                                {{ $category['name'] }} ({{ $category['count'] }})
                            </label>
                        </li>
                        @endforeach
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
                        <select class="sort-select" id="product-sort">
                            <option value="latest">Sort by: Latest First</option>
                        </select>
                    </div>
                </div>

                <div class="products-grid" id="products-grid">
                    @foreach($allProducts as $product)
                    <div class="product-card" data-category="{{ $product['category'] }}">
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
                    <i class="fa-solid fa-phone cta-btn-icon"></i>
                    <span>Call: {{ config('settings.contact') }}</span>
                </a>

                <!-- WhatsApp Button (Vivid Green) -->
                <a href="https://wa.me/{{ config('settings.whatsapp_wa') }}" target="_blank" rel="noopener noreferrer" class="cta-btn cta-btn-whatsapp" id="ctaWhatsappBtn" aria-label="Chat on WhatsApp">
                    <i class="fa-brands fa-whatsapp cta-btn-icon"></i>
                    <span>WhatsApp Us</span>
                </a>
            </div>
        </div>
    </section>

    @include('partials.front.product_modal')
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('product-search');
        const categoryCheckboxes = document.querySelectorAll('.category-checkbox');
        const sortSelect = document.getElementById('product-sort');
        const productsGrid = document.getElementById('products-grid');
        const products = Array.from(document.querySelectorAll('.product-card'));
        
        // Add click events to Top Categories Bar items
        const topCategoryCards = document.querySelectorAll('.shop-category-card');
        topCategoryCards.forEach(card => {
            card.addEventListener('click', function() {
                const categoryName = this.querySelector('h3').textContent.trim();
                
                // Clear all category checkboxes
                categoryCheckboxes.forEach(cb => cb.checked = false);
                
                // Check the one that matches
                const matchingCheckbox = document.querySelector(`.category-checkbox[value="${categoryName}"]`);
                if (matchingCheckbox) {
                    matchingCheckbox.checked = true;
                }
                
                filterAndSortProducts();
                
                // Scroll to products
                document.querySelector('.shop-content').scrollIntoView({ behavior: 'smooth' });
            });
        });

        function filterAndSortProducts() {
            const searchTerm = searchInput.value.toLowerCase();
            const activeCategories = Array.from(categoryCheckboxes)
                .filter(cb => cb.checked)
                .map(cb => cb.value);
            
            // Filter
            let visibleProducts = products.filter(product => {
                const productName = product.querySelector('.product-name').textContent.toLowerCase();
                const productCategory = product.dataset.category;
                
                const matchesSearch = productName.includes(searchTerm);
                const matchesCategory = activeCategories.length === 0 || activeCategories.includes(productCategory);
                
                if (matchesSearch && matchesCategory) {
                    product.style.display = 'block';
                    return true;
                } else {
                    product.style.display = 'none';
                    return false;
                }
            });
            
            // Sort
            const sortValue = sortSelect.value;
            
            // Latest first (default order) - we rely on the original DOM order by re-appending all visible items
            visibleProducts.sort((a, b) => products.indexOf(a) - products.indexOf(b));
            
            // Re-append sorted elements
            visibleProducts.forEach(product => {
                productsGrid.appendChild(product);
            });
        }

        searchInput.addEventListener('input', filterAndSortProducts);
        categoryCheckboxes.forEach(cb => cb.addEventListener('change', filterAndSortProducts));
        sortSelect.addEventListener('change', filterAndSortProducts);
    });
</script>
@endsection
