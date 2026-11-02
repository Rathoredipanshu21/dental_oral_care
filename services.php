<?php
// services.php
require_once 'config/db.php';
// ID 1 shows first and the last ID shows last
$services_result = @mysqli_query($conn, "SELECT * FROM services ORDER BY id ASC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Services - Oral Care Dental Clinic</title>
    
    <!-- Preconnect to external domains for instant DNS resolution -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://unpkg.com">
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="preconnect" href="https://cdn.jsdelivr.net">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- AOS Animation Library CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link icon rel="icon" href="Assets/logo.png" type="image/x-icon">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Playfair+Display:wght@600;700;800&display=swap" rel="stylesheet">

    <style>
        /* Global Overflow Prevention & Font Setup */
        html, body {
            overflow-x: hidden !important;
            max-width: 100vw;
            font-family: 'Montserrat', sans-serif;
            background-color: #f8fafc;
            color: #333;
            margin: 0;
            padding: 0;
        }

        h1, h2, h3, h4, .font-serif {
            font-family: 'Playfair Display', serif;
        }

        /* Professional Medical Grid Background */
        .bg-professional-grid {
            background-color: #f8fafc;
            background-image: 
                linear-gradient(to right, rgba(0, 43, 94, 0.04) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(0, 43, 94, 0.04) 1px, transparent 1px);
            background-size: 40px 40px;
            position: relative;
        }
        .bg-professional-grid::after {
            content: ""; position: absolute; inset: 0;
            background-image: radial-gradient(rgba(63, 158, 19, 0.15) 1px, transparent 1px);
            background-size: 40px 40px; background-position: -1px -1px; pointer-events: none;
        }

        /* Service Card Styling */
        .service-card {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .service-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgba(0, 43, 94, 0.1), 0 10px 10px -5px rgba(0, 43, 94, 0.04);
            border-color: #3F9E13;
        }
        
        /* Card Inner Swiper */
        .card-swiper { width: 100%; height: 100%; border-radius: 0.5rem 0.5rem 0 0; }
        
        /* Custom Pagination Dots */
        .card-swiper .swiper-pagination {
            bottom: 10px !important;
        }
        .card-swiper .swiper-pagination-bullet {
            background: rgba(255, 255, 255, 0.6);
            opacity: 1;
            width: 6px;
            height: 6px;
            transition: all 0.3s ease;
        }
        .card-swiper .swiper-pagination-bullet-active {
            background: #3F9E13;
            width: 16px;
            border-radius: 4px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.3);
        }
        
        .swiper-slide img {
            background-color: #e2e8f0;
        }

        /* Hero Background Overlay matching screenshot theme */
        .services-hero {
            position: relative;
            background: linear-gradient(rgba(0, 43, 94, 0.85), rgba(0, 43, 94, 0.90)), 
                        url('https://images.unsplash.com/photo-1629909613654-28e377c37b09?auto=format&fit=crop&w=1920&q=80') center/cover no-repeat;
            padding: 120px 0 90px 0;
            color: #ffffff;
            text-align: center;
        }
    </style>
