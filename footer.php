<?php
// footer.php - Super Stylish Footer Component for Oral Care Dental Clinic
?>

<!-- Required Tailwind CSS & FontAwesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800;900&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    .font-playfair { font-family: 'Playfair Display', serif; }
    .font-montserrat { font-family: 'Montserrat', sans-serif; }
    
    /* Footer Background Image with Deep Professional Overlay */
    .footer-bg {
        background: linear-gradient(135deg, rgba(0, 27, 60, 0.96) 0%, rgba(0, 43, 94, 0.94) 50%, rgba(0, 18, 41, 0.97) 100%), 
                    url('https://images.unsplash.com/photo-1629909613654-28e377c37b09?q=80&w=2000&auto=format&fit=crop');
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
    }
</style>

<!-- Super Stylish Footer Section -->
<footer class="footer-bg text-white relative overflow-hidden font-montserrat pt-20 pb-10 border-t-4 border-[#3F9E13]">
    
    <!-- Decorative Glowing Ambient Orbs -->
    <div class="absolute top-10 left-10 w-72 h-72 bg-[#3F9E13]/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-10 right-10 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <!-- Top Row: Newsletter Subscription Card Banner -->
        <div class="bg-gradient-to-r from-[#003B7E] to-[#002B5E] border border-white/10 rounded-3xl p-8 sm:p-10 mb-16 shadow-[0_15px_35px_rgba(0,0,0,0.3)] flex flex-col lg:flex-row items-center justify-between gap-8" data-aos="fade-up" data-aos-duration="1000">
            <div class="text-center lg:text-left">
                <span class="text-[#3F9E13] font-bold tracking-[0.25em] uppercase text-xs block mb-2">
                    <i class="fa-solid fa-envelope-open-text mr-2"></i> Stay Connected
                </span>
                <h3 class="font-playfair font-black text-2xl sm:text-3xl text-white">Subscribe for Dental Health Tips</h3>
                <p class="text-gray-300 text-xs sm:text-sm mt-1 max-w-xl">Get expert oral hygiene advice, special treatment offers, and clinic updates directly in your inbox.</p>
            </div>
            
            <form action="subscribe_action.php" method="POST" class="w-full lg:w-auto flex flex-col sm:flex-row gap-3">
                <div class="relative w-full sm:w-80">
                    <i class="fa-solid fa-paper-plane absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                    <input type="email" name="subscriber_email" placeholder="Enter your email address..." required 
                           class="w-full bg-white/10 border border-white/20 rounded-xl px-11 py-3.5 text-sm text-white placeholder-gray-400 focus:outline-none focus:border-[#3F9E13] transition">
                </div>
                <button type="submit" class="bg-[#3F9E13] text-white font-bold px-7 py-3.5 rounded-xl hover:bg-white hover:text-[#002B5E] transition-all duration-300 shadow-[0_5px_15px_rgba(63,158,19,0.4)] text-xs sm:text-sm uppercase tracking-wider shrink-0">
                    Subscribe Now
                </button>
            </form>
        </div>

        <!-- Main Footer Columns -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-10 mb-16">
            
            <!-- Column 1: Logo & About (Span 4) -->
            <div class="lg:col-span-4 space-y-5" data-aos="fade-up" data-aos-delay="100">
                <div class="flex items-center gap-3">
                    <img src="Assets/logo.png" alt="Oral Care Dental Clinic Logo" class="h-12 w-auto object-contain bg-white/10 p-1.5 rounded-xl border border-white/20">
                    <span class="font-playfair font-black text-xl tracking-wide text-white">Oral Care <span class="text-[#3F9E13]">Dental</span></span>
                </div>
                <p class="text-gray-300 text-xs sm:text-sm leading-relaxed">
                    Oral Care Dental Clinic provides world-class dental healthcare with advanced diagnostic technology, expert specialists, and compassionate, pain-free treatments for your whole family.
                </p>
                
                <!-- Social Media Icons -->
                <div>
                    <h5 class="text-xs uppercase tracking-widest text-[#3F9E13] font-bold mb-3">Follow Us Online</h5>
                    <div class="flex items-center gap-3">
                        <a href="#" class="w-10 h-10 rounded-xl bg-white/10 hover:bg-[#3F9E13] text-white flex items-center justify-center transition duration-300 shadow-sm border border-white/10">
                            <i class="fa-brands fa-facebook-f text-sm"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-xl bg-white/10 hover:bg-[#3F9E13] text-white flex items-center justify-center transition duration-300 shadow-sm border border-white/10">
                            <i class="fa-brands fa-instagram text-sm"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-xl bg-white/10 hover:bg-[#3F9E13] text-white flex items-center justify-center transition duration-300 shadow-sm border border-white/10">
                            <i class="fa-brands fa-whatsapp text-sm"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-xl bg-white/10 hover:bg-[#3F9E13] text-white flex items-center justify-center transition duration-300 shadow-sm border border-white/10">
                            <i class="fa-brands fa-youtube text-sm"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Column 2: Quick Links (Span 2) -->
            <div class="lg:col-span-2 space-y-4" data-aos="fade-up" data-aos-delay="200">
                <h4 class="font-playfair font-bold text-lg text-white border-b border-white/10 pb-2">Quick Links</h4>
                <ul class="space-y-2.5 text-xs sm:text-sm">
                    <li><a href="index.php" class="text-gray-300 hover:text-[#3F9E13] transition flex items-center gap-2"><i class="fa-solid fa-chevron-right text-[10px] text-[#3F9E13]"></i> Home</a></li>
                    <li><a href="about.php" class="text-gray-300 hover:text-[#3F9E13] transition flex items-center gap-2"><i class="fa-solid fa-chevron-right text-[10px] text-[#3F9E13]"></i> About Us</a></li>
                    <li><a href="services.php" class="text-gray-300 hover:text-[#3F9E13] transition flex items-center gap-2"><i class="fa-solid fa-chevron-right text-[10px] text-[#3F9E13]"></i> Our Services</a></li>
                    <li><a href="doctors.php" class="text-gray-300 hover:text-[#3F9E13] transition flex items-center gap-2"><i class="fa-solid fa-chevron-right text-[10px] text-[#3F9E13]"></i> Expert Doctors</a></li>
                    <li><a href="gallery.php" class="text-gray-300 hover:text-[#3F9E13] transition flex items-center gap-2"><i class="fa-solid fa-chevron-right text-[10px] text-[#3F9E13]"></i> Gallery</a></li>
                    <li><a href="contact.php" class="text-gray-300 hover:text-[#3F9E13] transition flex items-center gap-2"><i class="fa-solid fa-chevron-right text-[10px] text-[#3F9E13]"></i> Contact Us</a></li>
                </ul>
            </div>

            <!-- Column 3: Our Services (Span 2) -->
            <div class="lg:col-span-2 space-y-4" data-aos="fade-up" data-aos-delay="300">
                <h4 class="font-playfair font-bold text-lg text-white border-b border-white/10 pb-2">Specialties</h4>
                <ul class="space-y-2.5 text-xs sm:text-sm">
                    <li><span class="text-gray-300 hover:text-[#3F9E13] transition flex items-center gap-2"><i class="fa-solid fa-tooth text-[10px] text-[#3F9E13]"></i> Root Canal</span></li>
                    <li><span class="text-gray-300 hover:text-[#3F9E13] transition flex items-center gap-2"><i class="fa-solid fa-tooth text-[10px] text-[#3F9E13]"></i> Dental Implants</span></li>
                    <li><span class="text-gray-300 hover:text-[#3F9E13] transition flex items-center gap-2"><i class="fa-solid fa-tooth text-[10px] text-[#3F9E13]"></i> Teeth Whitening</span></li>
                    <li><span class="text-gray-300 hover:text-[#3F9E13] transition flex items-center gap-2"><i class="fa-solid fa-tooth text-[10px] text-[#3F9E13]"></i> Braces & Orthodontics</span></li>
                    <li><span class="text-gray-300 hover:text-[#3F9E13] transition flex items-center gap-2"><i class="fa-solid fa-tooth text-[10px] text-[#3F9E13]"></i> Pediatric Dentistry</span></li>
                    <li><span class="text-gray-300 hover:text-[#3F9E13] transition flex items-center gap-2"><i class="fa-solid fa-tooth text-[10px] text-[#3F9E13]"></i> Smile Makeover</span></li>
                </ul>
            </div>

            <!-- Column 4: Contact Information & Branches (Span 4) -->
            <div class="lg:col-span-4 space-y-4" data-aos="fade-up" data-aos-delay="400">
                <h4 class="font-playfair font-bold text-lg text-white border-b border-white/10 pb-2">Clinic Information</h4>
                
                <div class="space-y-3 text-xs sm:text-sm text-gray-300">
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-lg bg-[#3F9E13]/20 text-[#3F9E13] flex items-center justify-center shrink-0 mt-0.5">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <p><strong class="text-white">Branch 1:</strong> Gupteshwar Complex, A-Block, 1st Floor Beside Punjab National Bank, Bekarbandh, Dhanbad</p>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-lg bg-[#3F9E13]/20 text-[#3F9E13] flex items-center justify-center shrink-0 mt-0.5">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                        <p><strong class="text-white">Phone / Mobile:</strong> 8102605105, 0326-7960581</p>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-lg bg-[#3F9E13]/20 text-[#3F9E13] flex items-center justify-center shrink-0 mt-0.5">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                        <p><strong class="text-white">Email:</strong> drrajiv8484@gmail.com</p>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-lg bg-[#3F9E13]/20 text-[#3F9E13] flex items-center justify-center shrink-0 mt-0.5">
                            <i class="fa-solid fa-clock"></i>
                        </div>
                        <p><strong class="text-white">Timing:</strong> Mon-Sat (10am to 6pm) | Sun (10am to 2pm)</p>
                    </div>
                </div>
            </div>

        </div>

        <!-- Bottom Copyright Bar with AKCS Credit -->
        <div class="footer-bottom pt-8 border-t border-white/10 flex flex-col sm:flex-row items-center justify-between text-xs text-gray-400 gap-4" data-aos="fade-in">
            <p>&copy; <?php echo date("Y"); ?> Oral Care Dental Clinic. All Rights Reserved.</p>
            <p class="footer-credit">Designed &amp; Developed by <a href="https://akcsgroup.com" target="_blank" rel="noopener" class="text-[#3F9E13] hover:underline font-semibold">AKCS &amp; Group</a></p>
        </div>

    </div>
</footer>

<!-- AOS Animation Initialization -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        once: false,
        mirror: true,
        offset: 50
    });
</script>