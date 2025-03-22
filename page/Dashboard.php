
<?php
    $payroll_paid = $DB->SELECT_ONE("payroll_summary", "SUM(net) AS totalPaid");
    
    $total_pending = $DB->SELECT_ONE_WHERE("payroll", "COUNT(id) AS totalEmployee", ["status" => 'Pending']);

    $payroll_approved = $DB->SELECT_WHERE("payroll", "*", ["status" => 'Processing'], "ORDER BY updated_at DESC");
    
    $total_processing = 0;
    foreach ($payroll_approved as $payroll){
        $summary = $DB->SELECT_ONE("payroll_summary", "*");        
        $total_processing += $summary['net'];
    }

?>


<div x-data="sales">

    <?php
        Breadcrumb([
            ['label' => 'Dashboard'],
            ['label' => 'Analytics'],
        ]);
    ?>

        <div class="pt-5">
           
            <div class="mb-6 grid gap-6 sm:grid-cols-2 xl:grid-cols-3">
                
                <div class="panel h-full overflow-hidden border-0 p-0">
                    <div class="min-h-[190px] bg-gradient-to-r from-[#4361ee] to-[#160f6b] p-6">
                        <div class="flex items-center justify-between text-white">
                            <p class="text-xl">Total Payroll Approved</p>
                            <h5 class="text-2xl ltr:ml-auto rtl:mr-auto"><span class="text-white-light">₱</span><?=NUMBER($payroll_paid['totalPaid'])?></h5>
                        </div>
                    </div>
                    <div class="-mt-12 grid grid-cols-2 gap-2 px-8">
                        <div class="rounded-md bg-white px-4 py-2.5 shadow dark:bg-[#060818]">
                            <span class="mb-4 flex items-center justify-between dark:text-white">Pending Payroll
                                <svg class="h-4 w-4 text-success" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M19 15L12 9L5 15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </span>
                            <div class="btn w-full border-0 bg-[#ebedf2] py-1 text-base text-[#515365] shadow-none dark:bg-black dark:text-[#bfc9d4]">
                                <?=$total_pending['totalEmployee']?>
                            </div>
                        </div>
                        <div class="rounded-md bg-white px-4 py-2.5 shadow dark:bg-[#060818]">
                            <span class="mb-4 flex items-center justify-between dark:text-white">Processing
                                <svg class="h-4 w-4 text-danger" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M19 9L12 15L5 9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </span>
                            <div class="btn w-full border-0 bg-[#ebedf2] py-1 text-base text-[#515365] shadow-none dark:bg-black dark:text-[#bfc9d4]">
                                <?=$total_processing?>
                            </div>
                        </div>
                    </div>
                    <div class="p-5">
                       
                    </div>
                </div>

                <div class="panel h-full pb-0 sm:col-span-2 xl:col-span-2">

                    <?php
                        $payroll_transactions = $DB->SELECT_WHERE("payroll", "*", ["status" => 'Approved'], "ORDER BY updated_at DESC");
                    ?>
                
                    <h5 class="mb-5 text-lg font-semibold dark:text-white-light">Recent Approve Payroll</h5>

                    <div class="perfect-scrollbar relative -mr-3 mb-4 h-[290px] pr-3">
                        <div class="cursor-pointer text-sm">
                            <?php foreach ($payroll_transactions as $payroll){ 

                                $employee = $DB->SELECT_ONE_WHERE("employees", "*", ["employee_id" => $payroll['employee_id']]);    
                                $summary = $DB->SELECT_ONE_WHERE("payroll_summary", "*", ["employee_id" => $payroll['employee_id']]);        
                            
                            ?>
                                <div class="group relative flex items-center py-1.5">
                                    <div class="h-1.5 w-1.5 rounded-full bg-primary ltr:mr-1 rtl:ml-1.5"></div>
                                    <div class="flex-1"><?= $employee['firstname'].' '.$employee['lastname']?></div>
                                    <div class="text-xs text-white-dark ltr:ml-auto rtl:mr-auto dark:text-gray-500 font-bold"><?=PESO($summary['net'])?></div>
                                    <span class="badge badge-outline-primary absolute bg-primary-light text-xs opacity-0 group-hover:opacity-100 ltr:right-0 rtl:left-0 dark:bg-[#0e1726]">Pending</span>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="border-t border-white-light dark:border-white/10">
                        <a href="javascript:;" class="group group flex items-center justify-center p-4 font-semibold hover:text-primary">
                            View All
                            <svg class="h-4 w-4 transition duration-300 group-hover:translate-x-1 ltr:ml-1 rtl:mr-1 rtl:rotate-180 rtl:group-hover:-translate-x-1" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4 12H20M20 12L14 6M20 12L14 18" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </a>
                    </div>
                </div>

            </div>

        </div>
</div>
