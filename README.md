# Overview

This file tracks tasks and progress for Payroll HR Capstone System.

## Features

-   [x] User Login and Authentication.
-   [x] User Profile settings update information, password and change picture.
-   [x] Manage users add update information and role.
-   [] Payroll Processing.
    -   [] Payslip
    -   [] Reports
-   [] Benefits and Compensation
-   [] Self Service Portal
-   [] Payroll Approval
    -   [] Pending Report
-   [] Helpdesk AI Portal

## Integration

-   [x] Payroll API create

    End Point:

    ```http
    HEADER: {token}
    POST: https://{domain}/api/payroll/employee_record.php
    ```

    Payload Array of Object:

    ```json
    [
        {
            "employee_id": "EMP1001",
            "employee_name": "JHON DOE",
            "total_days": 10,
            "cutoff_start" : "2025-02-01",
            "cutoff_end" : "2025-02-15"
        },
        {
            "employee_id": "EMP1002",
            "employee_name": "JON DOE",
            "total_days": 8,
            "cutoff_start" : "2025-02-01",
            "cutoff_end" : "2025-02-15"
        },
        ...
    ]
    ```

    Response:

    Success 200:

    ```json
    {
        "success": true,
        "payroll_id": "PR20250221",
        "record_count": 2,
        "message": "Payroll data inserted successfully"
    }
    ```

    Unauthorized 401:

    ```json
    {
        "success": true,
        "message": "Token is invalid message details"
    }
    ```

    Bad Request 400:

    ```json
    {
        "success": true,
        "message": "Validation message either required or duplicate"
    }
    ```

    Server Error 500:

    ```json
    {
        "success": true,
        "message": "Payrol data failed to insert",
        "error": "catched error message"
    }
    ```
