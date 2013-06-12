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
				if($Item->HasCategories == 1 && $Name != 'text') {
					$CategoryCss = 'Categories';
				} else {
					$CategoryCss = 'Single';
				}
		if ($Name == 'default') { 
			echo '<li'.($this->RequestMethod == '' ? ' class="Navigation Images '.$CSS.'"' : '').'>'
					.'<a href="/info/home" class="TabLink '.$CategoryCss.'">'.T('default').'</a>';
			if($Item->HasCategories == 1) {
			?><div class="SubTab"><?
			$Items = $this->GetCategories($Name);
			foreach ($Items as $Item) {
				if ($Item->Visible == '1') {
					if ($Item->Label == $ActiveCategory) {
						$CatCSS = 'Active';
					} else {
						$CatCSS = 'Depth';
					}
					echo Anchor(T($Item->CategoryLabel), '/info'.DS.$Item->CategoryLabel);
				}
			}
			?></div><?
			}
	?></li><?
		} else {
			echo '<li'.($this->RequestMethod == '' ? ' class="Navigation Images '.$CSS.'"' : '').'>'
					.'<a href="/gallery/'.$Name.'" class="TabLink '.$CategoryCss.'">'.T($Name).'</a>';
			if($Item->HasCategories == 1) {
				?><div class="SubTab"><?
				$Items = $this->GetCategories($Name);
				foreach ($Items as $Item) {
					if ($Item->Visible == '1') {
						if ($Item->Label == $ActiveCategory) {
							$CatCSS = 'Active';
						} else {
							$CatCSS = 'Depth';
						}
						echo Anchor(T($Item->CategoryLabel), 'gallery'.DS.$Name.DS.$Item->CategoryLabel);
					}
				}
				?></div><?
                        }
                }
		}
		} // end for each classes
    ?><li>
		<a href="/designer" class="TabLink"><? echo T('designer') ?></a>
		<div class="SubTab">
			<a href="/designer/text/">Text</a>
		</div>
	</li>
	</ul>
</div>

