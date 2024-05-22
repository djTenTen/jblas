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
$style = "<style>
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
</style>";
$html =  "";
$html .= $style;
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
<p><b>CORPORATE DISCLOSURE CHECKLIST (IFRS)</b></p>
<p><b><u>Scope</u></b></p>
<p>This checklist should be completed for every corporate entity where International Financial Reporting Standards (IFRS) are being followed and it is not appropriate to complete Appendix 3.14 – Financial Statements Disclosure and Compliance Annual Review Checklist.</p>
<p>This checklist can be used for any entity that adopts IFRS, and includes a number of “best practice” disclosures which are commonly included within financial statements as a result of local legislative requirements.  If such best practice disclosures are not required, or are prohibited by legislation, it would be necessary to disregard these, and where relevant, to replace these disclosures with those disclosures required by the relevant legislation.</p>
<p>The requirements of IFRS only apply to material items.  Immaterial balances can be aggregated into other account headings and immaterial notes and accounting policies can be, and should ideally be, removed [IAS 1 paragraphs 29-31].</p>
<p>IFRS 15 <i>Revenue from Contracts with Customers</i> and IFRS 9 <i>Financial Instruments</i> became mandatory for accounting periods commencing on or after 1 January 2018. These resulted in significant additional disclosure requirements compared to the superseded standards dealing with these areas. </p>
<p>IFRS 16 Leases is mandatory for accounting periods commencing on or after 1 January 2019. This fundamentally alters the accounting treatment for lessees, with consequential disclosure amendments.</p>
<p><b>NB: To ensure that the Checklist is as efficient as possible, areas which are more specialised have been addressed by supplementary disclosure checklists.  <u>These supplementary disclosure checklists should only be completed if the area is relevant.</u></b></p>
<p>NB: The checklist does not cover the additional disclosures required by companies which enter into insurance contracts, where these are relevant considerations, then the disclosure requirements of IFRS 4 should be given.  It also does not cover the requirements of IAS 26, which are only relevant to clients who are themselves pension schemes, or IFRIC 2 which is relevant to cooperative entities.  The checklist also does not cover the disclosure requirements of companies with listed equity or debt.</p>
';
$html .= '
<table border="1">
    <thead>
        <tr class="cent">
            <th style="width: 55%;"><b>Specialist Area ~ Additional Disclosures Relating to:-</b></th>
            <th style="width: 15%;"><b>Reference in this Manual</b></th>
            <th style="width: 15%;"><b>Is this Area Relevant?(Y/N)</b></th>
            <th style="width: 15%;"><b>Supplementary Checklist Completed?(Y/N/NA)</b></th>
        </tr>
    </thead>
    <tbody>
        <tr class="cent">
            <td style="width: 55%;">Exploration for and Evaluation of Mineral Resources</td>
            <td style="width: 15%;">App. 3.15.1</td>
            <td style="width: 15%;">'.$sec['y1'].'</td>
            <td style="width: 15%;">'.$sec['y2'].'</td>
        </tr>
        <tr class="cent">
            <td style="width: 55%;">Defined Benefit Pension Plans</td>
            <td style="width: 15%;">App. 3.15.2</td>
            <td style="width: 15%;">'.$sec['y3'].'</td>
            <td style="width: 15%;">'.$sec['y4'].'</td>
        </tr>
        <tr class="cent">
            <td style="width: 55%;">Share-Based Payments</td>
            <td style="width: 15%;">App. 3.15.3</td>
            <td style="width: 15%;">'.$sec['y5'].'</td>
            <td style="width: 15%;">'.$sec['y6'].'</td>
        </tr>
        <tr class="cent">
            <td style="width: 55%;">Agricultural Activitiess</td>
            <td style="width: 15%;">App. 3.15.4</td>
            <td style="width: 15%;">'.$sec['y7'].'</td>
            <td style="width: 15%;">'.$sec['y8'].'</td>
        </tr>
        <tr class="cent">
            <td style="width: 55%;">First Time Adoption of IFRS</td>
            <td style="width: 15%;">App. 3.15.5</td>
            <td style="width: 15%;">'.$sec['y9'].'</td>
            <td style="width: 15%;">'.$sec['y10'].'</td>
        </tr>
        <tr class="cent">
            <td style="width: 55%;">Parent where Consolidated Financial Statements are not Prepared</td>
            <td style="width: 15%;">App. 3.15.6</td>
            <td style="width: 15%;">'.$sec['y11'].'</td>
            <td style="width: 15%;">'.$sec['y12'].'</td>
        </tr>
        <tr class="cent">
            <td style="width: 55%;">First Time Adoption of IFRS 15 / 9</td>
            <td style="width: 15%;">App. 3.15.7</td>
            <td style="width: 15%;">'.$sec['y13'].'</td>
            <td style="width: 15%;">'.$sec['y14'].'</td>
        </tr>
        <tr class="cent">
            <td style="width: 55%;">First Time Adoption of IFRS 16</td>
            <td style="width: 15%;">App. 3.15.8</td>
            <td style="width: 15%;">'.$sec['y15'].'</td>
            <td style="width: 15%;">'.$sec['y16'].'</td>
        </tr>
    </tbody>
