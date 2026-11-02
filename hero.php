<?php
// Include your database connection
require_once 'config/db.php'; 

// Fetch all banners safely
$hero_query = "SELECT * FROM hero_banners ORDER BY id DESC";
$hero_result = @mysqli_query($conn, $hero_query);
?>

<!-- Required CSS & Scripts for Styling -->
<script src="https://cdn.tailwindcss.com"></script>

<!-- Configure Tailwind AFTER loading the CDN to properly disable preflight -->
<script>
    tailwind.config = {
        corePlugins: {
            preflight: false, // This stops Tailwind from adding borders/underlines and breaking Bootstrap
        }
    }
</script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800;900&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    /* Prevent any horizontal scrolling */
    html, body {
        overflow-x: hidden !important;
    }

    /* Force remove any inherited underlines inside the hero section */
    .hero-swiper * {
        text-decoration: none !important;
    }

    /* Typography Classes */
    .font-playfair { font-family: 'Playfair Display', serif; }
    .font-montserrat { font-family: 'Montserrat', sans-serif; }

    /* Swiper custom styling for Oral Care Dental Clinic */
    .hero-swiper { width: 100%; height: 100%; }
    .swiper-pagination-bullet { background: #ffffff !important; opacity: 0.5; width: 10px; height: 10px; transition: all 0.3s ease; }
    .swiper-pagination-bullet-active { background: #3F9E13 !important; opacity: 1; width: 24px; border-radius: 5px; }
    
    /* Professional Background Zoom Animation (Ken Burns Effect) */
    .bg-zoom {
        transition: transform 12s ease-in-out;
        transform: scale(1);
    }
    .swiper-slide-active .bg-zoom {
        transform: scale(1.15); /* Slowly zooms in while active */
    }
    
    /* Elegant Gradient Overlay */
    .premium-overlay {
        background: linear-gradient(90deg, rgba(0, 43, 94, 0.95) 0%, rgba(0, 66, 137, 0.6) 50%, rgba(0, 0, 0, 0.2) 100%);
    }
</style>

<!-- Set Height: Strictly 80vh for Desktop and Mobile -->
<section class="relative w-full h-[80vh] bg-[#002B5E] overflow-hidden">
    <!-- Swiper Container -->
    <div class="swiper hero-swiper h-full w-full">
        <div class="swiper-wrapper h-full w-full">
            
            <?php if($hero_result && mysqli_num_rows($hero_result) > 0): ?>
                <?php while($banner = mysqli_fetch_assoc($hero_result)): 
                    
                    // Safely check for the image column name
                    $image_file = !empty($banner['image']) ? $banner['image'] : 'default-dental.jpg';
                ?>
                    
                <div class="swiper-slide relative h-full w-full overflow-hidden">
                    
                    <!-- Animated Background Image -->
                    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat bg-zoom" 
                         style="background-image: url('uploads/hero-banner/<?= htmlspecialchars($image_file) ?>');">
                    </div>
                    
                    <!-- Premium Gradient Overlay Tint -->
                    <div class="absolute inset-0 premium-overlay z-0"></div>
                    
                    <!-- Content Wrapper: px-[5%] aligns it exactly with your navbar on the left -->
                    <div class="relative h-full w-full px-[5%] flex flex-col justify-center items-center md:items-start text-center md:text-left text-white z-10 font-montserrat">
                        
                        <!-- Dynamic Subtitle / Slogan -->
                        <?php if(!empty($banner['subtitle'])): ?>
                            <span data-aos="fade-up" data-aos-duration="1000" class="text-[#3F9E13] font-bold tracking-[0.25em] uppercase text-xs sm:text-sm md:text-sm mb-4 block drop-shadow-md mx-auto md:ml-0 md:mr-auto">
                                <i class="fa-solid fa-tooth mr-2"></i> <?= htmlspecialchars($banner['subtitle']) ?>
                            </span>
                        <?php endif; ?>

                        <!-- Dynamic Main Heading -->
                        <?php if(!empty($banner['title'])): ?>
                            <h1 data-aos="fade-up" data-aos-delay="150" data-aos-duration="1000" class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-playfair font-black leading-tight mb-5 max-w-4xl drop-shadow-lg mx-auto md:ml-0 md:mr-auto text-white">
                                <?= nl2br(htmlspecialchars($banner['title'])) ?>
                            </h1>
                        <?php endif; ?>
                        
                        <!-- Dynamic Description -->
                        <?php if(!empty($banner['description'])): ?>
                            <p data-aos="fade-up" data-aos-delay="300" data-aos-duration="1000" class="text-sm sm:text-base md:text-lg font-medium mb-8 max-w-2xl text-gray-200 drop-shadow-md mx-auto md:ml-0 md:mr-auto leading-relaxed">
                                <?= htmlspecialchars($banner['description']) ?>
                            </p>
                        <?php endif; ?>
                        
                        <!-- CTA Button -->
                        <?php if(!empty($banner['btn_name'])): ?>
                        <div data-aos="fade-up" data-aos-delay="450" data-aos-duration="1000" class="mx-auto md:ml-0 md:mr-auto flex justify-center md:justify-start w-full md:w-auto">
                            <a href="<?= htmlspecialchars($banner['btn_link'] ?? '#') ?>" class="inline-flex items-center justify-center gap-3 bg-[#3F9E13] text-white font-bold px-7 py-3.5 md:px-9 md:py-4 rounded-md hover:bg-[#004289] hover:text-white transition-all duration-300 shadow-[0_8px_20px_rgba(63,158,19,0.4)] hover:shadow-[0_8px_25px_rgba(0,66,137,0.5)] uppercase tracking-wider group text-xs sm:text-sm outline-none">
                                <span><?= htmlspecialchars($banner['btn_name']) ?></span>
                                <span class="fas fa-arrow-right group-hover:translate-x-1.5 transition-transform duration-300"></span>
                            </a>
                        </div>
                        <?php endif; ?>

                    </div>
                </div>
                
                <?php endwhile; ?>
            <?php else: ?>
                <!-- Fallback slide if database is empty -->
                <div class="swiper-slide relative h-full w-full overflow-hidden">
                    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat bg-zoom" 
                         style="background-image: url('https://images.unsplash.com/photo-1606811841689-23dfddce3e95?q=80&w=2000&auto=format&fit=crop');">
                    </div>
                    
                    <div class="absolute inset-0 premium-overlay z-0"></div>
                    
                    <div class="relative h-full w-full px-[5%] flex flex-col justify-center items-center md:items-start text-center md:text-left text-white z-10 font-montserrat">
                        <span class="text-[#3F9E13] font-bold tracking-[0.25em] uppercase text-xs sm:text-sm mb-4 block mx-auto md:ml-0 md:mr-auto"><i class="fa-solid fa-tooth mr-2"></i> Your Smile, Our Priority</span>
                        <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-playfair font-black leading-tight mb-5 max-w-4xl text-white mx-auto md:ml-0 md:mr-auto">Oral Care Dental Clinic</h1>
                        <p class="text-sm sm:text-base md:text-lg text-gray-200 mb-8 max-w-2xl leading-relaxed mx-auto md:ml-0 md:mr-auto">Experience world-class dentistry with a gentle touch. We provide comprehensive oral care solutions in a comfortable environment.</p>
                        
                        <div class="mx-auto md:ml-0 md:mr-auto flex justify-center md:justify-start w-full md:w-auto">
                            <a href="appointment.php" class="inline-flex items-center justify-center gap-3 bg-[#3F9E13] text-white font-bold px-7 py-3.5 md:px-9 md:py-4 rounded-md hover:bg-[#004289] hover:text-white transition-all duration-300 shadow-[0_8px_20px_rgba(63,158,19,0.4)] uppercase tracking-wider group text-xs sm:text-sm outline-none">
                                <span class="fas fa-calendar-check"></span> 
                                <span>Book Appointment</span>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            
        </div>
        
        <!-- Add Pagination -->
        <div class="swiper-pagination mb-4"></div>
    </div>
</section>

<!-- Scripts for Slider and Animations -->
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    // Initialize AOS Animation
    AOS.init({
        once: false, 
        mirror: true,
        offset: 50
    });

    // Initialize Swiper Slider
    const heroSwiper = new Swiper('.hero-swiper', {
        loop: true,
        effect: 'fade', 
        fadeEffect: {
            crossFade: true
        },
        speed: 1500, // Smooth 1.5-second fade between slides
        autoplay: {
            delay: 6000, 
            disableOnInteraction: false,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        // Re-trigger AOS animations on slide change
        on: {
            slideChangeTransitionStart: function () {
                setTimeout(() => {
                    AOS.refreshHard();
                }, 50);
            }
        }
    });
</script>