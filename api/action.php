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
		
		$id = guid();
		$sql_sales = "INSERT INTO pos_dcashierbalance
(pos_dcashierbalance_key, ad_mclient_key, ad_morg_key, isactived, insertdate, insertby, postby, postdate, pos_mcashier_key, ad_muser_key, pos_mshift_key, startdate, enddate, balanceamount, salesamount, status, salescashamount, salesdebitamount, salescreditamount, actualamount, issync, refundamount, discountamount, cancelcount, cancelamount, donasiamount, pointamount, pointdebitamout, pointcreditamount, variantmin, variantplus, paycash, keterangan)
VALUES('".$id."', 'D089DFFA729F4A22816BD8838AB0813C', '".$org_id."', '1', '".date('Y-m-d H:i:s')."', '".$userid."', '".$userid."', '".date('Y-m-d H:i:s')."', NULL, NULL, 'f1115683c3dc49bd83dda7e676820651', '".date('Y-m-d H:i:s')."', NULL, 
'".$_POST['nominal_awal']."', NULL, 'RUNNING', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);";
		
		$stmt = $connec->prepare($sql_sales);
		$stmt->execute();
		$affected_rows = $stmt->rowCount();
		if ($affected_rows > 0) {
			
			$json_data = array("result"=>1,"msg"=>'Berhasil insert sales',"id"=> $id);
			
			
		}else{
			
			$json_data = array("result"=>0,"msg"=>'Berhasil insert sales',"id"=> $id);
		}
		
		
		echo json_encode($json_data); 
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
	}
	
}else if($_GET['modul'] == 'sales'){
	
	
	if($_GET['act'] == 'order'){
		$uang = str_replace(',','',$_POST['uang']);
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
		$jum = $connec->query("select sum(jual * qty) totalharga from temp_sale where billno = '".$_COOKIE['bill_no']."'");
		foreach($jum as $rrr){
			
			$tot_jual = $rrr['totalharga'];
			
		}
		
		foreach($temp as $rrr){
			
				$getbarang = $connec->query("select * from pos_mproduct where sku = '".$rrr['sku']."'");
				$nm = "";
				foreach($getbarang as $rr){ 
					$nm = $rr['name'];
				
				}
			
			$am = ($rrr['jual'] - $rrr['totaldiskon']) *  $rrr['qty'];
			$temp_array[] = "('".$rrr['temp_sale_id']."','D089DFFA729F4A22816BD8838AB0813C','".$org_id."','1','".date('Y-m-d H:i:s')."','".$rrr['kasir']."','".$id_sales_key."','".$bill_no."','".$rrr['sku']."','".$rrr['qty']."','".$rrr['jual']."','".$rrr['totaldiskon']."','".$am."','0','".$rrr['discountname']."')";
		}
		
		
		$values_line = implode(", ",$temp_array); 

		$sql_salesline = "INSERT INTO pos_dsalesline (pos_dsalesline_key, ad_mclient_key, ad_morg_key, isactived, insertdate, insertby, pos_dsales_key, billno, sku, qty, price, discount, amount, issync, discountname) values ".$values_line."";
		
		$sql_sales = "INSERT INTO pos_dsales_new (billcode, pos_dsales_key, ad_mclient_key, ad_morg_key, isactived, insertdate, insertby, pos_medc_key, pos_dcashierbalance_key, pos_mbank_key, ad_muser_key, billno, billamount,paymentmethodname, membercard, paycashgiven, paygiven) VALUES ('".$bill_code."','".$id_sales_key."', 'D089DFFA729F4A22816BD8838AB0813C', '".$org_id."', '1', '".date('Y-m-d H:i:s')."', '".$rrr['kasir']."', '', '', '', '".$userid."', '".$bill_no."', '".$tot_jual."', 'CASH', '', '".$uang."', '0');";
		
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
		$sisa_debit = str_replace(',','',$_POST['sisa_debit']);
		$infak_debit = str_replace(',','',$_POST['infak_debit']);
		$approve_code = $_POST['approve_code'];
		$mesin_edc = $_POST['mesin_edc'];
		$nama_bank_debit = $_POST['nama_bank_debit'];
		$uang_debit = $_POST['uang_debit'];
		// echo $uang;
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
		$jum = $connec->query("select sum(jual * qty) totalharga from temp_sale where billno = '".$_COOKIE['bill_no']."'");
		foreach($jum as $rrr){
			
			$tot_jual = $rrr['totalharga'];
			
		}
		
		foreach($temp as $rrr){
			
				$getbarang = $connec->query("select * from pos_mproduct where sku = '".$rrr['sku']."'");
				$nm = "";
				foreach($getbarang as $rr){ 
					$nm = $rr['name'];
				
				}
			
			$am = ($rrr['jual'] - $rrr['totaldiskon']) *  $rrr['qty'];
			$temp_array[] = "('".$rrr['temp_sale_id']."','D089DFFA729F4A22816BD8838AB0813C','".$org_id."','1','".date('Y-m-d H:i:s')."','".$rrr['kasir']."','".$id_sales_key."','".$no_struk_cook."','".$rrr['sku']."','".$rrr['qty']."','".$rrr['jual']."','".$rrr['totaldiskon']."','".$am."','0','".$rrr['discountname']."')";
		}
		
		
		$values_line = implode(", ",$temp_array); 

		$sql_salesline = "INSERT INTO pos_dsalesline (pos_dsalesline_key, ad_mclient_key, ad_morg_key, isactived, insertdate, insertby, pos_dsales_key, billno, sku, qty, price, discount, amount, issync, discountname) values ".$values_line."";
		
		$sql_sales = "INSERT INTO pos_dsales_new (billcode, bankname, edcno, approvecode, pos_dsales_key, ad_mclient_key, ad_morg_key, isactived, insertdate, insertby, pos_medc_key, pos_dcashierbalance_key, pos_mbank_key, ad_muser_key, billno, billamount,paymentmethodname, membercard, paycashgiven, paygiven) VALUES ('".$bill_code."', '".$nama_bank_debit."','".$mesin_edc."', '".$approve_code."', '".$id_sales_key."', 'D089DFFA729F4A22816BD8838AB0813C', '".$org_id."', '1', '".date('Y-m-d H:i:s')."', '".$rrr['kasir']."', '', '', '', '".$userid."', '".$no_struk_cook."', '".$tot_jual."', 
		'DEBIT', '', '".$sisa_debit."', '".$debit."');";
		
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
		$tot = $connec->query("SELECT SUM((qty*jual) - totaldiskon) total FROM temp_sale where billno = '".$_COOKIE['bill_no']."'");
  
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
					
				$diskon += $r1['discount'];
			
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
					'billamount'=>rupiah($r['billamount']),
					'paygiven'=>rupiah($r['paygiven']),
					'paycashgiven'=>rupiah($r['paycashgiven']),
					'donasiamount'=>rupiah($r['donasiamount']),
					'kembali'=>rupiah(($r['paycashgiven'] + $r['paygiven']) - $gt),
					'discount'=>rupiah($diskon),
					'grandtotal'=>rupiah($gt),
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
	}
}else if($_GET['modul'] == 'product'){
	
	
	if($_GET['act'] == 'list'){
		
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
					$nm = $rr['name'];
				
				}
				
				
				
				echo '<tr>
						<td>'.$no.'</td>
						<td>'.$r['sku'].'</td>
						<td>'.$r['barcode'].'</td>
						<td>'.$nm.'</td>
						<td>'.$r['qty'].'</td>
						<td>'.rupiah($r['jual']).'</td>
						<td>'.$r['diskon'].'</td>
						<td>'.rupiah($r['jual'] * $r['qty']).'</td>
						<td>-</td>
					</tr>';
				
				
				
				$no++;
				
			} 
				
		
		
	
	}else if($_GET['act'] == 'scan'){
		
		
		 $sku = $_POST['sku'];
		 
		 if($sku != ""){
		 $qty = $_POST['qty'];
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
				
				$sql_insert = "INSERT INTO temp_sale
			(sku, qty, jual, diskon, kasir, idmember, ispromo, jualnormal, barcode, created_date, `member`, m_product_id, maxqty, discount_print, billno, temp_sale_id)
			VALUES('".$r['sku']."', '".$qty."', '".$r['price']."', 0, '".$username."', '', '', '".$r['price']."', '".$r['barcode']."', '".date('Y-m-d H:i:s')."', 'N', '".$r['m_product_id']."', 0, 0, '".$_COOKIE['bill_no']."', '".guid()."');";
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
				"msg"=>'SKU tidak boleh kosong',
		  
			);
			 
			 
		 }
		 

		 
		
		 // echo $sql_insert;
		  echo json_encode($json_data); 
		 
		 
	}
}else if($_GET['modul'] == 'sync'){
	
	if($_GET['act'] == 'product'){
		
		
		
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
	}
	
}		
    

?>



		