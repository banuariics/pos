<?php session_start();
include "config/koneksi.php"; 

function rupiah($angka){
	
	$hasil_rupiah = number_format($angka,0,',','.');
	return $hasil_rupiah;
 
}


			
?> 
<!DOCTYPE HTML>
<html>
<head>
<title>POS</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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

		
<div class="header mb-0 pb-0" style="padding: 0 !important">
<div class="grid-container"  style="background-color:beige;padding: 0 !important">
  <div class="grid-item"><font style="font-size: 30px; color: blue">Idolmart</font> <br>Jalan Caman<br>Bekasi<br>Telp</div>
  <div class="grid-item">
  
	<?php $getkode = $connec->query("select storecode from m_profile limit 1");
	foreach($getkode as $gk){
		
		$store_code = $gk['storecode'];
		
	}
	$no_struk_cook = $store_code.'-'.date('YmdHis');
	
	
	if(!isset($_COOKIE["bill_no"])) {
	setcookie("bill_no", $no_struk_cook, time() + (86400 * 30), "/");
	$nostruk = $_COOKIE["bill_no"];
	} else {
	$nostruk = $_COOKIE["bill_no"];
	} 
	?>


	<table style="width: 100%">
		<tr>
			<td>Struk Temp</td>
			<td> : </td>
			<td><?php echo $_COOKIE["bill_no"]; ?></td>
			<td>Tanggal</td>
			<td> : </td>
			<td><?php echo date('Y-m-d'); ?></td>
		</tr>		
		<tr>
			<td>POS</td>
			<td> : </td>
			<td>Server</td>
			
			<td>Jam</td>
			<td> : </td>
			<td><?php echo date('H:i'); ?></td>
		</tr>
		
		<tr>
			<td colspan="6" style="font-size: 40px; font-weight: bold"><?php echo $_SESSION['username']; ?> (<?php echo $_SESSION['name']; ?>)</td>
		</tr>
	</table>
	
	
  </div>  
  <div class="grid-item">
  
  <font style="font-size: 80px;float: right; font-weight: bold" id="load-total">
  </font>
  
  </div>
</div>  
</div>

