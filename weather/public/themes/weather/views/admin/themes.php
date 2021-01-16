<?php
defined('FIR') OR exit();
/**
 * The template for displaying the Admin Panel Themes section
 */
?>
<?=$this->message()?>
<form action="<?=$data['url']?>/admin/themes" method="post">
    <?=$this->token()?>
    <div class="list-container">
        <?php foreach($data['themes'] as $theme): ?>
        <div class="list-row">
            <div class="list-col-image"><a href="<?=$theme['url']?>" target="_blank"><img src="<?=$data['url']?>/<?=$data['theme_path']?>/<?=$theme['path']?>/icon.png"></a></div>
            <div class="list-col-button"><button type="submit" name="theme" value="<?=$theme['path']?>"<?=($data['settings']['site_theme'] == $theme['path'] ? ' disabled' : '')?>><?=($data['settings']['site_theme'] == $theme['path'] ? $lang['active'] : $lang['activate'])?></button></div>
            <div class="list-col-content">
                <div><strong><a href="<?=$theme['url']?>" target="_blank" data-nd><?=$theme['name']?></a></strong> <?=$theme['version']?></div>
                <div><?=$lang['by']?>: <a href="<?=$theme['url']?>" target="_blank" data-nd><?=$theme['author']?></a></div>
            </div>
        </div>
        <?php endforeach ?>
    </div>
</form>