<?php if (!defined('APPLICATION')) exit();
$Session = Gdn::Session();
?>
<div class="Help Aside">
   <?php
   echo '<h2>', T('Need More Help?'), '</h2>';
   echo '<ul>';
   echo '<li>', Anchor(T('Managing Categories'), 'http://vanillaforums.org/docs/managecategories'), '</li>';
   echo '<li>', Anchor(T('Adding & Editing Categories'), 'http://vanillaforums.org/docs/managecategories#add'), '</li>';
   echo '</ul>';
   ?>
</div>
<h1><?php echo T('Manage Categories'); ?></h1>
<div class="Info">
   <?php echo T('Categories are used to help organize the gallery.', 'Categories are used to help organize the gallery. Click on a category to edit it.'); ?>
</div>
<div class="FilterMenu"><?php
	  echo Anchor(T('Add Class'), 'galleries/settings/addclass', 'Button');
?></div>
	<div class="Help Aside">
		<?php
		echo '<h2>', T('Did You Know?'), '</h2>';
		echo '<ul>';
		echo '<li>', sprintf(T('You can make the categories page your homepage.', 'You can make your categories page your homepage <a href="%s">here</a>.'), Url('/dashboard/settings/homepage')), '</li>';
		echo '<li>', sprintf(T('Make sure you click View Page', 'Make sure you click <a href="%s">View Page</a> to see what your categories page looks like after saving.'), Url('/categories/all')), '</li>';
		echo '<li>', T('Drag and drop the categories below to sort and nest them.'), '</li>';
		echo '</ul>';
		?>
	</div>
	<h1><?php
		echo T('Existing Classes and Categories');
	?></h1>
	<?php
	echo '<ol class="Classes">';
	$ClassData = $this->CategoryData;
	foreach ($ClassData as $ClassID => $Item) {
		$ClassLabel = $Item['ClassLabel'];
		if ($Item['Visible'] == '0') {
			$CSS = 'Secret';
		} else {
			$CSS = 'Visible';
		}
		echo '<li><table class="GalleryClass"><tr class="Heading"><th class ="'.$CSS.'"><h1>'.$ClassLabel.' ('.T($ClassLabel).')</h1></th></tr>';
		echo '<tr><td>';
		echo Anchor(T('Edit Class'), 'galleries/settings/editclass/'.$ClassID, 'SmallButton EditClass');
		echo Anchor(T('Delete Class'), 'galleries/settings/delete/class/'.$ClassID, 'SmallButton DeleteClass');
		if($Item['HasCategories'])
		echo Anchor(T('Add Category to Class'), 'galleries/settings/addcategory/'.$ClassID, 'SmallButton AddCategory');

		echo '<blockquote>'.$Name.'</blockquote>';
		echo '</td></tr></table><ol class="Categories"><table class="Categories">';
		if(!empty($Item['Categories'])) {
			foreach($Item['Categories'] as $CategoryID => $CategoryLabel) {
				echo '<tr class="Category"><td class="Category"><h3>'.$CategoryLabel.' ('.T($CategoryLabel).')</h3>';
				echo '<div class="CategoryButtons">';
				echo Anchor(T('Edit Category'), '/galleries/settings/editcategory/'.$CategoryID, 'SmallButton');
				echo Anchor(T('Delete Category'), '/galleries/settings/delete/category/'.$CategoryID, 'SmallButton');
				echo '</div></td></tr>';
			}
	   } else {
		   echo '<tr class="Category"><td class="Category">No Categories</td></tr>';
	   }
	   //echo '<li class="ClearFix"></li>';
		echo '</table></ol></li>';

   }
   echo '</ol>';