<div class="card m-2" style="padding: 0 !important; margin: 0 !important; background-color: beige !important">
<div class="card-body" style="padding: 0 !important">
	<div class="col-12">
		<div class="row">
			<div class="col-8" style="background-color:beige;">
			
			<div style=" height:280px; overflow:auto;">
			
			<div id="results" class="scrollingdatagrid">
			 
			<table tabindex='0' cellspacing="0" border="1" style="background-color:#fff;width: 100%; overflow:auto; height: 110px;" class="table2 table-bordered table-striped" id="table">
				<thead>
					<tr style="background-color: #609966; color: #fff;position: sticky;top: 0; /* Don't forget this, required for the stickiness */">
						<th>No</th>
						<th>SKU</th>
						<th>Barcode</th>
						<th>Deskripsi</th>
						<th>QTY</th>
						<th>Harga</th>
						<th>Diskon</th>
						<th>Total</th>
						<th>Discount Name</th>		
					</tr>
				</thead>
				<tbody>   
				

				</tbody>
			</table>
			</div>
			</div>
			
			<br>
			
					<div class="row">
						<div class="col-4">
							<label for="idNoMember" style="font-size:13px;">SKU / Barcode / Shortcut</label>
							<input type="text" class="form-control" id="sku" autofocus />
						</div>
						<div class="col-4">
							<label for="idNamaMember" style="font-size:13px;">Deskripsi</label>
							<input type="text" class="form-control" id="deskripsi" onchange="filtertable();" />
						</div>	
						<div class="col-4">
							<label for="idNamaMember" style="font-size:13px;">QTY</label>
							<input type="number" class="form-control" id="qty" value="1" />
						</div>				
	
										
					</div>
			
			<br>
			
			<div id="results" class="scrollingdatagrid cLoadDataItem">
			
			<table tabindex='0' cellspacing="0" border="1" style="background-color:#fff;width: 100%; overflow:auto; height: 110px; color: #000" class="table1 table-bordered table-striped" id="idTableItemList">
				<thead>
					<tr style="background-color: #609966; color: #fff">
						<th>SKU</th>
						<th>Barcode</th>
						<th>Shortcut</th>
						<th>Deskripsi</th>
						<th>Stock</th>
						<th>Harga</th>
					</tr>
				</thead>
				<tbody>  

					
					

				
				</tbody>
			</table>
			
			
			</div>
			</div>
			<div class="col-4">
				<div id="notif" class="col-12 p-2 mb-1" style="background-color:black; color: #fff; text-transform: uppercase;">
					NOTIF SECTION
				</div>
				<div class="col-12 p-2" style="background-color:beige;">
					<div class="row">
						<div class="col-8">
							<h5>BOSOL-ONLINE-SHOP</h5>
						</div>
						<div class="col-4">
							<text style="float:right;">Reguler</text>
						</div>
						<div class="col-6">
							<label for="idNoMember" style="font-size:13px;">No Kartu Member / HP</label>
							<input type="text" class="form-control" id="idNoMember" />
						</div>
						<div class="col-6">
							<label for="idNamaMember" style="font-size:13px;">Nama Member</label>
							<input type="text" class="form-control" id="idNamaMember" />
						</div>
						<div class="col-12">
							<label for="idKodePromo" style="font-size:13px;">Kode Promo</label>
							<input type="text" class="form-control" id="idKodePromo" />						
						</div>						
					</div>
					<div class="row mt-4 m-0 p-0">
						<div class="col-4" style="display: flex; flex-direction: row; justify-content: center;">
							<media class="cBtnVoid">
								<center>
									<image src="assets/icon/void.png" height="30" width="30" /><br/>
									<text style="font-size:10px;font-weight:bold;">VOID (F2)</text>
								</center>
							</media>
						</div>	
						<div class="col-4" style="display: flex; flex-direction: row; justify-content: center;">
							<media class="cBtnReprint">
								<center>
									<image src="assets/icon/reprint.png" height="30" width="30" /><br/>
									<text style="font-size:10px;font-weight:bold;">REPRINT (F3)</text>
								</center>
							</media>
						</div>
						<div class="col-4" style="display: flex; flex-direction: row; justify-content: center;">
							<media class="cBtnRefund">
								<center>
									<image src="assets/icon/refund.png" height="30" width="30" /><br/>
									<text style="font-size:10px;font-weight:bold;">REFUND (F4)</text>
								</center>
							</media>
						</div>
						
						<div class="col-12 m-2"></div>
						
						<div class="col-4" style="display: flex; flex-direction: row; justify-content: center;">
							<media class="cBtnDiscount">
								<center>
									<image src="assets/icon/discount.png" height="30" width="30" /><br/>
									<text style="font-size:10px;font-weight:bold;">DISCOUNT (F5)</text>
								</center>
							</media>
						</div>	
						<div class="col-4" style="display: flex; flex-direction: row; justify-content: center;">
							<media class="cBtnPending">
								<center>
									<image src="assets/icon/pending.png" height="30" width="30" /><br/>
									<text style="font-size:10px;font-weight:bold;">PENDING (F6)</text>
								</center>
							</media>
						</div>
						<div class="col-4" style="display: flex; flex-direction: row; justify-content: center;">
							<media class="cBtnQty">
								<center>
									<image src="assets/icon/qty.png" height="30" width="30" /><br/>
									<text style="font-size:10px;font-weight:bold;">QUANTITY (F8)</text>
								</center>
							</media>
						</div>	

						<div class="col-12 m-2"></div>
						
						<div class="col-12 text-white" style="background-color:tomato;">
							<media class="cBtnRefund">
								<center>
									<image src="assets/icon/payment.png" height="30" width="30" /><br/>
									<text style="font-size:10px;font-weight:bold;">PAYMENT (F7)</text>
								</center>
							</media>						
						</div>

						<div class="col-12 m-2"></div>
						
						<div class="col-4" style="display: flex; flex-direction: row; justify-content: center;">
							<media class="cBtnMember">
								<center>
									<image src="assets/icon/member.png" height="30" width="30" /><br/>
									<text style="font-size:10px;font-weight:bold;">MEMBER (F9)</text>
								</center>
							</media>
						</div>	
						<div class="col-4" style="display: flex; flex-direction: row; justify-content: center;">
							<media class="cBtnFindProduct">
								<center>
									<image src="assets/icon/search.png" height="30" width="30" /><br/>
									<text style="font-size:10px;font-weight:bold;">FIND PRODUCT (F10)</text>
								</center>
							</media>
						</div>
						<div class="col-4" style="display: flex; flex-direction: row; justify-content: center;">
							<media class="cBtnRecal">
								<center>
									<image src="assets/icon/filter.png" height="30" width="30" /><br/>
									<text style="font-size:10px;font-weight:bold;">RECALL (F11)</text>
								</center>
							</media>
						</div>	

						<div class="col-12 m-2"></div>
						
						<div class="col-12 text-white" style="background-color:#6847ff;">
							<media class="cBtnRefund">
								<center>
								<a href="dashboard.php">
									<image src="assets/icon/close.png" height="30" width="30" style="margin-top:5px;" /><br/>
									<text style="font-size:10px;font-weight:bold;">CLOSE (ESC)</text>
								</center>
								</a>
							</media>						
						</div>

						<div class="col-12 m-2"></div>						
						
						<div class="col-12">
							<h5>Pending Transaction</h5>
							<hr/>
							<table class="table table-bordered" style="border:1px solid silver;">
								<thead>
									<tr>
										<th style="font-size:12px;text-align:center;">No Temp</th>
										<th style="font-size:12px;text-align:center;">Member</th>		
									</tr>
								</thead>
								<tbody>  								
								</tbody>
							</table>						
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>


<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content" style="width: 30%">
    <span class="close">&times;</span>
   
   <button style="width: 100%; height: 100px; background-color: #0081B4; color: #fff; font-size: 30px;cursor: pointer" onclick="tunai();">Tunai</button><br>
   <button style="width: 100%; height: 100px; background-color: #4E6C50; color: #fff; font-size: 30px;cursor: pointer" onclick="debit();">Non Tunai</button><br>
   
   
  </div>

</div>




