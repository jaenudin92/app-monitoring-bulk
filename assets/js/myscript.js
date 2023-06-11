var save_method;
var tableuser;

function getBaseUrl()
{
	var url = location.href;
	var index = url.search("index.php");
	var base_url = url.substr(0,index);
	return base_url;
}

// menu
if ($(".bg-menu-theme .menu-inner > #menu-a > a").prop('href') == location.href) {
	$(".bg-menu-theme .menu-inner > #menu-a").addClass("active");
}else if ($(".bg-menu-theme .menu-inner > #menu-b > a").prop('href') == location.href) {
	$(".bg-menu-theme .menu-inner > #menu-b").addClass("active");
}else if ($(".bg-menu-theme .menu-inner > #menu-c > a").prop('href') == location.href) {
	$(".bg-menu-theme .menu-inner > #menu-c").addClass("active");
}else if ($(".bg-menu-theme .menu-inner > #menu-d > a").prop('href') == location.href) {
	$(".bg-menu-theme .menu-inner > #menu-d").addClass("active");
}else if ($(".bg-menu-theme .menu-inner > #menu-e > a").prop('href') == location.href) {
	$(".bg-menu-theme .menu-inner > #menu-e").addClass("active");
}else if ($(".bg-menu-theme .menu-inner > #menu-f > a").prop('href') == location.href) {
	$(".bg-menu-theme .menu-inner > #menu-f").addClass("active");
	// Get select option item group
	$(document).ready(function(){
		select_item_group();
		function select_item_group(){
			$("#item_group").ready(function(){

				var id=$(this).val();
				$.ajax({
					url : getBaseUrl()+"Product/get_list_item_group",
					method : "POST",
					data : {id: id},
					async : true,
					dataType : 'json',
					success: function(data){

						var html = '<option value=""> -- Pilih Item Group -- </option>';
						var i;
						for(i=0; i<data.length; i++){
							html += "<option value='"+data[i].item_group+"'>"+data[i].item_group+"</option>";
						}
						$('#item_group').append(html);

					}
				});
				return false;

			});
		}

		select_brand();
		function select_brand(){
			$("#brand").ready(function(){

				var id=$(this).val();
				$.ajax({
					url : getBaseUrl()+"Product/get_list_brand",
					method : "POST",
					data : {id: id},
					async : true,
					dataType : 'json',
					success: function(data){

						var html = '<option value=""> -- Pilih Brand -- </option>';
						var i;
						for(i=0; i<data.length; i++){
							html += "<option value='"+data[i].brand+"'>"+data[i].brand+"</option>";
						}
						$('#brand').append(html);

					}
				});
				return false;

			});
		}
	})

	// End select option item group
}else if ($(".bg-menu-theme .menu-inner > #menu-g > a").prop('href') == location.href) {
	$(".bg-menu-theme .menu-inner > #menu-g").addClass("active");

	// Get select option item group
	$(document).ready(function(){
		select_item_group();
		function select_item_group(){
			$("#item_group").ready(function(){

				var id=$(this).val();
				$.ajax({
					url : getBaseUrl()+"get_list_item_group",
					method : "POST",
					data : {id: id},
					async : true,
					dataType : 'json',
					success: function(data){

						var html = '<option value=""> -- Pilih Item Group -- </option>';
						var i;
						for(i=0; i<data.length; i++){
							html += "<option value='"+data[i].item_group+"'>"+data[i].item_group+"</option>";
						}
						$('#item_group').append(html);

					}
				});
				return false;

			});
		}

		select_brand();
		function select_brand(){
			$("#brand").ready(function(){

				var id=$(this).val();
				$.ajax({
					url : getBaseUrl()+"get_list_brand",
					method : "POST",
					data : {id: id},
					async : true,
					dataType : 'json',
					success: function(data){

						var html = '<option value=""> -- Pilih Brand -- </option>';
						var i;
						for(i=0; i<data.length; i++){
							html += "<option value='"+data[i].brand+"'>"+data[i].brand+"</option>";
						}
						$('#brand').append(html);

					}
				});
				return false;

			});
		}

		select_koordinat();
		function select_koordinat(){
			$("#koordinat").ready(function(){

				var id=$(this).val();
				$.ajax({
					url : getBaseUrl()+"get_list_koordinat",
					method : "POST",
					data : {id: id},
					async : true,
					dataType : 'json',
					success: function(data){

						var html = '<option value=""> -- Pilih Koordinat -- </option>';
						var i;
						for(i=0; i<data.length; i++){
							html += "<option value='"+data[i].koordinat+"'>"+data[i].koordinat+"</option>";
						}
						$('#koordinat').append(html);

					}
				});
				return false;

			});
		}
	})

	// End select option item group
}

