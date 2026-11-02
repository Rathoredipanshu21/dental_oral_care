<?php
require_once '../config/db.php';

// Handle Form Submission for New Service
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_service'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $short_desc = mysqli_real_escape_string($conn, $_POST['short_desc']);
    $long_desc = mysqli_real_escape_string($conn, $_POST['long_desc']);
    $speciality = mysqli_real_escape_string($conn, $_POST['speciality']);
    $sub_services = mysqli_real_escape_string($conn, $_POST['sub_services']);
    
    // Multiple Image Upload Logic
    $uploaded_images = [];
    if (!empty($_FILES['images']['name'][0])) {
        $upload_dir = '../uploads/services/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        
        foreach ($_FILES['images']['name'] as $key => $image_name) {
            $tmp_name = $_FILES['images']['tmp_name'][$key];
            $new_name = time() . '_' . preg_replace("/[^a-zA-Z0-9.]/", "", basename($image_name));
            if (move_uploaded_file($tmp_name, $upload_dir . $new_name)) {
                $uploaded_images[] = $new_name;
            }
        }
    }
    
    // Save images as comma-separated string
    $images_str = implode(',', $uploaded_images);
    $query = "INSERT INTO services (name, short_desc, long_desc, speciality, sub_services, images) 
              VALUES ('$name', '$short_desc', '$long_desc', '$speciality', '$sub_services', '$images_str')";
    
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Service Added Successfully!'); window.location.href='manage_services.php';</script>";
    } else {
        echo "<script>alert('Error adding service.');</script>";
    }
}

// Handle Form Submission for Edit Service
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_service'])) {
    $id = (int)$_POST['service_id'];
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $short_desc = mysqli_real_escape_string($conn, $_POST['short_desc']);
    $long_desc = mysqli_real_escape_string($conn, $_POST['long_desc']);
    $speciality = mysqli_real_escape_string($conn, $_POST['speciality']);
    $sub_services = mysqli_real_escape_string($conn, $_POST['sub_services']);
    $existing_images = mysqli_real_escape_string($conn, $_POST['existing_images']);
    
    $uploaded_images = [];
    if (!empty($_FILES['images']['name'][0])) {
        $upload_dir = '../uploads/services/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        
        foreach ($_FILES['images']['name'] as $key => $image_name) {
            $tmp_name = $_FILES['images']['tmp_name'][$key];
            $new_name = time() . '_' . preg_replace("/[^a-zA-Z0-9.]/", "", basename($image_name));
            if (move_uploaded_file($tmp_name, $upload_dir . $new_name)) {
                $uploaded_images[] = $new_name;
            }
        }
    }
    
    // Append new images to existing ones, or keep old ones if none uploaded
    $final_images = $existing_images;
    if (!empty($uploaded_images)) {
        $new_images_str = implode(',', $uploaded_images);
        $final_images = empty($existing_images) ? $new_images_str : $existing_images . ',' . $new_images_str;
    }

    $query = "UPDATE services SET name='$name', short_desc='$short_desc', long_desc='$long_desc', 
              speciality='$speciality', sub_services='$sub_services', images='$final_images' WHERE id=$id";
    
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Service Updated Successfully!'); window.location.href='manage_services.php';</script>";
    } else {
        echo "<script>alert('Error updating service.');</script>";
    }
}

// Handle Service Deletion
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_service'])) {
    $id = (int)$_POST['delete_id'];
    $query = "DELETE FROM services WHERE id=$id";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Service Deleted Successfully!'); window.location.href='manage_services.php';</script>";
    } else {
        echo "<script>alert('Error deleting service.');</script>";
    }
}

