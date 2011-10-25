<?php if (!defined('APPLICATION'))
	exit();

class SettingsController extends Gdn_Controller {
   /**
    * Models to include.
    *
    * @since 2.0.0
    * @access public
    * @var array
    */
   public $Uses = array('Database', 'Form', 'GalleryCategoryModel', 'GalleryClassModel');

   public function PrepareController() {
	   $this->AddCssFile('dashboard.css');
	   $this->AddJsFile('dashboard.js');
   }

	/**
    * Advanced settings.
    *
    * Allows setting configuration values via form elements.
    *
    * @since 2.0.0
    * @access public
    */
	public function Advanced() {
	   // Check permission
      $this->Permission('Gallery.Items.Manage');

		// Load up config options we'll be setting
		$Validation = new Gdn_Validation();
      $ConfigurationModel = new Gdn_ConfigurationModel($Validation);
      $ConfigurationModel->SetField(array(
         'Galleries.Items.PerPage',
		  'Galleries.FireEvents.Show'
      ));

      // Set the model on the form.
      $this->Form->SetModel($ConfigurationModel);

      // If seeing the form for the first time...
      if ($this->Form->AuthenticatedPostBack() === FALSE) {
         // Apply the config settings to the form.
         $this->Form->SetData($ConfigurationModel->Data);
		} else {
         // Define some validation rules for the fields being saved
         $ConfigurationModel->Validation->ApplyRule('Galleries.Items.PerPage', 'Required');
         $ConfigurationModel->Validation->ApplyRule('Galleries.Items.PerPage', 'Integer');
         $ConfigurationModel->Validation->ApplyRule('Vanilla.Comments.AutoRefresh', 'Integer');
         $ConfigurationModel->Validation->ApplyRule('Vanilla.Archive.Date', 'Date');

			// Grab old config values to check for an update.
			$ArchiveDateBak = Gdn::Config('Vanilla.Archive.Date');
			$ArchiveExcludeBak = (bool)Gdn::Config('Vanilla.Archive.Exclude');

			// Save new settings
			$Saved = $this->Form->Save();
			if($Saved) {
				$ArchiveDate = Gdn::Config('Vanilla.Archive.Date');
				$ArchiveExclude = (bool)Gdn::Config('Vanilla.Archive.Exclude');

				if($ArchiveExclude != $ArchiveExcludeBak || ($ArchiveExclude && $ArchiveDate != $ArchiveDateBak)) {
					$DiscussionModel = new DiscussionModel();
					$DiscussionModel->UpdateDiscussionCount('All');
				}
            $this->InformMessage(T("Your changes have been saved."));
			}
		}

      $this->AddSideMenu('galleries/settings/advanced');
      $this->AddJsFile('settings.js');
      $this->Title(T('Advanced Gallery Settings'));

		// Render default view (settings/advanced.php)
		$this->Render();
	}

   /**
    * Alias for ManageCategories method.
    *
    * @since 2.0.0
    * @access public
    */
   public function Index() {
      $this->View = 'managecategories';
      $this->ManageCategories();
   }

   /**
    * Switch MasterView. Include JS, CSS used by all methods.
    *
    * Always called by dispatcher before controller's requested method.
    *
    * @since 2.0.0
    * @access public
    */
   public function Initialize() {
      // Set up head
      $this->Head = new HeadModule($this);
      $this->AddJsFile('jquery.js');
      $this->AddJsFile('jquery.livequery.js');
      $this->AddJsFile('jquery.form.js');
      $this->AddJsFile('jquery.popup.js');
      $this->AddJsFile('jquery.gardenhandleajaxform.js');
      $this->AddJsFile('global.js');

      if (in_array($this->ControllerName, array('profilecontroller', 'activitycontroller'))) {
         $this->AddCssFile('style.css');
      } else {
         $this->AddCssFile('admin.css');
      }

      // Change master template
      $this->MasterView = 'admin';
      parent::Initialize();
   }

   /**
    * Configures navigation sidebar in Dashboard.
    *
    * @since 2.0.0
    * @access public
    *
    * @param $CurrentUrl Path to current location in dashboard.
    */
   public function AddSideMenu($CurrentUrl) {
      // Only add to the assets if this is not a view-only request
      if ($this->_DeliveryType == DELIVERY_TYPE_ALL) {
         $SideMenu = new SideMenuModule($this);
         $SideMenu->HtmlId = '';
         $SideMenu->HighlightRoute($CurrentUrl);
			$SideMenu->Sort = C('Garden.DashboardMenu.Sort');
         $this->EventArguments['SideMenu'] = &$SideMenu;
         $this->FireEvent('GetAppSettingsMenuItems');
         $this->AddModule($SideMenu, 'Panel');
      }
   }

