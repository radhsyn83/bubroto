<!doctype html>

<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Font & Icon -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i&display=swap"
		  rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">

	<!-- Plugins -->
	<link rel="stylesheet" href="<?= base_url('assets/plugins/noty/noty.min.css') ?>">

	<link rel="stylesheet" href="<?= base_url('assets/plugins/jqvmap/jqvmap.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/plugins/noty/noty.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/plugins/flatpickr/flatpickr.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/plugins/flatpickr/plugins/monthSelect/style.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/plugins/clockpicker/bootstrap-clockpicker.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/plugins/datatables/dataTables.bootstrap4.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/plugins/datatables/responsive.bootstrap4.min.css') ?>">

	<!-- Main Style -->
	<link rel="stylesheet" href="<?= base_url('assets/css/style.min.css') ?>" id="main-css">
	<link rel="stylesheet" href="#" id="sidebar-css">

	<title>Warung Bu Broto</title>
</head>

<body>

<!-- Sidebar -->
<div class="sidebar">

	<!-- Sidebar header -->
	<div class="sidebar-header">
		<a href="../index.html" class="logo">
			<img src="<?= base_url('assets/img/logo.svg') ?>" alt="Logo" id="main-logo">
			<?= $sess['jabatan'] ?>
		</a>
		<a href="#" class="nav-link nav-icon rounded-circle ml-auto" data-toggle="sidebar">
			<i class="material-icons">close</i>
		</a>
	</div>
	<!-- /Sidebar header -->

	<!-- Sidebar body -->
	<div class="sidebar-body">
		<ul class="nav nav-sub mt-3" id="menu">
			<li class="nav-item">
				<a class="nav-link has-icon active" href="javascript:void(0)"><i class="fa fa-home"></i>Dashboard</a>
			</li>
			<li class="nav-item">
				<a class="nav-link has-icon" onclick="logout()" href="javascript:void(0)"><i class="material-icons">exit_to_app</i>
					Logout</a>
			</li>
		</ul>
	</div>
	<!-- /Sidebar body -->

</div>
<!-- /Sidebar -->

<!-- Main -->
<div class="main">

	<!-- Main header -->
	<div class="main-header">
		<a class="nav-link nav-icon rounded-circle" href="#" data-toggle="sidebar"><i
				class="material-icons">menu</i></a>
		<ul class="nav nav-circle nav-gap-x-1 ml-auto"></ul>
		<ul class="nav nav-pills">
			<li class="nav-link-divider mx-2"></li>
			<li class="nav-item dropdown">
				<a class="nav-link has-img px-2" href="#">
					<img src="<?= base_url('assets/img/user.svg') ?>" alt="Admin" class="rounded-circle mr-2">
					<span class="d-none d-sm-block"><?= $_SESSION["nama"] ?></span>
				</a>
			</li>
		</ul>
	</div>
	<!-- /Main header -->

	<!-- Main body -->
	<div class="main-body">
		<section id="section1">
			<h5>Kuisioner</h5>
			<p class="text-muted font-size-sm" id="total-request">
				Daftar kuisioner pelanggan
			</p>
			<div class="row">
				<div class="col-4">
					<div class="input-group">
						<input id="pembayaran_id" type="text" class="form-control" placeholder="Nomor pembayaran">
						<div class="input-group-append">
							<button onclick="getPembayaran()" id="bt-kuisioner" class="btn btn-light" type="button">Tambah</button>
						</div>
					</div>
				</div>
			</div>
			<br>
			<br>
		</section>

		<table class="table">
			<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">No. Pembayaran</th>
				<th scope="col">Pelanggan</th>
				<th scope="col">Makanan</th>
				<th scope="col">Minuman</th>
				<th scope="col">Pelayanan</th>
				<th scope="col">Tanggal</th>
			</tr>
			</thead>
			<tbody id="body-kuisioner">
			<tr>
				<td colspan="7">
					<center>Belum ada kuisioner.</center>
				</td>
			</tr>
			</tbody>
		</table>
	</div>
	<!-- /Main body -->

</div>
<!-- /Main -->


