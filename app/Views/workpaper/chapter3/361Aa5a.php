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
                <h4>Private and Confidential</h4>
                <input type="text" class="form-control form control-sm" placeholder="[Name of Client]">
                <input type="text" class="form-control form control-sm" placeholder="[Address]">
                <input type="date" class="form-control form control-sm" placeholder="[date]">
                <br>
                <p>Dear Sirs</p>
                <h4>Management Letter</h4>
                <h6>Financial statements for the <input type="text" class="form-control form control-sm" placeholder="[year/period]"> ending <input type="date" class="form-control form control-sm" placeholder="[date]"></h6>
                <p>Following our recent <input type="text" class="form-control form control-sm" placeholder="[interim/final]">  audit in connection with the financial statements of <input type="text" class="form-control form control-sm" placeholder="[client name]">  for the <input type="text" class="form-control form control-sm" placeholder="[year/period]"> ending <input type="date" class="form-control form control-sm" placeholder="[year/period]">, we are writing to bring to your attention certain matters that arose during the course of our work, together with suggestions for improvements of controls and procedures operated by the company.  We hope you will find our comments helpful and constructive.</p>
                <p>Our work during the audit included an examination of some of the company’s transactions, procedures <input type="text" class="form-control form control-sm" placeholder="[and controls]"> with a view to expressing an opinion on the financial statements for the <input type="text" class="form-control form control-sm" placeholder="[year/period]">.  This work was not directed primarily towards discovering deficiencies in, or the operating effectiveness of your internal controls <textarea class="form-control form-control-sm"name="" id="" cols="30" rows="10" placeholder="[other than those that would affect our audit opinion]"></textarea> or towards the detection of fraud.  We have included in this letter only matters that have come to our attention as a result of our normal audit procedures and consequently our comments should not be regarded as a comprehensive record of all deficiencies in internal control that may exist, of all improvements that might be made, or of the operating effectiveness of your internal controls.</p>
                <textarea class="form-control" name="" id="" cols="30" rows="10" placeholder="[Small organisations or clients with a few accounting staff:We recognise that the number of your [accounting] staff makes a complete system of internal control impracticable and that the directors [or named client officials] exercise close personal supervision, which we consider reasonable in the circumstances.  We have taken this into account in conducting our audit and in preparing this letter]."></textarea>
                <p><input type="text" class="form-control form control-sm" placeholder="[Final audit only]"> Our work also included a review of the adequacy of disclosures in the financial statements and consideration of the appropriateness of the accounting policies and estimation techniques adopted by the company. This review identified no significant matters, which we believe are necessary to draw to your attention. <input type="text" class="form-control form control-sm" placeholder="[amend as required]">.</p>
                <h6>Summary</h6>
                The important matters that arose as a result of our work are set out in detail 
                <textarea class="form-control" name="" id="" cols="30" rows="10" placeholder="[below]/[in the attached memorandum]. [Matters of less significance are included in an appendix………..] [The attached memorandum and appendix collectively form part of this letter.]"></textarea>
                <textarea class="form-control" name="" id="" cols="30" rows="10" placeholder="[For groups or large organisations:
                We have prepared a separate memorandum for each subsidiary, division or different level of functional responsibility, as set out below:]
                "></textarea>
                <p>We would particularly draw your attention to the following matters:</p>
                <textarea class="form-control" name="" id="" cols="30" rows="10" placeholder="[Significant qualitative aspects of the entity’s accounting practices, including accounting policies, accounting estimates and financial statement disclosures:"></textarea>
                <i>
                    <p>Summary list of key matters:</p>
                    <ul>
                        <li><input type="text" class="form-control form control-sm"></li>
                    </ul>
                </i>
                <textarea class="form-control" name="" id="" cols="30" rows="10" placeholder="[Other matters, if any, arising from the audit that in our professional judgment, are significant to the oversight of the financial reporting process:"></textarea>
                <i>
                    <p>Summary list of key matters:</p>
                    <ul>
                        <li><input type="text" class="form-control form control-sm"></li>
                    </ul>
                </i>
                <textarea class="form-control" name="" id="" cols="30" rows="10" placeholder="[Where matters included in previous management letters have not been fully resolved:
                We wrote to you previously on [date(s)] following our [interim/final audit(s)] for the [year/period] ending [date].  We are pleased to record that many of the matters raised have been dealt with satisfactorily [although we appreciate that you are still carefully considering the implementation of [specific recommendation(s)]].
                "></textarea>
                <textarea class="form-control" name="" id="" cols="30" rows="10" placeholder="[Significant matters previously brought to your attention that, in our opinion, have not been effectively dealt with are summarised as follows:"></textarea>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Subject</th>
                            <th>Date of Letter</th>
                            <th>Paragrap Ref.</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="text" class="form-control"></td>
                            <td><input type="text" class="form-control"></td>
                            <td><input type="text" class="form-control"></td>
                        </tr>
                        <tr>
                            <td><input type="text" class="form-control"></td>
                            <td><input type="text" class="form-control"></td>
                            <td><input type="text" class="form-control"></td>
                        </tr>
                    </tbody>
                </table>
                <textarea class="form-control" name="" id="" cols="30" rows="10" placeholder="Any matters of particular significance should be repeated in detail.]"></textarea>
                <h6>Conclusion</h6>
                <p>If you require any further information or assistance, we shall be very pleased to help you.
                We would appreciate an acknowledgement of the receipt of this letter and look forward to receiving your comments when you have had the opportunity of considering the matters that we have raised. <textarea class="form-control" name="" id="" cols="30" rows="10" placeholder="[You have agreed that the contents of this letter will be minuted by the company after due consideration by the board]."></textarea> </p>
                <p>This letter is for your private use only.  It has been prepared on the understanding that it will not be disclosed to any third party, or quoted to or referred to, without our prior written consent and we assume no responsibility to any other party.</p>
                <p>We should like to take this opportunity of thanking you and your staff for the assistance and co-operation we have received during the course of our work.  The contents of this letter were discussed with and have been approved by <input type="text" class="form-control form control-sm" placeholder="[name of client official(s)]"> on <input type="date" class="form-control form control-sm" placeholder="[date]">.</p>  
                <p>Yours faithfully</p>
                <p>………………………………………………………</p>
                <p>Signed for and on behalf of <input type="text" class="form-control form control-sm" placeholder="[name of client official(s)]"> on <input type="text" class="form-control form control-sm" placeholder="[Audit Firm]"></p>
            </div>
        </div>
    </div>
</main>


















