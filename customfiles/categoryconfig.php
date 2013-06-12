<?php if (!defined('APPLICATION')) exit();

/**
 * Configuration file for intitial categories.
 * Later, these will be editable in the dashboard.
 */

/*-------------------------------- Configure Classes --------------------------------------------*/
// you should keep the first three classes, as changing them will require changes to the source code.
$SQL->Replace('GalleryClass', array('ClassLabel' => 'bases', 'HasCategories' => 0, 'Visible' => '1'),
        array('ClassKey' => 1), TRUE);
$SQL->Replace('GalleryClass', array('ClassLabel' => 'backgrounds', 'HasCategories' => 0, 'HasCategories' => 1, 'Visible' => '1'),
        array('ClassKey' => 2), TRUE);
$SQL->Replace('GalleryClass', array('ClassLabel' => 'frames', 'HasCategories' => 0, 'HasCategories' => 0, 'Visible' => '1'),
        array('ClassKey' => 3), TRUE);


/*/*-------------------------------- Configure Categories -----------------------------------------*/
// always keep a home category for each class, as it is the default when an incorrect category is given
// Class 3 Categories (backgrounds)
$SQL->Replace('GalleryCategory',array ('CategoryLabel' => 'home', 'Visible' => '1', 'ClassKey' => 2),
	array('CategoryKey' => 201), TRUE);
$SQL->Replace('GalleryCategory',array ('CategoryLabel' => 'abstract', 'Visible' => '1', 'ClassKey' => 2),
	array('CategoryKey' => 202), TRUE);
$SQL->Replace('GalleryCategory',array ('CategoryLabel' => 'artnouveau', 'Visible' => '1', 'ClassKey' => 2),
	array('CategoryKey' => 203), TRUE);
$SQL->Replace('GalleryCategory',array ('CategoryLabel' => 'cityscapes', 'Visible' => '1', 'ClassKey' => 2),
	array('CategoryKey' => 204), TRUE);
$SQL->Replace('GalleryCategory',array ('CategoryLabel' => 'holiday', 'Visible' => '1', 'ClassKey' => 2),
	array('CategoryKey' => 205), TRUE);
$SQL->Replace('GalleryCategory',array ('CategoryLabel' => 'impressionism', 'Visible' => '1', 'ClassKey' => 2),
	array('CategoryKey' => 206), TRUE);
$SQL->Replace('GalleryCategory',array ('CategoryLabel' => 'industry', 'Visible' => '1', 'ClassKey' => 2),
	array('CategoryKey' => 207), TRUE);
$SQL->Replace('GalleryCategory',array ('CategoryLabel' => 'nature', 'Visible' => '1', 'ClassKey' => 2),
	array('CategoryKey' => 208), TRUE);
$SQL->Replace('GalleryCategory',array ('CategoryLabel' => 'realism', 'Visible' => '1', 'ClassKey' => 2),
	array('CategoryKey' => 209), TRUE);
$SQL->Replace('GalleryCategory',array ('CategoryLabel' => 'renaissance', 'Visible' => '1', 'ClassKey' => 2),
	array('CategoryKey' => 210), TRUE);
$SQL->Replace('GalleryCategory',array ('CategoryLabel' => 'romanticism', 'Visible' => '1', 'ClassKey' => 2),
	array('CategoryKey' => 211), TRUE);
$SQL->Replace('GalleryCategory',array ('CategoryLabel' => 'space', 'Visible' => '1', 'ClassKey' => 2),
	array('CategoryKey' => 212), TRUE);
$SQL->Replace('GalleryCategory',array ('CategoryLabel' => 'textures', 'Visible' => '1', 'ClassKey' => 2),
	array('CategoryKey' => 213), TRUE);