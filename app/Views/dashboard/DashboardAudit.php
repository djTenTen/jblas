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
                        <div class="page-header-subtitle">Summary information about your firm.</div>
                    </div>
                    <div class="col-12 col-xl-auto mt-4">
                        <div class="input-group input-group-joined border-0" style="width: 16.5rem">
                            <span class="input-group-text"><i class="text-primary" data-feather="calendar"></i></span>
                            <input class="form-control ps-0 pointer" id="litepickerRangePlugin" placeholder="Select date range..." />
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
                                <i class="feather-xl text-primary mb-3" data-feather="users"></i>
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
                                <h1 class="text-xl"><?= $prep?></h1>
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
                                <h1 class="text-xl"><?= $rev?></h1>
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
                                <h5>Done</h5>
                                <h1 class="text-xl"><?= $check?></h1>
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
                                <div class="card-body">
                                    <!-- Progress item 1-->
                                    <div class="d-flex align-items-center justify-content-between small mb-1">
                                        <div class="fw-bold">Server Setup</div>
                                        <div class="small">25%</div>
                                    </div>
                                    <div class="progress mb-3"><div class="progress-bar bg-danger" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div></div>
                                    <!-- Progress item 2-->
                                    <div class="d-flex align-items-center justify-content-between small mb-1">
                                        <div class="fw-bold">Database Migration</div>
                                        <div class="small">50%</div>
                                    </div>
                                    <div class="progress mb-3"><div class="progress-bar bg-warning" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div></div>
                                    <!-- Progress item 3-->
                                    <div class="d-flex align-items-center justify-content-between small mb-1">
                                        <div class="fw-bold">Version Release</div>
                                        <div class="small">75%</div>
                                    </div>
                                    <div class="progress mb-3"><div class="progress-bar bg-primary" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div></div>
                                    <!-- Progress item 4-->
                                    <div class="d-flex align-items-center justify-content-between small mb-1">
                                        <div class="fw-bold">Product Listings</div>
                                        <div class="small">100%</div>
                                    </div>
                                    <div class="progress"><div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div></div>
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
                            <img class="img-fluid mb-4" src="assets/img/illustrations/team-spirit.svg" alt="" style="height: 10rem" />
                            <div class="px-0 px-lg-5">
                    
                                <h5>Team Access</h5>
                                <p class="mb-4"><?= $logs ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6 mb-4">
                        <!-- Dashboard activity timeline example-->
                        <div class="card card-header-actions h-100">
                            <div class="card-header">
                                Recent Activity
                                <div class="dropdown no-caret">
                                    <button class="btn btn-transparent-dark btn-icon dropdown-toggle" id="dropdownMenuButton" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="text-gray-500" data-feather="more-vertical"></i></button>
                                    <div class="dropdown-menu dropdown-menu-end animated--fade-in-up" aria-labelledby="dropdownMenuButton">
                                        <h6 class="dropdown-header">Filter Activity:</h6>
                                        <a class="dropdown-item" href="#!"><span class="badge bg-green-soft text-green my-1">Commerce</span></a>
                                        <a class="dropdown-item" href="#!"><span class="badge bg-blue-soft text-blue my-1">Reporting</span></a>
                                        <a class="dropdown-item" href="#!"><span class="badge bg-yellow-soft text-yellow my-1">Server</span></a>
                                        <a class="dropdown-item" href="#!"><span class="badge bg-purple-soft text-purple my-1">Users</span></a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="timeline timeline-xs">
                                    <!-- Timeline Item 1-->
                                    <div class="timeline-item">
                                        <div class="timeline-item-marker">
                                            <div class="timeline-item-marker-text">27 min</div>
                                            <div class="timeline-item-marker-indicator bg-green"></div>
                                        </div>
                                        <div class="timeline-item-content">
                                            New order placed!
                                            <a class="fw-bold text-dark" href="#!">Order #2912</a>
                                            has been successfully placed.
                                        </div>
                                    </div>
                                    <!-- Timeline Item 2-->
                                    <div class="timeline-item">
                                        <div class="timeline-item-marker">
                                            <div class="timeline-item-marker-text">58 min</div>
                                            <div class="timeline-item-marker-indicator bg-blue"></div>
                                        </div>
                                        <div class="timeline-item-content">
                                            Your
                                            <a class="fw-bold text-dark" href="#!">weekly report</a>
                                            has been generated and is ready to view.
                                        </div>
                                    </div>
                                    <!-- Timeline Item 3-->
                                    <div class="timeline-item">
                                        <div class="timeline-item-marker">
                                            <div class="timeline-item-marker-text">2 hrs</div>
                                            <div class="timeline-item-marker-indicator bg-purple"></div>
                                        </div>
                                        <div class="timeline-item-content">
                                            New user
                                            <a class="fw-bold text-dark" href="#!">Valerie Luna</a>
                                            has registered
                                        </div>
                                    </div>
                                    <!-- Timeline Item 4-->
                                    <div class="timeline-item">
                                        <div class="timeline-item-marker">
                                            <div class="timeline-item-marker-text">1 day</div>
                                            <div class="timeline-item-marker-indicator bg-yellow"></div>
                                        </div>
                                        <div class="timeline-item-content">Server activity monitor alert</div>
                                    </div>
                                    <!-- Timeline Item 5-->
                                    <div class="timeline-item">
                                        <div class="timeline-item-marker">
                                            <div class="timeline-item-marker-text">1 day</div>
                                            <div class="timeline-item-marker-indicator bg-green"></div>
                                        </div>
                                        <div class="timeline-item-content">
                                            New order placed!
                                            <a class="fw-bold text-dark" href="#!">Order #2911</a>
                                            has been successfully placed.
                                        </div>
                                    </div>
                                    <!-- Timeline Item 6-->
                                    <div class="timeline-item">
                                        <div class="timeline-item-marker">
                                            <div class="timeline-item-marker-text">1 day</div>
                                            <div class="timeline-item-marker-indicator bg-purple"></div>
                                        </div>
                                        <div class="timeline-item-content">
                                            Details for
                                            <a class="fw-bold text-dark" href="#!">Marketing and Planning Meeting</a>
                                            have been updated.
                                        </div>
                                    </div>
                                    <!-- Timeline Item 7-->
                                    <div class="timeline-item">
                                        <div class="timeline-item-marker">
                                            <div class="timeline-item-marker-text">2 days</div>
                                            <div class="timeline-item-marker-indicator bg-green"></div>
                                        </div>
                                        <div class="timeline-item-content">
                                            New order placed!
                                            <a class="fw-bold text-dark" href="#!">Order #2910</a>
                                            has been successfully placed.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 mb-4">
                        <!-- Pie chart with legend example-->
                        <div class="card h-100">
                            <div class="card-header">Traffic Sources</div>
                            <div class="card-body">
                                <div class="chart-pie mb-4"><canvas id="myPieChart" width="100%" height="50"></canvas></div>
                                <div class="list-group list-group-flush">
                                    <div class="list-group-item d-flex align-items-center justify-content-between small px-0 py-2">
                                        <div class="me-3">
                                            <i class="fas fa-circle fa-sm me-1 text-blue"></i>
                                            Direct
                                        </div>
                                        <div class="fw-500 text-dark">55%</div>
                                    </div>
                                    <div class="list-group-item d-flex align-items-center justify-content-between small px-0 py-2">
                                        <div class="me-3">
                                            <i class="fas fa-circle fa-sm me-1 text-purple"></i>
                                            Social
                                        </div>
                                        <div class="fw-500 text-dark">15%</div>
                                    </div>
                                    <div class="list-group-item d-flex align-items-center justify-content-between small px-0 py-2">
                                        <div class="me-3">
                                            <i class="fas fa-circle fa-sm me-1 text-green"></i>
                                            Referral
                                        </div>
                                        <div class="fw-500 text-dark">30%</div>
                                    </div>
                                </div>
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

                                            <?php if(empty($r['photo'])){
                                                    $path = base_url().'uploads/logo/'.session()->get('logo');
                                                    if(file_exists($path) && is_file($path)) { ?>
                                                        <img class="avatar-img img-fluid" src="<?= base_url()?>uploads/logo/<?= session()->get('logo')?>" />
                                                    <?php }else{?>
                                                        <img class="avatar-img img-fluid" src="<?= base_url()?>assets/img/illustrations/profiles/profile-5.png" />
                                                    <?php }?>
                                            <?php }else{
                                                    $path = base_url().'uploads/photo/'.$r['photo'];
                                                    if(file_exists($path) && is_file($path)) { ?>
                                                        <img class="avatar-img img-fluid" src="<?= base_url()?>uploads/photo/<?= $r['photo']?>" />
                                                    <?php }else{?>
                                                        <img class="avatar-img img-fluid" src="<?= base_url()?>assets/img/illustrations/profiles/profile-5.png" />
                                                    <?php }?>
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
