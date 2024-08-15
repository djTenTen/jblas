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
                                        <?php if(!empty($q1e)){?>
                                            <button type="button" class="btn btn-success btn-sm btn-icon viewfile" data-bs-toggle="modal" data-bs-target="#filemodal" title="view" data-pdffile="<?= base_url()?>uploads/pdf/wp/<?= $fID?>/<?= $crypt->decrypt(str_ireplace(['~','$'],['/','+'],$wpID))?>/<?= $q1e['file']?>" data-uploadedon="<?= date('F d, Y', strtotime($q1e['uploaded_on']))?>" data-filename="<?= $q1e['file']?>" data-file="<?= $q1e['type']?>" data-qtr="<?= $q1e['quarter']?>"><i class="fas fa-eye"></i></button>
                                        <?php }?>
                                    </div>
                                </div>
                            </form>
                            <form action="<?= base_url()?>auditsystem/wp/index/fstax/upload/<?= $code?>/<?= $cfiID?>/<?= $cID?>/<?= $wpID?>/<?= $index?>/<?= $desc?>/<?= $name?>" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="quarter" value="1st">
                                <input type="hidden" name="part" value="VAT">
                                <label class="small mb-1" for="tops" title="Value added tax">VAT</label>
                                <div class="row">
                                    <div class="col-9">
                                        <input class="form-control" id="fstax" type="file" accept=".pdf"  name="fstax" value="" required/>
                                    </div>
                                    <div class="col-3">
                                        <button type="submit" class="btn btn-primary btn-sm btn-icon" title="upload"><i class="fas fa-upload"></i></button>
                                        <?php if(!empty($q1v)){?>
                                            <button type="button" class="btn btn-success btn-sm btn-icon viewfile" data-bs-toggle="modal" data-bs-target="#filemodal" title="view" data-pdffile="<?= base_url()?>uploads/pdf/wp/<?= $fID?>/<?= $crypt->decrypt(str_ireplace(['~','$'],['/','+'],$wpID))?>/<?= $q1v['file']?>" data-uploadedon="<?= date('F d, Y', strtotime($q1v['uploaded_on']))?>" data-filename="<?= $q1v['file']?>" data-file="<?= $q1v['type']?>" data-qtr="<?= $q1v['quarter']?>"><i class="fas fa-eye"></i></button>
                                        <?php }?>
                                    </div>
                                </div>
                            </form>
                            <form action="<?= base_url()?>auditsystem/wp/index/fstax/upload/<?= $code?>/<?= $cfiID?>/<?= $cID?>/<?= $wpID?>/<?= $index?>/<?= $desc?>/<?= $name?>" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="quarter" value="1st">
                                <input type="hidden" name="part" value="1601C">
                                <label class="small mb-1" for="tops" title="1601 BIR Form">1601C</label>
                                <div class="row">
                                    <div class="col-9">
                                        <input class="form-control" id="fstax" type="file" accept=".pdf"  name="fstax" value="" required/>
                                    </div>
                                    <div class="col-3">
                                        <button type="submit" class="btn btn-primary btn-sm btn-icon" title="upload"><i class="fas fa-upload"></i></button>
                                        <?php if(!empty($q16)){?>
                                            <button type="button" class="btn btn-success btn-sm btn-icon viewfile" data-bs-toggle="modal" data-bs-target="#filemodal" title="view" data-pdffile="<?= base_url()?>uploads/pdf/wp/<?= $fID?>/<?= $crypt->decrypt(str_ireplace(['~','$'],['/','+'],$wpID))?>/<?= $q16['file']?>" data-uploadedon="<?= date('F d, Y', strtotime($q16['uploaded_on']))?>" data-filename="<?= $q16['file']?>" data-file="<?= $q16['type']?>" data-qtr="<?= $q16['quarter']?>"><i class="fas fa-eye"></i></button>
                                        <?php }?>
                                    </div>
                                </div>
                            </form>
                            <form action="<?= base_url()?>auditsystem/wp/index/fstax/upload/<?= $code?>/<?= $cfiID?>/<?= $cID?>/<?= $wpID?>/<?= $index?>/<?= $desc?>/<?= $name?>" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="quarter" value="1st">
                                <input type="hidden" name="part" value="1701/1702">
                                <label class="small mb-1" for="tops" title="1701/1702 BIR Form">1701/1702</label>
                                <div class="row">
                                    <div class="col-9">
                                        <input class="form-control" id="fstax" type="file" accept=".pdf"  name="fstax" value="" required/>
                                    </div>
                                    <div class="col-3">
                                        <button type="submit" class="btn btn-primary btn-sm btn-icon" title="upload"><i class="fas fa-upload"></i></button>
                                        <?php if(!empty($q17)){?>
                                            <button type="button" class="btn btn-success btn-sm btn-icon viewfile" data-bs-toggle="modal" data-bs-target="#filemodal" title="view" data-pdffile="<?= base_url()?>uploads/pdf/wp/<?= $fID?>/<?= $crypt->decrypt(str_ireplace(['~','$'],['/','+'],$wpID))?>/<?= $q17['file']?>" data-uploadedon="<?= date('F d, Y', strtotime($q17['uploaded_on']))?>" data-filename="<?= $q17['file']?>" data-file="<?= $q17['type']?>" data-qtr="<?= $q17['quarter']?>"><i class="fas fa-eye"></i></button>
                                        <?php }?>
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
                                        <?php if(!empty($q2e)){?>
                                            <button type="button" class="btn btn-success btn-sm btn-icon viewfile" data-bs-toggle="modal" data-bs-target="#filemodal" title="view" data-pdffile="<?= base_url()?>uploads/pdf/wp/<?= $fID?>/<?= $crypt->decrypt(str_ireplace(['~','$'],['/','+'],$wpID))?>/<?= $q2e['file']?>" data-uploadedon="<?= date('F d, Y', strtotime($q2e['uploaded_on']))?>" data-filename="<?= $q2e['file']?>" data-file="<?= $q2e['type']?>" data-qtr="<?= $q2e['quarter']?>"><i class="fas fa-eye"></i></button>
                                        <?php }?>
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
                                        <?php if(!empty($q2v)){?>
                                            <button type="button" class="btn btn-success btn-sm btn-icon viewfile" data-bs-toggle="modal" data-bs-target="#filemodal" title="view" data-pdffile="<?= base_url()?>uploads/pdf/wp/<?= $fID?>/<?= $crypt->decrypt(str_ireplace(['~','$'],['/','+'],$wpID))?>/<?= $q2v['file']?>" data-uploadedon="<?= date('F d, Y', strtotime($q2v['uploaded_on']))?>" data-filename="<?= $q2v['file']?>" data-file="<?= $q2v['type']?>" data-qtr="<?= $q2v['quarter']?>"><i class="fas fa-eye"></i></button>
                                        <?php }?>
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
                                        <?php if(!empty($q26)){?>
                                            <button type="button" class="btn btn-success btn-sm btn-icon viewfile" data-bs-toggle="modal" data-bs-target="#filemodal" title="view" data-pdffile="<?= base_url()?>uploads/pdf/wp/<?= $fID?>/<?= $crypt->decrypt(str_ireplace(['~','$'],['/','+'],$wpID))?>/<?= $q26['file']?>" data-uploadedon="<?= date('F d, Y', strtotime($q26['uploaded_on']))?>" data-filename="<?= $q26['file']?>" data-file="<?= $q26['type']?>" data-qtr="<?= $q26['quarter']?>"><i class="fas fa-eye"></i></button>
                                        <?php }?>
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
                                        <?php if(!empty($q27)){?>
                                            <button type="button" class="btn btn-success btn-sm btn-icon viewfile" data-bs-toggle="modal" data-bs-target="#filemodal" title="view" data-pdffile="<?= base_url()?>uploads/pdf/wp/<?= $fID?>/<?= $crypt->decrypt(str_ireplace(['~','$'],['/','+'],$wpID))?>/<?= $q27['file']?>" data-uploadedon="<?= date('F d, Y', strtotime($q27['uploaded_on']))?>" data-filename="<?= $q27['file']?>" data-file="<?= $q27['type']?>" data-qtr="<?= $q27['quarter']?>"><i class="fas fa-eye"></i></button>
                                        <?php }?>
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
                                        <?php if(!empty($q3e)){?>
                                            <button type="button" class="btn btn-success btn-sm btn-icon viewfile" data-bs-toggle="modal" data-bs-target="#filemodal" title="view" data-pdffile="<?= base_url()?>uploads/pdf/wp/<?= $fID?>/<?= $crypt->decrypt(str_ireplace(['~','$'],['/','+'],$wpID))?>/<?= $q3e['file']?>" data-uploadedon="<?= date('F d, Y', strtotime($q3e['uploaded_on']))?>" data-filename="<?= $q3e['file']?>" data-file="<?= $q3e['type']?>" data-qtr="<?= $q3e['quarter']?>"><i class="fas fa-eye"></i></button>
                                        <?php }?>
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
                                        <?php if(!empty($q3v)){?>
                                            <button type="button" class="btn btn-success btn-sm btn-icon viewfile" data-bs-toggle="modal" data-bs-target="#filemodal" title="view" data-pdffile="<?= base_url()?>uploads/pdf/wp/<?= $fID?>/<?= $crypt->decrypt(str_ireplace(['~','$'],['/','+'],$wpID))?>/<?= $q3v['file']?>" data-uploadedon="<?= date('F d, Y', strtotime($q3v['uploaded_on']))?>" data-filename="<?= $q3v['file']?>" data-file="<?= $q3v['type']?>" data-qtr="<?= $q3v['quarter']?>"><i class="fas fa-eye"></i></button>
                                        <?php }?>
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
                                        <?php if(!empty($q36)){?>
                                            <button type="button" class="btn btn-success btn-sm btn-icon viewfile" data-bs-toggle="modal" data-bs-target="#filemodal" title="view" data-pdffile="<?= base_url()?>uploads/pdf/wp/<?= $fID?>/<?= $crypt->decrypt(str_ireplace(['~','$'],['/','+'],$wpID))?>/<?= $q36['file']?>" data-uploadedon="<?= date('F d, Y', strtotime($q36['uploaded_on']))?>" data-filename="<?= $q36['file']?>" data-file="<?= $q36['type']?>" data-qtr="<?= $q36['quarter']?>"><i class="fas fa-eye"></i></button>
                                        <?php }?>
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
                                        <?php if(!empty($q37)){?>
                                            <button type="button" class="btn btn-success btn-sm btn-icon viewfile" data-bs-toggle="modal" data-bs-target="#filemodal" title="view" data-pdffile="<?= base_url()?>uploads/pdf/wp/<?= $fID?>/<?= $crypt->decrypt(str_ireplace(['~','$'],['/','+'],$wpID))?>/<?= $q37['file']?>" data-uploadedon="<?= date('F d, Y', strtotime($q37['uploaded_on']))?>" data-filename="<?= $q37['file']?>" data-file="<?= $q37['type']?>" data-qtr="<?= $q37['quarter']?>"><i class="fas fa-eye"></i></button>
                                        <?php }?>
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
                                        <?php if(!empty($q4e)){?>
                                            <button type="button" class="btn btn-success btn-sm btn-icon viewfile" data-bs-toggle="modal" data-bs-target="#filemodal" title="view" data-pdffile="<?= base_url()?>uploads/pdf/wp/<?= $fID?>/<?= $crypt->decrypt(str_ireplace(['~','$'],['/','+'],$wpID))?>/<?= $q4e['file']?>" data-uploadedon="<?= date('F d, Y', strtotime($q4e['uploaded_on']))?>" data-filename="<?= $q4e['file']?>" data-file="<?= $q4e['type']?>" data-qtr="<?= $q4e['quarter']?>"><i class="fas fa-eye"></i></button>
                                        <?php }?>
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
                                        <?php if(!empty($q4v)){?>
                                            <button type="button" class="btn btn-success btn-sm btn-icon viewfile" data-bs-toggle="modal" data-bs-target="#filemodal" title="view" data-pdffile="<?= base_url()?>uploads/pdf/wp/<?= $fID?>/<?= $crypt->decrypt(str_ireplace(['~','$'],['/','+'],$wpID))?>/<?= $q4v['file']?>" data-uploadedon="<?= date('F d, Y', strtotime($q4v['uploaded_on']))?>" data-filename="<?= $q4v['file']?>" data-file="<?= $q4v['type']?>" data-qtr="<?= $q4v['quarter']?>"><i class="fas fa-eye"></i></button>
                                        <?php }?>
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
                                        <?php if(!empty($q46)){?>
                                            <button type="button" class="btn btn-success btn-sm btn-icon viewfile" data-bs-toggle="modal" data-bs-target="#filemodal" title="view" data-pdffile="<?= base_url()?>uploads/pdf/wp/<?= $fID?>/<?= $crypt->decrypt(str_ireplace(['~','$'],['/','+'],$wpID))?>/<?= $q46['file']?>" data-uploadedon="<?= date('F d, Y', strtotime($q46['uploaded_on']))?>" data-filename="<?= $q46['file']?>" data-file="<?= $q46['type']?>" data-qtr="<?= $q46['quarter']?>"><i class="fas fa-eye"></i></button>
                                        <?php }?>
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
                                        <?php if(!empty($q47)){?>
                                            <button type="button" class="btn btn-success btn-sm btn-icon viewfile" data-bs-toggle="modal" data-bs-target="#filemodal" title="view" data-pdffile="<?= base_url()?>uploads/pdf/wp/<?= $fID?>/<?= $crypt->decrypt(str_ireplace(['~','$'],['/','+'],$wpID))?>/<?= $q47['file']?>" data-uploadedon="<?= date('F d, Y', strtotime($q47['uploaded_on']))?>" data-filename="<?= $q47['file']?>" data-file="<?= $q47['type']?>" data-qtr="<?= $q47['quarter']?>"><i class="fas fa-eye"></i></button>
                                        <?php }?>
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

    <!-- Modal Send to Reviewer-->
    <div class="modal fade" id="filemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle"><span id="mtitle"></span></h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h1 id="f"></h1>
                    <p>Quarter: <b><span id="qtr"></span></b></p>
                    <p>Uploaded On: <b><span id="uo"></span></b></p>
                    <p>File Name: <b><span id="fn"></span></b></p>
                    <object id="objectdata" data="" type="application/pdf" frameborder="0" width="100%" height="1000"> </object>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>


<script>
    $(document).ready(function () {
        $('.viewfile').on('click', function(){
            var file = $(this).data('pdffile');
            var uo = $(this).data('uploadedon');
            var fn = $(this).data('filename');
            var qtr = $(this).data('qtr');
            var f = $(this).data('file');
            $('#fn').html(fn);
            $('#uo').html(uo);
            $('#qtr').html(qtr);
            $('#f').html(f);
            $('#mtitle').html(f);
            $('#objectdata').attr('data',file);
        });
    });
</script>
    



    
    
  