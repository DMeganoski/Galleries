<?php if (!defined('APPLICATION'))
	exit();

	$SQL = Gdn::SQL();
	$Structure = Gdn::Structure();

	$Database = Gdn::Database();

	$PermissionModel = Gdn::PermissionModel();

	$PermissionModel->Database = $Database;

	$PermissionModel->SQL = $SQL;

	// Define some global permissions.
	$PermissionModel->Define(array(
	'Galleries.Manage',
	'Galleries.Items.Add',
	'Galleries.Items.Download',
	'Galleries.Items.Manage',
	'Galleries.Uploads.Add',
	'Galleries.Uploads.Overwite',
	'Galleries.Docs.Add',
	'Galleries.Docs.Download',
	'Galleries.Docs.Manage'
	//'Galleries.Comments.Manage'
	));

   if (isset($PermissionTableExists) && $PermissionTableExists) {
   // Set the intial member permissions.
   $PermissionModel->Save(array(
      'RoleID' => 8,
      'Galleries.Uploads.Add' => 1,
      'Galleries.Docs.Download' => 1
      ));

        // Set the initial administrator permissions.
	$PermissionModel->Save(array(
		'RoleID' => 16,
		'Galleries.Manage' => 1,
        'Galleries.Items.Upload' => 1,
		'Galleries.Items.Download' => 1,
        'Galleries.Items.Manage' => 1,
		'Galleries.Uploads.Add' => 1,
		'Galleries.Uploads.Overwite'=> 1,
		'Galleries.Docs.Add' => 1,
		'Galleries.Docs.Download' => 1,
		'Galleries.Docs.Manage' => 1,
         //'Gallery.Comments.Manage' => 1
         ));
   }