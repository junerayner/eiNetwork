<?php
/**
 * Table Definition for library
 */
require_once 'DB/DataObject.php';
require_once 'DB/DataObject/Cast.php';
require_once 'Drivers/marmot_inc/Holiday.php';
require_once 'Drivers/marmot_inc/NearbyBookStore.php';

class Library extends DB_DataObject
{
	public $__table = 'library';    // table name
	public $libraryId; 				//int(11)
	public $subdomain; 				//varchar(15)
	public $displayName; 			//varchar(50)
	public $themeName; 				//varchar(15)
	public $searchesFile;        //varchar(15)
	public $facetFile; 				//varchar(15)
	public $defaultLibraryFacet;  	//varchar(20)
	public $allowProfileUpdates;   //tinyint(4)
	public $allowFreezeHolds;   //tinyint(4)
	public $scope; 					//smallint(6)
	public $useScope;		 		//tinyint(4)
	public $hideCommentsWithBadWords; //tinyint(4)
	public $showAmazonReviews;
	public $linkToAmazon;
	public $showStandardReviews;
	public $showHoldButton;
	public $showLoginButton;
	public $showTextThis;
	public $showEmailThis;
	public $showComments;
	public $showTagging;
	public $showRatings;
	public $illLink;
	public $askALibrarianLink;
	public $showFavorites;
	public $inSystemPickupsOnly;
	public $validPickupSystems;
	public $defaultPType;
	public $suggestAPurchase;
	public $boopsieLink;
	public $facetLabel;
	public $showEcommerceLink;
	public $minimumFineAmount;
	public $tabbedDetails;
	public $goldRushCode;
	public $repeatSearchOption;
	public $repeatInProspector;
	public $repeatInWorldCat;
	public $repeatInAmazon;
	public $repeatInOverdrive;
	public $systemsToRepeatIn;
	public $homeLink;
	public $useHomeLinkInBreadcrumbs;
	public $showAdvancedSearchbox;
	public $enableBookCart;
	public $enablePospectorIntegration;
	public $prospectorCode;
	public $enableGenealogy;
	public $showHoldCancelDate;
	public $enableCourseReserves;
	public $enableSelfRegistration;
	public $showSeriesAsTab;
	public $showItsHere;
	public $holdDisclaimer;
	public $enableAlphaBrowse;
	public $enableMaterialsRequest;
	public $eContentLinkRules;

	/* Static get */
	function staticGet($k,$v=NULL) { return DB_DataObject::staticGet('Library',$k,$v); }

	function keys() {
		return array('libraryId', 'subdomain');
	}

