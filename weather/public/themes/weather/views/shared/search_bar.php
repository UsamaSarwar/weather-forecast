<?php
defined('FIR') OR exit();
/**
 * The template for displaying the Search Bar
 */
?>
<div class="search-content">
    <div class="search-container">
        <input type="text" name="search" id="search-input" class="search-input" tabindex="1" autocomplete="off" autocapitalize="off" autocorrect="off" data-search-url="<?=$data['url']?>/requests/search" data-token-id="<?=$_SESSION['token_id']?>" data-autofocus="<?=$data['autofocus']?>" placeholder="<?=$lang['city_name']?>">
        <div id="clear-button" class="clear-button"></div>
        <div id="search-button" class="search-button"></div>
        <div class="fav-list">
            <div class="fav-list-icon fav-list-close" onclick="closeFavorites()"></div><div class="fav-list-title"><?=$lang['favorites']?></div>
            <div class="fav-list-container">
            <?php foreach($data['favorites']['items'] as $key => $value): ?>
                <div class="fav-list-item" data-favorite-item="<?=e($key)?>">
                    <div class="fav-list-icon" onclick="setFavorite(<?=e($key)?>)"></div>
                    <a href="<?=$data['url']?>/location/<?=e($key)?>"><div class="fav-list-name"><?=e($value)?></div></a>
                </div>
            <?php endforeach ?>
            </div>
        </div>
        <div class="search-list">
            <div class="search-list-icon search-list-close" onclick="closeSearchResults()"></div><div class="search-list-title"><?=$lang['search_results']?></div>
            <div class="search-list-container" id="search-results"></div>
        </div>
    </div>
</div>