</head>
<body class="overflow-x-hidden">

    <!-- Include Navbar at the Top -->
    <?php include 'navbar.php'; ?>

    <!-- Stylish Hero Section with Background Image & Breadcrumb -->
    <section class="services-hero">
        <div class="w-[92%] md:w-[90%] xl:w-[85%] max-w-[1600px] mx-auto relative z-10" data-aos="fade-down" data-aos-duration="1000">
            <!-- Breadcrumb Pill -->
            <div class="inline-flex items-center bg-white/10 border border-white/20 px-5 py-2 rounded-full text-sm text-white mb-6 backdrop-blur-md">
                <a href="index.php" class="hover:text-[#3F9E13] transition-colors">HOME</a> 
                <span class="text-[#3F9E13] mx-2 font-bold">></span> 
                <span class="text-white font-semibold">SERVICES</span>
            </div>
            <h1 class="text-3xl md:text-5xl font-serif font-bold mb-4 tracking-tight">
                Our Comprehensive <span class="text-[#3F9E13]">Dental Services</span>
            </h1>
            <p class="text-gray-200 text-base md:text-lg max-w-2xl mx-auto leading-relaxed">
                Equipped with cutting-edge dental technology and staffed by expert professionals for seamless, painless, and world-class care.
            </p>
        </div>
    </section>

    <!-- Services Section (Integrated Grid Design matching home-services) -->
    <section class="relative w-full py-16 md:py-24 bg-professional-grid overflow-hidden border-b border-gray-200">
        <div class="w-[92%] md:w-[90%] xl:w-[85%] max-w-[1600px] mx-auto relative z-10">
            
            <!-- Section Header -->
            <div class="text-center max-w-3xl mx-auto mb-16" data-aos="fade-up" data-aos-duration="800">
                <div class="flex items-center justify-center gap-3 mb-4">
                    <span class="w-8 h-[2px] bg-[#3F9E13]"></span>
                    <h4 class="text-[#3F9E13] text-[11px] font-bold uppercase tracking-[0.25em]">Our Offerings</h4>
                    <span class="w-8 h-[2px] bg-[#3F9E13]"></span>
                </div>
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-serif font-bold text-[#002B5E] leading-tight mb-4">
                    Premium Dental Treatments
                </h2>
                <p class="text-gray-600 font-medium">Explore our specialized treatments tailored to keep your smile healthy, bright, and completely confident.</p>
            </div>

            <!-- Services Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                
                <?php if ($services_result && mysqli_num_rows($services_result) > 0): ?>
                    <?php while($srv = mysqli_fetch_assoc($services_result)): 
                        // Explode comma-separated images string
                        $images = !empty($srv['images']) ? explode(',', $srv['images']) : [];
                    ?>
                    
                    <div data-aos="fade-up" class="service-card relative bg-white rounded-lg border border-gray-200/80 cursor-pointer flex flex-col h-full z-10 group" onclick="window.location.href='service_details.php?id=<?= $srv['id'] ?>'">
                        
                        <!-- Top: Image Carousel Box -->
                        <div class="relative h-56 w-full overflow-hidden rounded-t-lg bg-[#002B5E]">
                            <div class="swiper card-swiper">
                                <div class="swiper-wrapper">
                                    <?php if(!empty($images) && !empty($images[0])): ?>
                                        <?php foreach($images as $img): ?>
                                        <div class="swiper-slide h-full w-full">
                                            <img src="uploads/services/<?= htmlspecialchars(trim($img)) ?>" alt="Service Image" loading="lazy" class="w-full h-full object-cover" />
                                        </div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <div class="swiper-slide h-full w-full">
                                            <img src="https://via.placeholder.com/600x400?text=No+Image" alt="No Image" loading="lazy" class="w-full h-full object-cover" />
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="swiper-pagination"></div>
                            </div>
                            
                            <?php if(!empty($srv['speciality'])): ?>
                            <div class="absolute top-4 right-4 z-20 bg-[#3F9E13] text-white text-[10px] font-bold px-3 py-1.5 rounded uppercase tracking-wider shadow-lg">
                                <?= htmlspecialchars($srv['speciality']) ?>
                            </div>
                            <?php endif; ?>
                        </div>

                        <!-- Bottom: Content -->
                        <div class="p-6 flex flex-col flex-grow">
                            <h3 class="text-xl font-bold text-[#002B5E] mb-3 group-hover:text-[#3F9E13] transition-colors">
                                <?= htmlspecialchars($srv['name']) ?>
                            </h3>
                            
                            <p class="text-sm text-gray-600 leading-relaxed mb-6 line-clamp-2">
                                <?= htmlspecialchars($srv['short_desc']) ?>...
                            </p>
                            
                            <div class="mt-auto">
                                <div class="pt-4 border-t border-gray-100 flex items-center justify-between">
                                    <span class="text-[#002B5E] font-bold text-xs uppercase tracking-widest group-hover:text-[#3F9E13] transition-colors">
                                        View Service Details
                                    </span>
                                    <div class="w-8 h-8 rounded-full bg-[#3F9E13]/10 flex items-center justify-center group-hover:bg-[#3F9E13] transition-colors">
                                        <i class="fas fa-arrow-right text-[#3F9E13] group-hover:text-white text-sm transition-colors"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="col-span-full py-12 text-center text-gray-500">
                        <i class="fas fa-tooth text-4xl text-gray-300 mb-3"></i>
                        <p>New dental services are being updated. Please check back soon.</p>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </section>
<?php include 'all_services.php'; ?>
    <!-- Include CTA Component -->
    <?php include 'cta.php'; ?>

    <!-- Include Footer at the Bottom -->
    <?php include 'footer.php'; ?>

    <!-- JS Libraries -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js" defer></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            if (typeof AOS !== 'undefined') {
                AOS.init({ once: true, mirror: false, offset: 50 });
            }

            const cardSwipers = document.querySelectorAll('.card-swiper');
            cardSwipers.forEach(swiperEl => {
                new Swiper(swiperEl, {
                    loop: true,
                    speed: 800,
                    autoplay: {
                        delay: 3500 + (Math.random() * 2000),
                        disableOnInteraction: false,
                    },
                    pagination: {
                        el: swiperEl.querySelector('.swiper-pagination'),
                        clickable: false,
                    },
                    allowTouchMove: true
                });
            });
        });
    </script>
</body>
</html>