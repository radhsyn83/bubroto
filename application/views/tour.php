<div class="slider-card container-fluid p-lg-5 align-content-center animated fadeIn"">
	<div id="loader" class="loader">Loading...</div>
	<div class="row tour-content"></div>
</div>

<!-- Modal -->
<div class="modal fade" id="menuModal" tabindex="-1" role="dialog" aria-labelledby="menuModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content modal-option">
			<div id="container">
				<div id="header">
					<div class="row" style="height: 100% !important; margin: 0px">
						<div class="col-md-12 header-modal">
							<img onclick="dismissMenuModal()" class="back-btn align-content-center"
								 src="<?= base_url() ?>assets/images/arrow-back.png"/>
							<span id="modal-title" class="title">SMART UNIKOM TOUR</span>
						</div>
					</div>
				</div>
				<div class="modal-content-3d slider-card	">
					<div id="loader-sub" class="loader">Loading...</div>
					<div class="row tour-sub-content"></div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Tour Modal -->
<div class="modal fade" id="tourModal" tabindex="-1" role="dialog" aria-labelledby="tourModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content modal-option">
			<div id="container">
				<div class="header-modal-tour">
					<img onclick="dismissTourModal()" class="back-btn align-content-center"
						 src="<?= base_url() ?>assets/images/arrow-back.png"/>
					<span id="modal-title-tour" class="title">SMART UNIKOM TOUR</span>
				</div>
				<iframe id="tour-frame"></iframe>
			</div>
		</div>
	</div>
</div>

<script>
	function loadDataMenu() {
        $.ajax({
            url: "<?php echo base_url(); ?>/tour/get_data",
            method: "POST",
            dataType: "JSON",
			beforeSend: function (){
				$('#loader').css("display", "flex");
				$('.tour-content').css("display", "none");
			},
            success: function (data) {
                var a = "";
                for (let i = 0; i < data.length; i++) {
                    a += '<div class="col-4 animated zoomIn faster" onclick="loadSubMenu(' + data[i].id + ',\''+ data[i].title + '\')">' +
                        '<div class="card bg-transparent text-white" style="height: 300px">' +
                        '<div class="img-bg h-100 w-auto" style="background-image: url(\'<?= base_url() ?>'+ data[i].thumbnail + '\');">' +
                        '<div class="img-title card-img-bottom">' +
                        '<span class="card-title">' + data[i].title + '</span>' +
                        '<img class="logo" src="<?= base_url() ?>assets/images/360.png"/> ' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>';
                };
                $('.tour-content').html(a);
                $('#loader').css("display", "none");
                $('.tour-content').css("display", "flex");
            }
        });
    }

    loadDataMenu();

    function dismissMenuModal() {
        $('#menuModal').modal('hide');
    };

    function dismissTourModal() {
        $('#tourModal').modal('hide');
    };

    function showTourModal(url, title) {
        console.log(url);
        if (url !== "null") {
            $('#tourModal').modal('show');
            $('#modal-title-tour').html(title);
            $("#tour-frame").attr("src", url);
		} else {
            alert("Virtual Tour belum tersedia");
		}
    }

    function loadSubMenu(id, title) {
        $('#menuModal').modal('show');
        $('#modal-title').html(title);
        $.ajax({
            url: "<?php echo base_url(); ?>/tour/get_data_sub/" + id,
            method: "POST",
            dataType: "JSON",
            beforeSend: function (){
                $('#loader-sub').css("display", "flex");
                $('.tour-sub-content').css("display", "none");
            },
            success: function (data) {
                console.log(data);
                var a = "";
                for (let i = 0; i < data.length; i++) {
                    var url = data[i].tour_link;

                    a += '<div class="col-3 card-tour-item animated zoomIn faster" onclick="showTourModal(\''+ url + '\',\''+ data[i].title + '\')">' +
                        '<div class="card bg-transparent text-white" style="height: 200px">' +
                        '<div class="img-bg h-100 w-auto" style="background-image: url(\'<?= base_url() ?>'+ data[i].thumbnail + '\');">' +
                        '<div class="img-title card-img-bottom">' +
                        '<span class="card-title">' + data[i].title + '</span>' +
                        '<img class="logo" src="<?= base_url() ?>assets/images/360.png"/> ' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>';
                };
                $('.tour-sub-content').html(a);
                $('#loader-sub').css("display", "none");
                $('.tour-sub-content').css("display", "flex");
            }
        });
	}

    // $('#miracle-building').click(function () {
    //     $('#menuModal').modal('show');
    //     $('#modal-title').html('UNIKOM Miracle Building');
    //     // $("#frame").attr("src", "http://127.0.0.1:8887");
    // });
</script>
