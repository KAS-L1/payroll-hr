<div class="page-content">

    <?php
        Breadcrumb([
            ['label' => 'Home', 'url' => '/dashboard'],
            ['label' => 'Users', 'url' => '/users'],
            ['label' => 'Add', 'url' => '/users/add'],
        ]);
    ?>

    <div class="pt-5">
        <div class="panel">
            <div class="mb-5">
                <h5 class="text-lg font-semibold dark:text-white-light">Create User Account <span class="text-danger">*</span></h5>
            </div>

            <div class="mb-5">
                <form id="formCreateUser">
                    <div id="responseCreateUser"></div>
                    <?= CSRF(); ?>
                    <!-- USER DETAILS -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label for="first_name">First Name</label>
                            <?= Input("text", "firstname", null, null, null, null, 'required') ?>
                        </div>
                        <div>
                            <label for="last_name">Last Name</label>
                            <?= Input("text", "lastname", null, null, null, null, 'required') ?>
                        </div>
                        <div>
                            <label for="username">Username</label>
                            <?= Input("text", "username", null, null, null, null, 'required') ?>
                        </div>
                        <div>
                            <label for="email">Email</label>
                            <?= Input("text", "email", null, null, null, null, 'required') ?>
                        </div>
                        <div>
                            <label for="address">Address</label>
                            <?= Input("text", "address", null, null, null, null) ?>
                        </div>
                        <div>
                            <label for="contact">Contact</label>
                            <?= Input("text", "contact", null, null, null, null, 'required') ?>
                        </div>
                    </div>

                    <!-- ROLE SELECTION WITH DESCRIPTIONS -->
                    <div class="mt-5">
                        <h5 class="font-semibold">Select Role <span class="text-danger">*</span></h5>
                        <ul class="space-y-4 mt-3">
                            <?php

                                $roles = [
                                    "Admin" => "Has full access to the system, including managing users, settings, security, and all administrative functions.",
                                    "Hr" => "Oversees operations, manages payroll, and benifits compensation.",
                                    "Finance" => "Handles payroll approval and budget releases."
                                ];

                                foreach ($roles as $role => $description){
                                    $role_id = strtolower(str_replace(' ', '_', $role));
                                    ?>
                                        <li>
                                            <div class="flex items-start gap-2">
                                                <input type="radio" id="role_<?= $role_id; ?>" name="role" class="form-radio h-4 w-4 text-blue-600" value="<?= $role; ?>" required>
                                                <label class="ml-2" for="role_<?= $role_id; ?>">
                                                    <div class="font-semibold"><?= $role; ?></div>
                                                    <p class="text-xs text-gray-500"><?= $description; ?></p>
                                                </label>
                                            </div>
                                        </li>
                                    <?php
                                }
                                
                            ?>
                        </ul>
                    </div>

                    <!-- PASSWORD SECTION (NOW INSIDE FORM) -->
                    <div class="mt-5">
                        <div class="mb-5">
                            <h5 class="text-lg font-semibold dark:text-white-light">Set User Password <span class="text-danger">*</span></h5>
                        </div>

                        <!-- ALERT NOTIFICATION -->
                        <div class="bg-info border border-info px-4 py-3 mb-5 rounded relative text-md flex items-center dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300 text-white">
                            <i class="fas fa-info-circle mr-2"></i>
                            <span>Please enter a secure password and confirm it.</span>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label for="password">Password</label>
                                <?= Input("password", "password", null, null, null, null, 'required minlength="6"') ?>
                            </div>
                            <div>
                                <label for="confirmPassword">Confirm Password</label>
                                <?= Input("password", "confirmPassword", null, null, null, null, 'required minlength="6"') ?>
                            </div>
                        </div>

                        <div class="flex items-center pl-1 mt-3">
                            <input type="checkbox" id="togglePassword" class="form-checkbox h-4 w-4 text-blue-600 transition duration-150 ease-in-out">
                            <label for="togglePassword" class="ml-2 mt-2 text-sm text-gray-600">Show Password</label>
                        </div>
                    </div>

                    <!-- SAVE BUTTON (UPDATED TEXT) -->
                    <div class="mt-4 text-right">
                        <?= Button("submit", "btnCreateUser", "Save", null) ?>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<script>
    // PASSWORD TOGGLE
    $('#togglePassword').change(function() {
        if ($(this).is(':checked')) {
            $('#password').attr('type', 'text');
            $('#confirmPassword').attr('type', 'text');
            $('label[for="togglePassword"]').text('Hide Password');
        } else {
            $('#password').attr('type', 'password');
            $('#confirmPassword').attr('type', 'password');
            $('label[for="togglePassword"]').text('Show Password');
        }
    });

    // FORM SUBMISSION
    $('#formCreateUser').submit(function(e) {
        e.preventDefault();
        btnLoading('#btnCreateUser');
        $.post("<?=Route('api/user/add.php')?>", $('#formCreateUser').serialize(), function(res) {
            $('#responseCreateUser').html(res);
            btnLoadingReset('#btnCreateUser');
        }).fail(function() {
            $('#responseCreateUser').html('<div class="text-red-500">An error occurred. Please try again.</div>');
            btnLoadingReset('#btnCreateUser');
        });
    });
</script>