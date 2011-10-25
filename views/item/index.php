<?php if (!defined('APPLICATION')) exit();
// This is the single Item page
include (PATH_APPLICATIONS.DS.'galleries/views/helper/helper.php');
$FileInfo = $this->FileData;

?>
<div id="Custom">
	<div class="Large Picture">
		<div class="Heading">
			<h1><?php echo $FileInfo->Name.' ('.$FileInfo->Slug.')'; ?></h1><?
			if (ItemController::$SelectedClass == 'backgrounds') {
				?><h2>You choose a frame if you like, then drag the image to your project box</h2><?
			} else {
				?><h2>The Image of the product is draggable. You can drag the item to your project box.</h2><?
			}
		?></div>
			<div class="Verify"></div>
			<div class="ButtonBox">
				<center>
				<a href="/project/select/background/'.$Slug.'" class="BackgroundSelect BigButton"  itemtype="<? echo $FileInfo->ClassLabel ?>" itemslug="<? echo $FileInfo->Slug ?>" itemtype="<? ItemController::$SelectedClass ?>">Select This Background</a>
				<button type="button" name="pjSubmitNew" id="pjSubmitNew" onclick="" class="NewSelection Button">Use this in a new project</button><?
				if (CheckPermission('Gallery.Items.Manage')) {
					?><button onclick="window.location = '/item/edit/<? echo $FileInfo->Slug ?>'" class="NonTab Button">Edit</button><?
				}
				?></center>
			</div>
			<table><tr>
			<td>Description: <td><?
			echo '<td>'.$FileInfo->Description.'</td>';
			?></tr></table>

		<div class="DetailsWrapper">
			<?php
		echo '<div id="ImageWrapper">';
		echo '<img src="'.$this->PublicDir.$FileInfo->ClassLabel.DS.$FileInfo->Slug.'L.jpg" class="Single"></img>';
		echo '</div>';
		include(PATH_APPLICATIONS.DS.'galleries/customfiles/detailedinfo.php');
		?>
		</div>
	</div><div class="ClearFix"></div>
</div><?php
 if (C('Galleries.ShowFireEvents'))
			$this->DisplayFireEvent('AfterItemDetails');

	$this->FireEvent('AfterItemDetails');
$FileInfo = $this->FileData;
if (ItemController::$SelectedClass == 'backgrounds') {
	 /*
	<div>
		<ul id="Frames">
			<li id="Click" class="Button None Active" type="None">No Frame</li>
			<li id="Click" class="Button Pewter" type="Pewter">Pewter Frame</li>
			<li id="Click" class="Button GoldEmblem" type="GoldEmblem">Gold Emblem Frame</li>
			<li id="Click" class="Button Traditional" type="Traditional">Traditional Frame</li>
			<li id="Click" class="Button Modern" Type="Modern">Modern Frame</li>
			<li id="Click" class="Button Wood" type="Wood">Wood Frame</li>
			<li id="Click" class="Button GoldLeaf" type="GoldLeaf">Gold Leaf Frame</li>
		</ul>

		echo '</div>'; */
} else {

}

