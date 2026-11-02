<?php
// admin/manage_gallery.php
session_start();
include '../config/db.php'; 

// Ensure upload directory exists securely
$target_dir = "../uploads/gallery-images/";
if (!is_dir($target_dir)) {
    mkdir($target_dir, 0755, true);
}

// Handle Multiple Image Uploads
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_images'])) {
    
    if (isset($_FILES['images']) && !empty($_FILES['images']['name'][0])) {
        $upload_count = 0;
        $error_messages = [];
        
        $total_files = count($_FILES['images']['name']);
        
        // Prepare once, reuse for every file
        $insert_query = "INSERT INTO `gallery` (`image_name`, `created_at`) VALUES (?, NOW())";
        $stmt = $conn->prepare($insert_query);
        
        if (!$stmt) {
            // Capture the error FIRST, before running any other query
            $my_error = $conn->error;
            $my_errno = $conn->errno;
            
            $db_res  = $conn->query("SELECT DATABASE() AS db");
            $db_name = ($db_res && ($r = $db_res->fetch_assoc())) ? $r['db'] : 'unknown';
            
            $tables = [];
            if ($t_res = $conn->query("SHOW TABLES")) {
                while ($t = $t_res->fetch_row()) { $tables[] = $t[0]; }
            }
            
            $_SESSION['msg'] = "<div class='alert alert-danger'><strong>Upload Failed:</strong><br>"
                . "Database statement prep failed.<br>"
                . "<small>MySQL error ({$my_errno}): " . htmlspecialchars($my_error) . "<br>"
                . "Connected DB: " . htmlspecialchars($db_name) . "<br>"
                . "Tables in this DB: " . htmlspecialchars(implode(', ', $tables)) . "</small></div>";
            header("Location: manage_gallery.php");
            exit();
        }
        
        for ($i = 0; $i < $total_files; $i++) {
            $file_tmp   = $_FILES['images']['tmp_name'][$i];
            $file_name  = $_FILES['images']['name'][$i];
            $file_error = $_FILES['images']['error'][$i];
            $file_size  = $_FILES['images']['size'][$i];
            
            // Check PHP upload error codes
            if ($file_error !== UPLOAD_ERR_OK) {
                $error_messages[] = "File '" . htmlspecialchars($file_name) . "' upload error code: {$file_error}";
                continue;
            }
            
            if ($file_size <= 0) {
                $error_messages[] = "File '" . htmlspecialchars($file_name) . "' is empty.";
                continue;
            }
            
            $file_info = pathinfo($file_name);
            $ext = strtolower($file_info['extension'] ?? '');
            $allowed_types = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            
            if (!in_array($ext, $allowed_types)) {
                $error_messages[] = "File '" . htmlspecialchars($file_name) . "' has an invalid extension (.{$ext}).";
                continue;
            }
            
            // Verify it is a real image, not just a renamed file
            if (@getimagesize($file_tmp) === false) {
                $error_messages[] = "File '" . htmlspecialchars($file_name) . "' is not a valid image.";
                continue;
            }
            
            // Create unique file name
            $new_file_name = time() . '_' . mt_rand(1000, 9999) . '.' . $ext;
            $target_file = $target_dir . $new_file_name;
            
            if (move_uploaded_file($file_tmp, $target_file)) {
                $stmt->bind_param("s", $new_file_name);
                if ($stmt->execute()) {
                    $upload_count++;
                } else {
                    // Roll back the file so no orphan is left on disk
                    @unlink($target_file);
                    $error_messages[] = "Database insert failed for '" . htmlspecialchars($file_name) . "': " . htmlspecialchars($stmt->error);
                }
            } else {
                $error_messages[] = "Failed to move uploaded file '" . htmlspecialchars($file_name) . "' to target directory. Check folder write permissions.";
            }
        }
        $stmt->close();
        
        if ($upload_count > 0) {
            $msg = "<div class='alert alert-success'>Successfully uploaded {$upload_count} image(s)!</div>";
            if (!empty($error_messages)) {
                $msg .= "<div class='alert alert-warning'><strong>Some files skipped:</strong><br>" . implode("<br>", $error_messages) . "</div>";
            }
            $_SESSION['msg'] = $msg;
        } else {
            $err_details = implode("<br>", $error_messages);
            $_SESSION['msg'] = "<div class='alert alert-danger'><strong>Upload Failed:</strong><br>{$err_details}</div>";
        }
    } else {
        $_SESSION['msg'] = "<div class='alert alert-warning'>No images selected for upload.</div>";
    }
    
    header("Location: manage_gallery.php");
    exit();
}

