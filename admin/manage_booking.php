<?php
// admin/manage_appointments.php
session_start();
require_once '../config/db.php';

// Handle Status Updates
if (isset($_GET['update_status']) && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $status = trim($_GET['update_status']);
    $stmt = $conn->prepare("UPDATE appointments SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $id);
    $stmt->execute();
    $stmt->close();
    $_SESSION['msg'] = "<div class='alert alert-success'>Appointment status updated successfully!</div>";
    header("Location: manage_appointments.php");
    exit();
}

// Handle Deletion
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $stmt = $conn->prepare("DELETE FROM appointments WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    $_SESSION['msg'] = "<div class='alert alert-success'>Appointment deleted successfully!</div>";
    header("Location: manage_appointments.php");
    exit();
}

// Fetch all appointments
$appointments = $conn->query("SELECT * FROM appointments ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Appointments | Admin Dashboard</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f8fafc;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
        }
        .table th {
            background-color: #002B5E;
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.5px;
        }
        .badge-pending { background-color: #f59e0b; color: #fff; }
        .badge-confirmed { background-color: #3b82f6; color: #fff; }
        .badge-completed { background-color: #3F9E13; color: #fff; }
        .badge-cancelled { background-color: #ef4444; color: #fff; }
        .card {
            border-radius: 16px;
            border: 1px solid rgba(0,0,0,0.05);
            box-shadow: 0 4px 15px rgba(0,0,0,0.03);
        }
    </style>
</head>
<body>

<div class="container-fluid py-5 px-4">
    <!-- Top Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1" style="color: #002B5E;"><i class="fa-solid fa-calendar-check text-[#3F9E13] me-2" style="color: #3F9E13;"></i> Patient Appointments</h2>
            <p class="text-muted small mb-0">View, manage, and track all patient booking schedules across clinic branches.</p>
        </div>
        <a href="dashboard.php" class="btn btn-outline-secondary btn-sm px-3">
            <i class="fa-solid fa-arrow-left me-1"></i> Back to Dashboard
        </a>
    </div>

    <!-- Notification Alert -->
    <?php 
    if(isset($_SESSION['msg'])) { 
        echo $_SESSION['msg']; 
        unset($_SESSION['msg']); 
    } 
    ?>

    <!-- Appointments Table Card -->
    <div class="card bg-white">
        <div class="card-body p-0 table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">#ID</th>
                        <th>Patient Details</th>
                        <th>Branch</th>
                        <th>Date & Time Slot</th>
                        <th>Concern / Message</th>
                        <th>Status</th>
                        <th class="text-center pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($appointments && $appointments->num_rows > 0): $i=1; while($row = $appointments->fetch_assoc()): ?>
                    <tr>
                        <td class="ps-4 fw-bold text-muted">#<?= $row['id']; ?></td>
                        <td>
                            <div class="fw-bold text-[#002B5E]"><?= htmlspecialchars($row['patient_name']); ?></div>
                            <small class="text-muted"><i class="fa-solid fa-phone me-1"></i><?= htmlspecialchars($row['patient_phone']); ?></small><br>
                            <?php if(!empty($row['patient_email'])): ?>
                                <small class="text-muted"><i class="fa-solid fa-envelope me-1"></i><?= htmlspecialchars($row['patient_email']); ?></small>
                            <?php endif; ?>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark border"><?= htmlspecialchars($row['branch_name']); ?></span>
                        </td>
                        <td>
                            <div class="fw-semibold text-dark"><i class="fa-solid fa-calendar-day text-primary me-1"></i> <?= date('d M, Y', strtotime($row['appointment_date'])); ?></div>
                            <div class="text-success fw-bold small"><i class="fa-solid fa-clock me-1"></i> <?= htmlspecialchars($row['appointment_time']); ?></div>
                        </td>
                        <td>
                            <span class="text-muted small" style="max-width: 200px; display: inline-block; white-space: normal;"><?= !empty($row['dental_concern']) ? htmlspecialchars($row['dental_concern']) : '<em>No specific concern</em>'; ?></span>
                        </td>
                        <td>
                            <?php 
                                $status = $row['status'] ?? 'Pending';
                                $badgeClass = 'badge-pending';
                                if($status == 'Confirmed') $badgeClass = 'badge-confirmed';
                                if($status == 'Completed') $badgeClass = 'badge-completed';
                                if($status == 'Cancelled') $badgeClass = 'badge-cancelled';
                            ?>
                            <span class="badge <?= $badgeClass ?> px-2.5 py-1.5"><?= $status; ?></span>
                        </td>
                        <td class="text-center pe-4">
                            <div class="dropdown">
                                <button class="btn btn-sm btn-light border dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Action
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                                    <li><h6 class="dropdown-header">Update Status</h6></li>
                                    <li><a class="dropdown-item text-primary" href="manage_appointments.php?id=<?= $row['id']; ?>&update_status=Confirmed"><i class="fa-solid fa-check me-2"></i> Confirm</a></li>
                                    <li><a class="dropdown-item text-success" href="manage_appointments.php?id=<?= $row['id']; ?>&update_status=Completed"><i class="fa-solid fa-circle-check me-2"></i> Complete</a></li>
                                    <li><a class="dropdown-item text-warning" href="manage_appointments.php?id=<?= $row['id']; ?>&update_status=Cancelled"><i class="fa-solid fa-ban me-2"></i> Cancel</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item text-danger" href="manage_appointments.php?delete=<?= $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this appointment booking?');"><i class="fa-solid fa-trash me-2"></i> Delete</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <?php endwhile; else: ?>
                    <tr><td colspan="7" class="text-center text-muted py-5">No appointment bookings found yet.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>