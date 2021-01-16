<?php
defined('FIR') OR exit();
/**
 * The template for displaying the Info Page delete section
 */
?>
<?=$this->message()?>
<form action="<?=$data['url']?>/admin/info_pages/delete/<?=$data['info_page']['id']?>" method="post">
    <?=$this->token()?>
    <button type="submit" name="submit" class="button-delete float-left"><?=$lang['delete']?></button>
    <a href="<?=$data['url']?>/admin/info_pages/edit/<?=$data['info_page']['id']?>"><div class="button button-neutral button-margin-left float-left"><?=$lang['cancel']?></div></a>
</form>