// Dashboard
function informasiExpired(){
	$('#cardInformasiExpired').removeClass('d-none');
	$('#cardInformasiExpired').addClass('d-block');
	$('#cardInformasiWarning').addClass('d-none');
	$('#cardInformasiNonAktif').addClass('d-none');
}

function informasiWarning(){
	$('#cardInformasiWarning').removeClass('d-none');
	$('#cardInformasiWarning').addClass('d-block');
	$('#cardInformasiExpired').addClass('d-none');
	$('#cardInformasiNonAktif').addClass('d-none');
}

function informasiNonAktif(){
	$('#cardInformasiNonAktif').removeClass('d-none');
	$('#cardInformasiNonAktif').addClass('d-block');
	$('#cardInformasiWarning').addClass('d-none');
	$('#cardInformasiExpired').addClass('d-none');
}

$('.tableInformasi').DataTable({
	hover:false
});

// Function untuk kelola data user
$(document).ready(function(){

	tableuser = $('#userTable').DataTable({ 

		"lengthChange": false,
		"processing": true,
		"serverSide": true,
		"order": [],
		"ajax": {
			"url": getBaseUrl()+"User/list_user",
			"type": "POST"
		},
		"columnDefs": [
		{ 
	            "targets": [ -1 ], //last column
	            "orderable": false, //set not orderable
	        },
	        ],

	});
})

function reloadTableUser()
{
	tableuser.ajax.reload(null,false);
}

function addUser()
{
	save_method = 'add';
	$('#formuser')[0].reset();
	$('.msg').html('');
	$('#modal_form').modal('show');
	$('.modal-title').text('Add User');
	$('#labelfoto').text('foto (tidak wajib)');
	$('#labelpassword').text('Password');
}

function saveUser()
{

	$('#btnSave').text('saving...');
	$('#btnSave').attr('disabled',true);
	var url;

	if(save_method == 'add') {
		url = getBaseUrl()+"User/add_user";
	} else {
		url = getBaseUrl()+"User/update_user";
	}

	var form = $('#formuser')[0];
	var data = new FormData(form);

	$.ajax({
		url : url,
		type: "POST",
		data: data,
		dataType: "JSON",
		enctype: 'multipart/form-data',
		processData: false,
		contentType: false,
		success: function(response)
		{

			if(response.success)
			{
				$('#btnSave').text('save');
				$('#btnSave').attr('disabled',false);
				$('#formuser')[0].reset();
				$('#modal_form').modal('hide');
				Swal.fire({
					icon: 'success',
					title: 'Saved!',
					showConfirmButton: false,
					timer: 1200
				})
				reloadTableUser();
			}
			if (response.error) {
				if (response.fullname_error != '') {
					$("#msg-fullname").html(response.fullname_error);
				}else{
					$("#msg-fullname").html("");
				}
				if (response.username_error != '') {
					$("#msg-username").html(response.username_error);
				}else{
					$("#msg-username").html("");
				}
				if (response.password_error != '') {
					$("#msg-password").html(response.password_error);
				}else{
					$("#msg-password").html("");
				}
				if (response.confirmpassword_error != '') {
					$("#msg-confirmpassword").html(response.confirmpassword_error);
				}else{
					$("#msg-confirmpassword").html("");
				}
				if (response.level_error != '') {
					$("#msg-level").html(response.level_error);
				}else{
					$("#msg-level").html("");
				}
			}
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
        	Swal.fire({
        		icon: 'error',
        		text: 'Error adding / update data!',
        		showConfirmButton: false,
        		timer: 1200
        	})
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 

        }
    });
}

