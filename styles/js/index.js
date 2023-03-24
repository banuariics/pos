load_table();
$(function() {
const UP = 38;
const DOWN = 40;
const ARROWS = [UP, DOWN];
const HIGHLIGHT = 'highlight_row';
let $table = $('.table_product');
var pressed = false;
$('#deskripsi1').on('keydown', function(e) {
$table = $('.table_product');

let key = e.which;
if (ARROWS.includes(key)) {
  let selectedRow = -1;
  //let $rows = $table.find('tr');
  let $rows = $table.find('tbody tr:not(".hidden")');
  $rows.each(function(i, row) {
    if ($(row).hasClass(HIGHLIGHT)) {
      selectedRow = i;
    }
  });
  
  
  
  if (key == UP && selectedRow > 0) {
    $rows.removeClass(HIGHLIGHT);
    $rows.eq(selectedRow - 1).addClass(HIGHLIGHT);
	//alert(selectedRow);
  } else if (key == DOWN && selectedRow < $rows.length - 1) {
    $rows.removeClass(HIGHLIGHT);
    $rows.eq(selectedRow + 1).addClass(HIGHLIGHT);
   //alert(selectedRow);
  }


}
});


 $('#deskripsi1').on('keyup', function(e) {
  // $(".input-element").on('keyup',function(e) {
      if(e.which == 13) {
		  pressed = false; 
      // alert($table.find("tbody tr.highlight_row td:nth-child(2)").html());    
	  
	  // document.getElementById("sku").value=$table.find("tbody tr.highlight_row td:nth-child(2)").html();
	  if($table.find("tbody tr.highlight_row td:first").html() != undefined){
		   document.getElementById("sku").value=$table.find("tbody tr.highlight_row td:first").html();
		   $("#qty").focus();

	  }
	  
	 pressed = true;
	 
	  
     
      setTimeout(function() {
				
                pressed = false;
            }, 500);
  }
});




});


function cari_barang(){
	var desk = document.getElementById("deskripsi").value;
	
	$.ajax({
		url: "api/action.php?modul=product&act=list_again&desk="+desk,
		type: "GET",
		processData: false,
		contentType: false,
		beforeSend: function(){
			document.getElementById("notif").innerHTML = 'Proses load';
			$("#overlay").fadeIn(300);
		},
		success: function(dataResult){
			console.log(dataResult);
			document.querySelector('#idTableItemList > tbody').innerHTML = dataResult;
			$("#overlay").fadeOut(300);
			$("#deskripsi1").focus();
			document.getElementById("notif").innerHTML = 'Selesai load';
			$("#sku").val("");
			
			
			
			$table = $('.table_product');
			
		}
	});
}





function myFunction(){
var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("deskripsi");
  filter = input.value.toUpperCase();
  table = document.getElementById("idTableItemList");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    td1 = tr[i].getElementsByTagName("td")[3];
    if (td) {
      txtValue = td.textContent || td.innerText;
      txtValue1 = td1.textContent || td1.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      }else if(txtValue1.toUpperCase().indexOf(filter) > -1){
		tr[i].style.display = "";  
	  } else {
        tr[i].style.display = "none";
      }
    }       
  }
	
}

easyNumberSeparator({
			selector: '.cash',
		});
var modal = document.getElementById("myModal");
var modal1 = document.getElementById("myModalTunai");
var modal_reprint = document.getElementById("myModalReprint");
var modal_debit = document.getElementById("myModalDebit");
var modal_refund = document.getElementById("myModalRefund");
var modal_promo = document.getElementById("myModalPromo");
var modal_promo_reguler = document.getElementById("myModalPromoReguler");
var modal_promo_member = document.getElementById("myModalPromoMember");
var modal_promo_murah = document.getElementById("myModalPromoMurah");
var modal_pending = document.getElementById("myModalPending");
var modal_void = document.getElementById("myModalVoid");
var modal_kredit = document.getElementById("myModalKredit");

