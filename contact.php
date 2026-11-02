<?php
// contact.php
require_once 'config/db.php';

$success_msg = "";
$error_msg = "";

// Handle Form Submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = trim($_POST['name'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $phone   = trim($_POST['phone'] ?? '');
    $subject = trim($_POST['subject'] ?? 'General Inquiry');
    $message = trim($_POST['message'] ?? '');

    if (!empty($name) && !empty($email) && !empty($phone) && !empty($message)) {
        $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, phone, subject, message) VALUES (?, ?, ?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("sssss", $name, $email, $phone, $subject, $message);
            if ($stmt->execute()) {
                $success_msg = "Thank you! Your message has been sent successfully. We will get back to you soon.";
            } else {
                $error_msg = "Something went wrong while saving your message. Please try again.";
            }
            $stmt->close();
        } else {
            $error_msg = "Database error: Could not prepare statement.";
        }
    } else {
        $error_msg = "Please fill in all required fields.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Oral Care Dental Clinic</title>
    <link icon rel="icon" href="Assets/logo.png" type="image/x-icon">
    <!-- Preconnect -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://unpkg.com">
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="preconnect" href="https://cdn.jsdelivr.net">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- AOS Animation Library CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
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

        /* Hero Background Overlay matching theme */
        .contact-hero {
            position: relative;
            background: linear-gradient(rgba(0, 43, 94, 0.85), rgba(0, 43, 94, 0.90)), 
                        url('https://images.unsplash.com/photo-1629909613654-28e377c37b09?auto=format&fit=crop&w=1920&q=80') center/cover no-repeat;
            padding: 120px 0 90px 0;
            color: #ffffff;
            text-align: center;
        }

        .branch-card {
            transition: all 0.3s ease;
        }
        .branch-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px -5px rgba(0, 43, 94, 0.1);
        }
    </style>
