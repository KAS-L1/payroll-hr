<?php

/**
 * REUSABLE GLOBAL COMPONENTS
 **/

function Refresh($seconds = null)
{
	if (!isset($seconds)) {
		?>
		<script>
			location.reload()
		</script>
		<?php
	} else {
		?>
		<script>
			setTimeout(function () {
				location.reload()
			}, <?= $seconds ?>)
		</script>
		<?php
	}
}

function Redirect($url, $seconds = null)
{
	if (!isset($seconds)) {
		?>
		<script>
			window.location.href = "<?= $url ?>"
		</script>
		<?php
	} else {
		?>
		<script>
			setTimeout(function () {
				location.href = "<?= $url ?>"
			}, "<?= $seconds ?>")
		</script>
		<?php
	}
}


// COMPONENTS
function Required()
{
	?><span class="text-danger app__required">*</span><?php
}

function Alert($type, $text)
{
	?>
	<div class="alert alert-<?= $type ?> app__alert animate__animated animate__fadeIn"><?= $text ?></div>
	<?php
}

function Success($text)
{
	?>
	<div class="alert alert-success app__alert animate__animated animate__fadeIn"><?= $text ?></div>
	<?php
}

function Warning($text)
{
	?>
	<div class="alert alert-warning app__alert animate__animated animate__fadeIn"><?= $text ?></div>
	<?php
}

function Error($text)
{
	?>
	<div class="alert alert-danger app__alert animate__animated animate__fadeIn"><?= $text ?></div>
	<?php
}

function Swal($type, $title, $buttonText = null, $text = null)
{
	if ($type == "success") {
		$color = 'var(--bs-success)';
	} else if ($type == "warning") {
		$color = 'var(--bs-warning)';
	} else if ($type == "error") {
		$color = 'var(--bs-danger)';
	} else {
		$color = 'var(--bs-primary)';
	}
	?>
	<script>
		Swal.fire({
			icon: '<?= $type ?>',
			title: '<?= $title ?>',
			text: '<?= $text ?>',
			confirmButtonText: '<?= isset($buttonText) ? $buttonText : 'Okay' ?>',
			confirmButtonColor: '<?= $color ?>'
		})
	</script>
	<?php
}

function SwalAction($url, $type, $title, $buttonText = null, $text = null)
{
	if ($type == "success") {
		$color = 'var(--bs-success)';
	} else if ($type == "warning") {
		$color = 'var(--bs-warning)';
	} else if ($type == "error") {
		$color = 'var(--bs-danger)';
	} else {
		$color = 'var(--bs-primary)';
	}
	?>
	<script>
		Swal.fire({
			icon: '<?= $type ?>',
			title: '<?= $title ?>',
			text: '<?= $text ?>',
			confirmButtonText: '<?= isset($buttonText) ? $buttonText : 'Okay' ?>',
			confirmButtonColor: '<?= $color ?>'
		}).then(function () {
			window.location = '<?= $url ?>';
		})
	</script>
	<?php
}

function Toast($type, $message, $position = null, $timer = null)
{
    if ($type == "success") {
        $color = 'success';
    } else if ($type == "warning") {
        $color = 'warning';
    } else if ($type == "error") {
        $color = 'danger';
    } else {
        $color = 'primary';
    }
    ?>
    <script>
        $(function () {
            var Toast = Swal.mixin({
                toast: true,
                position: '<?= isset($position) ? $position : 'top-right' ?>',
                showConfirmButton: false,
                timerProgressBar: true,
                timer: <?= isset($timer) ? $timer : 2000 ?>,
                customClass: {
                    popup: 'color-<?=$color?>',
                },
            });
            Toast.fire({
                icon: '<?= $type ?>',
                title: '<?= $message ?>'
            })
        })
    </script>
    <?php
}



function Input($type, $name, $value= null, $placeholder = null, $class = null, $icon = true, $attributes= null)
{
	?>
		<input type="<?=$type?>" name="<?=$name?>" id="<?= $name?>" value="<?= $value?>" placeholder="<?=$placeholder?>" class="form-input <?=!empty($icon) ? 'ps-10' : 'ps-0' ?> placeholder:text-white-dark <?=$class?>" <?= $attributes?>>
	<?php
}

function InputPassword($name, $value = null, $placeholder = null, $class = null, $icon = true, $attributes = null)
{
    ?>
    <div class="password-input-wrapper relative">
        <input 
            type="password" 
            name="<?= $name ?>" 
            id="<?= $name ?>" 
            value="<?= $value ?>" 
            placeholder="<?= $placeholder ?>" 
            class="form-input <?= !empty($icon) ? 'ps-10' : 'ps-0' ?> placeholder:text-white-dark <?= $class ?>" 
            <?= $attributes ?> 
        />
        <button 
            type="button" 
            class="toggle-password absolute inset-y-0 right-0 px-3 text-gray-500 hover:text-primary focus:outline-none" 
            onclick="togglePasswordVisibility('<?= $name ?>', this)"
        >
            <i class="fa-solid fa-eye"></i>
        </button>
    </div>
    <script>
        function togglePasswordVisibility(inputId, button) {
            const input = document.getElementById(inputId);
            const icon = button.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
    <?php
}

function Button($type, $id, $text, $class = null, $width = null, $attributes= null)
{
	?>
		<button type="<?=$type?>" id="<?=$id?>" class="btn btn-primary !mt-6 <?=!empty($width) ? 'w-full' : '' ?> border-0 uppercase <?=$class?>" <?= $attributes?>>
			<?= $text ?>
		</button>
	<?php
}

function Old($key, $default = null)
{
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	return isset($_SESSION['old'][$key]) ? htmlspecialchars($_SESSION['old'][$key]) : $default;
}

function Select($name, $options, $selected = null, $placeholder = null, $attributes = '')
{
    $html = "<select name='{$name}' class='form-select' {$attributes}>";

    if ($placeholder) {
        $html .= "<option value=''>{$placeholder}</option>";
    }

    foreach ($options as $value => $label) {
        $isSelected = ($selected == $value) ? 'selected' : '';
        $html .= "<option value='{$value}' {$isSelected}>{$label}</option>";
    }

    $html .= "</select>";
    return $html;
}

function Textarea($name, $value = null, $placeholder = null, $class = null, $icon = true, $rows = 4, $cols = 50, $attributes = null)
{
    ?>
    	<textarea name="<?= $name ?>" id="<?= $name ?>" placeholder="<?= $placeholder ?>" rows="<?= $rows ?>" cols="<?= $cols ?>" class="form-input <?= !empty($icon) ? 'ps-10' : 'ps-0' ?> placeholder:text-white-dark <?= $class ?>" <?= $attributes ?>><?= $value ?></textarea>
    <?php
}

