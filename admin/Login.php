<?php
session_start();

// Redirect if already logged in
if (isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit();
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include the centralized database connection file
    require_once "../config/db.php"; 

    // Ensure the connection variable (typically $conn or $db) exists from db.php
    if (!isset($conn)) {
        die("Database connection variable not found. Please check your db.php file.");
    }

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Query to check credentials
    $query = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['admin'] = $username;
        header("Location: index.php");
        exit();
    } else {
        $error = "Invalid username or password.";
    }

    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oral Care Dental Clinic | Admin Login</title>
    <link rel="icon" type="image/x-icon" href="../Assets/logo.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .btn-primary {
            background-color: #3F9E13; /* Bright Green from logo */
            color: #ffffff;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #2e750e; /* Darker green on hover */
            box-shadow: 0 4px 12px rgba(63, 158, 19, 0.4);
            transform: translateY(-1px);
        }
        .input-glass {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            transition: all 0.2s ease;
        }
        .input-glass:focus {
            border-color: #3F9E13;
            background: rgba(255, 255, 255, 0.15);
            outline: none;
            box-shadow: 0 0 0 4px rgba(63, 158, 19, 0.2);
        }
        .input-glass::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }
        .glass-container {
            background: rgba(0, 66, 137, 0.85); /* Deep vibrant blue from logo */
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
    </style>
</head>
<!-- Changed background to a dental-themed stock image -->
<body class="min-h-screen flex items-center justify-center relative bg-[url('https://images.unsplash.com/photo-1606811841689-23dfddce3e95?q=80&w=2000&auto=format&fit=crop')] bg-cover bg-center bg-fixed">

    <!-- Dark Gradient Overlay for the whole screen -->
    <div class="absolute inset-0 bg-black/70 z-0"></div>

    <!-- Main Glassmorphism Card -->
    <div class="relative z-10 flex flex-col lg:flex-row w-full max-w-5xl mx-4 my-8 glass-container border border-white/20 rounded-3xl shadow-2xl overflow-hidden">
        
        <!-- Left Side: Branding and Information (Hidden on Mobile, Visible on Desktop) -->
        <div class="hidden lg:flex flex-col justify-center w-1/2 p-12 border-r border-white/10 text-white">
            <img src="../Assets/logo.png" alt="Oral Care Dental Clinic Logo" class="h-16 object-contain mb-8 filter drop-shadow-lg self-start rounded-full">
            
            <h1 class="text-4xl font-bold tracking-tight mb-2">Welcome back</h1>
            <h2 class="text-2xl font-medium text-gray-200 mb-6">Oral Care Dental Clinic</h2>
            
            <!-- Green accent line -->
            <div class="w-16 h-1 bg-[#3F9E13] rounded-full mb-6"></div>
            
            <p class="text-gray-300 leading-relaxed font-normal text-base">
                Manage patient appointments, dental records, and clinic inquiries seamlessly. Access your system dashboard to provide premier oral care and monitor clinic operations.
            </p>
        </div>

        <!-- Right Side: Login Form -->
        <div class="w-full lg:w-1/2 p-8 sm:p-12 flex flex-col justify-center">
            
            <!-- Mobile Branding (Only shows on mobile screens) -->
            <div class="flex flex-col items-center mb-8 lg:hidden">
                <img src="../Assets/logo.jpg" alt="Oral Care Dental Clinic Logo" class="h-16 object-contain mb-4 filter drop-shadow-md rounded-full">
                <h1 class="text-2xl font-bold text-white text-center">Welcome Back</h1>
                <p class="text-sm font-medium text-gray-300 mt-1 text-center">Oral Care System Access</p>
            </div>

            <!-- Desktop Form Header -->
            <div class="mb-8 hidden lg:block text-white">
                <h3 class="text-3xl font-bold mb-2">Sign In</h3>
                <p class="text-gray-300 font-medium">Please enter your details to access your account.</p>
            </div>

            <!-- Error Message -->
            <?php if ($error !== ""): ?>
                <div class="mb-6 p-4 bg-red-500/20 border-l-4 border-red-500 text-white text-sm rounded-r-md shadow-sm flex items-center font-medium backdrop-blur-sm">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <!-- Form -->
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="space-y-6">
                
                <div>
                    <label for="username" class="block text-sm font-semibold text-gray-200 mb-1.5">Username</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <input 
                            type="text" 
                            id="username" 
                            name="username" 
                            required 
                            class="input-glass w-full pl-10 pr-3 py-3 text-sm rounded-xl"
                            placeholder="Enter admin username"
                        >
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-200 mb-1.5">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            required 
                            class="input-glass w-full pl-10 pr-3 py-3 text-sm rounded-xl"
                            placeholder="Enter your password"
                        >
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit" class="btn-primary w-full text-base font-semibold py-3 rounded-xl flex justify-center items-center shadow-lg">
                        Sign In to Dashboard
                        <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                </div>
                
            </form>

            <!-- Custom AKCS Footer -->
            <div class="mt-8 text-center text-sm font-medium text-gray-300">
                Developed and designed with <span class="text-red-500">❤️</span> by <br class="sm:hidden">
                <a href="https://www.akcsgroup.com" target="_blank" class="text-white hover:text-[#3F9E13] transition-colors font-semibold ml-1">AKCS Group</a>
            </div>

        </div>
    </div>
    
</body>
</html>