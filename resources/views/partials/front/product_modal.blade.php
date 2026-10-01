<!-- Premium Product Modal -->
<div id="premiumProductModal" class="premium-modal" aria-hidden="true">
    <div class="premium-modal-backdrop" id="modalBackdrop"></div>
    <div class="premium-modal-content">
        <button type="button" class="premium-modal-close" id="closeModalBtn" aria-label="Close Modal">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </button>
        <div class="premium-modal-grid">
            <div class="premium-modal-img-col">
                <img src="" alt="Product Image" id="modalProductImage" class="modal-main-img">
            </div>
            <div class="premium-modal-info-col">
                <span class="modal-badge">Pure & Natural</span>
                <h2 class="modal-product-name" id="modalProductName">Product Name</h2>
                <p class="modal-short-desc" id="modalShortDesc">Short description goes here.</p>
                <div class="modal-divider"></div>
                <div class="modal-long-desc-container">
                    <p class="modal-long-desc" id="modalLongDesc">
                        Long description goes here.
                    </p>
                </div>
                
                <div class="modal-actions">
                    <a href="tel:{{ config('settings.contact_tel', '+919925790544') }}" class="btn-modal-call">
                        <i class="fa fa-phone"></i> Call Now
                    </a>
                    <a href="https://wa.me/{{ config('settings.whatsapp_wa', '919925790544') }}" target="_blank" class="btn-modal-wa">
                        <i class="fa-brands fa-whatsapp"></i> WhatsApp Us
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Premium Modal Styles */
.premium-modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 9999;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}
.premium-modal.active {
    display: flex;
    opacity: 1;
}
.premium-modal-backdrop {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.7);
    backdrop-filter: blur(5px);
}
.premium-modal-content {
    position: relative;
    width: 90%;
    max-width: 900px;
    background: #fff;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 20px 40px rgba(0,0,0,0.2);
    transform: translateY(20px);
    transition: transform 0.3s ease;
    display: flex;
    max-height: 90vh;
}
.premium-modal.active .premium-modal-content {
    transform: translateY(0);
}
.premium-modal-close {
    position: absolute;
    top: 15px;
    right: 15px;
    background: #f1f1f1;
    border: none;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    z-index: 10;
    color: #333;
    transition: background 0.2s;
}
.premium-modal-close:hover {
    background: #e2e2e2;
}
.premium-modal-grid {
    display: flex;
    flex-direction: row;
    width: 100%;
}
.premium-modal-img-col {
    width: 45%;
    background: #f9f9f9;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 30px;
}
.modal-main-img {
    max-width: 100%;
    max-height: 400px;
    object-fit: contain;
    border-radius: 8px;
    box-shadow: 0 10px 20px rgba(0,0,0,0.05);
}
.premium-modal-info-col {
    width: 55%;
    padding: 40px 30px;
    display: flex;
    flex-direction: column;
    overflow-y: auto;
}
.modal-badge {
    display: inline-block;
    padding: 6px 12px;
    background: #eef8f1;
    color: #27ae60;
    font-size: 0.85rem;
    font-weight: 600;
    border-radius: 20px;
    margin-bottom: 15px;
    width: fit-content;
}
.modal-product-name {
    font-family: 'Playfair Display', serif;
    font-size: 2.2rem;
    color: #222;
    margin-bottom: 10px;
    line-height: 1.2;
}
.modal-short-desc {
    font-size: 1.05rem;
    color: #555;
    margin-bottom: 20px;
}
.modal-divider {
    height: 1px;
    background: #eaeaea;
    margin: 20px 0;
}
.modal-long-desc-container {
    flex-grow: 1;
    margin-bottom: 25px;
}
.modal-long-desc {
    font-size: 0.95rem;
    color: #666;
    line-height: 1.7;
    text-align: justify;
}
.modal-actions {
    display: flex;
    gap: 15px;
    margin-top: auto;
}
.btn-modal-call, .btn-modal-wa {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 12px 20px;
    border-radius: 8px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    font-size: 1rem;
}
.btn-modal-call {
    background: #d4af37;
    color: #fff;
    border: 1px solid #d4af37;
}
.btn-modal-call:hover {
    background: #c19b2e;
    color: #fff;
}
.btn-modal-wa {
    background: #25D366;
    color: #fff;
    border: 1px solid #25D366;
}
.btn-modal-wa:hover {
    background: #1ebe57;
    color: #fff;
}

@media (max-width: 768px) {
    .premium-modal-grid {
        flex-direction: column;
    }
    .premium-modal-img-col, .premium-modal-info-col {
        width: 100%;
    }
    .premium-modal-img-col {
        padding: 20px;
        height: 250px;
    }
    .modal-main-img {
        max-height: 200px;
    }
    .premium-modal-info-col {
        padding: 25px 20px;
    }
    .modal-product-name {
        font-size: 1.8rem;
    }
    .modal-actions {
        flex-direction: column;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('premiumProductModal');
    const backdrop = document.getElementById('modalBackdrop');
    const closeBtn = document.getElementById('closeModalBtn');
    
    const imgEl = document.getElementById('modalProductImage');
    const nameEl = document.getElementById('modalProductName');
    const shortDescEl = document.getElementById('modalShortDesc');
    const longDescEl = document.getElementById('modalLongDesc');
    
    // Attach event listeners to all 'View More' buttons
    const viewMoreBtns = document.querySelectorAll('.btn-view-more');
    viewMoreBtns.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Extract data
            const name = this.getAttribute('data-name');
            const image = this.getAttribute('data-image');
            const desc = this.getAttribute('data-desc');
            const longDesc = this.getAttribute('data-long-desc');
            
            // Populate modal
            nameEl.textContent = name;
            imgEl.src = image;
            imgEl.alt = name;
            shortDescEl.textContent = desc;
            longDescEl.textContent = longDesc;
            
            // Show modal
            modal.classList.add('active');
            document.body.style.overflow = 'hidden'; // Prevent scrolling
        });
    });
    
    // Close functions
    function closeModal() {
        modal.classList.remove('active');
        document.body.style.overflow = '';
    }
    
    closeBtn.addEventListener('click', closeModal);
    backdrop.addEventListener('click', closeModal);
    
    // Close on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && modal.classList.contains('active')) {
            closeModal();
        }
    });
});
</script>
