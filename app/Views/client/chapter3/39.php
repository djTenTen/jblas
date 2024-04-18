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
                

                <h4>ANALYTICAL REVIEW TECHNIQUES AND INTERPRETATIONS</h4>
                <h6>1. INTANGIBLE FIXED ASSETS (INCLUDING GOODWILL)</h6>
                <p>An increase in intangible fixed assets may be due to:</p>
                <ul>
                    <li>An acquisition (of a business or a subsidiary) during the period giving rise to goodwill or acquired intangibles</li>
                    <li>Capitalisation of deferred development costs or website costs</li>
                    <li>Purchase of intangible fixed assets</li>
                    <li>Revaluation of intangible fixed assets <i>(not allowed in respect of goodwill, and rarely appropriate regarding other fixed assets)</i></li>
                    <li>Write back of an impairment loss (not in respect of goodwill)</li>
                    <li>Items of a revenue nature being incorrectly capitalised</li>
                </ul>
                <p>A decrease in intangible fixed assets may be due to:</p>
                <ul>
                    <li>Impairment during the period</li>
                    <li>A change in accounting policy (for example, expensing development expenditure or website costs)</li>
                    <li>Amortisation in the period</li>
                    <li>Disposal of assets or sale of a subsidiary</li>
                </ul>
                <h6>Key Figures</h6>
                <ul>
                    <li>Additions and disposals as compared with previous periods and budgets</li>
                    <li>Adequacy of amortisation rates
                        <ul>
                            <li>average life of asset</li>
                            <li>industrial norms</li>
                        </ul>
                    </li>
                    <li>Assets yielding direct income
                        <ul>
                            <li>costs incurred</li>
                            <li>amortisation charge</li>
                            <li>income received</li>
                        </ul>
                    </li>
                </ul>

                <h6>2. PROPERTY, PLANT AND EQUIPMENT</h6>
                <p>An increase in property, plant and equipment may be due to:</p>
                <ul>
                    <li>Increase in business activity or automation giving rise to additions</li>
                    <li>Favourable tax rule (i.e. high temporary rates of capital allowance encouraging capital expenditure to be accelerated)</li>
                    <li>Assets acquired through the acquisition of a subsidiary or a business</li>
                    <li>Changes in capitalisation policy (reduction in de minimis limit or deciding to capitalise interest on self-constructed assets)</li>
                    <li>Assets acquired via finance leases as opposed to operating leases</li>
                    <li>Revaluation in the period</li>
                    <li>A write back of an impairment loss</li>
                    <li>Items of a revenue nature being incorrectly capitalised</li>
                </ul>
                
                <p>A decrease in fixed assets may be due to:</p>
                <ul>
                    <li>Disposal / scrapping of assets due to a business winding down / outsourcing / ceasing to be a going concern etc.</li>
                    <li>Changes in capitalisation policy (e.g. deciding not to capitalise interest on self-constructed assets)</li>
                    <li>Assets not being replaced in a recessionary environment</li>
                    <li>Assets acquired via operating leases rather than finance leases</li>
                    <li>An impairment loss being recognised</li>
                    <li>‘Normal’ depreciation, plus additional charges caused by reductions in the useful economic lives of assets or their residual value.</li>
                </ul>
                <h6>Key Figures</h6>
                <ul>
                    <li>Regarding revalued property price indices</li>
                    <li>Additions and disposals as compared with previous periods and budgets</li>
                    <li>Appropriateness of depreciation rates
                        <ul>
                            <li>average life of plant</li>
                            <li>average age of redundant plant</li>
                            <li>profit or loss on disposal</li>
                        </ul>
                    </li>
                    <li>Insurance cover</li>
                    <li>Assets yielding direct income
                        <ul>
                            <li>costs incurred</li>
                            <li>amortisation charge</li>
                            <li>income received</li>
                        </ul>
                    </li>
                </ul>


                <h6>3. INVESTMENTS</h6>
                <p>An increase in investments may be due to:</p>
                <ul>
                    <li>Purchases in the period</li>
                    <li>A capital contribution during the period</li>
                    <li>Increase in market value </li>
                    <li>Changes in value of unlisted investments due to the directors considering that fair value can now be determined</li>
                    <li>Write back of an impairment loss</li>
                    <li>Items of a revenue nature being incorrectly capitalised</li>
                </ul>
                <p>A decrease in investments may be due to:</p>
                <ul>
                    <li>Disposals during the period</li>
                    <li>Impairment losses</li>
                    <li>Decrease in market value</li>
                </ul>
                <h6>Key Figures</h6>
                <ul>
                    <li>Additions and disposals as compared with previous periods and budgets</li>
                    <li>Income compared to market value</li>
                    <li>Change in stock market indices (Dow Jones / Nikkei / FTSE etc.)</li>
                    <li>Value of unlisted investment in relation to the EBITDA of the companies in which the investments are held</li>
                </ul>


                <h6>4. INVENTORY</h6>
                <p>An increase in inventory could be due to:</p>
                <ul>
                    <li>Change in purchasing policy (for example to obtain bulk discounts)</li>
                    <li>A decrease in sales</li>
                    <li>Change in capitalisation policy so that where relevant, finance costs are ‘capitalised’</li>
                    <li>Costs being charged to inventory which should have been written-off to an expense account</li>
                    <li>Increased purchase costs due to inflation or adverse movements in exchange rates etc.</li>
                    <li>Cut-off errors</li>
                </ul>
                <p>A fall in stock levels / a rise in inventory turnover could be due to:</p>
                <ul>
                    <li>Improved inventory control (i.e. just in time purchasing)</li>
                    <li>An increase in sales</li>
                    <li>Decreased purchase cost due to deflation or favourable movements in exchange rates etc.</li>
                    <li>Change in accounting policy</li>
                    <li>Omission of items from inventory</li>
                    <li>Cut-off errors</li>
                    <li>Inventory write-off and provisions</li>
                </ul>
                <p>High level of inventory write-off may indicate:</p>
                <ul>
                    <li>Poor physical inventory management</li>
                    <li>Pilferage</li>
                    <li>Unrecorded sales</li>
                    <li>Poor market conditions</li>
                    <li>High degree of perishable / high fashion items</li>
                </ul>
                <h6>Key Figures</h6>
                <ul>
                    <li>Inventory volume changes</li>
                    <li>Actual inventory value changes</li>
                    <li>Changes in unit inventory prices</li>
                    <li>Theoretical inventory changes (prior period actual inventory adjusted for volume and price changes)</li>
                    <li>Provisions</li>
                    <li>Production standards</li>
                    <li>Percentage of material, labour and production overheads in production costs</li>
                    <li>Material usage and scrap material</li>
                    <li>Labour costs and hours</li>
                    <li>Overheads incurred and allocated</li>
                    <li>Level of returns (especially immediately after the period-end)</li>
                    <li>Inventory turnover</li>
                </ul>


                <h6>5. TRADE RECEIVABLES</h6>
                <p>An increase in receivables may be due to:</p>
                <ul>
                    <li>An increase in turnover / trading activity</li>
                    <li>Favourable exchange rate movements</li>
                    <li>A deterioration in the economic climate</li>
                    <li>A deterioration in the client's credit control or debt collection procedures</li>
                    <li>Sales to fictitious customers to increase reported profits</li>
                    <li>Unrecorded receipts from customers, delays in recording of banking receipts or teeming and lading</li>
                    <li>Cut-off errors</li>
                    <li>Artificial inflation of sales by pre-recording next period’s sales (window dressing)</li>
                </ul>
                <p>A decrease in the level of receivables may be due to:</p>
                <ul>
                    <li>A decrease in turnover / trading activity</li>
                    <li>Unfavourable exchange rate movements</li>
                    <li>Stricter credit control procedures</li>
                    <li>Sales being reduced by delays in issuing invoices</li>
                    <li>Cut-off errors</li>
                    <li>Customers’ receipts from the next period being recorded in the current period</li>
                </ul>
                <p>An increase in irrecoverable receivables may be due to:</p>
                <ul>
                    <li>Poor economic conditions</li>
                    <li>Lax credit control</li>
                    <li>Amounts written off prematurely</li>
                    <li>Fictitious sales being ‘reversed’</li>
                    <li>Fraud (i.e. writing-off receivables that have actually been paid where the money has been misappropriated)</li>
                </ul>
                <h6>Key Figures</h6>
                <ul>
                    <li>Level of receivables</li>
                    <li>Level of irrecoverable receivables</li>
                </ul>
                <h6>Key Figures</h6>
                <ul>
                    <li>Changes in aged receivables analysis</li>
                    <li>Receivables days</li>
                    <li>Irrecoverable receivables written-off as a percentage of sales</li>
                    <li>Money owed by key customers</li>
                </ul>


                <h6>6. CASH AT BANK AND IN HAND</h6>
                <p>An increase in bank and cash balances could be due to:</p>
                <ul>
                    <li>An increase in turnover / trading activity</li>
                    <li>Improved credit control</li>
                    <li>Customer receipts from next period being recorded in the current period</li>
                    <li>One-off receipts</li>
                    <li>A decrease in purchases / inventory levels held</li>
                    <li>Management decision to delay payment of suppliers</li>
                    <li>Payments made shortly before the period-end being recorded in the subsequent period</li>
                    <li>Realising investments</li>
                    <li>An increase in financing</li>
                </ul>
                <p>A decrease in bank and cash balances could be due to:</p>
                <ul>
                    <li>A decrease in turnover / trading activity</li>
                    <li>Irrecoverable receivables problems</li>
                    <li>One-off payments</li>
                    <li>Increased inventory levels</li>
                    <li>Acceleration of payment of payables</li>
                    <li>Cheques being recorded in the cash book but withheld</li>
                    <li>Purchasing of property, plant and equipment or investments</li>
                    <li>A decrease in financing</li>
                </ul>
                <h6>Key Figures</h6>
                <ul>
                    <li>Actual movements of cash compared to budgeted cash flows</li>
                    <li>Level of unusual / one-off cash disbursements</li>
                    <li>Available bank facilities</li>
                    <li>Interest received / paid compared to average balance</li>
                </ul>



                <h6>7. TRADE PAYABLES</h6>
                <p>An increase in payables could be due to:</p>
                <ul>
                    <li>An increase in purchase / trading activity</li>
                    <li>Management decision to delay payment</li>
                    <li>Adverse movements in exchange rates</li>
                    <li>Difficulty in paying liabilities as they fall due</li>
                    <li>Build-up of inventories</li>
                    <li>Cut-off errors</li>
                    <li>Payments made shortly before the period-end being recorded in the subsequent period to inflate cash balances (i.e. window dressing)</li>
                </ul>
                <p>A decrease in creditors could be due to:</p>
                <ul>
                    <li>A decrease in purchases / trading activity</li>
                    <li>Favourable movement in exchange rates</li>
                    <li>Acceleration of payment of payables</li>
                    <li>Omission of items</li>
                    <li>Cut-off errors</li>
                    <li>Cheques being recorded in the cash book but withheld</li>
                </ul>
                <h6>Key Figures</h6>
                <ul>
                    <li>Level of payables</li>
                    <li>Payables to inventory</li>
                    <li>Monies owed to major suppliers</li>
                    <li>Payables days</li>
                </ul>



                <h6>8. REVENUE</h6>
                <p>Key factors to consider are:</p>
                <ul>
                    <li>Sales volume changes</li>
                    <li>Sales price changes</li>
                    <li>Sales mix changes</li>
                    <li>Theoretical turnover changes (prior period sales adjusted by volume and price)</li>
                    <li>Monthly pattern of turnover</li>
                    <li>Industry conditions</li>
                    <li>Goods returned or discounts</li>
                </ul>



                <h6>9. EXPENSES</h6>
                <p>Key factors to consider are:</p>
                <ul>
                    <li>Purchase volume changes</li>
                    <li>Purchase price changes</li>
                    <li>Purchase mix changes</li>
                    <li>Theoretical purchase changes</li>
                    <li>Monthly pattern of purchases</li>
                </ul>




                <h6>10. GROSS PROFIT</h6>
                <p>Possible causes of changes could include changes in:</p>
                <ul>
                    <li>Selling price</li>
                    <li>Product mix</li>
                    <li>Cost price</li>
                    <li>Allocation of expense items</li>
                    <li>Under or over-valuation of inventory and work-in-progress</li>
                </ul>
                <p>Gross profit margin should be disaggregated in as many ways as possible. These could include:</p>
                <ul>
                    <li>Weeks, months or quarter (particularly around the period-end)</li>
                    <li>Geographical area</li>
                    <li>Business activity or division</li>
                </ul>


                

                <h6>11. PAYROLL COSTS</h6>
                <ul>
                    <li>Changes in payroll levels of different grades</li>
                    <li>Activity
                        <ul>
                            <li>average payroll cost per employee</li>
                            <li>bonuses and commissions</li>
                            <li>overtime</li>
                        </ul>
                    </li>
                    <li>Efficiency
                        <ul>
                            <li>changes in productivity of employees</li>
                            <li>profits per employee</li>
                            <li>revenue per employer</li>
                            <li>payroll deductions compared with remuneration for period</li>
                        </ul>
                    </li>
                </ul>



                <h6>12. OTHER PERFORMANCE STATEMENT CATEGORIES</h6>
                <p>Points to consider include:</p>
                <ul>
                    <li>Distribution costs as % of revenue</li>
                    <li>Consistency of property lease expense and property taxes, with property</li>
                    <li>Income from sub-let premises to rent paid for premises</li>
                    <li>Insurance premiums</li>
                    <li>Repairs compared with amounts capitalised</li>
                    <li>Vehicle running expenses to number of vehicles and miles</li>
                    <li>Signs of future commitments</li>
                    <li>Signs of future commitments</li>
                </ul>



                <h6>13. KEY BUSINESS RATIOS</h6>
                <p>There are four main categories as follows:</p>
                <ul>
                    <li>Profitability and Returns</li>
                    <li>Activity</li>
                    <li>Liquidity</li>
                    <li>Solvency</li>
                </ul>



                <h6>13.1	PROFITABILITY AND RETURNS</h6>
                <table class="table table-bordered">
                    <tr>
                        <td><h6>Gross Profit Margin</h6></td>
                        <td>Gross profit x 100% Revenue</td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <p>This ratio indicates the contribution of the company's trading activities to profitability.  A change may indicate: </p>
                            <ul>
                                <li>a company's inability to pass on increasing costs by raising prices;</li>
                                <li>changes in cost of sales price to sales price per unit;</li>
                                <li>changes in the sales mix; or</li>
                                <li>changes in manufacturing efficiencies.</li>
                            </ul>
                        </td>
                    </tr>
                </table>


                <table class="table table-bordered">
                    <tr>
                        <td><h6>Net Profit Margin</h6></td>
                        <td>Gross profit x 100% Revenue</td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <p>This shows the profit earned per sale.  A low level may indicate vulnerability to changing market conditions.</p>
                            <p>NB: Financial income and expenditure should also be excluded from the calculation of the net profit margin, otherwise this ratio will be polluted by changes in the fair value of investment properties and financial instruments.</p>
                        </td>
                    </tr>
                </table>


                <table class="table table-bordered">
                    <tr>
                        <td><h6>Shareholders’ Return</h6></td>
                        <td>Gross profit x 100% Revenue</td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <p>The higher this ratio, the better the return to shareholders.</p>
                            <p>NB: Financial income and expenditure should be included in the calculation of the net profit margin, as changes in the value of investment properties and financial instrument is relevant to shareholders.</p>
                        </td>
                    </tr>
                </table>





                <table class="table table-bordered">
                    <tr>
                        <td><h6>Return on Capital Employed (ROCE)</h6></td>
                        <td>Profit Before Tax x 100%
                        Total Assets Less Current Liabilities
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <p>A low % indicates a low return on the funds employed in the business and, hence, possible going concern problems.</p>
                        </td>
                    </tr>
                </table>






                <table class="table table-bordered">
                    <tr>
                        <td><h6>Interest Cover</h6></td>
                        <td>Profit Before Interest and Tax Interest Payable</td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <p>This shows the extent to which profits are used to pay interest.</p>
                            <p>NB:  Interest payable should exclude the unwinding of discounts on provisions and also interest charges generated by accounting for long-term interest free inter-company loans on an amortised cost basis.</p>
                        </td>
                    </tr>
                </table>




                <table class="table table-bordered">
                    <tr>
                        <td><h6>Interest Cover</h6></td>
                        <td>Profit Before Interest and Tax Interest Payable</td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <p>This shows the extent to which profits are used to pay interest.</p>
                            <p>NB:  Interest payable should exclude the unwinding of discounts on provisions and also interest charges generated by accounting for long-term interest free inter-company loans on an amortised cost basis.</p>
                        </td>
                    </tr>
                </table>




                <h6>13.2	ACTIVITY</h6>
                <table class="table table-bordered">
                    <tr>
                        <td><h6>Inventory Turnover</h6></td>
                        <td>Cost of Sales Average Inventory</td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <p>This ratio indicates the speed inventory is moving.  A low figure could indicate excessive levels, obsolete and slow-moving inventory, and could mean high storage and finance costs.  A high figure may indicate efficient inventory management but may also indicate insufficient supplies (and, hence, lost sales or loss of client goodwill), or excessive markdown.</p>
                        </td>
                    </tr>
                </table>


                <table class="table table-bordered">
                    <tr>
                        <td><h6>Receivables Days</h6></td>
                        <td>Trade Receivables x 365 Revenue</td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <p>A long period may indicate potential cash flow and working capital problems, bad and irrecoverable receivables problems, or inefficient credit control procedures.  Comparisons should be made to industry norms and the company's credit terms.</p>
                        </td>
                    </tr>
                </table>


                <table class="table table-bordered">
                    <tr>
                        <td><h6>Payables Days</h6></td>
                        <td>Trade Payables x 365 Direct Costs</td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <p>This ratio shows the client's payment patterns to suppliers.  A high number may indicate a policy of slow payment and using suppliers to help finance operations and, hence, possible liquidity problems.</p>
                        </td>
                    </tr>
                </table>


                <h6>13.3	LIQUIDITY</h6>
                <table class="table table-bordered">
                    <tr>
                        <td><h6>Acid Test / Quick Ratio</h6></td>
                        <td>Current Assets (Excluding Inventory) Current Liabilities </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <p>This ratio indicates the company's immediate liquidity position, i.e. how likely creditors are to be paid promptly.  It should normally exceed 1.  This is an appropriate ratio where inventory is not very liquid.</p>
                        </td>
                    </tr>
                </table>

                <table class="table table-bordered">
                    <tr>
                        <td><h6>Current Ratio</h6></td>
                        <td>Current Assets Current Liabilities</td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <p>This indicates the likelihood payments to payables can be met.  This is an appropriate ratio where stock is very liquid.</p>
                        </td>
                    </tr>
                </table>


                <table class="table table-bordered">
                    <tr>
                        <td><h6>Gearing</h6></td>
                        <td>Total Non-Shareholder Liabilities x 100%
                        Equity 1

                        1 = including those classified as debt under        IAS 32
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <p>This ratio shows the extent to which the company is financed by payables and debt rather than equity finance.  High ratios may mean debt is a burden and the company may have difficulty borrowing further in these circumstances.</p>
                        </td>
                    </tr>
                </table>


                <table class="table table-bordered">
                    <tr>
                        <td><h6>Non-Current Assets : Long-Term Liabilities</h6></td>
                        <td>Non-Current Assets : Long-Term Liabilities</td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <p>This indicates the extent to which long-term finance is used for non-current assets.  A high score together with significant current liabilities may indicate non-current assets being financed out of current liabilities which could be a sign of going concern difficulties.</p>
                        </td>
                    </tr>
                </table>


                <table class="table table-bordered">
                    <tr>
                        <td><h6>Non-Current Assets : Equity</h6></td>
                        <td>Non-Current Assets x 100% Equity </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <p>A company may be under-capitalised if non-current assets exceed equity.  If non-current assets are lower, the company could be over-capitalised and, hence, in a position to expand.</p>
                        </td>
                    </tr>
                </table>


                <table class="table table-bordered">
                    <tr>
                        <td><h6>Current Liabilities : Equity</h6></td>
                        <td>Current Liabilities x 100% Equity </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <p>This contrasts the funds short-term creditors have placed with the company with the funds invested by the owners.  The higher the ratio, the less the creditors' security.</p>
                        </td>
                    </tr>
                </table>





           
            </div>
        </div>
    </div>
    
</main>








