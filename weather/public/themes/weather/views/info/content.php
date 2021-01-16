<?php
defined('FIR') OR exit();
/**
 * The template for displaying the Info Pages content
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
            <?=$data['page_content']?>
        </div>
    </div>
</div>