	function getObjectStructure(){
		// get the structure for the library system's holidays
		$holidaysStructure = Holiday::getObjectStructure();
		
		// we don't want to make the libraryId property editable
		// because it is associated with this library system only
		unset($holidaysStructure['libraryId']);

		$nearbyBookStoreStructure = NearbyBookStore::getObjectStructure();
		unset($nearbyBookStoreStructure['weight']);
		unset($nearbyBookStoreStructure['libraryId']);
		
		$structure = array(
          'libraryId' => array('property'=>'libraryId', 'type'=>'label', 'label'=>'Library Id', 'description'=>'The unique id of the libary within the database'),
          'subdomain' => array('property'=>'subdomain', 'type'=>'text', 'label'=>'Subdomain', 'description'=>'A unique id to identify the library within the system'),
          'displayName' => array('property'=>'displayName', 'type'=>'text', 'label'=>'Display Name', 'description'=>'A unique id to identify the library within the system'),
          'themeName' => array('property'=>'themeName', 'type'=>'text', 'label'=>'Theme Name', 'description'=>'The name of the theme which should be used for the library'),
          'facetFile' => array('property'=>'facetFile', 'type'=>'text', 'label'=>'Facet File', 'description'=>'The name of the facet file which should be used while searching'),
          'facetLabel' => array('property'=>'facetLabel', 'type'=>'text', 'label'=>'Facet Label', 'description'=>'The label for the library system in the Library System Facet.'),
          'defaultLibraryFacet' => array('property'=>'defaultLibraryFacet', 'type'=>'text', 'label'=>'Default Library Facet', 'description'=>'A facet to apply during initial searches.  If left blank, no additional refinement will be done.'),
          'allowProfileUpdates'  => array('property'=>'allowProfileUpdates', 'type'=>'checkbox', 'label'=>'Allow Profile Updates', 'description'=>'Whether or not the user can update their own profile.'),
          'allowFreezeHolds'  => array('property'=>'allowFreezeHolds', 'type'=>'checkbox', 'label'=>'Allow Freezing Holds', 'description'=>'Whether or not the user can freeze their holds.'),
          'scope'  => array('property'=>'scope', 'type'=>'text', 'label'=>'Scope', 'description'=>'The scope for the system in Millennium to refine holdings for the user.'),
          'useScope'  => array('property'=>'useScope', 'type'=>'checkbox', 'label'=>'Use Scope', 'description'=>'Whether or not the scope should be used when displaying holdings.'),
          'hideCommentsWithBadWords'  => array('property'=>'hideCommentsWithBadWords', 'type'=>'checkbox', 'label'=>'Hide Comments with Bad Words', 'description'=>'If checked, any comments with bad words are completely removed from the user interface for everyone except the original poster.'),
          'showAmazonReviews'  => array('property'=>'showAmazonReviews', 'type'=>'checkbox', 'label'=>'Show Amazon Reviews', 'description'=>'Whether or not reviews from Amazon are displayed on the full record page.'),
          'linkToAmazon'  => array('property'=>'linkToAmazon', 'type'=>'checkbox', 'label'=>'Link To Amazon', 'description'=>'Whether or not a purchase on Amazon link should be shown.  Should generally match showAmazonReviews setting'),
          'showStandardReviews'  => array('property'=>'showStandardReviews', 'type'=>'checkbox', 'label'=>'Show Standard Reviews', 'description'=>'Whether or not reviews from Content Cafe/Syndetics are displayed on the full record page.'),
          'showHoldButton'  => array('property'=>'showHoldButton', 'type'=>'checkbox', 'label'=>'Show Hold Button', 'description'=>'Whether or not the hold button is displayed so patrons can place holds on items'),
          'showHoldCancelDate'   => array('property'=>'showHoldCancelDate', 'type'=>'checkbox', 'label'=>'Show Cancellation Date', 'description'=>'Whether or not the patron should be able to set a cancellation date (not needed after date) when placing holds.'),
          'showLoginButton'  => array('property'=>'showLoginButton', 'type'=>'checkbox', 'label'=>'Show Login Button', 'description'=>'Whether or not the login button is displayed so patrons can login to the site'),
          'enableSelfRegistration' => array('property'=>'enableSelfRegistration', 'type'=>'checkbox', 'label'=>'Enable Self Registration', 'description'=>'Whether or not patrons can self register on the site'),
          'showTextThis'  => array('property'=>'showTextThis', 'type'=>'checkbox', 'label'=>'Show Text This', 'description'=>'Whether or not the Text This link is shown'),
          'showEmailThis'  => array('property'=>'showEmailThis', 'type'=>'checkbox', 'label'=>'Show Email This', 'description'=>'Whether or not the Email This link is shown'),
          'showComments'  => array('property'=>'showComments', 'type'=>'checkbox', 'label'=>'Show Comments', 'description'=>'Whether or not comments are shown (also disables adding comments)'),
          'showTagging'  => array('property'=>'showTagging', 'type'=>'checkbox', 'label'=>'Show Tagging', 'description'=>'Whether or not tags are shown (also disables adding tags)'),
          'showRatings'  => array('property'=>'showRatings', 'type'=>'checkbox', 'label'=>'Show Ratings', 'description'=>'Whether or not ratings are shown'),
          'showFavorites'  => array('property'=>'showFavorites', 'type'=>'checkbox', 'label'=>'Show Favorites', 'description'=>'Whether or not users can maintain favorites lists'),
          'exportOptions' => array('property'=>'exportOptions', 'type'=>'text', 'label'=>'Export Options', 'description'=>'A list of export options that should be enabled separated by pipes.  Valid values are currently RefWorks and EndNote.'),
          'showEcommerceLink'  => array('property'=>'showEcommerceLink', 'type'=>'checkbox', 'label'=>'Show E-Commerce Link', 'description'=>'Whether or not users should be given a link to classic opac to pay fines'),
          'minimumFineAmount'  => array('property'=>'minimumFineAmount', 'type'=>'currency', 'displayFormat'=>'%0.2f', 'label'=>'Minimum Fine Amount', 'description'=>'The minimum fine amount to display the e-commerce link'),
          'showAdvancedSearchbox'  => array('property'=>'showAdvancedSearchbox', 'type'=>'checkbox', 'label'=>'Show Advanced Search Link', 'description'=>'Whether or not users should see the advanced search link next to the search box.  It will still appear in the footer.'),
          'tabbedDetails'  => array('property'=>'tabbedDetails', 'type'=>'checkbox', 'label'=>'Tabbed Details', 'description'=>'Whether or not details (reviews, copies, citations, etc) should be shown in tabs'),
          'showSeriesAsTab'  => array('property'=>'showSeriesAsTab', 'type'=>'checkbox', 'label'=>'Show Series as Tab', 'description'=>'Whether or not series information should be shown in a tab or in a scrollable window.'),
          'homeLink' => array('property'=>'homeLink', 'type'=>'text', 'label'=>'Home Link', 'description'=>'The location to send the user when they click on the home button or logo.  Use default or blank to go back to the vufind home location.'),
          'useHomeLinkInBreadcrumbs' => array('property'=>'useHomeLinkInBreadcrumbs', 'type'=>'checkbox', 'label'=>'Use Home Link in Breadcrumbs', 'description'=>'Whether or not the home link should be used in the breadcumbs.'),
          'illLink'  => array('property'=>'illLink', 'type'=>'text', 'label'=>'ILL Link', 'description'=>'A link to a library system specific ILL page'),
          'askALibrarianLink'  => array('property'=>'askALibrarianLink', 'type'=>'text', 'label'=>'Ask a Librarian Link', 'description'=>'A link to a library system specific Ask a Librarian page'), 
          'suggestAPurchase'  => array('property'=>'suggestAPurchase', 'type'=>'text', 'label'=>'Suggest a Purchase Link', 'description'=>'A link to a library system specific Suggest a Purchase page'), 
          'boopsieLink'  => array('property'=>'boopsieLink', 'type'=>'text', 'label'=>'Boopsie Link', 'description'=>'A link to the Boopsie Mobile App'),  
          'inSystemPickupsOnly'  => array('property'=>'inSystemPickupsOnly', 'type'=>'checkbox', 'label'=>'In System Pickups Only', 'description'=>'Restrict pickup locations to only locations within the library system which is active.'), 
          'validPickupSystems'  => array('property'=>'validPickupSystems', 'type'=>'text', 'label'=>'Valid Pickup Systems', 'description'=>'A list of library codes that can be used as pickup locations separated by pipes |'), 
          'defaultPType'  => array('property'=>'defaultPType', 'type'=>'text', 'label'=>'Default P-Type', 'description'=>'The P-Type to use when accessing a subdomain if the patron is not logged in.'), 
          'goldRushCode'  => array('property'=>'goldRushCode', 'type'=>'text', 'label'=>'Gold Rush Inst Code', 'description'=>'The INST Code to use with Gold Rush.  Leave blank to not link to Gold Rush.'),
          'repeatSearchOption'  => array('property'=>'repeatSearchOption', 'type'=>'enum', 'values'=>array('none'=>'None', 'librarySystem'=>'Library System','marmot'=>'Marmot'), 'label'=>'Repeat Search Options', 'description'=>'Where to allow repeating search. Valid options are: none, librarySystem, marmot, all'), 
          'repeatInProspector'  => array('property'=>'repeatInProspector', 'type'=>'checkbox', 'label'=>'Repeat In Prospector', 'description'=>'Turn on to allow repeat search in Prospector functionality.'),
          'prospectorCode' => array('property'=>'prospectorCode', 'type'=>'text', 'label'=>'Prospector Code', 'description'=>'The code used to identify this location within Prospector. Leave blank if items for this location are not in Prospector.'),
          'repeatInWorldCat'  => array('property'=>'repeatInWorldCat', 'type'=>'checkbox', 'label'=>'Repeat In WorldCat', 'description'=>'Turn on to allow repeat search in WorldCat functionality.'),
          'repeatInAmazon'  => array('property'=>'repeatInAmazon', 'type'=>'checkbox', 'label'=>'Repeat In Amazon', 'description'=>'Turn on to allow repeat search in Amazon functionality.'),
          'repeatInOverdrive' => array('property'=>'repeatInOverdrive', 'type'=>'checkbox', 'label'=>'Repeat In Overdrive', 'description'=>'Turn on to allow repeat search in Overdrive functionality.'),
          'systemsToRepeatIn'  => array('property'=>'systemsToRepeatIn', 'type'=>'text', 'label'=>'Systems To Repeat In', 'description'=>'A list of library codes that you would like to repeat search in separated by pipes |.'),
          'enableBookCart'  => array('property'=>'enableBookCart', 'type'=>'checkbox', 'label'=>'Enable Book Cart', 'description'=>'Whether or not the Book Cart should be used for this library.'),
          'enablePospectorIntegration'=> array('property'=>'enablePospectorIntegration', 'type'=>'checkbox', 'label'=>'Enable Prospector Integration', 'description'=>'Whether or not Prospector Integrations should be displayed for this library.'),
          'enableGenealogy' => array('property'=>'enableGenealogy', 'type'=>'checkbox', 'label'=>'Enable Genealogy Functionality', 'description'=>'Whether or not patrons can search genealogy.'),
          'enableCourseReserves' => array('property'=>'enableCourseReserves', 'type'=>'checkbox', 'label'=>'Enable Repeat Search in Course Reserves', 'description'=>'Whether or not patrons can repeat searches within course reserves.'),
          'enableAlphaBrowse' => array('property'=>'enableAlphaBrowse', 'type'=>'checkbox', 'label'=>'Enable Alphabetic Browse', 'description'=>'Enable Alphabetic Browsing of titles, authors, etc.'),
          'enableMaterialsRequest' => array('property'=>'enableMaterialsRequest', 'type'=>'checkbox', 'label'=>'Enable Materials Request', 'description'=>'Enable Materials Request functionality so patrons can request items not in the catalog.'),
          'showItsHere' => array('property'=>'showItsHere', 'type'=>'checkbox', 'label'=>'Show It\'s Here', 'description'=>'Whether or not the holdings summray should show It\'s here based on IP and the currently logged in patron\'s location.'),
          'eContentLinkRules' => array('property'=>'eContentLinkRules', 'type'=>'text', 'label'=>'EContent Link Rules', 'description'=>'A regular expression defining a set of criteria to determine whether or not a link belongs to this library.'),
          'holdDisclaimer' => array('property'=>'holdDisclaimer', 'type'=>'text', 'label'=>'Hold Disclaimer', 'description'=>'A disclaimer to display to patrons when they are placing a hold on items letting them know that their information may be available to other libraries.  Leave blank to not show a discalaimer.'),
		  'holidays' => array(
				'property' => 'holidays',
				'type'=> 'oneToMany',
				'keyThis' => 'libraryId',
				'keyOther' => 'libraryId',
				'subObjectType' => 'Holiday',
				'structure' => $holidaysStructure,
				'label' => 'Holidays',
				'description' => 'Holidays',
				'hideInLists' => true,
				'sortable' => false,
				'storeDb' => true
			),
		  'nearbyBookStores' => array(
				'property'=>'nearbyBookStores',
				'type'=>'oneToMany',
				'label'=>'NearbyBookStores',
				'description'=>'A list of book stores to search',
				'keyThis' => 'libraryId',
				'keyOther' => 'libraryId',
				'subObjectType' => 'NearbyBookStore',
				'structure' => $nearbyBookStoreStructure,
				'hideInLists' => true,
				'sortable' => true,
				'storeDb' => true
			),
		);
		foreach ($structure as $fieldName => $field){
			$field['propertyOld'] = $field['property'] . 'Old';
			$structure[$fieldName] = $field;
		}
		return $structure;
	}

