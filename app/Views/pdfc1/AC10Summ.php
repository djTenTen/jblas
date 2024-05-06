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
$pdf->SetMargins(25,7,15);  
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
$pdf->AddPage('L');
//$pdf->SetPageSize('A4');
$html =  "
    <style>
        *{
            font-family: 'Times New Roman', Times, serif;
            font-size: 12px;
        }
        h3{
            font-size: 15px;
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
    </style>
";
$html .= '
<table>
    <tr>
        <td style="width: 60%;">
            <table>
                <tr><td class="bb">Client:</td></tr>
                <tr><td></td></tr>
                <tr><td class="bb">Period:</td></tr>
            </table>
        </td>
        <td style="width: 40%;">
            <table border="1">
                <tr>
                    <td>Prepared by: <br></td>
                    <td>Date: <br></td>
                </tr>
                <tr>
                    <td>Reviewed by: <br></td>
                    <td>Date: <br></td>
                </tr>
            </table>
        </td>
    </tr>
</table>
';
$html .= '<p><b>AUDIT APPROACH AND SAMPLE SIZE CALCULATION</b></p>';
$html .= ' <p><i>To complete the table below enter the risk level as per Ac6 and the materiality level as documented at Ac8. Where a different risk level is relevant for different assertions the table can be expanded as indicated on the lefthand margin. The audit approach should be selected by entering \'Y\' or \'N\' as appropriate. Where sampling is not required under the approach selected the remainder of the row will be greyed out. 
    <br>Where substantive testing is to be undertaken document whether this will be supported by controls testing or supportive analytical procedures. For each area, enter the population and any large or key items on the appropriate supporting schedule. The residual sample size will then be automatically calculated by dividing the residual population (after large and key items) by materiality and multiplying this by the risk factor which is determined by the audit approach as documented on the reference table below.
    <br>Where transaction testing is to be undertaken select the approximate number of transactions from the drop down. This together with the risk level entered will calculate the appropriate sample size, again based on the information on the reference table below.
</i></p> ';
$html .= '
<table border="1">
    <thead>
        <tr class="cent">
            <th colspan="3" style="width: 27%;"></th>
            <th colspan="5" style="width: 25%;">A</th>
            <th style="width: 5%;">B</th>
            <th style="width: 5%;">C</th>
            <th style="width: 35%;" colspan="5"></th>
        </tr>
        <tr class="cent">
            <th colspan="8" style="width: 52%;">General</th>
            <th colspan="7" style="width: 35%;">Substantive</th>
            <th colspan="2" style="width: 10%;">Transaction</th>
        </tr>
        <tr>
            <th style="width: 10%;">Audit Area</th>
            <th style="width: 10%;">Audit Assertion (1) (Expand if different risks apply to different assertions)</th>
            <th style="width: 7%;" class="cent">Risk per Ac10</th>
            <th style="width: 5%;" class="cent">I</th>
            <th style="width: 5%;" class="cent">P</th>
            <th style="width: 5%;" class="cent">%</th>
            <th style="width: 5%;" class="cent">S</th>
            <th style="width: 5%;" class="cent">T</th>
            <th style="width: 5%;">Tests of control  # (2) @</th>
            <th style="width: 5%;">Supportive analytical procedures #</th>
            <th style="width: 5%;">Risk factor (as below)</th>
            <th style="width: 5%;">Value of population after large and key items</th>
            <th style="width: 5%;">Section Ref</th>
            <th style="width: 5%;">Residual sample size</th>
            <th style="width: 5%;">No of material / key items to be tested </th>
            <th style="width: 5%;">Approximate number of transactions</th>
            <th style="width: 5%;">Transaction sample size from table B</th>
        </tr>
    </thead>
    <tbody id="tbody">';
$html .='
        <tr>
            <td style="width: 10%;">Intangible Assets</td>
            <td style="width: 10%;">All</td>
            <td style="width: 7%;">';
            switch ($tgb['tgb_rpac10']) {
                case '1.2':$html .= 'Low';break;
                case '1.8':$html .= 'Medium';break;
                case '2.5':$html .= 'High';break;
                default:break;
            }
$html .= '
            </td>
            <td style="width: 5%;">'.$tgb['tgb_i'].'</td>
            <td style="width: 5%;">'.$tgb['tgb_p'].'</td>
            <td style="width: 5%;">'.$tgb['tgb_pcnt'].'</td>
            <td style="width: 5%;">'.$tgb['tgb_s'].'</td>
            <td style="width: 5%;">'.$tgb['tgb_t'].'</td>
            <td style="width: 5%;">';
                switch ($tgb['tgb_ctrf']) {
                    case '0.5':$html .= 'Yes';break;
                    case '1':$html .= 'No';break;
                    default:break;
                }
$html .='   </td>
            <td style="width: 5%;">';
                switch ($tgb['tgb_arf']) {
                    case '0.67':$html .='Yes';break;
                    case '1':$html .='No';break;
                    default:break;
                }
$html .='   </td>
            <td style="width: 5%;">'.$tgb['tgb_rf'].'</td>
            <td style="width: 5%;">'.$vop_tgb.'</td>
            <td style="width: 5%;">'.$tgb['tgb_secref'].'</td>
            <td style="width: 5%;">'.$tgb['tgb_rss'].'</td>
            <td style="width: 5%;">'.$nmk_tgb.'</td>
            <td style="width: 5%;">'.$tgb['tgb_ant'].'</td>
            <td style="width: 5%;">'.$tgb['tgb_tss'].'</td>
        </tr>';
$html .='
        <tr>
            <td style="width: 10%;">PPE</td>
            <td style="width: 10%;">All</td>
            <td style="width: 7%;">';
            switch ($ppe['ppe_rpac10']) {
                case '1.2':$html .= 'Low';break;
                case '1.8':$html .= 'Medium';break;
                case '2.5':$html .= 'High';break;
                default:break;
            }
$html .= '
            </td>
            <td style="width: 5%;">'.$ppe['ppe_i'].'</td>
            <td style="width: 5%;">'.$ppe['ppe_p'].'</td>
            <td style="width: 5%;">'.$ppe['ppe_pcnt'].'</td>
            <td style="width: 5%;">'.$ppe['ppe_s'].'</td>
            <td style="width: 5%;">'.$ppe['ppe_t'].'</td>
            <td style="width: 5%;">';
                switch ($ppe['ppe_ctrf']) {
                    case '0.5':$html .= 'Yes';break;
                    case '1':$html .= 'No';break;
                    default:break;
                }
$html .='   </td>
            <td style="width: 5%;">';
                switch ($ppe['ppe_arf']) {
                    case '0.67':$html .='Yes';break;
                    case '1':$html .='No';break;
                    default:break;
                }
$html .='   </td>
            <td style="width: 5%;">'.$ppe['ppe_rf'].'</td>
            <td style="width: 5%;">'.$vop_ppe.'</td>
            <td style="width: 5%;">'.$ppe['ppe_secref'].'</td>
            <td style="width: 5%;">'.$ppe['ppe_rss'].'</td>
            <td style="width: 5%;">'.$nmk_ppe.'</td>
            <td style="width: 5%;">'.$ppe['ppe_ant'].'</td>
            <td style="width: 5%;">'.$ppe['ppe_tss'].'</td>
        </tr>';
        $html .='
        <tr>
            <td style="width: 10%;">Investments</td>
            <td style="width: 10%;">All</td>
            <td style="width: 7%;">';
            switch ($invmt['invmt_rpac10']) {
                case '1.2':$html .= 'Low';break;
                case '1.8':$html .= 'Medium';break;
                case '2.5':$html .= 'High';break;
                default:break;
            }
$html .= '
            </td>
            <td style="width: 5%;">'.$invmt['invmt_i'].'</td>
            <td style="width: 5%;">'.$invmt['invmt_p'].'</td>
            <td style="width: 5%;">'.$invmt['invmt_pcnt'].'</td>
            <td style="width: 5%;">'.$invmt['invmt_s'].'</td>
            <td style="width: 5%;">'.$invmt['invmt_t'].'</td>
            <td style="width: 5%;">';
                switch ($invmt['invmt_ctrf']) {
                    case '0.5':$html .= 'Yes';break;
                    case '1':$html .= 'No';break;
                    default:break;
                }
$html .='   </td>
            <td style="width: 5%;">';
                switch ($invmt['invmt_arf']) {
                    case '0.67':$html .='Yes';break;
                    case '1':$html .='No';break;
                    default:break;
                }
$html .='   </td>
            <td style="width: 5%;">'.$invmt['invmt_rf'].'</td>
            <td style="width: 5%;">'.$vop_invmt.'</td>
            <td style="width: 5%;">'.$invmt['invmt_secref'].'</td>
            <td style="width: 5%;">'.$invmt['invmt_rss'].'</td>
            <td style="width: 5%;">'.$nmk_invmt.'</td>
            <td style="width: 5%;">'.$invmt['invmt_ant'].'</td>
            <td style="width: 5%;">'.$invmt['invmt_tss'].'</td>
        </tr>';
        $html .='
        <tr>
            <td style="width: 10%;">Inventories</td>
            <td style="width: 10%;">All</td>
            <td style="width: 7%;">';
            switch ($invtr['invtr_rpac10']) {
                case '1.2':$html .= 'Low';break;
                case '1.8':$html .= 'Medium';break;
                case '2.5':$html .= 'High';break;
                default:break;
            }
$html .= '
            </td>
            <td style="width: 5%;">'.$invtr['invtr_i'].'</td>
            <td style="width: 5%;">'.$invtr['invtr_p'].'</td>
            <td style="width: 5%;">'.$invtr['invtr_pcnt'].'</td>
            <td style="width: 5%;">'.$invtr['invtr_s'].'</td>
            <td style="width: 5%;">'.$invtr['invtr_t'].'</td>
            <td style="width: 5%;">';
                switch ($invtr['invtr_ctrf']) {
                    case '0.5':$html .= 'Yes';break;
                    case '1':$html .= 'No';break;
                    default:break;
                }
$html .='   </td>
            <td style="width: 5%;">';
                switch ($invtr['invtr_arf']) {
                    case '0.67':$html .='Yes';break;
                    case '1':$html .='No';break;
                    default:break;
                }
$html .='   </td>
            <td style="width: 5%;">'.$invtr['invtr_rf'].'</td>
            <td style="width: 5%;">'.$vop_invtr.'</td>
            <td style="width: 5%;">'.$invtr['invtr_secref'].'</td>
            <td style="width: 5%;">'.$invtr['invtr_rss'].'</td>
            <td style="width: 5%;">'.$nmk_invtr.'</td>
            <td style="width: 5%;">'.$invtr['invtr_ant'].'</td>
            <td style="width: 5%;">'.$invtr['invtr_tss'].'</td>
        </tr>';
        $html .='
        <tr>
            <td style="width: 10%;">Trade Receivables</td>
            <td style="width: 10%;">All</td>
            <td style="width: 7%;">';
            switch ($tr['tr_rpac10']) {
                case '1.2':$html .= 'Low';break;
                case '1.8':$html .= 'Medium';break;
                case '2.5':$html .= 'High';break;
                default:break;
            }
$html .= '
            </td>
            <td style="width: 5%;">'.$tr['tr_i'].'</td>
            <td style="width: 5%;">'.$tr['tr_p'].'</td>
            <td style="width: 5%;">'.$tr['tr_pcnt'].'</td>
            <td style="width: 5%;">'.$tr['tr_s'].'</td>
            <td style="width: 5%;">'.$tr['tr_t'].'</td>
            <td style="width: 5%;">';
                switch ($tr['tr_ctrf']) {
                    case '0.5':$html .= 'Yes';break;
                    case '1':$html .= 'No';break;
                    default:break;
                }
$html .='   </td>
            <td style="width: 5%;">';
                switch ($tr['tr_arf']) {
                    case '0.67':$html .='Yes';break;
                    case '1':$html .='No';break;
                    default:break;
                }
$html .='   </td>
            <td style="width: 5%;">'.$tr['tr_rf'].'</td>
            <td style="width: 5%;">'.$vop_tr.'</td>
            <td style="width: 5%;">'.$tr['tr_secref'].'</td>
            <td style="width: 5%;">'.$tr['tr_rss'].'</td>
            <td style="width: 5%;">'.$nmk_tr.'</td>
            <td style="width: 5%;">'.$tr['tr_ant'].'</td>
            <td style="width: 5%;">'.$tr['tr_tss'].'</td>
        </tr>';
        $html .='
        <tr>
            <td style="width: 10%;">All Other Receivables</td>
            <td style="width: 10%;">All</td>
            <td style="width: 7%;">';
            switch ($or['or_rpac10']) {
                case '1.2':$html .= 'Low';break;
                case '1.8':$html .= 'Medium';break;
                case '2.5':$html .= 'High';break;
                default:break;
            }
$html .= '
            </td>
            <td style="width: 5%;">'.$or['or_i'].'</td>
            <td style="width: 5%;">'.$or['or_p'].'</td>
            <td style="width: 5%;">'.$or['or_pcnt'].'</td>
            <td style="width: 5%;">'.$or['or_s'].'</td>
            <td style="width: 5%;">'.$or['or_t'].'</td>
            <td style="width: 5%;">';
                switch ($or['or_ctrf']) {
                    case '0.5':$html .= 'Yes';break;
                    case '1':$html .= 'No';break;
                    default:break;
                }
$html .='   </td>
            <td style="width: 5%;">';
                switch ($or['or_arf']) {
                    case '0.67':$html .='Yes';break;
                    case '1':$html .='No';break;
                    default:break;
                }
$html .='   </td>
            <td style="width: 5%;">'.$or['or_rf'].'</td>
            <td style="width: 5%;">'.$vop_or.'</td>
            <td style="width: 5%;">'.$or['or_secref'].'</td>
            <td style="width: 5%;">'.$or['or_rss'].'</td>
            <td style="width: 5%;">'.$nmk_or.'</td>
            <td style="width: 5%;">'.$or['or_ant'].'</td>
            <td style="width: 5%;">'.$or['or_tss'].'</td>
        </tr>';
        $html .='
        <tr>
            <td style="width: 10%;">Bank and Cash</td>
            <td style="width: 10%;">All</td>
            <td style="width: 7%;">';
            switch ($bac['bac_rpac10']) {
                case '1.2':$html .= 'Low';break;
                case '1.8':$html .= 'Medium';break;
                case '2.5':$html .= 'High';break;
                default:break;
            }
$html .= '
            </td>
            <td style="width: 5%;">'.$bac['bac_i'].'</td>
            <td style="width: 5%;">'.$bac['bac_p'].'</td>
            <td style="width: 5%;">'.$bac['bac_pcnt'].'</td>
            <td style="width: 5%;">'.$bac['bac_s'].'</td>
            <td style="width: 5%;">'.$bac['bac_t'].'</td>
            <td style="width: 5%;">';
                switch ($bac['bac_ctrf']) {
                    case '0.5':$html .= 'Yes';break;
                    case '1':$html .= 'No';break;
                    default:break;
                }
$html .='   </td>
            <td style="width: 5%;">';
                switch ($bac['bac_arf']) {
                    case '0.67':$html .='Yes';break;
                    case '1':$html .='No';break;
                    default:break;
                }
$html .='   </td>
            <td style="width: 5%;">'.$bac['bac_rf'].'</td>
            <td style="width: 5%;">'.$vop_bac.'</td>
            <td style="width: 5%;">'.$bac['bac_secref'].'</td>
            <td style="width: 5%;">'.$bac['bac_rss'].'</td>
            <td style="width: 5%;">'.$nmk_bac.'</td>
            <td style="width: 5%;">'.$bac['bac_ant'].'</td>
            <td style="width: 5%;">'.$bac['bac_tss'].'</td>
        </tr>';
        $html .='
        <tr>
            <td style="width: 10%;">Trade Payables</td>
            <td style="width: 10%;">All</td>
            <td style="width: 7%;">';
            switch ($tp['tp_rpac10']) {
                case '1.2':$html .= 'Low';break;
                case '1.8':$html .= 'Medium';break;
                case '2.5':$html .= 'High';break;
                default:break;
            }
$html .= '
            </td>
            <td style="width: 5%;">'.$tp['tp_i'].'</td>
            <td style="width: 5%;">'.$tp['tp_p'].'</td>
            <td style="width: 5%;">'.$tp['tp_pcnt'].'</td>
            <td style="width: 5%;">'.$tp['tp_s'].'</td>
            <td style="width: 5%;">'.$tp['tp_t'].'</td>
            <td style="width: 5%;">';
                switch ($tp['tp_ctrf']) {
                    case '0.5':$html .= 'Yes';break;
                    case '1':$html .= 'No';break;
                    default:break;
                }
$html .='   </td>
            <td style="width: 5%;">';
                switch ($tp['tp_arf']) {
                    case '0.67':$html .='Yes';break;
                    case '1':$html .='No';break;
                    default:break;
                }
$html .='   </td>
            <td style="width: 5%;">'.$tp['tp_rf'].'</td>
            <td style="width: 5%;">'.$vop_tp.'</td>
            <td style="width: 5%;">'.$tp['tp_secref'].'</td>
            <td style="width: 5%;">'.$tp['tp_rss'].'</td>
            <td style="width: 5%;">'.$nmk_tp.'</td>
            <td style="width: 5%;">'.$tp['tp_ant'].'</td>
            <td style="width: 5%;">'.$tp['tp_tss'].'</td>
        </tr>';
        $html .='
        <tr>
            <td style="width: 10%;">All Other Payables</td>
            <td style="width: 10%;">All</td>
            <td style="width: 7%;">';
            switch ($op['op_rpac10']) {
                case '1.2':$html .= 'Low';break;
                case '1.8':$html .= 'Medium';break;
                case '2.5':$html .= 'High';break;
                default:break;
            }
$html .= '
            </td>
            <td style="width: 5%;">'.$op['op_i'].'</td>
            <td style="width: 5%;">'.$op['op_p'].'</td>
            <td style="width: 5%;">'.$op['op_pcnt'].'</td>
            <td style="width: 5%;">'.$op['op_s'].'</td>
            <td style="width: 5%;">'.$op['op_t'].'</td>
            <td style="width: 5%;">';
                switch ($op['op_ctrf']) {
                    case '0.5':$html .= 'Yes';break;
                    case '1':$html .= 'No';break;
                    default:break;
                }
$html .='   </td>
            <td style="width: 5%;">';
                switch ($op['op_arf']) {
                    case '0.67':$html .='Yes';break;
                    case '1':$html .='No';break;
                    default:break;
                }
$html .='   </td>
            <td style="width: 5%;">'.$op['op_rf'].'</td>
            <td style="width: 5%;">'.$vop_op.'</td>
            <td style="width: 5%;">'.$op['op_secref'].'</td>
            <td style="width: 5%;">'.$op['op_rss'].'</td>
            <td style="width: 5%;">'.$nmk_op.'</td>
            <td style="width: 5%;">'.$op['op_ant'].'</td>
            <td style="width: 5%;">'.$op['op_tss'].'</td>
        </tr>';
        $html .='
        <tr>
            <td style="width: 10%;">Provisions</td>
            <td style="width: 10%;">All</td>
            <td style="width: 7%;">';
            switch ($prov['prov_rpac10']) {
                case '1.2':$html .= 'Low';break;
                case '1.8':$html .= 'Medium';break;
                case '2.5':$html .= 'High';break;
                default:break;
            }
$html .= '
            </td>
            <td style="width: 5%;">'.$prov['prov_i'].'</td>
            <td style="width: 5%;">'.$prov['prov_p'].'</td>
            <td style="width: 5%;">'.$prov['prov_pcnt'].'</td>
            <td style="width: 5%;">'.$prov['prov_s'].'</td>
            <td style="width: 5%;">'.$prov['prov_t'].'</td>
            <td style="width: 5%;">';
                switch ($prov['prov_ctrf']) {
                    case '0.5':$html .= 'Yes';break;
                    case '1':$html .= 'No';break;
                    default:break;
                }
$html .='   </td>
            <td style="width: 5%;">';
                switch ($prov['prov_arf']) {
                    case '0.67':$html .='Yes';break;
                    case '1':$html .='No';break;
                    default:break;
                }
$html .='   </td>
            <td style="width: 5%;">'.$prov['prov_rf'].'</td>
            <td style="width: 5%;">'.$vop_prov.'</td>
            <td style="width: 5%;">'.$prov['prov_secref'].'</td>
            <td style="width: 5%;">'.$prov['prov_rss'].'</td>
            <td style="width: 5%;">'.$nmk_prov.'</td>
            <td style="width: 5%;">'.$prov['prov_ant'].'</td>
            <td style="width: 5%;">'.$prov['prov_tss'].'</td>
        </tr>';
$html .= '<tr>
            <td colspan="17"></td>
    </tr>';
        $html .='
        <tr>
            <td style="width: 10%;">Revenue</td>
            <td style="width: 10%;">All</td>
            <td style="width: 7%;">';
            switch ($rev['rev_rpac10']) {
                case '1.2':$html .= 'Low';break;
                case '1.8':$html .= 'Medium';break;
                case '2.5':$html .= 'High';break;
                default:break;
            }
$html .= '
            </td>
            <td style="width: 5%;">'.$rev['rev_i'].'</td>
            <td style="width: 5%;">'.$rev['rev_p'].'</td>
            <td style="width: 5%;">'.$rev['rev_pcnt'].'</td>
            <td style="width: 5%;">'.$rev['rev_s'].'</td>
            <td style="width: 5%;">'.$rev['rev_t'].'</td>
            <td style="width: 5%;">';
                switch ($rev['rev_ctrf']) {
                    case '0.5':$html .= 'Yes';break;
                    case '1':$html .= 'No';break;
                    default:break;
                }
$html .='   </td>
            <td style="width: 5%;">';
                switch ($rev['rev_arf']) {
                    case '0.67':$html .='Yes';break;
                    case '1':$html .='No';break;
                    default:break;
                }
$html .='   </td>
            <td style="width: 5%;">'.$rev['rev_rf'].'</td>
            <td style="width: 5%;">'.$vop_rev.'</td>
            <td style="width: 5%;">'.$rev['rev_secref'].'</td>
            <td style="width: 5%;">'.$rev['rev_rss'].'</td>
            <td style="width: 5%;">'.$nmk_rev.'</td>
            <td style="width: 5%;">'.$rev['rev_ant'].'</td>
            <td style="width: 5%;">'.$rev['rev_tss'].'</td>
        </tr>';
        $html .='
        <tr>
            <td style="width: 10%;">Costs</td>
            <td style="width: 10%;">All</td>
            <td style="width: 7%;">';
            switch ($cst['cst_rpac10']) {
                case '1.2':$html .= 'Low';break;
                case '1.8':$html .= 'Medium';break;
                case '2.5':$html .= 'High';break;
                default:break;
            }
$html .= '
            </td>
            <td style="width: 5%;">'.$cst['cst_i'].'</td>
            <td style="width: 5%;">'.$cst['cst_p'].'</td>
            <td style="width: 5%;">'.$cst['cst_pcnt'].'</td>
            <td style="width: 5%;">'.$cst['cst_s'].'</td>
            <td style="width: 5%;">'.$cst['cst_t'].'</td>
            <td style="width: 5%;">';
                switch ($cst['cst_ctrf']) {
                    case '0.5':$html .= 'Yes';break;
                    case '1':$html .= 'No';break;
                    default:break;
                }
$html .='   </td>
            <td style="width: 5%;">';
                switch ($cst['cst_arf']) {
                    case '0.67':$html .='Yes';break;
                    case '1':$html .='No';break;
                    default:break;
                }
$html .='   </td>
            <td style="width: 5%;">'.$cst['cst_rf'].'</td>
            <td style="width: 5%;">'.$vop_cst.'</td>
            <td style="width: 5%;">'.$cst['cst_secref'].'</td>
            <td style="width: 5%;">'.$cst['cst_rss'].'</td>
            <td style="width: 5%;">'.$nmk_cst.'</td>
            <td style="width: 5%;">'.$cst['cst_ant'].'</td>
            <td style="width: 5%;">'.$cst['cst_tss'].'</td>
        </tr>';
        $html .='
        <tr>
            <td style="width: 10%;">Payroll</td>
            <td style="width: 10%;">All</td>
            <td style="width: 7%;">';
            switch ($pr['pr_rpac10']) {
                case '1.2':$html .= 'Low';break;
                case '1.8':$html .= 'Medium';break;
                case '2.5':$html .= 'High';break;
                default:break;
            }
$html .= '
            </td>
            <td style="width: 5%;">'.$pr['pr_i'].'</td>
            <td style="width: 5%;">'.$pr['pr_p'].'</td>
            <td style="width: 5%;">'.$pr['pr_pcnt'].'</td>
            <td style="width: 5%;">'.$pr['pr_s'].'</td>
            <td style="width: 5%;">'.$pr['pr_t'].'</td>
            <td style="width: 5%;">';
                switch ($pr['pr_ctrf']) {
                    case '0.5':$html .= 'Yes';break;
                    case '1':$html .= 'No';break;
                    default:break;
                }
$html .='   </td>
            <td style="width: 5%;">';
                switch ($pr['pr_arf']) {
                    case '0.67':$html .='Yes';break;
                    case '1':$html .='No';break;
                    default:break;
                }
$html .='   </td>
            <td style="width: 5%;">'.$pr['pr_rf'].'</td>
            <td style="width: 5%;">'.$vop_pr.'</td>
            <td style="width: 5%;">'.$pr['pr_secref'].'</td>
            <td style="width: 5%;">'.$pr['pr_rss'].'</td>
            <td style="width: 5%;">'.$nmk_pr.'</td>
            <td style="width: 5%;">'.$pr['pr_ant'].'</td>
            <td style="width: 5%;">'.$pr['pr_tss'].'</td>
        </tr>';
$html .='
    </tbody>   
</table>
';
$pdf->writeHTML($html, true, false,'J', false, '');
$pdf->AddPage('L');
$html =  "
    <style>
        *{
            font-family: 'Times New Roman', Times, serif;
            font-size: 12px;
        }
        h3{
            font-size: 15px;
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
    </style>
";
$html .= '
    <ol>
        <li>Risk must be assessed for each area at assertion level.  If for an area, all assertions have the same risk use the "all" line. However, if there are different levels of risks then the various assertion rows should be expanded in each area as relevant. At the testing stage the key assertions are occurrence, completeness, accuracy, cut off and classification for transactions and existence, rights and obligations, completeness, valuation and allocation and disclosure for balances.</li>
        <li>If testing controls then the operating effectiveness of the non critical controls must be tested at least every three years to ensure that they are effective, all critical controls should still be tested annually.  Walkthrough tests should be carried out every year to ensure that controls have not changed.</li>
        <li>It will usually only be appropriate to test controls where they are expected to be effective therefore a low risk sample size should be used.</li>
    </ol>
    <p><b>Reference Table</b></p>
    <table border="1">
        <thead>
            <tr>
                <th rowspan="4">Reference Table</th>
                <th></th>
                <th></th>
                <th></th>
                <th>Balance Sheet</th>
                <th></th>
                <th></th>
                <th></th>
                <th>Profit or Loss</th>
                <th></th>
                <th></th>
            </tr>
            <tr>
                <th>Audit Approach</th>
                <th></th>
                <th></th>
                <th>Risk Level</th>
                <th></th>
                <th></th>
                <th></th>
                <th>Risk Level</th>
                <th></th>
                <th></th>
            </tr>
            <tr>
                <th>A</th>
                <th>B</th>
                <th>C</th>
                <th>H</th>
                <th>M</th>
                <th>L</th>
                <th>Population</th>
                <th>H</th>
                <th>M</th>
                <th>L</th>
            </tr>
            <tr>
                <th>Approach</th>
                <th>Control</th>
                <th>AR</th>
                <th>Risk Factor</th>
                <th></th>
                <th></th>
                <th>Size</th>
                <th>Risk Factor</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td rowspan="11">Method of obtaining audit evidence</td>
                <td>I,P,%</td>
                <td>N/A</td>
                <td>N/A</td>
                <td>N/A</td>
                <td>N/A</td>
                <td>N/A</td>
                <td></td>
                <td>N/A</td>
                <td>N/A</td>
                <td>N/A</td>
            </tr>
            <tr>
                <td>S**</td>
                <td>No</td>
                <td>No</td>
                <td>2.5</td>
                <td>1.8</td>
                <td>1.2</td>
                <td></td>
                <td>1.2</td>
                <td>0.9</td>
                <td>0.6</td>
            </tr>
            <tr>
                <td>S**</td>
                <td>Yes</td>
                <td>No</td>
                <td>1.3</td>
                <td>0.9</td>
                <td>0.4</td>
                <td></td>
                <td>0.4</td>
                <td>0.3</td>
                <td>0.2</td>
            </tr>
            <tr>
                <td>S**</td>
                <td>No</td>
                <td>Yes</td>
                <td>1.7</td>
                <td>1.2</td>
                <td>0.8</td>
                <td></td>
                <td>0.8</td>
                <td>0.6</td>
                <td>0.4</td>
            </tr>
            <tr>
                <td>S**</td>
                <td>Yes</td>
                <td>Yes</td>
                <td>0.9</td>
                <td>0.6</td>
                <td>0.4</td>
                <td></td>
                <td>0.4</td>
                <td>0.3</td>
                <td>0.2</td>
            </tr>
            <tr>
                <td colspan="10">Sample Sizes**</td>
            </tr>
            <tr>
                <td>T / C</td>
                <td>N/A</td>
                <td>N/A</td>
                <td>N/A</td>
                <td>N/A</td>
                <td>N/A</td>
                <td>> 401</td>
                <td>60+</td>
                <td>40</td>
                <td>25</td>
            </tr>
            <tr>
                <td>T / C</td>
                <td>N/A</td>
                <td>N/A</td>
                <td>N/A</td>
                <td>N/A</td>
                <td>N/A</td>
                <td>226-400</td>
                <td>48+</td>
                <td>32</td>
                <td>20</td>
            </tr>
            <tr>
                <td>T / C</td>
                <td>N/A</td>
                <td>N/A</td>
                <td>N/A</td>
                <td>N/A</td>
                <td>N/A</td>
                <td>101-225</td>
                <td>36+</td>
                <td>24</td>
                <td>15</td>
            </tr>
            <tr>
                <td>T / C</td>
                <td>N/A</td>
                <td>N/A</td>
                <td>N/A</td>
                <td>N/A</td>
                <td>N/A</td>
                <td>26-100</td>
                <td>24+</td>
                <td>16</td>
                <td>10</td>
            </tr>
            <tr>
                <td>T / C</td>
                <td>N/A</td>
                <td>N/A</td>
                <td>N/A</td>
                <td>N/A</td>
                <td>N/A</td>
                <td>1-25</td>
                <td>12+</td>
                <td>8</td>
                <td>5</td>
            </tr>
        </tbody>
   </table>
    <p><b>Key</b></p>
    <p>
        I - Less than performance materiality <br>
        P - Proof in total (extensive analytical procedures) <br>
        % - 100% testing <br>
        S - Substantive sampling <br>
        T - Transaction testing <br>
        # - If a yes is recorded in either column B or C then suitable testing must be undertaken and the validity of this response must be reviewed at the end of the fieldwork and it must be cross referenced to supporting working papers <br>
        @ - It is only possible to record a yes in this column if controls have been tested, and they are effective.  If the controls are ineffective, a no must be recorded in this column.  This column may be completed with a yes at the planning stage if it is intended to test controls. <br>
        C - Tests of control <br>
        ** - When performing substantive procedures, the number of items selected from the residual population (after testing all "large" / "key" items) may be capped at the levels noted for transaction / control testing.
    </p>
';
//$pdf->write1DBarcode($rdata['reservation_id'], 'S25+', '', '', '', 18, 0.4, $style, 'N');
//$pdf->Write(0, $html, '', 0, 'J', true);
$pdf->writeHTML($html, true, false,'J', false, '');
$pdf->Output('stocktransfer.pdf','I');
exit();