<!--Modal-->
<div class="modal fade" id="modalKuisioner" tabindex="-1" role="dialog" aria-labelledby="basicModalLabel"
	 aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="container">
				<br>
				<h5 id="basicModalLabel">Tambah Kuisioner</h5>
			</div>

			<form id="kuisioner-form">

				<div class="modal-body">
					<input type="hidden" class="form-control" id="f_pembayaran" name="f_pembayaran">
					<div class="form-group">
						<label for="f_pelanggan">Nama Pelanggan</label>
						<input type="text" class="form-control" id="f_pelanggan" name="f_pelanggan"
							   placeholder="Masukkan nama pelanggan">
					</div>
					<div class="form-group">
						<label for="f_note">Makanan</label>
						<div class="row">
							<div class="col-md-3">
								<div class="custom-control custom-radio">
									<input type="radio" name="makanan" class="custom-control-input" id="makanan1" value="1">
									<label class="custom-control-label" for="makanan1">Buruk</label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="custom-control custom-radio">
									<input type="radio" name="makanan" class="custom-control-input" id="makanan2" value="2">
									<label class="custom-control-label" for="makanan2">Baik</label>
								</div>
							</div>
							<div class="col-md">
								<div class="custom-control custom-radio">
									<input type="radio" name="makanan" class="custom-control-input" id="makanan3" value="3">
									<label class="custom-control-label" for="makanan3">Sangat Baik</label>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="f_note">Minuman</label>
						<div class="row">
							<div class="col-md-3">
								<div class="custom-control custom-radio">
									<input type="radio" name="minuman" class="custom-control-input" id="minuman1" value="1">
									<label class="custom-control-label" for="minuman1">Buruk</label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="custom-control custom-radio">
									<input type="radio" name="minuman" class="custom-control-input" id="minuman2" value="2">
									<label class="custom-control-label" for="minuman2">Baik</label>
								</div>
							</div>
							<div class="col-md">
								<div class="custom-control custom-radio">
									<input type="radio" name="minuman" class="custom-control-input" id="minuman3" value="3">
									<label class="custom-control-label" for="minuman3">Sangat Baik</label>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label>Pelayanan</label>
						<div class="row">
							<div class="col-md-3">
								<div class="custom-control custom-radio">
									<input type="radio" name="pelayanan" class="custom-control-input" id="pelayanan1" value="1">
									<label class="custom-control-label" for="pelayanan1">Buruk</label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="custom-control custom-radio">
									<input type="radio" name="pelayanan" class="custom-control-input" id="pelayanan2" value="2">
									<label class="custom-control-label" for="pelayanan2">Baik</label>
								</div>
							</div>
							<div class="col-md">
								<div class="custom-control custom-radio">
									<input type="radio" name="pelayanan" class="custom-control-input" id="pelayanan3" value="3">
									<label class="custom-control-label" for="pelayanan3">Sangat Baik</label>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary" id="bahan-btn">Tambah</button>
				</div>
			</form>
		</div>
	</div>
</div>


<!-- Backdrop for expanded sidebar -->
<div class="sidebar-backdrop" id="sidebarBackdrop" data-toggle="sidebar"></div>

<!-- Main Scripts -->
<script src="<?= base_url('assets/js/script.min.js') ?>"></script>
<script src="<?= base_url('assets/js/app.min.js') ?>"></script>

<!-- Plugins -->
<script src="<?= base_url('assets/plugins/jquery-sparkline/jquery.sparkline.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/chart.js/Chart.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/jqvmap/jquery.vmap.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/jqvmap/maps/jquery.vmap.usa.js') ?>"></script>
<script src="<?= base_url('assets/plugins/noty/noty.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/bootbox/bootbox.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/flatpickr/flatpickr.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/flatpickr/plugins/monthSelect/index.js') ?>"></script>
<script src="<?= base_url('assets/plugins/clockpicker/bootstrap-clockpicker.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables/jquery.dataTables.bootstrap4.responsive.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables/jquery.dataTables.bootstrap4.responsive.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/dateformat.min.js') ?>"></script>

<script>
    function get_kuisioner() {
        let url = "<?= base_url('cs/get_kuisioner') ?>";
        $.ajax({
            url: url,
            dataType: "JSON",
            method: "POST",
            data: {},
            success: function (data) {
                let d = data.data;
                a = "";
                for (let i = 0; i < d.length; i++) {
                    a += '<tr>\n' +
                        '\t\t\t\t\t\t\t\t<td scope="col">' + (i + 1) + '</td>\n' +
                        '\t\t\t\t\t\t\t\t<td scope="col">' + d[i].id_pembayaran + '</td>\n' +
                        '\t\t\t\t\t\t\t\t<td scope="col">' + d[i].nama_pelanggan + '</td>\n' +
                        '\t\t\t\t\t\t\t\t<td scope="col">' + get_score(d[i].makanan) + '</td>\n' +
                        '\t\t\t\t\t\t\t\t<td scope="col">' + get_score(d[i].minuman) + '</td>\n' +
                        '\t\t\t\t\t\t\t\t<td scope="col">' + get_score(d[i].pelayanan) + '</td>\n' +
                        '\t\t\t\t\t\t\t\t<td scope="col">' + d[i].date_add + '</td>\n' +
                        '\t\t\t\t\t\t\t</tr>'
                }

                $('#body-kuisioner').html(a);
            }
        });
    }

    function get_score(i) {
		if (i === "1") {
		    return "Buruk"
		} else if (i === "2") {
		    return "Baik"
		} else {
		    return "Sangat Baik"
		}
    }

    get_kuisioner()

    function logout() {
        let url = "<?= base_url('auth/do_logout') ?>";
        let home = "<?= base_url() ?>";
        $.ajax({
            url: url,
            dataType: "JSON",
            method: "POST",
            success: function () {
                window.location.href = home;
            }
        });
    }

    function getPembayaran() {
        var id = $("#pembayaran_id").val()

        let url = "<?= base_url('cs/get_pembayaran') ?>";
        $.ajax({
            url: url,
            dataType: "JSON",
            method: "POST",
			data: { "id": id },
			beforeSend: function() {
                $("#bt-kuisioner").prop("disabled", true);
			},
            success: function (m) {
                $("#bt-kuisioner").prop("disabled", false);
               	if (m.error === 1) {
               	    alert(m.msg)
				} else {
                    showModal(m)
				}
            }
        });
    }
    function showModal(m) {
        $("#modalKuisioner").modal("show");
        $("#f_pembayaran").val(m.data.id);
    }

    $("#kuisioner-form").on("submit", function (e) {
        e.preventDefault()
        let url = "<?= base_url('cs/insert_kuisioner') ?>";

        $.ajax({
            url: url,
            dataType: "JSON",
            method: "POST",
            data: $(this).serialize(),
            success: function () {
                get_kuisioner()
            }
        })

        $("#modalKuisioner").modal("hide")
    })

</script>

</body>

</html>
