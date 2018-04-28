
	conn.onmessage = function(msg){
    	msg = JSON.parse(msg.data);
    	
    	$.ajax({
		  url: "../new_member_bc",
		  method: "POST",
		  data: {nim: msg.nim, id_registration: msg.registrasi},
		  success: function (data) {
		  	console.log(data);
		  	
    		if(msg.webhook == 1) return;
		  	if(data != 404 && $(".key").val() == msg.registrasi){
		  		$(".nodata").remove();
		  		
		  		current = (isNaN($(".number:last").html() * 1)) ? 0 : $(".number:last").html() * 1;
		  		number  = current + 1;
		     	$("#member").append(
		    		`<tr>
						<td class="number">${number}</td>
						<td>${data.nim}</td>
						<td>${data.nama}</td>
						<td>
							<a href="../lihat_anggota/${msg.nim}"><button class="button-small-3 button-green">Lihat</button></a>
							<a href="../hapus_anggota/${msg.nim}" onclick="return confirm('Yakin ingin menghapus?')"><button class="button-small-3 button-red">Hapus</button></a>
						</td>
					</tr>`
		    	);
		  	}
	      },
	      error: function (textStatus, errorThrown) {
	        console.log(textStatus + errorThrown);
	      }
		});
    }