<div id="myModalTunai" class="modal" >

  <!-- Modal content -->
  <div class="modal-content" style="width: 30%">
    <span class="close">&times;</span>
   
	
					<div class="row">
						<div class="col-12">
							<center><h5>PEMBAYARAN TUNAI</h5></center>
						</div>
						<div class="col-6">
							<label for="idNoMember" style="font-size:13px;">Redeem point</label>
							<input type="text" class="form-control" id="redeem" readonly />
						</div>
						<div class="col-6">
							<label for="idNamaMember" style="font-size:13px;">Total harus dibayar</label>
							<input type="text" class="form-control" id="total" readonly />
						</div>
						<div class="col-6">
							<label for="idKodePromo" style="font-size:13px;">Uang diterima</label>
							<input type="text" class="form-control cash" id="uang" onkeyup="cekKembalian();"/>						
						</div>			
						<div class="col-6">
							<label for="idKodePromo" style="font-size:13px;">Infak</label>
							<input type="text" class="form-control cash" id="infak" />						
						</div>	

						<div class="col-12">
						<br>
						<br>
							<center><h5>KEMBALIAN</h5></center><br>
							<center><h1 id="kembalian">0</h1></center>
						</div>	
						
						<div class="col-12">
							<button class="btn btn-primary" id="btn-order" style="display: none" onclick="submitOrder();">Submit</button>
						</div>	
						
					</div>
   
  </div>

</div>

<div id="myModalReprint" class="modal">

  <!-- Modal content -->
  <div class="modal-content" style="width: 30%">
    <span class="close">&times;</span>
	
	<div class="row">
		<div class="col-12">
			<center><h5>REPRINT</h5></center>
		</div>
		<div class="col-12">
			<label for="idNoMember" style="font-size:13px;">Nomor Struk</label>
			<input type="text" class="form-control" id="no_struk" style="width: 100%; margin-bottom: 10px" />
		</div>
		
		<div class="col-12">
			<button class="btn btn-primary" onclick="reprint();"  style="width: 100%">Reprint</button>
		</div>	
						
	</div>
   
   <!--<button style="width: 100%; height: 100px; background-color: #0081B4; color: #fff; font-size: 30px;cursor: pointer" onclick="tunai();">Saldo Awal</button><br>
   <button style="width: 100%; height: 100px; background-color: #0081B4; color: #fff; font-size: 30px;cursor: pointer" onclick="syncProduct();">Tutup Kasir</button><br>
   <button style="width: 100%; height: 100px; background-color: #0081B4; color: #fff; font-size: 30px;cursor: pointer" onclick="syncProduct();">Tutup Harian</button>-->
   
   
  </div>

</div>



<div id="myModalDebit" class="modal" >

  <!-- Modal content -->
  <div class="modal-content" style="width: 30%; z-index: 999">
    <span class="close">&times;</span>
   
	
					<div class="row">
						<div class="col-12">
							<center><h5>PEMBAYARAN DEBIT</h5></center>
						</div>
						<div class="col-12">
							<label for="idNoMember" style="font-size:13px;">Dibayar debit</label>
							<input type="text" class="form-control cash" id="debit" onkeyup="cekKembalianDebit();" />
						</div>
						<div class="col-6">
							<label for="idNoMember" style="font-size:13px;">No Debit Card</label>
							<input type="text" class="form-control" id="no_debit" />
						</div>
						<div class="col-6">
							<label for="idNamaMember" style="font-size:13px;">Approve Code</label>
							<input type="text" class="form-control" id="approve_code" />
						</div>
						<div class="col-6">
							<label for="idKodePromo" style="font-size:13px;">Mesin EDC</label>
							<input type="text" class="form-control" id="mesin_edc" />						
						</div>			
						<div class="col-6">
							<label for="idKodePromo" style="font-size:13px;">Nama Bank</label>
							<input type="text" class="form-control" id="nama_bank_debit" />						
						</div>	
						<div class="col-6">
							<label for="idKodePromo" style="font-size:13px;">Sisa Harus dibayar</label>
							<input type="text" class="form-control cash" id="sisa_debit" onkeyup="cekKembalianDebit();"/>						
						</div>	
						<div class="col-6">
							<label for="idKodePromo" style="font-size:13px;">Uang yg diterima</label>
							<input type="text" class="form-control" value="Tunai" id="uang_debit" readonly />						
						</div>

						<div class="col-12">
							<label for="idNoMember" style="font-size:13px;">Infak</label>
							<input type="text" class="form-control cash" id="infak_debit" value="0" onkeyup="cekKembalianDebit();" />
						</div>						

						<div class="col-12">
						<br>
						<br>
							<center><h5>KEMBALIAN</h5></center><br>
							<center><h1 id="kembalian_debit">0</h1></center>
						</div>	
						
						<div class="col-12">
							<button class="btn btn-primary" onclick="submitOrderDebit();">Submit</button>
						</div>	
						
					</div>
   
  </div>

</div>


   <script src="styles/js/bootstrap.js"> </script>
   <script src="styles/js/jquery.dataTables.min.js"></script>
   <script src="styles/js/dataTables.bootstrap5.min.js"></script>
   <script src="styles/js/shortcut.js"></script>
   <script src="styles/js/separator.js"></script>
   
   
  
   
<script type="text/javascript">
easyNumberSeparator({
			selector: '.cash',
		});
var modal = document.getElementById("myModal");
var modal1 = document.getElementById("myModalTunai");
var modal_reprint = document.getElementById("myModalReprint");
var modal_debit = document.getElementById("myModalDebit");

var span = document.getElementsByClassName("close")[0];
var span1 = document.getElementsByClassName("close")[1];
var span3 = document.getElementsByClassName("close")[2];
var span4 = document.getElementsByClassName("close")[3];


span.onclick = function() {
  modal.style.display = "none";
}

window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}



span3.onclick = function() {
	modal_reprint.style.display = "none";
}

