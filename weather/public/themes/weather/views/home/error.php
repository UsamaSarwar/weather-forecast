<?php
defined('FIR') OR exit();
/**
 * The template for displaying the No Results Error page
 */
?>
<div class="row">
    <?=$this->message()?>
    <div class="error-header">
        <div class="error-title"><?=sprintf($lang['no_results_found'], '<strong>'.e($data['location']).'</strong>')?></div>
    </div>
    <div class="weather-forecast">
        <div class="error-description">
            <?=$lang['suggestions']?>
            <ul>
                <li><?=$lang['suggestion_1']?></li>
                <li><?=$lang['suggestion_2']?></li>
                <li><?=$lang['suggestion_3']?></li>
            </ul>
        </div>
    </div>
</div>