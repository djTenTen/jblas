
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
                <a class="btn btn-primary btn-sm float-end mb-2" href="<?= base_url('auditsystem/wp/viewpdfc2/')?><?= $code?>/<?= $mtID?>/<?= $cID?>/<?= $wpID?>" target="_blank" title="View"><i class="fas fa-eye"></i> View Document</a>
                <hr style="color: #7752FE;" class="m-5">
                <div class="m-5">
                    <h4>TEAM DISCUSSIONS AND BRIEFING MEETING</h4>
                    <h6>Objective:</h6>
                    <p>To document a team discussion covering fraud and risk as required by PSA 240, 315 and 550 and to demonstrate that an adequate staff briefing has occurred.</p>
                    <form action="<?= base_url()?>auditsystem/wp/savevalues/c2/savetdabm/<?= $code?>/<?= $mtID?>/<?= $cID?>/<?= $wpID?>/<?= $name?>" method="post">
                        <input type="hidden" name="acid" value="<?= $mdID?>">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="mb-1" for="dom">Date of Meeting:</label>
                                <input type="date" name="dom" value="<?= $td['dom']?>" class="form-control">
                            </div>
                        </div>
                        <table class="table table-hover table-bordered">
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
                                    <td><input type="text" name="aepname" class="form-control" value="<?= $td['aepname']?>"></td>
                                    <td><input type="text" name="aepca" class="form-control" value="<?= $td['aepca']?>"></td>
                                    <td><input type="text" name="aepcup" class="form-control" value="<?= $td['aepcup']?>"></td>
                                </tr>
                                <tr>
                                    <td>Internal EQR</td>
                                    <td><input type="text" name="eqrname" class="form-control" value="<?= $td['eqrname']?>"></td>
                                    <td><input type="text" name="eqrca" class="form-control" value="<?= $td['eqrca']?>"></td>
                                    <td><input type="text" name="eqrcup" class="form-control" value="<?= $td['eqrcup']?>"></td>
                                </tr>
                                <tr>
                                    <td>Manager</td>
                                    <td><input type="text" name="manname" class="form-control" value="<?= $td['manname']?>"></td>
                                    <td><input type="text" name="manca" class="form-control" value="<?= $td['manca']?>"></td>
                                    <td><input type="text" name="mancup" class="form-control" value="<?= $td['mancup']?>"></td>
                                </tr>
                                <tr>
                                    <td>Supervisor</td>
                                    <td><input type="text" name="supname" class="form-control" value="<?= $td['supname']?>"></td>
                                    <td><input type="text" name="supca" class="form-control" value="<?= $td['supca']?>"></td>
                                    <td><input type="text" name="supcup" class="form-control" value="<?= $td['supcup']?>"></td>
                                </tr>
                                <tr>
                                    <td>Senior</td>
                                    <td><input type="text" name="senname" class="form-control" value="<?= $td['senname']?>"></td>
                                    <td><input type="text" name="senca" class="form-control" value="<?= $td['senca']?>"></td>
                                    <td><input type="text" name="sencup" class="form-control" value="<?= $td['sencup']?>"></td>
                                </tr>
                                <tr>
                                    <td>Junior</td>
                                    <td><input type="text" name="j1name" class="form-control" value="<?= $td['j1name']?>"></td>
                                    <td><input type="text" name="j1ca" class="form-control" value="<?= $td['j1ca']?>"></td>
                                    <td><input type="text" name="j1cup" class="form-control" value="<?= $td['j1cup']?>"></td>
                                </tr>
                                <tr>
                                    <td>Junior</td>
                                    <td><input type="text" name="j2name" class="form-control" value="<?= $td['j2name']?>"></td>
                                    <td><input type="text" name="j2ca" class="form-control" value="<?= $td['j2ca']?>"></td>
                                    <td><input type="text" name="j2cup" class="form-control" value="<?= $td['j2cup']?>"></td>
                                </tr>
                            </tbody>
                        </table>
                        <p><i>* Prior to initialling this column all staff should review the assignment plan, assessment of materiality & risk and systems notes.</i></p>
                        <p><i>The team discussions on fraud, risk and related party transactions should be chaired by the A.E.P. (although the general briefing can be performed by another team member, i.e., the manager) and it should be undertaken ensuring that, when considering fraud, professional skepticism is applied. <b><u>Team members should set aside the belief that the client is honest and acts with integrity.</u></b></i></p>
                        <p><i>Where junior staff are briefed separately, this should be clearly documented.</i></p>
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th colspan="1">Detailed consideration of fraud, risk and related party transactions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="1">Scope of discussion (add additional points as appropriate) ~ note that all points should be discussed, and key issues highlighted below:</td>
                                </tr>
                                <tr>
                                    <td>1.	The areas within the accounting system where error or fraud are most likely to occur (consideration must specifically be given to earnings management);</td>
                                    <td><textarea class="form-control" cols="30" rows="3" name="dsfr1"><?= $td['dsfr1']?></textarea></td>
                                </tr>
                                <tr>
                                    <td>2.	How a fraud could be carried out by either management or employees (special consideration should be given to accounting estimates);</td>
                                    <td><textarea class="form-control" cols="30" rows="3" name="dsfr2"><?= $td['dsfr2']?></textarea></td>
                                </tr>
                                <tr>
                                    <td>3.	How a fraud could be carried out by, or in conjunction with the entity’s related parties (including where transactions are not undertaken on an arm’s length basis);</td>
                                    <td><textarea class="form-control" cols="30" rows="3" name="dsfr3"><?= $td['dsfr3']?></textarea></td>
                                </tr>
                                <tr>
                                    <td>4.	How a fraud could be carried out by customers or suppliers;</td>
                                    <td><textarea class="form-control" cols="30" rows="3" name="dsfr4"><?= $td['dsfr4']?></textarea></td>
                                </tr>
                                <tr>
                                    <td>5.	What risk factors may be seen during the audit which could indicate fraudulent activity, including:
                                        <ul>
                                            <li>Pressure on management performance (e.g. targets set by holding companies, incentive schemes or banking covenants);</li>
                                            <li>Change in lifestyle or behavior of management or employees;</li>
                                            <li>Related party transactions which appear to have minimal commercial substance;</li>
                                            <li>Suppliers / customers with PO box addresses etc.;</li>
                                            <li>Allegations of fraud within the entity; or</li>
                                            <li>Management overriding key controls.</li>
                                        </ul>
                                    </td>
                                    <td><textarea class="form-control" cols="30" rows="3" name="dsfr5"><?= $td['dsfr5']?></textarea></td>
                                </tr>
                                <tr>
                                    <td>6.	What controls are in place in relation to cash (or assets that can be easily converted to cash) and the employees involved in this area;</td>
                                    <td><textarea class="form-control" cols="30" rows="3" name="dsfr6"><?= $td['dsfr6']?></textarea></td>
                                </tr>
                                <tr>
                                    <td>7.	Where consolidated financial statements are prepared the risk of fraud in subsidiaries, associates, joint ventures and during the consolidation process;</td>
                                    <td><textarea class="form-control" cols="30" rows="3" name="dsfr7"><?= $td['dsfr7']?></textarea></td>
                                </tr>
                                <tr>
                                    <td>8.	How any changes in senior management or shareholders during, or since the end of the period could cause a potential risk factor which needs to be approached with “professional skepticism”.</td>
                                    <td><textarea class="form-control" cols="30" rows="3" name="dsfr8"><?= $td['dsfr8']?></textarea></td>
                                </tr>
                                <tr>
                                    <td>9.	Which audit procedures will be used to respond to the susceptibility of the entity’s financial statements to material misstatement due to fraud? This may involve changing the nature, timing and extent of the audit procedures to be carried out.
                                        <ul>For example:
                                            <li>Performing substantive procedures on selected account balances and assertions not otherwise tested due to their materiality or risk;</li>
                                            <li>Adjusting the timing of audit procedures from that otherwise expected;</li>
                                            <li>Using different sampling methods;</li>
                                            <li>Altering the audit approach compared to the prior year;</li>
                                            <li>Use of data analytics to test for anomalies in a dataset;</li>
                                            <li>Performing audit procedures at different locations or at locations on an unannounced basis.</li>
                                        </ul>
                                    </td>
                                    <td><textarea class="form-control" cols="30" rows="3" name="dsfr9"><?= $td['dsfr9']?></textarea></td>
                                </tr>

                            </tbody>
                        </table>
                        <br><br><br><hr style="color: #7752FE;">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th colspan="1">Specific areas to be covered by the briefing:</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="1">Scope of discussion (add additional points as appropriate) ~ note that all points should be discussed, and key issues highlighted below:</td>
                                </tr>
                                <tr>
                                    <td>1.	All staff are aware of: </td>
                                    <td>Covered in discussion? (Yes/No)</td>
                                </tr>
                                <tr>
                                    <td><li>The need to report suspicions of money laundering internally, where required by legislation;</li></td>
                                    <td>
                                        <select name="sacb1yn1" id="" class="form-select">
                                            <option value="<?= $td['sacb1yn1']?>" selected><?= $td['sacb1yn1']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><li>That any issues (actual or possible), including matters relating to independence which, had they been known earlier, would have caused the firm to decline the appointment should be notified to the A.E.P. immediately;</li></td>
                                    <td>
                                        <select name="sacb1yn2" id="" class="form-select">
                                            <option value="<?= $td['sacb1yn2']?>" selected><?= $td['sacb1yn2']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><li>The main indicators for this client that the going concern assumption could be in doubt and if such issues are identified, these should be highlighted to the A.E.P. promptly;</li></td>
                                    <td>
                                        <select name="sacb1yn3" id="" class="form-select">
                                            <option value="<?= $td['sacb1yn3']?>" selected><?= $td['sacb1yn3']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><li>That if new related parties are identified, these must be communicated immediately to all members of the audit team;</li></td>
                                    <td>
                                        <select name="sacb1yn4" id="" class="form-select">
                                            <option value="<?= $td['sacb1yn4']?>" selected><?= $td['sacb1yn4']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2.	The responsibilities of team members;</td>
                                    <td>
                                        <select name="sacb2yn" id="" class="form-select">
                                            <option value="<?= $td['sacb2yn']?>" selected><?= $td['sacb2yn']?></option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="N/A">N/A</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3.	A detailed briefing regarding the client (including objectives, structure and activities);</td>
                                    <td><textarea class="form-control" cols="30" rows="3" name="sacb3"><?= $td['sacb3']?></textarea></td>
                                </tr>
                                <tr>
                                    <td>4.	The risk areas as identified from the risk assessment and how additional work on these areas are incorporated into the audit approach;</td>
                                    <td><textarea class="form-control" cols="30" rows="3" name="sacb4"><?= $td['sacb4']?></textarea></td>
                                </tr>
                                <tr>
                                    <td>5.	How can unpredictability be incorporated into the audit approach to maximize the chance of fraudulent transactions being identified (e.g., which procedure will involve random / haphazard testing etc.);</td>
                                    <td><textarea class="form-control" cols="30" rows="3" name="sacb5"><?= $td['sacb5']?></textarea></td>
                                </tr>
                                <tr>
                                    <td>6.	Timing of review procedures have been discussed and it has been documented who has responsibility to review which areas.</td>
                                    <td><textarea class="form-control" cols="30" rows="3" name="sacb6"><?= $td['sacb6']?></textarea></td>
                                </tr>
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-success m-1 btn-sm float-end"><i class="fas fa-file-alt m-1"></i>Save</button>
                    </form>
                    <br><br><br><hr style="color: #7752FE;">
                </div>
            </div>
        </div>
    </div>
</main>
