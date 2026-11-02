<?php
// appointment.php
require_once 'config/db.php';

$success_msg = "";
$error_msg = "";

// Handle Form Submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $branch_name      = trim($_POST['branch_name'] ?? '');
    $appointment_date = trim($_POST['appointment_date'] ?? '');
    $appointment_time = trim($_POST['appointment_time'] ?? '');
    $patient_name     = trim($_POST['patient_name'] ?? '');
    $patient_email    = trim($_POST['patient_email'] ?? '');
    $patient_phone    = trim($_POST['patient_phone'] ?? '');
    $dental_concern   = trim($_POST['dental_concern'] ?? '');

    if (!empty($branch_name) && !empty($appointment_date) && !empty($appointment_time) && !empty($patient_name) && !empty($patient_phone)) {
        
        // Check if slot is already booked for this branch and date
        $check_stmt = $conn->prepare("SELECT id FROM appointments WHERE branch_name = ? AND appointment_date = ? AND appointment_time = ?");
        $check_stmt->bind_param("sss", $branch_name, $appointment_date, $appointment_time);
        $check_stmt->execute();
        $check_res = $check_stmt->get_result();
        
        if ($check_res->num_rows > 0) {
            $error_msg = "Selected time slot is already booked. Please choose another available slot.";
        } else {
            $stmt = $conn->prepare("INSERT INTO appointments (branch_name, appointment_date, appointment_time, patient_name, patient_email, patient_phone, dental_concern) VALUES (?, ?, ?, ?, ?, ?, ?)");
            if ($stmt) {
                $stmt->bind_param("sssssss", $branch_name, $appointment_date, $appointment_time, $patient_name, $patient_email, $patient_phone, $dental_concern);
                if ($stmt->execute()) {
                    $success_msg = "Appointment booked successfully! We look forward to seeing you.";
                } else {
                    $error_msg = "Failed to save appointment. Please try again.";
                }
                $stmt->close();
            } else {
                $error_msg = "Database error: Could not prepare statement.";
            }
        }
        $check_stmt->close();
    } else {
        $error_msg = "Please fill in all required fields and pick an available time slot.";
    }
}