var span = document.getElementsByClassName("close")[0];
var span1 = document.getElementsByClassName("close")[1];
var span3 = document.getElementsByClassName("close")[2];
var span4 = document.getElementsByClassName("close")[3];
var span5 = document.getElementsByClassName("close")[4];
var span6 = document.getElementsByClassName("close")[5];
var span7 = document.getElementsByClassName("close")[6];
var span8 = document.getElementsByClassName("close")[7];
var span9 = document.getElementsByClassName("close")[8];
var span10 = document.getElementsByClassName("close")[9];
var span11 = document.getElementsByClassName("close")[10];
var span12 = document.getElementsByClassName("close")[11];


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



span5.onclick = function() {
	modal_refund.style.display = "none";
}

window.onclick = function(event) {
	if (event.target == modal_refund) {
		modal_refund.style.display = "none";
	}
}


span6.onclick = function() {
	modal_promo.style.display = "none";
}

window.onclick = function(event) {
	if (event.target == modal_promo) {
		modal_promo.style.display = "none";
	}
}

// span10.onclick = function() {
	// modal_pending.style.display = "none";
// }

// window.onclick = function(event) {
	// if (event.target == modal_pending) {
		// modal_pending.style.display = "none";
	// }
// }

span11.onclick = function() {
	modal_pending.style.display = "none";
}

window.onclick = function(event) {
	if (event.target == modal_pending) {
		modal_pending.style.display = "none";
	}
}

span12.onclick = function() {
	modal_void.style.display = "none";
}

window.onclick = function(event) {
	if (event.target == modal_void) {
		modal_void.style.display = "none";
	}
}

