<?php
session_start();
// Redirect if not logged in
if (!isset($_SESSION['admin'])) {
    header("Location: Login.php");
    exit();
}

include_once('../config/db.php');

$msg = "";
$msg_type = "";

if (isset($_POST['update_password'])) {
    $current_pass = mysqli_real_escape_string($conn, $_POST['current_password']);
    $new_pass     = mysqli_real_escape_string($conn, $_POST['new_password']);
    $confirm_pass = mysqli_real_escape_string($conn, $_POST['confirm_password']);
    $admin_id     = $_SESSION['admin_id']; // Ensure you stored 'admin_id' during login

    // 1. Fetch current password from DB
    $res = $conn->query("SELECT password FROM admin WHERE id = '$admin_id'");
    $row = $res->fetch_assoc();

    if ($current_pass !== $row['password']) {
        $msg = "Current password does not match!";
        $msg_type = "error";
    } elseif ($new_pass !== $confirm_pass) {
        $msg = "New passwords do not match!";
        $msg_type = "error";
    } else {
        // 2. Update Password
        $update = $conn->query("UPDATE admin SET password = '$new_pass' WHERE id = '$admin_id'");
        if ($update) {
            $msg = "Password updated successfully!";
            $msg_type = "success";
        } else {
            $msg = "Something went wrong. Try again.";
            $msg_type = "error";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Security Settings | Earth Power Infrastructure</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f0f2f5; }
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 30px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.05);
        }
        .input-group:focus-within label { color: #006837; }
        .input-field {
            transition: all 0.3s ease;
            border: 2px solid #f1f5f9;
        }
        .input-field:focus {
            border-color: #006837;
            background: white;
            box-shadow: 0 0 0 4px rgba(0, 104, 55, 0.1);
        }
    </style>
</head>
<body class="p-6 md:p-12">

    <div class="max-w-xl mx-auto">
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-black text-[#001a0d]">Security <span class="text-[#F7931E]">Portal</span></h1>
                <p class="text-gray-500 text-sm italic">Protect your admin access with a strong password.</p>
            </div>
            <div class="w-12 h-12 bg-[#006837] rounded-2xl flex items-center justify-center text-white shadow-lg">
                <i class="fa-solid fa-shield-halved text-xl"></i>
            </div>
        </div>

        <?php if($msg): ?>
        <div class="mb-6 p-4 rounded-2xl flex items-center gap-3 <?php echo ($msg_type == 'success') ? 'bg-green-50 text-green-700 border border-green-200' : 'bg-red-50 text-red-700 border border-red-200'; ?>">
            <i class="fa-solid <?php echo ($msg_type == 'success') ? 'fa-circle-check' : 'fa-circle-exclamation'; ?> text-xl"></i>
            <span class="font-bold text-sm uppercase tracking-tight"><?php echo $msg; ?></span>
        </div>
        <?php endif; ?>

        <div class="glass-card p-8 md:p-10">
            <form action="" method="POST" class="space-y-6">
                
                <div class="input-group">
                    <label class="text-[10px] font-black uppercase text-gray-400 mb-2 block ml-1 tracking-widest">
                        <i class="fa-solid fa-lock-open mr-1"></i> Current Password
                    </label>
                    <div class="relative">
                        <input type="password" name="current_password" required placeholder="••••••••" 
                               class="input-field w-full bg-gray-50 p-4 pl-12 rounded-2xl outline-none text-gray-700">
                        <i class="fa-solid fa-key absolute left-4 top-1/2 -translate-y-1/2 text-gray-300"></i>
                    </div>
                </div>

                <hr class="border-gray-100">

                <div class="input-group">
                    <label class="text-[10px] font-black uppercase text-gray-400 mb-2 block ml-1 tracking-widest">
                        <i class="fa-solid fa-vault mr-1"></i> New Secure Password
                    </label>
                    <div class="relative">
                        <input type="password" name="new_password" id="new_pass" required placeholder="Enter new password" 
                               class="input-field w-full bg-gray-50 p-4 pl-12 rounded-2xl outline-none text-gray-700">
                        <i class="fa-solid fa-fingerprint absolute left-4 top-1/2 -translate-y-1/2 text-gray-300"></i>
                    </div>
                </div>

                <div class="input-group">
                    <label class="text-[10px] font-black uppercase text-gray-400 mb-2 block ml-1 tracking-widest">
                        <i class="fa-solid fa-circle-check mr-1"></i> Confirm New Password
                    </label>
                    <div class="relative">
                        <input type="password" name="confirm_password" required placeholder="Repeat new password" 
                               class="input-field w-full bg-gray-50 p-4 pl-12 rounded-2xl outline-none text-gray-700">
                        <i class="fa-solid fa-check-double absolute left-4 top-1/2 -translate-y-1/2 text-gray-300"></i>
                    </div>
                </div>

                <button type="submit" name="update_password" 
                        class="w-full bg-[#006837] text-white py-5 rounded-2xl font-black uppercase tracking-[0.2em] shadow-xl hover:bg-[#F7931E] hover:scale-[1.02] active:scale-95 transition-all duration-300">
                    <i class="fa-solid fa-rotate mr-2"></i> Update Password
                </button>

            </form>
        </div>

        <p class="text-center text-gray-400 text-[10px] mt-8 uppercase font-bold tracking-[0.1em]">
            <i class="fa-solid fa-circle-info mr-1"></i> Password should be at least 8 characters for maximum security.
        </p>
    </div>

</body>
</html>