@extends('layout.front')
@section('styles')
    <script type="application/ld+json">
        {
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
            'hasMap' => config('settings.addres_link')
        }
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
</main>
@endsection