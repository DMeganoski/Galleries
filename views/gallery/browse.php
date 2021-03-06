<?php if (!defined('APPLICATION'))exit();

// Basically the view for all custom photo galleries.
// Lists the given images, and creates the necessary links for pages.
// @ $AllFiles, @ $PublicDir

$ActiveClass = GalleryController::$Class;
$ClassDirectory = PATH_UPLOADS.DS.'item'.DS.$ActiveClass;
$ActiveCategory = GalleryController::$Category;
// overridden in galleryside.php, still needed?
$Classes = $this->GetClasses();
$Limit = GalleryController::$Limit;
$Category = GalleryController::$Page;
$Offset = (($Category - 1) * $Limit);
//$LimitedFiles = array_slice($AllFiles, $Offset, $Limit, TRUE);
$ShortCat = substr($ActiveCategory, 0, 3);
$CapsCat = strtoupper($ShortCat);

if ($this->GalleryItemModel)
$AllFiles = $this->GalleryItemModel->Get($Offset, $Limit, array('CategoryCAPS' => $CapsCat));
$NextPage = ($Category + 1);
$PreviousPage = ($Category -1);
$OffsetLess = $Offset - $Limit;
$OffsetMore = $Offset + $Limit;
$Count = $this->Count;
$PageMax = ceil($Count / $Limit);
?><div class="Custom"><?php
if (!is_a($AllFiles, Gdn_DataSet)) {
      echo '<h1>Sorry, no items found</h1></div>';
    } else {
		if (C('Galleries.ShowFireEvents'))
			$this->DisplayFireEvent('BeforeBrowseView');

	 $this->FireEvent('BeforeBrowseView');
?>
	<div class="PageHeading">
		<h1>Click an item below</h1>
	</div>
<ul class="Gallery">
    <?php
    foreach($AllFiles as $Item){
	?><li id="ImageWrapper" class="Item Gallery Image">
	    <a href="<?php echo '/item'.DS.$Item->Slug; ?>">
		<span><? echo $Item->Name; ?></span>
            <img src="<?php
            echo $this->PublicDir.$ActiveClass.DS.$Item->Slug.'M.jpg';
            echo '" class="Gallery Image"';
	    echo 'page="/item'.DS.$Item->Slug.'"';
	    echo ' itemslug="'.$Item->Slug.'" itemtype="'.$Item->ClassLabel;
            ?>"/>
	    </a>
	</li><?php
                }
?></ul>
</div>
<div class="Pager">
    <ul><?
        if ($Offset != 0)
	    echo '<li class="Less Button"><a href="/gallery/'.$ActiveClass.DS.$ActiveCategory.DS.$PreviousPage.'" class="Less">< Previous Page</a></li>';

        if ($Count > $Offset + $Limit)
	    echo '<li class="More Button"><a href="/gallery/'.$ActiveClass.DS.$ActiveCategory.DS.$NextPage.'">Next Page ></a></li>';
    ?></ul>
</div>
<div class="Pager"><?php
   echo '<li class="Page">Page: ';
   if ($Category > 2)
      echo '<a href="/gallery/'.$ActiveClass.DS.$ActiveCategory.DS.($Category-2).'" class="Inactive">'.($Category-2).'</a>';
   if ($Category > 1)
      echo '<a href="/gallery/'.$ActiveClass.DS.$ActiveCategory.DS.($Category-1).'" class="Inactive">'.($Category-1).'</a>';
   echo '<a href="/gallery/'.$ActiveClass.DS.$ActiveCategory.DS.$Category.'" class="Active">'.$Category.'</a>';
   if ($Category < $PageMax)
      echo '<a href="/gallery/'.$ActiveClass.DS.$ActiveCategory.DS.($Category+1).'" class="Inactive">'.($Category+1).'</a>';
   if ($Category < $PageMax - 1)
      echo '<a href="/gallery/'.$ActiveClass.DS.$ActiveCategory.DS.($Category+2).'" class="Inactive">'.($Category+2).'</a>';
   echo 'out of '.$PageMax.'</li>';

?></div><?
 if (C('Galleries.ShowFireEvents'))
			$this->DisplayFireEvent('AfterBrowsePager');

	$this->FireEvent('AfterBrowsePager');
	}