   /**
    * Adding a new category.
    *
    * @since 2.0.0
    * @access public
    */
	public function AddClass() {
		// Check permission
		$this->Permission('Galleries.Items.Manage');

		// Set up head
		$this->AddJsFile('jquery.alphanumeric.js');
		$this->AddJsFile('categories.js');
		$this->AddJsFile('jquery.gardencheckboxgrid.js');
		$this->Title(T('Add Class'));
		$this->AddSideMenu('galleries/settings/managecategories');

		if ($this->DeliveryType() == DELIVERY_TYPE_ALL) {
			$this->AddSideMenu('galleries/settings/managecategories');
			$Session = Gdn::Session();
			$permissions = $Session->User->Permissions;
			$this->admin = preg_match('/Garden.Settings.Manage/',$permissions);

			if($this->admin) {

				// Prep models
				$this->Form->SetModel($this->GalleryClassModel);


				if ($this->Form->AuthenticatedPostBack() == FALSE) {


				} else { // Form was validly submitted
					$FormValues = $this->Form->FormValues();
					$this->GalleryClassModel->CreateClass($FormValues);

					// now get the new class and generate a home page for it
					$ClassLabel = $FormValues['ClassLabel'];
					$ClassData = $this->GalleryClassModel->GetClasses($ClassLabel);
					$this->GalleryCategoryModel->GenerateHome($ClassData->ClassKey);
					$this->StatusMessage = T("Your settings have been saved.");
					Redirect('/galleries/settings/managecategories');

				}
			$this->View = 'classform';
			$this->Render();
			}
		}


   }

   public function AddCategory() {

	   // Check permission
		$this->Permission('Galleries.Items.Manage');

		// Set up head
		$this->AddJsFile('jquery.alphanumeric.js');
		$this->AddJsFile('categories.js');
		$this->AddJsFile('jquery.gardencheckboxgrid.js');
		$this->Title(T('Add Class'));
		$this->AddSideMenu('galleries/settings/managecategories');

		if ($this->DeliveryType() == DELIVERY_TYPE_ALL) {
			$this->AddSideMenu('galleries/settings/managecategories');
			$Session = Gdn::Session();
			$permissions = $Session->User->Permissions;
			$this->admin = preg_match('/Garden.Settings.Manage/',$permissions);

			if($this->admin) {

				$ClassID = GetValue(0, $this->RequestArgs, "");

				// Prep models
				$this->Form->SetModel($this->GalleryCategoryModel);
				$this->Form->AddHidden('ClassKey', $ClassID);

				if ($this->Form->AuthenticatedPostBack() == FALSE) {


				} else { // Form was validly submitted

					if ($this->Form->Save() !== FALSE) {
						$this->StatusMessage = T("Your settings have been saved.");
						Redirect('/info/'.$SlugChecked);
					} else {
						$this->StatusMessage = T("Oops, changes not saved");
					}

				}
			$this->View = 'editcategory';
			$this->Render();
			}
		}


   }

   /**
    * Deleting a category.
    *
    * @since 2.0.0
    * @access public
    *
    * @param int $CategoryID Unique ID of the category to be deleted.
    */
   public function Delete() {

	   $Session = Gdn::Session();
		$permissions = $Session->User->Permissions;
		$this->admin = preg_match('/Garden.Settings.Manage/',$permissions);

		if($this->admin) {
			$Type = GetValue(0, $this->RequestArgs, "");
			$ObjectID = GetValue(1, $this->RequestArgs, "");
			if($Type == 'category') {
				$CategoryData = $this->GalleryCategoryModel->GetWhere(array('CategoryKey' => $ObjectID))->FirstRow();
				if ($CategoryData->CategoryLabel != 'home') {
					$this->GalleryCategoryModel->RemoveCategory($ObjectID);
					Redirect('/galleries/settings/managecategories');
				} else {
					echo "Cannot Remove Home Category";
				}
			} elseif ($Type == 'class') { // type == class

				$this->GalleryClassModel->Remove($ObjectID);
				Redirect('/galleries/settings/managecategories');

			} else { // no type specified
				echo 'Must specify type';
			}



		}

   }

   public function DeleteClass() {

   }

