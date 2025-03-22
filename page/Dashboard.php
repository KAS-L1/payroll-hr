
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
                            <p class="text-xl">Total Released</p>
                            <h5 class="text-2xl ltr:ml-auto rtl:mr-auto"><span class="text-white-light">₱</span>2953</h5>
                        </div>
                    </div>
                    <div class="-mt-12 grid grid-cols-2 gap-2 px-8">
                        <div class="rounded-md bg-white px-4 py-2.5 shadow dark:bg-[#060818]">
                            <span class="mb-4 flex items-center justify-between dark:text-white">Pending
                                <svg class="h-4 w-4 text-success" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M19 15L12 9L5 15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </span>
                            <div class="btn w-full border-0 bg-[#ebedf2] py-1 text-base text-[#515365] shadow-none dark:bg-black dark:text-[#bfc9d4]">
                                $97.99
                            </div>
                        </div>
                        <div class="rounded-md bg-white px-4 py-2.5 shadow dark:bg-[#060818]">
                            <span class="mb-4 flex items-center justify-between dark:text-white">Approved
                                <svg class="h-4 w-4 text-danger" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M19 9L12 15L5 9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </span>
                            <div class="btn w-full border-0 bg-[#ebedf2] py-1 text-base text-[#515365] shadow-none dark:bg-black dark:text-[#bfc9d4]">
                                $53.00
                            </div>
                        </div>
                    </div>
                    <div class="p-5">
                       
                    </div>
                </div>
                <div class="panel h-full pb-0 sm:col-span-2 xl:col-span-2">
                    <h5 class="mb-5 text-lg font-semibold dark:text-white-light">Recent Employees</h5>

                    <div class="perfect-scrollbar relative -mr-3 mb-4 h-[290px] pr-3">
                        <div class="cursor-pointer text-sm">
                            <div class="group relative flex items-center py-1.5">
                                <div class="h-1.5 w-1.5 rounded-full bg-primary ltr:mr-1 rtl:ml-1.5"></div>
                                <div class="flex-1">Updated Server Logs</div>
                                <div class="text-xs text-white-dark ltr:ml-auto rtl:mr-auto dark:text-gray-500">Just Now</div>

                                <span class="badge badge-outline-primary absolute bg-primary-light text-xs opacity-0 group-hover:opacity-100 ltr:right-0 rtl:left-0 dark:bg-[#0e1726]">Pending</span>
                            </div>
                            <div class="group relative flex items-center py-1.5">
                                <div class="h-1.5 w-1.5 rounded-full bg-success ltr:mr-1 rtl:ml-1.5"></div>
                                <div class="flex-1">Send Mail to HR and Admin</div>
                                <div class="text-xs text-white-dark ltr:ml-auto rtl:mr-auto dark:text-gray-500">2 min ago</div>

                                <span class="badge badge-outline-success absolute bg-success-light text-xs opacity-0 group-hover:opacity-100 ltr:right-0 rtl:left-0 dark:bg-[#0e1726]">Completed</span>
                            </div>
                            <div class="group relative flex items-center py-1.5">
                                <div class="h-1.5 w-1.5 rounded-full bg-danger ltr:mr-1 rtl:ml-1.5"></div>
                                <div class="flex-1">Backup Files EOD</div>
                                <div class="text-xs text-white-dark ltr:ml-auto rtl:mr-auto dark:text-gray-500">14:00</div>

                                <span class="badge badge-outline-danger absolute bg-danger-light text-xs opacity-0 group-hover:opacity-100 ltr:right-0 rtl:left-0 dark:bg-[#0e1726]">Pending</span>
                            </div>
                            <div class="group relative flex items-center py-1.5">
                                <div class="h-1.5 w-1.5 rounded-full bg-black ltr:mr-1 rtl:ml-1.5"></div>
                                <div class="flex-1">Collect documents from Sara</div>
                                <div class="text-xs text-white-dark ltr:ml-auto rtl:mr-auto dark:text-gray-500">16:00</div>

                                <span class="badge badge-outline-dark absolute bg-dark-light text-xs opacity-0 group-hover:opacity-100 ltr:right-0 rtl:left-0 dark:bg-[#0e1726]">Completed</span>
                            </div>
                            <div class="group relative flex items-center py-1.5">
                                <div class="h-1.5 w-1.5 rounded-full bg-warning ltr:mr-1 rtl:ml-1.5"></div>
                                <div class="flex-1">Conference call with Marketing Manager.</div>
                                <div class="text-xs text-white-dark ltr:ml-auto rtl:mr-auto dark:text-gray-500">17:00</div>

                                <span class="badge badge-outline-warning absolute bg-warning-light text-xs opacity-0 group-hover:opacity-100 ltr:right-0 rtl:left-0 dark:bg-[#0e1726]">In progress</span>
                            </div>
                            <div class="group relative flex items-center py-1.5">
                                <div class="h-1.5 w-1.5 rounded-full bg-info ltr:mr-1 rtl:ml-1.5"></div>
                                <div class="flex-1">Rebooted Server</div>
                                <div class="text-xs text-white-dark ltr:ml-auto rtl:mr-auto dark:text-gray-500">17:00</div>

                                <span class="badge badge-outline-info absolute bg-info-light text-xs opacity-0 group-hover:opacity-100 ltr:right-0 rtl:left-0 dark:bg-[#0e1726]">Completed</span>
                            </div>
                            <div class="group relative flex items-center py-1.5">
                                <div class="h-1.5 w-1.5 rounded-full bg-secondary ltr:mr-1 rtl:ml-1.5"></div>
                                <div class="flex-1">Send contract details to Freelancer</div>
                                <div class="text-xs text-white-dark ltr:ml-auto rtl:mr-auto dark:text-gray-500">18:00</div>

                                <span class="badge badge-outline-secondary absolute bg-secondary-light text-xs opacity-0 group-hover:opacity-100 ltr:right-0 rtl:left-0 dark:bg-[#0e1726]">Pending</span>
                            </div>
                            <div class="group relative flex items-center py-1.5">
                                <div class="h-1.5 w-1.5 rounded-full bg-primary ltr:mr-1 rtl:ml-1.5"></div>
                                <div class="flex-1">Updated Server Logs</div>
                                <div class="text-xs text-white-dark ltr:ml-auto rtl:mr-auto dark:text-gray-500">Just Now</div>

                                <span class="badge badge-outline-primary absolute bg-primary-light text-xs opacity-0 group-hover:opacity-100 ltr:right-0 rtl:left-0 dark:bg-[#0e1726]">Pending</span>
                            </div>
                            <div class="group relative flex items-center py-1.5">
                                <div class="h-1.5 w-1.5 rounded-full bg-success ltr:mr-1 rtl:ml-1.5"></div>
                                <div class="flex-1">Send Mail to HR and Admin</div>
                                <div class="text-xs text-white-dark ltr:ml-auto rtl:mr-auto dark:text-gray-500">2 min ago</div>

                                <span class="badge badge-outline-success absolute bg-success-light text-xs opacity-0 group-hover:opacity-100 ltr:right-0 rtl:left-0 dark:bg-[#0e1726]">Completed</span>
                            </div>
                            <div class="group relative flex items-center py-1.5">
                                <div class="h-1.5 w-1.5 rounded-full bg-danger ltr:mr-1 rtl:ml-1.5"></div>
                                <div class="flex-1">Backup Files EOD</div>
                                <div class="text-xs text-white-dark ltr:ml-auto rtl:mr-auto dark:text-gray-500">14:00</div>

                                <span class="badge badge-outline-danger absolute bg-danger-light text-xs opacity-0 group-hover:opacity-100 ltr:right-0 rtl:left-0 dark:bg-[#0e1726]">Pending</span>
                            </div>
                            <div class="group relative flex items-center py-1.5">
                                <div class="h-1.5 w-1.5 rounded-full bg-black ltr:mr-1 rtl:ml-1.5"></div>
                                <div class="flex-1">Collect documents from Sara</div>
                                <div class="text-xs text-white-dark ltr:ml-auto rtl:mr-auto dark:text-gray-500">16:00</div>

                                <span class="badge badge-outline-dark absolute bg-dark-light text-xs opacity-0 group-hover:opacity-100 ltr:right-0 rtl:left-0 dark:bg-[#0e1726]">Completed</span>
                            </div>
                            <div class="group relative flex items-center py-1.5">
                                <div class="h-1.5 w-1.5 rounded-full bg-warning ltr:mr-1 rtl:ml-1.5"></div>
                                <div class="flex-1">Conference call with Marketing Manager.</div>
                                <div class="text-xs text-white-dark ltr:ml-auto rtl:mr-auto dark:text-gray-500">17:00</div>

                                <span class="badge badge-outline-warning absolute bg-warning-light text-xs opacity-0 group-hover:opacity-100 ltr:right-0 rtl:left-0 dark:bg-[#0e1726]">In progress</span>
                            </div>
                            <div class="group relative flex items-center py-1.5">
                                <div class="h-1.5 w-1.5 rounded-full bg-info ltr:mr-1 rtl:ml-1.5"></div>
                                <div class="flex-1">Rebooted Server</div>
                                <div class="text-xs text-white-dark ltr:ml-auto rtl:mr-auto dark:text-gray-500">17:00</div>

                                <span class="badge badge-outline-info absolute bg-info-light text-xs opacity-0 group-hover:opacity-100 ltr:right-0 rtl:left-0 dark:bg-[#0e1726]">Completed</span>
                            </div>
                            <div class="group relative flex items-center py-1.5">
                                <div class="h-1.5 w-1.5 rounded-full bg-secondary ltr:mr-1 rtl:ml-1.5"></div>
                                <div class="flex-1">Send contract details to Freelancer</div>
                                <div class="text-xs text-white-dark ltr:ml-auto rtl:mr-auto dark:text-gray-500">18:00</div>

                                <span class="badge badge-outline-secondary absolute bg-secondary-light text-xs opacity-0 group-hover:opacity-100 ltr:right-0 rtl:left-0 dark:bg-[#0e1726]">Pending</span>
                            </div>
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
