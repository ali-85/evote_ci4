<?= $this->extend('layout/dashboard') ?>
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
							<h3>Dashboard</h3>
						</div>
						<div class="col-auto ms-auto text-end mt-n1">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
									<li class="breadcrumb-item"><a href="#">EVote</a></li>
									<li class="breadcrumb-item"><a href="#">Dashboards</a></li>
								</ol>
							</nav>
						</div>
					</div>
				<!-- Main Content -->
				<div class="row">
					<div class="col-sm-6 col-lg-3">
						<div class="card">
							<div class="card-body">
								<div class="row">
									<div class="col mt-0">
										<h5 class="card-title">Pengguna</h5>
									</div>
									<div class="col-auto">
										<div class="avatar">
											<div class="avatar-title rounded-circle bg-primary-light">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users align-middle"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
											</div>
										</div>
									</div>
								</div>
								<h1 class="mt-1 mb-3"><?= 0+$total_users ?></h1>
								<div class="mb-0">
									<span class="text-muted">Pengguna</span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-lg-3">
						<div class="card">
							<div class="card-body">
								<div class="row">
									<div class="col mt-0">
										<h5 class="card-title">Voting</h5>
									</div>
									<div class="col-auto">
										<div class="avatar">
											<div class="avatar-title rounded-circle bg-primary-light">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar align-middle"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
											</div>
										</div>
									</div>
								</div>
								<h1 class="mt-1 mb-3"><?= 0+$events ?></h1>
								<div class="mb-0">
									<span class="text-muted">Voting Berjalan</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
						<?php foreach($voting as $vote){ ?>
                    	<div class="col-12 col-lg-6">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Hasil <?= $vote->title ?></h5>
								</div>
								<div class="card-body">
									<div class="chart chart-sm"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>				<canvas id="chartjs-pie<?= $vote->id ?>" width="1360" height="500" class="chartjs-render-monitor" style="display: block; width: 680px; height: 250px;"></canvas>
								</div>
							</div>
						</div>
					</div>
					<?php } ?>
				</div>
			</main>
			<?= $this->include('layout/footer') ?>
		</div>
	</div>
    <script>
		document.addEventListener("DOMContentLoaded", function() {
			// Pie chart
			<?php foreach ($voting as $vote) { ?>
			new Chart(document.getElementById("chartjs-pie<?= $vote->id ?>"), {
				type: "pie",
				data: {
					labels: [
						<?php
							foreach($kandidat as $row){
								if ($row->voting_id == $vote->id) {
									echo "'".$row->nama."',";
								}
							}
						?>
					],
					datasets: [{
						data: [
						<?php
							foreach($kandidat as $row){
								if ($row->voting_id == $vote->id) {
									echo "'".$row->vote."',";
								}
							}
						?>
						],
						backgroundColor: [
							'#3498DB',
							'#2ECC71',
							'#E74C3C',
							'#8E44AD',
							'#F1C40F',
							'#2C3E50',
							'#7F8C8D'
						],
						borderColor: "transparent"
					}]
				},
				options: {
					maintainAspectRatio: false,
					legend: {
						display: false
					}
				}
			});
		<?php } ?>
		});
	</script>
<?= $this->endsection() ?>