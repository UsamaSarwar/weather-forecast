<?php
defined('FIR') OR exit();
/**
 * The template for displaying the Language selector for Preferences Page
 */
?>
<?=$this->message()?>
<form action="<?=$data['url']?>/preferences/language" method="post">
    <?=$this->token()?>

    <label for="i_site_language"><?=$lang['site_language']?></label>
    <select name="site_language" id="i_site_language">
        <?php foreach($data['languages'] as $language): ?>
            <option value="<?=e($language)?>"<?=($data['user_language'] == $language ? ' selected' : '')?>><?=e($language)?></option>
        <?php endforeach ?>
    </select>

    <button type="submit" name="submit" class="float-left"><?=$lang['save']?></button>
</form>