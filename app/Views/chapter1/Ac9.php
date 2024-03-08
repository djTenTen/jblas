
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
            
            <div class="card-body">
                <h4>CONSIDERATION OF SPECIFIC SKILLS REQUIRED FOR THIS ASSIGNMENT </h4>
                <h6>(SHOULD COVER ALL MEMBERS OF THE TEAM OTHER THAN JUNIORS, INCLUDING THE EQR)</h6>
                <textarea class="form-control" cols="30" rows="20" name="question[]"></textarea>

                <br>

                <h4>APPROVAL OF PLANNING</h4>
                <p>The following have all been reviewed prior to the team discussions being held and the detailed audit fieldwork commencing, and this has been documented by myself as A.E.P.:</p>
                <ul>
                    <li>Acceptance or Continuance;</li>
                    <li>Consideration of Non-Audit Services (where applicable);</li>
                    <li>Assessment of Overall Inherent Risk and the Control Environment;</li>
                    <li>Assessment of Risk in Individual Audit Areas; and</li>
                    <li>Determination of Materiality and Performance Materiality levels.</li>
                </ul>

                <p>Additionally, audit programmes of the working papers file have been reviewed, and I am satisfied that tailoring of these audit programmes is appropriate for the purpose of this audit.</p>

                <p>Planning approved by:______________(A.E.P.) on___________</p>

                <h4>APPROVAL OF PLANNING BY INTERNAL EQR (IF APPLICABLE)</h4>
                <p>I have reviewed, and this has been documented by myself as E.Q.R., the Acceptance or Continuance Form.  I have also reviewed the remaining documents set out in the bullet points above, along with this Assignment Plan, and additionally, the following:</p>
                    <ul>
                        <li><input type="text" class="form-control"></li>
                        <li><input type="text" class="form-control"></li>
                    </ul>


                <p>I am satisfied that the proposed audit approach is appropriate for the purpose of this audit.</p>
                <p>Planning approved by:______________(A.E.P.) on___________</p>

                <br>

                <table class="table table-bordered">
                    <tr>
                        <td>
                            <h4>BACKGROUND INFORMATION</h4>
                            <p>Detailed background information is included in the permanent file, the below information is just a short executive summary.</p>
                            <p>The entity is a company [other: insert details].</p>
                            <p>The principal activities of the entity are [ <input type="text" class="form-control"> ]</p>
                            <p>The business objectives and strategies of the entity are  [ <input type="text" class="form-control"> ]</p>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <h4>SIGNIFICANT FACTORS FROM PREVIOUS AUDIT AND IMPACT ON THIS PERIOD’S AUDIT </h4>
                            <ul>
                                <li>Last period’s financial statements have been compared to this period’s, as part of the preliminary analytical procedures;</li>
                                <li>If applicable, the findings of recent cold file reviews have been addressed by the planning documentation; and</li>
                                <li>If applicable, last period’s management letter points have been reviewed and any points have been considered during this period’s risk assessment and audit approach.</li>
                            </ul>
                            <textarea class="form-control" cols="30" rows="20" name="question[]" placeholder="This should not repeat information included elsewhere."></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <h4>SUMMARY OF SIGNIFICANT DEVELOPMENTS DURING THE PERIOD</h4>
                            <h6>(consideration should be given to any changes in the financial reporting framework used, as well as client specific developments.  The findings from the review of the previous audit file, PAF and other internal files such as the correspondence file, management accounts files, payroll files etc. should all be summarised)</h6>
                            <textarea class="form-control" cols="30" rows="20" name="question[]" placeholder="This should not repeat information included elsewhere."></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h4>KEY LAW AND REGULATIONS</h4>
                            <textarea class="form-control" cols="30" rows="20" name="question[]" placeholder="This should be an “Executive Summary”"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h4>RELATED PARTY ISSUES (Consideration should be given to any new related parties which have been identified, significant related party transactions and transfer pricing issues)</h4>
                            <textarea class="form-control" cols="30" rows="20" name="question[]" placeholder="This should be an “Executive Summary”."></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h4>SERVICE ORGANISATION AND EXPERTS </h4>
                            <h6>(Consideration should be given to whether any of the figures in the financial statements are derived from the records of a service organisation or from an expert (such as a valuation service).  Where this is a case, document the audit team’s approach to these areas)</h6>
                            <textarea class="form-control" cols="30" rows="20" name="question[]"></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <h4>AUDIT APPROACH</h4>
                            <p>This section should fully document the approach to be undertaken based on preliminary analytical procedures, client discussions and the risk and control environment assessments.  </p>
                            <p>Adequate consideration has been given to experts and service organisations.</p>
                            <p>The audit programmes to be used and key points arising during the planning are summarised below, as are the responsibilities of each team member regarding which work they are going to undertake.</p>
                            <textarea class="form-control" cols="30" rows="20" name="question[]"></textarea>
                            <p>Have the points raised above (and the risks identified in the risk assessment) been duly considered and the audit programmes sufficiently tailored to reflect these issues?</p>
                            <textarea class="form-control" cols="30" rows="20" name="question[]"></textarea>
                        </td>
                    </tr>

                </table>

                <br>

                <table class="table table-bordered">
                    <tr>
                        <td><h4>IS THE FINANCIAL REPORTING FRAMEWORK APPROPRIATE FOR THE ENTITY, BASED ON IT’S CIRCUMSTANCES</h4></td>
                        <td><h4>YES / NO</h4></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <p>If “no”, or the entity has changed its financial reporting framework, explain why the entity will be preparing financial statements on the basis indicated above:</p>
                            <textarea class="form-control" cols="30" rows="20" name="question[]"></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td><h4>ARE THERE ANY OTHER REPORTING REQUIREMENTS (SUCH AS TO A PARENT AUDITOR OR REGULATOR)</h4></td>
                        <td><h4>YES / NO</h4></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <p>If “yes”, explain what these are, and the impact this will have on the scope / timing of audit work on the statutory financial statements:</p>
                            <textarea class="form-control" cols="30" rows="20" name="question[]"></textarea>
                        </td>
                    </tr>
                
                </table>

                <br>
                <h4>TAX SCHEDULES REQUIRED (THESE SHOULD ONLY BE PREPARED WHERE IT HAS BEEN AGREED THAT A NON-AUDIT SERVICE IS BEING PROVIDED)</h4>
                <textarea class="form-control" cols="30" rows="20" name="question[]"></textarea>

                <br>
                
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ASSIGNMENT TIMETABLE</th>
                            <th>DATES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Client Pre-Planning Meeting</td>
                            <td><input type="date" name="" id="" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Inventory Count (irrespective of whether undertaken by client or 3rd party professional)</td>
                            <td><input type="date" name="" id="" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Audit Fieldwork</td>
                            <td><input type="date" name="" id="" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Client Closing Meeting</td>
                            <td><input type="date" name="" id="" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Annual General Meeting / Date of Distribution of Financial Statements to Members</td>
                            <td><input type="date" name="" id="" class="form-control"></td>
                        </tr>
                    </tbody>
                </table>


                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>THIRD PARTY AND COUNTER PARTY CONFIRMATIONS</th>
                            <th>REQUIRED</th>
                            <th>DATE REQUESTED</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Bank Confirmation Letter</td>
                            <td><input type="text" name="" id="" class="form-control"></td>
                            <td><input type="date" name="" id="" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Independent Inventory Counter’s Report</td>
                            <td><input type="text" name="" id="" class="form-control"></td>
                            <td><input type="date" name="" id="" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Receivables’ Circularisation</td>
                            <td><input type="text" name="" id="" class="form-control"></td>
                            <td><input type="date" name="" id="" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Type 2 Report</td>
                            <td><input type="text" name="" id="" class="form-control"></td>
                            <td><input type="date" name="" id="" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Property Valuations</td>
                            <td><input type="text" name="" id="" class="form-control"></td>
                            <td><input type="date" name="" id="" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Valuations of Financial Instruments</td>
                            <td><input type="text" name="" id="" class="form-control"></td>
                            <td><input type="date" name="" id="" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Actuarial Valuations</td>
                            <td><input type="text" name="" id="" class="form-control"></td>
                            <td><input type="date" name="" id="" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Legal Opinions</td>
                            <td><input type="text" name="" id="" class="form-control"></td>
                            <td><input type="date" name="" id="" class="form-control"></td>
                        </tr>
                    </tbody>
                </table>







            </div>
        </div>
    </div>
    
</main>