</head>
<body class="overflow-x-hidden">

    <!-- Include Navbar at the Top -->
    <?php include 'navbar.php'; ?>

    <!-- Stylish Hero Section -->
    <section class="contact-hero">
        <div class="w-[92%] md:w-[90%] xl:w-[85%] max-w-[1600px] mx-auto relative z-10" data-aos="fade-down" data-aos-duration="1000">
            <!-- Breadcrumb Pill -->
            <div class="inline-flex items-center bg-white/10 border border-white/20 px-5 py-2 rounded-full text-sm text-white mb-6 backdrop-blur-md">
                <a href="index.php" class="hover:text-[#3F9E13] transition-colors">HOME</a> 
                <span class="text-[#3F9E13] mx-2 font-bold">></span> 
                <span class="text-white font-semibold">CONTACT US</span>
            </div>
            <h1 class="text-3xl md:text-5xl font-serif font-bold mb-4 tracking-tight">
                Get In Touch With <span class="text-[#3F9E13]">Our Experts</span>
            </h1>
            <p class="text-gray-200 text-base md:text-lg max-w-2xl mx-auto leading-relaxed">
                Have questions or want to book an appointment? Reach out to our branches in Dhanbad or drop us a message below.
            </p>
        </div>
    </section>

    <!-- Main Contact Section -->
    <section class="relative w-full py-16 md:py-24 bg-professional-grid overflow-hidden border-b border-gray-200">
        <div class="w-[92%] md:w-[90%] xl:w-[85%] max-w-[1600px] mx-auto relative z-10">
            
            <!-- Section Header -->
            <div class="text-center max-w-3xl mx-auto mb-16" data-aos="fade-up" data-aos-duration="800">
                <div class="flex items-center justify-center gap-3 mb-4">
                    <span class="w-8 h-[2px] bg-[#3F9E13]"></span>
                    <h4 class="text-[#3F9E13] text-[11px] font-bold uppercase tracking-[0.25em]">Reach Out</h4>
                    <span class="w-8 h-[2px] bg-[#3F9E13]"></span>
                </div>
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-serif font-bold text-[#002B5E] leading-tight mb-4">
                    We Are Here For Your Smile
                </h2>
                <p class="text-gray-600 font-medium">Visit our clinics or contact our team directly through phone, email, or the form below.</p>
            </div>

            <!-- Notification Alerts -->
            <?php if (!empty($success_msg)): ?>
                <div class="max-w-4xl mx-auto mb-10 bg-green-50 border-l-4 border-[#3F9E13] p-4 rounded shadow-sm" data-aos="fade-up">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-[#3F9E13] text-xl mr-3"></i>
                        <p class="text-green-800 font-medium"><?= $success_msg ?></p>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (!empty($error_msg)): ?>
                <div class="max-w-4xl mx-auto mb-10 bg-red-50 border-l-4 border-red-500 p-4 rounded shadow-sm" data-aos="fade-up">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-circle text-red-500 text-xl mr-3"></i>
                        <p class="text-red-800 font-medium"><?= $error_msg ?></p>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Grid: Contact Info Cards & Form -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-16">
                
                <!-- Branch 1 Information -->
                <div class="branch-card bg-white p-8 rounded-xl border border-gray-200 shadow-sm flex flex-col justify-between" data-aos="fade-up" data-aos-delay="100">
                    <div>
                        <div class="inline-block bg-[#3F9E13] text-white text-xs font-bold px-3 py-1 rounded uppercase tracking-wider mb-4">
                            Branch - 1
                        </div>
                        <h3 class="text-xl font-serif font-bold text-[#002B5E] mb-3">Bekarbandh Clinic</h3>
                        <p class="text-gray-600 text-sm mb-6 leading-relaxed">
                            <i class="fas fa-map-marker-alt text-[#3F9E13] mr-2"></i>
                            Gupteshwar Complex, A-Block, 1st Floor Beside Punjab National Bank, Bekarbandh, Forest Colony, Dhanbad, Jharkhand 828130
                        </p>
                        <div class="space-y-3 text-sm text-gray-700 mb-6">
                            <p><i class="fas fa-clock text-[#002B5E] mr-2"></i><strong>Timing:</strong> Everyday - Morning (10am to 2pm) | Evening (5pm to 7pm) <br><span class="text-red-600 font-semibold ms-6">THURSDAY CLOSED</span></p>
                            <p><i class="fas fa-phone-alt text-[#002B5E] mr-2"></i><strong>Mobile:</strong> 8102605105, 7903144878</p>
                            <p><i class="fas fa-envelope text-[#002B5E] mr-2"></i><strong>Email:</strong> drrajiv8484@gmail.com</p>
                        </div>
                    </div>
                    <a href="tel:8102605105" class="w-full bg-[#002B5E] hover:bg-[#3F9E13] text-white font-semibold py-3 rounded-lg text-center transition-colors text-sm uppercase tracking-wider block">
                        <i class="fas fa-phone mr-2"></i> Call Branch 1
                    </a>
                </div>

                <!-- Branch 2 Information -->
                <div class="branch-card bg-white p-8 rounded-xl border border-gray-200 shadow-sm flex flex-col justify-between" data-aos="fade-up" data-aos-delay="200">
                    <div>
                        <div class="inline-block bg-[#3F9E13] text-white text-xs font-bold px-3 py-1 rounded uppercase tracking-wider mb-4">
                            Branch - 2
                        </div>
                        <h3 class="text-xl font-serif font-bold text-[#002B5E] mb-3">Dhaiya Clinic</h3>
                        <p class="text-gray-600 text-sm mb-6 leading-relaxed">
                            <i class="fas fa-map-marker-alt text-[#3F9E13] mr-2"></i>
                            1st Floor, Akash Parvati Plaza, Beside Haveli Apartment, Main Road, Dhaiya, Dhanbad, Jharkhand 826001
                        </p>
                        <div class="space-y-3 text-sm text-gray-700 mb-6">
                            <p><i class="fas fa-clock text-[#002B5E] mr-2"></i><strong>Timing:</strong> Mon to Sat (10am to 6pm) | Sunday (10am to 2pm)</p>
                            <p><i class="fas fa-phone-alt text-[#002B5E] mr-2"></i><strong>Mobile:</strong> 9241079766</p>
                            <p><i class="fas fa-envelope text-[#002B5E] mr-2"></i><strong>Email:</strong> vimmyk207@gmail.com</p>
                        </div>
                    </div>
                    <a href="tel:9241079766" class="w-full bg-[#002B5E] hover:bg-[#3F9E13] text-white font-semibold py-3 rounded-lg text-center transition-colors text-sm uppercase tracking-wider block">
                        <i class="fas fa-phone mr-2"></i> Call Branch 2
                    </a>
                </div>

                <!-- Quick Inquiry Box -->
                <div class="bg-[#002B5E] text-white p-8 rounded-xl shadow-lg flex flex-col justify-between" data-aos="fade-up" data-aos-delay="300">
                    <div>
                        <div class="inline-block bg-[#3F9E13] text-white text-xs font-bold px-3 py-1 rounded uppercase tracking-wider mb-4">
                            Quick Support
                        </div>
                        <h3 class="text-xl font-serif font-bold mb-3">Emergency Dental Care</h3>
                        <p class="text-gray-300 text-sm mb-6 leading-relaxed">
                            Experiencing severe tooth pain or dental trauma? Get immediate consultation and priority booking with our specialists.
                        </p>
                        <div class="space-y-4 text-sm text-gray-200 mb-6">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center mr-3 text-[#3F9E13]">
                                    <i class="fas fa-headset text-lg"></i>
                                </div>
                                <div>
                                    <span class="block text-xs text-gray-400 uppercase">Helpline</span>
                                    <strong class="text-base">+91 81026 05105</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="tel:8102605105" class="w-full bg-[#3F9E13] hover:bg-white hover:text-[#002B5E] text-white font-bold py-3 rounded-lg text-center transition-all text-sm uppercase tracking-wider block shadow">
                        <i class="fas fa-phone-volume mr-2"></i> Emergency Call Now
                    </a>
                </div>

            </div>

            <!-- Contact Form & Map Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
                
                <!-- Simple Contact Form -->
                <div class="bg-white p-8 md:p-10 rounded-2xl border border-gray-200 shadow-sm" data-aos="fade-right">
                    <h3 class="text-2xl font-serif font-bold text-[#002B5E] mb-2">Send Us a Message</h3>
                    <p class="text-gray-600 text-sm mb-6">Fill out the form below and our clinic reception will respond promptly.</p>
                    
                    <form action="contact.php" method="POST" class="space-y-5">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-[#002B5E] mb-2">Your Name *</label>
                                <input type="text" name="name" required class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:border-[#3F9E13] text-sm bg-gray-50/50" placeholder="John Doe">
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-[#002B5E] mb-2">Your Email *</label>
                                <input type="email" name="email" required class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:border-[#3F9E13] text-sm bg-gray-50/50" placeholder="john@example.com">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-[#002B5E] mb-2">Phone Number *</label>
                                <input type="text" name="phone" required class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:border-[#3F9E13] text-sm bg-gray-50/50" placeholder="+91 98765 43210">
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-[#002B5E] mb-2">Subject</label>
                                <input type="text" name="subject" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:border-[#3F9E13] text-sm bg-gray-50/50" placeholder="Appointment / Inquiry">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-[#002B5E] mb-2">Your Message *</label>
                            <textarea name="message" rows="4" required class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:border-[#3F9E13] text-sm bg-gray-50/50" placeholder="Write your message or dental concerns here..."></textarea>
                        </div>

                        <button type="submit" class="w-full bg-[#002B5E] hover:bg-[#3F9E13] text-white font-bold py-3.5 rounded-lg transition-all text-sm uppercase tracking-wider shadow-md">
                            <i class="fas fa-paper-plane mr-2"></i> Send Message
                        </button>
                    </form>
                </div>

                <!-- Exact Location Map -->
                <div class="bg-white p-4 rounded-2xl border border-gray-200 shadow-sm h-full flex flex-col" data-aos="fade-left">
                    <h3 class="text-xl font-serif font-bold text-[#002B5E] mb-3 px-2">Exact Location Map</h3>
                    <p class="text-gray-600 text-sm mb-4 px-2">Find our primary branch located at Bekarbandh, Dhanbad.</p>
                    
                    <div class="relative w-full h-[410px] rounded-xl overflow-hidden border border-gray-200">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3650.583088924036!2d86.425!3d23.801!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMjPCsDQ4JzA3LjgiTiA4NsKwMjUnMzAuMCJF!5e0!3m2!1sen!2sin!4v1620000000000!5m2!1sen!2sin" 
                            width="100%" 
                            height="100%" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- Include Footer at the Bottom -->
    <?php include 'footer.php'; ?>
    <?php include 'CTA.php'; ?>

    <!-- JS Libraries -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js" defer></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            if (typeof AOS !== 'undefined') {
                AOS.init({ once: true, mirror: false, offset: 50 });
            }
        });
    </script>
</body>
</html>