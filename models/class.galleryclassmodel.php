<?php if (!defined('APPLICATION'))
	exit();

class GalleryClassModel extends Gdn_Model {

	public function __construct() {
		parent::__construct('GalleryClass');
		$this->Name = "GalleryClass";
	}

	public function ClassQuery() {
		$this->SQL
				->Select('ga.*')
				->From('GalleryClass ga');
	}

	public function GetClasses($Single = '') {
       $this->SQL
            ->Select('gl.*')
            ->From('GalleryClass gl');

	   if ($Single != '')
		   $this->SQL->Where(array('ClassLabel' => $Single));

	    if ($Single != '')
			$Result = $this->SQL->Get()->FirstRow();
		else
			$Result = $this->SQL->Get();

        return $Result;
   }

   public function GetClass($ClassID) {
	   $this->ClassQuery();
	   $this->SQL->Where('ClassKey', $ClassID);
	   $Result = $this->SQL->Get()->FirstRow();
	   return $Result;
   }

	public function GetClassKey($GetClass) {
       $SQL = Gdn::SQL();
       $Classes = $this->GetClasses();
       foreach ($Classes as $Class) {
            $Key = $Class->ClassKey;
            $ClassName = $Class->ClassLabel;
            if ($ClassName == $GetClass) {
                return $Key;

	    }
       }
   }

	public function VerifyClass($VerifyClass) {
        $Classes = $this->GetClasses();
        foreach ($Classes as $Class) {
            $Label = $Class->ClassLabel;
            if ($VerifyClass == $Label) {
                $Return = TRUE;
            }
		}
            if ($Return) {
                return TRUE;
            } else {
                return FALSE;
            }

    }

	public function VerifyCategory($VerifyCategory, $Class) {
        $Categories = $this->GetCategories($Class);
        foreach ($Categories as $Category) {
            $Label = $Category->CategoryLabel;
            if ($VerifyCategory == $Label) {
                $Return = TRUE;
            }
        }
        if ($Return) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

	 public function Remove($ClassID) {

		$this->SQL->Delete("GalleryClass", array('ClassKey' => $ClassID));

	}

	/**
	 * Function since this model doesnt want to save to the db...
	 */
	public function CreateClass($FormValues) {
		$i = 0;
		$Labels = array();
		$Values = array();
		foreach($FormValues as $Label => $Value) {
			if($Label != 'TransientKey' && $Label != 'hpt' && $Label != 'Save') {
				$Labels[$i] = $Label;
				$Values[$i] = $Value;
				$i++;
			}
		}

		$InsertArray = array_combine($Labels, $Values);

		$this->SQL->Insert('GalleryClass', $InsertArray
		);
	}



}