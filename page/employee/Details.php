<?php
    $employee_id =  $_GET['emp_id'] ?? null;
    $employee = $DB->SELECT_ONE_WHERE("employees", "*", ["employee_id" => $employee_id]);
?>

<div class="page-content">

    <?php
        Breadcrumb([
            ['label' => 'Home', 'url' => '/dashboard'],
            ['label' => 'Employees', 'url' => '/employees'],
            ['label' => 'Details']
        ]);
    ?>

    <div class="panel h-full flex-col mb-4">
        <div class="flex flex-col items-center justify-center">
            <div class="flex flex-col items-center justify-center">
                <div class="w-[100px] mb-2" id="previewPicture">
                    <img src="<?=$employee['profile']?>" alt="image" id="profileImage" class="mb-4 h-24 w-24 rounded-full object-cover">
                </div>
                <div class="text-xs font-bold">EMP ID: <?=$employee['employee_id']?></div>
                <h4 class="text-xl font-bold"><?=$employee['firstname'].' '.$employee['lastname']?></h4>
            </div>
        </div>
    </div>
    
    <div class="mb-5 grid grid-cols-1 gap-5 lg:grid-cols-2 xl:grid-cols-2">
        <div class="panel">
            <h4 class="text-lg font-bold">Personal Details</h4>
            <table>
                <tr>
                    <td>Email</td>
                    <td class="font-bold"><?=$employee['email']?></td>
                </tr>
                <tr>
                    <td>Contact</td>
                    <td class="font-bold"><?=$employee['contact']?></td>
                </tr>
                <tr>
                    <td>Birthday</td>
                    <td class="font-bold"><?=$employee['birthdate']?></td>
                </tr>
                <tr>
                    <td>Gender</td>
                    <td class="font-bold"><?=$employee['gender']?></td>
                </tr>
                <tr>
                    <td>Civil Status</td>
                    <td class="font-bold"><?=$employee['civil_status']?></td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td class="font-bold"><?=$employee['address']?></td>
                </tr>
            </table>
        </div>
        <div class="panel">
            <h4 class="text-lg font-bold">Other Details</h4>
            <table>
                <tr>
                    <td>Status</td>
                    <td class="font-bold"><?=$employee['status']?></td>
                </tr>
                <tr>
                    <td>Position</td>
                    <td class="font-bold"><?=$employee['position']?></td>
                </tr>
                <tr>
                    <td>SSS</td>
                    <td class="font-bold"><?=$employee['sss']?></td>
                </tr>
                <tr>
                    <td>PHILHEALTH</td>
                    <td class="font-bold"><?=$employee['philhealth']?></td>
                </tr>
                <tr>
                    <td>PAGIBIG</td>
                    <td class="font-bold"><?=$employee['pagibig']?></td>
                </tr>
                <tr>
                    <td>Created</td>
                    <td class="font-bold"><?=$employee['created_at']?></td>
                </tr>
                <tr>
                    <td>Updated</td>
                    <td class="font-bold"><?=$employee['updated_at']?></td>
                </tr>
            </table>
        </div>
    </div>

</div>