<?php include "config/koneksi.php"; ?> 
<!DOCTYPE html>
<html lang="en">
<head>
<title>CSS Template</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {
  box-sizing: border-box;
}

.header {
  overflow: hidden;
  background-color: #f1f1f1;
  padding: 20px 10px;
}

.header a {
  float: left;
  color: black;
  text-align: center;
  padding: 12px;
  text-decoration: none;
  font-size: 18px; 
  line-height: 25px;
  border-radius: 4px;
}

.header a.logo {
  font-size: 25px;
  font-weight: bold;
}

.header a:hover {
  background-color: #ddd;
  color: black;
}

.header a.active {
  background-color: dodgerblue;
  color: white;
}

.header-right {
  float: right;
}

@media screen and (max-width: 500px) {
  .header a {
    float: none;
    display: block;
    text-align: left;
  }
  
  .header-right {
    float: none;
  }
}

body {
  margin: 0;
  font-family: "Lato", sans-serif;
}


.sidebar {
  margin: 0;
  padding: 0;
  width: 200px;
  background-color: #f1f1f1;
  position: fixed;
  height: 100%;
  overflow: auto;
}

.sidebar a {
  display: block;
  color: black;
  padding: 16px;
  text-decoration: none;
}
 
.sidebar a.active {
  background-color: #04AA6D;
  color: white;
}

.sidebar a:hover:not(.active) {
  background-color: #555;
  color: white;
}

div.content {
  margin-left: 200px;
  padding: 1px 16px;
}

@media screen and (max-width: 700px) {
  .sidebar {
    width: 100%;
    height: auto;
    position: relative;
  }
  .sidebar a {float: left;}
  div.content {margin-left: 0;}
}

@media screen and (max-width: 400px) {
  .sidebar a {
    text-align: center;
    float: none;
  }
}

.grid-container {
  display: grid;
  grid-template-columns: auto auto auto auto auto auto;
  background-color: #fff;
  padding: 10px;
}
.grid-item {
  background-color: #fff;
  border: 1px solid #000;
  padding: 20px;
  font-size: 30px;
  text-align: center;
}


	#overlay{	
		position: fixed;
		top: 0;
		z-index: 100;
		width: 100%;
		height:100%;
		display: none;
		background: rgba(0,0,0,0.6);
		}
		.cv-spinner {
		height: 100%;
		display: flex;
		justify-content: center;
		align-items: center;  
		}
		.spinner {
		width: 40px;
		height: 40px;
		border: 4px #ddd solid;
		border-top: 4px #2e93e6 solid;
		border-radius: 50%;
		animation: sp-anime 0.8s infinite linear;
		}
		@keyframes sp-anime {
		100% { 
			transform: rotate(360deg); 
		}
		}
		.is-hide{
		display:none;
		}
	
</style>
</head>
<body>
<div id="overlay">
			<div class="cv-spinner">
				<span class="spinner"></span>
			</div>
		</div>
<div class="header">
	<?php
	$json = file_get_contents('config.json');
	$json_data = json_decode($json,true);
	
	
	?>

  <a href="#default" class="logo">Idolmart (<?php echo $json_data['ip_server']; ?> : <?php echo $json_data['com_printer']; ?>)</a>

</div>


<?php include "components/menu.php"; ?>

<div class="content">
  
  

  
  

  
</div>
</body>
<script src="styles/js/jquery-1.11.1.min.js"></script>

</html>

