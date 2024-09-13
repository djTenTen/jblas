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
                <a class="btn btn-primary btn-sm float-end mb-2" href="<?= base_url('auditsystem/client/chapter3/view/')?><?= $code?>/<?= $c3tID?>" target="_blank" title="View"><i class="fas fa-eye"></i> View Document</a>
                <hr style="color: #7752FE;" class="m-5">
                <div class="m-5">
                    <h4>FINANCIAL STATEMENTS DISCLOSURE AND COMPLIANCE ANNUAL REVIEW CHECKLIST</h4>
                    <p>This checklist should be used to evidence the checking of disclosure and compliance matters for 'uncomplex companies' where the appropriate (i.e. IFRS) disclosure checklist has been completed within the last three years and the size and complexity of the company means that the firm does not consider that a full disclosure checklist needs to be completed every year.</p>
                    <h6>1. Use of Disclosure Checklists</h6>
                    <p>The appropriate disclosure checklist must be completed in the following circumstances:</p>
                    <ul>
                        <li>First year of engagement;</li>
                        <li>Every three years;</li>
                        <li>Where the financial statements are not prepared via a computerised accounts production package;</li>
                        <li>Where there have been significant changes in the client's business or accounting policies;</li>
                        <li>Where there have been significant changes in financial reporting standards (including First Time Adoption of / Amendments to IFRS) or legislative requirements;</li>
                        <li>Where there has been a significant transaction which would require additional disclosure in the financial statements (for example, a change to Equity (other than the profit for the year), the introduction of a new type of asset or liability, or acquiring a new source of income or expenditure).</li>
                    </ul>
                    <h6>2.	Common Changes</h6>
                    <p>Have any of the following points arisen during the period, resulting in disclosure or compliance changes:</p>
                    <form action="<?= base_url()?>auditsystem/client/savevalues/c3/saveab3/<?= $code?>/<?= $c3tID?>/<?= $cID?>/<?= $name?>" method="post">
                        <input type="hidden" name="acid" value="<?= $acID?>">
                        <table class="table table-bordered table-sm">
                            <tbody>
                                <tr>
                                    <td>Are disclosure exemptions available in legislation / IFRS now being taken / lost?</td>
                                    <td>
                                        <select name="aby1" id="" class="form-select">
                                            <option value="<?= $ab3['aby1']?>" selected><?= $ab3['aby1']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </td>   
                                </tr>
                                <tr>
                                    <td>Was the company required to produce consolidated financial statements in the previous period but not in this period?</td>
                                    <td>
                                        <select name="aby2" id="" class="form-select">
                                            <option value="<?= $ab3['aby2']?>" selected><?= $ab3['aby2']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </td>   
                                </tr>
                                <tr>
                                    <td>Is the company required to prepare consolidated financial statements this period (but has not in the previous period)?</td>
                                    <td>
                                        <select name="aby3" id="" class="form-select">
                                        <option value="<?= $ab3['aby3']?>" selected><?= $ab3['aby3']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </td>   
                                </tr>
                                <tr>
                                    <td>Is the company adopting a new accounting framework for the first time?</td>
                                    <td>
                                        <select name="aby4" id="" class="form-select">
                                            <option value="<?= $ab3['aby4']?>" selected><?= $ab3['aby4']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </td>   
                                </tr>
                            </tbody>
                        </table>
                        <p>If the answer to any of the above is yes, a full disclosure checklist needs to be completed.</p>
                        <h1>3.	New Financial Reporting Standards </h1>
                        <p>The most recently completed disclosure checklist was for the period ending_________________</p>
                        <p>Since then, no further* / the following* Accounting / Financial Reporting Standards or amendments (IFRS*) have become mandatory, with a commentary of the effect on disclosure in the financial statements being shown <i>(or included on a separate, cross-referenced schedule)(*delete as applicable):</i></p>
                        <table class="table table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th>Financial Reporting Standard </th>
                                    <th>Effect on disclosures</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="text" class="form-control" name="frs1" value="<?= $ab3['frs1']?>"></td>
                                    <td><input type="text" class="form-control" name="ed1" value="<?= $ab3['ed1']?>"></td>
                                </tr>
                                <tr>
                                    <td><input type="text" class="form-control" name="frs2" value="<?= $ab3['frs2']?>"></td>
                                    <td><input type="text" class="form-control" name="ed2" value="<?= $ab3['ed2']?>"></td>
                                </tr>
                                <tr>
                                    <td><input type="text" class="form-control" name="frs3" value="<?= $ab3['frs3']?>"></td>
                                    <td><input type="text" class="form-control" name="ed3" value="<?= $ab3['ed3']?>"></td>
                                </tr>
                                <tr>
                                <td><input type="text" class="form-control" name="frs4" value="<?= $ab3['frs4']?>"></td>
                                <td><input type="text" class="form-control" name="ed4" value="<?= $ab3['ed4']?>"></td>
                                </tr>
                                <tr>
                                    <td><input type="text" class="form-control" name="frs5" value="<?= $ab3['frs5']?>"></td>
                                    <td><input type="text" class="form-control" name="ed5" value="<?= $ab3['ed5']?>"></td>
                                </tr>
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-success m-1 float-end  btn-sm"><i class="fas fa-file-alt m-1"></i>Save</button>
                    </form>
                    <br><br><br><hr style="color: #7752FE;">
                </div>
            </div>
        </div>
    </div>
    
</main>













