<?php
// CTA.php - Floating WhatsApp and Direct Call Action Widget
?>

<!-- Required FontAwesome & AOS Animation for CTA Widget -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<style>
    /* Floating CTA Wrapper Styling for Bottom Right Corner */
    .floating-cta-container {
        position: fixed;
        bottom: 25px;
        right: 25px;
        z-index: 9999;
        display: flex;
        flex-direction: column;
        gap: 14px;
        align-items: flex-end;
    }

    /* Common Button Styling */
    .cta-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        padding: 12px 18px;
        border-radius: 50px;
        font-family: 'Montserrat', sans-serif;
        font-weight: 700;
        text-decoration: none !important;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.25);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        white-space: nowrap;
    }

    .cta-btn:hover {
        transform: translateY(-4px) scale(1.03);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.35);
    }

    /* WhatsApp Button Theme */
    .whatsapp-float-btn {
        background-color: #25D366;
        color: #ffffff;
    }
    .whatsapp-float-btn:hover {
        background-color: #20ba5a;
        color: #ffffff;
    }

    /* Direct Call Button Theme */
    .call-float-btn {
        background-color: #002B5E;
        color: #ffffff;
        border: 2px solid rgba(255, 255, 255, 0.2);
    }
    .call-float-btn:hover {
        background-color: #003B7E;
        color: #ffffff;
    }

    /* Pulse Glow Animation */
    @keyframes cta-pulse {
        0% { box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.6); }
        70% { box-shadow: 0 0 0 15px rgba(37, 211, 102, 0); }
        100% { box-shadow: 0 0 0 0 rgba(37, 211, 102, 0); }
    }
    .pulse-whatsapp {
        animation: cta-pulse 2s infinite;
    }

    /* Responsive adjustments for mobile devices */
    @media (max-width: 640px) {
        .floating-cta-container {
            bottom: 20px;
            right: 15px;
            gap: 10px;
        }
        .cta-btn {
            padding: 10px 14px;
            font-size: 12px;
        }
        .cta-btn i {
            font-size: 18px !important;
        }
    }
</style>

<!-- Floating CTA Widget -->
<div class="floating-cta-container" data-aos="fade-left" data-aos-duration="1000" data-aos-offset="0">
    
    <!-- WhatsApp Enquire Button -->
    <a href="https://wa.me/918102605105?text=Hello%2C%20I%20would%20like%20to%20book%20an%20appointment%20at%20Oral%20Care%20Dental%20Clinic." 
       target="_blank" 
       rel="noopener" 
       class="cta-btn whatsapp-float-btn pulse-whatsapp" 
       title="Chat with us on WhatsApp">
        <i class="fa-brands fa-whatsapp text-xl sm:text-2xl"></i>
        <span class="text-xs sm:text-sm tracking-wide">WhatsApp Us</span>
    </a>

    <!-- Direct Call Button -->
    <a href="tel:8102605105" 
       class="cta-btn call-float-btn" 
       title="Call us directly">
        <i class="fa-solid fa-phone-volume text-base sm:text-lg text-[#3F9E13]"></i>
        <span class="text-xs sm:text-sm tracking-wide">Call Now</span>
    </a>

</div>

<!-- AOS Script initialization -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
</script>