</table>
';
$pdf->writeHTML($html, true, false,false, false, '');
$pdf->AddPage();
$html = "";
$html .= $style;
$html .= '
    <p>For areas which are relevant, “Supplementary Checklist Completed” should be marked ‘Yes’, ‘No’ or ‘Not Applicable’ as appropriate.  Any ‘No’ answers must be fully explained.</p>
    <p><b>Contents</b></p>
    <table>
        <tbody>
            <tr>
                <td style="width: 15%;"><b>Section 1</b></td>
                <td style="width: 85%;"><b style="color: blue;">Format of the Annual Report and Generic Information</b><br></td>
            </tr>
            <tr>
                <td style="width: 15%;"><b>Section 2</b></td>
                <td style="width: 85%;"><b style="color: blue;">Directors Report (Review of the Business) ~ Best Practice Disclosures</b><br></td>
            </tr>
            <tr>
                <td style="width: 15%;"><b>Section 3</b></td>
                <td style="width: 85%;"><b style="color: blue;">Directors Report ~ Best Practice Disclosures</b><br></td>
            </tr>
            <tr>
                <td style="width: 15%;"><b>Section 4</b></td>
                <td style="width: 85%;"><b style="color: blue;">Statement of Comprehensive Income (SCI) and Related Notes</b><br></td>
            </tr>
            <tr>
                <td style="width: 15%;"><b>Section 5</b></td>
                <td style="width: 85%;"><b style="color: blue;">Statement of Changes in Equity</b><br></td>
            </tr>
            <tr>
                <td style="width: 15%;"><b>Section 6</b></td>
                <td style="width: 85%;"><b style="color: blue;">Statement of Financial Position and Related Notes</b><br></td>
            </tr>
            <tr>
                <td style="width: 15%;"><b>Section 7</b></td>
                <td style="width: 85%;"><b style="color: blue;">Statement of Cash Flows</b><br></td>
            </tr>
            <tr>
                <td style="width: 15%;"><b>Section 8</b></td>
                <td style="width: 85%;"><b style="color: blue;">Accounting Policies and Estimation Techniques</b><br></td>
            </tr>
            <tr>
                <td style="width: 15%;"><b>Section 9</b></td>
                <td style="width: 85%;"><b style="color: blue;">Notes and Other Disclosures</b><br></td>
            </tr>
        </tbody>
    </table>
    <p><b>Key to abbreviations used in the “Reference” column:</b></p>
    <table style="width: 50%;">
        <tbody>
            <tr>
                <td>IAS 1.82</td>
                <td>Paragraph 82 of IAS 1</td>
            </tr>
            <tr>
                <td>IFRS 15.110</td>
                <td>Paragraph 110 of IFRS 15</td>
            </tr>
        </tbody>
    </table>
';
$pdf->writeHTML($html, true, false,false, false, '');
$pdf->AddPage();
$html = "";
$html .= $style;
$html .= '
    <table border="1">
        <thead>
            <tr>
                <th  colspan="5"><b>Section 1 – Format of the Annual Report and Generic Information</b></th>
            </tr>
            <tr>
                <th style="width: 70%;" colspan="3"><b>Reference</b></th>
                <th style="width: 15%;" class="cent"><b>Y/N/NA</b></th>
                <th style="width: 15%;" class="cent"><b>Comments</b></th>
            </tr>
        </thead>
        <tbody>';
        foreach($sec1 as $r){
            $html .= '
            <tr>
                <td style="width: 13%;">'.$r['reference'].'</td>
                <td style="width: 7%;">'.$r['extent'].'</td>
                <td style="width: 50%;">'.$r['question'].'</td>
                <td style="width: 15%;">'.$r['yesno'].'</td>
                <td style="width: 15%;">'.$r['comment'].'</td>
            </tr>
            ';
        }
$html .= '
        </tbody>
    </table>
