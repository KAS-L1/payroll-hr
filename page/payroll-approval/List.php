<?php
    $payroll_process = $DB->SELECT_WHERE("payroll", "*", ["status" => 'Processing'], "ORDER BY updated_at DESC");
?>

<div class="page-content">

    <?php
        Breadcrumb([
            ['label' => 'Home', 'url' => '/dashboard'],
            ['label' => 'Payroll Approval', 'url' => '/payroll-approval'],
        ]);
    ?>

    <div class="mb-5 grid gap-6 sm:grid-cols-3 xl:grid-cols-4">
        
        <div class="panel sm:col-span-2 xl:col-span-3">
            <div class="table-responsive min-h-[400px] grow overflow-y-auto sm:min-h-[300px]">
                <table id="dataTable" class="table-bordered table-hover">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="uppercase text-xs">Payroll ID</th>
                            <th class="uppercase text-xs">Employee ID</th>
                            <th class="uppercase text-xs">Employee Name</th>
                            <th class="uppercase text-xs">Cutoff Start</th>
                            <th class="uppercase text-xs">Cutoff End</th>
                            <th class="uppercase text-xs">Gross</th>
                            <th class="uppercase text-xs">Deduction</th>
                            <th class="uppercase text-xs">Net</th>
                            <th class="uppercase text-xs">Status</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php 
                            $employees = 0;
                            $total_net = 0;
                            $total_deduction = 0;
                            foreach ($payroll_process as $payroll){ 

                                $employee = $DB->SELECT_ONE_WHERE("employees", "*", ["employee_id" => $payroll['employee_id']]);
                                $summary = $DB->SELECT_ONE_WHERE("payroll_summary", "*", ["employee_id" => $payroll['employee_id']]);        

                                $employees++;
                                $total_net += $summary['net'];
                                $total_deduction += $summary['deduction'];

                        ?>
                            <tr>
                                <td><?=$payroll['payroll_id']?></td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-center items-center gap-3">
                                        <i class="fa fa-eye text-lg text-primary"></i> <b><?=$payroll['employee_id']?></b>
                                    </div>
                                </td>
                                <td>
                                    <div class="flex flex-col sm:flex-row items-center gap-3">
                                        <div class="w-12 h-12 min-w-12 shrink-0">
                                            <img class="w-full h-full rounded-full object-cover" src="<?=$employee['profile']?>" alt="Profile" />
                                        </div>
                                        <div class="text-sm sm:text-base text-center sm:text-left break-words max-w-[200px]">
                                            <?= $employee['firstname'] . ' ' . $employee['lastname'] ?>
                                        </div>
                                    </div>
                                </td>
                                <td><?=$payroll['cutoff_start']?></td>
                                <td><?=$payroll['cutoff_end']?></td>
                                <td class="font-bold"><?=PESO($summary['gross'])?></td>
                                <td class="font-bold"><?=PESO($summary['deduction'])?></td>
                                <td class="font-bold"><?=PESO($summary['net'])?></td>
                                <td><span class="badge bg-secondary rounded-full">Processing</span></td>
                            </tr>
                        <?php } ?>
                        
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="panel h-full overflow-hidden border-0 p-0">
            <div class="min-h-[190px] bg-gradient-to-r from-[#4361ee] to-[#160f6b] p-6">
                <div class="flex items-center justify-between text-white">
                    <p class="text-xl">Total Net Release</p>
                    <h5 class="text-2xl ltr:ml-auto rtl:mr-auto"><span class="text-white-light">₱</span><?=NUMBER($total_net)?></h5>
                </div>
            </div>
            <div class="-mt-12 grid grid-cols-2 gap-2 px-8">
                <div class="rounded-md bg-white px-4 py-2.5 shadow dark:bg-[#060818]">
                    <span class="mb-4 flex items-center justify-between dark:text-white">Employees
                        <svg class="h-4 w-4 text-success" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M19 15L12 9L5 15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </span>
                    <div class="btn w-full border-0 bg-[#ebedf2] py-1 text-base text-[#515365] shadow-none dark:bg-black dark:text-[#bfc9d4]">
                        <?=$employees?>
                    </div>
                </div>
                <div class="rounded-md bg-white px-4 py-2.5 shadow dark:bg-[#060818]">
                    <span class="mb-4 flex items-center justify-between dark:text-white">Total Deduction
                        <svg class="h-4 w-4 text-danger" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M19 9L12 15L5 9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </span>
                    <div class="btn w-full border-0 bg-[#ebedf2] py-1 text-base text-[#515365] shadow-none dark:bg-black dark:text-[#bfc9d4]">
                        <?=PESO($total_deduction)?>
                    </div>
                </div>
            </div>
            
            <?php if(!empty($employees)){ ?>
                <div class="p-5">
                    <button class="btn btn-primary w-full mt-4" id="btnApprovePayroll">Approve Payroll</button>
                </div>
            <?php } ?>

            <div id="responsePayroll"></div>
            <script>
                $('#btnApprovePayroll').click(function(){
                    btnLoading('#btnApprovePayroll');
                    $.post("<?=ROUTE('api/payroll/approve.php')?>", {
                        action: 'Approve'
                    }, function(res){
                        $('#responsePayroll').html(res);
                        btnLoadingReset('#btnApprovePayroll');
                    });
                });
            </script>

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