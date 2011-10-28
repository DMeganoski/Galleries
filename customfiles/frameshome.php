<?php if (!defined('APPLICATION'))
	exit();
$Items = $this->GalleryItemModel->GetWhere(array('ClassLabel' => GalleryController::$Class, 'Visible' => 1));

?><div id="Custom">
   <div class="PageHeading">
      <h1>Choose your frame below</h1>
   </div>
<?php
    ?><div id="Choices" class="Home Gallery Tins">
		<ul class="Gallery">
        <?php
        foreach ($Items as $Item) {
				$Name = $Item->Name;
				$Slug = $Item->Slug;
		echo '<li><a href="/item/'.$Slug.'" class="ItemPage" title="'.$Name.' Frame">';
	    echo '<img src="'.$this->PublicDir.GalleryController::$Class.DS.$Slug.'L.jpg" class="Gallery Frames"></img>';
	    echo '</a>';
		echo '<table class="GalleryInfo">';
	    echo '<tr>';
	    echo '<th>'.T($Name).' Frame</th>';
	    echo '</tr>';
	    echo '</table>';
		echo '<a href="/project/select/base/'.$Slug.'" class="ProjectSelect BigButton" itemslug="'.$Slug.'" itemtype="'.GalleryController::$Class.'">Select This '.T($Item->ClassLabel).'</a>';	    echo '</li>';
        }?>
       </ul>
		<div class="PriceLink">
	  <a href="/gallery/default/pricing" class="BigButton">Price Guide</a>
       </div>
    </div>
</div>