window.onclick = function(event) {
	if (event.target == modal_reprint) {
		modal_reprint.style.display = "none";
	}
}

function tunai(){
	document.getElementById("uang").focus();
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

function debit(){
	
	modal_debit.style.display = "block";
	
	span4.onclick = function() {
		modal_debit.style.display = "none";
	}
	
	window.onclick = function(event) {
		if (event.target == modal_debit) {
			modal_debit.style.display = "none";
		}
	}
}

// function reprint(){
	
	// modal_reprint.style.display = "block";
	
	// span3.onclick = function() {
		// modal_reprint.style.display = "none";
	// }
	
	// window.onclick = function(event) {
		// if (event.target == modal_reprint) {
			// modal_reprint.style.display = "none";
		// }
	// }
// }

function formatRupiah(angka, prefix){
			var number_string = angka.replace(/[^,\d]/g, '').toString(),
			split   		= number_string.split(','),
			sisa     		= split[0].length % 3,
			rupiah     		= split[0].substr(0, sisa),
			ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
 
			// tambahkan titik jika yang di input sudah menjadi angka ribuan
			if(ribuan){
				separator = sisa ? '.' : '';
				rupiah += separator + ribuan.join('.');
			}
 
			rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
			return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
		}

function cekKembalian(){
	var uang = document.getElementById("uang").value;
	var total = document.getElementById("total").value;
	
	var intuang = parseInt(uang.split(",").join(""));
	var inttotal = parseInt(total.split(".").join(""));
	
	// alert(intuang+" "+inttotal);
	
	if(intuang >= inttotal){
		var jumm =  parseInt(intuang) -  parseInt(inttotal);
		
		var haha = new Intl.NumberFormat().format(jumm); // 1,43,450
		//document.getElementById("kembalian").innerHTML = formatRupiah(jumm, 'Rp.');
		
		document.getElementById("kembalian").innerHTML = haha;
		
		
		$("#btn-order").css("display", "block");
		
		
	}else{
		 $("#btn-order").css("display", "none");
		document.getElementById("kembalian").innerHTML = "TDK BOLEH KURANG DARI TOTAL";
	}
	
	
	
}

function cekKembalianDebit(){
	var sisa_debit = document.getElementById("sisa_debit").value;
	var debit = document.getElementById("debit").value;
	var infak_debit = document.getElementById("infak_debit").value;
	var total = document.getElementById("total").value;
	
	if(sisa_debit == ""){
		
		sisa_debit ="0";
	}
	
	if(debit == ""){
		
		debit = "0";
	}
	
	if(infak_debit == ""){
		
		infak_debit = "0";
	}
	
	var intuang = parseInt(debit.split(",").join("")) + parseInt(sisa_debit.split(",").join("")) + parseInt(infak_debit.split(",").join(""));
	var inttotal = parseInt(total.split(".").join(""));
	
	// alert(intuang+" "+inttotal);
	console.log(parseInt(debit.split(",").join("")));
	console.log(parseInt(sisa_debit.split(",").join("")));
	console.log(parseInt(infak_debit.split(",").join("")));
	if(intuang >= inttotal){
		var jumm =  parseInt(intuang) -  parseInt(inttotal);
		
		var haha = new Intl.NumberFormat().format(jumm); // 1,43,450
		//document.getElementById("kembalian").innerHTML = formatRupiah(jumm, 'Rp.');
		
		document.getElementById("kembalian_debit").innerHTML = haha;
		
		
		$("#btn-order-debit").css("display", "block");
		
		
	}else{
		 $("#btn-order-debit").css("display", "none");
		document.getElementById("kembalian_debit").innerHTML = "TDK BOLEH KURANG DARI TOTAL";
	}
	
	
	
}

function submitOrder(){
	var uang = document.getElementById("uang").value;
	var total = document.getElementById("total").value;
	
	var intuang = parseInt(uang.split(",").join(""));
	var inttotal = parseInt(total.split(".").join(""));
	
	// alert(intuang+" "+inttotal);
	
	if(intuang >= inttotal){
	$.ajax({
		url: "api/action.php?modul=sales&act=order",
		type: "POST",
		data : {uang: uang},
		beforeSend: function(){
			document.getElementById("notif").innerHTML = 'Proses load';
			$("#overlay").fadeIn(300);
		},
		success: function(dataResult){
			// console.log(dataResult);
			console.log(dataResult);
			var dataResults = JSON.parse(dataResult);
			if(dataResults.result == 1){
				
				cetak(dataResults.no_struk);
				location.reload();
			}else{
				
				$("#overlay").fadeOut(300);
				document.getElementById("notif").innerHTML = 'Gagal submit order';
			}
			
		}
	});
		
		
	}else{

		document.getElementById("kembalian").innerHTML = "TDK BOLEH KURANG DARI TOTAL";
	}
	
	// alert(uang);
	
}


function submitOrderDebit(){
	
	
	var debit = document.getElementById("debit").value;
	var no_debit = document.getElementById("no_debit").value;
	var approve_code = document.getElementById("approve_code").value;
	var mesin_edc = document.getElementById("mesin_edc").value;
	var nama_bank_debit = document.getElementById("nama_bank_debit").value;
	var sisa_debit = document.getElementById("sisa_debit").value;
	var uang_debit = document.getElementById("uang_debit").value; //Tunai/CASH
	var infak_debit = document.getElementById("infak_debit").value;
	var total = document.getElementById("total").value;
	
	
	var intuang = parseInt(debit.split(",").join("")) + parseInt(sisa_debit.split(",").join("")) + parseInt(infak_debit.split(",").join(""));
	var inttotal = parseInt(total.split(".").join(""));
	
	// alert(intuang+" "+inttotal);
	
	if(intuang >= inttotal){
	$.ajax({
		url: "api/action.php?modul=sales&act=order_debit",
		type: "POST",
		data : {
			debit:debit,
			approve_code:approve_code,
			mesin_edc:mesin_edc,
			nama_bank_debit:nama_bank_debit,
			sisa_debit:sisa_debit,
			uang_debit:uang_debit,
			infak_debit:infak_debit,
		},
		beforeSend: function(){
			document.getElementById("notif").innerHTML = 'Proses load';
			$("#overlay").fadeIn(300);
		},
		success: function(dataResult){
			// console.log(dataResult);
			console.log(dataResult);
			var dataResults = JSON.parse(dataResult);
			if(dataResults.result == 1){
				
				cetak(dataResults.no_struk);
				// location.reload();
			}else{
				
				$("#overlay").fadeOut(300);
				document.getElementById("notif").innerHTML = 'Gagal submit order';
			}
			
		}
	});
		
		
	}else{

		document.getElementById("kembalian").innerHTML = "TDK BOLEH KURANG DARI TOTAL";
	}

	
}

getTotal();
function getTotal(){
	
	$.ajax({
		url: "api/action.php?modul=sales&act=total",
		type: "GET",
		processData: false,
		contentType: false,
		beforeSend: function(){
			document.getElementById("notif").innerHTML = 'Proses load';
			$("#overlay").fadeIn(300);
		},
		success: function(dataResult){
			console.log(dataResult);
			
			
			document.getElementById("load-total").innerHTML = dataResult;
			document.getElementById("total").value = dataResult;
		}
	});
}


function showTampilan(){
	
	$.ajax({
		url: "api/action.php?modul=product&act=show",
		type: "GET",
		processData: false,
		contentType: false,
		beforeSend: function(){
			document.getElementById("notif").innerHTML = 'Proses load';
			$("#overlay").fadeIn(300);
		},
		success: function(dataResult){
			console.log(dataResult);
			document.querySelector('#table > tbody').innerHTML = dataResult;
			$("#overlay").fadeOut(300);
			
			document.getElementById("notif").innerHTML = 'Selesai load';
			
		}
	});
	
	
	
}
showTampilan();

var input = document.getElementById("sku");
var qtyinput = document.getElementById("qty");
var uang = document.getElementById("uang");


uang.addEventListener("keypress", function(event) {
	 if (event.key === "Enter") {
		 
		 
		 
		 submitOrder();
		 
	 }
	
});
input.addEventListener("keypress", function(event) {
  if (event.key === "Enter") {
	  
	var sku = input.value;
	var qty = qtyinput.value;
	$.ajax({
		url: "api/action.php?modul=product&act=scan",
		type: "POST",
		data : {sku: sku, qty: qty},
		beforeSend: function(){
	
			$('#notif').html("<font style='color: red'>Sedang mencari items..</font>");
		},
		success: function(dataResult){
			console.log(dataResult);
			var dataResults = JSON.parse(dataResult);
			if(dataResults.result == 1){
				
				$('#notif').html(dataResults.msg);
				$('#deskripsi').val(dataResults.name);
				showTampilan();
				getTotal();
				$('#sku').val("");
				$('#qty').val("1");
			}else{
				
				
				$('#notif').html(dataResults.msg);
			}
			
		}
	});
	

  }
});



qtyinput.addEventListener("keypress", function(event) {
  if (event.key === "Enter") {
	  
	var sku = input.value;
	var qty = qtyinput.value;
	$.ajax({
		url: "api/action.php?modul=product&act=scan",
		type: "POST",
		data : {sku: sku, qty: qty},
		beforeSend: function(){
	
			$('#notif').html("<font style='color: red'>Sedang mencari items..</font>");
		},
		success: function(dataResult){
			console.log(dataResult);
			var dataResults = JSON.parse(dataResult);
			if(dataResults.result == 1){
				
				$('#notif').html(dataResults.msg);
				$('#deskripsi').val(dataResults.name);
				showTampilan();
				getTotal();
				$('#sku').val("");
				$('#qty').val("1");
					
			}else{
				
				
				$('#notif').html(dataResults.msg);
			}
			
		}
	});
	

  }
});




$("body").keydown(function(e){
	var total = document.getElementById("total").value;	
	var keyCode = e.keyCode || e.which;
	 if(keyCode == "112"){ //F1

			document.getElementById("sku").focus();
			 
			 
	}  
	
	if(keyCode == "113"){  //F2
			 
			modal.style.display = "block";
			 
			 
		 }  
		 
	if(keyCode == "114"){  //F3
			e.preventDefault();
			modal_reprint.style.display = "block";
			document.getElementById("no_struk").focus();
			 
			 
	}  
		 
	 if(keyCode == "118"){  //F7
		e.preventDefault();
			if(total != 0){
				
				modal.style.display = "block";
				document.getElementById("uang").focus(); 
			}
	
		 }   
		 
});



function getDataStruk(){
	
	$.ajax({
		url: "api/action.php?modul=sales&act=total",
		type: "GET",
		processData: false,
		contentType: false,
		beforeSend: function(){
			document.getElementById("notif").innerHTML = 'Proses load';
			$("#overlay").fadeIn(300);
		},
		success: function(dataResult){
			console.log(dataResult);
			
			
			document.getElementById("load-total").innerHTML = dataResult;
			document.getElementById("total").value = dataResult;
		}
	});
}





function cetak(no_struk){
  	$.ajax({
		url: "api/action.php?modul=sales&act=reprint&no_struk="+no_struk,
		type: "GET",
		processData: false,
		contentType: false,
		beforeSend: function(){
			document.getElementById("notif").innerHTML = 'Proses load';
			$("#overlay").fadeIn(300);
		},
		success: function(dataResult){
			// console.log(dataResult);
			var dataResult = JSON.parse(dataResult);
			
			
			
			if(dataResult.result == 1){
				
				for (let index = 0; index < dataResult.header.length; ++index) {
					// const element = dataResult.header[index];
					// console.log(dataResult.header[index].billno);
					cetakStruk(
					dataResult.header[index].alamat, 
					dataResult.header[index].alamat1, 
					dataResult.header[index].kota, 
					dataResult.header[index].brand, 
					dataResult.header[index].footer1, 
					dataResult.header[index].footer2, 
					dataResult.header[index].footer3, 
					dataResult.header[index].npwp, 
					dataResult.header[index].billno, 
					dataResult.header[index].billcode, 
					dataResult.header[index].insertdate, 
					dataResult.header[index].inserttime, 
					dataResult.header[index].insertby, 
					dataResult.header[index].dpp, 
					dataResult.header[index].ppn, 
					dataResult.header[index].billamount, 
					dataResult.header[index].discount, 
					dataResult.header[index].grandtotal, 
					dataResult.header[index].paygiven, 
					dataResult.header[index].paycashgiven, 
					dataResult.header[index].donasiamount, 
					dataResult.header[index].kembali, 
					dataResult.header[index].line
					);
				}
				
				
				modal_reprint.style.display = "none";
			}else{
				
				console.log(dataResult);
			}
			
			$("#overlay").fadeOut(300);
	
		}
	}); // sendtoprinter();
};


function reprint(){
	var no_struk = document.getElementById("no_struk").value;
  	$.ajax({
		url: "api/action.php?modul=sales&act=reprint&no_struk="+no_struk,
		type: "GET",
		processData: false,
		contentType: false,
		beforeSend: function(){
			document.getElementById("notif").innerHTML = 'Proses load';
			$("#overlay").fadeIn(300);
		},
		success: function(dataResult){
			// console.log(dataResult);
			var dataResult = JSON.parse(dataResult);
			
			
			
			if(dataResult.result == 1){
				
				for (let index = 0; index < dataResult.header.length; ++index) {
					// const element = dataResult.header[index];
					// console.log(dataResult.header[index].billno);
					cetakStruk(
					dataResult.header[index].alamat, 
					dataResult.header[index].alamat1, 
					dataResult.header[index].kota, 
					dataResult.header[index].brand, 
					dataResult.header[index].footer1, 
					dataResult.header[index].footer2, 
					dataResult.header[index].footer3, 
					dataResult.header[index].npwp, 
					dataResult.header[index].billno, 
					dataResult.header[index].billcode, 
					dataResult.header[index].insertdate, 
					dataResult.header[index].inserttime, 
					dataResult.header[index].insertby, 
					dataResult.header[index].dpp, 
					dataResult.header[index].ppn, 
					dataResult.header[index].billamount, 
					dataResult.header[index].discount, 
					dataResult.header[index].grandtotal, 
					dataResult.header[index].paygiven, 
					dataResult.header[index].paycashgiven, 
					dataResult.header[index].donasiamount, 
					dataResult.header[index].kembali, 
					dataResult.header[index].line
					);
				}
				
				
				modal_reprint.style.display = "none";
			}else{
				
				console.log(dataResult);
			}
			
			$("#overlay").fadeOut(300);
	
		}
	}); // sendtoprinter();
};




function cetakStruk(alamat, alamat1, kota, brand, footer1, footer2, footer3, npwp, billno, billcode, insertdate, inserttime, insertby, dpp, ppn, billamount, discount,grandtotal, paygiven, paycashgiven,donasiamount, kembali, line){
	// alert("Ok");
	var strdpp="";
	var strppn="";
	var strnpwp="";
	var strbillno="";
	var strbillamount="";
	var strmemberdiscount="";
	var strgrandamount="";
	var strdcamount="";
	var strpaygiven="";
	var strpayreturn="";
	var strdonasiamount="";
	var straddressdonasi="";
   var strcontent='';
   var strorgdesc='';
   var isppn=0;

   var strTotalDiscount='';
   var strReedemPoint='';
   var strMemberId='';
   var strPointGive='';
   var strMemberName='';
   var strNote1='';
   var strNote2='';
   var strNote3='';
  
	

         strcontent+=textbyline(brand,38,'center')+'\r\n';
         strcontent+=textbyline(alamat,38,'center')+'\r\n';
         strcontent+=textbyline(alamat1,38,'center')+'\r\n';
         strcontent+=textbyline('REPRINT',38,'left')+'\r\n';
         strcontent+=textbyline('STRUK   :'+billcode,24,'left')+''+textbyline(inserttime,18,'right')+'\r\n';
         strcontent+=textbyline('TANGGAL :'+insertdate,18,'left')+''+textbyline(insertby,20,'right')+'\r\n';

        strcontent+=textbyline("=======================================",38,'center')+'\r\n';
        strcontent+=textbyline("Nama Barang",10,'center')+textbyline("Qty",5,'center')+textbyline("Harga",7,'center')+textbyline("Disc",6,'center')+textbyline("Total",10,'right')+'\r\n';
        strcontent+=textbyline("=======================================",38,'center')+'\r\n';
      
		for (let index = 0; index < line.length; ++index) {
				
				strcontent+=textbyline(line[index].name,38,'left')+'\r\n';
				strcontent+=textbyline(line[index].qty.toString(),13,'right')+textbyline(line[index].price,9,'right')+textbyline(line[index].discount.toString(),5,'right')+textbyline(line[index].amount.toString(),12,'right')+'\r\n';
			
		}
		
      
          strcontent+=textbyline("=======================================",38,'center')+'\r\n';
          strcontent+=textbyline("TOTAL",5,'left')+textbyline(billamount.toString(),34,'right')+'\r\n';
		  
		   if (discount > 0){
			   
			   strcontent+=textbyline("DISKON    ",11,'left')+textbyline(discount.toString(),29,'right')+'\r\n';
		   }
          
		  
		  
          if (strReedemPoint !== "" && strReedemPoint !== 0){
            strcontent+=textbyline("REEDEM POINT",8,'left')+textbyline(strReedemPoint.toString(),27,'right')+'\r\n';
            };
          strcontent+=textbyline("GRAND TOTAL",11,'left')+textbyline(grandtotal.toString(),28,'right')+'\r\n';
		   if (paygiven > 0){
			   
			    strcontent+=textbyline("BAYAR D/C  ",11,'left')+textbyline(paygiven.toString(),28,'right')+'\r\n';
		   }
         
          strcontent+=textbyline("BAYAR CASH ",11,'left')+textbyline(paycashgiven,28,'right')+'\r\n';
		  if (donasiamount > 0){
			  
			  strcontent+=textbyline("INFAK      ",11,'left')+textbyline(donasiamount,28,'right')+'\r\n';
		  }
		  
          
          strcontent+=textbyline("KEMBALI    ",11,'left')+textbyline(kembali.toString(),28,'right')+'\r\n';
          strcontent+=textbyline("=======================================",38,'center')+'\r\n';
          if (isppn >0){
          strcontent+=textbyline("DPP :"+dpp,6,'left')+textbyline("PPN :"+ppn,20,'right')+'\r\n';
          strcontent+=textbyline("=======================================",38,'center')+'\r\n';
          if (strMemberId != ''){
            strcontent+=textbyline("SELAMAT ANDA MENDAPATKAN POINT",38,'center')+'\r\n';
            strcontent+=textbyline("MEMBER   ",11,'left')+textbyline(strMemberName.toString(),28,'right')+'\r\n';
            strcontent+=textbyline("POINT :  ",11,'left')+textbyline(strPointGive.toString(),28,'right')+'\r\n';
          }
          strcontent+=textbyline("***************************************",38,'center')+'\r\n';
          strcontent+=textbyline("NPWP :"+npwp,38,'center')+'\r\n';
          };
          strcontent+=textbyline(strorgdesc,38,'center')+'\r\n';
          strcontent+=textbyline("***************************************",38,'center')+'\r\n';
          strcontent+=textbyline(footer1,38,'center')+'\r\n';
          strcontent+=textbyline(footer2,38,'center')+'\r\n';
          strcontent+=textbyline(footer3,38,'center')+'\r\n';
          strcontent+=textbyline("***************************************",38,'center')+'\r\n';
          strcontent+=textbyline(straddressdonasi,38,'center')+'\r\n';
          print_text(strcontent);
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

			$('#notif').html("Proses print");
			
			
		}
	});
}





