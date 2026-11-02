<?php
// doctors.php - Component file included inside index.php
require_once 'config/db.php';
?>

<!-- Stylish Doctors Section -->
<section class="py-10 bg-gradient-to-b from-slate-50 via-white to-slate-50 relative overflow-hidden font-montserrat">
    
    <!-- Background Decorative Glow Orbs -->
    <div class="absolute top-0 left-10 w-72 h-72 bg-[#3F9E13]/5 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-10 right-10 w-96 h-96 bg-[#002B5E]/5 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-16" data-aos="fade-down" data-aos-duration="1000">
            <span class="inline-flex items-center gap-2 bg-[#3F9E13]/10 text-[#3F9E13] px-4 py-1.5 rounded-full font-bold tracking-widest uppercase text-xs mb-4 shadow-sm">
                <i class="fa-solid fa-user-doctor animate-pulse"></i> Our Medical Professionals
            </span>
            <h2 class="text-3xl sm:text-4xl md:text-5xl font-playfair font-black text-[#002B5E] tracking-tight">
                Meet Our Expert <span class="text-[#3F9E13] underline decoration-[#3F9E13]/30 decoration-wavy decoration-2">Doctors</span>
            </h2>
            <p class="text-gray-600 mt-4 text-sm sm:text-base leading-relaxed">
                World-class specialists dedicated to delivering exceptional care with a gentle touch. Hover or tap any card to uncover their complete professional profile.
            </p>
        </div>

        <!-- Doctor Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 lg:gap-10 items-stretch">
            <?php
            $result = $conn->query("SELECT * FROM doctors ORDER BY id DESC");
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $raw_img = $row['profile_image'];
                    $imgSrc = (strpos($raw_img, 'uploads/') === 0) ? $raw_img : 'uploads/doctor-images/' . basename($raw_img);
            ?>
                    <!-- Card Wrapper with 3D Perspective -->
                    <div class="group h-[420px] w-full [perspective:1200px]" data-aos="fade-up" data-aos-duration="800">
                        
                        <!-- Flipping Container -->
                        <div class="relative h-full w-full rounded-3xl shadow-[0_15px_35px_rgba(0,43,94,0.08)] group-hover:shadow-[0_20px_45px_rgba(63,158,19,0.2)] transition-all duration-700 [transform-style:preserve-3d] group-hover:[transform:rotateY(180deg)]">
                            
                            <!-- ================= FRONT SIDE ================= -->
                            <div class="absolute inset-0 h-full w-full rounded-3xl bg-white border border-gray-100 flex flex-col items-center justify-between p-7 [backface-visibility:hidden] overflow-hidden">
                                
                                <!-- Top Accent Highlight Bar -->
                                <div class="absolute top-0 inset-x-0 h-2 bg-gradient-to-r from-[#002B5E] to-[#3F9E13]"></div>

                                <!-- Doctor Image with Glowing Ring Animation -->
                                <div class="relative mt-3">
                                    <div class="absolute -inset-1.5 bg-gradient-to-r from-[#002B5E] to-[#3F9E13] rounded-full blur opacity-40 group-hover:opacity-100 transition duration-500"></div>
                                    <img src="<?php echo htmlspecialchars($imgSrc); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>" class="relative w-32 h-32 object-cover rounded-full border-4 border-white shadow-md">
                                </div>

                                <!-- Doctor Info -->
                                <div class="text-center w-full my-auto">
                                    <h4 class="font-playfair font-bold text-2xl text-[#002B5E] mb-1.5"><?php echo htmlspecialchars($row['name']); ?></h4>
                                    
                                    <span class="inline-block bg-[#3F9E13]/10 text-[#3F9E13] border border-[#3F9E13]/20 text-xs font-bold px-3.5 py-1 rounded-full mb-3 tracking-wide">
                                        <?php echo htmlspecialchars($row['specialist']); ?>
                                    </span>
                                    
                                    <p class="text-gray-500 text-xs flex items-center justify-center font-medium">
                                        <i class="fa-solid fa-graduation-cap mr-1.5 text-[#3F9E13]"></i> <?php echo htmlspecialchars($row['qualification']); ?>
                                    </p>
                                </div>

                                <!-- Flip prompt footer -->
                                <div class="w-full pt-3 border-t border-gray-100 flex items-center justify-center text-gray-400 text-xs font-semibold tracking-wider uppercase gap-2">
                                    <span>Hover to view bio</span>
                                    <i class="fa-solid fa-arrow-rotate-right text-[#3F9E13] animate-spin" style="animation-duration: 4s;"></i>
                                </div>
                            </div>

                            <!-- ================= BACK SIDE ================= -->
                            <div class="absolute inset-0 h-full w-full rounded-3xl bg-gradient-to-br from-[#002B5E] to-[#001833] text-white flex flex-col justify-between p-8 text-center [transform:rotateY(180deg)] [backface-visibility:hidden] shadow-2xl overflow-hidden">
                                
                                <!-- Background Watermark Icon -->
                                <div class="absolute -right-6 -bottom-6 text-white/5 text-9xl pointer-events-none">
                                    <i class="fa-solid fa-stethoscope"></i>
                                </div>

                                <div>
                                    <h4 class="font-playfair font-bold text-xl text-white mb-1"><?php echo htmlspecialchars($row['name']); ?></h4>
                                    <p class="text-xs text-[#3F9E13] font-bold uppercase tracking-widest mb-3"><?php echo htmlspecialchars($row['qualification']); ?></p>
                                    <div class="w-16 h-1 bg-[#3F9E13] mx-auto rounded-full mb-4"></div>
                                </div>

                                <!-- Scrollable Description -->
                                <div class="overflow-y-auto max-h-[210px] px-1 custom-scrollbar my-auto">
                                    <p class="text-gray-200 text-xs sm:text-sm leading-relaxed text-left font-light">
                                        <?php echo nl2br(htmlspecialchars($row['description'])); ?>
                                    </p>
                                </div>

                                <!-- Bottom Action Tag -->
                                <div class="pt-3 border-t border-white/10 flex items-center justify-center text-[#3F9E13] text-xs font-bold tracking-widest uppercase">
                                    <i class="fa-solid fa-tooth mr-2"></i> Oral Care Specialist
                                </div>

                            </div>

                        </div>
                    </div>
            <?php
                }
            } else {
                echo '<div class="col-span-3 text-center py-16 bg-white rounded-3xl shadow-sm border border-gray-100"><p class="text-gray-500 font-medium">No doctors available at the moment. Please check back later.</p></div>';
            }
            ?>
        </div>

    </div>
</section>

<!-- Custom Scrollbar styling for back card description -->
<style>
    .custom-scrollbar::-webkit-scrollbar {
        width: 4px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: rgba(255, 255, 255, 0.05);
        border-radius: 10px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #3F9E13;
        border-radius: 10px;
    }
</style>