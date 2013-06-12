<?php if (!defined('APPLICATION')) exit();
// This is the Cover Class Home Page

?>
<div id="Custom"><?php
	if (C('Galleries.ShowFireEvents'))
		$this->DisplayFireEvent('BeforeCategoriesView');

	 $this->FireEvent('BeforeCategoriesView'); ?>
    <ul class="Home Gallery Image">
        <?php
        foreach ($this->Categories as $Item) {
            $Name = $Item->CategoryLabel;
            if ($Name != 'home') {
	       $CategoryID = $Item->CategoryKey;
            echo '<li'.($Sender->RequestMethod == '' ? ' class="Gallery Category"' : '').'><a href="/gallery/'.GalleryController::$Class.DS.$Name.'"><img src="'.$this->PublicDir.GalleryController::$Class.DS.'categories'.DS.$Name.'.jpg" class="Gallery Category"></img>
			</a><span class="Count">'.$this->GalleryItemModel->GetCount(array('CategoryKey' => $CategoryID)).' Total</span></li>';
        }}?>
    </ul></div><?php
	if (C('Galleries.ShowFireEvents'))
		$this->DisplayFireEvent('AfterCategoriesView');

	 $this->FireEvent('AfterCategoriesView');

