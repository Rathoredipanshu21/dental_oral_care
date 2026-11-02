<?php 
$current_page = basename($_SERVER['PHP_SELF'], ".php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oral Care Dental Clinic</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --nav-dark: #002B5E; 
            --nav-accent: #4D8B1C; 
            --nav-accent-light: #6CB434; 
            --nav-white: #FFFFFF;
            --nav-bg-glass: rgba(255, 255, 255, 0.98);
            --brand-font: 'Playfair Display', serif;
            --ui-font: 'Montserrat', sans-serif;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        html, body {
            overflow-x: hidden !important;
            margin: 0;
            padding: 0;
            width: 100%;
        }

        body {
            padding-top: 105px; /* Reduced body padding */
        }

        #sharma-nav-wrapper {
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            width: 100% !important;
            z-index: 999999 !important; 
            font-family: var(--ui-font);
            box-shadow: 0 2px 15px rgba(0,0,0,0.06);
            background: var(--nav-white);
        }

        /* --- Elegant Top Bar --- */
        .top-bar-sharma {
            background-color: var(--nav-dark);
            color: var(--nav-white);
            padding: 7px 5%; /* Reduced padding */
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 11px;
            font-weight: 400;
            letter-spacing: 0.5px;
        }
        .top-bar-sharma a { color: var(--nav-white); text-decoration: none; margin-left: 15px; transition: var(--transition); }
        .top-bar-sharma a:hover { color: var(--nav-accent-light); }
        .top-bar-sharma i { color: var(--nav-accent-light); margin-right: 6px; }

        /* --- Main Navbar --- */
        .sharma-nav-container {
            display: flex;
            align-items: center;
            justify-content: space-between; /* Perfect distribution of space */
            padding: 10px 5%; /* Reduced padding for a sleek look */
            background: var(--nav-bg-glass);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            transition: var(--transition);
        }

        /* Branding */
        .nav-brand-box {
            display: flex;
            align-items: center;
            text-decoration: none;
            flex-shrink: 0;
            gap: 12px; /* Clean spacing between logo and text */
        }
        
        .nav-brand-box img { 
            height: 60px; /* Professional, balanced size */
            transition: var(--transition); 
        } 
        
        .brand-text-stack { 
            display: flex; 
            flex-direction: column; 
            justify-content: center;
        }
        .nav-brand-name { 
            color: var(--nav-dark);
            font-family: var(--brand-font);
            font-size: 20px; /* Elegant desktop size */
            font-weight: 700; 
            line-height: 1.1;
            white-space: nowrap; 
        }
        .nav-brand-slogan { 
            color: var(--nav-accent); 
            font-size: 10px; 
            text-transform: uppercase; 
            letter-spacing: 1px; 
            font-weight: 600;
            margin-top: 3px;
            white-space: nowrap;
        }

        /* Desktop Menu */
        .desktop-menu-list { display: flex; list-style: none; margin: 0; padding: 0; }
        .desktop-menu-list li { margin: 0 12px; position: relative; }
        .desktop-menu-list a { 
            text-decoration: none; 
            color: var(--nav-dark); 
            font-size: 12px; 
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: 0.5px;
            padding: 5px 0;
            transition: var(--transition);
        }
        .desktop-menu-list a::after {
            content: '';
            position: absolute;
            bottom: 0; left: 0;
            width: 0; height: 2px;
            background: var(--nav-accent);
            transition: var(--transition);
        }
        .desktop-menu-list a:hover::after, 
        .desktop-menu-list a.active::after { width: 100%; }
        .desktop-menu-list a.active { color: var(--nav-accent); }

        /* Action Buttons */
        .nav-right-actions { display: flex; align-items: center; gap: 12px; }
        .btn-enquiry, .btn-appointment {
            padding: 9px 18px;
            text-decoration: none;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-radius: 4px;
            transition: var(--transition);
            white-space: nowrap;
        }
        
        .btn-enquiry {
            background: var(--nav-accent);
            color: #fff !important;
            box-shadow: 0 4px 12px rgba(77, 139, 28, 0.2);
        }
        .btn-enquiry:hover { background: var(--nav-dark); transform: translateY(-1px); }

        .btn-appointment {
            background: var(--nav-dark);
            color: #fff !important;
            box-shadow: 0 4px 12px rgba(0, 43, 94, 0.2);
        }
        .btn-appointment:hover { background: var(--nav-accent); transform: translateY(-1px); }

        /* Mobile Controls */
        #v-menu-toggle { display: none; }
        .v-menu-btn { font-size: 22px; cursor: pointer; color: var(--nav-dark); display: none; margin-left: 10px; }

        /* Modern Drawer */
        .v-drawer {
            position: fixed;
            top: 0; right: -100%; 
            width: 280px;
            height: 100vh;
            background: var(--nav-white);
            z-index: 1000000;
            transition: 0.4s cubic-bezier(0.77,0.2,0.05,1.0);
            padding: 50px 0;
            display: flex;
            flex-direction: column;
            box-shadow: -5px 0 25px rgba(0,0,0,0.1);
        }
        #v-menu-toggle:checked ~ .v-drawer { right: 0; }
        .v-drawer-overlay {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0, 43, 94, 0.4);
            backdrop-filter: blur(3px);
            visibility: hidden; opacity: 0; z-index: 999999; transition: 0.4s;
        }
        #v-menu-toggle:checked ~ .v-drawer-overlay { visibility: visible; opacity: 1; }
        .v-close-drawer { position: absolute; top: 15px; right: 20px; font-size: 26px; cursor: pointer; color: var(--nav-dark); }

        .v-drawer-list { list-style: none; padding: 0; margin-top: 15px; }
        .v-drawer-list a {
            display: block;
            padding: 15px 35px;
            text-decoration: none;
            color: var(--nav-dark);
            text-transform: uppercase;
            font-weight: 600;
            font-size: 13px;
            letter-spacing: 0.5px;
            border-bottom: 1px solid #f0f0f0;
            transition: 0.3s;
        }
        .v-drawer-list a:hover { padding-left: 42px; color: var(--nav-accent); background: #fafafa; }

        /* RESPONSIVENESS */
        @media (max-width: 1100px) {
            .desktop-menu-list { display: none; }
            .v-menu-btn { display: block; }
        }

        @media (max-width: 992px) {
            .top-bar-sharma .addr-hide { display: none; }
            .sharma-nav-container { padding: 10px 4%; }
            body { padding-top: 95px; }
        }

        @media (max-width: 768px) {
            .btn-enquiry { display: none; }
        }

        /* Phone Screen Adjustments - Stylish & Professional */
        @media (max-width: 576px) {
            body { padding-top: 85px; }
            .top-bar-sharma { justify-content: center; font-size: 10px; padding: 6px 3%; }
            .top-bar-sharma div:last-child { display: none; }
            .sharma-nav-container { padding: 8px 3%; }
            .btn-appointment { display: none; } 
            
            /* Perfectly scaled brand for mobile - no cutting off */
            .nav-brand-box img { height: 40px; } 
            .nav-brand-name { font-size: 18.5px; line-height: 1.2; white-space: nowrap; } /* Fits perfectly on one line */
            .nav-brand-slogan { font-size: 8px; letter-spacing: 0.5px; }
            .nav-brand-box { gap: 8px; }
        }
        
        @media (max-width: 360px) {
            /* Extra safety net for very small phones like iPhone SE */
            .nav-brand-name { font-size: 13px; }
            .nav-brand-box img { height: 35px; }
        }
    </style>
</head>
<body>

<header id="sharma-nav-wrapper">
    <div class="top-bar-sharma">
        <div>
            <span><i class="fas fa-phone-alt"></i> 081026 05105</span>
            <span class="ms-4 addr-hide"><i class="fas fa-map-marker-alt"></i> 1st Floor, A Block, Gupteshwar Complex, beside punjab national bank, Bekarbandh, Forest Colony, Dhanbad, Jharkhand 828130</span>
        </div>
        <div>
            <a href="#" title="Instagram"><i class="fab fa-instagram"></i></a>
            <a href="#" title="WhatsApp"><i class="fab fa-whatsapp"></i></a>
        </div>
    </div>

    <nav class="sharma-nav-container">
        <a href="index" class="nav-brand-box">
            <img src="Assets/logo.png" alt="Oral Care Dental Clinic Logo">
            <div class="brand-text-stack">
                <span class="nav-brand-name">Oral Care Dental clinic</span>
                <span class="nav-brand-slogan">Your Smile, Our Priority</span>
            </div>
        </a>

        <ul class="desktop-menu-list">
            <li><a href="index" class="<?= ($current_page == 'index') ? 'active' : ''; ?>">Home</a></li>
            <li><a href="about" class="<?= ($current_page == 'about') ? 'active' : ''; ?>">About</a></li>
            <li><a href="services" class="<?= ($current_page == 'services') ? 'active' : ''; ?>">Services</a></li>
            <li><a href="Patient-care" class="<?= ($current_page == 'Patient-care') ? 'active' : ''; ?>">Patient Care</a></li>
            <li><a href="gallery" class="<?= ($current_page == 'gallery') ? 'active' : ''; ?>">Gallery</a></li>
            <li><a href="contact" class="<?= ($current_page == 'contact') ? 'active' : ''; ?>">Contact</a></li>
        </ul>

        <div class="nav-right-actions">
            <a href="enquiry" class="btn-enquiry">Get Quote</a>
            <a href="appointment" class="btn-appointment">Book Appointment</a>
            
            <input type="checkbox" id="v-menu-toggle">
            <label for="v-menu-toggle" class="v-menu-btn">
                <i class="fas fa-bars-staggered"></i>
            </label>

            <div class="v-drawer">
                <label for="v-menu-toggle" class="v-close-drawer">&times;</label>
                <div class="px-4 mb-4" style="overflow: hidden;">
                    <div class="nav-brand-name" style="font-size: 18px; white-space: nowrap;">Oral Care Dental clinic</div>
                    <div class="nav-brand-slogan" style="letter-spacing: 0.5px; font-size: 9px; white-space: nowrap;">Your Smile, Our Priority</div>
                </div>
                <ul class="v-drawer-list">
                    <li><a href="index">Home</a></li>
                    <li><a href="about">About Us</a></li>
                    <li><a href="services">Our Services</a></li>
                    <li><a href="gallery">Gallery</a></li>
                    <li><a href="contact">Contact</a></li>
                    <li><a href="enquiry" style="color: var(--nav-accent); font-weight: 700;">Get Quote</a></li>
                    <li><a href="appointment" style="color: var(--nav-dark); font-weight: 700;">Book Appointment</a></li>
                </ul>
                <div class="mt-auto px-5 pb-4">
                    <p style="font-size: 10px; text-transform: uppercase; color: #aaa; letter-spacing: 1px;">Follow Us</p>
                    <div style="font-size: 18px;">
                        <a href="#" class="me-3" style="color: var(--nav-dark);"><i class="fab fa-instagram"></i></a>
                        <a href="#" style="color: var(--nav-dark);"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
            </div>
            <label for="v-menu-toggle" class="v-drawer-overlay"></label>
        </div>
    </nav>
</header>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    window.addEventListener('scroll', function() {
        const nav = document.querySelector('.sharma-nav-container');
        if (window.scrollY > 30) {
            nav.style.padding = '8px 5%';
            nav.style.background = 'rgba(255, 255, 255, 0.98)';
            nav.style.boxShadow = '0 4px 15px rgba(0,0,0,0.05)';
        } else {
            nav.style.padding = '10px 5%';
            nav.style.background = 'var(--nav-bg-glass)';
            nav.style.boxShadow = 'none';
        }
    });
</script>
</body>
</html>