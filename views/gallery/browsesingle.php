<?php if (!defined('APPLICATION'))
	exit();
$Items = $this->GalleryItemModel->GetWhere(array('ClassLabel' => GalleryController::$Class, 'Visible' => 1));
$ClassSingle = substr(GalleryController::$Class, 0, (strlen(GalleryController::$Class) - 1));
?><div id="Custom">
   <div class="PageHeading">
      <h1 class="PageHeading">Choose your <? echo T($ClassSingle) ?> below</h1>
   </div>
<?php
    ?><div id="Choices" class="Home Gallery Tins">
		<ul class="Gallery">
        <?php
        foreach ($Items as $Item) {
				$Name = $Item->Name;
				$Slug = $Item->Slug;
		echo '<li>';
		echo '<table class="GalleryInfo">';
	    echo '<tr>';
	    echo '<th>'.T($Name).' '.T($ClassSingle).'</th>';
	    echo '</tr>';
	    echo '</table>';
		echo '<a href="/project/select/base/'.$Slug.'" class="ProjectSelect BigButton" itemslug="'.$Slug.'" itemtype="'.GalleryController::$Class.'">Select this '.T($ClassSingle).'</a>';
		echo '<a href="/item/'.$Slug.'" class="ItemPage ProjectSelect" itemslug="'.$Slug.'" itemtype="'.GalleryController::$Class.'"" title="'.$Name.' Frame">';
	    echo '<img src="'.$this->PublicDir.GalleryController::$Class.DS.$Slug.'L.jpg" class="Gallery"></img>';
	    echo '</a>';
		echo '</li>';
        }?>
       </ul>
		<div class="PriceLink">
	  <a href="/gallery/default/pricing" class="BigButton">Price Guide</a>
       </div>
    </div>
</div>