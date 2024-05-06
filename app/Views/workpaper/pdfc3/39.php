<?php
// create new PDF document
$pageLayout = array(21, 29.7);
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A4', true, 'UTF-8', false);
$pdf->setPrintFooter(false);
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('ApplAud');
$pdf->SetTitle($code);
$pdf->SetSubject('TCPDF');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
// set default header data
//$pdf->SetHeaderData("headerdispatch.png", 65);
// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
// set margins
$pdf->SetMargins(25,10,15);   
//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP-60, PDF_MARGIN_RIGHT);
//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetHeaderMargin(0);   
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->setPrintHeader(false);
// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}
// ---------------------------------------------------------
// set font
// add a page
$pdf->AddPage('P');
//$pdf->SetPageSize('A4');
$html =  "
    <style>
        *{
            font-family: 'Times New Roman', Times, serif;
            font-size: 14px;
        }
        h3{
            font-size: 16px;
        }
        .cent{
            text-align: center;
        }
        .bo{
            border: 1px solid black;
        }
        p,li{
            text-align: justify;
        }
        .bb{
            border-bottom: 1px solid black;
        }
        .ind{
            text-indent: 20px;
        }
    </style>
";
$html .= '
    <h3>ANALYTICAL REVIEW TECHNIQUES AND INTERPRETATIONS</h3>
    <table>
        <tbody>
            <tr>
                <td style="width: 7%;">1.</td>
                <td style="width: 93%;"><b>INTANGIBLE FIXED ASSETS (INCLUDING GOODWILL)</b>
                    <p>An increase in intangible fixed assets may be due to:</p>
                    <ul>
                        <li>An acquisition (of a business or a subsidiary) during the period giving rise to goodwill or acquired intangibles</li>
                        <li>Capitalisation of deferred development costs or website costs</li>
                        <li>Purchase of intangible fixed assets</li>
                        <li>Revaluation of intangible fixed assets <i> (not allowed in respect of goodwill, and rarely appropriate regarding other fixed assets) </i></li>
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
                    <p><b>Key Figures</b></p>
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
                    <br><br>
                </td>
            </tr>
            <tr>
                <td style="width: 7%;">2.</td>
                <td style="width: 93%;"><b>PROPERTY, PLANT AND EQUIPMENT</b>
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
                    <p><b>Key Figures</b></p>
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
                                <li>depreciation charge</li>
                                <li>income received</li>
                            </ul>
                        </li>
                    </ul>
                    <br><br>
                </td>
            </tr>
            <tr>
                <td style="width: 7%;">3.</td>
                <td style="width: 93%;"><b>INVESTMENTS</b>
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
                        <li>A decrease in investments may be due to:</li>
                        <li>Impairment losses</li>
                        <li>Decrease in market value</li>
                    </ul>
                    <p><b>Key Figures</b></p>
                    <ul>
                        <li>Additions and disposals as compared with previous periods and budgets</li>
                        <li>Income compared to market value</li>
                        <li>Change in stock market indices (Dow Jones / Nikkei / FTSE etc.)</li>
                        <li>Value of unlisted investment in relation to the EBITDA of the companies in which the investments are held</li>
                    </ul>
                    <br><br>
                </td>
            </tr>
            <tr>
                <td style="width: 7%;">4.</td>
                <td style="width: 93%;"><b>INVENTORY</b>
                    <p>An increase in inventory could be due to:</p>
                    <ul>
                        <li>Change in purchasing policy (for example to obtain bulk discounts)</li>
                        <li>A decrease in sales</li>
                        <li>Change in capitalisation policy so that where relevant, finance costs are ‘capitalised’ </li>
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
                    <p><b>Key Figures</b></p>
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
                    <br><br>
                </td>
            </tr>
            <tr>
                <td style="width: 7%;">5.</td>
                <td style="width: 93%;"><b>INVENTORY</b>
                    <p>An increase in receivables may be due to:</p>
                    <ul>
                        <li>An increase in turnover / trading activity</li>
                        <li>Favourable exchange rate movements</li>
                        <li>A deterioration in the economic climate</li>
                        <li>A deterioration in the client\'s credit control or debt collection procedures</li>
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
                    <p><b>Key Figures</b></p>
                    <ul>
                        <li>Level of receivables</li>
                        <li>Level of irrecoverable receivables</li>
                    </ul>
                    <p><b>Key Figures</b></p>
                    <ul>
                        <li>Changes in aged receivables analysis</li>
                        <li>Receivables days</li>
                        <li>Irrecoverable receivables written-off as a percentage of sales</li>
                        <li>Money owed by key customers</li>
                    </ul>
                    <br><br>
                </td>
            </tr>
            <tr>
                <td style="width: 7%;">6.</td>
                <td style="width: 93%;"><b>CASH AT BANK AND IN HAND</b>
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
                    <p><b>Key Figures</b></p>
                    <ul>
                        <li>Actual movements of cash compared to budgeted cash flows</li>
                        <li>Level of unusual / one-off cash disbursements</li>
                        <li>Available bank facilities</li>
                        <li>Interest received / paid compared to average balance</li>
                    </ul>
                    <br><br>
                </td>
            </tr>
            <tr>
                <td style="width: 7%;">7.</td>
                <td style="width: 93%;"><b>TRADE PAYABLES</b>
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
                    <p><b>Key Figures</b></p>
                    <ul>
                        <li>Level of payables</li>
                        <li>Payables to inventory</li>
                        <li>Monies owed to major suppliers</li>
                        <li>Payables days</li>
                    </ul>
                    <br><br>
                </td>
            </tr>
            <tr>
                <td style="width: 7%;">8.</td>
                <td style="width: 93%;"><b>REVENUE</b>
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
                    <br><br>
                </td>
            </tr>
            <tr>
                <td style="width: 7%;">9.</td>
                <td style="width: 93%;"><b>EXPENSES</b>
                    <p>Key factors to consider are:</p>
                    <ul>
                        <li>Purchase volume changes</li>
                        <li>Purchase price changes</li>
                        <li>Purchase mix changes</li>
                        <li>Theoretical purchase changes</li>
                        <li>Monthly pattern of purchases</li>
                    </ul>
                    <br><br>
                </td>
            </tr>
            <tr>
                <td style="width: 7%;">10.</td>
                <td style="width: 93%;"><b>GROSS PROFIT</b>
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
                    <br><br>
                </td>
            </tr>
            <tr>
                <td style="width: 7%;">11.</td>
                <td style="width: 93%;"><b>PAYROLL COSTS</b>
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
                    <br><br>
                </td>
            </tr>
            <tr>
                <td style="width: 7%;">12.</td>
                <td style="width: 93%;"><b>OTHER PERFORMANCE STATEMENT CATEGORIES</b>
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
                    <br><br>
                </td>
            </tr>
            <tr>
                <td style="width: 7%;">13.</td>
                <td style="width: 93%;"><b>KEY BUSINESS RATIOS</b>
                    <p>There are four main categories as follows:</p>
                    <ul>
                        <li>Profitability and Returns</li>
                        <li>Activity</li>
                        <li>Liquidity</li>
                        <li>Solvency</li>
                    </ul>
                    <br><br>
                </td>
            </tr>
            <tr>
                <td style="width: 7%;">13.1</td>
                <td style="width: 93%;">
                    <b>PROFITABILITY AND RETURNS</b> <br>
                    <table border="1">
                        <tbody>
                            <tr>
                                <td><b>Gross Profit Margin</b></td>
                                <td>Gross profit x 100% Revenue</td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    This ratio indicates the contribution of the company\'s trading activities to profitability.  A change may indicate:
                                    <ul>
                                        <li>a company\'s inability to pass on increasing costs by raising prices;</li>
                                        <li>changes in cost of sales price to sales price per unit;</li>
                                        <li>changes in the sales mix; or</li>
                                        <li>changes in manufacturing efficiencies.</li>
                                    </ul>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <br><br>
                    <table border="1">
                        <tr>
                            <td><b>Net Profit Margin</b></td>
                            <td>Gross profit x 100% Revenue</td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                This shows the profit earned per sale.  A low level may indicate vulnerability to changing market conditions. <br><br>
                                NB: Financial income and expenditure should also be excluded from the calculation of the net profit margin, otherwise this ratio will be polluted by changes in the fair value of investment properties and financial instruments.
                                <br><br>
                            </td>
                        </tr>
                    </table>
                    <br><br>
                    <table border="1">
                        <tr>
                            <td><b>Shareholders’ Return</b></td>
                            <td>Gross profit x 100% Revenue</td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                The higher this ratio, the better the return to shareholders. <br><br>
                                NB: Financial income and expenditure should be included in the calculation of the net profit margin, as changes in the value of investment properties and financial instrument is relevant to shareholders.
                                <br><br>
                            </td>
                        </tr>
                    </table>
                    <br><br>
                    <table border="1">
                        <tr>
                            <td><b>Return on Capital Employed (ROCE)</b></td>
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
                    <br><br>
                    <table border="1">
                        <tr>
                            <td><b>Interest Cover</b></td>
                            <td>Profit Before Interest and Tax Interest Payable</td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                This shows the extent to which profits are used to pay interest. <br>
                                NB:  Interest payable should exclude the unwinding of discounts on provisions and also interest charges generated by accounting for long-term interest free inter-company loans on an amortised cost basis.
                            </td>
                        </tr>
                    </table>
                    <br><br>
                </td>
            </tr>
            <tr>
                <td style="width: 7%;">13.2</td>
                <td style="width: 93%;">
                    <b>ACTIVITY</b> <br>
                    <table border="1">
                        <tr>
                            <td><b>Inventory Turnover</b></td>
                            <td>Cost of Sales Average Inventory</td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                This ratio indicates the speed inventory is moving.  A low figure could indicate excessive levels, obsolete and slow-moving inventory, and could mean high storage and finance costs.  A high figure may indicate efficient inventory management but may also indicate insufficient supplies (and, hence, lost sales or loss of client goodwill), or excessive markdown.
                            </td>
                        </tr>
                    </table>
                    <table border="1">
                        <tr>
                            <td><b>Inventory Turnover</b></td>
                            <td>Cost of Sales Average Inventory</td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                This ratio indicates the speed inventory is moving.  A low figure could indicate excessive levels, obsolete and slow-moving inventory, and could mean high storage and finance costs.  A high figure may indicate efficient inventory management but may also indicate insufficient supplies (and, hence, lost sales or loss of client goodwill), or excessive markdown.
                            </td>
                        </tr>
                    </table>
                    <br><br>
                    <table border="1">
                        <tr>
                            <td><b>Receivables Days</b></td>
                            <td>Trade Receivables x 365 Revenue</td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                A long period may indicate potential cash flow and working capital problems, bad and irrecoverable receivables problems, or inefficient credit control procedures.  Comparisons should be made to industry norms and the company\'s credit terms.
                            </td>
                        </tr>
                    </table>
                    <br><br>
                    <table border="1">
                        <tr>
                            <td><b>Payables Days</b></td>
                            <td>Trade Payables x 365 Direct Costs</td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                This ratio shows the client\'s payment patterns to suppliers.  A high number may indicate a policy of slow payment and using suppliers to help finance operations and, hence, possible liquidity problems.
                            </td>
                        </tr>
                    </table>
                    <br><br>
                </td>
            </tr>
            <tr>
                <td style="width: 7%;">13.3</td>
                <td style="width: 93%;">
                    <b>LIQUIDITY</b> <br>
                    <table border="1">
                        <tr>
                            <td><b>Acid Test / Quick Ratio</b></td>
                            <td>Current Assets (Excluding Inventory) Current Liabilities </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                This ratio indicates the company\'s immediate liquidity position, i.e. how likely creditors are to be paid promptly.  It should normally exceed 1.  This is an appropriate ratio where inventory is not very liquid.
                            </td>
                        </tr>
                    </table>
                    <br><br>
                    <table border="1">
                        <tr>
                            <td><b>Current Ratio</b></td>
                            <td>Current Assets Current Liabilities</td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                This indicates the likelihood payments to payables can be met.  This is an appropriate ratio where stock is very liquid.
                            </td>
                        </tr>
                    </table>
                    <br><br>
                    <table border="1">
                        <tr>
                            <td><h6>Gearing</h6></td>
                            <td>Total Non-Shareholder Liabilities x 100%
                            Equity 1 <br><br>
                            1 = including those classified as debt under        IAS 32
                            <br><br>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                This ratio shows the extent to which the company is financed by payables and debt rather than equity finance.  High ratios may mean debt is a burden and the company may have difficulty borrowing further in these circumstances.
                            </td>
                        </tr>
                    </table>
                    <br><br>
                    <table border="1">
                        <tr>
                            <td><b>Non-Current Assets : Long-Term Liabilities</b></td>
                            <td>Non-Current Assets : Long-Term Liabilities</td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                This indicates the extent to which long-term finance is used for non-current assets.  A high score together with significant current liabilities may indicate non-current assets being financed out of current liabilities which could be a sign of going concern difficulties.
                            </td>
                        </tr>
                    </table>
                    <br><br>
                    <table border="1">
                        <tr>
                            <td><b>Non-Current Assets : Equity</b></td>
                            <td>Non-Current Assets x 100% Equity </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                A company may be under-capitalised if non-current assets exceed equity.  If non-current assets are lower, the company could be over-capitalised and, hence, in a position to expand.
                            </td>
                        </tr>
                    </table>
                    <br><br>
                    <table border="1">
                        <tr>
                            <td><b>Current Liabilities : Equity</b></td>
                            <td>Current Liabilities x 100% Equity </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                This contrasts the funds short-term creditors have placed with the company with the funds invested by the owners.  The higher the ratio, the less the creditors\' security.
                            </td>
                        </tr>
                    </table>
                    <br><br>
                </td>
            </tr>
        </tbody>
    </table>
    ';
//$pdf->write1DBarcode($rdata['reservation_id'], 'S25+', '', '', '', 18, 0.4, $style, 'N');
//$pdf->Write(0, $html, '', 0, 'J', true);
$pdf->writeHTML($html, true, false,'J', false, '');
$pdf->Output('stocktransfer.pdf','I');
exit();