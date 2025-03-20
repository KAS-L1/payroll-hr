<?php require("../../app/init.php") ?>
<?php

$headers = getallheaders();

if(!isset($headers['Token']) OR empty($headers['Token'])){
    http_response_code(401);
    die(json_encode([
        "success" => false, 
        "message" => "Invalid authorization token is required"
    ]));
}

// df5cde6502c7856feb74596254fa0cbc
$token = md5('secure-token-api-key');

if($token != $headers['Token']){
    http_response_code(401);
    die(json_encode([
        "success" => false, 
        "message" => "Token is invalid"
    ]));
}

try {

    $data = file_get_contents("php://input");
    $payrollData = json_decode($data, true);
    
    // Validate required fields
    foreach($payrollData as $data){
        if (empty($data['cutoff_start']) || empty($data['cutoff_end'])) {
            http_response_code(400);
            die(json_encode([
                "success" => false,
                "message" => "Cutoff start and end dates are required"
            ]));
        }
        if (empty($data['total_days'])) {
            http_response_code(400);
            die(json_encode([
                "success" => false,
                "message" => "Total days cannot be empty"
            ]));
        }
    }

    // Validate duplicate employee_id
    $employeeIds = array_column($payrollData, 'employee_id');
    if (count($employeeIds) !== count(array_unique($employeeIds))) {
        http_response_code(400);
        die(json_encode([
            "success" => false,
            "message" => "Duplicate employee ID found in the payroll data"
        ]));
    }

    // Validate duplicate employee_name
    $employeeNames = array_column($payrollData, 'employee_name');
    if (count($employeeNames) !== count(array_unique($employeeNames))) {
        http_response_code(400);
        die(json_encode([
            "success" => false,
            "message" => "Duplicate employee Name found in the payroll data"
        ]));
    }
    
    // Payroll generate batch
    $payroll_batch_id = 'PR'.date('Ymd');

    $existingRecord = $DB->SELECT_ONE_WHERE("payroll","payroll_id", ["payroll_id" => $payroll_batch_id]);
    
    // Validate batch id
    if (!empty($existingRecord)) {
        http_response_code(400);
        die(json_encode([
            "success" => false,
            "payroll_id" => $payroll_batch_id,
            "record_count" => count($payrollData), 
            "message" => "Payroll batch already exist in our record"
        ]));
    }

    // Loop through the data
    foreach ($payrollData as $key => $value) {
        $value['payroll_id'] = $payroll_batch_id;
        $value['created_at'] = DATE_TIME;
        $DB->INSERT("payroll", $value);
    }

    // Success response
    http_response_code(200);
    die(json_encode([
        "success" => true,
        "payroll_id" => $payroll_batch_id,
        "record_count" => count($payrollData),
        "message" => "Payroll data inserted successfully"
    ]));

} catch (Exception $e) {
    // Error response
    http_response_code(500);
    die(json_encode([
        "success" => false,
        "message" => "Server response error",
        "error" => $e->getMessage()
    ]));

}