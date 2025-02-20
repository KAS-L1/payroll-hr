<?php
    $get_user_id = $_GET['user_id'] ?? null;
    $user = $DB->SELECT_ONE_WHERE("users", "*", ["user_id" => $get_user_id]);
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>

<div>

    <?php
    breadcrumb([
        ['label' => 'Home', 'url' => '/dashboard'],
        ['label' => 'User Management', 'url' => '/user-management'],
        ['label' => 'Details', 'url' => '/user-management/details'],
    ]);
    ?>

    <div class="pt-5">
        <div class="mb-5 grid grid-cols-1 gap-5 lg:grid-cols-3 xl:grid-cols-4">
            <div class="panel">
                <div class="mb-5 flex items-center justify-between">
                    <h5 class="text-lg font-semibold dark:text-white-light">Profile</h5>
                </div>
                <div class="mb-5">
                    <div class="flex flex-col items-center justify-center">
                        <div class="flex flex-col items-center justify-center">
                            <div class="w-[100px] mb-3" id="previewPicture">
                                <img src="<?= DOMAIN ?>/upload/profile/<?= $user['picture'] ?>" alt="image" id="profileImage" class="mb-4 h-24 w-24 rounded-full object-cover">
                            </div>
                        </div>
                        <div class="text-xl font-semibold text-primary"><?= $user['firstname'] . ' ' . $user['lastname'] ?></div>
                        <ul class="m-auto mt-5 flex max-w-[300px] flex-col space-y-4 font-semibold text-white-dark">
                            <li class="flex items-center gap-2">
                                <svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0">
                                    <path d="M2.3153 12.6978C2.26536 12.2706 2.2404 12.057 2.2509 11.8809C2.30599 10.9577 2.98677 10.1928 3.89725 10.0309C4.07094 10 4.286 10 4.71612 10H15.2838C15.7139 10 15.929 10 16.1027 10.0309C17.0132 10.1928 17.694 10.9577 17.749 11.8809C17.7595 12.057 17.7346 12.2706 17.6846 12.6978L17.284 16.1258C17.1031 17.6729 16.2764 19.0714 15.0081 19.9757C14.0736 20.6419 12.9546 21 11.8069 21H8.19303C7.04537 21 5.9263 20.6419 4.99182 19.9757C3.72352 19.0714 2.89681 17.6729 2.71598 16.1258L2.3153 12.6978Z" stroke="currentColor" stroke-width="1.5"></path>
                                    <path opacity="0.5" d="M17 17H19C20.6569 17 22 15.6569 22 14C22 12.3431 20.6569 11 19 11H17.5" stroke="currentColor" stroke-width="1.5"></path>
                                    <path opacity="0.5" d="M10.0002 2C9.44787 2.55228 9.44787 3.44772 10.0002 4C10.5524 4.55228 10.5524 5.44772 10.0002 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M4.99994 7.5L5.11605 7.38388C5.62322 6.87671 5.68028 6.0738 5.24994 5.5C4.81959 4.9262 4.87665 4.12329 5.38382 3.61612L5.49994 3.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M14.4999 7.5L14.6161 7.38388C15.1232 6.87671 15.1803 6.0738 14.7499 5.5C14.3196 4.9262 14.3767 4.12329 14.8838 3.61612L14.9999 3.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                                <?= $user['role'] . " - " . $user['user_id'] ?>
                            </li>
                            <li class="flex items-center gap-2">
                                <svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0">
                                    <path opacity="0.5" d="M4 10.1433C4 5.64588 7.58172 2 12 2C16.4183 2 20 5.64588 20 10.1433C20 14.6055 17.4467 19.8124 13.4629 21.6744C12.5343 22.1085 11.4657 22.1085 10.5371 21.6744C6.55332 19.8124 4 14.6055 4 10.1433Z" stroke="currentColor" stroke-width="1.5"></path>
                                    <circle cx="12" cy="10" r="3" stroke="currentColor" stroke-width="1.5"></circle>
                                </svg>
                                <?= $user['address'] ?>
                            </li>
                            <li>
                                <a href="javascript:;" class="flex items-center gap-2">
                                    <svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0">
                                        <path opacity="0.5" d="M2 12C2 8.22876 2 6.34315 3.17157 5.17157C4.34315 4 6.22876 4 10 4H14C17.7712 4 19.6569 4 20.8284 5.17157C22 6.34315 22 8.22876 22 12C22 15.7712 22 17.6569 20.8284 18.8284C19.6569 20 17.7712 20 14 20H10C6.22876 20 4.34315 20 3.17157 18.8284C2 17.6569 2 15.7712 2 12Z" stroke="currentColor" stroke-width="1.5"></path>
                                        <path d="M6 8L8.1589 9.79908C9.99553 11.3296 10.9139 12.0949 12 12.0949C13.0861 12.0949 14.0045 11.3296 15.8411 9.79908L18 8" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                                    </svg>
                                    <span class="truncate text-primary"> <?= $user['email'] ?>
                                    </span></a>
                            </li>
                            <li class="flex items-center gap-2">
                                <svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5">
                                    <path d="M16.1007 13.359L16.5562 12.9062C17.1858 12.2801 18.1672 12.1515 18.9728 12.5894L20.8833 13.628C22.1102 14.2949 22.3806 15.9295 21.4217 16.883L20.0011 18.2954C19.6399 18.6546 19.1917 18.9171 18.6763 18.9651M4.00289 5.74561C3.96765 5.12559 4.25823 4.56668 4.69185 4.13552L6.26145 2.57483C7.13596 1.70529 8.61028 1.83992 9.37326 2.85908L10.6342 4.54348C11.2507 5.36691 11.1841 6.49484 10.4775 7.19738L10.1907 7.48257" stroke="currentColor" stroke-width="1.5"></path>
                                    <path opacity="0.5" d="M18.6763 18.9651C17.0469 19.117 13.0622 18.9492 8.8154 14.7266C4.81076 10.7447 4.09308 7.33182 4.00293 5.74561" stroke="currentColor" stroke-width="1.5"></path>
                                    <path opacity="0.5" d="M16.1007 13.3589C16.1007 13.3589 15.0181 14.4353 12.0631 11.4971C9.10807 8.55886 10.1907 7.48242 10.1907 7.48242" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                                </svg>
                                <span class="whitespace-nowrap" dir="ltr"> <?= $user['contact'] ?>
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel lg:col-span-2 xl:col-span-3">
                <div class="mb-5">
                    <h5 class="text-lg font-semibold dark:text-white-light">Account Information <span class="text-danger">*</span></h5>
                </div>
                <div class="mb-5">
                    <form id="formAccount">
                        <?= CSRF(); ?>
                        <input type="hidden" name="user_id" value="<?= $user['user_id'] ?>">
                        <div class="flex flex-col sm:flex-row">
                            <div class="grid flex-1 grid-cols-1 gap-5 sm:grid-cols-2 ml-2">
                                <div>
                                    <label for="first_name">First Name</label>
                                    <div class="relative text-white-dark mb-4">
                                        <?= Input("text", "firstname", $user['firstname'], null, null, null, 'required') ?>
                                    </div>
                                </div>
                                <div>
                                    <label for="last_name">Last Name</label>
                                    <div class="relative text-white-dark mb-4">
                                        <?= Input("text", "lastname", $user['lastname'], null, null, null, 'required') ?>
                                    </div>
                                </div>
                                <div>
                                    <label for="username">User Name</label>
                                    <div class="relative text-white-dark mb-4">
                                        <?= Input("text", "username", $user['username'], null, null, null, 'required') ?>
                                    </div>
                                </div>
                                <div>
                                    <label for="email">Email</label>
                                    <div class="relative text-white-dark mb-4">
                                        <?= Input("text", "email", $user['email'], null, null, null, 'required') ?>
                                    </div>
                                </div>
                                <div>
                                    <label for="address">Address</label>
                                    <div class="relative text-white-dark mb-4">
                                        <?= Input("text", "address", $user['address'], null, null, null) ?>
                                    </div>
                                </div>
                                <div>
                                    <label for="contact">Contact</label>
                                    <div class="relative text-white-dark mb-4">
                                        <?= Input("text", "contact", $user['contact'], null, null, null, 'required') ?>
                                    </div>
                                </div>
                                <div class="sm:col-span-2">
                                    <?= Button("submit", "btnLogin", "Update", null) ?>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div id="responseAccount"></div>
                    <script>
                        $('#formAccount').submit(function(e) {
                            e.preventDefault();
                            btnLoading('#btnLogin');
                            $.post('<?=Route('api/user/update_account.php')?>', $('#formAccount').serialize(), function(res) {
                                $('#responseAccount').html(res);
                                btnLoadingReset('#btnLogin');
                            })
                        })
                    </script>
                </div>
            </div>
        </div>

        <div class="mb-5 grid grid-cols-1 gap-5 lg:grid-cols-3 xl:grid-cols-4">
            <div class="empty"></div>
            <div class="panel lg:col-span-2 xl:col-span-3">
                <div class="mb-5">
                    <h5 class="text-lg font-semibold dark:text-white-light">Account Password <span class="text-danger">*</span></h5>
                </div>
                <div class="mb-5">
                    <form id="formPassword">
                        <?= CSRF(); ?>
                        <input type="hidden" name="user_id" value="<?= $user['user_id'] ?>">
                        <div class="bg-info border border-info px-4 py-3 mb-5 rounded relative mb-3 text-md flex items-center dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300 text-white" role="alert">
                            <i class="fas fa-info-circle mr-2"></i><span>Please enter new password and confirm new password to update the user password.</span>
                        </div>
                        <div class="flex flex-col sm:flex-row">
                            <div class="grid flex-1 grid-cols-1 gap-5 sm:grid-cols-2 ml-2">
                                <div>
                                    <label for="newPassword">New Password</label>
                                    <div class="relative text-white-dark mb-4">
                                        <?= Input("password", "newPassword", null, null, null, null, 'required minlength="6"') ?>
                                    </div>
                                </div>
                                <div>
                                    <label for="confirmPassword">Confirm Password</label>
                                    <div class="relative text-white-dark mb-4">
                                        <?= Input("password", "confirmPassword", null, null, null, null, 'required minlength="6"') ?>
                                    </div>
                                </div>

                                <div class="flex items-center pl-1">
                                    <input type="checkbox" id="togglePassword" class="form-checkbox h-4 w-4 text-blue-600 transition duration-150 ease-in-out">
                                    <label for="togglePassword" class="ml-2 mt-2 text-sm text-gray-600">Show Password</label>
                                </div>

                                <div class="sm:col-span-2">
                                    <?= Button("submit", "btnUpdatePassword", "Update", null) ?>
                                </div>
                            </div>
                        </div>
                        <div id="responsePassword"></div>
                        <script>
                            $('#togglePassword').change(function() {
                                if ($(this).is(':checked')) {
                                    $('#newPassword').attr('type', 'text');
                                    $('#confirmPassword').attr('type', 'text');
                                    $('label[for="togglePassword"]').text('Hide Password');
                                } else {
                                    $('#newPassword').attr('type', 'password');
                                    $('#confirmPassword').attr('type', 'password');
                                    $('label[for="togglePassword"]').text('Show Password');
                                }
                            });

                            $('#formPassword').submit(function(e) {
                                e.preventDefault();
                                btnLoading('#btnUpdatePassword');
                                $.post('<?=Route('api/user/update_password.php')?>', $('#formPassword').serialize(), function(res) {
                                    $('#responsePassword').html(res);
                                    btnLoadingReset('#btnUpdatePassword');
                                }).fail(function() {
                                    $('#responsePassword').html('An error occurred. Please try again.');
                                });
                            });
                        </script>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="mb-5 grid grid-cols-1 gap-5 lg:grid-cols-3 xl:grid-cols-4">
            <div class="empty"></div>
            <div class="panel lg:col-span-2 xl:col-span-3">
                <div class="mb-5">
                    <h5 class="text-lg font-semibold dark:text-white-light">Account Role <span class="text-danger">*</span></h5>
                </div>
                <div class="mb-5">
                    <div id="responseRole"></div>
                    <form id="formRole">
                        <?= CSRF(); ?>
                        <input type="hidden" name="user_id" value="<?= $user['user_id']; ?>">

                        <ul class="space-y-4">
                            <?php

                                $roles = [
                                    "Admin" => "Has full access to the system, including managing users, settings, security, and all administrative functions.",
                                    "Hr" => "Oversees operations, manages payroll, and benifits compensation.",
                                    "Finance" => "Handles payroll approval and budget releases."
                                ];

                                foreach ($roles as $role => $description){
                                    $role_id = strtolower(str_replace(' ', '_', $role));
                                    $checked = ($user['role'] == $role) ? 'checked' : '';
                                    ?>
                                        <li>
                                            <div class="flex items-start gap-2">
                                                <input type="radio" id="role_<?= $role_id; ?>" name="role" class="form-radio h-4 w-4 text-blue-600" value="<?= $role; ?>" <?= $checked; ?> required>
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

                        <div class="text-right mt-4">
                            <div class="sm:col-span-2">
                                <?= Button("submit", "btnUpdateRole", "Update", null) ?>
                            </div>
                        </div>

                    </form>

                    <script>
                        $('#formRole').submit(function(e) {
                            e.preventDefault();
                            btnLoading('#btnUpdateRole');
                            $.post('<?=Route('api/user/update_role.php')?>', $('#formRole').serialize(), function(res) {
                                $('#responseRole').html(res);
                                btnLoadingReset('#btnUpdateRole');
                            }).fail(function() {
                                $('#responseRole').html('<div class="text-red-500">An error occurred. Please try again.</div>');
                                btnLoadingReset('#btnUpdateRole');
                            });
                        });
                    </script>

                </div>
            </div>
        </div>

    </div>