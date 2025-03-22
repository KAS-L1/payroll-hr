<?php
    $payrolls = $DB->SELECT_WHERE("payroll", "*", ["status" => 'Pending'], "ORDER BY created_at DESC");
?>

<div class="page-content">

    <?php
        Breadcrumb([
            ['label' => 'Home', 'url' => '/dashboard'],
            ['label' => 'Payroll Processing', 'url' => '/payroll'],
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
                            <th class="uppercase text-xs">Total Days</th>
                            <th class="uppercase text-xs">Total Holidays</th>
                            <th class="uppercase text-xs">Status</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach ($payrolls as $payroll){ 

                            $employee = $DB->SELECT_ONE_WHERE("employees", "*", ["employee_id" => $payroll['employee_id']]);    
                        
                        ?>
                            <tr class="touchable" onclick="link('<?=ROUTE('payroll?emp_id='.$payroll['employee_id'].'&payroll_id='.$payroll['payroll_id'])?>')">
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
                                <td><?=$payroll['total_days']?></td>
                                <td><?=$payroll['total_holidays']?></td>
                                <td><span class="badge bg-dark rounded-full">Pending</span></td>
                            </tr>
                        <?php } ?>
                        
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="panel">
            
            <?php if(isset($_GET['emp_id'])){ ?>

                <?php
                    $employee_id = $_GET['emp_id']; 
                    $employee = $DB->SELECT_ONE_WHERE("employees", "*", ["employee_id" => $employee_id]);    

                    $benefits_compensation = $DB->SELECT_WHERE("benefits_compensation","*", ["employee_id" => $employee_id]);

                ?>
                
                <div class="flex flex-col items-center justify-center mb-4">
                    <div class="flex flex-col items-center justify-center">
                        <div class="w-[100px] mb-2" id="previewPicture">
                            <img src="<?=$employee['profile']?>" alt="image" id="profileImage" class="mb-4 h-20 w-20 rounded-full object-cover">
                        </div>
                        <div class="text-xs font-bold">ID: <?=$employee['employee_id']?></div>
                        <h4 class="text-xl font-bold"><?=$employee['firstname'].' '.$employee['lastname']?></h4>
                    </div>
                </div>

                <?php if(empty($benefits_compensation)){ ?>
                    <div class="flex items-center justify-center py-5">
                        <div class="font-bold text-danger">No Benefits & Compensation</div>
                    </div>
                <?php }else{ ?>
                    <table class="table table-bordered">
                        <?php 
                            $other_allowance=0;

                            foreach($benefits_compensation as $data){ 
                                
                                if($data['type'] == "Daily Rate"){
                                    $daily_rate = $data['amount'];
                                }
                                
                                if($data['type'] != "Daily Rate" AND $data['type'] != "Basic Salary"){
                                    if($data['amount'] > 0){
                                        $other_allowance += $data['amount'];
                                    }
                                }         
                        ?>
                            <?php if($data['amount'] > 0){ ?>
                                <tr>
                                    <td><?=$data['type']?></td>
                                    <td class="flex justify-end">
                                        <?=PESO($data['amount'])?>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php } ?>
                    </table>

                    <div class="text-md font-bold py-3 text-center">** DEDUCTIONS **</div>
                    <table class="table table-bordered">
                        <?php 
                            $total_deduction = 0;
                            foreach($benefits_compensation as $data){ ?>
                            <?php if($data['amount'] < 0){ 
                                $total_deduction += $data['amount'];
                            ?>
                                <tr>
                                    <td><?=$data['type']?></td>
                                    <td class="flex justify-end"><?=PESO($data['amount'])?></td>
                                </tr>
                            <?php } ?>
                        <?php } ?>
                    </table>

                    <?php 
                        $payroll_day = $DB->SELECT_ONE_WHERE("payroll", "*", ["employee_id" => $employee_id]);
                    ?>

                    <div class="text-md font-bold py-3 text-center">** SUMMARY **</div>
                    <table class="table table-bordered">
                        <tr>
                            <td>Total Days Work</td>
                            <td class="flex justify-end font-bold">
                                <?=$payroll_day['total_days']?>
                            </td>
                        </tr>
                        <tr>
                            <td>Work Pay Day</td>
                            <td class="flex justify-end font-bold">
                                <?php $total_workday = $daily_rate * $payroll_day['total_days']?>
                                <?=PESO($total_workday)?>
                            </td>
                        </tr>
                        <tr>
                            <td>Holiday Pay</td>
                            <td class="flex justify-end font-bold">
                                <?php $total_holiday = $daily_rate * ($payroll_day['total_holidays'] >= 1 ? $payroll_day['total_holidays'] * 2 : $payroll_day['total_holidays']) ?>
                                <?=PESO($total_holiday)?>
                            </td>
                        </tr>
                        <tr>
                            <td>Other Allowance</td>
                            <td class="flex justify-end font-bold">
                                <?=PESO($other_allowance)?>
                            </td>
                        </tr>
                    </table>

                    <table class="table table-bordered mt-4">
                        <tr>
                            <td>Gross Pay</td>
                            <td class="flex justify-end font-bold">
                                <?php $gross_pay = $total_workday + $total_holiday + $other_allowance?>
                               <?=PESO($gross_pay)?>
                            </td>
                        </tr>
                        <tr>
                            <td>Total Deduction</td>
                            <td class="flex justify-end font-bold">
                               - <?=PESO(abs($total_deduction))?>
                            </td>
                        </tr>
                        <tr>
                            <td>Net Pay</td>
                            <td class="flex justify-end font-bold">
                               <?php $net_pay = $gross_pay - abs($total_deduction)?>
                               <?=PESO($net_pay)?>
                            </td>
                        </tr>
                    </table>

                    <button class="btn btn-primary w-full mt-4" id="btnProcessPayroll">Process Payroll</button>
                    
                    <div id="responsePayroll"></div>
                    <script>
                        $('#btnProcessPayroll').click(function(){
                            const payroll_id = '<?=$_GET['payroll_id']?>';
                            const employee_id = '<?=$_GET['emp_id']?>';
                            const gross_pay = '<?=$gross_pay?>';
                            const total_deduction = '<?=abs($total_deduction)?>';
                            const net_pay = '<?=$net_pay?>';
                            btnLoading('#btnProcessPayroll');
                            $.post("<?=ROUTE('api/payroll/process.php')?>", {
                                payroll_id: payroll_id,
                                employee_id: employee_id,
                                gross_pay: gross_pay,
                                total_deduction: total_deduction,
                                net_pay: net_pay
                            }, function(res){
                                $('#responsePayroll').html(res);
                                btnLoadingReset('#btnProcessPayroll');
                            });
                        });
                    </script>
                
                <?php } ?>
            
            <?php } ?>
        </div>

    </div>
    
    <?php
        $payroll_process = $DB->SELECT_WHERE("payroll", "*", ["status" => 'Processing'], "ORDER BY updated_at DESC");
    ?>
    
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

                    <?php foreach ($payroll_process as $payroll){ 

                        $employee = $DB->SELECT_ONE_WHERE("employees", "*", ["employee_id" => $payroll['employee_id']]);
                        $summary = $DB->SELECT_ONE_WHERE("payroll_summary", "*", ["employee_id" => $payroll['employee_id']]);        
                        
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