<?php
defined('FIR') OR exit();
/**
 * The template for displaying Weather forecast
 */
?>
<div class="row">
    <?=$data['settings']['ads_1']?>
    <div <?php if($data['weather_now']['icon']): ?>style="background-image: linear-gradient(var(--cover-top), var(--cover-bottom)), url('<?=$data['url']?>/<?=$data['theme_path']?>/<?=$data['settings']['site_theme']?>/assets/images/weather/<?=e(sprintf('%02d', (int)$data['weather_now']['icon']))?>.jpg');"<?php endif ?> class="weather-now">
        <div class="wn-title"><?=$lang['weather']?>
            <form id="format">
                <?=$this->token()?>
                <input type="hidden" name="format" value="<?php if($data['format']): ?>0<?php else: ?>1<?php endif ?>">
            </form>
            <div class="button-round-container" onclick="post('format')">
                <div class="button-round <?php if($data['format']): ?>format-f<?php else: ?>format-c<?php endif ?>"></div>
            </div>

            <form id="favorite">
                <?=$this->token()?>
                <input type="hidden" name="favorite">
                <input type="hidden" name="id" value="<?=$data['weather_now']['location_id']?>">
                <input type="hidden" name="name" value="<?=e($data['weather_now']['location'])?>">
            </form>
            <div class="button-round-container<?php if($data['favorite'] == true): ?> button-round-active<?php endif ?>" onclick="post('favorite')">
                <div class="button-round favorite"></div>
            </div>
        </div>
        <div class="wn-location"><a href="<?=$data['url']?>/location/<?=$data['weather_now']['location_id']?>"><?=e($data['weather_now']['location'])?></a></div>

        <div class="wn-box wn-temperature"><?=e($data['weather_now']['temperature'])?>° <img src="<?=$data['url']?>/<?=$data['theme_path']?>/<?=$data['settings']['site_theme']?>/assets/images/icons/weather/<?=e(sprintf('%02d', (int)$data['weather_now']['icon']))?>.svg" class="wn-icon"></div>

        <div class="wn-box wn-conditions">
            <div class="wn-box-condition-row"><img src="<?=$data['url']?>/<?=$data['theme_path']?>/<?=$data['settings']['site_theme']?>/assets/images/icons/conditions/condition.svg"><div class="wn-conditions-text"><?=$lang['conditions']?>: <?=$lang['c_'.$data['weather_now']['condition']]?></div></div>

            <div class="wn-box-condition-row"><img src="<?=$data['url']?>/<?=$data['theme_path']?>/<?=$data['settings']['site_theme']?>/assets/images/icons/conditions/humidity.svg"><div class="wn-conditions-text"><?=$lang['humidity']?>: <?=$data['weather_now']['humidity']?>%</div></div>
        </div>
        <div class="wn-box wn-conditions">
            <div class="wn-box-condition-row"><img src="<?=$data['url']?>/<?=$data['theme_path']?>/<?=$data['settings']['site_theme']?>/assets/images/icons/conditions/speed.svg"><div class="wn-conditions-text"><?=$lang['wind_speed']?>: <?=$data['weather_now']['wind']['speed'][0]?> <?=$lang[$data['weather_now']['wind']['speed'][1]]?></div></div>

            <div class="wn-box-condition-row"><img src="<?=$data['url']?>/<?=$data['theme_path']?>/<?=$data['settings']['site_theme']?>/assets/images/icons/conditions/direction.svg" style="transform: rotate(<?=$data['weather_now']['wind']['direction']?>deg);"><div class="wn-conditions-text"><?=$lang['wind_direction']?>: <?php if(!empty($data['weather_now']['wind']['direction'])): ?><?=$data['weather_now']['wind']['direction']?>°<?php else: ?>N/A<?php endif ?></div></div>
        </div>
    </div>
</div>
<?=$data['forecast_view']?>
<div class="row">
    <div class="weather-info">
        <?=$data['settings']['ads_3']?>
        <div class="wi-title"><?=$lang['info']?></div>
        <div class="wi-content">
            <div class="wi-item">
                <div class="wi-icon">
                    <img src="<?=$data['url']?>/<?=$data['theme_path']?>/<?=$data['settings']['site_theme']?>/assets/images/icons/sunrise.svg" class="wf-icon">
                </div>
                <div class="wi-description">
                    <div class="wi-name">
                        <?=$lang['sunrise']?>
                    </div>
                    <div class="wi-value">
                        <?=($data['weather_now']['sunrise'] ? $data['weather_now']['sunrise'] : '--:--')?>
                    </div>
                </div>
            </div>
            <div class="wi-item">
                <div class="wi-icon">
                    <img src="<?=$data['url']?>/<?=$data['theme_path']?>/<?=$data['settings']['site_theme']?>/assets/images/icons/sunset.svg" class="wf-icon">
                </div>
                <div class="wi-description">
                    <div class="wi-name">
                        <?=$lang['sunset']?>
                    </div>
                    <div class="wi-value">
                        <?=($data['weather_now']['sunset'] ? $data['weather_now']['sunset'] : '--:--')?>
                    </div>
                </div>
            </div>
            <div class="wi-item">
                <div class="wi-icon">
                    <img src="<?=$data['url']?>/<?=$data['theme_path']?>/<?=$data['settings']['site_theme']?>/assets/images/icons/latitude.svg" class="wf-icon">
                </div>
                <div class="wi-description">
                    <div class="wi-name">
                        <?=$lang['latitude']?>
                    </div>
                    <div class="wi-value">
                        <?=$data['coordinates']['lat']?>
                    </div>
                </div>
            </div>
            <div class="wi-item">
                <div class="wi-icon">
                    <img src="<?=$data['url']?>/<?=$data['theme_path']?>/<?=$data['settings']['site_theme']?>/assets/images/icons/longitude.svg" class="wf-icon">
                </div>
                <div class="wi-description">
                    <div class="wi-name">
                        <?=$lang['longitude']?>
                    </div>
                    <div class="wi-value">
                        <?=$data['coordinates']['lon']?>
                    </div>
                </div>
            </div>
        </div>
        <div class="timezone"><?=sprintf($lang['timezone_gmt'], date('P'))?></div>
    </div>
</div>
<?php if($data['settings']['weather_latest']): ?>
<div class="row">
    <div class="latest-searches">
        <div class="ls-title"><?=$lang['latest_searches']?></div>
        <?php foreach($data['latest_searches'] as $value): ?>
            <a href="<?=$data['url']?>/location/<?=e($value['id'])?>"><div class="button button-neutral button-margin-right float-left"><?=e($value['name'])?>, <?=$value['country']?></div></a>
        <?php endforeach ?>
    </div>
</div>
<?php endif ?>