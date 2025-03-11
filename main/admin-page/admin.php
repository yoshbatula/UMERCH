<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iNeuron Banking Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #CB1E24;
            --secondary-color: #F8F9FA;
            --text-color: #333;
            --card-blue: #3264C8;
            --card-red: #E63E4D;
            --card-green: #1AAB8B;
            --card-orange: #F5864D;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #fafafa;
            color: var(--text-color);
            overflow-x: hidden;
        }
        
        .sidebar {
            background-color: var(--primary-color);
            color: white;
            height: 100vh;
            position: fixed;
            padding-top: 15px;
            z-index: 100;
            width: 250px;
        }
        
        .sidebar .navbar-brand {
            color: white;
            font-weight: bold;
            font-size: 24px;
            padding: 10px 15px;
            margin-bottom: 20px;
        }
        
        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 10px 15px;
            margin: 5px 0;
            border-radius: 5px;
        }
        
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
        }
        
        .sidebar .nav-link i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }
        
        .main-content {
            margin-left: 250px;
            padding: 15px 20px;
        }
        
        .header-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            padding-top: 5px;
        }
        
        .search-bar {
            position: relative;
            margin-right: 15px;
        }
        
        .search-bar input {
            padding-left: 40px;
            border-radius: 20px;
            border: 1px solid #ddd;
            height: 36px;
            width: 200px;
        }
        
        .search-bar i {
            position: absolute;
            left: 15px;
            top: 10px;
            color: #999;
        }
        
        .card {
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
            border: none;
        }
        
        .summary-card {
            color: white;
            height: 80px;
        }
        
        .summary-card.blue {
            background-color: var(--card-blue);
        }
        
        .summary-card.red {
            background-color: var(--card-red);
        }
        
        .summary-card.green {
            background-color: var(--card-green);
        }
        
        .summary-card.orange {
            background-color: var(--card-orange);
        }
        
        .summary-card .card-body {
            padding: 15px;
        }
        
        .summary-card .card-title {
            font-size: 13px;
            font-weight: normal;
            margin-bottom: 5px;
            opacity: 0.9;
        }
        
        .summary-card .amount {
            font-size: 20px;
            font-weight: bold;
        }
        
        .table-card {
            background-color: white;
        }
        
        .table-card .card-body {
            padding: 15px;
        }
        
        .table th {
            font-weight: 600;
            color: #666;
            border-top: none;
            padding: 12px 15px;
            font-size: 13px;
            text-transform: uppercase;
        }
        
        .table td {
            padding: 12px 15px;
            vertical-align: middle;
            font-size: 14px;
            color: #444;
        }
        
        .status-badge {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            text-align: center;
            display: inline-block;
            min-width: 60px;
        }
        
        .status-badge.active {
            background-color: rgba(26, 171, 139, 0.2);
            color: var(--card-green);
        }
        
        .status-badge.pending {
            background-color: rgba(245, 134, 77, 0.2);
            color: var(--card-orange);
        }
        
        .user-avatar {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            margin-right: 5px;
        }
        
        .bottom-charts {
            margin-top: 15px;
        }
        
        .chart-container {
            height: 180px;
            position: relative;
        }
        
        .profile-section {
            display: flex;
            align-items: center;
            padding: 0 10px;
            margin-right: 15px;
        }
        
        .profile-section img {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            margin-right: 10px;
        }
        
        .profile-name {
            font-size: 14px;
            font-weight: 500;
        }
        
        .header-icons {
            display: flex;
            align-items: center;
        }
        
        .table-amount {
            font-weight: 600;
        }
        
        .greeting {
            margin-bottom: 15px;
        }
        
        .greeting h4 {
            margin: 0;
            font-weight: 600;
            font-size: 22px;
        }
        
        .greeting p {
            margin: 5px 0 0 0;
            font-size: 14px;
            color: #666;
        }
        
        .people-list {
            list-style: none;
            padding: 0;
        }
        
        .people-list li {
            display: flex;
            align-items: center;
            margin-bottom: 12px;
        }
        
        .people-list .name {
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 0;
        }
        
        .people-list .role {
            font-size: 12px;
            color: #777;
        }
        
        .chart-item {
            display: flex;
            align-items: center;
            margin-bottom: 8px;
        }
        
        .chart-item .color-box {
            width: 12px;
            height: 12px;
            margin-right: 8px;
        }
        
        .chart-item .label {
            font-size: 13px;
            color: #666;
        }
        
        .chart-item .value {
            font-size: 13px;
            font-weight: 500;
            margin-left: auto;
        }
        
        .pagination {
            font-size: 13px;
            color: #777;
        }
        
        .pagination-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <!-- Left Sidebar -->
    <div class="sidebar" style="width: 250px;">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <i class="fas fa-university me-2"></i>
            <span>iNeuron</span>
        </a>
        
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="#">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-chart-line"></i> Analytics
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-wallet"></i> Accounts
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-credit-card"></i> Cards
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-money-bill-wave"></i> Payments
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-cog"></i> Settings
                </a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header with search and profile -->
        <div class="header-section">
            <div class="greeting">
                <h4>Dashboard</h4>
                <p>Welcome back! Here's what's happening with your account today.</p>
            </div>
            <div class="d-flex align-items-center">
                <div class="search-bar">
                    <i class="fas fa-search"></i>
                    <input type="text" class="form-control" placeholder="Search...">
                </div>
                <div class="header-icons">
                    <div class="profile-section">
                        <img src="/api/placeholder/32/32" alt="User">
                        <span class="profile-name">John Doe</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Summary Cards Row -->
        <div class="row">
            <div class="col-md-3">
                <div class="card summary-card blue">
                    <div class="card-body">
                        <div class="card-title">Total Balance</div>
                        <div class="amount">$56,772</div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card summary-card red">
                    <div class="card-body">
                        <div class="card-title">Total Spending</div>
                        <div class="amount">$14,253</div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card summary-card green">
                    <div class="card-body">
                        <div class="card-title">Total Saved</div>
                        <div class="amount">$28,564</div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card summary-card orange">
                    <div class="card-body">
                        <div class="card-title">Upcoming Bills</div>
                        <div class="amount">$7,820</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Transactions Table -->
        <div class="card table-card">
            <div class="card-body">
                <h5 class="card-title mb-3">Recent Transactions</h5>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>NAME/BUSINESS</th>
                                <th>ACCOUNT</th>
                                <th>STATUS</th>
                                <th>DATE</th>
                                <th>CATEGORY</th>
                                <th class="text-end">AMOUNT</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Sample data for transactions that would come from database
                            $transactions = [
                                [
                                    'name' => 'John Doe',
                                    'account' => 'Savings Account',
                                    'status' => 'active',
                                    'date' => '14 Mar 2025',
                                    'category' => 'Income',
                                    'amount' => '+$2,500.00'
                                ],
                                [
                                    'name' => 'Michael Smith',
                                    'account' => 'Current Account',
                                    'status' => 'pending',
                                    'date' => '13 Mar 2025',
                                    'category' => 'Transfer',
                                    'amount' => '-$850.75'
                                ],
                                [
                                    'name' => 'Sarah Johnson',
                                    'account' => 'Savings Account',
                                    'status' => 'active',
                                    'date' => '12 Mar 2025',
                                    'category' => 'Income',
                                    'amount' => '+$1,200.50'
                                ],
                                [
                                    'name' => 'Apple Store',
                                    'account' => 'Credit Card',
                                    'status' => 'active',
                                    'date' => '11 Mar 2025',
                                    'category' => 'Shopping',
                                    'amount' => '-$999.99'
                                ],
                                [
                                    'name' => 'Electric Company',
                                    'account' => 'Current Account',
                                    'status' => 'pending',
                                    'date' => '10 Mar 2025',
                                    'category' => 'Utilities',
                                    'amount' => '-$125.40'
                                ],
                                [
                                    'name' => 'James Wilson',
                                    'account' => 'Current Account',
                                    'status' => 'active',
                                    'date' => '09 Mar 2025',
                                    'category' => 'Transfer',
                                    'amount' => '-$500.00'
                                ]
                            ];

                            foreach ($transactions as $transaction) {
                                $statusClass = $transaction['status'] == 'active' ? 'active' : 'pending';
                                $amountClass = strpos($transaction['amount'], '+') === 0 ? 'text-success' : 'text-danger';
                                
                                echo '<tr>';
                                echo '<td>' . $transaction['name'] . '</td>';
                                echo '<td>' . $transaction['account'] . '</td>';
                                echo '<td><span class="status-badge ' . $statusClass . '">' . ucfirst($transaction['status']) . '</span></td>';
                                echo '<td>' . $transaction['date'] . '</td>';
                                echo '<td>' . $transaction['category'] . '</td>';
                                echo '<td class="text-end ' . $amountClass . ' table-amount">' . $transaction['amount'] . '</td>';
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="pagination-info">
                    <div>Showing 1 to 6 of 15 entries</div>
                    <div>
                        <button class="btn btn-sm btn-outline-secondary me-2">Previous</button>
                        <button class="btn btn-sm btn-primary">Next</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom charts and statistics -->
        <div class="row bottom-charts">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title mb-3">Team Members</h6>
                        <ul class="people-list">
                            <li>
                                <img src="/api/placeholder/36/36" alt="User" class="user-avatar">
                                <div>
                                    <p class="name">Alex Morgan</p>
                                    <p class="role">Manager</p>
                                </div>
                            </li>
                            <li>
                                <img src="/api/placeholder/36/36" alt="User" class="user-avatar">
                                <div>
                                    <p class="name">Jessica Smith</p>
                                    <p class="role">Developer</p>
                                </div>
                            </li>
                            <li>
                                <img src="/api/placeholder/36/36" alt="User" class="user-avatar">
                                <div>
                                    <p class="name">Ryan Taylor</p>
                                    <p class="role">Designer</p>
                                </div>
                            </li>
                            <li>
                                <img src="/api/placeholder/36/36" alt="User" class="user-avatar">
                                <div>
                                    <p class="name">Amanda Lee</p>
                                    <p class="role">Analyst</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title mb-3">Spending Categories</h6>
                        <div class="chart-container mb-3">
                            <div class="d-flex justify-content-center align-items-center h-100">
                                <div style="width: 120px; height: 120px; border-radius: 50%; background: #f5f5f5; position: relative; overflow: hidden;">
                                    <div style="position: absolute; width: 100%; height: 65.5%; background: var(--card-blue); transform-origin: 50% 100%; transform: rotate(0deg);"></div>
                                    <div style="position: absolute; width: 100%; height: 34.5%; background: var(--card-green); transform-origin: 50% 100%; transform: rotate(236deg);"></div>
                                    <div style="width: 70px; height: 70px; background: white; border-radius: 50%; position: absolute; top: 25px; left: 25px;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="chart-item">
                            <div class="color-box" style="background-color: var(--card-blue);"></div>
                            <div class="label">Shopping</div>
                            <div class="value">65.5%</div>
                        </div>
                        <div class="chart-item">
                            <div class="color-box" style="background-color: var(--card-green);"></div>
                            <div class="label">Bills & Utilities</div>
                            <div class="value">34.5%</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title mb-3">Statistics</h6>
                        <div class="chart-container">
                            <div class="d-flex flex-column justify-content-center h-100">
                                <div class="mb-3">
                                    <p class="mb-1" style="font-size: 13px;">Monthly Spending</p>
                                    <div class="d-flex align-items-center justify-content-between mb-1">
                                        <span style="font-size: 12px;">$0</span>
                                        <span style="font-size: 12px;">$10k</span>
                                        <span style="font-size: 12px;">$20k</span>
                                    </div>
                                    <div class="progress mb-1" style="height: 6px;">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span style="font-size: 14px; font-weight: 500;">$14,253</span>
                                        <span style="font-size: 12px;">75%</span>
                                    </div>
                                </div>
                                
                                <div>
                                    <p class="mb-1" style="font-size: 13px;">Monthly Savings</p>
                                    <div class="d-flex align-items-center justify-content-between mb-1">
                                        <span style="font-size: 12px;">$0</span>
                                        <span style="font-size: 12px;">$15k</span>
                                        <span style="font-size: 12px;">$30k</span>
                                    </div>
                                    <div class="progress mb-1" style="height: 6px;">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 42%;" aria-valuenow="42" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span style="font-size: 14px; font-weight: 500;">$12,564</span>
                                        <span style="font-size: 12px;">42%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="mt-3 mb-3 text-center">
            <small class="text-muted">Copyright © 2025 iNeuron Banking | All rights reserved</small>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>