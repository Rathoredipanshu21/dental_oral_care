<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: Login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oral Care Dental Clinic | Admin Control Panel</title>
    <link rel="icon" type="image/jpeg" href="../Assets/logo.png">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- FontAwesome & Google Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600;700;800;900&family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            /* Brand Colors for Oral Care Dental Clinic */
            --oc-navy: #004289;       /* Deep Vibrant Blue */
            --oc-navy-dark: #002B5E;  /* Darker Navy */
            --oc-green: #3F9E13;      /* Bright Brand Green */
            --oc-green-light: rgba(63, 158, 19, 0.15);
            --oc-bg: #f8f9fa;         /* Light Gray/White Background */
            --oc-text: #374151;       /* Dark Text */
            --oc-font-brand: 'Playfair Display', serif;
            --oc-font-body: 'Montserrat', sans-serif;
        }

        body {
            font-family: var(--oc-font-body);
            background-color: var(--oc-bg);
            color: var(--oc-text);
            overflow: hidden; /* Prevents whole-page scrolling, relying on iframe */
        }

        /* --- Sidebar --- */
        .oc-sidebar {
            background: linear-gradient(180deg, var(--oc-navy-dark) 0%, var(--oc-navy) 100%);
            transition: all 0.3s ease-in-out;
            height: 100vh;
            display: flex;
            flex-direction: column;
            border-right: 2px solid var(--oc-green);
        }
        
        .oc-sidebar-nav {
            flex-grow: 1;
            overflow-y: auto;
            padding: 1rem 0;
        }

        /* Hide scrollbar for sidebar but keep functionality */
        .oc-sidebar-nav::-webkit-scrollbar { width: 4px; }
        .oc-sidebar-nav::-webkit-scrollbar-thumb { background: var(--oc-green); border-radius: 4px; }

        .oc-logo-box {
            padding: 1.5rem;
            background: var(--oc-navy-dark);
            border-bottom: 1px solid rgba(63, 158, 19, 0.3);
        }

        .oc-sidebar-link {
            display: flex;
            align-items: center;
            padding: 14px 24px;
            color: #d1d5db; /* Gray-300 */
            font-weight: 600;
            font-size: 0.85rem;
            transition: all 0.2s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-left: 4px solid transparent;
        }

        .oc-sidebar-link:hover {
            background: var(--oc-green-light);
            color: #ffffff;
            border-left-color: var(--oc-green);
        }

        .oc-sidebar-link.active {
            background: var(--oc-green);
            color: #ffffff;
            border-left-color: #ffffff;
            font-weight: 700;
            box-shadow: inset 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .oc-sidebar-link i { 
            width: 32px; 
            font-size: 1.1rem; 
            color: var(--oc-green); 
            transition: color 0.2s ease;
        }
        .oc-sidebar-link:hover i { color: #ffffff; }
        .oc-sidebar-link.active i { color: #ffffff; }

        .oc-nav-label {
            font-size: 0.65rem;
            text-transform: uppercase;
            color: var(--oc-green);
            padding: 24px 24px 8px;
            font-weight: 800;
            letter-spacing: 0.2em;
            opacity: 0.9;
        }

        /* --- Header & Content --- */
        .oc-glass-header {
            background: #ffffff;
            border-bottom: 2px solid var(--oc-green);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        .oc-top-accent {
            height: 4px;
            background: linear-gradient(90deg, var(--oc-navy), var(--oc-green), var(--oc-navy-dark));
            width: 100%;
        }

        .oc-user-pill {
            background: rgba(0, 0, 0, 0.2);
            border-top: 1px solid rgba(63, 158, 19, 0.3);
            padding: 16px 24px;
        }

        /* --- Mobile Responsiveness --- */
        @media (max-width: 1024px) {
            .oc-sidebar { 
                position: fixed; 
                left: -100%; 
                z-index: 100; 
                width: 280px; 
            }
            .oc-sidebar.active { 
                left: 0; 
                box-shadow: 10px 0 25px rgba(0,0,0,0.5);
            }
        }
    </style>
</head>
<body>

    <!-- Mobile Overlay -->
    <div id="overlay" class="fixed inset-0 bg-[#002B5E]/80 backdrop-blur-sm z-[90] hidden transition-opacity lg:hidden"></div>

    <div class="flex h-screen">
        
        <!-- Sidebar Menu -->
        <aside id="sidebar" class="oc-sidebar w-72 flex-shrink-0">
            <div class="oc-logo-box">
                <div class="flex items-center gap-4">
                    <img src="../Assets/logo.png" alt="Oral Care Dental Clinic Logo" class="w-12 h-12 object-cover bg-white p-0.5 rounded-full shadow-md">
                    <div>
                        <h1 class="text-white font-black text-sm leading-tight tracking-widest uppercase" style="font-family: var(--oc-font-brand);">Oral Care<br>Dental</h1>
                        <span class="text-[var(--oc-green)] text-[9px] font-bold uppercase tracking-[0.2em]">Admin Portal</span>
                    </div>
                </div>
            </div>

            <nav class="oc-sidebar-nav">
                <div class="oc-nav-label">Core Modules</div>
                <a href="dashboard.php" class="oc-sidebar-link active" target="content-frame">
                    <i class="fa-solid fa-chart-line"></i> Dashboard
                </a>
                
                <a href="manage_hero.php" class="oc-sidebar-link" target="content-frame">
                    <i class="fa-solid fa-images"></i> Manage Banners
                </a>
                
                <a href="manage_services.php" class="oc-sidebar-link" target="content-frame">
                    <i class="fa-solid fa-tooth"></i> Manage Services
                </a>
                <a href="manage_doctors.php" class="oc-sidebar-link" target="content-frame">
                    <i class="fa-solid fa-user-md"></i> Manage Doctors
                </a>
                
                <a href="manage_appointments.php" class="oc-sidebar-link" target="content-frame">
                    <i class="fa-solid fa-calendar-check"></i> Appointments
                </a>

                <div class="oc-nav-label">Media & Content</div>
                <a href="manage_gallery.php" class="oc-sidebar-link" target="content-frame">
                    <i class="fa-solid fa-camera"></i> Manage Gallery
                </a>
                
                <a href="manage_blogs.php" class="oc-sidebar-link" target="content-frame">
                    <i class="fa-solid fa-pen-to-square"></i> Manage Blogs
                </a>
                
                <a href="manage_enquiries.php" class="oc-sidebar-link" target="content-frame">
                    <i class="fa-solid fa-envelope-open-text"></i> Patient Enquiries
                </a>
            </nav>

            <div class="oc-user-pill">
                <div class="flex items-center gap-3">
                    <div class="flex-1 min-w-0">
                        <p class="text-xs font-bold text-white truncate uppercase tracking-widest">Administrator</p>
                        <a href="logout.php" class="text-[11px] text-[var(--oc-green)] hover:text-white flex items-center gap-2 mt-1.5 font-bold uppercase tracking-widest transition-colors">
                            <i class="fa-solid fa-power-off text-sm"></i> Sign Out
                        </a>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col min-w-0">
            <div class="oc-top-accent"></div>
            
            <header class="oc-glass-header h-20 flex items-center justify-between px-6 md:px-8">
                <div class="flex items-center gap-4 md:gap-6">
                    <button id="menu-toggle" class="lg:hidden w-11 h-11 rounded flex items-center justify-center bg-[var(--oc-navy)] text-white hover:bg-[var(--oc-green)] transition-colors shadow-md">
                        <i class="fa-solid fa-bars-staggered text-lg"></i>
                    </button>
                    <div class="flex flex-col">
                        <h2 id="page-title" class="text-xl md:text-2xl font-bold text-[var(--oc-navy)] tracking-wider uppercase" style="font-family: var(--oc-font-brand);">Dashboard</h2>
                        <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest">Oral Care Management Panel</p>
                    </div>
                </div>

                <div class="flex items-center gap-3 md:gap-4">
                    <a href="../index.php" target="_blank" class="hidden sm:flex items-center gap-2 text-xs font-bold text-white bg-[var(--oc-green)] hover:bg-[var(--oc-navy)] transition-all px-5 py-2.5 rounded shadow uppercase tracking-wider">
                        <i class="fa-solid fa-globe"></i> View Website
                    </a>
                    <button onclick="toggleFullScreen()" class="w-11 h-11 rounded bg-white border-2 border-[var(--oc-navy)] text-[var(--oc-navy)] hover:bg-[var(--oc-navy)] hover:text-white flex items-center justify-center transition-all shadow-sm">
                        <i id="fullscreen-icon" class="fa-solid fa-expand"></i>
                    </button>
                </div>
            </header>

            <main class="flex-1 relative overflow-hidden bg-[var(--oc-bg)]">
                <iframe id="content-frame" name="content-frame" src="dashboard.php" class="w-full h-full border-none" allowfullscreen></iframe>
            </main>
        </div>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        const menuToggle = document.getElementById('menu-toggle');
        const links = document.querySelectorAll('.oc-sidebar-link');
        const pageTitle = document.getElementById('page-title');

        // Toggle Sidebar for Mobile
        function toggleSidebar() {
            sidebar.classList.toggle('active');
            overlay.classList.toggle('hidden');
        }

        menuToggle.addEventListener('click', toggleSidebar);
        overlay.addEventListener('click', toggleSidebar);

        // Active State and Title Update Logic
        links.forEach(link => {
            link.addEventListener('click', function() {
                // Remove active class from all links
                links.forEach(l => l.classList.remove('active'));
                
                // Add active class to clicked link
                this.classList.add('active');
                
                // Update header title based on link text
                if(pageTitle) {
                    pageTitle.textContent = this.textContent.trim();
                }
                
                // Auto-close sidebar on mobile after clicking a link
                if(window.innerWidth < 1024) {
                    toggleSidebar();
                }
            });
        });

        // Fullscreen Toggle Logic
        function toggleFullScreen() {
            const icon = document.getElementById('fullscreen-icon');
            if (!document.fullscreenElement) {
                document.documentElement.requestFullscreen();
                icon.classList.replace('fa-expand', 'fa-compress');
            } else {
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                    icon.classList.replace('fa-compress', 'fa-expand');
                }
            }
        }
    </script>
</body>
</html>