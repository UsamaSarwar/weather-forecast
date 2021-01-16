<?php
defined('FIR') OR exit();
/**
 * The main template file
 * This file puts together the three main section of the software, header, content and footer
 */
?>
<!DOCTYPE html>
<html class="<?php if($data['cookie']['dark_mode']): ?>dark<?php else: ?>light<?php endif ?> <?=$lang['lang_dir']?>" dir="<?=$lang['lang_dir']?>">
<head>
    <meta charset="UTF-8" />
    <title><?=e($this->docTitle())?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="<?=$data['url']?>/<?=UPLOADS_PATH?>/brand/<?=$data['settings']['favicon']?>" rel="icon">
    <?php foreach(['chartist', 'style'] as $css): ?><link href="<?=$data['url']?>/<?=$data['theme_path']?>/<?=$data['settings']['site_theme']?>/assets/css/<?=$css?>.css" rel="stylesheet" type="text/css">
    <?php endforeach ?>
    <?php foreach(['jquery', 'chartist.min', 'functions'] as $js): ?><script type="text/javascript" src="<?=$data['url']?>/<?=$data['theme_path']?>/<?=$data['settings']['site_theme']?>/assets/js/<?=$js?>.js"></script>
    <?php endforeach ?>
    <?=$data['settings']['tracking_code']?>
</head>
<body>
    <div id="loading-bar"></div>
    <?=$data['header_view']?>
    <?=$data['content_view']?>
    <?=$data['footer_view']?>
</body>
</html>