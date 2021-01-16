<?php
defined('FIR') OR exit();
/**
 * The template for displaying the Admin Panel General Settings section
 */
?>
<?=$this->message()?>
<form action="<?=$data['url']?>/admin/general" method="post" enctype="multipart/form-data">
    <?=$this->token()?>
    <label for="i_site_title"><?=$lang['site_title']?></label>
    <input type="text" name="site_title" id="i_site_title" placeholder="<?=$lang['site_title']?>" value="<?=e($data['site_settings']['site_title'])?>" maxlength="64">

    <label for="i_logo"><?=$lang['site_logo']?></label>
    <input type="file" name="logo" id="i_logo" accept=".png,.svg">

    <label for="i_favicon"><?=$lang['site_favicon']?></label>
    <input type="file" name="favicon" id="i_favicon" accept=".png,.svg">

    <label for="i_timezone"><?=$lang['timezone']?></label>
    <select name="timezone" id="i_timezone">
        <option value=""<?=($data['site_settings']['timezone'] == "" ? ' selected' : '')?>><?=$lang['default']?></option>
        <?php foreach(timezone_identifiers_list() as $value): ?>
            <option value="<?=e($value)?>"<?=($data['site_settings']['timezone'] == $value ? ' selected' : '')?>><?=e($value)?></option>
        <?php endforeach ?>
    </select>

    <label for="i_tracking_code"><?=$lang['tracking_code']?></label>
    <textarea name="tracking_code" id="i_tracking_code" placeholder="<?=$lang['tracking_code']?>"><?=e(isset($data['site_settings']['tracking_code']) ? $data['site_settings']['tracking_code'] : '')?></textarea>

    <button type="submit" name="submit"><?=$lang['save']?></button>
</form>