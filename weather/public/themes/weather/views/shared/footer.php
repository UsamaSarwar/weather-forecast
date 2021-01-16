<?php
defined('FIR') OR exit();
/**
 * The template for displaying the footer section
 */
?>
<footer id="footer" class="footer">
    <div class="footer-content">
        <div class="footer-menu">
            <?php foreach($data['info_pages'] as $value): ?>
                <div class="footer-element"><a href="<?=$data['url']?>/info/<?=e($value['url'])?>"<?=((isset($this->url[1]) && $this->url[1] == $value['url'] && $this->url[0] == 'info') ? ' class="menu-active"' : '')?>><?=e($value['title'])?></a></div>
            <?php endforeach ?>
            <?php if(isset($_SESSION['adminUsername'])): ?>
                <div class="footer-element"><a href="<?=$data['url']?>/admin"<?=((isset($this->url[0]) && $this->url[0] == 'admin') ? ' class="menu-active"' : '')?>><?=e($lang['admin'])?></a></div>
            <?php endif ?>
        </div>
        <div class="footer-info">
            <div class="footer-element"><?=sprintf($lang['copyright'], $data['year'], e($data['settings']['site_title']))?></div>
            <div class="footer-element"><?=sprintf($lang['powered_by'], '<a href="'.SOFTWARE_URL.'" target="_blank" data-nd>'.SOFTWARE_NAME.'</a>')?></div>
        </div>
    </div>
</footer>