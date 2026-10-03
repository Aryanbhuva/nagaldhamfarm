@extends('layout.front')
@section('styles')
    @php
        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'LocalBusiness',
            'name' => 'Nagaldham Farm',
            'url' => url('/'),
            'logo' => url('assets/img/logo.png'),
            'image' => url('assets/img/home-hero.webp'),
            'description' => $data['meta_description'] ?? 'Nagaldham Farm',
            'telephone' => config('settings.contact'),
            'email' => config('settings.email'),
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => 'Moniya, Visavadar',
                'addressLocality' => 'Visavadar',
                'addressRegion' => 'Gujarat',
                'postalCode' => '362120',
                'addressCountry' => 'IN',
            ],
            'hasMap' => config('settings.addres_link'),
        ];
    @endphp
    <script type="application/ld+json">
    {!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) !!}
    </script>
@endsection
@section('content')
<main class="main-wrapper">
    <!-- Hero Section -->
    <section class="hero-section" id="hero">
        <div class="hero-bg-overlay" aria-hidden="true"></div>

        <div class="hero-container">
            <div class="hero-content">
                <!-- Eyebrow Subtitle -->
                <div class="hero-tagline">
                    <span class="tag-word">PURE</span>
                    <span class="hero-dot" aria-hidden="true">•</span>
                    <span class="tag-word">NATURAL</span>
                    <span class="hero-dot" aria-hidden="true">•</span>
                    <span class="tag-word">TRADITIONAL</span>
                </div>

                <!-- Main Heading -->
                <h1 class="hero-heading">
                    Goodness from<br>
                    Our Gir Cows<br>
                    to Your Family
                </h1>

                <!-- Subtitle / Description -->
                <p class="hero-subheading">
                    Traditional dairy and farm products<br>
                    for a healthier, happier and more<br>
                    natural tomorrow.
                </p>

                <!-- CTA Action -->
                <div class="hero-cta-wrapper">
                    <a href="#products" class="hero-cta-btn" id="exploreProductsBtn">
                        <span class="btn-text">Explore Our Products</span>
                        <span class="btn-arrow" aria-hidden="true">
                            <svg width="20" height="14" viewBox="0 0 20 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 7H18M18 7L12.5 1.5M18 7L12.5 12.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Marquee Ribbon (Smooth Right to Left) -->
    <section class="features-ribbon" id="featuresRibbon" aria-label="Our Farm Highlights">
        <div class="features-marquee-wrapper custom-marquee-padding">
            <div class="features-track">
                <!-- Group 1 -->
                <div class="features-group">
                    <div class="feature-card">
                        <div class="feature-icon-badge">
                            <img src="{{ asset('assets/img/icon-100-natural-pure.png') }}" alt="100% Natural & Pure" class="feature-icon-img" width="64" height="64" loading="lazy">
                        </div>
                        <span class="feature-title">100% Natural<br>&amp; Pure</span>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon-badge">
                            <img src="{{ asset('assets/img/icon-gir-cow-products.png') }}" alt="Gir Cow Products" class="feature-icon-img" width="64" height="64" loading="lazy">
                        </div>
                        <span class="feature-title">Gir Cow<br>Products</span>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon-badge">
                            <img src="{{ asset('assets/img/icon-chemical-free.png') }}" alt="Chemical Free" class="feature-icon-img" width="64" height="64" loading="lazy">
                        </div>
                        <span class="feature-title">Chemical Free</span>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon-badge">
                            <img src="{{ asset('assets/img/icon-traditional-methods.png') }}" alt="Traditional Methods" class="feature-icon-img" width="64" height="64" loading="lazy">
                        </div>
                        <span class="feature-title">Traditional<br>Methods</span>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon-badge">
                            <img src="{{ asset('assets/img/icon-farm-fresh-quality.png') }}" alt="Farm Fresh Quality" class="feature-icon-img" width="64" height="64" loading="lazy">
                        </div>
                        <span class="feature-title">Farm Fresh<br>Quality</span>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon-badge">
                            <img src="{{ asset('assets/img/icon-supports-sustainable-farming.png') }}" alt="Supports Sustainable Farming" class="feature-icon-img" width="64" height="64" loading="lazy">
                        </div>
                        <span class="feature-title">Supports<br>Sustainable Farming</span>
                    </div>
                </div>

                <!-- Group 2 (Duplicate for Seamless Infinite Loop) -->
                <div class="features-group" aria-hidden="true">
                    <div class="feature-card">
                        <div class="feature-icon-badge">
                            <img src="{{ asset('assets/img/icon-100-natural-pure.png') }}" alt="100% Natural & Pure" class="feature-icon-img" width="64" height="64" loading="lazy">
                        </div>
                        <span class="feature-title">100% Natural<br>&amp; Pure</span>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon-badge">
                            <img src="{{ asset('assets/img/icon-gir-cow-products.png') }}" alt="Gir Cow Products" class="feature-icon-img" width="64" height="64" loading="lazy">
                        </div>
                        <span class="feature-title">Gir Cow<br>Products</span>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon-badge">
                            <img src="{{ asset('assets/img/icon-chemical-free.png') }}" alt="Chemical Free" class="feature-icon-img" width="64" height="64" loading="lazy">
                        </div>
                        <span class="feature-title">Chemical Free</span>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon-badge">
                            <img src="{{ asset('assets/img/icon-traditional-methods.png') }}" alt="Traditional Methods" class="feature-icon-img" width="64" height="64" loading="lazy">
                        </div>
                        <span class="feature-title">Traditional<br>Methods</span>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon-badge">
                            <img src="{{ asset('assets/img/icon-farm-fresh-quality.png') }}" alt="Farm Fresh Quality" class="feature-icon-img" width="64" height="64" loading="lazy">
                        </div>
                        <span class="feature-title">Farm Fresh<br>Quality</span>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon-badge">
                            <img src="{{ asset('assets/img/icon-supports-sustainable-farming.png') }}" alt="Supports Sustainable Farming" class="feature-icon-img" width="64" height="64" loading="lazy">
                        </div>
                        <span class="feature-title">Supports<br>Sustainable Farming</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Premium Products Section -->
    <section class="products-section" id="products">
        <div class="products-container">
            <!-- Section Header -->
            <div class="section-header">
                <h2 class="section-title">Our Premium Products</h2>
                <p class="section-subtitle">
                    Experience the purity and nutrition of traditional farm products,<br>
                    crafted with love and care from our Gir cows.
                </p>
            </div>

            <!-- Products Slider Wrapper -->
            <div class="products-slider-wrapper" style="overflow: hidden; width: 100%;">
                <div class="products-grid" id="productsSlider" style="display: flex; flex-wrap: nowrap; transition: transform 0.5s ease; gap: clamp(1.15rem, 1.8vw, 1.75rem);">
                    @foreach($products as $category => $items)
                        @foreach($items as $item)
                        <div class="product-card" style="flex: 0 0 auto; width: calc(25% - 1.35rem); min-width: 260px;">
                            <div class="product-img-box">
                                <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" width="300" height="300" loading="lazy">
                            </div>
                            <div class="product-info">
                                <h3 class="product-name">{{ $item['name'] }}</h3>
                                <p class="product-desc">{{ $item['description'] }}</p>
                                <div class="product-actions custom-product-actions">
                                    <a href="#" class="btn-product-action custom-btn-view-more" data-name="{{ $item['name'] }}" data-image="{{ asset($item['image']) }}" data-desc="{{ $item['description'] }}" data-long-desc="{{ $item['long_description'] ?? '' }}">
                                        <span>View More</span>
                                        <span class="btn-arrow" aria-hidden="true">
                                            <svg width="16" height="12" viewBox="0 0 16 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M1 6H14.5M14.5 6L9.5 1M14.5 6L9.5 11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </span>
                                    </a>
                                    <a href="tel:{{ config('settings.contact') }}" aria-label="Call" class="custom-btn-action custom-btn-call">
                                        <i class="fa-solid fa-phone"></i>
                                    </a>
                                    <a href="https://wa.me/{{ config('settings.whatsapp_wa') }}" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp" class="custom-btn-action custom-btn-wa">
                                        <i class="fa-brands fa-whatsapp"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Our Gir Cow Products Section -->
    <section class="why-choose-section" id="whyChoose">
        <div class="why-choose-overlay" aria-hidden="true"></div>
        <div class="why-choose-container">
            <!-- Left Text Column -->
            <div class="why-choose-content">
                <span class="why-choose-tag">WHY CHOOSE OUR</span>
                <h2 class="why-choose-title">Gir Cow Products?</h2>
                <p class="why-choose-desc">
                    Bringing you the best of nature through<br>
                    our farm-fresh, chemical-free and<br>
                    traditionally prepared products.
                </p>
                <div class="why-choose-cta">
                    <a href="#about" class="btn-why-choose" id="whyChooseBtn">
                        <span>Learn More</span>
                        <span class="btn-arrow" aria-hidden="true">
                            <svg width="18" height="12" viewBox="0 0 18 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 6H16.5M16.5 6L11 1M16.5 6L11 11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                    </a>
                </div>
            </div>

            <!-- Right Features Grid (3x2 Floating Cards) -->
            <div class="why-choose-grid">
                <!-- Card 1: Pure Gir Cow Products -->
                <div class="why-card">
                    <div class="why-card-icon">
                        <img src="{{ asset('assets/img/icon-gir-cow-products.png') }}" alt="Pure Gir Cow Products" width="48" height="48" loading="lazy">
                    </div>
                    <span class="why-card-text">Pure Gir Cow<br>Products</span>
                </div>

                <!-- Card 2: Rich in Nutrition -->
                <div class="why-card">
                    <div class="why-card-icon">
                        <img src="{{ asset('assets/img/icon-100-natural-pure.png') }}" alt="Rich in Nutrition" width="48" height="48" loading="lazy">
                    </div>
                    <span class="why-card-text">Rich in Nutrition</span>
                </div>

                <!-- Card 3: No Chemicals or Preservatives -->
                <div class="why-card">
                    <div class="why-card-icon">
                        <img src="{{ asset('assets/img/icon-chemical-free.png') }}" alt="No Chemicals or Preservatives" width="48" height="48" loading="lazy">
                    </div>
                    <span class="why-card-text">No Chemicals<br>or Preservatives</span>
                </div>

                <!-- Card 4: Ethically Sourced -->
                <div class="why-card">
                    <div class="why-card-icon">
                        <img src="{{ asset('assets/img/icon-traditional-methods.png') }}" alt="Ethically Sourced" width="48" height="48" loading="lazy">
                    </div>
                    <span class="why-card-text">Ethically Sourced</span>
                </div>

                <!-- Card 5: Supports Local Farmers -->
                <div class="why-card">
                    <div class="why-card-icon">
                        <img src="{{ asset('assets/img/icon-supports-sustainable-farming.png') }}" alt="Supports Local Farmers" width="48" height="48" loading="lazy">
                    </div>
                    <span class="why-card-text">Supports<br>Local Farmers</span>
                </div>

                <!-- Card 6: Good for You and the Environment -->
                <div class="why-card">
                    <div class="why-card-icon">
                        <img src="{{ asset('assets/img/icon-farm-fresh-quality.png') }}" alt="Good for You and the Environment" width="48" height="48" loading="lazy">
                    </div>
                    <span class="why-card-text">Good for You<br>and the Environment</span>
                </div>
            </div>
        </div>
    </section>
    
        <!-- From Our Farm To Your Home Process Section -->
    <section class="process-section" id="process">
        <div class="process-container">
            <!-- Section Header -->
            <div class="process-header">
                <h2 class="process-title">From Our Farm To Your Home</h2>
                <p class="process-subtitle">A simple, transparent process to bring you the purest products.</p>
            </div>

            <!-- Steps Chain Container -->
            <div class="process-timeline">
                <!-- Connecting Dashed Line with Nodes -->
                <div class="process-line-track" aria-hidden="true">
                    <span class="process-line-dashed"></span>
                    <span class="process-node node-1"></span>
                    <span class="process-node node-2"></span>
                    <span class="process-node node-3"></span>
                </div>

                <!-- Process Steps Grid (4 Steps) -->
                <div class="process-steps">
                    <!-- Step 1: Caring for Gir Cows -->
                    <div class="process-step">
                        <div class="process-circle" aria-hidden="true">
                            <img src="{{ asset('assets/img/process-step-1-cow.png') }}" alt="Caring for Gir Cows" class="process-icon-img" width="76" height="76" loading="lazy">
                        </div>
                        <span class="step-num">1</span>
                        <h3 class="step-title">Caring for Gir Cows</h3>
                        <p class="step-desc">with love and care</p>
                    </div>

                    <!-- Step 2: Traditional methods of production -->
                    <div class="process-step">
                        <div class="process-circle" aria-hidden="true">
                            <img src="{{ asset('assets/img/process-step-2-traditional.png') }}" alt="Traditional methods of production" class="process-icon-img" width="76" height="76" loading="lazy">
                        </div>
                        <span class="step-num">2</span>
                        <h3 class="step-title">Traditional</h3>
                        <p class="step-desc">methods of production</p>
                    </div>

                    <!-- Step 3: Quality check and packaging -->
                    <div class="process-step">
                        <div class="process-circle" aria-hidden="true">
                            <img src="{{ asset('assets/img/process-step-3-quality.png') }}" alt="Quality check and packaging" class="process-icon-img" width="76" height="76" loading="lazy">
                        </div>
                        <span class="step-num">3</span>
                        <h3 class="step-title">Quality</h3>
                        <p class="step-desc">check and packaging</p>
                    </div>

                    <!-- Step 4: Delivered fresh to your home -->
                    <div class="process-step">
                        <div class="process-circle" aria-hidden="true">
                            <img src="{{ asset('assets/img/process-step-4-delivered.png') }}" alt="Delivered fresh to your home" class="process-icon-img" width="76" height="76" loading="lazy">
                        </div>
                        <span class="step-num">4</span>
                        <h3 class="step-title">Delivered</h3>
                        <p class="step-desc">fresh to your home</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Us Section: Our Journey From Farm to Family -->
    <section class="about-section" id="about">
        <!-- Floating Elements Layer (Brush Banner & Circular Quality Seal) -->
        <div class="about-floating-decor" aria-hidden="true">
            <!-- Center Painted Brush Stroke Banner: Our Heritage / Our Strength -->
            <div class="about-brush-badge" role="img" aria-label="Our Heritage, Our Strength">
                <svg class="brush-svg" viewBox="0 0 340 130" preserveAspectRatio="none">
                    <defs>
                        <linearGradient id="brushGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                            <stop offset="0%" stop-color="#c89643" />
                            <stop offset="35%" stop-color="#b37e2c" />
                            <stop offset="75%" stop-color="#95601d" />
                            <stop offset="100%" stop-color="#7b4b12" />
                        </linearGradient>
                        <filter id="brushDropShadow" x="-15%" y="-15%" width="130%" height="135%" filterUnits="userSpaceOnUse">
                            <feDropShadow dx="0" dy="5" stdDeviation="6" flood-color="rgba(30,15,5,0.32)" />
                        </filter>
                    </defs>
                    <!-- Organic textured dry-brush shape with tapered edges and realistic bristles -->
                    <path d="M42 32C75 22 145 15 220 18C265 20 295 24 318 34C326 38 335 45 330 52C324 58 312 60 300 63C315 65 328 72 320 78C310 85 290 87 275 89C288 92 295 98 285 104C270 112 230 115 175 116C115 117 65 114 35 105C22 101 12 95 18 88C22 84 32 82 48 80C30 78 15 72 20 65C25 58 40 56 60 54C42 52 25 45 28 39C30 35 36 33 42 32Z" fill="url(#brushGrad)" filter="url(#brushDropShadow)"/>
                    <!-- Bristle fibers & paint texture accents -->
                    <path d="M305 22C318 18 332 25 324 32C315 38 300 32 305 22Z" fill="#a87428" opacity="0.9"/>
                    <path d="M320 40C334 38 338 46 328 50C318 53 312 45 320 40Z" fill="#8f5716" opacity="0.9"/>
                    <path d="M295 82C312 85 322 92 308 97C295 100 288 90 295 82Z" fill="#7a460e" opacity="0.85"/>
                    <path d="M15 48C6 52 2 60 8 64C16 67 25 60 15 48Z" fill="#b07a2c" opacity="0.9"/>
                    <path d="M22 68C12 73 8 82 16 85C24 87 30 78 22 68Z" fill="#945f1b" opacity="0.9"/>
                    <path d="M32 92C20 98 16 106 25 108C34 110 42 102 32 92Z" fill="#73410c" opacity="0.85"/>
                </svg>
                <div class="brush-text">
                    <span class="brush-line-1">Our Heritage</span>
                    <span class="brush-line-2">Our Strength</span>
                </div>
            </div>

            <!-- Top Right Circular Quality Seal Badge: 100% Natural Products with green botanical leaves -->
            <div class="about-seal-badge" role="img" aria-label="100% Natural Products Certified Quality">
                <div class="seal-inner-circle">
                    <!-- SVG Ring Borders and Fine Curved Arc Text -->
                    <svg class="seal-svg" viewBox="0 0 160 160">
                        <defs>
                            <path id="sealArcPath" d="M 24 80 A 56 56 0 0 1 136 80" fill="none" />
                        </defs>
                        <!-- Delicate dashed outer circle & fine inner concentric ring -->
                        <circle cx="80" cy="80" r="74" fill="none" stroke="#d4c5ae" stroke-width="1.2" stroke-dasharray="3 3"/>
                        <circle cx="80" cy="80" r="70" fill="none" stroke="#8c6134" stroke-width="0.75" opacity="0.35"/>
                        <!-- Top curved text: • 100% PURE & NATURAL GIR COW PRODUCTS • -->
                        <text class="seal-arc-text">
                            <textPath href="#sealArcPath" startOffset="50%" text-anchor="middle">
                                • 100% PURE &amp; NATURAL PRODUCTS •
                            </textPath>
                        </text>
                    </svg>

                    <!-- Center Seal Typography -->
                    <div class="seal-content">
                        <span class="seal-number">100%</span>
                        <span class="seal-title">Natural</span>
                        <span class="seal-subtitle">Products</span>
                    </div>

                    <!-- Botanical Fresh Green Leaves -->
                    <div class="seal-leaves-decor" aria-hidden="true">
                        <svg width="46" height="46" viewBox="0 0 48 48" fill="none">
                            <defs>
                                <linearGradient id="aboutLeafGrad1" x1="0%" y1="0%" x2="100%" y2="100%">
                                    <stop offset="0%" stop-color="#72be37"/>
                                    <stop offset="60%" stop-color="#4a901c"/>
                                    <stop offset="100%" stop-color="#2a5d0d"/>
                                </linearGradient>
                                <linearGradient id="aboutLeafGrad2" x1="100%" y1="0%" x2="0%" y2="100%">
                                    <stop offset="0%" stop-color="#88d842"/>
                                    <stop offset="70%" stop-color="#5ca423"/>
                                    <stop offset="100%" stop-color="#366b11"/>
                                </linearGradient>
                                <filter id="aboutLeafShadow" x="-20%" y="-20%" width="140%" height="140%">
                                    <feDropShadow dx="1" dy="2.5" stdDeviation="2.5" flood-color="rgba(0,0,0,0.22)"/>
                                </filter>
                            </defs>
                            <g filter="url(#aboutLeafShadow)">
                                <!-- Leaf 1 (Left / Back leaf) -->
                                <path d="M14 36C12 26 18 16 30 14C34 24 30 32 18 36L14 36Z" fill="url(#aboutLeafGrad1)"/>
                                <path d="M14 36C20 28 26 22 30 14" stroke="#9cf052" stroke-width="0.8" stroke-linecap="round" opacity="0.6"/>
                                <!-- Leaf 2 (Right / Front glossy leaf) -->
                                <path d="M18 38C22 28 32 20 44 20C46 32 38 42 22 42L18 38Z" fill="url(#aboutLeafGrad2)"/>
                                <path d="M18 38C28 32 36 27 44 20" stroke="#b2f76e" stroke-width="0.9" stroke-linecap="round" opacity="0.75"/>
                                <!-- Small stem connection -->
                                <path d="M12 42C15 39 18 38 18 38" stroke="#366b11" stroke-width="2" stroke-linecap="round"/>
                            </g>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Column -->
        <div class="about-container">
            <div class="about-content">
                <span class="about-tag">ABOUT US</span>
                <h2 class="about-title">Our Journey<br>From Farm to Family</h2>
                <p class="about-desc">
                    We are committed to preserving the ancient wisdom of Indian farming and
                    bringing pure, natural and high-quality products to your home. Our focus is on
                    sustainable farming, Gir cow protection and delivering nutrition-rich products
                    for a healthier society.
                </p>
                <div class="about-cta">
                    <a href="{{ route('product') }}" class="btn-about" id="aboutStoryBtn">
                        <span>Our Products</span>
                        <span class="btn-arrow" aria-hidden="true">
                            <svg width="18" height="12" viewBox="0 0 18 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 6H16.5M16.5 6L11 1M16.5 6L11 11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </section>



    <!-- Testimonials Section: What Our Customers Say -->
    <section class="testimonials-section" id="testimonials">

        <div class="testimonials-container">
            <!-- Section Title -->
            <h2 class="testimonials-title">What Our Customers Say</h2>

            <!-- Slider Wrapper with Navigation Arrows -->
            <div class="testimonials-slider-wrapper">

                <!-- Cards Track -->
                <div class="testimonials-track" id="testimonialsTrack">
                    <!-- Testimonial 1: Priya Sharma -->
                    <div class="testimonial-card" itemscope itemtype="https://schema.org/Review">
                        <div class="testimonial-avatar-box">
                            <img src="{{ asset('assets/img/customer-priya.jpg') }}" alt="Priya Sharma - Satisfied Customer" width="80" height="80" loading="lazy">
                        </div>
                        <blockquote class="testimonial-quote" itemprop="reviewBody">
                            “The ghee is absolutely pure and aromatic. You can feel the difference in quality. Highly recommended!”
                        </blockquote>
                        <div class="testimonial-meta">
                            <h3 class="testimonial-author" itemprop="author" itemscope itemtype="https://schema.org/Person">
                                <span itemprop="name">Priya Sharma</span>
                            </h3>
                            <div class="testimonial-stars" itemprop="reviewRating" itemscope itemtype="https://schema.org/Rating" aria-label="5 out of 5 stars rating">
                                <meta itemprop="ratingValue" content="5">
                                <meta itemprop="bestRating" content="5">
                                <span class="star">&#9733;</span>
                                <span class="star">&#9733;</span>
                                <span class="star">&#9733;</span>
                                <span class="star">&#9733;</span>
                                <span class="star">&#9733;</span>
                            </div>
                        </div>
                    </div>

                    <!-- Testimonial 2: Rahul Mehta -->
                    <div class="testimonial-card" itemscope itemtype="https://schema.org/Review">
                        <div class="testimonial-avatar-box">
                            <img src="{{ asset('assets/img/customer-rahul.jpg') }}" alt="Rahul Mehta - Satisfied Customer" width="80" height="80" loading="lazy">
                        </div>
                        <blockquote class="testimonial-quote" itemprop="reviewBody">
                            “Amazing products and excellent service. The sweets taste just like homemade.”
                        </blockquote>
                        <div class="testimonial-meta">
                            <h3 class="testimonial-author" itemprop="author" itemscope itemtype="https://schema.org/Person">
                                <span itemprop="name">Rahul Mehta</span>
                            </h3>
                            <div class="testimonial-stars" itemprop="reviewRating" itemscope itemtype="https://schema.org/Rating" aria-label="5 out of 5 stars rating">
                                <meta itemprop="ratingValue" content="5">
                                <meta itemprop="bestRating" content="5">
                                <span class="star">&#9733;</span>
                                <span class="star">&#9733;</span>
                                <span class="star">&#9733;</span>
                                <span class="star">&#9733;</span>
                                <span class="star">&#9733;</span>
                            </div>
                        </div>
                    </div>

                    <!-- Testimonial 3: Neha Patel -->
                    <div class="testimonial-card" itemscope itemtype="https://schema.org/Review">
                        <div class="testimonial-avatar-box">
                            <img src="{{ asset('assets/img/customer-neha.jpg') }}" alt="Neha Patel - Satisfied Customer" width="80" height="80" loading="lazy">
                        </div>
                        <blockquote class="testimonial-quote" itemprop="reviewBody">
                            “I love their colostrum powder. It has really improved my family's immunity.”
                        </blockquote>
                        <div class="testimonial-meta">
                            <h3 class="testimonial-author" itemprop="author" itemscope itemtype="https://schema.org/Person">
                                <span itemprop="name">Neha Patel</span>
                            </h3>
                            <div class="testimonial-stars" itemprop="reviewRating" itemscope itemtype="https://schema.org/Rating" aria-label="5 out of 5 stars rating">
                                <meta itemprop="ratingValue" content="5">
                                <meta itemprop="bestRating" content="5">
                                <span class="star">&#9733;</span>
                                <span class="star">&#9733;</span>
                                <span class="star">&#9733;</span>
                                <span class="star">&#9733;</span>
                                <span class="star">&#9733;</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog Section: Our Farm Stories & Insights (With Google SEO Schema) -->
    <section class="blog-section" id="blog">
        <div class="blog-container">
           
            <!-- Section Title & Subtitle -->
            <h2 class="blog-section-title">Our Farm Stories &amp; Insights</h2>
            <p class="blog-section-subtitle">Learn more about healthy living, traditional farming and product benefits.</p>

            <!-- Blog Posts Grid (3 Cards) -->
            <div class="blog-grid">
                <!-- Article 1: Health Benefits of Gir Cow Ghee -->
                <article class="blog-card" itemscope itemtype="https://schema.org/BlogPosting">
                    <div class="blog-image-box">
                        <img src="{{ asset('assets/img/blog-ghee.jpg') }}" alt="Health Benefits of Gir Cow Ghee - Pure Vedic A2 Ghee" width="400" height="225" loading="lazy" itemprop="image">
                    </div>
                    <div class="blog-content">
                        <h3 class="blog-title" itemprop="headline">Health Benefits of Gir Cow Ghee</h3>
                        <meta itemprop="description" content="Discover the remarkable Ayurvedic and nutritional health benefits of pure Gir cow Vedic A2 bilona ghee for digestion, brain health and natural vitality.">
                        <meta itemprop="datePublished" content="2026-09-15T09:00:00+05:30">
                        <meta itemprop="author" content="Nagaldham Farm">
                        <a href="#blog" class="blog-read-more" itemprop="url">
                            <span>Read More</span>
                            <span class="btn-arrow" aria-hidden="true">&rarr;</span>
                        </a>
                    </div>
                </article>

                <!-- Article 2: Why Gir Cow Products are Better for Your Health -->
                <article class="blog-card" itemscope itemtype="https://schema.org/BlogPosting">
                    <div class="blog-image-box">
                        <img src="{{ asset('assets/img/blog-cows.jpg') }}" alt="Why Gir Cow Products are Better for Your Health - Organic A2 Dairy" width="400" height="225" loading="lazy" itemprop="image">
                    </div>
                    <div class="blog-content">
                        <h3 class="blog-title" itemprop="headline">Why Gir Cow Products are Better for Your Health</h3>
                        <meta itemprop="description" content="Understand why indigenous Gir cow A2 beta-casein dairy products are superior for lactose tolerance, gut immunity, and heart wellness compared to conventional dairy.">
                        <meta itemprop="datePublished" content="2026-09-18T10:30:00+05:30">
                        <meta itemprop="author" content="Nagaldham Farm">
                        <a href="#blog" class="blog-read-more" itemprop="url">
                            <span>Read More</span>
                            <span class="btn-arrow" aria-hidden="true">&rarr;</span>
                        </a>
                    </div>
                </article>

                <!-- Article 3: Traditional Indian Sweets and Their Nutritional Value -->
                <article class="blog-card" itemscope itemtype="https://schema.org/BlogPosting">
                    <div class="blog-image-box">
                        <img src="{{ asset('assets/img/blog-sweets.jpg') }}" alt="Traditional Indian Sweets and Their Nutritional Value - Pure Ghee Sweets" width="400" height="225" loading="lazy" itemprop="image">
                    </div>
                    <div class="blog-content">
                        <h3 class="blog-title" itemprop="headline">Traditional Indian Sweets and Their Nutritional Value</h3>
                        <meta itemprop="description" content="Explore how pure A2 Gir cow ghee sweets crafted with natural sweeteners provide wholesome energy, rich micronutrients, and authentic festive goodness.">
                        <meta itemprop="datePublished" content="2026-09-22T11:00:00+05:30">
                        <meta itemprop="author" content="Nagaldham Farm">
                        <a href="#blog" class="blog-read-more" itemprop="url">
                            <span>Read More</span>
                            <span class="btn-arrow" aria-hidden="true">&rarr;</span>
                        </a>
                    </div>
                </article>
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
</main>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const slider = document.getElementById('productsSlider');
    if (slider) {
        let scrollInterval;
        
        function startAutoScroll() {
            scrollInterval = setInterval(() => {
                const card = slider.querySelector('.product-card');
                if (card) {
                    const gapStyle = window.getComputedStyle(slider).gap;
                    const gap = gapStyle !== 'normal' ? parseFloat(gapStyle) : 24; // Default to ~24px if not parsable
                    const cardWidth = card.offsetWidth + gap;
                    
                    slider.style.transition = 'transform 0.5s ease';
                    slider.style.transform = `translateX(-${cardWidth}px)`;
                    
                    setTimeout(() => {
                        slider.style.transition = 'none';
                        slider.appendChild(slider.firstElementChild);
                        slider.style.transform = 'translateX(0)';
                    }, 500);
                }
            }, 2000); // 2 seconds
        }

        startAutoScroll();

        // Pause auto-scroll when hovering over the slider
        slider.addEventListener('mouseenter', () => clearInterval(scrollInterval));
        slider.addEventListener('mouseleave', startAutoScroll);
    }
});
</script>
@endsection