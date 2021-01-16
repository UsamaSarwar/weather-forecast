<?php
defined('FIR') OR exit();
/**
 * The template for displaying Admin Panel Info Pages section
 */
?>
<?=$this->message()?>
<a href="<?=$data['url'].'/admin/info_pages/new'?>"><div class="button button-create"><?=$lang['new_page']?></div></a>
<div class="list-container">
    <?php foreach($data['info_pages'] as $page): ?>
    <div class="list-row">
        <div class="list-col-button"><a href="<?=$data['url'].'/admin/info_pages/edit/'.$page['id'].''?>"><div class="button"><?=$lang['edit']?></div></a></div>
        <div class="list-col-content list-col-content-full">
            <div><strong><a href="<?=$data['url'].'/info/'.$page['url']?>" target="_blank" data-nd><?=e($page['title'])?></a></strong> (<?=($page['public'] ? $lang['public'] : $lang['unlisted'])?>)</div>
            <div><?=e(str_limit($page['content']))?></div>
        </div>
    </div>
    <?php endforeach ?>
</div>