';
$pdf->writeHTML($html, true, false,false, false, '');
$pdf->AddPage();
$html = "";
$html .= $style;
$html .= '
    <table border="1">
        <thead>
            <tr>
                <th  colspan="5"><b>Section 2– Directors’ Report (Review of the Business) ~ Best Practice Disclosures</b></th>
            </tr>
            <tr>
                <th style="width: 70%;" colspan="3"><b>Reference</b></th>
                <th style="width: 15%;" class="cent"><b>Y/N/NA</b></th>
                <th style="width: 15%;" class="cent"><b>Comments</b></th>
            </tr>
        </thead>
        <tbody>';
        foreach($sec2 as $r){
            $html .= '
            <tr>
                <td style="width: 13%;">'.$r['reference'].'</td>
                <td style="width: 7%;">'.$r['extent'].'</td>
                <td style="width: 50%;">'.$r['question'].'</td>
                <td style="width: 15%;">'.$r['yesno'].'</td>
                <td style="width: 15%;">'.$r['comment'].'</td>
            </tr>
            ';
        }
$html .= '
        </tbody>
    </table>
';
$pdf->writeHTML($html, true, false,false, false, '');
$pdf->AddPage();
$html = "";
$html .= $style;
$html .= '
    <table border="1">
        <thead>
            <tr>
                <th  colspan="5"><b>Section 3 – Directors’ Report (Other) ~ Best Practice Disclosures</b></th>
            </tr>
            <tr>
                <th style="width: 70%;" colspan="3"><b>Reference</b></th>
                <th style="width: 15%;" class="cent"><b>Y/N/NA</b></th>
                <th style="width: 15%;" class="cent"><b>Comments</b></th>
            </tr>
        </thead>
        <tbody>';
        foreach($sec3 as $r){
            $html .= '
            <tr>
                <td style="width: 13%;">'.$r['reference'].'</td>
                <td style="width: 7%;">'.$r['extent'].'</td>
                <td style="width: 50%;">'.$r['question'].'</td>
                <td style="width: 15%;">'.$r['yesno'].'</td>
                <td style="width: 15%;">'.$r['comment'].'</td>
            </tr>
            ';
        }
$html .= '
        </tbody>
    </table>
';
$pdf->writeHTML($html, true, false,false, false, '');
$pdf->AddPage();
$html = "";
$html .= $style;
$html .= '
    <table border="1">
        <thead>
            <tr>
                <th  colspan="5"><b>Section 4 – Statement of Comprehensive Income (SCI) and Related Notes</b></th>
            </tr>
            <tr>
                <th style="width: 70%;" colspan="3"><b>Reference</b></th>
                <th style="width: 15%;" class="cent"><b>Y/N/NA</b></th>
                <th style="width: 15%;" class="cent"><b>Comments</b></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="5">IAS 1 paragraph 81A allows the SCI to be presented as either one or two statements (a profit and loss account and a SCI (which is a combination of the profit for the year plus items of other comprehensive income (OCI))).</td>
            </tr>
            ';
        foreach($sec4 as $r){
            $html .= '
            <tr>
                <td style="width: 13%;">'.$r['reference'].'</td>
                <td style="width: 7%;">'.$r['extent'].'</td>
                <td style="width: 50%;">'.$r['question'].'</td>
                <td style="width: 15%;">'.$r['yesno'].'</td>
                <td style="width: 15%;">'.$r['comment'].'</td>
            </tr>
            ';
        }
$html .= '
        </tbody>
    </table>
';
$pdf->writeHTML($html, true, false,false, false, '');
$pdf->AddPage();
$html = "";
$html .= $style;
$html .= '
    <table border="1">
        <thead>
            <tr>
                <th  colspan="5"><b>Section 5 – Statement of Changes in Equity</b>
                <p>NB1: This must be presented as a primary statement and not as a note to the financial statements.</p>
                <p>NB2: Per IAS 21 paragraph 52(a) there should be a column for foreign exchange differences that pass through OCI and accumulate in equity.</p>
            </th>
            </tr>
            <tr>
                <th style="width: 70%;" colspan="3"><b>Reference</b></th>
                <th style="width: 15%;" class="cent"><b>Y/N/NA</b></th>
                <th style="width: 15%;" class="cent"><b>Comments</b></th>
            </tr>
        </thead>
        <tbody>
            ';
        foreach($sec5 as $r){
            $html .= '
            <tr>
                <td style="width: 13%;">'.$r['reference'].'</td>
                <td style="width: 7%;">'.$r['extent'].'</td>
                <td style="width: 50%;">'.$r['question'].'</td>
                <td style="width: 15%;">'.$r['yesno'].'</td>
                <td style="width: 15%;">'.$r['comment'].'</td>
            </tr>
            ';
        }
$html .= '
        </tbody>
    </table>
