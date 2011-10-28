<?php if (!defined('APPLICATION')) exit();

class GalleryController extends GalleriesController {

    public $Uses = array('Form', 'GalleryCategoryModel', 'GalleryClassModel', 'GalleryItemModel');

    public static $SelectedFile = array();
    public $PublicDir = '/uploads/item/';
    public static $Limit = 16;
    public static $Page = 1;
    public static $Class = 'default';
    public static $Category = 'home';
	public static $ClassID;

    public $Categories;

	public function Initialize() {
		parent::Initialize();

		$Controller = $this->ControllerName;
		//$Sender->Form = new Gdn_Form();

		if ($this->Head) {
			$this->AddJsFile('jquery.js');
			$this->AddJsFile('css_browser_selector.js');
			$this->AddJsFile('jquery.livequery.js');
			$this->AddJsFile('jquery.form.js');
			$this->AddJsFile('jquery.popup.js');
			$this->AddJsFile('jquery.gardenhandleajaxform.js');
			$this->AddJsFile('global.js');


			if (C('Galleries.ShowFireEvents'))
				$this->DisplayFireEvent('WhileHeadInit');

			$this->FireEvent('WhileHeadInit');
			$this->AddJsFile('/applications/projects/js/projectbox.js');
			$this->AddCssFile('/applications/projects/design/projectbox.css');
		}
   }

   /**
    * PrepareController function.
    *
    * Adds CSS and JS includes to the header of the page.
    *
    * @access protected
    * @param mixed $Controller The hooked controller
    * @return void
    */

	public function PrepareController() {
		$this->AddCssFile('gallery.css');
		$this->AddCssFile('gallerycustom.css');

		$this->AddJsFile('jquery.lightbox-0.5.pack.js');
		$this->AddCssFile('jquery.lightbox-0.5.css');

		$this->AddJsFile('gallery.js');
		$this->AddJsFile('gallerycustom.js');

		$this->AddJsFile('jquery.ui.packed.js');
		$this->AddJsFile('jquery.event.drag.js');

		$this->AddJsFile('/applications/projects/js/projectbox.js');
			$this->AddCssFile('/applications/projects/design/projectbox.css');

		$this->AddCssFile('fileupload.css');
		$this->AddJsFile('fileupload.js');

		$this->AddJsFile('/applications/projects/js/projectsshared.js');

		if (C('Galleries.ShowFireEvents'))
			$this->DisplayFireEvent('AfterGalleryPrepare');

		$this->FireEvent('AfterGalleryPrepare');
   }

   /**
    * Displays various custom pages based on the arguments passed
    *
    * @acess public
    * @param mixed $this->RequestArgs
    */
	public function Index($Args) {

		// show dialog for fire event if enabled
		if (C('Galleries.ShowFireEvents'))
			$this->DisplayFireEvent('BeforeBrowseRender');
		$this->FireEvent('BeforeBrowseRender');

		// Prepare page
		$this->PrepareController();

		// Get Request Arguments
		$Class = ArrayValue('0', $this->RequestArgs, '');
		$Category = ArrayValue('1', $this->RequestArgs, 'home');
		$Page= ArrayValue('2', $this->RequestArgs, '1');

		// Set the defaults
		if (!is_numeric($Page) || $Page < 1)
		$Page = 1;
		self::$Page = $Page;
		$Limit = C('Gallery.Items.PerPage', 16);
		self::$Limit = $Limit;
		$Path = PATH_APPLICATIONS.DS.'galleries'.DS.'customfiles';

		$GalleryItemModel = $this->GalleryItemModel;

/*----------- Now check the requests for validity and set data ---------------*/


        if ($Class != '') {
			$ClassData = $this->GalleryClassModel->GetClasses($Class);
            // check if there's a file for the view
            if (file_exists($Path.DS.$Class.'home.php')) {

                // check if the view is a gallery class
                $VerifyClass = $this->GalleryClassModel->VerifyClass($Class);
                if ($VerifyClass == TRUE) {

                    // if it is, set the global.
                    self::$Class = $Class;
					self::$ClassID = $ClasData->ClassKey;
					$this->Title(T(self::$Class));

                    // now the category...
                    if ($Category != 'home' && $ClassData->HasCategories == 1) {
                        $VerifyCategory = $this->GalleryCategoryModel->VerifyCategory($Category,$Class);
                        if ($VerifyCategory) {
							self::$Category = $Category;

						// verify category return false
						} else {
							self::$Class = 'notfound';
							$this->View = 'notfound';
						}
                     } else { // category was not requested
						self::$Category = 'home';
						$this->Title(T($Class));
                     }
				} else { // verify class return false
					self::$Class = 'notverified';
					$this->View = 'notverified';
				}
			} else { // file does not exist
				self::$Class = 'notfound';
				$this->View = 'notfound';
			}
		} else {
			self::$Class = 'gettingstarted';
            $Class = 'gettingstarted';
			self::$Category = 'home';
			$this->Title(T('Getting Started'));
			$this->View = "gettingstarted";
        }
		$this->Head->Title($this->Head->Title());
		if (self::$Category != 'home')
			$this->View = ('browse');
		else
			$this->View = ($Path.DS.self::$Class.'home.php');

		$this->Categories = $this->GetCategories(self::$Class);
		$ShortCat = substr(self::$Category, 0, 3);
		$CapsCat = strtoupper($ShortCat);
		$this->Count = $this->GalleryItemModel->GetCount(array('CategoryCAPS' => $CapsCat));
	 if (C('Galleries.ShowFireEvents'))
		$this->DisplayFireEvent('AfterBrowseRender');

	 $this->FireEvent('AfterBrowseRender');
        $this->Render();
    }

	/**
	 * Render function for displaying a not found page
	 */
	public function NotFound() {
		$this->PrepareController();
		$this->View = 'notfound';
		$this->Render();
   }

   /**
    * Function for displaying the fire event as a div
    *
    * @param type $EventName
    */
	public function DisplayFireEvent($EventName) {
	   $Controller = $this->ControllerName;
	   echo '<img src="/applications/galleries/design/images/burn.png" class="FireEvent" content="'.$EventName.'"></img>';
	   echo '<div class="FireEvent">FireEvent: '.$Controller.':'.$EventName.'</div>';
   }

   /*
    * Model Functions, not sure why but calling $this inside them refers to the controller
    */
   public function GetFilesInfo($Class, $Category = 'home') {
	 $Model = $this->GalleryItemModel;
	 $Files = $Model->GetFilesInfo($Class, $Category);
	 return $Files;
      }
   public function GetDirectory($GetClass) {
	 $Model = $this->GalleryItemModel;
	 $Files = $Model->GetDirectory($GetClass);
	 return $Files;
      }
   public function GetClasses() {
	 $Model = $this->GalleryClassModel;
	 $Result = $Model->GetClasses();
	 return $Result;
      }
   public function GetCategories($GetClass) {
	 $Model = $this->GalleryCategoryModel;
	 $Result = $Model->GetCategories(self::$Class);
	 return $Result;
      }
   public function GetClassKey($GetClass) {
	 $Model = $this->GalleryClassModel;
	 $Key = $Model->GetClassKey($GetClass);
	 return $Key;
      }
   public function GetCategoryKey($GetCategoryCaps) {
	 $Model = $this->GalleryCategoryModel;
	 $Key = $Model->GetCategoryKey($GetCategoryCaps);
	 return $Key;
      }
   public function VerifyCategory($VerifyCategory, $Class) {
	  $Model = $this->GalleryCategoryModel;
	  $Return = $Model->VerifyCategory($VerifyCategory, $Class);
      }
}


?>
