<?php
class BuildController extends AppController
{
	
	protected $campaign;
	protected $region;
	protected $craftname;
	protected $city;
	
    public function init ()
    {    
    	$this->_helper->Layout->disableLayout(); // Will not load the layout
    	$this->_helper->viewRenderer->setNoRender(); //Will not render view
    	
    	$this->user_state = parent::getRbUser();
    	if(isset($this->user_state)) $this->_helper->layout()->rb_username = $this->user_state->loggedin;
    	$this->city = ($this->_request->getParam('city') == 'philly')? 'philadelphia': $this->_request->getParam('city');
    	$this->city = ($this->_request->getParam('city') == 'dfw')? 'dallas': $this->_request->getParam('city');
    	 
    	 
    }
    public function indexAction ()
    {
    	$this->_redirect('/experience/');
    
    }

    public function craftAction() {
    	$this->_helper->Layout->disableLayout(); // Will not load the layout
        $this->_helper->viewRenderer->setNoRender(); //Will not render view
        
    	if(isset($_POST)){
    		
    		error_reporting(0);  //so we can get a clean craft_id
    		$images = "";
    		$lg_images="";
    		$items = array();
    		$ids = array();
    		foreach($_POST as $k=>$v) {
    			if($k=="name"||$k=="campaign"||$k=="region")continue;
    			error_log("k:$k v:$v");
    			$items = explode(",",$v);
    			if($items[0]=="undefined")continue;
    			$id = $items[0];
    			$img = $items[1];
    			$ids[]=$id;
    			if($img!="") {
    				$img = $_SERVER['DOCUMENT_ROOT'].$img;
    				$bits = explode(".",$img); 
    				$lg_img = $bits[0]."_lg.".$bits[1];
    				$images.=$img." -page +0+0 ";
    				$lg_images.=$lg_img." -page +0+0 ";
    			}
    		}
    		$parts = implode(",",$ids);
    		if(substr($parts,-1)==",") $parts = substr($parts,0,-1);
    		$craft_name = $_POST['name'];
    		$images = substr($images,0,-12);
    		$lg_images = substr($lg_images,0,-12);
    		$campaign = strtolower($_POST['campaign']);
    		$region = strtolower($_POST['region']);
    		$username = $this->user_state->username;
    		$base_name = $this->uniqueImage($username);
    		$image_name = $base_name.".png";
    		$med_image_name = $base_name."_med.png";
    		$large_image_name = $base_name."_large.png";
    		$dir = $_SERVER['DOCUMENT_ROOT']."/crafts/{$username}/{$campaign}/{$region}/";
    		if(!is_dir($dir)) mkdir($dir,0777,true);
    		$fb_photo_path = $_COOKIE['add_fb_photo'];
			$first_bit  = "convert -page 532x425+0+0 ";
			$first_bit_lg = "convert -page 630x408+0+0 ";
			$second_bit=($_COOKIE['add_fb_photo']!='')?" -page 87x87+239+105 {$fb_photo_path}":"";
    		$second_bit_lg=($_COOKIE['add_fb_photo']!='')?" -page 87x87+289+125 {$fb_photo_path}":"";
    		$third_bit = " -background none -compose DstOver  -flatten ";
    		$third_bit_lg = $third_bit."-resize 678x425 ";
    		$third_bit_med = $third_bit."-resize 195x129 ";
    		$command_base = $first_bit.$images.$second_bit.$third_bit.$dir;
    		$command_base_lg = $first_bit_lg.$lg_images.$second_bit_lg.$third_bit_lg.$dir;
    		$command_base_med = $first_bit.$images.$second_bit.$third_bit_med.$dir;
    		$this->fire_command($command_base.$image_name);
    		$this->fire_command($command_base_med.$med_image_name);
    		$this->fire_command($command_base_lg.$large_image_name);
    		$craftModel = new Model_Craft();
    		if(isset($_POST['craft_id']) && $_POST['craft_id'] !="") {
       			$craftModel->updateCraft($_POST['craft_id'],$craft_name,$username,$campaign,$region,$parts,$image_name,1);
				echo $_POST['craft_id'];
       		} else {
    			$result = $craftModel->saveCraft($craft_name,$username,$campaign,$region,$parts,$image_name,1);
				echo $result;
    		}

		}
    }
    
