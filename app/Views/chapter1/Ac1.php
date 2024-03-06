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
                        <div class="page-header-subtitle"><?= $header?></div>

                        
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

            <?php if (session()->get('invalid_input')) { ?>
                <div class="alert alert-danger alert-icon" role="alert">
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-icon-content">
                        <h6 class="alert-heading">Invalid Input</h6>
                        Invalid email or password, Please try again.
                    </div>
                </div>
            <?php  }?>
            <?php if (session()->get('success_registration')) { ?>
                <div class="alert alert-success alert-icon" role="alert">
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-icon-content">
                        <h6 class="alert-heading">Success Registration</h6>
                        Contents has been successfully saved.
                    </div>
                </div>
            <?php  }?>
            <?php if (session()->get('failed_registration')) { ?>
                <div class="alert alert-danger alert-icon" role="alert">
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-icon-content">
                        <h6 class="alert-heading">Failed Registration</h6>
                        Error registering contents.
                    </div>
                </div>
            <?php  }?>

            <div class="card-body">
               <!-- Contents Here -->

                <h4>Client Acceptance or Continuance Form</h4>
                <h6">This form must be completed by the A.E.P. before any work is undertaken on the file.</p>
                <p>While answering these questions the following matters should be fully considered for the audit firm and any network firm: independence, integrity, conflicts of interest with other clients, economic dependence, trusts, matters arising with regulatory authorities, ability to service the client, other services provided to the client and hospitality. Additional guidance is available in legislation and the Code of Ethics issued by the International Ethics Standards Board for Accountants.  </h6>

                <h6>Any YES answers should be fully explained along with the safeguards, which will enable us to accept / continue with the appointment. </h6>

                <h6>Significant issues must be discussed with the <span class="text-danger">Ethics Partner</span> and details of the discussion documented on file.</h6>

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Question</th>
                            <th>Yes/No</th>
                            <th>Comment</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($ac1 as $r){?>
                            <tr class="text-center">
                                <td><?= $r['question']?></td>
                                <td><?= $r['yesno']?></td>
                                <td><?= $r['comment']?></td>
                                <td><?php if($r['status'] == 'Active'){echo '<span class="badge badge-success">'.$r['status'].'</span>';}else{echo '<span class="badge badge-success">'.$r['status'].'</span>';}?></td>
                                <td><?= $r['status']?></td>
                            </tr>
                        <?php }?>
                    </tbody>
                </table>
                <form action="<?= base_url()?>auditsystem/chapter1/manage/ac1/save/<?= $header?>" method="post">
                   
                    <table class="table table-sm table-hover">
                        <thead>
                            <tr>
                                <th>Question</th>
                                <th>Yes/No</th>
                                <th>Comments</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                        </tbody>
                    </table>

                    <button class="btn btn-primary btn-sm float-right" type="button" data-action="add-field" id="add-field">Add Field</button>

                    <button type="submit" class="btn btn-success btn-sm">Save</button>

                </form>

                <br><br>

                <p>Name of A.P., not connected with this assignment, to whom staff may bring any grievances related to this engagement: 					</p>
                <h6>Those Charged With Governance and Management:</h6>
                <p>PSA 260 / 265 requires different matters to be communicated separately to those charged with governance and to management.  Where those charged with governance and management are the same individuals (for example, all matters are dealt with solely by the directors of the company), it is not necessary for these matters to be communicated twice.</p>
                <p>[EITHER]</p>
                <p>The Directors are actively involved in the day-to-day operations of the entity and are therefore considered to be both management and those charged with governance. </p>
                <p>Name of Informed Management: ……………………………… </p>
                <p>Justification of why they can be considered Informed Management:
                    ……………………………………………………………………………………………………………………………………………………………………………………………………………………
                </p>
                <p>Informed management is a “Member of management (or senior employee) of the entity relevant to the engagement who has the authority and capability to make independent management judgments and decisions in relation to non-audit / additional services on the basis of information provided by the firm”
                Our primary contact (if different from Informed Management) for the audit will be: …………………………………………………………………………………………………………
                </p>
                <p>[OR]</p>
                <p>The Directors are not actively involved in the day-to-day operations of the entity and are therefore considered to be those charged with governance. </p>
                <p>Management of the entity has been delegated to ………………………………………….</p>
                <p>Our primary contact of those charged with governance will be……………………………………….</p>
                <p>Our primary contact within the management team will be……………………………………………</p>
                <p>Name of Informed Management: ……………………………… </p>
                <p>Justification of why they can be considered Informed Management:
                ……………………………………………………………………………………………………………………………………………………………………………………………………………………
                </p>
                <p>Communication of certain matters will be required with both those charged with governance AND management. The following documents will evidence this dual communication:</p>
                <ul>
                    <li>Letter of engagement</li>
                    <li>Preliminary planning procedures</li>
                    <li>Planning letter</li>
                    <li>Letter of representation</li>
                    <li>Management letter</li>
                </ul>

                <h4>ENGAGEMENT QUALITY REVIEW:</h4>
                <p>An EQR needs to be undertaken on all audits where:</p>
                <ul>
                    <li>The firm’s criteria for a review has been met;</li>
                    <li>The A.E.P. deems it necessary for a review to be undertaken; or</li>
                    <li>It is required as a safeguard against threats which have been identified to the firm’s objectivity and independence.  It should be considered on all assignments where non-audit services have been provided.</li>
                </ul>
                <p><i>Note that it is necessary for the EQR to be appointed.  The A.E.P. should avoid excessive consultation with the EQR during the assignment, as this may lead to the reviewer’s ability to perform an objective review being impaired.  Where excessive consultation has taken place, the EQR will need to be replaced.</i></p>
                <ul>
                    <li>No EQR needs to be performed.</li>
                    <li>It is necessary for an EQR to be performed and this will be performed by</li>
                    <li>Where the EQR is undertaken by an external reviewer the name of the organisation which they work for</li>
                </ul>

                <table class="table">
                    <tr>
                        <td> REASON FOR EQR (If an EQR review was performed in the previous period, but is not being performed in the current period, this decision must also be justified.)  
                            <textarea class="form-control" cols="30" rows="3" name="question[]" required></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h6>SCOPE OF EQR (PSA 220.20):</h6>
                            <ul>
                                <li>Discussion of significant matters with the A.E.P.;</li>
                                <li>Review of the financial statements and the proposed auditor’s report;</li>
                                <li>Review of selected audit documentation relating to the significant judgments the engagement team made and the conclusions it reached; and </li>
                                <li>Evaluation of the conclusions reached in formulating the auditor’s report and consideration of whether the proposed report is appropriate.</li>
                            </ul>
                        </td>
                    </tr>
                </table>

                <h6>Authority to accept appointment:</h6>
                <p>Having completed the checklist I *do / *do not consider that there are any perceived threats to our independence, integrity and objectivity, and believe that we *can accept / *can accept with the stated safeguards / *cannot accept this appointment.</p>
                <p>Where necessary, adequate consultation has been undertaken and documented at 				.</p>
                <p>
                    Signature:	
                    (A.E.P.)

                    Date:	
                </p>        
                <p>If appropriate:</p>
                <p>
                    Signature:	
                    (EQR) 

                    Date:	
                </p>
            </div>
        </div>
    </div>
    
</main>


<script>
    $(document).ready(function () {

        var rowIdx = 0;

        $('#add-field').on('click', function () {
            // Adding a row inside the tbody.
            $('#tbody').append(`<tr>
                <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                <td><input class="form-control" type="text" name="yesno[]" value="YES"></td>
                <td><textarea class="form-control" cols="30" rows="3" name="comment[]">None</textarea></td>
                <td><button class="btn btn-danger remove" type="button" data-action="remove">remove</button></td>
            </tr>`);
        });

        $('#tbody').on('click', '.remove', function () {
            var child = $(this).closest('tr').nextAll();
            child.each(function () {
            var id = $(this).attr('id');
            var idx = $(this).children('.row-index').children('p');
            var dig = parseInt(id.substring(1));
            idx.html(`Row ${dig - 1}`);
            $(this).attr('id', `R${dig - 1}`);
            });
            $(this).closest('tr').remove();
            rowIdx--;
        });
    });
</script>