$('#idTableItemList').on('click', function(e){
	var id = $(e.target).closest('tr').find(".id").html();
	
	$('#sku').val(id);
	document.getElementById("sku").focus();
});






// input.addEventListener("keypress", function(event) {
  // if (event.key === "Enter") {
	  
	// var sku = input.value;
	// var qty = qtyinput.value;
	// $.ajax({
		// url: "api/action.php?modul=product&act=scan",
		// type: "POST",
		// data : {sku: sku, qty: qty},
		// beforeSend: function(){
	
			// $('#notif').html("<font style='color: red'>Sedang mencari items..</font>");
		// },
		// success: function(dataResult){
			// console.log(dataResult);
			// var dataResults = JSON.parse(dataResult);
			// if(dataResults.result == 1){
				
				// $('#notif').html(dataResults.msg);
				// $('#deskripsi').val(dataResults.name);
				// $('#table').load(' #table');
				// $('#load-total').load(' #load-total');
				// $('#sku').val("");
					
			// }else{
				
				
				// $('#notif').html(dataResults.msg);
			// }
			
		// }
	// });
	

  // }
// });



function filtertable(){
		var desk = $('#deskripsi').val();

           $('#idTableItemList').DataTable({
              "processing": true,
              "serverSide": true,
			  "destroy": true,
			  "searching": false,
              "ajax":{
                       "url": "api/action.php?modul=product&act=list",
                       "dataType": "json",
                       "type": "POST",
					   "data": {
						   "desk":desk
					   }
                     },
              "columns": [
                  { "data": "sku" },
                  { "data": "barcode" },
                  { "data": "shortcut" },
				  { "data": "description" },
                  { "data": "stockqty" },
				  { "data": "price" },
              ]  
 
          });
}
filtertable();
UpDown();


