<?php
defined('FIR') OR exit();
/**
 * The template for displaying the header section
 */
?>
<div id="header" class="header">
    <div class="header-content">
        <div class="header-col header-col-logo"><a href="<?=$data['url']?>/"><div class="logo"><img src="<?=$data['url'].'/'.PUBLIC_PATH.'/'.UPLOADS_PATH?>/brand/<?=$data['settings']['logo']?>"></div></a></div>
        <div class="header-col-content"><?=(isset($data['search_bar_view']) ? $data['search_bar_view'] : '')?></div>
        <div class="header-col header-col-menu">
            <div class="header-menu-el">
                <div class="icon header-icon icon-menu menu-button" id="db-menu" data-db-id="menu"></div>
                <div class="menu" id="dd-menu">
                    <div class="menu-content">
                        <?php foreach($data['site_menu'] as $key => $value): ?>
                            <?php if(isset($_SESSION['user']['id'])): ?>
                                <div class="divider"></div>
                            <?php else: ?>
                                <div class="menu-title"><?=$lang[$key]?></div>
                                <div class="divider"></div>
                            <?php endif ?>

                            <?php if(is_array($value)): ?>
                                <?php foreach($value as $list => $meta): ?>
                                    <a href="<?=$data['url']?>/<?=$key?>/<?=$list?>"<?=(($meta[0] == true) ? ' data-nd' : '')?>><div class="menu-icon icon-<?=$list?>"></div><?=$lang[$list]?></a>
                                <?php endforeach ?>
                            <?php endif ?>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>
        <?=(isset($data['menu_view']) ? $data['menu_view'] : '')?>
    </div>
</div>