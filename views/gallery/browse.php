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
$Page = GalleryController::$Page;
$Offset = (($Page - 1) * $Limit);
//$LimitedFiles = array_slice($AllFiles, $Offset, $Limit, TRUE);
$ShortCat = substr($ActiveCategory, 0, 3);
$CapsCat = strtoupper($ShortCat);

if ($this->GalleryItemModel)
$AllFiles = $this->GalleryItemModel->Get($Offset, $Limit, array('CategoryCAPS' => $CapsCat));
$NextPage = ($Page + 1);
$PreviousPage = ($Page -1);
$OffsetLess = $Offset - $Limit;
$OffsetMore = $Offset + $Limit;
$Count = $this->Count;
$PageMax = ceil($Count / $Limit);
?>
<script type="text/javascript">
$(document).ready(function() {

	var dragging = false;

	$(".Project").droppable({
			"over": function( event, ui ) {
				$( this )
					.addClass( "ui-state-highlight" );

					},
					"drop": function( event, ui ) {
						var itemType = $(ui.draggable).attr("itemtype");
						var itemSlug = $(ui.draggable).attr("itemslug");
						$(this).doFrameSubmit();
						$(this).doProjectSubmit( itemType, itemSlug );
						//$(this).doFrameSubmit();
						$(this).removeClass( "ui-state-highlight" );
					},
					"out": function() {
						$(this).removeClass( "ui-state-highlight" );
					}

			});

	function browseHelper( src ) {
		return "<img src=\"" + src + "\" class=\"Helper\"></img>";
	}

	$("img.Gallery").draggable({"revert": "invalid", "opacity": "0.5", "cursor": 'move',
			"start": function(event,ui) {
				dragging = true;
				//$('.ProjectBox').show()
				//.updateProjectBox();
			},
			"stop": function() {
				$('img.Helper').hide();
				dragging = false;

			}
	});
	});
</script>
<div class="Custom"><?php
if (!is_a($AllFiles, Gdn_DataSet)) {
      echo '<h1>Sorry, no items found</h1></div>';
    } else {
		if (C('Galleries.ShowFireEvents'))
			$this->DisplayFireEvent('BeforeBrowseView');

	 $this->FireEvent('BeforeBrowseView');
?>
	<div class="Heading">
		<h2>Click an item for more information and options</h2>
		<p>Or simply drag it to your project box</p>
	</div>
<ul class="Gallery">
    <?php
    foreach($AllFiles as $Item){
            ?><li id="ImageWrapper" class="Item Gallery Image">
				<a href="<?php echo '/item'.DS.$Item->Slug; ?>">
                <img src="<?php
                echo $this->PublicDir.$ActiveClass.DS.$Item->Slug.'M.jpg';
                echo '" class="Gallery Image"';
				echo 'page="/item'.DS.$Item->Slug.'"';
				echo ' itemslug="'.$Item->Slug.'" itemtype="'.$Item->ClassLabel;
                ?>"/></a></li><?php
                }
?></ul>

</div>
<div class="Pager">
    <ul><?
        if ($Offset != 0)
        echo '<li class="Less Button"><a href="/gallery/'.$ActiveClass.DS.$ActiveCategory.DS.$PreviousPage.'" class="Less"> < Previous Page</a></li>';

        if ($Count > $Offset + $Limit)
        echo '<li class="More Button"><a href="/gallery/'.$ActiveClass.DS.$ActiveCategory.DS.$NextPage.'">Next Page > </a></li>';        ?>
    </ul>
</div>
<div class="Pager"><?php
   echo '<li class="Page">Page: ';
   if ($Page > 2)
      echo '<a href="/gallery/'.$ActiveClass.DS.$ActiveCategory.DS.($Page-2).'" class="Inactive">'.($Page-2).'</a>';
   if ($Page > 1)
      echo '<a href="/gallery/'.$ActiveClass.DS.$ActiveCategory.DS.($Page-1).'" class="Inactive">'.($Page-1).'</a>';
   echo '<a href="/gallery/'.$ActiveClass.DS.$ActiveCategory.DS.$Page.'" class="Active">'.$Page.'</a>';
   if ($Page < $PageMax)
      echo '<a href="/gallery/'.$ActiveClass.DS.$ActiveCategory.DS.($Page+1).'" class="Inactive">'.($Page+1).'</a>';
   if ($Page < $PageMax - 1)
      echo '<a href="/gallery/'.$ActiveClass.DS.$ActiveCategory.DS.($Page+2).'" class="Inactive">'.($Page+2).'</a>';
   echo 'out of '.$PageMax.'</li>';

?></div><?
 if (C('Galleries.ShowFireEvents'))
			$this->DisplayFireEvent('AfterBrowsePager');

	$this->FireEvent('AfterBrowsePager');
	}
