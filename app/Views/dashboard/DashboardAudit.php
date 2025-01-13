<main>
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
        <div class="container-xl px-4">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="activity"></i></div>
                            <?= $title?>
                        </h1>
                        <div class="page-header-subtitle">Summary information about your firm</div>
                    </div>
                    <div class="col-12 col-xl-auto mt-4">
                        <div class="input-group input-group-joined border-0" style="width: 16.5rem">
                            <span class="input-group-text"><i class="text-primary" data-feather="calendar"></i></span>
                            <select name="" id="dateyear" class="form-control" data-url="<?= base_url()?>auditsystem/dashboard/wp/" data-urlpp="<?= base_url()?>auditsystem/dashboard/numwpp/">
                                <option value="2000">2000</option>
                                <option value="2001">2001</option>
                                <option value="2002">2002</option>
                                <option value="2003">2003</option>
                                <option value="2004">2004</option>
                                <option value="2005">2005</option>
                                <option value="2006">2006</option>
                                <option value="2007">2007</option>
                                <option value="2008">2008</option>
                                <option value="2009">2009</option>
                                <option value="2010">2010</option>
                                <option value="2011">2011</option>
                                <option value="2012">2012</option>
                                <option value="2013">2013</option>
                                <option value="2014">2014</option>
                                <option value="2015">2015</option>
                                <option value="2016">2016</option>
                                <option value="2017">2017</option>
                                <option value="2018">2018</option>
                                <option value="2019">2019</option>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                                <option value="2024" selected>2024</option>
                                <option value="2025">2025</option>
                                <option value="2026">2026</option>
                                <option value="2027">2027</option>
                                <option value="2028">2028</option>
                                <option value="2029">2029</option>
                                <option value="2030">2030</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container-xl px-4 mt-n10">
        <div class="row">
            <div class="col-xl-3 mb-4">
                <!-- Dashboard example card 1-->
                <div class="card lift h-100">
                    <div class="card-body d-flex justify-content-center flex-column">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="me-3">
                                <i class="feather-xl text-primary mb-3" data-feather="user-check"></i>
                                <h5>Your Clients</h5>
                                <h1 class="text-xl"><?= $numcli?></h1>
                            </div>
                            <img src="<?= base_url()?>assets/img/illustrations/client.svg" alt="..." style="width: 8rem" />
                        </div>
                    </div>
                </div>
                
            </div>

            <div class="col-xl-3 mb-4">
                <!-- Dashboard example card 2-->
                <div class="card lift h-100">
                    <div class="card-body d-flex justify-content-center flex-column">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="me-3">
                                <i class="feather-xl text-warning mb-3" data-feather="edit-3"></i>
                                <h5>Preparing</h5>
                                <h1 class="text-xl" id="numprep"><?= $prep?></h1>
                            </div>
                            <img src="<?= base_url()?>assets/img/illustrations/working.svg" alt="..." style="width: 8rem" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 mb-4">
                <!-- Dashboard example card 3-->
                <div class="card lift h-100">
                    <div class="card-body d-flex justify-content-center flex-column">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="me-3">
                                <i class="feather-xl text-secondary mb-3" data-feather="eye"></i>
                                <h5>Reviewing</h5>
                                <h1 class="text-xl" id="numrev"><?= $rev?></h1>
                            </div>
                            <img src="<?= base_url()?>assets/img/illustrations/review.svg" alt="..." style="width: 8rem" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 mb-4">
                <!-- Dashboard example card 3-->
                <div class="card lift h-100">
                    <div class="card-body d-flex justify-content-center flex-column">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="me-3">
                                <i class="feather-xl text-success mb-3" data-feather="check-square"></i>
                                <h5>Approved</h5>
                                <h1 class="text-xl" id="numdone"><?= $approved?></h1>
                            </div>
                            <img src="<?= base_url()?>assets/img/illustrations/approve.svg" alt="..." style="width: 8rem"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xxl-8">
                <!-- Tabbed dashboard card example-->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="col-xl-6 col-xxl-12">
                            <!-- Project tracker card example-->
                            <div class="card card-header-actions mb-4">
                                <div class="card-header">
                                    Work Paper Progress
                                </div>
                                <div class="card-body" id="progress">
                                    
                                    <?php foreach($prog as $r){
                                        $x = $r['x1'] + $r['x2'] + $r['x3'];
                                        $y = $r['y1'] + $r['y2'] + $r['y3'];
                                        if($x == 0 or $y == 0 or ($r['ir'] == 0 and $r['ic'] == 0 and $r['ia'] == 0)){
                                            $p = 1;
                                        }else{
                                            $ir = ($r['ir'] * 50) /  $r['ti'];
                                            $ic = ($r['ic'] * 75) /  $r['ti'];
                                            $ia = ($r['ia'] * 100) /  $r['ti'];
                                            $z = round($ir + $ic + $ia, 2);
                                            $p = round($y / $x, 2) * 100;
                                            $p = round(($p * .75) + ($z * .25));
                                        }
                                        if($p <= 25){
                                            $badge = 'danger';
                                        }elseif($p <= 50 and $p >= 26){
                                            $badge = 'warning';
                                        }elseif($p <= 75 and $p >= 51){
                                            $badge = 'secondary';
                                        }elseif($p <= 85 and $p >= 76){
                                            $badge = 'primary';
                                        }elseif($p >= 86){
                                            $badge = 'success';
                                        }
                                        ?>
                                        <div class="d-flex align-items-center justify-content-between small mb-1">
                                            <div class="fw-bold"><?= $r['cli'].' - '.$r['org']?></div>
                                            <div class="small"><?= $p?>%</div>
                                        </div>
                                        <div class="progress mb-3"><div class="progress-bar bg-<?= $badge?>" role="progressbar" style="width: <?= $p?>%" aria-valuenow="<?= $p?>" aria-valuemin="0" aria-valuemax="100"></div></div>
                                    <?php }?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Illustration dashboard card example-->
                <div class="card mb-4">
                    <div class="card-body py-5">
                        <div class="d-flex flex-column justify-content-center">
                            <!-- <img class="img-fluid mb-4" src="assets/img/illustrations/data-report.svg" alt="" style="height: 10rem" /> -->
                            <img class="img-fluid mb-4" src="<?= base_url()?>assets/img/illustrations/team-spirit.svg" alt="" style="height: 10rem" />
                            <div class="px-0 px-lg-5">
                                <a href="<?= base_url("auditsystem/logs")?>"><h5>Team Access</h5></a>
                                <p class="mb-4"><?= $logs ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-4">
                <div class="row">
                    <div class="col-xl-6 col-xxl-12">
                        <!-- Team members / people dashboard card example-->
                        <div class="card mb-4">
                            <div class="card-header">People</div>
                            <div class="card-body">
                                <!-- Item 1-->
                                <?php foreach($aud as $r){?>
                                    <div class="d-flex align-items-center justify-content-between mb-4">
                                        <div class="d-flex align-items-center flex-shrink-0 me-3">
                                            <div class="avatar avatar-xl me-3 bg-gray-200">
                                            <?php if(empty($r['photo']) or $r['photo'] == ''){ ?>
                                                <img class="avatar-img img-fluid" src="<?= base_url()?>assets/img/illustrations/profiles/profile-5.png" />
                                            <?php }else{ ?>
                                                <img class="avatar-img img-fluid" src="<?= base_url()?>uploads/img/<?= decr(session()->get('firmID'))?>/photo/<?= $r['photo']?>" />
                                            <?php }?>
                                            </div>
                                            <div class="d-flex flex-column fw-bold">
                                                <a class="text-dark line-height-normal mb-1" href="#!"><?= $r['name']?></a>
                                                <div class="small text-muted line-height-normal"><?= $r['position'].' - '.$r['type']?></div>
                                            </div>
                                        </div>
                                    </div>
                                <?php }?>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <!-- Illustration dashboard card example-->
                <div class="card">
                    <div class="card-body text-center p-5">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</main>
