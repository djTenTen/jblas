
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
    <link rel="icon" type="image/x-icon" href="<?= base_url()?>assets/img/favicon.png" />
    <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.29.0/feather.min.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

</head>
<body class="nav-fixed">

    <nav class="topnav navbar navbar-expand shadow justify-content-between justify-content-sm-start navbar-light bg-white" id="sidenavAccordion">
        <!-- Sidenav Toggle Button-->
        <button class="btn btn-icon btn-transparent-dark order-1 order-lg-0 me-2 ms-lg-2 me-lg-0" id="sidebarToggle"><i data-feather="menu"></i></button>
        <!-- Navbar Brand-->
        <!-- * * Tip * * You can use text or an image for your navbar brand.-->
        <!-- * * * * * * When using an image, we recommend the SVG format.-->
        <!-- * * * * * * Dimensions: Maximum height: 32px, maximum width: 240px-->
        <a class="navbar-brand pe-3 ps-4 ps-lg-2" href="auditsystem">ApplAud - <?= session()->get('firm')?></a>
       
        <!-- Navbar Items-->
        <ul class="navbar-nav align-items-center ms-auto">
           
            <!-- Navbar Search Dropdown-->
            <!-- * * Note: * * Visible only below the lg breakpoint-->
            <li class="nav-item dropdown no-caret me-3 d-lg-none">
                <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="searchDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="search"></i></a>
                <!-- Dropdown - Search-->
                <div class="dropdown-menu dropdown-menu-end p-3 shadow animated--fade-in-up" aria-labelledby="searchDropdown">
                    <form class="form-inline me-auto w-100">
                        <div class="input-group input-group-joined input-group-solid">
                            <input class="form-control pe-0" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                            <div class="input-group-text"><i data-feather="search"></i></div>
                        </div>
                    </form>
                </div>
            </li>
            <!-- Alerts Dropdown-->
            <li class="nav-item dropdown no-caret d-none d-sm-block me-3 dropdown-notifications">
                <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownAlerts" href="javascript:void(0);" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="bell"></i></a>
                <div class="dropdown-menu dropdown-menu-end border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownAlerts">
                    <h6 class="dropdown-header dropdown-notifications-header">
                        <i class="me-2" data-feather="bell"></i>
                        Alerts Center
                    </h6>
                    <!-- Example Alert 1-->
                    <a class="dropdown-item dropdown-notifications-item" href="#!">
                        <div class="dropdown-notifications-item-icon bg-warning"><i data-feather="activity"></i></div>
                        <div class="dropdown-notifications-item-content">
                            <div class="dropdown-notifications-item-content-details">December 29, 2021</div>
                            <div class="dropdown-notifications-item-content-text">This is an alert message. It's nothing serious, but it requires your attention.</div>
                        </div>
                    </a>
                    <!-- Example Alert 2-->
                    <a class="dropdown-item dropdown-notifications-item" href="#!">
                        <div class="dropdown-notifications-item-icon bg-info"><i data-feather="bar-chart"></i></div>
                        <div class="dropdown-notifications-item-content">
                            <div class="dropdown-notifications-item-content-details">December 22, 2021</div>
                            <div class="dropdown-notifications-item-content-text">A new monthly report is ready. Click here to view!</div>
                        </div>
                    </a>
                    <!-- Example Alert 3-->
                    <a class="dropdown-item dropdown-notifications-item" href="#!">
                        <div class="dropdown-notifications-item-icon bg-danger"><i class="fas fa-exclamation-triangle"></i></div>
                        <div class="dropdown-notifications-item-content">
                            <div class="dropdown-notifications-item-content-details">December 8, 2021</div>
                            <div class="dropdown-notifications-item-content-text">Critical system failure, systems shutting down.</div>
                        </div>
                    </a>
                    <!-- Example Alert 4-->
                    <a class="dropdown-item dropdown-notifications-item" href="#!">
                        <div class="dropdown-notifications-item-icon bg-success"><i data-feather="user-plus"></i></div>
                        <div class="dropdown-notifications-item-content">
                            <div class="dropdown-notifications-item-content-details">December 2, 2021</div>
                            <div class="dropdown-notifications-item-content-text">New user request. Woody has requested access to the organization.</div>
                        </div>
                    </a>
                    <a class="dropdown-item dropdown-notifications-footer" href="#!">View All Alerts</a>
                </div>
            </li>
            <!-- Messages Dropdown-->
            <li class="nav-item dropdown no-caret d-none d-sm-block me-3 dropdown-notifications">
                <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownMessages" href="javascript:void(0);" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="mail"></i></a>
                <div class="dropdown-menu dropdown-menu-end border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownMessages">
                    <h6 class="dropdown-header dropdown-notifications-header">
                        <i class="me-2" data-feather="mail"></i>
                        Message Center
                    </h6>
                    <!-- Example Message 1  -->
                    <a class="dropdown-item dropdown-notifications-item" href="#!">
                        <img class="dropdown-notifications-item-img" src="<?= base_url()?>assets/img/illustrations/profiles/profile-2.png" />
                        <div class="dropdown-notifications-item-content">
                            <div class="dropdown-notifications-item-content-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>
                            <div class="dropdown-notifications-item-content-details">Thomas Wilcox · 58m</div>
                        </div>
                    </a>
                    <!-- Example Message 2-->
                    <a class="dropdown-item dropdown-notifications-item" href="#!">
                        <img class="dropdown-notifications-item-img" src="<?= base_url()?>assets/img/illustrations/profiles/profile-3.png" />
                        <div class="dropdown-notifications-item-content">
                            <div class="dropdown-notifications-item-content-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>
                            <div class="dropdown-notifications-item-content-details">Emily Fowler · 2d</div>
                        </div>
                    </a>
                    <!-- Example Message 3-->
                    <a class="dropdown-item dropdown-notifications-item" href="#!">
                        <img class="dropdown-notifications-item-img" src="<?= base_url()?>assets/img/illustrations/profiles/profile-4.png" />
                        <div class="dropdown-notifications-item-content">
                            <div class="dropdown-notifications-item-content-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>
                            <div class="dropdown-notifications-item-content-details">Marshall Rosencrantz · 3d</div>
                        </div>
                    </a>
                    <!-- Example Message 4-->
                    <a class="dropdown-item dropdown-notifications-item" href="#!">
                        <img class="dropdown-notifications-item-img" src="<?= base_url()?>assets/img/illustrations/profiles/profile-5.png" />
                        <div class="dropdown-notifications-item-content">
                            <div class="dropdown-notifications-item-content-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>
                            <div class="dropdown-notifications-item-content-details">Colby Newton · 3d</div>
                        </div>
                    </a>
                    <!-- Footer Link-->
                    <a class="dropdown-item dropdown-notifications-footer" href="#!">Read All Messages</a>
                </div>
            </li>
            <!-- User Dropdown-->
            <li class="nav-item dropdown no-caret dropdown-user me-3 me-lg-4">
                <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownUserImage" href="javascript:void(0);" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="img-fluid" src="<?= base_url()?>assets/img/illustrations/profiles/profile-1.png" /></a>
                <div class="dropdown-menu dropdown-menu-end border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownUserImage">
                    <h6 class="dropdown-header d-flex align-items-center">
                        <img class="dropdown-user-img" src="<?= base_url()?>assets/img/illustrations/profiles/profile-1.png" />
                        <div class="dropdown-user-details">
                            <div class="dropdown-user-details-name"><?= session()->get('name') ?></div>
                            <div class="dropdown-user-details-email"><?= session()->get('email') ?></div>
                        </div>
                    </h6>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#!">
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
                        <!-- Sidenav Menu Heading (Account)-->
                        <!-- * * Note: * * Visible only on and above the sm breakpoint-->
                        <div class="sidenav-menu-heading d-sm-none">Account</div>
                        <!-- Sidenav Link (Alerts)-->
                        <!-- * * Note: * * Visible only on and above the sm breakpoint-->
                        <a class="nav-link d-sm-none" href="#!">
                            <div class="nav-link-icon"><i data-feather="bell"></i></div>
                            Alerts
                            <span class="badge bg-warning-soft text-warning ms-auto">4 New!</span>
                        </a>
                        <!-- Sidenav Link (Messages)-->
                        <!-- * * Note: * * Visible only on and above the sm breakpoint-->
                        <a class="nav-link d-sm-none" href="#!">
                            <div class="nav-link-icon"><i data-feather="mail"></i></div>
                            Messages
                            <span class="badge bg-success-soft text-success ms-auto">2 New!</span>
                        </a>
                        <!-- Sidenav Menu Heading (Core)-->
                        <div class="sidenav-menu-heading">Core</div>
                        <!-- Sidenav Accordion (Dashboard)-->
                        <?php if(session()->get('allowed')->dash == "Yes"){?>
                        <a class="nav-link" href="<?= base_url('auditsystem')?>">
                            <div class="nav-link-icon"><i data-feather="activity"></i></div>
                            Dashboards
                        </a>
                        <?php }?>

                        <div class="sidenav-menu-heading">Managements</div>
 
                        <?php if(session()->get('allowed')->clm == "Yes"){?>
                            <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseClient" aria-expanded="false" aria-controls="collapseClient">
                                <div class="nav-link-icon"><i data-feather="activity"></i></div>
                                Client Management
                                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseClient" data-bs-parent="#accordionSidenav">
                                <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">
                                <?php if(session()->get('allowed')->cl == "Yes"){?>
                                    <a class="nav-link" href="<?= base_url()?>auditsystem/client">Clients</a>
                                <?php }?>
                                <?php if(session()->get('allowed')->sd == "Yes"){?>
                                    <a class="nav-link" href="<?= base_url()?>auditsystem/client/set">Set Defaults</a>
                                <?php }?>
                                </nav>
                            </div>
                        <?php }?>
                       
                        <?php if(session()->get('allowed')->audm == "Yes"){?>
                        <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseAuditor" aria-expanded="false" aria-controls="collapseAuditor">
                            <div class="nav-link-icon"><i data-feather="activity"></i></div>
                            Auditor Management
                            <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <?php }?>
                        <?php if(session()->get('allowed')->aud == "Yes"){?>
                        <div class="collapse" id="collapseAuditor" data-bs-parent="#accordionSidenav">
                            <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">
                                <a class="nav-link" href="<?= base_url()?>auditsystem/auditor">Auditor</a>
                            </nav>
                        </div>
                        <?php }?>

                        <div class="sidenav-menu-heading">Work Paper</div>
                        <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapsePrepare" aria-expanded="false" aria-controls="collapsePrepare">
                            <div class="nav-link-icon"><i data-feather="activity"></i></div>
                            Prepare
                            <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapsePrepare" data-bs-parent="#accordionSidenav">
                            <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">
                                <a class="nav-link" href="<?= base_url()?>auditsystem/workpaper/prepare">Prepare Work Paper</a>
                            </nav>
                        </div>


                        <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseReview" aria-expanded="false" aria-controls="collapseReview">
                            <div class="nav-link-icon"><i data-feather="activity"></i></div>
                            Review
                            <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseReview" data-bs-parent="#accordionSidenav">
                            <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">
                                <a class="nav-link" href="<?= base_url()?>auditsystem/workpaper/revievw">Check Work Paper</a>
                            </nav>
                        </div>

                        <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseAudManager" aria-expanded="false" aria-controls="collapseAudManager">
                            <div class="nav-link-icon"><i data-feather="activity"></i></div>
                            Audit Manager
                            <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseAudManager" data-bs-parent="#accordionSidenav">
                            <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">
                                <a class="nav-link" href="<?= base_url()?>auditsystem/workpaper/initiate">Initiate</a>
                                <a class="nav-link" href="<?= base_url()?>auditsystem/workpaper/revievw">View</a>
                                <a class="nav-link" href="<?= base_url()?>auditsystem/workpaper/Approved">Approved</a>
                            </nav>
                        </div>


                        <?php if(session()->get('allowed')->sett == "Yes"){?>
                            <div class="sidenav-menu-heading">System</div>

                            <?php if(session()->get('allowed')->frm == "Yes"){?>
                            <a class="nav-link" href="<?= base_url('auditsystem/firms')?>">
                                <div class="nav-link-icon"><i data-feather="filter"></i></div>
                                Firms
                            </a>
                            <?php }?>
                            <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="nav-link-icon"><i data-feather="grid"></i></div>
                                Settings
                                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" data-bs-parent="#accordionSidenav">
                                <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPagesMenu">
                                    <!-- Nested Sidenav Accordion (Pages -> Account)-->
                                    <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAccount" aria-expanded="false" aria-controls="pagesCollapseAccount">
                                        HAT Audit
                                        <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAccount" data-bs-parent="#accordionSidenavPagesMenu">
                                        <nav class="sidenav-menu-nested nav">
                                            <a class="nav-link" href="<?= base_url()?>auditsystem/c1/view">Chapter 1</a>
                                            <a class="nav-link" href="<?= base_url()?>auditsystem/c2/view">Chapter 2</a>
                                            <a class="nav-link" href="<?= base_url()?>auditsystem/c3/view">Chapter 3</a>
                                            <a class="nav-link" href="<?= base_url()?>auditsystem/c4/view">Prof Documents</a>
                                            <a class="nav-link" href="<?= base_url()?>auditsystem/c5/view">Prof Dividers</a>
                                        </nav>
                                    </div>
                                    <a class="nav-link" href="<?= base_url('auditsystem/position')?>">
                                        <div class="nav-link-icon"><i data-feather="filter"></i></div>
                                        Position
                                    </a>
                                </nav>
                            </div>
                        <?php }?>


                        <div class="sidenav-menu-heading">User Management</div>
                        <?php if(session()->get('allowed')->sett == "Yes"){?>
                            <a class="nav-link" href="<?= base_url('auditsystem/user')?>">
                                <div class="nav-link-icon"><i data-feather="activity"></i></div>
                                Users
                            </a>
                        <?php }?>
                        
                    </div>
                </div>
                <!-- Sidenav Footer-->
                <div class="sidenav-footer">
                    <div class="sidenav-footer-content">
                        <div class="sidenav-footer-subtitle">Logged in as:</div>
                        <div class="sidenav-footer-title"><?= session()->get('name') ?></div>
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">

    
                
                








 