function tunai(){
	setTimeout(function(){ 
					$("#uang").focus();
				}, 150);
	// document.getElementById("uang").focus();
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


$("body").keydown(function(e){
	var total = document.getElementById("total").value;	
	var keyCode = e.keyCode || e.which;
	 if(keyCode == "112"){ //F1
			e.preventDefault();
			document.getElementById("sku").focus();
			 
			 
	}  
	
	if (keyCode == "27") { 
		$('.modal').hide();
	}
	
	if(keyCode == "113"){  //F2
			 
			modal_void.style.display = "block";
			list_spv();
			 
		 }  
		 
	if(keyCode == "114"){  //F3
			e.preventDefault();
			modal_reprint.style.display = "block";
			document.getElementById("no_struk").focus();
			 
			 
	}  
	
	
	if(keyCode == "115"){  //F4
			e.preventDefault();
			modal_refund.style.display = "block";
			document.getElementById("no_struk_refund").focus();
			 
			 
	}  
	
	if(keyCode == "116"){  //F5
			e.preventDefault();
			modal_promo.style.display = "block";
			setTimeout(function(){ 
					$("#reguler_promo").focus();
				}, 150);
			 
			 
	}  
	
	if(keyCode == "117"){  //F6
			e.preventDefault();
			modal_pending.style.display = "block";
			setTimeout(function(){ 
					$("#pending_ok").focus();
				}, 150);
			
			
			// pending();	
			 
	}  
		 
	 if(keyCode == "118"){  //F7
		e.preventDefault();
			if(total != 0){
				// $('#myModal').on('shown.bs.modal', function(e){
					// $('#tunai').focus();
				// });
				setTimeout(function(){ 
					$("#tunai").focus();
				}, 150);
				
				modal.style.display = "block";
				document.getElementById("uang").focus(); 
				list_bank();
				list_edc();
			}

	
		 }   
		 
		 
	 if(keyCode == "119"){  //F8
		// e.preventDefault();
			
				
				
				document.getElementById("qty").focus(); 
			
	
		 }   
		 
		 if(keyCode == "120"){  //F9
		// e.preventDefault();
			
				
				
				location.reload();
			
	
		 }   
		 
		  if(keyCode == "121"){  //F10
			e.preventDefault();
			
				document.getElementById("deskripsi").value = ""; 
				
				document.getElementById("deskripsi").focus(); 
			
	
		 }   
		 
		 
		 if(keyCode == "122"){  //F11
			e.preventDefault();
			recall();	
			 
		}  
		
		if(keyCode == "123"){  //F12
			e.preventDefault();
			logout();	
			 
		}  
		
		if(keyCode == "36"){  //HOME
			e.preventDefault();
			
			 location.href = "dashboard.php";
		}  
		 
});


function logout(){
	
	$.ajax({
		url: "logout.php",
		type: "GET",
		processData: false,
		contentType: false,
		beforeSend: function(){
			document.getElementById("notif").innerHTML = 'Proses load';
			$("#overlay").fadeIn(300);
		},
		success: function(dataResult){
			console.log(dataResult);
			var dataResults = JSON.parse(dataResult);
			if(dataResults.result == 1){
				
				
				location.href = "index.php";
			}
		}
	});
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

function kredit(){
	
	modal_kredit.style.display = "block";
	
	span12.onclick = function() {
		modal_kredit.style.display = "none";
	}
	
	window.onclick = function(event) {
		if (event.target == modal_kredit) {
			modal_kredit.style.display = "none";
		}
	}
}

function reguler_promo(){
	// alert("test");
	modal_promo_reguler.style.display = "block";
	listpromoreguler();
	span7.onclick = function() {
		modal_promo_reguler.style.display = "none";
	}
	
	window.onclick = function(event) {
		if (event.target == modal_promo_reguler) {
			modal_promo_reguler.style.display = "none";
			
		}
	}
}

function member_promo(){
	// alert("test");
	modal_promo_member.style.display = "block";
	listpromomember();
	span8.onclick = function() {
		modal_promo_member.style.display = "none";
	}
	
	window.onclick = function(event) {
		if (event.target == modal_promo_member) {
			modal_promo_member.style.display = "none";
			
		}
	}
}

function murah_promo(){
	// alert("test");
	modal_promo_murah.style.display = "block";
	listpromomurah();
	span9.onclick = function() {
		modal_promo_murah.style.display = "none";
	}
	
	window.onclick = function(event) {
		if (event.target == modal_promo_murah) {
			modal_promo_murah.style.display = "none";
			
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


function caraBayar(){
	var cara_bayar = document.getElementById("cara_bayar").value;
	
	if(cara_bayar == 'debit'){
		
		$("#btn-order-debit").css("display", "none");
		
		$('#redeem_debit').attr('readonly', false);
		$('#debit').attr('readonly', false);
		$('#sisa_debit').attr('readonly', false);
		$('#uang_debit').attr('readonly', false);
		$('#infak_debit').attr('readonly', false);
		
	}else if(cara_bayar == 'kredit'){
		
		getTotal();
		
		
		$("#btn-order-debit").css("display", "block");
		
		$('#redeem_debit').val('0');
		// $('#debit').attr('readonly', true);
		$('#sisa_debit').val('0');
		$('#uang_debit').val('0');
		$('#infak_debit').val('0');
		
		$('#redeem_debit').attr('readonly', true);
		$('#debit').attr('readonly', true);
		$('#sisa_debit').attr('readonly', true);
		$('#uang_debit').attr('readonly', true);
		$('#infak_debit').attr('readonly', true);
	}
	
	
}

function cekKembalian(){
	var uang = document.getElementById("uang").value;
	var infak = document.getElementById("infak").value;
			$.ajax({
				url: "api/action.php?modul=sales&act=kembalian",
				type: "POST",
				data : {uang: uang, infak: infak},
				beforeSend: function(){
					document.getElementById("notif").innerHTML = 'Proses load';
				},
				success: function(dataResult){
					console.log(dataResult);
					var dataResults = JSON.parse(dataResult);
					if(dataResults.result == 1){
						
						$("#overlay").fadeOut(300);
						document.getElementById("kembalian").innerHTML = dataResults.msg;
						$("#btn-order").css("display", "block");
					}else{
						
						$("#overlay").fadeOut(300);
						document.getElementById("kembalian").innerHTML = dataResults.msg;
						$("#btn-order").css("display", "none");
					}
			
				}
			});
}

function cekKembalianDebit(){
	var debit = document.getElementById("debit").value;
	var infak_debit = document.getElementById("infak_debit").value;
	var uang_debit = document.getElementById("uang_debit").value;
	
			$.ajax({
				url: "api/action.php?modul=sales&act=kembalian_debit",
				type: "POST",
				data : {debit: debit, infak_debit: infak_debit, uang_debit: uang_debit},
				beforeSend: function(){
					document.getElementById("notif").innerHTML = 'Proses load';
				},
				success: function(dataResult){
					console.log(dataResult);
					var dataResults = JSON.parse(dataResult);
					if(dataResults.result == 1){
						document.getElementById("sisa_debit").value = dataResults.sisa_debit;
						
						$("#overlay").fadeOut(300);
						document.getElementById("kembalian_debit").innerHTML = dataResults.msg;
						$("#btn-order-debit").css("display", "block");
					}else{
						document.getElementById("sisa_debit").value = dataResults.sisa_debit;
						$("#overlay").fadeOut(300);
						document.getElementById("kembalian_debit").innerHTML = dataResults.msg;
						$("#btn-order-debit").css("display", "none");
					}
			
				}
			});
}




$("#table").on("blur", ".last:last", function(){
     $("#table").append('<tr><td><input type="text" autofocus/></td><td><input type="text" class="last" /></td></tr>');
     $("#table tr:last td:first input").focus();

});


function ubahQty(temp_sale_id){
		 	var qty_ubah = document.getElementById("qty_ubah"+temp_sale_id).value;
			var qty_lama = document.getElementById("qty_lama"+temp_sale_id).value;
			
			if(parseInt(qty_ubah) > parseInt(qty_lama)){
			$.ajax({
				url: "api/action.php?modul=sales&act=ubah_qty",
				type: "POST",
				data : {qty_ubah: qty_ubah, qty_lama: qty_lama, temp_sale_id: temp_sale_id},
				beforeSend: function(){
					document.getElementById("notif").innerHTML = 'Proses load';
					$("#overlay").fadeIn(300);
				},
				success: function(dataResult){
					// console.log(dataResult);
					console.log(dataResult);
					var dataResults = JSON.parse(dataResult);
					if(dataResults.result == 1){
						
						$("#overlay").fadeOut(300);
						// location.reload();
						showTampilan();
						getTotal();
						document.getElementById("notif").innerHTML = 'berhasil ubah qty';
					}else{
						
						$("#overlay").fadeOut(300);
						document.getElementById("notif").innerHTML = 'Gagal submit order';
					}
					
				}
			});
				
				
			}else{
		
				document.getElementById("notif").innerHTML = "VOID DULU";
			}


}




function submitOrder(){
	var uang = document.getElementById("uang").value;
	var infak = document.getElementById("infak").value;
	var total = document.getElementById("total").value;
	
	var intuang = parseInt(uang.split(",").join(""));
	var inttotal = parseInt(total.split(".").join(""));
	
	// alert(intuang+" "+inttotal);
	
	if(intuang >= inttotal){
	$.ajax({
		url: "api/action.php?modul=sales&act=order",
		type: "POST",
		data : {uang: uang, infak: infak},
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
	var cara_bayar = document.getElementById("cara_bayar").value;
	var total = document.getElementById("total").value;
	
	// alert(intuang+" "+inttotal);
	
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
			cara_bayar:cara_bayar,
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
			document.getElementById("total_debit").innerHTML = dataResult;
			document.getElementById("debit").value = dataResult;
			document.getElementById("total_kredit").value = dataResult;
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
var input_refund = document.getElementById("no_struk_refund");
var qtyinput = document.getElementById("qty");
var uang = document.getElementById("uang");
var no_struk = document.getElementById("no_struk");


no_struk.addEventListener("keypress", function(event) {
	 if (event.key === "Enter") {
		 
		 
		 preview(no_struk.value);
		 
	 }
	
});

uang.addEventListener("keypress", function(event) {
	 if (event.key === "Enter") {
		 
		 
		 
		 submitOrder();
		 
	 }
	
});
input.addEventListener("keypress", function(event) {
  if (event.key === "Enter") {
	  
	var sku = input.value;
	var qty = qtyinput.value;
	
	// if(qty < 1){
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
				$('#deskripsi').val("");
				load_table();
				showTampilan();
				getTotal();
				$('#sku').val("");
				$('#qty').val("1");
			}else{
				
				
				$('#notif').html(dataResults.msg);
			}
			
		}
	});
		
	// }else{
		
		// $('#notif').html("Minimal 1");
	// }
	
	
	

  }
});

input_refund.addEventListener("keypress", function(event) {
  if (event.key === "Enter") {
	  
	var no_struk_refund = input_refund.value;
	show_refund(no_struk_refund);
  }
});

function show_refund(no_struk_refund){
	
	$.ajax({
		url: "api/action.php?modul=sales&act=refund&no_struk_refund="+no_struk_refund,
		type: "GET",
		processData: false,
		contentType: false,
		beforeSend: function(){
			document.getElementById("notif").innerHTML = 'Proses load';
			$("#overlay").fadeIn(300);
		},
		success: function(dataResult){
			console.log(dataResult);
			document.querySelector('#tableRefund > tbody').innerHTML = dataResult;
			$("#overlay").fadeOut(300);
			
			document.getElementById("notif").innerHTML = 'Selesai load';
			
		}
	});
}


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
				//$('#deskripsi').val(dataResults.name);
				$('#deskripsi').val("");
				load_table();
				showTampilan();
				getTotal();
				$('#sku').val("");
				$('#sku').focus();
				$('#qty').val("1");
				
					
			}else{
				
				
				$('#notif').html(dataResults.msg);
			}
			
		}
	});
	

  }
});


