<?php
defined('FIR') OR exit();
/**
 * The template for displaying Admin Panel content
 */
?>
<div id="content" class="content content-<?=e($this->url[0])?>">
    <?=$data['menu_view']?>
    <div class="page-header">
        <div class="row">
            <div class="page-title"><?=e((is_array($data['page_title']) ? implode(' - ', $data['page_title']) : $data['page_title']))?></div>
        </div>
    </div>
    <div class="page-content">
        <div class="row">
            <?=$data['settings_view']?>
        </div>
    </div>
</div>