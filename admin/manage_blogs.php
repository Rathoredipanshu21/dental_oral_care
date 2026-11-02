<?php
session_start();
include '../config/db.php'; 

// Ensure upload directory exists
$target_dir = "../uploads/blogs-images/";
if (!is_dir($target_dir)) {
    mkdir($target_dir, 0777, true);
}

// Handle Add Blog Form Submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_blog'])) {
    $title =$conn->real_escape_string(trim($_POST['title']));$content = $conn->real_escape_string(trim($_POST['content']));
    
    // Handle Image Upload
    $image_name = '';
    if (isset($_FILES['image']) &&$_FILES['image']['error'] == 0) {
        $file_info = pathinfo($_FILES['image']['name']);
        $ext = strtolower($file_info['extension']);
        // Sanitize and make unique filename
        $image_name = time() . '_' . preg_replace("/[^a-zA-Z0-9]/", "", $file_info['filename']) . '.' .$ext;
        $target_file = $target_dir .$image_name;
        
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        if (in_array($ext,$allowed_types)) {
            move_uploaded_file($_FILES['image']['tmp_name'],$target_file);
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Invalid image format.</div>";
            header("Location: manage_blogs.php");
            exit();
        }
    }

    $insert_query = "INSERT INTO `blogs` (`title`, `content`, `image`) VALUES (?, ?, ?)";
    if ($stmt = $conn->prepare($insert_query)) {
        $stmt->bind_param("sss", $title, $content,$image_name);
        if ($stmt->execute()) {$_SESSION['msg'] = "<div class='alert alert-success'>Blog added successfully!</div>";
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Database error.</div>";
        }
        $stmt->close();
    }
    header("Location: manage_blogs.php");
    exit();
}

// Handle Deletion
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    // Fetch image to delete from server
    $res =$conn->query("SELECT image FROM blogs WHERE id = $id");
    if ($res &&$res->num_rows > 0) {
        $img =$res->fetch_assoc()['image'];
        if (!empty($img) && file_exists($target_dir .$img)) {
            unlink($target_dir .$img);
        }
    }
    $conn->query("DELETE FROM blogs WHERE id = $id");
    $_SESSION['msg'] = "<div class='alert alert-success'>Blog deleted successfully!</div>";
    header("Location: manage_blogs.php");
    exit();
}

// Fetch all blogs
$blogs =$conn->query("SELECT * FROM blogs ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Blogs | Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .table img { width: 80px; height: 50px; object-fit: cover; border-radius: 4px; }
        .table th { background-color: #093564; color: white; }
    </style>
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 style="color: #093564;"><i class="fa-solid fa-blog text-warning"></i> Manage Blogs</h2>
        <button class="btn btn-primary" style="background-color: #f6a715; border-color: #f6a715; color: #052140; font-weight: 700;" data-bs-toggle="modal" data-bs-target="#addBlogModal">
            <i class="fa-solid fa-plus"></i> Add New Blog
        </button>
    </div>

    <?php 
    if(isset($_SESSION['msg'])) { 
        echo $_SESSION['msg']; 
        unset($_SESSION['msg']); 
    } 
    ?>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0 table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Date Published</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($blogs->num_rows > 0):$i=1; while($row =$blogs->fetch_assoc()): ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td>
                            <?php if(!empty($row['image'])): ?>
                                <img src="../uploads/blogs-images/<?= htmlspecialchars($row['image']); ?>" alt="Blog Image">
                            <?php else: ?>
                                <span class="badge bg-secondary">No Image</span>
                            <?php endif; ?>
                        </td>
                        <td><strong><?= htmlspecialchars($row['title']); ?></strong></td>
                        <td><?= date('d M, Y', strtotime($row['created_at'])); ?></td>
                        <td class="text-center">
                            <a href="manage_blogs.php?delete=<?= $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this blog?');">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endwhile; else: ?>
                    <tr><td colspan="5" class="text-center text-muted py-4">No blogs found. Add one to get started!</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Blog Modal (Centered) -->
<div class="modal fade" id="addBlogModal" tabindex="-1" aria-labelledby="addBlogModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <form action="manage_blogs.php" method="POST" enctype="multipart/form-data" class="modal-content">
            <div class="modal-header text-white" style="background-color: #093564;">
                <h5 class="modal-title" id="addBlogModalLabel"><i class="fa-solid fa-pen-nib text-warning"></i> Add New Blog</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label fw-bold">Blog Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control" placeholder="Enter an engaging title" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Blog Featured Image <span class="text-danger">*</span></label>
                    <input type="file" name="image" class="form-control" accept="image/*" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Blog Content <span class="text-danger">*</span></label>
                    <textarea name="content" class="form-control" rows="8" placeholder="Write your blog content here..." required></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" name="add_blog" class="btn" style="background-color: #093564; color: white;">Publish Blog</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>