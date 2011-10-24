<?php if (!defined('APPLICATION'))
	exit();
$Items = $this->GalleryItemModel->GetWhere(array('ClassLabel' => GalleryController::$Class, 'Visible' => 1));

?><div id="Custom">
   <div class="PageHeading">
      <h1>Choose your tin color below</h1>
   </div>
<?php
    ?><div class="Home Gallery Tins">
        <?php
        foreach ($Items as $Item) {
				$Name = $Item->Name;
				$Slug = $Item->Slug;
            echo '<div'.($Sender->RequestMethod == '' ? ' class="Image Category Tins"' : '').'>';
	    echo '<img src="'.$this->PublicDir.GalleryController::$Class.DS.$Slug.'M.jpg" class="Gallery Category Tins"></img>';
	    echo '<table>';
	    echo '<tr>';
	    echo '<th>'.T($Name).' Finish</th>';
	    echo '</tr>';
	    echo '<tr>';
	    echo '<td class="Select"><a href="/project/select/base/'.$Slug.'" class="TinSelect BigButton">Select This Color Tin</button></td>';
	    echo '</tr>';
	    echo '</table>';
	    echo '</div>';
        }?>
       <div class="PriceLink">
	  <a href="/gallery/default/pricing" class="BigButton">Price Guide</a>
       </div>
    </div>
</div>