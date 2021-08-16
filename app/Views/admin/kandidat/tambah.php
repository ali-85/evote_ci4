<?= $this->extend('layout/dashboard') ?>
<?= $this->section('style') ?>
    <style>
        .ck-editor__editable_inline{
            min-height: 150px;
        }
    </style>
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
							<h3>Kandidat</h3>
						</div>
						<div class="col-auto ms-auto text-end mt-n1">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
									<li class="breadcrumb-item"><a href="#">EVote</a></li>
									<li class="breadcrumb-item"><a href="#">Kandidat</a></li>
									<li class="breadcrumb-item"><a href="#">Tambah</a></li>
								</ol>
							</nav>
						</div>
					</div>
				<!-- Main Content -->
				<div class="row">
                <div class="col-12 col-lg-6">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Tambah Kandidat</h5>
								</div>
								<div class="card-body">
									<form method="post" action="<?= base_url('admin/kandidat/tambah/post') ?>" enctype="multipart/form-data">
                                        <div class="mb-3">
											<label class="form-label">Acara Voting</label>
											<select name="voting_id" id="role" class="form-control" required>
                                                <option disabled selected>-- Pilih Voting --</option>
                                                <?php
                                                    foreach ($voting as $row) {
                                                ?>
                                                <option value="<?= $row->id ?>"><?= $row->title ?></option>
                                                <?php } ?>
                                            </select>
										</div>
										<div class="mb-3">
											<label class="form-label">Nama Calon atau Pasangan</label>
											<input type="text" class="form-control" name="nama" placeholder="Kandidat atau/dan Pasangan" required>
										</div>
										<div class="mb-3">
											<label class="form-label">Visi</label>
											<textarea id="visi" class="form-control" rows="3" name="visi" placeholder="Visi"></textarea>
										</div>
										<div class="mb-3">
											<label class="form-label">Misi</label>
											<textarea id="misi" class="form-control" rows="5" name="misi" placeholder="Misi"></textarea>
										</div>
                                        <div class="mb-3">
                                            <label class="form-label w-100">Foto calon atau pasangan</label>
                                            <input type="file" name="img" required>
                                            <small class="form-text text-muted">.jpg .jpeg .png</small>
                                        </div>
										<button type="submit" class="btn btn-primary">Simpan</button>
									</form>
								</div>
							</div>
						</div>
				</div>
			</main>
			<?= $this->include('layout/footer') ?>
		</div>
	</div>
<?= $this->endsection() ?>
<?= $this->section('script')?>
    <script src="<?= base_url('dist/ckeditor/ckeditor.js') ?>"></script>
    <script type="text/javascript">
        ClassicEditor
            .create( document.querySelector( '#visi' ) )
            .then( editor => {
                console.log( editor );
            } )
            .catch( error => {
                console.error( error );
            } );
        ClassicEditor
            .create( document.querySelector( '#misi' ) )
            .then( editor => {
                console.log( editor );
            } )
            .catch( error => {
                console.error( error );
            } );
    </script>
<?= $this->endsection() ?>