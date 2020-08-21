
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<table class="table table-bordered table-striped">
	<thead>
		<tr>
			Versi Query
			<th>No</th>
			<th>Kode Foto</th>
			<th>Nama Foto</th>
			<th>Foto</th>
			<th class="span2">
				<a href="#modalAddBarang" class="btn btn-mini btn-block btn-inverse" data-toggle="modal">
					<i class="icon-plus-sign icon-white"></i> Tambah Data
				</a>
			</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$no=1;
		if(isset($data_foto)){
			foreach($data_foto->result_array() as $row){
				?>
				<tr>
					<td><?php echo $no++; ?></td>
					<td><?php echo $row['kode_foto']; ?></td>
					<td><?php echo $row['nama_foto']; ?></td>
					<td><img src="<?php echo base_url('assets/'.$row['foto']);?>" height="100px" width="100px"></td>
					
					<td>
						<a class="btn btn-mini" href="#modalEditBarang<?php echo $row['kode_foto']?>" data-toggle="modal"><i class="icon-pencil"></i> Edit</a>
						<a class="btn btn-mini" href="<?php echo site_url('admin/hapus_foto/'.$row['kode_foto']);?>"
							onclick="return confirm('Anda yakin?')"> <i class="icon-remove"></i> Hapus</a>
						</td>
					</tr>

				<?php }
			}
			?>
		</tbody>
	</table>
	<!-- ============ MODAL ADD FOTO =============== -->
	<div id="modalAddBarang" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h3 id="myModalLabel">Tambah Data Foto</h3>
				</div>
				<form class="form-horizontal" method="post" action="<?php echo site_url('admin/tambah_foto')?>" enctype="multipart/form-data">
					<div class="modal-body">
						<div class="control-group">
							<label class="control-label">Kode Foto</label>
							<div class="controls">
								<input name="kode_foto" type="text" value="<?php echo $kode_foto; ?>" readonly>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" >Nama Foto</label>
							<div class="controls">
								<input name="nama_foto" type="text" placeholder="Input Nama Foto...">
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" >Stok</label>
							<div class="controls">
								<input name="foto" type="file" placeholder="Input Stok...">
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
						<button type="submit" class="btn btn-primary">Save</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- ============ MODAL EDIT FOTO =============== -->
	<?php
	if (isset($data_foto)){
		foreach($data_foto->result_array() as $row){
			?>
			<div id="modalEditBarang<?php echo $row['kode_foto'];?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h3 id="myModalLabel">Edit Data Foto</h3>
						</div>
						<form class="form-horizontal" method="post" action="<?php echo site_url('admin/edit_foto')?>" enctype="multipart/form-data">
							<div class="modal-body">
								<div class="control-group">
									<label class="control-label">Kode Foto</label>
									<div class="controls">
										<input name="kode_foto" type="text" value="<?php echo $row['kode_foto'];?>" readonly>
									</div>
								</div>

								<div class="control-group">
									<label class="control-label" >Nama Foto</label>
									<div class="controls">
										<input name="nama_foto" type="text" value="<?php echo $row['nama_foto'];?>" >
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" >Stok</label>
									<div class="controls">
										<img src="<?php echo base_url('assets/'.$row['foto']);?>" width="200px" height="200px">
										<input name="foto" type="file" value="<?php echo $row['foto'];?>">
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
								<button type="submit" class="btn btn-primary">Update</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		<?php }
	}
	?>