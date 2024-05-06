<?php  $crypt = \Config\Services::encrypter();?>
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
                        <div class="page-header-subtitle"><?= $code.' - '.$header?></div>
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
                <h4>STATEMENT OF DIRECTORS’ RESPONSIBILITIES</h4>
                <p>It is necessary to include, either within the financial statements, or if this has not been included, within the report of the auditors, a summary of the legal responsibilities of the directors.</p>
                <p>Example wording below sets out suggested wording which may be used, which should be tailored according to specific legal requirements set out in legislation.</p>
                <p>This wording presumes that the financial statements of the company are not published on the company’s website, as amendments to the wording may be required if this happens.</p>
                <p>“The directors are responsible for preparing financial statements for each financial year which give a true and fair view of the state of affairs of the company at the end of the financial year and of the profit or loss for that period and which comply with <input type="text" class="form-control" placeholder="[insert legislation]"> .  In preparing the financial statements, appropriate accounting policies have been used and applied consistently, and reasonable and prudent judgments and estimates have been made.  The directors are responsible for maintaining proper accounting records, for safeguarding the assets of the company, and for preventing and detecting fraud and other irregularities.”</p>
            </div>
        </div>
    </div>
</main>


