// Fetch booked slots for AJAX / dynamic highlighting via GET
if (isset($_GET['get_booked_slots']) && isset($_GET['branch']) && isset($_GET['date'])) {
    $b = $_GET['branch'];
    $d = $_GET['date'];
    $booked = [];
    $stmt = $conn->prepare("SELECT appointment_time FROM appointments WHERE branch_name = ? AND appointment_date = ?");
    $stmt->bind_param("ss", $b, $d);
    $stmt->execute();
    $res = $stmt->get_result();
    while ($row = $res->fetch_assoc()) {
        $booked[] = $row['appointment_time'];
    }
    $stmt->close();
    header('Content-Type: application/json');
    echo json_encode($booked);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Appointment - Oral Care Dental Clinic</title>
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

        /* Hero Section */
        .appointment-hero {
            position: relative;
            background: linear-gradient(rgba(0, 43, 94, 0.85), rgba(0, 43, 94, 0.90)), 
                        url('https://images.unsplash.com/photo-1629909613654-28e377c37b09?auto=format&fit=crop&w=1920&q=80') center/cover no-repeat;
            padding: 120px 0 90px 0;
            color: #ffffff;
            text-align: center;
        }

        /* Stylish Green Slot Styling States */
        .slot-label {
            background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
            border: 1px solid #86efac;
            color: #166534;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .slot-label:hover {
            background: linear-gradient(135deg, #dcfce7 100%, #bbf7d0 100%);
            border-color: #3F9E13;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(63, 158, 19, 0.15);
        }
        .slot-radio:checked + label {
            background: linear-gradient(135deg, #3F9E13 0%, #358610 100%) !important;
            color: white !important;
            border-color: #3F9E13 !important;
            box-shadow: 0 8px 20px rgba(63, 158, 19, 0.35) !important;
            transform: translateY(-2px);
        }
        .slot-booked {
            background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%) !important;
            color: #991b1b !important;
            border-color: #fca5a5 !important;
            cursor: not-allowed !important;
            opacity: 0.75;
            text-decoration: line-through;
        }
    </style>
</head>
<body class="overflow-x-hidden">

    <!-- Include Navbar at the Top -->
    <?php include 'navbar.php'; ?>

    <!-- Stylish Hero Section -->
    <section class="appointment-hero">
        <div class="w-[92%] md:w-[90%] xl:w-[85%] max-w-[1600px] mx-auto relative z-10" data-aos="fade-down" data-aos-duration="1000">
            <div class="inline-flex items-center bg-white/10 border border-white/20 px-5 py-2 rounded-full text-sm text-white mb-6 backdrop-blur-md shadow-lg">
                <a href="index.php" class="hover:text-[#3F9E13] transition-colors">HOME</a> 
                <span class="text-[#3F9E13] mx-2 font-bold">></span> 
                <span class="text-white font-semibold">BOOK APPOINTMENT</span>
            </div>
            <h1 class="text-3xl md:text-5xl font-serif font-bold mb-4 tracking-tight">
                Schedule Your <span class="text-[#3F9E13]">Dental Visit</span>
            </h1>
            <p class="text-gray-200 text-base md:text-lg max-w-2xl mx-auto leading-relaxed">
                Explore our branch schedules on the left and book your preferred green 15-minute time slot instantly on the right.
            </p>
        </div>
    </section>

    <!-- Main Section -->
    <section class="relative w-full py-16 md:py-24 bg-professional-grid overflow-hidden border-b border-gray-200">
        <div class="w-[92%] md:w-[90%] xl:w-[85%] max-w-[1600px] mx-auto relative z-10">
            
            <!-- Section Header -->
            <div class="text-center max-w-3xl mx-auto mb-16" data-aos="fade-up" data-aos-duration="800">
                <div class="flex items-center justify-center gap-3 mb-4">
                    <span class="w-8 h-[2px] bg-[#3F9E13]"></span>
                    <h4 class="text-[#3F9E13] text-[11px] font-bold uppercase tracking-[0.25em]">Online Consultation</h4>
                    <span class="w-8 h-[2px] bg-[#3F9E13]"></span>
                </div>
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-serif font-bold text-[#002B5E] leading-tight mb-4">
                    Branch Timings & Live Slot Selector
                </h2>
                <p class="text-gray-600 font-medium">Select your clinic branch, pick a date, and click an available green slot to secure your visit.</p>
            </div>

            <!-- Notifications -->
            <?php if (!empty($success_msg)): ?>
                <div class="max-w-5xl mx-auto mb-10 bg-green-50 border-l-4 border-[#3F9E13] p-4 rounded-xl shadow-md" data-aos="fade-up">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-[#3F9E13] text-2xl mr-3"></i>
                        <p class="text-green-800 font-semibold"><?= $success_msg ?></p>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (!empty($error_msg)): ?>
                <div class="max-w-5xl mx-auto mb-10 bg-red-50 border-l-4 border-red-500 p-4 rounded-xl shadow-md" data-aos="fade-up">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-circle text-red-500 text-2xl mr-3"></i>
                        <p class="text-red-800 font-semibold"><?= $error_msg ?></p>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Main Layout Grid: Left (Branch Details) & Right (Booking Form) -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                
                <!-- LEFT SIDE: Branch Details & Reference Cards (Cols 5) -->
                <div class="lg:col-span-5 space-y-6" data-aos="fade-right">
                    
                    <div class="bg-white p-6 md:p-8 rounded-2xl border border-gray-200/80 shadow-md hover:shadow-xl transition-all">
                        <div class="inline-block bg-[#3F9E13] text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider mb-3 shadow">
                            Branch - 1
                        </div>
                        <h3 class="text-xl font-serif font-bold text-[#002B5E] mb-2">Bekarbandh Clinic</h3>
                        <p class="text-gray-600 text-xs mb-4 leading-relaxed">
                            <i class="fas fa-map-marker-alt text-[#3F9E13] mr-2"></i>
                            Gupteshwar Complex, A-Block, 1st Floor Beside PNB, Bekarbandh, Dhanbad
                        </p>
                        <div class="bg-gradient-to-br from-gray-50 to-emerald-50/30 p-4 rounded-xl border border-gray-100 space-y-2 text-xs text-gray-700">
                            <p><i class="fas fa-clock text-[#002B5E] mr-1.5"></i><strong>Timing:</strong> Morning (10am-2pm) | Evening (5pm-7pm)</p>
                            <p class="text-red-600 font-bold uppercase tracking-wider text-center pt-1 bg-red-50 py-1 rounded border border-red-100">THURSDAY CLOSED</p>
                            <p class="pt-1 border-t border-gray-200"><i class="fas fa-phone-alt text-[#002B5E] mr-1.5"></i><strong>Mobile:</strong> 8102605105, 7903144878</p>
                        </div>
                        <button type="button" onclick="setBranchFromCard('Bekarbandh Clinic')" class="mt-5 w-full bg-[#002B5E] hover:bg-[#3F9E13] text-white font-semibold py-3 rounded-xl transition-all text-xs uppercase tracking-wider block text-center shadow">
                            <i class="fas fa-arrow-right mr-1"></i> Select Branch 1
                        </button>
                    </div>

                    <div class="bg-white p-6 md:p-8 rounded-2xl border border-gray-200/80 shadow-md hover:shadow-xl transition-all">
                        <div class="inline-block bg-[#3F9E13] text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider mb-3 shadow">
                            Branch - 2
                        </div>
                        <h3 class="text-xl font-serif font-bold text-[#002B5E] mb-2">Dhaiya Clinic</h3>
                        <p class="text-gray-600 text-xs mb-4 leading-relaxed">
                            <i class="fas fa-map-marker-alt text-[#3F9E13] mr-2"></i>
                            1st Floor, Akash Parvati Plaza, Beside Haveli Apartment, Main Road, Dhaiya, Dhanbad
                        </p>
                        <div class="bg-gradient-to-br from-gray-50 to-emerald-50/30 p-4 rounded-xl border border-gray-100 space-y-2 text-xs text-gray-700">
                            <p><i class="fas fa-clock text-[#002B5E] mr-1.5"></i><strong>Mon-Sat:</strong> 10am to 6pm | <strong>Sun:</strong> 10am to 2pm</p>
                            <p class="pt-1 border-t border-gray-200"><i class="fas fa-phone-alt text-[#002B5E] mr-1.5"></i><strong>Mobile:</strong> 9241079766</p>
                        </div>
                        <button type="button" onclick="setBranchFromCard('Dhaiya Clinic')" class="mt-5 w-full bg-[#002B5E] hover:bg-[#3F9E13] text-white font-semibold py-3 rounded-xl transition-all text-xs uppercase tracking-wider block text-center shadow">
                            <i class="fas fa-arrow-right mr-1"></i> Select Branch 2
                        </button>
                    </div>

                </div>

                <!-- RIGHT SIDE: Appointment Booking Form (Cols 7) -->
                <div class="lg:col-span-7 bg-white p-8 md:p-12 rounded-3xl border border-gray-200/80 shadow-2xl" data-aos="fade-left">
                    <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-100">
                        <div>
                            <h3 class="text-2xl font-serif font-bold text-[#002B5E]">Book Your Visit</h3>
                            <p class="text-gray-500 text-xs mt-1">Fill in your details and pick your time slot.</p>
                        </div>
                        <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-[#3F9E13] flex items-center justify-center text-xl shadow-inner">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                    </div>

                    <form action="appointment.php" method="POST" class="space-y-6">
                        
                        <!-- Branch Selection Dropdown with color styling -->
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-[#002B5E] mb-2">Select Clinic Branch *</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-[#3F9E13] pointer-events-none">
                                    <i class="fas fa-clinic-medical"></i>
                                </span>
                                <select id="branch_select" name="branch_name" required onchange="onBranchOrDateChange()" class="w-full pl-11 pr-4 py-3.5 rounded-xl border border-gray-300 focus:outline-none focus:border-[#3F9E13] focus:ring-2 focus:ring-[#3F9E13]/20 text-sm bg-gray-50/80 font-semibold text-[#002B5E] shadow-sm transition-all">
                                    <option value="">-- Choose Clinic Branch --</option>
                                    <option value="Bekarbandh Clinic">Bekarbandh Clinic (Branch 1)</option>
                                    <option value="Dhaiya Clinic">Dhaiya Clinic (Branch 2)</option>
                                </select>
                            </div>
                        </div>

                        <!-- Date & Patient Name -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-[#002B5E] mb-2">Appointment Date *</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-[#3F9E13] pointer-events-none">
                                        <i class="fas fa-calendar-day"></i>
                                    </span>
                                    <input type="date" id="appointment_date" name="appointment_date" required min="<?= date('Y-m-d') ?>" onchange="onBranchOrDateChange()" class="w-full pl-11 pr-4 py-3.5 rounded-xl border border-gray-300 focus:outline-none focus:border-[#3F9E13] focus:ring-2 focus:ring-[#3F9E13]/20 text-sm bg-gray-50/80 shadow-sm transition-all font-medium text-gray-700">
                                </div>
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-[#002B5E] mb-2">Patient Full Name *</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-[#3F9E13] pointer-events-none">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <input type="text" name="patient_name" required class="w-full pl-11 pr-4 py-3.5 rounded-xl border border-gray-300 focus:outline-none focus:border-[#3F9E13] focus:ring-2 focus:ring-[#3F9E13]/20 text-sm bg-gray-50/80 shadow-sm transition-all" placeholder="John Doe">
                                </div>
                            </div>
                        </div>

                        <!-- Phone & Optional Email -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-[#002B5E] mb-2">Phone Number *</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-[#3F9E13] pointer-events-none">
                                        <i class="fas fa-phone"></i>
                                    </span>
                                    <input type="text" name="patient_phone" required class="w-full pl-11 pr-4 py-3.5 rounded-xl border border-gray-300 focus:outline-none focus:border-[#3F9E13] focus:ring-2 focus:ring-[#3F9E13]/20 text-sm bg-gray-50/80 shadow-sm transition-all" placeholder="+91 98765 43210">
                                </div>
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-[#002B5E] mb-2">Email Address (Optional)</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-[#3F9E13] pointer-events-none">
                                        <i class="fas fa-envelope"></i>
                                    </span>
                                    <input type="email" name="patient_email" class="w-full pl-11 pr-4 py-3.5 rounded-xl border border-gray-300 focus:outline-none focus:border-[#3F9E13] focus:ring-2 focus:ring-[#3F9E13]/20 text-sm bg-gray-50/80 shadow-sm transition-all" placeholder="john@example.com">
                                </div>
                            </div>
                        </div>

                        <!-- 15 Minutes Time Slots with Suggestion / Legend -->
                        <div class="bg-emerald-50/40 p-5 rounded-2xl border border-emerald-100">
                            <div class="flex flex-wrap items-center justify-between mb-3 pb-2 border-b border-emerald-100">
                                <label class="block text-xs font-bold uppercase tracking-wider text-[#002B5E]">Select 15-Minute Time Slot *</label>
                                <!-- Legend / Suggestion -->
                                <div class="flex items-center gap-3 text-[11px] font-bold">
                                    <span class="flex items-center gap-1.5"><span class="w-3 h-3 rounded-full bg-[#3F9E13] inline-block shadow-sm"></span> Available</span>
                                    <span class="flex items-center gap-1.5"><span class="w-3 h-3 rounded-full bg-red-400 inline-block shadow-sm"></span> Booked</span>
                                </div>
                            </div>
                            
                            <div id="slotsContainer" class="grid grid-cols-3 sm:grid-cols-4 gap-2.5 max-h-56 overflow-y-auto pr-1">
                                <p class="col-span-full text-center text-xs text-gray-500 py-6 font-medium">Please select a branch and date above to load live green available time slots.</p>
                            </div>
                        </div>

                        <!-- Dental Concern -->
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-[#002B5E] mb-2">Dental Concern / Message</label>
                            <textarea name="dental_concern" rows="2" class="w-full px-4 py-3.5 rounded-xl border border-gray-300 focus:outline-none focus:border-[#3F9E13] focus:ring-2 focus:ring-[#3F9E13]/20 text-sm bg-gray-50/80 shadow-sm transition-all" placeholder="Briefly describe your dental issue..."></textarea>
                        </div>

                        <button type="submit" class="w-full bg-[#002B5E] hover:bg-[#3F9E13] text-white font-bold py-4 rounded-xl transition-all text-sm uppercase tracking-wider shadow-xl transform hover:-translate-y-0.5">
                            <i class="fas fa-calendar-check mr-2"></i> Confirm & Book Appointment
                        </button>
                    </form>
                </div>

            </div>

        </div>
    </section>

    <!-- Include Footer at the Bottom -->
    <?php include 'footer.php'; ?>

    <!-- JS Libraries & Dynamic Slot Fetcher -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js" defer></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            if (typeof AOS !== 'undefined') {
                AOS.init({ once: true, mirror: false, offset: 50 });
            }
        });

        function setBranchFromCard(branchName) {
            const selectEl = document.getElementById('branch_select');
            selectEl.value = branchName;
            window.scrollTo({ top: selectEl.getBoundingClientRect().top + window.pageYOffset - 150, behavior: 'smooth' });
            onBranchOrDateChange();
        }

        function onBranchOrDateChange() {
            const branch = document.getElementById('branch_select').value;
            const dateVal = document.getElementById('appointment_date').value;
            const container = document.getElementById('slotsContainer');

            if (!branch || !dateVal) {
                container.innerHTML = '<p class="col-span-full text-center text-xs text-gray-500 py-6 font-medium">Please select both clinic branch and appointment date.</p>';
                return;
            }

            const dateObj = new Date(dateVal);
            const dayOfWeek = dateObj.getDay(); // 0 = Sunday, 4 = Thursday

            if (branch === 'Bekarbandh Clinic' && dayOfWeek === 4) {
                container.innerHTML = '<p class="col-span-full text-center text-xs text-red-600 font-bold py-6 bg-red-50 rounded-xl border border-red-200">Bekarbandh Clinic is CLOSED on Thursdays. Please pick another date.</p>';
                return;
            }

            // Fetch already booked slots via AJAX
            fetch(`appointment.php?get_booked_slots=1&branch=${encodeURIComponent(branch)}&date=${encodeURIComponent(dateVal)}`)
                .then(response => response.json())
                .then(bookedSlots => {
                    let timeRanges = [];

                    if (branch === 'Bekarbandh Clinic') {
                        timeRanges = [
                            { startHour: 10, startMin: 0, endHour: 14, endMin: 0 },
                            { startHour: 17, startMin: 0, endHour: 19, endMin: 0 }
                        ];
                    } else if (branch === 'Dhaiya Clinic') {
                        if (dayOfWeek === 0) {
                            timeRanges = [{ startHour: 10, startMin: 0, endHour: 14, endMin: 0 }];
                        } else {
                            timeRanges = [{ startHour: 10, startMin: 0, endHour: 18, endMin: 0 }];
                        }
                    }

                    let slotsHTML = '';
                    let totalSlots = 0;

                    timeRanges.forEach(range => {
                        let currentMinutes = range.startHour * 60 + range.startMin;
                        let endMinutes = range.endHour * 60 + range.endMin;

                        while (currentMinutes < endMinutes) {
                            let hour = Math.floor(currentMinutes / 60);
                            let minute = currentMinutes % 60;
                            let ampm = hour >= 12 ? 'PM' : 'AM';
                            let formattedHour = hour % 12 === 0 ? 12 : hour % 12;
                            let formattedMinute = minute < 10 ? '0' + minute : minute;
                            let timeStr = `${formattedHour}:${formattedMinute} ${ampm}`;

                            let isBooked = bookedSlots.includes(timeStr);
                            let slotId = `slot_${timeStr.replace(/[: ]/g, '_')}`;

                            if (isBooked) {
                                slotsHTML += `
                                    <div>
                                        <div class="block text-center py-2.5 px-2 rounded-xl text-xs font-bold slot-booked select-none shadow-sm">
                                            ${timeStr} (Booked)
                                        </div>
                                    </div>
                                `;
                            } else {
                                totalSlots++;
                                slotsHTML += `
                                    <div>
                                        <input type="radio" id="${slotId}" name="appointment_time" value="${timeStr}" required class="hidden slot-radio">
                                        <label for="${slotId}" class="slot-label block text-center py-2.5 px-2 rounded-xl text-xs font-bold cursor-pointer shadow-sm">
                                            ${timeStr}
                                        </label>
                                    </div>
                                `;
                            }

                            currentMinutes += 15; // 15-minute interval
                        }
                    });

                    if (totalSlots === 0 && timeRanges.length > 0) {
                        container.innerHTML = '<p class="col-span-full text-center text-xs text-amber-700 font-bold py-6 bg-amber-50 rounded-xl border border-amber-200">All time slots are fully booked for this date. Please select another day.</p>';
                    } else {
                        container.innerHTML = slotsHTML;
                    }
                })
                .catch(err => {
                    container.innerHTML = '<p class="col-span-full text-center text-xs text-red-500 py-6">Error loading slots. Please refresh.</p>';
                });
        }
    </script>
</body>
</html>