<?php if (!defined('APPLICATION'))
	exit();


$Session = Gdn::Session();
$UploadOK = $this->Form->IsPostBack() && $this->Form->ErrorCount() == 0;

?>

<h1 class="PageHeading"><?php echo T('Upload an Image for Your Project') ?></h1>
<div class="HelpWrapper">
	<div class="Help Aside">
		<h2>Choose Your Pictures</h2>
		<li class="Info">Choose as many files as you would like to upload, and click submit.</li>
	</div>
	<div class="Help Aside">
		<h2>File Types</h2>
		<li class="Info">Accepted file types are:</li>
		<li class="Info"> .jpg, .png, .psd, .ai, .eps, and .cdr.</li>
	</div>
	<div class="Help Aside">
		<h2>File Size</h2>
		<li class="Info">The <? echo T('bases') ?> are printed in high resolution. Images to be used in the project should be as high-resolution as possible.</li>
	</div>

	<div class="Help Aside">
		<h2>Add a Note</h2>
		<li class="Info">The description will be applied to all the files chosen.</li>
		<li class="Info">This can be used for personal identification, or as a note for our staff.</li>
	</div>
</div>
<?php
echo $this->Form->Open(array('enctype' => 'multipart/form-data'));
echo $this->Form->Errors();
?>
<ul class="GalleryUploadForm"><?php
if ($UploadOK != False) {
	/*
}
	echo Wrap($this->Form->TextBox('RawData', array('Multiline' => True)), 'li');
	echo '<li>';
	echo $this->Form->CheckBox('WithDomain', T('With Domain'));
	echo $this->Form->CheckBox('AbsoluteURL', T('Absolute URL'));
	echo $this->Form->CheckBox('MakeMarkDownIDs', T('Markdown IDs'));
	echo '</li>';
	 */
}
 ?><li><?php
echo $this->Form->Label('Choose File', 'File');
echo $this->Form->Input('Files[]', 'file', array('multiple' => 'multiple'));
?></li>
<li><?php
/* if (isset($this->UploadTo)) {
	echo $this->Form->Label('Upload To', 'UploadTo');
	echo $this->Form->DropDown('UploadTo', $this->UploadTo, array('IncludeNull' => True));
}
*/?></li>
<li>
<strong><?php echo Gdn::Translate('If File Exists') ?>:</strong>
<?php
//echo $this->Form->CheckBox('Rename', Gdn::Translate('ToRename'))
if($Session->CheckPermission('Plugins.Garden.LoadUp.Overwrite'))
	echo $this->Form->CheckBox('Overwrite', T('Overwrite Existing?'));
?>
</li>

</ul>
<?php
echo $this->Form->Button('Upload');
echo $this->Form->Close();
?>

