<?php
    $users = $DB->SELECT("users", "*", "ORDER BY created_at DESC");
?>

<div class="page-content">

    <?php
        Breadcrumb([
            ['label' => 'Home', 'url' => '/dashboard'],
            ['label' => 'User Management', 'url' => '/users'],
        ]);
    ?>

    <div class="panel h-full flex-col">
        <div class="flex justify-end">
            <a href="<?=Route('users/add')?>" class="btn btn-primary">
                <i class="fas fa-user-plus mr-2"></i> Add User
            </a>
        </div>
        <div class="table-responsive  min-h-[400px] grow overflow-y-auto sm:min-h-[300px]">
            <table id="dataTable" class="table-bordered table-hover">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Username</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Contact</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Address</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Role</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Created</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($users as $user){ ?>
                        <tr>
                            <td class="p-2 lg:p-4">
                                <div class="flex flex-col sm:flex-row items-center gap-3">
                                    <div class="w-12 h-12 min-w-12 shrink-0">
                                        <img class="w-full h-full rounded-full object-cover" src="<?= DOMAIN ?>/upload/profile/<?= $user['picture'] ?>" alt="Profile picture" />
                                    </div>
                                    <div class="text-sm font-bold sm:text-base text-center sm:text-left break-words max-w-[200px]">
                                        <?= $user['firstname'] . ' ' . $user['lastname'] ?>
                                    </div>
                                </div>
                            </td>
                            <td><?= $user['username'] ?></td>
                            <td><?= $user['email'] ?></td>
                            <td><?= $user['contact'] ?></td>
                            <td><?= $user['address'] ?></td>
                            <td><?= UPPER($user['role']) ?></td>
                            <td><?= badge($user['status']) ?></td>
                            <td><?= DATE_TIME_SHORT($user['created_at']) ?></td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center items-center gap-3">
                                    <a href="<?=Route('users/details?user_id='.$user['user_id'])?>" x-tooltip="Details" class="text-primary p-2">
                                        <i class="fa fa-eye text-lg"></i>
                                    </a>
                                </div>
                            </td>
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