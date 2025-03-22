<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= APP_TITLE ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="<?= APP_ICON ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="css2?family=Nunito:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" media="screen" href="<?= DOMAIN ?>/assets/css/perfect-scrollbar.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="<?= DOMAIN ?>/assets/css/style.css">
    <link defer="" rel="stylesheet" type="text/css" media="screen" href="<?= DOMAIN ?>/assets/css/animate.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.jqueryui.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.2.1/css/buttons.jqueryui.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.2.1/css/buttons.dataTables.css">
    <link rel="stylesheet"href="https://cdn.datatables.net/v/dt/dt-2.2.2/r-3.0.3/datatables.min.css">
    <link rel="stylesheet" href="<?= DOMAIN ?>/assets/css/app.css">
    <link rel="stylesheet" href="<?= DOMAIN ?>/page/_component/app.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.1/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/v/dt/dt-2.2.2/r-3.0.3/datatables.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/3.2.1/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.1/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.1/js/buttons.dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.1/js/buttons.print.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="<?= DOMAIN ?>/assets/js/sweetalert.min.js"></script>
    <script src="<?= DOMAIN ?>/assets/js/perfect-scrollbar.min.js"></script>
    <script defer="" src="<?= DOMAIN ?>/assets/js/popper.min.js"></script>
    <script defer="" src="<?= DOMAIN ?>/assets/js/tippy-bundle.umd.min.js"></script>


</head>

<body x-data="main" class="relative overflow-x-hidden font-nunito text-sm font-normal antialiased" :class="[ $store.app.sidebar ? 'toggle-sidebar' : '', $store.app.theme === 'dark' || $store.app.isDarkMode ?  'dark' : '', $store.app.menu, $store.app.layout,$store.app.rtlClass]">

    <!-- ** SETUP YOUR TEMPLATE HERE ** -->

    <!-- Sidebar menu overlay -->
    <div x-cloak="" class="fixed inset-0 z-50 bg-[black]/60 lg:hidden" :class="{'hidden' : !$store.app.sidebar}" @click="$store.app.toggleSidebar()"></div>

    <!-- Screen loader -->
    <?php include_once('page/_component/Loader.php') ?>

    <!-- Scroll to top button -->
    <?php include_once('page/_component/Scrolltop.php') ?>

    <?php //include_once('page/_component/Customizer.php') 
    ?>

    <div class="main-container min-h-screen text-black dark:text-white-dark" :class="[$store.app.navbar]">

        <!-- Sidebar -->
        <?php include_once('page/_component/Sidebar.php'); ?>

        <div class="main-content flex min-h-screen flex-col">

            <!-- Header -->
            <?php include_once('page/_component/Topbar.php') ?>

            <!-- Main Page Content -->
            <div class="animate__animated p-6" :class="[$store.app.animation]">