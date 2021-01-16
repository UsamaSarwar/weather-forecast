<?php
defined('FIR') OR exit();
/**
 * The template for displaying Weather forecast
 */
?>
<div class="row">
    <div class="weather-forecast hourly">
        <?=$data['settings']['ads_2']?>
        <div class="wf-title"><?=$lang['hourly_forecast']?></div>
        <div>
            <?php foreach($data['weather_forecast']['hourly'] as $forecast): ?>
                <div class="wf-list">
                    <div class="wf-list-col wf-date">
                        <div class="wf-day"><?=sprintf($lang['hour_format'], $forecast['hour'][0], $forecast['hour'][1])?></div>
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
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="weather-evolution hourly">
        <div class="we-title"><?=$lang['evolution']?></div>
        <div class="chart-container">
            <div class="chart-title"><?=$lang['hourly_forecast_evolution']?> (°<?=($data['format'] == 1 ? $lang['f'] : $lang['c'])?>)</div>
            <div class="ct-chart">
                <script>
                    var chartData = {
                        labels: [<?php foreach(($lang['lang_dir'] == 'rtl' ? array_reverse($data['weather_forecast']['hourly']) : $data['weather_forecast']['hourly']) as $forecast): ?>'<?=sprintf($lang['hour_format'], $forecast['hour'][0], $forecast['hour'][1])?>',<?php endforeach ?>],
                        series: [
                            [<?php foreach(($lang['lang_dir'] == 'rtl' ? array_reverse($data['weather_forecast']['hourly']) : $data['weather_forecast']['hourly']) as $forecast): ?>'<?=$forecast['temp']['max']?>',<?php endforeach ?>]
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
                    };

                    var chart = new Chartist.Line('.ct-chart', chartData, chartOptions);
                </script>
            </div>
            <div class="chart-legends">
                <div class="chart-legend"><div class="legend-color legend-neutral"></div><div class="legend-name"><?=$lang['temperature']?></div></div>
            </div>
        </div>
    </div>
</div>