function isValidURL() {

    $.ajax({
      url: "ping.php",
      type: "GET",
      success: function(data) {
		 console.log(data);
        document.getElementById("online").innerHTML = data;
      },
      error: function(){
        document.getElementById("online").innerHTML = data;
      }
    });

}

// var intervalId = window.setInterval(function(){
  // isValidURL();
// }, 5000);



function pending(){
	
	$.ajax({
		url: "api/action.php?modul=sales&act=pending",
		type: "GET",
		processData: false,
		contentType: false,
		beforeSend: function(){
			document.getElementById("notif").innerHTML = 'Proses load';
			$("#overlay").fadeIn(300);
		},
		success: function(dataResult){
		console.log(dataResult);
			var dataResult = JSON.parse(dataResult);
			if(dataResult.result == 1){
				
				location.reload();
				
			}else{
				modal_pending.style.display = "none";
				document.getElementById("notif").innerHTML = dataResult.msg;
			}
			
			// location.reload();
		}
	});
}

function recall(){
	
	$.ajax({
		url: "api/action.php?modul=sales&act=recall",
		type: "GET",
		processData: false,
		contentType: false,
		beforeSend: function(){
			document.getElementById("notif").innerHTML = 'Proses load';
			$("#overlay").fadeIn(300);
		},
		success: function(dataResult){
			console.log(dataResult);
			var dataResult = JSON.parse(dataResult);
			if(dataResult.result == 1){
				
				location.reload();
				
			}else{
				
				document.getElementById("notif").innerHTML = dataResult.msg;
			}
			
		}
	});
}

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
					0,
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


