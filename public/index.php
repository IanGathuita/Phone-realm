	<?php
	    require_once "../private/config.php";
	    require_once "../private/db.php";
	    include_once "partials/header.php";

	    $featured_query = "SELECT image,description FROM phones WHERE featured=1";
	    $result = mysqli_query($conn,$featured_query);
	    if( mysqli_num_rows($result) != null && mysqli_num_rows($result) > 0){
	        $featured = mysqli_fetch_assoc($result);
	        $featured_img_name = $featured['image'];
	        $featured_description = $featured['description'];
	    }

	    mysqli_free_result($result);
	    mysqli_close($conn);    

	    
	 ?>
	<section class="search-section">
		<div>
			<h2>Search a device by name</h2>
		    <input type="search" name="search" placeholder="Search">
		</div>		
	</section>
	<section class="specifications-section">
		<div class="device-image">			
			<h2>Featured phone</h2>
		    <img src = "<?php
		        if(isset($featured_img_name)){
		            echo "Images/".$featured_img_name;
		        }
		     ?>">	
		</div>
		<div>
			<h3>Device description</h3>
			<?php
			echo "<p>$featured_description</p>"
			?>
			<!-- <p>The most common types of abuse are uploading files which are too many, too large, or too frequent. Too many or too large files can deplete a system's file storage resources. Files sent too frequently can slow down server processing or monopolize server connections, potentially even leading to a denial of service.
			</p> -->			
		</div>
		<div class="add-favorite">
			<h3>Add to favorites</h3>			
		</div>		
	</section>
<?php include "partials/footer.php" ?>