<?php if (!defined('APPLICATION'))
	exit(); ?>
<div id="Custom">
		<?php
		echo '<div class="PageHeading">';
			echo '<h1>My Personal Uploads <a href="/item/upload" class="Button">Upload New Item</a></h1>';
		echo '</div>';
	echo '<div class="Uploads">';
		if(is_object($this->Uploads)) {
			$Uploads = $this->Uploads;
			echo '<ul id="Uploads">';
			$HTML = '';
			foreach ($Uploads as $File) {
				$FileName = $File->FileName;
				if (strlen($FileName)< 28) {
					$FileLabel = $FileName;
				} else {
					$FileLabel = substr($FileName, 0, 25);
					$FileLabel .= '...';
				}
				$FileParts = pathinfo($FileName);
				$BaseName = $FileParts['filename'];
				$HTML .= '<li class="UploadData" uploadid="'.$File->UploadKey.'">';
				$HTML .= '<img src="/uploads/submitted/'.$this->UserID.DS.$BaseName.'-Thumb.jpg" class="Thumb"></img>';
				$HTML .= '<br/>';
				$HTML .= '<strong>'.$FileLabel.'</strong>';
				$HTML .= '</br>';
				$HTML .= $File->Description;
				$HTML .= '<br/>';
				$HTML .= '<button type="button" class="UploadDelete Button" id="Delete" uploadid="'.$File->UploadKey.'">Delete Image</button>';
				$HTML .= '<button type="button" class="ProjectInclude Button" id="Upload" uploadid="'.$File->UploadKey.'">Add to Project</button>';
				$HTML .= '<div class="ClearFix"></div>';
				$HTML .= '</li>';

			}
			echo $HTML;
			echo '</ul></div></div>';
		} else {
			echo "<h3 class='NoUploads'>You have not uploaded any images yet. To upload an image from your computer, click the button up top.</h3>";
			echo "<img src='/applications/galleries/design/images/arrow_up.png' class='ArrowUp'/>";
		}

	?></div>
</div>