// Handle Deletion
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $res = $conn->query("SELECT image_name FROM gallery WHERE id = $id");
    if ($res && $res->num_rows > 0) {
        $img = $res->fetch_assoc()['image_name'];
        if (!empty($img) && file_exists($target_dir . $img)) {
            @unlink($target_dir . $img);
        }
    }
    $conn->query("DELETE FROM gallery WHERE id = $id");
    $_SESSION['msg'] = "<div class='alert alert-success'>Image deleted successfully!</div>";
    header("Location: manage_gallery.php");
    exit();
}

// Fetch all gallery images
$gallery = $conn->query("SELECT * FROM gallery ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Gallery | Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .gallery-admin-img { width: 100px; height: 70px; object-fit: cover; border-radius: 6px; border: 1px solid #ddd; }
        .table th { background-color: #002B5E; color: white; }
        .btn-theme-primary { background-color: #3F9E13; border-color: #3F9E13; color: white; font-weight: 600; }
        .btn-theme-primary:hover { background-color: #358610; border-color: #358610; color: white; }
        .text-theme-green { color: #3F9E13; }
        .text-theme-navy { color: #002B5E; }
    </style>
</head>
<body class="bg-light">

<div class="container mt-5 mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-theme-navy"><i class="fa-solid fa-images text-theme-green"></i> Manage Clinic Gallery</h2>
        <button class="btn btn-theme-primary" data-bs-toggle="modal" data-bs-target="#addGalleryModal">
            <i class="fa-solid fa-plus me-1"></i> Add New Images
        </button>
    </div>

    <?php 
    if(isset($_SESSION['msg'])) { 
        echo $_SESSION['msg']; 
        unset($_SESSION['msg']); 
    } 
    ?>

    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body p-0 table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th width="5%" class="ps-4">#</th>
                        <th width="20%">Image Preview</th>
                        <th width="40%">File Name</th>
                        <th width="20%">Upload Date</th>
                        <th width="15%" class="text-center pe-4">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($gallery && $gallery->num_rows > 0): $i=1; while($row = $gallery->fetch_assoc()): ?>
                    <tr>
                        <td class="ps-4"><?= $i++; ?></td>
                        <td>
                            <img src="../uploads/gallery-images/<?= htmlspecialchars($row['image_name']); ?>" class="gallery-admin-img shadow-sm" alt="Gallery Image">
                        </td>
                        <td><small class="text-muted font-monospace"><?= htmlspecialchars($row['image_name']); ?></small></td>
                        <td><?= !empty($row['created_at']) ? date('d M, Y', strtotime($row['created_at'])) : '—'; ?></td>
                        <td class="text-center pe-4">
                            <a href="manage_gallery.php?delete=<?= (int)$row['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this image?');">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endwhile; else: ?>
                    <tr><td colspan="5" class="text-center text-muted py-5">No images in gallery yet. Click "Add New Images" to upload.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Multiple Images Modal -->
<div class="modal fade" id="addGalleryModal" tabindex="-1" aria-labelledby="addGalleryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form action="manage_gallery.php" method="POST" enctype="multipart/form-data" class="modal-content border-0 shadow">
            <div class="modal-header text-white" style="background-color: #002B5E;">
                <h5 class="modal-title" id="addGalleryModalLabel"><i class="fa-solid fa-cloud-arrow-up text-theme-green me-2"></i> Upload Gallery Images</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 text-center">
                <div class="mb-3">
                    <i class="fa-solid fa-images mb-3 text-theme-green" style="font-size: 48px;"></i>
                </div>
                <div class="mb-3 text-start">
                    <label class="form-label fw-bold text-theme-navy">Select Images <span class="text-danger">*</span></label>
                    <input type="file" name="images[]" class="form-control" accept="image/*" multiple required>
                    <small class="text-muted d-block mt-2">You can select multiple images at once (Hold Ctrl on Windows or Cmd on Mac).</small>
                </div>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" name="add_images" class="btn btn-theme-primary px-4">Upload Images</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>