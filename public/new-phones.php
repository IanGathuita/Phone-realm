<?php 
    include "partials/header.php";
    require_once "../private/config.php";
	require_once "../private/db.php";

    $all_phones_query = "SELECT * FROM phones";
    $result_set= mysqli_query($conn,$all_phones_query);
    if(mysqli_num_rows($result_set) !=null && mysqli_num_rows($result_set) > 0){
    	$all_phones = $result_set;
    }
	?>
    
<section>
	<div>
	    <h2>Brand new phones</h2>
    </div>
</section>
<section>
	<div class="new-phones">
		<?php
		    if(isset($all_phones)){
		    	while($phone = mysqli_fetch_assoc($all_phones)){ ?>
		    		<div class="new-phone">
						<img src="<?php echo "Images/".$phone["image"] ?>">
						<h3><?php echo $phone["name"] ?></h3>
						<p>Ksh. <?php echo $phone["price"] ?></p>
						<p><?php echo $phone["description"] ?> </p>		
					</div>
					<?php
		    	}
		    }
		?>
		<!-- <div class="new-phone">
			<img src="Images/image.jpg">
			<h3>Phone name</h3>
			<p>Ksh. 120,000</p>
			<p>This phone is the best because it has hshd dccj jsdgccn xhxjhxm ccj</p>		
		</div> -->		
	</div>
</section>
<?php include "partials/footer.php" ?>