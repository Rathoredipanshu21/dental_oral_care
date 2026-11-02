<?php
// details.php - Detailed Profile Section for Oral Care Dental Clinic
?>
<!-- Required CSS & Scripts for Styling (Scoped / Compatible) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

<style>
    .font-playfair { font-family: 'Playfair Display', serif; }
    .font-montserrat { font-family: 'Montserrat', sans-serif; }
    
    /* Custom Parallax / Fixed Background Scrolling Effect */
    .fixed-bg-section {
        background-image: linear-gradient(rgba(0, 43, 94, 0.85), rgba(0, 43, 94, 0.85)), url('https://images.unsplash.com/photo-1629909613654-28e377c37b09?q=80&w=2000&auto=format&fit=crop');
        background-attachment: fixed;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }
    
    /* Branch Swiper Customization */
    .branch-swiper { width: 100%; height: 260px; border-radius: 1rem; }
    .branch-swiper .swiper-pagination-bullet { background: #3F9E13 !important; opacity: 0.6; }
    .branch-swiper .swiper-pagination-bullet-active { opacity: 1; width: 20px; border-radius: 4px; }
</style>

<!-- ================= CLINIC DETAILED OVERVIEW SECTION ================= -->
<section class="py-20 bg-white relative overflow-hidden font-montserrat text-[#002B5E]">
    <!-- Background decorative glows -->
    <div class="absolute top-0 right-0 w-80 h-80 bg-[#3F9E13]/5 rounded-full blur-3xl pointer-events-none"></div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            <!-- Left: Multiple Images Showcase Grid -->
            <div class="lg:col-span-5 grid grid-cols-2 gap-4" data-aos="fade-right" data-aos-duration="1000">
                <div class="space-y-4">
                    <img src="uploads/doctor-images/doc_6ae19dff11b8a0.04704214.jpeg" alt="Clinic Consultation" class="rounded-2xl shadow-lg w-full h-48 object-cover transform hover:scale-105 transition duration-500">
                    <img src="uploads/doctor-images/doc_6ae19f403f35f9.00253266.png" alt="Clinic Interior" class="rounded-2xl shadow-lg w-full h-64 object-cover transform hover:scale-105 transition duration-500">
                </div>
                <div class="space-y-4 pt-8">
                    <img src="Assets/branch21.png" alt="Dental Equipment" class="rounded-2xl shadow-lg w-full h-64 object-cover transform hover:scale-105 transition duration-500">
                    <div class="bg-gradient-to-br from-[#002B5E] to-[#001833] text-white p-6 rounded-2xl shadow-lg text-center flex flex-col justify-center items-center">
                        <span class="text-3xl font-playfair font-black text-[#3F9E13] mb-1">100%</span>
                        <span class="text-xs tracking-wider uppercase font-semibold text-gray-300">Sterilization Safety</span>
                    </div>
                </div>
            </div>

            <!-- Right: Detailed Info & Facilities -->
            <div class="lg:col-span-7" data-aos="fade-left" data-aos-duration="1000">
                <span class="text-[#3F9E13] font-bold tracking-[0.25em] uppercase text-xs block mb-3">
                    <i class="fa-solid fa-hospital-user mr-2"></i> About Our Clinic
                </span>
                <h2 class="text-3xl sm:text-4xl font-playfair font-black text-[#002B5E] mb-6">
                    Modern Dentistry with a Gentle, Caring Touch
                </h2>
                <p class="text-gray-600 text-sm sm:text-base leading-relaxed mb-6 font-normal">
                    Oral Care Dental Clinic is a premier destination for comprehensive dental healthcare. Located conveniently, our clinic features cutting-edge diagnostic equipment, laser dentistry tools, and an expert team of specialists dedicated to keeping your smile healthy and radiant.
                </p>

                <!-- Icon Grid Features -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-8">
                    <div class="flex items-start gap-4 p-4 rounded-xl bg-slate-50 border border-gray-100 shadow-sm">
                        <div class="w-12 h-12 rounded-lg bg-[#3F9E13]/10 text-[#3F9E13] flex items-center justify-center shrink-0 text-xl font-bold">
                            <i class="fa-solid fa-shield-halved"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-[#002B5E] text-sm mb-1">Strict Sterilization</h4>
                            <p class="text-xs text-gray-500">Hospital-grade autoclave sterilization protocols for 100% safety.</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4 p-4 rounded-xl bg-slate-50 border border-gray-100 shadow-sm">
                        <div class="w-12 h-12 rounded-lg bg-[#002B5E]/10 text-[#002B5E] flex items-center justify-center shrink-0 text-xl font-bold">
                            <i class="fa-solid fa-stethoscope"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-[#002B5E] text-sm mb-1">Expert Specialists</h4>
                            <p class="text-xs text-gray-500">Experienced orthodontists, surgeons, and pediatric dentists.</p>
                        </div>
                    </div>
                </div>

                <!-- Action Link -->
                <div class="flex flex-wrap items-center gap-4">
                    <a href="appointment.php" class="inline-flex items-center justify-center gap-3 bg-[#3F9E13] text-white font-bold px-8 py-3.5 rounded-lg hover:bg-[#002B5E] transition-all duration-300 shadow-[0_8px_20px_rgba(63,158,19,0.4)] text-xs sm:text-sm uppercase tracking-wider">
                        <span>Book Clinic Appointment</span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ================= OUR BRANCHES SECTION (CAROUSELS & ADDRESSES) ================= -->
<section class="py-24 bg-slate-50 relative font-montserrat">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-16" data-aos="fade-down">
            <span class="text-[#3F9E13] font-bold tracking-[0.25em] uppercase text-xs block mb-2">Our Locations</span>
            <h2 class="text-3xl sm:text-4xl font-playfair font-black text-[#002B5E]">Visit Our Clinic Branches</h2>
            <p class="text-gray-600 text-sm mt-3">Equipped with state-of-the-art facilities across Dhanbad to serve you better.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
            
            <!-- BRANCH - 1 -->
            <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-xl border border-gray-100 flex flex-col justify-between" data-aos="fade-up" data-aos-delay="100">
                <div>
                    <!-- Branch Badge -->
                    <div class="inline-block bg-[#002B5E] text-white text-xs font-bold px-4 py-1.5 rounded-full uppercase tracking-widest mb-6 shadow-md">
                        <i class="fa-solid fa-location-dot mr-1.5 text-[#3F9E13]"></i> Branch - 1
                    </div>

                    <!-- Carousel for Branch 1 -->
                    <div class="swiper branch-swiper mb-6 shadow-md overflow-hidden">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img src="Assets/branch1.png" alt="Branch 1 Exterior" class="w-full h-full object-cover">
                            </div>
                            <div class="swiper-slide">
                                <img src="Assets/branch11.png" alt="Branch 1 Interior" class="w-full h-full object-cover">
                            </div>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>

                    <!-- Address & Contact Info Card (Matching Screenshot 3) -->
                    <div class="bg-slate-100 rounded-2xl p-5 border border-gray-200 text-center">
                        <h4 class="font-playfair font-bold text-[#002B5E] text-base mb-2">Gupteshwar Complex, A-Block, 1st Floor</h4>
                        <p class="text-xs text-gray-700 font-medium mb-3">Beside Punjab National Bank, Bekarbandh, Dhanbad, Jharkhand 828130</p>
                        <div class="flex flex-wrap justify-center items-center gap-4 text-xs font-semibold text-[#002B5E] pt-2 border-t border-gray-200">
                            <span><i class="fa-solid fa-envelope text-[#3F9E13] mr-1"></i> drrajiv8484@gmail.com</span>
                            <span><i class="fa-solid fa-phone text-[#3F9E13] mr-1"></i> Mob.: 8102605105</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- BRANCH - 2 -->
            <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-xl border border-gray-100 flex flex-col justify-between" data-aos="fade-up" data-aos-delay="200">
                <div>
                    <!-- Branch Badge -->
                    <div class="inline-block bg-[#002B5E] text-white text-xs font-bold px-4 py-1.5 rounded-full uppercase tracking-widest mb-6 shadow-md">
                        <i class="fa-solid fa-location-dot mr-1.5 text-[#3F9E13]"></i> Branch - 2
                    </div>

                    <!-- Carousel for Branch 2 -->
                    <div class="swiper branch-swiper mb-6 shadow-md overflow-hidden">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img src="Assets/branch21.png" alt="Branch 2 Exterior" class="w-full h-full object-cover">
                            </div>
                            <div class="swiper-slide">
                                <img src="Assets/branch22.png" alt="Branch 2 Interior" class="w-full h-full object-cover">
                            </div>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>

                    <!-- Address & Contact Info Card (Matching Screenshot 3) -->
                    <div class="bg-slate-100 rounded-2xl p-5 border border-gray-200 text-center">
                        <h4 class="font-playfair font-bold text-[#002B5E] text-base mb-2">1st Floor, Akash Parvati Plaza</h4>
                        <p class="text-xs text-gray-700 font-medium mb-3">Beside Haveli Apartment, Main Road, Dhaiya, Dhanbad (Jharkhand)</p>
                        <div class="flex flex-wrap justify-center items-center gap-4 text-xs font-semibold text-[#002B5E] pt-2 border-t border-gray-200">
                            <span><i class="fa-solid fa-envelope text-[#3F9E13] mr-1"></i> vimmyk207@gmail.com</span>
                            <span><i class="fa-solid fa-phone text-[#3F9E13] mr-1"></i> Mob.: 9241079766</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ================= FULL WIDTH FIXED IMAGE SCROLLING SECTION ================= -->
<section class="py-28 fixed-bg-section text-white relative font-montserrat">
    <div class="max-w-5xl mx-auto px-4 text-center relative z-10" data-aos="zoom-in" data-aos-duration="1000">
        <span class="inline-block bg-[#3F9E13] text-white text-xs font-bold px-4 py-1.5 rounded-full uppercase tracking-widest mb-4">
            Excellence in Healthcare
        </span>
        <h2 class="text-3xl sm:text-5xl font-playfair font-black mb-6 leading-tight">
            Transforming Smiles With Advanced Dental Technology
        </h2>
        <p class="text-gray-200 text-sm sm:text-base max-w-3xl mx-auto leading-relaxed mb-10 font-light">
            From routine preventative cleanings to complex smile makeovers and dental implants, Oral Care Dental Clinic is equipped to handle all your family's dental needs under one roof.
        </p>
        <div class="flex flex-wrap justify-center gap-6">
            <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl p-6 w-56 text-center">
                <i class="fa-solid fa-users text-3xl text-[#3F9E13] mb-3"></i>
                <h3 class="text-2xl font-bold mb-1">5,000+</h3>
                <p class="text-xs text-gray-300 uppercase tracking-wider">Happy Customers</p>
            </div>
            <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl p-6 w-56 text-center">
                <i class="fa-solid fa-star text-3xl text-yellow-400 mb-3"></i>
                <h3 class="text-2xl font-bold mb-1">4.9 / 5.0</h3>
                <p class="text-xs text-gray-300 uppercase tracking-wider">Patient Rating</p>
            </div>
            <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl p-6 w-56 text-center">
                <i class="fa-solid fa-award text-3xl text-[#3F9E13] mb-3"></i>
                <h3 class="text-2xl font-bold mb-1">17+ Years</h3>
                <p class="text-xs text-gray-300 uppercase tracking-wider">Trusted Experience</p>
            </div>
        </div>
    </div>
</section>

<!-- ================= WHY CHOOSE US SECTION ================= -->
<section class="py-24 bg-white relative font-montserrat">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-16" data-aos="fade-down">
            <span class="text-[#3F9E13] font-bold tracking-[0.25em] uppercase text-xs block mb-2">Our Core Advantages</span>
            <h2 class="text-3xl sm:text-4xl font-playfair font-black text-[#002B5E]">Why Choose Oral Care Dental Clinic?</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Card 1 -->
            <div class="bg-slate-50 border border-gray-100 p-8 rounded-3xl shadow-sm hover:shadow-xl transition duration-500 group" data-aos="fade-up" data-aos-delay="100">
                <div class="w-14 h-14 rounded-2xl bg-[#002B5E] text-white flex items-center justify-center text-2xl mb-6 group-hover:bg-[#3F9E13] transition duration-300 shadow-md">
                    <i class="fa-solid fa-hand-holding-medical"></i>
                </div>
                <h3 class="font-playfair font-bold text-xl text-[#002B5E] mb-3">Painless Treatments</h3>
                <p class="text-gray-600 text-xs sm:text-sm leading-relaxed">
                    Advanced painless dental procedures designed to keep you completely comfortable throughout your visit.
                </p>
            </div>

            <!-- Card 2 -->
            <div class="bg-slate-50 border border-gray-100 p-8 rounded-3xl shadow-sm hover:shadow-xl transition duration-500 group" data-aos="fade-up" data-aos-delay="200">
                <div class="w-14 h-14 rounded-2xl bg-[#002B5E] text-white flex items-center justify-center text-2xl mb-6 group-hover:bg-[#3F9E13] transition duration-300 shadow-md">
                    <i class="fa-solid fa-microchip"></i>
                </div>
                <h3 class="font-playfair font-bold text-xl text-[#002B5E] mb-3">Advanced Equipment</h3>
                <p class="text-gray-600 text-xs sm:text-sm leading-relaxed">
                    Equipped with cutting-edge digital radiography and high-precision dental tools for accurate diagnoses.
                </p>
            </div>

            <!-- Card 3 -->
            <div class="bg-slate-50 border border-gray-100 p-8 rounded-3xl shadow-sm hover:shadow-xl transition duration-500 group" data-aos="fade-up" data-aos-delay="300">
                <div class="w-14 h-14 rounded-2xl bg-[#002B5E] text-white flex items-center justify-center text-2xl mb-6 group-hover:bg-[#3F9E13] transition duration-300 shadow-md">
                    <i class="fa-solid fa-clock-rotate-left"></i>
                </div>
                <h3 class="font-playfair font-bold text-xl text-[#002B5E] mb-3">Emergency Care</h3>
                <p class="text-gray-600 text-xs sm:text-sm leading-relaxed">
                    Immediate assistance and emergency care protocols for severe tooth pain, accidents, and urgent treatments.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Initialize Swiper Carousels for Branches -->
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<script>
    const branchSwipers = document.querySelectorAll('.branch-swiper');
    branchSwipers.forEach(swiperEl => {
        new Swiper(swiperEl, {
            loop: true,
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
            pagination: {
                el: swiperEl.querySelector('.swiper-pagination'),
                clickable: true,
            }
        });
    });
</script>