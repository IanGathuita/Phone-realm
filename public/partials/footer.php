    <footer>
		<ul>
			<?php
			if(isset($_SESSION['logged-in'])){
				if($_SESSION['logged-in'] != true){
			        echo '<li><a href="login.php">Sign in</a></li>';
			    }
			    else{
			    	echo '<li><a href="logout.php">Sign out</a></li>';
			    }
			}
			else{
				echo '<li><a href="login.php">Sign in</a></li>';
			}			
			?>
			<li><a href="index.php">Home</a></li>
			<li><a href="new-phones.php">New phones</a></li>
			<?php
			if(isset($_SESSION['logged-in'])){
				if($_SESSION['logged-in']){
			        echo '<li><a href="favorites.php">My favorites</a></li>';
			    }			    
			}
			?>
			
		</ul>
	</footer>
	<script type="text/javascript" src="./scripts/script.js"></script>
</body>
</html>