<?php
require_once '../config/db.php';

// Directory setup[cite: 9]
$upload_dir = '../uploads/hero-banner/';
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

// Handle Add Banner[cite: 9]
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_banner'])) {
    $subtitle = $_POST['subtitle'] ?? '';
    $title = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';
    $btn_name = $_POST['btn_name'] ?? '';
    $btn_link = $_POST['btn_link'] ?? '';
    $image_name = '';

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $file_extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $image_name = time() . '_' . uniqid() . '.' . $file_extension;
        $target_file = $upload_dir . $image_name;
        move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
    }

    $stmt = $conn->prepare("INSERT INTO hero_banners (subtitle, title, description, btn_name, btn_link, image) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $subtitle, $title, $description, $btn_name, $btn_link, $image_name);
    $stmt->execute();
    $stmt->close();

    header("Location: manage_hero.php?success=1");
    exit();
}

// Handle Edit Banner
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_banner'])) {
    $id = $_POST['id'];
    $subtitle = $_POST['subtitle'] ?? '';
    $title = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';
    $btn_name = $_POST['btn_name'] ?? '';
    $btn_link = $_POST['btn_link'] ?? '';

    // Check if a new image was uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $file_extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $image_name = time() . '_' . uniqid() . '.' . $file_extension;
        $target_file = $upload_dir . $image_name;
        move_uploaded_file($_FILES['image']['tmp_name'], $target_file);

        // Fetch old image to delete it from server
        $stmt = $conn->prepare("SELECT image FROM hero_banners WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result();
        if ($row = $res->fetch_assoc()) {
            $old_file = $upload_dir . $row['image'];
            if (file_exists($old_file) && !is_dir($old_file)) {
                unlink($old_file);
            }
        }
        $stmt->close();

        $stmt = $conn->prepare("UPDATE hero_banners SET subtitle=?, title=?, description=?, btn_name=?, btn_link=?, image=? WHERE id=?");
        $stmt->bind_param("ssssssi", $subtitle, $title, $description, $btn_name, $btn_link, $image_name, $id);
    } else {
        // Update without changing the image
        $stmt = $conn->prepare("UPDATE hero_banners SET subtitle=?, title=?, description=?, btn_name=?, btn_link=? WHERE id=?");
        $stmt->bind_param("sssssi", $subtitle, $title, $description, $btn_name, $btn_link, $id);
    }
    
    $stmt->execute();
    $stmt->close();

    header("Location: manage_hero.php?updated=1");
    exit();
}

