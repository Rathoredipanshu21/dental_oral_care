<!-- home-about.php -->
<!-- Required Libraries for Icons and Animations -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    /* ==========================================
       STRICTLY SCOPED CSS TO PREVENT CONFLICTS
       ========================================== */
    
    .home-about-section {
        position: relative;
        width: 100%;
        /* Strict 80vh height on desktop, flexible minimum on mobile */
        min-height: 80vh;
        /* Padding from all sides (10px) as requested */
        padding: 10px;
        overflow-x: hidden !important;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #ffffff;
        /* Row and Column Line Background (Grid Pattern) */
        background-image: 
            linear-gradient(to right, rgba(0, 43, 94, 0.05) 1px, transparent 1px),
            linear-gradient(to bottom, rgba(0, 43, 94, 0.05) 1px, transparent 1px);
        background-size: 40px 40px;
        font-family: 'Montserrat', sans-serif;
    }

    .home-about-container {
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: 40px;
        /* Added internal top padding to ensure content breathes */
        padding-top: 20px; 
    }

    /* --- Left Side: Image Collage --- */
    .home-about-left {
        flex: 1 1 45%;
        position: relative;
        height: 500px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Box Linning Design (Decorative frames behind images) */
    .home-about-box-line-1 {
        position: absolute;
        top: 20px;
        left: 20px;
        right: 60px;
        bottom: 60px;
        border: 2px dashed rgba(0, 43, 94, 0.3);
        border-radius: 15px;
        z-index: 1;
    }
    .home-about-box-line-2 {
        position: absolute;
        top: 60px;
        left: 60px;
        right: 20px;
        bottom: 20px;
        border: 3px solid rgba(63, 158, 19, 0.4);
        border-radius: 15px;
        z-index: 1;
    }

    /* Collage Images */
    .home-about-img-back {
        position: absolute;
        top: 0;
        left: 0;
        width: 65%;
        height: 70%;
        border-radius: 15px;
        object-fit: cover;
        border: 5px solid #ffffff;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        z-index: 2;
    }

    .home-about-img-front {
        position: absolute;
        bottom: 0;
        right: 0;
        width: 65%;
        height: 70%;
        border-radius: 15px;
        object-fit: cover;
        border: 6px solid #ffffff;
        box-shadow: 0 15px 40px rgba(0,0,0,0.15);
        z-index: 3;
    }

    .home-about-experience-badge {
        position: absolute;
        bottom: 15px;
        left: -20px;
        background: #ffffff;
        padding: 10px 20px;
        border-radius: 8px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        display: flex;
        align-items: center;
        gap: 10px;
        z-index: 4;
        border-left: 4px solid #3F9E13;
    }

    .home-about-exp-num {
        font-family: 'Playfair Display', serif;
        font-size: 28px;
        font-weight: 800;
        color: #3F9E13;
    }
    .home-about-exp-text {
        font-size: 11px;
        font-weight: 700;
        color: #002B5E;
        text-transform: uppercase;
        line-height: 1.2;
    }

    /* --- Right Side: Content & Box Column --- */
    .home-about-right {
        flex: 1 1 45%;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .home-about-subtitle {
        color: #3F9E13;
        font-size: 13px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .home-about-title {
        font-family: 'Playfair Display', serif;
        font-size: 42px;
        font-weight: 800;
        color: #002B5E;
        line-height: 1.1;
        margin: 0 0 20px 0;
    }

    .home-about-desc {
        font-size: 15px;
        color: #555555;
        line-height: 1.7;
        margin-bottom: 30px;
    }

    /* Box Column Design (2x2 Grid) */
    .home-about-features-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
        margin-bottom: 35px;
    }

    .home-about-feature-box {
        background: #ffffff;
        border: 1px solid #eeeeee;
        border-radius: 10px;
        padding: 15px;
        display: flex;
        align-items: flex-start;
        gap: 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.02);
        transition: all 0.3s ease;
    }
    .home-about-feature-box:hover {
        border-color: #3F9E13;
        box-shadow: 0 5px 15px rgba(63, 158, 19, 0.1);
        transform: translateY(-2px);
    }

    .home-about-feature-icon {
        width: 35px;
        height: 35px;
        background: rgba(0, 43, 94, 0.05);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #002B5E;
        font-size: 16px;
        flex-shrink: 0;
        transition: all 0.3s ease;
    }
    .home-about-feature-box:hover .home-about-feature-icon {
        background: rgba(63, 158, 19, 0.1);
        color: #3F9E13;
    }

    .home-about-feature-text h4 {
        margin: 0 0 4px 0;
        font-size: 14px;
        color: #002B5E;
        font-weight: 700;
    }
    .home-about-feature-text p {
        margin: 0;
        font-size: 12px;
        color: #777777;
        line-height: 1.4;
    }

    /* Buttons */
    .home-about-btn-group {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
    }
    .home-about-btn-primary {
        background: #3F9E13;
        color: #ffffff;
        padding: 12px 25px;
        border-radius: 5px;
        font-size: 13px;
        font-weight: 700;
        text-transform: uppercase;
        text-decoration: none;
        letter-spacing: 1px;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(63, 158, 19, 0.3);
    }
    .home-about-btn-primary:hover {
        background: #002B5E;
        color: #ffffff;
        box-shadow: 0 5px 15px rgba(0, 43, 94, 0.3);
    }
    .home-about-btn-secondary {
        background: transparent;
        color: #002B5E;
        padding: 10px 23px;
        border: 2px solid #002B5E;
        border-radius: 5px;
        font-size: 13px;
        font-weight: 700;
        text-transform: uppercase;
        text-decoration: none;
        letter-spacing: 1px;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .home-about-btn-secondary:hover {
        background: #002B5E;
        color: #ffffff;
    }

    /* --- Responsive Adjustments --- */
    @media (max-width: 992px) {
        .home-about-section { height: auto; padding: 40px 15px; }
        .home-about-left, .home-about-right { flex: 1 1 100%; }
        .home-about-left { height: 400px; margin-bottom: 30px; }
        .home-about-title { font-size: 32px; }
    }
    @media (max-width: 576px) {
        .home-about-features-grid { grid-template-columns: 1fr; }
        .home-about-left { height: 320px; }
        .home-about-img-back, .home-about-img-front { width: 75%; }
        .home-about-box-line-1 { right: 30px; bottom: 30px; }
        .home-about-box-line-2 { left: 30px; top: 30px; }
        .home-about-btn-group { flex-direction: column; width: 100%; }
        .home-about-btn-primary, .home-about-btn-secondary { text-align: center; justify-content: center; }
    }
</style>

<section class="home-about-section">
    <div class="home-about-container">
        
        <!-- LEFT SIDE: 2-Image Collage with Box Lining -->
        <div class="home-about-left" data-aos="fade-right" data-aos-duration="1000">
            <!-- Box Linning Backgrounds -->
            <div class="home-about-box-line-1"></div>
            <div class="home-about-box-line-2"></div>

            <!-- Images -->
            <img src="Assets/branch21.png" alt="Dental Clinic Interior" class="home-about-img-back">
            <img src="Assets/homeabout.png" alt="Happy Patient Smile" class="home-about-img-front">
            
            <!-- Experience Badge -->
            <div class="home-about-experience-badge">
                <div class="home-about-exp-num">17+</div>
                <div class="home-about-exp-text">Years of<br>Excellence</div>
            </div>
        </div>

        <!-- RIGHT SIDE: Content and Box Column Design -->
        <div class="home-about-right" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
            
            <div class="home-about-subtitle">
                <i class="fa-solid fa-tooth"></i> About Oral Care Dental
            </div>
            
            <h2 class="home-about-title">Modern Dentistry with a Gentle Touch.</h2>
            
            <p class="home-about-desc">
                Welcome to Oral Care Dental Clinic, Dhanbad's premier destination for comprehensive oral health. We blend state-of-the-art dental technology with compassionate care to create healthy, beautiful smiles that last a lifetime.
            </p>

            <!-- Box Column (2x2 Grid) -->
            <div class="home-about-features-grid">
                
                <div class="home-about-feature-box">
                    <div class="home-about-feature-icon"><i class="fa-solid fa-user-doctor"></i></div>
                    <div class="home-about-feature-text">
                        <h4>Expert Specialists</h4>
                        <p>Highly qualified professionals.</p>
                    </div>
                </div>

                <div class="home-about-feature-box">
                    <div class="home-about-feature-icon"><i class="fa-solid fa-microscope"></i></div>
                    <div class="home-about-feature-text">
                        <h4>Advanced Tech</h4>
                        <p>Modern equipment & X-rays.</p>
                    </div>
                </div>

                <div class="home-about-feature-box">
                    <div class="home-about-feature-icon"><i class="fa-solid fa-face-smile-beam"></i></div>
                    <div class="home-about-feature-text">
                        <h4>Painless Care</h4>
                        <p>Comfortable, anxiety-free.</p>
                    </div>
                </div>

                <div class="home-about-feature-box">
                    <div class="home-about-feature-icon"><i class="fa-solid fa-hand-holding-dollar"></i></div>
                    <div class="home-about-feature-text">
                        <h4>Affordable</h4>
                        <p>Premium care for your budget.</p>
                    </div>
                </div>

            </div>

            <!-- Buttons -->
            <div class="home-about-btn-group">
                <a href="about.php" class="home-about-btn-primary">Discover More</a>
                <a href="contact.php" class="home-about-btn-secondary"><i class="fa-solid fa-phone"></i> Contact Us</a>
            </div>

        </div>

    </div>
</section>

<!-- Initialize AOS Animation -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        AOS.init({
            once: false,
            mirror: true,
            offset: 50
        });
    });
</script>