function cekVersion(){
	
	$.ajax({
		url: "api/cek_version.php",
		type: "GET",
		beforeSend: function(){
	
			$('#notif1').html("<font style='color: red'>Sedang mengecek version..</font>");
		},
		success: function(dataResult){
			// console.log(dataResult);
			var dataResults = JSON.parse(dataResult);
			if(dataResults.result=='1'){
				$('#notif1').html("<font style='color: green'>Version up to date (ver "+dataResults.version+") <a target=_blank href='https://idolmart.co.id/live/pi/doc_pi.php'>Link update</a></font>");
				$(':input[type="submit"]').prop('disabled', false);
			}else{
				
				if(dataResults.version === null){
					var msg = "<font style='color: red'>Periksa koneksi internet dan ERP</font>";
					
				}else{
					
					var msg = "<font style='color: red'>Versi belum update, silahkan update dulu ke ver "+dataResults.version+"</font>";
					
				}
				
				$('#notif1').html(msg+" <a target=_blank href='https://idolmart.co.id/live/pi/doc_pi.php'>Link update</a>");
				// $(':input[type="submit"]').prop('disabled', true);
			}
			// else {
				// $('#notif').html(dataResult.msg);
			// }
			
		}
	});
	
}
// load_table();
// function load_table(){
	
	// var desk = $('#deskripsi').val();
	
	// $.ajax({
		// url: "api/action.php?modul=product&act=show",
		// type: "POST",
		// data : {desk: desk},
		// beforeSend: function(){
			// $('#sync').prop('disabled', true);
			// $('#notif1').html("<font style='color: red'>Sedang melakukan sync, mohon tunggu..</font>");
		// },
		// success: function(dataResult){
			// console.log(dataResult);
			// document.querySelector('#idTableItemList > tbody').innerHTML = dataResult;
		// }
	// });
	
