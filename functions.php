<?php
	session_start();
	function homeContent(){
                $dir = "./uploads/" . $_SESSION['userID'];
                $extensions = array (
                        "jpg",
                        "jpeg",
                        "png",
                        "gif"
                );
                foreach($extensions as $imgExt){
                        foreach(glob($dir . "/*".$imgExt) as $filename){
                                echo "<img id='imgOut' class='images' src='$filename' alt='failedtoload' />";
                        }
                }
        }

	function uploadFile(){
			
		$target_dir = "uploads/" . $_SESSION['userID'] . "/";
		//echo $target_dir . "\n";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
			$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			if($check !== false) {
        			//echo "File is an image - " . $check["mime"] . ".";
        			$uploadOk = 1;
    			}			 
			else {
        			//exit("File is not an image.");
        			$uploadOk = 0;
    			}
		}
		//check if directory exists
		if(!createDirectory($target_dir)){
			//exit("Sorry error with directory");
			$uploadOk = 0;
		}
		// Check if file already exists
		if (file_exists($target_file)) {
			//exit("Sorry, file already exists.");
	    		$uploadOk = 0;
		}
		// Check file size
		if ($_FILES["fileToUpload"]["size"] > 50000000) {
			//exit("Sorry, your file is too large.");
	    		$uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
	  		//exit("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
	  		$uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			return FALSE;
			//exit("Sorry, your file was not uploaded.");
			// if everything is ok, try to upload file
		} 
		else {
			if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			//echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
			return TRUE;
		} 
			else {
				return FALSE;
				// exit("Sorry, there was an error uploading your file. " . basename( $_FILES['fileToUpload']['name']));
			}
		}

	}

	
	 function feedContent(){
                $path = './uploads';
                $dirs = glob($path . '/*', GLOB_ONLYDIR);
                $randomImages = array();
                foreach($dirs as $dir){
                        $files  = glob($dir . "/*.*");
                        $index   = array_rand($files,1);
                        array_push($randomImages, $files[$index]);
                }
		
		foreach($randomImages as $image){
			echo "<img id='imgOut' class='images' src='$image' alt='failedtoload' />";
		}
        }

	function createDirectory ($directory){
	    if(file_exists($directory)){
	        //echo "directory exists\n";
	        return TRUE;
	    }
	    else {
	        //echo "creating directory\n";
	        return mkdir($directory,0775,true);
	    }
	}
	
	function logout(){
		if(!isset($_SESSION['user'])){
       			 header("Location: index.php");
		}
		else if(isset($_SESSION['user'])!=""){
        		header("Location: home.php");
		}
		if(isset($_GET['logout'])){
        		session_destroy();
        		unset($_SESSION['user']);
        		header("Location: index.php");
		}

	}
