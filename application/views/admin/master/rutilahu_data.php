<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<style media="all" type="text/css">
    .alignCenter { text-align: center; }
</style>
<ul class="page-breadcrumb breadcrumb">
	<li>
		<span>Master</span>
		<i class="fa fa-circle"></i>
	</li>
	<li>
		<span>Data Rutilahu (Rumah Tidak Layak Huni)</span>
	</li>
</ul>
<?= $this->session->flashdata('sukses') ?>
<?= $this->session->flashdata('gagal') ?>
<div class="page-content-inner">
	<div class="m-heading-1 border-yellow m-bordered" style="background-color:#FAD405;">
		<h3>Catatan</h3>
		<p> Untuk menambahkan data anggota Rutilahu silahkan klik detil data rutilahu-nya.</p>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="portlet light ">
				<div class="portlet-body">
					<div class="col-md-12">
						<form method='post' action='<?=site_url('admin_side/rutilahu');?>'>
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
						<div class="row">
							<div class="col-md-4">
								<div class="btn-group">
									<!-- <button type='submit' id="sample_editable_1_new" class="btn sbold red"> Hapus
										<i class="fa fa-trash"></i>
									</button> -->
								</div>
									<!-- <span class="separator">|</span> -->
									<a href="<?=base_url('admin_side/tambah_data_rutilahu');?>" class="btn green uppercase">Tambah Data <i class="fa fa-plus"></i> </a>
							</div>
							<div class="col-md-8" style='text-align: right;'>
								<a href="#" class="btn btn-default" data-toggle="modal" data-target="#fe">Ekspor Data <i class="fa fa-cloud-download"></i></a>
								<span class="separator">|</span>
								<a href="#" class="btn btn-info" data-toggle="modal" data-target="#fi">Impor Data <i class="fa fa-cloud-upload"></i></a>
								<a href="<?=base_url()?>import_data_template/template_rutilahu.xlsx" class="btn btn-warning">Unduh Template</a>
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
								<th style="text-align: center;"> Tahun Program </th>
								<th style="text-align: center;"> Tahap </th>
								<th style="text-align: center;"> Nama Kelompok </th>
								<th style="text-align: center;"> Alamat Rumah </th>
								<th style="text-align: center;"> Rencana Anggaran </th>
								<th style="text-align: center;"> Provinsi </th>
								<th style="text-align: center;"> Kabupaten </th>
								<th style="text-align: center;"> Kecamatan </th>
								<th style="text-align: center;"> Desa </th>
								<th style="text-align: center;" width="7%"> Aksi </th>
							</tr>
						</thead>
					</table>
					</form>
					<script type="text/javascript" language="javascript" >
						$(document).ready(function(){
							$('#tbl').dataTable({
								"order": [[ 1, "asc" ]],
								"bProcessing": true,
								"ajax" : {
									type:"POST",
									url: "<?php echo site_url('admin/Master/json_rutilahu')?>",
									data:{prov:"<?= $prov; ?>",kabkot:'<?= $kabkot; ?>'},
									cache: false
								},
								"aoColumns": [
											{ mData: 'checkbox', sClass: "alignCenter", "bSortable": false} ,
											{ mData: 'number', sClass: "alignCenter" },
											{ mData: 'tahun', sClass: "alignCenter" } ,
											{ mData: 'tahap', sClass: "alignCenter" } ,
											{ mData: 'nama_tim' },
											{ mData: 'alamat', sClass: "alignCenter" } ,
											{ mData: 'rencana_anggaran', sClass: "alignCenter" },
											{ mData: 'nm_provinsi', sClass: "alignCenter" },
											{ mData: 'nm_kabupaten', sClass: "alignCenter" },
											{ mData: 'nm_kecamatan', sClass: "alignCenter" },
											{ mData: 'nm_desa', sClass: "alignCenter" },
											{ mData: 'action' }
										]
							});
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
						<form method='post' action='<?=base_url('admin/Master/download_rutilahu_data');?>'>
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
<div class="modal fade" id="fi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Form Import</h4>
			</div>
			<form role="form" action="<?php echo base_url()."admin/Master/import_rutilahu_data"; ?>" method='post' enctype="multipart/form-data">
				<div class="modal-body">
					<div class="form-body">
						<div class="form-group form-md-line-input has-danger">
							<label class="col-md-3 control-label" for="form_control_1">Provinsi <span class="required"> * </span></label>
							<div class="col-md-9">
								<div class="input-icon">
									<select name='id_provinsi' id='id_provinsi' class="form-control select2-allow-clear" required>
										<option value=''></option>
										<?php
										foreach ($provinsi as $key => $value) {
											echo '<option value="'.$value->id_provinsi.'">'.$value->nm_provinsi.'</option>';
										}
										?>
									</select>
								</div>
							</div>
						</div>
						<div class="form-group form-md-line-input has-danger">
							<label class="col-md-3 control-label" for="form_control_1">Kabupaten/ Kota <span class="required"> * </span></label>
							<div class="col-md-9">
								<div class="input-icon">
									<select name='id_kabupaten' id='id_kabupaten' class="form-control select2-allow-clear" required>
										<option value=''></option>
									</select>
								</div>
							</div>
						</div>
						<div class="form-group form-md-line-input has-danger">
							<label class="col-md-3 control-label" for="form_control_1">Tahun Program <span class="required"> * </span></label>
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
							</div>
							<label class="col-md-2 control-label" for="form_control_1">Tahap <span class="required"> * </span></label>
							<div class="col-md-4">
								<div class="input-icon">
									<select name='tahap' class="form-control select2-allow-clear" required>
										<option value=''>-- Pilih --</option>
										<option value='1'>Tahap 1</option>
										<option value='2'>Tahap 2</option>
										<option value='3'>Tahap 3</option>
									</select>
								</div>
							</div>
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
						<form method='post' action='<?=base_url('admin/Master/download_rutilahu_data');?>'>
							
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