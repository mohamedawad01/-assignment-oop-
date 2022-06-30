<?php 
	require("ImageUpload.php");
	if(isset($_POST['upload-image'])){
		if($_FILES['image']['error'] == 0){
			$image_upload = new ImageUpload($_FILES);
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">

	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	 <link rel="stylesheet" href="styles.css">
	<title>Preview multiple files with javascript</title>
</head>
<body>
	
	<h2> <i class="far fa-folder-open"></i> Uploads folder </h2>
	<div class="preview-container">
		<?php 
			$images = glob("uploads/*.*");
			foreach ($images as $image) {
				?>
					<img src="<?php echo $image ?>" alt="">
				<?php
			}
		?>
	</div>
	

	<form action="" method="post" enctype="multipart/form-data">
		<h2><i class="far fa-file-image"></i> Choose an image to upload</h2>
		<input type="file" name="image" >
		<h3>
			Accepted image file types are <span>( .jpg .png .gif )</span>, 
			and the file must be smaller than <span>2MB</span>.
		</h3>

		<input type="submit" name="upload-image" value="upload-image">
		<p class="error"><?php echo @$image_upload->error; ?></p>
	</form>




</body>
</html>
