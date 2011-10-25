<?php if (!defined('APPLICATION')) exit();
// This is the Tin Home Page
$Items = $this->GalleryItemModel->GetWhere(array('ClassLabel' => GalleryController::$Class, 'Visible' => 1));
?>
<div id="Custom">
   <div class="PageHeading">
      <h1>Choose your tin color below</h1>
   </div>
<?php
    ?><div id="Choices" class="Home Gallery Tins">
		<ul class="Gallery">
        <?php
        foreach ($Items as $Item) {
			$Name = $Item->Name;
			$Slug = $Item->Slug;
			echo '<li>';
			echo '<a href="/item/'.$Slug.'" class="ItemPage">';
			echo '<img src="'.$this->PublicDir.GalleryController::$Class.DS.$Slug.'L.jpg" class="Gallery Tins"></img>';
			echo '</a>';
			echo '<table class="ItemInfo">';
			echo '<tr>';
			echo '<th>'.T($Name).' Finish</th>';
			echo '</tr>';
			echo '</table>';
			echo '<a href="/project/select/base/'.$Slug.'" class="ProjectSelect BigButton" itemslug="'.$Slug.'" itemtype="'.GalleryController::$Class.'">Select This Color Tin</a>';
			echo '</li>';
        }?>
		</ul>
		<div class="PriceLink">
	  <a href="/gallery/default/pricing" class="BigButton">Price Guide</a>
       </div>
    </div>
</div>