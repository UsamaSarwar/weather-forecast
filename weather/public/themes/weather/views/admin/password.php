<?php
defined('FIR') OR exit();
/**
 * The template for displaying the Admin Panel Password section
 */
?>
<?=$this->message()?>
<form action="<?=$data['url']?>/admin/password" method="post">
    <?=$this->token()?>
    <label for="i_current_password"><?=$lang['current_password']?></label>
    <input type="password" name="current_password" id="i_current_password" placeholder="<?=$lang['current_password']?>" maxlength="64">

    <label for="i_password"><?=$lang['new_password']?></label>
    <input type="password" name="password" id="i_password" placeholder="<?=$lang['new_password']?>" maxlength="64">

    <label for="i_repeat_password"><?=$lang['confirm_new_password']?></label>
    <input type="password" name="repeat_password" id="i_repeat_password" placeholder="<?=$lang['confirm_new_password']?>" maxlength="64">

    <button type="submit" name="submit"><?=$lang['save']?></button>
</form>