function editUser(id)
{
	save_method = 'update';
	$('#formuser')[0].reset();
	$('.msg').html('');
	$('#modal_form').modal('show');
	$('#username').attr('readonly',true);
	$('.modal-title').text('Edit User');
	$('#labelfoto').text('Ganti Foto (tidak wajib)');
	$('#labelpassword').text('Ganti Password');
	$.ajax({
		url : getBaseUrl()+"User/edit_user/"+id,
		type: "GET",
		dataType: "JSON",
		success: function(data)
		{

			$('[name="id"]').val(data.id);
			$('[name="fullname"]').val(data.nama_lengkap);
			$('[name="username"]').val(data.username);
			$('[name="level"]').val(data.level);

		},
		error: function (jqXHR, textStatus, errorThrown)
		{
			alert('Error get data from ajax');
		}
	});
}

function deleteUser(id)
{

	Swal.fire({
		text: 'Are you sure delete this data?',
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#696CFF',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes, delete it!'
	}).then((result) => {
		if (result.isConfirmed) {
			$.ajax({
				url : getBaseUrl()+"User/delete_user/"+id,
				type: "POST",
				dataType: "JSON",
				success: function(data)
				{
					Swal.fire({
						icon: 'success',
						text: 'Your data has been deleted',
						showConfirmButton: false,
						timer: 1200
					})
					reloadTableUser();
				},
				error: function (jqXHR, textStatus, errorThrown)
				{
					Swal.fire({
						icon: 'error',
						text: 'Error deleting data!',
						showConfirmButton: false,
						timer: 1500
					})
				}
			});
		}
	})
}

// End function kelola data user

// Function untuk kelola data brand
var tablebrand = '';
$(document).ready(function(){

	tablebrand = $('#brandTable').DataTable({ 

		"lengthChange": false,
		"processing": true,
		"serverSide": true,
		"order": [],
		"ajax": {
			"url": getBaseUrl()+"Brand/list_brand",
			"type": "POST"
		},
		"columnDefs": [
		{ 
	            "targets": [ -1 ], //last column
	            "orderable": false, //set not orderable
	        },
	        ],

	});
})

function reloadTableBrand()
{
	tablebrand.ajax.reload(null,false);
}

function addBrand()
{
	save_method = 'add';
	$('#formbrand')[0].reset();
	$('.msg').html('');
	$('#modal_form_brand').modal('show');
	$('.modal-title').text('Add Brand');
}

function saveBrand()
{

	$('#btnSavebrand').text('saving...');
	$('#btnSavebrand').attr('disabled',true);
	var url;

	if(save_method == 'add') {
		url = getBaseUrl()+"Brand/add_brand";
	} else {
		url = getBaseUrl()+"Brand/update_brand";
	}

	$.ajax({
		url : url,
		type: "POST",
		data:  $('#formbrand').serialize(),
		dataType: "JSON",
		success: function(response)
		{

			if(response.success)
			{
				$('#btnSavebrand').text('save');
				$('#btnSavebrand').attr('disabled',false);
				$('#formbrand')[0].reset();
				$('#modal_form_brand').modal('hide');
				Swal.fire({
					icon: 'success',
					title: 'Saved!',
					showConfirmButton: false,
					timer: 1200
				})
				reloadTableBrand();
			}
			if (response.error) {
				if (response.brand_error != '') {
					$("#msg-brand").html(response.brand_error);
				}else{
					$("#msg-brand").html("");
				}
			}
			$('#btnSavebrand').text('save');
			$('#btnSavebrand').attr('disabled',false);


		},
		error: function (jqXHR, textStatus, errorThrown)
		{
			Swal.fire({
				icon: 'error',
				text: 'Error adding / update data!',
				showConfirmButton: false,
				timer: 1200
			})
            $('#btnSavebrand').text('save'); //change button text
            $('#btnSavebrand').attr('disabled',false); //set button enable 

        }
    });
}

function editBrand(id)
{
	save_method = 'update';
	$('#formbrand')[0].reset();
	$('.msg').html('');
	$('#modal_form_brand').modal('show');

    //Ajax Load data from ajax
	$.ajax({
		url : getBaseUrl()+"Brand/edit_brand/"+id,
		type: "GET",
		dataType: "JSON",
		success: function(data)
		{

			$('[name="id"]').val(data.id);
			$('[name="brand"]').val(data.brand);

		},
		error: function (jqXHR, textStatus, errorThrown)
		{
			alert('Error get data from ajax');
		}
	});
}