// Handle Delete Banner
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_banner'])) {
    $id = $_POST['id'];

    // Fetch image name to delete file from server
    $stmt = $conn->prepare("SELECT image FROM hero_banners WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $res = $stmt->get_result();
    if ($row = $res->fetch_assoc()) {
        $file = $upload_dir . $row['image'];
        if (file_exists($file) && !is_dir($file)) {
            unlink($file);
        }
    }
    $stmt->close();

    // Delete record from database
    $stmt = $conn->prepare("DELETE FROM hero_banners WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    header("Location: manage_hero.php?deleted=1");
    exit();
}

// Fetch DB Data for Display[cite: 9]
$query = $conn->query("SELECT * FROM hero_banners ORDER BY id DESC");
$banners = $query->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Hero Banners | Oral Care</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            /* Updated to Oral Care Dental Clinic branding[cite: 9] */
            --primary: #004289; 
            --accent: #3F9E13;  
            --bg: #f8f9fa;
            --text: #374151;
            --border: #e5e7eb;
            --danger: #dc3545;
            --warning: #ffc107;
        }
        body { margin: 0; font-family: 'Montserrat', sans-serif; background: var(--bg); color: var(--text); }
        .header { background: var(--primary); color: #fff; padding: 15px 5%; display: flex; justify-content: space-between; align-items: center; border-bottom: 4px solid var(--accent); }
        .header h2 { margin: 0; font-size: 18px; font-weight: 600; }
        .btn-add { background: var(--accent); color: #fff; border: none; padding: 10px 20px; font-size: 14px; font-weight: 600; cursor: pointer; border-radius: 4px; display: flex; gap: 8px; align-items: center; transition: background 0.3s; }
        .btn-add:hover { background: #2e750e; }
        .container { padding: 30px 5%; }
        
        .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 20px; }
        .card { background: #fff; border: 1px solid var(--border); border-radius: 6px; overflow: hidden; box-shadow: 0 2px 4px rgba(0,0,0,0.05); display: flex; flex-direction: column; }
        .card img { width: 100%; height: 180px; object-fit: cover; }
        .card-body { padding: 15px; flex-grow: 1; display: flex; flex-direction: column; }
        .card-subtitle { color: var(--accent); font-size: 11px; font-weight: 700; text-transform: uppercase; margin-bottom: 5px; display: block; letter-spacing: 1px; }
        .card-title { font-size: 18px; font-weight: 700; color: var(--primary); margin: 0 0 10px 0; }
        .card-desc { font-size: 13px; color: #666; margin-bottom: 15px; line-height: 1.5; flex-grow: 1; }
        .card-btn { display: inline-block; font-size: 11px; background: var(--primary); padding: 6px 12px; border-radius: 4px; color: #fff; font-weight: 600; align-self: flex-start; margin-bottom: 15px; }

        .card-actions { display: flex; gap: 10px; border-top: 1px solid var(--border); padding-top: 15px; margin-top: auto; }
        .btn-action { flex: 1; border: none; padding: 8px; border-radius: 4px; font-size: 12px; font-weight: 600; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 5px; transition: opacity 0.2s; color: #fff; }
        .btn-action:hover { opacity: 0.9; }
        .btn-edit { background: var(--warning); color: #000; }
        .btn-delete { background: var(--danger); }

        .modal-overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,43,94,0.7); display: flex; justify-content: center; align-items: center; opacity: 0; visibility: hidden; transition: 0.3s; z-index: 1000; padding: 20px; box-sizing: border-box; backdrop-filter: blur(4px); }
        .modal-overlay.active { opacity: 1; visibility: visible; }
        .modal-content { background: #fff; width: 100%; max-width: 600px; padding: 25px; border-radius: 8px; position: relative; box-shadow: 0 10px 25px rgba(0,0,0,0.2); max-height: 90vh; overflow-y: auto; }
        .modal-header { display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid var(--border); padding-bottom: 15px; margin-bottom: 20px; }
        .modal-header h3 { margin: 0; color: var(--primary); font-weight: 700; }
        .close-btn { cursor: pointer; font-size: 20px; color: #888; transition: color 0.3s; }
        .close-btn:hover { color: #f44336; }
        
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; font-size: 13px; font-weight: 600; margin-bottom: 6px; color: var(--primary); }
        .form-group input, .form-group textarea { width: 100%; padding: 10px; border: 1px solid var(--border); border-radius: 4px; box-sizing: border-box; font-family: inherit; font-size: 14px; transition: border-color 0.3s; }
        .form-group input:focus, .form-group textarea:focus { outline: none; border-color: var(--accent); }
        .btn-submit { background: var(--accent); color: #fff; border: none; padding: 12px; width: 100%; font-size: 15px; font-weight: 600; cursor: pointer; border-radius: 4px; margin-top: 10px; transition: background 0.3s; }
        .btn-submit:hover { background: #2e750e; }
        .optional { font-size: 11px; color: #999; font-weight: normal; }
    </style>
</head>
<body>

    <div class="header">
        <h2><i class="fa-solid fa-images"></i> Manage Hero Banners</h2>
        <button class="btn-add" onclick="document.getElementById('addModal').classList.add('active')">
            <i class="fa-solid fa-plus"></i> Add New Banner
        </button>
    </div>

    <div class="container">
        <div class="grid">
            <?php foreach($banners as $banner): ?>
            <div class="card">
                <img src="../uploads/hero-banner/<?= htmlspecialchars($banner['image']) ?>" alt="Banner">
                <div class="card-body">
                    <span class="card-subtitle"><?= htmlspecialchars($banner['subtitle']) ?></span>
                    <h3 class="card-title"><?= nl2br(htmlspecialchars($banner['title'])) ?></h3>
                    <p class="card-desc"><?= htmlspecialchars($banner['description']) ?></p>
                    
                    <?php if(!empty($banner['btn_name'])): ?>
                        <div class="card-btn"><?= htmlspecialchars($banner['btn_name']) ?> (<?= htmlspecialchars($banner['btn_link']) ?>)</div>
                    <?php endif; ?>

                    <div class="card-actions">
                        <!-- Edit Button triggering JS function -->
                        <button class="btn-action btn-edit" onclick="openEditModal(
                            <?= $banner['id'] ?>, 
                            '<?= htmlspecialchars(addslashes($banner['subtitle'])) ?>', 
                            '<?= htmlspecialchars(addslashes($banner['title'])) ?>', 
                            '<?= htmlspecialchars(addslashes($banner['description'])) ?>', 
                            '<?= htmlspecialchars(addslashes($banner['btn_name'])) ?>', 
                            '<?= htmlspecialchars(addslashes($banner['btn_link'])) ?>'
                        )">
                            <i class="fa-solid fa-pen-to-square"></i> Edit
                        </button>
                        
                        <!-- Delete Form -->
                        <form method="POST" onsubmit="return confirm('Are you sure you want to delete this banner? This action cannot be undone.');" style="flex:1; display:flex;">
                            <input type="hidden" name="id" value="<?= $banner['id'] ?>">
                            <button type="submit" name="delete_banner" class="btn-action btn-delete">
                                <i class="fa-solid fa-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            
            <?php if(empty($banners)): ?>
                <p>No banners added yet.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Add Modal[cite: 9] -->
    <div class="modal-overlay" id="addModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Create Hero Banner</h3>
                <i class="fa-solid fa-xmark close-btn" onclick="document.getElementById('addModal').classList.remove('active')"></i>
            </div>
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Subtitle / Slogan</label>
                    <input type="text" name="subtitle" placeholder="e.g. Your Smile, Our Priority" required>
                </div>
                <div class="form-group">
                    <label>Main Heading</label>
                    <input type="text" name="title" placeholder="e.g. Advanced Dental Care for Your Family" required>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" rows="3" placeholder="Enter brief description about the clinic or offer..." required></textarea>
                </div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                    <div class="form-group">
                        <label>Button Name <span class="optional">(Optional)</span></label>
                        <input type="text" name="btn_name" placeholder="e.g. Book Appointment">
                    </div>
                    <div class="form-group">
                        <label>Button Link <span class="optional">(Optional)</span></label>
                        <input type="text" name="btn_link" placeholder="e.g. appointment.php">
                    </div>
                </div>
                <div class="form-group">
                    <label>Background Image</label>
                    <input type="file" name="image" accept="image/*" required>
                </div>
                <button type="submit" name="add_banner" class="btn-submit">Save Banner</button>
            </form>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal-overlay" id="editModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Edit Hero Banner</h3>
                <i class="fa-solid fa-xmark close-btn" onclick="document.getElementById('editModal').classList.remove('active')"></i>
            </div>
            <form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" id="edit_id">
                
                <div class="form-group">
                    <label>Subtitle / Slogan</label>
                    <input type="text" name="subtitle" id="edit_subtitle" required>
                </div>
                <div class="form-group">
                    <label>Main Heading</label>
                    <input type="text" name="title" id="edit_title" required>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" id="edit_description" rows="3" required></textarea>
                </div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                    <div class="form-group">
                        <label>Button Name <span class="optional">(Optional)</span></label>
                        <input type="text" name="btn_name" id="edit_btn_name">
                    </div>
                    <div class="form-group">
                        <label>Button Link <span class="optional">(Optional)</span></label>
                        <input type="text" name="btn_link" id="edit_btn_link">
                    </div>
                </div>
                <div class="form-group">
                    <label>Replace Background Image <span class="optional">(Leave blank to keep current)</span></label>
                    <input type="file" name="image" accept="image/*">
                </div>
                <button type="submit" name="edit_banner" class="btn-submit" style="background: var(--primary);">Update Banner</button>
            </form>
        </div>
    </div>

    <script>
        // Function to populate and open the Edit Modal
        function openEditModal(id, subtitle, title, description, btn_name, btn_link) {
            document.getElementById('edit_id').value = id;
            document.getElementById('edit_subtitle').value = subtitle;
            document.getElementById('edit_title').value = title;
            document.getElementById('edit_description').value = description;
            document.getElementById('edit_btn_name').value = btn_name;
            document.getElementById('edit_btn_link').value = btn_link;
            
            document.getElementById('editModal').classList.add('active');
        }
    </script>
</body>
</html>