<?php
defined('FIR') OR exit();
/**
 * The template for displaying Home page content
 */
?>
<div id="content" class="content content-home">
    <?php if(empty($this->url[0]) && $data['settings']['weather_geo_location']): ?>
        <script>userLocation('<?=COOKIE_PATH?>');</script>
    <?php endif ?>
    <?=$data['results_view']?>
</div>