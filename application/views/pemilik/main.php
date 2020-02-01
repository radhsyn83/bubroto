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

		<section id="section6">
			<div class="row">
				<div class="col-sm-7 mb-1">
					<h5>Dashboard</h5>
					<p class="text-muted font-size-sm">
						Laporan penjualan dan kuisioner
					</p>
				</div>
				<div class="col-sm-5">
					<input type="text" class="form-control daterangepicker mt-3" placeholder="Filter bedasarkan Tanggal">
				</div>
			</div>
		</section>

		<div class="row row-cols-2 row-cols-lg-4 gutters-sm">
			<!-- New Orders -->
			<div class="col mb-3">
				<div class="card">
					<div class="card-body">
						<h6 class="card-title">Pesanan Selesai</h6>
						<div class="d-flex align-items-center font-number mb-1">
							<i class="material-icons mr-2">check_circle_outline</i>
							<h3 class="mb-0 mr-2" id="selesai">0</h3>
						</div>
					</div>
				</div>
			</div>
			<!-- /New Orders -->

			<!-- Bounce Rate -->
			<div class="col mb-3">
				<div class="card">
					<div class="card-body">
						<h6 class="card-title">Pesanan Proses</h6>
						<div class="d-flex align-items-center font-number mb-1">
							<i class="material-icons mr-2">autorenew</i>
							<h3 class="mb-0 mr-2" id="proses">0</h3>
						</div>
					</div>
				</div>
			</div>
			<!-- /Bounce Rate -->

			<!-- New Users -->
			<div class="col mb-3">
				<div class="card">
					<div class="card-body">
						<h6 class="card-title">Belum Dimasak</h6>
						<div class="d-flex align-items-center font-number mb-1">
							<i class="material-icons mr-2">history</i>
							<h3 class="mb-0 mr-2" id="waiting">0</h3>
						</div>
					</div>
				</div>
			</div>
			<!-- /New Users -->

			<!-- Unique Visitors -->
			<div class="col mb-3">
				<div class="card">
					<div class="card-body">
						<h6 class="card-title">Total Pengunjung</h6>
						<div class="d-flex align-items-center font-number mb-1">
							<i class="material-icons mr-2">face</i>
							<h3 class="mb-0 mr-2" id="pengunjung">0</h3>
						</div>
					</div>
				</div>
			</div>
			<!-- /Unique Visitors -->
		</div>

		<div class="row gutters-sm">

			<!-- Monthly Kuisioner -->
			<div class="col-xl-12 mb-3">
				<div class="card h-100">
					<div class="card-header py-1">
						<i class="material-icons mr-2">show_chart</i>
						<h6>Kuisioner</h6>
						<button type="button" data-action="fullscreen" class="btn btn-sm btn-text-secondary btn-icon rounded-circle shadow-none ml-auto">
							<i class="material-icons">fullscreen</i>
						</button>
					</div>
					<div class="card-body" style="height: 350px"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
						<canvas id="bar-chart-multi" style="display: block; width: 660px; height: 318px;" width="660" height="318" class="chartjs-render-monitor"></canvas>
					</div>
				</div>
			</div>
			<!-- /Monthly Kuisioner -->

		</div>

	</div>
	<!-- /Main body -->

</div>
<!-- /Main -->

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
<script src="<?= base_url('assets/plugins/chart.js/Chart.min.js') ?>"></script>

<script>

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

</script>


<script>
    var today = new Date();
    var dateSize = new Date(today.getFullYear(), (today.getMonth()+1), 0).getDate();
    var dateStart = today.getFullYear()+"-"+(today.getMonth()+1)+"-01"
    var dateEnd = today.getFullYear()+"-"+(today.getMonth()+1)+"-"+dateSize

    function load_kuisioner() {
        let url = "<?= base_url('pemilik/get_chart') ?>";
        $.ajax({
            url: url,
            dataType: "JSON",
            data: {"dateStart": dateStart, "dateEnd": dateEnd},
            method: "POST",
            success: function (d) {
				load_chart(d.data)
            }
        });
    }

    function daysInMonth () {
        var today = new Date();
        var dateSize = new Date(today.getFullYear(), (today.getMonth()+1), 0).getDate();
        var dayArray = [];
        var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Agu','Sep','Ock','Nov','Des']
        for (let i = 1; i <= dateSize; i++) {
			dayArray.push(i+" "+months[today.getMonth()])
        }
        return dayArray
    }

    function init_date_picker() {
        flatpickr('.daterangepicker', {
            mode: 'range',
            defaultDate: [dateStart, dateEnd],
            conjunction: " s/d ",
            onChange: function(selectedDates, dateStr, instance){
                dateStart = selectedDates[0].getFullYear() + "-" + (selectedDates[0].getMonth() + 1) + "-" + (selectedDates[0].getDate());
                dateEnd = selectedDates[1].getFullYear() + "-" + (selectedDates[1].getMonth() + 1) + "-" + (selectedDates[1].getDate());
                load_kuisioner()
                load_pesanan()
            }
        })

        load_kuisioner()
		load_pesanan()
    }
    init_date_picker()
	
	function load_pesanan() {
        let url = "<?= base_url('pemilik/get_pesanan') ?>";
        $.ajax({
            url: url,
            dataType: "JSON",
            data: {"dateStart": dateStart, "dateEnd": dateEnd},
            method: "POST",
            success: function (data) {
                var d = data.data
				$("#selesai").html(d.selesai)
				$("#waiting").html(d.waiting)
				$("#proses").html(d.proses)
				$("#pengunjung").html(d.pengunjung)
            }
        });
    }

    // Data example
    // monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July']
	function load_chart(ch) {
        monthNames = daysInMonth()
        data1 = ch.makanan
        data2 = ch.minuman
        data3 = ch.pelayanan

        // Global configuration
        Chart.defaults.global.elements.rectangle.borderWidth = 1 // bar border width
        Chart.defaults.global.elements.line.borderWidth = 1 // label border width
        Chart.defaults.global.maintainAspectRatio = false // disable the maintain aspect ratio in options then it uses the available height

        /***************** MULTI AXIS *****************/
        new Chart('bar-chart-multi', {
            type: 'bar',
            data: {
                labels: monthNames,
                datasets: [
                    {
                        label: 'Makanan',
                        backgroundColor: Chart.helpers.color(cyan).alpha(0.5).rgbString(),
                        borderColor: cyan,
                        data: data1
                    },
                    {
                        label: 'Minuman',
                        backgroundColor: Chart.helpers.color(yellow).alpha(0.5).rgbString(),
                        borderColor: yellow,
                        data: data2
                    },
                    {
                        label: 'Pelayanan',
                        backgroundColor: Chart.helpers.color(red).alpha(0.5).rgbString(),
                        borderColor: red,
                        data: data3
                    }
                ]
            },
            options: {
                tooltips: {
                    mode: 'index',
                    intersect: false
                    // Interactions configuration: https://www.chartjs.org/docs/latest/general/interactions/
                }
            }
        })
    }
</script>

</body>

</html>
