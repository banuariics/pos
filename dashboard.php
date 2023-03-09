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
  grid-template-columns: auto auto auto auto;
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
</style>
<link href="styles/css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="styles/css/font-awesome.css" rel="stylesheet"> 
<script src="styles/js/jquery-1.11.1.min.js"></script>

<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
<link href="styles/css/animate.css" rel="stylesheet" type="text/css" media="all">
<link href="styles/css/custom.css" rel="stylesheet">
<link rel="stylesheet" href="styles/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="styles/css/stylepos.css">
</head>
<body>

<div class="header">
  <a href="#default" class="logo">Idolmart</a>
</div>


<?php include "components/menu.php"; ?>

<div class="content">
  
  <div class="grid-container">
  <div class="grid-item"><a  onclick="modal_buka_kasir();" style="cursor: pointer">Buka Shift</a></div>
  <div class="grid-item"><a  onclick="masuk_pos();" style="cursor: pointer">Point of Sales</a></div>
  <div class="grid-item">Tutup Shift</div>  
  <div class="grid-item">Tutup Harian</div>

</div>
  
  
</div>



<div id="myModalReprint" class="modal">

  <!-- Modal content -->
  <div class="modal-content" style="width: 30%">
    <span class="close">&times;</span>
	
	<div class="row">
		<div class="col-12">
			<center><h5>Saldo Awal Kasir</h5></center>
		</div>
		<div class="col-12">
			<label for="idNoMember" style="font-size:13px;">Saldo Awal Kasir</label>
			<input type="text" class="form-control" id="nominal_awal" style="width: 100%; margin-bottom: 10px" autofocus />
		</div>
		
		<div class="col-12">
			<button class="btn btn-primary"  onclick="buka_kasir();" style="width: 100%">Submit</button>
		</div>	
						
	</div>
   
   <!--<button style="width: 100%; height: 100px; background-color: #0081B4; color: #fff; font-size: 30px;cursor: pointer" onclick="tunai();">Saldo Awal</button><br>
   <button style="width: 100%; height: 100px; background-color: #0081B4; color: #fff; font-size: 30px;cursor: pointer" onclick="syncProduct();">Tutup Kasir</button><br>
   <button style="width: 100%; height: 100px; background-color: #0081B4; color: #fff; font-size: 30px;cursor: pointer" onclick="syncProduct();">Tutup Harian</button>-->
   
   
  </div>

</div>



<div id="myModalBelumBuka" class="modal">

  <!-- Modal content -->
  <div class="modal-content" style="width: 30%">
    <span class="close">&times;</span>
	

			<center><h5>Buka Kasir Dulu Yaa..</h5></center>

   

  </div>

</div>

</body>

<script type="text/javascript">
var modal = document.getElementById("myModalReprint");
var modal1 = document.getElementById("myModalBelumBuka");
var span = document.getElementsByClassName("close")[0];
var span1 = document.getElementsByClassName("close")[1];

function modal_buka_kasir(){
	
	document.getElementById("nominal_awal").focus();
	modal.style.display = "block";
	
	span.onclick = function() {
		modal.style.display = "none";
	}
	
	window.onclick = function(event) {
		if (event.target == modal) {
			modal.style.display = "none";
			
		}
	}
}

function modal_notif_kasir(){
	modal1.style.display = "block";
	
	span1.onclick = function() {
		modal1.style.display = "none";
	}
	
	window.onclick = function(event) {
		if (event.target == modal1) {
			modal1.style.display = "none";
			
		}
	}
}

function masuk_pos(){
	
	$.ajax({
		url: "api/action.php?modul=users&act=masuk_pos",
		type: "GET",
		beforeSend: function(){
			// document.getElementById("notif").innerHTML = 'Proses load';
			$("#overlay").fadeIn(300);
		},
		success: function(dataResult){
			// console.log(dataResult);
			// console.log(dataResult);
			var dataResults = JSON.parse(dataResult);
			console.log(dataResults.id);
			if(dataResults.result == 1){
				
				location.href = "pos.php";
				// location.reload();
			}else{
				$("#overlay").fadeOut(300);
				modal_notif_kasir();
				
				// document.getElementById("notif").innerHTML = 'Gagal submit order';
			}
			
		}
	});
	
}


