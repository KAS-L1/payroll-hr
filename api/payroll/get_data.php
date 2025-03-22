<?php require("../../app/init.php") ?>
<?php require("../auth/auth.php") ?>
<?php

    $payrollData = [
        [
            "payroll_id" => "PR20250323",
            "employee_id" => "EMP0001",
            "total_days" => 10,
            "total_holidays" => 1,
            "cutoff_start" => "2025-02-01",
            "cutoff_end" => "2025-02-15",
            "status" => 'Pending'
        ],
        [
            "payroll_id" => "PR20250323",
            "employee_id" => "EMP0002",
            "total_days" => 12,
            "total_holidays" => 0,
            "cutoff_start" => "2025-02-01",
            "cutoff_end" => "2025-02-15",
            "status" => 'Pending'
        ],
        [
            "payroll_id" => "PR20250323",
            "employee_id" => "EMP0003",
            "total_days" => 8,
            "total_holidays" => 2,
            "cutoff_start" => "2025-02-01",
            "cutoff_end" => "2025-02-15",
            "status" => 'Pending'
        ],
        [
            "payroll_id" => "PR20250323",
            "employee_id" => "EMP0004",
            "total_days" => 15,
            "total_holidays" => 1,
            "cutoff_start" => "2025-02-01",
            "cutoff_end" => "2025-02-15",
            "status" => 'Pending'
        ],
        [
            "payroll_id" => "PR20250323",
            "employee_id" => "EMP0005",
            "total_days" => 9,
            "total_holidays" => 1,
            "cutoff_start" => "2025-02-01",
            "cutoff_end" => "2025-02-15",
            "status" => 'Pending'
        ],
        [
            "payroll_id" => "PR20250323",
            "employee_id" => "EMP0006",
            "total_days" => 11,
            "total_holidays" => 0,
            "cutoff_start" => "2025-02-01",
            "cutoff_end" => "2025-02-15",
            "status" => 'Pending'
        ],
        [
            "payroll_id" => "PR20250323",
            "employee_id" => "EMP0007",
            "total_days" => 13,
            "total_holidays" => 1,
            "cutoff_start" => "2025-02-01",
            "cutoff_end" => "2025-02-15",
            "status" => 'Pending'
        ],
        [
            "payroll_id" => "PR20250323",
            "employee_id" => "EMP0008",
            "total_days" => 14,
            "total_holidays" => 2,
            "cutoff_start" => "2025-02-01",
            "cutoff_end" => "2025-02-15",
            "status" => 'Pending'
        ],
        [
            "payroll_id" => "PR20250323",
            "employee_id" => "EMP0009",
            "total_days" => 10,
            "total_holidays" => 1,
            "cutoff_start" => "2025-02-01",
            "cutoff_end" => "2025-02-15",
            "status" => 'Pending'
        ],
        [
            "payroll_id" => "PR20250323",
            "employee_id" => "EMP0010",
            "total_days" => 7,
            "total_holidays" => 0,
            "cutoff_start" => "2025-02-01",
            "cutoff_end" => "2025-02-15",
            "status" => 'Pending'
        ]
    ];

    foreach ($payrollData as $dataEmployee) {
        $migrate_employee = $DB->INSERT("payroll", $dataEmployee);
    }

    Swal("success", "Payroll Migrated Successfully");
    Refresh(2000);
    die();

    