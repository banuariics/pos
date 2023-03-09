<?php session_start();
include "koneksi.php";
$username = $_POST['user'];
$pwd = hash_hmac("sha256", $_POST['pwd'], 'marinuak');

$sql = "select ad_muser_key, userid, username, ad_org_id, name from m_pi_users where userid ='".$username."' 
and userpwd ='".$pwd."' and isactived = '1' group by userid,username,ad_org_id, name  limit 1";

$result = $connec->query($sql);

$rows = $result->rowCount();

$number_of_rows = $result->fetchColumn(); 
if($rows > 0){

	foreach ($connec->query($sql) as $row) {
			$_SESSION['userid'] = $row["userid"];
			$_SESSION['username'] = $row["username"];
			$_SESSION['org_key'] = $row["ad_org_id"];
			$_SESSION['name'] = $row["name"];
			$_SESSION['ad_muser_key'] = $row["ad_muser_key"];
			
			if($row["name"] == 'Audit'){
				
				$_SESSION['role'] = "Global";
			}else{
				$_SESSION['role'] = "Daily";
			}
			
			
			$sqll = "select storecode as value from m_profile ";

			$results = $connec->query($sqll);
			
			
			foreach ($results as $r) {
				$_SESSION['kode_toko'] = $r["value"];
				
			}



				
			header("Location: ../dashboard.php?".$_SESSION["username"]);
			
			
			
	}
	
}else{
	
	
			header("Location: ../index.php?pesan=Username/pass salah");
		}


	// header("Location: ../dashboard.php?".$_SESSION["username"]);

?>