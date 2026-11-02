<?php
// admin/manage_doctor.php
include '../config/db.php';

$msg = "";
$error = "";

// Ensure we are working with the correct database if not hardcoded in db.php
if (isset($conn) && $conn) {
    @mysqli_select_db($conn, 'lx');
}

// Handle Form Submission for Adding Doctor
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_doctor'])) {
    $name = trim($_POST['name']);
    $qualification = trim($_POST['qualification']);
    $specialist = trim($_POST['specialist']);
    $description = trim($_POST['description']);
    
    // Image Upload Handling
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
        $allowed = ['jpg', 'jpeg', 'png', 'webp'];
        $filename = $_FILES['profile_image']['name'];
        $filetmp = $_FILES['profile_image']['tmp_name'];
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        
        if (in_array($ext, $allowed)) {
            $newfilename = uniqid('doc_', true) . '.' . $ext;
            
            // Upload directory path: ../uploads/doctor-images/
            $upload_dir = '../uploads/doctor-images/';
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            $destination = $upload_dir . $newfilename;
            
            if (move_uploaded_file($filetmp, $destination)) {
                $db_image_path = 'uploads/doctor-images/' . $newfilename; // Stored relative to root for display
                
                $stmt = $conn->prepare("INSERT INTO doctors (name, qualification, specialist, profile_image, description) VALUES (?, ?, ?, ?, ?)");
                if ($stmt) {
                    $stmt->bind_param("sssss", $name, $qualification, $specialist, $db_image_path, $description);
                    
                    if ($stmt->execute()) {
                        $msg = "Doctor added successfully and saved to database!";
                    } else {
                        $error = "Database execution error: " . $stmt->error;
                    }
                    $stmt->close();
                } else {
                    $error = "Database preparation error: " . $conn->error;
                }
            } else {
                $error = "Failed to move uploaded file. Check folder permissions.";
            }
        } else {
            $error = "Invalid file extension. Allowed: JPG, JPEG, PNG, WEBP.";
        }
    } else {
        $error = "Profile image is required or an upload error occurred.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Doctors - Admin Dashboard</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            color: #002147;
            overflow-x: hidden;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-image: 
                linear-gradient(to right, rgba(0, 33, 71, 0.03) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(0, 33, 71, 0.03) 1px, transparent 1px);
            background-size: 30px 30px;
        }
        .navbar-custom {
            background-color: #002147;
        }
        .btn-custom-green {
            background-color: #558020;
            color: #ffffff;
            border: none;
            transition: all 0.3s ease;
        }
        .btn-custom-green:hover {
            background-color: #456819;
            color: #ffffff;
        }
        .doctor-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 33, 71, 0.08);
            transition: transform 0.3s ease;
            background: #ffffff;
        }
        .doctor-card:hover {
            transform: translateY(-5px);
        }
        .doc-img {
            width: 90px;
            height: 90px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid #558020;
        }
    </style>
</head>
<body>

    <!-- Top Navbar -->
    <nav class="navbar navbar-dark navbar-custom px-4 py-3 shadow-sm">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1 fw-bold"><i class="fa-solid fa-hospital-user me-2"></i>Admin Panel | Manage Doctors</span>
            <a href="../doctors.php" target="_blank" class="btn btn-outline-light btn-sm"><i class="fa-solid fa-eye me-1"></i> View Live Page</a>
        </div>
    </nav>

    <div class="container py-5">
        
        <!-- Header & Add Button -->
        <div class="row align-items-center mb-4" data-aos="fade-down">
            <div class="col-md-6">
                <h2 class="fw-bold" style="color: #002147;">Doctor Management</h2>
                <p class="text-muted mb-0">Add and manage clinic doctors and specialists.</p>
            </div>
            <div class="col-md-6 text-md-end mt-3 mt-md-0">
                <button type="button" class="btn btn-custom-green px-4 py-2 rounded-pill shadow-sm" data-bs-toggle="modal" data-bs-target="#addDoctorModal">
                    <i class="fa-solid fa-user-plus me-2"></i> Add New Doctor
                </button>
            </div>
        </div>

        <!-- Alert Notifications -->
        <?php if (!empty($msg)): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa-solid fa-circle-check me-2"></i><?php echo $msg; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fa-solid fa-circle-exclamation me-2"></i><?php echo $error; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Doctors Grid View -->
        <div class="row g-4">
            <?php
            $result = $conn->query("SELECT * FROM doctors ORDER BY id DESC");
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $imgSrc = "../" . htmlspecialchars($row['profile_image']);
            ?>
                    <div class="col-md-4" data-aos="fade-up">
                        <div class="card doctor-card p-4 h-100">
                            <div class="d-flex align-items-center mb-3">
                                <img src="<?php echo $imgSrc; ?>" alt="Doctor Image" class="doc-img me-3">
                                <div>
                                    <h5 class="fw-bold mb-1" style="color: #002147;"><?php echo htmlspecialchars($row['name']); ?></h5>
                                    <span class="badge bg-light text-success border border-success mb-1"><?php echo htmlspecialchars($row['specialist']); ?></span>
                                    <p class="text-muted small mb-0"><i class="fa-solid fa-graduation-cap me-1"></i><?php echo htmlspecialchars($row['qualification']); ?></p>
                                </div>
                            </div>
                            <hr class="text-muted opacity-25">
                            <p class="text-secondary small mb-0"><?php echo nl2br(htmlspecialchars($row['description'])); ?></p>
                        </div>
                    </div>
            <?php 
                }
            } else {
                echo '<div class="col-12 text-center py-5"><p class="text-muted">No doctors found. Click "Add New Doctor" to create one.</p></div>';
            }
            ?>
        </div>
    </div>

    <!-- Add Doctor Modal (Centered) -->
    <div class="modal fade" id="addDoctorModal" tabindex="-1" aria-labelledby="addDoctorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 15px;">
                <div class="modal-header text-white" style="background-color: #002147;">
                    <h5 class="modal-title fw-bold" id="addDoctorModalLabel"><i class="fa-solid fa-user-doctor me-2"></i>Add New Doctor</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-dark">Doctor Name</label>
                            <input type="text" class="form-control" name="name" placeholder="e.g. Dr. John Doe" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-dark">Qualification</label>
                            <input type="text" class="form-control" name="qualification" placeholder="e.g. BDS, MDS - Oral Surgeon" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-dark">Specialist</label>
                            <input type="text" class="form-control" name="specialist" placeholder="e.g. Orthodontist" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-dark">Profile Image</label>
                            <input type="file" class="form-control" name="profile_image" accept="image/*" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-dark">Description</label>
                            <textarea class="form-control" name="description" rows="3" placeholder="Enter professional bio and details..." required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer bg-light border-0">
                        <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="add_doctor" class="btn btn-custom-green rounded-pill px-4">Save Doctor</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AOS Animation JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true
        });
    </script>
</body>
</html>