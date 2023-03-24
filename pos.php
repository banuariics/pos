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


	<table style="width: 100%" id="load_struk">
		<tr>
			<td>Struk Temp</td>
			<td> : </td>
			<td>
			
			
			<?php 
			function toBase($num, $b=62) {
				$base='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
				$r = $num  % $b ;
				$res = $base[$r];
				$q = floor($num/$b);
				while ($q) {
					$r = $q % $b;
					$q =floor($q/$b);
					$res = $base[$r].$res;
				}
				return $res;
			}
			
			
			$lastcount = $connec->query("select count(*) jum from pos_dsales_new where date(insertdate) = date(now())");
			foreach($lastcount as $rrr){
				
				$jum_last = $rrr['jum'] + 1;
				
			}
			
			
			$bilangan=$jum_last; // Nilai Proses
			$fzeropadded = sprintf("%04d", $bilangan);
			
			$bill_no = $store_code.'-'.date('ymd').$fzeropadded;
			$bill_code = strtoupper($store_code.'-'.toBase(date('ymd').$fzeropadded));
			
			echo $bill_no;
			
			?>
			
			
			
			</td>
			
			
			
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
					<tr style="background-color: #609966; color: #fff;position: sticky;top: 0; /* Don't forget this, required for the stickiness */ ">
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
							<input type="text" class="form-control" id="sku" autofocus autocomplete="off" />
						</div>
						<div class="col-4">
							<label for="idNamaMember" style="font-size:13px;">Deskripsi</label>
							<input type="text" class="form-control input-element" id="deskripsi" onchange="cari_barang();" autocomplete="off" />
							
							<div style="width: 0;overflow: hidden;">
							<input type="text" class="form-control input-element1" id="deskripsi1" autocomplete="off" />
							</div>
						</div>	
						<div class="col-4">
							<label for="idNamaMember" style="font-size:13px;">QTY</label>
							<input type="number" class="form-control" id="qty" value="1" onfocus="this.select();" onmouseup="return false;" autocomplete="off" />
						</div>				
	
										
					</div>
			
			<br>
			
			<div id="results" class="scrollingdatagrid cLoadDataItem">
			
			<table border="1" style="background-color:#fff;width: 100%; overflow:auto; height: 110px; color: #000" class="table1 table-bordered table-striped table_product" id="idTableItemList">
				<thead>
					<tr style="background-color: #609966; color: #fff">
						<th>SKU</th>
						<th>Barcode</th>
						<th>Shortcut</th>
						<th>Deskripsi</th>
						<th>Stock</th>
						<th>Harga</th>
						<th>Diskon</th>
						<th>Nama Diskon</th>
					</tr>
				</thead>
				<tbody>  

				
				
				</tbody>
			</table>
			
			
			</div>
			</div>
			<div class="col-4">
				<div class="col-12 p-2 mb-1" style="background-color:black; color: #fff; text-transform: uppercase;"><font id="notif">NOTIF SECTION</font>	<font style="float:right" id="online"></font></div>
				
				
				
				
				
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
									<text style="font-size:10px;font-weight:bold;color:#fff">CLOSE (ESC)</text>
									</a>
								</center>
								
							</media>						
						</div>

						<div class="col-12 m-2"></div>						
						
						<div class="col-12" style="background-color: #fff">
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

									<?php 
									$listpending = $connec->query("select * from temp_sale where nomor is not null and kasir = '".$_SESSION['username']."' group by nomor");
									foreach($listpending as $rr){ ?>
										<td style="font-size:12px;text-align:center;">TEMP#<?php echo $rr['nomor']; ?></td>
										<td style="font-size:12px;text-align:center;">-</td>		
									
									<?php } ?>

								
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
   <div class="col-12">
							<center><h5>METODE PEMBAYARAN</h5></center>
						</div>
   <button id="tunai" style="width: 100%; height: 100px; background-color: #0081B4; color: #fff; font-size: 30px;cursor: pointer" onclick="tunai();">Tunai</button><br>
   <button style="width: 100%; height: 100px; background-color: #4E6C50; color: #fff; font-size: 30px;cursor: pointer" onclick="debit();">Non Tunai</button><br>
  <!-- <button style="width: 100%; height: 100px; background-color: #4E6C50; color: #fff; font-size: 30px;cursor: pointer" onclick="kredit();">Kredit</button><br>-->
   
   
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
							<input type="text" class="form-control cash" id="infak" value="0" onkeyup="cekKembalian();"/>						
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
		
		<div class="col-12" id="preview_reprint">
			
		</div>
		
		<div class="col-12">
			<button class="btn btn-primary" onclick="reprint();"  style="width: 100%">Reprint</button>
		</div>	
						
	</div>
  </div>

