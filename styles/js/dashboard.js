var modal = document.getElementById("myModalBukaKasir");
var modal1 = document.getElementById("myModalBelumBuka");
var modal2 = document.getElementById("myModalReprint");
var modal3 = document.getElementById("myModalTutupKasir");
var modal4 = document.getElementById("myModalTutupHarian");


var span = document.getElementsByClassName("close")[0];
var span1 = document.getElementsByClassName("close")[1];
var span2 = document.getElementsByClassName("close")[2];
var span3 = document.getElementsByClassName("close")[3];
var span4 = document.getElementsByClassName("close")[4];

easyNumberSeparator({
			selector: '.cash',
		});

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

function reprint(){
	
	modal2.style.display = "block";
	
	span2.onclick = function() {
		modal2.style.display = "none";
	}
	
	window.onclick = function(event) {
		if (event.target == modal2) {
			modal2.style.display = "none";
			
		}
	}
}


function modal_tutup_kasir(){
	
	modal3.style.display = "block";
	
	span3.onclick = function() {
		modal3.style.display = "none";
	}
	
	window.onclick = function(event) {
		if (event.target == modal3) {
			modal3.style.display = "none";
			
		}
	}
}

function modal_tutup_harian(){
	
	modal4.style.display = "block";
	
	span4.onclick = function() {
		modal4.style.display = "none";
	}
	
	window.onclick = function(event) {
		if (event.target == modal4) {
			modal4.style.display = "none";
			
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

function tutup_kasir(){
	var total_cash = document.getElementById("total_cash").value;
	
	$.ajax({
		url: "api/action.php?modul=users&act=tutup_kasir",
		type: "POST",
		data : {total_cash: total_cash},
		beforeSend: function(){
			// document.getElementById("notif").innerHTML = 'Proses load';
			$("#overlay").fadeIn(300);
		},
		success: function(dataResult){
			console.log(dataResult);
			// console.log(dataResult);
			var dataResults = JSON.parse(dataResult);
			// console.log(dataResults.id);
			if(dataResults.result == 1){
				
				cetak_tutup_kasir(dataResults.id);
				// location.reload();
			}else{
				
				$("#overlay").fadeOut(300);
				// document.getElementById("notif").innerHTML = 'Gagal submit order';
			}
			
		}
	});
	
}

function tutup_harian(){
	var tgl_tutup_harian = document.getElementById("tgl_tutup_harian").value;
	var notes_tutup_harian = document.getElementById("notes_tutup_harian").value;
	
	$.ajax({
		url: "api/action.php?modul=users&act=tutup_harian",
		type: "POST",
		data : {tgl_tutup_harian: tgl_tutup_harian, notes_tutup_harian: notes_tutup_harian},
		beforeSend: function(){
			// document.getElementById("notif").innerHTML = 'Proses load';
			$("#overlay").fadeIn(300);
		},
		success: function(dataResult){
			console.log(dataResult);
			// console.log(dataResult);
			var dataResults = JSON.parse(dataResult);
			// console.log(dataResults.id);
			if(dataResults.result == 1){
				
				cetak_tutup_harian(dataResults.id);
				// location.reload();
			}else{
				document.getElementById("notif_tutup").innerHTML = dataResults.msg;
				
				$("#overlay").fadeOut(300);
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
				document.getElementById("notif_buka_kasir").innerHTML = dataResults.msg;
			}
			
		}
	});
	
}

function reprint_saldo_awal(){
  	$.ajax({
		url: "api/action.php?modul=users&act=reprint_buka_kasir",
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



function reprint_tutup_kasir(id){
	// alert(id);
  	$.ajax({
		url: "api/action.php?modul=users&act=cetak_tutup_kasir&id="+id,
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

					cetakTutup(
						dataResult.alamat, 
						dataResult.alamat1, 
						dataResult.kota, 
						dataResult.brand, 
						dataResult.insertby, 
						dataResult.startdate, 
						dataResult.balanceamount, 
						dataResult.insertdate, 
						dataResult.inserttime,
						dataResult.m_penjualan,
						dataResult.m_diskon,
						dataResult.m_penjualan_bersih,
						dataResult.m_redeem,
						dataResult.m_tot_noncash,
						dataResult.m_cashin_system,
						dataResult.m_infak,
						dataResult.m_cashin_seharusnya,
						dataResult.m_cashin_drawer,
						dataResult.m_variant,
						dataResult.m_total_transfer,
						dataResult.kasir,
						dataResult.line
					);
				
				modal1.style.display = "none";
			}else{
				
				console.log(dataResult);
			}
			
			$("#overlay").fadeOut(300);
	
		}
	}); // sendtoprinter();
}


function cetak_tutup_kasir(id){
	// alert(id);
  	$.ajax({
		url: "api/action.php?modul=users&act=cetak_tutup_kasir&id="+id,
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
					cetakTutup(
						dataResult.alamat, 
						dataResult.alamat1, 
						dataResult.kota, 
						dataResult.brand, 
						dataResult.insertby, 
						dataResult.startdate, 
						dataResult.balanceamount, 
						dataResult.insertdate, 
						dataResult.inserttime,
						dataResult.m_penjualan,
						dataResult.m_diskon,
						dataResult.m_penjualan_bersih,
						dataResult.m_redeem,
						dataResult.m_tot_noncash,
						dataResult.m_cashin_system,
						dataResult.m_infak,
						dataResult.m_cashin_seharusnya,
						dataResult.m_cashin_drawer,
						dataResult.m_variant,
						dataResult.m_total_transfer,
						dataResult.kasir,
						dataResult.line
					);
				
				modal1.style.display = "none";
			}else{
				
				console.log(dataResult);
			}
			
			$("#overlay").fadeOut(300);
	
		}
	}); // sendtoprinter();
}

function cetak_tutup_harian(id){
	// alert(id);
  	$.ajax({
		url: "api/action.php?modul=users&act=cetak_tutup_harian&id="+id,
		type: "GET",
		processData: false,
		contentType: false,
		beforeSend: function(){
			// document.getElementById("notif").innerHTML = 'Proses load';
			$("#overlay").fadeIn(300);
		},
		success: function(dataResult){
			console.log(dataResult);
			var dataResult = JSON.parse(dataResult);
			
			
			if(dataResult.result == 1){

					cetakTutupHarian(
						dataResult.alamat, 
						dataResult.alamat1, 
						dataResult.kota, 
						dataResult.brand, 
						dataResult.insertby, 
						dataResult.startdate, 
						dataResult.balanceamount, 
						dataResult.insertdate, 
						dataResult.inserttime,
						dataResult.m_penjualan,
						dataResult.m_diskon,
						dataResult.m_penjualan_bersih,
						dataResult.m_redeem,
						dataResult.m_tot_noncash,
						dataResult.m_cashin_system,
						dataResult.m_infak,
						dataResult.m_cashin_seharusnya,
						dataResult.m_cashin_drawer,
						dataResult.m_variant,
						dataResult.m_variant_plus,
						dataResult.m_total_transfer,
						dataResult.kasir,
						dataResult.line
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
	 var strcontent = textbyline('LAPORAN BUKA SHIFT KASIR',38,'center')+'\r\n';
     strcontent+=textbyline(brand,38,'center')+'\r\n';
     strcontent+=textbyline(alamat,38,'center')+'\r\n';
     strcontent+=textbyline(alamat1,38,'center')+'\r\n';
     strcontent+=textbyline("=======================================",38,'center')+'\r\n';
     strcontent+=textbyline('KASIR      :',13,'left')+''+textbyline(insertby,27,'right')+'\r\n';
     strcontent+=textbyline('TANGGAL    :',13,'left')+''+textbyline(startdate,27,'right')+'\r\n';
     strcontent+=textbyline('SALDO AWAL :',13,'left')+''+textbyline(balanceamount,27,'right')+'\r\n';
     strcontent+=textbyline("=======================================",38,'center')+'\r\n';
     strcontent+=textbyline(insertdate+' '+inserttime,38,'left')+'\r\n';

    // print_text(strcontent);
	console.log(strcontent);
	
}

function cetakTutup(alamat, alamat1, kota, brand, insertby, startdate, balanceamount, insertdate, inserttime, m_penjualan,m_diskon,m_penjualan_bersih,m_redeem,m_tot_noncash,
m_cashin_system,m_infak,m_cashin_seharusnya, m_cashin_drawer,m_variant,m_total_transfer, kasir, line){
	 // var strcontent='';

     var strcontent = textbyline('LAPORAN TUTUP SHIFT KASIR',38,'center')+'\r\n';
     strcontent+=textbyline(brand,38,'center')+'\r\n';
     strcontent+=textbyline(alamat,38,'center')+'\r\n';
     strcontent+=textbyline(alamat1,38,'center')+'\r\n';
     strcontent+=textbyline("=======================================",38,'center')+'\r\n';
     strcontent+=textbyline('PENJUALAN',13,'left')+''+textbyline(m_penjualan.toString(),30,'right')+'\r\n';
     strcontent+=textbyline('DISKON',13,'left')+''+textbyline(m_diskon.toString(),33,'right')+'\r\n';
     strcontent+=textbyline("=======================================",38,'center')+'\r\n';
	 strcontent+=textbyline('PENJUALAN BERSIH',13,'left')+''+textbyline(m_penjualan_bersih.toString(),23,'right')+'\r\n';
	 strcontent+=textbyline("=======================================",38,'center')+'\r\n';
	  strcontent+=textbyline('#NON CASH#',38,'center')+'\r\n';
	  
	  for (let index = 0; index < line.length; ++index) {
				
				 strcontent+=textbyline(line[index].edcno.toString(),13,'left')+''+textbyline(line[index].billamount.toString(),39 - line[index].edcno.toString().length,'right')+'\r\n';
			
		}
	  

	  strcontent+=textbyline('REDEEM POINT',13,'left')+''+textbyline(m_redeem.toString(),27,'right')+'\r\n';
	  strcontent+=textbyline("=======================================",38,'center')+'\r\n';
	  strcontent+=textbyline('TOTAL NON CASH',13,'left')+''+textbyline(m_tot_noncash.toString(),25,'right')+'\r\n';
	   strcontent+=textbyline("=======================================",38,'center')+'\r\n';
	  strcontent+=textbyline('CASH IN SYSTEM',13,'left')+''+textbyline(m_cashin_system.toString(),25,'right')+'\r\n';
	  strcontent+=textbyline('INFAK',13,'left')+''+textbyline(m_infak.toString(),34,'right')+'\r\n';
	   strcontent+=textbyline("=======================================",38,'center')+'\r\n';
	  strcontent+=textbyline('CASH IN SEHARUSNYA',13,'left')+''+textbyline(m_cashin_system.toString(),21,'right')+'\r\n';
	  strcontent+=textbyline('CASH IN DRAWER',13,'left')+''+textbyline(m_cashin_drawer.toString(),25,'right')+'\r\n';
	   strcontent+=textbyline("=======================================",38,'center')+'\r\n';
	  strcontent+=textbyline('VARIANT',13,'left')+''+textbyline(m_variant.toString(),32,'right')+'\r\n';
	strcontent+=textbyline("=======================================",38,'center')+'\r\n';
	strcontent+=textbyline("***************************************",38,'center')+'\r\n';
	strcontent+=textbyline('#TOTAL TRANSFER CASH IN#',38,'center')+'\r\n';
	strcontent+=textbyline("***************************************",38,'center')+'\r\n';
	strcontent+=textbyline('TOTAL TRANSFER',13,'left')+''+textbyline(m_total_transfer.toString(),25,'right')+'\r\n';
	strcontent+=textbyline("=======================================",38,'center')+'\r\n';
	strcontent+=textbyline('#DATA VOID & REFUND KASIR#',38,'center')+'\r\n';
	strcontent+=textbyline("=======================================",38,'center')+'\r\n';
	strcontent+=textbyline("=======================================",38,'center')+'\r\n';
	strcontent+=textbyline(insertdate+' '+inserttime,38,'left')+'\r\n';
	strcontent+=textbyline('KASIR : '+kasir,13,'left');
     
	 
	 

    // print_text(strcontent);
	console.log(strcontent);
	
}


function cetakTutupHarian(alamat, alamat1, kota, brand, insertby, startdate, balanceamount, insertdate, inserttime, m_penjualan,m_diskon,m_penjualan_bersih,m_redeem,m_tot_noncash,
m_cashin_system,m_infak,m_cashin_seharusnya, m_cashin_drawer,m_variant,m_variant_plus,m_total_transfer, kasir,line){
	 // var strcontent='';

     var strcontent = textbyline('LAPORAN TUTUP HARIAN TOKO',38,'center')+'\r\n';
     strcontent+=textbyline(brand,38,'center')+'\r\n';
     strcontent+=textbyline(alamat,38,'center')+'\r\n';
     strcontent+=textbyline(alamat1,38,'center')+'\r\n';
     strcontent+=textbyline("=======================================",38,'center')+'\r\n';
     strcontent+=textbyline('PENJUALAN',13,'left')+''+textbyline(m_penjualan.toString(),30,'right')+'\r\n';
     strcontent+=textbyline('DISKON',13,'left')+''+textbyline(m_diskon.toString(),33,'right')+'\r\n';
     strcontent+=textbyline("=======================================",38,'center')+'\r\n';
	 strcontent+=textbyline('PENJUALAN BERSIH',13,'left')+''+textbyline(m_penjualan_bersih.toString(),23,'right')+'\r\n';
	 strcontent+=textbyline("=======================================",38,'center')+'\r\n';
	  strcontent+=textbyline('#NON CASH#',38,'center')+'\r\n';
	  strcontent+=textbyline('REDEEM POINT',13,'left')+''+textbyline(m_redeem.toString(),27,'right')+'\r\n';
	  strcontent+=textbyline("=======================================",38,'center')+'\r\n';
	  strcontent+=textbyline('TOTAL NON CASH',13,'left')+''+textbyline(m_tot_noncash.toString(),25,'right')+'\r\n';
	   strcontent+=textbyline("=======================================",38,'center')+'\r\n';
	  strcontent+=textbyline('CASH IN SYSTEM',13,'left')+''+textbyline(m_cashin_system.toString(),25,'right')+'\r\n';
	  strcontent+=textbyline('INFAK',13,'left')+''+textbyline(m_infak.toString(),34,'right')+'\r\n';
	   strcontent+=textbyline("=======================================",38,'center')+'\r\n';
	  strcontent+=textbyline('CASH IN SEHARUSNYA',13,'left')+''+textbyline(m_cashin_seharusnya.toString(),21,'right')+'\r\n';
	  strcontent+=textbyline('CASH IN DRAWER',13,'left')+''+textbyline(m_cashin_drawer.toString(),25,'right')+'\r\n';
	   strcontent+=textbyline("=======================================",38,'center')+'\r\n';
	  strcontent+=textbyline('VARIANT (+)',13,'left')+''+textbyline(m_variant_plus.toString(),28,'right')+'\r\n';
	  strcontent+=textbyline('VARIANT (-)',13,'left')+''+textbyline(m_variant.toString(),28,'right')+'\r\n';
	strcontent+=textbyline("=======================================",38,'center')+'\r\n';
	  strcontent+=textbyline('#CATATAN TUTUP HARIAN#',38,'center')+'\r\n';
	strcontent+=textbyline("=======================================",38,'center')+'\r\n';
	 strcontent+=textbyline('Oke Cuy',13,'left')+'\r\n';
	strcontent+=textbyline("***************************************",38,'center')+'\r\n';
	strcontent+=textbyline('#TOTAL TRANSFER CASH IN#',38,'center')+'\r\n';
	strcontent+=textbyline("***************************************",38,'center')+'\r\n';
	strcontent+=textbyline('TOTAL TRANSFER',13,'left')+''+textbyline(m_total_transfer.toString(),25,'right')+'\r\n';
	strcontent+=textbyline("=======================================",38,'center')+'\r\n';
	strcontent+=textbyline('#DATA VOID & REFUND KASIR#',38,'center')+'\r\n';
	strcontent+=textbyline("=======================================",38,'center')+'\r\n';
	 strcontent+=textbyline('JML VOID (X)',13,'left')+''+textbyline("0",27,'right')+'\r\n';
	 strcontent+=textbyline('TOTAL VOID',13,'left')+''+textbyline("0",29,'right')+'\r\n';
	 strcontent+=textbyline('REFUND',13,'left')+''+textbyline("0",33,'right')+'\r\n';
	strcontent+=textbyline("=======================================",38,'center')+'\r\n';
	 strcontent+=textbyline('#REKAP OMSET KATEGORI#',38,'center')+'\r\n';
	strcontent+=textbyline("=======================================",38,'center')+'\r\n';
	
	for (let index = 0; index < line.length; ++index) {
				
				 strcontent+=textbyline(line[index].kategori.toString(),13,'left')+''+textbyline(line[index].amount.toString(),39 - line[index].kategori.toString().length,'right')+'\r\n';
			
		}
	
	
	strcontent+=textbyline("=======================================",38,'center')+'\r\n';
	 strcontent+=textbyline('GRAND TOTAL',13,'left')+''+textbyline(m_penjualan.toString(),28,'right')+'\r\n';
	 strcontent+=textbyline("=======================================",38,'center')+'\r\n';
	strcontent+=textbyline(insertdate+' '+inserttime,38,'left')+'\r\n';
	strcontent+=textbyline('KASIR : '+kasir,13,'left');
     
	 
	 

    // print_text(strcontent);
	console.log(strcontent);
	// console.log(line);
	
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