function deleteBrand(id)
{

	Swal.fire({
		text: 'Are you sure delete this data?',
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#696CFF',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes, delete it!'
	}).then((result) => {
		if (result.isConfirmed) {
			$.ajax({
				url : getBaseUrl()+"Brand/delete_brand/"+id,
				type: "POST",
				dataType: "JSON",
				success: function(data)
				{
					Swal.fire({
						icon: 'success',
						text: 'Your data has been deleted',
						showConfirmButton: false,
						timer: 1200
					})
					reloadTableBrand();
				},
				error: function (jqXHR, textStatus, errorThrown)
				{
					Swal.fire({
						icon: 'error',
						text: 'Error deleting data!',
						showConfirmButton: false,
						timer: 1500
					})
				}
			});
		}
	})
}

// End function kelola data brand

// Function untuk kelola data item group
var tableitemgroup;
$(document).ready(function(){

	tableitemgroup = $('#itemgroupTable').DataTable({ 

		"lengthChange": false,
		"processing": true,
		"serverSide": true,
		"order": [],
		"ajax": {
			"url": getBaseUrl()+"Itemgroup/list_itemgroup",
			"type": "POST"
		},
		"columnDefs": [
		{ 
	            "targets": [ -1 ], //last column
	            "orderable": false, //set not orderable
	        },
	        ],

	});
})

function reloadTableItemgroup()
{
	tableitemgroup.ajax.reload(null,false);
}

function addItemgroup()
{
	save_method = 'add';
	$('#formitemgroup')[0].reset();
	$('.msg').html('');
	$('#modal_form_itemgroup').modal('show');
	$('.modal-title').text('Add Brand');
}

function saveItemgroup()
{

	$('#btnSavebrand').text('saving...');
	$('#btnSavebrand').attr('disabled',true);
	var url;

	if(save_method == 'add') {
		url = getBaseUrl()+"Itemgroup/add_itemgroup";
	} else {
		url = getBaseUrl()+"Itemgroup/update_itemgroup";
	}

	$.ajax({
		url : url,
		type: "POST",
		data:  $('#formitemgroup').serialize(),
		dataType: "JSON",
		success: function(response)
		{

			if(response.success)
			{
				$('#btnSaveitemgroup').text('save');
				$('#btnSaveitemgroup').attr('disabled',false);
				$('#formitemgroup')[0].reset();
				$('#modal_form_itemgroup').modal('hide');
				Swal.fire({
					icon: 'success',
					title: 'Saved!',
					showConfirmButton: false,
					timer: 1200
				})
				reloadTableItemgroup();
			}
			if (response.error) {
				if (response.brand_error != '') {
					$("#msg-itemgroup").html(response.itemgroup_error);
				}else{
					$("#msg-itemgroup").html("");
				}
			}
			$('#btnSaveitemgroup').text('save');
			$('#btnSaveitemgroup').attr('disabled',false);


		},
		error: function (jqXHR, textStatus, errorThrown)
		{
			Swal.fire({
				icon: 'error',
				text: 'Error adding / update data!',
				showConfirmButton: false,
				timer: 1200
			})
			$('#btnSaveitemgroup').text('save');
			$('#btnSaveitemgroup').attr('disabled',false);

		}
	});
}

function editItemgroup(id)
{
	save_method = 'update';
	$('#formitemgroup')[0].reset();
	$('.msg').html('');
	$('#modal_form_itemgroup').modal('show');

    //Ajax Load data from ajax
	$.ajax({
		url : getBaseUrl()+"Itemgroup/edit_itemgroup/"+id,
		type: "GET",
		dataType: "JSON",
		success: function(data)
		{

			$('[name="id"]').val(data.id);
			$('[name="itemgroup"]').val(data.item_group);

		},
		error: function (jqXHR, textStatus, errorThrown)
		{
			alert('Error get data from ajax');
		}
	});
}

function deleteItemgroup(id)
{

	Swal.fire({
		text: 'Are you sure delete this data?',
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#696CFF',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes, delete it!'
	}).then((result) => {
		if (result.isConfirmed) {
			$.ajax({
				url : getBaseUrl()+"Itemgroup/delete_itemgroup/"+id,
				type: "POST",
				dataType: "JSON",
				success: function(data)
				{
					Swal.fire({
						icon: 'success',
						text: 'Your data has been deleted',
						showConfirmButton: false,
						timer: 1200
					})
					reloadTableItemgroup();
				},
				error: function (jqXHR, textStatus, errorThrown)
				{
					Swal.fire({
						icon: 'error',
						text: 'Error deleting data!',
						showConfirmButton: false,
						timer: 1500
					})
				}
			});
		}
	})
}

