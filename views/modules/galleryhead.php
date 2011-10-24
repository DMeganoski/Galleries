<?php if (!defined('APPLICATION')) exit();
//$ActiveClass = GalleryController::$Class;
//$ActiveCategory = GalleryController::$Category;
?>
<div class="Tabs">
    <ul>
        <?php
        foreach ($this->Classes as $Item) {
            $Name = ($Item->ClassLabel);
            if ($Item->Visible == '1'  && $Name != 'designer') {
				if ($Name == $ActiveClass) {
					$CSS = 'Active';
				} else {
					$CSS = 'Depth';
				}
		if ($Name == 'default') {
			echo '<li'.($this->RequestMethod == '' ? ' class="Navigation Images '.$CSS.'"' : '').'>'
					.'<a href="/info/home" class="TabButton">'.T('default').'</a>';

			?><ul class="Sublist"><?
			$Items = $this->GetCategories($Name);
			foreach ($Items as $Item) {
				if ($Item->Visible == '1') {
					if ($Item->Label == $ActiveCategory) {
						$CatCSS = 'Active';
					} else {
						$CatCSS = 'Depth';
					}
					if ($Item->CategoryLabel != 'home' && $Name != 'designer')
					echo '<li>'.Anchor(T($Item->CategoryLabel), '/info'.DS.$Item->CategoryLabel).'</li>';
				}
			}
			?><li class="ClearFix"></li>
			</ul>
	</li><?
		} else {
			echo '<li'.($this->RequestMethod == '' ? ' class="Navigation Images '.$CSS.'"' : '').'>'
					.'<a href="/gallery/'.$Name.'" class="TabButton">'.T($Name).'</a>';

			?><ul class="Sublist"><?
			$Items = $this->GetCategories($Name);
			foreach ($Items as $Item) {
				if ($Item->Visible == '1') {
					if ($Item->Label == $ActiveCategory) {
						$CatCSS = 'Active';
					} else {
						$CatCSS = 'Depth';
					}
					if ($Item->CategoryLabel != 'home' && $Name != 'designer')
					echo '<li>'.Anchor(T($Item->CategoryLabel), 'gallery'.DS.$Name.DS.$Item->CategoryLabel).'</li>';
				}
			}
			?><li class="ClearFix"></li>
			</ul><?
		}}}
    ?><li>
		<a href="/designer"><? echo T('designer') ?></a>
		<ul class="Sublist">
			<li><a href="/designer/text/">Text</a></li>
		</ul>
	</li>
	</ul>
</div>

