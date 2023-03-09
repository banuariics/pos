<?php include "config/koneksi.php"; ?> 
<!DOCTYPE HTML>
<html>
<head>
<title>Login Physical Inventory</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="styles/css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="styles/css/style.css" rel='stylesheet' type='text/css' />
<link href="styles/css/font-awesome.css" rel="stylesheet"> 
<script src="styles/js/jquery-1.11.1.min.js"></script>
<script src="styles/js/modernizr.custom.js"></script>
<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
<link href="styles/css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="styles/js/metisMenu.min.js"></script>
<script src="styles/js/custom.js"></script>
<link href="styles/css/custom.css" rel="stylesheet">
</head> 
<body onload="cekVersion();">
	<div class="main-content">
		<div id="page-wrapper">
			<div class="main-page login-page">
			
			
			
				<h3 class="title1">Sign in My POS</h3>
				
				
				<?php $btnsync = "";
					
					
					$cmd4 = ['CREATE TABLE m_pi_users (
							ad_muser_key character varying(50),
							isactived numeric DEFAULT 1,
							userid character varying(45),
							username character varying(45),
							userpwd character varying(100),
							ad_org_id character varying(45),
							name character varying(32)
						);'
					];
					
					$result3 = $connec->query("SELECT 1 FROM information_schema.tables WHERE table_name = 'm_pi_users'" );
					if($result3->rowCount() == 0) {
						
						foreach ($cmd4 as $r){
								$create = $connec->exec($r);
								if($create){
									$cek = $connec->query("select * from m_pi_users ");
									$count = $cek->rowCount();
					 
									if($count == 0){
						
										echo '<button style="width: 100%" type="button" id="sync" class="btn btn-success" onclick="syncUser();">Sync Users</button>';
									}
								}
						}
						
					}else{
						
						$cek = $connec->query("select * from m_pi_users ");
						$count = $cek->rowCount();
					 
						if($count == 0){
						
							$btnsync = '<input type="text" class="user" id="kode_toko" placeholder="Masukan kode toko, jgn sampai salah ya" required="" autofocus>
							<button style="width: 100%" type="button" id="sync" class="btn btn-success" onclick="syncUser();">Sync Profile & Users</button><br><br>';
						}
					}
					
					$cmd5 = ["CREATE TABLE m_piversion (
							value character varying(10)
						);","insert into m_piversion (value) VALUES ('1')"
					];
					
					$result4 = $connec->query("SELECT 1 FROM information_schema.tables WHERE table_name = 'm_piversion'" );
					if($result4->rowCount() == 0) {
						foreach ($cmd5 as $r){
					
								$connec->exec($r);
								
						
						}
					}
					
					
					?>
				
				<div class="widget-shadow">
					<div class="login-body">
					
					
					
					
						<?php echo $btnsync; ?>	
					
					<form action="config/cek_login.php" method="POST">
						
					
						
					<font id="notif1" style="color: red; font-weight: bold"></font><br>
						
					
						
				
							<input type="text" class="user" name="user" placeholder="username" required="" autofocus>
							<input type="password" name="pwd" class="lock" placeholder="password">
							<input type="submit" name="Sign In" id="login" value="Masuk"></input>
							
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="footer">
		   <p>&copy; 2022 PT Idola Cahaya Semesta. All Rights Reserved</p>
		</div>
	</div>
	<script src="styles/js/jquery.nicescroll.js"></script>
	<script src="styles/js/scripts.js"></script>
   <script src="styles/js/bootstrap.js"> </script>
   
   
<script type="text/javascript">
  $('#btn-update').click(function(){
        var clickBtnValue = $(this).val();
        var ajaxurl = 'update.php',
        data =  {'action': clickBtnValue};
        $.post(ajaxurl, data, function (response) {
            // Response div goes here.
            
        });
    });

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


function syncUser(){
	
	var kt = $('#kode_toko').val();
	
if(kt != ""){
		$.ajax({
		url: "api/register.php?kt="+kt,
		type: "GET",
		beforeSend: function(){
			$('#sync').prop('disabled', true);
			$('#notif1').html("<font style='color: red'>Sedang melakukan sync, mohon tunggu..</font>");
		},
		success: function(dataResult){
			console.log(dataResult);
			var dataResults = JSON.parse(dataResult);
			if(dataResults.result=='1'){
				$('#notif1').html("<font style='color: green'>"+dataResults.msg+"</font>");
				location.reload();
			}else{
				location.reload();
				$('#notif1').html("<font style='color: green'>"+dataResult+"</font>");
				
			}
			// else {
				// $('#notif').html(dataResult.msg);
			// }
			
		}
	});
	
}else{
	$('#notif1').html("<font style='color: red'>Kode toko harus diisi</font>");
	
}

	
}

</script>
   
   
</body>
</html>