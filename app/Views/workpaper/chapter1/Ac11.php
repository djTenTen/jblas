
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
                <a class="btn btn-primary btn-sm float-end mb-2" href="<?= base_url('auditsystem/wp/viewpdfc1/')?><?= $code?>/<?= $c1tID?>/<?= $cID?>/<?= $wpID?>" target="_blank" title="View"><i class="fas fa-eye"></i> View Document</a>
                <hr style="color: #7752FE;" class="m-5">
                <div class="m-5">
                    <h4>TEAM DISCUSSIONS AND BRIEFING MEETING</h4>
                    <h6>Objective:</h6>
                    <p>To document a team discussion covering fraud and risk as required by PSA 240, 315 and 550 and to demonstrate that an adequate staff briefing has occurred.</p>
                    <form action="<?= base_url()?>auditsystem/wp/savevalues/c1/saveac11/<?= $code?>/<?= $c1tID?>/<?= $cID?>/<?= $name?>" method="post">
                        <input type="hidden" name="acid" value="<?= $acID?>">
                        <label for="">Date of the meeting: <input type="date" class="form-control" name="datem" value="<?= $ac11['datem']?>" required></label>
                        <h6>Details of the assignment team:</h6>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Grade:</th>
                                    <th>Name:</th>
                                    <th>Initial to Confirm Attendance:</th>
                                    <th>Initial to Confirm Understanding of Planning:*</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>A.E.P.</td>
                                    <td> <input type="text" class="form-control" name="ape1" value="<?= $ac11['ape1']?>"></td>
                                    <td> <input type="text" class="form-control" name="ape2" value="<?= $ac11['ape2']?>"></td>
                                    <td> <input type="text" class="form-control" name="ape3" value="<?= $ac11['ape3']?>"></td>
                                </tr>
                                <tr>
                                    <td>Internal EQR</td>
                                    <td> <input type="text" class="form-control" name="ieqr1" value="<?= $ac11['ieqr1']?>"></td>
                                    <td> <input type="text" class="form-control" name="ieqr2" value="<?= $ac11['ieqr2']?>"></td>
                                    <td> <input type="text" class="form-control" name="ieqr3" value="<?= $ac11['ieqr3']?>"></td>
                                </tr>
                                <tr>
                                    <td>Manager</td>
                                    <td> <input type="text" class="form-control" name="mngr1" value="<?= $ac11['mngr1']?>"></td>
                                    <td> <input type="text" class="form-control" name="mngr2" value="<?= $ac11['mngr2']?>"></td>
                                    <td> <input type="text" class="form-control" name="mngr3" value="<?= $ac11['mngr3']?>"></td>
                                </tr>
                                <tr>
                                    <td>Supervisor</td>
                                    <td> <input type="text" class="form-control" name="sup1" value="<?= $ac11['sup1']?>"></td>
                                    <td> <input type="text" class="form-control" name="sup2" value="<?= $ac11['sup2']?>"></td>
                                    <td> <input type="text" class="form-control" name="sup3" value="<?= $ac11['sup3']?>"></td>
                                </tr>
                                <tr>
                                    <td>Senior</td>
                                    <td> <input type="text" class="form-control" name="sr1" value="<?= $ac11['sr1']?>"></td>
                                    <td> <input type="text" class="form-control" name="sr2" value="<?= $ac11['sr2']?>"></td>
                                    <td> <input type="text" class="form-control" name="sr3" value="<?= $ac11['sr3']?>"></td>
                                </tr>
                                <tr>
                                    <td>Junior</td>
                                    <td> <input type="text" class="form-control" name="jra1" value="<?= $ac11['jra1']?>"></td>
                                    <td> <input type="text" class="form-control" name="jra2" value="<?= $ac11['jra2']?>"></td>
                                    <td> <input type="text" class="form-control" name="jra3" value="<?= $ac11['jra3']?>"></td>
                                </tr>
                                <tr>
                                    <td>Junior</td>
                                    <td> <input type="text" class="form-control" name="jrb1" value="<?= $ac11['jrb1']?>"></td>
                                    <td> <input type="text" class="form-control" name="jrb2" value="<?= $ac11['jrb2']?>"></td>
                                    <td> <input type="text" class="form-control" name="jrb3" value="<?= $ac11['jrb3']?>"></td>
                                </tr>
                            </tbody>
                        </table>
                        <p>* Prior to initialling this column all staff should review the assignment plan, assessment of materiality & risk and systems notes.</p>
                        <p>The team discussions on fraud, risk and related party transactions should be chaired by the A.E.P. (although the general briefing can be performed by another team member, i.e. the manager) and it should be undertaken ensuring that, when considering fraud, professional scepticism is applied. <strong> Team members should set aside the belief that the client is honest and acts with integrity. </strong></p>
                        <p>Where junior staff are briefed separately, this should be clearly documented.</p>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th colspan="2">Detailed consideration of fraud, risk and related party transactions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="2">Scope of discussion (add additional points as appropriate) ~ note that all points should be discussed, and key issues highlighted below:</td>
                                </tr>
                                <tr>
                                    <td style="width: 50%;">1.	The areas within the accounting system where error or fraud are most likely to occur (consideration must specifically be given to earnings management);</td>
                                    <td><textarea class="form-control" cols="30" rows="5" name="dcfrrt1"><?= $ac11['dcfrrt1']?></textarea></td>
                                </tr>
                                <tr>
                                    <td>2.	How a fraud could be carried out by either management or employees (special consideration should be given to accounting estimates);</td>
                                    <td><textarea class="form-control" cols="30" rows="5" name="dcfrrt2"><?= $ac11['dcfrrt2']?></textarea></td>
                                </tr>
                                <tr>
                                    <td>3.	How a fraud could be carried out by, or in conjunction with the entity’s related parties (including where transactions are not undertaken on an arm’s length basis);</td>
                                    <td><textarea class="form-control" cols="30" rows="5" name="dcfrrt3"><?= $ac11['dcfrrt3']?></textarea></td>
                                </tr>
                                <tr>
                                    <td>4.	How a fraud could be carried out by customers or suppliers;</td>
                                    <td><textarea class="form-control" cols="30" rows="5" name="dcfrrt4"><?= $ac11['dcfrrt4']?></textarea></td>
                                </tr>
                                <tr>
                                    <td>5.	What risk factors may be seen during the audit which could indicate fraudulent activity, including:
                                        <ul>
                                            <li>Pressure on management performance (e.g. targets set by holding companies, incentive schemes or banking covenants);</li>
                                            <li>Change in lifestyle or behaviour of management or employees</li>
                                            <li>Related party transactions which appear to have minimal commercial substance;</li>
                                            <li>Suppliers / customers with PO box addresses etc.;</li>
                                            <li>Allegations of fraud within the entity; or</li>
                                            <li>Management overriding key controls.</li>
                                        </ul>
                                    </td>
                                    <td><textarea class="form-control" cols="30" rows="5" name="dcfrrt5"><?= $ac11['dcfrrt5']?></textarea></td>
                                </tr>
                                <tr>
                                    <td colspan="2">Scope of discussion (add additional points as appropriate) ~ note that all points should be discussed, and key issues highlighted below:</td>
                                </tr>
                                <tr>
                                    <td>6.	What controls are in place in relation to cash (or assets that can be easily converted to cash) and the employees involved in this area;</td>
                                    <td><textarea class="form-control" cols="30" rows="5" name="dcfrrt6"><?= $ac11['dcfrrt6']?></textarea></td>
                                </tr>
                                <tr>
                                    <td>7.	Where consolidated financial statements are prepared the risk of fraud in subsidiaries, associates, joint ventures and during the consolidation process;</td>
                                    <td><textarea class="form-control" cols="30" rows="5" name="dcfrrt7"><?= $ac11['dcfrrt7']?></textarea></td>
                                </tr>
                                <tr>
                                    <td>8.	How any changes in senior management or shareholders during, or since the end of the period could cause a potential risk factor which needs to be approached with “professional scepticism”.</td>
                                    <td><textarea class="form-control" cols="30" rows="5" name="dcfrrt8"><?= $ac11['dcfrrt8']?></textarea></td>
                                </tr>
                                <tr>
                                    <td>9.	Which audit procedures will be used to respond to the susceptibility of the entity’s financial statements to material misstatement due to fraud? This may involve changing the nature, timing and extent of the audit procedures to be carried out.
                                        <ul>
                                            <li>Performing substantive procedures on selected account balances and assertions not otherwise tested due to their materiality or risk;</li>
                                            <li>Adjusting the timing of audit procedures from that otherwise expected;</li>
                                            <li>Using different sampling methods;</li>
                                            <li>Altering the audit approach compared to the prior year;</li>
                                            <li>Use of data analytics to test for anomalies in a dataset;</li>
                                            <li>Performing audit procedures at different locations or at locations on an unannounced basis.</li>
                                        </ul>
                                    </td>
                                    <td><textarea class="form-control" cols="30" rows="5" name="dcfrrt9"><?= $ac11['dcfrrt9']?></textarea></td>
                                </tr>
                            </tbody>
                        </table>
                        <br>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th colspan="2">Specific areas to be covered by the briefing:</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Scope of discussion (add additional points as appropriate) ~ note that all points should be discussed, and key issues highlighted below:</td>
                                    <td>Covered in discussion? (Yes/No)</td>
                                </tr>
                                <tr>
                                    <td> <p>1.	All staff are aware of: </p></td>
                                </tr>
                                <tr>
                                    <td>- The need to report suspicions of money laundering internally, where required by legislation;</td>
                                    <td><input type="text" class="form-control" name="sacb1" <?= $ac11['sacb1']?>></td>
                                </tr>
                                <tr>
                                    <td>- That any issues (actual or possible), including matters relating to independence which, had they been known earlier, would have caused the firm to decline the appointment should be notified to the A.E.P. immediately;</td>
                                    <td><input type="text" class="form-control" name="sacb2" value="<?= $ac11['sacb2']?>"></td>
                                </tr>
                                <tr>
                                    <td>- The main indicators for this client that the going concern assumption could be in doubt and if such issues are identified, these should be highlighted to the A.E.P. promptly;</td>
                                    <td><input type="text" class="form-control" name="sacb3" value="<?= $ac11['sacb3']?>"></td>
                                </tr>
                                <tr>
                                    <td>- That if new related parties are identified, these must be communicated immediately to all members of the audit team;</td>
                                    <td><input type="text" class="form-control" name="sacb4" value="<?= $ac11['sacb4']?>"></td>
                                </tr>
                                <tr>
                                    <td>2.	The responsibilities of team members have been clarified and documented at Ac14;</td>
                                    <td><input type="text" class="form-control" name="sacb5" value="<?= $ac11['sacb5']?>"></td>
                                </tr>
                                <tr>
                                    <td>3.	A detailed briefing regarding the client (including; objectives, structure and activities);</td>
                                    <td><input type="text" class="form-control" name="sacb6" value="<?= $ac11['sacb6']?>"></td>
                                </tr>
                                <tr>
                                    <td>4.	The risk areas as identified from the risk assessment and how additional work on these areas are incorporated into the audit approach;</td>
                                    <td><input type="text" class="form-control" name="sacb7" value="<?= $ac11['sacb7']?>"></td>
                                </tr>
                                <tr>
                                    <td>5.	How can unpredictability be incorporated into the audit approach to maximise the chance of fraudulent transactions being identified (e.g. which procedure will involve random / haphazard testing etc.);</td>
                                    <td><input type="text" class="form-control" name="sacb8" value="<?= $ac11['sacb8']?>"></td>
                                </tr>
                                <tr>
                                    <td>6.	Timing of review procedures have been discussed and it has been documented who has responsibility to review which areas.</td>
                                    <td><input type="text" class="form-control" name="sacb9" value="<?= $ac11['sacb9']?>"></td>
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
