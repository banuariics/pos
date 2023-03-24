<?php session_start();
include "../config/koneksi.php";
ini_set('max_execution_time', '4000');
if(isset($_SESSION['username']) && !empty($_SESSION['username'])) {
  
}else{
	$json = array('result'=>'3', 'msg'=>'Session telah habis, reload dulu halamannya');	
	
	// header("Location: ../index.php");
}

$store_code = "";
$org_id = "";
$ad_muser_key = $_SESSION['ad_muser_key'];
$userid = $_SESSION['userid'];
$username = $_SESSION['username'];
$getkode = $connec->query("select * from m_profile limit 1");
foreach($getkode as $gk){
	
	$store_code = $gk['storecode'];
	$org_id = $gk['storeid'];
	$alamat = $gk['alamat'];
	$alamat1 = $gk['alamat1'];
	$kota = $gk['kota'];
	$brand = $gk['brand'];
	$footer1 = $gk['footer1'];
	$footer2 = $gk['footer2'];
	$footer3 = $gk['footer3'];
	
}

$no_struk_cook = $store_code.'-'.date('YmdHis');




function guid(){
	return str_replace("-","",sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
		mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
		mt_rand( 0, 0xffff ),
		mt_rand( 0, 0x0fff ) | 0x4000,
		mt_rand( 0, 0x3fff ) | 0x8000,
		mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
	));
}
function rupiah($angka){
	
	$hasil_rupiah = number_format($angka,0,',','.');
	return $hasil_rupiah;
 
}

function get_data_stock_all($a){
						    
	// $fields_string = http_build_query($postData);
	$curl = curl_init();

	curl_setopt_array($curl, array(
	CURLOPT_URL => 'https://newpos.idolmartidolaku.com/pos-api/sync-product?org='.$a,
	//CURLOPT_URL => 'https://pi.idolmartidolaku.com/api/action.php?modul=inventory&act=sync_pos_fix_new&org='.$a,
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => '',
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 0,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => 'GET',
	// CURLOPT_POSTFIELDS => $postData,
	CURLOPT_HTTPHEADER => array(
		'Authorization: Basic YmFudToxMjM0NTY='
	)
	));
	
	$response = curl_exec($curl);
	
	curl_close($curl);
	return $response;
					
					
}

function get_data_edc(){
						    
	// $fields_string = http_build_query($postData);
	$curl = curl_init();

	curl_setopt_array($curl, array(
	CURLOPT_URL => 'https://newpos.idolmartidolaku.com/pos-api/sync-edc-bank',
	//CURLOPT_URL => 'https://pi.idolmartidolaku.com/api/action.php?modul=inventory&act=sync_pos_fix_new&org='.$a,
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => '',
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 0,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => 'GET',
	// CURLOPT_POSTFIELDS => $postData,
	CURLOPT_HTTPHEADER => array(
		'Authorization: Basic YmFudToxMjM0NTY='
	)
	));
	
	$response = curl_exec($curl);
	
	curl_close($curl);
	return $response;
					
					
}


function get_data_member(){
						    
	// $fields_string = http_build_query($postData);
	$curl = curl_init();

	curl_setopt_array($curl, array(
	CURLOPT_URL => 'https://newpos.idolmartidolaku.com/pos-api/sync-member',
	//CURLOPT_URL => 'https://pi.idolmartidolaku.com/api/action.php?modul=inventory&act=sync_pos_fix_new&org='.$a,
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => '',
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 0,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => 'GET',
	// CURLOPT_POSTFIELDS => $postData,
	CURLOPT_HTTPHEADER => array(
		'Authorization: Basic YmFudToxMjM0NTY='
	)
	));
	
	$response = curl_exec($curl);
	
	curl_close($curl);
	return $response;
					
					
}


function get_data_promo($org_id){
	
	$curl = curl_init();

	curl_setopt_array($curl, array(
	CURLOPT_URL => "https://pi.idolmartidolaku.com/api/action.php?modul=inventory&act=sync_promo&org_id=".$org_id,
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => '',
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 0,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => 'GET',
	));
	
	$response = curl_exec($curl);
	
	curl_close($curl);
	return $response;
	
	
}
function get_data_promo_code($org_id){
	
	$curl = curl_init();

	curl_setopt_array($curl, array(
	CURLOPT_URL => "https://pi.idolmartidolaku.com/api/action.php?modul=inventory&act=sync_promo_code&org_id=".$org_id,
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => '',
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 0,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => 'GET',
	));
	
	$response = curl_exec($curl);
	
	curl_close($curl);
	return $response;
	
	
}