';
$pdf->writeHTML($html, true, false,false, false, '');
$pdf->AddPage();
$html = "";
$html .= $style;
$html .= '
    <table border="1">
        <thead>
            <tr>
                <th  colspan="5"><b>Section 6 – Statement of Financial Position and Related Notes</b>
            </th>
            </tr>
            <tr>
                <th style="width: 70%;" colspan="3"><b>Reference</b></th>
                <th style="width: 15%;" class="cent"><b>Y/N/NA</b></th>
                <th style="width: 15%;" class="cent"><b>Comments</b></th>
            </tr>
        </thead>
        <tbody>
            ';
        foreach($sec6 as $r){
            $html .= '
            <tr>
                <td style="width: 13%;">'.$r['reference'].'</td>
                <td style="width: 7%;">'.$r['extent'].'</td>
                <td style="width: 50%;">'.$r['question'].'</td>
                <td style="width: 15%;">'.$r['yesno'].'</td>
                <td style="width: 15%;">'.$r['comment'].'</td>
            </tr>
            ';
        }
$html .= '
        </tbody>
    </table>
';
$pdf->writeHTML($html, true, false,false, false, '');
$pdf->AddPage();
$html = "";
$html .= $style;
$html .= '
    <table border="1">
        <thead>
            <tr>
                <th  colspan="5"><b>Section 7 – Statement of Cash Flows</b>
            </th>
            </tr>
            <tr>
                <th style="width: 70%;" colspan="3"><b>Reference</b></th>
                <th style="width: 15%;" class="cent"><b>Y/N/NA</b></th>
                <th style="width: 15%;" class="cent"><b>Comments</b></th>
            </tr>
        </thead>
        <tbody>
            ';
        foreach($sec7 as $r){
            $html .= '
            <tr>
                <td style="width: 13%;">'.$r['reference'].'</td>
                <td style="width: 7%;">'.$r['extent'].'</td>
                <td style="width: 50%;">'.$r['question'].'</td>
                <td style="width: 15%;">'.$r['yesno'].'</td>
                <td style="width: 15%;">'.$r['comment'].'</td>
            </tr>
            ';
        }
$html .= '
        </tbody>
    </table>
';
$pdf->writeHTML($html, true, false,false, false, '');
$pdf->AddPage();
$html = "";
$html .= $style;
$html .= '
    <table border="1">
        <thead>
            <tr>
                <th  colspan="5"><b>Section 8 – Accounting Policies and Estimation Techniques</b>
                <p>The following disclosures can be show as part of the notes to the financial statements or as a specific section in the financial statements [IAS 1.116].</p>
            </th>
            </tr>
            <tr>
                <th style="width: 70%;" colspan="3"><b>Reference</b></th>
                <th style="width: 15%;" class="cent"><b>Y/N/NA</b></th>
                <th style="width: 15%;" class="cent"><b>Comments</b></th>
            </tr>
        </thead>
        <tbody>
            ';
        foreach($sec8 as $r){
            $html .= '
            <tr>
                <td style="width: 13%;">'.$r['reference'].'</td>
                <td style="width: 7%;">'.$r['extent'].'</td>
                <td style="width: 50%;">'.$r['question'].'</td>
                <td style="width: 15%;">'.$r['yesno'].'</td>
                <td style="width: 15%;">'.$r['comment'].'</td>
            </tr>
            ';
        }
$html .= '
        </tbody>
    </table>
';
$pdf->writeHTML($html, true, false,false, false, '');
$pdf->AddPage();
$html = "";
$html .= $style;
$html .= '
    <table border="1">
        <thead>
            <tr>
                <th  colspan="5"><b>Section 9– Notes and Other Disclosures </b>
            </th>
            </tr>
            <tr>
                <th style="width: 70%;" colspan="3"><b>Reference</b></th>
                <th style="width: 15%;" class="cent"><b>Y/N/NA</b></th>
                <th style="width: 15%;" class="cent"><b>Comments</b></th>
            </tr>
        </thead>
        <tbody>
            ';
        foreach($sec9 as $r){
            $html .= '
            <tr>
                <td style="width: 13%;">'.$r['reference'].'</td>
                <td style="width: 7%;">'.$r['extent'].'</td>
                <td style="width: 50%;">'.$r['question'].'</td>
                <td style="width: 15%;">'.$r['yesno'].'</td>
                <td style="width: 15%;">'.$r['comment'].'</td>
            </tr>
            ';
        }
$html .= '
        </tbody>
    </table>
';
//$pdf->write1DBarcode($rdata['reservation_id'], 'S25+', '', '', '', 18, 0.4, $style, 'N');
//$pdf->Write(0, $html, '', 0, 'J', true);
$pdf->writeHTML($html, true, false,false, false, '');
$pdf->Output('stocktransfer.pdf','I');
exit();