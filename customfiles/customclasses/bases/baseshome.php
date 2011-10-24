<?php if (!defined('APPLICATION')) exit();
include(PATH_APPLICATIONS.DS.'galleries/views/helper/helper.php');
// This is the Tin Home Page
$Items = $this->GetCategories($ActiveClass);
?>
<div id="Custom">
   <div class="Heading">
      <h1>Choose your tin shape, size, and color below</h1>
      <p>We unfortunately only have round tins available at this time</p>
   </div>
<?php
    ?><div class="Home Gallery Tins">
        <?php
        foreach ($Items as $Item) {
				$Name = $Item->CategoryLabel;
            if ($Name != $ActiveCategory && $Item->Visible == '1') {
				$CategoryID = $Item->CategoryKey;
            echo '<div'.($Sender->RequestMethod == '' ? ' class="Image Category Tins"' : '').'>';
	    echo '<a href="/gallery/'.$ActiveClass.DS.$Name.'">';
	    echo '<img src="'.$PublicDir.$ActiveClass.DS.'categories'.DS.$Name.'.jpg" class="Gallery Category Tins"></img>';
	    echo '</a>';
	    echo '<span class="Count">'.$this->GalleryItemModel->GetCount(array('CategoryKey' => $CategoryID)).' Total</span>';
	    echo '<table>';
	    echo '<tr>';
	    echo '<th>'.T($Name).' Finish</th>';
	    echo '</tr>';
	    echo '<tr>';
	    echo '<td class="Size">Sizes Available:</td>';
	    echo '</tr>';
	    $Items = $this->GalleryItemModel->Get(0,0, array('CategoryKey' => $CategoryID));
	    foreach ($Items as $FileInfo) {
	    echo '<tr><td><a href="/item/'.$FileInfo->Slug.'">'.$FileInfo->Name.'</a></td></tr>';
	    }
	    echo '</table>';
	    echo '</div>';
        }}?>
       <div class="PriceLink">
	  <a href="/gallery/default/pricing" class="BigButton">Price Guide</a>
       </div>
    </div>
</div>