function preview(no_struk){
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
					var content = cetakStrukPreview(
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
					0,
					dataResult.header[index].line
					);
					
					document.getElementById("preview_reprint").innerHTML = content;
					
				}
				
				
				// modal_reprint.style.display = "none";
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
					1,
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




function cetakStruk(alamat, alamat1, kota, brand, footer1, footer2, footer3, npwp, billno, billcode, insertdate, inserttime, insertby, dpp, ppn, billamount, discount,grandtotal, paygiven, paycashgiven,donasiamount, kembali, reprint, line){
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
		  if (reprint == 1){
			   strcontent+=textbyline('REPRINT',38,'left')+'\r\n';
			  
		  }
        
		 
         strcontent+=textbyline('STRUK   :'+billcode,24,'left')+''+textbyline(inserttime,18,'right')+'\r\n';
         strcontent+=textbyline('TANGGAL :'+insertdate,18,'left')+''+textbyline(insertby,20,'right')+'\r\n';

        strcontent+=textbyline("=======================================",38,'center')+'\r\n';
        strcontent+=textbyline("Nama Barang",10,'center')+textbyline("Qty",5,'center')+textbyline("Harga",7,'center')+textbyline("Disc",10,'center')+textbyline("Total",6,'right')+'\r\n';
        strcontent+=textbyline("=======================================",38,'center')+'\r\n';
      
		for (let index = 0; index < line.length; ++index) {
				
				strcontent+=textbyline(line[index].name,38,'left')+'\r\n';
				strcontent+=textbyline(line[index].qty.toString(),13,'right')+textbyline(line[index].price,9,'right')+textbyline(line[index].discount.toString(),8,'right')+textbyline(line[index].amount.toString(),9,'right')+'\r\n';
			
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
          // print_text(strcontent);
          console.log(strcontent);
	
	
}


function cetakStrukPreview(alamat, alamat1, kota, brand, footer1, footer2, footer3, npwp, billno, billcode, insertdate, inserttime, insertby, dpp, ppn, billamount, discount,grandtotal, paygiven, paycashgiven,donasiamount, kembali, reprint, line){
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
  
	

         strcontent+=textbyline(brand,38,'center')+'<br>';
         strcontent+=textbyline(alamat,38,'center')+'<br>';
         strcontent+=textbyline(alamat1,38,'center')+'<br>';
		  if (reprint == 1){
			   strcontent+=textbyline('REPRINT',38,'left')+'<br>';
			  
		  }
        
		 
         strcontent+=textbyline('STRUK   :'+billcode,24,'left')+''+textbyline(inserttime,18,'right')+'<br>';
         strcontent+=textbyline('TANGGAL :'+insertdate,18,'left')+''+textbyline(insertby,20,'right')+'<br>';

        strcontent+=textbyline("=======================================",38,'center')+'<br>';
        strcontent+=textbyline("Nama Barang",10,'center')+textbyline("Qty",5,'center')+textbyline("Harga",7,'center')+textbyline("Disc",10,'center')+textbyline("Total",6,'right')+'<br>';
        strcontent+=textbyline("=======================================",38,'center')+'<br>';
      
		for (let index = 0; index < line.length; ++index) {
				
				strcontent+=textbyline(line[index].name,38,'left')+'<br>';
				strcontent+=textbyline(line[index].qty.toString(),13,'right')+textbyline(line[index].price,9,'right')+textbyline(line[index].discount.toString(),8,'right')+textbyline(line[index].amount.toString(),9,'right')+'<br>';
			
		}
		
      
          strcontent+=textbyline("=======================================",38,'center')+'<br>';
          strcontent+=textbyline("TOTAL",5,'left')+textbyline(billamount.toString(),34,'right')+'<br>';
		  
		   if (discount > 0){
			   
			   strcontent+=textbyline("DISKON    ",11,'left')+textbyline(discount.toString(),29,'right')+'<br>';
		   }
          
		  
		  
          if (strReedemPoint !== "" && strReedemPoint !== 0){
            strcontent+=textbyline("REEDEM POINT",8,'left')+textbyline(strReedemPoint.toString(),27,'right')+'<br>';
            };
          strcontent+=textbyline("GRAND TOTAL",11,'left')+textbyline(grandtotal.toString(),28,'right')+'<br>';
		   if (paygiven > 0){
			   
			    strcontent+=textbyline("BAYAR D/C  ",11,'left')+textbyline(paygiven.toString(),28,'right')+'<br>';
		   }
         
          strcontent+=textbyline("BAYAR CASH ",11,'left')+textbyline(paycashgiven,28,'right')+'<br>';
		  if (donasiamount > 0){
			  
			  strcontent+=textbyline("INFAK      ",11,'left')+textbyline(donasiamount,28,'right')+'<br>';
		  }
		  
          
          strcontent+=textbyline("KEMBALI    ",11,'left')+textbyline(kembali.toString(),28,'right')+'<br>';
          strcontent+=textbyline("=======================================",38,'center')+'<br>';
          if (isppn >0){
          strcontent+=textbyline("DPP :"+dpp,6,'left')+textbyline("PPN :"+ppn,20,'right')+'<br>';
          strcontent+=textbyline("=======================================",38,'center')+'<br>';
          if (strMemberId != ''){
            strcontent+=textbyline("SELAMAT ANDA MENDAPATKAN POINT",38,'center')+'<br>';
            strcontent+=textbyline("MEMBER   ",11,'left')+textbyline(strMemberName.toString(),28,'right')+'<br>';
            strcontent+=textbyline("POINT :  ",11,'left')+textbyline(strPointGive.toString(),28,'right')+'<br>';
          }
          strcontent+=textbyline("***************************************",38,'center')+'<br>';
          strcontent+=textbyline("NPWP :"+npwp,38,'center')+'<br>';
          };
          strcontent+=textbyline(strorgdesc,38,'center')+'<br>';
          strcontent+=textbyline("***************************************",38,'center')+'<br>';
          strcontent+=textbyline(footer1,38,'center')+'<br>';
          strcontent+=textbyline(footer2,38,'center')+'<br>';
          strcontent+=textbyline(footer3,38,'center')+'<br>';
          strcontent+=textbyline("***************************************",38,'center')+'<br>';
          strcontent+=textbyline(straddressdonasi,38,'center')+'<br>';
          // print_text(strcontent);
         return strcontent;
	
	
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


function clickRefund(sku){
	

		$('#refund_sku').val(sku);
        // alert(sku);


}


$('#idTableItemList').on('click', function(e){
	
	var id = $(e.target).closest('tr').find(".id").html();
	// alert("tes");
	$('#sku').val(id);
	document.getElementById("sku").focus();
});


function refund(){
	
	var refund_sku = $('#refund_sku').val();
	var refund_qty = $('#refund_qty').val();
	var no_struk_refund = $('#no_struk_refund').val();
	$.ajax({
		url: "api/action.php?modul=product&act=refund",
		type: "POST",
		data : {sku: refund_sku, qty: refund_qty, no_struk_refund: no_struk_refund},
		beforeSend: function(){
	
			$('#notif').html("<font style='color: red'>Sedang mencari items..</font>");
		},
		success: function(dataResult){
			console.log(dataResult);
			var dataResults = JSON.parse(dataResult);
			if(dataResults.result == 1){
				
				location.reload();
			}else{
				
				
				$('#notif').html(dataResults.msg);
			}
			
		}
	});
	
	
}



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
function listpromoreguler(){

           $('#tablePromoReguler').DataTable({
              "processing": true,
              "serverSide": true,
			  "destroy": true,
			  "searching": true,
              "ajax":{
                       "url": "api/action.php?modul=promo&act=reguler",
                       "dataType": "json",
					   "type": "POST"
                     },
              "columns": [
                  { "data": "sku" },
                  { "data": "nama_items" },
                  { "data": "harga_normal" },
				  { "data": "potongan" },
                  { "data": "harga_promo" },
                  { "data": "discountname" },
              ]  
 
          });
}

function listpromomember(){

           $('#tablePromoMember').DataTable({
              "processing": true,
              "serverSide": true,
			  "destroy": true,
			  "searching": true,
              "ajax":{
                       "url": "api/action.php?modul=promo&act=member",
                       "dataType": "json",
					   "type": "POST"
                     },
              "columns": [
                  { "data": "sku" },
                  { "data": "nama_items" },
                  { "data": "harga_normal" },
				  { "data": "potongan" },
                  { "data": "harga_promo" },
                  { "data": "discountname" },
              ]  
 
          });
}

function listpromomurah(){

           $('#tablePromoMurah').DataTable({
              "processing": true,
              "serverSide": true,
			  "destroy": true,
			  "searching": true,
              "ajax":{
                       "url": "api/action.php?modul=promo&act=murah",
                       "dataType": "json",
					   "type": "POST"
                     },
              "columns": [
                  { "data": "sku" },
                  { "data": "nama_items" },
                  { "data": "harga_normal" },
				  { "data": "potongan" },
                  { "data": "harga_promo" },
                  { "data": "discountname" },
              ]  
 
          });
}


// function filtertable(){
		// var desk = $('#deskripsi').val();

           // $('#idTableItemList').DataTable({
              // "processing": true,
              // "serverSide": true,
			  // "destroy": true,
			  // "searching": false,
              // "ajax":{
                       // "url": "api/action.php?modul=product&act=list",
                       // "dataType": "json",
                       // "type": "POST",
					   // "data": {
						   // "desk":desk
					   // }
                     // },
              // "columns": [
                  // { "data": "sku" },
                  // { "data": "barcode" },
                  // { "data": "shortcut" },
				  // { "data": "description" },
                  // { "data": "stockqty" },
				  // { "data": "price" },
              // ]  
 
          // });
// }
// filtertable();
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


function load_table(){
	var desk = document.getElementById("deskripsi").value;
	
	$.ajax({
		url: "api/action.php?modul=product&act=list_again&desk="+desk,
		type: "GET",
		processData: false,
		contentType: false,
		beforeSend: function(){
			document.getElementById("notif").innerHTML = 'Proses load';
			$("#overlay").fadeIn(300);
		},
		success: function(dataResult){
			console.log(dataResult);
			document.querySelector('#idTableItemList > tbody').innerHTML = dataResult;
			$("#overlay").fadeOut(300);
			
			document.getElementById("notif").innerHTML = 'Selesai load';
			
		}
	});
}


function list_spv(){
	
	
	$.ajax({
		url: "api/action.php?modul=users&act=list_spv",
		type: "GET",
		processData: false,
		contentType: false,
		beforeSend: function(){
			document.getElementById("notif").innerHTML = 'Proses load';
			$("#overlay").fadeIn(300);
		},
		success: function(dataResult){
			console.log(dataResult);
			document.querySelector('#spv').innerHTML = dataResult;
			$("#overlay").fadeOut(300);
			
			
		}
	});
}

function list_edc(){
	
	
	$.ajax({
		url: "api/action.php?modul=product&act=list_edc",
		type: "GET",
		processData: false,
		contentType: false,
		beforeSend: function(){
			document.getElementById("notif").innerHTML = 'Proses load';
			$("#overlay").fadeIn(300);
		},
		success: function(dataResult){
			console.log(dataResult);
			document.querySelector('#mesin_edc').innerHTML = dataResult;
			$("#overlay").fadeOut(300);
			
			
		}
	});
}

function list_bank(){
	
	
	$.ajax({
		url: "api/action.php?modul=product&act=list_bank",
		type: "GET",
		processData: false,
		contentType: false,
		beforeSend: function(){
			document.getElementById("notif").innerHTML = 'Proses load';
			$("#overlay").fadeIn(300);
		},
		success: function(dataResult){
			console.log(dataResult);
			document.querySelector('#nama_bank_debit').innerHTML = dataResult;
			$("#overlay").fadeOut(300);
			
			
		}
	});
}

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



 