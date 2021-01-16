<?php
defined('FIR') OR exit();
/**
 * The template for displaying the Admin Panel General Settings section
 */
?>
<?=$this->message()?>
<form action="<?=$data['url']?>/admin/weather" method="post">
    <?=$this->token()?>
    <label for="i_weather_api_key"><?=$lang['weather_api_key']?></label>
    <input type="text" name="weather_api_key" id="i_weather_api_key" placeholder="<?=$lang['weather_api_key']?>" value="<?=e($data['site_settings']['weather_api_key'])?>" maxlength="64">

    <label for="i_weather_location"><?=$lang['weather_location']?></label>
    <input type="text" name="weather_location" id="i_weather_location" placeholder="<?=$lang['weather_location']?>" value="<?=e($data['site_settings']['weather_location'])?>" maxlength="64">

    <label for="i_weather_format"><?=$lang['weather_format']?></label>
    <select name="weather_format" id="i_weather_format">
        <option value="0"<?=($data['site_settings']['weather_format'] == 0 ? ' selected' : '')?>><?=$lang['celsius']?></option>
        <option value="1"<?=($data['site_settings']['weather_format'] > 0 ? ' selected' : '')?>><?=$lang['fahrenheit']?></option>
    </select>

    <label for="i_weather_geo_location"><?=$lang['weather_geo_location']?></label>
    <select name="weather_geo_location" id="i_weather_geo_location">
        <option value="0"<?=($data['site_settings']['weather_geo_location'] == 0 ? ' selected' : '')?>><?=$lang['off']?></option>
        <option value="1"<?=($data['site_settings']['weather_geo_location'] > 0 ? ' selected' : '')?>><?=$lang['on']?></option>
    </select>

    <label for="i_weather_forecast_days"><?=$lang['weather_forecast_days']?></label>
    <input type="text" name="weather_forecast_days" id="i_weather_forecast_days" placeholder="<?=$lang['weather_forecast_days']?>" value="<?=e($data['site_settings']['weather_forecast_days'])?>" maxlength="64">

    <label for="i_weather_latest"><?=$lang['weather_latest']?></label>
    <input type="text" name="weather_latest" id="i_weather_latest" placeholder="<?=$lang['weather_latest']?>" value="<?=e($data['site_settings']['weather_latest'])?>" maxlength="64">

    <label for="i_search_per_ip"><?=$lang['searches_per_ip']?></label>
    <input type="text" name="search_per_ip" id="i_search_per_ip" placeholder="<?=$lang['searches_per_ip']?>" value="<?=e($data['site_settings']['search_per_ip'])?>" maxlength="64">

    <button type="submit" name="submit"><?=$lang['save']?></button>
</form>