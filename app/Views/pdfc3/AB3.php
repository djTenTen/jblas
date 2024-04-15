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
$pdf->AddPage();
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


$html .= '
<h3>FINANCIAL STATEMENTS DISCLOSURE AND COMPLIANCE ANNUAL REVIEW CHECKLIST</h3>
<p>This checklist should be used to evidence the checking of disclosure and compliance matters for \'uncomplex companies\' where the appropriate (i.e. IFRS) disclosure checklist has been completed within the last three years and the size and complexity of the company means that the firm does not consider that a full disclosure checklist needs to be completed every year.</p>

<table>
    <tbody>
        <tr>
            <td style="width: 7%;"><b>1.</b></td>
            <td style="width: 93%;"><b>Use of Disclosure Checklists</b>
                <p>The appropriate disclosure checklist must be completed in the following circumstances:</p>
                <ul>
                    <li>First year of engagement;</li>
                    <li>Every three years;</li>
                    <li>Where the financial statements are not prepared via a computerised accounts production package;</li>
                    <li>Where there have been significant changes in the client\'s business or accounting policies;</li>
                    <li>Where there have been significant changes in financial reporting standards (including First Time Adoption of / Amendments to IFRS) or legislative requirements;</li>
                    <li>Where there has been a significant transaction which would require additional disclosure in the financial statements (for example, a change to Equity (other than the profit for the year), the introduction of a new type of asset or liability, or acquiring a new source of income or expenditure).</li>
                </ul>
                <br>
            </td>
        </tr>
        <tr>
            <td style="width: 7%;"><b>2.</b></td>
            <td style="width: 93%;"><b>Common Changes</b>
                <p>Have any of the following points arisen during the period, resulting in disclosure or compliance changes:</p>
                <table>
                    <thead>
                        <tr>
                            <th style="width: 80%;"></th>
                            <th class="bo cent" style="width: 20%;"><b>Yes/No</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>•  Are disclosure exemptions available in legislation / IFRS now being taken / lost?</td>
                            <td class="bo cent">'.$ab3['aby1'].'</td>
                        </tr>
                        <tr>
                            <td>•  Was the company required to produce consolidated financial statements in the previous period but not in this period?</td>
                            <td class="bo cent">'.$ab3['aby2'].'</td>
                        </tr>
                        <tr>
                            <td>•  Is the company required to prepare consolidated financial statements this period (but has not in the previous period)?</td>
                            <td class="bo cent">'.$ab3['aby3'].'</td>
                        </tr>
                        <tr>
                            <td>•  Is the company adopting a new accounting framework for the first time?</td>
                            <td class="bo cent">'.$ab3['aby4'].'</td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <p>If the answer to any of the above is yes, a full disclosure checklist needs to be completed.</p>
            </td>
        </tr>
        <tr>
            <td style="width: 7%;"><b>3.</b></td>
            <td style="width: 93%;"><b>New Financial Reporting Standards </b>
                <p>The most recently completed disclosure checklist was for the period ending_________________</p>
                <p>Since then, no further* / the following* Accounting / Financial Reporting Standards or amendments (IFRS*) have become mandatory, with a commentary of the effect on disclosure in the financial statements being shown <i>(or included on a separate, cross-referenced schedule)(*delete as applicable):</i></p>
                <table border="1">
                    <thead>
                        <tr>
                            <th class="cent"><b>Financial Reporting Standard </b></th>
                            <th class="cent"><b>Effect on disclosures</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="cent">
                            <td>'.$ab3['frs1'].'</td>
                            <td>'.$ab3['ed1'].'</td>
                        </tr>
                        <tr class="cent">
                            <td>'.$ab3['frs2'].'</td>
                            <td>'.$ab3['ed2'].'</td>
                        </tr>
                        <tr class="cent">
                            <td>'.$ab3['frs3'].'</td>
                            <td>'.$ab3['ed3'].'</td>
                        </tr>
                        <tr class="cent">
                            <td>'.$ab3['frs4'].'</td>
                            <td>'.$ab3['ed4'].'</td>
                        </tr>
                        <tr class="cent">
                            <td>'.$ab3['frs5'].'</td>
                            <td>'.$ab3['ed5'].'</td>
                        </tr>
                    </tbody>
                </table>
                <br>
                
            </td>
        </tr>
        <tr>
            <td style="width: 7%;"><b>4.</b></td>
            <td style="width: 93%;"><b>Conclusion</b>
                <p>It is unnecessary to complete the relevant disclosure checklist for the current period.</p>
                <p>The financial statements have been reviewed with reference to the previously completed disclosure checklist and the requirements of any new financial reporting standards or amendments, and disclosures are considered to be adequate.</p>
                
                <br>
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