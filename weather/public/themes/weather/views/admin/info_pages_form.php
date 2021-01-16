<?php
defined('FIR') OR exit();
/**
 * The template for displaying the Info Pages Form
 * This template is used for both the New Page and the Edit Page sections
 */
?>
<?=$this->message()?>
<?php if($data['form_for'] == 1): ?>
<form action="<?=$data['url']?>/admin/info_pages/edit/<?=$data['info_page']['id']?>" method="post">
<?php else: ?>
<form action="<?=$data['url']?>/admin/info_pages/new" method="post">
<?php endif ?>
    <?=$this->token()?>
    <label for="i_page_title"><?=$lang['page_title']?></label>
    <input type="text" name="page_title" id="i_page_title" placeholder="<?=$lang['page_title']?>" value="<?=e(isset($data['info_page']['title']) ? $data['info_page']['title'] : '')?>" maxlength="64">

    <label for="i_page_url"><?=$lang['page_url']?></label>
    <input type="text" name="page_url" id="i_page_url" placeholder="<?=$lang['page_url']?>" value="<?=e(isset($data['info_page']['url']) ? $data['info_page']['url'] : '')?>" maxlength="64">

    <label for="i_page_public"><?=$lang['page_public']?></label>
    <select name="page_public" id="i_page_public">
        <option value="1"<?=($data['info_page']['public'] == '1' ? ' selected' : '')?>><?=$lang['yes']?></option>
        <option value="0"<?=($data['info_page']['public'] == '0' ? ' selected' : '')?>><?=$lang['no']?></option>
    </select>

    <label for="i_page_content"><?=$lang['page_content']?></label>
    <textarea name="page_content" id="i_page_content" placeholder="<?=$lang['page_content']?>"><?=e(isset($data['info_page']['content']) ? $data['info_page']['content'] : '')?></textarea>

    <button type="submit" name="submit" class="float-left"><?=$lang['save']?></button>
    <?php if($data['form_for'] == 1): ?>
    <a href="<?=$data['url']?>/admin/info_pages"><div class="button button-neutral button-margin-left float-left"><?=$lang['cancel']?></div></a>
    <a href="<?=$data['url']?>/admin/info_pages/delete/<?=$data['info_page']['id']?>"><div class="button button-delete button-margin-left float-left"><?=$lang['delete']?></div></a>
    <?php endif ?>
</form>