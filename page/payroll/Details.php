<?php
    $employee_id =  $_GET['emp_id'] ?? null;
    $employee = $DB->SELECT_ONE_WHERE("employees", "*", ["employee_id" => $employee_id]);

    $benefits = $DB->SELECT("benefits","*");

    $benefits_compensation = $DB->SELECT_WHERE("benefits_compensation","*", ["employee_id" => $employee_id]);

?>

<div class="page-content">

    <?php
        Breadcrumb([
            ['label' => 'Home', 'url' => '/dashboard'],
            ['label' => 'Benefits & Compensation', 'url' => '/benefits-compensation'],
            ['label' => 'Details'],
        ]);
    ?>

    <div class="panel h-full flex-col mb-5">
        <div class="flex flex-col items-center justify-center">
            <div class="flex flex-col items-center justify-center">
                <div class="w-[100px] mb-2" id="previewPicture">
                    <img src="<?=$employee['profile']?>" alt="image" id="profileImage" class="mb-4 h-24 w-24 rounded-full object-cover">
                </div>
                <div class="text-xs font-bold">EMP ID: <?=$employee['employee_id']?></div>
                <h2 class="text-xl font-bold"><?=$employee['firstname'].' '.$employee['lastname']?></h2>
            </div>
        </div>
    </div>

</div>