function get_data_promo_tebus($org_id){
	
	$curl = curl_init();

	curl_setopt_array($curl, array(
	CURLOPT_URL => "https://pi.idolmartidolaku.com/api/action.php?modul=inventory&act=sync_promo_tebus&org_id=".$org_id,
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => '',
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 0,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => 'GET',
	));
	
	$response = curl_exec($curl);
	
	curl_close($curl);
	return $response;
	
	
}
function get_data_cat(){
						    
	// $fields_string = http_build_query($postData);
	$curl = curl_init();

	curl_setopt_array($curl, array(
	CURLOPT_URL => "https://newpos.idolmartidolaku.com/pos-api/sync-category",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => '',
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 0,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => 'GET',
	// CURLOPT_POSTFIELDS => $postData,
	CURLOPT_HTTPHEADER => array(
		'Authorization: Basic YmFudToxMjM0NTY='
	)
	));
	
	$response = curl_exec($curl);
	
	curl_close($curl);
	return $response;
					
					
}



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
if($_GET['modul'] == 'users'){
	if($_GET['act'] == 'buka_kasir'){
		
		$nominal_awal = str_replace(',','',$_POST['nominal_awal']);
		$tot = $connec->query("select * from pos_dcashierbalance where insertby = '".$_SESSION['userid']."' and date(insertdate) = date(now())");
		$jum = $tot->rowCount();
		
		if($jum > 0){
			$json_data = array("result"=>0,"msg"=>'Saldo awal sudah ada, silahkan reprint ');
			
		}else{
			
			$id = guid();
			$sql_sales = "INSERT INTO pos_dcashierbalance
			(pos_dcashierbalance_key, ad_mclient_key, ad_morg_key, isactived, insertdate, insertby, postby, postdate, pos_mcashier_key, ad_muser_key, pos_mshift_key, startdate, enddate, balanceamount, salesamount, status, salescashamount, salesdebitamount, salescreditamount, actualamount, issync, refundamount, discountamount, cancelcount, cancelamount, donasiamount, pointamount, pointdebitamout, pointcreditamount, variantmin, variantplus, paycash, keterangan)
			VALUES('".$id."', 'D089DFFA729F4A22816BD8838AB0813C', '".$org_id."', '1', '".date('Y-m-d H:i:s')."', '".$userid."', '".$userid."', '".date('Y-m-d H:i:s')."', NULL, NULL, 'f1115683c3dc49bd83dda7e676820651', '".date('Y-m-d H:i:s')."', NULL, 
			'".$nominal_awal."', NULL, 'RUNNING', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);";
			
			$stmt = $connec->prepare($sql_sales);
			$stmt->execute();
			$affected_rows = $stmt->rowCount();
			if ($affected_rows > 0) {
				$json_data = array("result"=>1,"msg"=>'Berhasil insert sales',"id"=> $id);
			}else{
				$json_data = array("result"=>0,"msg"=>'Berhasil insert sales',"id"=> $id);
			}
			
		}

		echo json_encode($json_data); 
	}else if($_GET['act'] == 'tutup_kasir'){
		
		$m_tot_debit = 0;
		$m_tot_cash = 0;
		$m_penjualan_bersih = 0;
		$m_infak = 0;
		$jum_refund = 0;
		$jum_discount = 0;
		$total_cash = str_replace(',','',$_POST['total_cash']);
		$donasiamount = 0;
		
		
		
		$penjualan_debit = $connec->query("select coalesce(sum(billamount),0) as billamount, coalesce(sum(donasiamount),0) as donasiamount from pos_dsales_new where ad_muser_key = '".$_SESSION['userid']."' and date(insertdate) = date(now()) 
		and paymentmethodname in ('debit')");
		foreach($penjualan_debit as $r){
			$m_tot_debit 		= $r['billamount'];
			$donasiamount 		= $r['donasiamount'];
		}
		
		$penjualan_credit = $connec->query("select coalesce(sum(billamount),0) as billamount, coalesce(sum(donasiamount),0) as donasiamount from pos_dsales_new where ad_muser_key = '".$_SESSION['userid']."' and date(insertdate) = date(now()) 
		and paymentmethodname in ('kredit')");
		foreach($penjualan_credit as $r){
			$m_tot_credit 		= $r['billamount'];
		}
		
		$penjualan_cash = $connec->query("select coalesce(sum(billamount),0) as billamount, coalesce(sum(donasiamount),0) as donasiamount from pos_dsales_new where ad_muser_key = '".$_SESSION['userid']."' and date(insertdate) = date(now()) 
		and paymentmethodname in ('CASH')");
		foreach($penjualan_cash as $r){
			$m_tot_cash 		= $r['billamount'];
		}
		
		$diskon = $connec->query("select sum(qty * price) jum_all, sum(discount * qty) jum_diskon from pos_dsalesline where insertby = '".$_SESSION['username']."' and date(insertdate) = date(now())");
		foreach($diskon as $r){
			$jum_all 			= $r['jum_all'];
			$jum_discount 		= $r['jum_diskon'];
		}
		
		
		$penjualan = $connec->query("select sum(billamount) as billamount, coalesce(sum(donasiamount),0) as donasiamount from pos_dsales_new where ad_muser_key = '".$_SESSION['userid']."' and date(insertdate) = date(now())");
		foreach($penjualan as $r){
			$m_penjualan_bersih = $r['billamount'];
			$m_infak 			= $r['donasiamount'];
		}
		
		$refund = $connec->query("select coalesce((sum(qty * price) - sum(qty * discount)),0) jum_refund from pos_dsalesline where insertby = '".$_SESSION['username']."' and date(insertdate) = date(now()) and qty < 0");
		foreach($penjualan as $r){
			$jum_refund = $r['jum_refund'];
		
		}
		
		
		$selisih = $total_cash - $m_tot_cash;
		
		if($selisih < 0){
			
			$q_selisih = " variantmin = '".$selisih."', variantplus = '0'";
			
		}else{
			
			$q_selisih = " variantplus = '".$selisih."', variantmin = '0'";
		}
		
		
		$sql ="UPDATE pos_dcashierbalance set salesamount = '".$m_penjualan_bersih."', 
		salescashamount = '".$m_tot_cash."',
		salesdebitamount = '".$m_tot_debit."',
		salescreditamount = '".$m_tot_credit."',
		refundamount = '".$jum_refund."',
		discountamount = '".$jum_discount."',
		donasiamount = '".$donasiamount."',
		actualamount = '".$total_cash."',
		".$q_selisih."
		WHERE insertby ='".$_SESSION['userid']."' and date(insertdate) = date(now())";
		// echo $sql;
		$up =  $connec->query($sql);
		
		if($up){
			
			$json_data = array(
					"result"=>1,
					"msg"=>'Berhasil update',
		  
				);
		}else{
			$json_data = array(
					"result"=>0,
					"msg"=>'Gagal update',
		  
				);
			
		}
				
		echo json_encode($json_data); 
	}else if($_GET['act'] == 'tutup_harian'){
		
		$m_tot_debit = 0;
		$m_tot_cash = 0;
		$m_penjualan_bersih = 0;
		$m_infak = 0;
		$jum_refund = 0;
		$jum_discount = 0;
		// $total_cash = str_replace(',','',$_POST['total_cash']);
		$donasiamount = 0;
		$total_cash = 0;
		$notes_tutup_harian = "";
		
		$actualamount = 0;
		$refundamount = 0;
		$discountamount = 0;
		$donasiamount = 0;
		$variantmin = 0;
		$variantplus = 0;
		
		$penjualan_debit = $connec->query("select coalesce(sum(billamount),0) as billamount, coalesce(sum(donasiamount),0) as donasiamount from pos_dsales_new where ad_muser_key = '".$_SESSION['userid']."' and date(insertdate) = date(now()) 
		and paymentmethodname in ('debit')");
		foreach($penjualan_debit as $r){
			$m_tot_debit 		= $r['billamount'];
			$donasiamount 		= $r['donasiamount'];
		}
		
		$penjualan_credit = $connec->query("select coalesce(sum(billamount),0) as billamount, coalesce(sum(donasiamount),0) as donasiamount from pos_dsales_new where ad_muser_key = '".$_SESSION['userid']."' and date(insertdate) = date(now()) 
		and paymentmethodname in ('kredit')");
		foreach($penjualan_credit as $r){
			$m_tot_credit 		= $r['billamount'];
		}
		
		$penjualan_cash = $connec->query("select coalesce(sum(billamount),0) as billamount, coalesce(sum(donasiamount),0) as donasiamount from pos_dsales_new where ad_muser_key = '".$_SESSION['userid']."' and date(insertdate) = date(now()) 
		and paymentmethodname in ('CASH')");
		foreach($penjualan_cash as $r){
			$m_tot_cash 		= $r['billamount'];
		}
		
		$diskon = $connec->query("select sum(qty * price) jum_all, sum(discount * qty) jum_diskon from pos_dsalesline where insertby = '".$_SESSION['username']."' and date(insertdate) = date(now())");
		foreach($diskon as $r){
			$jum_all 			= $r['jum_all'];
			$jum_discount 		= $r['jum_diskon'];
		}
		
		
		$penjualan = $connec->query("select sum(billamount) as billamount, coalesce(sum(donasiamount),0) as donasiamount from pos_dsales_new where ad_muser_key = '".$_SESSION['userid']."' and date(insertdate) = date(now())");
		foreach($penjualan as $r){
			$m_penjualan_bersih = $r['billamount'];
			$m_infak 		   = $r['donasiamount'];
		}
		
		$refund = $connec->query("select coalesce((sum(qty * price) - sum(qty * discount)),0) jum_refund from pos_dsalesline where insertby = '".$_SESSION['username']."' and date(insertdate) = date(now()) and qty < 0");
		foreach($penjualan as $r){
			$jum_refund = $r['jum_refund'];
		
		}
		
		$cashier = $connec->query("select sum(actualamount) as actualamount, sum(refundamount) as refundamount, sum(discountamount) as discountamount, sum(donasiamount) as donasiamount,
		sum(variantmin) as variantmin, sum(variantplus) as variantplus
		from pos_dcashierbalance where date(insertdate) = date(now())");
		foreach($cashier as $r){
			$actualamount = $r['actualamount'];
			$refundamount = $r['refundamount'];
			$discountamount = $r['discountamount'];
			$donasiamount = $r['donasiamount'];
			$variantmin = $r['variantmin'];
			$variantplus = $r['variantplus'];
		
		}
		
		

		
		$sql ="INSERT INTO pos_dshopsales
(pos_dshopsales_key, ad_mclient_key, ad_morg_key, isactived, insertdate, insertby, postby, postdate, pos_mshift_key, ad_muser_key, 
salesdate, closedate, balanceamount, salesamount, salescashamount, salesdebitamount, salescreditamount, status, actualamount, remark, issync, refundamount, 
discountamount, cancelcount, cancelamount, donasiamount, variantmin, variantplus, pointamount, pointdebitamout, pointcreditamount)


VALUES('".guid()."', 'D089DFFA729F4A22816BD8838AB0813C', '".$org_id."', '1', '".date('Y-m-d H:i:s')."', '".$_SESSION['username']."', '".$_SESSION['username']."', '".date('Y-m-d H:i:s')."', NULL, '".$_SESSION['userid']."', 
'".$_POST['tgl_tutup_harian']."', '".date('Y-m-d H:i:s')."', 0, '".$m_penjualan_bersih."', '".$m_tot_cash."','".$m_tot_debit."', '".$m_tot_credit."', 'DONE', '".$actualamount."', 'A', 0, '".$refundamount."', 
'".$discountamount."', 0, 0, '".$donasiamount."', '".$variantmin."', '".$variantplus."', 0, NULL, NULL);";
// echo $sql; 
		$jumm = 0;
		$cek_pos = $connec->query("select count(*) jum from pos_dshopsales where date(insertdate) = '".$_POST['tgl_tutup_harian']."'");
		foreach($cek_pos as $r){
			$jumm 		= $r['jum'];
		}
		
		if($jumm == 0){
			$jum_kasir = 0;
			$jum_kasir_sales = 0;
			$cek_kasir = $connec->query("SELECT COUNT(*) jum FROM (select count(*) jum from pos_dcashierbalance where date(insertdate) = '".$_POST['tgl_tutup_harian']."' and actualamount is not null group by insertby) AS Agg");
			foreach($cek_kasir as $r){
				$jum_kasir		= $r['jum'];
			}
			
			
			
			
			$cek_kasir_sales = $connec->query("SELECT COUNT(*) jum FROM (SELECT * FROM pos_dsales_new where date(insertdate) = '".$_POST['tgl_tutup_harian']."'  group by ad_muser_key) AS Agg");
			foreach($cek_kasir_sales as $r){
				$jum_kasir_sales		= $r['jum'];
			}
			

			if($jum_kasir < $jum_kasir_sales){
				
				$json_data = array(
					"result"=>0,
					"msg"=>'Kasir ada yg belum tutup kasir',
		  
				);
			}else{
				$up =  $connec->query($sql);
				if($up){
				
					$json_data = array(
						"result"=>1,
						"msg"=>'Berhasil update',
						"notes"=>$_POST['notes_tutup_harian'],
						"id"=>guid(),
			
					);
				}else{
					$json_data = array(
						"result"=>0,
						"msg"=>'Gagal update',
			
					);
				
				}
				
			}
			
			
			
		}else{
			
			
			$json_data = array(
					"result"=>0,
					"msg"=>'Sudah tutup harian',
		  
				);
		}
				
		echo json_encode($json_data); 
		// echo $sql; 
	}else if($_GET['act'] == 'cetak_buka_kasir'){
		
		// echo $_GET['id'];
		// echo $_GET['id'];
		$tot = $connec->query("select * from pos_dcashierbalance where pos_dcashierbalance_key = '".$_GET['id']."'");
		$jum = $tot->rowCount();
		
		if($jum > 0){
			
			foreach($tot as $r){
				$json_data = array(
					"result"=>1,
					"msg"=>'Proses cetak',
					'alamat'=>$alamat,
					'alamat1'=>$alamat1,
					'kota'=>$kota,
					'brand'=>$brand,
					'pos_dcashierbalance_key'=>$r['pos_dcashierbalance_key'],
					'insertby'=>$r['insertby'],
					'startdate'=>$r['startdate'],
					'balanceamount'=>rupiah($r['balanceamount']),
					'insertdate'=>date('Y-m-d', strtotime($r['insertdate'])),
					'inserttime'=>date('H:i:s', strtotime($r['insertdate'])),
			
				);
			}
		}else{
			$json_data = array(
				"result"=>0,
				"msg"=>'Tidak ditemukan',
		  
			);
			
		}
		

		echo json_encode($json_data); 
	}else if($_GET['act'] == 'cetak_tutup_kasir'){
		$m_penjualan 		= 0;
		$m_diskon 			= 0;
		$m_penjualan_bersih = 0;
		$m_redeem 			= 0;
		$m_tot_noncash 		= 0;
		$m_cashin_system 	= 0;
		$m_infak 			= 0;
		$m_cashin_seharusnya= 0;
		$m_cashin_drawer 	= 0;
		$m_variant 			= 0;
		$m_total_transfer 	= 0;
		$m_diskon 			= 0;
		$m_tot_cash 		= 0;
		$tot = $connec->query("select * from pos_dcashierbalance where insertby = '".$_SESSION['userid']."' and date(insertdate) = date(now())");
		$jum = $tot->rowCount();
		
		
		
		$penjualan_debit = $connec->query("select sum(billamount) as billamount, coalesce(sum(donasiamount),0) as donasiamount from pos_dsales_new where ad_muser_key = '".$_SESSION['userid']."' and date(insertdate) = date(now()) 
		and paymentmethodname in ('debit', 'kredit')");
		foreach($penjualan_debit as $r){
			$m_tot_noncash 		= $r['billamount'];
		}
		
		$penjualan_cash = $connec->query("select sum(billamount) as billamount, coalesce(sum(donasiamount),0) as donasiamount from pos_dsales_new where ad_muser_key = '".$_SESSION['userid']."' and date(insertdate) = date(now()) 
		and paymentmethodname = 'CASH'");
		foreach($penjualan_cash as $r){
			$m_tot_cash 		= $r['billamount'];
		}
		
		$diskon = $connec->query("select sum(qty * price) jum_all, sum(discount * qty) jum_diskon from pos_dsalesline where insertby = '".$_SESSION['username']."' and date(insertdate) = date(now())");
		foreach($diskon as $r){
			$jum_all 			= $r['jum_all'];
			$jum_diskon 		= $r['jum_diskon'];
		}
		
		
		$penjualan = $connec->query("select sum(billamount) as billamount, coalesce(sum(donasiamount),0) as donasiamount from pos_dsales_new where ad_muser_key = '".$_SESSION['userid']."' and date(insertdate) = date(now())");
		foreach($penjualan as $r){
			$m_penjualan_bersih = $r['billamount'];
			$m_infak 			= $r['donasiamount'];
		}
		
		
		$sales_edc = $connec->query("select edcno, sum(billamount) billamount from pos_dsales_new where date(insertdate) = date(now()) and ad_muser_key = '".$_SESSION['userid']."'
		and paymentmethodname != 'CASH'
		group by edcno;");
		foreach($sales_edc as $r){
			
			
			$line[] = array(
						'edcno'=>$r['edcno'],
						'billamount'=>rupiah($r['billamount'])
						
					);
		}
		
		
		
		
		if($jum > 0){
			
			foreach($tot as $r){
				
				if($r['variantmin'] != 0){
					
					$m_variant = $r['variantmin'];
				}else{
					
					$m_variant = $r['variantplus'];
				}
				
				$get_username = $connec->query("select * from m_pi_users where userid = '".$r['insertby']."'");
				foreach($get_username as $rr){
					
					$nama_kasir = $rr['username'];
					
				}
				$json_data = array(
					"result"=>1,
					"msg"=>'Proses cetak',
					'alamat'=>$alamat,
					'alamat1'=>$alamat1,
					'kota'=>$kota,
					'brand'=>$brand,
					'pos_dcashierbalance_key'=>$r['pos_dcashierbalance_key'],
					'insertby'=>$r['insertby'],
					'startdate'=>$r['startdate'],
					'balanceamount'=>rupiah($r['balanceamount']),
					'insertdate'=>date('Y-m-d', strtotime($r['insertdate'])),
					'inserttime'=>date('H:i:s', strtotime($r['insertdate'])),
					'startdate'=>$r['startdate'],
					'm_penjualan'=>rupiah($jum_all),	
					'm_diskon'=>rupiah($jum_diskon), 			
					'm_penjualan_bersih'=>rupiah($m_penjualan_bersih) ,
					'm_redeem'=>rupiah($m_redeem), 			
					'm_tot_noncash'=>rupiah($m_tot_noncash), 		
					'm_cashin_system'=>rupiah($m_tot_cash),	
					'm_infak'=>rupiah($m_infak), 			
					'm_cashin_seharusnya'=>rupiah($m_tot_cash + $m_infak),
					'm_cashin_drawer'=>rupiah($r['actualamount']) ,	
					'm_variant'=>rupiah($m_variant),		
			        'm_total_transfer'=>rupiah($m_total_transfer),
			        'kasir'=>$nama_kasir,
			        'line'=>$line,
					
				);
			}
		}else{
			$json_data = array(
				"result"=>0,
				"msg"=>'Tidak ditemukan',
		  
			);
			
		}
		

		echo json_encode($json_data);
	}else if($_GET['act'] == 'cetak_tutup_harian'){
		$m_penjualan 		= 0;
		$m_diskon 			= 0;
		$m_penjualan_bersih = 0;
		$m_redeem 			= 0;
		$m_tot_noncash 		= 0;
		$m_cashin_system 	= 0;
		$m_infak 			= 0;
		$m_cashin_seharusnya= 0;
		$m_cashin_drawer 	= 0;
		$m_variant 			= 0;
		$m_total_transfer 	= 0;
		$m_diskon 			= 0;
		$tot = $connec->query("select * from pos_dcashierbalance where date(insertdate) = date(now())");
		$jum = $tot->rowCount();
		
		$line = array();
		
		$penjualan_debit = $connec->query("select sum(billamount) as billamount, coalesce(sum(donasiamount),0) as donasiamount from pos_dsales_new where date(insertdate) = date(now()) 
		and paymentmethodname in ('debit', 'kredit')");
		foreach($penjualan_debit as $r){
			$m_tot_noncash 		= $r['billamount'];
		}
		
		$penjualan_cash = $connec->query("select sum(billamount) as billamount, coalesce(sum(donasiamount),0) as donasiamount from pos_dsales_new where date(insertdate) = date(now()) 
		and paymentmethodname = 'CASH'");
		foreach($penjualan_cash as $r){
			$m_tot_cash 		= $r['billamount'];
		}
		
		$diskon = $connec->query("select sum(qty * price) jum_all, sum(discount * qty) jum_diskon from pos_dsalesline where date(insertdate) = date(now())");
		foreach($diskon as $r){
			$jum_all 			= $r['jum_all'];
			$jum_diskon 		= $r['jum_diskon'];
		}
		
		
		$penjualan = $connec->query("select sum(billamount) as billamount, coalesce(sum(donasiamount),0) as donasiamount from pos_dsales_new where date(insertdate) = date(now())");
		foreach($penjualan as $r){
			$m_penjualan_bersih = $r['billamount'];
			$m_infak 			= $r['donasiamount'];
		}
		
		$sales_kat = $connec->query("select kodekat, kategori, sum(amount) amount from pos_dsalesline a left join 
		pos_m_category b on LEFT(a.sku, 3) = b.kodekat where date(insertdate) = date(now())
		group by kodekat;");
		foreach($sales_kat as $r){
			
			
			$line[] = array(
						'kodekat'=>$r['kodekat'],
						'kategori'=>$r['kategori'],
						'amount'=>rupiah($r['amount'])
						
					);
		}
		
		
		
		
		if($jum > 0){
			
			foreach($tot as $r){
				
				// if($r['variantmin'] != 0){
					
					$m_variant = $r['variantmin'];
				// }else{
					
					$m_variant_plus = $r['variantplus'];
				// }
				
				$get_username = $connec->query("select * from m_pi_users where userid = '".$r['insertby']."'");
				foreach($get_username as $rr){
					
					$nama_kasir = $rr['username'];
					
				}
				
				$json_data = array(
					"result"=>1,
					"msg"=>'Proses cetak',
					'alamat'=>$alamat,
					'alamat1'=>$alamat1,
					'kota'=>$kota,
					'brand'=>$brand,
					'pos_dcashierbalance_key'=>$r['pos_dcashierbalance_key'],
					'insertby'=>$r['insertby'],
					'startdate'=>$r['startdate'],
					'balanceamount'=>rupiah($r['balanceamount']),
					'insertdate'=>date('Y-m-d', strtotime($r['insertdate'])),
					'inserttime'=>date('H:i:s', strtotime($r['insertdate'])),
					'startdate'=>$r['startdate'],
					'm_penjualan'=>rupiah($jum_all),	
					'm_diskon'=>rupiah($jum_diskon), 			
					'm_penjualan_bersih'=>rupiah($m_penjualan_bersih) ,
					'm_redeem'=>rupiah($m_redeem), 			
					'm_tot_noncash'=>rupiah($m_tot_noncash), 		
					'm_cashin_system'=>rupiah($m_tot_cash),	
					'm_infak'=>rupiah($m_infak), 			
					'm_cashin_seharusnya'=>rupiah($m_tot_cash + $m_infak),
					'm_cashin_drawer'=>rupiah($r['actualamount']) ,	
					'm_variant'=>rupiah($m_variant),		
					'm_variant_plus'=>rupiah($m_variant_plus),		
			        'm_total_transfer'=>rupiah($m_total_transfer),
			        'kasir'=>$nama_kasir,
					'line'=>$line,
				);
			
			}
		}else{
			$json_data = array(
				"result"=>0,
				"msg"=>'Tidak ditemukan',
		  
			);
			
		}
		

		echo json_encode($json_data);
	}else if($_GET['act'] == 'reprint_buka_kasir'){
		
	
		$tot = $connec->query("select * from pos_dcashierbalance where insertby = '".$_SESSION['userid']."' and date(insertdate) = date(now())");
		$jum = $tot->rowCount();
		
		if($jum > 0){
			
			foreach($tot as $r){
				$json_data = array(
					"result"=>1,
					"msg"=>'Proses cetak',
					'alamat'=>$alamat,
					'alamat1'=>$alamat1,
					'kota'=>$kota,
					'brand'=>$brand,
					'pos_dcashierbalance_key'=>$r['pos_dcashierbalance_key'],
					'insertby'=>$r['insertby'],
					'startdate'=>$r['startdate'],
					'balanceamount'=>rupiah($r['balanceamount']),
					'insertdate'=>date('Y-m-d', strtotime($r['insertdate'])),
					'inserttime'=>date('H:i:s', strtotime($r['insertdate'])),
			
				);
			}
		}else{
			$json_data = array(
				"result"=>0,
				"msg"=>'Tidak ditemukan',
		  
			);
			
		}
		

		echo json_encode($json_data); 
	}else if($_GET['act'] == 'masuk_pos'){
		
		// echo $_GET['id'];
		// echo $_GET['id'];
		$tot = $connec->query("select * from pos_dcashierbalance where insertby = '".$_SESSION['userid']."' and date(insertdate) = date(now());");
		$jum = $tot->rowCount();
		
		if($jum > 0){
			$json_data = array("result"=>1,"msg"=>'Berhasil get sales');
			
		}else{
			$json_data = array("result"=>0,"msg"=>'Gagal get sales');
		}
		

		echo json_encode($json_data); 
	}else if($_GET['act'] == 'list_spv'){

		
				$no = 1;
				$getusers = $connec->query("select * from m_pi_users where name = 'Supervisor' and accesscode != 0");
				foreach($getusers as $r){ 

				
				
				
				
				
					echo '<option> '.$r['username'].'</option>';
				
				
				
					$no++;
				}
	}
	
}else if($_GET['modul'] == 'sales'){
	if($_GET['act'] == 'kembalian'){
		$total = 0;
		$uang = str_replace(',','',$_POST['uang']);
		$infak = str_replace(',','',$_POST['infak']);
		$tot = $connec->query("SELECT SUM(qty* (jual - diskon)) total FROM temp_sale where billno = '".$_COOKIE['bill_no']."'");
  
		foreach($tot as $rtot){
	 
			$total = $rtot['total'];
	 
		} 
		
		if($total == 0){
			
			
			
			$json_data = array("result"=>0,"msg"=>'KEMBALIAN TDK BOLEH MINUS', "kembalian"=>"0");
			
		}else{
			$kembalian = $uang - ($total + $infak);
		
			if($kembalian < 0){
				
				$json_data = array("result"=>0,"msg"=>'KEMBALIAN TDK BOLEH MINUS', "kembalian"=>$kembalian);
			}else{
				
				$json_data = array("result"=>1,"msg"=>rupiah($kembalian), "kembalian"=>$kembalian);
			}
			
		}
		
		
		
		
		

		echo json_encode($json_data); 
		
		
		
		
	
	}else if($_GET['act'] == 'kembalian_debit'){
		$total = 0;
		// $debit = str_replace(',','',$_POST['debit']);
		$debit = str_replace('.','',$_POST['debit']);
		$debit = str_replace(',','',$debit);
		// $sisa_debit = str_replace(',','',$_POST['sisa_debit']);
		$infak_debit = str_replace(',','',$_POST['infak_debit']);
		$uang_debit = str_replace(',','',$_POST['uang_debit']);
		
		$tot = $connec->query("SELECT SUM(qty* (jual - diskon)) total FROM temp_sale where billno = '".$_COOKIE['bill_no']."'");
  
		foreach($tot as $rtot){
	 
			$total = $rtot['total'];
	 
		} 
		
		if($debit == ""){
			$debit = 0;
			
		}
		
		if($infak_debit == ""){
			$infak_debit = 0;
			
		}
		
		
		if($total == 0){
			
			
			
			$json_data = array("result"=>0,"msg"=>'KEMBALIAN TDK BOLEH MINUS', "kembalian"=>"0");
			
		}else{
			
			$sisa_debit = $total - $debit;
			$kembalian = $uang_debit - ($sisa_debit+$infak_debit);
			
			
			
			
			if($kembalian < 0){
				
				$json_data = array("result"=>0,"msg"=>'KEMBALIAN TDK BOLEH MINUS', "kembalian"=>$kembalian, "sisa_debit"=>rupiah($sisa_debit));
			}else{
				
				$json_data = array("result"=>1,"msg"=>rupiah($kembalian), "kembalian"=>$kembalian, "sisa_debit"=>rupiah($sisa_debit));
			}
			
			
		}
		
		
		
		
		
		
		

		echo json_encode($json_data); 
		
		
		
		
	
	}else if($_GET['act'] == 'order'){
		$uang = str_replace(',','',$_POST['uang']);
		$infak = str_replace(',','',$_POST['infak']);
		// echo $uang;
		$lastcount = $connec->query("select count(*) jum from pos_dsales_new where date(insertdate) = date(now())");
		foreach($lastcount as $rrr){
			
			$jum_last = $rrr['jum'] + 1;
			
		}
		
		
		$bilangan=$jum_last; // Nilai Proses
		$fzeropadded = sprintf("%04d", $bilangan);
		
		$bill_no = $store_code.'-'.date('ymd').$fzeropadded;
		$bill_code = strtoupper($store_code.'-'.toBase(date('ymd').$fzeropadded));
		
		
		
		$id_sales_key = guid();
		$temp_array = array();
		$tot_jual = 0;
		$temp = $connec->query("select * from temp_sale where billno = '".$_COOKIE['bill_no']."'");
		$jum = $connec->query("select sum((jual - diskon) * qty) totalharga from temp_sale where billno = '".$_COOKIE['bill_no']."'");
		foreach($jum as $rrr){
			
			$tot_jual = $rrr['totalharga'];
			
		}
		
		foreach($temp as $rrr){
			
				$getbarang = $connec->query("select * from pos_mproduct where sku = '".$rrr['sku']."'");
				$nm = "";
				foreach($getbarang as $rr){ 
					$nm = ltrim($rr['name']);
				
				}
			
			$am = ($rrr['jual'] - $rrr['diskon']) *  $rrr['qty'];
			$temp_array[] = "('".$rrr['temp_sale_id']."','D089DFFA729F4A22816BD8838AB0813C','".$org_id."','1','".date('Y-m-d H:i:s')."','".$rrr['kasir']."','".$id_sales_key."','".$bill_no."','".$rrr['sku']."','".$rrr['qty']."','".$rrr['jual']."','".$rrr['diskon']."','".$am."','0','".$rrr['discountname']."')";
		}
		
		
		$values_line = implode(", ",$temp_array); 

		$sql_salesline = "INSERT INTO pos_dsalesline (pos_dsalesline_key, ad_mclient_key, ad_morg_key, isactived, insertdate, insertby, pos_dsales_key, billno, sku, qty, price, discount, amount, issync, discountname) values ".$values_line."";
		
		$sql_sales = "INSERT INTO pos_dsales_new (billcode, pos_dsales_key, ad_mclient_key, ad_morg_key, isactived, insertdate, insertby, pos_medc_key, pos_dcashierbalance_key, pos_mbank_key, ad_muser_key, billno, billamount,paymentmethodname, membercard, paycashgiven, paygiven, donasiamount) 
		VALUES ('".$bill_code."','".$id_sales_key."', 'D089DFFA729F4A22816BD8838AB0813C', '".$org_id."', '1', '".date('Y-m-d H:i:s')."', '".$rrr['kasir']."', '', '', '', '".$userid."', '".$bill_no."', '".$tot_jual."', 'CASH', '', '".$uang."', '0','".$infak."');";
		
		
		// echo $sql_salesline;
		// echo $sql_sales;
		
		
		$stmt = $connec->prepare($sql_sales);
		$stmt->execute();
		$stmt = $connec->prepare($sql_salesline);
		$stmt->execute();
		$affected_rows = $stmt->rowCount();
		if ($affected_rows > 0) {
			
				$connec->query("delete from temp_sale where billno = '".$_COOKIE['bill_no']."'");
				$json_data = array("result"=>1,"msg"=>'Berhasil insert sales', "no_struk"=>$bill_no);
				
				
				if(!isset($_COOKIE["bill_no"])) {
					setcookie("bill_no", $no_struk_cook, time() + (86400 * 30), "/");
				} else {
					setcookie('bill_no', null, -1, '/'); 
				}
			
		} else{
			
			$json_data = array("result"=>0,"msg"=>'Gagal insert sales', "no_struk"=>$bill_no);
		}
		

		echo json_encode($json_data); 
		
	}else if($_GET['act'] == 'order_debit'){
		
		
		$debit = str_replace(',','',$_POST['debit']);
		$debit = str_replace('.','',$debit);
		$sisa_debit = str_replace(',','',$_POST['sisa_debit']);
		$sisa_debit = str_replace('.','',$sisa_debit);
		$infak_debit = str_replace(',','',$_POST['infak_debit']);
		$approve_code = $_POST['approve_code'];
		$mesin_edc = $_POST['mesin_edc'];
		$nama_bank_debit = $_POST['nama_bank_debit'];
		$uang_debit = str_replace(',','',$_POST['uang_debit']);
		$cara_bayar = $_POST['cara_bayar'];

		$lastcount = $connec->query("select count(*) jum from pos_dsales_new where date(insertdate) = date(now())");
		foreach($lastcount as $rrr){
			
			$jum_last = $rrr['jum'] + 1;
			
		}
		
		
		$bilangan=$jum_last; // Nilai Proses
		$fzeropadded = sprintf("%04d", $bilangan);
		
		$no_struk_cook = $store_code.'-'.date('ymd').$fzeropadded;
		$bill_code = strtoupper($store_code.'-'.toBase(date('ymd').$fzeropadded));
		
		
		$id_sales_key = guid();
		$temp_array = array();
		$tot_jual = 0;
		$temp = $connec->query("select * from temp_sale where billno = '".$_COOKIE['bill_no']."'");
		$jum = $connec->query("select sum((jual - diskon) * qty) totalharga from temp_sale where billno = '".$_COOKIE['bill_no']."'");
		foreach($jum as $rrr){
			
			$tot_jual = $rrr['totalharga'];
			
		}
		
		foreach($temp as $rrr){
			
				$getbarang = $connec->query("select * from pos_mproduct where sku = '".$rrr['sku']."'");
				$nm = "";
				foreach($getbarang as $rr){ 
					$nm = ltrim($rr['name']);
				
				}
			
			$am = ($rrr['jual'] - $rrr['diskon']) *  $rrr['qty'];
			$temp_array[] = "('".$rrr['temp_sale_id']."','D089DFFA729F4A22816BD8838AB0813C','".$org_id."','1','".date('Y-m-d H:i:s')."','".$rrr['kasir']."','".$id_sales_key."','".$no_struk_cook."','".$rrr['sku']."','".$rrr['qty']."','".$rrr['jual']."','".$rrr['diskon']."','".$am."','0','".$rrr['discountname']."')";
		}
		
		
		$values_line = implode(", ",$temp_array); 
		
		// echo $values_line;
		// echo $sql_sales;
		// echo $sql_salesline;

		$sql_salesline = "INSERT INTO pos_dsalesline (pos_dsalesline_key, ad_mclient_key, ad_morg_key, isactived, insertdate, insertby, pos_dsales_key, billno, sku, qty, price, discount, amount, issync, discountname) values ".$values_line."";
		
		$sql_sales = "INSERT INTO pos_dsales_new (billcode, bankname, edcno, approvecode, pos_dsales_key, ad_mclient_key, ad_morg_key, isactived, insertdate, insertby, pos_medc_key, pos_dcashierbalance_key, pos_mbank_key, ad_muser_key, billno, billamount,paymentmethodname, membercard, paycashgiven, paygiven) VALUES ('".$bill_code."', '".$nama_bank_debit."','".$mesin_edc."', '".$approve_code."', '".$id_sales_key."', 'D089DFFA729F4A22816BD8838AB0813C', '".$org_id."', '1', '".date('Y-m-d H:i:s')."', '".$rrr['kasir']."', '', '', '', '".$userid."', '".$no_struk_cook."', '".$tot_jual."', 
		'".$cara_bayar."', '', '".$sisa_debit."', '".$debit."');";
		
// '".$sisa_debit."', '".$debit."'
		
		
		$stmt = $connec->prepare($sql_sales);
		$stmt->execute();
		$stmt = $connec->prepare($sql_salesline);
		$stmt->execute();
		$affected_rows = $stmt->rowCount();
		if ($affected_rows > 0) {
			
				$connec->query("delete from temp_sale where billno = '".$_COOKIE['bill_no']."'");
				$json_data = array("result"=>1,"msg"=>'Berhasil insert sales', "no_struk"=>$no_struk_cook);
				
				
				if(!isset($_COOKIE["bill_no"])) {
					setcookie("bill_no", $no_struk_cook, time() + (86400 * 30), "/");
				} else {
					setcookie('bill_no', null, -1, '/'); 
				}
			
		} else{
			
			$json_data = array("result"=>0,"msg"=>'Gagal insert sales', "no_struk"=>$no_struk_cook);
		}
		
		
		echo json_encode($json_data); 
		
	}else if($_GET['act'] == 'total'){
		$tot = $connec->query("SELECT SUM(qty*(jual-diskon)) total FROM temp_sale where billno = '".$_COOKIE['bill_no']."'");
  
		foreach($tot as $rtot){
	 
			echo rupiah($rtot['total']);
	 
		} 
		
	}else if($_GET['act'] == 'reprint'){
		$tot = $connec->query("select * from pos_dsales_new where billno = '".$_GET['no_struk']."'");
		$jum = $tot->rowCount();
		$s = array();
		$line = array();
		
		// $alamat = $gk['alamat'];
		// $alamat1 = $gk['alamat1'];
		// $kota = $gk['kota'];
		// $brand = $gk['brand'];
		// $footer1 = $gk['footer1'];
		// $footer2 = $gk['footer2'];
		// $footer3 = $gk['footer3'];
		$diskon = 0;
		$total = 0;
		
		if($jum > 0){
			
			foreach($tot as $r){
				$qline = $connec->query("select * from pos_dsalesline a left join pos_mproduct b on a.sku = b.sku where a.pos_dsales_key = '".$r['pos_dsales_key']."'");
				foreach($qline as $r1){
					
					
					
					
					$line[] = array(
						'pos_dsalesline_key'=>$r1['pos_dsalesline_key'],
						'ad_mclient_key'=>$r1['ad_mclient_key'],
						'ad_morg_key'=>$r1['ad_morg_key'],
						'isactived'=>$r1['isactived'],
						'insertdate'=>$r1['insertdate'],
						'insertby'=>$r1['insertby'],
						'postby'=>$r1['postby'],
						'postdate'=>$r1['postdate'],
						'pos_dsales_key'=>$r1['pos_dsales_key'],
						'sku'=>$r1['sku'],
						'qty'=>$r1['qty'],
						'price'=>rupiah($r1['price']),
						'discount'=>rupiah($r1['discount']),
						'issync'=>$r1['issync'],
						'discountname'=>$r1['discountname'],
						'name'=>$r1['name'],
						'amount'=>rupiah(($r1['price'] - $r1['discount']) * $r1['qty']),
					);
					
				$diskon += $r1['discount'] * $r1['qty'];
				$total += $r1['price'] * $r1['qty'];
				}
				
				
				$gt = $r['billamount'] - $diskon;
				$header = array(
					'alamat'=>$alamat,
					'alamat1'=>$alamat1,
					'kota'=>$kota,
					'brand'=>$brand,
					'footer1'=>$footer1,
					'footer2'=>$footer2,
					'footer3'=>$footer3,
					'billno'=>$r['billno'],
					'billcode'=>$r['billcode'],
					'dpp'=>$r['dpp'],
					'ppn'=>$r['ppn'],
					'npwp'=>$r['npwp'],
					'billamount'=>rupiah($total),
					'grandtotal'=>rupiah($r['billamount']),
					'paygiven'=>rupiah($r['paygiven']),
					'paycashgiven'=>rupiah($r['paycashgiven']),
					'donasiamount'=>rupiah($r['donasiamount']),
					'kembali'=>rupiah(($r['paycashgiven'] + $r['paygiven']) - ($r['billamount'] + $r['donasiamount'])),
					'discount'=>rupiah($diskon),
					'insertdate'=>date('Y-m-d', strtotime($r['insertdate'])),
					'insertby'=>$r['insertby'],
					'inserttime'=>date('H:i:s', strtotime($r['insertdate'])),
					'line'=>$line,
				);
			
			
			
			
		
			
			
			$s[] = $header;
			// $o[] = $line;
	 
			} 
			
			 $json_data = array(
				"result"=>1,
				"msg"=>'Proses cetak',
				"header"=>$s,
		  
			);
		}else{
			$json_data = array(
				"result"=>0,
				"msg"=>'Tidak ditemukan',
		  
			);
			
		}
		

		echo json_encode($json_data); 
	}else if($_GET['act'] == 'refund'){
		$tot = $connec->query("select * from pos_dsales_new where billcode = '".$_GET['no_struk_refund']."'");
		$jum = $tot->rowCount();
		$s = array();
		$line = array();
		$diskon = 0;
		
		if($jum > 0){
			
			foreach($tot as $r){
				$qline = $connec->query("select * from pos_dsalesline a left join pos_mproduct b on a.sku = b.sku where a.pos_dsales_key = '".$r['pos_dsales_key']."'");
				foreach($qline as $r1){
					
					$getbarang = $connec->query("select * from pos_mproduct where sku = '".$r1['sku']."'");
					$nm = "-";
					foreach($getbarang as $rr){ 
						$nm = ltrim($rr['name']);
					
					}
					
					echo '<tr>
						<td onclick="clickRefund('.$r1['sku'].');">'.$r1['sku'].'</td>
						<td>'.$nm.'</td>
						<td>'.$r1['qty'].'</td>
						<td>'.rupiah($r1['price']).'</td>
						<td>'.rupiah($r1['discount']).'</td>
						<td>'.rupiah($r1['amount']).'</td>
					</tr>';
				
			
				}
	 
			} 
		}
	}else if($_GET['act'] == 'ubah_qty'){
		
		
		$sql_insert = "update temp_sale set qty = '".$_POST['qty_ubah']."' where temp_sale_id = '".$_POST['temp_sale_id']."'";
		$insert = $connec->query($sql_insert);

			
			if($insert){
				$json_data = array(
					"result"=>1,
					"msg"=>'Berhasil insert',
		  
				);
				
			}else{
				
				$json_data = array(
					"result"=>0,
					"msg"=>'gagal insert',
		  
				);
				
				
			}	
		
		  echo json_encode($json_data); 
	}else if($_GET['act'] == 'pending'){
		
		$jum = 0;
		$cek = $connec->query("select count(*) jum, billno from temp_sale where nomor is not null and kasir = '".$username."' group by nomor");
		
		
		
		foreach($cek as $rr){ 
			
			$jum = $rr['jum'];
			$bn = $rr['billno'];
		}
		
		
		if($_COOKIE['bill_no'] == $bn){ //jika bill aktif sdh ada di pending
			
			
			setcookie('bill_no', null, -1, '/'); 
			$json_data = array(
						"result"=>1,
						"msg"=>'Berhasil insert',
			
			);
		}else{
			
			if($jum > 0){
			
				$json_data = array(
					"result"=>0,
					"msg"=>'MASIH ADA TRANSAKSI PENDING',
		  
				);
			
			}else{
				$sql_insert = "update temp_sale set nomor = '001' where billno = '".$_COOKIE['bill_no']."'";
				$insert = $connec->query($sql_insert);
			
				if($insert){
					setcookie('bill_no', null, -1, '/'); 
					
					$json_data = array(
						"result"=>1,
						"msg"=>'Berhasil insert',
			
					);
					
				}else{
					
					$json_data = array(
						"result"=>0,
						"msg"=>'gagal insert',
			
					);
					
					
				}
				
			}
			
			
		}
		
		
		
		
			
		
		  echo json_encode($json_data); 
		
		
	}else if($_GET['act'] == 'recall'){
		$jum = 0;
		$cek = $connec->query("select count(*) jum from temp_sale where nomor is null and kasir = '".$username."'");
		
		foreach($cek as $rr){ 
			
			$jum = $rr['jum'];
		}
		
		if($jum > 0){
			
			$json_data = array(
					"result"=>0,
					"msg"=>'Selesaikan transaksi dulu',
		  
				);
		}else{
			
			
			$cekk = "select billno from temp_sale where nomor = '001' and kasir = '".$username."' group by nomor";
			$r_cek = $connec->query($cekk);
			foreach($r_cek as $rr){
				setcookie("bill_no", $rr['billno'], time() + (86400 * 30), "/");
				$sql_insert = "update temp_sale set nomor = null where billno = '".$rr['billno']."'";
				$insert = $connec->query($sql_insert);
			}
		
			
		
			// if($insert){
				
				
				$json_data = array(
					"result"=>1,
					"msg"=>'Berhasil recall',
		  
				);
				
			// }else{
				
				// $json_data = array(
					// "result"=>0,
					// "msg"=>'gagal insert',
		  
				// );
				
				
			// }	
		
		 
			
			
		}
		
		
		 echo json_encode($json_data); 
		
	}else if($_GET['act'] == 'cashier_balance'){
		$m_tot_debit = 0;
		$m_tot_cash = 0;
		$m_penjualan_bersih = 0;
		$m_infak = 0;
		$jum_refund = 0;
		$jum_discount = 0;
		$donasiamount = 0;
		
		
		
		$penjualan_debit = $connec->query("select coalesce(sum(billamount),0) as billamount, coalesce(sum(donasiamount),0) as donasiamount from pos_dsales_new where ad_muser_key = '".$_SESSION['userid']."' and date(insertdate) = date(now()) 
		and paymentmethodname in ('debit')");
		foreach($penjualan_debit as $r){
			$m_tot_debit 		= $r['billamount'];
			$donasiamount 		= $r['donasiamount'];
		}
		
		$penjualan_credit = $connec->query("select coalesce(sum(billamount),0) as billamount, coalesce(sum(donasiamount),0) as donasiamount from pos_dsales_new where ad_muser_key = '".$_SESSION['userid']."' and date(insertdate) = date(now()) 
		and paymentmethodname in ('kredit')");
		foreach($penjualan_credit as $r){
			$m_tot_credit 		= $r['billamount'];
		}
		
		$penjualan_cash = $connec->query("select coalesce(sum(billamount),0) as billamount, coalesce(sum(donasiamount),0) as donasiamount from pos_dsales_new where ad_muser_key = '".$_SESSION['userid']."' and date(insertdate) = date(now()) 
		and paymentmethodname in ('CASH')");
		foreach($penjualan_cash as $r){
			$m_tot_cash 		= $r['billamount'];
		}
		
		$diskon = $connec->query("select sum(qty * price) jum_all, sum(discount * qty) jum_diskon from pos_dsalesline where insertby = '".$_SESSION['username']."' and date(insertdate) = date(now())");
		foreach($diskon as $r){
			$jum_all 			= $r['jum_all'];
			$jum_discount 		= $r['jum_diskon'];
		}
		
		
		$penjualan = $connec->query("select sum(billamount) as billamount, coalesce(sum(donasiamount),0) as donasiamount from pos_dsales_new where ad_muser_key = '".$_SESSION['userid']."' and date(insertdate) = date(now())");
		foreach($penjualan as $r){
			$m_penjualan_bersih = $r['billamount'];
			$m_infak 			= $r['donasiamount'];
		}
		
		$refund = $connec->query("select coalesce((sum(qty * price) - sum(qty * discount)),0) jum_refund from pos_dsalesline where insertby = '".$_SESSION['username']."' and date(insertdate) = date(now()) and qty < 0");
		foreach($penjualan as $r){
			$jum_refund = $r['jum_refund'];
		
		}
		
		
		$sql ="UPDATE pos_dcashierbalance set salesamount = '".$m_penjualan_bersih."', 
		salescashamount = '".$m_tot_cash."',
		salesdebitamount = '".$m_tot_debit."',
		salescreditamount = '".$m_tot_credit."',
		refundamount = '".$jum_refund."',
		discountamount = '".$jum_discount."',
		donasiamount = '".$donasiamount."'
		WHERE insertby ='".$_SESSION['userid']."' and date(insertdate) = date(now())";
		// echo $sql;
		$up =  $connec->query($sql);
		
		if($up){
			
			$json_data = array(
					"result"=>1,
					"msg"=>'Berhasil update',
		  
				);
		}else{
			$json_data = array(
					"result"=>0,
					"msg"=>'Gagal update',
		  
				);
			
		}
				
		echo json_encode($json_data); 
	}
}else if($_GET['modul'] == 'product'){
	if($_GET['act'] == 'list_bank'){

		
				$no = 1;
				$getusers = $connec->query("SELECT * FROM pos_mbank order by name asc");
				foreach($getusers as $r){ 
					echo '<option value="'.$r['name'].'"> '.$r['description'].'</option>';
					$no++;
				}
	}else if($_GET['act'] == 'list_edc'){

		
				$no = 1;
				$getusers = $connec->query("SELECT * FROM pos_medc order by name asc");
				foreach($getusers as $r){ 
					echo '<option value="'.$r['name'].'"> '.$r['description'].'</option>';
					$no++;
				}
	}
	
	else if($_GET['act'] == 'list'){
		
		 $columns = array( 
                               0 =>'pos_mproduct_key', 
                               1 =>'ad_mclient_key',
                               2=> 'ad_morg_key',
                               3=> 'isactived',
                               4=> 'insertdate',
                               5=> 'insertby',
                               6=> 'm_product_id',
                               7=> 'm_product_category_id',
                               8=> 'c_uom_id',
                               9=> 'sku',
                               10=> 'name',
                               11=> 'description',
                               12=> 'price',
                               13=> 'stockqty',
                               14=> 'isnosale',
                               15=> 'shortcut',
                               16=> 'barcode',
                               17=> 'rack',
                               18=> 'm_locator_id',
                               19=> 'locator_name',
                               20=> 'updated',
                               21=> 'priceupdate',
                               22=> 'pricemaster',
                           );
 
		if($_POST['desk'] != "") {
		
			$querycount =  $connec->query("SELECT count(*) as jumlah FROM pos_mproduct WHERE 
														barcode = '".$_POST['desk']."' or
														sku = '".$_POST['desk']."' or
                                                        name LIKE  '%".$_POST['desk']."%'");
														
			
		}else{
		
		
			$querycount =  $connec->query("SELECT count(*) as jumlah FROM pos_mproduct");
		}
		foreach($querycount as $r){
			$datacount = $r['jumlah'];
			
		}
        $totalData = $datacount;
             
        $totalFiltered = $totalData; 
 
        $limit = $_POST['length'];
        $start = $_POST['start'];
        $order = $columns[$_POST['order']['0']['column']];
        $dir = $_POST['order']['0']['dir'];
	
		if($_POST['desk'] != "") {
			
			
			$sql = "select * from pos_mproduct where barcode = '".$_POST['desk']."' or sku = '".$_POST['desk']."' or name LIKE  '%".$_POST['desk']."%' order by name asc LIMIT $limit OFFSET $start";
			$query = $connec->query("select * from pos_mproduct where barcode = '".$_POST['desk']."' or sku = '".$_POST['desk']."' or name LIKE  '%".$_POST['desk']."%' order by name asc LIMIT $limit OFFSET $start");
			
			
			
			
													  
			$querycount = $connec->query("select count(*) as jumlah from pos_mproduct where barcode = '".$_POST['desk']."' or sku = '".$_POST['desk']."' or name LIKE  '%".$_POST['desk']."%'");
			foreach($querycount as $rr){
				$datacount = $rr['jumlah'];
				
			}
           $totalFiltered = $datacount;									  
			
			// echo $sql;
			
		}else{
			 $query = $connec->query("select * from pos_mproduct order by name asc LIMIT $limit OFFSET $start");

		}

 
        $data = array();
        if(!empty($query))
        {
            $no = $start + 1;
			foreach($query as $r){
				
				
				$nestedData['no'] = $no;
				$nestedData['postdate'] = $r['insertdate'];
				$nestedData['shortcut'] = $r['shortcut'];
				$nestedData['barcode'] = $r['barcode'];
				$nestedData['rack'] = $r['rack'];
				$nestedData['stockqty'] = $r['stockqty'];
                $nestedData['sku'] = '<font style="font-weight: bold" class="id">'.$r['sku'].'</font>';
                $nestedData['name'] = $r['name'];
                $nestedData['description'] = $r['name'];
                $nestedData['price'] = rupiah($r['price']);
                $data[] = $nestedData;	   
                $no++;
				
			}
			

        }
           
        $json_data = array(
                    "draw"            => intval($_POST['draw']),  
                    "recordsTotal"    => intval($totalData),  
                    "recordsFiltered" => intval($totalFiltered), 
                    "data"            => $data  
                    );

        echo json_encode($json_data); 

	}else if($_GET['act'] == 'show'){

		
				$no = 1;
				$temp = $connec->query("select * from temp_sale where billno = '".$_COOKIE['bill_no']."'");
				foreach($temp as $r){ 
				
				$getbarang = $connec->query("select * from pos_mproduct where sku = '".$r['sku']."'");
				$nm = "-";
				foreach($getbarang as $rr){ 
					$nm = ltrim($rr['name']);
				
				}
				
				
				
				echo '<tr>
						<td>'.$no.'</td>
						<td>'.$r['sku'].'</td>
						<td>'.$r['barcode'].'</td>
						<td>'.$nm.'</td>
						<td>
						<input type="number" style="width: 65px" value="'.$r['qty'].'" id="qty_ubah'.$r['temp_sale_id'].'" onchange="ubahQty(\'' . $r['temp_sale_id'] . '\');"></input>
						<input type="hidden" value="'.$r['qty'].'" id="qty_lama'.$r['temp_sale_id'].'"></input>
						</td>
						<td>'.rupiah($r['jual']).'</td>
						<td>'.rupiah($r['diskon']).'</td>
						<td>'.rupiah(($r['jual'] - $r['diskon']) * $r['qty']).'</td>
						<td>'.$r['discountname'].'</td>
					</tr>';
				
					
				
				$no++;
				
			} 
				
		
		
	
	}else if($_GET['act'] == 'list_again'){

		
				$no = 1;
				$desk = $_GET['desk'];
				$getbarang = $connec->query("select * from pos_mproduct where (name like '%".$desk."%' or sku like '%".$desk."%' or barcode like '%".$desk."%') limit 30");
				$nm = "-";
				foreach($getbarang as $r){ 
				$dc = "0";
				$dn = "-";
				
				$cekdiskon = $connec->query("select * from pos_mproductdiscount where todate >= '".date('Y-m-d')."' and sku = '".$r['sku']."' ");
				foreach($cekdiskon as $cd){
					$dc = $cd['discount'];
					$dn = $cd['discountname'];
					
				}
				
				
				
					echo '<tr>
						<td class="id">'.$r['sku'].'</td>
						<td>'.$r['barcode'].'</td>
						<td>'.$r['shortcut'].'</td>
						<td>'.$r['name'].'</td>
						<td>'.$r['stockqty'].'</td>
						<td>'.rupiah($r['price']).'</td>
						<td>'.rupiah($dc).'</td>
						<td>'.$dn.'</td>
						
						</tr>';
				
				
				
					$no++;
				}
	}else if($_GET['act'] == 'scan'){
		
		
		 $sku = $_POST['sku'];
		 $qty = $_POST['qty'];
		 if($sku != "" && $qty >= 1 && is_numeric( $qty ) && strpos( $qty, '.' ) === false){
		
		 $query = $connec->query("select * from pos_mproduct where (sku = '".$sku."' or barcode = '".$sku."')");
		 $count = $query->rowCount();
		 
		 if($count > 0){
			 
		foreach($query as $r){
			
			$ct = 0;
			$cektemp = $connec->query("select count(*) jum, qty from temp_sale where billno = '".$_COOKIE['bill_no']."' and (sku = '".$sku."' or barcode = '".$sku."')");
			foreach($cektemp as $ctemp){
				$ct = $ctemp['jum'];
				$qtytemp = $ctemp['qty'];
			}
			 
			
			
			if($ct > 0){
				$qtylast = $qty + $qtytemp;
				$sql_insert = "update temp_sale set qty = '".$qtylast."' where billno = '".$_COOKIE['bill_no']."' and  (sku = '".$sku."' or barcode = '".$sku."')";
				
			}else{
				$dc = 0;
				$dn = "";
				$cekdiskon = $connec->query("select * from pos_mproductdiscount where todate >= '".date('Y-m-d')."' and sku = '".$sku."' ");
				foreach($cekdiskon as $cd){
					$dc = $cd['discount'];
					$dn = $cd['discountname'];
					
				}
				
			
				
				$sql_insert = "INSERT INTO temp_sale
			(sku, qty, jual, diskon, kasir, idmember, ispromo, jualnormal, barcode, created_date, `member`, m_product_id, maxqty, discount_print, billno, temp_sale_id, discountname)
			VALUES('".$r['sku']."', '".$qty."', '".$r['price']."', '".$dc."', '".$username."', '', '', '".$r['price']."', '".$r['barcode']."', '".date('Y-m-d H:i:s')."', 'N', '".$r['m_product_id']."', 0, 0, '".$_COOKIE['bill_no']."', '".guid()."',
			'".$dn."');";
			}
			
			
			
			
			$insert = $connec->query($sql_insert);

			
			if($insert){
				$json_data = array(
					"result"=>1,
					"sku"=>$r['sku'],
					"name"=>$r['name'],
					"price"=>$r['price'],
					"msg"=>'Berhasil insert',
		  
				);
				
			}else{
				
				$json_data = array(
					"result"=>1,
					"sku"=>$r['sku'],
					"name"=>$r['name'],
					"price"=>$r['price'],
					"msg"=>'Gagal insert',
		  
				);
			}
			 
			 
			 
			
		 }
		 }else{
			 
			 $json_data = array(
				"result"=>0,
				"msg"=>'Produk tidak ditemukan',
		  
			);
		 }
			 
		 }else{
			 $json_data = array(
				"result"=>0,
				"msg"=>'SKU / QTY harus sesuai format',
		  
			);
			 
			 
		 }
		 

		 
		
		 // echo $sql_insert;
		  echo json_encode($json_data); 
		 
		 
	}else if($_GET['act'] == 'refund'){
		
		
		 $sku = $_POST['sku'];
		 $no_struk_refund = $_POST['no_struk_refund'];
		 $qty = $_POST['qty'];
		 if($sku != "" && $no_struk_refund != ""){
		
		$status = 0;
		 
		 
		$tot = $connec->query("select * from pos_dsales_new where billcode = '".$no_struk_refund."' and date(insertdate) = date(now())");
		$jum = $tot->rowCount();
		$s = array();
		$line = array();
		$diskon = 0;
		
		if($jum > 0){
			$status = 1;
			foreach($tot as $r){
				$status = 2;
				$qty_lama = 0;
				$qline = $connec->query("select * from pos_dsalesline a left join pos_mproduct b on a.sku = b.sku where a.pos_dsales_key = '".$r['pos_dsales_key']."' and a.sku = '".$sku."'");
				foreach($qline as $r1){
					$qty_lama = $r1['qty'];
					$status = 3;
					$getbarang = $connec->query("select * from pos_mproduct where sku = '".$sku."'");
					$nm = "-";
					foreach($getbarang as $rr){ 
						$nm = ltrim($rr['name']);
						$mpi = $rr['m_product_id'];
						$barcode = $rr['barcode'];
					
					}
					
					$ct = 0;
					$cektemp = $connec->query("select count(*) jum, qty from temp_sale where billno = '".$_COOKIE['bill_no']."' and (sku = '".$sku."' or barcode = '".$sku."')");
					foreach($cektemp as $ctemp){
						$ct = $ctemp['jum'];
						$qtytemp = $ctemp['qty'];
					}
					
					
					if($ct > 0){
						$status = 4;
						$qtylast = -$qty + $qtytemp;
						$sql_insert = "update temp_sale set qty = '".$qtylast."' where billno = '".$_COOKIE['bill_no']."' and  (sku = '".$sku."' or barcode = '".$sku."')";
				
					}else{
						$status = 4;
						$sql_insert = "INSERT INTO temp_sale
						(sku, qty, jual, diskon, kasir, idmember, ispromo, jualnormal, barcode, created_date, `member`, m_product_id, maxqty, discount_print, billno, temp_sale_id)
						VALUES('".$sku."', '".-$qty."', '".$r1['price']."', '".$r1['discount']."', '".$username."', '', '', '".$r1['price']."', '".$barcode."', '".date('Y-m-d H:i:s')."', 'N', '".$mpi."', 0, 0, '".$_COOKIE['bill_no']."', '".guid()."');";
					}
					
			
				}
				
				// echo $status;
				if($qty_lama < $qty){
					 $json_data = array(
						"result"=>0,
						"msg"=>'QTY Tidak Boleh Melebihi Batas',
		  
					);
					
				}else{
					$insert = $connec->query($sql_insert);
					if($insert){
						$json_data = array(
							"result"=>1,
							"msg"=>'Berhasil refund',
				
						);
						
					}else{
						
						$json_data = array(
							"result"=>1,
							"msg"=>'Gagal refund',
				
						);
					}
					
					
				}
				
					
				
	 
			} 
		}else{
			 
			 $json_data = array(
				"result"=>0,
				"msg"=>'Items tidak ditemukan pada sales',
		  
			);
		 }
		 
	
			 
		 }else{
			 $json_data = array(
				"result"=>0,
				"msg"=>'SKU tidak boleh kosong',
		  
			);
			 
			 
		 }
		 

		 
		
		 // echo $sql_insert;
		  echo json_encode($json_data); 
		 
		 
	}
}else if($_GET['modul'] == 'sync'){
	
	if($_GET['act'] == 'sync_user'){
		
			$json_url = "https://pi.idolmartidolaku.com/api/action.php?modul=inventory&act=sync_user&org_id=".$org_id;
			$json = file_get_contents($json_url);

			$arr = json_decode($json, true);
			$jum = count($arr);
		
		if($jum > 0){
			$truncate = $connec->query("TRUNCATE TABLE m_pi_users");
			if($truncate){
			
		
			
			
			// echo $jum;
			$no = 0;
			foreach($arr as $item) { //foreach element in $arr
				$ad_muser_key 	= $item['ad_muser_key']; //etc
				$isactived 		= $item['isactived']; //etc
				$userid 		= $item['userid']; //etc
				$username 		= $item['username']; //etc
				$userpwd 		= $item['userpwd']; //etc
				$ad_org_id 		= $item['ad_org_id']; //etc
				$name 			= $item['name']; //etc
				$accesscode 	= $item['accesscode']; //etc
				$accessuniq 	= $item['accessuniq']; //etc
				
				$sql = "insert into m_pi_users (ad_muser_key, isactived, userid, username, userpwd, ad_org_id, name, accesscode, accessuniq) 
					VALUES ('".$ad_muser_key."', '".$isactived."','".$userid."','".$username."','".$userpwd."','".$ad_org_id."','".$name."','".$accesscode."','".$accessuniq."')";
				
				$statement1 = $connec->query($sql);
					
				// echo $sql;
					
					 
					if($statement1){
						$no = $no+1;

						
					}	
					
					
									
			}
			$json = array('result'=>'1', 'msg'=>'Berhasil sync '.$no.' dari '.$jum.' users');
			
			
				
			
		}
			
			
		}else{
			$json = array('result'=>'1', 'msg'=>'Gagal connect ke server');
			
			
		}
			$json_string = json_encode($json);	
			echo $json_string;	
	}else if($_GET['act'] == 'product'){
		
		
		
		$hasil = get_data_stock_all($org_id);
		$j_hasil = json_decode($hasil, true);
		$no = 0;	
		
		
		// var_dump($j_hasil);
		
		foreach($j_hasil as $r) {
			
			
			$stock_sales = 0;
			$haha = 0;
			$ceksales = $connec->query("select sku, sum(qty) as jj from pos_dsales where sku = '".$r['sku']."' and date(insertdate) = date(now()) group by sku");
			foreach ($ceksales as $rs) {
				
					$stock_sales = $rs['jj'];
				}
			
			$cekitems = $connec->query("select count(sku) as jum, stockqty from pos_mproduct where sku = '".$r['sku']."' group by sku, stockqty");
			foreach ($cekitems as $ra) {
				
					$haha = $ra['jum'];
				}
			
			$totqty = $r['stockqty'] - $stock_sales;
	
			if($haha > 0){
				
				
				
				$sql = "update pos_mproduct set stockqty='".$totqty."' where sku='".$r['sku']."'";
				
				$upcount = $connec->query($sql);
				
			}else{
				$sql = "insert into pos_mproduct (
ad_mclient_key,
ad_morg_key,
isactived,
insertdate,
insertby,
m_product_id,
m_product_category_id,
c_uom_id,
sku,
name,
price,
stockqty,
m_locator_id,
locator_name) VALUES (
				'".$r['ad_client_id']."',
				'".$r['ad_mor_key']."',
				'".$r['isactive']."',
				'".date('Y-m-d H:i:s')."',
				'".$r['insertby']."',
				'".$r['m_product_id']."',
				'".$r['m_product_category_id']."',
				'".$r['c_uom_id']."',
				'".$r['sku']."',
				'".substr($r['namaitem'], 0, 49)."',
				'".$r['price']."',
				'".$r['stockqty']."',
				'".$r['m_locator_id']."',
				'".$r['locator_name']."'
)";

				$upcount = $connec->query($sql);
				

			}
			
			
			if($upcount){
				$no = $no + 1;
				
			}
			
		// echo $sql;

		}
		
		$data = array("result"=>1, "msg"=>"Berhasil sync ".$no." data");
		
		$json_string = json_encode($data);	
		echo $json_string;
		
	}else if($_GET['act'] == 'member'){
		
		$hasil = get_data_member();
		$j_hasil = json_decode($hasil, true);
		$no = 0;	

		$jum_member = count($j_hasil);
		// var_dump($j_hasil);
		if($jum_member > 0){
			$s = array();
			foreach ($j_hasil as $rrr) {
				$s[] = "('".$rrr['pos_mmember_key']."','','".$rrr['ad_org_id']."', '".$rrr['isactived']."','".$rrr['insertdate']."','".$rrr['insertby']."','".$rrr['postby']."','".$rrr['postdate']."',
				'".$rrr['memberid']."','".str_replace(["'",'"'],'',$rrr['name'])."','".$rrr['dateofbirth']."','".$rrr['point']."','".$rrr['membercardno']."','".$rrr['nohp']."')";
	
			}
			 
			$values = implode(", ",$s); 
			
			$truncate = $connec->query("truncate table pos_mmember");
			
			if($truncate){
				
				$sql_member = "INSERT INTO pos_mmember (pos_mmember_key, ad_mclient_key, ad_morg_key, isactived, insertdate, insertby, postby, postdate, memberid, name, dateofbirth, `point`, membercardno, nohp) values ".$values."";
				$connec->query($sql_member);
				
			}
			
		

			
		}
		
		// echo $sql_member;
		$data = array("result"=>1, "msg"=>"Berhasil sync ".$no." data");
		
		$json_string = json_encode($data);	
		echo $json_string;
	}else if($_GET['act'] == 'sync_promo'){
		
		$jsons = get_data_promo($org_id);
		$arr = json_decode($jsons, true);
		$jum = count($arr);
		$s = array();
		
		// var_dump( $arr);			
		
		if($jum > 0){
		$truncate = $connec->query("TRUNCATE TABLE pos_mproductdiscount");
		if($truncate){
			
		
			// echo $jum;
			$no = 0;
			
			foreach($arr as $item) { //foreach element in $arr
				$amk = $item['ad_morg_key']; //etc
				$isactived = $item['isactived']; //etc
				$insertdate = $item['insertdate']; //etc
				$insertby = $item['insertby']; //etc
				$discountname = str_replace("'", "\'", $item['discountname']); //etc
				$discounttype = $item['discounttype']; //etc
				$sku = $item['sku']; //etc
				$discount = $item['discount']; //etc
				$fromdate = $item['fromdate']; //etc
				$todate = $item['todate']; //etc
				$typepromo = $item['typepromo']; //etc
				$maxqty = $item['maxqty']; //etc
				$ad_mclient_key = $item['ad_mclient_key']; //etc
					
					 
				$s[] = "('".guid()."','".$ad_mclient_key."', '".$amk."', '".$isactived."', '".date("Y-m-d H:i:s")."','".$insertdate."', '".$insertby."', '".$discountname."', '".$discounttype."','".$sku."', '".$discount."', '".$fromdate."', '".$todate."', '".$typepromo."', '".$maxqty."')";	 
					 
				
									
			}
			
			$jum_s = count($s);
			
			if($jum_s > 0){
				$values = implode(", ",$s);

				$ssql = "insert into pos_mproductdiscount (pos_mproductdiscount_key, ad_mclient_key, ad_morg_key, isactived, postdate, insertdate, insertby, discountname, discounttype, sku, discount, fromdate, todate, typepromo, maxqty) 
						VALUES ".$values.";";


				// echo $ssql;
				$suc = $connec->query($ssql);
				
				
				if($suc){
					
					$json = array('result'=>'1', 'msg'=>'Berhasil sync');
					$json_string = json_encode($json);	
					
				}else{
					
					$json = array('result'=>'1', 'msg'=>'Gagal sync, coba lagi nanti');
					$json_string = json_encode($json);	
				}
				
			}else{
				$json = array('result'=>'1', 'msg'=>'Gagal sync, data rack blm ditemukan');
				$json_string = json_encode($json);	
				
			}
		}	
			
	}else{
		
				$json = array('result'=>'1', 'msg'=>'Gagal sync, data blm ditemukan');
				$json_string = json_encode($json);	
		
	}
		

	echo $json_string;	
	

	}else if($_GET['act'] == 'sync_promo_code'){
		
	
		
		$jsons = get_data_promo_code($org_id);
		$arr = json_decode($jsons, true);
		$jum = count($arr);
		$s = array();
		if($jum > 0){
		$truncate = $connec->query("TRUNCATE TABLE pos_mproductdiscountmember");
		if($truncate){
			
		
			// echo $jum;
			$no = 0;
			
			foreach($arr as $item) { //foreach element in $arr
				$amk = $item['ad_morg_key']; //etc
				$isactived = $item['isactived']; //etc
				$insertdate = $item['insertdate']; //etc
				$insertby = $item['insertby']; //etc
				$discountname = str_replace("'", "\'", $item['discountname']); //etc
				$discounttype = $item['discounttype']; //etc
				$sku = $item['sku']; //etc
				$discount = $item['discount']; //etc
				$fromdate = $item['fromdate']; //etc
				$todate = $item['todate']; //etc
				$typepromo = $item['typepromo']; //etc
				$maxqty = $item['maxqty']; //etc
				$afterdiscount = $item['afterdiscount']; //etc
				$ad_mclient_key = $item['ad_mclient_key']; //etc
					
					 
				$s[] = "('".guid()."', '".$ad_mclient_key."','".$amk."', '".$isactived."', '".date("Y-m-d H:i:s")."','".$insertdate."', '".$insertby."', '".$discountname."','".$sku."', '".$afterdiscount."', '".$fromdate."', '".$todate."', '".$maxqty."')";	 
					 
				
									
			}
			
			$jum_s = count($s);
			
			if($jum_s > 0){
				$values = implode(", ",$s);

				$suc = $connec->query("insert into pos_mproductdiscountmember (pos_mproductdiscountmember_key, ad_mclient_key, ad_morg_key, isactived, postdate, insertdate, insertby, discountname, sku, pricediscount, fromdate, todate, maxqty) 
						VALUES ".$values.";");
				
				
				if($suc){
					
					$json = array('result'=>'1', 'msg'=>'Berhasil sync');
					$json_string = json_encode($json);	
					
				}else{
					
					$json = array('result'=>'1', 'msg'=>'Gagal sync, coba lagi nanti');
					$json_string = json_encode($json);	
				}
				
			}else{
				$json = array('result'=>'1', 'msg'=>'Gagal sync, data blm ditemukan');
				$json_string = json_encode($json);	
				
			}
		}	
			
	}else{
		
				$json = array('result'=>'1', 'msg'=>'Gagal sync, data blm ditemukan');
				$json_string = json_encode($json);	
		
	}
		

	echo $json_string;	
				

	}else if($_GET['act'] == 'sync_promo_tebus'){
		
		
		
		$jsons = get_data_promo_tebus($org_id);
		$arr = json_decode($jsons, true);
		$jum = count($arr);
		$s = array();
		if($jum > 0){
		$truncate = $connec->query("TRUNCATE TABLE pos_mproductdiscountmurah");
		if($truncate){
			
			// echo $jum;
			$no = 0;
			
			foreach($arr as $item) { //foreach element in $arr
				$amk = $item['ad_org_id']; //etc
				$insertdate = $item['insertdate']; //etc
				$insertby = $item['insertby']; //etc
				$discountname = str_replace("'", "\'", $item['headername']); //etc
				$sku = $item['sku']; //etc
				$pricediscount = $item['afterdiscount']; //etc
				$fromdate = $item['fromdate']; //etc
				$todate = $item['todate']; //etc
				$maxqty = $item['maxqty']; //etc
					
					 
				$s[] = "('".guid()."', 'D089DFFA729F4A22816BD8838AB0813C', '".$amk."', '1', '".$insertdate."', '".date('Y-m-d H:i:s')."', '".$insertby."', '".$discountname."', '".$sku."', '".$pricediscount."', 
				'".$fromdate."', '".$todate."', '".$maxqty."')";	 
							
			}
			
			$jum_s = count($s);
			
			if($jum_s > 0){
				$values = implode(", ",$s);

				$ssql = "INSERT INTO pos_mproductdiscountmurah (pos_mproductdiscountmurah_key, ad_mclient_key, ad_morg_key, isactived, insertdate, postdate, insertby, discountname, sku, pricediscount, fromdate, todate, limitamount) VALUES ".$values.";";

				$suc = $connec->query($ssql);
				
				
				echo $ssql;
				
				if($suc){
					
					$json = array('result'=>'1', 'msg'=>'Berhasil sync');
					$json_string = json_encode($json);	
					
				}else{
					
					$json = array('result'=>'1', 'msg'=>'Gagal sync, coba lagi nanti');
					$json_string = json_encode($json);	
				}
				
			}else{
				$json = array('result'=>'1', 'msg'=>'Gagal sync, data blm ditemukan');
				$json_string = json_encode($json);	
				
			}
		}	
			
	}else{
		
				$json = array('result'=>'1', 'msg'=>'Gagal sync, data blm ditemukan');
				$json_string = json_encode($json);	
		
	}
		

	echo $json_string;	
	// echo $ssql;	
				

	}else if($_GET['act'] == 'edc'){
		
		$hasil = get_data_edc();
		$j_hasil = json_decode($hasil, true);	


			$s = array();
			$p = array();
			foreach ($j_hasil['edc'] as $rrr) {
				$s[] = "('".$rrr['pos_medc_key']."','".$rrr['insertdate']."', '".$rrr['insertby']."','".$rrr['name']."','".$rrr['description']."','".$rrr['code']."')";
	
			}
			
			foreach ($j_hasil['bank'] as $rrr) {
				$p[] = "('".$rrr['pos_mbank_key']."','".$rrr['insertdate']."', '".$rrr['insertby']."','".$rrr['name']."','".$rrr['description']."')";
	
			}
			 
			$edc = implode(", ",$s); 
			$bank = implode(", ",$p); 
			
			$connec->query("truncate table pos_mbank");
			$connec->query("truncate table pos_medc");
			// echo $edc;
			
			
			// if($truncate){
				
				$sql_bank = "INSERT INTO pos_mbank (pos_mbank_key, insertdate, insertby, name, description) values ".$bank."";
				$connec->query($sql_bank);
				
				$sql_edc = "INSERT INTO pos_medc(pos_medc_key, insertdate, insertby, name, description, code) values ".$edc."";
				$connec->query($sql_edc);
			
			
		
				// echo $sql_edc;
				
				
			// }
			
		

			
		
			
		$data = array("result"=>1, "msg"=>"Berhasil sync data");
		
		$json_string = json_encode($data);	
		echo $json_string;
	}else if($_GET['act'] == 'cat'){
		
		$hasil = get_data_cat();
		$j_hasil = json_decode($hasil, true);	

		// var_dump($j_hasil);
			$s = array();
			$p = array();
			foreach ($j_hasil as $rrr) {
				
				$imp = explode("-",$rrr['value']);
				
				$s[] = "('8".$imp[0]."','".$rrr['value']."','".date('Y-m-d H:i:s', strtotime($rrr['created']))."')";
	
			}
			
			
			$edc = implode(", ",$s); 
			
			$truncate = $connec->query("truncate table pos_m_category");

			
			if($truncate){
				
				$sql_bank = "INSERT INTO pos_m_category (kodekat, kategori, created_date) values ".$edc."";
				$connec->query($sql_bank);
				
				// echo $sql_bank;
			}
			
		$data = array("result"=>1, "msg"=>"Berhasil sync data");
		
		$json_string = json_encode($data);	
		echo $json_string;
	}
	
	
	
	
}else if($_GET['modul'] == 'promo'){
	
	
	if($_GET['act'] == 'reguler'){
		  
		 $columns = array( 
                               0 =>'sku', 
                               1 =>'nama_items',
                               2=> 'harga_normal',
                               3=> 'potongan',
                               4=> 'harga_promo'
                           );
 
	      $querycount =  $connec->query("select count(*) as jumlah from pos_mproductdiscount a inner join pos_mproduct b on a.sku = b.sku");
    
		foreach($querycount as $r){
			$datacount = $r['jumlah'];
			
		}
   
        $totalData = $datacount;
             
        $totalFiltered = $totalData; 
 
        $limit = $_POST['length'];
        $start = $_POST['start'];
		// $limit = 10;
        // $start = 0;
        $order = $columns[$_POST['order']['0']['column']];
        $dir = $_POST['order']['0']['dir'];
             
        if(empty($_POST['search']['value']))
        {
         $query = $connec->query("select a.*, b.name, b.price from pos_mproductdiscount a inner join pos_mproduct b on a.sku = b.sku order by a.sku asc
                                                      LIMIT $limit
                                                      OFFSET $start");
        }
        else {
            $search = $_POST['search']['value']; 
            $query = $connec->query("select a.*, b.name, b.price from pos_mproductdiscount a inner join pos_mproduct b on a.sku = b.sku WHERE a.sku LIKE  '%$search%'
                                                         or a.discountname LIKE  '%$search%'
                                                         or b.name LIKE  '%$search%'
                                                         order by a.sku asc
                                                         LIMIT $limit
                                                         OFFSET $start");
 
 
         $querycount = $connec->query("select count(*) as jumlah from pos_mproductdiscount a inner join pos_mproduct b on a.sku = b.sku WHERE a.sku LIKE  '%$search%' or b.name LIKE  '%$search%'
                                                         or a.discountname LIKE  '%$search%'");
        foreach($querycount as $rr){
			$datacount = $rr['jumlah'];
			
		}
           $totalFiltered = $datacount;
        }
 
        $data = array();
        if(!empty($query))
        {
            $no = $start + 1;
			foreach($query as $r){
				
			
				$pd = $r['price'] - $r['discount'];
                $nestedData['sku'] = '<font style="font-weight: bold">'.$r['sku'].'</font>';
                $nestedData['nama_items'] = $r['name'];
                $nestedData['harga_normal'] = '<font style="color: blue;font-weight: bold">'.rupiah($r['price']).'</font>';
                $nestedData['potongan'] = '<font style="color: red;font-weight: bold">'.rupiah($r['discount']).'</font>';
                $nestedData['harga_promo'] = '<font style="color: green;font-weight: bold">'.rupiah($pd).'</font>';
                $nestedData['discountname'] = $r['discountname'];
                $data[] = $nestedData;
                $no++;
				
			}
			

        }
           
        $json_data = array(
                    "draw"            => intval($_POST['draw']),  
                    "recordsTotal"    => intval($totalData),  
                    "recordsFiltered" => intval($totalFiltered), 
                    "data"            => $data  
                    );
             
        echo json_encode($json_data); 
	}else if($_GET['act'] == 'member'){
		  
		 $columns = array( 
                               0 =>'sku', 
                               1 =>'nama_items',
                               2=> 'harga_normal',
                               3=> 'potongan',
                               4=> 'harga_promo'
                           );
 
	      $querycount =  $connec->query("SELECT count(*) as jumlah FROM pos_mproductdiscountmember");
    
		foreach($querycount as $r){
			$datacount = $r['jumlah'];
			
		}
   
        $totalData = $datacount;
             
        $totalFiltered = $totalData; 
 
        $limit = $_POST['length'];
        $start = $_POST['start'];
		// $limit = 10;
        // $start = 0;
        $order = $columns[$_POST['order']['0']['column']];
        $dir = $_POST['order']['0']['dir'];
             
        if(empty($_POST['search']['value']))
        {
         $query = $connec->query("select a.*, b.name, b.price from pos_mproductdiscountmember a inner join pos_mproduct b on a.sku = b.sku order by a.sku asc
                                                      LIMIT $limit
                                                      OFFSET $start");
        }
        else {
            $search = $_POST['search']['value']; 
            $query = $connec->query("select a.*, b.name, b.price from pos_mproductdiscountmember a inner join pos_mproduct b on a.sku = b.sku WHERE a.sku LIKE  '%$search%'
                                                         or a.discountname LIKE  '%$search%'
                                                         or b.name LIKE  '%$search%'
                                                         order by a.sku asc
                                                         LIMIT $limit
                                                         OFFSET $start");
 
 
         $querycount = $connec->query("select count(*) as jumlah from pos_mproductdiscountmember a inner join pos_mproduct b on a.sku = b.sku WHERE a.sku LIKE  '%$search%' or b.name LIKE  '%$search%'
                                                         or a.discountname LIKE  '%$search%'");
        foreach($querycount as $rr){
			$datacount = $rr['jumlah'];
			
		}
           $totalFiltered = $datacount;
        }
 
        $data = array();
        if(!empty($query))
        {
            $no = $start + 1;
			foreach($query as $r){
				
			
				$pd = $r['price'] - $r['discount'];
                $nestedData['sku'] = '<font style="font-weight: bold">'.$r['sku'].'</font>';
                $nestedData['nama_items'] = $r['name'];
                $nestedData['harga_normal'] = '<font style="color: blue;font-weight: bold">'.rupiah($r['price']).'</font>';
                $nestedData['potongan'] = '<font style="color: red;font-weight: bold">'.rupiah($r['discount']).'</font>';
                $nestedData['harga_promo'] = '<font style="color: green;font-weight: bold">'.rupiah($pd).'</font>';
                $nestedData['discountname'] = $r['discountname'];
                $data[] = $nestedData;
                $no++;
				
			}
			

        }
           
        $json_data = array(
                    "draw"            => intval($_POST['draw']),  
                    "recordsTotal"    => intval($totalData),  
                    "recordsFiltered" => intval($totalFiltered), 
                    "data"            => $data  
                    );
             
        echo json_encode($json_data); 
	}else if($_GET['act'] == 'murah'){
		  
		 $columns = array( 
                               0 =>'sku', 
                               1 =>'nama_items',
                               2=> 'harga_normal',
                               3=> 'potongan',
                               4=> 'harga_promo'
                           );
 
	      $querycount =  $connec->query("SELECT count(*) as jumlah FROM pos_mproductdiscountmurah");
    
		foreach($querycount as $r){
			$datacount = $r['jumlah'];
			
		}
   
        $totalData = $datacount;
             
        $totalFiltered = $totalData; 
 
        $limit = $_POST['length'];
        $start = $_POST['start'];
		// $limit = 10;
        // $start = 0;
        $order = $columns[$_POST['order']['0']['column']];
        $dir = $_POST['order']['0']['dir'];
             
        if(empty($_POST['search']['value']))
        {
         $query = $connec->query("select a.*, b.name, b.price from pos_mproductdiscountmurah a inner join pos_mproduct b on a.sku = b.sku order by a.sku asc
                                                      LIMIT $limit
                                                      OFFSET $start");
        }
        else {
            $search = $_POST['search']['value']; 
            $query = $connec->query("select a.*, b.name, b.price from pos_mproductdiscountmurah a inner join pos_mproduct b on a.sku = b.sku WHERE a.sku LIKE  '%$search%'
                                                         or a.discountname LIKE  '%$search%'
                                                         or b.name LIKE  '%$search%'
                                                         order by a.sku asc
                                                         LIMIT $limit
                                                         OFFSET $start");
 
 
         $querycount = $connec->query("select count(*) as jumlah from pos_mproductdiscountmurah a inner join pos_mproduct b on a.sku = b.sku WHERE a.sku LIKE  '%$search%' or b.name LIKE  '%$search%'
                                                         or a.discountname LIKE  '%$search%'");
        foreach($querycount as $rr){
			$datacount = $rr['jumlah'];
			
		}
           $totalFiltered = $datacount;
        }
 
        $data = array();
        if(!empty($query))
        {
            $no = $start + 1;
			foreach($query as $r){
				
			
				$pd = $r['price'] - $r['discount'];
                $nestedData['sku'] = '<font style="font-weight: bold">'.$r['sku'].'</font>';
                $nestedData['nama_items'] = $r['name'];
                $nestedData['harga_normal'] = '<font style="color: blue;font-weight: bold">'.rupiah($r['price']).'</font>';
                $nestedData['potongan'] = '<font style="color: red;font-weight: bold">'.rupiah($r['discount']).'</font>';
                $nestedData['harga_promo'] = '<font style="color: green;font-weight: bold">'.rupiah($pd).'</font>';
                $nestedData['discountname'] = $r['discountname'];
                $data[] = $nestedData;
                $no++;
				
			}
			

        }
           
        $json_data = array(
                    "draw"            => intval($_POST['draw']),  
                    "recordsTotal"    => intval($totalData),  
                    "recordsFiltered" => intval($totalFiltered), 
                    "data"            => $data  
                    );
             
        echo json_encode($json_data); 
	}		
    
}
?>



		