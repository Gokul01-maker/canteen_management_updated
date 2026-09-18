<?php
$topRole = (string)($_SESSION['role_name'] ?? 'User');
$topName = (string)($_SESSION['employee_name'] ?? 'User');
$topInitial = strtoupper(substr(trim($topName), 0, 1) ?: 'U');

$menuItems = [
    // Admin Menus
    ['label'=>'Dashboard', 'icon'=>'fa-home', 'href'=>'../admin/dashboard.php', 'subtitle'=>'Overview of the system.'],
    ['label'=>'User Management', 'icon'=>'fa-users', 'href'=>'../admin/users.php', 'subtitle'=>'Create login accounts and manage system access.'],
    ['label'=>'Role Management', 'icon'=>'fa-user-tie', 'href'=>'../admin/roles.php', 'subtitle'=>'Manage user roles and permissions.'],
    ['label'=>'Price Master', 'icon'=>'fa-tags', 'href'=>'../admin/price_master.php', 'subtitle'=>'Manage standard rates for all cooking materials.'],
    ['label'=>'Invoice Approvals', 'icon'=>'fa-file-invoice-dollar', 'href'=>'../admin/invoice_approvals.php', 'subtitle'=>'Review and approve supplier invoices for payment.'],
    ['label'=>'Canteen Report', 'icon'=>'fa-chart-pie', 'href'=>'../admin/canteen_report.php', 'subtitle'=>'View food serving, staff consumption, and actual wastage.'],
    
    // Purchase Menus (URLs Updated Correctly)
    ['label'=>'Supplier Management', 'icon'=>'fa-truck-fast', 'href'=>'../purchase/suppliers.php', 'subtitle'=>'Manage purchase suppliers.'],
    ['label'=>'Purchase Order', 'icon'=>'fa-cart-shopping', 'href'=>'../purchase/purchase_orders.php', 'subtitle'=>'Create and manage purchase orders.'],
    ['label'=>'Purchase Requests', 'icon'=>'fa-clipboard-list', 'href'=>'../purchase/requests.php', 'subtitle'=>'Review and process purchase requests submitted by Store.'],
    ['label'=>'Purchase Report', 'icon'=>'fa-file-lines', 'href'=>'../purchase/purchase_report.php', 'subtitle'=>'View purchase and stock reports.']
];

$currentPageFile = basename($_SERVER['PHP_SELF']);

$pageTitle = 'Dashboard';
$pageIcon = 'fa-shield-halved'; 
$pageSubtitle = '';

foreach ($menuItems as $item) {
    if (basename($item['href']) === $currentPageFile) {
        $pageTitle = $item['label'];
        $pageIcon = $item['icon'];
        $pageSubtitle = $item['subtitle'] ?? '';
        break;
    }
}
?>
<style>
    .mnc-dropdown {
        width: 220px !important;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08) !important;
        border: 1px solid rgba(0, 0, 0, 0.05) !important;
        border-radius: 12px !important;
        padding: 10px !important;
        margin-top: 10px !important;
    }
    .mnc-dropdown-item {
        padding: 8px 12px !important;
        border-radius: 8px !important;
        font-weight: 500;
        font-size: 13.5px;
        color: #4a5568;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        margin-bottom: 2px;
    }
    .mnc-dropdown-item:hover {
        background-color: #f8fafc !important;
        color: #0b2239;
        transform: translateX(4px);
    }
    .mnc-logout-btn {
        background-color: #fce8e9 !important;
        color: #a11b22 !important;
        font-weight: 600;
        margin-top: 4px;
    }
    .mnc-logout-btn:hover {
        background-color: #a11b22 !important;
        color: #ffffff !important;
    }
    .mnc-avatar-large {
        background: linear-gradient(135deg, #0b2239, #1a4370);
        color: white;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        font-weight: bold;
        margin: 0 auto 8px;
        box-shadow: 0 4px 10px rgba(11, 34, 57, 0.15);
    }
</style>

<header class="topbar" style="height: 78px !important; min-height: 78px !important; padding: 0 25px !important; display: flex !important; align-items: center !important; background-color: #ffffff !important;">
    <div class="d-flex align-items-center gap-3 w-100">
        <button class="btn btn-light d-lg-none topbar-mobile-toggle" id="sidebarToggle" type="button" aria-label="Open menu"><i class="fa-solid fa-bars"></i></button>
        
        <div class="d-flex align-items-center gap-3 ms-2">
            <div class="d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background-color: #fce8e9; border-radius: 8px; color: #a11b22; font-size: 18px;">
                <i class="fa-solid <?= e($pageIcon) ?>"></i>
            </div>
            
            <div class="d-flex flex-column justify-content-center ms-1">
                <h5 class="fw-bold" style="color: #0b2239; letter-spacing: 0.5px; margin: 0 0 4px 0 !important; line-height: 1 !important;"><?= e($pageTitle) ?></h5>
                <?php if (!empty($pageSubtitle)): ?>
                    <span class="text-muted" style="font-size: 13px; letter-spacing: 0.3px; line-height: 1 !important; margin-top: 2px !important;"><?= e($pageSubtitle) ?></span>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="topbar-actions ms-auto">
        <div class="dropdown">
            <button class="user-menu dropdown-toggle border-0 bg-transparent" data-bs-toggle="dropdown" type="button" style="height: 50px !important; padding: 0 10px !important; outline: none;">
                <span class="avatar text-white fw-bold d-inline-flex align-items-center justify-content-center" style="background-color: #0b2239; border-radius: 50%; width: 38px; height: 38px; margin-right: 8px;">
                    <?= e($topInitial) ?>
                </span>
                <span class="topbar-user-name fw-semibold text-dark" style="letter-spacing: 0.3px; font-size: 14.5px;"><?= e($topName) ?></span>
            </button>
            
            <ul class="dropdown-menu dropdown-menu-end mnc-dropdown">
                <li class="text-center pt-2 pb-2">
                    <div class="mnc-avatar-large">
                        <?= e($topInitial) ?>
                    </div>
                    <h6 class="mb-1 fw-bold" style="color: #0b2239; font-size: 15px; letter-spacing: 0.2px;"><?= e($topName) ?></h6>
                    <span class="badge mt-1" style="background-color: #e2e8f0; color: #475569; font-size: 11px; font-weight: 600; padding: 4px 8px; border-radius: 4px; letter-spacing: 0.3px;"><?= e($topRole) ?></span>
                </li>
                
                <li><hr class="dropdown-divider" style="border-color: #edf2f7; margin: 8px 0;"></li>
                <li>
                    <a class="dropdown-item mnc-dropdown-item mnc-logout-btn" href="../logout.php">
                        <i class="fa-solid fa-arrow-right-from-bracket me-2" style="font-size: 14px; width: 18px; text-align: center;"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</header>