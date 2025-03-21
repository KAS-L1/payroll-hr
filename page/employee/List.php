<?php
    $employees = $DB->SELECT("employees", "*", "ORDER BY created_at DESC");
?>

<div class="page-content">

    <?php
        Breadcrumb([
            ['label' => 'Home', 'url' => '/dashboard'],
            ['label' => 'Employees', 'url' => '/employees'],
        ]);
    ?>

    <div class="panel h-full flex-col">
        <div class="flex justify-end">
            <button class="btn btn-primary">
                <i class="bi bi-people mr-2"></i> Sync Employees
            </button>
        </div>
        <div class="table-responsive  min-h-[400px] grow overflow-y-auto sm:min-h-[300px]">
            <table id="dataTable" class="table-bordered table-hover">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="uppercase text-xs">Employee ID</th>
                        <th class="uppercase text-xs">Employee Name</th>
                        <th class="uppercase text-xs">Email</th>
                        <th class="uppercase text-xs">Contact</th>
                        <th class="uppercase text-xs">Position</th>
                        <th class="uppercase text-xs">Birthdate</th>
                        <th class="uppercase text-xs">Gender</th>
                        <th class="uppercase text-xs">Civil Status</th>
                        <th class="uppercase text-xs">Address</th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($employees as $employee){ ?>
                        <tr>
                            <td class="px-6 py-4">
                                <div class="flex justify-center items-center gap-3">
                                    <a href="<?=ROUTE('employees/details?emp_id='.$employee['employee_id'])?>" x-tooltip="Details" class="p-2">
                                        <i class="fa fa-eye text-lg text-primary"></i> <b><?=$employee['employee_id']?></b>
                                    </a>
                                </div>
                            </td>
                            <td class="p-2 lg:p-4">
                                <div class="flex flex-col sm:flex-row items-center gap-3">
                                    <div class="w-12 h-12 min-w-12 shrink-0">
                                        <img class="w-full h-full rounded-full object-cover" src="<?=DOMAIN?>/upload/profile/default.png" alt="Profile" />
                                    </div>
                                    <div class="text-sm sm:text-base text-center sm:text-left break-words max-w-[200px]">
                                        <?= $employee['firstname'] . ' ' . $employee['lastname'] ?>
                                    </div>
                                </div>
                            </td>
                            <td><?= $employee['email'] ?></td>
                            <td><?= $employee['contact'] ?></td>
                            <td><?= $employee['position'] ?></td>
                            <td><?= $employee['birthdate'] ?></td>
                            <td><?= $employee['gender'] ?></td>
                            <td><?= $employee['civil_status'] ?></td>
                            <td><?= $employee['address'] ?></td>
                        </tr>
                    <?php } ?>
                    
                </tbody>
            </table>
        </div>
    </div>

</div>


<script>
    let table = new DataTable('#dataTable', {
        layout: {
            topStart: {
                buttons: [{
                        extend: 'pdfHtml5',
                        text: '<i class="fa fa-file-pdf text-danger text-lg"></i> PDF',
                        className: 'btn btn-outline-danger btn-sm',
                        download: 'open',
                        orientation: 'landscape',
                        pageSize: 'LEGAL'
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fa fa-file-excel text-primary text-lg"></i> Excel',
                        className: 'btn btn-outline-success btn-sm'
                    },
                    {
                        extend: 'colvis',
                        text: '<i class="fa fa-eye text-info text-lg"></i> Columns',

                    }
                ],
            }
        }
    });
</script>