<?php 
    use \App\Models\SystemModel;
    $sm = new SystemModel;
    $cnf = $sm->countnotif();
    $crypt = \Config\Services::encrypter();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title;?></title>

    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/litepicker/dist/css/litepicker.css" rel="stylesheet" />
    <link href="https://unpkg.com/easymde/dist/easymde.min.css" rel="stylesheet" />
    <link href="<?= base_url()?>css/styles.css" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="<?= base_url()?>img/bg/APPLAUD1.png" />
    <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.29.0/feather.min.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.4/xlsx.full.min.js"></script>

</head>
<body class="nav-fixed bg-primary-soft">

    <nav class="topnav navbar navbar-expand shadow justify-content-between justify-content-sm-start navbar-light bg-white" id="sidenavAccordion">
        <!-- Sidenav Toggle Button-->
        <button class="btn btn-icon btn-transparent-dark order-1 order-lg-0 me-2 ms-lg-2 me-lg-0" id="sidebarToggle"><i data-feather="menu"></i></button>
        <!-- Navbar Brand-->
        <!-- * * Tip * * You can use text or an image for your navbar brand.-->
        <!-- * * * * * * When using an image, we recommend the SVG format.-->
        <!-- * * * * * * Dimensions: Maximum height: 32px, maximum width: 240px-->
        <img src="<?= base_url()?>img/bg/APPLAUD1.png" alt="" style="width: 40px;" >
        <a class="navbar-brand pe-3 ps-4 ps-lg-2" href="<?= base_url()?>auditsystem/dashboard">ApplAud</a>
        <!-- Navbar Items-->
        <ul class="navbar-nav align-items-center ms-auto">
            <!-- Alerts Dropdown-->
            <li class="nav-item dropdown no-caret d-none d-md-block me-3">
                <a class="nav-link dropdown-toggle" id="navbarDropdownDocs" href="javascript:void(0);" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="fw-500">Documentation</div>
                    <i class="fas fa-chevron-right dropdown-arrow"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-end py-0 me-sm-n15 me-lg-0 o-hidden animated--fade-in-up" aria-labelledby="navbarDropdownDocs">
                    <a class="dropdown-item py-3" href="<?= base_url()?>auditsystem/documentation" target="_blank">
                        <div class="icon-stack bg-primary-soft text-primary me-4"><i data-feather="book"></i></div>
                        <div>
                            <div class="small text-gray-500">Documentation</div>
                            Usage instructions and reference
                        </div>
                    </a>
                </div>
            </li>
            <li class="nav-item dropdown no-caret d-none d-sm-block me-3 dropdown-notifications">
                <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownAlerts" href="javascript:void(0);" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="bell"></i><span class="badge bg-red text-white" id="notiffirm"><?php if($cnf == 0){echo '';}else{echo $cnf;}?></span></a>
                <div class="dropdown-menu dropdown-menu-end border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownAlerts">
                    <h6 class="dropdown-header dropdown-notifications-header">
                        <i class="me-2" data-feather="bell"></i>
                        Notification Center
                    </h6>
                    <?php foreach($sm->getnotif() as $ntf){?>
                        <a class="dropdown-item dropdown-notifications-item" href="<?= base_url()?>auditsystem/notif">
                            <div class="dropdown-notifications-item-icon bg-<?= $ntf['intensity']?>"><i class="fas fa-exclamation-triangle"></i></div>
                            <div class="dropdown-notifications-item-content">
                                <div class="dropdown-notifications-item-content-details"><?= date('F d, Y ', strtotime($ntf['added_on']))?></div>
                                <div class="dropdown-notifications-item-content-text"><?= $ntf['msg']?></div>
                            </div>
                        </a>
                    <?php }?>
                    <a class="dropdown-item dropdown-notifications-footer" href="<?= base_url()?>auditsystem/notif">View All Alerts</a>
                </div>
            </li>
            <!-- User Dropdown-->
            <li class="nav-item dropdown no-caret dropdown-user me-3 me-lg-4">
                <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownUserImage" href="javascript:void(0);" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php if(!empty(session()->get('photo'))){ ?>
                        <img class="img-fluid" src="<?= base_url()?>uploads/img/<?= $crypt->decrypt(session()->get('firmID'))?>/photo/<?= session()->get('photo')?>" />
                    <?php }elseif(!empty(session()->get('logo'))){ ?>
                         <img class="img-fluid" src="<?= base_url()?>uploads/img/<?= $crypt->decrypt(session()->get('firmID'))?>/logo/<?= session()->get('logo')?>" />
                    <?php }elseif(empty(session()->get('photo')) and empty(session()->get('logo'))){ ?>
                        <img class="img-fluid" src="<?= base_url()?>img/bg/APPLAUD1.png" />
                    <?php }?>
                </a>
                <div class="dropdown-menu dropdown-menu-end border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownUserImage">
                    <h6 class="dropdown-header d-flex align-items-center">
                    <?php if(!empty(session()->get('photo'))){ ?>
                        <img class="dropdown-user-img" src="<?= base_url()?>uploads/img/<?= $crypt->decrypt(session()->get('firmID'))?>/photo/<?= session()->get('photo')?>" />
                    <?php }elseif(!empty(session()->get('logo'))){ ?>
                        <img class="dropdown-user-img" src="<?= base_url()?>uploads/img/<?= $crypt->decrypt(session()->get('firmID'))?>/logo/<?= session()->get('logo')?>" />
                    <?php }elseif(empty(session()->get('photo')) and empty(session()->get('logo'))){ ?>
                        <img class="dropdown-user-img" src="<?= base_url()?>img/bg/APPLAUD1.png" />
                    <?php }?>
                        <div class="dropdown-user-details">
                            <div class="dropdown-user-details-name"><?= session()->get('name') ?></div>
                            <div class="dropdown-user-details-email"><?= session()->get('email') ?></div>
                            <div class="dropdown-user-details-email"><?= session()->get('pos') ?></div>
                        </div>
                    </h6>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?= base_url()?>auditsystem/myaccount">
                        <div class="dropdown-item-icon"><i data-feather="settings"></i></div>
                        Account
                    </a>
                    <a class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#logoutmodal" >
                        <div class="dropdown-item-icon"><i data-feather="log-out"></i></div>
                        Logout
                    </a>

                </div>
            </li>
        </ul>
    </nav>
    
    <!-- Modal Logout-->
    <div class="modal fade" id="logoutmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Confirmation</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    
                    <h3>Are you sure to log out your session?</h3>
                    
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                    <form action="<?= base_url('logout')?>" method="post">
                        <button class="btn btn-primary" type="submit">Confirm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sidenav shadow-right sidenav-light">
                <div class="sidenav-menu">
                    <div class="nav accordion" id="accordionSidenav">
                        <div class="mt-3 container row justify-content-center">
                        <?php if(!empty(session()->get('logo'))){ ?>
                            <img class="" src="<?= base_url()?>uploads/img/<?= $crypt->decrypt(session()->get('firmID'))?>/logo/<?= session()->get('logo')?>" alt="Firm Logo" style="width: 60%;" >
                        <?php }else{ ?>
                            <img class="" src="<?= base_url()?>img/bg/APPLAUD1.png" alt="Firm Logo" style="width: 60%;" >
                        <?php }?>
                            <h6 class="text-center m-1"><?= session()->get('firm')?></h6>
                        </div>
                        <!-- Sidenav Menu Heading (Core)-->
                        <div class="sidenav-menu-heading">Core</div>
                        <!-- Sidenav Accordion (Dashboard)-->
                        <?php if(session()->get('allowed')->dash == "Yes"){?>
                        <a class="nav-link <?php if(str_contains(uri_string(),'auditsystem/dashboard')){echo 'active';}?>" href="<?= base_url('auditsystem/dashboard')?>">
                            <div class="nav-link-icon"><i data-feather="activity"></i></div>
                            Dashboard
                        </a>
                        <?php }?>

                        <div class="sidenav-menu-heading">Managements </div>
                        <?php 
                            $carr = ['auditsystem/client/set','auditsystem/client/files','auditsystem/client/getfiles','auditsystem/client/chapter1/setvalues','auditsystem/client/chapter2/setvalues','auditsystem/client/chapter3/setvalues'];
                        ?>
                        <?php if(session()->get('allowed')->clm == "Yes"){?>
                            <a class="nav-link <?php if(str_contains(uri_string(),'auditsystem/client')){echo 'active collapse';}else{echo 'collapsed';} ?>" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseClient" aria-expanded="false" aria-controls="collapseClient">
                            <div class="nav-link-icon"><i data-feather="table"></i></div>
                                Client Management 
                                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse <?php if(str_contains(uri_string(),'auditsystem/client')){echo 'show';}?>" id="collapseClient" data-bs-parent="#accordionSidenav">
                                <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">
                                <?php if(session()->get('allowed')->cl == "Yes"){?>
                                    <a class="nav-link <?php foreach($carr as $str){if(str_contains(uri_string(),$str)){$res = true;}else{$res = false;continue;}}if($res == true){echo 'active';}?>" href="<?= base_url()?>auditsystem/client">
                                    <div class="nav-link-icon"><i data-feather="users"></i></div>Clients</a>
                                <?php }?>
                                <?php if(session()->get('allowed')->sd == "Yes"){?>
                                    <a class="nav-link <?php foreach($carr as $str){if(str_contains(uri_string(),$str)){echo 'active';}}?>" href="<?= base_url()?>auditsystem/client/set">
                                    <div class="nav-link-icon"><i data-feather="tool"></i></div>Set Defaults</a>
                                <?php }?>
                                </nav>
                            </div>
                        <?php }?>
                       
                        <?php if(session()->get('allowed')->audm == "Yes"){?>
                            <a class="nav-link <?php if(str_contains(uri_string(),'auditsystem/auditor')){echo 'active collapse';}else{echo 'collapsed';} ?>" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseAuditor" aria-expanded="false" aria-controls="collapseAuditor">
                                <div class="nav-link-icon"><i data-feather="sliders"></i></div>
                                Auditor Management
                                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <?php if(session()->get('allowed')->aud == "Yes"){?>
                            <div class="collapse <?php if(str_contains(uri_string(),'auditsystem/auditor')){echo 'show';}?>" id="collapseAuditor" data-bs-parent="#accordionSidenav">
                                <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">
                                    <a class="nav-link <?php if(str_contains(uri_string(),'auditsystem/auditor')){echo 'active';}?>" href="<?= base_url()?>auditsystem/auditor">
                                    <div class="nav-link-icon"><i data-feather="slack"></i></div>Auditor</a>
                                </nav>
                            </div>
                            <?php }?>
                        <?php }?>
                            
                        <?php if(session()->get('allowed')->workp == "Yes"){?>
                                <div class="sidenav-menu-heading">Work Paper</div>
                            <?php if(session()->get('allowed')->preparer == "Yes"){?>
                                <a class="nav-link <?php if(str_contains(uri_string(),'auditsystem/wp/')){echo 'active collapse';}else{echo 'collapsed';} ?>" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapsePrepare" aria-expanded="false" aria-controls="collapsePrepare">
                                    <div class="nav-link-icon"><i data-feather="edit"></i></div>
                                    Prepare
                                    <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse <?php if(str_contains(uri_string(),'auditsystem/wp/prepare')){echo 'show';}?>" id="collapsePrepare" data-bs-parent="#accordionSidenav">
                                    <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">
                                        <a class="nav-link <?php if(str_contains(uri_string(),'auditsystem/wp/prepare')){echo 'active';}?>" href="<?= base_url()?>auditsystem/wp/prepare">
                                        <div class="nav-link-icon"><i data-feather="edit-3"></i></div>Prepare Work Paper</a>
                                    </nav>
                                </div>
                            <?php }?>
                            <?php if(session()->get('allowed')->reviewer == "Yes"){?>
                                <a class="nav-link <?php if(str_contains(uri_string(),'auditsystem/wp/')){echo 'active collapse';}else{echo 'collapsed';} ?>" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseReview" aria-expanded="false" aria-controls="collapseReview">
                                    <div class="nav-link-icon"><i data-feather="eye"></i></div>
                                    Review
                                    <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse <?php if(str_contains(uri_string(),'auditsystem/wp/review')){echo 'show';}?>" id="collapseReview" data-bs-parent="#accordionSidenav">
                                    <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">
                                        <a class="nav-link <?php if(str_contains(uri_string(),'auditsystem/wp/review')){echo 'active';}?>" href="<?= base_url()?>auditsystem/wp/review">
                                        <div class="nav-link-icon"><i data-feather="check-square"></i></div>Check Work Paper</a>
                                    </nav>
                                </div>
                            <?php }?>
                            <?php 
                                $audarr = ['auditsystem/wp/initiate','auditsystem/wp/approved'];
                            ?>
                            <?php if(session()->get('allowed')->audmanager == "Yes"){?>
                            <a class="nav-link <?php if(str_contains(uri_string(),'auditsystem/wp/')){echo 'active collapse';}else{echo 'collapsed';} ?>" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseAudManager" aria-expanded="false" aria-controls="collapseAudManager">
                                <div class="nav-link-icon"><i data-feather="users"></i></div>
                                Audit Manager
                                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse <?php foreach($audarr as $aud){if(str_contains(uri_string(),$aud)){echo 'show';}} ?>" id="collapseAudManager" data-bs-parent="#accordionSidenav">
                                <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">
                                    <a class="nav-link <?php if(str_contains(uri_string(),'auditsystem/wp/initiate')){echo 'active';}?>" href="<?= base_url()?>auditsystem/wp/initiate">
                                    <div class="nav-link-icon"><i data-feather="file-plus"></i></div>Initiate</a>
                                    <a class="nav-link <?php if(str_contains(uri_string(),'auditsystem/wp/approved')){echo 'active';}?>" href="<?= base_url()?>auditsystem/wp/approved">
                                    <div class="nav-link-icon"><i data-feather="check-square"></i></div>Approved</a>
                                </nav>
                            </div>
                            <?php }?>
                        <?php }?>
                        <div class="sidenav-menu-heading">System </div>
                        <?php if(session()->get('allowed')->dash == "Yes"){?>
                        <a class="nav-link <?php if(str_contains(uri_string(),'auditsystem/logs')){echo 'active';}?>" href="<?= base_url('auditsystem/logs')?>">
                            <div class="nav-link-icon"><i data-feather="edit-3"></i></div>
                            Logs
                        </a>
                        <?php }?>

                    </div>
                </div>
                <!-- Sidenav Footer-->
                <div class="sidenav-footer">
                    <div class="sidenav-footer-content">
                        <div class="sidenav-footer-subtitle">Logged in as:</div>
                        <div class="sidenav-footer-title"><?= session()->get('name') ?></div>
                        <div class="sidenav-footer-title"><?= session()->get('type') ?></div>
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">

    
                
                








 