	static function getSearchLibrary(){
		$searchSource = isset($_REQUEST['searchSource']) ? $_REQUEST['searchSource'] : 'local';
		if ($searchSource == 'local' || $searchSource == 'econtent'){
			return Library::getActiveLibrary();
		}else if ($searchSource == 'marmot'){
			return null;
		}else{
			$location = Location::getSearchLocation();
			if (is_null($location)){
				//Check to see if we have a library for the subdomain
				$library = new Library();
				$library->subdomain = $searchSource;
				$library->find();
				if ($library->N > 0){
					$library->fetch();
					return clone($library);
				}
				return null;
			}else{
				return self::getLibraryForLocation($location->locationId);
			}
		}
	}

	static function getActiveLibrary(){
		global $user;
		global $library;
		//First check to see if we have a library loaded based on subdomain (loaded in index)
		if (isset($library)) {
			return $library;
		}
		//If there is only one library, that library is active by default. 
		$activeLibrary = new Library();
		$activeLibrary->find();
		if ($activeLibrary->N == 1){
			$activeLibrary->fetch();
			return $activeLibrary;
		}
		//Next check to see if we are in a library.
		global $locationSingleton;
		$physicalLocation = $locationSingleton->getActiveLocation();
		if (!is_null($physicalLocation)){
			//Load the library based on the home branch for the user
			return self::getLibraryForLocation($physicalLocation->libraryId);
		}
		//Finally check to see if the user has logged in and if so, use that library
		if (isset($user) && $user != false){
			//Load the library based on the home branch for the user
			return self::getLibraryForLocation($user->homeLocationId);
		}

	}

