<?php
defined('FIR') OR exit();
/**
 * The template for displaying the Theme settings for Preferences Page
 */
?>
<?=$this->message()?>
<form action="<?=$data['url']?>/preferences/theme" method="post">
    <?=$this->token()?>

    <label for="i_dark_mode"><?=$lang['dark_mode']?></label>
    <select name="dark_mode" id="i_dark_mode">
        <option value="0"<?=($data['cookie']['dark_mode'] == 0 ? ' selected' : '')?>><?=$lang['no']?></option>
        <option value="1"<?=($data['cookie']['dark_mode'] > 0 ? ' selected' : '')?>><?=$lang['yes']?></option>
    </select>

    <button type="submit" name="submit" class="float-left"><?=$lang['save']?></button>
</form>