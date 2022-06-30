<?php 

class ImageUpload{
	// Class properties =================

	private $image_name; // the image name.
	private $image_type; // the image type.
	private $image_size; // the image size.
	private $image_temp; // the temporary location where the uploaded image is stored.
	private $uploads_folder = "./uploads/"; // the uploads folder.
	private $upload_max_size = 2*1024*1024; // setting the max upload file size to 2MB.

	// property to hold an array of allowed image types.
	private $allowed_image_types = ["image/jpeg", "image/jpg", "image/png", "image/gif"];

	public $error; 

	
	public function __construct($files){
		$this->image_name = $files['image']['name'];
		$this->image_size = $files['image']['size'];
		$this->image_temp = $files['image']['tmp_name'];
		$this->image_type = $files['image']['type'];

		$this->isImage();
		$this->imageNameValidation();
		$this->sizeValidation();
		$this->checkFile();

		if($this->error == null){
			$this->moveFile();
		}

		if($this->error == null){
			$this->recordImage();
		}
	}


	private function isImage(){
		$finfo = finfo_open(FILEINFO_MIME_TYPE);
		$mime = finfo_file($finfo, $this->image_temp);
		if(!in_array($mime, $this->allowed_image_types)){
			return $this->error = "Only [ .jpg, .jpeg, .png, and .gif ] files are allowed";
		}
		finfo_close($finfo);
	}


	private function imageNameValidation(){
		return $this->image_name = filter_var($this->image_name, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	}


	// The method will return an error if the file's size exceeds
	// the 2MB size limit.
	private function sizeValidation(){
		if($this->image_size > $this->upload_max_size){
			return $this->error = "File is bigger than 2MB";
		}
	}


	private function checkFile(){
		if(file_exists($this->uploads_folder.$this->image_name)){
			return $this->error = "File already exists in folder";
		}
	}


	private function moveFile(){
		if(!move_uploaded_file($this->image_temp, $this->uploads_folder.$this->image_name)){
			return $this->error = "There was an error, please try again";
		}
	}


	private function recordImage(){
		//  connect to the mysql server and the database;
		$mysqli = new mysqli('localhost','root','','test');
		$mysqli->query("INSERT INTO images(image_name)VALUES('$this->image_name')");

		
		if($mysqli->affected_rows != 1){
			if(file_exists($this->uploads_folder.$this->image_name)){
				unlink($this->uploads_folder.$this->image_name);
			}
			//  return an error message.
			return $this->error = "There was an error, please try again.";
		}
	}



}