</div>





<div id="myModalDebit" class="modal" >

  <!-- Modal content -->
  <div class="modal-content" style="width: 30%; z-index: 999">
    <span class="close">&times;</span>
   
	
					<div class="row">
						<div class="col-12">
							<center><h3>PEMBAYARAN NON TUNAI</h3></center>
						</div>
						
						<div class="col-12" >
							<h3>Total <font style="float: right" id="total_debit"></font></h3>
							
						</div>
						
						
						<div class="col-6">
							<label for="idNoMember" style="font-size:13px;">Cara Bayar</label>
							
							<select class="form-select" id="cara_bayar" onchange="caraBayar();">
								<option value="debit">Debit</option>
								<option value="kredit">Kredit</option>
							</select>
							
							
						</div>
						<div class="col-6">
							<label for="idNoMember" style="font-size:13px;">Redeem point</label>
							<input type="text" class="form-control" id="redeem_debit" readonly />
						</div>
						<!--<div class="col-6">
							<label for="idNamaMember" style="font-size:13px;">Total harus dibayar</label>
							<input type="text" class="form-control" id="total_debit" readonly />
						</div>-->
						<div class="col-6">
							<label for="idNoMember" style="font-size:13px;">Bayar Non Cash</label>
							<input type="text" class="form-control cash" id="debit" onfocus="this.select();" onmouseup="return false;" autocomplete="off" onkeyup="cekKembalianDebit();" />
						</div>
						<div class="col-6">
							<label for="idKodePromo" style="font-size:13px;">Sisa Harus dibayar</label>
							<input type="text" class="form-control cash" id="sisa_debit" readonly />						
						</div>	
						<div class="col-6">
							<label for="idKodePromo" style="font-size:13px;">Nama EDC</label>
							<select class="form-select" id="mesin_edc"></select>
						</div>			
						
						
						<div class="col-6">
							<label for="idKodePromo" style="font-size:13px;">Bank</label>
							<select class="form-select" id="nama_bank_debit"></select>			
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
							<label for="idKodePromo" style="font-size:13px;">Uang Diterima</label>
							<input type="text" class="form-control cash" value="0" onfocus="this.select();" onmouseup="return false;" autocomplete="off" id="uang_debit" onkeyup="cekKembalianDebit();"/>						
						</div>

						<div class="col-6">
							<label for="idNoMember" style="font-size:13px;">Infak</label>
							<input type="text" class="form-control cash" id="infak_debit" onfocus="this.select();" onmouseup="return false;" autocomplete="off" value="0" onkeyup="cekKembalianDebit();" />
						</div>						

						<div class="col-12">
						<br>
						<br>
							<center><h5>KEMBALI</h5></center><br>
							<center><h1 id="kembalian_debit">0</h1></center>
						</div>	
						
						<div class="col-12">
							<button class="btn btn-primary" id="btn-order-debit" style="display:none" onclick="submitOrderDebit();">Submit</button>
						</div>	
						
					</div>
   
  </div>

</div>


<div id="myModalRefund" class="modal">

  <!-- Modal content -->
  <div class="modal-content" style="width: 50%">
    <span class="close">&times;</span>
	
	<div class="row">
		<div class="col-12">
			<center><h5>REFUND</h5></center>
		</div>
		<div class="col-12">
			<label for="idNoMember" style="font-size:13px;">Nomor Struk</label>
			<input type="text" class="form-control" id="no_struk_refund" style="width: 100%; margin-bottom: 10px" />
		</div>
			<div class="col-12">
		<table tabindex='0' cellspacing="0" border="1" style="background-color:#fff;width: 100%; color: #000" class="table1 table-bordered table-striped" id="tableRefund">
				<thead>
					<tr style="background-color: #609966; color: #fff">
						<th>SKU</th>
						<th>Nama Items</th>
						<th>Jumlah</th>
						<th>Harga</th>
						<th>Discount</th>
						<th>Total</th>
					</tr>
				</thead>
				<tbody>  

					
					

				
				</tbody>
			</table>
		
		</div>
		<br>
		<br>
		<div class="col-12">
			<label for="idNoMember" style="font-size:13px;">Refund QTY</label>
			<input type="text" class="form-control" id="refund_qty" style="width: 100%; margin-bottom: 10px" />
			<input type="text" class="form-control" id="refund_sku" style="width: 100%; margin-bottom: 10px" readonly />
		</div>
		
		
		<div class="col-12">
			<button class="btn btn-primary" onclick="refund();"  style="width: 100%">Submit</button>
		</div>	
						
	</div>
  </div>

