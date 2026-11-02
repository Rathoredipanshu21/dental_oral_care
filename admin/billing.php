<?php
session_start();
require_once '../config/db.php';

// Quick Add Client AJAX Handler
if (isset($_GET['ajax']) && $_GET['ajax'] == 'add_client' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $c_type = $_POST['client_type'] ?? 'Business';
    $c_name = $_POST['company_name'] ?? '';
    $c_person = $_POST['contact_person'] ?? '';
    $c_contact = $_POST['contact_number'] ?? '';
    $c_alt = $_POST['alt_contact_number'] ?? '';
    $c_gst = $_POST['gst_no'] ?? '';
    $c_address = $_POST['address'] ?? '';
    $c_pan = $_POST['pan_no'] ?? '';

    $stmt = $conn->prepare("INSERT INTO clients (client_type, company_name, contact_person, contact_number, alt_contact_number, gst_no, address, pan_no) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $c_type, $c_name, $c_person, $c_contact, $c_alt, $c_gst, $c_address, $c_pan);
    if ($stmt->execute()) {
        $new_id = $stmt->insert_id;
        echo json_encode(['status' => 'success', 'id' => $new_id, 'company_name' => $c_name, 'contact_person' => $c_person, 'contact_number' => $c_contact, 'gst_no' => $c_gst, 'address' => $c_address, 'pan_no' => $c_pan]);
    } else {
        echo json_encode(['status' => 'error', 'msg' => $conn->error]);
    }
    exit();
}

$message = "";

// Handle Create Invoice Form Submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create_invoice'])) {
    $invoice_no = $_POST['invoice_no'];
    $invoice_date = $_POST['invoice_date'];
    $bill_to_id = $_POST['bill_to'];
    $ship_to_id = isset($_POST['same_as_ship']) ? $bill_to_id : $_POST['ship_to'];
    
    $payment_terms = $_POST['payment_terms'] ?? '';
    $dispatched_through = $_POST['dispatched_through'] ?? '';
    $destination = $_POST['destination'] ?? '';
    $vehicle_no = $_POST['vehicle_no'] ?? '';
    $terms_of_delivery = $_POST['terms_of_delivery'] ?? '';
    
    $subtotal = $_POST['subtotal'] ?? 0;
    $gst_enabled = isset($_POST['gst_enabled']) ? 1 : 0;
    $gst_type = $_POST['gst_type'] ?? '';
    $gst_amount = $_POST['gst_amount'] ?? 0;
    $net_payable = $_POST['net_payable'] ?? 0;
    $advance_received = $_POST['advance_received'] ?? 0;
    $balance_due = $_POST['balance_due'] ?? 0;
    $amount_in_words = $_POST['amount_in_words'] ?? '';

    $stmt = $conn->prepare("INSERT INTO invoices (invoice_no, invoice_date, bill_to_id, ship_to_id, payment_terms, dispatched_through, destination, vehicle_no, terms_of_delivery, subtotal, gst_enabled, gst_type, gst_amount, net_payable, advance_received, balance_due, amount_in_words) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    $stmt->bind_param("ssiisssssdisdddds", $invoice_no, $invoice_date, $bill_to_id, $ship_to_id, $payment_terms, $dispatched_through, $destination, $vehicle_no, $terms_of_delivery, $subtotal, $gst_enabled, $gst_type, $gst_amount, $net_payable, $advance_received, $balance_due, $amount_in_words);
    
    if ($stmt->execute()) {
        $invoice_id = $stmt->insert_id;
        
        // Insert Items
        if (isset($_POST['item_product_id']) && is_array($_POST['item_product_id'])) {
            $item_stmt = $conn->prepare("INSERT INTO invoice_items (invoice_id, product_id, product_name, hsn_code, qty, rate, amount) VALUES (?, ?, ?, ?, ?, ?, ?)");
            for ($i = 0; $i < count($_POST['item_product_id']); $i++) {
                $p_id = $_POST['item_product_id'][$i];
                $p_name = $_POST['item_name'][$i];
                $p_hsn = $_POST['item_hsn'][$i];
                $p_qty = $_POST['item_qty'][$i];
                $p_rate = $_POST['item_rate'][$i];
                $p_amt = $_POST['item_amount'][$i];
                $item_stmt->bind_param("iissidd", $invoice_id, $p_id, $p_name, $p_hsn, $p_qty, $p_rate, $p_amt);
                $item_stmt->execute();
            }
        }
        $message = "Invoice Created Successfully!";
    } else {
        $message = "Error: " . $conn->error;
    }
}

// Fetch Clients
$clients = [];
$c_res = $conn->query("SELECT id, client_type, company_name, contact_person, contact_number, gst_no, address, pan_no FROM clients");
if($c_res) { while($r = $c_res->fetch_assoc()) $clients[$r['id']] = $r; }

// Fetch Products
$products = [];
$p_res = $conn->query("SELECT id, name, hsn_code, selling_price, images FROM software_products");
if($p_res) { while($r = $p_res->fetch_assoc()) $products[$r['id']] = $r; }

// Generate Auto Invoice Number
$next_id = 1;
$max_res = $conn->query("SELECT MAX(id) as max_id FROM invoices");
if($max_res && $m = $max_res->fetch_assoc()) {
    $next_id = ($m['max_id'] ?? 0) + 1;
}
$auto_invoice_no = "LXS300" . $next_id;

// Fetch Invoices for Display
$invoices = [];
$inv_res = $conn->query("SELECT i.*, c.company_name, c.contact_person FROM invoices i LEFT JOIN clients c ON i.bill_to_id = c.id ORDER BY i.id DESC");
if($inv_res) { while($r = $inv_res->fetch_assoc()) $invoices[] = $r; }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Billing | House Maker</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root { 
            --brand-primary: #176B5A; /* Teal Dark */
            --brand-light: #E8F5F1;
            --brand-accent: #259D82;
            --hm-bg: #F4F7F6; 
        }
        body { font-family: 'Montserrat', sans-serif; background: var(--hm-bg); }
        .modal-overlay { background: rgba(0,0,0,0.6); backdrop-filter: blur(5px); }
        
        /* Modern Input Styling */
        .input-wrapper { position: relative; width: 100%; }
        .input-icon { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #9CA3AF; font-size: 0.9rem; pointer-events: none; }
        .input-field { width: 100%; padding: 10px 14px 10px 40px; border: 1px solid #D1D5DB; border-radius: 8px; font-size: 0.85rem; color: #374151; outline: none; transition: all 0.3s; background: #fff; }
        .input-field:focus { border-color: var(--brand-accent); box-shadow: 0 0 0 3px rgba(37, 157, 130, 0.1); }
        .input-field.no-icon { padding-left: 14px; }
        
        /* Custom Toggle */
        .toggle-checkbox:checked { right: 0; border-color: var(--brand-accent); }
        .toggle-checkbox:checked + .toggle-label { background-color: var(--brand-accent); }
        .toggle-checkbox { right: 4px; z-index: 1; transition: all 0.3s; }
        .toggle-label { width: 44px; height: 24px; background-color: #D1D5DB; border-radius: 9999px; transition: all 0.3s; }

        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; border-radius: 10px; }
        ::-webkit-scrollbar-thumb { background: var(--brand-primary); border-radius: 10px; }
    </style>
</head>
<body class="p-4 md:p-8">

    <!-- Header -->
    <div class="flex justify-between items-center bg-white p-6 rounded-xl shadow-sm border border-gray-100 mb-6">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 bg-teal-50 rounded-lg flex items-center justify-center text-var(--brand-primary)">
                <i class="fa-solid fa-file-invoice-dollar text-2xl" style="color: var(--brand-primary);"></i>
            </div>
            <div>
                <h1 class="text-xl font-extrabold text-gray-800 tracking-tight">Billing & Invoices</h1>
                <p class="text-xs text-gray-500 font-semibold uppercase mt-1">Manage and create tax invoices</p>
            </div>
        </div>
        <button onclick="toggleModal('invoiceModal')" class="bg-[#176B5A] hover:bg-[#115043] text-white px-6 py-3 rounded-lg font-bold uppercase tracking-wider text-xs transition shadow-md flex items-center gap-2">
            <i class="fa-solid fa-plus"></i> Create Invoice
        </button>
    </div>

    <?php if($message) echo "<div class='p-4 mb-4 bg-green-50 border border-green-200 rounded-lg text-green-700 font-bold shadow-sm'><i class='fa-solid fa-circle-check mr-2'></i> $message</div>"; ?>

    <!-- Invoices List -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse whitespace-nowrap">
                <thead>
                    <tr class="bg-gray-50 text-gray-500 text-[10px] font-extrabold uppercase tracking-widest border-b border-gray-200">
                        <th class="p-4">Invoice No</th>
                        <th class="p-4">Date</th>
                        <th class="p-4">Client</th>
                        <th class="p-4">Amount</th>
                        <th class="p-4 text-center">Status</th>
                        <th class="p-4 text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="text-sm font-medium">
                    <?php foreach($invoices as $inv): ?>
                    <tr class="hover:bg-gray-50 border-b border-gray-100 transition">
                        <td class="p-4 font-bold text-gray-800">
                            <i class="fa-solid fa-hashtag text-gray-400 mr-1 text-xs"></i><?= $inv['invoice_no'] ?>
                        </td>
                        <td class="p-4 text-gray-600">
                            <i class="fa-regular fa-calendar text-gray-400 mr-1 text-xs"></i><?= date('d M Y', strtotime($inv['invoice_date'])) ?>
                        </td>
                        <td class="p-4 text-gray-800">
                            <i class="fa-regular fa-building text-gray-400 mr-1 text-xs"></i><?= !empty($inv['company_name']) ? $inv['company_name'] : $inv['contact_person'] ?>
                        </td>
                        <td class="p-4 font-bold text-[#176B5A]">₹<?= number_format($inv['net_payable'], 2) ?></td>
                        <td class="p-4 text-center">
                            <?php if($inv['balance_due'] <= 0): ?>
                                <span class="bg-emerald-50 border border-emerald-200 text-emerald-600 px-3 py-1 text-[10px] font-bold uppercase rounded-full">Paid</span>
                            <?php else: ?>
                                <span class="bg-red-50 border border-red-200 text-red-600 px-3 py-1 text-[10px] font-bold uppercase rounded-full">Due: ₹<?= $inv['balance_due'] ?></span>
                            <?php endif; ?>
                        </td>
                        <td class="p-4 text-right">
                            <a href="invoice.php?id=<?= $inv['id'] ?>" target="_blank" class="text-[#176B5A] hover:bg-[#176B5A] hover:text-white border border-[#176B5A] transition font-bold px-4 py-1.5 rounded-lg text-xs">
                                <i class="fa-solid fa-print mr-1"></i> Print
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- CREATE INVOICE MODAL -->
    <div id="invoiceModal" class="fixed inset-0 z-40 hidden flex items-center justify-center modal-overlay p-4">
        <div class="bg-white w-full max-w-6xl rounded-2xl shadow-2xl relative flex flex-col max-h-[95vh] overflow-hidden">
            
            <!-- Modal Header -->
            <div class="bg-white px-6 py-4 flex justify-between items-center border-b border-gray-200 flex-shrink-0">
                <h2 class="text-[#176B5A] text-lg font-extrabold flex items-center gap-2">
                    <i class="fa-solid fa-file-invoice-dollar bg-[#E8F5F1] p-2 rounded-lg"></i> Create New Invoice
                </h2>
                <button type="button" onclick="toggleModal('invoiceModal')" class="text-gray-400 hover:text-red-500 hover:bg-red-50 p-2 rounded-lg transition text-xl">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            
            <div class="p-6 overflow-y-auto bg-[#F4F7F6] flex-1">
                <form action="" method="POST" id="invoiceForm">
                    
                    <!-- Section 1: Customer Details -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 mb-6">
                        <h3 class="text-xs font-extrabold text-[#176B5A] uppercase tracking-wider mb-4 flex items-center gap-2">
                            <i class="fa-solid fa-address-card"></i> Customer & Invoice Details
                        </h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
                            <div>
                                <label class="block text-[10px] font-bold text-gray-500 uppercase mb-1">Invoice No.</label>
                                <div class="input-wrapper">
                                    <i class="fa-solid fa-hashtag input-icon"></i>
                                    <input type="text" name="invoice_no" value="<?= $auto_invoice_no ?>" class="input-field font-bold text-gray-800">
                                </div>
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-gray-500 uppercase mb-1">Invoice Date</label>
                                <div class="input-wrapper">
                                    <i class="fa-solid fa-calendar-days input-icon"></i>
                                    <input type="date" name="invoice_date" value="<?= date('Y-m-d') ?>" class="input-field">
                                </div>
                            </div>
                            <div class="md:col-span-2">
                                <div class="flex justify-between items-center mb-1">
                                    <label class="block text-[10px] font-bold text-gray-500 uppercase">Bill To Customer</label>
                                    <button type="button" onclick="toggleModal('clientAddModal')" class="text-[10px] text-[#259D82] font-bold hover:underline">
                                        <i class="fa-solid fa-circle-plus"></i> Add New
                                    </button>
                                </div>
                                <div class="input-wrapper">
                                    <i class="fa-solid fa-user-tie input-icon"></i>
                                    <select name="bill_to" id="bill_to_select" class="input-field" onchange="renderClientPreview(this.value, 'bill_to_preview')" required>
                                        <option value="">Select Customer...</option>
                                        <?php foreach($clients as $id => $c): ?>
                                            <option value="<?= $id ?>"><?= $c['company_name'] ? $c['company_name'] : $c['contact_person'] ?> (<?= $c['contact_number'] ?>)</option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Previews & Ship To -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div id="bill_to_preview" class="text-xs text-gray-600 min-h-[60px] bg-gray-50 p-3 rounded-lg border border-gray-100 flex items-center justify-center italic">
                                Select a client to view details.
                            </div>
                            
                            <div class="border border-gray-200 rounded-lg p-3 relative bg-white">
                                <div class="flex justify-between items-center mb-2 pb-2 border-b border-gray-100">
                                    <label class="block text-[10px] font-bold text-gray-500 uppercase">Ship To Details</label>
                                    <label class="flex items-center gap-2 text-xs font-bold text-[#176B5A] cursor-pointer">
                                        <input type="checkbox" name="same_as_ship" id="same_as_ship" checked onchange="toggleShipTo()" class="w-3.5 h-3.5 accent-[#259D82] rounded"> Same as Bill To
                                    </label>
                                </div>
                                <div id="ship_to_container" class="opacity-40 pointer-events-none transition-opacity duration-300">
                                    <div class="input-wrapper mb-2">
                                        <i class="fa-solid fa-truck input-icon"></i>
                                        <select name="ship_to" id="ship_to_select" class="input-field" onchange="renderClientPreview(this.value, 'ship_to_preview')">
                                            <option value="">Select Shipping Customer...</option>
                                            <?php foreach($clients as $id => $c): ?>
                                                <option value="<?= $id ?>"><?= $c['company_name'] ? $c['company_name'] : $c['contact_person'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div id="ship_to_preview" class="text-xs text-gray-500 italic text-center py-1">Will use Bill To details.</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section 2: Journey/Extra Details -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 mb-6">
                        <h3 class="text-xs font-extrabold text-[#176B5A] uppercase tracking-wider mb-4 flex items-center gap-2">
                            <i class="fa-solid fa-bars-staggered"></i> Additional Information (Optional)
                        </h3>
                        <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                            <div>
                                <label class="block text-[10px] font-bold text-gray-500 uppercase mb-1">Mode/Terms</label>
                                <div class="input-wrapper"><i class="fa-solid fa-money-check-dollar input-icon"></i><input type="text" name="payment_terms" class="input-field" placeholder="e.g. Cash"></div>
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-gray-500 uppercase mb-1">Dispatched Via</label>
                                <div class="input-wrapper"><i class="fa-solid fa-truck-fast input-icon"></i><input type="text" name="dispatched_through" class="input-field" placeholder="Courier/Hand"></div>
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-gray-500 uppercase mb-1">Destination</label>
                                <div class="input-wrapper"><i class="fa-solid fa-location-dot input-icon"></i><input type="text" name="destination" class="input-field" placeholder="City"></div>
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-gray-500 uppercase mb-1">Vehicle No.</label>
                                <div class="input-wrapper"><i class="fa-solid fa-car input-icon"></i><input type="text" name="vehicle_no" class="input-field" placeholder="JH10..."></div>
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-gray-500 uppercase mb-1">Terms of Delivery</label>
                                <div class="input-wrapper"><i class="fa-solid fa-handshake input-icon"></i><input type="text" name="terms_of_delivery" class="input-field" placeholder="Terms..."></div>
                            </div>
                        </div>
                    </div>

                    <!-- Section 3: Product Selection -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 mb-6">
                        <h3 class="text-xs font-extrabold text-[#176B5A] uppercase tracking-wider mb-4 flex items-center gap-2">
                            <i class="fa-solid fa-boxes-stacked"></i> Select Products / Services
                        </h3>
                        
                        <div class="mb-4 bg-[#F4F7F6] p-3 rounded-lg border border-gray-200">
                            <div class="input-wrapper">
                                <i class="fa-solid fa-magnifying-glass input-icon text-[#259D82]"></i>
                                <select id="product_search" class="input-field border-[#259D82] shadow-sm font-semibold" onchange="addProductToTable(this.value)">
                                    <option value="">-- Click to search and add products --</option>
                                    <?php foreach($products as $id => $p): ?>
                                        <option value="<?= $id ?>"><?= $p['name'] ?> (₹<?= $p['selling_price'] ?>)</option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="border border-gray-200 rounded-lg overflow-hidden">
                            <table class="w-full text-left border-collapse" id="itemTable">
                                <thead>
                                    <tr class="bg-gray-50 text-[10px] font-extrabold text-gray-500 uppercase tracking-widest border-b border-gray-200">
                                        <th class="p-3 w-10 text-center">#</th>
                                        <th class="p-3">Description</th>
                                        <th class="p-3">HSN</th>
                                        <th class="p-3 w-24 text-center">Qty</th>
                                        <th class="p-3 w-32 text-right">Rate</th>
                                        <th class="p-3 w-32 text-right">Amount</th>
                                        <th class="p-3 w-12 text-center">Act</th>
                                    </tr>
                                </thead>
                                <tbody id="itemBody" class="text-sm">
                                    <!-- Rows injected by JS -->
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Section 4: Billing Summary -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6 items-end">
                        
                        <!-- Amount In Words -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 h-full flex flex-col justify-end">
                            <label class="block text-[10px] font-extrabold text-gray-400 uppercase tracking-widest mb-2">Amount in Words</label>
                            <textarea name="amount_in_words" id="amount_in_words" readonly rows="2" class="w-full p-3 bg-gray-50 border border-gray-200 rounded-lg text-sm font-bold text-gray-700 outline-none resize-none flex-1 flex items-center"></textarea>
                        </div>

                        <!-- Calculations Box -->
                        <div class="bg-white rounded-xl shadow-md border border-gray-200 p-6 relative overflow-hidden">
                            <div class="absolute top-0 left-0 w-full h-1 bg-[#259D82]"></div>
                            
                            <h3 class="text-sm font-extrabold text-[#176B5A] mb-5 flex items-center gap-2">
                                <i class="fa-solid fa-file-invoice-dollar"></i> Billing Summary
                            </h3>
                            
                            <div class="flex justify-between items-center mb-5 pb-4 border-b border-gray-100">
                                <span class="text-sm font-bold text-gray-800">Enable GST Calculation</span>
                                <div class="relative inline-block w-11 h-6 align-middle select-none transition duration-200 ease-in">
                                    <input type="checkbox" name="gst_enabled" id="gst_toggle" class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-2 border-gray-300 appearance-none cursor-pointer" onchange="calculateTotals()"/>
                                    <label for="gst_toggle" class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-200 cursor-pointer"></label>
                                </div>
                            </div>

                            <div id="gst_options" class="hidden grid grid-cols-2 gap-3 mb-5">
                                <label class="gst-radio cursor-pointer text-center p-2 rounded-lg font-bold text-[11px] uppercase tracking-wider transition border-2 border-[#259D82] bg-[#E8F5F1] text-[#176B5A]">
                                    <input type="radio" name="gst_type" value="cgst_sgst" checked onchange="updateRadioStyles(); calculateTotals();" class="hidden"> 9% CGST + 9% SGST
                                </label>
                                <label class="gst-radio cursor-pointer text-center p-2 rounded-lg font-bold text-[11px] uppercase tracking-wider transition border border-gray-200 bg-gray-50 text-gray-500 hover:bg-gray-100">
                                    <input type="radio" name="gst_type" value="igst" onchange="updateRadioStyles(); calculateTotals();" class="hidden"> 18% IGST
                                </label>
                            </div>

                            <div class="bg-[#F8FAF9] p-4 rounded-xl border border-[#E8F5F1] mb-5">
                                <div class="flex justify-between mb-2 text-sm font-bold text-gray-600">
                                    <span>Subtotal</span>
                                    <div class="flex items-center">
                                        <span class="mr-1">₹</span>
                                        <input type="number" id="calc_subtotal" name="subtotal" readonly class="bg-transparent text-right w-24 outline-none font-bold" value="0.00">
                                    </div>
                                </div>
                                <div id="gst_display_row" class="hidden flex justify-between mb-3 text-sm font-bold text-[#259D82] pb-3 border-b border-dashed border-teal-100">
                                    <span id="gst_label">CGST (9%) + SGST (9%)</span>
                                    <div class="flex items-center">
                                        <span class="mr-1">+ ₹</span>
                                        <input type="number" id="calc_gst_amt" name="gst_amount" readonly class="bg-transparent text-right w-24 outline-none font-bold" value="0.00">
                                    </div>
                                </div>
                                <div class="flex justify-between mt-1 text-lg font-black text-[#176B5A]">
                                    <span>Net Payable</span>
                                    <div class="flex items-center">
                                        <span class="mr-1">₹</span>
                                        <input type="number" id="calc_net" name="net_payable" readonly class="bg-transparent text-right w-28 outline-none font-black" value="0.00">
                                    </div>
                                </div>
                            </div>

                            <!-- Advance and Balance -->
                            <div class="grid grid-cols-2 gap-4">
                                <div class="bg-orange-50 border border-orange-100 p-3 rounded-xl">
                                    <label class="block text-[9px] font-extrabold text-orange-400 uppercase tracking-widest mb-1">Advance Received</label>
                                    <div class="flex items-center text-orange-600 font-bold text-lg">
                                        <i class="fa-solid fa-hand-holding-dollar mr-2 opacity-70 text-sm"></i>₹
                                        <input type="number" name="advance_received" id="calc_advance" value="0" min="0" step="0.01" class="bg-transparent outline-none w-full ml-1" oninput="calculateTotals()">
                                    </div>
                                </div>
                                <div class="bg-red-50 border border-red-100 p-3 rounded-xl">
                                    <label class="block text-[9px] font-extrabold text-red-400 uppercase tracking-widest mb-1">Balance Due</label>
                                    <div class="flex items-center text-red-600 font-bold text-lg">
                                        <i class="fa-solid fa-circle-exclamation mr-2 opacity-70 text-sm"></i>₹
                                        <input type="number" name="balance_due" id="calc_due" readonly class="bg-transparent outline-none w-full ml-1 font-bold" value="0.00">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Footer Buttons -->
                    <div class="flex justify-end gap-4 pt-6 border-t border-gray-200">
                        <button type="button" onclick="toggleModal('invoiceModal')" class="px-6 py-3 border border-gray-300 rounded-lg text-gray-600 font-bold uppercase tracking-wider text-xs hover:bg-gray-50 transition">Cancel</button>
                        <button type="submit" name="create_invoice" class="bg-[#176B5A] hover:bg-[#115043] text-white px-8 py-3 rounded-lg font-bold uppercase tracking-wider text-sm shadow-md transition flex items-center gap-2">
                            <i class="fa-solid fa-check-circle"></i> Save Invoice
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- QUICK ADD CLIENT MODAL -->
    <div id="clientAddModal" class="fixed inset-0 z-50 hidden flex items-center justify-center modal-overlay p-4">
        <div class="bg-white w-full max-w-lg rounded-2xl shadow-2xl relative overflow-hidden">
            <div class="bg-white px-6 py-4 flex justify-between items-center border-b border-gray-100">
                <h2 class="text-[#176B5A] text-md font-extrabold flex items-center gap-2">
                    <i class="fa-solid fa-user-plus bg-[#E8F5F1] p-1.5 rounded text-sm"></i> Add New Client
                </h2>
                <button type="button" onclick="toggleModal('clientAddModal')" class="text-gray-400 hover:text-red-500 transition text-lg"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="p-6 bg-[#F4F7F6]">
                <form id="ajaxClientForm" onsubmit="addClientAjax(event)">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="col-span-2">
                            <label class="block text-[10px] font-bold text-gray-500 uppercase mb-1">Company/Name <span class="text-red-500">*</span></label>
                            <div class="input-wrapper"><i class="fa-solid fa-building input-icon"></i><input type="text" name="company_name" required class="input-field bg-white"></div>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-500 uppercase mb-1">Contact Person <span class="text-red-500">*</span></label>
                            <div class="input-wrapper"><i class="fa-solid fa-user input-icon"></i><input type="text" name="contact_person" required class="input-field bg-white"></div>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-500 uppercase mb-1">Contact No. <span class="text-red-500">*</span></label>
                            <div class="input-wrapper"><i class="fa-solid fa-phone input-icon"></i><input type="text" name="contact_number" required class="input-field bg-white"></div>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-500 uppercase mb-1">GST No.</label>
                            <div class="input-wrapper"><i class="fa-solid fa-file-invoice input-icon"></i><input type="text" name="gst_no" class="input-field bg-white uppercase"></div>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-500 uppercase mb-1">PAN No.</label>
                            <div class="input-wrapper"><i class="fa-solid fa-id-card input-icon"></i><input type="text" name="pan_no" class="input-field bg-white uppercase"></div>
                        </div>
                        <div class="col-span-2">
                            <label class="block text-[10px] font-bold text-gray-500 uppercase mb-1">Address</label>
                            <div class="input-wrapper">
                                <i class="fa-solid fa-map-location-dot input-icon" style="top: 20px;"></i>
                                <textarea name="address" class="input-field bg-white" rows="2" style="padding-top:10px;"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="mt-6 flex justify-end">
                        <button type="submit" class="bg-[#176B5A] hover:bg-[#115043] text-white px-6 py-2.5 rounded-lg text-xs font-bold uppercase tracking-widest shadow transition"><i class="fa-solid fa-save mr-2"></i> Save Client</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Scripting -->
    <script>
        const clientsData = <?= json_encode($clients) ?>;
        const productsData = <?= json_encode($products) ?>;
        
        // Modal toggle
        function toggleModal(id) { document.getElementById(id).classList.toggle('hidden'); }
        
        // Render Customer Details View[cite: 8]
        function renderClientPreview(id, target) {
            const container = document.getElementById(target);
            if(!id || !clientsData[id]) { 
                container.innerHTML = '<div class="flex h-full items-center justify-center text-gray-400"><i class="fa-solid fa-user-slash mr-2"></i> Select a client to view details.</div>'; 
                return; 
            }
            const c = clientsData[id];
            container.innerHTML = `
                <div class="flex items-start gap-3">
                    <div class="w-10 h-10 bg-[#E8F5F1] rounded-full flex items-center justify-center text-[#176B5A] flex-shrink-0 mt-1">
                        <i class="fa-solid fa-building"></i>
                    </div>
                    <div class="w-full">
                        <div class="font-bold text-gray-800 text-sm mb-1">${c.company_name || c.contact_person}</div>
                        <div class="grid grid-cols-2 gap-y-1 gap-x-2 text-[11px] text-gray-600">
                            <div><i class="fa-solid fa-user text-gray-400 mr-1 w-3 text-center"></i> ${c.contact_person}</div>
                            <div><i class="fa-solid fa-phone text-gray-400 mr-1 w-3 text-center"></i> ${c.contact_number}</div>
                            <div><i class="fa-solid fa-file-invoice text-gray-400 mr-1 w-3 text-center"></i> ${c.gst_no || 'N/A'}</div>
                            <div><i class="fa-solid fa-id-card text-gray-400 mr-1 w-3 text-center"></i> ${c.pan_no || 'N/A'}</div>
                            <div class="col-span-2 truncate"><i class="fa-solid fa-location-dot text-gray-400 mr-1 w-3 text-center"></i> ${c.address}</div>
                        </div>
                    </div>
                </div>
            `;
            container.classList.remove('italic', 'justify-center', 'items-center');
        }
        
        // Same as Ship To Logic
        function toggleShipTo() {
            const isSame = document.getElementById('same_as_ship').checked;
            const container = document.getElementById('ship_to_container');
            if(isSame) {
                container.classList.add('opacity-40', 'pointer-events-none');
                document.getElementById('ship_to_select').value = '';
                document.getElementById('ship_to_preview').innerHTML = '<div class="flex h-full items-center justify-center text-gray-400"><i class="fa-solid fa-copy mr-2"></i> Will use Bill To details.</div>';
            } else {
                container.classList.remove('opacity-40', 'pointer-events-none');
            }
        }

        // Add Client dynamically via AJAX
        async function addClientAjax(e) {
            e.preventDefault();
            const form = e.target;
            const formData = new FormData(form);
            const res = await fetch('?ajax=add_client', { method: 'POST', body: formData });
            const data = await res.json();
            if(data.status === 'success') {
                clientsData[data.id] = data;
                const opt = new Option(`${data.company_name || data.contact_person} (${data.contact_number})`, data.id);
                document.getElementById('bill_to_select').add(opt.cloneNode(true));
                document.getElementById('ship_to_select').add(opt);
                document.getElementById('bill_to_select').value = data.id;
                renderClientPreview(data.id, 'bill_to_preview');
                toggleModal('clientAddModal');
                form.reset();
            } else { alert("Error adding client!"); }
        }

        // Product Table Management
        let rowCount = 0;
        function addProductToTable(prodId) {
            if(!prodId) return;
            const existingRow = document.querySelector(`tr[data-pid='${prodId}']`);
            if(existingRow) {
                const qtyInput = existingRow.querySelector('.qty-input');
                qtyInput.value = parseInt(qtyInput.value) + 1;
                updateRowAmount(existingRow);
            } else {
                rowCount++;
                const p = productsData[prodId];
                let imgSrc = '';
                if(p.images) {
                    try { 
                        let imgs = JSON.parse(p.images); 
                        if(imgs.length > 0) imgSrc = '../uploads/services/' + imgs[0]; 
                    } catch(e){}
                }

                const tr = document.createElement('tr');
                tr.setAttribute('data-pid', prodId);
                tr.className = "border-b border-gray-100 hover:bg-gray-50 transition";
                tr.innerHTML = `
                    <td class="p-3 text-center text-xs font-bold text-gray-400">${rowCount}<input type="hidden" name="item_product_id[]" value="${prodId}"></td>
                    <td class="p-3">
                        <div class="flex items-center gap-3">
                            ${imgSrc ? `<img src="${imgSrc}" class="w-10 h-10 rounded object-cover shadow-sm border border-gray-200">` : `<div class="w-10 h-10 rounded bg-gray-100 flex items-center justify-center text-gray-400"><i class="fa-solid fa-image"></i></div>`}
                            <input type="text" name="item_name[]" value="${p.name}" class="w-full bg-transparent outline-none font-bold text-gray-800 text-sm">
                        </div>
                    </td>
                    <td class="p-3"><input type="text" name="item_hsn[]" value="${p.hsn_code || ''}" class="w-full bg-transparent outline-none text-xs text-gray-500 font-mono"></td>
                    <td class="p-3">
                        <div class="border border-gray-200 rounded-md bg-white flex items-center">
                            <input type="number" name="item_qty[]" value="1" min="1" class="w-full bg-transparent outline-none text-center font-bold text-sm py-1.5 qty-input" oninput="updateRowAmount(this.closest('tr'))">
                        </div>
                    </td>
                    <td class="p-3">
                        <div class="border border-gray-200 rounded-md bg-white flex items-center px-2">
                            <span class="text-xs text-gray-400 font-bold">₹</span>
                            <input type="number" name="item_rate[]" value="${p.selling_price}" step="0.01" class="w-full bg-transparent outline-none text-right font-bold text-sm py-1.5 rate-input" oninput="updateRowAmount(this.closest('tr'))">
                        </div>
                    </td>
                    <td class="p-3">
                        <div class="flex items-center justify-end px-2">
                            <span class="text-xs text-[#259D82] font-bold mr-1">₹</span>
                            <input type="number" name="item_amount[]" value="${p.selling_price}" readonly class="bg-transparent outline-none text-right font-bold text-sm text-[#176B5A] amt-input w-20">
                        </div>
                    </td>
                    <td class="p-3 text-center">
                        <button type="button" onclick="this.closest('tr').remove(); calculateTotals();" class="w-8 h-8 rounded-full hover:bg-red-50 text-red-400 hover:text-red-600 transition flex items-center justify-center mx-auto">
                            <i class="fa-solid fa-trash-can"></i>
                        </button>
                    </td>
                `;
                document.getElementById('itemBody').appendChild(tr);
            }
            document.getElementById('product_search').value = "";
            calculateTotals();
        }

        function updateRowAmount(tr) {
            const qty = parseFloat(tr.querySelector('.qty-input').value) || 0;
            const rate = parseFloat(tr.querySelector('.rate-input').value) || 0;
            tr.querySelector('.amt-input').value = (qty * rate).toFixed(2);
            calculateTotals();
        }

        // Active State toggler for GST Radio buttons[cite: 7]
        function updateRadioStyles() {
            document.querySelectorAll('input[name="gst_type"]').forEach(r => {
                const label = r.parentElement;
                if(r.checked) {
                    label.className = "gst-radio cursor-pointer text-center p-2 rounded-lg font-bold text-[11px] uppercase tracking-wider transition border-2 border-[#259D82] bg-[#E8F5F1] text-[#176B5A]";
                } else {
                    label.className = "gst-radio cursor-pointer text-center p-2 rounded-lg font-bold text-[11px] uppercase tracking-wider transition border border-gray-200 bg-gray-50 text-gray-500 hover:bg-gray-100";
                }
            });
        }

        // Total Calculations[cite: 7]
        function calculateTotals() {
            let subtotal = 0;
            document.querySelectorAll('.amt-input').forEach(inp => { subtotal += parseFloat(inp.value) || 0; });
            document.getElementById('calc_subtotal').value = subtotal.toFixed(2);

            const gstEnabled = document.getElementById('gst_toggle').checked;
            const gstOptions = document.getElementById('gst_options');
            const gstDisplayRow = document.getElementById('gst_display_row');
            
            let gstAmt = 0;
            if(gstEnabled) {
                gstOptions.classList.remove('hidden');
                gstDisplayRow.classList.remove('hidden');
                
                const gstType = document.querySelector('input[name="gst_type"]:checked').value;
                gstAmt = subtotal * 0.18; // Both cases total 18%
                
                document.getElementById('gst_label').innerText = gstType === 'igst' ? 'IGST (18%)' : 'CGST (9%) + SGST (9%)';
                document.getElementById('calc_gst_amt').value = gstAmt.toFixed(2);
            } else {
                gstOptions.classList.add('hidden');
                gstDisplayRow.classList.add('hidden');
                document.getElementById('calc_gst_amt').value = "0.00";
            }

            const net = subtotal + gstAmt;
            document.getElementById('calc_net').value = net.toFixed(2);

            const advance = parseFloat(document.getElementById('calc_advance').value) || 0;
            document.getElementById('calc_due').value = (net - advance).toFixed(2);

            document.getElementById('amount_in_words').value = numberToWords(Math.round(net)) + " Rupees Only";
        }

        // Helper: Number to Words
        function numberToWords(num) {
            const a = ['','One ','Two ','Three ','Four ', 'Five ','Six ','Seven ','Eight ','Nine ','Ten ','Eleven ','Twelve ','Thirteen ','Fourteen ','Fifteen ','Sixteen ','Seventeen ','Eighteen ','Nineteen '];
            const b = ['', '', 'Twenty','Thirty','Forty','Fifty', 'Sixty','Seventy','Eighty','Ninety'];
            if ((num = num.toString()).length > 9) return 'overflow';
            n = ('000000000' + num).substr(-9).match(/^(\d{2})(\d{2})(\d{2})(\d{1})(\d{2})$/);
            if (!n) return; var str = '';
            str += (n[1] != 0) ? (a[Number(n[1])] || b[n[1][0]] + ' ' + a[n[1][1]]) + 'Crore ' : '';
            str += (n[2] != 0) ? (a[Number(n[2])] || b[n[2][0]] + ' ' + a[n[2][1]]) + 'Lakh ' : '';
            str += (n[3] != 0) ? (a[Number(n[3])] || b[n[3][0]] + ' ' + a[n[3][1]]) + 'Thousand ' : '';
            str += (n[4] != 0) ? (a[Number(n[4])] || b[n[4][0]] + ' ' + a[n[4][1]]) + 'Hundred ' : '';
            str += (n[5] != 0) ? ((str != '') ? 'and ' : '') + (a[Number(n[5])] || b[n[5][0]] + ' ' + a[n[5][1]]) : '';
            return str.trim() === '' ? 'Zero' : str;
        }

        // Initialize display
        renderClientPreview('','bill_to_preview');
        updateRadioStyles();
    </script>
</body>
</html>