// End function kelola data item group

// Function untuk kelola data Koordinat
var tablekoordinat;
$(document).ready(function(){

	tablekoordinat = $('#koordinatTable').DataTable({ 

		"lengthChange": false,
		"processing": true,
		"serverSide": true,
		"order": [],
		"ajax": {
			"url": getBaseUrl()+"Koordinat/list_koordinat",
			"type": "POST"
		},
		"columnDefs": [
		{ 
	            "targets": [ -1 ], //last column
	            "orderable": false, //set not orderable
	        },
	        ],

	});
})

function reloadTableKoordinat()
{
	tablekoordinat.ajax.reload(null,false);
}

function addKoordinat()
{
	save_method = 'add';
	$('#formkoordinat')[0].reset();
	$('.msg').html('');
	$('#modal_form_koordinat').modal('show');
	$('.modal-title').text('Add Koordinat');
}

function saveKoordinat()
{

	$('#btnSavebrand').text('saving...');
	$('#btnSavebrand').attr('disabled',true);
	var url;

	if(save_method == 'add') {
		url = getBaseUrl()+"Koordinat/add_koordinat";
	} else {
		url = getBaseUrl()+"Koordinat/update_koordinat";
	}

	$.ajax({
		url : url,
		type: "POST",
		data:  $('#formkoordinat').serialize(),
		dataType: "JSON",
		success: function(response)
		{

			if(response.success)
			{
				$('#btnSavekoordinat').text('save');
				$('#btnSavekoordinat').attr('disabled',false);
				$('#formkoordinat')[0].reset();
				$('#modal_form_koordinat').modal('hide');
				Swal.fire({
					icon: 'success',
					title: 'Saved!',
					showConfirmButton: false,
					timer: 1200
				})
				reloadTableKoordinat();
			}
			if (response.error) {
				if (response.brand_error != '') {
					$("#msg-koordinat").html(response.koordinat_error);
				}else{
					$("#msg-koordinat").html("");
				}
			}
			$('#btnSavekoordinat').text('save');
			$('#btnSavekoordinat').attr('disabled',false);


		},
		error: function (jqXHR, textStatus, errorThrown)
		{
			Swal.fire({
				icon: 'error',
				text: 'Error adding / update data!',
				showConfirmButton: false,
				timer: 1200
			})
			$('#btnSavekoordinat').text('save');
			$('#btnSavekoordinat').attr('disabled',false);

		}
	});
}

function editKoordinat(id)
{
	save_method = 'update';
	$('#formkoordinat')[0].reset();
	$('.msg').html('');
	$('#modal_form_koordinat').modal('show');

    //Ajax Load data from ajax
	$.ajax({
		url : getBaseUrl()+"koordinat/edit_koordinat/"+id,
		type: "GET",
		dataType: "JSON",
		success: function(data)
		{

			$('[name="id"]').val(data.id);
			$('[name="koordinat"]').val(data.koordinat);

		},
		error: function (jqXHR, textStatus, errorThrown)
		{
			alert('Error get data from ajax');
		}
	});
}

function deleteKoordinat(id)
{

	Swal.fire({
		text: 'Are you sure delete this data?',
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#696CFF',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes, delete it!'
	}).then((result) => {
		if (result.isConfirmed) {
			$.ajax({
				url : getBaseUrl()+"Koordinat/delete_koordinat/"+id,
				type: "POST",
				dataType: "JSON",
				success: function(data)
				{
					Swal.fire({
						icon: 'success',
						text: 'Your data has been deleted',
						showConfirmButton: false,
						timer: 1200
					})
					reloadTableKoordinat();
				},
				error: function (jqXHR, textStatus, errorThrown)
				{
					Swal.fire({
						icon: 'error',
						text: 'Error deleting data!',
						showConfirmButton: false,
						timer: 1500
					})
				}
			});
		}
	})
}

// End function kelola data Koordinat

