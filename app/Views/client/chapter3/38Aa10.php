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
                
                <h4>FINAL ANALYTICAL PROCEDURES</h4>
                <h6>Objective: </h6>
                <p>TTo carry out a review of the financial statements such that the results obtained, together with the conclusions drawn from other audit tests, give a basis for the opinion on the financial statements.</p>
                <h6>Recording:</h6>
                <p>Review key ratios of most significance to the entity. Any large or unexpected movements in these ratios should be explained. This section should also contain details of significant or unexpected changes in major Statement of Financial Position and Performance Statement items.</p>
                <h6>Comparisons should be made of current period figures with prior period and / or budgeted figures.  Explanations obtained for significant or unexpected changes in key business ratios and items in the financial statements must be corroborated by other evidence. A conclusion should then be reached. </h6>
                <h6><i>Undertaking analytical procedures at finalisation is mandatory; however, the use of this form is optional.</i></h6>

                <form action="<?= base_url()?>auditsystem/client/saveaa10/<?= $code?>/<?= $c3tID?>/<?= $cID?>/<?= $name?>" method="post">
                    <input type="hidden" name="acid" value="<?= $acID?>">
                    <p>Summary of key ratios which may be calculated or printed from a relevant software package (add others which are specifically relevant to the entity):</p>
                    <i>
                        <ul>
                            <li>(Gross Profit / Revenue) x 100</li>
                            <li>(Profit before Tax / Revenue) x 100</li>
                            <li>Direct expenses / Inventory</li>
                            <li>(Trade Receivables / Credit Sales) x 365</li>
                            <li>(Trade Payables / Credit Purchases) x 365</li>
                            <li>Current Assets / Current Liabilities</li>
                            <li>Current Assets – Inventory / Current Liabilities</li>
                            <li>Total Liabilities / Equity</li>
                        </ul>
                    </i>

                    <textarea name="sum" id="" cols="30" rows="10" class="form-control"><?= $aa10['sum']?></textarea>
                    
                    <br><br>
                    <p>Comparison of key figures (or summarise where this work is filed)</p>
                    <i>
                        <p>For example:</p>
                        <p>Compare current year’s figures, at intervals appropriate with the availability of management information, against a sample of the following, as appropriate:</p>
                        <ul>
                            <li>Prior year’s figures;</li>
                            <li>Budgeted figures;</li>
                            <li>Industry and other external statistics;</li>
                            <li>Non-financial information (specify which information); or</li>
                            <li>Any other relevant information.</li>
                        </ul>
                        <p>Ensure that a summary is prepared of all variances (both absolute and percentage) to justify the analysis performed.</p>
                        <p>Compare results of final analytical procedures with those of preliminary analytical procedures.</p>
                    </i>

                    <textarea name="comp" id="" cols="30" rows="10" class="form-control"><?= $aa10['comp']?></textarea>

                    <br><br>
                    <p><b>Explanations of unusual variations </b> (or summarise where this work is filed)</p>
                    <i>
                        <p>For example:</p>
                        <p>Investigate normal and abnormal fluctuations, and record explanations.</p>
                        <p>Record details of the evidence obtained to substantiate and corroborate the explanations received.</p>
                        <p>Consider whether any of the points raised need to be included in either:</p>
                        <ul>
                            <li>The management letter, as a result of a weakness highlighted in the accounting system; or</li>
                            <li>The letter of representation, as a result of an explanation for which only verbal evidence is available.</li>
                        </ul>
                        <p>Consider whether any of the unusual variances identified indicate a previously unrecognised risk of material misstatements due to fraud.</p>
                    </i>

                    <textarea name="exp" id="" cols="30" rows="10" class="form-control"><?= $aa10['exp']?></textarea>

                    <button type="submit" class="btn btn-success m-1 float-end"><i class="fas fa-file-alt m-1"></i>Save</button>


                </form>
                <br><br><br><hr>
                
                <h6>Conclusion:</h6>
                    <p>I have carried out both overall and detailed analytical procedures on the financial statements and I am satisfied that:</p>
                    <ul>
                        <li>there are no large or unusual variations in the figures which cannot be adequately explained;</li>
                        <li>no indicators of fraud have been identified; and</li>
                        <li>no indicators of fraud have been identified; and</li>
                    </ul>
                
            </div>
        </div>
    </div>
    
</main>



















