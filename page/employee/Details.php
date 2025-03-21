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

    <div class="panel h-full flex-col">
        <div class="flex flex-col items-center justify-center">
            <div class="flex flex-col items-center justify-center">
                <div class="w-[100px] mb-2" id="previewPicture">
                    <img src="<?= DOMAIN ?>/upload/profile/default.png" alt="image" id="profileImage" class="mb-4 h-24 w-24 rounded-full object-cover">
                </div>
                <h4 class="text-lg font-bold"><?=$employee['firstname'].' '.$employee['lastname']?></h4>
            </div>
        </div>
    </div>
    
    <div class="mb-5 grid grid-cols-1 gap-5 lg:grid-cols-3 xl:grid-cols-4"></div>
        <div class="panel">
            <table>
                <tr>
                    <td>Email</td>
                    <td>Contact</td>
                </tr>
            </table>
        </div>
        <div class="panel">
            <table>
                <tr>
                    <td>Email</td>
                    <td>Contact</td>
                </tr>
            </table>
        </div>
    </div>

</div>