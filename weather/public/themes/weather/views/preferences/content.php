<?php
defined('FIR') OR exit();
/**
 * The template for displaying the Preferences Page content
 */
?>
<div id="content" class="content content-<?=e($this->url[0])?>">
    <?=$data['menu_view']?>
    <div class="page-header">
        <div class="row">
            <div class="page-title"><?=e($data['page_title'])?></div>
        </div>
    </div>
    <div class="page-content">
        <div class="row">
            <?=$data['preferences_view']?>
        </div>
    </div>
</div>