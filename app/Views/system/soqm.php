
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
                        <div class="page-header-subtitle">SOQM Manual</div>
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
            <?php if (session()->get('success')) { ?>
                <div class="alert alert-success alert-icon" role="alert">
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-icon-content">
                        <h6 class="alert-heading">Success!</h6>
                        <?= session()->get('success')?>
                    </div>
                </div>
            <?php  }?>
            <?php if (session()->get('failed')) { ?>
                <div class="alert alert-danger alert-icon" role="alert">
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-icon-content">
                        <h6 class="alert-heading">Error!</h6>
                        <?= session()->get('failed')?>
                    </div>
                </div>
            <?php  }?>
            <div class="card-body">
                <hr style="color: #7752FE;" class="m-3">
                <div class="m-5">
                    <?php if($soqm['soqm'] != 'Using' and $soqm['soqm'] != 'Uploaded'){?>
                        <p>Here, you have the option to either use the default SOQM Manual provided by the system or upload your own customized version to suit your specific requirements.</p>
                        <div class="container row">
                            <div class="col-6">
                                <h3>Use ApplAud's SOQM</h3>
                                <form action="<?= base_url()?>auditsystem/soqm/use" method="post">.
                                    <?php if($soqm['soqm'] != 'Using'){?>
                                        <button type="submit" class="btn btn-primary m-1 btn-sm"><i class="fas fa-file-alt m-1"></i>Use SOQM</button>
                                    <?php }?>
                                    <a type="button" href="<?= base_url()?>auditsystem/soqmpdf" target="_blank" class="btn btn-success m-1 btn-sm"><i class="fas fa-eye m-1"></i>View SOQM Template</a>
                                </form>
                            </div>
                            <div class="col-6">
                                <h3>Upload your own SOQM</h3>
                                <form action="/auditsystem/soqm/upload" enctype="multipart/form-data" method="post">
                                    <div class="col-6">
                                        <input type="file" name="soqmfile" accept=".pdf" class="form form-control btn btn-secondary">
                                    </div>
                                    <button type="submit" class="btn btn-primary m-1 btn-sm"><i class="fas fa-file-pdf m-1"></i>Upload</button>
                                </form>
                            </div>
                        </div>
                    <?php }?>
                    <?php if($soqm['soqm'] == 'Using'){?>
                        <form action="/auditsystem/soqm/save" method="post">
                            <h6><b>Note:</b> If you choose not to use a specific field or section of the SOQM, please enter "N/A" in the corresponding fields. Otherwise, they will appear empty or with default values in your SOQM manual.</h6>
                            <h6><b>Note:</b> Please use <span class="text-danger"><<code>br</code>></span> at the end of your paragraphs if you want the next paragraphs to display next line. Please see the Template Below.</h6>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="mb-1" for="prac">Name of Practitioner</label>
                                    <input type="text" class="form-control border-dark" name="prac" value="<?= $sd['prac']?>" required>
                                </div>
                                <div class="mb-3">
                                    <label class="mb-1" for="bg">Background</label>
                                    <textarea class="form-control border-dark" cols="30" rows="5" name="bg" required><?= $sd['bg']?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="mb-1" for="cs">The firm’s core services are centered on</label>
                                    <textarea class="form-control border-dark" cols="30" rows="5" name="cs" required><?= $sd['cs']?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="mb-1" for="cq">Commitment to Quality</label>
                                    <textarea class="form-control border-dark" cols="30" rows="5" name="cq" required><?= $sd['cq']?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="mb-1" for="cp">Core Principles</label>
                                    <textarea class="form-control border-dark" cols="30" rows="5" name="cp" required><?= $sd['cp']?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="mb-1" for="phil">Philosophy</label>
                                    <textarea class="form-control border-dark" cols="30" rows="5" name="phil" required><?= $sd['phil']?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="mb-1" for="miss">Mission</label>
                                    <textarea class="form-control border-dark" cols="30" rows="5" name="miss" required><?= $sd['miss']?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="mb-1" for="viss">Vision</label>
                                    <textarea class="form-control border-dark" cols="30" rows="5" name="viss" required><?= $sd['viss']?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="mb-1" for="fg">Firm's Goal</label>
                                    <textarea class="form-control border-dark" cols="30" rows="5" name="fg" required><?= $sd['fg']?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="mb-1" for="rwt">Relationship with the Team</label>
                                    <textarea class="form-control border-dark" cols="30" rows="5" name="rwt" required><?= $sd['rwt']?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="mb-1" for="appr">Our approach includes:</label>
                                    <textarea class="form-control border-dark" cols="30" rows="5" name="appr" required><?= $sd['appr']?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="mb-1" for="fs">Firm Size</label>
                                    <textarea class="form-control border-dark" cols="30" rows="5" name="fs" required><?= $sd['fs']?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="mb-1" for="cr">Client Relationship</label>
                                    <textarea class="form-control border-dark" cols="30" rows="5" name="cr" required><?= $sd['cr']?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="mb-1" for="csa">Client Service Approach</label>
                                    <textarea class="form-control border-dark" cols="30" rows="5" name="csa" required><?= $sd['csa']?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="mb-1" for="gd">Geographic Details</label>
                                    <textarea class="form-control border-dark" cols="30" rows="5" name="gd" required><?= $sd['gd']?></textarea>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success m-1 btn-sm float-end"><i class="fas fa-file-alt m-1"></i>Save Info</button>
                            <a type="button" href="<?= base_url()?>auditsystem/mysoqmpdf" target="_blank" class="btn btn-primary m-1 btn-sm float-end"><i class="fas fa-eye m-1"></i>View my SOQM</a>
                        </form>

                    <?php }?>
                    <?php if($soqm['soqm'] == 'Uploaded'){?>
                        <form action="/auditsystem/soqm/upload" enctype="multipart/form-data" method="post">
                            <div class="col-6">
                                <input type="file" name="soqmfile" accept=".pdf" class="form form-control btn btn-secondary" required>
                            </div>
                            <button type="submit" class="btn btn-primary m-1 btn-sm"><i class="fas fa-file-pdf m-1"></i>Upload</button>
                        </form>
                        <object data="<?= base_url()?>uploads/pdf/<?= decr(session()->get('firmID'))?>/soqm/<?= $soqm['soqm_data']?>" type="application/pdf" frameborder="0" width="100%" height="1000"> </object>
                    <?php }?>
                </div>
                <br><br><br><hr style="color: #7752FE;" class="m-3">
            </div>
        </div>
    </div>
</main>