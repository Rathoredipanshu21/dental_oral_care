<?php
require_once 'config/db.php';

// Get service ID from URL, default to 1 if not provided or invalid
$service_id = isset($_GET['id']) ? (int)$_GET['id'] : 1;

// Fetch specific service details
$stmt = mysqli_prepare($conn, "SELECT * FROM services WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $service_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$service = mysqli_fetch_assoc($result);

// If service not found, fallback or redirect
if (!$service) {
    // Fallback to the first service if ID doesn't exist
    $fallback = mysqli_query($conn, "SELECT * FROM services ORDER BY id ASC LIMIT 1");
    $service = mysqli_fetch_assoc($fallback);
}

// Fetch all services for the sidebar or quick-switching list
$all_services_result = mysqli_query($conn, "SELECT id, name, speciality FROM services ORDER BY id ASC");
?>
<!DOCTYPE html>
<html lang="en" class="overflow-x-hidden">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $service ? htmlspecialchars($service['name']) : 'Service Details' ?> - Oral Care Dental Clinic</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome & AOS & Swiper -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Playfair+Display:wght@600;700;800&display=swap" rel="stylesheet">

    <style>
        /* Prevent horizontal overflow */
        html, body {
            max-width: 100%;
            overflow-x: hidden !important;
        }

        /* Professional Medical Grid Background matching home-services.php */
        .bg-professional-grid {
            background-color: #f8fafc;
            background-image: 
                linear-gradient(to right, rgba(0, 43, 94, 0.04) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(0, 43, 94, 0.04) 1px, transparent 1px);
            background-size: 40px 40px;
        }
        .bg-professional-grid::after {
            content: ""; position: absolute; inset: 0;
            background-image: radial-gradient(rgba(63, 158, 19, 0.15) 1px, transparent 1px);
            background-size: 40px 40px; background-position: -1px -1px; pointer-events: none;
        }

        /* Card Styling matching home services */
        .service-detail-card {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .service-detail-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 43, 94, 0.1), 0 10px 10px -5px rgba(0, 43, 94, 0.04);
            border-color: #3F9E13;
        }

        /* Swiper Customizations */
        .details-swiper { width: 100%; height: 100%; border-radius: 1rem; }
        .details-swiper .swiper-pagination-bullet {
            background: rgba(255, 255, 255, 0.7);
            opacity: 1;
            width: 8px;
            height: 8px;
            transition: all 0.3s ease;
        }
        .details-swiper .swiper-pagination-bullet-active {
            background: #3F9E13;
            width: 20px;
            border-radius: 4px;
        }
    </style>
