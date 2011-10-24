<?php if (!defined('APPLICATION')) exit();
// This is the Cover Class Home Page
include(PATH_APPLICATIONS.DS.'galleries/views/helper/helper.php');


?>
<div id="Custom"><?php
	if (C('Galleries.ShowFireEvents'))
		$this->DisplayFireEvent('BeforeCategoriesView');

	 $this->FireEvent('BeforeCategoriesView'); ?>
    <ul class="Home Gallery Image">
        <?php
        foreach ($this->Categories as $Item) {
            $Name = $Item->CategoryLabel;
            if ($Name != $ActiveCategory) {
	       $CategoryID = $Item->CategoryKey;
            echo '<li'.($Sender->RequestMethod == '' ? ' class="Gallery Category"' : '').'><a href="/gallery/'.$ActiveClass.DS.$Name.'"><img src="'.$PublicDir.$ActiveClass.DS.'categories'.DS.$Name.'.jpg" class="Gallery Category"></img>
			</a><span class="Count">'.$this->GalleryItemModel->GetCount(array('CategoryKey' => $CategoryID)).' Total</span></li>';
        }}?>
    </ul></div><?php
	if (C('Galleries.ShowFireEvents'))
		$this->DisplayFireEvent('AfterCategoriesView');

	 $this->FireEvent('AfterCategoriesView');

