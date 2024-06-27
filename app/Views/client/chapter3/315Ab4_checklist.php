<?php  $crypt = \Config\Services::encrypter();?>
<main>
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
        <div class="container-xl px-4">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="activity"></i></div>
                            <?= $name?>
                        </h1>
                        <div class="page-header-subtitle"><?= $title?></div>
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

            <?php if (session()->get('success_update')) { ?>
                <div class="alert alert-success alert-icon" role="alert">
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-icon-content">
                        <h6 class="alert-heading">Success Update</h6>
                        Contents has been successfully updated.
                    </div>
                </div>
            <?php  }?>
            <?php if (session()->get('failed_update')) { ?>
                <div class="alert alert-danger alert-icon" role="alert">
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-icon-content">
                        <h6 class="alert-heading">Failed update</h6>
                        Error registering contents.
                    </div>
                </div>
            <?php  }?>

            <div class="card-body">

                <nav class="nav nav-borders">
                    <a class="nav-link ms-0 <?php if(str_contains(uri_string(), 'checklist')){echo 'active ';} ?>" href="<?= base_url()?>auditsystem/chapter3/setvalues/3.15 Ab4-checklist/<?= $c3tID?>/<?= $cID?>/<?= $name?>">Checklist</a>
                    <a class="nav-link ms-0 <?php if(str_contains(uri_string(), 'section1')){echo 'active ';} ?>" href="<?= base_url()?>auditsystem/chapter3/setvalues/3.15 Ab4-section1/<?= $c3tID?>/<?= $cID?>/<?= $name?>">Section 1</a>
                    <a class="nav-link ms-0 <?php if(str_contains(uri_string(), 'section2')){echo 'active ';} ?>" href="<?= base_url()?>auditsystem/chapter3/setvalues/3.15 Ab4-section2/<?= $c3tID?>/<?= $cID?>/<?= $name?>">Section 2</a>
                    <a class="nav-link ms-0 <?php if(str_contains(uri_string(), 'section3')){echo 'active ';} ?>" href="<?= base_url()?>auditsystem/chapter3/setvalues/3.15 Ab4-section3/<?= $c3tID?>/<?= $cID?>/<?= $name?>">Section 3</a>
                    <a class="nav-link ms-0 <?php if(str_contains(uri_string(), 'section4')){echo 'active ';} ?>" href="<?= base_url()?>auditsystem/chapter3/setvalues/3.15 Ab4-section4/<?= $c3tID?>/<?= $cID?>/<?= $name?>">Section 4</a>
                    <a class="nav-link ms-0 <?php if(str_contains(uri_string(), 'section5')){echo 'active ';} ?>" href="<?= base_url()?>auditsystem/chapter3/setvalues/3.15 Ab4-section5/<?= $c3tID?>/<?= $cID?>/<?= $name?>">Section 5</a>
                    <a class="nav-link ms-0 <?php if(str_contains(uri_string(), 'section6')){echo 'active ';} ?>" href="<?= base_url()?>auditsystem/chapter3/setvalues/3.15 Ab4-section6/<?= $c3tID?>/<?= $cID?>/<?= $name?>">Section 6</a>
                    <a class="nav-link ms-0 <?php if(str_contains(uri_string(), 'section7')){echo 'active ';} ?>" href="<?= base_url()?>auditsystem/chapter3/setvalues/3.15 Ab4-section7/<?= $c3tID?>/<?= $cID?>/<?= $name?>">Section 7</a>
                    <a class="nav-link ms-0 <?php if(str_contains(uri_string(), 'section8')){echo 'active ';} ?>" href="<?= base_url()?>auditsystem/chapter3/setvalues/3.15 Ab4-section8/<?= $c3tID?>/<?= $cID?>/<?= $name?>">Section 8</a>
                    <a class="nav-link ms-0 <?php if(str_contains(uri_string(), 'section9')){echo 'active ';} ?>" href="<?= base_url()?>auditsystem/chapter3/setvalues/3.15 Ab4-section9/<?= $c3tID?>/<?= $cID?>/<?= $name?>">Section 9</a>
                </nav>
                <hr class="mt-0 mb-4" />
                <br>
                
                <h4>CORPORATE DISCLOSURE CHECKLIST (IFRS)</h4>
                <h6><u>Scope</u></h6>
                <p>This checklist should be completed for every corporate entity where International Financial Reporting Standards (IFRS) are being followed and it is not appropriate to complete Appendix 3.14 – Financial Statements Disclosure and Compliance Annual Review Checklist.</p>
                <p>This checklist can be used for any entity that adopts IFRS, and includes a number of “best practice” disclosures which are commonly included within financial statements as a result of local legislative requirements.  If such best practice disclosures are not required, or are prohibited by legislation, it would be necessary to disregard these, and where relevant, to replace these disclosures with those disclosures required by the relevant legislation.</p>
                <p>The requirements of IFRS only apply to material items.  Immaterial balances can be aggregated into other account headings and immaterial notes and accounting policies can be, and should ideally be, removed [IAS 1 paragraphs 29-31].</p>
                <p>IFRS 15 <i>Revenue from Contracts with Customers</i> and IFRS 9 <i>Financial Instruments</i> became mandatory for accounting periods commencing on or after 1 January 2018. These resulted in significant additional disclosure requirements compared to the superseded standards dealing with these areas. </p>
                <p>IFRS 16 <i>Leases</i> is mandatory for accounting periods commencing on or after 1 January 2019. This fundamentally alters the accounting treatment for lessees, with consequential disclosure amendments.</p>
                <p><b>NB: To ensure that the Checklist is as efficient as possible, areas which are more specialised have been addressed by supplementary disclosure checklists. <u>These supplementary disclosure checklists should only be completed if the area is relevant.</u> </b></p>
                <p>NB: The checklist does not cover the additional disclosures required by companies which enter into insurance contracts, where these are relevant considerations, then the disclosure requirements of IFRS 4 should be given.  It also does not cover the requirements of IAS 26, which are only relevant to clients who are themselves pension schemes, or IFRIC 2 which is relevant to cooperative entities.  The checklist also does not cover the disclosure requirements of companies with listed equity or debt.</p>

                <form action="<?= base_url()?>auditsystem/client/saveab4checklist/<?= $code?>/<?= $c3tID?>/<?= $cID?>/<?= $name?>" method="post">
                <input type="hidden" name="part" value="<?= $section?>">

                <input type="hidden" name="acid" value="<?= $acID?>">
                <table class="table table-sm table-bordered">
                    <thead>
                        <tr>
                            <th>Specialist Area ~ Additional Disclosures Relating to:-</th>
                            <th>Reference in this Manual</th>
                            <th>Is this Area Relevant?(Y/N)</th>
                            <th>Supplementary Checklist Completed?(Y/N/NA)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Exploration for and Evaluation of Mineral Resources</td>
                            <td>App. 3.15.1</td>
                            <td>
                                <select name="y1" id="" class="form-select">
                                    <option value="<?= $sec['y1']?>" selected><?= $sec['y1']?></option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </td>
                            <td>
                                <select name="y2" id="" class="form-select">
                                    <option value="<?= $sec['y2']?>" selected><?= $sec['y2']?></option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                    <option value="N/A">N/A</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Defined Benefit Pension Plans</td>
                            <td>App. 3.15.2</td>
                            <td>
                                <select name="y3" id="" class="form-select">
                                    <option value="<?= $sec['y3']?>" selected><?= $sec['y3']?></option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </td>
                            <td>
                                <select name="y4" id="" class="form-select">
                                    <option value="<?= $sec['y4']?>" selected><?= $sec['y4']?></option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                    <option value="N/A">N/A</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Share-Based Payments</td>
                            <td>App. 3.15.3</td>
                            <td>
                                <select name="y5" id="" class="form-select">
                                    <option value="<?= $sec['y5']?>" selected><?= $sec['y5']?></option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </td>
                            <td>
                                <select name="y6" id="" class="form-select">
                                    <option value="<?= $sec['y6']?>" selected><?= $sec['y6']?></option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                    <option value="N/A">N/A</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Agricultural Activitiess</td>
                            <td>App. 3.15.4</td>
                            <td>
                                <select name="y7" id="" class="form-select">
                                    <option value="<?= $sec['y7']?>" selected><?= $sec['y7']?></option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </td>
                            <td>
                                <select name="y8" id="" class="form-select">
                                    <option value="<?= $sec['y8']?>" selected><?= $sec['y8']?></option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                    <option value="N/A">N/A</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>First Time Adoption of IFRS</td>
                            <td>App. 3.15.5</td>
                            <td>
                                <select name="y9" id="" class="form-select">
                                    <option value="<?= $sec['y9']?>" selected><?= $sec['y9']?></option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </td>
                            <td>
                                <select name="y10" id="" class="form-select">
                                    <option value="<?= $sec['y10']?>" selected><?= $sec['y10']?></option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                    <option value="N/A">N/A</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Parent where Consolidated Financial Statements are not Prepared</td>
                            <td>App. 3.15.6</td>
                            <td>
                                <select name="y11" id="" class="form-select">
                                    <option value="<?= $sec['y11']?>" selected><?= $sec['y11']?></option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </td>
                            <td>
                                <select name="y12" id="" class="form-select">
                                    <option value="<?= $sec['y12']?>" selected><?= $sec['y12']?></option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                    <option value="N/A">N/A</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>First Time Adoption of IFRS 15 / 9</td>
                            <td>App. 3.15.7</td>
                            <td>
                                <select name="y13" id="" class="form-select">
                                    <option value="<?= $sec['y13']?>" selected><?= $sec['y13']?></option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </td>
                            <td>
                                <select name="y14" id="" class="form-select">
                                    <option value="<?= $sec['y14']?>" selected><?= $sec['y14']?></option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                    <option value="N/A">N/A</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>First Time Adoption of IFRS 16</td>
                            <td>App. 3.15.8</td>
                            <td>
                                <select name="y15" id="" class="form-select">
                                    <option value="<?= $sec['y15']?>" selected><?= $sec['y15']?></option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </td>
                            <td>
                                <select name="y16" id="" class="form-select">
                                    <option value="<?= $sec['y16']?>" selected><?= $sec['y16']?></option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                    <option value="N/A">N/A</option>
                                </select>
                            </td>
                        </tr>
                    </tbody>
                </table>
                    <button type="submit" class="btn btn-success m-1 float-end  btn-sm"><i class="fas fa-file-alt m-1"></i>Save</button>
                </form>


            </div>
        </div>
    </div>
    
</main>













