<?php
/**
 * APP CUSTOM COMPONENTS
**/

function ViewPage($folder, $index){
    GLOBAL $DB;
    $GET_PAGE = PAGE(1); // Get the page route
    if(isset($GET_PAGE)){
        if(VIEW('page/'.$folder.'/', $GET_PAGE) == '404'){
            include_once('page/404.php');
        }else{
            include_once(VIEW('page/'.$folder.'/', $GET_PAGE));    
        }
    }else{
        include_once('page/'.$folder.'/'.ucfirst($index).'.php');
    }
}

function Loading($text = null){
    ?>
        <div class="d-flex justify-content-center py-2">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    <?php
}

function DataEmpty($text, $action = null, $url = null){
    ?>
        <div class="text-center py-5">
            <img src="<?=DOMAIN?>/assets/images/resource/data-empty.png" width="100">
            <p class="my-2 fw-semibold"><?=$text?></p>
            <?php if(!empty($action)){ ?>
                <div>
                    <a href="<?=$url?>" class="btn btn-sm btn-primary px-4"><?=$action?></a>
                </div>
            <?php } ?>
        </div>
    <?php
}

function UploadImage($text = null){
    ?>
        <label for="image" id="previewFile" class="card card__upload-file mb-0 touchable" title="Choose file">
            <div class="text-center p-4">
                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                    <polyline points="17 8 12 3 7 8"></polyline>
                    <line x1="12" y1="3" x2="12" y2="15"></line>
                </svg>
                <div><?=$text ?? 'Attach a File'?></div>
                <div class="small text-muted">Click here to upload</div>
            </div>
        </label>
        <input type="file" name="image" id="image" style="opacity:0; height: 1px; width: 100%;" accept=".png, .jpg, .jpeg" onchange="previewFile(event)" required>
        <script>
            function previewFile(event){
                try {
                    var reader = new FileReader();
                    reader.readAsDataURL(event.target.files[0]);
                    var src = URL.createObjectURL(event.target.files[0]);
                  	reader.onload = function(){
                    	$('#previewFile').html(`
                    	    <div class="file__upload-body">
                        	    <img src="${src}" class="file__upload-source">
                            </div>
                    	`);
                  	}
                }catch(err) {
                    $('#previewFile').html(`
                        <div class="text-center p-4">
                            <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                <polyline points="17 8 12 3 7 8"></polyline>
                                <line x1="12" y1="3" x2="12" y2="15"></line>
                            </svg>
                            <div><?=$text ?? 'Attach a File'?></div>
                            <div class="small text-muted">Click here to upload</div>
                        </div>
                    `);
                }
            }
        </script>
    <?php
}


function Breadcrumb($items) {
    // Get current route (you would need some custom routing logic for this)
    $currentPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    
    echo '<ul class="flex space-x-2 rtl:space-x-reverse mb-3">';

    foreach ($items as $index => $item) {
        $isActive = false;
        if (isset($item['route'])) {
            // If route is defined, check if current route matches
            $isActive = (rtrim($item['route'], '/') === rtrim($currentPath, '/'));
        } elseif (isset($item['url'])) {
            // If URL is defined, check if current URL matches
            $isActive = (rtrim($item['url'], '/') === rtrim($currentPath, '/'));
        }

        // Set classes for active item and other items
        $activeClass = $isActive ? 'text-primary font-semibold' : 'text-[#888EA8]';
        $separatorClass = $index !== 0 ? 'before:content-[\'/\'] ltr:before:mr-1 rtl:before:ml-1' : '';

        echo "<li class=\"$separatorClass\">";
        
        if (isset($item['route'])) {
            // If route is set, create a link
            echo '<a href="' . $item['route'] . '" class="hover:underline ' . $activeClass . '">' . $item['label'] . '</a>';
        } elseif (isset($item['url'])) {
            // If URL is set, create a link
            echo '<a href="' . $item['url'] . '" class="hover:underline ' . $activeClass . '">' . $item['label'] . '</a>';
        } else {
            // If neither route nor URL is set, it's a static breadcrumb (current page)
            echo '<span class="font-semibold ' . $activeClass . '">' . $item['label'] . '</span>';
        }

        echo '</li>';
    }

    echo '</ul>';
}

function Badge($status, $outline = false)
{
    // Ensure status is not NULL
    $status = $status ?? 'Pending';

    // Define the base class based on the outline flag
    $baseClass = $outline ? 'badge-outline-' : 'bg-';

    // Determine the class based on the status
    switch ($status) {
        case 'Pending':
            $classes = $baseClass . 'dark';
            break;
        case 'Approved':
            $classes = $baseClass . 'primary';
            break;
        case 'Rejected':
        case 'Declined':
        case 'Inactive':
        case 'Closed':
        case 'Expired':
        case 'High':
            $classes = $baseClass . 'danger';
            break;
        case 'Low':
            $classes = $baseClass . 'warning';
            break;
        case 'Active':
        case 'Open':
        case 'Awarded':
        case 'Accepted':
        case 'Renewed':
        case 'Signed':
            $classes = $baseClass . 'primary';
            break;
        default:
            $classes = $baseClass . 'secondary';
    }

    // Return the badge HTML with the appropriate classes
    return '<span class="badge ' . $classes . ' rounded-full">' . htmlspecialchars($status, ENT_QUOTES, 'UTF-8') . '</span>';
}