// Function input product
function saveInputproduct()
{
	$('#btnSaveinputproduct').text('saving...');
	$('#btnSaveinputproduct').attr('disabled',true);

	$.ajax({
		url : getBaseUrl()+"add_product",
		type: "POST",
		data:  $('#forminputproduct').serialize(),
		dataType: "JSON",
		success: function(response)
		{

			if(response.success)
			{
				$('#btnSaveinputproduct').text('save');
				$('#btnSaveinputproduct').attr('disabled',false);
				$('#forminputproduct')[0].reset();
				$(".msg").text('');
				Swal.fire({
					icon: 'success',
					title: 'Saved!',
					showConfirmButton: false,
					timer: 1200
				})
			}
			if (response.error) {
				if (response.item_group_error != '') {
					$("#msg-item_group").html(response.item_group_error);
				}else{
					$("#msg-item_group").html("");
				}
				if (response.kode_item_error != '') {
					$("#msg-kode_item").html(response.kode_item_error);
				}else{
					$("#msg-kode_item").html("");
				}
				if (response.kode_standar_error != '') {
					$("#msg-kode_standar").html(response.kode_standar_error);
				}else{
					$("#msg-kode_standar").html("");
				}
				if (response.nama_item_error != '') {
					$("#msg-nama_item").html(response.nama_item_error);
				}else{
					$("#msg-nama_item").html("");
				}
				if (response.brand_error != '') {
					$("#msg-brand").html(response.brand_error);
				}else{
					$("#msg-brand").html("");
				}
				if (response.no_batch_error != '') {
					$("#msg-no_batch").html(response.no_batch_error);
				}else{
					$("#msg-no_batch").html("");
				}
				if (response.formula_error != '') {
					$("#msg-formula").html(response.formula_error);
				}else{
					$("#msg-formula").html("");
				}
				if (response.keterangan_error != '') {
					$("#msg-keterangan").html(response.keterangan_error);
				}else{
					$("#msg-keterangan").html("");
				}
				if (response.alokasi_error != '') {
					$("#msg-alokasi").html(response.alokasi_error);
				}else{
					$("#msg-alokasi").html("");
				}
				if (response.koordinat_error != '') {
					$("#msg-koordinat").html(response.koordinat_error);
				}else{
					$("#msg-koordinat").html("");
				}
				if (response.tgl_berlaku_mulai_error != '') {
					$("#msg-tgl_berlaku_mulai").html(response.tgl_berlaku_mulai_error);
				}else{
					$("#msg-tgl_berlaku_mulai").html("");
				}
				if (response.tgl_berlaku_sampai_error != '') {
					$("#msg-tgl_berlaku_sampai").html(response.tgl_berlaku_sampai_error);
				}else{
					$("#msg-tgl_berlaku_sampai").html("");
				}
				if (response.packaging_error != '') {
					$("#msg-packaging").html(response.packaging_error);
				}else{
					$("#msg-packaging").html("");
				}
				if (response.jumlah_error != '') {
					$("#msg-jumlah").html(response.jumlah_error);
				}else{
					$("#msg-jumlah").html("");
				}
			}
			$('#btnSaveinputproduct').text('save');
			$('#btnSaveinputproduct').attr('disabled',false);


		},
		error: function (jqXHR, textStatus, errorThrown)
		{
			Swal.fire({
				icon: 'error',
				text: 'Error adding data!',
				showConfirmButton: false,
				timer: 1200
			})
			$('#btnSaveinputproduct').text('save');
			$('#btnSaveinputproduct').attr('disabled',false);

		}
	});
}
// End function

// // Function untuk kelola data product

// $(document).ready(function () {
var tableproduct = $('#productTable').DataTable({
	"scrollX"  : true,
	"lengthChange": false,
	"searching" : false,
	"processing": true,
	"serverSide": true,
	"ajax": {
		"url": getBaseUrl()+"Product/getlistProduct",
		"type": 'POST',
		"data": function (data) {
			var item_group = $("#item_group").val();
			var brand = $("#brand").val();
			var status = $("#status").val();
			var datefrom = $("#datefrom").val();
			var dateto = $("#dateto").val();

			data.item_group = item_group;
			data.brand = brand;
			data.status = status;
			data.datefrom = datefrom;
			data.dateto = dateto;
		}
	},
	"fnRowCallback": function( row, data) {
		if ( data.status == "Warning" )
		{
			$('td', row).addClass('bg-warning text-white');
		}
		else if ( data.status == "Expired" )
		{
			$('td', row).addClass('bg-danger text-white');
		}
		else if ( data.status == "Non Aktif" )
		{
			$('td', row).addClass('bg-secondary text-white');
		}
	},
	'columns': [
		{ data: 'action' },
		{ data: 'item_group' },
		{ data: 'kode_item' },
		{ data: 'kode_standar' },
		{ data: 'nama_item' },
		{ data: 'brand' },
		{ data: 'no_batch' },
		{ data: 'formula' },
		{ data: 'keterangan' },
		{ data: 'alokasi' },
		{ data: 'koordinat' },
		{ data: 'tgl_berlaku_mulai' },
		{ data: 'tgl_berlaku_sampai' },
		{ data: 'peminjam' },
		{ data: 'perpanjangan_ke' },
		{ data: 'packaging' },
		{ data: 'jumlah' },
		{ data: 'expired' },
		{ data: 'status' }
		]

});
// });

