# 🌿 Nagaldham Farm — Project Documentation

> **Last Updated:** October 2026
> **Maintained by:** Aryanbhuva / vishamay123
> **GitHub:** https://github.com/Aryanbhuva/nagaldhamfarm

---

## 📋 Table of Contents

1. [Project Overview](#1-project-overview)
2. [Tech Stack](#2-tech-stack)
3. [Project Architecture](#3-project-architecture)
4. [Directory Structure](#4-directory-structure)
5. [Git Branches & Commit History](#5-git-branches--commit-history)
6. [Pages & Routes](#6-pages--routes)
7. [Product Catalogue](#7-product-catalogue)
8. [Business Configuration](#8-business-configuration)
9. [Design System](#9-design-system)
10. [SEO Implementation](#10-seo-implementation)
11. [Environment Setup](#11-environment-setup)
12. [Known Gaps & Future Roadmap](#12-known-gaps--future-roadmap)

---

## 1. Project Overview

**Nagaldham Farm** (also known as **Krishna Gaushala**) is a traditional Gir cow farm located in Moniya, Visavadar, Gujarat, India. This is their official website built to showcase and promote their range of pure, natural, and traditional Gir cow products including A2 Ghee, organic farm produce, traditional sweets, and Gaushala items.

| Detail | Info |
|---|---|
| **Project Type** | Business / E-Commerce Informational Website |
| **Industry** | Agriculture / Organic Farm Products / Gaushala |
| **Primary Goal** | Showcase products and drive customer inquiries via Call & WhatsApp |
| **Target Audience** | Health-conscious consumers across India |
| **Language** | English |
| **Location** | Moniya, Visavadar, Dist. Junagadh, Gujarat - 362120 |

---

## 2. Tech Stack

### Backend
| Technology | Version | Purpose |
|---|---|---|
| **PHP** | ^8.1 | Server-side language |
| **Laravel** | ^10.0 | Web application framework |
| **Laravel Sanctum** | ^3.2 | API authentication (installed, not yet used) |
| **Laravel Tinker** | ^2.8 | REPL for development |
| **Guzzle HTTP** | ^7.2 | HTTP client |

### Frontend
| Technology | Version | Purpose |
|---|---|---|
| **Blade Templates** | Laravel 10 | HTML templating engine |
| **Vanilla CSS** | — | All custom styling (public/assets/css/style.css) |
| **Vanilla JavaScript** | ES6+ | Sliders, filters, modals (public/assets/js/main.js) |
| **Google Fonts** | — | Playfair Display, Outfit, Plus Jakarta Sans |
| **Font Awesome** | 6.4.0 | Icons (via CDN) |
| **Vite** | — | Asset bundler (vite.config.js) |

### Development Tools
| Tool | Purpose |
|---|---|
| **PHPUnit** | ^10.0 — Unit & feature testing |
| **Faker PHP** | ^1.9.1 — Test data generation |
| **Laravel Pint** | ^1.0 — PHP code style fixer |
| **Laravel Sail** | ^1.18 — Docker environment |
| **Spatie Ignition** | ^2.0 — Error page handler |
| **Mockery** | ^1.4.4 — Mocking library for tests |

---

## 3. Project Architecture

### Application Pattern
```
MVC (Model - View - Controller)
```

### Request Flow
```
Browser Request
      │
      ▼
  routes/web.php
      │
      ▼
  PageController (app/Http/Controllers/Front/)
      │
      ├── home()    ──► resources/views/front/home.blade.php
      │
      └── product() ──► resources/views/front/product.blade.php
                              │
                        layout/front.blade.php  (Master Layout)
                              │
                    ┌─────────┴─────────┐
              header.blade.php    footer.blade.php
                    │
              product_modal.blade.php
```

### Data Flow
```
Controller (hardcoded PHP arrays)
      │
      ▼
 compact('data', 'products')
      │
      ▼
  Blade View  ──► @foreach loops render product cards
      │
      ▼
  HTML + CSS + JS served to browser
```

> ⚠️ NOTE: Currently there is NO database. All product data is hardcoded as PHP arrays
> inside PageController.php. This is intentional for this version but will need
> a database for future scalability.

### Key Controller Methods

| Method | Route | View Returned | Data Passed |
|---|---|---|---|
| `home()` | `GET /` | `front.home` | `$data` (meta), `$products` (grouped by category) |
| `product()` | `GET /products` | `front.product` | `$data` (meta), `$categories`, `$allProducts` (flat list) |

---

## 4. Directory Structure

```
project/
│
├── app/                                  # Core application logic
│   ├── Console/Kernel.php
│   ├── Exceptions/Handler.php
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Controller.php            # Base controller
│   │   │   └── Front/
│   │   │       └── PageController.php   ★ MAIN CONTROLLER
│   │   ├── Kernel.php
│   │   └── Middleware/
│   ├── Models/User.php
│   └── Providers/
│
├── config/
│   ├── settings.php                     ★ BUSINESS CONFIG (contact, social links)
│   ├── app.php, auth.php, database.php, ...
│
├── database/
│   ├── factories/UserFactory.php
│   ├── migrations/                      # Default Laravel migrations only
│   └── seeders/DatabaseSeeder.php
│
├── public/                              # Web root (served by server)
│   ├── index.php                        # Laravel entry point
│   ├── .htaccess                        # Apache rewrite rules
│   └── assets/
│       ├── css/style.css                ★ ALL CUSTOM CSS
│       ├── js/main.js                   ★ ALL CUSTOM JS
│       └── img/                         ★ ALL IMAGES
│           ├── logo.png, favicon.png
│           ├── home-hero.webp, product-hero.webp
│           ├── product-ghee.jpg, product-cow-dung.jpg
│           ├── product-colostrum.jpg, product-sweets.jpg
│           ├── blog-ghee.jpg, blog-cows.jpg, blog-sweets.jpg
│           ├── customer-priya.jpg, customer-rahul.jpg, customer-neha.jpg
│           ├── process-step-1-cow.png ... process-step-4-delivered.png
│           └── icon-*.png (6 feature icons)
│
├── resources/views/
│   ├── layout/front.blade.php           ★ MASTER LAYOUT
│   ├── front/
│   │   ├── home.blade.php               ★ HOME PAGE (711 lines)
│   │   └── product.blade.php            ★ PRODUCTS PAGE (302 lines)
│   └── partials/front/
│       ├── header.blade.php
│       ├── footer.blade.php
│       └── product_modal.blade.php      # Product detail popup
│
├── routes/web.php                       ★ WEB ROUTES (2 routes only)
├── storage/                             # Laravel cache, sessions, logs
├── tests/                               # PHPUnit tests
├── .env.example                         # Environment template
├── composer.json                        # PHP dependencies
├── package.json                         # Node dependencies
├── vite.config.js
└── project.md                           # ← THIS FILE
```

---

## 5. Git Branches & Commit History

### Remote Repository
```
git remote: git@github.com:Aryanbhuva/nagaldhamfarm.git
```

### Branches

| Branch | Type | Status | Purpose |
|---|---|---|---|
| `main` | Production | ✅ Active | Stable, live-ready code |
| `staging` | Staging | ✅ Active | Testing & pre-production changes |

```
Local branches:
  main
* staging   ← currently active

Remote tracking:
  remotes/origin/main
  remotes/origin/staging
```

### Commit History (All 6 Commits)

| Hash | Message | Description |
|---|---|---|
| `3ddad9c` | update meta title and set favicon | Latest — SEO meta & favicon update |
| `a447574` | update and create many changes | General updates |
| `72e0d97` | add product related long description and develop popup model | Product modals added |
| `6a66535` | develop other section like CTA, header, footer, blog, about, why choose us | Site sections built |
| `c3ffb17` | develop home page hero section | Hero section first built |
| `d862ba9` | initial commit | Project scaffolded |

### Branch Workflow
```
main ←────── (merge when stable) ←────── staging
                                              ↑
                                       (develop here)
```

> Best Practice: Always work on `staging`. Merge to `main` only when fully tested.

### Common Git Commands
```bash
# Switch to staging for development
git checkout staging

# Make changes, then commit
git add .
git commit -m "your message"
git push origin staging

# Deploy to production (merge to main)
git checkout main
git merge staging
git push origin main
```

---

## 6. Pages & Routes

### Route Definitions (routes/web.php)
```php
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/products', [PageController::class, 'product'])->name('product');
```

### Home Page (/)

| Section | Anchor ID | Description |
|---|---|---|
| Hero | `#hero` | Full-screen background, tagline "Pure · Natural · Traditional", CTA |
| Features Ribbon | `#featuresRibbon` | Infinite right-to-left marquee with 6 icon cards |
| Products | `#products` | Auto-scrolling product slider (2s interval, pause on hover) |
| Why Choose | `#whyChoose` | 2-col layout with 6 reasons/feature cards |
| Process | `#process` | 4-step timeline: Cow Care → Production → Quality → Delivery |
| About | `#about` | Our journey section with SVG brush badge & quality seal |
| Testimonials | `#testimonials` | 3 customer review cards with star ratings |
| Blog | `#blog` | 3 static blog article cards |
| CTA | `#cta-contact` | Call & WhatsApp contact buttons |

### Products Page (/products)

| Section | Description |
|---|---|
| Hero | Page banner with breadcrumbs (Home → Products) |
| Category Cards | 3 clickable category cards — triggers sidebar filter |
| Sidebar | Search input + category checkboxes |
| Product Grid | All 22 products, filterable & searchable |
| CTA | Call & WhatsApp buttons |

### Shared Partials
| Partial | Location | Included In |
|---|---|---|
| Header | `partials/front/header.blade.php` | All pages via master layout |
| Footer | `partials/front/footer.blade.php` | All pages via master layout |
| Product Modal | `partials/front/product_modal.blade.php` | home.blade.php, product.blade.php |

---

## 7. Product Catalogue

> All product data is defined in `app/Http/Controllers/Front/PageController.php`
> Total: 22 products across 3 categories

### Category 1: Gaushala Products (5 items)

| # | Product | Description |
|---|---|---|
| 1 | **Gir Cow A2 Ghee** | Bilona method, A2 milk curd churned, pure & aromatic |
| 2 | **Havan Kanda** | Sun-dried cow dung cakes for yagna/puja |
| 3 | **Dhupbatti** | Hand-rolled incense from cow dung + sacred herbs |
| 4 | **Cow Dung** | 100% natural, eco-friendly, multipurpose |
| 5 | **Colostrum Powder** | Immunity-boosting first-milk superfood |

### Category 2: Sweets (8 items)

| # | Product | Description |
|---|---|---|
| 1 | **Mohanthal** | Traditional Gujarati besan fudge made with A2 ghee |
| 2 | **Cow Milk Mava** | Slow-cooked fresh Gir cow milk khoya |
| 3 | **Mava Peda** | Soft, saffron-infused traditional peda |
| 4 | **Topra Pak** | Coconut fudge with Gir cow milk & ghee |
| 5 | **Peanut Pak** | Jaggery + peanut energy sweet |
| 6 | **Sesame Chikki** | Til brittle with natural jaggery |
| 7 | **Peanut Chikki** | Classic groundnut brittle |
| 8 | **Besan Ladoo** | Slow-roasted gram flour ladoo with cardamom |

### Category 3: Organic Farm Products (9 items)

| # | Product | Description |
|---|---|---|
| 1 | **Bansi Wheat** | Chemical-free traditional wheat grain |
| 2 | **Tukda Wheat** | Coarse fiber-rich wheat |
| 3 | **Chana** | Organically grown whole Bengal gram |
| 4 | **Chana Dal** | Unpolished split gram dal |
| 5 | **Moong** | Whole green moong, natural & unpolished |
| 6 | **Moong Dal** | Light, easily digestible split moong |
| 7 | **Turmeric** | High-curcumin organic turmeric powder |
| 8 | **Groundnut Oil** | Cold-pressed wooden ghani peanut oil |
| 9 | **Sesame Oil** | 100% cold-pressed organic til oil |

---

## 8. Business Configuration

File: `config/settings.php`

```php
return [
    'contact'       => '+91 99257 90544',       // Display phone
    'contact_tel'   => '+919925790544',          // tel: href format
    'phone'         => '+91 78781 89998',        // Secondary phone
    'phone_tel'     => '+917878189998',
    'whatsapp'      => '+91 99257 90544',
    'whatsapp_wa'   => '919925790544',           // wa.me format
    'email'         => 'nagaldhamgaushala@gmail.com',
    'address'       => 'Moniya, Visavadar, Dist. Junagadh, Gujarat, India - 362120',
    'addres_link'   => 'https://maps.app.goo.gl/BRQ4DMqNupNr4TpT9',
    'youtube'       => 'https://www.youtube.com/@krishnafarm_gaushalanagaldham',
    'facebook'      => 'https://www.facebook.com/jaydeep.dolar.9',
    'instagram'     => 'https://www.instagram.com/krishna.gaushala_nagaldham',
];
```

Usage in Blade views:
```blade
{{ config('settings.contact') }}
{{ config('settings.whatsapp_wa') }}
```

---

## 9. Design System

### Color Palette
| Name | Hex | Usage |
|---|---|---|
| Gold / Amber | `#c89643` | Primary brand, badges, highlights |
| Dark Brown | `#7b4b12` | Deep accents, brush stroke decorations |
| Mid Brown | `#95601d` | Gradients, secondary accents |
| Forest Green | `#4a901c` | Eco/natural icons, leaf decorations |
| Off-White | `#faf6f0` | Background, light sections |

### Typography
| Font | Weights | Usage |
|---|---|---|
| **Playfair Display** | 500–800, Italic | Hero headings, section titles |
| **Outfit** | 400–700 | Body text, UI elements |
| **Plus Jakarta Sans** | 400–700 | Subheadings, meta text |

### UI Components
| Component | Description |
|---|---|
| **Product Modal** | Popup with image, name, long description, call/WhatsApp buttons |
| **Marquee Ribbon** | Infinite right-to-left scrolling feature strip |
| **Product Slider** | Auto-scroll cards every 2s, pause on hover |
| **Sticky Buttons** | Fixed Call + WhatsApp always on screen |
| **Sidebar Filter** | Search + checkbox category filter (Products page) |
| **Process Timeline** | 4-step horizontal chain with dashed line connectors |
| **SVG Brush Badge** | Decorative brush stroke: "Our Heritage · Our Strength" |
| **Circular Seal** | Animated quality seal: "100% Natural Products" |
| **Testimonial Cards** | Review cards with avatar, quote, stars (Schema.org markup) |

---

## 10. SEO Implementation

### Per-Page Meta Tags
```blade
<title>{{ $data['meta_title'] }}</title>
<meta name="description" content="{{ $data['meta_description'] }}">
<meta name="keywords" content="{{ $data['meta_keywords'] }}">
<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1">
<link rel="canonical" href="{{ url()->current() }}">
```

### Open Graph Tags
```html
<meta property="og:title"       content="...">
<meta property="og:description" content="...">
<meta property="og:type"        content="website">
<meta property="og:url"         content="...">
<meta property="og:image"       content=".../logo.png">
<meta property="og:site_name"   content="Nagaldham Farm">
```

### JSON-LD Structured Data

| Schema | Page | Purpose |
|---|---|---|
| `LocalBusiness` | Home | Business details for Google Maps/Search |
| `BlogPosting` | Home (blog cards) | Blog content schema |
| `Review` + `Rating` | Home (testimonials) | Customer review schema |

### Page Meta Titles
- **Home:** `Nagaldham Farm - Pure Gir Cow Products & Organic Farm Produce`
- **Products:** `Our Products - Nagaldham Farm | A2 Ghee, Sweets & Organic Grocery`

---

## 11. Environment Setup

### Prerequisites
- PHP >= 8.1
- Composer
- Node.js + npm
- MySQL (for future database use)
- Git with SSH key configured for GitHub

### Local Setup Steps

```bash
# 1. Clone the repository
git clone git@github.com:Aryanbhuva/nagaldhamfarm.git
cd nagaldhamfarm

# 2. Checkout staging for development
git checkout staging

# 3. Install PHP dependencies
composer install

# 4. Install Node.js dependencies
npm install

# 5. Copy environment file and configure
cp .env.example .env

# 6. Generate application key
php artisan key:generate

# 7. Create storage symlink
php artisan storage:link

# 8. Start development server
php artisan serve
# App will be at: http://127.0.0.1:8000
```

### .env Configuration
```env
APP_NAME="Nagaldham Farm"
APP_ENV=local
APP_KEY=                    ← set by artisan key:generate
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nagaldham
DB_USERNAME=root
DB_PASSWORD=
```

---

## 12. Known Gaps & Future Roadmap

### Current Limitations

| # | Issue | Impact |
|---|---|---|
| 1 | **No Database** | Products hardcoded in PHP — not scalable |
| 2 | **No Admin Panel** | Can't add/edit products without code changes |
| 3 | **No Pricing** | Price field commented out in views |
| 4 | **No Contact Form** | Only call/WhatsApp — no email form |
| 5 | **No Order System** | No cart, checkout, or order flow |
| 6 | **Blog Not Functional** | Blog cards link to `#blog` anchor — no real posts |
| 7 | **Static Testimonials** | Reviews hardcoded — no submission system |
| 8 | **Sanctum Unused** | Auth system installed but not implemented |

### Future Feature Roadmap

| Priority | Feature |
|---|---|
| 🔴 High | Database migration — MySQL with Eloquent models |
| 🔴 High | Admin panel — CRUD for products, categories |
| 🟡 Medium | WhatsApp order button with pre-filled message |
| 🟡 Medium | Email contact form |
| 🟡 Medium | Product pricing display |
| 🟢 Low | Full blog system with real posts |
| 🟢 Low | Hindi / Gujarati language support |
| 🟢 Low | Customer review submission system |
| 🟢 Low | Farm photo gallery page |

---

## 📞 Contact & Social Media

| Channel | Details |
|---|---|
| 📧 Email | nagaldhamgaushala@gmail.com |
| 📞 Primary Phone | +91 99257 90544 |
| 📞 Secondary Phone | +91 78781 89998 |
| 💬 WhatsApp | +91 99257 90544 |
| 📍 Address | Moniya, Visavadar, Junagadh, Gujarat - 362120 |
| 🗺️ Google Maps | https://maps.app.goo.gl/BRQ4DMqNupNr4TpT9 |
| 🎥 YouTube | https://www.youtube.com/@krishnafarm_gaushalanagaldham |
| 📘 Facebook | https://www.facebook.com/jaydeep.dolar.9 |
| 📸 Instagram | https://www.instagram.com/krishna.gaushala_nagaldham |

---

*This document lives at `project.md` in the project root and should be updated
whenever significant changes are made to the project structure, features, or configuration.*
