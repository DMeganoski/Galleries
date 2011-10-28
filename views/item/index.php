<?php if (!defined('APPLICATION')) exit();
// This is the single Item page
include (PATH_APPLICATIONS.DS.'galleries/views/helper/helper.php');
$FileInfo = $this->FileData;

?>
<div id="Custom">
	<div class="Large Picture">
		<div class="Heading">
			<h1><?php echo $FileInfo->Name.' ('.$FileInfo->Slug.')'; ?></h1>
			<h2>Click the button below to add this <? echo T(substr($FileInfo->ClassLabel, 0, -1))?> to your project</h2>
		</div>
			<div class="Verify"></div>
			<div class="ButtonWrapper">
				<center>
				<a href="/project/select/background/'.$Slug.'" class="ProjectSelect BigButton"  itemtype="<? echo $FileInfo->ClassLabel ?>" itemslug="<? echo $FileInfo->Slug ?>">Select This Background</a><?
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