function reloadTableProduct()
{
	$('#item_group').val('');
	$('#brand').val('');
	$('#status').val('');
	$('#datefrom').val('');
	$('#dateto').val('');
	tableproduct.ajax.reload();
}

function editProduct(id)
{
	save_method = 'update';
	$('#formeditproduct')[0].reset();
	$('.msg').html('');
	$('#modal_form_edit_product').modal('show');

    //Ajax Load data from ajax
	$.ajax({
		url : getBaseUrl()+"Product/edit_product/"+id,
		type: "GET",
		dataType: "JSON",
		success: function(data)
		{

			$('[name="id"]').val(data.id);
			$('[name="tglmulai"]').val(data.tgl_berlaku_mulai);
			$('[name="tglsampai"]').val(data.tgl_berlaku_sampai);
			$('[name="perpanjangan"]').val(data.perpanjangan_ke);
			$('[name="jmlh"]').val(data.jumlah);
			if (data.status == 'Aktif') {
				$('#radioStatusAktif').prop('checked', true);
			}else{
				$('#radioStatusNonAktif').prop('checked', true);	
			}

		},
		error: function (jqXHR, textStatus, errorThrown)
		{
			alert('Error get data from ajax');
		}
	});
}

function updateProduct()
{

	$('#btnUpdateProduct').text('saving...');
	$('#btnUpdateProduct').attr('disabled',true);

	$.ajax({
		url : getBaseUrl()+"Product/update_product",
		type: "POST",
		data:  $('#formeditproduct').serialize(),
		dataType: "JSON",
		success: function(response)
		{

			if(response.success)
			{
				$('#btnUpdateProduct').text('save');
				$('#btnUpdateProduct').attr('disabled',false);
				$('#formeditproduct')[0].reset();
				$('#modal_form_edit_product').modal('hide');
				Swal.fire({
					icon: 'success',
					title: 'Saved!',
					showConfirmButton: false,
					timer: 1200
				})
				reloadTableProduct();
			}
			if (response.error) {
				if (response.tglmulai_error != '') {
					$("#msg-tglmulai").html(response.tglmulai_error);
				}else{
					$("#msg-tglmulai").html("");
				}
			}
			if (response.error) {
				if (response.tglsampai_error != '') {
					$("#msg-tglsampai").html(response.tglsampai_error);
				}else{
					$("#msg-tglsampai").html("");
				}
			}
			if (response.error) {
				if (response.perpanjangan_error != '') {
					$("#msg-perpanjangan").html(response.perpanjangan_error);
				}else{
					$("#msg-perpanjangan").html("");
				}
			}
			if (response.error) {
				if (response.jmlh_error != '') {
					$("#msg-jmlh").html(response.jmlh_error);
				}else{
					$("#msg-jmlh").html("");
				}
			}
			$('#btnUpdateProduct').text('save');
			$('#btnUpdateProduct').attr('disabled',false);


		},
		error: function (jqXHR, textStatus, errorThrown)
		{
			Swal.fire({
				icon: 'error',
				text: 'Error adding / update data!',
				showConfirmButton: false,
				timer: 1200
			})
			$('#btnUpdateProduct').text('save');
			$('#btnUpdateProduct').attr('disabled',false);

		}
	});
}