</div>




<div id="myModalPromo" class="modal">

  <!-- Modal content -->
  <div class="modal-content" style="width: 30%">
    <span class="close">&times;</span>
   <div class="col-12">
	<center><h5>Pilih Promo</h5></center>
						</div>
   <button id="reguler_promo" style="width: 100%; height: 100px; background-color: #0081B4; color: #fff; font-size: 30px;cursor: pointer" onclick="reguler_promo();">Reguler Promo</button><br>
   <button style="width: 100%; height: 100px; background-color: #4E6C50; color: #fff; font-size: 30px;cursor: pointer" onclick="member_promo();">Member Promo</button><br>
   <button style="width: 100%; height: 100px; background-color: #E21818; color: #fff; font-size: 30px;cursor: pointer" onclick="murah_promo();">Tebus Murah</button><br>
   
   
  </div>

</div>

<div id="myModalPromoReguler" class="modal">

  <!-- Modal content -->
  <div class="modal-content" style="width: 50%">
    <span class="close">&times;</span>
	
	<div class="row">
		<div class="col-12">
			<center><h5>ITEMS PROMO REGULER</h5></center>
		</div>
	
			<div class="col-12">
				<table tabindex='0' cellspacing="0" border="1" style="background-color:#fff;width: 100%; color: #000" class="table1 table-bordered table-striped" id="tablePromoReguler">
						<thead>
							<tr style="background-color: #609966; color: #fff">
								<th>SKU</th>
								<th>Nama Items</th>
								<th>Harga Normal</th>
								<th>Potongan</th>
								<th>Harga Promo</th>
								<th>Nama Diskon</th>
							</tr>
						</thead>
						<tbody>  
		
							
							
		
						
						</tbody>
			</table>
		
		</div>
	

	</div>
  </div>

</div>

<div id="myModalPromoMember" class="modal">

  <!-- Modal content -->
  <div class="modal-content" style="width: 50%">
    <span class="close">&times;</span>
	
	<div class="row">
		<div class="col-12">
			<center><h5>ITEMS PROMO MEMBER</h5></center>
		</div>
	
			<div class="col-12">
				<table tabindex='0' cellspacing="0" border="1" style="background-color:#fff;width: 100%; color: #000" class="table1 table-bordered table-striped" id="tablePromoMember">
						<thead>
							<tr style="background-color: #609966; color: #fff">
								<th>SKU</th>
								<th>Nama Items</th>
								<th>Harga Normal</th>
								<th>Potongan</th>
								<th>Harga Promo</th>
								<th>Nama Diskon</th>
							</tr>
						</thead>
						<tbody>  
		
							
							
		
						
						</tbody>
			</table>
		
		</div>
	

	</div>
  </div>

</div>

<div id="myModalPromoMurah" class="modal">

  <!-- Modal content -->
  <div class="modal-content" style="width: 50%">
    <span class="close">&times;</span>
	
	<div class="row">
		<div class="col-12">
			<center><h5>ITEMS PROMO MURAH</h5></center>
		</div>
	
			<div class="col-12">
				<table tabindex='0' cellspacing="0" border="1" style="background-color:#fff;width: 100%; color: #000" class="table1 table-bordered table-striped" id="tablePromoMurah">
						<thead>
							<tr style="background-color: #609966; color: #fff">
								<th>SKU</th>
								<th>Nama Items</th>
								<th>Harga Normal</th>
								<th>Potongan</th>
								<th>Harga Promo</th>
								<th>Nama Diskon</th>
							</tr>
						</thead>
						<tbody>  
		
							
							
		
						
						</tbody>
			</table>
		
		</div>
	

	</div>
  </div>

