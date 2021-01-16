<?php
defined('FIR') OR exit();
/**
 * The template for displaying the Admin Panel Ads Settings section
 */
?>
<?=$this->message()?>
<form action="<?=$data['url']?>/admin/ads" method="post">
    <?=$this->token()?>

    <label for="i_ads_1"><?=$lang['ads_1']?></label>
    <textarea name="ads_1" id="i_ads_1" placeholder="<?=$lang['ad_unit_code']?>"><?=e(isset($data['site_settings']['ads_1']) ? $data['site_settings']['ads_1'] : '')?></textarea>

    <label for="i_ads_2"><?=$lang['ads_2']?></label>
    <textarea name="ads_2" id="i_ads_2" placeholder="<?=$lang['ad_unit_code']?>"><?=e(isset($data['site_settings']['ads_2']) ? $data['site_settings']['ads_2'] : '')?></textarea>

    <label for="i_ads_3"><?=$lang['ads_3']?></label>
    <textarea name="ads_3" id="i_ads_3" placeholder="<?=$lang['ad_unit_code']?>"><?=e(isset($data['site_settings']['ads_3']) ? $data['site_settings']['ads_3'] : '')?></textarea>

    <button type="submit" name="submit"><?=$lang['save']?></button>
</form>