function deleteProduct(id)
{

	Swal.fire({
		text: 'Are you sure delete this data?',
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#696CFF',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes, delete it!'
	}).then((result) => {
		if (result.isConfirmed) {
			$.ajax({
				url : getBaseUrl()+"Product/delete_product/"+id,
				type: "POST",
				dataType: "JSON",
				success: function(data)
				{
					Swal.fire({
						icon: 'success',
						text: 'Your data has been deleted',
						showConfirmButton: false,
						timer: 1200
					})
					reloadTableProduct();
				},
				error: function (jqXHR, textStatus, errorThrown)
				{
					Swal.fire({
						icon: 'error',
						text: 'Error deleting data!',
						showConfirmButton: false,
						timer: 1500
					})
				}
			});
		}
	})
}

function searchTableProduct() {

	if ($('#datefrom').val() != '' && $('#dateto').val() != '') {
		tableproduct.draw();
		return false;
	}if ($('#datefrom').val() == '' && $('#dateto').val() == '') {
		tableproduct.draw();
		return false;
	}else{
		Swal.fire({
			icon: 'error',
			text: 'Jika pilih tanggal harus diisi semua',
			showConfirmButton: false,
			timer: 1200
		})
	}

}

function exportTableProduct() {

	var item_group = $('#item_group').val();
	var brand = $('#brand').val();
	var status = $('#status').val();
	var datefrom = $('#datefrom').val();
	var dateto = $('#dateto').val();
	var url = getBaseUrl()+"Product/exportProduct?item_group="+item_group+"&brand="+brand+"&status="+status+"&datefrom="+datefrom+"&dateto="+dateto;

	if ($('#datefrom').val() != '' && $('#dateto').val() != '') {
		window.open(url,'_blank');
		return false;
	}if ($('#datefrom').val() == '' && $('#dateto').val() == '') {
		window.open(url,'_blank');
		return false;
	}else{
		Swal.fire({
			icon: 'error',
			text: 'Jika pilih tanggal harus diisi semua',
			showConfirmButton: false,
			timer: 1200
		})
	}

}

function uploadDataProduct()
{

	$('#btnUploadProduct').text('Loading...');
	$('#btnUploadProduct').attr('disabled',true);

	var form = $('#uploadDataProduct')[0];
	var data = new FormData(form);

	console.log(data);

	$.ajax({
		url : getBaseUrl()+'uploadproduct',
		type: "POST",
		data: data,
		dataType: "JSON",
		enctype: 'multipart/form-data',
		processData: false,
		contentType: false,
		success: function(response)
		{

			if(response.success)
			{
				// $('#btnUploadProduct').text('Upload');
				// $('#btnUploadProduct').attr('disabled',false);
				// form.reset();
				Swal.fire({
					icon: 'success',
					title: 'Saved!',
					showConfirmButton: false,
					timer: 1200
				})
				window.location.href = getBaseUrl();
			}
			if (response.error) {
				Swal.fire({
	        		icon: 'error',
	        		text: response.message,
	        		showConfirmButton: false,
	        		timer: 1500
	        	})
	        	form.reset();
			}
            $('#btnUploadProduct').text('Upload'); //change button text
            $('#btnUploadProduct').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
        	Swal.fire({
        		icon: 'error',
        		text: 'Error upload data!',
        		showConfirmButton: false,
        		timer: 1200
        	})
        	form.reset();
            $('#btnUploadProduct').text('Upload'); //change button text
            $('#btnUploadProduct').attr('disabled',false); //set button enable 

        }
    });
}

function downloadTemplate() {
	var url = getBaseUrl()+'../assets/fileupload/Template_upload.xlsx';
	window.location.href= url;
}

function modalSett(){
	$('#formsett')[0].reset();
	$('.msg').html('');
	$('#modalsetting').modal('show');
	$('.modal-title').text('Setting Masa Expired');

	$.ajax({
		url : getBaseUrl()+'home/getexpired',
		type: 'GET',
		dataType: 'JSON',
		success:function(result){
			$('#expired').val(result)
		}
	})
}

function saveSett(){
	var expired = $('#expired').val();
	if (expired >= 30) {
		$.ajax({
			url : getBaseUrl()+'home/updateexpired',
			type: 'POST',
			dataType: 'JSON',
			data:{expired},
			success:function(result){
				if (response = 'oke') {
					window.location.href=getBaseUrl();
				}
			}
		})
	}else{
		$("#msg-expired").html("Tidak boleh kurang dari 30 hari")
	}
}