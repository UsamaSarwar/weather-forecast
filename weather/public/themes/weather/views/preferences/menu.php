<?php
defined('FIR') OR exit();
/**
 * The template for displaying the top menu for the Preferences Page
 */
?>
<div class="content-white content-menu">
    <div class="page-menu page-menu-left" id="page-menu">
        <div class="row">
            <?php foreach($data['menu'] as $key => $value): ?>
                <a href="<?=$data['url'].'/preferences/'.e($key)?>"<?=(($value[0] == true) ? ' class="menu-active"' : '')?><?=(($value[1] == true) ? ' data-nd' : '')?>><?=$lang[$value[2]]?></a>
            <?php endforeach ?>
        </div>
    </div>
</div>