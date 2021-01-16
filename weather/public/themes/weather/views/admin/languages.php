<?php
defined('FIR') OR exit();
/**
 * The template for displaying the Admin Panel Languages section
 */
?>
<?=$this->message()?>
<form action="<?=$data['url']?>/admin/languages" method="post">
    <?=$this->token()?>
    <div class="list-container">
        <?php foreach($data['languages'] as $language): ?>
        <div class="list-row">
            <div class="list-col-button"><button type="submit" name="language" value="<?=$language['path']?>"<?=($data['settings']['site_language'] == $language['path'] ? ' disabled' : '')?>><?=($data['settings']['site_language'] == $language['path'] ? $lang['default'] : $lang['make_default'])?></button></div>
            <div class="list-col-content list-col-content-full">
                <div><strong><a href="<?=$language['url']?>" target="_blank" data-nd><?=$language['name']?></a></strong></div>
                <div><?=$lang['by']?>: <a href="<?=$language['url']?>" target="_blank" data-nd><?=$language['author']?></a></div>
            </div>
        </div>
        <?php endforeach ?>
    </div>
</form>