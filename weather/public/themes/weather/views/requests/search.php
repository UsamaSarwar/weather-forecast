<?php
defined('FIR') OR exit();
/**
 * The template for displaying the Search Requests
 */
?>
<?php if($data['results']): ?>
    <?php foreach($data['results'] as $result): ?>
        <div class="search-list-item">
            <a href="<?=$data['url']?>/location/<?=e($result['id'])?>"><div class="search-list-name"><?=e($result['name'])?>, <?=e($result['country'])?></div></a>
        </div>
    <?php endforeach ?>
<?php else: ?>
    <div class="search-list-item">
        <?=sprintf($lang['no_results_found'], '<strong>'.$data['query'].'</strong>')?>
    </div>
<?php endif ?>