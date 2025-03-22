
<?php require("../../app/init.php") ?>
<?php

try{

    $data = file_get_contents("https://hr1.paradisehoteltomasmorato.com/api/all-employee-docs");
    $employeeData = json_decode($data, true);
    
    foreach($employeeData['data'] as $employee){

        $dataEmployee = [
            "employee_id" => $employee['employee_no'],
            "firstname" => $employee['firstname'],
            "lastname" => $employee['lastname'],
            "profile" => $employee['profile'],
            "email" => $employee['email'],
            "contact" => $employee['number'],
            "position" => $employee['position'],
            "birthdate" => $employee['birthdate'],
            "gender" => $employee['gender'],
            "civil_status" => $employee['civil_status'],
            "address" => $employee['address'],
            "sss" => $employee['sss'],
            "tin" => $employee['tin'],
            "philhealth" => $employee['philhealth'],
            "pagibig" => $employee['pagibig'],
            "status" => $employee['status'],
            "approved" => $employee['approved'],
            "registered_at" => $employee['created_at'],
            "updated_at" => $employee['updated_at'],
        ];

        $check_employee = $DB->SELECT_ONE_WHERE('employees', 'employee_id', ['employee_id' => $employee['employee_no']]);
        if(!empty($check_employee)){
            $migrate_employee = $DB->UPDATE("employees", $dataEmployee, ["employee_id" => $employee['employee_no']]);    
        }else{
            $dataEmployee['created_at'] = DATE_TIME;
            $migrate_employee = $DB->INSERT("employees", $dataEmployee);
        }
    }

    if($migrate_employee['success']){
        http_response_code(200);
        Swal("success", "Employee data synced successfully");
        Refresh(3000);
        die();
    }else{
        http_response_code(500);
        die(json_encode([
            "success" => false,
            "message" => "Failed to import employee data",
            "error" => $insert_employee['error']
        ]));
    }  
    
} catch (Exception $e) {
    // Error response
    http_response_code(500);
    die(json_encode([
        "success" => false,
        "message" => "Server response error",
        "error" => $e->getMessage()
    ]));

}