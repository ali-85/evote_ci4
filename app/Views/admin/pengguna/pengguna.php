<?= $this->extend('layout/dashboard') ?>
<?= $this->section('style') ?>
	<link rel="stylesheet" href="<?= base_url('dist/css/bootstrap.min.css') ?>">
<?= $this->endsection() ?>
<?= $this->section('content') ?>
	<div class="wrapper">
    <?= $this->include('layout/sidebar') ?>
		<div class="main">
		<?= $this->include('layout/header') ?>
			<main class="content">
				<div class="container-fluid p-0">
					<!-- Breadcrumbs -->
					<div class="row mb-2 mb-xl-3">
						<div class="col-auto d-none d-sm-block">
							<h3>Pengguna</h3>
						</div>
						<div class="col-auto ms-auto text-end mt-n1">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
									<li class="breadcrumb-item"><a href="#">EVote</a></li>
									<li class="breadcrumb-item"><a href="#">Pengguna</a></li>
								</ol>
							</nav>
						</div>
					</div>
				<!-- Main Content -->
				<div class="row">
                    <div class="col-12">
                        <?php
		                    if(session()->getFlashdata('message')){
		                ?>
                        <div class="alert alert-success alert-dismissible" role="alert">
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							<div class="alert-message">
                                <?= session()->getFlashdata('message') ?>
							</div>
						</div>
                        <?php } ?>
							<div class="card">
								<form action="" method="post" id="myform">
								<div class="card-header">
                                <div class="btn-group mb-3" role="group" aria-label="Default button group">
									<a href="<?= base_url('admin/import') ?>" class="btn btn-sm btn-success">Import</a>
									<a href="<?= base_url('admin/pengguna/tambah') ?>" class="btn btn-sm btn-primary">+ Tambah</a>
									<button type="submit" role="button" onclick="editAction()" class="btn btn-sm btn-success"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 align-middle"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg> Edit</button>
									<button type="submit" role="button" onclick="deleteAction()" class="btn btn-sm btn-danger"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash align-middle"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg> Hapus</button>
                            </div>
									<div class="col-lg-2 float-end">
											<div class="input-group input-group-navbar">
												<input type="text" name="key" class="form-control" placeholder="Search…" aria-label="Search">
												<button class="btn" onclick="searchAction()" type="submit" name="submit">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search align-middle"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
												</button>
											</div>
									</div>
								</div>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th><input class="form-check-input" type="checkbox" onclick="toggle(this)"></th>
                                                <th>NIM</th>
                                                <th>Nama</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        foreach ($pengguna as $row) { 
                                        ?>
                                            <tr>
                                                <td>
												<?php
													if ($row->role != 1) {
												?>
													<input type="checkbox" class="form-check-input" name="id[]" id="id" value="<?= $row->id ?>">
												<?php } ?>
												</td>
                                                <td><?= $row->nim ?></td>
                                                <td><?= $row->nama ?></td>
                                                <td class="table-action">
												<?php if(session()->get('id') != $row->id){?>
                                                    <a href="<?= base_url('admin/pengguna/edit/'.$row->id) ?>"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 align-middle"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a>
                                                    <a href="<?= base_url('admin/pengguna/delete/'.$row->id) ?>" onclick="return confirm('Anda yakin ingin menghapusnya?')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash align-middle"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></a>
												<?php } ?>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
								</form>
									<?= $pager->links('users','bootstrap_pagination') ?>
							</div>
						</div>
                    </div>
				</div>
			</main>
			<?= $this->include('layout/footer') ?>
		</div>
	</div>
<?= $this->endsection() ?>
<?= $this->section('script') ?>
	<script type="text/javascript">
		function deleteAction() {
			changeActionAndSubmit("<?php echo base_url('admin/pengguna/delete'); ?>");
		}
		function editAction() {
			changeActionAndSubmit("<?php echo base_url('admin/pengguna/edit-selected'); ?>");
		}
		function searchAction()
		{
			changeActionAndSubmit("<?= base_url('admin/pengguna/cari') ?>");
		}
		function changeActionAndSubmit(action) {
			document.getElementById('myform').action = action;
			document.getElementById('myform').submit();
		}
		function toggle(source) {
			var checkboxes = document.querySelectorAll('input[type="checkbox"]');
			for (var i = 0; i < checkboxes.length; i++) {
				if (checkboxes[i] != source)
					checkboxes[i].checked = source.checked;
			}
		}
	</script>
<?= $this->endsection() ?>