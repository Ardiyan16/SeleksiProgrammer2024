<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.0/css/dataTables.bootstrap4.css">

    <title></title>
  </head>
  <body>
    
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Test</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="<?= site_url('Controller') ?>">Pasien <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= site_url('Controller/visit') ?>">Visit</a>
      </li>
    </ul>
  </div>
</nav>
<div class="container">
	<h3>Data Pasien<h1>
	<a href="#tambah" data-toggle="modal" class="btn btn-primary">Tambah Pasien</a>
	<?= $this->session->flashdata('success') ?>
	<?= $this->session->flashdata('error') ?>
	<div class="mt-3">
	<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Gender</th>
                <th>Address</th>
                <th>Option</th>
            </tr>
        </thead>
        <tbody>
					<?php 
					$no = 1;
					foreach($data as $value) { ?>
					<tr>
							<td><?= $no++ ?></td>
							<td><?= $value->name ?></td>
							<td>
								<?php 
									if($value->gender == 'L') {
										echo '<span class="badge bg-primary text-white">Pria</span>';
									} else {
										echo '<span class="badge bg-success text-white">Wanita</span>';
									}
								?>
							</td>
							<td><?= $value->address ?></td>
							<td>
								<a href="#edit<?= $value->id ?>" data-toggle="modal" class="btn btn-sm btn-primary">Edit</a>
								<a href="<?= site_url('Controller/hapus_pasien/' . $value->id) ?>" onclick="return confirm('apakah anda yakin menghapus data ?')" class="btn btn-sm btn-danger">Hapus</a>
							</td>
					</tr>
					<?php } ?>
				</tbody>
    </table>
	</div>
</div>
<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Tambah Pasien</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= site_url('Controller/simpan_pasien') ?>" method="POST">
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Nama <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <input type="text" required id="name" class="form-control" name="name">
														<?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Gender <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <select name="gender" class="form-control" id="" required>					
															<option value="" disabled>Pilih</option>
															<option value="L">Pria</option>
															<option value="P">Wanita</option>
														</select>
														<?= form_error('gender', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Alamat <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <input type="text" id="address" class="form-control" required name="address">
                            <span class="text-danger price_err"></span>
                        </div>
												<?= form_error('address', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2"></label>
                        <div class="col-md-10">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            </div>
        </div>
    </div>
</div>

<?php foreach ($data as $edit) { ?>
<div class="modal fade" id="edit<?= $edit->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Edit Pasien</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= site_url('Controller/update_pasien') ?>" method="POST">
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Nama <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <input type="hidden" value="<?= $edit->id ?>" class="form-control" name="id">
                            <input type="text" required id="name" value="<?= $edit->name ?>" class="form-control" name="name">
														<?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Gender <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <select name="gender" class="form-control" id="" required>					
															<option value="" disabled>Pilih</option>
															<option <?php if ($edit->gender == 'L') {
                                                    echo "selected=\"selected\"";
                                                } ?> value="L">Pria</option>
															<option <?php if ($edit->gender == 'P') {
                                                    echo "selected=\"selected\"";
                                                } ?> value="P">Wanita</option>
														</select>
														<?= form_error('gender', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Alamat <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <input type="text" id="address" class="form-control" value="<?= $edit->address ?>" required name="address">
                            <span class="text-danger price_err"></span>
                        </div>
												<?= form_error('address', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2"></label>
                        <div class="col-md-10">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            </div>
        </div>
    </div>
</div>
<?php } ?>

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
		<script src="https://cdn.datatables.net/2.1.0/js/dataTables.bootstrap4.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>
		<script>
				new DataTable('#example');
		</script>
  </body>
</html>
