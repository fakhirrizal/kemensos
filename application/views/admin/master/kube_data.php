<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script type="text/javascript">

	$(function(){

		$.ajaxSetup({
			type:"POST",
			url: "<?php echo site_url('/admin/Master/ajax_function')?>",
			cache: false,
		});

		$("#id_provinsi").change(function(){
			var value=$(this).val();
			$.ajax({
				data:{id:value,modul:'get_kabupaten_by_id_provinsi'},
				success: function(respond){
					$("#id_kabupaten").html(respond);
				}
			})
		});

		$("#id_provinsi2").change(function(){
			var value=$(this).val();
			$.ajax({
				data:{id:value,modul:'get_kabupaten_by_id_provinsi'},
				success: function(respond){
					$("#id_kabupaten2").html(respond);
				}
			})
		});

	})

</script>
<style media="all" type="text/css">
    .alignCenter { text-align: center; }
</style>
<ul class="page-breadcrumb breadcrumb">
	<li>
		<span>Master</span>
		<i class="fa fa-circle"></i>
	</li>
	<li>
		<span>Data Kube (Kelompok Usaha Bersama)</span>
	</li>
</ul>
<?= $this->session->flashdata('sukses') ?>
<?= $this->session->flashdata('gagal') ?>
<div class="page-content-inner">
	<div class="m-heading-1 border-yellow m-bordered" style="background-color:#FAD405;">
		<h3>Catatan</h3>
		<p> Untuk menambahkan data anggota Kube silahkan klik detil data kube-nya.</p>
	</div>
	<div class="row">
		<div class="col-md-12">
			<!-- BEGIN EXAMPLE TABLE PORTLET-->
			<div class="portlet light ">
				<div class="portlet-body">
					<div class="col-md-12">
						<form method='post' action='<?=site_url('admin_side/kube');?>'>
							<div class="form-group select2-bootstrap-prepend" >
								<label class="control-label col-md-3">Opsi pencarian berdasarkan wilayah</label>
								<div class="col-md-3">
									<select id='id_provinsi' name='id_provinsi' class="form-control" required>
										<option value="">-- Pilih Provinsi --</option>
										<?php
										foreach ($provinsi as $key => $value) {
											echo '<option value="'.$value->id_provinsi.'">'.$value->nm_provinsi.'</option>';
										}
										?>
									</select>
								</div>
								<div class="col-md-4">
									<select id='id_kabupaten' name='id_kabupaten' class="form-control">
										<option value="">-- Pilih Kabupaten/ Kota --</option>
									</select>
								</div>
								<div class="col-md-2">
									<button type="submit" class="btn btn-danger">Proses</button>
								</div>
							</div>
						</form>
					</div>
					<br>
					<br>
					<hr>
					<form action="#" method="post" onsubmit="return deleteConfirm();"/>
					<div class="table-toolbar">
						<!-- <div class="row">
							<div class="col-md-6">
								<div class="btn-group">
									<button type='submit' id="sample_editable_1_new" class="btn sbold red"> Hapus
										<i class="fa fa-trash"></i>
									</button>
								</div>
									<span class="separator">|</span>
									<a href="<?=base_url('admin_side/tambah_data_kube');?>" class="btn green uppercase">Tambah Data <i class="fa fa-plus"></i> </a>
									<button id="sample_editable_1_new" onclick="window.location.href='<?=base_url('Master/admin');?>'" class="btn sbold green"> Tambah Data Baru
										<i class="fa fa-plus"></i>
									</button>
							</div>
						</div> -->
						<div class="row">
							<div class="col-md-2">
								<div class="btn-group">
									<!-- <button type='submit' id="sample_editable_1_new" class="btn sbold red"> Hapus
										<i class="fa fa-trash"></i>
									</button> -->
								</div>
									<!-- <span class="separator">|</span> -->
									<a href="<?=base_url('admin_side/tambah_data_kube');?>" class="btn green uppercase">Tambah Data <i class="fa fa-plus"></i> </a>
							</div>
							<div class="col-md-10" style='text-align: right;'>
								<a href="#" class="btn btn-default" data-toggle="modal" data-target="#fe">Ekspor Data <i class="fa fa-cloud-download"></i></a>
								<span class="separator">|</span>
								<a href="#" class="btn btn-info" data-toggle="modal" data-target="#fi">Impor Data <i class="fa fa-cloud-upload"></i></a>
								<a href="<?=base_url()?>import_data_template/template_import_kube.xlsx" class="btn btn-warning">Unduh Template</a>
								<!-- <a href="<?=base_url()?>import_data_template/template_kube.xlsx" class="btn btn-warning">Unduh Template</a> -->
							</div>
						</div>
					</div>
					<table class="table table-striped table-bordered table-hover table-checkable order-column" style="overflow-x: auto;width: 120%;" id="tbl">
						<thead>
							<tr>
								<th width="3%">
									<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
										<input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" />
										<span></span>
									</label>
								</th>
								<th style="text-align: center;" width="4%"> # </th>
								<th style="text-align: center;"> Provinsi </th>
								<th style="text-align: center;"> Kabupaten </th>
								<th style="text-align: center;"> Kecamatan </th>
								<th style="text-align: center;"> Desa </th>
								<th style="text-align: center;"> ID Kube </th>
								<th style="text-align: center;"> Nama Kelompok </th>
								<th style="text-align: center;"> Alamat </th>
								<th style="text-align: center;"> Ketua Kelompok </th>
								<th style="text-align: center;"> No. HP </th>
								<th style="text-align: center;"> Tahun Program </th>
								<th style="text-align: center;"> Jenis Usaha Pokok </th>
								<th style="text-align: center;"> Jenis Usaha Pengembangan </th>
								<th style="text-align: center;"> Pendamping </th>
								<th style="text-align: center;"> ID Pendamping </th>
								<th style="text-align: center;"> Status </th>
								<th style="text-align: center;" width="7%"> Aksi </th>
							</tr>
						</thead>
						<!-- <tbody> -->
							<?php
							// $no = 1;
							// foreach ($data_tabel as $key => $value) {
							?>
							<!-- <tr class="odd gradeX">
								<td style="text-align: center;">
									<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
										<input type="checkbox" class="checkboxes" name="selected_id[]" value="#"/>
										<span></span>
									</label>
								</td>
								<td style="text-align: center;"><?= $no++.'.'; ?></td>
								<td style="text-align: center;">UD. Makmur Jaya Jati</td>
								<td style="text-align: center;">Jln. dr. Cipto 61, Proyonanggan Tengah, Batang 51211</td>
								<td style="text-align: center;">Imam Fajrul Falah</td>
								<td style="text-align: center;"><span class="label label-sm label-danger">Tidak Aktif</span></td>
								<td>
									<div class="btn-group" style="text-align: center;">
										<button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Aksi
											<i class="fa fa-angle-down"></i>
										</button>
										<ul class="dropdown-menu" role="menu">
											<li>
												<a href="<?=site_url('admin_side/detail_data_kube/');?>">
													<i class="icon-eye"></i> Detail Data </a>
											</li>
											<li>
												<a href="<?=site_url('admin_side/ubah_data_kube/');?>">
													<i class="icon-wrench"></i> Ubah Data </a>
											</li>
											<li>
												<a onclick="return confirm('Anda yakin?')" href="<?=site_url('admin_side/hapus_data_kube/');?>">
													<i class="icon-trash"></i> Hapus Data </a>
											</li>
										</ul>
									</div>
								</td>
							</tr> -->
							<?php
							// }
							?>
						<!-- </tbody> -->
					</table>
					</form>
					<script type="text/javascript" language="javascript" >
						$(document).ready(function(){
							$('#tbl').dataTable({
								"order": [[ 1, "asc" ]],
								"bProcessing": true,
								"ajax" : {
									type:"POST",
									url: "<?php echo site_url('admin/Master/json_kube')?>",
									data:{prov:"<?= $prov; ?>",kabkot:'<?= $kabkot; ?>'},
									cache: false
								},
								// "footerCallback": function ( row, data, start, end, display ) {
								// 	var api = this.api(), data;
								// 	var intVal = function ( i ) {
								// 		return typeof i === 'string' ?
								// 			i.replace(/[\$,]/g, '')*1 :
								// 			typeof i === 'number' ?
								// 				i : 0;
								// 	};
								// 	total = api
								// 		.column( 5 )
								// 		.data()
								// 		.reduce( function (a, b) {
								// 			return intVal(a) + intVal(b);
								// 		}, 0 );
								// 	pageTotal = api
								// 		.column( 5, { page: 'current'} )
								// 		.data()
								// 		.reduce( function (a, b) {
								// 			return intVal(a) + intVal(b);
								// 		}, 0 );
								// 	$( api.column( 5 ).footer() ).html(
								// 		'$ '+pageTotal +' ( $ '+ total +' Total)'
								// 		'$ '+ total
								// 	);

								// 	total2 = api
								// 		.column( 4 )
								// 		.data()
								// 		.reduce( function (a, b) {
								// 			return intVal(a) + intVal(b);
								// 		}, 0 );
								// 	pageTotal2 = api
								// 		.column( 4, { page: 'current'} )
								// 		.data()
								// 		.reduce( function (a, b) {
								// 			return intVal(a) + intVal(b);
								// 		}, 0 );
								// 	$( api.column( 4 ).footer() ).html(
								// 		'$ '+pageTotal2 +' ( $ '+ total2 +' Total)'
								// 		'$ '+ total2
								// 	);
								// },
								"aoColumns": [
											{ mData: 'checkbox', sClass: "alignCenter", "bSortable": false} ,
											{ mData: 'number', sClass: "alignCenter" },
											{ mData: 'nm_provinsi', sClass: "alignCenter" },
											{ mData: 'nm_kabupaten', sClass: "alignCenter" },
											{ mData: 'nm_kecamatan', sClass: "alignCenter" },
											{ mData: 'nm_desa', sClass: "alignCenter" },
											{ mData: 'no_kube', sClass: "alignCenter" },
											{ mData: 'nama_tim' },
											{ mData: 'alamat', sClass: "alignCenter" } ,
											{ mData: 'ketua', sClass: "alignCenter" } ,
											{ mData: 'no_hp', sClass: "alignCenter" } ,
											{ mData: 'tahun', sClass: "alignCenter" } ,
											{ mData: 'jenis_usaha', sClass: "alignCenter" },
											{ mData: 'jenis_usaha_pengembangan', sClass: "alignCenter" },
											{ mData: 'pendamping', sClass: "alignCenter" },
											{ mData: 'no_pendamping', sClass: "alignCenter" },
											{ mData: 'status', sClass: "alignCenter" },
											{ mData: 'action' }
										]
							});

							// $('#search').click(function(){
							// 	var payment_type = $('#type').val();
							// 	if(payment_type != '')
							// 	{
							// 		$('#tbl').dataTable({
							// 			"bProcessing": true,
							// 			"ajax" : {
							// 				url:"<?= site_url('admin/Master/json_kube'); ?>",
							// 				type:"POST",
							// 				data:{
							// 					type:payment_type
							// 				}
							// 			},
							// 			"destroy" : true,
							// 			"aoColumns": [
							// 						{ mData: 'date' } ,
							// 						{ mData: 'trans_id' },
							// 						{ mData: 'name' },
							// 						{ mData: 'status' },
							// 						{ mData: 'transfer_in' } ,
							// 						{ mData: 'transfer_out' }
							// 					]
							// 		}).ajax.reload();
							// 	}
							// 	else
							// 	{
							// 		alert("Payment Type is Required");
							// 	}
							// });

						});
					</script>
					<script type="text/javascript">
					function deleteConfirm(){
						var result = confirm("Yakin akan menghapus data ini?");
						if(result){
							return true;
						}else{
							return false;
						}
					}
					</script>
					<!-- <br>
					<hr>
					<div class="row" >
						<div class="form-group select2-bootstrap-prepend" >
						<form method='post' action='<?=base_url('admin/Master/download_kube_data');?>'>
							<div class="col-md-1">
							</div>
							<label class="control-label col-md-1">Provinsi <span class="required"> * </span></label>
							<div class="col-md-3">
								<select name='prov' id='id_provinsi' class="form-control select2-allow-clear" required>
									<option value=""></option>
									<?php
									foreach ($provinsi as $key => $value) {
										echo'<option value="'.$value->id_provinsi.'">'.$value->nm_provinsi.'</option>';
									}
									?>
								</select>
							</div>
							<label class="control-label col-md-1">Kabupaten/ Kota </label>
							<div class="col-md-3">
								<select name='kab' id='id_kabupaten' class="form-control select2-allow-clear">
									<option value=""></option>
								</select>
							</div>
							<div class="col-md-1">
								<button type='submit' class="btn btn-default">Ekspor Data <i class="fa fa-cloud-download"></i></button>
							</div>
						</form>
						</div>
					</div> -->
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(function(){
		$.ajaxSetup({
			type:"POST",
			url: "<?php echo site_url('/admin/Master/ajax_function')?>",
			cache: false,
		});
		$("#id_provinsi").change(function(){
			var value=$(this).val();
			$.ajax({
				data:{id:value,modul:'get_kabupaten_by_id_provinsi'},
				success: function(respond){
					$("#id_kabupaten").html(respond);
				}
			})
		});
	})
