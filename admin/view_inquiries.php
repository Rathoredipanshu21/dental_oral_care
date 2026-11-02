<?php
session_start();
if (!isset($_SESSION['admin'])) { header("Location: Login.php"); exit(); }
include '../config/db.php';

// Handle Delete
if(isset($_GET['del'])){
    $id = $_GET['del'];
    $conn->query("DELETE FROM contact_inquiries WHERE id = $id");
    header("Location: view_inquiries.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-7xl mx-auto bg-white p-10 rounded-[40px] shadow-sm">
        <h2 class="text-3xl font-black text-[#006837] mb-10 uppercase tracking-tighter"><i class="fa-solid fa-envelope-open-text mr-3"></i> Client Inquiries</h2>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left border-separate border-spacing-y-4">
                <thead>
                    <tr class="text-gray-400 text-xs font-black uppercase tracking-widest">
                        <th class="px-6">Client Info</th>
                        <th class="px-6">Subject / Message</th>
                        <th class="px-6">Received Date</th>
                        <th class="px-6 text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $res = $conn->query("SELECT * FROM contact_inquiries ORDER BY id DESC");
                    while($row = $res->fetch_assoc()):
                    ?>
                    <tr class="bg-gray-50 hover:bg-white hover:shadow-xl transition-all rounded-2xl group">
                        <td class="px-6 py-6 rounded-l-3xl">
                            <h4 class="font-bold text-[#001a0d]"><?php echo $row['name']; ?></h4>
                            <p class="text-xs text-gray-500"><?php echo $row['email']; ?></p>
                            <p class="text-xs font-bold text-[#F7931E]"><?php echo $row['phone']; ?></p>
                        </td>
                        <td class="px-6 py-6 max-w-md">
                            <span class="text-[10px] font-black bg-green-100 text-green-700 px-2 py-0.5 rounded uppercase"><?php echo $row['subject']; ?></span>
                            <p class="text-sm text-gray-600 mt-2 italic"><?php echo $row['message']; ?></p>
                        </td>
                        <td class="px-6 py-6 text-sm font-bold text-gray-400">
                            <?php echo date('d M, Y', strtotime($row['created_at'])); ?>
                        </td>
                        <td class="px-6 py-6 rounded-r-3xl text-center">
                            <a href="?del=<?php echo $row['id']; ?>" class="text-red-400 hover:text-red-600 transition" onclick="return confirm('Delete this message?')">
                                <i class="fa-solid fa-trash-can text-xl"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>