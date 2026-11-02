<?php
// about.php - About Us Page for Oral Care Dental Clinic
?>
<!DOCTYPE html>
<html lang="en" class="overflow-x-hidden">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Oral Care Dental Clinic</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            corePlugins: { preflight: false }
        }
    </script>
    <!-- FontAwesome & Google Fonts & AOS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800;900&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        html, body {
            overflow-x: hidden !important;
            margin: 0;
            padding: 0;
        }
        .font-playfair { font-family: 'Playfair Display', serif; }
        .font-montserrat { font-family: 'Montserrat', sans-serif; }
        
        /* Consistent Theme Background Design */
        .page-bg {
            background-color: #f8fafc;
            background-image: 
                linear-gradient(to right, rgba(0, 43, 94, 0.03) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(0, 43, 94, 0.03) 1px, transparent 1px);
            background-size: 40px 40px;
        }
    </style>
</head>
<body class="font-montserrat page-bg text-[#002B5E] overflow-x-hidden">

    <?php include 'navbar.php'; ?>

    <!-- ================= STYLISH HERO SECTION (70vh) ================= -->
    <section class="relative w-full h-[70vh] bg-[#002B5E] flex items-center justify-center text-center overflow-hidden">
        <div class="absolute inset-0 bg-cover bg-center opacity-40 mix-blend-overlay" style="background-image: url('https://images.unsplash.com/photo-1629909613654-28e377c37b09?q=80&w=2000&auto=format&fit=crop');"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-[#002B5E] via-transparent to-black/40"></div>
        
        <div class="relative z-10 max-w-4xl px-4 mx-auto" data-aos="fade-down" data-aos-duration="1000">
            <span class="inline-flex items-center gap-2 bg-[#3F9E13]/20 text-[#3F9E13] border border-[#3F9E13]/30 px-4 py-1.5 rounded-full font-bold tracking-widest uppercase text-xs mb-4 backdrop-blur-md">
                <a href="index.php" class="text-white hover:text-[#3F9E13] transition">Home</a> <i class="fa-solid fa-chevron-right text-[10px]"></i> <span class="text-[#3F9E13]">About Us</span>
            </span>
            <h1 class="text-3xl sm:text-5xl md:text-6xl font-playfair font-black text-white leading-tight tracking-tight mb-4">
                About Our <span class="text-[#3F9E13]">Dental Practice</span>
            </h1>
            <p class="text-gray-200 text-sm sm:text-base max-w-2xl mx-auto font-light leading-relaxed">
                Dedicated to clinical excellence, patient comfort, and world-class dental restorations across our advanced diagnostic facilities in Dhanbad.
            </p>
        </div>
    </section>

    <!-- ================= 2 COLLEGE / CLINIC ALBUM DESIGNS ================= -->
    <section class="py-20 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-16" data-aos="fade-down">
                <span class="text-[#3F9E13] font-bold tracking-[0.25em] uppercase text-xs block mb-2">Clinic Showcase Gallery</span>
                <h2 class="text-3xl sm:text-4xl font-playfair font-black text-[#002B5E]">Our Facilities & Infrastructure</h2>
            </div>

            <!-- Album Grid (2 distinct styled collage displays) -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                
                <!-- Album 1: Branch 1 Showcase Card -->
                <div class="bg-white border border-gray-200 rounded-3xl p-6 sm:p-8 shadow-xl relative overflow-hidden group" data-aos="fade-right" data-aos-duration="1000">
                    <div class="absolute top-0 right-0 bg-[#3F9E13] text-white text-xs font-bold px-4 py-1.5 rounded-bl-2xl uppercase tracking-wider">
                        Branch 1 Gallery
                    </div>
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <img src="https://images.unsplash.com/photo-1588776814546-1ffcf47267a5?q=80&w=600&auto=format&fit=crop" alt="Exterior View" class="rounded-2xl h-48 w-full object-cover shadow-md transform group-hover:scale-105 transition duration-500">
                        <img src="https://images.unsplash.com/photo-1559839734-2b71ea197ec2?q=80&w=600&auto=format&fit=crop" alt="Dental Operatory" class="rounded-2xl h-48 w-full object-cover shadow-md transform group-hover:scale-105 transition duration-500">
                    </div>
                    <h3 class="font-playfair font-bold text-xl text-[#002B5E] mb-2">Bekarbandh Center (Branch 1)</h3>
                    <p class="text-gray-600 text-xs sm:text-sm leading-relaxed mb-4">
                        Gupteshwar Complex, A-Block, 1st Floor Beside Punjab National Bank, Bekarbandh, Dhanbad[cite: 10]. Equipped with advanced dental operatories and state-of-the-art sterilization equipment.
                    </p>
                    <div class="flex items-center gap-4 text-xs font-semibold text-[#3F9E13]">
                        <span><i class="fa-solid fa-clock mr-1"></i> Mon-Sat (10am-2pm, 5pm-7pm)</span>
                        <span><i class="fa-solid fa-phone mr-1"></i> 8102605105</span>
                    </div>
                </div>

                <!-- Album 2: Branch 2 Showcase Card -->
                <div class="bg-white border border-gray-200 rounded-3xl p-6 sm:p-8 shadow-xl relative overflow-hidden group" data-aos="fade-left" data-aos-duration="1000">
                    <div class="absolute top-0 right-0 bg-[#002B5E] text-white text-xs font-bold px-4 py-1.5 rounded-bl-2xl uppercase tracking-wider">
                        Branch 2 Gallery
                    </div>
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <img src="https://images.unsplash.com/photo-1629909615184-74f495363b67?q=80&w=600&auto=format&fit=crop" alt="Clinic Interior" class="rounded-2xl h-48 w-full object-cover shadow-md transform group-hover:scale-105 transition duration-500">
                        <img src="https://images.unsplash.com/photo-1537368910025-700350fe46c7?q=80&w=600&auto=format&fit=crop" alt="Consultation Room" class="rounded-2xl h-48 w-full object-cover shadow-md transform group-hover:scale-105 transition duration-500">
                    </div>
                    <h3 class="font-playfair font-bold text-xl text-[#002B5E] mb-2">Dhaiya Center (Branch 2)</h3>
                    <p class="text-gray-600 text-xs sm:text-sm leading-relaxed mb-4">
                        1st Floor, Akash Parvati Plaza, Beside Haveli Apartment, Main Road, Dhaiya, Dhanbad[cite: 10]. Designed to offer a relaxing, anxiety-free atmosphere for patients of all ages.
                    </p>
                    <div class="flex items-center gap-4 text-xs font-semibold text-[#3F9E13]">
                        <span><i class="fa-solid fa-clock mr-1"></i> Mon-Sat (10am-6pm)</span>
                        <span><i class="fa-solid fa-phone mr-1"></i> 9241079766</span>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ================= ABOUT ORAL CARE DENTAL CLINIC ================= -->
    <section class="py-20 bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <div class="lg:col-span-6" data-aos="fade-right" data-aos-duration="1000">
                    <span class="text-[#3F9E13] font-bold tracking-[0.25em] uppercase text-xs block mb-3">
                        <i class="fa-solid fa-tooth mr-2"></i> Comprehensive Dental Care
                    </span>
                    <h2 class="text-3xl sm:text-4xl font-playfair font-black text-[#002B5E] mb-6">
                        Passionate to Help You Experience the Exciting Advances in Dentistry!
                    </h2>
                    <p class="text-gray-600 text-sm sm:text-base leading-relaxed mb-6">
                        Oral Care Dental Clinic is recognized as a multi-specialty clinic providing complete care and cure under one roof[cite: 12]. Led by expert practitioners like Dr. Rajiv Ranjan (M.D.S.) and Dr. Vimmy (B.D.S., Gold Medalist), our practice takes pride in adopting modern dental technologies[cite: 12].
                    </p>
                    <p class="text-gray-600 text-sm sm:text-base leading-relaxed mb-8">
                        Our expertise and state-of-the-art equipment help you achieve and maintain optimum oral health and beauty[cite: 12]. We offer a very different experience, by putting in a lot of care, precision, and compassion[cite: 12].
                    </p>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="p-4 rounded-xl bg-slate-50 border border-gray-100 shadow-sm">
                            <h4 class="font-bold text-2xl text-[#3F9E13] mb-1">5,000+</h4>
                            <p class="text-xs text-gray-500 uppercase tracking-wider">Happy Patients</p>
                        </div>
                        <div class="p-4 rounded-xl bg-slate-50 border border-gray-100 shadow-sm">
                            <h4 class="font-bold text-2xl text-[#002B5E] mb-1">100%</h4>
                            <p class="text-xs text-gray-500 uppercase tracking-wider">Sterilization Safety</p>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-6 relative" data-aos="fade-left" data-aos-duration="1000">
                    <div class="absolute -inset-2 bg-gradient-to-r from-[#002B5E] to-[#3F9E13] rounded-3xl blur opacity-30"></div>
                    <div class="relative bg-[#002B5E] text-white p-8 sm:p-10 rounded-3xl shadow-2xl">
                        <h3 class="font-playfair font-bold text-2xl mb-6 text-white border-b border-white/10 pb-4">Our Leading Experts</h3>
                        
                        <div class="space-y-6">
                            <div class="flex items-start gap-4">
                                <div class="w-14 h-14 rounded-full bg-[#3F9E13] text-white font-bold flex items-center justify-center text-xl shrink-0 shadow-md">
                                    RR
                                </div>
                                <div>
                                    <h4 class="font-bold text-lg text-white">Dr. Rajiv Ranjan</h4>
                                    <p class="text-xs text-[#3F9E13] font-semibold">M.D.S. (Oral Medicine & Radiology), FAGE (Manipal)[cite: 12]</p>
                                    <p class="text-xs text-gray-300 mt-1">Senior Lecturer, Vanachal Dental College[cite: 12]. Expert in diagnostic imaging and clinical pathology.</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-4 pt-4 border-t border-white/10">
                                <div class="w-14 h-14 rounded-full bg-[#3F9E13] text-white font-bold flex items-center justify-center text-xl shrink-0 shadow-md">
                                    DV
                                </div>
                                <div class="w-full">
                                    <h4 class="font-bold text-lg text-white">Dr. Vimmy</h4>
                                    <p class="text-xs text-[#3F9E13] font-semibold">B.D.S. (Gold Medalist), Certified Implantologist[cite: 12]</p>
                                    <p class="text-xs text-gray-300 mt-1">Specialized in advanced dental implants, cosmetic dentistry, and painless restorative procedures.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= MISSION, VISION, & SCOPE ================= -->
    <section class="py-24 bg-gradient-to-b from-slate-50 to-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-16" data-aos="fade-down">
                <span class="text-[#3F9E13] font-bold tracking-[0.25em] uppercase text-xs block mb-2">Our Core Principles</span>
                <h2 class="text-3xl sm:text-4xl font-playfair font-black text-[#002B5E]">Mission, Vision & Scope</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Mission -->
                <div class="bg-white border border-gray-100 p-8 rounded-3xl shadow-lg hover:shadow-2xl transition duration-500 group" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-14 h-14 rounded-2xl bg-[#002B5E] text-white flex items-center justify-center text-2xl mb-6 group-hover:bg-[#3F9E13] transition duration-300 shadow-md">
                        <i class="fa-solid fa-bullseye"></i>
                    </div>
                    <h3 class="font-playfair font-bold text-xl text-[#002B5E] mb-3">Our Mission</h3>
                    <p class="text-gray-600 text-xs sm:text-sm leading-relaxed">
                        To provide uncompromised dental care with complete transparency, warmth, and precision, ensuring every patient leaves with a confident and healthy smile.
                    </p>
                </div>

                <!-- Vision -->
                <div class="bg-white border border-gray-100 p-8 rounded-3xl shadow-lg hover:shadow-2xl transition duration-500 group" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-14 h-14 rounded-2xl bg-[#002B5E] text-white flex items-center justify-center text-2xl mb-6 group-hover:bg-[#3F9E13] transition duration-300 shadow-md">
                        <i class="fa-solid fa-eye"></i>
                    </div>
                    <h3 class="font-playfair font-bold text-xl text-[#002B5E] mb-3">Our Vision</h3>
                    <p class="text-gray-600 text-xs sm:text-sm leading-relaxed">
                        To be the most trusted dental healthcare provider in Jharkhand by setting new benchmarks in advanced surgical solutions, patient comfort, and hygiene standards.
                    </p>
                </div>

                <!-- Scope -->
                <div class="bg-white border border-gray-100 p-8 rounded-3xl shadow-lg hover:shadow-2xl transition duration-500 group" data-aos="fade-up" data-aos-delay="300">
                    <div class="w-14 h-14 rounded-2xl bg-[#002B5E] text-white flex items-center justify-center text-2xl mb-6 group-hover:bg-[#3F9E13] transition duration-300 shadow-md">
                        <i class="fa-solid fa-stethoscope"></i>
                    </div>
                    <h3 class="font-playfair font-bold text-xl text-[#002B5E] mb-3">Our Scope</h3>
                    <p class="text-gray-600 text-xs sm:text-sm leading-relaxed">
                        Encompassing all modern branches of dentistry including dental implants, oral prophylaxis, root canal therapy, orthodontics, and maxillofacial surgery[cite: 12].
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= OUR BRANCHES SECTION ================= -->
    <section class="py-20 bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-16" data-aos="fade-down">
                <span class="text-[#3F9E13] font-bold tracking-[0.25em] uppercase text-xs block mb-2">Visit Our Locations</span>
                <h2 class="text-3xl sm:text-4xl font-playfair font-black text-[#002B5E]">Our Clinic Branches</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Branch 1 Card -->
                <div class="bg-slate-50 border border-gray-200 p-8 rounded-3xl shadow-md hover:shadow-xl transition" data-aos="fade-right" data-aos-duration="1000">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 rounded-xl bg-[#3F9E13] text-white flex items-center justify-center font-bold">1</div>
                        <h3 class="font-playfair font-bold text-xl text-[#002B5E]">Branch - 1 (Bekarbandh)</h3>
                    </div>
                    <p class="text-gray-600 text-xs sm:text-sm leading-relaxed mb-4">
                        Gupteshwar Complex, A-Block, 1st Floor Beside Punjab National Bank, Bekarbandh, Dhanbad[cite: 10].
                    </p>
                    <ul class="space-y-2 text-xs sm:text-sm text-gray-700 font-medium">
                        <li><i class="fa-solid fa-clock text-[#3F9E13] mr-2"></i> Everyday - Morning (10am to 2pm) | Evening (5pm to 7pm)[cite: 10]</li>
                        <li><i class="fa-solid fa-calendar-xmark text-red-500 mr-2"></i> THURSDAY CLOSED[cite: 10]</li>
                        <li><i class="fa-solid fa-phone text-[#002B5E] mr-2"></i> Mob.: 8102605105, Ph.: 0326-7960581[cite: 10]</li>
                        <li><i class="fa-solid fa-envelope text-[#3F9E13] mr-2"></i> e-mail: drrajiv8484@gmail.com[cite: 10]</li>
                    </ul>
                </div>

                <!-- Branch 2 Card -->
                <div class="bg-slate-50 border border-gray-200 p-8 rounded-3xl shadow-md hover:shadow-xl transition" data-aos="fade-left" data-aos-duration="1000">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 rounded-xl bg-[#002B5E] text-white flex items-center justify-center font-bold">2</div>
                        <h3 class="font-playfair font-bold text-xl text-[#002B5E]">Branch - 2 (Dhaiya)</h3>
                    </div>
                    <p class="text-gray-600 text-xs sm:text-sm leading-relaxed mb-4">
                        1st Floor, Akash Parvati Plaza, Beside Haveli Apartment, Main Road, Dhaiya, Dhanbad (Jharkhand)[cite: 10].
                    </p>
                    <ul class="space-y-2 text-xs sm:text-sm text-gray-700 font-medium">
                        <li><i class="fa-solid fa-clock text-[#3F9E13] mr-2"></i> Mon to Sat (10am to 6pm)[cite: 10]</li>
                        <li><i class="fa-solid fa-clock text-[#3F9E13] mr-2"></i> Sunday (10am to 2pm)[cite: 10]</li>
                        <li><i class="fa-solid fa-phone text-[#002B5E] mr-2"></i> Mob.: 9241079766[cite: 10]</li>
                        <li><i class="fa-solid fa-envelope text-[#3F9E13] mr-2"></i> e-mail: vimmyk207@gmail.com[cite: 10]</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= MORE ABOUT US & FACILITIES ================= -->
    <section class="py-20 bg-gradient-to-b from-white to-slate-50 border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center" data-aos="zoom-in">
            <span class="inline-block bg-[#3F9E13] text-white text-xs font-bold px-4 py-1.5 rounded-full uppercase tracking-widest mb-4">
                National Dental Achivers 2015[cite: 12]
            </span>
            <h2 class="text-3xl sm:text-5xl font-playfair font-black text-[#002B5E] mb-6">
                A Better Life Begins with a New Smile[cite: 12]
            </h2>
            <p class="text-gray-600 text-sm sm:text-base max-w-3xl mx-auto leading-relaxed mb-10">
                We take in all the advances in modern dentistry as and when it occurs[cite: 12]. Whether you require dental implants, oral prophylaxis, root canal treatments, dental bleaching, crowns & bridges, dentures, or orthodontics, our clinic is fully equipped to deliver excellence[cite: 12].
            </p>
            <a href="contact.php" class="inline-flex items-center justify-center gap-3 bg-[#002B5E] text-white font-bold px-9 py-4 rounded-xl hover:bg-[#3F9E13] transition shadow-lg text-xs sm:text-sm uppercase tracking-wider">
                <span>Get in Touch With Us</span>
                <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </section>

    <!-- ================= FOOTER INCLUDED ================= -->
    <?php include 'footer.php'; ?>

    <!-- ================= FLOATING CTA INCLUDED ================= -->
    <?php include 'CTA.php'; ?>

    <!-- AOS Animation Initialization -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            once: false,
            mirror: true,
            offset: 50
        });
    </script>
</body>
</html>