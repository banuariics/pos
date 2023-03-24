<?php include "config/koneksi.php"; ?> 
<!DOCTYPE html>
<html lang="en">
<head>
<title>My POSS</title>
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
  grid-template-columns: auto auto auto auto auto;
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
  <div class="grid-item"><a  onclick="modal_tutup_kasir();" style="cursor: pointer">Tutup Shift</a></div>  
  <div class="grid-item"><a  onclick="modal_tutup_harian();" style="cursor: pointer">Tutup Harian</a></div>  
  <div class="grid-item" onclick="reprint();" style="cursor: pointer">Reprint</div>

</div>
  
  
</div>



<div id="myModalBukaKasir" class="modal">

  <!-- Modal content -->
  <div class="modal-content" style="width: 30%">
    <span class="close">&times;</span>
	
	<div class="row">
	<font id="notif_buka_kasir"></font>
	
		<div class="col-12">
			<center><h5>Saldo Awal Kasir</h5></center>
		</div>
		<div class="col-12">
			<label for="idNoMember" style="font-size:13px;">Saldo Awal Kasir</label>
			<input type="text" class="form-control cash" id="nominal_awal" style="width: 100%; margin-bottom: 10px" autofocus />
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


<div id="myModalReprint" class="modal">

  <!-- Modal content -->
  <div class="modal-content" style="width: 30%">
    <span class="close">&times;</span>
   
   <button style="width: 100%; height: 100px; background-color: #0081B4; color: #fff; font-size: 30px;cursor: pointer" onclick="reprint_saldo_awal();">SALDO AWAL</button><br>
   <button style="width: 100%; height: 100px; background-color: #4E6C50; color: #fff; font-size: 30px;cursor: pointer" onclick="reprint_tutup_kasir();">TUTUP KASIR</button><br>
   <button style="width: 100%; height: 100px; background-color: #DF2E38; color: #fff; font-size: 30px;cursor: pointer" onclick="reprint_tutup_harian();">TUTUP HARIAN</button><br>
   
   
  </div>

</div>

<div id="myModalTutupKasir" class="modal">

  <!-- Modal content -->
  <div class="modal-content" style="width: 30%">
    <span class="close">&times;</span>
	
	<div class="row">
		<div class="col-12">
			<center><h5>Tutup Kasir</h5></center>
		</div>
		<div class="col-12">
			<label for="idNoMember" style="font-size:13px;">Total Uang Cash</label>
			<input type="text" class="form-control cash" id="total_cash" style="width: 100%; margin-bottom: 10px" autofocus />
		</div>
		
		<div class="col-12">
			<button class="btn btn-primary"  onclick="tutup_kasir();" style="width: 100%">Submit</button>
		</div>	
						
	</div>
   
   <!--<button style="width: 100%; height: 100px; background-color: #0081B4; color: #fff; font-size: 30px;cursor: pointer" onclick="tunai();">Saldo Awal</button><br>
   <button style="width: 100%; height: 100px; background-color: #0081B4; color: #fff; font-size: 30px;cursor: pointer" onclick="syncProduct();">Tutup Kasir</button><br>
   <button style="width: 100%; height: 100px; background-color: #0081B4; color: #fff; font-size: 30px;cursor: pointer" onclick="syncProduct();">Tutup Harian</button>-->
   
   
  </div>

</div>

<div id="myModalTutupHarian" class="modal">

  <!-- Modal content -->
  <div class="modal-content" style="width: 30%">
    <span class="close">&times;</span>
	
	<div class="row">
		<div class="col-12">
			<center><h5>Tutup Harian</h5></center>
		</div>
		
		<div class="col-12">
			<font id="notif_tutup" style="font-size:13px; color: red"></font>
		</div>
		
		<div class="col-12">
			<label for="idNoMember" style="font-size:13px;">Tanggal</label>
			<input type="date" class="form-control" id="tgl_tutup_harian" style="width: 100%; margin-bottom: 10px" autofocus value="<?php echo date('Y-m-d'); ?>"/>
		</div>
		
		<div class="col-12">
			<label for="idNoMember" style="font-size:13px;">Notes</label>
			<textarea class="form-control" id="notes_tutup_harian" style="width: 100%; margin-bottom: 10px"></textarea>
		</div>
		
		<div class="col-12">
			<button class="btn btn-primary"  onclick="tutup_harian();" style="width: 100%">Submit</button>
		</div>	
						
	</div>
   
   <!--<button style="width: 100%; height: 100px; background-color: #0081B4; color: #fff; font-size: 30px;cursor: pointer" onclick="tunai();">Saldo Awal</button><br>
   <button style="width: 100%; height: 100px; background-color: #0081B4; color: #fff; font-size: 30px;cursor: pointer" onclick="syncProduct();">Tutup Kasir</button><br>
   <button style="width: 100%; height: 100px; background-color: #0081B4; color: #fff; font-size: 30px;cursor: pointer" onclick="syncProduct();">Tutup Harian</button>-->
   
   
  </div>

</div>


</body>
<script src="styles/js/separator.js"></script>
<script src="styles/js/dashboard.js?id=<?php echo date('ydmHis'); ?>"></script>

</html>