   /**
    * Editing a category.
    *
    * @since 2.0.0
    * @access public
    *
    * @param int $CategoryID Unique ID of the category to be updated.
    */
   public function EditCategory() {
      // Check permission
      $this->Permission('Galleries.Items.Manage');
	  $ClassLabel = ArrayValue('0', $this->RequestArgs, '');
       $CategoryLabel = ArrayValue('1', $this->RequestArgs, '');
      // Set up models
      $this->Form->SetModel($this->GalleryCategoryModel);

      // Get category data
		$AllClassCats = $this->GalleryCategoryModel->GetCategories($ClassLabel);
		foreach($AllClassCats as $Category) {
			if ($Category->CategoryLabel == $CategoryLabel) {
				$this->Category = $Category;
			}
		}
      // Set up head
      $this->AddJsFile('jquery.alphanumeric.js');
      $this->AddJsFile('categories.js');
      $this->AddJsFile('jquery.gardencheckboxgrid.js');
      $this->Title(T('Edit Category'));

      $this->AddSideMenu('galleries/settings/managecategories');

      // Make sure the form knows which item we are editing.
      $this->Form->AddHidden('CategoryKey', $CategoryKey);

      if ($this->Form->AuthenticatedPostBack() === FALSE) {
         $this->Form->SetData($this->Category);
      } else {
         if ($this->Form->Save())
				Redirect('galleries/settings/managecategories');
	  }
      // Render default view
      $this->Render();
   }

	public function EditClass() {
		// Check permission
		$this->Permission('Galleries.Items.Manage');
		$ClassID = ArrayValue('0', $this->RequestArgs, '');
		// Set up models
		$this->Form->SetModel($this->GalleryClassModel);

		// Get category data
		$ClassData = $this->GalleryClassModel->GetClass($ClassID);
		// Set up head
		$this->AddJsFile('jquery.alphanumeric.js');
		$this->AddJsFile('categories.js');
		$this->AddJsFile('jquery.gardencheckboxgrid.js');
		$this->Title(T('Edit Class'));

		$this->AddSideMenu('galleries/settings/managecategories');

		// Make sure the form knows which item we are editing.
		$this->Form->AddHidden('ClassKey', $ClassID);

		if ($this->Form->AuthenticatedPostBack() === FALSE) {
			$this->Form->SetData($ClassData);
		} else {
			if ($this->Form->Save())
				Redirect('galleries/settings/managecategories');
		}
		// Render default view
		$this->View = 'classform';
		$this->Render();
	}


   /**
    * Enabling and disabling categories from list.
    *
    * @since 2.0.0
    * @access public
    */
	public function ManageCategories() {
		// Check permission
		$this->Permission('Gallery.Items.Manage');
		$this->PrepareController();

		// Set up head
		$this->AddSideMenu('galleries/settings/managecategories');
		$this->AddJsFile('categories.js');
//       $this->AddJsFile('jquery.ui.packed.js');
		$this->AddJsFile('js/library/jquery.alphanumeric.js');
		$this->AddJsFile('js/library/nestedSortable.1.2.1/jquery-ui-1.8.2.custom.min.js');
		$this->AddJsFile('js/library/nestedSortable.1.2.1/jquery.ui.nestedSortable.js');
		$this->Title(T('Gallery Categories'));

		// Get Class Data
		$Classes = $this->GalleryClassModel->GetClasses();
		// Get category data
		$ClassNum = 0;
		foreach ($Classes as $Class) {
			$ClassLabel = $Class->ClassLabel;
			$ClassKey = $Class->ClassKey;
			$Categories = $this->GalleryCategoryModel->GetCategories($ClassLabel);
			$CategoryData[$ClassKey] = array('ClassLabel' => $ClassLabel, 'Visible' => $Class->Visible,
				'HasCategories' => $Class->HasCategories, 'Categories' => array());
			foreach ($Categories as $Category) {
				$CategoryLabel = $Category->CategoryLabel;
				$CategoryKey = $Category->CategoryKey;
				$CategoryData[$ClassKey]['Categories'][$CategoryKey] = $CategoryLabel;
			}

		}
		$this->CategoryData = $CategoryData;

      // Set the model on the form.
      $this->Form->SetModel($this->GalleriesCategoryModel);

      // If seeing the form for the first time...
      if ($this->Form->AuthenticatedPostBack() === FALSE) {
         // Apply the config settings to the form.
      } else {
         if ($this->Form->Save() !== FALSE)
            $this->InformMessage(T("Your settings have been saved."));
		}

      // Render default view
      $this->Render();
   }

   /**
    * Sorting display order of categories.
    *
    * Accessed by ajax so its default is to only output true/false.
    *
    * @since 2.0.0
    * @access public
    */
   public function SortCategories() {
      // Check permission
      $this->Permission('Vanilla.Categories.Manage');

      // Set delivery type to true/false
      $this->_DeliveryType = DELIVERY_TYPE_BOOL;
		$TransientKey = GetIncomingValue('TransientKey');
      if (Gdn::Session()->ValidateTransientKey($TransientKey)) {
			$TreeArray = GetValue('TreeArray', $_POST);
			$this->CategoryModel->SaveTree($TreeArray);
		}

      // Renders true/false rather than template
      $this->Render();
   }

}