	static function getPatronHomeLibrary(){
		global $user;
		//Finally check to see if the user has logged in and if so, use that library
		if (isset($user) && $user != false){
			//Load the library based on the home branch for the user
			return self::getLibraryForLocation($user->homeLocationId);
		}else{
			return null;
		}

	}

	static function getLibraryForLocation($locationId){
		if (isset($locationId)){
			$libLookup = new Library();
			require_once('Drivers/marmot_inc/Location.php');
			$location = new Location();
			$libLookup->whereAdd('libraryId = (SELECT libraryId FROM location WHERE locationId = ' . $libLookup->escape($locationId) . ')');
			$libLookup->find();
			if ($libLookup->N > 0){
				$libLookup->fetch();
				return clone $libLookup;
			}
		}else{
			return null;
		}
	}

	public function __get($name){
		if ($name == "holidays") {
			if (!isset($this->holidays)){
				$this->holidays = array();
				$holiday = new Holiday();
				$holiday->libraryId = $this->libraryId;
				$holiday->orderBy('date');
				$holiday->find();
				while($holiday->fetch()){
					$this->holidays[$holiday->id] = clone($holiday);
				}
			}
			return $this->holidays;
		}elseif ($name == "nearbyBookStores") {
			if (!isset($this->nearbyBookStores)){
				$this->nearbyBookStores = array();
				$store = new NearbyBookStore();
				$store->libraryId = $this->libraryId;
				$store->orderBy('weight');
				$store->find();
				while($store->fetch()){
					$this->nearbyBookStores[$store->id] = clone($store);
				}
			}
			return $this->nearbyBookStores;
		}
	}
	