// }

function syncUser(){
	

	
	$.ajax({
		url: "api/register.php",
		type: "GET",
		beforeSend: function(){
			$('#sync').prop('disabled', true);
			$('#notif1').html("<font style='color: red'>Sedang melakukan sync, mohon tunggu..</font>");
		},
		success: function(dataResult){
			// console.log(dataResult);
			var dataResults = JSON.parse(dataResult);
			if(dataResults.result=='1'){
				$('#notif1').html("<font style='color: green'>"+dataResults.msg+"</font>");
				$("#example").load(" #example");
			}else{
				
				$('#notif1').html("<font style='color: green'>"+dataResult+"</font>");
				
			}
			// else {
				// $('#notif').html(dataResult.msg);
			// }
			
		}
	});
	
}



function UpDown(){
	var addEvent = (function( window, document ) {
    if ( document.addEventListener ) {
        return function( elem, type, cb ) {
            if ( (elem && !elem.length) || elem === window ) {
                elem.addEventListener(type, cb, false );
            }
            else if ( elem && elem.length ) {
                var len = elem.length;
                for ( var i = 0; i < len; i++ ) {
                    addEvent( elem[i], type, cb );
                }
            }
        };
    }
    else if ( document.attachEvent ) {
        return function ( elem, type, cb ) {
            if ( (elem && !elem.length) || elem === window ) {
                elem.attachEvent( 'on' + type, function() { return cb.call(elem, window.event) } );
            }
            else if ( elem.length ) {
                var len = elem.length;
                for ( var i = 0; i < len; i++ ) {
                    addEvent( elem[i], type, cb );
                }
            }
        };
    }
})( this, document );

//derived from: http://stackoverflow.com/a/10924150/402706
function getpreviousSibling(element) {
    var p = element;
    do p = p.previousSibling;
    while (p && p.nodeType != 1);
    return p;
}

//derived from: http://stackoverflow.com/a/10924150/402706
function getnextSibling(element) {
    var p = element;
    do p = p.nextSibling;
    while (p && p.nodeType != 1);
    return p;
};

(function() {
    var trows = document.getElementById("table").rows;

    for (var t = 1; t < trows.length; ++t) {
        trow = trows[t];
        trow.className = "normal";
        trow.onclick = highlightRow;
    }//end for

    function highlightRow() {
        for ( var t = 1; t < trows.length; ++t ) {
            trow = trows[t];
            if (trow != this) { trow.className = "normal" }
        }//end for
        
        this.className = (this.className == "highlighted")?"normal":"highlighted";
    }//end function
    
    addEvent(document.getElementById('table'), 'keydown', function(e){
        var key = e.keyCode || e.which;

        if((key === 38 || key === 40) && !e.shiftKey && !e.metaKey && !e.ctrlKey && !e.altKey){
        
            var highlightedRows = document.querySelectorAll('.highlighted'); 
            
            if(highlightedRows.length > 0){
                
                var highlightedRow = highlightedRows[0];
                
                var prev = getpreviousSibling(highlightedRow); 
                var next = getnextSibling(highlightedRow); 
                
                if(key === 38 && prev && prev.nodeName === highlightedRow.nodeName){//up
                    highlightedRow.className = 'normal';
                    prev.className = 'highlighted';
                } else if(key === 40 && next && next.nodeName === highlightedRow.nodeName){ //down
                    highlightedRow.className = 'normal';
                    next.className = 'highlighted';
                }
				
				
                
            }
        }
        
    });


})();//end script

	
	
}





</script>
   
   
</body>
</html>