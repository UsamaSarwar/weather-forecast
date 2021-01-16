<?php
defined('FIR') OR exit();
/**
 * The template for displaying Admin Panel login section
 */
?>
<?=$this->message()?>
<form action="<?=$data['url']?>/admin/login" method="post">
    <?=$this->token()?>
    <label for="i_username"><?=$lang['username']?></label>
    <input type="text" name="username" id="i_username" placeholder="<?=$lang['username']?>" value="<?=e(isset($data['username']) ? $data['username'] : '')?>" maxlength="32">

    <label for="i_password"><?=$lang['password']?></label>
    <input type="password" name="password" id="i_password" placeholder="<?=$lang['password']?>" maxlength="64">

    <div class="remember-me"><input type="checkbox" name="remember" id="i_remember" value="1"><label for="i_remember"><?=$lang['remember_me']?></label></div>

    <button type="submit" name="login"><?=$lang['login']?></button>
</form>