	public function __set($name, $value){
		if ($name == "holidays") {
			$this->holidays = $value;
		}elseif ($name == "nearbyBookStores") {
			$this->nearbyBookStores = $value;
		}
	}
	
	/**
	 * Override the update functionality to save related objects
	 *
	 * @see DB/DB_DataObject::update()
	 */
	public function update(){
		$ret = parent::update();
		if ($ret === FALSE ){
			return $ret;
		}else{
			$this->saveHolidays();
			$this->saveNearbyBookStores();
		}
	}
	
	/**
	 * Override the update functionality to save the related objects
	 *
	 * @see DB/DB_DataObject::insert()
	 */
	public function insert(){
		$ret = parent::insert();
		if ($ret === FALSE ){
			return $ret;
		}else{
			$this->saveHolidays();
			$this->saveNearbyBookStores();
		}
	}
	
	public function saveHolidays(){
		if (isset ($this->holidays) && is_array($this->holidays)){
			foreach ($this->holidays as $holiday){
				if (isset($holiday->deleteOnSave) && $holiday->deleteOnSave == true){
					$holiday->delete();
				}else{
					if (isset($holiday->id) && is_numeric($holiday->id)){
						$holiday->update();
					}else{
						$holiday->libraryId = $this->libraryId;
						$holiday->insert();
					}
				}
			}
			unset($this->holidays);
		}
	}
	
	public function saveNearByBookStores(){
		if (isset ($this->nearbyBookStores) && is_array($this->nearbyBookStores)){
			foreach ($this->nearbyBookStores as $store){
				if (isset($store->deleteOnSave) && $store->deleteOnSave == true){
					$store->delete();
				}else{
					if (isset($store->id) && is_numeric($store->id)){
						$store->update();
					}else{
						$store->libraryId = $this->libraryId;
						$store->insert();
					}
				}
			}
			unset($this->nearbyBookStores);
		}
	}
	
	static function getBookStores(){
		$library = Library::getActiveLibrary();
		if ($library) {
			return NearbyBookStore::getBookStores($library->libraryId);
		} else {
			return NearbyBookStore::getDefaultBookStores();
		}
	}
}