</div>



<div id="myModalKredit" class="modal" >

  <!-- Modal content -->
  <div class="modal-content" style="width: 30%; z-index: 999">
    <span class="close">&times;</span>
   
	
					<div class="row">
						<div class="col-12">
							<center><h5>PEMBAYARAN KREDIT</h5></center>
						</div>
						<div class="col-12">
							<label for="idNamaMember" style="font-size:13px;">Total harus dibayar</label>
							<input type="text" class="form-control" id="total_kredit" readonly />
						</div>
						<div class="col-6">
							<label for="idNoMember" style="font-size:13px;">No Kredit Card</label>
							<input type="text" class="form-control" id="no_kredit" />
						</div>
						<div class="col-6">
							<label for="idNamaMember" style="font-size:13px;">Approve Code</label>
							<input type="text" class="form-control" id="approve_code_kredit" />
						</div>
						<div class="col-6">
							<label for="idKodePromo" style="font-size:13px;">Mesin EDC</label>
							<input type="text" class="form-control" id="mesin_edc_kredit" />						
						</div>			
						<div class="col-6">
							<label for="idKodePromo" style="font-size:13px;">Nama Bank</label>
							<input type="text" class="form-control" id="nama_bank_kredit" />						
						</div>	
					
						<br>
						<br>
						<br>
							
						
						<div class="col-12">
							<button class="btn btn-primary" onclick="submitOrderKredit();">Submit</button>
						</div>	
						
					</div>
   
  </div>

</div>




<div id="myModalPending" class="modal">

  <!-- Modal content -->
  <div class="modal-content" style="width: 30%">
    <span class="close">&times;</span>
	
	<div class="row">
		<div class="col-12">
			<center><h5>Apakah anda yakin pending transaksi ?</h5></center>
		</div>
		<div class="col-12">
			<button class="btn btn-primary" id="pending_ok" onclick="pending();" style="width: 100%">Yakin</button>
		</div>	
						
	</div>
   
   <!--<button style="width: 100%; height: 100px; background-color: #0081B4; color: #fff; font-size: 30px;cursor: pointer" onclick="tunai();">Saldo Awal</button><br>
   <button style="width: 100%; height: 100px; background-color: #0081B4; color: #fff; font-size: 30px;cursor: pointer" onclick="syncProduct();">Tutup Kasir</button><br>
   <button style="width: 100%; height: 100px; background-color: #0081B4; color: #fff; font-size: 30px;cursor: pointer" onclick="syncProduct();">Tutup Harian</button>-->
   
   
  </div>

</div>


<div id="myModalVoid" class="modal">

  <!-- Modal content -->
  <div class="modal-content" style="width: 30%">
    <span class="close">&times;</span>
	
	<div class="row">
		<div class="col-12">
			<center><h5>PASSWORD ACCESS</h5></center>
		</div>
		<div class="col-6">
			<label for="idNoMember" style="font-size:13px;">Supervisor</label>
			<select class="form-select" id="spv" style="width: 100%; margin-bottom: 10px">
				
			
			</select>
			
		</div>
		
		<div class="col-6">
			<label for="idNoMember" style="font-size:13px;">Sandi</label>
			<input type="text" class="form-control" id="sandi" style="width: 100%; margin-bottom: 10px" readonly />
		</div>
		
		<div class="col-12">
			<label for="idNoMember" style="font-size:13px;">Password</label>
			<input type="text" class="form-control" id="password_void" style="width: 100%; margin-bottom: 10px" />
		</div>	
						
		
		<div class="col-12">
			<button class="btn btn-primary" onclick="void();"  style="width: 100%">Submit</button>
		</div>	
						
	</div>
  </div>

</div>





   <script src="styles/js/bootstrap.js"> </script>
   <script src="styles/js/jquery.dataTables.min.js"></script>
   <script src="styles/js/dataTables.bootstrap5.min.js"></script>
   <script src="styles/js/shortcut.js"></script>
   <script src="styles/js/separator.js"></script>
   <script src="styles/js/index.js?id=<?php echo date('ydmHis'); ?>"></script>
   
</body>
</html>