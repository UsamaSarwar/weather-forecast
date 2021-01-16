<?php
defined('FIR') OR exit();
/**
 * The template for displaying Weather forecast
 */
?>
<div class="row">
    <div class="weather-forecast daily">
        <?=$data['settings']['ads_2']?>
        <div class="wf-title"><?=$lang['daily_forecast']?></div>
        <div>
            <?php foreach($data['weather_forecast']['daily'] as $forecast): ?>
                <a href="<?=$data['url']?>/location/<?=$data['weather_now']['location_id']?>/day/<?=$forecast['date'][0]?>" class="wf-list">
                    <div class="wf-list-col wf-date">
                        <div class="wf-day"><?=$lang[$forecast['day']]?></div>
                        <div class="wf-date"><?=sprintf($lang['date_format'], $forecast['date'][0], $forecast['date'][1], $forecast['date'][2])?></div>
                    </div>
                    <div class="wf-list-col wf-conditions">
                        <div class="wf-condition-row"><img src="<?=$data['url']?>/<?=$data['theme_path']?>/<?=$data['settings']['site_theme']?>/assets/images/icons/conditions/condition.svg"><div class="wf-conditions-text"><?=$lang['conditions']?>: <?=$lang['c_'.$forecast['condition']]?></div></div>

                        <div class="wf-condition-row"><img src="<?=$data['url']?>/<?=$data['theme_path']?>/<?=$data['settings']['site_theme']?>/assets/images/icons/conditions/humidity.svg"><div class="wf-conditions-text"><?=$lang['humidity']?>: <?=$forecast['humidity']?>%</div></div>
                    </div>
                    <div class="wf-list-col wf-temp-icon">
                        <div class="wf-icon"><img src="<?=$data['url']?>/<?=$data['theme_path']?>/<?=$data['settings']['site_theme']?>/assets/images/icons/weather/<?=e(sprintf('%02d', (int)$forecast['icon']))?>.svg" class="wf-icon"></div>
                        <div class="wf-temp">
                            <div class="wf-temp-max"><?=$forecast['temp']['max']?>°</div>
                            <div class="wf-temp-min"><?=$forecast['temp']['min']?>°</div>
                        </div>
                    </div>
                </a>
            <?php endforeach ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="weather-evolution daily">
        <div class="we-title"><?=$lang['evolution']?></div>
        <div class="chart-container">
            <div class="chart-title"><?=$lang['daily_forecast_evolution']?> (°<?=($data['format'] == 1 ? $lang['f'] : $lang['c'])?>)</div>
            <div class="ct-chart">
                <script>
                    var chartData = {
                        labels: [<?php foreach(($lang['lang_dir'] == 'rtl' ? array_reverse($data['weather_forecast']['daily']) : $data['weather_forecast']['daily']) as $forecast): ?>'<?=$lang[$forecast['day']]?>',<?php endforeach ?>],
                        series: [
                            [<?php foreach(($lang['lang_dir'] == 'rtl' ? array_reverse($data['weather_forecast']['daily']) : $data['weather_forecast']['daily']) as $forecast): ?>'<?=$forecast['temp']['max']?>',<?php endforeach ?>],
                            [<?php foreach(($lang['lang_dir'] == 'rtl' ? array_reverse($data['weather_forecast']['daily']) : $data['weather_forecast']['daily']) as $forecast): ?>'<?=$forecast['temp']['min']?>',<?php endforeach ?>]
                        ]
                    };

                    var chartOptions = {
                        axisY: {
                            <?php if($lang['lang_dir'] == 'rtl'): ?>
                            position: 'end',
                            <?php endif ?>
                            labelInterpolationFnc: function(value) {
                                return (value) + '°';
                            }
                        },
                        fullWidth: true,
                        lineSmooth: false,
                        chartPadding: {
                            <?php if($lang['lang_dir'] == 'rtl'): ?>
                            right: 10,
                            left: 50,
                            <?php else: ?>
                            right: 50,
                            <?php endif ?>
                            top: 20
                        },
                        height: 200
                    }

                    var chart = new Chartist.Line('.ct-chart', chartData, chartOptions);
                </script>
            </div>
            <div class="chart-legends">
                <div class="chart-legend"><div class="legend-color legend-min"></div><div class="legend-name"><?=$lang['lowest_temperature']?></div></div>
                <div class="chart-legend"><div class="legend-color legend-max"></div><div class="legend-name"><?=$lang['highest_temperature']?></div></div>
            </div>
        </div>
    </div>
</div>