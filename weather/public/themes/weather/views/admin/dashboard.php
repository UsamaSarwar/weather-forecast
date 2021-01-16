<?php
defined('FIR') OR exit();
/**
 * The template for displaying the Admin Panel Dashboard section
 */
?>
<?=$this->message()?>
<div class="section">
    <div><strong><?=$lang['site_info']?></strong></div>
    <div>
        <a href="<?=SOFTWARE_URL?>" target="_blank" data-nd><?=SOFTWARE_NAME?></a> <?=SOFTWARE_VERSION?>
    </div>
</div>
<div class="divider"></div>
<div class="section">
    <div><strong>Useful Links</strong></div>
    <div>
        <a href="<?=SOFTWARE_URL?>/customize/themes" target="_blank" data-nd><?=$lang['get_more_themes']?></a>
    </div>
    <div>
        <a href="<?=SOFTWARE_URL?>/customize/languages" target="_blank" data-nd><?=$lang['get_more_languages']?></a>
    </div>
</div>