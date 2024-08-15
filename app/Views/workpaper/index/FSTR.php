<?php  
    $crypt = \Config\Services::encrypter();
?>
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
                        <div class="page-header-subtitle"><?= $subt?></div>
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
        <div class="card">
            <?php if (session()->get('updated')) { ?>
                <div class="alert alert-success alert-icon" role="alert">
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-icon-content">
                        <h6 class="alert-heading">Files Updated</h6>
                        The file has successfully Updated.
                    </div>
                </div>
            <?php  }?>
            <?php if (session()->get('uploaded')) { ?>
                <div class="alert alert-success alert-icon" role="alert">
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-icon-content">
                        <h6 class="alert-heading">Files Uploaded</h6>
                        The file has successfully Uploaded.
                    </div>
                </div>
            <?php  }?>
            <?php if (session()->get('file_exist')) { ?>
                <div class="alert alert-danger alert-icon" role="alert">
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-icon-content">
                        <h6 class="alert-heading">Error Upload</h6>
                        The file has already exist on the system, try difference file name.
                    </div>
                </div>
            <?php  }?>
            <?php if (session()->get('invalid_input')) { ?>
                <div class="alert alert-danger alert-icon" role="alert">
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-icon-content">
                        <h6 class="alert-heading">Invalid Input</h6>
                        Something wrong with your data inputed, please try again.
                    </div>
                </div>
            <?php  }?>
            <div class="card-header border-bottom">
                <!-- Wizard navigation-->
                <div class="nav nav-pills nav-justified flex-column flex-xl-row" id="cardTab" role="tablist">
                    <!-- Wizard navigation item 1-->
                    <a class="nav-item nav-link active" id="wizard1-tab" href="#wizard1" data-bs-toggle="tab" role="tab" aria-controls="wizard1" aria-selected="true">
                        <div class="wizard-step-text">
                            <div class="wizard-step-text-name">1st Quarter</div>
                        </div>
                    </a>
                    <!-- Wizard navigation item 2-->
                    <a class="nav-item nav-link" id="wizard2-tab" href="#wizard2" data-bs-toggle="tab" role="tab" aria-controls="wizard2" aria-selected="true">
                        <div class="wizard-step-text">
                            <div class="wizard-step-text-name">2nd Quarter</div>
                        </div>
                    </a>
                    <!-- Wizard navigation item 3-->
                    <a class="nav-item nav-link" id="wizard3-tab" href="#wizard3" data-bs-toggle="tab" role="tab" aria-controls="wizard3" aria-selected="true">
                        <div class="wizard-step-text">
                            <div class="wizard-step-text-name">3rd Quarter</div>
                        </div>
                    </a>
                    <a class="nav-item nav-link" id="wizard4-tab" href="#wizard4" data-bs-toggle="tab" role="tab" aria-controls="wizard4" aria-selected="true">
                        <div class="wizard-step-text">
                            <div class="wizard-step-text-name">4th Quarter</div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content" id="cardTabContent">
                    <!-- Wizard tab pane item 1-->
                    <div class="tab-pane py-5 fade show active" id="wizard1" role="tabpanel" aria-labelledby="wizard1-tab">
                        <h4>1st Quarter</h4>

                        <div class="col-md-6">
                            <form action="<?= base_url()?>auditsystem/wp/index/fstax/upload/<?= $code?>/<?= $cfiID?>/<?= $cID?>/<?= $wpID?>/<?= $index?>/<?= $desc?>/<?= $name?>" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="quarter" value="1st">
                                <input type="hidden" name="part" value="EWT">
                                <label class="small mb-1" for="tops" title="Expanded Withholding Tax">EWT</label>
                                <div class="row">
                                    <div class="col-9">
                                        <input class="form-control" id="fstax" type="file" accept=".pdf"  name="fstax" value="" required/>
                                    </div>
                                    <div class="col-3">
                                        <button type="submit" class="btn btn-primary btn-sm btn-icon" title="upload"><i class="fas fa-upload"></i></button>
                                        <button type="button" class="btn btn-success btn-sm btn-icon" title="view"><i class="fas fa-eye"></i></button>
                                    </div>
                                </div>
                            </form>
                            <form action="<?= base_url()?>auditsystem/wp/index/fstax/upload/<?= $code?>/<?= $cfiID?>/<?= $cID?>/<?= $wpID?>/<?= $index?>/<?= $desc?>/<?= $name?>" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="quarter" value="1st">
                                <input type="hidden" name="part" value="VAT">
                                <label class="small mb-1" for="tops" title="Expanded Withholding Tax">VAT</label>
                                <div class="row">
                                    <div class="col-9">
                                        <input class="form-control" id="fstax" type="file" accept=".pdf"  name="fstax" value="" required/>
                                    </div>
                                    <div class="col-3">
                                        <button type="submit" class="btn btn-primary btn-sm btn-icon" title="upload"><i class="fas fa-upload"></i></button>
                                        <button type="button" class="btn btn-success btn-sm btn-icon" title="view"><i class="fas fa-eye"></i></button>
                                    </div>
                                </div>
                            </form>
                            <form action="<?= base_url()?>auditsystem/wp/index/fstax/upload/<?= $code?>/<?= $cfiID?>/<?= $cID?>/<?= $wpID?>/<?= $index?>/<?= $desc?>/<?= $name?>" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="quarter" value="1st">
                                <input type="hidden" name="part" value="1601C">
                                <label class="small mb-1" for="tops" title="Expanded Withholding Tax">1601C</label>
                                <div class="row">
                                    <div class="col-9">
                                        <input class="form-control" id="fstax" type="file" accept=".pdf"  name="fstax" value="" required/>
                                    </div>
                                    <div class="col-3">
                                        <button type="submit" class="btn btn-primary btn-sm btn-icon" title="upload"><i class="fas fa-upload"></i></button>
                                        <button type="button" class="btn btn-success btn-sm btn-icon" title="view"><i class="fas fa-eye"></i></button>
                                    </div>
                                </div>
                            </form>
                            <form action="<?= base_url()?>auditsystem/wp/index/fstax/upload/<?= $code?>/<?= $cfiID?>/<?= $cID?>/<?= $wpID?>/<?= $index?>/<?= $desc?>/<?= $name?>" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="quarter" value="1st">
                                <input type="hidden" name="part" value="1701/1702">
                                <label class="small mb-1" for="tops" title="Expanded Withholding Tax">1701/1702</label>
                                <div class="row">
                                    <div class="col-9">
                                        <input class="form-control" id="fstax" type="file" accept=".pdf"  name="fstax" value="" required/>
                                    </div>
                                    <div class="col-3">
                                        <button type="submit" class="btn btn-primary btn-sm btn-icon" title="upload"><i class="fas fa-upload"></i></button>
                                        <button type="button" class="btn btn-success btn-sm btn-icon" title="view"><i class="fas fa-eye"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                    <!-- Wizard tab pane item 2-->
                    <div class="tab-pane py-5 fade" id="wizard2" role="tabpanel" aria-labelledby="wizard2-tab">
                        <h4>2nd Quarter</h4>
                        <div class="col-md-6">
                            <form action="<?= base_url()?>auditsystem/wp/index/fstax/upload/<?= $code?>/<?= $cfiID?>/<?= $cID?>/<?= $wpID?>/<?= $index?>/<?= $desc?>/<?= $name?>" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="quarter" value="2nd">
                                <input type="hidden" name="part" value="EWT">
                                <label class="small mb-1" for="tops" title="Expanded Withholding Tax">EWT</label>
                                <div class="row">
                                    <div class="col-9">
                                        <input class="form-control" id="fstax" type="file" accept=".pdf"  name="fstax" value="" required/>
                                    </div>
                                    <div class="col-3">
                                        <button type="submit" class="btn btn-primary btn-sm btn-icon" title="upload"><i class="fas fa-upload"></i></button>
                                        <button type="button" class="btn btn-success btn-sm btn-icon" title="view"><i class="fas fa-eye"></i></button>
                                    </div>
                                </div>
                            </form>
                            <form action="<?= base_url()?>auditsystem/wp/index/fstax/upload/<?= $code?>/<?= $cfiID?>/<?= $cID?>/<?= $wpID?>/<?= $index?>/<?= $desc?>/<?= $name?>" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="quarter" value="2nd">
                                <input type="hidden" name="part" value="VAT">
                                <label class="small mb-1" for="tops" title="Expanded Withholding Tax">VAT</label>
                                <div class="row">
                                    <div class="col-9">
                                        <input class="form-control" id="fstax" type="file" accept=".pdf"  name="fstax" value="" required/>
                                    </div>
                                    <div class="col-3">
                                        <button type="submit" class="btn btn-primary btn-sm btn-icon" title="upload"><i class="fas fa-upload"></i></button>
                                        <button type="button" class="btn btn-success btn-sm btn-icon" title="view"><i class="fas fa-eye"></i></button>
                                    </div>
                                </div>
                            </form>
                            <form action="<?= base_url()?>auditsystem/wp/index/fstax/upload/<?= $code?>/<?= $cfiID?>/<?= $cID?>/<?= $wpID?>/<?= $index?>/<?= $desc?>/<?= $name?>" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="quarter" value="2nd">
                                <input type="hidden" name="part" value="1601C">
                                <label class="small mb-1" for="tops" title="Expanded Withholding Tax">1601C</label>
                                <div class="row">
                                    <div class="col-9">
                                        <input class="form-control" id="fstax" type="file" accept=".pdf"  name="fstax" value="" required/>
                                    </div>
                                    <div class="col-3">
                                        <button type="submit" class="btn btn-primary btn-sm btn-icon" title="upload"><i class="fas fa-upload"></i></button>
                                        <button type="button" class="btn btn-success btn-sm btn-icon" title="view"><i class="fas fa-eye"></i></button>
                                    </div>
                                </div>
                            </form>
                            <form action="<?= base_url()?>auditsystem/wp/index/fstax/upload/<?= $code?>/<?= $cfiID?>/<?= $cID?>/<?= $wpID?>/<?= $index?>/<?= $desc?>/<?= $name?>" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="quarter" value="2nd">
                                <input type="hidden" name="part" value="1701/1702">
                                <label class="small mb-1" for="tops" title="Expanded Withholding Tax">1701/1702</label>
                                <div class="row">
                                    <div class="col-9">
                                        <input class="form-control" id="fstax" type="file" accept=".pdf"  name="fstax" value="" required/>
                                    </div>
                                    <div class="col-3">
                                        <button type="submit" class="btn btn-primary btn-sm btn-icon" title="upload"><i class="fas fa-upload"></i></button>
                                        <button type="button" class="btn btn-success btn-sm btn-icon" title="view"><i class="fas fa-eye"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        
                    </div>
                    <!-- Wizard tab pane item 3-->
                    <div class="tab-pane py-5 fade" id="wizard3" role="tabpanel" aria-labelledby="wizard3-tab">
                        <h4>3rd Quarter</h4>

                        <div class="col-md-6">
                            <form action="<?= base_url()?>auditsystem/wp/index/fstax/upload/<?= $code?>/<?= $cfiID?>/<?= $cID?>/<?= $wpID?>/<?= $index?>/<?= $desc?>/<?= $name?>" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="quarter" value="3rd">
                                <input type="hidden" name="part" value="EWT">
                                <label class="small mb-1" for="tops" title="Expanded Withholding Tax">EWT</label>
                                <div class="row">
                                    <div class="col-9">
                                        <input class="form-control" id="fstax" type="file" accept=".pdf"  name="fstax" value="" required/>
                                    </div>
                                    <div class="col-3">
                                        <button type="submit" class="btn btn-primary btn-sm btn-icon" title="upload"><i class="fas fa-upload"></i></button>
                                        <button type="button" class="btn btn-success btn-sm btn-icon" title="view"><i class="fas fa-eye"></i></button>
                                    </div>
                                </div>
                            </form>
                            <form action="<?= base_url()?>auditsystem/wp/index/fstax/upload/<?= $code?>/<?= $cfiID?>/<?= $cID?>/<?= $wpID?>/<?= $index?>/<?= $desc?>/<?= $name?>" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="quarter" value="3rd">
                                <input type="hidden" name="part" value="VAT">
                                <label class="small mb-1" for="tops" title="Expanded Withholding Tax">VAT</label>
                                <div class="row">
                                    <div class="col-9">
                                        <input class="form-control" id="fstax" type="file" accept=".pdf"  name="fstax" value="" required/>
                                    </div>
                                    <div class="col-3">
                                        <button type="submit" class="btn btn-primary btn-sm btn-icon" title="upload"><i class="fas fa-upload"></i></button>
                                        <button type="button" class="btn btn-success btn-sm btn-icon" title="view"><i class="fas fa-eye"></i></button>
                                    </div>
                                </div>
                            </form>
                            <form action="<?= base_url()?>auditsystem/wp/index/fstax/upload/<?= $code?>/<?= $cfiID?>/<?= $cID?>/<?= $wpID?>/<?= $index?>/<?= $desc?>/<?= $name?>" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="quarter" value="3rd">
                                <input type="hidden" name="part" value="1601C">
                                <label class="small mb-1" for="tops" title="Expanded Withholding Tax">1601C</label>
                                <div class="row">
                                    <div class="col-9">
                                        <input class="form-control" id="fstax" type="file" accept=".pdf"  name="fstax" value="" required/>
                                    </div>
                                    <div class="col-3">
                                        <button type="submit" class="btn btn-primary btn-sm btn-icon" title="upload"><i class="fas fa-upload"></i></button>
                                        <button type="button" class="btn btn-success btn-sm btn-icon" title="view"><i class="fas fa-eye"></i></button>
                                    </div>
                                </div>
                            </form>
                            <form action="<?= base_url()?>auditsystem/wp/index/fstax/upload/<?= $code?>/<?= $cfiID?>/<?= $cID?>/<?= $wpID?>/<?= $index?>/<?= $desc?>/<?= $name?>" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="quarter" value="3rd">
                                <input type="hidden" name="part" value="1701/1702">
                                <label class="small mb-1" for="tops" title="Expanded Withholding Tax">1701/1702</label>
                                <div class="row">
                                    <div class="col-9">
                                        <input class="form-control" id="fstax" type="file" accept=".pdf"  name="fstax" value="" required/>
                                    </div>
                                    <div class="col-3">
                                        <button type="submit" class="btn btn-primary btn-sm btn-icon" title="upload"><i class="fas fa-upload"></i></button>
                                        <button type="button" class="btn btn-success btn-sm btn-icon" title="view"><i class="fas fa-eye"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        
                    </div>
                    <div class="tab-pane py-5 fade" id="wizard4" role="tabpanel" aria-labelledby="wizard4-tab">
                        <h4>4th Quarter</h4>

                        <div class="col-md-6">
                            <form action="<?= base_url()?>auditsystem/wp/index/fstax/upload/<?= $code?>/<?= $cfiID?>/<?= $cID?>/<?= $wpID?>/<?= $index?>/<?= $desc?>/<?= $name?>" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="quarter" value="4th">
                                <input type="hidden" name="part" value="EWT">
                                <label class="small mb-1" for="tops" title="Expanded Withholding Tax">EWT</label>
                                <div class="row">
                                    <div class="col-9">
                                        <input class="form-control" id="fstax" type="file" accept=".pdf"  name="fstax" value="" required/>
                                    </div>
                                    <div class="col-3">
                                        <button type="submit" class="btn btn-primary btn-sm btn-icon" title="upload"><i class="fas fa-upload"></i></button>
                                        <button type="button" class="btn btn-success btn-sm btn-icon" title="view"><i class="fas fa-eye"></i></button>
                                    </div>
                                </div>
                            </form>
                            <form action="<?= base_url()?>auditsystem/wp/index/fstax/upload/<?= $code?>/<?= $cfiID?>/<?= $cID?>/<?= $wpID?>/<?= $index?>/<?= $desc?>/<?= $name?>" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="quarter" value="4th">
                                <input type="hidden" name="part" value="VAT">
                                <label class="small mb-1" for="tops" title="Expanded Withholding Tax">VAT</label>
                                <div class="row">
                                    <div class="col-9">
                                        <input class="form-control" id="fstax" type="file" accept=".pdf"  name="fstax" value="" required/>
                                    </div>
                                    <div class="col-3">
                                        <button type="submit" class="btn btn-primary btn-sm btn-icon" title="upload"><i class="fas fa-upload"></i></button>
                                        <button type="button" class="btn btn-success btn-sm btn-icon" title="view"><i class="fas fa-eye"></i></button>
                                    </div>
                                </div>
                            </form>
                            <form action="<?= base_url()?>auditsystem/wp/index/fstax/upload/<?= $code?>/<?= $cfiID?>/<?= $cID?>/<?= $wpID?>/<?= $index?>/<?= $desc?>/<?= $name?>" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="quarter" value="4th">
                                <input type="hidden" name="part" value="1601C">
                                <label class="small mb-1" for="tops" title="Expanded Withholding Tax">1601C</label>
                                <div class="row">
                                    <div class="col-9">
                                        <input class="form-control" id="fstax" type="file" accept=".pdf"  name="fstax" value="" required/>
                                    </div>
                                    <div class="col-3">
                                        <button type="submit" class="btn btn-primary btn-sm btn-icon" title="upload"><i class="fas fa-upload"></i></button>
                                        <button type="button" class="btn btn-success btn-sm btn-icon" title="view"><i class="fas fa-eye"></i></button>
                                    </div>
                                </div>
                            </form>
                            <form action="<?= base_url()?>auditsystem/wp/index/fstax/upload/<?= $code?>/<?= $cfiID?>/<?= $cID?>/<?= $wpID?>/<?= $index?>/<?= $desc?>/<?= $name?>" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="quarter" value="4th">
                                <input type="hidden" name="part" value="1701/1702">
                                <label class="small mb-1" for="tops" title="Expanded Withholding Tax">1701/1702</label>
                                <div class="row">
                                    <div class="col-9">
                                        <input class="form-control" id="fstax" type="file" accept=".pdf"  name="fstax" value="" required/>
                                    </div>
                                    <div class="col-3">
                                        <button type="submit" class="btn btn-primary btn-sm btn-icon" title="upload"><i class="fas fa-upload"></i></button>
                                        <button type="button" class="btn btn-success btn-sm btn-icon" title="view"><i class="fas fa-eye"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

    



    
    
  