</script>
<div class="modal fade" id="fi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Form Import</h4>
			</div>
			<form role="form" action="<?php echo base_url()."admin/Master/import_kube_data"; ?>" method='post' enctype="multipart/form-data">
				<div class="modal-body">
					<div class="form-body">
						<!-- <div class="form-group form-md-line-input has-danger">
							<label class="col-md-3 control-label" for="form_control_1">Provinsi <span class="required"> * </span></label>
							<div class="col-md-9">
								<div class="input-icon">
									<select name='id_provinsi' id='id_provinsi2' class="form-control select2-allow-clear" required>
										<option value=''></option>
										<?php
										foreach ($provinsi as $key => $value) {
											echo '<option value="'.$value->id_provinsi.'">'.$value->nm_provinsi.'</option>';
										}
										?>
									</select>
								</div>
							</div>
						</div> -->
						<!-- <div class="form-group form-md-line-input has-danger">
							<label class="col-md-3 control-label" for="form_control_1">Kabupaten/ Kota <span class="required"> * </span></label>
							<div class="col-md-9">
								<div class="input-icon">
									<select name='id_kabupaten' id='id_kabupaten2' class="form-control select2-allow-clear" required>
										<option value=''></option>
									</select>
								</div>
							</div>
						</div> -->
						<div class="form-group form-md-line-input has-danger">
							<!-- <label class="col-md-3 control-label" for="form_control_1">Tahun Program <span class="required"> * </span></label>
							<div class="col-md-3">
								<div class="input-icon">
									<select name='tahun' class="form-control select2-allow-clear" required>
										<option value=''>-- Pilih --</option>
										<option value='2015'>2015</option>
										<option value='2016'>2016</option>
										<option value='2017'>2017</option>
										<option value='2018'>2018</option>
										<option value='2019'>2019</option>
									</select>
								</div>
							</div> -->
							<!-- <label class="col-md-2 control-label" for="form_control_1">Tahap <span class="required"> * </span></label>
							<div class="col-md-4">
								<div class="input-icon">
									<select name='tahap' class="form-control select2-allow-clear" required>
										<option value=''>-- Pilih --</option>
										<option value='1'>Tahap 1</option>
										<option value='2'>Tahap 2</option>
										<option value='3'>Tahap 3</option>
									</select>
								</div>
							</div> -->
						</div>
						<div class="form-group form-md-line-input has-danger">
							<label class="col-md-3 control-label" for="form_control_1">File Import <span class="required"> * </span></label>
							<div class="col-md-9">
								<div class="input-icon">
									<input class="form-control" type="file" name='fmasuk' required>
									<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
					<button type="submit" class="btn btn-primary">Unggah</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="modal fade" id="fe" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Form Ekspor</h4>
			</div>
			<div class="modal-body">
				<div class="form-body">
					<div class="row">
						<form method='post' action='<?=base_url('admin/Master/download_kube_data');?>'>
							
							<label class="control-label col-md-2">Provinsi <span class="required"> * </span></label>
							<div class="col-md-3">
								<select name='prov' id='id_provinsi2' class="form-control select2-allow-clear" required>
									<option value=""></option>
									<?php
									foreach ($provinsi as $key => $value) {
										echo'<option value="'.$value->id_provinsi.'">'.$value->nm_provinsi.'</option>';
									}
									?>
								</select>
							</div>
							<label class="control-label col-md-2">Kabupaten/ Kota </label>
							<div class="col-md-3">
								<select name='kab' id='id_kabupaten2' class="form-control select2-allow-clear">
									<option value=""></option>
								</select>
							</div>
							<div class="col-md-1">
								<!-- <a href="<?=base_url('admin/Master/download_admin_data');?>" class="btn btn-default">Ekspor Data <i class="fa fa-cloud-download"></i></a> -->
								<button type='submit' class="btn btn-primary">Ekspor Data</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>