<script>
$(document).ready(function () {

    $("#dateyear").on("change", function() {
        var url = $(this).data('url');
        var urlpp = $(this).data('urlpp');
        var year = $(this).val();
        
        $("#progress").html(`
        <div class="container mt-3">
            <p>Loading...</p>
            <div class="spinner-grow text-muted"></div>
            <div class="spinner-grow text-primary"></div>
            <div class="spinner-grow text-success"></div>
            <div class="spinner-grow text-info"></div>
            <div class="spinner-grow text-warning"></div>
            <div class="spinner-grow text-danger"></div>
            <div class="spinner-grow text-secondary"></div>
            <div class="spinner-grow text-dark"></div>
            <div class="spinner-grow text-light"></div>
        </div>`);
        var pg = ``;
        $.ajax({
            url: url + year, 
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                $.each(data, function(i, r) {
                    var x = parseInt(r.x1) + parseInt(r.x2) + parseInt(r.x3);
                    var y = parseInt(r.y1) + parseInt(r.y2) + parseInt(r.y3);
                    var p;
                    var badge = '';
                    if(x == 0 || y == 0){
                        p = 1;
                    }else{
                        var ir = (parseInt(r.ir) * 50) / parseInt(r.ti);
                        var ic = (parseInt(r.ic) * 75) / parseInt(r.ti);
                        var ia = (parseInt(r.ia) * 100) / parseInt(r.ti);
                        var z = Math.round(ir + ic + ia);
                        p = Math.round((y / x) * 100) ;
                        p = Math.round((p * .75) + (z * .25));
                    }
                    if(p <= 25){
                        badge = 'danger';
                    }else if(p <= 50 && p >= 26){
                        badge = 'warning';
                    }else if(p <= 75 && p >= 51){
                        badge = 'secondary';
                    }else if(p <= 85 && p >= 76){
                        badge = 'primary';
                    }else if(p <= 100 && p >= 86){
                        badge = 'success';
                    }
                    pg += `
                    <div class="d-flex align-items-center justify-content-between small mb-1">
                        <div class="fw-bold">${r.cli} - ${r.org}</div>
                        <div class="small">${p}%</div>
                    </div>
                    <div class="progress mb-3"><div class="progress-bar bg-${badge}" role="progressbar" style="width: ${p}%" aria-valuenow="${p}" aria-valuemin="0" aria-valuemax="100"></div></div>
                    `;
                });
                $("#progress").html(pg);
            },
            error: function() {
                // Handle error if the data fetch fails
                $("#progress").html("No Data Found");
            }
        });
        $.ajax({
            url: urlpp + year, 
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                $('#numprep').html(data.prep);
                $('#numrev').html(data.rev);
                $('#numcheck').html(data.check);
                $('#numdone').html(data.done);
            }
        });
        

    });

});
</script>