    public function fire_command($command){
    	exec($command);
    	error_log($command);
    }
    
    public function personalizeAction() {
    	
    	$this->_helper->Layout->disableLayout(); // Will not load the layout
        $this->_helper->viewRenderer->setNoRender(); //Will not render view
        if(isset($_POST)){
    		error_log("post is set");
    		
    		$fb_photo_path = $_SERVER['DOCUMENT_ROOT'].$_POST['fb_photo_path'];
    		$fb_photo_arr = explode(".",$_POST['fb_photo_path']);
    		$small_fb_photo = $fb_photo_arr[0]."_small.".$fb_photo_arr[1];
    		error_log("small_fb_photo:$small_fb_photo");
    		$small_fb_photo_path = $_SERVER['DOCUMENT_ROOT'].$small_fb_photo;
    		error_log("fb_photo_path:".$fb_photo_path);
    		// convert /var/www/html/redbull/public/fb_profile/504695214.jpg -resize 87x87^ /var/www/html/redbull/public/fb_profile/504695214_small.jpg
    		
    		exec("convert {$fb_photo_path} -resize 87x87  {$small_fb_photo_path}");
    		error_log("convert {$fb_photo_path} -resize 87x87  {$small_fb_photo_path}");
    		exec("convert {$small_fb_photo_path} -crop 87x87+0+0  {$small_fb_photo_path}");
    		error_log("convert {$small_fb_photo_path} -crop 87x87+0+0  {$small_fb_photo_path}");
    		//setcookie("add_fb_photo",$small_fb_photo_path,60*5);
    		
    		$time = time()+300;
	   		setcookie("add_fb_photo",$small_fb_photo_path,$time,"/",".".$_SERVER['HTTP_HOST']);
	   		echo (string)$small_fb_photo;
		}
    }
    
    public function savecraftAction() {
    	
    	$this->_helper->Layout->disableLayout(); // Will not load the layout
        $this->_helper->viewRenderer->setNoRender(); //Will not render view
        if(isset($_POST)){
    		$saved_images="";
    		$items = array();
    		$ids = array();
    		foreach($_POST as $k=>$v) {
    			?><script>console.log("v:<?=$v?>");</script><?
    			if(in_array($k,array('name','region','campaign')))continue;
    			//error_log("k:$k v:$v");
    			$items = explode(",",$v);
    			if($items[0]=="undefined")continue;
    			$id = $items[0];
    			$ids[]=$id;
    		}
    		$parts = implode(",",$ids);
    		$parts = substr($parts,0,-1);
    		$craft_name = $_POST['name'];
    		$campaign = $_POST['campaign'];
    		$region = strtolower($_POST['region']);
    		$username = $this->user_state->username;
       		$craftModel = new Model_Craft();
       		if($_POST['craft_id']!="") {
       			error_log($_POST['craft_id']."\n");
       			$craftModel->updateCraft($_POST['craft_id'],$craft_name,$username,$campaign,$region,$parts);
       		} else {
    			$craftModel->saveCraft($craft_name,$username,$campaign,$region,$parts);
    		}
    		return true;
		}
    }


    public function uniqueImage($img) {
    	$image_name = md5(time().$img);
    	if(file_exists($image_name)) $image_name = uniqueImage($img);
    	return $image_name;
    }
    
    
    
    public function voteAction() {
   
    	$this->_helper->Layout->disableLayout(); // Will not load the layout
        $this->_helper->viewRenderer->setNoRender(); //Will not render view
        $vote_id = $_POST['id'];
        $vote_id = substr($vote_id,5);
    	$craftModel = new Model_Craft();
    	$craftModel->voteCraft($vote_id);
    }
   

	public function blacklistAction(){
	
		$blacklist = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/badwords.txt', true);
		$craft_name = strtolower($_GET['name']);

		if (preg_match ("/$blacklist/", $craft_name))
		{
			echo "failed"; // bad word found
		} else {
			echo "success"; // passed 
		}
		exit();
	} 
}


