
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
              

            <h4>ASSESSMENT OF MATERIALITY (INCLUDING PERFORMANCE MATERIALITY)</h4>

            <p>OBJECTIVE: To assess materiality for the financial statements as a whole, performance materiality and other quantitative benchmarks based on materiality, which will reduce the risk of material misstatements in the financial statements to an acceptable level.</p>

            <h4>OVERALL MATERIALITY</h4>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Benchmarks</th>
                        <th>Planning 3</th>
                        <th>Finalisation</th>
                        <th>%</th>
                        <th>Planning CU</th>
                        <th>Finalisation CU</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Revenue</td>
                        <td><input type="number" class="form-control"></td>
                        <td><input type="number" class="form-control"></td>
                        <td>1%</td>
                        <td><input type="number" class="form-control" readonly></td>
                        <td><input type="number" class="form-control" readonly></td>
                    </tr>
                    <tr>
                        <td>Profit Before Tax 2</td>
                        <td><input type="number" class="form-control"></td>
                        <td><input type="number" class="form-control"></td>
                        <td>10%</td>
                        <td><input type="number" class="form-control" readonly></td>
                        <td><input type="number" class="form-control" readonly></td>
                    </tr>
                    <tr>
                        <td>Gross Assets</td>
                        <td><input type="number" class="form-control"></td>
                        <td><input type="number" class="form-control"></td>
                        <td>2%</td>
                        <td><input type="number" class="form-control" readonly></td>
                        <td><input type="number" class="form-control" readonly></td>
                    </tr>
                    <tr>
                        <td colspan="4">Select the most appropriate benchmark for this entity</td>
                        <td>
                            <select name="" id="" class="form-control">
                                <option value="" selected>Select from Planning</option>
                                <option value="Revenue">Revenue</option>
                                <option value="Profit Before Tax">Profit Before Tax</option>
                                <option value="Gross Assets">Gross Assets</option>
                                <option value="Something Else">Something Else</option>
                            </select>
                        </td>
                        <td>
                            <select name="" id="" class="form-control">
                                <option value="" selected>Select from Finalisation</option>
                                <option value="Revenue">Revenue</option>
                                <option value="Profit Before Tax">Profit Before Tax</option>
                                <option value="Gross Assets">Gross Assets</option>
                                <option value="Something Else">Something Else</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5"><h6>JUSTIFY THE USE OF THE BENCHMARK SELECTED ABOVE (Notes 4 and 5) </h6></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="6"> <textarea class="form-control" cols="30" rows="5" name="question[]"></textarea></td>
                    </tr>

                    <tr>
                        <td colspan="4"><h6>Initial suggested Materiality Level:</h6></td>
                        <td><input type="number" class="form-control" readonly></td>
                        <td><input type="number" class="form-control" readonly></td>
                    </tr>
                    <tr>
                        <td colspan="4"><p>If any adjustments are required to initial materiality level, detail these here (Note 6) :</p></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="4"><p>A.<input type="text" class="form-control"></p></td>
                        <td><input type="number" class="form-control"></td>
                        <td><input type="number" class="form-control"></td>
                    </tr>
                    <tr>
                        <td colspan="4"><p>B. <input type="text" class="form-control"></p></td>
                        <td><input type="number" class="form-control"></td>
                        <td><input type="number" class="form-control"></td>
                    </tr>
                    <tr>
                        <td colspan="4"><p>C. <input type="text" class="form-control"></p></td>
                        <td><input type="number" class="form-control"></td>
                        <td><input type="number" class="form-control"></td>
                    </tr>
                    <tr>
                        <td colspan="6"><p>NB: adjustments need to be mutiplied by the appropriate benchmark percentage</p></td>      
                    </tr>
                    <tr>
                        <td colspan="4"><h6>Assessed Overall Materiality</h6></td>
                        <td><input type="number" class="form-control" readonly></td>
                        <td><input type="number" class="form-control" readonly></td>     
                    </tr>
                    <tr>
                        <td colspan="4"><p>Materiality Level for previous period (for information only):</p></td>
                        <td><input type="number" class="form-control"></td>
                        <td></td> 
                    </tr>
                    <tr>
                        <td colspan="6"><h6>Conclusion at planning stage</h6></td>
                    </tr>
                    <tr>
                        <td colspan="6"><p>The overall materiality level calculated above is deemed to be appropriate because:</p></td>
                    </tr>
                    <tr>
                        <td colspan="6"> <textarea class="form-control" cols="30" rows="5" name="question[]"></textarea></td>
                    </tr>

                    <tr>
                        <td colspan="6">
                            <h6>Conclusion at finalisation stage</h6>
                            <p>Document reasons for any revision to the materiality assessed at planning stage and the impact on the audit procedures undertaken:</p>
                            <textarea class="form-control" cols="30" rows="5" name="question[]"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6"><h4>PERFORMANCE MATERIALITY</h4></td>
                    </tr>
                    <tr>
                        <td colspan="4">Select Overall Inherent Risk (Low / Medium / High):</td>
                        <td>
                            <select name="" id="" class="form-control">
                                <option value="" selected>Select Inherent</option>
                                <option value="Low">Low</option>
                                <option value="Medium">Medium</option>
                                <option value="High">High</option>
                            </select>
                        </td>
                        <td>
                            <select name="" id="" class="form-control">
                                <option value="" selected>Select Inherent</option>
                                <option value="Low">Low</option>
                                <option value="Medium">Medium</option>
                                <option value="High">High</option>
                            </select>
                        </td> 
                    </tr>
                    <tr>
                        <td colspan="4">Performance Materiality Percentage (Note 7):</td>
                        <td><input type="number" class="form-control" readonly></td>
                        <td><input type="number" class="form-control" readonly></td> 
                    </tr>

                    <tr>
                        <td colspan="4">Assessed Performance Materiality</td>
                        <td><input type="number" class="form-control" readonly></td>
                        <td><input type="number" class="form-control" readonly></td> 
                    </tr>

                    <tr>
                        <td colspan="6">
                            <h6>Conclusion at planning stage</h6>
                            <p>The performance materiality level calculated above is deemed to be appropriate because:</p>
                            <textarea class="form-control" cols="30" rows="5" name="question[]"></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="6"><h4>PERFORMANCE MATERIALITY</h4></td>
                    </tr>
                    <tr>
                        <td colspan="3">Level at which errors are considered trivial (Note 8)</td>
                        <td>1%</td>
                        <td><input type="number" class="form-control"></td>
                        <td><input type="number" class="form-control"></td> 
                    </tr>

                    <tr>
                        <td colspan="6">
                            <h6>Document reasons for any revision to the suggested percentage </h6>
                            <textarea class="form-control" cols="30" rows="5" name="question[]"></textarea>
                        </td>
                    </tr>

                    <tr>

                        <td colspan="6">
                            <h6>SPECIFIC PERFORMANCE MATERIALITY LEVELS FOR CLASSES OF TRANSACTIONS, ACCOUNT BALANCES OR DISCLOSURES (Notes 9 and 10):</h6>
                            <p>Factors that may indicate the existence of one or more particular classes of transactions, account balances or disclosures for which a lower level of materiality should be applied include the following:</p>
                            
                            <ul>
                                <li>Related party transactions and compensation of key management personnel;</li>
                                <li>Key disclosures in relation to the industry in which the entity operates;</li>
                                <li>Particular focus on specific disclosures (such as business combinations);</li>
                                <li>Accounting estimates.</li>
                            </ul>
                            <p>Document below the materiality levels to be applied to the relevant classes of transactions, account balances or disclosures. </p>
                            <p>The auditor may find it useful to get the views and expectations of the client here.</p>
                        </td>

                    </tr>
                    <tr>
                        <td colspan="6"><h6>Other levels of performance materiality to be applied:</h6></td>
                    </tr>
                    <tr>
                        <td colspan="3">Related party transactions and Remuneration of key management</td>
                        <td>5%</td>
                        <td><input type="number" class="form-control" readonly></td>
                        <td><input type="number" class="form-control" readonly></td> 
                    </tr>
                    <tr>
                        <td colspan="3">Accounting estimates</td>
                        <td></td>
                        <td><input type="number" class="form-control" readonly></td>
                        <td><input type="number" class="form-control" readonly></td> 
                    </tr>
                    <tr>
                        <td colspan="3">[Insert transactions, balances, disclosures or accounting estimates]</td>
                        <td><input type="number" class="form-control"></td>
                        <td><input type="number" class="form-control" readonly></td>
                        <td><input type="number" class="form-control" readonly></td> 
                    </tr>
                    <tr>
                        <td colspan="3">[Insert transactions, balances, disclosures or accounting estimates]</td>
                        <td><input type="number" class="form-control"></td>
                        <td><input type="number" class="form-control" readonly></td>
                        <td><input type="number" class="form-control" readonly></td> 
                    </tr>
                    <tr>
                        <td colspan="3">[Insert transactions, balances, disclosures or accounting estimates]</td>
                        <td><input type="number" class="form-control"></td>
                        <td><input type="number" class="form-control" readonly></td>
                        <td><input type="number" class="form-control" readonly></td> 
                    </tr>

                    <tr>
                        <td colspan="6">
                            <h6>Definition per PSA 320.9:</h6>
                            <p>Performance materiality - For the purposes of the ISAs, performance materiality means the amount or amounts set by the auditor at less than materiality for the financial statements as a whole to reduce to an acceptably low level the probability that the aggregate of uncorrected and undetected misstatements exceeds materiality for the financial statements as a whole.  If applicable, performance materiality also refers to the amount or amounts set by the auditor at less than the materiality level or levels for particular classes of transactions, account balances or disclosures.</p>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="6">
                            <h6>Guidance and Notes:</h6>
                            <p>1. Blue cells require user input</p>
                            <p>2. Use absolute figures (i.e. if there is a loss before tax, use this as a positive figure)</p>
                            <p>3. At the planning stage use management accounts, flexed budgets or last period's figures if current figures are not available.</p>
                            <p>4. The auditor must document the factors considered in the determination of materiality as a whole, performance materiality and, if applicable, the materiality level(s) for particular classes of transactions, account balances or disclosures. The determining of materiality involves the use of professional judgement, therefore the auditor must be able to justify the chosen benchmark used as a starting point in determining materiality. See PSA 320.A3 for guidance. </p>
                            <p>For example: for a trading company where the Directors are focused on profit, profit before tax may be the most relevant benchmark to use. For an investment property company, it is likely that the gross assets figure would be the most appropriate benchmark. For service companies, cost-plus entities or not-for-profit entities, it is likely that revenue will be the most appropriate benchmark.</p>
                            <p>If the most relevant benchmark for an entity is volatile year on year, such that using that benchmark would result in incomparable materiality figures year on year, other benchmarks may be considered to be more appropriate.</p>
                            <p>5. The percentages applied to a chosen benchmark are also a matter of professional judgement. If the suggested percentages noted above are inappropriate, amend them as necessary.</p>
                            <p>6. Adjust for any anomalies that may affect materiality.  For example, for an owner-managed business where the owner takes much of the profit before tax in the form of remuneration, "adding back" the owner's remuneration to the profit before taxation figure would provide a more relevant benchmark to be used in the materiality calculation.</p>
                            <p>7. It is recommended that a level of 75% of audit materiality is used to determine performance materiality when overall inherent risk is low, 62.5% when overall inherent risk is medium and 50% when overall inherent risk is high (see definition above).  Percentages </p>
                            <p>8. "Clearly trivial"  errors do not need to be accumulated.  These items are clearly inconsequential, whether taken individually or in aggregate, whether judged by size, nature or circumstances.  It is suggested that 1% of audit materiality is used to determine a level at which items are deemed to be clearly trivial, but a different percentage can be used if deemed to be more appropriate and is adequately justified.  </p>
                            <p>However, misstatements relating to amounts may not be clearly trivial when judged on criteria of nature or circumstance. If this is the case, the misstatements should be accumulated as unadjusted errors.</p>
                            <p>9. For "sensitive" disclosures, such as those relating to share capital, directors' remuneration and related party transactions, amounts which are disclosed in the financial statements should be correct.  It is recommended that that "allowable misstatements" relating to any related party matter are set at 5% of audit materiality.  It is permissible for different thresholds may be set, but these should be appropriate in the context.  Additional thresholds may also be set for other classes of transactions, account balances or disclosures, which should be fully documented, but may not exceed the level of performance materiality.  In each case, the percentage of audit materiality applied should be stated.</p>
                            <p>10. The accuracy of accounting estimates needs to be established.  Estimates are "soft" figures in financial statements, and as such, have a level of risk attached to them.  The level of estimation uncertainty for accounting estimates should be documented and should be set at a level lower than performance materiality.</p>
                            <p>11. Document reasons for not using a materiality level based on the amounts calculated, reasons for setting different levels for individual items in the financial statements and reasons why the final materiality level differs from the planning materiality level.</p>
                        </td>
                    </tr>
                    
                    
                </tbody>
            </table>

            
            

            </div>
        </div>
    </div>
    
</main>