// Fetch all services
$fetch_query = "SELECT * FROM services ORDER BY id DESC";
$result = mysqli_query($conn, $fetch_query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Services</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <style>
        .modal { display: none; }
        .modal.active { display: flex; }
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: #f1f5f9; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
        
        /* Table Swiper Box Styling */
        .admin-card-swiper { width: 120px; height: 80px; border-radius: 6px; overflow: hidden; }
    </style>
</head>
<body class="bg-gray-50 p-6 font-sans">

    <div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-sm border border-gray-200">
        
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800"><i class="fa-solid fa-tooth text-[#3F9E13] mr-2"></i> Manage Services</h2>
            <button onclick="toggleModal('addServiceModal')" class="bg-[#002B5E] hover:bg-[#3F9E13] text-white px-5 py-2.5 rounded-md font-semibold transition-colors duration-300 shadow-md">
                <i class="fa-solid fa-plus mr-2"></i> Add New Service
            </button>
        </div>

        <!-- Services Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-100 text-gray-700">
                        <th class="p-3 border-b">ID</th>
                        <th class="p-3 border-b">Images Box</th>
                        <th class="p-3 border-b">Service Name</th>
                        <th class="p-3 border-b">Speciality</th>
                        <th class="p-3 border-b">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($result) > 0): ?>
                        <?php while ($row = mysqli_fetch_assoc($result)): 
                            $images_array = !empty($row['images']) ? explode(',', $row['images']) : [];
                        ?>
                        <tr class="hover:bg-gray-50 border-b transition-colors">
                            <td class="p-3 font-medium text-gray-600">#<?= $row['id'] ?></td>
                            <td class="p-3">
                                <!-- Image Carousel Box in Admin Panel -->
                                <div class="swiper admin-card-swiper border border-gray-200 shadow-sm relative bg-gray-100">
                                    <div class="swiper-wrapper">
                                        <?php if (!empty($images_array) && !empty($images_array[0])): ?>
                                            <?php foreach ($images_array as $img): ?>
                                                <div class="swiper-slide flex items-center justify-center">
                                                    <img src="../uploads/services/<?= htmlspecialchars(trim($img)) ?>" alt="Service" class="w-full h-full object-cover">
                                                </div>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <div class="swiper-slide flex items-center justify-center">
                                                <img src="https://via.placeholder.com/120x80?text=No+Image" alt="No Image" class="w-full h-full object-cover">
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="swiper-pagination"></div>
                                </div>
                            </td>
                            <td class="p-3 font-bold text-[#002B5E]"><?= htmlspecialchars($row['name']) ?></td>
                            <td class="p-3 text-gray-600"><?= htmlspecialchars($row['speciality']) ?></td>
                            <td class="p-3 flex gap-3 items-center">
                                <!-- Edit Button -->
                                <button onclick="openEditModal(
                                    '<?= $row['id'] ?>', 
                                    '<?= htmlspecialchars(addslashes($row['name'])) ?>', 
                                    '<?= htmlspecialchars(addslashes($row['speciality'])) ?>', 
                                    '<?= htmlspecialchars(addslashes($row['short_desc'])) ?>', 
                                    '<?= htmlspecialchars(addslashes($row['long_desc'])) ?>', 
                                    '<?= htmlspecialchars(addslashes($row['sub_services'])) ?>', 
                                    '<?= htmlspecialchars(addslashes($row['images'])) ?>'
                                )" class="text-blue-500 hover:text-blue-700 transition-colors"><i class="fa-solid fa-pen-to-square"></i></button>
                                
                                <!-- Delete Button -->
                                <form method="POST" onsubmit="return confirm('Are you sure you want to delete this service?');" class="inline m-0 p-0">
                                    <input type="hidden" name="delete_id" value="<?= $row['id'] ?>">
                                    <button type="submit" name="delete_service" class="text-red-500 hover:text-red-700 transition-colors"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr><td colspan="5" class="p-5 text-center text-gray-500">No services found. Add one!</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add Service Modal -->
    <div id="addServiceModal" class="modal fixed inset-0 bg-black/60 z-50 p-4 md:p-8 items-center justify-center">
        <div class="bg-white rounded-lg shadow-2xl w-full max-w-3xl relative flex flex-col max-h-[90vh] overflow-hidden">
            <div class="flex justify-between items-center p-5 border-b bg-gray-50 shrink-0">
                <h3 class="text-xl font-bold text-[#002B5E]">Add New Service</h3>
                <button onclick="toggleModal('addServiceModal')" class="text-gray-400 hover:text-red-500 text-3xl leading-none transition-colors">&times;</button>
            </div>
            
            <form action="" method="POST" enctype="multipart/form-data" class="flex flex-col flex-grow overflow-hidden">
                <div class="p-6 overflow-y-auto custom-scrollbar flex-grow bg-white">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Service Name *</label>
                            <input type="text" name="name" required class="w-full border p-2.5 rounded focus:outline-none focus:border-[#3F9E13] focus:ring-1 focus:ring-[#3F9E13] transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Speciality / Category</label>
                            <input type="text" name="speciality" placeholder="e.g. Cosmetic Dentistry" class="w-full border p-2.5 rounded focus:outline-none focus:border-[#3F9E13] focus:ring-1 focus:ring-[#3F9E13] transition-all">
                        </div>
                    </div>

                    <div class="mb-5">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Short Description (Max 150 chars) *</label>
                        <textarea name="short_desc" maxlength="150" required rows="2" class="w-full border p-2.5 rounded focus:outline-none focus:border-[#3F9E13] focus:ring-1 focus:ring-[#3F9E13] transition-all"></textarea>
                    </div>

                    <div class="mb-5">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Detailed Description *</label>
                        <textarea name="long_desc" required rows="4" class="w-full border p-2.5 rounded focus:outline-none focus:border-[#3F9E13] focus:ring-1 focus:ring-[#3F9E13] transition-all"></textarea>
                    </div>

                    <div class="mb-5">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Sub-Services (Comma Separated)</label>
                        <input type="text" name="sub_services" placeholder="e.g. Teeth Whitening, Veneers, Bonding" class="w-full border p-2.5 rounded focus:outline-none focus:border-[#3F9E13] focus:ring-1 focus:ring-[#3F9E13] transition-all">
                    </div>

                    <div class="mb-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Upload Multiple Images *</label>
                        <input type="file" name="images[]" multiple required accept="image/*" class="w-full border border-gray-300 p-2 rounded file:mr-4 file:py-2 file:px-4 file:border-0 file:text-sm file:font-semibold file:bg-[#002B5E] file:text-white hover:file:bg-[#3F9E13] file:transition-colors file:cursor-pointer bg-gray-50 cursor-pointer">
                        <p class="text-xs text-gray-500 mt-2">You can select multiple images at once.</p>
                    </div>
                </div>

                <div class="flex justify-end gap-3 p-4 border-t bg-gray-50 shrink-0">
                    <button type="button" onclick="toggleModal('addServiceModal')" class="px-5 py-2.5 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded font-semibold transition-colors">Cancel</button>
                    <button type="submit" name="add_service" class="px-5 py-2.5 bg-[#3F9E13] hover:bg-[#002B5E] text-white rounded font-semibold transition-colors shadow-md">Save Service</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Service Modal -->
    <div id="editServiceModal" class="modal fixed inset-0 bg-black/60 z-50 p-4 md:p-8 items-center justify-center">
        <div class="bg-white rounded-lg shadow-2xl w-full max-w-3xl relative flex flex-col max-h-[90vh] overflow-hidden">
            <div class="flex justify-between items-center p-5 border-b bg-gray-50 shrink-0">
                <h3 class="text-xl font-bold text-[#002B5E]">Edit Service</h3>
                <button onclick="toggleModal('editServiceModal')" class="text-gray-400 hover:text-red-500 text-3xl leading-none transition-colors">&times;</button>
            </div>
            
            <form action="" method="POST" enctype="multipart/form-data" class="flex flex-col flex-grow overflow-hidden">
                <div class="p-6 overflow-y-auto custom-scrollbar flex-grow bg-white">
                    <input type="hidden" name="service_id" id="edit_id">
                    <input type="hidden" name="existing_images" id="edit_existing_images">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Service Name *</label>
                            <input type="text" name="name" id="edit_name" required class="w-full border p-2.5 rounded focus:outline-none focus:border-[#3F9E13] focus:ring-1 focus:ring-[#3F9E13] transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Speciality / Category</label>
                            <input type="text" name="speciality" id="edit_speciality" class="w-full border p-2.5 rounded focus:outline-none focus:border-[#3F9E13] focus:ring-1 focus:ring-[#3F9E13] transition-all">
                        </div>
                    </div>

                    <div class="mb-5">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Short Description (Max 150 chars) *</label>
                        <textarea name="short_desc" id="edit_short_desc" maxlength="150" required rows="2" class="w-full border p-2.5 rounded focus:outline-none focus:border-[#3F9E13] focus:ring-1 focus:ring-[#3F9E13] transition-all"></textarea>
                    </div>

                    <div class="mb-5">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Detailed Description *</label>
                        <textarea name="long_desc" id="edit_long_desc" required rows="4" class="w-full border p-2.5 rounded focus:outline-none focus:border-[#3F9E13] focus:ring-1 focus:ring-[#3F9E13] transition-all"></textarea>
                    </div>

                    <div class="mb-5">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Sub-Services (Comma Separated)</label>
                        <input type="text" name="sub_services" id="edit_sub_services" class="w-full border p-2.5 rounded focus:outline-none focus:border-[#3F9E13] focus:ring-1 focus:ring-[#3F9E13] transition-all">
                    </div>

                    <div class="mb-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Upload New Images (Optional)</label>
                        <input type="file" name="images[]" multiple accept="image/*" class="w-full border border-gray-300 p-2 rounded file:mr-4 file:py-2 file:px-4 file:border-0 file:text-sm file:font-semibold file:bg-[#002B5E] file:text-white hover:file:bg-[#3F9E13] file:transition-colors file:cursor-pointer bg-gray-50 cursor-pointer">
                        <p class="text-xs text-gray-500 mt-2">Uploading new images will add them alongside existing ones. Leave empty to keep current images.</p>
                    </div>
                </div>

                <div class="flex justify-end gap-3 p-4 border-t bg-gray-50 shrink-0">
                    <button type="button" onclick="toggleModal('editServiceModal')" class="px-5 py-2.5 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded font-semibold transition-colors">Cancel</button>
                    <button type="submit" name="edit_service" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded font-semibold transition-colors shadow-md">Update Service</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script>
        function toggleModal(modalID) {
            document.getElementById(modalID).classList.toggle('active');
        }

        function openEditModal(id, name, speciality, shortDesc, longDesc, subServices, images) {
            document.getElementById('edit_id').value = id;
            document.getElementById('edit_name').value = name;
            document.getElementById('edit_speciality').value = speciality;
            document.getElementById('edit_short_desc').value = shortDesc;
            document.getElementById('edit_long_desc').value = longDesc;
            document.getElementById('edit_sub_services').value = subServices;
            document.getElementById('edit_existing_images').value = images;
            
            toggleModal('editServiceModal');
        }

        // Initialize admin table swipers
        document.addEventListener("DOMContentLoaded", function() {
            const adminSwipers = document.querySelectorAll('.admin-card-swiper');
            adminSwipers.forEach(swiperEl => {
                new Swiper(swiperEl, {
                    loop: true,
                    autoplay: {
                        delay: 2500,
                        disableOnInteraction: false,
                    },
                    pagination: {
                        el: swiperEl.querySelector('.swiper-pagination'),
                        clickable: true,
                    }
                });
            });
        });
    </script>
</body>
</html>