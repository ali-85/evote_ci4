<?= $this->extend('layout/page') ?>
<?= $this->section('content') ?>
<main class="d-flex w-100 h-100">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

						<div class="text-center mt-4">
							<h1 class="h2">Selamat Datang di EVote</h1>
							<p class="lead">
								Masuk untuk melakukan vote
							</p>
						</div>
						<?php
		                    if(session()->getFlashdata('msg')){
		                ?>
                        <div class="alert alert-danger alert-dismissible" role="alert">
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							<div class="alert-message">
                                <?= session()->getFlashdata('msg') ?>
							</div>
						</div>
                        <?php } ?>
						<div class="card">
							<div class="card-body">
								<div class="m-sm-4">
									<form action="<?= base_url('login') ?>" method="post">
										<div class="mb-3">
											<label class="form-label">NIM</label>
											<input class="form-control form-control-lg" type="number" name="nim" placeholder="Masukkan NIM">
										</div>
										<div class="mb-3">
											<label class="form-label">Password</label>
											<input class="form-control form-control-lg" type="password" name="password" placeholder="Masukkan password">
											<small>
												<a href="pages-reset-password.html">Lupa Password?</a>
											</small>
										</div>
										<div>
											<label class="form-check">
												<input class="form-check-input" type="checkbox" value="remember-me" name="remember-me" checked="">
												<span class="form-check-label">
													Ingat saya?
												</span>
											</label>
										</div>
										<div class="text-center mt-3">
											<button type="submit" class="btn btn-lg btn-primary">Masuk</button>
											<!-- <button type="submit" class="btn btn-lg btn-primary">Sign in</button> -->
										</div>
									</form>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</main>
<?= $this->endsection() ?>