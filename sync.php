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
  <a href="#default" class="logo">Idolmart</a>
</div>


<?php include "components/menu.php"; ?>

<div class="content">
  
  <div class="grid-container">
  <div class="grid-item"><button style="width: 100%; height: 100px; background-color: #E14D2A; color: #fff; font-size: 25px;cursor: pointer" onclick="syncProduct();">Sync Items</button></div>
  <div class="grid-item"><button style="width: 100%; height: 100px; background-color: #FD841F; color: #fff; font-size: 25px;cursor: pointer" onclick="syncMember();">Sync Member</button></div>
  <div class="grid-item"><button style="width: 100%; height: 100px; background-color: #0E8388; color: #fff; font-size: 25px;cursor: pointer" onclick="syncPromo();">Sync Promo</button></div>
  <div class="grid-item"></div>  

</div>
  
  
</div>
</body>
<script src="styles/js/jquery-1.11.1.min.js"></script>
<script>

function syncProduct(){
		$.ajax({
			url: "api/action.php?modul=sync&act=product",
			type: "POST",
			beforeSend: function(){
				$("#overlay").fadeIn(300);
			},
			success: function(dataResult){
				console.log(dataResult);
				var dataResult = JSON.parse(dataResult);
	
	
				$("#overlay").fadeOut(300);
				
			},error: function (request, status, error) {
				$("#overlay").fadeOut(300);
				alert("Maaf, sync error");
			}
		});
}

function syncMember(){
		$.ajax({
			url: "api/action.php?modul=sync&act=member",
			type: "POST",
			beforeSend: function(){
				$("#overlay").fadeIn(300);
			},
			success: function(dataResult){
				console.log(dataResult);
				var dataResult = JSON.parse(dataResult);
	
	
				$("#overlay").fadeOut(300);
				
			},error: function (request, status, error) {
				$("#overlay").fadeOut(300);
				alert("Maaf, sync error");
			}
		});
}

function syncPromo(){
	$("#overlay").fadeIn(300);

		$.ajax({
		url: "api/action.php?modul=sync&act=sync_promo",
		type: "POST",
		beforeSend: function(){
			$('#notif').html("Proses sync Promo..");
			
		},
		success: function(dataResult){
			// console.log(dataResult);
			syncPromoCode();
			syncPromoTebus();
		}
		});
		
	
	
	
	
}
		
		
function syncPromoCode(){
	$("#overlay").fadeIn(300);

		$.ajax({
		url: "api/action.php?modul=sync&act=sync_promo_code",
		type: "POST",
		beforeSend: function(){
			$('#notif').html("Proses sync Promo code..");
			
		},
		success: function(dataResult){
			var dataResult = JSON.parse(dataResult);
			// location.reload();
			$('#notif').html("<font style='color: green'>"+dataResult.msg+"</font>");
			$("#overlay").fadeOut(300);
			
		}
		});
}		
		
		
function syncPromoTebus(){
	$("#overlay").fadeIn(300);

		$.ajax({
		url: "api/action.php?modul=sync&act=sync_promo_tebus",
		type: "POST",
		beforeSend: function(){
			$('#notif').html("Proses sync Promo code..");
			
		},
		success: function(dataResult){
			console.log(dataResult);
			var dataResult = JSON.parse(dataResult);
			location.reload();
			$('#notif').html("<font style='color: green'>"+dataResult.msg+"</font>");
			$("#overlay").fadeOut(300);
			
		}
		});
}

</script>


</html>