function buka_kasir(){
	var nominal_awal = document.getElementById("nominal_awal").value;
	
	$.ajax({
		url: "api/action.php?modul=users&act=buka_kasir",
		type: "POST",
		data : {nominal_awal: nominal_awal},
		beforeSend: function(){
			// document.getElementById("notif").innerHTML = 'Proses load';
			$("#overlay").fadeIn(300);
		},
		success: function(dataResult){
			// console.log(dataResult);
			// console.log(dataResult);
			var dataResults = JSON.parse(dataResult);
			console.log(dataResults.id);
			if(dataResults.result == 1){
				
				cetak_kasir(dataResults.id);
				location.reload();
			}else{
				
				$("#overlay").fadeOut(300);
				// document.getElementById("notif").innerHTML = 'Gagal submit order';
			}
			
		}
	});
	
}


function cetak_kasir(id){
	// alert(id);
  	$.ajax({
		url: "api/action.php?modul=users&act=cetak_buka_kasir&id="+id,
		type: "GET",
		processData: false,
		contentType: false,
		beforeSend: function(){
			// document.getElementById("notif").innerHTML = 'Proses load';
			$("#overlay").fadeIn(300);
		},
		success: function(dataResult){
			// console.log(dataResult);
			var dataResult = JSON.parse(dataResult);
			
			
			if(dataResult.result == 1){

					cetakBuka(
						dataResult.alamat, 
						dataResult.alamat1, 
						dataResult.kota, 
						dataResult.brand, 
						dataResult.insertby, 
						dataResult.startdate, 
						dataResult.balanceamount, 
						dataResult.insertdate, 
						dataResult.inserttime
					);
				
				
				
				modal1.style.display = "none";
			}else{
				
				console.log(dataResult);
			}
			
			$("#overlay").fadeOut(300);
	
		}
	}); // sendtoprinter();
}


function cetakBuka(alamat, alamat1, kota, brand, insertby, startdate, balanceamount, insertdate, inserttime){
	 // var strcontent='';

     var strcontent =textbyline(brand,38,'center')+'\r\n';
     strcontent+=textbyline(alamat,38,'center')+'\r\n';
     strcontent+=textbyline(alamat1,38,'center')+'\r\n';
     strcontent+=textbyline("=======================================",38,'center')+'\r\n';
     strcontent+=textbyline('KASIR      :',13,'left')+''+textbyline(insertby,28,'right')+'\r\n';
     strcontent+=textbyline('TANGGAL    :',13,'left')+''+textbyline(startdate,28,'right')+'\r\n';
     strcontent+=textbyline('SALDO AWAL :',13,'left')+''+textbyline(balanceamount,28,'right')+'\r\n';
     strcontent+=textbyline("=======================================",38,'center')+'\r\n';
     strcontent+=textbyline(insertdate+' '+inserttime,38,'left')+'\r\n';

    // print_text(strcontent);
	console.log(strcontent);
	
}

function textbyline(str,intmax,stralign){
    var strresult='';
  if (stralign=='right'){
    strresult=str.padStart(intmax);
  } else if (stralign=='center'){
    var l = str.length;
    var w2 = Math.floor(intmax / 2);
    var l2 = Math.floor(l / 2);
    var s = new Array(w2 - l2 + 1).join(" ");
    str = s + str + s;
    if (str.length < intmax)
    {
        str += new Array(intmax - str.length + 1).join(" ");
    }
    strresult=str;
  } else {
    strresult=str;
  }
  return strresult;
};

function print_text(html){
	// console.log(html);
	$.ajax({
		url: "print.php",
		type: "POST",
		data : {html: html},
		success: function(dataResult){
			var dataResult = JSON.parse(dataResult);

			// $('#notif').html("Proses print");
			
			
		}
	});
}

</script>

</html>