function NavItem($icon, $title, $route = '#', $dropdownKey = null, $subItems = [], $currentRoute = null) {
    // Determine if the current route matches
    $isActive = $currentRoute && $route === $currentRoute;
    $subItemActive = false;
    
    if ($dropdownKey && !empty($subItems)) {
        // Check if any sub-item is active
        foreach ($subItems as $subItem) {
            if (isset($subItem['route']) && $subItem['route'] === $currentRoute) {
                $subItemActive = true;
                break;
            }
        }
    }
    
    ?>
    <li class="menu nav-item">
        <?php if ($dropdownKey && !empty($subItems)): ?>
            <button 
                type="button" 
                class="nav-link group <?= $subItemActive ? 'active' : '' ?>" 
                :class="{ 'active': activeDropdown === '<?= $dropdownKey ?>' }"
                @click="activeDropdown === '<?= $dropdownKey ?>' ? activeDropdown = null : activeDropdown = '<?= $dropdownKey ?>'"
            >
                <div class="flex items-center">
                    <i class="<?= $icon ?> shrink-0 group-hover:text-primary text-current opacity-50"></i>
                    <span class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">
                        <?= htmlspecialchars($title) ?>
                    </span>
                </div>
                <div class="rtl:rotate-180" :class="{ '!rotate-90': activeDropdown === '<?= $dropdownKey ?>' }">
                    <svg width="16" height="16" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 5L15 12L9 19" stroke="currentColor" stroke-width="1.5" 
                              stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </div>
            </button>
            <ul 
                x-cloak 
                x-show="activeDropdown === '<?= $dropdownKey ?>'" 
                x-collapse="" 
                class="sub-menu text-gray-500"
            >
                <?php foreach ($subItems as $subItem): ?>
                    <li>
                        <a href="<?= $subItem['route'] ?>" 
                           class="<?= ($currentRoute === $subItem['route']) ? 'active' : '' ?>">
                            <?= htmlspecialchars($subItem['title']) ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <a href="<?= htmlspecialchars($route) ?>" 
               class="nav-link group <?= $isActive ? 'active' : '' ?>">
                <div class="flex items-center">
                    <i class="<?= $icon ?> shrink-0 group-hover:text-primary text-current opacity-50"></i>
                    <span class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">
                        <?= htmlspecialchars($title) ?>
                    </span>
                </div>
            </a>
        <?php endif; ?>
    </li>
    <?php
}

function VerticalNavItem($icon, $title, $route = '#', $dropdownKey = null, $subItems = [], $currentRoute = null) {
    $isActive = $currentRoute && $route === $currentRoute;
    $subItemActive = false;
    
    if ($dropdownKey && !empty($subItems)) {
        foreach ($subItems as $subItem) {
            if (isset($subItem['route']) && $subItem['route'] === $currentRoute) {
                $subItemActive = true;
                break;
            }
        }
    }
    
    ?>
    <li class="menu nav-item relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
        <?php if ($dropdownKey && !empty($subItems)): ?>
            <div class="nav-link group <?= $subItemActive ? 'active' : '' ?>" >
                <div class="flex items-center">
                    <i class="<?= $icon ?> shrink-0 group-hover:text-primary text-current opacity-50"></i>
                    <span class="px-1"><?= htmlspecialchars($title) ?></span>
                </div>
                <div class="right_arrow">
                    <svg class="h-4 w-4 rotate-90" width="16" height="16" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 5L15 12L9 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </div>
            </div>
            <ul 
                x-show="open" 
                x-collapse 
                class="sub-menu"
            >
                <?php foreach ($subItems as $subItem): ?>
                    <li>
                        <a href="<?= $subItem['route'] ?>" 
                           class="<?= ($currentRoute === $subItem['route']) ? 'active' : '' ?>">
                            <?= htmlspecialchars($subItem['title']) ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <a href="<?= htmlspecialchars($route) ?>" 
               class="nav-link group <?= $isActive ? 'active' : '' ?>">
                <div class="flex items-center">
                    <i class="<?= $icon ?> shrink-0 group-hover:text-primary text-current opacity-50"></i>
                    <span class="px-1"><?= htmlspecialchars($title) ?></span>
                </div>
            </a>
        <?php endif; ?>
    </li>
    <?php
}
    function NavSection($title, $icon = null) {
    ?>
    <h2 class="-mx-4 mb-1 flex items-center bg-white-light/30 px-7 py-3 font-extrabold uppercase dark:bg-dark dark:bg-opacity-[0.08]">
        <?php if ($icon): ?>
            <svg class="hidden h-5 w-4 flex-none" viewbox="0 0 24 24" stroke="currentColor" stroke-width="1.5"
                fill="none" stroke-linecap="round" stroke-linejoin="round">
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
        <?php endif; ?>
        <span><?= htmlspecialchars($title) ?></span>
    </h2>
    <?php
}