</head>
<body class="bg-professional-grid font-sans text-gray-800 antialiased selection:bg-[#3F9E13] selection:text-white">
<?php include 'navbar.php'; ?>
    <!-- Hero Header Banner Inside Details Page -->
    <section class="relative py-16 md:py-24 bg-[#002B5E] text-white overflow-hidden">
        <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#3F9E13_1px,transparent_1px)] [background-size:16px_16px]"></div>
        <div class="w-[92%] md:w-[90%] xl:w-[85%] max-w-[1600px] mx-auto relative z-10 text-center" data-aos="fade-down" data-aos-duration="800">
            <div class="inline-flex items-center gap-2 bg-[#3F9E13]/20 border border-[#3F9E13]/40 px-4 py-1.5 rounded-full text-[#3F9E13] text-xs font-bold uppercase tracking-widest mb-4">
                <i class="fa-solid fa-tooth"></i> Oral Care Clinic Services
            </div>
            <h1 class="text-3xl md:text-5xl lg:text-6xl font-serif font-bold mb-4 tracking-tight">
                <?= $service ? htmlspecialchars($service['name']) : 'Service Details' ?>
            </h1>
            <p class="text-gray-300 max-w-2xl mx-auto text-sm md:text-base font-medium">
                <?= $service ? htmlspecialchars($service['short_desc']) : '' ?>
            </p>
        </div>
    </section>

    <!-- Main Content Section -->
    <section class="relative w-full py-16 md:py-20 overflow-hidden">
        <div class="w-[92%] md:w-[90%] xl:w-[85%] max-w-[1600px] mx-auto relative z-10">
            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                
                <!-- Left Column: Image Carousel Box (Span 6) -->
                <div class="lg:col-span-6" data-aos="fade-right" data-aos-duration="800">
                    <div class="bg-white p-3 rounded-2xl shadow-xl border border-gray-200/80">
                        <div class="relative h-[320px] md:h-[420px] w-full overflow-hidden rounded-xl bg-gray-900">
                            <div class="swiper details-swiper h-full w-full">
                                <div class="swiper-wrapper">
                                    <?php 
                                    $images = !empty($service['images']) ? explode(',', $service['images']) : [];
                                    if (!empty($images) && !empty($images[0])):
                                        foreach($images as $img):
                                    ?>
                                        <div class="swiper-slide h-full w-full">
                                            <img src="uploads/services/<?= htmlspecialchars(trim($img)) ?>" alt="Service Image" loading="lazy" class="w-full h-full object-cover">
                                        </div>
                                    <?php 
                                        endforeach;
                                    else: 
                                    ?>
                                        <div class="swiper-slide h-full w-full">
                                            <img src="https://via.placeholder.com/800x600?text=No+Image+Available" alt="No Image" class="w-full h-full object-cover">
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="swiper-pagination"></div>
                               
                            </div>
                            
                            <?php if(!empty($service['speciality'])): ?>
                            <div class="absolute top-5 right-5 z-20 bg-[#3F9E13] text-white text-xs font-bold px-4 py-2 rounded-lg uppercase tracking-wider shadow-lg">
                                <?= htmlspecialchars($service['speciality']) ?>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Quick Navigation Box of All Services -->
                    <div class="mt-8 bg-white p-6 rounded-2xl shadow-sm border border-gray-200">
                        <h4 class="text-sm font-bold uppercase tracking-wider text-[#002B5E] mb-4 flex items-center gap-2">
                            <i class="fa-solid fa-list-check text-[#3F9E13]"></i> Explore Other Treatments
                        </h4>
                        <div class="flex flex-wrap gap-2">
                            <?php while($s = mysqli_fetch_assoc($all_services_result)): ?>
                                <a href="service_details.php?id=<?= $s['id'] ?>" class="text-xs font-semibold px-3 py-2 rounded-lg transition-all <?= ($s['id'] == $service_id) ? 'bg-[#002B5E] text-white shadow-md' : 'bg-gray-100 text-gray-700 hover:bg-[#3F9E13] hover:text-white' ?>">
                                    <?= htmlspecialchars($s['name']) ?>
                                </a>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Detailed Description & Sub-Services (Span 6) -->
                <div class="lg:col-span-6 flex flex-col gap-6" data-aos="fade-left" data-aos-duration="800">
                    
                    <!-- Overview Box -->
                    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-200/80">
                        <div class="flex items-center gap-3 mb-4">
                            <span class="w-8 h-[2px] bg-[#3F9E13]"></span>
                            <span class="text-[#3F9E13] text-xs font-bold uppercase tracking-widest">Comprehensive Overview</span>
                        </div>
                        <h2 class="text-2xl md:text-3xl font-serif font-bold text-[#002B5E] mb-4">
                            <?= htmlspecialchars($service['name']) ?>
                        </h2>
                        <p class="text-gray-600 leading-relaxed text-base mb-6">
                            <?= nl2br(htmlspecialchars($service['long_desc'])) ?>
                        </p>

                        <div class="pt-6 border-t border-gray-100 flex flex-wrap items-center justify-between gap-4">
                            <div>
                                <span class="block text-xs font-bold text-gray-400 uppercase tracking-wider">Category</span>
                                <span class="text-sm font-bold text-[#002B5E]"><?= htmlspecialchars($service['speciality'] ?: 'General Dentistry') ?></span>
                            </div>
                            <div>
                                <span class="block text-xs font-bold text-gray-400 uppercase tracking-wider">Published Date</span>
                                <span class="text-sm font-bold text-gray-700"><?= date('d M, Y', strtotime($service['created_at'])) ?></span>
                            </div>
                            <a href="#booking" onclick="alert('Please navigate to booking or contact section to schedule your appointment.')" class="bg-[#3F9E13] hover:bg-[#002B5E] text-white px-6 py-3 rounded-xl font-semibold text-sm transition-colors shadow-md inline-flex items-center gap-2">
                                <i class="fa-solid fa-calendar-check"></i> Book Appointment
                            </a>
                        </div>
                    </div>

                    <!-- Sub-Services Stylish Box Section -->
                    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-200/80">
                        <div class="flex items-center gap-3 mb-4">
                            <span class="w-8 h-[2px] bg-[#3F9E13]"></span>
                            <span class="text-[#3F9E13] text-xs font-bold uppercase tracking-widest">Included Sub-Services</span>
                        </div>
                        <h3 class="text-xl font-bold text-[#002B5E] mb-6">
                            Specialized Care Components
                        </h3>

                        <?php if (!empty($service['sub_services'])): 
                            $sub_list = explode(',', $service['sub_services']);
                        ?>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                <?php foreach($sub_list as $sub): 
                                    if(trim($sub) == '') continue;
                                ?>
                                    <div class="service-detail-card bg-gray-50 border border-gray-200/70 p-4 rounded-xl flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-lg bg-[#3F9E13]/10 flex items-center justify-center text-[#3F9E13] shrink-0 font-bold">
                                            <i class="fa-solid fa-check"></i>
                                        </div>
                                        <span class="font-bold text-sm text-[#002B5E]"><?= htmlspecialchars(trim($sub)) ?></span>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <p class="text-sm text-gray-500 italic">No specific sub-services listed for this treatment. Full professional care is provided directly.</p>
                        <?php endif; ?>
                    </div>

                </div>

            </div>

        </div>
    </section>
<?php include 'footer.php'; ?>

    <!-- Scripts -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Initialize AOS Animation
            if (typeof AOS !== 'undefined') {
                AOS.init({ once: true, mirror: false, offset: 50 });
            }

            // Initialize Swiper Carousel
            new Swiper('.details-swiper', {
                loop: true,
                speed: 800,
                autoplay: {
                    delay: 4000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                allowTouchMove: true
            });
        });
    </script>
</body>
</html>