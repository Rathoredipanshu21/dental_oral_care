<?php
// gallery.php
require_once 'config/db.php';
$gallery_result = @mysqli_query($conn, "SELECT * FROM gallery ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinic Gallery - Oral Care Dental Clinic</title>
    
    <!-- Preconnect -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://unpkg.com">
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="preconnect" href="https://cdn.jsdelivr.net">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link icon rel="icon" href="Assets/logo.png" type="image/x-icon">
    <!-- AOS Animation Library CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Playfair+Display:wght@600;700;800&display=swap" rel="stylesheet">

    <style>
        /* Global Overflow Prevention & Typography */
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

        /* Hero Section Styling */
        .gallery-hero {
            position: relative;
            background: linear-gradient(rgba(0, 43, 94, 0.85), rgba(0, 43, 94, 0.90)), 
                        url('https://images.unsplash.com/photo-1629909613654-28e377c37b09?auto=format&fit=crop&w=1920&q=80') center/cover no-repeat;
            padding: 120px 0 90px 0;
            color: #ffffff;
            text-align: center;
        }

        /* Gallery Card Zoom Effect */
        .gallery-item {
            transition: all 0.4s ease;
        }
        .gallery-item:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 25px -5px rgba(0, 43, 94, 0.15);
        }
        .gallery-item img {
            transition: transform 0.5s ease;
        }
        .gallery-item:hover img {
            transform: scale(1.05);
        }
    </style>
</head>
<body class="overflow-x-hidden">

    <!-- Include Navbar at the Top -->
    <?php include 'navbar.php'; ?>

    <!-- Stylish Hero Section -->
    <section class="gallery-hero">
        <div class="w-[92%] md:w-[90%] xl:w-[85%] max-w-[1600px] mx-auto relative z-10" data-aos="fade-down" data-aos-duration="1000">
            <!-- Breadcrumb Pill -->
            <div class="inline-flex items-center bg-white/10 border border-white/20 px-5 py-2 rounded-full text-sm text-white mb-6 backdrop-blur-md">
                <a href="index.php" class="hover:text-[#3F9E13] transition-colors">HOME</a> 
                <span class="text-[#3F9E13] mx-2 font-bold">></span> 
                <span class="text-white font-semibold">GALLERY</span>
            </div>
            <h1 class="text-3xl md:text-5xl font-serif font-bold mb-4 tracking-tight">
                Our Clinic <span class="text-[#3F9E13]">Gallery</span>
            </h1>
            <p class="text-gray-200 text-base md:text-lg max-w-2xl mx-auto leading-relaxed">
                Take a virtual tour of our modern state-of-the-art facilities, advanced equipment, and comfortable clinic environment in Dhanbad.
            </p>
        </div>
    </section>

    <!-- Gallery Grid Section -->
    <section class="relative w-full py-16 md:py-24 bg-professional-grid overflow-hidden border-b border-gray-200">
        <div class="w-[92%] md:w-[90%] xl:w-[85%] max-w-[1600px] mx-auto relative z-10">
            
            <!-- Section Header -->
            <div class="text-center max-w-3xl mx-auto mb-16" data-aos="fade-up" data-aos-duration="800">
                <div class="flex items-center justify-center gap-3 mb-4">
                    <span class="w-8 h-[2px] bg-[#3F9E13]"></span>
                    <h4 class="text-[#3F9E13] text-[11px] font-bold uppercase tracking-[0.25em]">Visual Tour</h4>
                    <span class="w-8 h-[2px] bg-[#3F9E13]"></span>
                </div>
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-serif font-bold text-[#002B5E] leading-tight mb-4">
                    Inside Our Dental Practice
                </h2>
                <p class="text-gray-600 font-medium">Browse through our treatment rooms, sterilization units, and happy patient moments.</p>
            </div>

            <!-- Gallery Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <?php if ($gallery_result && mysqli_num_rows($gallery_result) > 0): ?>
                    <?php while($row = mysqli_fetch_assoc($gallery_result)): ?>
                    <div class="gallery-item bg-white rounded-xl overflow-hidden border border-gray-200/80 shadow-sm cursor-pointer relative group" data-aos="fade-up" onclick="openLightbox('uploads/gallery-images/<?= htmlspecialchars($row['image_name']) ?>')">
                        <div class="h-64 w-full overflow-hidden bg-gray-100 relative">
                            <img src="uploads/gallery-images/<?= htmlspecialchars($row['image_name']) ?>" alt="Oral Care Dental Clinic Gallery" class="w-full h-full object-cover" loading="lazy">
                            <!-- Overlay Icon on Hover -->
                            <div class="absolute inset-0 bg-[#002B5E]/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                <div class="w-12 h-12 rounded-full bg-[#3F9E13] text-white flex items-center justify-center shadow-lg transform scale-75 group-hover:scale-100 transition-transform">
                                    <i class="fas fa-search-plus text-lg"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="col-span-full py-16 text-center text-gray-500">
                        <i class="fas fa-images text-5xl text-gray-300 mb-3"></i>
                        <p class="text-lg font-medium">Gallery images are being updated. Please check back soon!</p>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </section>

    <!-- Lightbox Modal for Full Image View -->
    <div id="lightboxModal" class="fixed inset-0 z-50 bg-black/90 hidden items-center justify-center p-4" onclick="closeLightbox()">
        <button class="absolute top-6 right-6 text-white text-3xl hover:text-[#3F9E13] transition-colors focus:outline-none">
            <i class="fas fa-times"></i>
        </button>
        <img id="lightboxImg" src="" alt="Enlarged View" class="max-w-[90vw] max-h-[85vh] rounded-lg shadow-2xl object-contain" onclick="event.stopPropagation()">
    </div>

    <!-- Include CTA Component -->
    <?php include 'cta.php'; ?>

    <!-- Include Footer at the Bottom -->
    <?php include 'footer.php'; ?>

    <!-- JS Libraries -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js" defer></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            if (typeof AOS !== 'undefined') {
                AOS.init({ once: true, mirror: false, offset: 50 });
            }
        });

        // Lightbox Functions
        function openLightbox(imgSrc) {
            const modal = document.getElementById('lightboxModal');
            const img = document.getElementById('lightboxImg');
            img.src = imgSrc;
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        function closeLightbox() {
            const modal = document.getElementById('lightboxModal');
            modal.classList.remove('flex');
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
    </script>
</body>
</html>