<?php 

include "../config/koneksi.php";
ini_set('max_execution_time', '2000');
$kode_toko = $_GET['kt'];

$json_url1 = "https://pi.idolmartidolaku.com/api/action.php?modul=inventory&act=sync_profile&kode_toko=".$kode_toko;
$json1 = file_get_contents($json_url1);

$arr1 = json_decode($json1, true);
$jum1 = count($arr1);
$status = 0;
foreach($arr1 as $items) { //foreach element in $arr



$truncate_profile = $connec->query("TRUNCATE TABLE m_profile");

if($truncate_profile){
	$sp = 0;
	if($items['setpoint'] != ""){
		
		$sp = $items['setpoint'];
	}
	
	$sql1 = "INSERT INTO m_profile
	(storecode, alamat, alamat1, kota, tlp, ispkp, npwp, namanpwp, brand, storeid, storename, setpoint, tipepoint, footer1, footer2, footer3, tipe, lastconected)
	VALUES('".$items['value']."', '".$items['address1']."', '".$items['address2']."', '".$items['address2']."', '', '', 
	'', '', '".$items['address3']."', '".$items['ad_org_id']."', '".$items['name']."', '".$sp."', '".$items['tipepoint']."', '".$items['note1']."', '".$items['note2']."', '".$items['note3']."', 
	'".$items['type']."', '".$items['lastsyncdate']."');";
					
	$saveorg = $connec->query($sql1);
	if($saveorg){
		$status = 1;
		$truncate = $connec->query("TRUNCATE TABLE m_pi_users");
		if($truncate){
			$json_url = "https://pi.idolmartidolaku.com/api/action.php?modul=inventory&act=sync_user&org_id=".$items['ad_org_id'];
			$json = file_get_contents($json_url);

			$arr = json_decode($json, true);
			$jum = count($arr);
			
			$no = 0;
			foreach($arr as $item) { //foreach element in $arr
				$ad_muser_key 	= $item['ad_muser_key']; //etc
				$isactived 		= $item['isactived']; //etc
				$userid 		= $item['userid']; //etc
				$username 		= $item['username']; //etc
				$userpwd 		= $item['userpwd']; //etc
				$ad_org_id 		= $item['ad_org_id']; //etc
				$name 			= $item['name']; //etc
				
				$sql = "insert into m_pi_users (ad_muser_key, isactived, userid, username, userpwd, ad_org_id, name) 
					VALUES ('".$ad_muser_key."', '".$isactived."','".$userid."','".$username."','".$userpwd."','".$ad_org_id."','".$name."')";
				
				$statement1 = $connec->query($sql);
					
					
					 
					if($statement1){
						$no = $no+1;
						$status = 2;
					}				
			}
			
				
			
				
			
		}	
			
	
	}
	
	
	// echo $sql1;
	
	
}

}


if($status == 0){
	$json = array('result'=>'1', 'msg'=>'Gagal sync');
	
}else if($status == 1){
	
	$json = array('result'=>'1', 'msg'=>'Berhasil sync profile');
	
}else if($status == 2){
	
	$json = array('result'=>'1', 'msg'=>'Berhasil sync profile dan user');
	
}





$json_string = json_encode($json);	
echo $json_string;
			

