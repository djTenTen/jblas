<?php
use \App\Models\ReportModel;
use setasign\Fpdi\Tcpdf\Fpdi;
$rp = new ReportModel;
// create new PDF document
$pageLayout = array(21, 29.7);
$pdf = new Fpdi('P', 'mm', 'A4');
// $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A4', true, 'UTF-8', false);
$pdf->setPrintFooter(false);
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('ApplAud: '.$firm);
$pdf->SetTitle('Workpaper: '.$client);
$pdf->SetSubject('Workpaper: '.$client);
$pdf->SetKeywords($firm);
// set default header data
//$pdf->SetHeaderData("headerdispatch.png", 65);
// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->setPrintHeader(false);
// set margins
$pdf->SetMargins(25,15,15);  
//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP-60, PDF_MARGIN_RIGHT);
//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetHeaderMargin(0);   
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}
$pdf->setPrintFooter(true);

function dtformat($dt){
    return date('F d, SY', strtotime($dt));
}

// ---------------------------------------------------------
// add a page
$pdf->AddPage('P');
//$pdf->SetPageSize('A4');
$style2 =  "
    <style>
        *{
            font-family: 'dejavusans';
            font-size: 12px;
        }
        h2{
            font-family: Arial, Helvetica, sans-serif;
            font-size: 15px;
        }
    </style>
";
$style =  "
    <style>
        *{
            font-family: 'Times New Roman', Times, serif;
            font-size: 13px;
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
$audsign = '<img src="'.base_url('uploads/img/'.$fID.'/signature/'.$cl['audsign']).'" alt="" srcset="" style="width: 100px; align-self: center;">';
$supsign = '<img src="'.base_url('uploads/img/'.$fID.'/signature/'.$cl['supsign']).'" alt="" srcset="" style="width: 100px; align-self: center;">';
$mansign = '<img src="'.base_url('uploads/img/'.$fID.'/signature/'.$cl['mansign']).'" alt="" srcset="" style="width: 100px; align-self: center;">';
$html = '';
    /**
        ----------------------------------------------------------
        FRONT PAGE
        ---------------------------------------------------------- 
    */
    $html .= '
        <hr style="color:blue;"> <br><br><br><br><br><br><br><br><br><br><br><br>
    ';
    $image_file = base_url('uploads/img/'.$fID.'/logo/'.$logo);
    $pdf->Image($image_file, $x = 74, $y = 50, $w = 75, $h = 0 , $type = '', $link = '', $align = 'center', $resize = true, $dpi = 300, $palign = '', $ismask = false, $imgmask = false, $border = 0, $fitbox = true, $hidden = false, $fitonpage = false, $alt = '');
    $html .= '
        <table>
            <tr>
                <td style="text-align: center;"></td>
            </tr>
            <tr>
                <td style="text-align: center;"><br><br><br><br><br><br><br></td>
            </tr>
            <tr>
                <td style="text-align: center;"><br><br></td>
            </tr>
            <tr>
                <td><h1 style="color:#7752FE; text-align:center;">'.$firm.'</h1><br><br></td>
            </tr>
            <tr>
                <td><h1 style="color:#7752FE; text-align:center;">'.$client.'</h1></td>
            </tr>
            <tr>
                <td><h3 style="text-align:center;">Workpaper - FY'.$fy.'</h3></td>
            </tr>
        
        </table>
    ';
    $html .='
        <br><br><br><br><br><br><br>
        <br><br><br><br><br><br><br>
        <table style="margin-top: 50px;">
            <tbody>
                <tr>
                    <td style="width: 20%;">Prepared by:</td>
                    <td><b>'.$aud.'</b></td>
                </tr>
                <tr>
                    <td style="width: 20%;">Reviewed by:</td>
                    <td><b>'.$sup.'</b></td>
                </tr>
                <tr>
                    <td style="width: 20%;">Manager:</td>
                    <td><b>'.$audm.'</b></td>
                </tr>
            </tbody>
        </table>
    ';
    $pdf->writeHTML($html, true, false,false, false, '');
    $html = '';


    /**
        ----------------------------------------------------------
        INTRODUCTION PDF GENERATOR
        ---------------------------------------------------------- 
    */
    $pdf->AddPage('P');
    $pdf->Bookmark('Introduction',0,0);
    $html .= '<hr style="color:blue;">';
    $html .= '<h1 style="color:#7752FE;text-align:center;">INTRODUCTION</h1>';
    $html .= '<hr style="color:blue;">';
    $html .= '<p style="color:black;">The purpose of this Audit Quality Management System (QMS) Manual is to outline procedures and guidelines for conducting financial audits efficiently and effectively in small and medium audit firms. This manual ensures compliance with the International Standards on Auditing (ISA) and local regulations, despite limited resources.</p>';
    $pdf->writeHTML($html, true, false,false, false, '');
    $html = '';


    /**
        ----------------------------------------------------------
        SOQM PDF GENERATOR
        ---------------------------------------------------------- 
    */
    $pdf->AddPage('P');
    $pdf->Bookmark('System of Quality Management (SOQM) Manual',0,0);
    $html .= '<hr style="color:blue;">';
    $html .= '<h1 style="color:#7752FE;text-align:center;">System of Quality Management (SOQM) Manual</h1>';
    $html .= '<hr style="color:blue;">';
    $pdf->writeHTML($html, true, false,false, false, '');
    $html = '';
    if($soqm['soqm'] == 'Uploaded'){
        if($sd['soqm_data'] != ''){
            // Set the source PDF file 
            $pageCount = $pdf->setSourceFile(ROOTPATH.'public/uploads/pdf/soqm/'.$fID.'/'.$sd['soqm_data']);
            // Iterate through all pages and import them
            for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
                $templateId = $pdf->importPage($pageNo);
                $size = $pdf->getTemplateSize($templateId);
                // Create a new page in TCPDF with the same size as the imported page
                $pdf->AddPage($size['orientation'], array($size['width'], $size['height']));
                // Use the imported page as a template
                $pdf->writeHTMLCell(0, 0, 10, 10, $html, 0, 1, 0, true, '', true);
                $pdf->useTemplate($templateId, 0, 20);
            }
        }
    }
    if($soqm['soqm'] == 'Using'){
        $html .= $style2;
        $html .= '
            <table>
                <tr>
                    <td style="text-align: center;"></td>
                </tr>
                <tr>
                    <td style="text-align: center;"><br><br><br></td>
                </tr>
                <tr>
                    <td style="text-align: center;"><br><br></td>
                </tr>
                <tr>
                    <td><h1 style="color:#7752FE; text-align:center; font-size:40px;">System of Quality Management (SOQM) Manual </h1></td>
                </tr>
                <tr>
                    <td><h1 style="color:#7752FE; text-align:center; font-size:30px;">of</h1></td>
                </tr>
                <tr>
                    <td><h1 style="color:#7752FE; text-align:center; font-size:40px;">'.$sd['prac'].'</h1></td>
                </tr>
            
            </table>
        ';
        $pdf->writeHTML($html, true, false,false, false, '');
        $pdf->AddPage();
        $html = '';
        $html .= $style;
        $html .= '
            <h2>CHAPTER 1: POLICY STATEMENT</h2>
            <h4>General Quality Policy Statement</h4>
            <p>The CPA practitioner\'s objective is to consistently uphold and enhance the quality of its services. This includes the development, implementation, and continual refinement of a robust system of quality management (SOQM) that at the minimum, meets the requirements outlined in the Philippine Standard on Quality Management (PSQM) 1, Quality Management for Firms that Perform Audits or Reviews of Financial Statements, or Other Assurance or Related Services Engagement and PSQM 2, Engagement Quality Reviews.</p>
            <p>The CPA practitioner requires that relevant and appropriate documentation be in place to provide evidence of the operation of its SOQM.</p>
            <p>The CPA practitioner\'s SOQM manual is provided to all team members, by providing both digital and physical copies. Furthermore, the CPA practitioner acknowledges the dynamic nature of quality objectives, risks, and responses. Thus, it actively fosters an environment where every team member is empowered to contribute to their continual enhancement.</p>
            <p>Every team member within the firm bears a shared responsibility for upholding quality and is accountable for complying with all established policies and procedures. Any revisions to the SOQM manual or the CPA practitioner\'s policies and procedures will be communicated to all members during regular team meetings.</p>
            <p>Documents pertaining to the SOQM shall be retained for a minimum of 5 years, ensuring compliance with regulatory requirements and professional standards.</p>
            <h4>Foreword</h4>
            <p>As the individual with ultimate responsibility and accountability for the System of Quality Management (SQM) at '.$sd['prac'].' I affirm my unwavering commitment to upholding the highest standards of quality, integrity, and professionalism in all our audit engagements.</p>
            <p>Our SQM is designed to ensure compliance with applicable standards, laws, and regulations, as well as to meet the expectations of clients, stakeholders, and the public. It reflects our dedication to fostering an environment where independence, competence, and ethical behavior are paramount.</p>
        ';
        $pdf->writeHTML($html, true, false,false, false, '');
        $pdf->AddPage();
        $html = '';
        $html .= $style;
        $html .= ' <h2>'.$sd['prac'].'</h2>';

        if($sd['bg'] != 'N/A'){ $html .= '<h4>Background</h4><p>'.$sd['bg'].'</p>';}
        if($sd['cs'] != 'N/A'){ $html .= '<h4>The firm\'s core services are centered on:</h4><p>'.$sd['cs'].'</p>';}
        if($sd['cq'] != 'N/A'){ $html .= '<h4>Commitment to Quality</h4><p>'.$sd['cq'].'</p>';}
        if($sd['cp'] != 'N/A'){ $html .= '<h4>Core Principles</h4><p>'.$sd['cp'].'</p>';}
        $html .= '<h4>Firm\’s Mission and Vision</h4>';
        if($sd['phil'] != 'N/A'){ $html .= '<h4>Philosophy</h4><p>'.$sd['phil'].'</p>';}
        if($sd['miss'] != 'N/A'){ $html .= '<h4>Mission</h4><p>'.$sd['miss'].'</p>';}
        if($sd['viss'] != 'N/A'){ $html .= '<h4>Vision</h4><p>'.$sd['viss'].'</p>';}
        if($sd['fg'] != 'N/A'){ $html .= '<h4>Firm\'s Goal!</h4><p>'.$sd['fg'].'</p>';}
        if($sd['rwt'] != 'N/A'){ $html .= '<h4>Relationship with the Team</h4><p>'.$sd['rwt'].'</p>';}
        if($sd['appr'] != 'N/A'){ $html .= '<h4>Our approach includes:</h4><p>'.$sd['appr'].'</p>';}
        if($sd['fs'] != 'N/A'){ $html .= '<h4>Firm Size</h4><p>'.$sd['fs'].'</p>';}
        if($sd['cr'] != 'N/A'){ $html .= '<h4>Client Relationship</h4><p>'.$sd['cr'].'</p>';}
        if($sd['csa'] != 'N/A'){ $html .= '<h4>Client Service Approach</h4><p>'.$sd['csa'].'</p>';}
        if($sd['gd'] != 'N/A'){ $html .= '<h4>Geographic Details</h4><p>'.$sd['gd'].'</p>';}

        $pdf->writeHTML($html, true, false,false, false, '');
        $pdf->AddPage();
        $html = '';
        $html .= $style;
        $html .= '
            <h2>CHAPTER 2: RISK ASSESSMENT PROCESS </h2>
            <p>The CPA Practitioner applies a risk-based approach in designing, implementing and operating the components of the SOQM in an interconnected and coordinated manner such that the CPA Practitioner proactively manages the quality of engagements it performs.</p>
            <p>The CPA Practitioner designs and implements a risk assessment process to establish quality objectives, identify and assess quality risks and design and implement responses to address the quality risks.</p>
            
            <h4>Quality objectives</h4>
            <p>Quality objectives are the desired outcomes in relation to the components of the SOQM to be achieved by the CPA Practitioner.</p>
            <p>The CPA Practitioner has established the quality objectives specified in paragraphs 28-33 of PSQM</p>
            <p>The firm has not identified any additional quality objectives considered necessary to achieve the objectives of the system of quality management. The quality objectives the CPA Practitioner has established are kept under regular review to ensure they reflect any relevant changes.</p>
            <h4>Quality Risks</h4>
            <p>A quality risk is a risk that has a reasonable possibility of:</p>
            <ol type="a">
                <li>) Occurring; and</li>
                <li>) Individually, or in combination with other risks, adversely affecting the achievement of one or more quality objectives.</li>
            </ol>
            <p>The CPA Practitioner identifies and assesses quality risks to provide a basis for the design and implementation of responses. In doing so, the CPA Practitioner:</p>
            <ol type="a">
                <li>Obtains an understanding of the conditions, events, circumstances, actions or inactions that may adversely affect the achievement of the quality objectives, including:
                    <ul>
                        <li>With respect to the nature and circumstances of the firm, those relating to:
                            <ul>
                                <li>The complexity and operating characteristics of the firm;</li>
                                <li>The strategic and operational decisions and actions, business processes and business model of the firm;</li>
                                <li>The characteristics and management style of leadership:</li>
                                <li>The resources of the firm, including the resources provided by service providers; and Law, regulation, auditing and assurance standards and the environment in which the firm operates.</li>
                            </ul>
                        </li>
                        <li>With respect to the nature and circumstances of the engagements performed by the CPA Practitioner, those relating to:
                            <ul>
                                <li>The types of engagements performed by the CPA Practitioner and the reports to be issued; and</li>
                                <li>The types of entities for which such engagements are undertaken.</li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li>) Taking into account how, and the degree to which, these conditions, events, circumstances, actions or inactions may adversely affect the achievement of the quality objectives.</li>
            </ol>
            <h4>Responses</h4>
            <p>Responses (in relation to a system of quality management) are policies or procedures that are designed and implemented by the firm to address one or more quality risk(s):</p>
            <ol type="a">
                <li>) Policies are statements of what should, or should not, be done to address a quality risk(s). Such statements may be documented, explicitly stated in communications or implied through actions and decisions.</li>
                <li>) Procedures are actions to implement policies.</li>
            </ol>
            <p>The CPA Practitioner designs and implements responses to address identified and assessed quality risks in a manner that is based on, and responsive to, the reasons for the assessments given to those quality risks. The firm\'s responses include the responses specified in paragraph 34 of ISQM 1.</p>
            <h4>Iterative approach</h4>
            <p>The CPA Practitioner\'s SOQM operates in a continual and non-linear manner and is responsive to changes in the nature and circumstances of the firm and its engagements.</p>
            <p>The results of monitoring and remediation activities, results of external inspections and other relevant information (e.g., complaints and allegations) may identify information that indicates additional quality objectives, or additional or modified quality risks or responses, are needed due to changes in the nature and circumstances of the firm or its engagements. If such information is identified, the CPA Practitioner considers the information and when appropriate:</p>
            <ol type="a">
                <li>) Establishes additional quality objectives or modifies additional quality objectives already established by the CPA Practitioner:</li>
                <li>) Identifies and assesses additional quality risks, modifies the quality risks or reassesses the quality risks; or</li>
                <li>) Designs and implements additional responses or modifies the existing responses.</li>
            </ol>
            <h4>Risk Assessment Matrix</h4>
            <p>The CPA Practitioner\'s risk assessment matrix is in Appendix A.</p>
        ';

        $pdf->writeHTML($html, true, false,false, false, '');
        $pdf->AddPage();
        $html = '';
        $html .= $style;
        $html .= '

            <h2>CHAPTER 3: GOVERNANCE AND LEADERSHIP</h2>
            <p>This Chapter outlines the policies and procedures that address the firm\'s governance and leadership.</p>


            <h4>PSQM 1.28 sets out the following objectives:</h4>
            <ol type="a">
                <li>) The firm demonstrates a commitment to quality through a culture that exists throughout the firm, which recognizes and reinforces:
                    <ol type="i">
                        <li>) The firm\'s role in serving the public interest by consistently performing quality engagements; </li>
                        <li>) The importance of professional ethics, values and attitudes;</li>
                        <li>) The responsibility of all personnel for quality relating to the performance of engagements or activities within the system of quality management, and their expected behavior; and </li>
                        <li>) The importance of quality in the firm\'s strategic decisions and actions, including the firm\'s financial and operational priorities.</li>
                    </ol>
                </li>
                <li>) Leadership is responsible and accountable for quality.</li>
                <li>) Leadership demonstrates a commitment to quality through their actions and behaviors.</li>
                <li>) The organizational structure and assignment of roles, responsibilities and authority is appropriate to enable the design, implementation and operation of the firm\'s system of quality management.</li>
                <li>) Resource needs, including financial resources, are planned for and resources are obtained, allocated or assigned in a manner that is consistent with the firm\'s commitment to quality.</li>
            </ol>

            <h4>GENERAL</h4>
            <p>GL.01 The CPA Practitioner\'s objective is to demonstrate the firm\'s commitment to promoting a culture of quality reinforced by designing, implementing and operating its own SOQM both at the firm level and the engagement level.</p>
            <p>GL.02 The CPA Practitioner shall evaluate the SOQM on an annual basis to ensure that the system is responsive to the nature and circumstances faced by the firm. After evaluation, the CPA Practitioner shall improve and regularly update the SOQM Manual. The update shall include all relevant policies, procedures and guidelines.</p>

            <h4>ASSIGNMENT OF LEADERSHIP RESPONSIBILITIES</h4>
            <p>GL.03 The CPA Practitioner is the ultimate responsible and accountable for the system of quality management.</p>
            <p>GL.04 The CPA Practitioner shall assign the operational responsibility for the firm\’s system of quality management to the administrative department in charge.</p>
            <p>GL.05 The assignment of responsibilities shall be documented by utilizing GL-Form-01 Assignment of Ultimate and Operational Responsibility and Accountability.</p>
            
            <h4>Commitment to Quality</h4>
            <p>GL.06 The CPA Practitioner shall create and adhere to Mission, Vision, and Core Values that will emphasize the commitment of the firm to quality through clear and consistent communication about the SOQM, leadership actions and behavior in performing engagements, and the importance of compliance with ethical and professional standards.</p>

            <p>GL.07 The CPA Practitioner shall ensure the continuous development of professional ethics, values, and attitudes through the following measures:</p>
            <ul>
                <li>Provide employee handbooks for all firm personnel.</li>
                <li>Conduct or provide training and seminars tailored to industry-specific engagements.</li>
                <li>Allocate time and financial budgets for seminars and training to enhance the quality of work.</li>
                <li>Offer in-house training and activities for all personnel, from partners to junior staff.</li>
                <li>Develop comprehensive training materials or manuals covering key aspects of PSQM processes and requirements.</li>
                <li>Organize regular training sessions or workshops to keep personnel updated on changes or developments in PSQM practices.</li>
                <li>Provide access to online resources, databases, or libraries containing relevant literature and research on quality management.</li>
                <li>Ensure proper communication to all personnel, if any.</li>
            </ul>

            <p>GL.08 The CPA Practitioner shall assign experienced or seasoned staff to all its audit engagements.</p>
            <p>GL.09 The CPA Practitioner shall encourage participation of the firm personnel in industry conferences, seminars as part of its continuous professional development.</p>
            <p>GL.10 The CPA Practitioner shall collaborate with external consultants or experts to supplement internal expertise where needed.</p>
            <p>GL.11 The CPA Practitioner shall implement a system for knowledge sharing and documentation, of lessons learned to facilitate continuous quality improvement.</p>
            <h4>Responsibility over Quality</h4>
            <p>GL.12 The CPA Practitioner shall recognize the need for the individual who has been assigned ultimate responsibility and accountability for the SOQM and operational responsibility for the firm\'s SOQM to have the appropriate experience, competence, knowledge, influence and authority within the firm.</p>
            <p>GL.13 The CPA Practitioner shall ensure that the individuals assigned have the appropriate experience, knowledge, influence, and authority,and have sufficient time to discharge their duties and understand their roles and responsibilities.</p>
            <h4>Annual Performance Review</h4>
            <p>GL.14 As required by PSQM 1 Para 56, the CPA Practitioner shall undertake annual performance evaluations of the individuals assigned ultimate responsibility and accountability for the system of quality management, and the individuals assigned operational responsibility for the SOQM including any operational responsibility assigned for specific aspects of the SOQM. The performance evaluation shall be considered in the evaluation of the SOQM as further laid out in Chapter 9, Monitoring and Remediation Process.</p>
            <p>GL.15 The CPA Practitioner shall conduct annual performance reviews of all employees that include an appraisal of demonstrated commitment to quality. (For further guidance, please refer to Chapter 7, Resources)</p>
            <h4>Communication on Leadership</h4>
            <p>GL.16 The CPA practitioner shall regularly issue quality communications to all staff, with a special focus on audit personnel. These communications shall cover the following:</p>
            <ul>
                <li>Issuance and Updates of the SOQM Manual: Including an annual statement emphasizing the continuous commitment to maintaining high-quality standards at all times.</li>
                <li>Significant Updates on Other Relevant Manuals, Policies, and Procedures: Ensuring that all personnel are informed of any critical changes or enhancements.</li>
                <li>General Assemblies and Important Team Meetings: Providing essential updates and reinforcing the importance of quality in all activities.</li>
            </ul>
            <p>GL.17 The CPA Practitioner shall take responsibility for clear, consistent, and effective actions being taken that reflect the firm\'s commitment to quality and establish and communicate the expected behavior of engagement team members, including emphasizing:</p>
            <ol type="a">
                <li>) That all engagement team members are responsible for contributing to the management and achievement of quality at the engagement level;</li>
                <li>) The importance of professional ethics, values and attitudes to the members of the engagement team;li>
                <li>) The importance of open and robust communication within the engagement team, and supporting the ability of engagement team members to raise concerns without fear of reprisal; and</li>
                <li>) The importance of each engagement team member exercising professional skepticism throughout the audit engagement.</li>
            </ol>
            <h4>Organizational Structure</h4>
            <p>GL.18 The CPA Practitioner shall design and update their organizational structure on an annual basis to ensure that the implementation and operation of a system of quality management would be feasible and clearly understandable. The organizational structure of the Firm is in GL-Form-02.</p>
            <h4>Resources</h4>
            <p>GL.19 The CPA Practitioner shall provide sufficient and adequate resources for the improvement and implementation of the SOQM as embedded in the firm\'s strategic planning and annual budget.</p>
        ';

        $pdf->writeHTML($html, true, false,false, false, '');
        $pdf->AddPage();
        $html = '';
        $html .= $style;
        $html .= '
            <h2>CHAPTER 4: RELEVANT ETHICAL REQUIREMENTS</h2>
            <p>This Chapter outlines the policies and procedures for the Relevant Ethical Requirements.</p>
            <p>PSQM 1.29 sets out the following quality objectives:</p>
            <ol type="a">
                <li>) The firm and its personnel:
                    <ol type="i">
                        <li>) Understand the relevant ethical requirements to which the firm and the firm\'s engagements are subject; and</li>
                        <li>) Fulfill their responsibilities in relation to the relevant ethical requirements to which the firm and the firm\'s engagements are subject.
                    </ol>
                </li>
            </ol>
            <h4>General</h4>
            <p>RER.01 As a general policy, the CPA Practitioner shall:</p>
            <ul>
                <li>remain alert, throughout the audit engagement process, through observations and making inquiries as necessary, for evidence of non-compliance with relevant ethical requirements by members of the engagement team; and</li>
                <li>determine the appropriate action, in consultation with others in the firm (as applicable), if matters come to the attention of the CPA Practitioner that members of the engagement team have not complied with the relevant ethical requirements.</li>
            </ul>
            <h4>Fundamental Principles</h4>
            <p>RER.02 The CPA Practitioner and its personnel shall comply with the following fundamental principles which align with the lESBA Code of Ethics:</p>
            <ul>
                <li>Integrity - should conduct oneself with honesty and clarity in all business and professional interactions or dealings.</li>
                <li>Objectivity and Independence - to prevent prejudice, conflicts of interest, or excessive influence from others from superseding business or professional judgments.</li>
                <li>Professional Competence and Due Care - to keep one\'s professional knowledge and skills up to date so that one can continue to provide competent services to clients based on the latest tools, laws, and procedures; additionally, one must act conscientiously and in compliance with relevant professional and technical standards.</li>
                <li>Confidentiality - to protect the privacy of information obtained through business and professional relationships, the CPA Practitioner shall refrain from disclosing any such information to unapproved parties unless required by law or another professional relationship. Also, the CPA Practitioner shall avoid using such information for the professional accountant\'s or any other party\'s personal gain.</li>
                <li>Professional Behaviour - must adhere to all applicable rules and laws and refrain from doing any actions that would bring the profession into disrepute.</li>
                <li>Public Interest - members of the engagement team understand their obligation to work in the public interest.</li>
            </ul>
            <p>RER.03 The CPA Practitioner is responsible for determining and putting in place protective measures that can be used to lessen any perceived risks to the aforementioned fundamental principles.</p>
            <p>RER.04 The CPA Practitioner shall designate a person in charge or individual with operational responsibility for Independence (refer also to Chapter 3, Governance and Leadership).</p>
            <p>The CPA practitioner shall identify a responsible person in charge of compliance with ethical requirements in the organization. He/She shall regularly conduct monitoring and evaluations to verify adherence with the assigned role and responsibilities.</p>
            <p>RER.05 The CPA Practitioner and its personnel shall familiarize and update themselves with appropriate knowledge of the IESBA Code of Ethics and any other policy pertinent to relevant ethical requirements and standards to be able to fulfill and discharge their responsibilities while performing an engagement. In cases of conflict or inconsistency between the IESBA code and the ethical standards of the relevant jurisdiction during their application, the standards of that jurisdiction shall take precedence.</p>
            <h4>Mission, Vision and Core Values</h4>
            <p>RER.06 The CPA Practitioner and its personnel shall act in accordance with the principles of its Mission, Vision and Core Values listed in Chapter 1 of this Manual.</p>
            <h4>Independence Policy Update</h4>
            <p>RER.07 At least annually, the CPA Practitioner reviews the independence section of its manual or policy to ensure that specific guidelines are updated and approved before their release to intended users.</p>
            <p>RER.08 The CPA Practitioner shall ensure that its personnel are kept up to date on relevant ethical requirements through the issuance of regular memos in cases of updates or changes in the IESBA Code of Ethics, the relevant jurisdiction\'s ethical standards, or the CPA Practitioner\'s ethical guidance, if any.</p>
            <h4>Relevant Ethical Requirements Training / Orientation</h4>
            <p>RER.09 The CPA Practitioner and its personnel shall attend and complete the related or associated ethical and independence requirements training in order for them to keep updated and abreast with all the relevant ethical and independence requirements. This will apply to all personnel both old and new hires while onboarding.</p>
            <p>Also, the CPA Practitioner shall ensure that proper orientation during the onboarding process of the new hires about the relevant ethical requirements has been conducted and is fully understood by them before handling an audit engagement.</p>
            <p>The CPA Practitioner may craft training programs with the following considerations:</p>
            <ol type="a">
                <li>) Mandatory ethics training sessions for all employees annually.</li>
                <li>) Discuss the firm\'s code of ethics, real-world scenarios, and the importance of professional values and attitudes.</li>
                <li>) Utilize a combination of in-person workshops, online courses, and interactive sessions.</li>
            </ol>
            <p>RER.10 In cases where the engagement team members were not provided with adequate resources to attend external seminars, the CPA Practitioner, through the individual in charge of the training, shall conduct an internal seminar/webinar/echo seminar. An attendance sheet shall be accomplished and retained accordingly.</p>
            <p>RER.11 The CPA Practitioner shall set up procedures to track completion of the mandatory training including the Code of Conduct training within the allotted time and report cases of non-completion to the appropriate level of authority for possible inclusion in a quality breach log or other similar record. The CPA Practitioner shall include ethical conduct as a key performance indicator in leadership evaluations and appraisals.</p>
            <p>RER.12 On an annual basis, the CPA Practitioner shall review the content of local ethics and independence training and ascertain that it is updated based on the latest regulations or standards.</p>
            <h4>Personnel Independence and Objectivity</h4>
            <p>RER.13 Each member of the engagement team shall complete an Annual Independence Confirmation RER-Form-01 based on the independence requirements of the lESBA Code of Ethics, to identify if there are situations or cases that could compromise independence. This will apply to personnel both old and new hi while onboarding. For new hires, an independence declaration shall be completed within the first week of employment. All responses to the independence declaration shall be reviewed by the CPA Practitioner and follow up on any exceptions noted, and confirm any breach as at the submission date for inclusion to the quality breach log, if any.</p>
            <p>RER.14 The CPA Practitioner and the members of the engagement team must sign an independence confirmation stating that there is no financial interest or conflict of interest if a new client prospect is found and captured as an opportunity. This documentation will be part of and maintained in the audit file.</p>
            <p>RER.15 The CPA practitioner shall review annual independence declarations submitted by the personnel and follow up on exceptions noted and confirm potential breaches identified, and non-responders at the submission date. Personnel who have not submitted the required independence declaration and have potential breaches are included in the quality breach log and shall be marked as such during the year-end performance evaluation process.</p>
            <p>RER.16 The CPA Practitioner shall have an appropriate and effective organizational and administrative arrangement to prevent, identify, eliminate, or manage and disclose any threats to the firm\'s independence required by the ISBA Code of Ethics by completing an Annual Independence Confirmation in RER-Form-01 or Engagement Independence Declaration.</p>
            <h4>Data Privacy and Non-Disclosure Agreement</h4>
            <p>RER.17 The CPA Practitioner and its personnel shall be required to fill or accomplish the RER-Form-02 Data Privacy and Non-Disclosure Agreement of information including those new hires while onboarding. The CPA Practitioner shall use encrypted and password-protected external drives to transfer information. Alternatively, files can be sent through email and sensitive data files shall be password-protected.</p>
            <h4>Independence Breaches and Ethical Threats</h4>
            <p>RER.18 The CPA Practitioner shall ensure that no  member of the firm intervenes in the carrying out of an engagement in any way that jeopardizes the Firm\'s independence and objectivity in carrying out such work.</p>
            <p>RER.19 The CPA Practitioner shall update its client listing regularly, i.e., monthly, ensuring that its personnel stay informed about any potential breaches of ethical requirements concerning new clients added to the list.</p>
            <p>RER.20 If the CPA Practitioner believes or determines that a breach of ethical obligation has occurred, the following actions shall be undertaken:</p>
            <ul>
                <li>Terminate, put on hold, or cut off the relationship or interest that gave rise to the breach.</li>
                <li>Assess the scope or importance of the breach and how it affects the firm\'s impartiality and capacity to provide the service.</li>
                <li>Ascertain whether steps may be made to adequately address the breach\'s implications.</li>
            </ul>
            <p>RER.21 The CPA Practitioner shall be responsible for ensuring that a clear documentation process is in place that describes how to identify, escalate, and monitor noncompliance with Firm policy, as well as how to report noncompliance relating to independence or ethical conflicts.</p>
            <p>In order to conduct a formal or informal resolution process, those involved shall consider the following information:</p>
            <ul>
                <li>Relevant facts;</li>
                <li>Ethical issues involved;</li>
                <li>Fundamental principles related to the matter in question;</li>
                <li>Established internal procedures; and</li>
                <li>Alternative courses of action.</li>
            </ul>
            <p>An Independence Resolution Memorandum in RER-Form-03 shall be used whenever there is a potential threat to independence has been determined.</p>
            <p>RER.22 If an ethical conflict remains unresolved, the engagement team including the partners and staff may determine that, in the circumstances, it is appropriate to withdraw from the engagement or specific assignment or to resign from the engagement.</p>
            <h4>Third-Party Personnel / Service Provider or Contractor</h4>
            <p>RER.23 The CPA Practitioner shall require its third-party personnel or service provider to read and understand the SOQM Manual and the relevant ethical requirements and assess these ethical requirements in discharging its duties and responsibilities.</p>
            <p>RER.24 Third-Party Personnel / Service Provider shall at all times conduct its business affairs in compliance with the policies and procedures of the CPA Practitioner. To that end, the service provider and service provider\'s representatives, agents, and employees shall not directly or indirectly make an offer, payment, or authorize a payment, gift, or anything of value for the purpose of influencing an act or decision of any firm\'s leadership in order to obtain or retain service under certain agreement. A Statement of Absence of Conflict of Interest / Declaration of Absence of Conflict of Interest and Confidentiality in RER-Form-04 shall be provided.</p>
            <p>RER.25 The Data Privacy and Non-Disclosure Agreement of information shall also be accomplished and filled out by the third-party personnel/service provider/contractor.</p>
            <h4>Whistleblowing and Complaints Policy</h4>
            <p>RER.26 The CPA Practitioner shall have a whistleblowing and complaints policy and reporting procedures published or posted on their website, bulletin board, or any conspicuous place, as the case may</p>
            <p>RER.26 The CPA Practitioner shall have a whistleblowing and complaints policy and reporting procedures published or posted on their website, bulletin board, or any conspicuous place, as the case may</p>
            <ul>
                <li>The policy makes clear the procedures for filing internal complaints and ethical issues, as well as the escalation procedures in the event of a dispute or disagreement; and</li>
                <li>Personnel are informed about the confidential reporting method by posting it on the CPA Practitioner\'s website, bulletin board, or in another obvious place within the building.</li>
            </ul>
            <h4>Access Rights to Whistleblowing / Complaint Box</h4>
            <p>RER.28 The CPA Practitioner shall designate an authorized individual to open and access the data in the whistleblowing/complaint box.</p>
            <p>RER.29 The person designated to retrieve information from the whistleblowing/complaint box shall be accountable for looking into and recording all reported issues, both internal and external, and their suggested solutions shall be evaluated and approved by the leadership of the Firm.</p>
            <p>RER.30 All the reported matters shall be maintained, summarized, and taken care of with utmost confidentiality.</p>
            <p>RER.31 The CPA Practitioner shall set up policies and processes intended to give it a reasonable level of certainty regarding how it handles:</p>
            <ul>
                <li>Claims and complaints alleging that the [Firm/CPA practitioner\'s work does not adhere to the relevant legal and regulatory requirements as well as professional standards;</li>
                <li>Claims of non-adherence to the quality control system of the CPA Practitioner; and</li>
                <li>Potential and actual claims.</li>
            </ul>
            <p>Complaints can be categorized as follows: fee disputes, delay, failure to respond to correspondence, failure to carry out duties, and poor work or advice.</p>
            <h4>Recording of Complaints and Allegations</h4>
            <p>RER.32 Written acknowledgment of receipt of all complaints is required, along with an explanation of the complaint\'s handling procedure. Every step will be recorded since, at some point, a regulator, a court, or any other third party may review this correspondence regarding a complaint. A Client Complaint Record in RER-Form-05 should be accomplished in relation to complaints from clients.</p>
            <h4>Investigation Process</h4>
            <p>RER.33 In the event that a complaint is received, it must be looked into right away by an impartial third party who will ascertain all necessary information through conversation with the engagement team members and an examination of pertinent files or working documents.</p>
            <p>RER.34 Corrective action shall be performed right away if the complaint is found to be valid.</p>
            <p>RER.35 In the event that the inquiry finds no basis for the complaint, the complainant shall be informed in writing and through a meeting or phone conversation. It is important to keep client confidentiality private.</p>
            <h4>SPECIFIED RESPONSES REQUIRED BY PSQM 1</h4>
            <p>PSQM 1. Para. (34) requires:</p>
            <ol type="a">
                <li>) The firm establishes policies or procedures for:
                    <ol type="i">
                        <li>) Identifying, evaluating and addressing threats to compliance with the relevant ethical requirements; and</li>
                        <li>) Identifying, communicating, evaluating and reporting of any breaches of the relevant requirements and appropriately responding to the causes and consequences of the bre a timely manner.</li>
                    </ol>
                </li>
                <li>) The firm obtains, at least annually, a documented confirmation of compliance with independence requirements from all personnel required by relevant ethical requirements to be independent</li>
                <li>) The firm establishes policies or procedures for receiving, investigating and resolving complaints and allegations about failures to perform work in accordance with professional PSQM 1 standards applicable legal and regulatory requirements, or non-compliance with the firm\'s policies or pro established in accordance with this PSQM.</li>
            </ol>
        ';

        $pdf->writeHTML($html, true, false,false, false, '');
        $pdf->AddPage();
        $html = '';
        $html .= $style;
        $html .= '
            <h2>CHAPTER 5: ACCEPTANCE AND CONTINUANCE OF CLIENT RELATIONSHIPS AND SPECIFIC ENGAGEMENTS</h2>
            <p>This Chapter outlines the policies and procedures for the acceptance and continuance of client relationships and specific engagements.</p>
            <p>PSQM 1.30 sets out the following quality objectives:</p>
            <ol type="a">
                <li>) Judgments by the firm about whether to accept or continue a client relationship or specific engagement are appropriate based on:
                    <ol type="i">
                        <li>) Information obtained about the nature and circumstances of the engagement and the integrity and ethical values of the client (including management, and, when appropriate, those charged with governance) that is sufficient to support such judgments; and</li>
                        <li>) The firm\'s ability to perform the engagement in accordance with professional standards and applicable legal and regulatory requirements.</li>
                    </ol>
                </li>
                <li>) The financial and operational priorities of the firm do not lead to inappropriate judgments about whether to accept or continue a client relationship or specific engagement.</li>
            </ol>
            <h4>GENERAL</h4>
            <p>AC.01 As a general policy, the CPA Practitioner will accept new or continue client relationships or engagements only if:</p>
            <ul>
                <li>The CPA Practitioner has considered the nature and circumstances of the engagement and the integrity and ethical values of the prospective clients;</li>
                <li>The CPA Practitioner is compliant with the relevant ethical requirements; and</li>
                <li>The CPA Practitioner is competent to undertake the work and has sufficient time and resources to do so.</li>
            </ul>
            <p>When accepting or continuing engagements, the CPA Practitioner must prioritize quality above financial and operational considerations.</p>
            <h4>ACCEPTING NEW CLIENTS</h4>
            <p>AC.02 The CPA Practitioner shall conduct a comprehensive evaluation before accepting engagements/ relationships from new clients. The CPA Practitioner should include the following factors in its evaluation:</p>
            <ul>
                <li>Understanding the profile of the prospective client including its integrity and ethical values and the nature and circumstances of the prospective engagement (see AC.03);</li>
                <li>Compliance with the relevant ethical requirements (see AC.04); and</li>
                <li>The CPA practitioner\'s proficiency, expertise, and available resources, as well as their suitability for undertaking the engagement (see AC.05).</li>
            </ul>
            <p>AC.03 The CPA Practitioner shall acquire information to know its client including its integrity and ethical values which include the following factors, but not limited to:</p>
            <ul>
                <li>The nature of the client\'s operations;</li>
                <li>Rationale for the proposed appointment;</li>
                <li>The identity and business reputation of the client\'s owners, key management, related parties, and those charged with its governance;</li>
                <li>Background search;</li>
                <li>Client\'s attitude to fairness in financial reporting:</li>
                <li>Requiring the client to provide permanent files to assist in the profiling; and</li>
                <li>Information about potential limitations in the scope of work.</li>
            </ul>
            <p>AC.04 To ensure adherence to relevant ethical standards when considering an engagement, the CPA practitioner must carefully evaluate various factors such as conflict of interest and independence requirements including the possible impact of non-assurance services, if any, provided to the client.</p>
            <p>The CPA Practitioner must require an ethical clearance letter from the predecessor auditor, if applicable, to ensure that there are no ethical or professional issues that might impede the CPA Practitioner\'s ability to perform the audit effectively and impartially. In communicating with the predecessor auditor, the request for an Ethical Clearance Letter can be referred to AC-Form-01.</p>
            <p>The CPA Practitioner must assess whether accepting the engagement would pose any risks to comply with the fundamental principles outlined in Chapter 4, Relevant Ethical Requirements before agreeing to it.</p>
            <p>AC.05 Below are some of the factors to consider when evaluating the CPA Practitioner\'s capabilities to undertake the engagement:</p>
            <ul>
                <li>The availability of a proficient.engagement team with the necessary skills and time to execute" the engagement effectively.</li>
                <li>The accessibility of appropriate resources within the Firm (including personnel, specialists, need for an engagement quality reviewer and others) necessary for the successful completion of the engagement;</li>
                <li>Aligning the timing and budget allocation for the engagement with the proposed fee; [and the CPA Practitioner\'s minimum fee threshold]; and</li>
                <li>Considering the timing constraints of the engagement, including reporting deadlines.</li>
            </ul>
            <p>AC.06 The Firm\'s assessment for client acceptance should be documented using the New Client Acceptance Form in AC-Form-02. The form must be completed by the applicable personnel and approved by the CPA practitioner before the commencement of the engagement. [The form will also include an assessment of the risk of accepting the engagement ranging from Low, Medium and High.]</p>
            <h4>CONTINUING CLIENT ENGAGEMENTS</h4>
            <p>AC.07 The decision to continue engagement for recurring clients should undergo an annual review as part of the engagement planning process. Below are key factors to consider when evaluating new engagements from existing clients, but not limited to:</p>
            <ul>
                <li>Changes in the nature or scope of engagement;</li>
                <li>Significant changes in the client\'s business operations and ownership structure, those charged with governance, key management personnel;</li>
                <li>Persistent lack of cooperation by management;</li>
                <li>Emergence of litigation or legal issue arising from the client\'s operations; and Changes in the regulatory framework affecting the client and its engagement.</li>
            </ul>
            <p>AC.08 The engagement team must complete a Client Continuance Form in AC-Form-03 in relation to client continuance. The form requires endorsement and approval from the CPA Practitioner and should be duly documented within the engagement file.</p>
            <h4>TERMINATION OF A CLIENT RELATIONSHIP/ ENGAGEMENT</h4>
            <p>AC.09 Termination of a client relationship/ specific engagements may be caused by the following:</p>
            <ul>
                <li>Recurring client opts for a different professional accountant (see AC. 10); or</li>
                <li>The CPA Practitioner decides to cease a client relationship or terminate specific engagements (see AC.11).</li>
            </ul>
            <p>AC.10 When a client notifies the CPA Practitioner of their intent to change to another accounting firm, the CPA Practitioner should obtain the client\'s permission to communicate with the new accounting firm. Subsequently, upon receiving a request from the new accounting firm regarding any potential professional concerns related to accepting or declining the engagement, the CPA Practitioner should promptly issue an ethical clearance letter [and a hold harmless letter to the new accounting firm, securing their acknowledgment and agreement before accessing the client\'s information. Please see AC-Form-04]</p>
            <p>AC.11 If the CPA Practitioner decides to withdraw from the engagement/ client relationship, the following steps should be taken:</p>
            <ul>
                <li>Engage in discussions with the appropriate level of the client\'s management and those charged with its governance to determine the most appropriate course of action;</li>
                <li>If the decision to withdraw is deemed appropriate, communicate with the relevant parties regarding the intention to withdraw from either the engagement or both the engagement and the client relationship, providing clear reasons for the decision;</li>
                <li>Evaluate whether any professional, regulatory, or legal obligations necessitate the CPA Practitioner to maintain its involvement, or if there is a requirement to report the withdrawal to regulatory authorities; and</li>
                <li>Thoroughly document all significant issues, consultations, conclusions, and the rationale behind the decisions made.</li>
            </ul>
            <p>AC.12 The CPA Practitioner must maintain documentation for the termination of a client relationship. whether initiated by the client or the CPA Practitioner itself. AC-Form-05 Client Exit Form should be utilized in documenting considerations related to the termination of a client relationship and an exit letter should be provided to the client to formally inform them of the termination. The template of which is in AC-Form-06Client Exit Letter.</p>
            <h4>SPECIFIED RESPONSES REQUIRED BY PSQM 1</h4>
            <p>PSQM 1. Para. (34) (d) requires the Firm to establish policies or procedures that:</p>
            <ol type="i">
                <li>) The firm becomes aware of information subsequent to accepting or continuing a client relationship or specific engagement that would have caused it to decline the client relationship or specific engagement had that information been known prior to accepting or continuing the client relationship in The finish engle ny law or regulation to accept a client relationship or specific engagement.</li>
                <li>) The firm is obligated by law or regulation to accept a client relationship or specific engagement.</li>
            </ol>
            <p>AC.13 If significant information surfaces subsequent to the initial acceptance or continuance of an engagement that could potentially impact the CPA Practitioner\'s decision, the following steps should be considered:</p>
            <ul>
                <li>Conduct and document consultations with relevant parties or seek advice from legal counsel;</li>
                <li>Evaluate whether the CPA Practitioner is obligated to proceed with the engagement;</li>
                <li>Engage in discussions with the appropriate level of the client\'s management and those charged with governance to determine the appropriate course of action; and</li>
                <li>Communicate the reasons for withdrawal to the client\'s management and those charged with governance if deemed necessary.</li>
            </ul>
            <h4>OTHERS</h4>
            <p>AC.14 The CPA Practitioner does not accept/ require approval for acceptance by the individual with ultimate responsibility for the quality management for the following clients:</p>
            <ul>
                <li>Clients active in the following industries that the CPA Practitioner does not have any competence or skills yet such as casinos, banks, insurance companies, and mining industries;</li>
                <li>Publicly listed entities;</li>
                <li>Entities that are defined as public interest entities under the local regulations;</li>
                <li>Entities wherein the previous auditor\'s report is modified]; and</li>
            </ul>
        ';

        $pdf->writeHTML($html, true, false,false, false, '');
        $pdf->AddPage();
        $html = '';
        $html .= $style;
        $html .= '

            <h2>CHAPTER 6: ENGAGEMENT PERFORMANCE</h2>
            <p>This Chapter outlines the policies and procedures to ensure the performance of quality engagements.</p>
            <p>PSQM 1.31 sets out the following quality objectives:</p>
            <ol type="a">
                <li>) Engagement teams understand and fulfill their responsibilities in connection with the engagements, including, as applicable, the overall responsibility of engagement partners for managing and achieving quality on the engagement and being sufficiently and appropriately involved throughout the engagement.</li>
                <li>) The nature, timing and extent of direction and supervision of engagement teams and review of the work performed is appropriate based on the nature and circumstances of the engagements and the resources assigned or made available to the engagement teams, and the work performed by less experienced engagement team members is directed, supervised and reviewed by more experienced engagement team members.</li>
                <li>) Engagement teams exercise appropriate professional judgment and, when applicable to the type of engagement, professional skepticism.</li>
                <li>) Consultation on difficult or contentious matters is undertaken and the conclusions agreed are implemented.</li>
                <li>) Differences of opinion within the engagement team, or between the engagement team and the engagement quality reviewer or individuals performing activities within the firm\'s system of quality management are brought to the attention of the firm and resolved.</li>
                <li>) Engagement documentation is assembled on a timely basis after the date of the engagement report, and is appropriately maintained and retained to meet the needs of the firm and comply with law, regulation, relevant ethical requirements, or professional standards.</li>
            </ol>
            <h4>GENERAL</h4>
            <p>EP.01 The CPA Practitioner\'s objective is to carry out each engagement in accordance with the relevant auditing, accounting, and other professional standards, and meet internationally accepted best professional practices.</p>
            <p>Particularly, in addition to the requirements of PSQM 1, for audit engagements, the engagement team members, especially the CPA practitioner, are anticipated to possess a thorough understanding of the provisions outlined in the [Philippine Standards on Auditing (PSA) 220 - Revised.].</p>
            <p>EP.02 Before commencing the work in an engagement, the engagement team shall ensure they\'ve completed the necessary client acceptance or continuance evaluation procedures as outlined in Chapter 5, Acceptance And Continuance Of Client Relationships And Specific Engagements, and have a binding engagement contract with clients.</p>
            <h4>Allocation of Responsibility</h4>
            <h4>CPA Practitioner</h4>
            <p>EP.03 The CPA Practitioner shall have the appropriate competence, capabilities, time, and authority to perform the role for each engagement.</p>
            <p>EP.04 The identity and role of the CPA practitioner should be communicated to key members of client management. This will usually be accomplished by including details in the engagement contract.</p>
            <p>EP.05 For engagements deemed high risk, other key personnel] will be engaged, typically in a reviewing capacity, to ensure increased oversight.</p>
            <h4>Engagement Team Members and Other Resources</h4>
            <p>EP.06 The CPA practitioner is responsible for identifying their resource needs for an engagement. It includes allocating sufficient personnel to the engagement who possess the knowledge, skills, time, and experience to successfully perform the engagement in accordance with professional standards and regulatory and legal requirements.</p>
            <p>EP.07 Various resources may be required for executing engagements effectively, such as:</p>
            <ul>
                <li>Personnel with suitable competence and capabilities, and sufficient time for their tasks. This includes individuals for overall supervision and review, individuals who possess industry-specific knowledge, and those conducting audit procedures</li>
                <li>Technological tools necessary for facilitating the engagement procedures.</li>
                <li>Intellectual resources like methodologies and pertinent technical guidance materials.</li>
                <li>The possibility of engaging an independent reviewer or experts when required to uphold engagement quality.</li>
            </ul>
            <p>EP.08 In allocating engagement team members, the CPA practitioner may consider the following:</p>
            <ul>
                <li>the technical proficiency and industry knowledge of each team member.</li>
                <li>their previous experience with engagements similar in nature and complexity.</li>
                <li>understanding of the CPA Practitioner\'s policies and procedures, professional standards, and regulatory and legal requirements.</li>
                <li>their ability to exercise professional judgment effectively within their role on the engagement.</li>
            </ul>
            <p>EP.09 The CPA practitioner shall prioritize assembling the most competent members for significant and complex accounts such as:</p>
            <ul>
                <li>Public interest entities as defined under the IESBA Code and/or local regulations</li>
                <li>Entities operating in emerging or unfamiliar industries to the CPA Practitioner</li>
                <li>Entities operating in industries associated with a substantial complexity or requiring exercise of significant professional judgment.</li>
            </ul>
            <p>EP.10 In cases where the CPA Practitioner does not have sufficient and competent personnel to conduct an engagement, the CPA practitioner shall be responsible for ensuring that the process of determining the need for an external service provider\', the scope of their work, their competencies and capabilities, and compliance with professional standards and relevant ethical requirements are adequately documented. For tasks to be outsourced, the CPA practitioner may limit them to those that are repetitive in nature and those that may require specialization.</p>
            <p>EP.11 A yearly account distribution will be conducted to assess adequacy and ensure proper allocation among current employees. Any adjustments to this distribution must be duly justified. Status reports shall also be provided to the CPA practitioner regularly to ensure proper monitoring of the distribution.</p>
            <p>EP.12 In the onboarding process, the CPA Practitioner shall ensure that engagement team members are provided with their job titles, job descriptions, and clear delineation of responsibilities. This information is reiterated annually, with any updates communicated promptly. At the engagement level, a comprehensive planning meeting is mandated by the CPA Practitioner, during which the role of each team member is thoroughly communicated and emphasized.</p>
            <h4>Methodologies and Manuals</h4>
            <p>EP.13 The CPA Practitioner shall prepare or adopt an audit manual and methodology which will be distributed among its personnel. The manual and methodology shall be subject to regular updates to reflect changes or as deemed necessary. The engagement manual shall be updated regularly by the Personnel.</p>
            <p>EP.14 The CPA Practitioner uses appropriate [systems and] procedures designed to ensure consistency in conducting its audit activities. The documentation shall also demonstrate that the CPA Practitioner is properly involved from the planning stage until the completion of the engagement in accordance with the requirements of the relevant standards.</p>
            <p>EP.15 The CPA Practitioner monitors the engagement team\'s involvement through recorded time spent documented in any applicable timekeeping tool] in EP-Form-01 Time Recording Form. To ensure thorough involvement of the CPA practitioner, the CPA practitioner uses a time budget and determines the minimum budget allocated to the CPA practitioner based on the complexity of the engagement. The CPA Practitioner shall utilize a Time and Fee Analysis Form in EP-Form-02.]</p>
            <p>EP.16 Audit training programs/manuals shall reflect the need to exercise appropriate professional judgment.</p>
            <h4>Engagement Planning, Supervision, and Review</h4>
            <p>EP.17 The CPA practitioner is responsible for the overall delivery of the engagement from its planning until finalization. In relation to the planning phase of the engagement, the following considerations shall be taken into account:</p>
            <ul>
                <li>Understanding the client\'s business and industry, including any inherent complexities.</li>
                <li>Addressing significant issues identified during the acceptance and continuance review stage.</li>
                <li>Ensuring independence and managing any potential conflicts of interest.</li>
                <li>Determining planning materiality to guide the audit process.</li>
                <li>Identifying and mitigating significant risks.</li>
                <li>Establishing an overall audit strategy and detailed audit approach, providing guidance to engagement team members regarding their roles and ensuring they have access to necessary resources.</li>
                <li>Discuss key matters with the engagement quality reviewer or specialist, if deemed necessary.</li>
            </ul>
            <h4>Supervision</h4>
            <p>EP.18 The CPA practitioner shall be responsible for supervising the engagement team and conducting a review of the engagement documentation to determine that the work performed supports the engagement deliverables or report. The CPA Practitioner may delegate the supervision and review to [directors/ managers/ seniors] when permitted under the provisions of PSA 220 - Revised.</p>
            <p>EP.19 Supervision shall include, but not limited to:</p>
            <ul>
                <li>Maintaining proper or open lines of communication with key clients and the engagement team members.</li>
                <li>Continuous consideration of the competence and capabilities of the engagement team members and the resources that they may need.</li>
                <li>Tracking the satisfactory progress and performance of the engagement.</li>
                <li>Identifying matters requiring consultation.</li>
                <li>Directly performing tasks if the circumstances require.</li>
                <li>Reviewing pertinent deliverables or working files, as necessary.</li>
                <li>Ensuring that an engagement quality reviewer is appointed when required and that the reviewer is performing their role accordingly</li>
            </ul>
            <h4>Review</h4>
            <p>EP.20 A review involves evaluating several key aspects:</p>
            <ul>
                <li>Ensuring adherence to the terms outlined in the engagement contract.</li>
                <li>Verifying that the work conducted aligns with the CPA practitioner\'s policies and procedures, professional standards, and regulatory requirements.</li>
                <li>Confirming that necessary consultations have occurred, with resulting decisions well-documented and</li>
                <li>Identifying and addressing all significant issues, ensuring they are appropriately communicated and resolved.</li>
                <li>Resolving any disagreements effectively and documenting the agreed conclusions.</li>
                <li>Evaluating if the work plan was executed properly or needs adjustments.</li>
                <li>Confirming that the completed work adequately supports the engagement deliverables, with sufficient and relevant evidence to substantiate findings.</li>
                <li>If applicable, ensuring that the engagement quality review is completed before release of the report.</li>
            </ul>
            <p>EP.21 The work of less experienced engagement team members shall also be reviewed by more experienced engagement team members. The documentation, from planning to completion shall be reviewed at appropriate points in time during the engagement, especially those documentation relating to significant matters and professional judgment. To ensure adequate involvement of the CPA Practitioner, substantial proof of review shall be made available through the [system/ manual route sheet/ other applicable forms)</p>
            <p>EP.22 When time and resources allocated to the review process were determined inadequate, the CPA Practitioner shall take appropriate action, including communicating with appropriate individuals about the need to assign or make available additional or alternative resources to the engagement.</p>
            <h4>Professional Judgment and Skepticism</h4>
            <p>EP.23 The CPA Practitioner and the engagement team members shall exercise professional judgment and skepticism. The CPA Practitioner shall be responsible for ensuring that all members of the engagement team receive adequate training on applying professional skepticism and mitigating impediments in exercising professional judgment. This training will be factored into the performance evaluation of engagement team members.</p>
            <p>EP.24 The CPA Practitioner requires the engagement team to hold a planning meeting emphasizing the critical significance of professional skepticism.</p>
            <p>EP.25 To enhance and foster a higher standard of review in relation to the application of professional skepticism, the CPA Practitioner shall encourage a more comprehensive review of specific documentation, particularly in the following scenarios:</p>
            <ul>
                <li>Complex or subjective areas of the audit where interpretations may vary.</li>
                <li>Complex or subjective areas of the audit where interpretations may vary.</li>
                <li>Instances of identified or suspected non-compliance with pertinent laws or regulations.</li>
                <li>Accounts with significant management estimates and assumptions.</li>
            </ul>
            <h4>Consultation</h4>
            <p>EP.26 Consultation within the Firm is not only anticipated but also actively encouraged. In instances where the engagement team may lack the experience to apply sound professional judgment, the procedures established by the CPA Practitioner shall promote and prioritize consultation.</p>
            <ul>
                <li>Areas with fraud risk and internal control risk</li>
                <li>Potential impairments of independence or objectivity</li>
                <li>Identified significant non-compliance with laws or regulations</li>
                <li>Significant or unusual transactions that are outside the normal course of business for the entity </li>
                <li>Complex accounts or accounts with a high degree of estimation uncertainty</li>
                <li>Uncertainty about a client\'s ability to continue as going concern wherein the audit report is not modified</li>
                <li>Significant uncorrected misstatements (quantitative or qualitative)</li>
                <li>Reports with qualifications, disclaimer of opinion, or with key audit matters</li>
            </ul>
            <p>EP.28 The engagement team is required to seek guidance from the Engagement Quality Reviewer, whenever difficult or contentious issues emerge during an engagement. Documentation of the matter under consultation, the resulting conclusions, and their subsequent implementation is mandatory. Any consultation with external parties necessitates prior approval from the CPA Practitioner.</p>
            <p>EP.29 The CPA Practitioner shall ensure adequate internal resources are available for consultation. External sources will only be pursued when internal resources, have been thoroughly utilized. These external sources may include, but are not limited to:</p>
            <ul>
                <li>external expert or legal counsel</li>
                <li>professional or standard-setting bodies (through communication gateways such as emails, landlines, etc that should be documented accordingly)</li>
                <li>other audit firms/ [members of the network firm especially those that are involved in peer review].</li>
            </ul>
            <p>EP.30 The Firm requires the CPA practitioner to diligently assess whether the engagement team has conducted thorough consultations throughout the engagement, and conclusions resulting from such consultations are agreed with the party consulted and that conclusions agreed have been implemented. The CPA Practitioner must ensure the implementation of these conclusions prior to issuing the report, with ongoing monitoring overseen by the Engagement Quality Reviewer.</p>
            <p>EP.31 The CPA Practitioner shall be committed to fostering a culture where contentious issues are identified and addressed proactively during the planning phase of engagements. This includes any difference of opinion.</p>
            <p>EP.32 The CPA Practitioner is required to document its consultation through EP-Form-03 Consultation Memorandum.</p>
            <h4>Differences of Opinion</h4>
            <p>EP.33 CPA practitioner and staff shall embody objectivity, conscientiousness, open-mindedness, and reasonableness when addressing and resolving disputes or differences of opinion. These discussions must be approached with a commitment to fostering a timely resolution. The CPA practitioner shall also release an [annual/semi-annual/quarterly] statement that emphasizes the importance of confidently raising disagreements through a published statement routed to its employees and during any assembly. Following this policy, a difference of opinion is not deemed to exist if, following thorough discussions, research, or the emergence of new or revised facts, all involved parties freely converge on the same viewpoint regarding the issue at hand.</p>
            <p>EP.34 Differences of opinion among the engagement team and differences of opinion with any consulted specialists or experts must be documented in EP-Form-04 Differences of Opinion Resolution Form.</p>
            <p>EP.35 Differences of opinion that persist within the engagement team or arise between the team and consulted specialists/experts must, at minimum, be escalated to the Engagement Quality Reviewer, where applicable. Alternatively, they should be directed to the CPA Practitioner.</p>
            <p>EP.36 In instances where a member of the engagement team lacks the necessary authority to challenge the CPA Practitioner or other senior members regarding potential inappropriate actions stemming from differences of opinion that could impact engagement quality, they are encouraged to utilize the CPA Practitioner\'s whistleblowing policy in Chapter 4, Relevant Ethical Requirements.</p>
            <h4>Completion of Engagement Documentation</h4>
            <p>EP.37 The CPA practitioner shall accomplish a Completion Checklist/ Archiving Transmittal Form available in EP-Form-05 to ensure that the CPA Practitioner\'s policies and procedures are properly considered before finalizing the engagement. [The Completion Checklist should also include an update of the risk classification of the engagement and a reassessment if there is information obtained that may affect the continuance of recurring engagements.]</p>
            <p>EP.38 The CPA Practitioner shall be primarily responsible for the quality of engagement deliverables. They must ensure that these deliverables align with the terms outlined in the engagement contract and have been meticulously prepared in accordance with the CPA Practitioner\'s procedures, professional standards, as well as legal and regulatory requirements.</p>
            <p>EP.39 Throughout the engagement process and upon its completion, the preparer and reviewer in all engagement documentation" shall be distinctly identified.</p>
            <p>EP.40 The CPA Practitioner shall be committed to safeguarding the integrity and confidentiality of its deliverables throughout their distribution process. A policy should be established to ensure that deliverables are shared with clients through a [secured platform/ add other practical methods]. [In exceptional cases where such a platform is unavailable, alternative means of file transmission may be considered as a last resort, with a strict mandate for encryption to maintain data security and confidentiality.]</p>
            <h4>Archiving and Retention of Engagement Documentation</h4>
            <p>EP.41 Engagement documentation needs to be retained to substantiate the work conducted by the CPA Practitioner and adhere to relevant laws, regulations, and professional standards including PSQM 1.</p>
            <p>EP.42 The CPA Practitioner shall maintain a structured archiving period within a specified period from the date of the report to guarantee the completeness and accessibility of engagement documentation, whenever necessary. The archiving period of the CPA Practitioner is Sixty 60 days and includes a Completion Checklist/ Manual Archiving Transmittal Form as outlined in EP-Form-05.</p>
            <p>EP.43 The archival of relevant engagement documentation should be monitored to ensure that it is completed on time through [Insert any system/IT tool/manual tool]. The Archiving Monitoring of such shall be documented in EP-Form-06. [The monitoring responsibilities for the archival of engagement documentation are assigned to [insert Responsible Department/ Personnel]]. Violations of this policy, particularly repeated ones, shall be met with disciplinary action.</p>
            <p>EP.44 After archiving the audit files, the CPA Practitioner shall limit access to engagement documentation and any subsequent changes shall be properly logged and approved. [through an audit trail].</p>
            <p>EP.45 The CPA Practitioner is responsible for ensuring proper retention of engagement documentation. This includes implementing a policy that mandates retention through a secure platform, such as [Cloud-based/ Intranet-based/ Other Methods]. The retention period shall be set at 5 years, ensuring compliance with regulatory requirements and facilitating accessibility for future reference or audit purposes.</p>
            <p>EP.46 Electronic engagement documentation must undergo appropriate backup procedures at designated stages while physical documents shall also be retained in accordance with the CPA Practitioner\'s policy.</p>
            <p>EP.47 Unless otherwise specified by law or regulation, engagement documentation shall be considered property of the CPA Practitioner. Requests from clients or third parties for access to the Firm\'s engagement documentation or copies of engagement deliverables shall only be granted following consultation with the CPA practitioner, and subject to compliance with applicable laws and regulations.</p>
            <p>EP.48 The CPA Practitioner shall destroy the engagement documentation at the conclusion of the retention period except in cases where a claim or circumstance relevant to the engagement has surfaced, or if the documentation is subject to a preservation requirement under applicable laws, regulations, or professional standards.</p>
            <p></p>
        ';

        $pdf->writeHTML($html, true, false,false, false, '');
        $pdf->AddPage();
        $html = '';
        $html .= $style;
        $html .= '
            <h2>CHAPTER 7: RESOURCES</h2>
            <p>This section is dedicated to the management of human, technological, and intellectual resources involved in engagement performance and the operation of the quality management system. PSQM 1.32 sets out the following quality objectives:</p>
            <p>The firm shall establish the following quality objectives that address appropriately obtaining, developing, using, maintaining, allocating and assigning resources in a timely manner to enable the design, implementation and operation of the system of quality management:</p>
            <ol type="a">
                <li>) Personnel are hired, developed and retained and have the competence and capabilities to:
                    <ol type="i">
                        <li>) Consistently perform quality engagements, including having knowledge or experience relevant to the engagements the firm performs; or</li>
                        <li>) Perform activities or carry out responsibilities in relation to the operation of the firm\'s system of quality management.</li>
                    </ol>
                </li>
                <li>) Personnel demonstrate a commitment to quality through their actions and behaviors, develop and maintain the appropriate competence to perform their roles, and are held accountable or recognized through timely evaluations, compensation, promotion and other incentives.</li>
                <li>) Individuals are obtained from external sources (i.e., the network, another network firm or a service provider) when the firm does not have sufficient or appropriate personnel to enable the operation of firm\'s system of quality management or performance of engagements.</li>
                <li>) Engagement team members are assigned to each engagement, including an engagement partner, who have appropriate competence and capabilities, including being given sufficient time, to consistently perform quality engagements.</li>
                <li>) Individuals are assigned to perform activities within the system of quality management who have appropriate competence and capabilities, including sufficient time, to perform such activities.</li>
                <li>) Technological Resources <br> Appropriate technological resources are obtained or developed, implemented, maintained, and used, to enable the operation of the firm\'s system of quality management and the performance of engagements.</li>
                <li>) Intellectual Resources <br> Appropriate intellectual resources are obtained or developed, implemented, maintained, and used, to enable the operation of the firm\'s system of quality management and the consistent performance of quality engagements, and such intellectual resources are consistent with professional standards and applicable legal and regulatory requirements, where applicable.</li>
                <li>) Service Providers <br> Human, technological or intellectual resources from service providers are appropriate for use in the firm\'s system of quality management and in the performance of engagements, taking into account the quality objectives in paragraph 32 (d),(e).(f) and (g).</li>
            </ol>
            <h4>GENERAL</h4>
            <p>R.01 As part of the CPA practitioner\'s ongoing commitment to operational excellence, the CPA Practitioner shall regularly review the firm\'s workflow records and aged work-in-progress records to ensure adequate personnel are available for client engagements. Each partner is assigned responsibility for overseeing all human resource matters.</p>
            <p>Recognizing the pivotal role of human resources in the CPA practitioner\'s success, partners assume accountability for the quality of the firm\'s work. Effective management and communication with team members are integral responsibilities of partners.</p>
            <p>The CPA Practitioner shall uphold ethical principles as fundamental to all human resources procedures, including performance evaluation, promotion, and compensation. Personnel failing to adhere to these principles will receive counseling, and if necessary, may face disciplinary action.</p>
            <h4>HUMAN RESOURCES</h4>
            <h4>Recruitment</h4>
            <p>R.02 The CPA Practitioner shall enhance recruitment procedures by implementing a detailed recruitment process and technical assessments to ensure hiring personnel with the required competence and capabilities. The following are the basic considerations:</p>
            <ul>
                <li>Job descriptions are maintained for all positions.</li>
                <li>Candidates best suited to the job descriptions are interviewed and evaluated.</li>
                <li>References are thoroughly checked and documented.</li>
                <li>A partner approves the offer/no offer decision.</li>
            </ul>
            <p>The CPA practitioner shall utilize the FR-Form-01 Personnel Requisition Form and FR-Form-02 Candidate Interview And Evaluation Checklist.</p>
            <p>R.03, The CPA practitioner shall implement rigorous recruitment procedures, including comprehensive competency assessments and interviews, to ensure personnel hired possess the necessary competence and capabilities for duties within the firm\'s SOQM.</p>
            <p>Prior to onboarding new staff, the CPA Practitioner shall conduct thorough orientation sessions to ensure that new hires are adequately prepared to fulfill their assigned duties. FR-Form-03 New Staff Orientation Checklist is available for this process.</p>
            <h4>Talent Management</h4>
            <p>R.04 The CPA practitioner shall implement robust talent development programs, including mentoring and skills training initiatives, to foster the growth and retention of personnel with the necessary competence.</p>
            <p>To ensure alignment with the CPA Practitioner\'s objective of designing tailored programs for its diverse workforce, the CPA Practitioner shall conduct training needs assessments and develop learning plans for personnel at every level. This process aims to guarantee that employees receive appropriate training specific to their respective job levels and responsibilities. The CPA Practitioner may use FR-Form-04 Training Needs Assessment Form, FR-Form-05 Learning Plan, and FR-Form-06 Training and Development Record for this area of talent management.</p>
            <p>R.05 The CPA Practitioner shall implement targeted talent development initiatives, including mentoring programs and specialized training sessions, to cultivate and retain personnel with the requisite competence for roles within the firm\'s SOQM.</p>
            <p>These initiatives will be designed to enhance the skills and knowledge of staff members, ensuring they meet the firm\'s standards and regulatory requirements. Regular evaluations and feedback mechanisms will be integrated into these programs to continuously improve the effectiveness of the talent development process.</p>
            <p>R.06 The CPA practitioner shall establish structured training programs and mentorship initiatives to develop and maintain personnel competence for roles within quality engagements and the SOQM.</p>
            <p>These programs will encompass comprehensive training sessions that cover technical skills, regulatory updates, and best practices in quality management. Additionally, the mentorship initiatives will pair less experienced staff with seasoned professionals to foster knowledge transfer, practical experience, and ongoing professional development, ensuring a consistent and high standard of service delivery across the firm. Regular assessments will be conducted to monitor progress and make necessary adjustments to the training and mentorship programs.</p>
            <p>R.07 The CPA Practitioner shall establish transparent compensation and promotion criteria that prioritize personnel commitment to quality and competence in executing their roles.[An annual salary audit shall be conducted for staff at each level to verify that appropriate compensation and benefits are being provided to all personnel within the Firm. This process ensures equitable remuneration and supports talent retention efforts.]</p>
            <p>The CPA Practitioner shall emphasize demonstrated excellence in executing responsibilities, consistent commitment to maintaining high-quality standards, and a continuous pursuit of professional development.</p>
            <p>Furthermore, promotions should reflect an individual\'s ability to contribute positively to the firm\'s reputation for excellence and their alignment with the firm\'s core values and objectives.</p>
            <p>R.08 The CPA Practitioner shall implement regular performance evaluations that assess personnel based on their commitment to quality and competence in executing their respective roles.</p>
            <p>The CPA Practitioner shall conduct regular performance evaluations aimed at assessing personnel based on their demonstrated commitment to quality and competence in executing their respective roles. These evaluations should be structured to comprehensively gauge the individual\'s adherence to established quality ,Standards, the effectiveness of their role execution, and their ongoing pursuit of professional development opportunities. Feedback from these evaluations should inform decisions related to training, advancement, and overall personnel management, ensuring alignment with the firm\'s commitment to excellence.</p>
            <p>FR-Form-07 Professional Staff Performance Review and FR-Form-08 Administrative Staff Performance Review are available as a baseline guide to accomplish the performance evaluation of professional and administrative staff of the CPA Practitioner.</p>
            <p>R.09 The CPA Practitioner shall establish a robust external recruitment process to acquire personnel resources, ensuring compliance with applicable laws, regulations, and professional standards while maintaining the effectiveness of the SOQM.</p>
            <p>This process will involve stringent candidate evaluation criteria, including qualifications, experience, and alignment with the firm\'s quality management principles. Additionally, a recruitment strategy will emphasize diversity and inclusion, aiming to bring in a wide range of perspectives and expertise that enhance the firm\'s ability to meet and exceed quality standards. Regular audits of the recruitment process will be conducted to ensure its continued alignment with the SOQM and to identify areas for improvement.</p>
            <p>R.10 The CPA Practitioner shall initiate collaboration between internal members of the Firm and the concerned external parties.</p>
            <p>This collaboration will include regular communication and coordination with external auditors, regulatory bodies, and industry experts to ensure the firm\'s practices remain current and compliant with evolving standards, Additionally, establishing strong partnerships with external stakeholders will provide valuable insights and feedback, fostering a continuous improvement environment within the firm.</p>
            <p>R.11 The CPA Practitioner will assign the engagement team members conscientiously based on their skills, competence, and capabilities to ensure that the engagement will be performed in accordance with the professional standards and the firm\'s SOQM.</p>
            <p>This careful selection process will involve assessing individual team members\' expertise, past performance, and specific strengths relevant to the engagement at hand. By strategically aligning personnel with the requirements of each engagement, the firm will uphold the highest quality standards, thereby enhancing client satisfaction and maintaining regulatory compliance. Regular reviews and adjustments will be made to ensure the alignment remains effective and responsive to any changes in engagement demands or professional standards.</p>
            <p>R.12 The CPA Practitioner shall implement a thorough screening process for engagement team members, ensuring they possess the requisite competence and capabilities for quality engagements. Allocate sufficient time and resources to team members to enable them to effectively execute their roles and deliver high-quality outcomes.</p>
            <p>This process will include evaluating candidates\' educational background, professional certifications, relevant experience, and track record in similar engagements. Additionally, the CPA Practitioner will allocate sufficient time and resources to team members, providing them with the necessary support and tools to effectively execute their roles and deliver high-quality outcomes. This approach ensures that all engagements are handled by well-qualified professionals who can meet the firm\'s standards and client expectations. Regular performance reviews and ongoing training will be conducted to maintain and enhance the team\'s proficiency.</p>
            <p>R.13 The CPA Practitioner shall conduct rigorous assessments to ensure individuals possess the requisite competence and capabilities for quality engagements. Allocate adequate time and resources to individuals to facilitate the effective execution of their responsibilities and maintain high standards of performance.</p>
            <p>These assessments will include evaluations of technical skills, professional experience, and adherence to ethical standards. Furthermore, the firm will allocate adequate time and resources to individuals, providing necessary training, tools, and support to facilitate the effective execution of their responsibilities. By doing so, the firm ensures that all team members can consistently maintain high standards of performance, contributing to the overall effectiveness and integrity of the firm\'s SOQM. Regular monitoring and feedback mechanisms will be established to continually assess and enhance individual and team performance.</p>
            <p>R.14 The CPA Practitioner shall establish stringent criteria for selecting human resources from service providers to ensure alignment with the firm\'s SOQM requirements. Conduct thorough evaluations of service provider capabilities and performance to mitigate the risk of inappropriate resource allocation.</p>
            <p>This will involve defining clear standards for qualifications, experience, and professional competencies that service providers must meet. Additionally, the firm will conduct thorough evaluations of service provider capabilities and past performance, including reviewing references and prior work samples, to mitigate the risk of inappropriate resource allocation. By implementing these measures, the firm ensures that external resources contribute effectively to maintaining high-quality engagement standards and overall compliance with the SOQM. Regular audits and performance reviews of service providers will be conducted to ensure ongoing alignment and address any emerging issues promptly.</p>
            <h4>TECHNOLOGICAL RESOURCES</h4>
            <p>TECHNOLOGICAL RESOURCES</p>
            <p>This includes regular assessments of technological needs, proactive upgrades, and ensuring compatibility with evolving SOQM requirements to mitigate the risk of inadequate resources.</p>
            <p>The CPA Practitioner shall recognize the critical role of technology in supporting the efficient operation of the SOQM. As such, the CPA Practitioner is committed to prioritizing investment in adequate technological resources. This commitment encompasses regular assessments of technological needs to identify areas for improvement, proactive upgrades to ensure that systems remain current and effective, and ongoing efforts to ensure compatibility with evolving SOQM requirements. By dedicating resources to technological infrastructure, the CPA Practitioner aims to mitigate the risk of inadequate resources and uphold the integrity and effectiveness of the SOQM processes.</p>
            <p>To aid in this policy, FR-Form-09 Technology Acquisition Request Form shall be utilized by the CPA Practitioner and its personnel.</p>
            <p>R.16 The CPA Practitioner shall prioritize acquiring and maintaining appropriate technological resources to facilitate quality engagements.</p>
            <p>This includes conducting regular assessments of current technology needs, identifying potential areas for improvement, and proactively upgrading systems to stay ahead of technological advancements. Ensuring compatibility with specific engagement requirements is critical, as it mitigates the risk of inadequate resources hindering engagement quality. By maintaining cutting-edge technology, the firm supports its personnel in delivering efficient, accurate, and high-quality services, aligned with this policy. Regular reviews and updates will be conducted to ensure that technological resources continue to meet the evolving demands of professional standards and client expectations.</p>
            <p>R.17 The CPA Practitioner shall establish regular maintenance schedules and protocols for the Firm\'s audit software to mitigate the risk of software degradation or malfunction.</p>
            <p>R.18 The CPA Practitioner shall provide training and support to individuals supervising the SOQM to ensure they effectively utilize the appropriate technological resources for their duties and responsibilities.</p>
            <p>This training will cover the use of relevant software, tools, and systems necessary for monitoring, evaluating, and enhancing the SOQM. Additionally, ongoing support will be provided to address any technical challenges and to keep supervisors updated on the latest technological advancements and best practices. By equipping supervisors with the necessary skills and knowledge, the firm ensures that the SOQM is managed efficiently, thereby maintaining high standards of quality and compliance. Regular refresher courses and feedback sessions will be incorporated to continually improve the supervisors\' technological proficiency.</p>
            <p>R.19 The CPA Practitioner shall enforce strict adherence to technological resource usage policies among personnel to mitigate the risk of underutilization or misuse.</p>
            <p>This proactive measure aims to mitigate the inherent risks associated with underutilization or misuse of technological resources. By ensuring strict adherence to these policies, the CPA Practitioner shall uphold the commitment to efficiency, security, and the optimal utilization of technological assets, thereby safeguarding the integrity of the operations and the trust of stakeholders.</p>
            <p>R.20 The CPA Practitioner shall establish thorough criteria for selecting technological resources from service providers to ensure compatibility with the firm\'s SOQM, mitigating the risk of inappropriate resource provision.</p>
            <p>When selecting technological resources from service providers to ensure compatibility with the  CPA practitioner\'s practice, several criteria must be considered:</p>
            <ul>
                <li>Functionality</li>
                <li>Integration</li>
                <li>Scalability</li>
                <li>Security</li>
                <li>Ease of Use</li>
                <li>Reliability and Support</li>
                <li>Compliance</li>
                <li>Cost- effectiveness</li>
            </ul>
            <h4>INTELLECTUAL RESOURCES</h4>
            <p>R 21 The CPA practitioner shall prioritize the existence, continuous development and maintenance of the Firm\'s intellectual resources to support the effective operation of the SOQM, ensuring alignment with evolving needs and standards.</p>
            <p>The CPA Practitioner shall recognize the invaluable contribution of intellectual resources to the effective operation of the SOQM. Therefore, the CPA Practitioner shall be committed to prioritizing the existence, continuous development, and maintenance of these resources. This entails fostering a culture of knowledge sharing and collaboration among team members, investing in professional development initiatives to enhance expertise, and regularly updating intellectual resources to align with evolving needs and industry standards. By nurturing and leveraging intellectual resources, the firm ensures the ongoing effectiveness and adaptability of the SOQM to meet current and future challenges.</p>
            <p>To implement the policy prioritizing the existence, continuous development, and maintenance of intellectual resources to support the SOQM, the CPA Practitioner may create a structured framework after consideration of the following:</p>
            <ul>
                <li>Resource Identification: Identify key intellectual resources relevant to the SOQM, including documentation, training materials, and subject matter experts.</li>
                <li>Current State Assessment: Evaluate the current status of intellectual resources, including their relevance, completeness, and accessibility.</li>
                <li>Development Plan: Outline a plan for continuous development, including strategies for creating new resources, updating existing ones, and fostering a culture of knowledge sharing.</li>
                <li>Resource Maintenance Schedule: Establish a schedule for regular maintenance activities, such as reviews, updates, and version control, to ensure that intellectual resources remain current and accurate.</li>
                <li>Alignment with Evolving Needs and Standards: Define mechanisms for monitoring changes in SOQM needs and industry standards, and ensure that intellectual resources are updated accordingly.</li>
                <li>Responsibilities and Accountability: Assign responsibilities for the development and maintenance of intellectual resources to relevant team members and establish mechanisms for accountability.</li>
                <li>Evaluation and Feedback: Implement processes for regularly evaluating the effectiveness of intellectual resources in supporting the SOQM and gathering feedback for improvement.</li>
                <li>Documentation and Reporting: Document all activities related to intellectual resource development and maintenance, and provide regular reports to management on progress and outcomes.</li>
            </ul>
            <p>The CPA Practitioner can systematically implement and track efforts to develop and maintain intellectual resources in alignment with the policy outlined in this SOQM manual.</p>
            <p>R.22 The CPA Practitioner shall conduct regular reviews and updates of intellectual resources to ensure consistency with professional standards and compliance with legal and regulatory requirements, mitigating the risk of inconsistencies in engagement performance.</p>
            <p>R.23 The CPA practitioner shall establish stringent criteria for selecting human, technological, and intellectual resources from service providers, ensuring alignment with the firm\'s SOQM requirements and mitigating the risk of inappropriate resource provision.</p>
            <p>The CPA Practitioner shall acknowledge the critical importance of selecting the right human, technological, and intellectual resources from service providers to support the SOQM effectively. Therefore, the firm is committed to establishing stringent criteria for this selection process. These criteria will ensure alignment with the firm\'s SOQM requirements and mitigate the risk of inappropriate resource provision. The selection process will involve thorough evaluations of service providers\' capabilities, track record, and compatibility with the firm\'s values and objectives. By implementing these stringent criteria, the firm aims to safeguard the integrity and effectiveness of the SOQM while fostering productive partnerships with external providers.</p>
            <p>The CPA Practitioner shall use the FR-Form-10 New Service Provider Request Form to accomplish this.</p>

        ';

        $pdf->writeHTML($html, true, false,false, false, '');
        $pdf->AddPage();
        $html = '';
        $html .= $style;
        $html .= '
            <h2>CHAPTER 8: INFORMATION AND COMMUNICATION</h2>
            <p>This Chapter outlines the policies and procedures for the Information and Communication. PSQM 1.33 sets out the following quality objectives:</p>
            <ol type="a">
                <li>) The information system identifies, captures, processes and maintains relevant and reliable inform that supports the system of quality management, whether from internal or external sources.</li>
                <li>) The culture of the firm recognizes and reinforces the responsibility of personnel to exchange information with the firm and with one another.</li>
                <li>) Relevant and reliable information is exchanged throughout the firm and with engagement teams, including:
                    <ol type="i">
                        <li>) Information is communicated to personnel and engagement teams, and the nature, timing and extent of the information is sufficient to enable them to understand and carry out their responsibilities relating to performing activities within the system of quality management or engagements; and</li>
                        <li>) Personnel and engagement teams communicate information to the firm when performing activities within the system of quality management or engagements.</li>
                    </ol>
                </li>
                <li>) Relevant and reliable information is communicated to external parties, including:
                    <ol type="i">
                        <li>) Information is communicated by the firm to or within the firm\'s network or to service prc any, enabling the network or service providers to fulfill their responsibilities relating to the requirements or network services or resources provided by them; and</li>
                        <li>) Information is communicated externally when required by law, regulation or professional standards, or to support external parties\' understanding of the system of quality management.</li>
                    </ol>
                </li>
            </ol>
            <h4>General</h4>
            <p>IC,01 Information and communication deals with gathering, producing, or utilizing information about engagements and the System of Quality Management as well as timely dissemination of accurate information both inside the Firm/CA\'s practice and to other parties. In addition to reiterating the necessity of strong two-way communication within the Firm, it highlights the ongoing flow of information with the engagement teams and the CPA Practitioner. It addresses the requirement for the firm to communicate externally and motivates the establishment of an information system with procedures to locate, gather, and preserve information.</p>
            <p>The CPA Practitioner shall make a commitment to invest in information systems that address the demands of the current situation as well as the anticipated changes in the future.</p>
            <p>The CPA Practitioner\'s information systems, which comprise both manual or automated, and information technology like hardware and software, support our quality management system.</p>
            <p>The CPA Practitioner shall be committed to having constructive and educational interactions with both internal and external stakeholders. It is acknowledged by the CPA Practitioner that concise and straightforward communication in a work setting takes practice. Staff members shall be encouraged to participate in communication training as part of their performance development plan if it is determined that this is an area that needs improvement.</p>
            <h4>Approval of Communications</h4>
            <p>IC.02 The CPA Practitioner shall review and approve the communication of key or important changes, updates and messages (i.e., modification to manuals, policy updates, new procedures or processes) through an established or recognized platform, like email blasts or signed memorandums, in relation to their areas of responsibility.</p>
            <p>Important internal or external quality-related communications shall be evaluated and approved by the relevant level of authority as needed before being released</p>
            <h4>Timely Communication</h4>
            <p>IC.03 The CPA Practitioner shall provide relevant and reliable written information on a timely basis (i.e., monthly / quarterly as the case may be) to its personnel to sufficiently allow them to carry out their responsibilities in reinforcing the system of quality management. Such written communication should be properly reviewed and approved before its dissemination to its intended recipient.</p>
            <p>IC.04 The CPA Practitioner shall promptly furnish its personnel with a written communication that is understandable, pertinent, and trustworthy in order to enable them to fulfill their duties and responsibilities with respect to adherence to the system of quality management.</p>
            <h4>Quality Communication</h4>
            <p>IC.05 The CPA Practitioner shall increase the number of quality communications coming from its office to show significant involvement as the one who has ultimate responsibility over the system of quality management. (Refer to Chapter 3, Governance and Leadership) </p>
            <p>IC.06 The CPA Practitioner shall have a data backup recovery plan. The person in charge of data backup on the information systems shall carry out or perform on a regular and timely basis (at least weekly) in order not to compromise the loss of important data or information needed by the organization.</p>
            <p>IC.07 On a regular basis (i.e., annually), the person responsible for testing and evaluation of the information systems as regards data security shall be performed in order to ascertain if it\'s still operational in its current state. Also, system maintenance shall be considered on a regular basis.</p>
            <p>IC.08 The individual in charge of the information systems shall regularly assess or review its full capability and its operational efficiency, particularly as regards to its engagement performance needs, in case the Firm\'s information system has an integrated audit tool to its information system.</p>
            <h4>Leadership\'s Communication of Information</h4>
            <p>IC.09 The CPA Practitioner through its leadership shall provide written policies and procedures, training programs or orientation about information exchanges adequately or appropriately to be observed by all personnel within the entire organization.</p>
            <p>IC.10 The CPA Practitioner shall cherish an environment that acknowledges and supports employees\' duty to share information throughout the organization.</p>
            <p>IC.11 An upward feedback policy shall be implemented in the leadership\'s performance evaluation.</p>
            <p>IC.12 A whistle blowing policy shall be put in place to encourage the engagement team members to share information in cases where implementation of such policies failed. (Refer also to RER.26 - RER.27 Whistleblowing and Complaint Policy)</p>
            <h4>Culture Assessment - Quality</h4>
            <p>IC.13 The CPA Practitioner shall measure its culture for quality management to evaluate how conducive the Firm is to participation by its personnel. This Culture Assessment - Quality in IC-Form-01 shall be completed at the same time as the annual evaluation of the system of quality management.</p>
            <h4>Employee Survey</h4>
            <p>IC.14 Engagement team members shall be encouraged to share information with senior managers and other team members about relevant engagement matters, issues or concerns by conducting regular employee surveys or feedback mechanisms within the organization.Communication Channel</p>
            <p>IC.15 The CPA Practitioner shall put in place appropriate communication channels such as but not limited to formal team meetings, newsletters, or internal messaging platforms to ease an open exchange of information within the organization.</p>
            <h4>Communication with Third-Party</h4>
            <p>IC.16 The CPA Practitioner shall properly communicate relevant and reliable information to third parties or external service providers to enable them to fulfill their responsibilities relating to the services provided. If reliable technical and legal expertise is required as needed, a checklist or form such as IC-Form-02 Using the Work of Experts and IC-Form-03 Checklist for Use of Outside Experts shall be considered as part of the communication process with third-party.</p>
            <p>IC.17 Ensure that all external communications are properly reviewed and approved before their release to the intended recipient.</p>
            <p>IC.18 The CPA Practitioner\'s relevant and reliable written and verbal communications as regards systems of quality management shall be clear and understandable to its intended recipient or external parties to avoid any confusion. Also, proper training on communications shall be conducted to all personnel.</p>
            <p>IC.19 The CPA Practitioner shall provide information to external parties that comply with the reporting requirements as regards relevant laws and regulations or professional standards (i.e., communication with external regulators). Information about updates on BIR, SEC and other regulatory bodies shall be posted on its website, if any. Information on the websites if applicable shall include Mission, Vision and Core Values.</p>
            <h4>SPECIFIED RESPONSES REQUIRED BY PSQM 1</h4>
            <p>PSQM 1. Para. (34)</p>
            <ol type="i">
                <li>) Require communication with those charged with governance when performing an audit of financial statements of listed entities about how the system of quality management supports the consistent performance of quality audit engagements: (Ref: Para. A127-A129)</li>
                <li>) Address when it is otherwise appropriate to communicate with external parties about the firm\'s system of quality management; and (Ref: Para. A130)</li>
                <li>) Address the information to be provided when communicating externally in accordance with paragraph 34(e)(i), including the nature, timing and extent and appropriate form of communication. (Ref: Para. A131-A132)</li>
            </ol>
            
        ';

        $pdf->writeHTML($html, true, false,false, false, '');
        $pdf->AddPage();
        $html = '';
        $html .= $style;
        $html .= '

            <h2>CHAPTER 9: MONITORING AND REMEDIATION PROCESS</h2>
            <h4>Monitoring</h4>
            <p>MRP-01 In determining the nature, timing and extent of monitoring activities relating to the SOQM, the CPA Practitioner takes into account:</p>
            <ul>
                <li>The reasons for the assessments given to the quality risks;</li>
                <li>The design of the responses;</li>
                <li>The design of the firm\’s risk assessment process and monitoring and remediation process;</li>
                <li>Changes in the system of quality management;</li>
            </ul>
            <p>Individuals performing monitoring activities are required to have the competence and capabilities, including sufficient time, to perform those monitoring activities effectively.</p>
            <p>All engagements are reviewed by the engagement partner before the report is issued to the client. This engagement review includes reviewing whether the firm\'s system of quality management has been adhered to. When issues are identified or errors are uncovered during engagement reviews, the system is reviewed and practical changes that should reduce the risk of future similar errors are made. When identified as a requirement, relevant training programs will be arranged to address issues uncovered during monitoring procedures.</p>
            <p>MRP-02 Monitoring activities include:</p>
            <ul>
                <li>A culture assessment, focusing on the CPA Practitioner\'s commitment to quality in IC-Form-</li>
                <li>[Quarterly/ Semi-Annual/ Annually/ Other Period], the individual assigned operational responsibility for the SOQM, the [audit quality leader/other personnel/external service provider], conducts an informal assessment of the firm. This is discussed with appropriate team members at team meetings, and appropriate follow-up actions are implemented.</li>
                <li>Inspection of completed engagements - a review of a completed engagement file for each partner will be conducted [at least once every three years/ other cyclical basis]. Engagement team members or the engagement quality reviewer of an engagement are prohibited from performing any inspection of that engagement. The Engagement Review Form is in MRP-Form-01.</li>
                <li>The CPA Practitioner is also subject to review and oversight by [insert name of professional accountancy organization).</li>
            </ul>
            <h4>Remediation</h4>
            <p>MRP-03 The [audit quality leader/other personnel/external service provider] evaluates the findings from the monitoring activities to determine whether deficiencies exist. The severity and pervasiveness of identified deficiencies are evaluated by investigating the root causes) of the identified deficiencies, and evaluating the effect of the identified deficiencies, individually and in aggregate, on the SOQM.</p>
            <p>Remedial actions to address identified deficiencies that are responsive to the results of the root cause analysis are designed and implemented. Remedial actions should identify ownership, timeframes and should articulate what effectiveness looks like and how this will be evaluated. If there are significant changes needed as a result of findings, action plans may be needed to ensure these are implemented effectively.</p>
            <p>A Findings Register is in MRP-Form-02 while the Deficiency Evaluation Worksheet is in MRP-Form-03.</p>
            <p>MRP-04 The [audit quality leader/other personnel/external service provider] evaluates whether the remedial actions are appropriately designed to address the identified deficiencies and their related root cause(s) and determine that they have been implemented. The [audit quality leader/other personnel/external service provider] also evaluates whether the remedial actions implemented to address previously identified deficiencies have been effective. If the evaluation indicates that the remedial actions were not appropriately designed and implemented or were not effective, the [audit quality leader/other personnel/external service provider] takes appropriate action to determine that the remedial actions are appropriately modified such that they will be effective.</p>
            <p>When findings indicate that there is an engagement for which procedures required were omitted during the performance of that engagement, the CPA Practitioner takes appropriate action to comply with applicable auditing and assurance, and professional and ethical standards and relevant legal and regulatory requirements. When the report is considered to be inappropriate, the CPA Practitioner considers the implications and takes appropriate action, including considering whether to obtain legal advice.</p>
            <p>MRP-05 The [audit quality leader/other personnel/external service provider] communicates on a timely basis to the individual(s) assigned ultimate responsibility and accountability for the SOQM a description of the monitoring activities performed; the identified deficiencies, including the severity and pervasiveness of such deficiencies; and the remedial actions to address the identified deficiencies. The CPA Practitioner communicates these same matters to engagement teams to enable them to take prompt and appropriate action in accordance with their responsibilities.</p>
            <h4>Complaints and allegations</h4>
            <p>MRP-06 Complaints and allegations about failures to perform work in accordance with applicable auditing and assurance, and professional and ethical standards and relevant legal and regulatory requirements, or noncompliance with the firm\'s policies or procedures are taken seriously by the firm. Complaints are to be acknowledged with the client. and investigated by a partner not involved in the engagement. As we are a small firm this investigation will be referred to a consultant or another firm in instances where the complaint is designated \'serious\'. The managing partner has responsibility for designating complaints as \'serious\'.</p>
            <p>A prompt resolution must be sought, and the clients must be kept informed as to the progress of the resolution.</p>
            <p>MRP-07 Every formal complaint received is examined to determine if a weakness in the CPA Practitioner\'s SOQM exists, which is in need of improvement. A record of client complaint form is completed to aid in satisfactorily resolving the matter. Please see RER-Form-04 - Client Complaint Record.</p>
            <p>Professional indemnity insurers are notified, if necessary.</p>
            <h4>Evaluation</h4>
            <p>MRP-08 The individuals assigned ultimate responsibility and accountability for the SOQM evaluates the SOQM annually, the first one being before [15 December 2023/ Add Other Applicable Date], and then every year thereafter and documents the findings in MRP-Form-04 - System evaluation. Following the evaluation, a conclusion is made in accordance with paragraph 54 of PSQM 1 on if the SOQM provides the firm with reasonable assurance that the objectives of the SOQM are being achieved. In instances where deficiencies have been identified from monitoring activities and/or reasonable assurance has not been achieved, further measures are taken in line with paragraph 55 of ISQM 1.</p>
            <p>MRP-09 For partnerships: Periodic performance evaluations should be performed by the firm/the board of directors for:</p>
            <ul>
                <li>The individual(s) assigned ultimate responsibility and accountability for the system of quality management;</li>
                <li>The audit quality leader or other personnel assigned with operational responsibility]; and</li>
                <li>[Other personnel assigned with operational responsibility with independence, monitoring, and others as deemed necessary by the Firm]</li>
            </ul>
            <p>or</p>
            <p>For sole practitioners/ smaller firms: Performance evaluations should be performed by an external service provider</p>
            
        ';

        $pdf->writeHTML($html, true, false,false, false, '');
        $pdf->AddPage();
        $html = '';
        $html .= $style;
        $html .= '
            <h2>CHAPTER 10: ENGAGEMENT QUALITY REVIEWS</h2>
            <h4>General</h4>
            <p>EQR.01 An engagement quality review (EQR) must be undertaken for:</p>
            <ul>
                <li>Audits of financial reports of listed entities;</li>
                <li>Audits or other engagements for which an engagement quality review is required by law or regulation;</li>
                <li>Audits or other engagements for which the firm determines that an engagement quality review is an appropriate response to address one or more quality risk(s).</li>
            </ul>
            <p>EQR.02 For all other assurance engagements, the CPA Practitioner will consider the following criteria when determining whether an EQR should be performed:</p>
            <ul>
                <li>Level of engagement audit risk - if the level of audit risk is considered to be high then it is more likely that an EQR is required.</li>
                <li>Seniority of staff conducting the engagement - the need for an EQR might reduce with the higher levels of audit team experience/proficiency.</li>
                <li>Any EQR conducted on this engagement in prior years - if an EQR has been conducted in recent years the need for a current year review may be reduced in some cases, depending upon the reason for an EQR in prior years.</li>
                <li>Findings/recommendations of any previous EQR - if the EQR revealed few issues, the need for a current year EQR may be reduced.</li>
                <li>The EQR may recommend the frequency of subsequent EQRs but the results of internal monitoring should also be considered (e.g., risk areas or for specific partners).]</li>
            </ul>
            <h4>Eligibility And Appointment</h4>
            <p>EQR.03 The responsibility for the appointment of engagement quality reviewers must be assigned to an individual with the competence, capabilities and appropriate authority within the firm to fulfill the responsibility.</p>
            <p>Therefore, this responsibility has been assigned to the [audit quality leader/ other appropriate personnel].</p>
            <p>EQR.04 The criteria for an individual to be eligible to be appointed as an engagement quality reviewer are:</p>
            <ul>
                <li>Not a member of the engagement team;</li>
                <li>Has the competence and capabilities, including sufficient time, and the appropriate authority to perform the EQR;</li>
                <li>Complies with relevant ethical requirements, including in relation to threats to their objectivity and independence; and :</li>
                <li>Complies with provisions of law and regulation, if any, that are relevant to their eligibility.</li>
                <li>There must be a cooling-off period of at least two years before an individual can be appointed as an engagement quality reviewer after previously serving as the engagement partner.</li>
            </ul>
            <p>EQR.05 The criteria for an individual to be eligible to assist the engagement quality reviewer are:</p>
            <ul>
                <li>Shall not be a member of the engagement team;</li>
                <li>Has the competence and capabilities, including sufficient time, to perform the duties assigned to them; and</li>
                <li>Complies with relevant ethical requirements, including in relation to threats to independence and, if applicable, the provisions of law and regulation.</li>
            </ul>
            <p>EQR.06 The engagement quality reviewer takes overall responsibility for the performance of the EQR. The engagement quality reviewer is responsible for performing procedures at appropriate points in time during the engagement to provide an appropriate basis for an objective evaluation of the significant judgments made by the engagement team and the conclusions reached thereon. The engagement quality reviewer is responsible for determining the nature, timing and extent of the direction and supervision of the individuals assisting in the review, and the review of their work.</p>
            <h4>Impairment of Eligibility</h4>
            <p>EQR.07 When the engagement quality reviewer becomes aware of circumstances that impair their eligibility they shall notify the [audit quality leader/ other appropriate personnel], and:</p>
            <ul>
                <li>If the engagement quality review has not commenced, decline the appointment to perform the EQR;</li>
                <li>If the engagement quality review has commenced, discontinue the performance of the EQR.</li>
            </ul>
            <p>In circumstances in which the engagement quality reviewer\'s eligibility to perform the engagement quality review is impaired, the audit quality leader will identify and appoint a replacement who meets the eligibility criteria.</p>
            <p>EQR.07 In circumstances when the nature and extent of discussions between the engagement quality reviewer and the engagement team about a significant judgment give rise to a threat to the objectivity of the engagement quality reviewer, the engagement quality reviewer shall notify the [audit quality leader/ other appropriate personnel]. The [audit quality leader/ other appropriate personnel] shall evaluate whether such a threat is at an acceptable level. If the [audit quality leader/ other appropriate personnel] determines that the identified threat to the objectivity of the engagement quality reviewer is not at an acceptable level, the [audit quality leader/ other appropriate personnel] shall apply safeguards, where available and capable of being applied, to reduce the threats to an acceptable level.</p>
            <p>EQR.08 In circumstances in which the threat to objectivity of the engagement quality reviewer cannot be reduced to an acceptable level through the application of safeguards, the [audit quality leader/ other appropriate personnel] will identify and appoint a replacement who meets the eligibility criteria.</p>
            <h4>Documentation</h4>
            <p>EQR.09 The engagement quality reviewer takes responsibility for documentation of the EQR, and such documentation shall be included with the engagement documentation. The engagement quality reviewer must complete the Engagement Quality Review Form in EQR-Form-01.</p>
            <p>EQR.10 The engagement quality reviewer shall notify the CPA Practitionerif they have concerns that the significant judgments made by the engagement team, or the conclusions reached thereon, are not appropriate. If such concerns are not resolved to their satisfaction, they shall notify the (audit quality leader/ other appropriate personnel] that the EQR cannot be completed.</p>
            <p>EQR.11 The CPA Practitioner is precluded from dating the engagement report until notification has been received from the engagement quality reviewer that the EQR is complete.</p>
        ';
    }
    $pdf->writeHTML($html, true, false,false, false, '');
    $html = '';


    /**
        ----------------------------------------------------------
        CONCLUDING THE AUDIT PDF GENERATOR
        ---------------------------------------------------------- 
    */
    $pdf->AddPage('P');
    $pdf->Bookmark('Concluding the Audit',0,0);
    $html .= '<hr style="color:blue;">';
    $html .= '<h1 style="color:#7752FE;text-align:center;">Concluding the Audit</h1>';
    $html .= '<hr style="color:blue;">';
    $pdf->writeHTML($html, true, false,false, false, '');
    $html = '';
    foreach($c3 as $c){
        switch($c['code']){
            case 'AA1':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : Audit control record',1,1);
                $html   .= $style;
                $fl      = $rp->getfileinfo('c3',$wpID,$cID,$c['mtID']);
                $datapl  = $rp->getvalues_m('c3','planning',$c['code'],$c['mtID'],$cID,$wpID);
                $dataaf  = $rp->getvalues_m('c3','audit finalisation',$c['code'],$c['mtID'],$cID,$wpID);
                $rdata2  = $rp->getvalues_s('c3','rc',$c['code'],$c['mtID'],$cID,$wpID);
                $rc      = json_decode($rdata2['field1'], true);
                $rdata   = $rp->getvalues_s('c3','section3',$c['code'],$c['mtID'],$cID,$wpID);
                $s3      = json_decode($rdata['field1'], true);
                $html   .= '
                    <table>
                        <tr>
                            <td style="width: 60%;">
                                <table>
                                    <tr><td class="bb">Client: <b>'.$cl['clientname'].'</b></td></tr>
                                    <tr><td></td></tr>
                                    <tr><td class="bb">Period: <b>FY-'.$cl['financial_year'].'</b></td></tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <h3>AUDIT CONTROL RECORD</h3>
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 6%;"></th>
                                <th style="width: 60%;"><b>Planning</b></th>
                                <th class="cent bo" style="width: 18%;"><b>Yes/No /N/A</b></th>
                                <th class="cent bo" style="width: 18%;"><b>WP Ref / Comment</b></th>
                            </tr>
                        </thead>
                        <tbody>
                ';
                    $count   = 0;
                    foreach($datapl as $r){
                        $count ++;
                        $html .= '
                            <tr>
                                <td style="width: 6%;">'.$count.'.<br></td>
                                <td style="width: 60%;">'.$r['field1'].'<br></td>
                                <td class="cent bo" style="width: 18%;">'.$r['field2'].'</td>
                                <td class="cent bo" style="width: 18%;">'.$r['field3'].'</td>
                            </tr>
                        ';
                    }
                $html .= '
                        </tbody>
                    </table>
                    <p><b>1.  Completion by most senior person completing the fieldwork</b></p>
                    <p>I have completed my work as summarised above, and consider that the working papers adequately support our proposed opinion, except for the outstanding points listed on </p>
                    <p>-'.$rc['awp4'].'</p>
                    <table>
                        <tr>
                            <td style="width: 50%;">Signed:	</td>
                            <td style="width: 50%;">Date:	</td>
                        </tr>
                    </table>
                    <p><b>2.  Review completion by manager</b></p>
                    <p>I have completed my review of the working papers and consider that they support the opinion proposed except for the matters noted on </p>
                    <p>-'.$rc['awp5'].'</p>
                    <table>
                        <tr>
                            <td style="width: 50%;">Signed:	</td>
                            <td style="width: 50%;">Date:	</td>
                        </tr>
                    </table>
                    <p><b>3.  Review completion by Audit Engagement Partner</b></p>
                    <p>I have completed my review of:</p>
                    <p>-'.$rc['awp6'].'</p>
                    <ul>
                        <li>the audit working papers, including:
                            <ul>';
                                if($rc['awp1'] != ''){
                                    $html .= '<li>'.$rc['awp1'].'</li>';
                                }
                                if($rc['awp2'] != ''){
                                    $html .= '<li>'.$rc['awp2'].'</li>';
                                }
                                if($rc['awp3'] != ''){
                                    $html .= '<li>'.$rc['awp3'].'</li>';
                                }
                $html .= '
                            </ul>
                        </li>
                        <li>the financial statements / set of financial statements sent to the directors and consider that they support the proposed opinion to be given except for the matters noted on '.$rc['awp7'].' and the audit has been carried out in accordance with International Standards on Auditing.</li>
                    </ul>
                    <p>Where it is proposed to provide an unmodified opinion, I can confirm that:</p>
                    <ul>';
                        if($rc['rceap1'] != ''){
                            $html .= '<li>'.$rc['rceap1'].'</li>';
                        }
                        if($rc['rceap2'] != ''){
                            $html .= '<li>'.$rc['rceap2'].'</li>';
                        }
                        if($rc['rceap3'] != ''){
                            $html .= '<li>'.$rc['rceap3'].'</li>';
                        }
                        if($rc['rceap4'] != ''){
                            $html .= '<li>'.$rc['rceap4'].'</li>';
                        }
                        if($rc['rceap5'] != ''){
                            $html .= '<li>'.$rc['rceap5'].'</li>';
                        }
                        if($rc['rceap6'] != ''){
                            $html .= '<li>'.$rc['rceap6'].'</li>';
                        }
                        if($rc['rceap7'] != ''){
                            $html .= '<li>'.$rc['rceap7'].'</li>';
                        }
                        if($rc['rceap8'] != ''){
                            $html .= '<li>'.$rc['rceap8'].'</li>';
                        }
                        if($rc['rceap9'] != ''){
                            $html .= '<li>'.$rc['rceap9'].'</li>';
                        }
                        if($rc['rceap10'] != ''){
                            $html .= '<li>'.$rc['rceap10'].'</li>';
                        }
                $html .= '
                    </ul>
                    <table>
                        <tr>
                            <td style="width: 50%;">Signed:	</td>
                            <td style="width: 50%;">Date:	</td>
                        </tr>
                    </table>
                    <p><i>The Audit Engagement Partner should also ensure that their relevant declarations have been completed on the front page of each of Aa3b Going Concern Checklist, and Aa7 ISA Compliance Critical Issues Memorandum.</i></p>
                    <p><b>Matters that must be cleared before the financial statements are signed:</b></p>
                    <p>Details: '.$rc['details'].'</p>
                    <p>Date required by client: '.dtformat($rc['datereq']).'</p>
                    <p>Number of copies required: '.$rc['numcop'].'</p>
                    <p><b>4.	Pre-sign off completion by Audit Engagement Partner</b></p>
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 6%;"></th>
                                <th style="width: 60%;"><b>Audit finalisation</b></th>
                                <th class="cent bo" style="width: 18%;"><b>Yes/No /N/A</b></th>
                                <th class="cent bo" style="width: 18%;"><b>WP Ref / Comment</b></th>
                            </tr>
                        </thead>
                        <tbody>
                ';
                    $count = 0;
                    foreach($dataaf as $r){
                        $count ++;
                        $html .= '
                            <tr>
                                <td style="width: 6%;">'.$count.'.<br></td>
                                <td style="width: 60%;">'.$r['field1'].'<br></td>
                                <td class="cent bo" style="width: 18%;">'.$r['field2'].'</td>
                                <td class="cent bo" style="width: 18%;">'.$r['field3'].'</td>
                            </tr>
                        ';
                    }
                $html .= '
                        </tbody>
                    </table>
                    <p><b>5.  Signed Financial Statements and Audit Opinion</b></p>
                    <p>Have all outstanding matters noted above, including confirming that the financial statements do not contain material errors or misstatements, been cleared to the satisfaction of the originator (and crossed through to demonstrate this)?</p>
                    <p>-'.$s3['a1'].'</p>
                    <p>Has a letter of representation, dated on, or immediately prior to the date of the audit report, been obtained, or has an appropriate modification been given?</p>
                    <p>-'.$s3['a2'].'</p>
                    <p>I confirm that consideration has been given to subsequent events arising since the reporting date, to the date of the approval of the financial statements.  If matters have arisen, these have been disclosed in the financial statements in note</p>
                    <p>-'.$s3['a3'].'</p>
                    <p>I confirm that the going concern basis '.$s3['a4'].' appropriate, and that relevant disclosures have been made in the financial statements.</p>                       
                    <p>In considering the audit opinion, I have considered whether:</p>
                    <ul>';
                        if($s3['a5'] != ''){
                            $html .= '<li>'.$s3['a5'].'</li>';
                        }
                        if($s3['a6'] != ''){
                            $html .= '<li>'.$s3['a6'].'</li>';
                        }
                        if($s3['a7'] != ''){
                            $html .= '<li>'.$s3['a7'].'</li>';
                        }
                        if($s3['a8'] != ''){
                            $html .= '<li>'.$s3['a8'].'</li>';
                        }
                $html .= '
                    </ul>
                    <p>I approve the signing of an '.$s3['a9'].' audit opinion.</p>';
                    if($s3['a10'] != ''){
                        $html .= '<p>'.$s3['a10'].'</p>';
                        $html .= '<p>-'.$s3['a10d'].'</p>';
                    }
                    if($s3['a11'] != ''){
                        $html .= '<p>'.$s3['a11'].'</p>';
                        $html .= '<p>-'.$s3['a11d'].'</p>';
                    }
                    if($s3['a12'] != ''){
                        $html .= '<p>'.$s3['a12'].'</p>';
                    }
                $html .= '
                    <table>
                        <tr>
                            <td style="width: 50%;">Signed:___________(A.E.P)</td>
                            <td style="width: 50%;">Date:_____________</td>
                        </tr>
                    </table>
                    <p><b>6.  Completion by EQCR:</b></p>
                    <p>I have carried out a hot review, the scope of which is documented on</p>
                    <p>- '.$s3['a13'].'</p>';
                    if($s3['a14'] != ''){
                        $html .= '<p>'.$s3['a14'].'</p>';
                        $html .= '<p>'.$s3['a14d'].'have been cleared.</p>';
                    }
                    if($s3['a15'] != ''){
                        $html .= '<p>'.$s3['a15'].'</p>';
                    }
                    if($s3['a16'] != ''){
                        $html .= '<p>'.$s3['a16'].'</p>';
                    }
                $html .='
                    <table>
                        <tr>
                            <td style="width: 50%;">Signed:___________(EQCR)</td>
                            <td style="width: 50%;">Date:_____________</td>
                        </tr>
                    </table>
                    <p><b>7	Acceptance of Re-Appointment (to be completed by the A.E.P.)</b></p>
                    <p><b>This section is to be completed by the A.E.P. prior to re-appointment.</b></p>
                    <p>Whilst answering these questions the following matters should be fully considered for the audit firm and any network firm: independence, integrity, conflicts of interest with other clients, economic dependence, trusts, matters arising with regulatory authorities, ability to service the client, other services provided to the client and hospitality. Additional guidance is available in legislation and the Code of Ethics issued by the International Ethics Standards Board for Accountants.</p>
                    <p><b>Any YES answers should be fully explained along with the safeguards, which will enable us to accept the re-appointment.</b></p>
                    <p><b>Significant issues must be discussed with the Ethics Partner and details of the discussion should be documented on file.</b></p>
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 60%;"></th>
                                <th style="width: 20%;">Yes/No</th>
                                <th style="width: 20%;">Comment</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="width: 60%;">Are there any matters which would alter any of the Ethical Considerations set out on the Regulation of Auditor’s Checklist (Ac2), Provision of Non-Audit Services to Audit Clients (Ac3), and Part 4 of the Audit Control Record?</td>
                                <td class="bo" style="width: 20%;">'.$s3['a17'].'</td>
                                <td class="bo" style="width: 20%;">'.$s3['a18'].'</td>
                            </tr>
                            <tr>
                                <td class="bo" style="width: 60%;">
                                    Are there any matters which would alter any of the Ethical Considerations set out on the Regulation of Auditor’s Checklist (Ac2), Provision of Non-Audit Services to Audit Clients (Ac3), and Part 4 of the Audit Control Record?
                                    <br><br><br>
                                    '.$s3['a19'].'
                                    <br><br><br>
                                    Does any of the above affect our service as auditors of this client?
                                </td>
                                <td class="bo" style="width: 20%;">'.$s3['a20'].'</td>
                                <td class="bo" style="width: 20%;">'.$s3['a21'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 60%;">Do we know of any other factors that could affect independence or otherwise indicate that we should not accept re-appointment?</td>
                                <td class="bo" style="width: 20%;">'.$s3['a22'].'</td>
                                <td class="bo" style="width: 20%;">'.$s3['a23'].'</td>
                            </tr>
                        </tbody>
                    </table>
                    <p><b>Authority to accept re-appointment:</b></p>
                    <p>I have considered the above, and do not consider that there are any perceived threats to our independence, integrity and objectivity and believe that we '.$s3['a24'].' this re-appointment. </p>
                    <p>Where necessary adequate consultation has been undertaken and documented with the Ethics Partner.</p>
                    <table>
                        <tbody>
                            <tr>
                                <td style="width: 50%;"><p>Signature: </p></td>
                                <td style="width: 50%;">(A.E.P.)</td>
                            </tr>
                            <tr>
                                <td style="width: 50%;"><p>Date:</p><br></td>
                                <td style="width: 50%;" class="cent"></td>
                            </tr>
                            <tr>
                                <td style="width: 50%;"><p><i>If appropriate:</i></p><br></td>
                                <td style="width: 50%;" class="cent"></td>
                            </tr>
                            <tr>
                                <td style="width: 50%;"><p>Signature: </p></td>
                                <td style="width: 50%;">(EQR) </td>
                            </tr>
                            <tr>
                                <td style="width: 50%;"><p>Date:</p></td>
                                <td style="width: 50%;" class="cent"></td>
                            </tr>
                        </tbody>
                    </table>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;

            case 'AA2':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : Points forward',1,1);
                $html  .= $style;
                $fl     = $rp->getfileinfo('c3',$wpID,$cID,$c['mtID']);
                $rdata  = $rp->getvalues_s('c3','aa2',$c['code'],$c['mtID'],$cID,$wpID);
                $aa2    = json_decode($rdata['field1'], true);
                $html .= '
                    <table>
                        <tr>
                            <td style="width: 55%;">
                                <table>
                                    <tr><td class="bb">Client: <b>'.$cl['clientname'].'</b></td></tr>
                                    <tr><td></td></tr>
                                    <tr><td class="bb">Period: <b>FY-'.$cl['financial_year'].'</b></td></tr>
                                </table>
                            </td>
                            <td style="width: 45%;">
                                <table border="1">
                                    <tr>
                                        <td>Prepared by: <br><b>'.$cl['aud'].'</b></td>
                                        <td>Date: <br><b>'; if(!empty($fl['prepared_on'])){$html .= dtformat($fl['prepared_on']);}else{$html .= '';} $html .='</b></td>
                                    </tr>
                                    <tr>
                                        <td>Reviewed by: <br><b>'.$cl['sup'].'</b></td>
                                        <td>Date: <br><b>'; if(!empty($fl['reviewed_on'])){$html .= dtformat($fl['reviewed_on']);}else{$html .= '';} $html .='</b></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <h3>POINTS FORWARD</h3>
                    <p><b>Objective: </b> <br>
                        To provide a summary of the key points arising from the audit, where it is possible for improvements to the efficiency of the audit to be made, and should include both financial and non-financial matters. <br><i>The use of this form is optional.</i></p>
                    <p><b>Recording:</b> <br>This form should be completed during the audit, and should cover key matters which are of relevance to next year’s assignment.</p>
                    <p>If information has been included elsewhere on the audit file (for example, Subsequent Events Review, or the ISA Compliance Critical Issues Memorandum), it does not need to be repeated.  Where appropriate, details of suggested improvements should be outlined.</p>
                    <table border="1">
                        <tbody>
                            <tr>
                                <td><b>Problems encountered during the audit (regarding audit tests):</b>
                                    <br><p>'.$aa2['rat'].'</p><br><br><br>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <br><br>
                    <table border="1">
                        <tbody>
                            <tr>
                                <td><b>Problems encountered during the audit (regarding the client, and their accessibility etc.):</b>
                                    <br><p>'.$aa2['rcae'].'</p><br><br><br>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <br><br>
                    <table border="1">
                        <tbody>
                            <tr>
                                <td><b>Audit tests which can be removed / reduced without impairing audit quality:</b>
                                    <br><p>'.$aa2['atriaq'].'</p><br><br><br>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <br><br>
                    <table border="1">
                        <tbody>
                            <tr>
                                <td><b>Known changes to, or new accounting policies and estimation techniques in the forthcoming period:</b>
                                    <br><p>'.$aa2['kcapet'].'</p><br><br><br>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <br><br>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('P');
                $html .= $style;
                $html .= '
                    <table border="1">
                        <tbody>
                            <tr>
                                <td><b>Future developments (nature of business, locations, acquisitions and disposals):</b>
                                    <br><p>'.$aa2['fd'].'</p><br><br><br>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <br><br>
                    <table border="1">
                        <tbody>
                            <tr>
                                <td><b>Future structure of the audit team:</b>
                                    <br><p>'.$aa2['fs'].'</p><br><br><br>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <br><br>
                    <table border="1">
                        <tbody>
                            <tr>
                                <td><b>Other issues:</b>
                                    <br><p>'.$aa2['oi'].'</p><br><br><br>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;

            case 'AA3A':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : Subsequent events review',1,1);
                $html .= $style;
                $cr    = $rp->getvalues_m('c3','cr',$c['code'],$c['mtID'],$cID,$wpID);
                $dc    = $rp->getvalues_m('c3','dc',$c['code'],$c['mtID'],$cID,$wpID);
                $faf   = $rp->getvalues_m('c3','faf',$c['code'],$c['mtID'],$cID,$wpID);
                $rdata = $rp->getvalues_s('c3','air',$c['code'],$c['mtID'],$cID,$wpID);
                $air   = json_decode($rdata['field1'], true);
                $html .= '
                    <table>
                        <tr>
                            <td style="width: 60%;">
                                <table>
                                    <tr><td class="bb">Client: <b>'.$cl['clientname'].'</b></td></tr>
                                    <tr><td></td></tr>
                                    <tr><td class="bb">Period: <b>FY-'.$cl['financial_year'].'</b></td></tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <h3>SUBSEQUENT EVENTS REVIEW</h3>
                    <p><b>Objective: </b> <br>
                    To determine whether any material adjustment or disclosure is required to the financial statements as a result of events occurring between the end of the accounting period and the date of signing the audit report and to ensure the requirements of ISA 560 regarding subsequent events are met.</p>
                    <p class="bo"><b>NB: An adjusting event is an event that provides evidence of a condition that existed at the reporting date.  A non-adjusting event is an event that arose solely after the reporting date, however, its disclosure is necessary to give a true and fair view.</b></p>
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 6%;"></th>
                                <th style="width: 47%;"><b>Review of Clients Records</b></th>
                                <th class="cent bo" style="width: 47%;"><b>Working Paper Reference or Comment</b></th>
                            </tr>
                        </thead>
                        <tbody>
                ';
                    $count = 0;
                    foreach($cr as $r){
                        $count ++;
                        $html .= '
                            <tr>
                                <td style="width: 6%;">'.$count.'.<br></td>
                                <td style="width: 47%;">'.$r['field1'].'<br></td>
                                <td class="cent bo" style="width: 47%;">'.$r['field2'].'</td>
                            </tr>
                        ';
                    }
                $html .= '
                        </tbody>
                    </table>
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 6%;"></th>
                                <th style="width: 47%;"><b>Discussion with Client</b></th>
                                <th class="cent bo" style="width: 47%;"><b>Working Paper Reference or Comment</b></th>
                            </tr>
                        </thead>
                        <tbody>
                ';
                    $count = 0;
                    foreach($dc as $r){
                        $count ++;
                        $html .= '
                            <tr>
                                <td style="width: 6%;">'.$count.'.<br></td>
                                <td style="width: 47%;">'.$r['field1'].'<br></td>
                                <td class="cent bo" style="width: 47%;">'.$r['field2'].'</td>
                            </tr>
                        ';
                    }
                $html .= '
                        </tbody>
                    </table>
                    <p><b>Finalisation of the Audit File</b></p>
                    <p>This section should also detail any other work done on subsequent events not covered by the questions below.</p>
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 6%;"></th>
                                <th style="width: 60%;"><b></b></th>
                                <th class="cent bo" style="width: 18%;"><b>Initial & Date</b></th>
                                <th class="cent bo" style="width: 18%;"><b>WP Ref / Comment</b></th>
                            </tr>
                        </thead>
                        <tbody>
                ';
                    $count = 0;
                    foreach($faf as $r){
                        $count ++;
                        $html .= '
                            <tr>
                                <td style="width: 6%;">'.$count.'.<br></td>
                                <td style="width: 60%;">'.$r['field1'].'<br></td>
                                <td class="cent bo" style="width: 18%;">'.$r['field2'].'</td>
                                <td class="cent bo" style="width: 18%;">'.$r['field3'].'</td>
                            </tr>
                        ';
                    }
                $html .= '
                        </tbody>
                    </table>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('P');
                $html .= $style;
                $html .= '
                    <h3>Initial Conclusion:</h3>
                    <p>Having completed the above procedures:</p>
                    <p>There were no significant events.</p>
                    <p>Subsequent events identified above '.$air['sia'].' been adequately reflected in the financial statements.</p>
                    <p>Significant events highlighted by this review, including any disagreements with the client have been brought to the A.E.P.\'s attention and are noted on schedule '.$air['seh'].'</p>
                    <table>
                        <tr>
                            <td style="width: 50%;">Prepared by:___________</td>
                            <td style="width: 50%;">Date:_____________</td>
                        </tr>
                        <tr>
                            <td style="width: 50%;">Reviewed by:___________</td>
                            <td style="width: 50%;">Date:_____________</td>
                        </tr>
                    </table>
                    <h3>Final Conclusion:</h3>
                    <p>The initial review was conducted sufficiently close to the proposed date of the audit report not to require the work to be revised.</p>
                    <p>The initial review has been updated to '.$air['tird'].'. The work performed is outlined below:</p>
                    <table>
                        <tbody>
                            <tr>
                                <td class="bo">
                                    <br><br><br>
                                    '.$air['ir'].'
                                    <br><br><br>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <p>Having reviewed the above procedures:</p>
                    <p>I am satisfied that no further significant events have occurred between the initial review as documented by the conclusion above and '.$air['tfrd'].' <br> Significant events that have occurred are explained above, have been communicated to the A.E.P., and adequately accounted for / disclosed in the financial statements. </p>
                    <table>
                        <tr>
                            <td style="width: 50%;">Prepared by:___________</td>
                            <td style="width: 50%;">Date:_____________</td>
                        </tr>
                        <tr>
                            <td style="width: 50%;">Reviewed by:___________</td>
                            <td style="width: 50%;">Date:_____________</td>
                        </tr>
                    </table>
                    <p><i>N.B. If a matter is discovered after the financial statements are approved which may have changed the opinion given, consider the following (ISA 560.10):</i></p>
                    <ul>
                        <li><i>Discuss the issue with management;</i></li>
                        <li><i>Revising the financial statements;</i></li>
                        <li><i>Taking appropriate action.</i></li>
                    </ul>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;

            case 'AA3B':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : Going concern checklist',1,1);
                $html .= $style;
                $fl    = $rp->getfileinfo('c3',$wpID,$cID,$c['mtID']);
                $bp1   = $rp->getvalues_m('c3','p1',$c['code'],$c['mtID'],$cID,$wpID);
                $bp2   = $rp->getvalues_m('c3','p2',$c['code'],$c['mtID'],$cID,$wpID);
                $bp3a  = $rp->getvalues_m('c3','p3a',$c['code'],$c['mtID'],$cID,$wpID);
                $bp3b  = $rp->getvalues_m('c3','p3b',$c['code'],$c['mtID'],$cID,$wpID);
                $rdata = $rp->getvalues_s('c3','p4',$c['code'],$c['mtID'],$cID,$wpID);
                $bp4   = json_decode($rdata['field1'], true);
                $html .= '
                    <table>
                        <tr>
                            <td style="width: 55%;">
                                <table>
                                    <tr><td class="bb">Client: <b>'.$cl['clientname'].'</b></td></tr>
                                    <tr><td></td></tr>
                                    <tr><td class="bb">Period: <b>FY-'.$cl['financial_year'].'</b></td></tr>
                                </table>
                            </td>
                            <td style="width: 45%;">
                                <table border="1">
                                    <tr>
                                        <td>Prepared by: <br><b>'.$cl['aud'].'</b></td>
                                        <td>Date: <br><b>'; if(!empty($fl['prepared_on'])){$html .= dtformat($fl['prepared_on']);}else{$html .= '';} $html .='</b></td>
                                    </tr>
                                    <tr>
                                        <td>Reviewed by: <br><b>'.$cl['sup'].'</b></td>
                                        <td>Date: <br><b>'; if(!empty($fl['reviewed_on'])){$html .= dtformat($fl['reviewed_on']);}else{$html .= '';} $html .='</b></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <h3>GOING CONCERN CHECKLIST</h3>
                    <p><b>Objective: </b> <br>
                    To ensure that the fundamental concept of going concern is fully considered and that the requirements of ISA 570 are met.</p>
                    <p class="bo"><b>Overview:  Under the going concern assumption, an entity is viewed as continuing in business for the foreseeable future.  Financial statements are prepared on a going concern basis, unless management either intends to liquidate the entity or to cease to operate, or has no realistic alternative to do so (in these circumstances the financial statements are prepared on a break-up basis).</b></p>
                    <br><br><br>
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 6%;"></th>
                                <th style="width: 65%;"><b>Part 1 – Discussion with the Client Regarding Going Concern:</b></th>
                                <th class="cent" style="width: 29%;"><b></b></th>
                            </tr>
                        </thead>
                        <tbody>
                ';
                    $count = 0;
                    foreach($bp1 as $r){
                        $count ++;
                        $html .= '
                            <tr>
                                <td style="width: 6%;">'.$count.'.<br></td>
                                <td style="width: 65%;">'.$r['field1'].'</td>
                                <td class="cent bo" style="width: 29%;">'.$r['field2'].'</td>
                            </tr>
                        ';
                    }
                $html .= '
                        </tbody>
                    </table>
                    <br><br>
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 6%;"></th>
                                <th style="width: 65%;"><b>Part 2 – The Auditor’s Assessment ~ General Considerations:</b></th>
                                <th class="cent bo" style="width: 29%;"><b>Comments / Ref</b></th>
                            </tr>
                        </thead>
                        <tbody>
                ';
                    $count = 0;
                    foreach($bp2 as $r){
                        $count ++;
                        $html .= '
                            <tr>
                                <td style="width: 6%;">'.$count.'.<br></td>
                                <td style="width: 65%;">'.$r['field1'].'</td>
                                <td class="cent bo" style="width: 29%;">'.$r['field2'].'</td>
                            </tr>
                        ';
                    }
                $html .= '
                        </tbody>
                    </table>
                    <br><br>
                    <p><b>Part 3a – The Auditor’s Assessment ~ Specific Concerns: <br><i>Completion of this section is optional unless potential issues regarding the going concern presumption have been identified in Parts 1 or 2 above. </i></b></p>
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 6%;"></th>
                                <th style="width: 65%;"><b></b></th>
                                <th class="cent bo" style="width: 29%;"><b>Comments / Ref</b></th>
                            </tr>
                        </thead>
                        <tbody>
                ';
                    $count = 0;
                    foreach($bp3a as $r){
                        $count ++;
                        $html .= '
                            <tr>
                                <td style="width: 6%;">'.$count.'.<br></td>
                                <td style="width: 65%;">'.$r['field1'].'</td>
                                <td class="cent bo" style="width: 29%;">'.$r['field2'].'</td>
                            </tr>
                        ';
                    }
                $html .= '
                        </tbody>
                    </table>
                    <br><br>
                    <p><b>Part 3b – The Auditor’s Assessment ~ Disclosure considerations:</b></p>
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 6%;"></th>
                                <th style="width: 65%;"><b></b></th>
                                <th class="cent bo" style="width: 29%;"><b>Comments / Ref</b></th>
                            </tr>
                        </thead>
                        <tbody>
                ';
                    $count = 0;
                    foreach($bp3b as $r){
                        $count ++;
                        $html .= '
                            <tr>
                                <td style="width: 6%;">'.$count.'.<br></td>
                                <td style="width: 65%;">'.$r['field1'].'</td>
                                <td class="cent bo" style="width: 29%;">'.$r['field2'].'</td>
                            </tr>
                        ';
                    }
                $html .= '
                        </tbody>
                    </table>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('P');
                $html .= $style;
                $html .= '
                    <p><b>Part 4 – Conclusion:</b></p>
                    <p>Where potential problems with the going concern presumption have been identified, summarise the issue and resolution:</p>
                    <table border="1">
                        <thead>
                            <tr>
                                <th class="cent"><b>Going Concern Problem</b></th>
                                <th class="cent"><b>Audit Evidence Gained / Schedule Reference</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <br><br><br>
                                    '.$bp4['p41'].'
                                    <br><br><br>
                                </td>
                                <td>
                                    <br><br><br>
                                    '.$bp4['p42'].'
                                    <br><br><br>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <p>On the basis of the work recorded above, I consider that:</p>
                    <ul>';
                        if($bp4['bwr1'] != ''){
                            $html .= '<li>The financial statements have been correctly prepared on the break-up basis.</li>';
                        }
                        if($bp4['bwr2'] != ''){
                            $html .= '<li>The going concern concept '.$bp4['bwr2d'].' correctly applied to this client.</li>';
                        }
                        if($bp4['bwr3'] != ''){
                            $html .= '<li>There is '.$bp4['bwr3d'].' regarding the going concern concept for this client.</li>';
                        }
                        if($bp4['bwr4'] != ''){
                            $html .= '<li>The notes to the financial statements '.$bp4['bwr4d'].' additional information regarding the going concern concept.</li>';
                        }
                        if($bp4['bwr5'] != ''){
                            $html .= '<li>The audit report should be '.$bp4['bwr5d'].' to going concern</li>';
                        }
                $html .='
                    </ul>
                    <table>
                        <tr>
                            <td style="width: 50%;">Signed:___________[A.E.P.]</td>
                            <td style="width: 50%;">Date:_____________</td>
                        </tr>
                    </table>
                    <p><i>There is more guidance on the impact on the financial statements and audit report of going concern issues in Chapter 3, paragraph 5.4 of the Manual, as well as in ISA 570.</i></p>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;

            case 'AA4':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : Suggested letter of representation',1,1);
                $html  .= $style;
                $rdata  = $rp->getvalues_s('c3','aa4',$c['code'],$c['mtID'],$cID,$wpID);
                $aa4    = json_decode($rdata['field1'], true);
                $html  .= '
                    <p class="cent"><b>SUGGESTED LETTER OF REPRESENTATION</b> <br><br><br></p>
                    <table>
                        <tr>
                            <td>'.$cl['aud'].'</td>
                        </tr>
                        <tr>
                            <td>'.$cl['sup'].'</td>
                        </tr>
                        <tr>
                            <td>'.$cl['audm'].'</td>
                        </tr>
                        <tr>
                            <td>'.$firm.'</td>
                        </tr>
                    </table>
                    <p>Dear Sirs</p>
                    <p class="ind"><b>LETTER OF REPRESENTATION FOR THE '.strtoupper($cl['financial_year']).' ENDED '.strtoupper(date('F d', strtotime($cl['financial_year'].'-'.$cl['end_financial_year'])) ).'</b></p>
                    <p>We confirm that the following representations are made on the basis of enquiries of management and staff with relevant knowledge and experience and where appropriate, of inspection of supporting documentation, sufficient to satisfy ourselves that we can properly make each of the following representations to you in connection with your audit of the company\'s financial statements for the year ended '.dtformat($cl['financial_year'].'-'.$cl['end_financial_year']).'.</p>
                    <p>We acknowledge our legal responsibilities regarding disclosure of information to you as auditors and confirm that so far as we are aware, there is no relevant audit information needed by you in connection with preparing your audit report of which you are unaware.  Each director has taken all the steps that they ought to have taken as a director in order to make themselves aware of any relevant audit information and to establish that you are aware of that information.</p>
                    <p><b>Financial Statements:</b></p>
                    <table>
                        <tbody>
                            <tr>
                                <td style="width: 7%;">1.</td>
                                <td style="width: 93%;"><b>We acknowledge, and have fulfilled, as directors, our collective responsibility under '.$aa4['leg1'].' for presenting financial statements (in accordance with '.$aa4['leg2'].' and International Financial Reporting Standards), which give a true and fair view of the financial position of the company at the reporting date, and of its result for the period then ended, and for making accurate representations to you.  We confirm that we have approved the financial statements for the year ended [date].</b> <br></td>
                            </tr>
                            <tr>
                                <td style="width: 7%;">2.</td>
                                <td style="width: 93%;"><b>We confirm that the accounting policies and estimation techniques '.$aa4['isa'].' adopted for the preparation of the financial statements are the most appropriate to the circumstances in which the company operates.</b> <br></td>
                            </tr>
                            <tr>
                                <td style="width: 7%;">3.</td>
                                <td style="width: 93%;"><b>Other than as disclosed in the financial statements, the company has not entered into any transactions involving directors, officers or other related parties, which require disclosure under '.$aa4['leg3'].' or International Financial Reporting Standards.  Appropriate disclosure has been made of the control of the company.</b><br></td>
                            </tr>
                            <tr>
                                <td style="width: 7%;">4.</td>
                                <td style="width: 93%;"><b>We have disclosed all known or possible litigation and claims whose effects should be considered when preparing the financial statements and these have been disclosed in accordance with the requirements of accounting standards.</b><br></td>
                            </tr>
                            <tr>
                                <td style="width: 7%;">5.</td>
                                <td style="width: 93%;"><b>The financial statements of the company have been prepared on the going concern basis as we believe that adequate cash resources will be available to cover the company’s requirements for working capital and capital expenditure for at least the next twelve months.  We are not aware of any other factors which could put into jeopardy the company’s going concern status during or beyond this period.</b><br></td>
                            </tr>
                            <tr>
                                <td style="width: 7%;">6.</td>
                                <td style="width: 93%;"><b>There have been no events since the reporting date which necessitate revision of the figures included in the financial statements or inclusion of a note thereto.  Should further material events occur, which may necessitate revision of the figures included in the financial statements or inclusion of a note thereto, we will advise you accordingly.</b><br></td>
                            </tr>
                            <tr>
                                <td style="width: 7%;">7.</td>
                                <td style="width: 93%;"><b>'.$aa4['num7'].'</b><br></td>
                            </tr>
                            <tr>
                                <td style="width: 7%;">8.</td>
                                <td style="width: 93%;">We confirm that we have agreed the adjustments appended to this letter which have been made to the performance statement(s), and statement of financial position which we presented to you for audit.<br></td>
                            </tr>
                            <tr>
                                <td style="width: 7%;">9.</td>
                                <td style="width: 93%;">We confirm we have no plans or intentions that may materially affect the carrying value or classification of any assets and liabilities reflected in the financial statements. <br></td>
                            </tr>
                ';
                    if($aa4['num10yes'] != ''){
                        $html .= '
                            <tr>
                                <td style="width: 7%;">10.</td>
                                <td style="width: 93%;">
                                
                                With regard to the defined benefit pension plan, we are satisfied that:
                                    <ul>
                                        <li>the actuarial assumptions underlying the valuation are consistent with our knowledge of the business;</li>
                                        <li>all significant retirement benefits have been identified and properly accounted for; and</li>
                                        <li>all settlements and curtailments have been identified and properly accounted for.</li>
                                    </ul>
                                    <br>
                                </td>
                            </tr>
                        ';
                    }
                    if($aa4['num11yes'] != ''){
                        $html .= '
                            <tr>
                                <td style="width: 7%;">11.</td>
                                <td style="width: 93%;">'.$aa4['num11'].'<br></td>
                            </tr>
                        ';
                    }
                    if($aa4['num12yes'] != ''){
                        $html .= '
                            <tr>
                                <td style="width: 7%;">12.</td>
                                <td style="width: 93%;">'.$aa4['num12'].'<br></td>
                            </tr>
                        ';
                    }
                    $html .= '
                            <tr>
                                <td style="width: 7%;">13.</td>
                                <td style="width: 93%;"><b>All the accounting records have been made available to you for the purpose of your audit and all the transactions undertaken by the company have been properly reflected and recorded in the accounting records.  We have provided to you all other information requested and given unrestricted access to persons within the entity from whom you have deemed it necessary to speak to.  All other records and relevant information, including minutes of all management and shareholders\' meetings, have been made available to you.</b><br></td>
                            </tr>
                            <tr>
                                <td style="width: 7%;">14.</td>
                                <td style="width: 93%;"><b>Other than those disclosed in the financial statements we are not aware of any material liabilities, provisions, contingent liabilities, contingent assets or contracted for capital commitments, that need to be provided for or disclosed in the financial statements.</b><br></td>
                            </tr>
                            <tr>
                                <td style="width: 7%;">15.</td>
                                <td style="width: 93%;">The company has satisfactory title to all assets and there are no liens or encumbrances on the company’s assets '.$aa4['num15'].'.<br></td>
                            </tr>
                            <tr>
                                <td style="width: 7%;">16.</td>
                                <td style="width: 93%;">We confirm that the functional currency of the company is '.$aa4['num16'].'.<br></td>
                            </tr>
                            <tr>
                                <td style="width: 7%;">17.</td>
                                <td style="width: 93%;">Where investment properties are carried at cost in a portfolio which is valued on a fair value basis or there are unlisted investments (other than investments in subsidiaries, associates and joint ventures) that have been carried at historic cost, we confirm that a reliable estimate of fair value cannot be established for the following reasons '.$aa4['num17'].'.<br></td>
                            </tr>
                            <tr>
                                <td style="width: 7%;">18.</td>
                                <td style="width: 93%;">We confirm that we have reviewed all material items of property, plant and equipment and intangible fixed assets and we have assessed the reasonableness of their useful economic lives and residual values.  We have also reviewed all material items of property, plant and equipment, intangible fixed assets and investments (other than those carried at fair value) and consider that '.$aa4['imp'].'.<br></td>
                            </tr>
                            <tr>
                                <td style="width: 7%;">19.</td>
                                <td style="width: 93%;"><b>We confirm that we have notified you of all related party relationships, and transactions that the company has entered into with those related parties during the year of which we are aware.</b><br></td>
                            </tr>
                            <tr>
                                <td style="width: 7%;">20.</td>
                                <td style="width: 93%;"><b>We acknowledge our responsibility for the design and implementation of internal controls to prevent and detect errors or fraud, and have disclosed to you the results of our assessment of the risk that the financial statements may be materially misstated as a result of fraud.  We are unaware of any irregularities, including fraud and suspected fraud, involving management, employees or others who have significant roles in internal control, or those employed by the company where the fraud could have a material effect on the financial statements.  No allegations of such irregularities or breaches have come to our notice.</b><br></td>
                            </tr>
                            <tr>
                                <td style="width: 7%;">21.</td>
                                <td style="width: 93%;"><b>We are unaware of any breaches or possible breaches of statute, regulations, contracts,</b> agreements or the company\'s constitution <b>which might result in the company suffering significant penalties or other loss.</b>  No allegations of such irregularities or breaches have come to our notice.<br></td>
                            </tr>
                    ';
                    if($aa4['num22yes1'] != ''){
                        $html .= '
                            <tr>
                                <td style="width: 7%;">22.</td>
                                <td style="width: 93%;"><b>We confirm that we have been notified by you that there are no matters which you are required to raise with us to comply with your profession’s ethical guidance which are in addition to the matters included in your planning letter to us dated '.dtformat($aa4['num221']).'.</b> <br></td>
                            </tr>
                        ';
                    }
                    if($aa4['num22yes2'] != ''){
                        if($aa4['num222'] != ''){$a = $aa4['num222'];}else{$a = '';}
                        if($aa4['num223'] != ''){$b = $aa4['num223'];}else{$b = '';}
                        if($aa4['num224'] != ''){$c = $aa4['num224'];}else{$c = '';}
                        $html .= '
                            <tr>
                                <td style="width: 7%;">22.</td>
                                <td style="width: 93%;"><b>We confirm that you have notified to us the following matters, which are additional to the matters raised in your planning letter which you are required to raise with us to comply with your profession’s ethical guidance:</b>
                                    <ul>
                                        <li><b>'.$a.'</b></li>
                                        <li><b>'.$b.'; and</b></li>
                                        <li><b>'.$c.'.</b></li>
                                    </ul><br>
                                </td>
                            </tr>
                        ';
                    }

                    if($aa4['num23yes1'] != ''){
                        $html .= '
                            <tr>
                                <td style="width: 7%;">23.</td>
                                <td style="width: 93%;"><b>We confirm receipt of your planning letter dated '.dtformat($aa4['num23d1']).' and </b> we confirm receipt of your management letter dated '.dtformat($aa4['num23d2']).'.<br></td>
                            </tr>
                        ';
                    }
                    if($aa4['num23yes2'] != ''){
                        $html .= '
                            <tr>
                                <td style="width: 7%;">23.</td>
                                <td style="width: 93%;"><b>We confirm receipt of your planning letter dated '.dtformat($aa4['num23d']).' and</b> we confirm that we have been notified by you that there are no matters of governance interest (which include deficiencies in internal control, comments regarding accounting policies, estimation techniques and financial statement disclosure, and details of significant difficulties during the audit fieldwork) which you wish to draw to our attention.<br></td>
                            </tr>
                        ';
                    }
                $html .='
                        </tbody>
                    </table>
                    <p>Yours faithfully <br><br></p>
                    <p>[Name] <br> Signed on behalf of the Board of Directors (those charged with governance)</p>
                    <p><i>The following signature is only required where management differ from those charged with governance, as were identified on the Regulation of Auditor’s Checklist.  (Separate letters may be considered appropriate if there are representations which those charged with governance wish to remain confidential from management):</i> <br><br></p>
                    <p>[Name] <br>Signed on behalf of management</p>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;

            case 'AA5A':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : Management letter',1,1);
                $html   .= $style;
                $rdata   = $rp->getvalues_s('c3','aa5a',$c['code'],$c['mtID'],$cID,$wpID);
                $aa5a    = json_decode($rdata['field1'], true);
                $html   .= '
                    <p><b>Private and Confidential</b> <br></p>
                    <table>
                        <tr>
                            <td>The Directors</td>
                        </tr>
                        <tr>
                            <td>'.$cl['clientname'].'</td>
                        </tr>
                        <tr>
                            <td>'.$cl['clientaddress'].'</td>
                        </tr>
                        <tr>
                            <td>'.dtformat($aa5a['aa51d']).'<br></td>
                        </tr>
                    </table>
                    <p>Dear Sirs</p>
                    <h3 class="cent">Management Letter <br> Financial statements for the '.$cl['financial_year'].' ending '.date('F d', strtotime($cl['financial_year'].'-'.$cl['end_financial_year'])).'</h3>
                    <p><b>Introduction</b></p>
                    <p>Following our recent '.$aa5a['ml1'].' audit in connection with the financial statements of '.$cl['clientname'].' for the '.$cl['financial_year'].' ending '.dtformat($aa5a['ml1d']).', we are writing to bring to your attention certain matters that arose during the course of our work, together with suggestions for improvements of controls and procedures operated by the company.  We hope you will find our comments helpful and constructive.</p>
                    <p>Our work during the audit included an examination of some of the company’s transactions, procedures and controls with a view to expressing an opinion on the financial statements for the '.$cl['financial_year'].'.  This work was not directed primarily towards discovering deficiencies in, or the operating effectiveness of your internal controls other than those that would affect our audit opinion or towards the detection of fraud.  We have included in this letter only matters that have come to our attention as a result of our normal audit procedures and consequently our comments should not be regarded as a comprehensive record of all deficiencies in internal control that may exist, of all improvements that might be made, or of the operating effectiveness of your internal controls.</p>';
                    if($aa5a['ml2'] != ''){
                        $html .= '<p>'.$aa5a['ml2'].'</p>';
                    }
                
                $html .='
                    <p>Our work also included a review of the adequacy of disclosures in the financial statements and consideration of the appropriateness of the accounting policies and estimation techniques adopted by the company. This review identified no significant matters, which we believe are necessary to draw to your attention.</p>
                    <p><b>Summary</b></p>
                    <p>The important matters that arose as a result of our work are set out in detail in the attached memorandum.</p>
                ';
                    if($aa5a['ml3'] != ''){
                        $html .= '<p>'.$aa5a['ml3'].'</p>';
                    }
                    $html .='<p>We would particularly draw your attention to the following matters:</p>';
                
                    if($aa5a['ml4'] != ''){
                        $html .= '<p><b>'.$aa5a['ml4'].'</b></p>';
                        $html .= '<p>'.$aa5a['ml4d'].'</p>';
                    }
                    if($aa5a['ml5'] != ''){
                        $html .= '<p><b>'.$aa5a['ml5'].'</b></p>';
                        $html .= '<p>'.$aa5a['ml5d'].'</p>';
                    }
                    if($aa5a['ml6'] != ''){
                        $html .= '<p><b>'.$aa5a['ml6'].'</b></p>';
                        $html .= '<p>'.$aa5a['ml6d'].'</p>';
                    }
                    if($aa5a['ml7'] != ''){
                        $html .= '<p>We wrote to you previously on '.dtformat($aa5a['ml7d']).' following our '.$aa5a['ml8'].' audit for the [year/period] ending [date]. We are pleased to record that many of the matters raised have been dealt with satisfactorily.</p>';
                    }
                $html .='
                    <p><b>Conclusion</b></p>
                    <p>If you require any further information or assistance, we shall be very pleased to help you.</p>
                    <p>We would appreciate an acknowledgement of the receipt of this letter and look forward to receiving your comments when you have had the opportunity of considering the matters that we have raised. </p>
                    <p>This letter is for your private use only.  It has been prepared on the understanding that it will not be disclosed to any third party, or quoted to or referred to, without our prior written consent and we assume no responsibility to any other party.</p>
                    <p>We should like to take this opportunity of thanking you and your staff for the assistance and co-operation we have received during the course of our work. <br><br></p>
                    <p>Yours faithfully <br></p>
                    <p>……………………………………………………… <br>
                        Signed for and on behalf of '.$firm.'
                    </p>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;

            case 'AA5B':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : Management letter worksheet',1,1);
                $html .= $style;
                $fl    = $rp->getfileinfo('c3',$wpID,$cID,$c['mtID']);
                $aa5b  =  $rp->getvalues_m('c3','aa5b',$c['code'],$c['mtID'],$cID,$wpID);
                $html .= '
                    <table>
                        <tr>
                            <td style="width: 55%;">
                                <table>
                                    <tr><td class="bb">Client: <b>'.$cl['clientname'].'</b></td></tr>
                                    <tr><td></td></tr>
                                    <tr><td class="bb">Period: <b>FY-'.$cl['financial_year'].'</b></td></tr>
                                </table>
                            </td>
                            <td style="width: 45%;">
                                <table border="1">
                                    <tr>
                                        <td>Prepared by: <br><b>'.$cl['aud'].'</b></td>
                                        <td>Date: <br><b>'; if(!empty($fl['prepared_on'])){$html .= dtformat($fl['prepared_on']);}else{$html .= '';} $html .='</b></td>
                                    </tr>
                                    <tr>
                                        <td>Reviewed by: <br><b>'.$cl['sup'].'</b></td>
                                        <td>Date: <br><b>'; if(!empty($fl['reviewed_on'])){$html .= dtformat($fl['reviewed_on']);}else{$html .= '';} $html .='</b></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <h3>MANAGEMENT LETTER WORKSHEET [INTERIM / FINAL AUDIT]</h3>
                    <table border="1" class="cent">
                        <thead>
                            <tr >
                                <th style="width: 7%;">SchRef.</th>
                                <th style="width: 18.6%;">Issues Identified </th>
                                <th style="width: 18.6%;">Client’s Comments</th>
                                <th style="width: 18.6%;">Recommendations</th>
                                <th style="width: 18.6%;">To be Included in Management Letter YES / NO</th>
                                <th style="width: 18.6%;">Results of Follow up at Next Audit Visit</th>
                            </tr>
                        </thead>
                        <tbody>
                ';
                    foreach($aa5b as $r){
                        $html .= '
                            <tr>
                                <td style="width: 7%;"><br><br>'.$r['field1'].'<br></td>
                                <td style="width: 18.6%;"><br><br>'.$r['field2'].'<br></td>
                                <td style="width: 18.6%;"><br><br>'.$r['field3'].'<br></td>
                                <td style="width: 18.6%;"><br><br>'.$r['field4'].'<br></td>
                                <td style="width: 18.6%;"><br><br>'.$r['field5'].'<br></td>
                                <td style="width: 18.6%;"><br><br>'.$r['field6'].'<br></td>
                            </tr>
                        ';
                    }
                $html .='
                        </tbody>
                    </table>
                    <p>This should cover weaknesses in the accounting system and control environment plus comments on the qualitative aspects of the financial statements and the appropriateness of the accounting policies and estimation techniques adopted by the client.</p>
                    <p>All significant issues should be included in the management letter.  For other issues verbal communication is adequate.  If there are no significant issues then this can be confirmed in a “voluntary” management letter or alternatively, the letter of representation can note that a management letter is not necessary ~ note, however, that this is likely to be a rare occurrence when applying IFRS.</p>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;

            case 'AA6':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : ISA Compliance critical issues memorandum',1,1);
                $html   .= $style;
                $fl      = $rp->getfileinfo('c3',$wpID,$cID,$c['mtID']);
                $aepapp  = $rp->getvalues_s('c3','aepapp',$c['code'],$c['mtID'],$cID,$wpID);
                $aa7     = $rp->getvalues_m('c3','isa315',$c['code'],$c['mtID'],$cID,$wpID);
                $cons    = $rp->getvalues_m('c3','consultation',$c['code'],$c['mtID'],$cID,$wpID);
                $inc     = $rp->getvalues_m('c3','inconsistencies',$c['code'],$c['mtID'],$cID,$wpID);
                $ref     = $rp->getvalues_m('c3','refusal',$c['code'],$c['mtID'],$cID,$wpID);
                $dep     = $rp->getvalues_m('c3','departures',$c['code'],$c['mtID'],$cID,$wpID);
                $oth     = $rp->getvalues_m('c3','other',$c['code'],$c['mtID'],$cID,$wpID);
                $rdata   = $rp->getvalues_s('c3','aep',$c['code'],$c['mtID'],$cID,$wpID);
                $aep     = json_decode($rdata['field1'], true);
                $html   .= '
                    <table>
                        <tr>
                            <td style="width: 55%;">
                                <table>
                                    <tr><td class="bb">Client: <b>'.$cl['clientname'].'</b></td></tr>
                                    <tr><td></td></tr>
                                    <tr><td class="bb">Period: <b>FY-'.$cl['financial_year'].'</b></td></tr>
                                </table>
                            </td>
                            <td style="width: 45%;">
                                <table border="1">
                                    <tr>
                                        <td>Prepared by: <br><b>'.$cl['aud'].'</b></td>
                                        <td>Date: <br><b>'; if(!empty($fl['prepared_on'])){$html .= dtformat($fl['prepared_on']);}else{$html .= '';} $html .='</b></td>
                                    </tr>
                                    <tr>
                                        <td>Reviewed by: <br><b>'.$cl['sup'].'</b></td>
                                        <td>Date: <br><b>'; if(!empty($fl['reviewed_on'])){$html .= dtformat($fl['reviewed_on']);}else{$html .= '';} $html .='</b></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <h3>ISA COMPLIANCE CRITICAL ISSUES MEMORANDUM</h3>
                    <p><b>Objective:</b></p>
                    <p>To ensure compliance with ISA by providing a summary of critical audit issues and how these have been resolved. When read in conjunction with final analytical procedures, completion of this memorandum should provide the Audit Engagement Partner with an executive summary of the key points arising from the assignment.</p>
                    <p><b>Recording:</b></p>
                    <p>This form must be completed and include any changes made to the original planning documentation, how significant risks have been addressed during the audit and certain other issues specifically required by ISA. <i>The first 3 pages of this form are mandatory</i>.</p>
                    <p>If the A.E.P. wishes, this form can be fully completed thus providing a comprehensive executive summary which (when read in conjunction with final analytical procedures) provides a critical review of financial and non-financial matters, notes outstanding work; key issues where the A.E.P.’s input is needed and key issues that require further client involvement.</p>
                    <p>This form should not be used to record routine review points or administrative points for the A.E.P.’s attention or to record outstanding work at interim stages of the assignment.</p>
                    <table border="1">
                        <tbody>
                            <tr>
                                <td><b>Summary and Impact of Changes Made to Audit Planning After the Date of the A.E.P’s Approval:</b>
                                    <br><br><br>
                                    '.$aepapp['field1'].'
                                    <br><br><br>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <p>I approve the above changes to the planning, and consider that these changes have been adequately integrated into the audit approach.</p>
                    <table>
                        <tr>
                            <td style="width: 50%;">Changes approved by:___________(A.E.P.) </td>
                            <td style="width: 50%;">on_____________</td>
                        </tr>
                    </table>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('L');
                $html .= $style;
                $html .= '
                    <p><b>I have considered the requirements of ISA 315 and specifically, the definition of a significant risk being, “an identified and assessed risk of material misstatement that, in the auditor’s judgment, requires special audit consideration”.</b></p>
                    <p><b>A summary of significant risks identified, the outcome from audit tests performed on those risks, and the conclusions reached (mandatory section):</b> <br> <i>(Insert additional rows as required)</i></p>
                    <h3>MANAGEMENT LETTER WORKSHEET [INTERIM / FINAL AUDIT]</h3>
                    <table border="1" class="cent">
                        <thead>
                            <tr >
                                <th style="width: 15%;"><b>Area / Assertion</b></th>
                                <th style="width: 30%;"><b>Significant risk identified</b></th>
                                <th style="width: 10%;"><b>Audit test reference</b></th>
                                <th style="width: 20%;"><b>Results of audit tests</b></th>
                                <th style="width: 20%;"><b>Conclusions</b></th>
                            </tr>
                        </thead>
                        <tbody>
                ';
                    foreach($aa7 as $r){
                        $html .= '
                            <tr>
                                <td style="width: 15%;"><br><br>'.$r['field1'].'<br></td>
                                <td style="width: 30%;"><br><br>'.$r['field2'].'<br></td>
                                <td style="width: 10%;"><br><br>'.$r['field3'].'<br></td>
                                <td style="width: 20%;"><br><br>'.$r['field4'].'<br></td>
                                <td style="width: 20%;"><br><br>'.$r['field5'].'<br></td>
                            </tr>
                        ';
                    }
                $html .='
                        </tbody>
                    </table>
                    <p>I consider that significant risks have been identified and adequately addressed by this assignment, and have been appropriately communicated to the client in the Planning Letter (or, for significant risks identified at a later stage of the assignment, via alternative, appropriate documentation).</p>
                    <table>
                        <tr>
                            <td style="width: 50%;">Signature:___________(A.E.P.) </td>
                            <td style="width: 50%;">on_____________</td>
                        </tr>
                    </table>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('L');
                $html .= $style;
                $html .= '
                    <table border="1" >
                        <thead>
                            <tr>
                                <th style="width: 20%;"><b>Issue(s):</b></th>
                                <th style="width: 20%;"><b>Comments and conclusion of the audit team:</b></th>
                                <th style="width: 20%;"><b>(If applicable) <br> Further information needed from the client and a summary of information subsequently received:</b></th>
                                <th style="width: 20%;"><b>(If applicable) <br> A.E.P. input required:</b></th>
                                <th style="width: 20%;"><b>A.E.P. Conclusion(s):</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="5"><b>Areas where consultation has been undertaken (mandatory section):</b></td>
                            </tr>
                ';
                    foreach($cons as $r){
                        $html .= '
                            <tr>
                                <td style="width: 20%;"><br><br>'.$r['field1'].'<br></td>
                                <td style="width: 20%;"><br><br>'.$r['field2'].'<br></td>
                                <td style="width: 20%;"><br><br>'.$r['field3'].'<br></td>
                                <td style="width: 20%;"><br><br>'.$r['field4'].'<br></td>
                                <td style="width: 20%;"><br><br>'.$r['field5'].'<br></td>
                            </tr>
                        ';
                    }
                $html .= '
                    <tr>
                        <td colspan="5"><b>Inconsistencies noted between information provided by the client and other findings of the audit team (mandatory section):</b></td>
                    </tr>
                ';
                    foreach($inc as $r){
                        $html .= '
                            <tr>
                                <td style="width: 20%;"><br><br>'.$r['field1'].'<br></td>
                                <td style="width: 20%;"><br><br>'.$r['field2'].'<br></td>
                                <td style="width: 20%;"><br><br>'.$r['field3'].'<br></td>
                                <td style="width: 20%;"><br><br>'.$r['field4'].'<br></td>
                                <td style="width: 20%;"><br><br>'.$r['field5'].'<br></td>
                            </tr>
                        ';
                    }
                $html .= '
                    <tr>
                        <td colspan="5"><b>Areas where management refusal to allow the audit team to send a confirmation request has led to alternative procedures being performed (mandatory section):</b></td>
                    </tr>
                ';
                    foreach($ref as $r){
                        $html .= '
                            <tr>
                                <td style="width: 20%;"><br><br>'.$r['field1'].'<br></td>
                                <td style="width: 20%;"><br><br>'.$r['field2'].'<br></td>
                                <td style="width: 20%;"><br><br>'.$r['field3'].'<br></td>
                                <td style="width: 20%;"><br><br>'.$r['field4'].'<br></td>
                                <td style="width: 20%;"><br><br>'.$r['field5'].'<br></td>
                            </tr>
                        ';
                    }
                $html .= '
                    <tr>
                        <td colspan="5"><b>Departures from requirements of ISA, reasons for the departure and alternative audit procedures performed (mandatory section):</b></td>
                    </tr>
                ';
                    foreach($dep as $r){
                        $html .= '
                            <tr>
                                <td style="width: 20%;"><br><br>'.$r['field1'].'<br></td>
                                <td style="width: 20%;"><br><br>'.$r['field2'].'<br></td>
                                <td style="width: 20%;"><br><br>'.$r['field3'].'<br></td>
                                <td style="width: 20%;"><br><br>'.$r['field4'].'<br></td>
                                <td style="width: 20%;"><br><br>'.$r['field5'].'<br></td>
                            </tr>
                        ';
                    }
                $html .='
                        </tbody>
                    </table>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('L');
                $html .= $style;
                $html .= '
                    <p><b>Other Issues (including any key outstanding audit matters):</b></p>
                    <table border="1" >
                        <thead>
                            <tr>
                                <th style="width: 20%;"><b>Issue(s):</b></th>
                                <th style="width: 20%;"><b>Comments and conclusion of the audit team:</b></th>
                                <th style="width: 20%;"><b>(If applicable) <br> Further information needed from the client and a summary of information subsequently received:</b></th>
                                <th style="width: 20%;"><b>(If applicable) <br> A.E.P. input required:</b></th>
                                <th style="width: 20%;"><b>A.E.P. Conclusion(s):</b></th>
                            </tr>
                        </thead>
                        <tbody>
                ';
                    foreach($oth as $r){
                        $html .= '
                            <tr>
                                <td style="width: 20%;"><br><br>'.$r['field1'].'<br></td>
                                <td style="width: 20%;"><br><br>'.$r['field2'].'<br></td>
                                <td style="width: 20%;"><br><br>'.$r['field3'].'<br></td>
                                <td style="width: 20%;"><br><br>'.$r['field4'].'<br></td>
                                <td style="width: 20%;"><br><br>'.$r['field5'].'<br></td>
                            </tr>
                        ';
                    }
                $html .='
                        </tbody>
                    </table>
                    <p><b>Changes to, or new accounting policies and estimation techniques in the period:</b></p>
                    <table border="1">
                        <thead>
                            <tr>
                                <th><b>Points to A.E.P.:</b></th>
                                <th><b>A.E.P. Comments:</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <br><br><br>
                                    '.$aep['ch1'].'
                                    <br><br><br>
                                </td>
                                <td>
                                    <br><br><br>
                                    '.$aep['ch2'].'
                                    <br><br><br>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <p><b>Developments during the period:</b></p>
                    <table border="1">
                        <thead>
                            <tr>
                                <th><b>Points to A.E.P.:</b></th>
                                <th><b>A.E.P. Comments:</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <br><br><br>
                                    '.$aep['dev1'].'
                                    <br><br><br>
                                </td>
                                <td>
                                    <br><br><br>
                                    '.$aep['dev2'].'
                                    <br><br><br>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <p><b>Future developments:</b></p>
                    <table border="1">
                        <thead>
                            <tr>
                                <th><b>Points to A.E.P.:</b></th>
                                <th><b>A.E.P. Comments:</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <br><br><br>
                                    '.$aep['fut1'].'
                                    <br><br><br>
                                </td>
                                <td>
                                    <br><br><br>
                                    '.$aep['fut2'].'
                                    <br><br><br>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <p><b>Costs to date, including an explanation of deviation from budget, and timetable for completion:</b></p>
                    <table border="1">
                        <thead>
                            <tr>
                                <th><b>Points to A.E.P.:</b></th>
                                <th><b>A.E.P. Comments:</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <br><br><br>
                                    '.$aep['cst1'].'
                                    <br><br><br>
                                </td>
                                <td>
                                    <br><br><br>
                                    '.$aep['cst2'].'
                                    <br><br><br>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;

            case 'AA7':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : Final analutical Procedures',1,1);
                $html  .= $style;
                $fl     = $rp->getfileinfo('c3',$wpID,$cID,$c['mtID']);
                $rdata  =  $rp->getvalues_s('c3','aa10',$c['code'],$c['mtID'],$cID,$wpID);
                $aa10   = json_decode($rdata['field1'], true);
                $html .= '
                    <table>
                        <tr>
                            <td style="width: 55%;">
                                <table>
                                    <tr><td class="bb">Client: <b>'.$cl['clientname'].'</b></td></tr>
                                    <tr><td></td></tr>
                                    <tr><td class="bb">Period: <b>FY-'.$cl['financial_year'].'</b></td></tr>
                                </table>
                            </td>
                            <td style="width: 45%;">
                                <table border="1">
                                    <tr>
                                        <td>Prepared by: <br><b>'.$cl['aud'].'</b></td>
                                        <td>Date: <br><b>'; if(!empty($fl['prepared_on'])){$html .= dtformat($fl['prepared_on']);}else{$html .= '';} $html .='</b></td>
                                    </tr>
                                    <tr>
                                        <td>Reviewed by: <br><b>'.$cl['sup'].'</b></td>
                                        <td>Date: <br><b>'; if(!empty($fl['reviewed_on'])){$html .= dtformat($fl['reviewed_on']);}else{$html .= '';} $html .='</b></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <h3>FINAL ANALYTICAL PROCEDURES</h3>
                    <p><b>Objective:</b> <br> To carry out a review of the financial statements such that the results obtained, together with the conclusions drawn from other audit tests, give a basis for the opinion on the financial statements.</p>
                    <p><b>Recording:</b> <br> Review key ratios of most significance to the entity. Any large or unexpected movements in these ratios should be explained. This section should also contain details of significant or unexpected changes in major Statement of Financial Position and Performance Statement items.</p>
                    <p><b>Comparisons should be made of current period figures with prior period and / or budgeted figures.  Explanations obtained for significant or unexpected changes in key business ratios and items in the financial statements must be corroborated by other evidence. A conclusion should then be reached. </b></p>
                    <p><b><i>Undertaking analytical procedures at finalisation is mandatory; however, the use of this form is optional.</i></b></p>
                    <table border="1">
                        <tbody>
                            <tr>
                                <td>
                                    Summary of key ratios which may be calculated or printed from a relevant software package (add others which are specifically relevant to the entity):
                                    <ul>
                                        <li><i>(Gross Profit / Revenue) x 100</i></li>
                                        <li><i>(Profit before Tax / Revenue) x 100</i></li>
                                        <li><i>Direct expenses / Inventory</i></li>
                                        <li><i>(Trade Receivables / Credit Sales) x 365</i></li>
                                        <li><i>(Trade Payables / Credit Purchases) x 365</i></li>
                                        <li><i>Current Assets / Current Liabilities</i></li>
                                        <li><i>Current Assets – Inventory / Current Liabilities</i></li>
                                        <li><i>Total Liabilities / Equity</i></li>
                                        <br><br><br><br><br>
                                        '.$aa10['sum'].'
                                        <br><br><br><br><br>
                                        To give an accurate figure an adjustment for sales taxes will have to be made.
                                    </ul>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('L');
                $html .= $style;
                $html .='
                    <table border="1">
                        <tbody>
                            <tr>
                                <td>
                                    <b>Comparison of key figures</b> (or summarise where this work is filed) <br>
                                    <i>For example:</i> <br>
                                    <i>Compare current year’s figures, at intervals appropriate with the availability of management information, against a sample of the following, as appropriate:</i>
                                    <ul>
                                        <li><i>Prior year’s figures;</i></li>
                                        <li><i>Budgeted figures;</i></li>
                                        <li><i>Industry and other external statistics;</i></li>
                                        <li><i>Non-financial information (specify which information); or</i></li>
                                        <li><i>Any other relevant information.</i></li>
                                    </ul>
                                    <p><i>Ensure that a summary is prepared of all variances (both absolute and percentage) to justify the analysis performed.</i></p>
                                    <p><i>Compare results of final analytical procedures with those of preliminary analytical procedures.</i></p>
                                    <br><br><br><br><br>
                                    '.$aa10['comp'].'
                                    <br><br><br><br><br>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('L');
                $html .= $style;
                $html .='
                    <table border="1">
                        <tbody>
                            <tr>
                                <td>
                                    <b>Explanations of unusual variations</b> (or summarise where this work is filed) <br>
                                    <i>For example:</i> <br>
                                    <i>Investigate normal and abnormal fluctuations, and record explanations.</i> <br>
                                    <i>Record details of the evidence obtained to substantiate and corroborate the explanations received.</i> <br>
                                    <i>Consider whether any of the points raised need to be included in either:</i>
                                    <ul>
                                        <li><i>The management letter, as a result of a weakness highlighted in the accounting system; or</i></li>
                                        <li><i>The letter of representation, as a result of an explanation for which only verbal evidence is available.</i></li>
                                    </ul>
                                    <p><i>Consider whether any of the unusual variances identified indicate a previously unrecognised risk of material misstatements due to fraud.</i></p>
                                    <br><br><br><br><br>
                                    '.$aa10['exp'].'
                                    <br><br><br><br><br>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <p><b>Conclusion:</b></p>
                    <p>I have carried out both overall and detailed analytical procedures on the financial statements and I am satisfied that:</p>
                    <ul>
                        <li>there are no large or unusual variations in the figures which cannot be adequately explained;</li>
                        <li>no indicators of fraud have been identified; and</li>
                        <li>no indicators of fraud have been identified; and</li>
                    </ul>
                    <table>
                        <tr>
                            <td style="width: 50%;">Signature:___________</td>
                            <td style="width: 50%;">Dated:_____________</td>
                        </tr>
                    </table>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;

            case 'AA8':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : Summary of unadjusted errors',1,1);
                $html  .= $style;
                $fl     = $rp->getfileinfo('c3',$wpID,$cID,$c['mtID']);
                $aef    = $rp->getvalues_m('c3','aef',$c['code'],$c['mtID'],$cID,$wpID);
                $aej    = $rp->getvalues_m('c3','aej',$c['code'],$c['mtID'],$cID,$wpID);
                $ee     = $rp->getvalues_m('c3','ee',$c['code'],$c['mtID'],$cID,$wpID);
                $de     = $rp->getvalues_m('c3','de',$c['code'],$c['mtID'],$cID,$wpID);
                $rdata  = $rp->getvalues_s('c3','aa11ue',$c['code'],$c['mtID'],$cID,$wpID);
                $ue     = json_decode($rdata['field1'], true);
                $rdata2 = $rp->getvalues_s('c3','con',$c['code'],$c['mtID'],$cID,$wpID);
                $con    = json_decode($rdata2['field1'], true);
                $html .= '
                    <table>
                        <tr>
                            <td style="width: 55%;">
                                <table>
                                    <tr><td class="bb">Client: <b>'.$cl['clientname'].'</b></td></tr>
                                    <tr><td></td></tr>
                                    <tr><td class="bb">Period: <b>FY-'.$cl['financial_year'].'</b></td></tr>
                                </table>
                            </td>
                            <td style="width: 45%;">
                                <table border="1">
                                    <tr>
                                        <td>Prepared by: <br><b>'.$cl['aud'].'</b></td>
                                        <td>Date: <br><b>'; if(!empty($fl['prepared_on'])){$html .= dtformat($fl['prepared_on']);}else{$html .= '';} $html .='</b></td>
                                    </tr>
                                    <tr>
                                        <td>Reviewed by: <br><b>'.$cl['sup'].'</b></td>
                                        <td>Date: <br><b>'; if(!empty($fl['reviewed_on'])){$html .= dtformat($fl['reviewed_on']);}else{$html .= '';} $html .='</b></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <p><b>SUMMARY OF UNADJUSTED ERRORS</b></p>
                    <p>If, during the assignment, either the aggregate of accumulated misstatements approaches performance materiality, or the nature of identified misstatements indicate that other misstatements may exist which would lead to accumulated misstatements exceeding performance materiality, it shall be determined whether the overall audit strategy and audit plan need to be revised.</p>
                    <p><b>Objective:</b> <br>This summary of errors is to determine whether any errors, including disclosure errors, which have not yet been corrected (including uncorrected misstatements relating to prior periods), are individually or in total, sufficiently material to warrant correction in the financial statements and to ensure, if appropriate, that they are communicated to the client.  Where applicable, the effect of taxation should also be documented.</p>
                    <p><b>Scope:</b> <br>Either all errors should be recorded on this form or just those over a de minimis level which can be set by the A.E.P. (this should normally be less than or equal to the clearly trivial threshold).</p>
                    <table>
                        <tbody>
                            <tr>
                                <td style="width: 60%;"><b>Clearly Trivial per Ac13</b></td>
                                <td style="width: 5%;"><b>CU</b></td>
                                <td style="width: 20%;" class="bo">'.$ue['cta'].'</td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                            </tr>
                            <tr>
                                <td style="width: 60%;"><b>Final Performance Materiality per Ac13</b></td>
                                <td style="width: 5%;"><b>CU</b></td>
                                <td style="width: 20%;" class="bo">'.$ue['fpm'].'</td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                            </tr>
                            <tr>
                                <td style="width: 60%;"><b>Final Materiality per Ac13</b></td>
                                <td style="width: 5%;"><b>CU</b></td>
                                <td style="width: 20%;" class="bo">'.$ue['fma'].'</td>
                            </tr>
                        </tbody>
                    </table>
                    <br><br> 
                    <table border="1">
                        <thead>
                            <tr>
                                <th style="width: 10%;"></th>
                                <th style="width: 40%;"></th>
                                <th colspan="4" style="width: 40%;"><b>Potential Effect on the Financial Statements</b></th>
                                <th style="width: 10%;"></th>
                            </tr>
                            <tr>
                                <th></th>
                                <th></th>
                                <th colspan="2" style="width: 20%;"><b>Performance Statements</b></th>
                                <th colspan="2" style="width: 20%;"><b>S\'ment of Fin. Position</b></th>
                                <th style="width: 10%;"><b>Adjust?</b></th>
                            </tr>
                            <tr>
                                <th style="width: 10%;"><b>WP Ref.</b></th>
                                <th style="width: 40%;"><b>Account and Description of Error</b></th>
                                <th style="width: 10%;" class="cent"><b>Dr</b></th>
                                <th style="width: 10%;" class="cent"><b>Cr</b></th>
                                <th style="width: 10%;" class="cent"><b>Dr</b></th>
                                <th style="width: 10%;" class="cent"><b>Cr</b></th>
                                <th style="width: 10%;" class="cent"><b>Yes/No</b></th>
                            </tr>
                            <tr>
                                <th colspan="7"><b>ACTUAL ERRORS - FACTUAL</b></th>
                            </tr>
                        </thead>
                        <tbody> 
                ';
                    $aef_drps = 0;
                    $aef_crps = 0;
                    $aef_drfp = 0;
                    $aef_crfp = 0;
                    foreach($aef as $r){
                        $aef_drps += $r['field3'];
                        $aef_crps += $r['field4'];
                        $aef_drfp += $r['field5'];
                        $aef_crfp += $r['field6'];
                        $html .= '
                            <tr>
                                <td style="width: 10%;" class="cent">'.$r['field1'].'</td>
                                <td style="width: 40%;">'.$r['field2'].'</td>
                                <td style="width: 10%;" class="cent">'.$r['field3'].'</td>
                                <td style="width: 10%;" class="cent">'.$r['field4'].'</td>
                                <td style="width: 10%;" class="cent">'.$r['field5'].'</td>
                                <td style="width: 10%;" class="cent">'.$r['field6'].'</td>
                                <td style="width: 10%;" class="cent">'.$r['field7'].'</td>
                            </tr>
                        ';
                    }
                $html .= '
                            <tr>
                                <td colspan="6" style="width: 90%;"><b>ACTUAL ERRORS - JUDGMENTAL</b></td>
                                <td style="width: 10%;"><b>Adjust?</b></td>
                            </tr>
                ';
                    $aej_drps = 0;
                    $aej_crps = 0;
                    $aej_drfp = 0;
                    $aej_crfp = 0;
                    foreach($aej as $r){
                        $aej_drps += $r['field3'];
                        $aej_crps += $r['field4'];
                        $aej_drfp += $r['field5'];
                        $aej_crfp += $r['field6'];  
                        $html .= '
                            <tr>
                                <td style="width: 10%;" class="cent">'.$r['field1'].'</td>
                                <td style="width: 40%;">'.$r['field2'].'</td>
                                <td style="width: 10%;" class="cent">'.$r['field3'].'</td>
                                <td style="width: 10%;" class="cent">'.$r['field4'].'</td>
                                <td style="width: 10%;" class="cent">'.$r['field5'].'</td>
                                <td style="width: 10%;" class="cent">'.$r['field6'].'</td>
                                <td style="width: 10%;" class="cent">'.$r['field7'].'</td>
                            </tr>
                        ';
                    }
                $html .= '
                        <tr>
                            <td colspan="6" style="width: 90%;"><b>EXTRAPOLATED ERRORS</b></td>
                            <td style="width: 10%;"><b>Adjust?</b></td>
                        </tr>
                ';
                    $ee_drps = 0;
                    $ee_crps = 0;
                    $ee_drfp = 0;
                    $ee_crfp = 0;
                    foreach($ee as $r){
                        $ee_drps += $r['field3'];
                        $ee_crps += $r['field4'];
                        $ee_drfp += $r['field5'];
                        $ee_crfp += $r['field6'];
                        $html .= '
                            <tr>
                                <td style="width: 10%;" class="cent">'.$r['field1'].'</td>
                                <td style="width: 40%;">'.$r['field2'].'</td>
                                <td style="width: 10%;" class="cent">'.$r['field3'].'</td>
                                <td style="width: 10%;" class="cent">'.$r['field4'].'</td>
                                <td style="width: 10%;" class="cent">'.$r['field5'].'</td>
                                <td style="width: 10%;" class="cent">'.$r['field6'].'</td>
                                <td style="width: 10%;" class="cent">'.$r['field7'].'</td>
                            </tr>
                        ';
                    }
                $html .= '
                        <tr>
                            <td colspan="6" style="width: 90%;"><b>DISCLOSURE ERRORS</b></td>
                            <td style="width: 10%;"><b>Adjust?</b></td>
                        </tr>
                ';
                    $de_drps = 0;
                    $de_crps = 0;
                    $de_drfp = 0;
                    $de_crfp = 0;
                    foreach($de as $r){
                        $de_drps += $r['field3'];
                        $de_crps += $r['field4'];
                        $de_drfp += $r['field5'];
                        $de_crfp += $r['field6'];
                        $html .= '
                            <tr>
                                <td style="width: 10%;" class="cent">'.$r['field1'].'</td>
                                <td style="width: 40%;">'.$r['field2'].'</td>
                                <td style="width: 10%;" class="cent">'.$r['field3'].'</td>
                                <td style="width: 10%;" class="cent">'.$r['field4'].'</td>
                                <td style="width: 10%;" class="cent">'.$r['field5'].'</td>
                                <td style="width: 10%;" class="cent">'.$r['field6'].'</td>
                                <td style="width: 10%;" class="cent">'.$r['field7'].'</td>
                            </tr>
                        ';
                    }
                $html .= '
                            <tr>
                                <td colspan="6" style="width: 50%;"><b>Total Effect of Unadjusted Errors</b></td>
                                <td style="width: 10%;" class="cent">'.$aef_drps + $aej_drps + $ee_drps + $de_drps.'</td>
                                <td style="width: 10%;" class="cent">'.$aef_crps + $aej_crps + $ee_crps + $de_crps.'</td>
                                <td style="width: 10%;" class="cent">'.$aef_drfp + $aej_drfp + $ee_drfp + $de_drfp.'</td>
                                <td style="width: 10%;" class="cent">'.$aef_crfp + $aej_crfp + $ee_crfp + $de_crfp.'</td>
                            </tr>
                        </tbody>
                    </table>
                    <p><b>Conclusion (only include errors which remain uncorrected):</b></p>
                    <table border="1">
                        <thead>
                            <tr>
                                <th style="width: 10%;"></th>
                                <th style="width: 40%;"></th>
                                <th colspan="4" style="width: 40%;"><b>Potential Effect on the Financial Statements</b></th>
                            </tr>
                            <tr>
                                <th></th>
                                <th></th>
                                <th colspan="2" style="width: 20%;"><b>Performance Statements</b></th>
                                <th colspan="2" style="width: 20%;"><b>S\'ment of Fin. Position</b></th>

                            </tr>
                            <tr>
                                <th style="width: 10%;"><b>WP Ref.</b></th>
                                <th style="width: 40%;"><b>Details</b></th>
                                <th style="width: 10%;" class="cent"><b>Dr</b></th>
                                <th style="width: 10%;" class="cent"><b>Cr</b></th>
                                <th style="width: 10%;" class="cent"><b>Dr</b></th>
                                <th style="width: 10%;" class="cent"><b>Cr</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tbody>
                                <tr>
                                    <td style="width: 10%;">B DIV</td>
                                    <td style="width: 40%;">Intangibles and goodwill</td>
                                    <td style="width: 10%;">'.$con['bdr1'].'</td>
                                    <td style="width: 10%;">'.$con['bcr1'].'</td>
                                    <td style="width: 10%;">'.$con['bdr2'].'</td>
                                    <td style="width: 10%;">'.$con['bcr2'].'</td>
                                </tr>
                                <tr>
                                    <td style="width: 10%;">C DIV</td>
                                    <td style="width: 40%;">Property, plant and equipment</td>
                                    <td style="width: 10%;">'.$con['cdr1'].'</td>
                                    <td style="width: 10%;">'.$con['ccr1'].'</td>
                                    <td style="width: 10%;">'.$con['cdr2'].'</td>
                                    <td style="width: 10%;">'.$con['ccr2'].'</td>
                                </tr>
                                <tr>
                                    <td style="width: 10%;">D/G DIV</td>
                                    <td style="width: 40%;">Investments</td>
                                    <td style="width: 10%;">'.$con['ddr1'].'</td>
                                    <td style="width: 10%;">'.$con['dcr1'].'</td>
                                    <td style="width: 10%;">'.$con['ddr2'].'</td>
                                    <td style="width: 10%;">'.$con['dcr2'].'</td>
                                </tr>
                                <tr>
                                    <td style="width: 10%;">E DIV</td>
                                    <td style="width: 40%;">Inventories</td>
                                    <td style="width: 10%;">'.$con['edr1'].'</td>
                                    <td style="width: 10%;">'.$con['ecr1'].'</td>
                                    <td style="width: 10%;">'.$con['edr2'].'</td>
                                    <td style="width: 10%;">'.$con['ecr2'].'</td>
                                </tr>
                                <tr>
                                    <td style="width: 10%;">F DIV</td>
                                    <td style="width: 40%;">Receivables</td>
                                    <td style="width: 10%;">'.$con['fdr1'].'</td>
                                    <td style="width: 10%;">'.$con['fcr1'].'</td>
                                    <td style="width: 10%;">'.$con['fdr2'].'</td>
                                    <td style="width: 10%;">'.$con['fcr2'].'</td>
                                </tr>
                                <tr>
                                    <td style="width: 10%;">H DIV</td>
                                    <td style="width: 40%;">Cash at bank and in hand</td>
                                    <td style="width: 10%;">'.$con['hdr1'].'</td>
                                    <td style="width: 10%;">'.$con['hcr1'].'</td>
                                    <td style="width: 10%;">'.$con['hdr2'].'</td>
                                    <td style="width: 10%;">'.$con['hcr2'].'</td>
                                </tr>
                                <tr>
                                    <td style="width: 10%;">I DIV</td>
                                    <td style="width: 40%;">Payables</td>
                                    <td style="width: 10%;">'.$con['idr1'].'</td>
                                    <td style="width: 10%;">'.$con['icr1'].'</td>
                                    <td style="width: 10%;">'.$con['idr2'].'</td>
                                    <td style="width: 10%;">'.$con['icr2'].'</td>
                                </tr>
                                <tr>
                                    <td style="width: 10%;">J DIV</td>
                                    <td style="width: 40%;">Taxation</td>
                                    <td style="width: 10%;">'.$con['jdr1'].'</td>
                                    <td style="width: 10%;">'.$con['jcr1'].'</td>
                                    <td style="width: 10%;">'.$con['jdr2'].'</td>
                                    <td style="width: 10%;">'.$con['jcr2'].'</td>
                                </tr>
                                <tr>
                                    <td style="width: 10%;">L DIV</td>
                                    <td style="width: 40%;">Provisions</td>
                                    <td style="width: 10%;">'.$con['ldr1'].'</td>
                                    <td style="width: 10%;">'.$con['lcr1'].'</td>
                                    <td style="width: 10%;">'.$con['ldr2'].'</td>
                                    <td style="width: 10%;">'.$con['lcr2'].'</td>
                                </tr>
                                <tr>
                                    <td style="width: 10%;">M DIV</td>
                                    <td style="width: 40%;">Equity</td>
                                    <td style="width: 10%;">'.$con['mdr1'].'</td>
                                    <td style="width: 10%;">'.$con['mcr1'].'</td>
                                    <td style="width: 10%;">'.$con['mdr2'].'</td>
                                    <td style="width: 10%;">'.$con['mcr2'].'</td>
                                </tr>
                                <tr>
                                    <td style="width: 10%;">O DIV</td>
                                    <td style="width: 40%;">Revenue</td>
                                    <td style="width: 10%;">'.$con['odr1'].'</td>
                                    <td style="width: 10%;">'.$con['ocr1'].'</td>
                                    <td style="width: 10%;">'.$con['odr2'].'</td>
                                    <td style="width: 10%;">'.$con['ocr2'].'</td>
                                </tr>
                                <tr>
                                    <td style="width: 10%;">P DIV</td>
                                    <td style="width: 40%;">Direct costs</td>
                                    <td style="width: 10%;">'.$con['pdr1'].'</td>
                                    <td style="width: 10%;">'.$con['pcr1'].'</td>
                                    <td style="width: 10%;">'.$con['pdr2'].'</td>
                                    <td style="width: 10%;">'.$con['pcr2'].'</td>
                                </tr>
                                <tr>
                                    <td style="width: 10%;">Q DIV</td>
                                    <td style="width: 40%;">Other income and gains</td>
                                    <td style="width: 10%;">'.$con['qdr1'].'</td>
                                    <td style="width: 10%;">'.$con['qcr1'].'</td>
                                    <td style="width: 10%;">'.$con['qdr2'].'</td>
                                    <td style="width: 10%;">'.$con['qcr2'].'</td>
                                </tr>
                                <tr>
                                    <td style="width: 10%;">R DIV</td>
                                    <td style="width: 40%;">Other expenditure and losses</td>
                                    <td style="width: 10%;">'.$con['rdr1'].'</td>
                                    <td style="width: 10%;">'.$con['rcr1'].'</td>
                                    <td style="width: 10%;">'.$con['rdr2'].'</td>
                                    <td style="width: 10%;">'.$con['rcr2'].'</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2">Total Effect of Unadjusted Errors</td>
                                    <td>'.$con['bdr1'] + $con['cdr1'] + $con['ddr1'] + $con['edr1'] + $con['fdr1'] + $con['hdr1'] + $con['idr1'] + $con['jdr1'] + $con['ldr1'] + $con['mdr1'] + $con['odr1'] + $con['pdr1'] + $con['qdr1']  + $con['rdr1']  .'</td>
                                    <td>'.$con['bcr1'] + $con['ccr1'] + $con['dcr1'] + $con['ecr1'] + $con['fcr1'] + $con['hcr1'] + $con['icr1'] + $con['jcr1'] + $con['lcr1'] + $con['mcr1'] + $con['ocr1'] + $con['pcr1'] + $con['qcr1']  + $con['rcr1']  .'</td>
                                    <td>'.$con['bdr2'] + $con['cdr2'] + $con['ddr2'] + $con['edr2'] + $con['fdr2'] + $con['hdr2'] + $con['idr2'] + $con['jdr2'] + $con['ldr2'] + $con['mdr2'] + $con['odr2'] + $con['pdr2'] + $con['qdr2']  + $con['rdr2']  .'</td>
                                    <td>'.$con['bcr2'] + $con['ccr2'] + $con['dcr2'] + $con['ecr2'] + $con['fcr2'] + $con['hcr2'] + $con['icr2'] + $con['jcr2'] + $con['lcr2'] + $con['mcr2'] + $con['ocr2'] + $con['pcr2'] + $con['qcr2']  + $con['rcr2']  .'</td>
                                </tr>
                            </tfoot>
                        </tbody>
                    </table>
                    <p>The errors in total are clearly trivial (as defined by the planning letter) and have not been communicated to the directors.*</p>
                    <p>The errors in total are not trivial and the directors have confirmed verbally that they do not want to adjust them and this will be confirmed in the letter of representation.*</p>
                    <p>I am satisfied that the combined effect of the above errors is below performance materiality for the financial statements as a whole**, and therefore does not warrant correction.*</p>
                    <p>The errors in total exceed performance materiality for the financial statements as a whole**, and given the risk of unidentified items, the financial statements are deemed to be materially incorrect, and the audit opinion will be modified (Aa1, page 7)</p>
                    <table>
                        <tr>
                            <td style="width: 50%;">Signed:___________ (A.E.P.)</td>
                            <td style="width: 50%;">Dated:_____________</td>
                        </tr>
                    </table>
                    <br><br>
                    <p>*  Delete as appropriate</p>
                    <p>** Does not turn a profit into a loss (or vice versa) or a net asset position into a net liability position (or vice versa), adjustments, misstatements for an individual area being greater than the performance materiality level, or is greater than any of the specific measures of performance materiality noted at Ac13 (for example, related party transactions, directors\' emoluments, etc.).  Also, where the client has artificially ‘cherry picked’ potential adjustments to achieve a particular presentation of its financial position, financial performance or cash flows (for example, all items that reduce profit have been corrected but all adjustments that increase it have not) then this would also be considered to be a material error in the financial statements.</p>
                    <p><b>Notes: </b><br>"Clearly trivial"  errors do not need to be accumulated.  These items are clearly inconsequential, whether taken individually or in aggregate, whether judged by size, nature or circumstances.  It is suggested that 1% of audit materiality is used to determine a level at which items are deemed to be clearly trivial, but a different percentage can be used if deemed to be more appropriate and is adequately justified.  </p>
                    <p>However, misstatements relating to amounts may not be clearly trivial when judged on criteria of nature or circumstance. If this is the case, the misstatements should be accumulated as unadjusted errors.</p>
                    <p>Misstatements in disclosures may also be clearly trivial whether taken individually or in aggregate, and whether judged by any criteria of size, nature or circumstances. Misstatements in disclosures that are not clearly trivial are also accumulated to assist the auditor in evaluating the effect of such misstatements on the relevant disclosures and the financial statements as a whole. Paragraph A13a of ISA 450 provides examples of where misstatements in qualitative disclosures may be material.</p>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';

                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : Summary of adjustments mate to the client\'s financial statements',1,1);
                $html .= $style;
                $ad    = $rp->getvalues_m('c3','ad',$c['code'],$c['mtID'],$cID,$wpID);
                $rdata = $rp->getvalues_s('c3','aa11uead',$c['code'],$c['mtID'],$cID,$wpID);
                $ue    = json_decode($rdata['field1'], true);   
                $html .= '
                    <p><b>SUMMARY OF ADJUSTMENTS MADE TO THE CLIENT\'S FINANCIAL STATEMENTS</b></p>
                    <p><b>Objective:</b> <br> To carry out a review of the financial statements such that the results obtained, together with the conclusions drawn from other audit tests, give a basis for the opinion on the financial statements.</p>
                    <p><b>Recording:</b> <br> Review key ratios of most significance to the entity. Any large or unexpected movements in these ratios should be explained. This section should also contain details of significant or unexpected changes in major Statement of Financial Position and Performance Statement items.</p>
                    <p><b>Comparisons should be made of current period figures with prior period and / or budgeted figures.  Explanations obtained for significant or unexpected changes in key business ratios and items in the financial statements must be corroborated by other evidence. A conclusion should then be reached. </b></p>
                    <p><b><i>Undertaking analytical procedures at finalisation is mandatory; however, the use of this form is optional.</i></b></p>
                    <table border="1">
                        <thead>
                            <tr>
                                <th style="width: 10%;"></th>
                                <th style="width: 40%;"></th>
                                <th colspan="4" style="width: 40%;"><b>Potential Effect on the Financial Statements</b></th>
                            </tr>
                            <tr>
                                <th></th>
                                <th></th>
                                <th colspan="2" style="width: 20%;"><b>Performance Statements</b></th>
                                <th colspan="2" style="width: 20%;"><b>S\'ment of Fin. Position</b></th>
                        
                            </tr>
                            <tr>
                                <th style="width: 10%;"><b>WP Ref.</b></th>
                                <th style="width: 40%;"><b>Account and Description of Adjustment</b></th>
                                <th style="width: 10%;" class="cent"><b>Dr</b></th>
                                <th style="width: 10%;" class="cent"><b>Cr</b></th>
                                <th style="width: 10%;" class="cent"><b>Dr</b></th>
                                <th style="width: 10%;" class="cent"><b>Cr</b></th>
                            </tr>
                            <tr>
                                <th colspan="6"><b>ADJUSTMENTS MADE BY AUDITORS</b></th>
                            </tr>
                        </thead>
                        <tbody>
                ';
                    $drps = 0;
                    $crps = 0;
                    $drfp = 0;
                    $crfp = 0;
                    foreach($ad as $r){
                        $drps += $r['field3'];
                        $crps += $r['field4'];
                        $drfp += $r['field5'];
                        $crfp += $r['field6'];
                        $html .= '
                            <tr>
                                <td style="width: 10%;">'.$r['field1'].'</td>
                                <td style="width: 40%;">'.$r['field2'].'</td>
                                <td style="width: 10%;" class="cent">'.$r['field3'].'</td>
                                <td style="width: 10%;" class="cent">'.$r['field4'].'</td>
                                <td style="width: 10%;" class="cent">'.$r['field5'].'</td>
                                <td style="width: 10%;" class="cent">'.$r['field6'].'</td>
                            </tr>
                        ';
                    }
                $html .= '
                            <tr>
                                <td colspan="6" style="width: 50%;"><b>Total Effect of Unadjusted Errors</b></td>
                                <td style="width: 10%;" class="cent">'.$drps.'</td>
                                <td style="width: 10%;" class="cent">'.$crps.'</td>
                                <td style="width: 10%;" class="cent">'.$drfp.'</td>
                                <td style="width: 10%;" class="cent">'.$crfp.'</td>
                            </tr>
                        </tbody>
                    </table>
                    <br><br>
                    <table>
                        <tbody>
                            <tr>
                                <td style="width: 65%;"><b>Profit (Loss) for the Period per Draft Financial Statements</b></td>
                                <td style="width: 5%;"><b>CU</b></td>
                                <td style="width: 20%;" class="bo">'.$ue['pl'].'</td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                            </tr>
                            <tr>
                                <td style="width: 65%;"><b>Net Adjustments Made by Auditors to Client\'s Draft Figures</b></td>
                                <td style="width: 5%;"><b>CU</b></td>
                                <td style="width: 20%;" class="bo">'.$ue['na'].'</td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                            </tr>
                            <tr>
                                <td style="width: 65%;"><b>Profit (Loss)  for the Period per Final Financial Statements</b></td>
                                <td style="width: 5%;"><b>CU</b></td>
                                <td style="width: 20%;" class="bo">'.$ue['pl2'].'</td>
                            </tr>
                        </tbody>
                    </table>
                    <p>No adjustments have been made to the client\'s draft financial statements.*</p>
                    <p>The above adjustments have been identified, the directors ("informed management") have confirmed verbally that they wish to adjust them and this will be confirmed in the letter of representation.*</p>
                    <table>
                        <tr>
                            <td style="width: 50%;">Signed:___________ (A.E.P.)</td>
                            <td style="width: 50%;">Dated:_____________</td>
                        </tr>
                    </table>
                    <p>* Delete as appropriate</p>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';

            break;
            case 'AA9':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : Auditors Responsibilities Relating to Other Information',1,1);
                $html .= $style;
                $rdata      = $rp->getvalues_s('c3','aa9',$c['code'],$c['mtID'],$cID,$wpID);
                $a9         = json_decode($rdata['field1'], true);  
                $html .= '
                    <h3>THE AUDITOR’S RESPONSIBILITIES RELATING TO OTHER INFORMATION</h3>
                    <p><b>AUDITOR’S OBJECTIVE:</b></p>
                    <p>The objectives of the auditor, having read the other information, are:</p>
                    <ol type="a">
                        <li>)To consider whether there is a material inconsistency between the other information and the financial statements;</li>
                        <li>)To consider whether there is a material inconsistency between the other information and the auditor’s knowledge obtained in the audit;</li>
                        <li>)To respond appropriately when the auditor identifies that such material inconsistencies appear to exist, or when the auditor otherwise becomes aware that other information appears to be materially misstated; and</li>
                        <li>)To report in accordance with this PSA.</li>
                    </ol>
                    <p><b>AUDIT PROCEDURES</b></p>

                    <table border="1">
                        <thead>
                            <tr>
                                <th style="width: 60%;"></th>
                                <th style="width: 20%;">WP REF.</th>
                                <th style="width: 20%;">DONE BY</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="width: 60%;">
                                    <p>1.	Determine, through discussion with management, which document(s) comprises the annual report, and the entity’s planned manner and timing of the issuance of such document(s);</p>
                                    <p>2.	Make appropriate arrangements with management to obtain in a timely manner and, if possible, prior to the date of the auditor’s report, the final version of the document(s) comprising the annual report; </p>
                                    <p>3.	When some or all of the document(s) determined  will not be available until after the date of the auditor’s report, request management to provide a written representation that the final version of the document(s) will be provided to the auditor when available, and prior to its issuance by the entity, such that the auditor can complete the procedures required by this PSA.</p>
                                </td>
                                <td style="width: 20%;">'.$a9['wpref1'].'</td>
                                <td style="width: 20%;">'.$a9['doneby1'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 60%;">
                                    <p>4.	The auditor shall read the other information and consider whether there is a material inconsistency between the other information and the financial statements. </p>
                                    <p>5.	As the basis for the above consideration, the auditor shall, to evaluate their consistency, compare selected amounts or other items in the other information (that are intended to be the same as, to summarize, or to provide greater detail about, the amounts or other items in the financial statements) with such amounts or other items in the financial statements; </p>
                                    <p>6.	Consider whether there is a material inconsistency between the other information and the auditor’s knowledge obtained in the audit, in the context of audit evidence obtained and conclusions reached in the audit. </p>
                                </td>
                                <td style="width: 20%;">'.$a9['wpref2'].'</td>
                                <td style="width: 20%;">'.$a9['doneby2'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 60%;">
                                    <p>7.	While reading the other information, the auditor shall remain alert for indications that the other information not related to the financial statements or the auditor’s knowledge obtained in the audit appears to be materially misstated.</p>
                                </td>
                                <td style="width: 20%;">'.$a9['wpref3'].'</td>
                                <td style="width: 20%;">'.$a9['doneby3'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 60%;">
                                    <p>8.	If the auditor identifies that a material inconsistency appears to exist (or becomes aware that the other information appears to be materially misstated), the auditor shall discuss the matter with management and, if necessary, perform other procedures to conclude whether: (a) A material misstatement of the other information exists; (b) A material misstatement of the financial statements exists; or (c) The auditor’s understanding of the entity and its environment needs to be updated.</p>
                                </td>
                                <td style="width: 20%;">'.$a9['wpref4'].'</td>
                                <td style="width: 20%;">'.$a9['doneby4'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 60%;">
                                    <p>9.	If the auditor concludes that a material misstatement of the other information exists, the auditor shall request management to correct the other information. </p>
                                    <p>10.	If management agrees to make the correction, the auditor shall determine that the correction has been made.</p>
                                    <p>11.	If management refuses to make the correction, the auditor shall communicate the matter with those charged with governance and request that the correction be made.</p>
                                </td>
                                <td style="width: 20%;">'.$a9['wpref5'].'</td>
                                <td style="width: 20%;">'.$a9['doneby5'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 60%;">
                                    <p>12.	If the auditor concludes that a material misstatement exists in other information obtained prior to the date of the auditor’s report, and the other information is not corrected after communicating with those charged with governance, the auditor shall take appropriate action, including communicating with those charged with governance about how the auditor plans to address the material misstatement in the auditor’s report; or withdrawing from the engagement, where withdrawal is possible under applicable law or regulation.</p>
                                </td>
                                <td style="width: 20%;">'.$a9['wpref6'].'</td>
                                <td style="width: 20%;">'.$a9['doneby6'].'</td>
                            </tr>
                        </tbody>
                    </table>
                    <p><b>Reporting</b></p>
                    <ul>
                        <li>The auditor’s report shall include a separate section with a heading “Other Information”, or other appropriate heading, when, at the date of the auditor’s report:
                            <ol type="a">
                                <li>) For an audit of financial statements of a listed entity, the auditor has obtained, or expects to obtain, the other information; or</li>
                                <li>) For an audit of financial statements of an entity other than a listed entity, the auditor has obtained some or all of the other information. </li>
                            </ol>
                        </li>
                        <li>When the auditor’s report is required to include Other Information section  this section shall include: (Ref: Para. A53)
                            <ol type="a">
                                <li>) A statement that management is responsible for the other information;</li>
                                <li>) An identification of:
                                    <ol type="i">
                                        <li> )Other information, if any, obtained by the auditor prior to the date of the auditor’s report; and</li>
                                        <li>) For an audit of financial statements of a listed entity, other information, if any, expected to be obtained after the date</li>
                                    </ol>
                                </li>
                                <li>) A statement that the auditor’s opinion does not cover the other information and, accordingly, that the auditor does not express (or will not express) an audit opinion or any form of assurance conclusion thereon;</li>
                                <li>) A description of the auditor’s responsibilities relating to reading, considering and reporting on other information as required by this PSA; and</li>
                                <li>) When other information has been obtained prior to the date of the auditor’s report, either:
                                    <ol type="i">
                                        <li>) A statement that the auditor has nothing to report; or</li>
                                        <li>) If the auditor has concluded that there is an uncorrected material misstatement of the other information, a statement that describes the uncorrected material misstatement of the other information.</li>
                                    </ol>
                                </li>
                            </ol>
                        </li>
                        <li>When the auditor expresses a qualified or adverse opinion in accordance with PSA 705 (Revised), the auditor shall consider the implications of the matter giving rise to the modification of opinion for the statement.</li>
                    </ul>
                    <p><b><i>Reporting Prescribed by Law or Regulation</i></b></p>
                    <ul>
                        <li>If the auditor is required by law or regulation of a specific jurisdiction to refer to the other information in the auditor’s report using a specific layout or wording, the auditor’s report shall refer to Philippine Standards on Auditing only if the auditor’s report includes, at a minimum: 
                            <ol type="a">
                                <li>) Identification of the other information obtained by the auditor prior to the date of the auditor’s report;</li>
                                <li>) A description of the auditor’s responsibilities with respect to the other information; and</li>
                                <li>) An explicit statement addressing the outcome of the auditor’s work for this purpose.</li>
                            </ol>
                        </li>
                    </ul>
                    <p><b>GUIDANCE</b></p>
                    <p><b><i>Examples of Amounts or Other Items that May Be Included in the Other Information</i></b></p>
                    <p><b>Amounts</b></p>
                    <ul>
                        <li>Items in a summary of key financial results, such as net income, earnings per share, dividends, sales and other operating revenues, and purchases and operating expenses.</li>
                        <li>Selected operating data, such as income from continuing operations by major operating area, or sales by geographical segment or product line.</li>
                        <li>Special items, such as asset dispositions, litigation provisions, asset impairments, tax adjustments, environmental remediation provisions, and restructuring and reorganization expenses.</li>
                        <li>Liquidity and capital resource information, such as cash, cash equivalents and marketable securities; dividends; and debt, capital lease and minority interest obligations.</li>
                        <li>Capital expenditures by segment or division.</li>
                        <li>Amounts involved in, and related financial effects of, off-balance sheet arrangements.</li>
                        <li>Amounts involved in guarantees, contractual obligations, legal or environmental claims, and other contingencies.</li>
                        <li>Financial measures or ratios, such as gross margin, return on average capital employed, return on average shareholders’ equity, current ratio, interest coverage ratio and debt ratio. Some of these may be directly reconcilable to the financial statements.</li>
                    </ul>
                    <p><b>Other Items</b></p>
                    <ul>
                        <li>Explanations of critical accounting estimates and related assumptions.</li>
                        <li>Identification of related parties and descriptions of transactions with them.</li>
                        <li>Articulation of the entity’s policies or approach to manage commodity, foreign exchange or interest rate risks, such as through the use of forward contracts, interest rate swaps, or other financial instruments.</li>
                        <li>Descriptions of the nature of off-balance sheet arrangements.</li>
                        <li>Descriptions of guarantees, indemnifications, contractual obligations, litigation or environmental liability cases, and other contingencies, including management’s qualitative assessments of the entity’s related exposures.</li>
                        <li>Descriptions of changes in legal or regulatory requirements, such as new tax or environmental regulations, that have materially impacted the entity’s operations or fiscal position, or will have a material impact on the entity’s future financial prospects.</li>
                        <li>Management’s qualitative assessments of the impacts of new financial reporting standards that have come into effect during the period, or will come into effect in the following period, on the entity’s financial results, financial position and cash flows.</li>
                        <li>General descriptions of the business environment and outlook.</li>
                        <li>Overview of strategy.</li>
                        <li>Descriptions of trends in market prices of key commodities or raw materials.</li>
                        <li>Contrasts of supply, demand and regulatory circumstances between geographic regions.</li>
                        <li>Explanations of specific factors influencing the entity’s profitability in specific segments.</li>
                    </ul>

                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;
            case 'AA10':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : Communication with those charged with governance',1,1);
                $html .= $style;
                $rdata      = $rp->getvalues_s('c3','aa10',$c['code'],$c['mtID'],$cID,$wpID);
                $a10         = json_decode($rdata['field1'], true);  
                $html .= '
                    <h3>COMMUNICATION OF AUDIT MATTERS WITH THOSE CHARGED WITH GOVERNANCE</h3>
                    <p><b>AUDIT OBJECTIVES:</b></p>
                    <ol type="a">
                        <li>) To communicate clearly with those charged with governance the responsibilities of the auditor in relation to the financial statement audit, and an overview of the planned scope and timing of the audit; </li>
                        <li>) To obtain from those charged with governance information relevant to the audit; </li>
                        <li>) To provide those charged with governance with timely observations arising from the audit that are significant and relevant to their responsibility to oversee the financial reporting process; and </li>
                        <li>) To promote effective two-way communication between the auditor and those charged with governance.  </li>
                    </ol>
                    <p><b>AUDIT PROCEDURES</b></p>

                    <table border="1">
                        <thead>
                            <tr>
                                <th style="width: 60%;"><b><i>The auditor should determine the appropriate persons within the organization’s governance structure with whom to communicate.</i></b></th>
                                <th style="width: 20%;">WP REF.</th>
                                <th style="width: 20%;">DONE BY</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="width: 60%;">
                                    <p>1.	Based on the results of obtaining an understanding of the entity and its environment, identify the relevant persons who are charged with governance and with whom audit matters of governance interest are communicated.</p>
                                    <p>2.	Where necessary, use judgment to determine those persons with whom audit matters of governance interest are communicated, taking into account:</p>
                                    <ul>
                                        <li>the governance structure of the entity</li>
                                        <li>the circumstances of the engagement and any relevant legislation; and </li>
                                        <li>the legal responsibilities of those persons.</li>
                                    </ul>
                                    <p>3.	When the entity’s governance structure is not well defined, or those charged with governance are not clearly identified by the circumstances of the engagement, or by legislation, come to an agreement with the entity about with whom audit matters of governance interest are to be communicated.</p>
                                    <p>4.	Include in the audit engagement letter an explanation that </p>
                                    <ul>
                                        <li>We will communicate only those matters of governance interest that come to attention as a result of the performance of an audit  </li>
                                        <li>We are not required to design audit procedures for the specific purpose of identifying matters of governance interest.</li>
                                    </ul>
                                    <p>5.	As necessary,include in the engagement letter:</p>
                                    <ul>
                                        <li>a description of the form in which any communications on audit matters of governance interest will be made</li>
                                        <li>identification of the relevant persons with whom such communications will be made; </li>
                                        <li>identification of any specific audit matters of governance interest which it has been agreed are to be communicated.</li>
                                    </ul>
                                </td>
                                <td style="width: 20%;">'.$a10['wpref1'].'</td>
                                <td style="width: 20%;">'.$a10['doneby1'].'</td>
                            </tr>
                            <tr>
                                <td colspan="3"><i><b>The auditor shall communicate with those charged with governance the responsibilities of the auditor in relation to the financial statements audit</b></i></td>
                            </tr>
                            <tr>
                                <td style="width: 60%;">
                                    <p>6.	Review the results of procedures for acceptance/retention of clients, and audit planning, for possible matters of governance interest.  Such matters may include:</p>
                                    <ul>
                                        <li>Planned scope anf timing of the audit;</li>
                                        <li>Significant risks identified that may require special audit consideration,</li>
                                    </ul>
                                    <p>7.	During the performance of risk assessment procedures, identify the potential effect on the financial statements of any material risks and exposures, such as pending litigation, that are required to be disclosed in the financial statements.</p>
                                    <p>8.	During the performance of the audit, identify audit adjustments (whether or not recorded by the entity) that have, or could have, a material effect on the entity’s financial statements</p>
                                    <p>9.	Identify other matters of governance interest.</p>
                                    <p>10.	Using the form of communication agreed with the client, summarize the matters of governance interest and communicate the same to those charged with governance.</p>
                                    <p>11.	Inform those charged with governance regarding those uncorrected misstatements we aggregated during the audit that were determined by management to be immaterial, both individually and in the aggregate, to the financial statements taken as a whole.</p>
                                </td>
                                <td style="width: 20%;">'.$a10['wpref2'].'</td>
                                <td style="width: 20%;">'.$a10['doneby2'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 60%;">
                                    <p>12.	When audit matters of governance interest are communicated orally, document in the working papers the matters communicated and any responses to those matters. 
                                        <br> This documentation may take the form of a copy of the minutes of the auditor’s discussion with those charged with governance. 
                                    </p>
                                </td>
                                <td style="width: 20%;">'.$a10['wpref3'].'</td>
                                <td style="width: 20%;">'.$a10['doneby3'].'</td>
                            </tr>
                            <tr>
                                <td>
                                    <p>13.	Where deemed necessary, depending on the nature, sensitivity, and significance of the matter, confirm in writing with those charged with governance any oral communications on audit matters of governance interest.</p>
                                </td>
                                <td style="width: 20%;">'.$a10['wpref4'].'</td>
                                <td style="width: 20%;">'.$a10['doneby4'].'</td>
                            </tr>
                        </tbody>
                    </table>
                    <p><b>GUIDANCE</b></p>
                    <p><b>MATTERS TO BE COMMUNICATED TO THOSE CHARGED WITH GOVERNANCE</b></p>
                    <ol type="1">
                        <li>) The auditor’s responsibilities in relation to the financial statements;</li>
                        <li>) Planned scope and timing of the audit;</li>
                        <li>) Significant findings from the audit;</li>
                        <li>) Significant difficulties encountered during the audit;</li>
                        <li>) Significant matters discussed, or subject to correspondence with management;</li>
                        <li>) Circumstances that affect the form and content of the auditor’s report;</li>
                        <li>) Other significant matters relevant to the financial reporting process;</li>
                        <li>) Auditor independence;</li>
                        <li>) Supplementary matters.</li>
                    </ol>
                    <p><b>Cross-referencing with Other Standards</b></p>
                    <p>Specific Requirements in PSQC 1 and Other PSAs that Refer to communications with Those Charged With Governance </p>
                    <ul>
                        <li> PSQC 1,  <i>Quality Control for Firms that Perform Audits and Reviews of Financial Statements, and Other Assurance and Related Services Engagements </i> – paragraph 30(a) </li>
                        <li> PSA 240, <i>The Auditor’s Responsibilities Relating to Fraud in an Audit of Financial Statements</i> – paragraphs 21, 38(c)(i) and 40-42 </li>
                        <li> PSA 250, <i>Consideration of Laws and Regulations in an Audit of Financial Statements</i> – paragraphs 14, 19 and 22–24 </li>
                        <li> PSA 265, <i>Communicating Deficiencies in Internal Control to Those Charged with Governance and Management </i> – paragraph 9 </li>
                        <li> PSA 450, <i>Evaluation of Misstatements Identified during the Audit</i> – paragraphs 12-13 </li>
                        <li> PSA 505, <i>External Confirmations</i> – paragraph 9 </li>
                        <li> PSA 510, <i>Initial Audit Engagements―Opening Balances </i> – paragraph 7 </li>
                        <li> PSA 550, <i>Related Parties</i> – paragraph 27 </li>
                        <li> PSA 560, <i>Subsequent Events</i>–  paragraphs 7(b)-(c), 10(a), 13(b), 14(a) and 1</li>
                        <li> PSA 570 (Revised), <i>Going Concern</i> – paragraph 25 </li>
                        <li> PSA 600, <i>Special Considerations―Audits of Group Financial Statements (Including the Work of Component Auditors)</i> – paragraph 49 </li>
                        <li> PSA 610 (Revised), <i>Using the Work of Internal Auditors</i> – paragraph 18; PSA 610 (Revised 2013), <i>Using the Work of Internal Auditors</i> – paragraphs 20 and 31 </li>
                        <li> PSA 700 (Revised),<i>Forming an Opinion and Reporting on Financial Statements</i> – paragraph 45 </li>
                        <li> PSA 701, <i>Communicating Key Audit Matters in the Independent Auditor’s Report</i> – paragraph 17 </li>
                        <li> PSA 705 (Revised), <i>Modifications to the Opinion in the Independent Auditor’s Report </i>– paragraphs 12, 14, 23 and 30 </li>
                        <li> PSA 706 (Revised), <i>Emphasis of Matter Paragraphs and Other Matter Paragraphs in the Independent Auditor’s Report</i>– paragraph 12 </li>
                        <li> PSA 710, <i>Comparative Information—Corresponding Figures and Comparative Financial Statements</i> – paragraph 18 </li>
                        <li> PSA 720, <i>The Auditor’s Responsibilities Relating to Other Information in Documents Containing Audited Financial Statements </i> – paragraphs 10, 13 and 16 </li>
                    </ul>
                    <p><b>Qualitative Aspects of Accounting Practices</b></p>
                    <p>The communication required by paragraph 12(a), and discussed in paragraph A21, may include such matters as:</p>
                    <p>Accounting Policies</p>
                    <ul>
                        <li> The appropriateness of the accounting policies to the particular circumstances of the entity, having regard to the need to balance the cost of providing information with the likely benefit to users of the entity’s financial statements. Where acceptable alternative accounting policies exist, the communication may include identification of the financial statement items that are affected by the choice of significant accounting policies as well as information on accounting policies used by similar entities.</li>
                        <li> The initial selection of, and changes in significant accounting policies, including the application of new accounting pronouncements. The communication may include: the effect of the timing and method of adoption of a change in accounting policy on the current and future earnings of the entity; and the timing of a change in accounting policies in relation to expected new accounting pronouncements.</li>
                        <li> The effect of significant accounting policies in controversial or emerging areas (or those unique to an industry, particularly when there is a lack of authoritative guidance or consensus).</li>
                        <li> The effect of the timing of transactions in relation to the period in which they are recorded.</li>
                    </ul>
                    <p>Accounting Estimates</p>
                    <p>For items for which estimates are significant, issues discussed in PSA 540,28 including, for example: </p>
                    <ul>
                        <li> How management identifies those transactions, events and conditions that may give rise to the need for accounting estimates to be recognized or disclosed in the financial statements. </li>
                        <li> Changes in circumstances that may give rise to new, or the need to revise existing, accounting estimates. </li>
                        <li> Whether management’s decision to recognize, or to not recognize, the accounting estimates in the financial statements is in accordance with the applicable financial reporting framework. </li>
                        <li> Whether there has been or ought to have been a change from the prior period in the methods for making the accounting estimates and, if so, why, as well as the outcome of accounting estimates in prior periods. </li>
                        <li> Management’s process for making accounting estimates (e.g., when management has used a model), including whether the selected measurement basis for the accounting estimate is in accordance with the applicable financial reporting framework. </li>
                        <li> Whether the significant assumptions used by management in developing the accounting estimate are reasonable. </li>
                        <li> Where relevant to the reasonableness of the significant assumptions used by management or the appropriate application of the applicable financial reporting framework, management’s intent to carry out specific courses of action and its ability to do so. </li>
                        <li> Risks of material misstatement. </li>
                        <li> Indicators of possible management bias. </li>
                        <li> How management has considered alternative assumptions or outcomes and why it has rejected them, or how management has otherwise addressed estimation uncertainty in making the accounting estimate. </li>
                        <li> The adequacy of disclosure of estimation uncertainty in the financial statements </li>
                    </ul>
                    <p>Financial Statement Disclosures</p>
                    <ul>
                        <li>The issues involved, and related judgments made, in formulating particularly sensitive financial statement disclosures (e.g., disclosures related to revenue recognition, remuneration, going concern, subsequent events, and contingency issues).</li>
                        <li>The overall neutrality, consistency and clarity of the disclosures in the financial statements.</li>
                    </ul>
                    <p>Related Matters</p>
                    <ul>
                        <li>The potential effect on the financial statements of significant risks, exposures and uncertainties, such as pending litigation, that are disclosed in the financial statements.</li>
                        <li>The extent to which the financial statements are affected by significant transactions that are outside the normal course of business for the entity, or that otherwise appear to be unusual. This communication may highlight: 
                            <ul>
                                <li>The non-recurring amounts recognized during the period. </li>
                                <li>The extent to which such transactions are separately disclosed in the financial statements. </li>
                                <li>Whether such transactions appear to have been designed to achieve a particular accounting or tax treatment, or a particular legal or regulatory objective. </li>
                                <li>Whether the form of such transactions appears overly complex or where extensive advice regarding the structuring of the transaction has been taken. </li>
                                <li>Where management is placing more emphasis on the need for a particular accounting treatment than on the underlying economics of the transaction. </li>
                            </ul>
                        </li>
                        <li>The factors affecting asset and liability carrying values, including the entity’s bases for determining useful lives assigned to tangible and intangible assets. The communication may explain how factors affecting carrying values were selected and how alternative selections would have affected the financial statements.</li>
                        <li>The selective correction of misstatements, for example, correcting misstatements with the effect of increasing reported earnings, but not those that have the effect of decreasing reported earnings.</li>
                    </ul>
                ';

                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;
            case 'AA11':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : Guidance for Modifications to the Opinion in the Auditors Report',1,1);
                $html .= $style;
                $a11      = $rp->getvalues_m('c3','aa11',$c['code'],$c['mtID'],$cID,$wpID); 
                $html .= '
                    <h3>GUIDANCE ON MODIFICATION TO THE OPINION  IN THE INDEPENDENT AUDITOR’S REPORT</h3>
                    <p><b>AUDITOR’S OBJECTIVE:</b></p>
                    <p>The objective of the auditor is to express clearly an appropriately modified opinion on the financial statements. </p>
                    <p><b>REQUIREMENTS</b></p>
                    <p><b><i>Circumstances When a Modification to the Auditor’s Opinion Is Required </i></b></p>
                    <ol type="a">
                        <li>) The auditor concludes that, based on the audit evidence obtained, the financial statements as a whole are not free from material misstatement; or </li>
                        <li>) The auditor is unable to obtain sufficient appropriate audit evidence to conclude that the financial statements as a whole are free from material misstatement. </li>
                    </ol>
                    <p><b><i>Determining the Type of Modification to the Auditor’s Opinion</i></b></p>
                    <p><i>Qualified Opinion </i></p>
                    <p>The auditor shall express a <b>qualified opinion</b> when: </p>
                    <ol type="a">
                        <li>) The auditor, having obtained sufficient appropriate audit evidence, concludes that misstatements, individually or in the aggregate, are <b>material but not pervasive</b> , to the financial statements; or </li>
                        <li>) The auditor is unable to obtain sufficient appropriate audit evidence on which to base the opinion, but the auditor concludes that the possible effects on the financial statements of undetected misstatements, if any, could be <b>material but not pervasive</b>. </li>
                    </ol>
                    <p><i>Adverse Opinion </i></p>
                    <p>The auditor shall express an adverse opinion when the auditor, having obtained sufficient appropriate audit evidence, concludes that misstatements, individually or in the aggregate are, <b>both material and pervasive</b> to the financial statements. </p>
                    <p><i>Disclaimer of Opinion </i></p>
                    <p>The auditor shall disclaim an opinion when the auditor is unable to obtain sufficient appropriate audit evidence on which to base the opinion, and the auditor concludes that the possible effects on the financial statements of undetected misstatements, if any, could be <b>both material and pervasive.</b>  </p>
                    <p>The auditor shall disclaim an opinion when, in extremely rare circumstances involving multiple uncertainties, the auditor concludes that, notwithstanding having obtained sufficient appropriate audit evidence regarding each of the individual uncertainties, it is not possible to form an opinion on the financial statements due to the potential interaction of the uncertainties and their possible cumulative effect on the financial statements. </p>
                    <p><b><i>Consequence of an Inability to Obtain Sufficient Appropriate Audit Evidence Due to a Management- Imposed Limitation after the Auditor Has Accepted the Engagement </i></b></p>
                    <ul>
                        <li>If, after accepting the engagement, the auditor becomes aware that management has imposed a limitation on the scope of the audit that the auditor considers likely to result in the need to expressa qualified opinion or to disclaim an opinion on the financial statements, the auditor shall request that management remove the limitation. </li>
                        <li>If management refuses to remove the limitation referred to in paragraph 11 of this PSA, the auditor shall communicate the matter to those charged with governance, unless all of those charged with governance are involved in managing the entity,2 and determine whether it is possible to perform alternative procedures to obtain sufficient appropriate audit evidence. </li>
                        <li>If the auditor is unable to obtain sufficient appropriate audit evidence, the auditor shall determine the implications as follows: 
                            <ol type="a">
                                <li>) If the auditor concludes that the possible effects on the financial statements of undetected misstatements, if any, could be material but not pervasive, the auditor shall qualify the opinion; or </li>
                                <li>) If the auditor concludes that the possible effects on the financial statements of undetected misstatements, if any, could be both material and pervasive so that a qualification of the opinion would be inadequate to communicate the gravity of the situation, the auditor shall: 
                                    <ol type="i">
                                        <li>) Withdraw from the audit, where practicable and possible under applicable law or regulation; or (Ref: Para. A13) </li>
                                        <li>) If withdrawal from the audit before issuing the auditor’s report is not practicable or possible, disclaim an opinion on the financial statements. (Ref. Para. A14) </li>
                                    </ol>
                                </li>
                            </ol>
                        </li>
                        <li>If the auditor withdraws as contemplated by (b)(i) above, before withdrawing, the auditor shall communicate to those charged with governance any matters regarding misstatements identified during the audit that would have given rise to a modification of the opinion. (Ref: Para. A1 5) </li>
                    </ul>
                    <p><b><i>Other Considerations Relating to an Adverse Opinion or Disclaimer of Opinion</i></b></p>
                    <p>When the auditor considers it necessary to express an adverse opinion or disclaim an opinion on the financial statements as a whole, the auditor’s report shall not also include an unmodified opinion with respect to the same financial reporting framework on a single financial statement or one or more specific elements, accounts or items of a financial statement. To include such an unmodified opinion in the same report3 in these circumstances would contradict the auditor’s adverse opinion or disclaimer of opinion on the financial statements as a whole. (Ref: Para. A1 6)</p>
                    <p><b>Form and Content of the Auditor’s Report When the Opinion Is Modified </b></p>
                    <p><i>Auditor’s Opinion </i></p>
                    <p>When the auditor modifies the audit opinion, the auditor shall use the heading “Qualified Opinion,” “Adverse Opinion,” or “Disclaimer of Opinion,” as appropriate, for the Opinion section. </p>
                    <p><i>Basis for Opinion </i></p>
                    <p>When the auditor modifies the opinion on the financial statements, the auditor shall, in addition to the specific elements required by PSA 700 (Revised): </p>
                    <ol type="a">
                        <li>) Amend the heading “Basis for Opinion” required by paragraph 28 of PSA 700 (Revised) to “Basis for Qualified Opinion,” “Basis for Adverse Opinion,” or “Basis for Disclaimer of Opinion,” as appropriate; and </li>
                        <li>) Within this section, include a description of the matter giving rise to the modification.</li>
                    </ol>
                    <br>
                    <p><b>MODIFIED REPORT</b></p>
                    <table border="1">
                        <thead>
                            <tr>
                                <th rowspan="2"><b>Nature of Matter Giving Rise to the Modification</b></th>
                                <th colspan="2"><b>Auditor\'s Judgment about the Pervasiveness of the Effects or Possible Effects on the Financial Statements.</b></th>
                            </tr>
                            <tr>
                                <th><b>Material but Not Pervasive</b></th>
                                <th><b>Material and Pervasive</b></th>
                            </tr>
                        </thead>
                        <tbody id="tbody"> 
                            <tr>
                                <td>Financial statements are materially misstated</td>
                                <td>Qualified opinion</td>
                                <td>Adverse opinion</td>
                            </tr>
                            <tr>
                                <td>Inability to obtain sufficient appropriate audit evidence</td>
                                <td>Qualified opinion</td>
                                <td>Disclaimer of opinion</td>
                            </tr>
                            ';
                            foreach($a11 as $r){
                                $html .= '
                                <tr>
                                    <td>'.$r['field1'].'</td>
                                    <td>'.$r['field2'].'</td>
                                    <td>'.$r['field3'].'</td>
                                </tr>
                                ';
                            }
                $html .= '
                        </tbody>
                    </table>
                ';

                $html .= '
                    <p><b><i>Circumstances When a Modification to the Auditor’s Opinion Is Required</i></b></p>
                    <ul>
                        <li><i>Nature of Material Misstatements </i>
                            <p>A material misstatement of the financial statements may arise in relation to: </p>
                            <ol type="a">
                                <li>) The appropriateness of the selected accounting policies; </li>
                                <li>) The application of the selected accounting policies; or </li>
                                <li>) The appropriateness or adequacy of disclosures in the financial statements </li>
                            </ol>
                        </li>
                        <li><i>Nature of an Inability to Obtain Sufficient Appropriate Audit Evidence</i>
                            <p>The auditor’s inability to obtain sufficient appropriate audit evidence (also referred to as a limitation on the scope of the audit) may arise from:</p>
                            <ol type="a">
                                <li>) Circumstances beyond the control of the entity; </li>
                                <li>) Circumstances relating to the nature or timing of the auditor’s work; or </li>
                                <li>) Limitations imposed by management. </li>
                            </ol>
                            <p><u>Examples of circumstances beyond the control of the entity include when: </u></p>
                            <ul>
                                <li>The entity’s accounting records have been destroyed. </li>
                                <li>The accounting records of a significant component have been seized indefinitely by governmental authorities. </li>
                            </ul>
                            <p><u>Examples of circumstances relating to the nature or timing of the auditor’s work include when: </u></p>
                            <ul>
                                <li>The entity is required to use the equity method of accounting for an associated entity, and the auditor is unable to obtain sufficient appropriate audit evidence about the latter’s financial information to evaluate whether the equity method has been appropriately applied. </li>
                                <li>The timing of the auditor’s appointment is such that the auditor is unable to observe the counting of the physical inventories. </li>
                                <li>The auditor determines that performing substantive procedures alone is not sufficient, but the entity’s controls are not effective. </li>
                            </ul>
                            <p><u>Examples of an inability to obtain sufficient appropriate audit evidence arising from a limitation on the scope of the audit imposed by management include when: </u></p>
                            <ul>
                                <li>Management prevents the auditor from observing the counting of the physical inventory. </li>
                                <li>Management prevents the auditor from requesting external confirmation of specific account balances. </li>
                            </ul>
                        </li>
                    </ul>
                    <p><b><i>Communication with Those Charged with Governance </i></b></p>
                    <p>Communicating with those charged with governance the circumstances that lead to an expected modification to the auditor’s opinion and the wording of the modification enables: </p>
                    <ol type="a">
                        <li>) The auditor to give notice to those charged with governance of the intended modification(s) and the reasons (or circumstances) for the modification(s); </li>
                        <li>) The auditor to seek the concurrence of those charged with governance regarding the facts of the matter(s) giving rise to the expected modification(s), or to confirm matters of disagreement with management as such; and,</li>
                        <li>) Those charged with governance to have an opportunity, where appropriate, to provide the auditor with further information and explanations in respect of the matter(s) giving rise to the expected modification(s).</li>
                    </ol>
                ';

                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;
            case 'AA12':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : Guidance on Emphasis of a matter and other matter paragraphs',1,1);
                $html .= $style;
                $rdata      = $rp->getvalues_s('c3','aa12',$c['code'],$c['mtID'],$cID,$wpID);
                $a12         = json_decode($rdata['field1'], true);  
                $html .= '
                    <h3>GUIDANCE ON EMPHASIS OF MATTER PARAGRAPHS AND OTHER MATTER PARAGRAPHS IN THE INDEPENDENT AUDITOR’S REPORT</h3>
                    <p><b>AUDITOR’S OBJECTIVE:</b></p>
                    <p>The objective of the auditor, having formed an opinion on the financial statements, is to draw users’ attention, when in the auditor’s judgment it is necessary to do so, </p>
                    <ol type="a">
                        <li>) A matter, although appropriately presented or disclosed in the financial statements, that is of such importance that it is fundamental to users’ understanding of the financial statements; or </li>
                        <li>) As appropriate, any other matter that is relevant to users’ understanding of the audit, the auditor’s responsibilities or the auditor’s report. </li>
                    </ol>
                    <table border="1">
                        <thead>
                            <tr>
                                <th style="width: 60%;"></th>
                                <th style="width: 20%;">WP REF.</th>
                                <th style="width: 20%;">DONE BY</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="width: 60%;">
                                    <p><b><i>If the auditor considers it necessary to draw users’ attention to a matter presented or disclosed in the financial statements that, in the auditor’s judgment, is of such importance that it is fundamental to users’ understanding of the financial statements, the auditor shall include an Emphasis of Matter paragraph in the auditor’s report provided: </i></b></p>
                                    <ol type="a">
                                        <li><b><i>)The auditor would not be required to modify the opinion in accordance with PSA 705 (Revised)3 as a result of the matter; and </i></b></li>
                                        <li><b><i>)When PSA 701 applies, the matter has not been determined to be a key audit matter to be communicated in the auditor’s report. </i></b></li>
                                    </ol>
                                </td>
                                <td style="width: 20%;">'.$a12['wpref1'].'</td>
                                <td style="width: 20%;">'.$a12['doneby1'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 60%;">
                                    <p>When the auditor includes an Emphasis of Matter paragraph in the auditor’s report, the auditor shall: </p>
                                    <ol type="a">
                                        <li>Include the paragraph within a separate section of the auditor’s report with an appropriate heading that includes the term “Emphasis of Matter”; </li>
                                        <li>Include in the paragraph a clear reference to the matter being emphasized and to where relevant disclosures that fully describe the matter can be found in the financial statements. The paragraph shall refer only to information presented or disclosed in the financial statements; and </li>
                                        <li>Indicate that the auditor’s opinion is not modified in respect of the matter emphasized. </li>
                                    </ol>
                                </td>
                                <td style="width: 20%;">'.$a12['wpref2'].'</td>
                                <td style="width: 20%;">'.$a12['doneby2'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 60%;">
                                    <p><b><i>If the auditor considers it necessary to communicate a matter other than those that are presented or disclosed in the financial statements that, in the auditor’s judgment, is relevant to users’ understanding of the audit, the auditor’s responsibilities or the auditor’s report, the auditor shall include an Other Matter paragraph in the auditor’s report, provided: </i></b></p>
                                    <ol type="a">
                                        <li><b><i>) This is not prohibited by law or regulation; and </i></b></li>
                                        <li><b><i>) When PSA 701 applies, the matter has not been determined to be a key audit matter to be communicated in the auditor’s report.</i></b></li>
                                    </ol>
                                    <p><b><i>When the auditor includes an Other Matter paragraph in the auditor’s report, the auditor shall include the paragraph within a separate section with the heading “Other Matter,” or other appropriate heading.</i></b></p>
                                </td>
                                <td style="width: 20%;">'.$a12['wpref3'].'</td>
                                <td style="width: 20%;">'.$a12['doneby3'].'</td>
                            </tr>
                            <tr>
                                <td>
                                    <p><b><i>If the auditor expects to include an Emphasis of Matter or an Other Matter paragraph in the auditor’s report, the auditor shall communicate with those charged with governance regarding this expectation and the wording of this paragraph.</i></b></p>
                                </td>
                                <td style="width: 20%;">'.$a12['wpref4'].'</td>
                                <td style="width: 20%;">'.$a12['doneby4'].'</td>
                            </tr>
                        </tbody>
                    </table>
                    <p><b><i>Circumstances in Which an Emphasis of Matter Paragraph May Be Necessary </i></b></p>
                    <ul>
                        <li>When a financial reporting framework prescribed by law or regulation would be unacceptable but for the fact that it is prescribed by law or regulation. </li>
                        <li>To alert users that the financial statements are prepared in accordance with a special purpose framework. </li>
                        <li>When facts become known to the auditor after the date of the auditor’s report and the auditor provides a new or amended auditor’s report (i.e., subsequent events).</li>
                        <li>An uncertainty relating to the future outcome of exceptional litigation or regulatory action.</li>
                        <li>A significant subsequent event that occurs between the date of the financial statements and the date of the auditor’s report.</li>
                        <li>Early application (where permitted) of a new accounting standard that has a material effect on the financial statements. </li>
                        <li>A major catastrophe that has had, or continues to have, a significant effect on the entity’s financial position. </li>
                        <li>A widespread use of Emphasis of Matter paragraphs may diminish the effectiveness of the auditor’s communication about such matters. </li>
                    </ul>
                    <p><b><i>Including an Emphasis of Matter Paragraph in the Auditor’s Report </i></b></p>
                    <p>The inclusion of an Emphasis of Matter paragraph in the auditor’s report does not affect the auditor’s opinion. An Emphasis of Matter paragraph is not a substitute for: </p>
                    <ol type="a">
                        <li>) A modified opinion in accordance with PSA 705 (Revised) when required by the circumstances of a specific audit engagement; </li>
                        <li>) Disclosures in the financial statements that the applicable financial reporting framework requires management to make, or that are otherwise necessary to achieve fair presentation; or </li>
                        <li>) Reporting in accordance with PSA 570 (Revised)7 when a material uncertainty exists relating to events or conditions that may cast significant doubt on an entity’s ability to continue as a going concern. </li>
                    </ol>
                    <p><b><i>Circumstances in Which an Other Matter Paragraph May Be Necessary/ Relevant to Users’ </i></b></p>
                    <p>Other Matter paragraph may be necessary for the users when: </p>
                    <ul>
                        <li>It will aid in the understanding of the Audit </li>
                        <li>It is relevant to Users’ Understanding of the Auditor’s Responsibilities or the Auditor’s Report </li>
                        <li>The auditor is reporting on more than one set of financial statements </li>
                        <li>There is a restriction on distribution or use of the auditor’s report </li>
                    </ul>
                    <p><b><i>Including an Other Matter Paragraph in the Auditor’s Report </i></b></p>
                    <p>The content of an Other Matter paragraph reflects clearly that such other matter is not required to be presented and disclosed in the financial statements.</p>
                    <p>An Other Matter paragraph does not include information that the auditor is prohibited from providing by law, regulation or other professional standards, for example, ethical standards relating to confidentiality of information.</p>
                    <p>An Other Matter paragraph also does not include information that is required to be provided by management. </p>
                    <p><b>Placement of Emphasis of Matter Paragraphs and Other Matter Paragraphs in the Auditor’s Report </b></p>
                    <p>The placement of an Emphasis of Matter paragraph or Other Matter paragraph in the auditor’s report depends on the nature of the information to be communicated, and the auditor’s judgment as to the relative significance of such information to intended users compared to other elements required to be reported in accordance with PSA 700 (Revised). For example: </p>
                    <p><i>Emphasis of Matter Paragraphs </i></p>
                    <ul>
                        <li>When the Emphasis of Matter paragraph relates to the applicable financial reporting framework, including circumstances where the auditor determines that the financial reporting framework prescribed by law or regulation would otherwise be unacceptable,11 the auditor may consider it necessary to place the paragraph immediately following the Basis of Opinion section to provide appropriate context to the auditor’s opinion. </li>
                        <li>When a Key Audit Matters section is presented in the auditor’s report, an Emphasis of Matter paragraph may be presented either directly before or after the Key Audit Matters section, based on the auditor’s judgment as to the relative significance of the information included in the Emphasis of Matter paragraph. The auditor may also add further context to the heading 
                            <br><br>
                            For example, as required by PSA 210, <i>Agreeing the Terms of Audit Engagements</i>, paragraph 19 and PSA 800, <i>Special Considerations—Audits of Financial Statements Prepared in Accordance with Special Purpose Frameworks</i>, paragraph 14
                            <br><br>
                            “Emphasis of Matter”, such as “Emphasis of Matter – Subsequent Event”, to differentiate the Emphasis of Matter paragraph from the individual matters described in the Key Audit Matters section. 
                        </li>
                    </ul>
                    <p><i>Other Matter Paragraphs </i></p>
                    <ul>
                        <li>When a Key Audit Matters section is presented in the auditor’s report and an Other Matter paragraph is also considered necessary, the auditor may add further context to the heading “Other Matter”, such as “Other Matter – Scope of the Audit”, to differentiate the Other Matter paragraph from the individual matters described in the Key Audit Matters section. </li>
                        <li>When an Other Matter paragraph is included to draw users’ attention to a matter relating to Other Reporting Responsibilities addressed in the auditor’s report, the paragraph may be included in the Report on Other Legal and Regulatory Requirements section. </li>
                        <li>When relevant to all the auditor’s responsibilities or users’ understanding of the auditor’s report, the Other Matter paragraph may be included as a separate section following the Report on the Audit of the Financial Statements and the Report on Other Legal and Regulatory Requirements. </li>
                    </ul>
                    <p><b>Communication with Those Charged with Governance </b></p>
                    <p>The communication required by paragraph 12 enables those charged with governance to be made aware of the nature of any specific matters that the auditor intends to highlight in the auditor’s report, and provides them with an opportunity to obtain further clarification from the auditor where necessary. 
                        Where the inclusion of an Other Matter paragraph on a particular matter in the auditor’s report recurs on each successive engagement, the auditor may determine that it is unnecessary to repeat the communication on each engagement, unless otherwise required to do so by law or regulation.
                        </p>
                    <p><b>List of PSAs Containing Requirements for Emphasis of Matter Paragraphs </b></p>
                    <ul>
                        <li>PSA 210, <i>Agreeing the Terms of Audit Engagements</i> – paragraph 19(b) </li>
                        <li>PSA 560, <i>Subsequent Events</i> – paragraphs 12(b) and 16 </li>
                        <li>PSA 800, <i>Special Considerations—Audits of Financial Statements Prepared in Accordance with Special Purpose Frameworks</i> – paragraph 14</li>
                    </ul>
                    <p><b>List of PSAs Containing Requirements for Other Matter Paragraphs </b></p>
                    <ul>
                        <li>PSA 560, Subsequent Events – paragraphs 12(b) and 16 </li>
                        <li>PSA 710, Comparative Information—Corresponding Figures and Comparative Financial Statements – paragraphs 13–14, 16–17 and 19 </li>
                        <li>PSA 720, The Auditor’s Responsibilities Relating to Other Information in Documents Containing Audited Financial Statements – paragraph 10(a)</li>
                    </ul>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;
            case 'AB1':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : Critical review of the financial statements',1,1);
                $html .= $style;
                $ab1 = $rp->getvalues_m('c3','ab1',$c['code'],$c['mtID'],$cID,$wpID);
                $html .= '
                    <table>
                        <tr>
                            <td style="width: 60%;">
                                <table>
                                    <tr><td class="bb">Client: <b>'.$cl['clientname'].'</b></td></tr>
                                    <tr><td></td></tr>
                                    <tr><td class="bb">Period: <b>FY-'.$cl['financial_year'].'</b></td></tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <h3>CRITICAL REVIEW OF THE FINANCIAL STATEMENTS</h3>
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 6%;"></th>
                                <th style="width: 60%;"><b></b></th>
                                <th class="cent bo" style="width: 18%;"><b>Yes / No / N/A</b></th>
                                <th class="cent bo" style="width: 18%;"><b>WP Ref. / Comment</b></th>

                            </tr>
                        </thead>
                        <tbody>
                ';
                    $count = 0;
                    foreach($ab1 as $r){
                        $count ++;
                        $html .= '
                            <tr>
                                <td style="width: 6%;">'.$count.'.<br></td>
                                <td style="width: 60%;">'.$r['field1'].'<br></td>
                                <td class="cent bo" style="width: 18%;">'.$r['field2'].'</td>
                                <td class="cent bo" style="width: 18%;">'.$r['field3'].'</td>
                            </tr>
                        ';
                    }
                $html .= '
                        </tbody>
                    </table>
                    <p>The tests above were undertaken on draft financial statements sent to the client.</p>
                    <table>
                        <tr>
                            <td style="width: 50%;">Signed:___________ </td>
                            <td style="width: 50%;">Date:_____________</td>
                        </tr>
                    </table>
                    <p>The tests above were undertaken on final financial statements sent to the client.  The financial statements are correctly prepared, and other information included within the Annual Report is consistent with the financial statements.</p>
                    <table>
                        <tr>
                            <td style="width: 50%;">Signed:___________ (Manager)</td>
                            <td style="width: 50%;">Date:_____________</td>
                        </tr>
                    </table>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break; ;   
            
            case 'AB2':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : Financial statements disclosure and compliance annual review checklist',1,1);
                $html  .= $style;
                $fl     = $rp->getfileinfo('c3',$wpID,$cID,$c['mtID']);
                $rdata  = $rp->getvalues_s('c3','ab3',$c['code'],$c['mtID'],$cID,$wpID);
                $ab3    = json_decode($rdata['field1'], true);
                $html  .= '
                    <table>
                        <tr>
                            <td style="width: 55%;">
                                <table>
                                    <tr><td class="bb">Client: <b>'.$cl['clientname'].'</b></td></tr>
                                    <tr><td></td></tr>
                                    <tr><td class="bb">Period: <b>FY-'.$cl['financial_year'].'</b></td></tr>
                                </table>
                            </td>
                            <td style="width: 45%;">
                                <table border="1">
                                    <tr>
                                        <td>Prepared by: <br><b>'.$cl['aud'].'</b></td>
                                        <td>Date: <br><b>'; if(!empty($fl['prepared_on'])){$html .= dtformat($fl['prepared_on']);}else{$html .= '';} $html .='</b></td>
                                    </tr>
                                    <tr>
                                        <td>Reviewed by: <br><b>'.$cl['sup'].'</b></td>
                                        <td>Date: <br><b>'; if(!empty($fl['reviewed_on'])){$html .= dtformat($fl['reviewed_on']);}else{$html .= '';} $html .='</b></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
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
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break; 

            case 'AB3':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : Corporate disclosure checklist (IFRS)',1,1);
                $html  .= $style;
                $fl     = $rp->getfileinfo('c3',$wpID,$cID,$c['mtID']);
                $rdata  = $rp->getvalues_s('c3','checklist',$c['code'],$c['mtID'],$cID,$wpID);
                $sec    = json_decode($rdata['field1'], true);
                $sec1   = $rp->getvalues_m('c3','section1',$c['code'],$c['mtID'],$cID,$wpID);
                $sec2   = $rp->getvalues_m('c3','section2',$c['code'],$c['mtID'],$cID,$wpID);
                $sec3   = $rp->getvalues_m('c3','section3',$c['code'],$c['mtID'],$cID,$wpID);
                $sec4   = $rp->getvalues_m('c3','section4',$c['code'],$c['mtID'],$cID,$wpID);
                $sec5   = $rp->getvalues_m('c3','section5',$c['code'],$c['mtID'],$cID,$wpID);
                $sec6   = $rp->getvalues_m('c3','section6',$c['code'],$c['mtID'],$cID,$wpID);
                $sec7   = $rp->getvalues_m('c3','section7',$c['code'],$c['mtID'],$cID,$wpID);
                $html .= '
                    <table>
                        <tr>
                            <td style="width: 55%;">
                                <table>
                                    <tr><td class="bb">Client: <b>'.$cl['clientname'].'</b></td></tr>
                                    <tr><td></td></tr>
                                    <tr><td class="bb">Period: <b>FY-'.$cl['financial_year'].'</b></td></tr>
                                </table>
                            </td>
                            <td style="width: 45%;">
                                <table border="1">
                                    <tr>
                                        <td>Prepared by: <br><b>'.$cl['aud'].'</b></td>
                                        <td>Date: <br><b>'; if(!empty($fl['prepared_on'])){$html .= dtformat($fl['prepared_on']);}else{$html .= '';} $html .='</b></td>
                                    </tr>
                                    <tr>
                                        <td>Reviewed by: <br><b>'.$cl['sup'].'</b></td>
                                        <td>Date: <br><b>'; if(!empty($fl['reviewed_on'])){$html .= dtformat($fl['reviewed_on']);}else{$html .= '';} $html .='</b></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <p><b>CORPORATE DISCLOSURE CHECKLIST (IFRS)</b></p>
                    <p><b><u>Scope</u></b></p>
                    <p>This checklist should be completed for every corporate entity where International Financial Reporting Standards (IFRS) are being followed and it is not appropriate to complete Appendix 3.14 – Financial Statements Disclosure and Compliance Annual Review Checklist.</p>
                    <p>This checklist can be used for any entity that adopts IFRS, and includes a number of “best practice” disclosures which are commonly included within financial statements as a result of local legislative requirements.  If such best practice disclosures are not required, or are prohibited by legislation, it would be necessary to disregard these, and where relevant, to replace these disclosures with those disclosures required by the relevant legislation.</p>
                    <p>The requirements of IFRS only apply to material items.  Immaterial balances can be aggregated into other account headings and immaterial notes and accounting policies can be, and should ideally be, removed [IAS 1 paragraphs 29-31].</p>
                    <p>IFRS 15 <i>Revenue from Contracts with Customers</i> and IFRS 9 <i>Financial Instruments</i> became mandatory for accounting periods commencing on or after 1 January 2018. These resulted in significant additional disclosure requirements compared to the superseded standards dealing with these areas. </p>
                    <p>IFRS 16 Leases is mandatory for accounting periods commencing on or after 1 January 2019. This fundamentally alters the accounting treatment for lessees, with consequential disclosure amendments.</p>
                    <p><b>NB: To ensure that the Checklist is as efficient as possible, areas which are more specialised have been addressed by supplementary disclosure checklists.  <u>These supplementary disclosure checklists should only be completed if the area is relevant.</u></b></p>
                    <p>NB: The checklist does not cover the additional disclosures required by companies which enter into insurance contracts, where these are relevant considerations, then the disclosure requirements of IFRS 4 should be given.  It also does not cover the requirements of IAS 26, which are only relevant to clients who are themselves pension schemes, or IFRIC 2 which is relevant to cooperative entities.  The checklist also does not cover the disclosure requirements of companies with listed equity or debt.</p>
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
                $html = '';
                $pdf->AddPage('P');
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
                                <td style="width: 85%;"><b style="color: blue;">Statement of Comprehensive Income (SCI) and Related Notes</b><br></td>
                            </tr>
                            <tr>
                                <td style="width: 15%;"><b>Section 3</b></td>
                                <td style="width: 85%;"><b style="color: blue;">Statement of Changes in Equity</b><br></td>
                            </tr>
                            <tr>
                                <td style="width: 15%;"><b>Section 4</b></td>
                                <td style="width: 85%;"><b style="color: blue;">Statement of Financial Position and Related Notes</b><br></td>
                            </tr>
                            <tr>
                                <td style="width: 15%;"><b>Section 5</b></td>
                                <td style="width: 85%;"><b style="color: blue;">Statement of Cash Flows</b><br></td>
                            </tr>
                            <tr>
                                <td style="width: 15%;"><b>Section 6</b></td>
                                <td style="width: 85%;"><b style="color: blue;">Accounting Policies and Estimation Techniques</b><br></td>
                            </tr>
                            <tr>
                                <td style="width: 15%;"><b>Section 7</b></td>
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
                $html = '';
                $pdf->AddPage('P');
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
                        <tbody>
                ';
                    foreach($sec1 as $r){
                        $html .= '
                            <tr>
                                <td style="width: 13%;">'.$r['field4'].'</td>
                                <td style="width: 7%;">'.$r['field5'].'</td>
                                <td style="width: 50%;">'.$r['field1'].'</td>
                                <td style="width: 15%;">'.$r['field2'].'</td>
                                <td style="width: 15%;">'.$r['field3'].'</td>
                            </tr>
                        ';
                    }
                $html .= '
                        </tbody>
                    </table>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('P');
                $html .= $style;
                $html .= '
                    <table border="1">
                        <thead>
                            <tr>
                                <th  colspan="5"><b>Section 2 – Statement of Comprehensive Income (SCI) and Related Notes</b></th>
                            </tr>
                            <tr>
                                <th style="width: 70%;" colspan="3"><b>Reference</b></th>
                                <th style="width: 15%;" class="cent"><b>Y/N/NA</b></th>
                                <th style="width: 15%;" class="cent"><b>Comments</b></th>
                            </tr>
                        </thead>
                        <tbody>
                ';
                    foreach($sec2 as $r){
                        $html .= '
                            <tr>
                                <td style="width: 13%;">'.$r['field4'].'</td>
                                <td style="width: 7%;">'.$r['field5'].'</td>
                                <td style="width: 50%;">'.$r['field1'].'</td>
                                <td style="width: 15%;">'.$r['field2'].'</td>
                                <td style="width: 15%;">'.$r['field3'].'</td>
                            </tr>
                        ';
                    }
                $html .= '
                        </tbody>
                    </table>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('P');
                $html .= $style;
                $html .= '
                    <table border="1">
                        <thead>
                            <tr>
                                <th  colspan="5"><b>Section 3 – Statement of Changes in Equity</b><br>
                                    NB1: This must be presented as a primary statement and not as a note to the financial statements.<br>
                                    NB2: Per IAS 21 paragraph 52(a) there should be a column for foreign exchange differences that pass through OCI and accumulate in equity.
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
                    foreach($sec3 as $r){
                        $html .= '
                            <tr>
                                <td style="width: 13%;">'.$r['field4'].'</td>
                                <td style="width: 7%;">'.$r['field5'].'</td>
                                <td style="width: 50%;">'.$r['field1'].'</td>
                                <td style="width: 15%;">'.$r['field2'].'</td>
                                <td style="width: 15%;">'.$r['field3'].'</td>
                            </tr>
                        ';
                    }
                $html .= '
                        </tbody>
                    </table>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('P');
                $html .= $style;
                $html .= '
                    <table border="1">
                        <thead>
                            <tr>
                                <th  colspan="5"><b>Section 4 – Statement of Financial Position and Related Notes</b></th>
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
                                <td style="width: 13%;">'.$r['field4'].'</td>
                                <td style="width: 7%;">'.$r['field5'].'</td>
                                <td style="width: 50%;">'.$r['field1'].'</td>
                                <td style="width: 15%;">'.$r['field2'].'</td>
                                <td style="width: 15%;">'.$r['field3'].'</td>
                            </tr>
                        ';
                    }
                $html .= '
                        </tbody>
                    </table>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('P');
                $html .= $style;
                $html .= '
                    <table border="1">
                        <thead>
                            <tr>
                                <th  colspan="5"><b>Section 5 – Statement of Cash Flows</b></th>
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
                                <td style="width: 13%;">'.$r['field4'].'</td>
                                <td style="width: 7%;">'.$r['field5'].'</td>
                                <td style="width: 50%;">'.$r['field1'].'</td>
                                <td style="width: 15%;">'.$r['field2'].'</td>
                                <td style="width: 15%;">'.$r['field3'].'</td>
                            </tr>
                        ';
                    }
                $html .= '
                        </tbody>
                    </table>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('P');
                $html .= $style;
                $html .= '
                    <table border="1">
                        <thead>
                            <tr>
                                <th  colspan="5"><b>Section 6 – Accounting Policies and Estimation Techniques</b>
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
                    foreach($sec6 as $r){
                        $html .= '
                            <tr>
                                <td style="width: 13%;">'.$r['field4'].'</td>
                                <td style="width: 7%;">'.$r['field5'].'</td>
                                <td style="width: 50%;">'.$r['field1'].'</td>
                                <td style="width: 15%;">'.$r['field2'].'</td>
                                <td style="width: 15%;">'.$r['field3'].'</td>
                            </tr>
                        ';
                    }
                $html .= '
                        </tbody>
                    </table>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('P');
                $html .= $style;
                $html .= '
                    <table border="1">
                        <thead>
                            <tr>
                                <th  colspan="5"><b>Section 7 – Notes and Other Disclosures</b>
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
                                <td style="width: 13%;">'.$r['field4'].'</td>
                                <td style="width: 7%;">'.$r['field5'].'</td>
                                <td style="width: 50%;">'.$r['field1'].'</td>
                                <td style="width: 15%;">'.$r['field2'].'</td>
                                <td style="width: 15%;">'.$r['field3'].'</td>
                            </tr>
                        ';
                    }
                $html .= '
                        </tbody>
                    </table>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                
            break; 

        }
    }


    /**
        ----------------------------------------------------------
        PRE-ENGAGEMENT PDF GENERATOR
        ---------------------------------------------------------- 
    */
    $pdf->AddPage('P');
    $pdf->Bookmark('Pre-Engagement',0,0);
    $html .= '<hr style="color:blue;">';
    $html .= '<h1 style="color:#7752FE;text-align:center;">PRE-ENGAGEMENT</h1>';
    $html .= '<hr style="color:blue;">';
    $pdf->writeHTML($html, true, false,false, false, '');
    $html = '';

    foreach($c1 as $c){
        switch ($c['code']) {
            case 'AC1':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : Client acceptance or continuance form',1,1);
                $html  .= $style;
                $fl     = $rp->getfileinfo('c1',$wpID,$cID,$c['mtID']);
                $ac1    = $rp->getvalues_m('c1','cacf',$c['code'],$c['mtID'],$cID,$wpID);
                $cnt    = 0;
                $rdata  = $rp->getvalues_s('c1','eqr',$c['code'],$c['mtID'],$cID,$wpID);
                $eqr    = json_decode($rdata['field1'], true);
                $html  .= '
                    <table>
                        <tr>
                            <td style="width: 55%;">
                                <table>
                                    <tr><td class="bb">Client: <b>'.$cl['clientname'].'</b></td></tr>
                                    <tr><td></td></tr>
                                    <tr><td class="bb">Period: <b>FY-'.$cl['financial_year'].'</b></td></tr>
                                </table>
                            </td>
                            <td style="width: 45%;">
                                <table border="1">
                                    <tr>
                                        <td>Prepared by: <br><b>'.$cl['aud'].'</b></td>
                                        <td>Date: <br><b>'; if(!empty($fl['prepared_on'])){$html .= dtformat($fl['prepared_on']);}else{$html .= '';} $html .='</b></td>
                                    </tr>
                                    <tr>
                                        <td>Reviewed by: <br><b>'.$cl['sup'].'</b></td>
                                        <td>Date: <br><b>'; if(!empty($fl['reviewed_on'])){$html .= dtformat($fl['reviewed_on']);}else{$html .= '';} $html .='</b></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <h3>Client Acceptance or Continuance Form</h3>
                    <p><b>This form must be completed by the A.E.P. before any work is undertaken on the file.</b></p>
                    <p>While answering these questions the following matters should be fully considered for the audit firm and any network firm: independence, integrity, conflicts of interest with other clients, economic dependence, trusts, matters arising with regulatory authorities, ability to service the client, other services provided to the client and hospitality. Additional guidance is available in legislation and the Code of Ethics issued by the International Ethics Standards Board for Accountants.  </p>
                    <p><b>Any YES answers should be fully explained along with the safeguards, which will enable us to accept / continue with the appointment. </b></p>
                    <p><b>Significant issues must be discussed with the <span style="color: red;">Ethics Partner</span>  and details of the discussion documented on file.</b></p>
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 10%"></th>
                                <th style="width: 50%"></th>
                                <th style="width: 20%" class="cent bo"><b>YES/NO</b></th>
                                <th style="width: 20%" class="cent bo"><b>COMMENTS</b></th>
                            </tr>
                        </thead>
                        <tbody>
                ';
                    foreach($ac1 as $r){
                        $cnt ++;
                        $html .='
                            <tr>
                                <td style="width: 10%">'.$cnt.'</td>
                                <td style="width: 50%;">'.$r['field1'].'</td>
                                <td style="width: 20%" class="cent bo">'.$r['field2'].'</td>
                                <td style="width: 20%" class="cent bo">'.$r['field3'].'</td>
                            </tr>
                        ';
                    }

                $html .= '
                    <p>Name of A.P., not connected with this assignment, to whom staff may bring any grievances related to this engagement:_______________</p>
                    <p><b>ENGAGEMENT QUALITY REVIEW:</b></p>
                    <p>An EQR needs to be undertaken on all audits where:</p>';
                    switch ($eqr['eqr']) {
                        case 'It is necessary for an EQR to be performed and this will be performed by: ':
                            $html .=  '<ul><li>'.$eqr['eqr'].' '.$eqr['eq1'].'</li></ul>';
                        break;
                        case 'Where the EQR is undertaken by an external reviewer the name of the organisation which they work for ':
                            $html .=  '<ul><li>'.$eqr['eqr'].' '.$eqr['eq2'].'</li></ul>';
                        break;
                        default:
                            $html .=  '<ul><li>'.$eqr['eqr'].'</li></ul>';
                        break;
                    }
                $html .= '   
                        </tbody>
                    </table>
                    <p><b>REASON FOR EQR:</b></p>
                    <p>'.$eqr['eqrr'].'</p>
                    <p><b>Authority to accept appointment:</b></p>
                    <p>Having completed the checklist '.$eqr['hcc'].' consider that there are any perceived threats to our independence, integrity and objectivity, and believe that we '.$eqr['iio'].' this appointment.</p>
                    <p>Where necessary, adequate consultation has been undertaken and documented at '.$firm.'.</p>
                    <table>
                        <tbody>
                            <tr>
                                <td style="width: 50%;">Signature: '.$audsign.'</td>
                                <td style="width: 50%;">(A.E.P.)</td>
                            </tr>
                            <tr>
                                <td style="width: 50%;"><p>Date: '.dtformat($fl['prepared_on']).'</p><br></td>
                                <td style="width: 50%;" class="cent"></td>
                            </tr>
                            <tr>
                                <td style="width: 50%;"><p><i>If appropriate:</i></p><br></td>
                                <td style="width: 50%;" class="cent"></td>
                            </tr>
                            <tr>
                                <td style="width: 50%;">Signature: '.$audsign.'</td>
                                <td style="width: 50%;">(EQR) </td>
                            </tr>
                            <tr>
                                <td style="width: 50%;"><p>Date:  '.dtformat($fl['approved_on']).'</p></td>
                                <td style="width: 50%;" class="cent"></td>
                            </tr>
                        </tbody>
                    </table>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;

            case 'AC2':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : Provision of non-audit services',1,1);
                $html .= $style;
                $fl    = $rp->getfileinfo('c1',$wpID,$cID,$c['mtID']);
                $ac2   = $rp->getvalues_m('c1','pans',$c['code'],$c['mtID'],$cID,$wpID);
                $aep   = $rp->getvalues_s('c1','ac2aep',$c['code'],$c['mtID'],$cID,$wpID);
                $html .= '
                    <table>
                        <tr>
                            <td style="width: 55%;">
                                <table>
                                    <tr><td class="bb">Client: <b>'.$cl['clientname'].'</b></td></tr>
                                    <tr><td></td></tr>
                                    <tr><td class="bb">Period: <b>FY-'.$cl['financial_year'].'</b></td></tr>
                                </table>
                            </td>
                            <td style="width: 45%;">
                                <table border="1">
                                    <tr>
                                        <td>Prepared by: <br><b>'.$cl['aud'].'</b></td>
                                        <td>Date: <br><b>'; if(!empty($fl['prepared_on'])){$html .= dtformat($fl['prepared_on']);}else{$html .= '';} $html .='</b></td>
                                    </tr>
                                    <tr>
                                        <td>Reviewed by: <br><b>'.$cl['sup'].'</b></td>
                                        <td>Date: <br><b>'; if(!empty($fl['reviewed_on'])){$html .= dtformat($fl['reviewed_on']);}else{$html .= '';} $html .='</b></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <h3>PROVISION OF NON-AUDIT SERVICES</h3>
                    <p><b>Aim:</b></p>
                    <p>To give adequate consideration of the acceptability of providing non-audit services to entities which are not listed (or affiliates of such an entity).</p>
                    <p><b>The form must be completed prior to the commencement of each type of non-audit work (including the preparation of statutory financial statements) undertaken either by the firm, or by any network firm, and approved by the A.E.P. (or, in the A.E.P.’s absence, another A.E.P. within the firm).  </b></p>
                    <p>For new audit clients, this should extend to non-audit services provided prior to appointment, but relating to a period that the firm will audit. In subsequent years, consideration should be given before any work is undertaken on the audit.</p>  
                    <p>This checklist only provides general guidance and reference should be made to IESBA’s <i> Section 290: Independence ~ Audit and Review Engagements </i> where any doubts exist. In particular, this form does not consider:</p>
                    <ul>
                        <li>Internal Audit Services;</li>
                        <li>IT Services;</li>
                        <li>Recruiting Services; and</li>
                        <li>Corporate Finance Services.</li>
                    </ul>
                    <p>If any of the above is to be undertaken, this should be separately considered, with reference to the IESBA Code of Ethics.</p>
                    <p><b><i>NB: If the client does not have ‘informed management’ the provision of both audit and non-audit services is not permitted.</i></b></p>
                    <p><b>Section 1 – Consideration of Prohibited Services</b></p>
                ';
                $image_file = base_url('img/ac2/ac2-f1.jpg');
                $pdf->Image($image_file, $x = 20, $y = 190, $w = 180, $h = 180, $type = '', $link = '', $align = '', $resize = true, $dpi = 300, $palign = '', $ismask = false, $imgmask = false, $border = 0, $fitbox = true, $hidden = false, $fitonpage = false, $alt = '');
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('L');
                $html .= $style;
                $html .= '
                    <p><b>Section 2 – Consideration of the Type of Non-Audit Services Provided and Safeguards in Place </b></p>
                    <p><i>N.B. Complete multiple sheets if more than four different types of non-audit service are provided<br>N.B. Audit related non-audit services (for example, a separate report to a regulator, (e.g. that on client money handled by a solicitor)) should still be treated as a non-audit service, but it is not necessary for safeguards to be put in place, as threats to independence are insignificant</i></p>
                    <table border="1">
                    <thead>
                        <tr>
                            <th style="width: 45%;"><b>Non-audit service to be provided:</b></th>
                            <th style="width: 10%;" class="cent"><b>Corporation tax</b></th>
                            <th style="width: 10%;" class="cent"><b>Statutory Services</b></th>
                            <th style="width: 10%;" class="cent"><b>Accountancy(including preparation of financial statements)</b></th>
                            <th style="width: 10%;" class="cent"><b>Other (specify)</b></th>
                            <th style="width: 10%;" class="cent"><b>Total CU</b></th>
                        </tr>
                    </thead>
                    <tbody>
                ';
                foreach ($ac2 as $r){
                    $html .= '
                        <tr>
                            <td style="width: 45%;">'.$r['field1'].'</td>
                            <td style="width: 10%;" class="cent">'.$r['field2'].'</td>
                            <td style="width: 10%;" class="cent">'.$r['field3'].'</td>
                            <td style="width: 10%;" class="cent">'.$r['field4'].' </td>
                            <td style="width: 10%;" class="cent">'.$r['field5'].'</td>
                            <td style="width: 10%;" class="cent">'.$r['field6'].'</td>
                        </tr>
                    ';
                }
                $html .= '    
                    </tbody>
                </table>';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('P');
                $html .= $style;
                $html .= '<p><b>Section 2 – Consideration of the Type of Non-Audit Services Provided and Safeguards in Place </b></p>';
                $image_file = base_url('img/ac2/ac2-f2.jpg');
                $pdf->Image($image_file, $x = 20, $y = 30, $w = 180, $h = 180, $type = '', $link = '', $align = '', $resize = true, $dpi = 300, $palign = '', $ismask = false, $imgmask = false, $border = 0, $fitbox = true, $hidden = false, $fitonpage = false, $alt = '');
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->SetXY(50, 205); // Set the position to (50, 160) pixels
                $html .= $style;
                $html .= '
                    <p><i>* “Substantial” should be considered both in terms of the audit firm and the audit client.1 A self interest threat arises where substantial non-audit fees are ‘regularly’ generated. If it considered that the substantial fee is not ‘regular’ the reason for this should be documented at *** below.</i></p>
                    <table border="1">
                        <tr>
                            <td><p><b>***(Where appropriate): Documentation by the A.E.P. of how the self interest threat has been reduced to an acceptable level / details of communication with the Ethics Partner / Details of which services (audit or non-audit) will not be provided:</b> </p>
                                '.$aep['field1'].'
                            </td>
                        </tr>
                    </table>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('P');
                $html .= $style;
                $html .= '
                    <h3>Conclusion</h3>
                    <p>'.$aep['field2'].'</p>
                    <table>
                        <tbody>
                            <tr>
                                <td style="width: 50%;">Signature:<b> '.$cl['aud'].'</b>'.$audsign.'</td>
                                <td style="width: 50%;">(A.E.P.)</td>
                            </tr>
                            <tr>
                                <td style="width: 50%;"><p>Date: '.dtformat($fl['prepared_on']).'</p></td>
                                <td style="width: 50%;" class="cent"></td>
                            </tr>
                        </tbody>
                    </table>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;
        }
    }

    /**
        ----------------------------------------------------------
        AUDIT PLANNING PDF GENERATOR
        ---------------------------------------------------------- 
    */
    $pdf->AddPage('P');
    $pdf->Bookmark('Audit Planning',0,0);
    $html .= '<hr style="color:blue;">';
    $html .= '<h1 style="color:#7752FE;text-align:center;">AUDIT PLANNING</h1>';
    $html .= '<hr style="color:blue;">';
    $pdf->writeHTML($html, true, false,false, false, '');
    $html = '';
    foreach($c2 as $c){
        switch ($c['code']) {
            case 'AB4':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : Permanent file checklist',1,1);
                $html       .= $style;
                $fl          = $rp->getfileinfo('c2',$wpID,$cID,$c['mtID']);
                $ac3genmat   = $rp->getvalues_m('c2','genmat',$c['code'],$c['mtID'],$cID,$wpID);
                $ac3doccors  = $rp->getvalues_m('c2','doccors',$c['code'],$c['mtID'],$cID,$wpID);
                $statutory   = $rp->getvalues_m('c2','statutory',$c['code'],$c['mtID'],$cID,$wpID);
                $ac3accsys   = $rp->getvalues_m('c2','accsys',$c['code'],$c['mtID'],$cID,$wpID);
                $cnt         = 0;
                $html       .= '
                    <table>
                        <tr>
                            <td style="width: 55%;">
                                <table>
                                    <tr><td class="bb">Client: <b>'.$cl['clientname'].'</b></td></tr>
                                    <tr><td></td></tr>
                                    <tr><td class="bb">Period: <b>FY-'.$cl['financial_year'].'</b></td></tr>
                                </table>
                            </td>
                            <td style="width: 45%;">
                                <table border="1">
                                    <tr>
                                        <td>Prepared by: <br><b>'.$cl['aud'].'</b></td>
                                        <td>Date: <br><b>'; if(!empty($fl['prepared_on'])){$html .= dtformat($fl['prepared_on']);}else{$html .= '';} $html .='</b></td>
                                    </tr>
                                    <tr>
                                        <td>Reviewed by: <br><b>'.$cl['sup'].'</b></td>
                                        <td>Date: <br><b>'; if(!empty($fl['reviewed_on'])){$html .= dtformat($fl['reviewed_on']);}else{$html .= '';} $html .='</b></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <h3>PERMANENT FILE CHECKLIST</h3>
                    <p>Objective: This form is to be used to ensure the permanent file contains sufficient background information about the client.</p>
                    <p>This is a mandatory form.  Any “no” answers indicate a deficiency on the permanent file and a comment should be made as to how this will be addressed.</p>
                    <p>Per PSA 315, para A128c, “Disclosures in the financial statements of smaller entities may be less detailed or less complex (e.g., some financial reporting frameworks allow smaller entities to provide fewer disclosures in the financial statements). However, this does not relieve the auditor of the responsibility to obtain an understanding of the entity and its environment, including internal control, as it relates to disclosures.”</p>
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 5%"></th>
                                <th style="width: 60%"><b>General Matters</b></th>
                                <th style="width: 17%" class="cent bo"><b>YES/NO</b></th>
                                <th style="width: 17%" class="cent bo"><b>COMMENTS</b></th>
                            </tr>
                        </thead>
                        <tbody>
                ';
                    foreach($ac3genmat as $r){
                        $cnt ++;
                        $html .='
                            <tr>
                                <td style="width: 5%">'.$cnt.'</td>
                                <td style="width: 60%;">'.$r['field1'].'</td>
                                <td style="width: 17%" class="cent bo">'.$r['field2'].'</td>
                                <td style="width: 17%" class="cent bo">'.$r['field3'].'</td>
                            </tr>
                        ';
                    }
                $html .= '   
                        </tbody>
                    </table>
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 5%"></th>
                                <th style="width: 60%"><b>Documents and Correspondence of a Permanent Nature</b></th>
                                <th style="width: 17%" class="cent bo"><b>YES/NO</b></th>
                                <th style="width: 17%" class="cent bo"><b>COMMENTS</b></th>
                            </tr>
                        </thead>
                        <tbody>
                ';
                    foreach($ac3doccors as $r){
                        $cnt ++;
                        $html .='
                            <tr>
                                <td style="width: 5%">'.$cnt.'</td>
                                <td style="width: 60%;">'.$r['field1'].'</td>
                                <td style="width: 17%" class="cent bo">'.$r['field2'].'</td>
                                <td style="width: 17%" class="cent bo">'.$r['field3'].'</td>
                            </tr>
                        ';
                    }
                $html .= '   
                        </tbody>
                    </table>
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 5%"></th>
                                <th style="width: 60%"><b>Statutory Matters</b></th>
                                <th style="width: 17%" class="cent bo"><b>YES/NO</b></th>
                                <th style="width: 17%" class="cent bo"><b>COMMENTS</b></th>
                            </tr>
                        </thead>
                        <tbody>
                ';
                    foreach($statutory as $r){
                        $cnt ++;
                        $html .='
                            <tr>
                                <td style="width: 5%">'.$cnt.'</td>
                                <td style="width: 60%;">'.$r['field1'].'</td>
                                <td style="width: 17%" class="cent bo">'.$r['field2'].'</td>
                                <td style="width: 17%" class="cent bo">'.$r['field3'].'</td>
                            </tr>
                        ';
                    }
                $html .= '   
                        </tbody>
                    </table>
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 5%"></th>
                                <th style="width: 60%"><b>The Accounting System</b></th>
                                <th style="width: 17%" class="cent bo"><b>YES/NO</b></th>
                                <th style="width: 17%" class="cent bo"><b>COMMENTS</b></th>
                            </tr>
                        </thead>
                        <tbody>
                ';
                    foreach($ac3accsys as $r){
                        $cnt ++;
                        $html .='
                            <tr>
                                <td style="width: 5%">'.$cnt.'</td>
                                <td style="width: 60%;">'.$r['field1'].'</td>
                                <td style="width: 17%" class="cent bo">'.$r['field2'].'</td>
                                <td style="width: 17%" class="cent bo">'.$r['field3'].'</td>
                            </tr>
                        ';
                    }
                $html .= '   
                    </tbody>
                    </table>
                    <p><b>I have reviewed / updated the permanent file and consider that it is adequate.</b></p>
                    <table>
                        <tbody>
                            <tr>
                                <td style="width: 50%;"><p>Signed:</p> <b>'.$cl['aud'].'</b> '.$supsign.'</td>
                                <td style="width: 50%;"><p>Date: '; if(!empty($fl['reviewed_on'])){$html .= dtformat($fl['reviewed_on']);}else{$html .= '';} $html .='</p></td>
                            </tr>
                        </tbody>
                    </table>
                    <p><b>I have reviewed the permanent file and consider that it is adequate.</b></p>
                    <table>
                        <tbody>
                            <tr>
                                <td style="width: 50%;"><p>Signed:</p> <b>'.$cl['aud'].'</b> '.$supsign.'</td>
                                <td style="width: 50%;"><p>Date: '; if(!empty($fl['reviewed_on'])){$html .= dtformat($fl['reviewed_on']);}else{$html .= '';} $html .='</p></td>
                            </tr>
                        </tbody>
                    </table>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;

            case 'AB4A':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : PRELIMINARY ANALYTICAL PROCEDURES',1,1);
                $html  .= $style;
                $rd     = $rp->getvalues_m('c2','rd',$c['code'],$c['mtID'],$cID,$wpID);
                $html .= '<h3>PRELIMINARY ANALYTICAL PROCEDURES</h3>';

                $html .= '
                <table >
                    <thead>
                        <tr>
                            <th colspan="2">Section A - Permanent</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>General matters</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Documents and correspondence of a permanent nature</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Statutory matters</td>
                        </tr>
                    </tbody>
                </table>
                <table >
                    <thead>
                        <tr>
                            <th colspan="2">Section B - Systems</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>The accounting system - overall description</td>
                        </tr>
                        <tr>
                            <td>2-5</td>
                            <td>Individual accounting systems - detail</td>
                        </tr>
                    </tbody>
                </table>
                <h3 style="text-align: center;">REVIEW DETAILS</h3>
                ';

                $html .= '
                    <table border="1">
                        <thead>
                            <tr>
                                <th>Year to</th>
                                <th>Prepared by</th>
                                <th>Date</th>
                                <th>Reviewed by</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                ';
                        foreach($rd as $r){
                            $html .= '
                                <tr>
                                    <td>'.$r['field1'].'</td>
                                    <td>'.$r['field2'].'</td>
                                    <td>'.$r['field3'].'</td>
                                    <td>'.$r['field4'].'</td>
                                    <td>'.$r['field5'].'</td>
                                </tr>
                            ';
                        }
                $html .= '</tbody>
                    </table>
                ';

                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;

            case 'AC3':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : Preliminary planning procedures - Client involvement in the planning process',1,1);
                $html  .= $style;
                $fl     = $rp->getfileinfo('c2',$wpID,$cID,$c['mtID']);
                $rdata  = $rp->getvalues_s('c2','ppr',$c['code'],$c['mtID'],$cID,$wpID);
                $ppr    = json_decode($rdata['field1'], true);
                $ac4    = $rp->getvalues_m('c2','ac4sod',$c['code'],$c['mtID'],$cID,$wpID);
                $html  .= '
                    <table>
                        <tr>
                            <td style="width: 55%;">
                                <table>
                                    <tr><td class="bb">Client: <b>'.$cl['clientname'].'</b></td></tr>
                                    <tr><td></td></tr>
                                    <tr><td class="bb">Period: <b>FY-'.$cl['financial_year'].'</b></td></tr>
                                </table>
                            </td>
                            <td style="width: 45%;">
                                <table border="1">
                                    <tr>
                                        <td>Prepared by: <br><b>'.$cl['aud'].'</b></td>
                                        <td>Date: <br><b>'; if(!empty($fl['prepared_on'])){$html .= dtformat($fl['prepared_on']);}else{$html .= '';} $html .='</b></td>
                                    </tr>
                                    <tr>
                                        <td>Reviewed by: <br><b>'.$cl['sup'].'</b></td>
                                        <td>Date: <br><b>'; if(!empty($fl['reviewed_on'])){$html .= dtformat($fl['reviewed_on']);}else{$html .= '';} $html .='</b></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <h3>PRELIMINARY PLANNING PROCEDURES – CLIENT INVOLVEMENT IN THE PLANNING PROCESS</h3>
                    <p><b>NB: The key issues noted from this document must be recorded in the relevant areas of the audit file or the PAF and should feed through into the risk assessment, audit approach and fieldwork.</b></p>
                    <table border="1"\>
                        <tr>
                            <td><p><b>Which members of the client staff and the audit team have been involved in the preplanning process and what are their roles?</b></p>
                            '.$ppr['ppr1'].'
                            </td>
                        </tr>
                        <tr>
                            <td><p><b>How was the communication undertaken and on what date?</b></p>
                            '.$ppr['ppr2'].'
                            </td>
                        </tr>
                    </table>
                    <p><i>In respect of a new audit assignment, where the discussion points below request “changes” to be noted, full information should be documented, as the working papers will not document “existing” issues affecting the client.</i></p>
                    <p class="bo"><b>Scope of discussion (add additional points as appropriate) ~ note that all points should be discussed, and key issues highlighted:</b></p>
                    <table border="1">
                        <tbody>
                ';
                    foreach($ac4 as $r){
                        $html .= '
                            <tr>
                                <td>'.$r['field1'].'<br></td>
                                <td>'.$r['field2'].'</td>
                            </tr>
                        ';
                    }
                $html .= '</tbody>
                    </table>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;

            case 'AC4':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : Preliminary analytical procedures',1,1);
                $html .= $style;
                $fl    = $rp->getfileinfo('c2',$wpID,$cID,$c['mtID']);
                $rdata = $rp->getvalues_s('c2','rescon',$c['code'],$c['mtID'],$cID,$wpID);
                $rc    = json_decode($rdata['field1'], true);
                $html .= '
                    <table>
                        <tr>
                            <td style="width: 55%;">
                                <table>
                                    <tr><td class="bb">Client: <b>'.$cl['clientname'].'</b></td></tr>
                                    <tr><td></td></tr>
                                    <tr><td class="bb">Period: <b>FY-'.$cl['financial_year'].'</b></td></tr>
                                </table>
                            </td>
                            <td style="width: 45%;">
                                <table border="1">
                                    <tr>
                                        <td>Prepared by: <br><b>'.$cl['aud'].'</b></td>
                                        <td>Date: <br><b>'; if(!empty($fl['prepared_on'])){$html .= dtformat($fl['prepared_on']);}else{$html .= '';} $html .='</b></td>
                                    </tr>
                                    <tr>
                                        <td>Reviewed by: <br><b>'.$cl['sup'].'</b></td>
                                        <td>Date: <br><b>'; if(!empty($fl['reviewed_on'])){$html .= dtformat($fl['reviewed_on']);}else{$html .= '';} $html .='</b></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                ';
                $space = $pdf->Ln(10);
                $html .= '<h3>PRELIMINARY ANALYTICAL PROCEDURES</h3>';
                $html .= '
                    <table border="1">
                        <tbody>
                            <tr>
                                <td><b><p><u>Summary of results and preliminary analytical procedures</u></p>
                                    <p>Objectives:</p><ul>
                                        <li>To highlight the impact on this period’s audit, including consideration of any unexpected ratios or variances which could be indicative of fraud.</li>
                                        <li>To ensure that risks identified are transferred to the risk assessment and into the audit approach / work programmes as required and are cross referenced to indicate this.</li>
                                        <li>Where a parent company produces consolidated financial statements, consideration must be given to the parent company figures and the consolidated figures.</li>
                                    </ul></b>
                                    <br><br><br><br>
                                    <p><b>Result:</b></p>
                                    <p>'.$rc['res'].'</p>
                                    <br><br><br><br>
                                    <p><b>Conclusion:</b></p>
                                    <p>'.$rc['con'].'</p>
                                    <br><br><br><br>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;

            case 'AC5':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : Team Discussions and Briefing',1,1);
                $html .= $style;
                $fl    = $rp->getfileinfo('c2',$wpID,$cID,$c['mtID']);
                $rdata = $rp->getvalues_s('c2','td',$c['code'],$c['mtID'],$cID,$wpID);
                $td    = json_decode($rdata['field1'], true);

                $html .= '
                <table>
                    <tr>
                        <td style="width: 55%;">
                            <table>
                                <tr><td class="bb">Client: <b>'.$cl['clientname'].'</b></td></tr>
                                <tr><td></td></tr>
                                <tr><td class="bb">Period: <b>FY-'.$cl['financial_year'].'</b></td></tr>
                            </table>
                        </td>
                    </tr>
                </table>
                ';
                $space = $pdf->Ln(10);
                
                $html .= '
                
                    <style>
                        .sdf{
                
                            vertical-align: -webkit-baseline-middle;
                
                        }
                    </style>
                
                    <h3>TEAM DISCUSSIONS AND BRIEFING MEETING</h3>
                    <p><b>Objective:</b></p>
                    <p>To document a team discussion covering fraud and risk as required by PSA 240, 315 and 550 and to demonstrate that an adequate staff briefing has occurred.</p>
                    <p><b>Date of Meeting: '. dtformat($td['dom']).'</b></p>
                    <p><b>Details of the assignment team:</b></p>
                    <table border="1">
                        <thead>
                            <tr style="text-align:center;">
                                <th style="width: 20%;"><br><br><b>Grade:</b></th>
                                <th style="width: 40%;"><br><br><b>Name:</b></th>
                                <th style="width: 20%;"><b>Initial to Confirm Attendance:</b></th>
                                <th style="width: 20%;"><b>Initial to Confirm Understanding of Planning:</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="width: 20%;"><br><br>A.E.P.<br></td>
                                <td style="width: 40%;">'.$td['aepname'].'</td>
                                <td style="width: 20%;">'.$td['aepca'].'</td>
                                <td style="width: 20%;">'.$td['aepcup'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 20%;"><br><br>Internal EQR<br></td>
                                <td style="width: 40%;">'.$td['eqrname'].'</td>
                                <td style="width: 20%;">'.$td['eqrca'].'</td>
                                <td style="width: 20%;">'.$td['eqrcup'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 20%;"><br><br>Manager<br></td>
                                <td style="width: 40%;">'.$td['manname'].'</td>
                                <td style="width: 20%;">'.$td['manca'].'</td>
                                <td style="width: 20%;">'.$td['mancup'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 20%;"><br><br>Supervisor<br></td>
                                <td style="width: 40%;">'.$td['supname'].'</td>
                                <td style="width: 20%;">'.$td['supca'].'</td>
                                <td style="width: 20%;">'.$td['supcup'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 20%;"><br><br>Senior<br></td>
                                <td style="width: 40%;">'.$td['senname'].'</td>
                                <td style="width: 20%;">'.$td['senca'].'</td>
                                <td style="width: 20%;">'.$td['sencup'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 20%;"><br><br>Junior<br></td>
                                <td style="width: 40%;">'.$td['j1name'].'</td>
                                <td style="width: 20%;">'.$td['j1ca'].'</td>
                                <td style="width: 20%;">'.$td['j1cup'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 20%;"><br><br>Junior<br></td>
                                <td style="width: 40%;">'.$td['j2name'].'</td>
                                <td style="width: 20%;">'.$td['j2ca'].'</td>
                                <td style="width: 20%;">'.$td['j2cup'].'</td>
                            </tr>
                        </tbody>
                    </table>
                    <p><i>* Prior to initialling this column all staff should review the assignment plan, assessment of materiality & risk and systems notes.</i></p>
                    <p><i>The team discussions on fraud, risk and related party transactions should be chaired by the A.E.P. (although the general briefing can be performed by another team member, i.e., the manager) and it should be undertaken ensuring that, when considering fraud, professional skepticism is applied. <b><u>Team members should set aside the belief that the client is honest and acts with integrity.</u></b></i></p>
                    <p><i>Where junior staff are briefed separately, this should be clearly documented.</i></p>';
                
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('L'); 
                $html = $style;
                
                $html .='
                    <table border="1">
                        <thead>
                            <tr>
                                <th colspan="2"><b>Detailed consideration of fraud, risk and related party transactions</b></th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="2">Scope of discussion (add additional points as appropriate) ~ note that all points should be discussed, and key issues highlighted below:</td>
                                
                            </tr>
                            <tr>
                                <td><br><br>1.	The areas within the accounting system where error or fraud are most likely to occur (consideration must specifically be given to earnings management);<br></td>
                                <td>'.$td['dsfr1'].'</td>
                            </tr>
                            <tr>
                                <td><br><br>2.	How a fraud could be carried out by either management or employees (special consideration should be given to accounting estimates);<br></td>
                                <td>'.$td['dsfr2'].'</td>
                            </tr>
                            <tr>
                                <td><br><br>3.	How a fraud could be carried out by, or in conjunction with the entity’s related parties (including where transactions are not undertaken on an arm’s length basis);<br></td>
                                <td>'.$td['dsfr3'].'</td>
                            </tr>
                            <tr>
                                <td><br><br>4.	How a fraud could be carried out by customers or suppliers;<br></td>
                                <td>'.$td['dsfr4'].'</td>
                            </tr>
                            <tr>
                                <td><br><br>5.	What risk factors may be seen during the audit which could indicate fraudulent activity, including:
                                    <ul>
                                        <li>Pressure on management performance (e.g. targets set by holding companies, incentive schemes or banking covenants);</li>
                                        <li>Change in lifestyle or behavior of management or employees;</li>
                                        <li>Related party transactions which appear to have minimal commercial substance;</li>
                                        <li>Suppliers / customers with PO box addresses etc.;</li>
                                        <li>Allegations of fraud within the entity; or</li>
                                        <li>Management overriding key controls.</li>
                                    </ul>
                                    <br>
                                </td>
                                <td>'.$td['dsfr5'].'</td>
                            </tr>
                            <tr>
                                <td><br><br>6.	What controls are in place in relation to cash (or assets that can be easily converted to cash) and the employees involved in this area;<br></td>
                                <td>'.$td['dsfr6'].'</td>
                            </tr>
                            <tr>
                                <td><br><br>7.	Where consolidated financial statements are prepared the risk of fraud in subsidiaries, associates, joint ventures and during the consolidation process;<br></td>
                                <td>'.$td['dsfr7'].'</td>
                            </tr>
                            <tr>
                                <td><br><br>8.	How any changes in senior management or shareholders during, or since the end of the period could cause a potential risk factor which needs to be approached with “professional skepticism”.<br></td>
                                <td>'.$td['dsfr8'].'</td>
                            </tr>
                            <tr>
                                <td><br><br>9.	Which audit procedures will be used to respond to the susceptibility of the entity’s financial statements to material misstatement due to fraud? This may involve changing the nature, timing and extent of the audit procedures to be carried out.
                                    <ul>For example:
                                        <li>Performing substantive procedures on selected account balances and assertions not otherwise tested due to their materiality or risk;</li>
                                        <li>Adjusting the timing of audit procedures from that otherwise expected;</li>
                                        <li>Using different sampling methods;</li>
                                        <li>Altering the audit approach compared to the prior year;</li>
                                        <li>Use of data analytics to test for anomalies in a dataset;</li>
                                        <li>Performing audit procedures at different locations or at locations on an unannounced basis.</li>
                                    </ul>
                                    <br>
                                </td>
                                <td>'.$td['dsfr9'].'</td>
                            </tr>
                        </tbody>
                    </table>
                    <br><br>
                    <table border="1">
                        <thead>
                            <tr>
                                <th colspan="2" ><b>Specific areas to be covered by the briefing:</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="width: 80%;">Scope of discussion (add additional points as appropriate) ~ note that all points should be discussed, and key issues highlighted below:</td>
                                <td style="width: 20%;" rowspan="2"><b>Covered in discussion? (Yes/No)</b></td>
                            </tr>
                            <tr>
                                <td>1.	All staff are aware of: </td>
                            </tr>
                            <tr>
                                <td>• The need to report suspicions of money laundering internally, where required by legislation;</td>
                                <td style="text-align: center;">'.$td['sacb1yn1'].'</td>
                            </tr>
                            <tr>
                                <td>• That any issues (actual or possible), including matters relating to independence which, had they been known earlier, would have caused the firm to decline the appointment should be notified to the A.E.P. immediately;</td>
                                <td style="text-align: center;">'.$td['sacb1yn2'].'</td>
                            </tr>
                            <tr>
                                <td>• The main indicators for this client that the going concern assumption could be in doubt and if such issues are identified, these should be highlighted to the A.E.P. promptly;</td>
                                <td style="text-align: center;">'.$td['sacb1yn3'].'</td>
                            </tr>
                            <tr>
                                <td>• That if new related parties are identified, these must be communicated immediately to all members of the audit team;</td>
                                <td style="text-align: center;">'.$td['sacb1yn4'].'</td>
                            </tr>
                            <tr>
                                <td>2.	The responsibilities of team members;</td>
                                <td style="text-align: center;">'.$td['sacb2yn'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 50%;"><br><br>3.	A detailed briefing regarding the client (including objectives, structure and activities);<br></td>
                                <td style="width: 50%;">'.$td['sacb3'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 50%;"><br><br>4.	The risk areas as identified from the risk assessment and how additional work on these areas are incorporated into the audit approach;<br></td>
                                <td style="width: 50%;">'.$td['sacb4'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 50%;"><br><br>5.	How can unpredictability be incorporated into the audit approach to maximize the chance of fraudulent transactions being identified (e.g., which procedure will involve random / haphazard testing etc.);<br></td>
                                <td style="width: 50%;">'.$td['sacb5'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 50%;"><br><br>6.	Timing of review procedures have been discussed and it has been documented who has responsibility to review which areas.<br></td>
                                <td style="width: 50%;">'.$td['sacb6'].'</td>
                            </tr>
                        </tbody>
                    </table>
                ';

                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;

            case 'AC6':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : Assessment of materiality',1,1);
                $html .= $style;
                $html .= '
                    <table>
                        <tr>
                            <td style="width: 60%;">
                                <table>
                                    <tr><td></td></tr>
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
                                        <td>A.E.P. Approval: <br></td>
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
                $space = $pdf->Ln(10);
                $html .= '
                    <h3>ASSESSMENT OF MATERIALITY (INCLUDING PERFORMANCE MATERIALITY)</h3>
                    <p><b>OBJECTIVE: </b> To assess materiality for the financial statements as a whole, performance materiality and other quantitative benchmarks based on materiality, which will reduce the risk of material misstatements in the financial statements to an acceptable level.</p> 
                    <p><b>OVERALL MATERIALITY</b></p>
                ';
                $rdata      = $rp->getvalues_s('c2','revp',$c['code'],$c['mtID'],$cID,$wpID);
                $ac6        = json_decode($rdata['field1'], true);

                $html .= '
                    <table>
                        <thead>
                            <tr>
                                <th class="cent" style="width: 25%;"><b>Benchmarks</b></th>
                                <th class="cent"><b>Planning CU</b></th>
                                <th class="cent"><b>Finalisation CU</b></th>
                                <th class="cent" style="width: 8%;"><b>%</b></th>
                                <th class="bo cent"><b>Planning CU</b></th>
                                <th class="bo cent"><b>Finalisation CU</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="5"></td>
                            </tr>
                            <tr>
                                <td style="width: 25%;">Revenue</td>
                                <td class="bo cent">'.$ac6['revp'].'</td>
                                <td class="bo cent">'.$ac6['revf'].'</td>
                                <td class="cent" style="width: 8%;">1%</td>
                                <td class="bo cent">'.$ac6['revpr'].'</td>
                                <td class="bo cent">'.$ac6['revfr'].'</td>
                            </tr>
                            <tr>
                                <td colspan="5"></td>
                            </tr>
                            <tr>
                                <td style="width: 25%;">Profit Before Tax 2</td>
                                <td class="bo cent">'.$ac6['prop'].'</td>
                                <td class="bo cent">'.$ac6['prof'].'</td>
                                <td class="cent" style="width: 8%;">10%</td>
                                <td class="bo cent">'.$ac6['propr'].'</td>
                                <td class="bo cent">'.$ac6['profr'].'</td>
                            </tr>
                            <tr>
                                <td colspan="5"></td>
                            </tr>
                            <tr>
                                <td style="width: 25%;">Gross Assets</td>
                                <td class="bo cent">'.$ac6['grop'].'</td>
                                <td class="bo cent">'.$ac6['grof'].'</td>
                                <td class="cent" style="width: 8%;">2%</td>
                                <td class="bo cent">'.$ac6['gropr'].'</td>
                                <td class="bo cent">'.$ac6['grofr'].'</td>
                            </tr>
                        </tbody>
                    </table>
                    <br><br>
                    <table>
                        <tbody>
                            <tr>
                                <td style="width: 58.5%;"><p><b>Select the most appropriate benchmark for this entity</b></p></td>
                                <td style="width: 8%;"></td>
                                <td class="bo cent" style="width: 16.75%;">'.$ac6['pcu'].'</td>
                                <td class="bo cent" style="width: 16.75%;">'.$ac6['fcu'].'</td>
                            </tr>
                        </tbody>
                    </table>
                    <br><br>
                    <table>
                        <tbody>
                            <tr>
                                <td><p><b>JUSTIFY THE USE OF THE BENCHMARK SELECTED ABOVE (Notes 4 and 5) </b></p></td>
                            </tr>
                            <tr>
                                <td class="bo"><br><br> '.$ac6['justn45'].' <br><br></td>
                            </tr>
                        </tbody>
                    </table>
                    <br><br>
                    <table>
                        <tbody>
                            <tr>
                                <td style="width: 58.5%;"><p><b>Initial suggested Materiality Level:</b></p></td>
                                <td style="width: 8%;"></td>
                                <td class="cent" style="width: 16.75%;">'.$ac6['pcur'].'</td>
                                <td class="cent" style="width: 16.75%;">'.$ac6['fcur'].'</td>
                            </tr>
                        </tbody>
                    </table>
                    <table>
                        <tbody>
                            <tr>
                                <td colspan="3"><p>If any adjustments are required to initial materiality level, detail these here (Note 6) :</p></td>
                            </tr>
                            <tr>
                                <td style="width: 58.5%;">a) '.$ac6['adja'].'</td>
                                <td style="width: 8%;"></td>
                                <td class="bo cent" style="width: 16.75%;">'.$ac6['adjap'].'</td>
                                <td class="bo cent" style="width: 16.75%;">'.$ac6['adjaf'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 58.5%;">b) '.$ac6['adjb'].'</td>
                                <td style="width: 8%;"></td>
                                <td class="bo cent" style="width: 16.75%;">'.$ac6['adjbp'].'</td>
                                <td class="bo cent" style="width: 16.75%;">'.$ac6['adjbf'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 58.5%;">c) '.$ac6['adjc'].'</td>
                                <td style="width: 8%;"></td>
                                <td class="bo cent" style="width: 16.75%;">'.$ac6['adjcp'].'</td>
                                <td class="bo cent" style="width: 16.75%;">'.$ac6['adjcf'].'</td>
                            </tr>
                            <tr>
                                <td colspan="3"><p><i>NB: adjustments need to be mutiplied by the appropriate benchmark percentage</i></p></td>
                            </tr>
                        </tbody>
                    </table>
                    <br><br>
                    <table>
                        <tbody>
                            <tr>
                                <td style="width: 58.5%;"><p><b>Assessed Overall Materiality</b></p></td>
                                <td style="width: 8%;"></td>
                                <td class="bo cent" style="width: 16.75%;">'.$ac6['aomp'].'</td>
                                <td class="bo cent" style="width: 16.75%;">'.$ac6['aomf'].'</td>
                            </tr>
                        </tbody>
                    </table>
                    <br><br>
                    <table>
                        <tbody>
                            <tr>
                                <td style="width: 58.5%;"><p>Materiality Level for previous period (for information only):</p></td>
                                <td style="width: 8%;"></td>
                                <td class="bo cent" style="width: 33.5%;">'.$ac6['mlpinfo'].'</td>
                            </tr>
                        </tbody>
                    </table>
                    <table>
                        <tbody>
                            <tr>
                                <td><p><b>Conclusion at planning stage</b> <br>The overall materiality level calculated above is deemed to be appropriate because:</p></td>
                            </tr>
                            <tr>
                                <td class="bo"><br><br> '.$ac6['conplst'].' <br><br></td>
                            </tr>
                        </tbody>
                    </table>
                    <table>
                        <tbody>
                            <tr>
                                <td><p><b>Conclusion at finalisation stage</b><br>Document reasons for any revision to the materiality assessed at planning stage and the impact on the audit procedures undertaken:</p></td>
                            </tr>
                            <tr>
                                <td class="bo"><br><br> '.$ac6['confnst'].'</td>
                            </tr>
                        </tbody>
                    </table>
                    <p><b>PERFORMANCE MATERIALITY</b></p>
                    <table>
                        <tbody>
                            <tr>
                                <td style="width: 58.5%;"><p><b>Select Overall Inherent Risk (Low / Medium / High):</b></p></td>
                                <td style="width: 8%;"></td>
                                <td class="bo cent" style="width: 16.75%;">'.$ac6['oirp'].'</td>
                                <td class="bo cent" style="width: 16.75%;">'.$ac6['oirf'].'</td>
                            </tr>
                        </tbody>
                    </table>
                    <table>
                        <tbody>
                            <tr>
                                <td style="width: 58.5%;">Performance Materiality Percentage (Note 7):</td>
                                <td style="width: 8%;"></td>
                                <td class="bo cent" style="width: 16.75%;">'.$ac6['pmpp'].'</td>
                                <td class="bo cent" style="width: 16.75%;">'.$ac6['pmpf'].'</td>
                            </tr>
                        </tbody>
                    </table>   
                    <p><i>NB: If a percentage has been applied which differs from that suggested by the methodology, document the reasons for this in the conclusion box below.</i></p>
                    <table>
                        <tbody>
                            <tr>
                                <td style="width: 58.5%;"><p><b>Assessed Performance Materiality</b></p></td>
                                <td style="width: 8%;"></td>
                                <td class="bo cent" style="width: 16.75%;">'.$ac6['apmp'].'</td>
                                <td class="bo cent" style="width: 16.75%;">'.$ac6['apmf'].'</td>
                            </tr>
                        </tbody>
                    </table>  
                    <table>
                        <tbody>
                            <tr>
                                <td><p><b>Conclusion at planning stage</b><br>The performance materiality level calculated above is deemed to be appropriate because:</p></td>
                            </tr>
                            <tr>
                                <td class="bo"><br><br> '.$ac6['conplst2'].' <br><br></td>
                            </tr>
                        </tbody>
                    </table>
                    <table>
                        <tbody>
                            <tr>
                                <td><p><b>Conclusion at finalisation stage</b><br>Document reasons for any revision to the perfomance materiality assessed at planning stage and the impact on the audit procedures undertaken:</p></td>
                            </tr>
                            <tr>
                                <td class="bo"><br><br> '.$ac6['confnst2'].' <br><br></td>
                            </tr>
                        </tbody>
                    </table>
                    <p><b>CLEARLY TRIVIAL</b></p>
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 58.5%;"></th>
                                <th style="width: 8%;"><b>%</b></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="width: 58.5%;">Level at which errors are considered trivial (Note 8)</td>
                                <td style="width: 8%;">1%</td>
                                <td class="bo cent" style="width: 16.75%;">'.$ac6['ctp'].'</td>
                                <td class="bo cent" style="width: 16.75%;">'.$ac6['ctf'].'</td>
                            </tr>
                        </tbody>
                    </table>
                    <table>
                        <tbody>
                            <tr>
                                <td><p><b>Document reasons for any revision to the suggested percentage</b></p></td>
                            </tr>
                            <tr>
                                <td class="bo"><br><br> '.$ac6['rsp'].' <br><br></td>
                            </tr>
                        </tbody>
                    </table>
                    <p><b>SPECIFIC PERFORMANCE MATERIALITY LEVELS FOR CLASSES OF TRANSACTIONS, ACCOUNT BALANCES OR DISCLOSURES (Notes 9 and 10):</b></p>
                    <p>Factors that may indicate the existence of one or more particular classes of transactions, account balances or disclosures for which a lower level of materiality should be applied include the following:</p>
                    <ol type="a">
                        <li>Related party transactions and compensation of key management personnel;</li>
                        <li>Key disclosures in relation to the industry in which the entity operates;</li>
                        <li>Particular focus on specific disclosures (such as business combinations);</li>
                        <li>Accounting estimates.</li>
                    </ol>        
                    <p>Document below the materiality levels to be applied to the relevant classes of transactions, account balances or disclosures. <br>The auditor may find it useful to get the views and expectations of the client here. <br><b>Other levels of performance materiality to be applied:</b></p>
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 58.5%;"></th>
                                <th style="width: 8%;">%</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="width: 58.5%;">Related party transactions and Remuneration of key management</td>
                                <td style="width: 8%;">5%</td>
                                <td class="bo cent" style="width: 16.75%;">'.$ac6['rptp'].'</td>
                                <td class="bo cent" style="width: 16.75%;">'.$ac6['rptf'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 58.5%;">Accounting estimates</td>
                                <td style="width: 8%;">'.$ac6['aest'].'</td>
                                <td class="bo cent" style="width: 16.75%;">'.$ac6['aestp'].'</td>
                                <td class="bo cent" style="width: 16.75%;">'.$ac6['aestf'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 58.5%;">'.$ac6['itbdae1'].'</td>
                                <td style="width: 8%;">'.$ac6['itbd1'].'</td>
                                <td class="bo cent" style="width: 16.75%;">'.$ac6['itbd1p'].'</td>
                                <td class="bo cent" style="width: 16.75%;">'.$ac6['itbd1f'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 58.5%;">'.$ac6['itbdae2'].'</td>
                                <td style="width: 8%;">'.$ac6['itbd2'].'</td>
                                <td class="bo cent" style="width: 16.75%;">'.$ac6['itbd2p'].'</td>
                                <td class="bo cent" style="width: 16.75%;">'.$ac6['itbd2f'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 58.5%;">'.$ac6['itbdae3'].'</td>
                                <td style="width: 8%;">'.$ac6['itbd3'].'</td>
                                <td class="bo cent" style="width: 16.75%;">'.$ac6['itbd3p'].'</td>
                                <td class="bo cent" style="width: 16.75%;">'.$ac6['itbd3f'].'</td>
                            </tr>
                        </tbody>
                    </table>
                    <p><b>Definition per PSA 320.9:</b><br>Performance materiality - For the purposes of the ISAs, performance materiality means the amount or amounts set by the auditor at less than materiality for the financial statements as a whole to reduce to an acceptably low level the probability that the aggregate of uncorrected and undetected misstatements exceeds materiality for the financial statements as a whole.  If applicable, performance materiality also refers to the amount or amounts set by the auditor at less than the materiality level or levels for particular classes of transactions, account balances or disclosures.</p>
                    <p><b>Guidance and Notes:</b></p>
                    <ol>
                        <li>Blue cells require user input</li>
                        <li>Use absolute figures (i.e. if there is a loss before tax, use this as a positive figure)</li>
                        <li>At the planning stage use management accounts, flexed budgets or last period\'s figures if current figures are not available.</li>
                        <li>The auditor must document the factors considered in the determination of materiality as a whole, performance materiality and, if applicable, the materiality level(s) for particular classes of transactions, account balances or disclosures. The determining of materiality involves the use of professional judgement, therefore the auditor must be able to justify the chosen benchmark used as a starting point in determining materiality. See PSA 320.A3 for guidance. 
                            <br>For example: for a trading company where the Directors are focused on profit, profit before tax may be the most relevant benchmark to use. For an investment property company, it is likely that the gross assets figure would be the most appropriate benchmark. For service companies, cost-plus entities or not-for-profit entities, it is likely that revenue will be the most appropriate benchmark. 
                            <br>If the most relevant benchmark for an entity is volatile year on year, such that using that benchmark would result in incomparable materiality figures year on year, other benchmarks may be considered to be more appropriate.
                        </li>
                        <li>The percentages applied to a chosen benchmark are also a matter of professional judgement. If the suggested percentages noted above are inappropriate, amend them as necessary.</li>
                        <li>Adjust for any anomalies that may affect materiality.  For example, for an owner-managed business where the owner takes much of the profit before tax in the form of remuneration, "adding back" the owner\'s remuneration to the profit before taxation figure would provide a more relevant benchmark to be used in the materiality calculation.</li>
                        <li>It is recommended that a level of 75% of audit materiality is used to determine performance materiality when overall inherent risk is low, 62.5% when overall inherent risk is medium and 50% when overall inherent risk is high (see definition above).  Percentages </li>
                        <li>"Clearly trivial"  errors do not need to be accumulated.  These items are clearly inconsequential, whether taken individually or in aggregate, whether judged by size, nature or circumstances.  It is suggested that 1% of audit materiality is used to determine a level at which items are deemed to be clearly trivial, but a different percentage can be used if deemed to be more appropriate and is adequately justified. 
                            <br>However, misstatements relating to amounts may not be clearly trivial when judged on criteria of nature or circumstance. If this is the case, the misstatements should be accumulated as unadjusted errors.
                        </li>
                        <li>For "sensitive" disclosures, such as those relating to share capital, directors\' remuneration and related party transactions, amounts which are disclosed in the financial statements should be correct.  It is recommended that that "allowable misstatements" relating to any related party matter are set at 5% of audit materiality.  It is permissible for different thresholds may be set, but these should be appropriate in the context.  Additional thresholds may also be set for other classes of transactions, account balances or disclosures, which should be fully documented, but may not exceed the level of performance materiality.  In each case, the percentage of audit materiality applied should be stated.</li>
                        <li>The accuracy of accounting estimates needs to be established.  Estimates are "soft" figures in financial statements, and as such, have a level of risk attached to them.  The level of estimation uncertainty for accounting estimates should be documented and should be set at a level lower than performance materiality.</li>
                        <li>Document reasons for not using a materiality level based on the amounts calculated, reasons for setting different levels for individual items in the financial statements and reasons why the final materiality level differs from the planning materiality level.</li>
                    </ol>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;

            case 'AC7':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : Risk summary',1,1);
                $html .= $style;
                $fl    = $rp->getfileinfo('c2',$wpID,$cID,$c['mtID']);
                $trig  = 0;
                $ac6   = $rp->getvalues_m('c2','ac6ra',$c['code'],$c['mtID'],$cID,$wpID);
                $rdata = $rp->getvalues_s('c2','ac6s12',$c['code'],$c['mtID'],$cID,$wpID);
                $s     = json_decode($rdata['field1'], true);
                $s3    = $rp->getvalues_m('c2','ac6s3',$c['code'],$c['mtID'],$cID,$wpID);
                $html .= '
                    <table>
                        <tr>
                            <td style="width: 55%;">
                                <table>
                                    <tr><td class="bb">Client: <b>'.$cl['clientname'].'</b></td></tr>
                                    <tr><td></td></tr>
                                    <tr><td class="bb">Period: <b>FY-'.$cl['financial_year'].'</b></td></tr>
                                </table>
                            </td>
                            <td style="width: 45%;">
                                <table border="1">
                                    <tr>
                                        <td>Prepared by: <br><b>'.$cl['aud'].'</b></td>
                                        <td>Date: <br><b>'; if(!empty($fl['prepared_on'])){$html .= dtformat($fl['prepared_on']);}else{$html .= '';} $html .='</b></td>
                                    </tr>
                                    <tr>
                                        <td>Reviewed by: <br><b>'.$cl['sup'].'</b></td>
                                        <td>Date: <br><b>'; if(!empty($fl['reviewed_on'])){$html .= dtformat($fl['reviewed_on']);}else{$html .= '';} $html .='</b></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <h3>RISK SUMMARY</h3><p><b>This form should be completed when a narrative approach to inherent business risk assessment is undertaken. </b> If more than one risk level applies, add additional lines as appropriate.</p>
                    <table>
                        <thead>
                            <tr>
                                <th></th>
                                <th  colspan="2" class="cent">Risk Assessment</th>
                                <th class="cent">Reference</th>
                            </tr>
                            <tr>
                                <th class="cent" style="width: 50%;">Question</th>
                                <th class="cent" style="width: 16%;">Planning</th>
                                <th class="cent" style="width: 16%;">Finalization</th>
                                <th style="width: 16%;"></th>
                            </tr>
                        </thead>
                    <tbody>
                ';
                foreach($ac6 as $r){
                    $html .= '
                        <tr>
                            <td style="width: 50%;">'.$r['field1'].'</td>
                            <td class="bo" style="width: 16%;">'.$r['field2'].'</td>
                            <td class="bo" style="width: 16%;">'.$r['field3'].'</td>
                            <td class="bo" style="width: 16%;">'.$r['field4'].'</td>
                        </tr>
                        ';
                        if($r['field1'] == 'Control environment'){
                            $html .= '
                            <tr>
                                <td colspan="3"><b>Inherent risk assessment of specific areas</b></td>
                            </tr>
                            ';
                        }elseif($r['field1'] == 'Payroll' and $trig == 0){
                            $html .= '
                            <tr>
                                <td colspan="3"><b>Control risk assessment of specific areas</b></td>
                            </tr>
                            ';
                            $trig = 1;
                        }
                }
                $html .= '
                        </tbody>
                    </table>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('P');
                $html .= $style;
                $html .= '
                    <h3>NARRATIVE RISK ASSESSMENTINHERENT BUSINESS RISK AND CONTROL ENVIRONMENT ASSESSMENT</h3>
                    <p>The risk forms should not be completed until –</p>
                    <ul>
                        <li>Appropriate enquiries have been made of management;</li>
                        <li>Points forward from last year have been considered;</li>
                        <li>The permanent audit file has been reviewed; and</li>
                        <li>Preliminary analytical procedures have been carried out.</li>
                    </ul>
                    <p>Notes on completion of this document –</p>
                    <ul>
                        <li>Where significant risks have been identified, the entity \'s controls relevant to those risks should be understood;</li>
                        <li>Items marked * should be appropriately tailored.</li>
                    </ul>
                    <p>It should be ensured that appropriate consideration should be given to –</p>
                    <ul>
                        <li>Events and conditions that cast significant doubt on the entity’s ability to continue as a Going Concern;</li>
                        <li>The client’s use of Service Organisations and Experts;</li>
                        <li>The impact of litigation, claims and areas of non-compliance with law and regulations on the financial statements;</li>
                        <li>The extent to which transactions with related parties are incorporated into the financial statements;</li>
                        <li>The extent to which there are material figures in the financial statements which are derived from Accounting Estimates.</li>
                    </ul>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('L');
                $html .= $style;
                $html .= '
                    <p><b>Objective:</b> This form is designed to determine the inherent risk of the business as a whole.  PSA 315 implies that all businesses should be high risk unless this can be rebutted.  Completion of this form will help to justify a departure from high risk.</p>
                    <h3>Section 1 – INHERENT BUSINESS RISK</h3>
                    <table border="1">
                        <tbody>
                            <tr>
                                <td><p>The inherent business risk of the client is deemed to be low / medium / high* for the following reasons:</p>
                                    <br><br><br><br>
                                    <p>'.$s['s1'].'</p>
                                    <br><br><br><br><br><br><br><br>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <p>Comprehensive consideration should be given to all clients even those deemed to be low risk. As part of this review consideration must be given to the Company’s going concern status and I.T. risk.</p>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('L');
                $html .= $style;
                $html .= '
                    <p><b>Objective:</b> This form is designed to assess the adequacy of the entity’s control environment as a whole to determine whether a control based audit approach is appropriate. Section 3 looks at internal controls specific to the audit. To comply with PSA 315, both sections must be completed regardless of whether you intend to test, and if successful, place reliance on the entity’s controls.</p>
                    <p>In addition, this form should document the considerations of the risks related to management override of controls.</p>
                    <h3>Section 2a – CONSIDERATION OF THE RISK OF MANAGEMENT OVERRIDE OF CONTROLS </h3>
                    <table border="1">
                        <tbody>
                            <tr>
                                <td><p>The risk of management override is present in <b>ALL</b> entities. However, the level of that risk will vary from entity to entity. Where management can override key controls, document here the considerations relating to the level of risk posed by management override and the audit procedures planned to address this risk:</p>
                                    <br><br><br><br>
                                    <p>'.$s['s2a'].'</p>
                                    <br><br><br><br><br><br><br><br>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <h3>Section 2b – CONSIDERATION OF THE CONTROL ENVIRONMENT </h3>
                    <table border="1">
                        <tbody>
                            <tr>
                                <td><p>The control environment of the client deemed to be effective / ineffective* for the following reasons: </p>
                                    <br><br><br><br>
                                    <p>'.$s['s2b'].'</p>
                                    <br><br><br><br><br><br><br><br>
                                    <p>Based on the above assessment control testing is / is not * going to be undertaken </p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('L');
                $html .= $style;
                $html .= '
                    <h3>Section 3 - UNDERSTANDING THE DESIGN AND IMPLEMENTATION OF INTERNAL CONTROLS</h3>
                    <p><b>Objective:</b><br>The auditor is required to “obtain an understanding of internal control relevant to the audit. Although most controls relevant to the audit are likely to relate to financial reporting, not all controls that relate to financial reporting are relevant to the audit.” (paragraph 12 of PSA 315).</p>
                    <p>The auditor is required to evaluate the design of these controls and determine whether they have been appropriately implemented.  Per paragraph A74 of PSA 315:</p>
                    <ul>
                        <li><b><u>Evaluating</u></b> the design of a control involves “considering whether the control, individually or in combination with other controls, is capable of effectively preventing, or detecting and correcting, material misstatements;</li>
                        <li><b><u>Implementation</u></b> of a control means that the control exists, and the entity is using it”.</li>
                    </ul>
                    <p><b>Requirement:</b><br>Summarise below the internal controls that are <b><u>relevant to the audit</u></b> and evaluate whether those controls are effective. If the controls are considered effective, test that the controls are being used by the entity.   </p>
                    <p>As per paragraph A75 of PSA 315, the following procedures may be carried out to obtain evidence about the design and implementation of controls: </p>
                    <ul>
                        <li>Inquiry of entity personnel;</li>
                        <li>Observing the application of specific controls;</li>
                        <li>Inspecting documents and reports;</li>
                        <li>Tracing transactions through the information system relevant to financial reporting.</li>
                    </ul>
                    <p>NB: this requirement exists irrespective of whether the overall control environment has been deemed to be ineffective in section 2b above. </p>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('L');
                $html .= $style;
                $html .= '
                    <table border="1">
                        <thead>
                            <tr>
                                <th><b>Financial Statement Area</b></th>
                                <th><b>Description of the control </b></th>
                                <th><b>Is the control effective?</b></th>
                                <th><b>Has the control been implemented effectively?</b></th>
                                <th><b>How has this been assessed?</b></th>
                                <th><b>Cross reference to testing </b></th>
                                <th><b>Reliance to be placed on control? (*)</b></th>
                            </tr>
                        </thead>
                        <tbody id="tbody1" class="tbody">
                            <tr>
                                <td>e.g. <br> Trade Debtors</td>
                                <td>e.g.<br> All new customers are subject to credit checks and credit limits restricted to £50k.</td>
                                <td>e.g.<br> Yes</td>
                                <td>e.g.<br> Yes</td>
                                <td>e.g.<br> The risk of bad debts has been reduced. Inquired with the sales ledger team about the process and seen evidence of this by performing a walkthrough of a new customer set up.</td>
                                <td>e.g.<br> T4</td>
                                <td>e.g.<br> No</td>
                            </tr>
                            <tr>
                                <td>e.g.<br>Creditors and Stock</td>
                                <td>e.g.<br>All goods received are matched to purchase orders before being booked into stock.</td>
                                <td>e.g.<br>Yes</td>
                                <td>e.g.<br>No</td>
                                <td>e.g.<br>Despite this being noted as a control in the client’s systems notes, the warehouse team often do not evidence that the check has taken place. </td>
                                <td>e.g.<br>T6</td>
                                <td>e.g.<br>No</td>
                            </tr>
                ';
                        foreach($s3 as $r1){
                            $html .= '
                            <tr>
                                <td>'.$r1['field1'].'</td>
                                <td>'.$r1['field2'].'</td>
                                <td>'.$r1['field3'].'</td>
                                <td>'.$r1['field4'].'</td>
                                <td>'.$r1['field5'].'</td>
                                <td>'.$r1['field6'].'</td>
                                <td>'.$r1['field7'].'</td>
                            </tr>
                            ';
                        }
                $html .='
                        </tbody>
                    </table>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('L');
                $html .= $style;
                $html .= '
                    <p><b>Notes Regarding Assessment of Controls:	</b></p>
                    <ol>
                        <li>The audit approach section of the assignment plan should include details of how the risk and control environment assessment have influenced the design of the audit programmes and have identified key items and key audit issues. <br></li>
                        <li>Where it is unlikely that sufficient, appropriate audit evidence can be obtained solely from substantive procedures, it is necessary to obtain an understanding of the controls over risks which may arise.  In such circumstances, it is necessary for controls testing to be performed (for example, a company which sells goods and services over the internet, where the process is highly automated, and relies on little or no human input).  In such cases, the entity\'s controls over such risks are relevant to the audit.  (PSA 315.30, PSA 315.A140-142). <br></li>
                        <li>Where significant risks have been identified, the entity\'s controls relevant to those risks should be understood. <br></li>
                        <li>Paragraph 31 of PSA 240 states "Management is in a unique position to perpetrate fraud because of management’s ability to manipulate accounting records and prepare fraudulent financial statements by overriding controls that otherwise appear to be operating effectively. Although the level of risk of management override of controls will vary from entity to entity, the risk is nevertheless present in all entities. Due to the unpredictable way in which such override could occur, it is a risk of material misstatement due to fraud and thus a significant risk". <br></li>
                    </ol>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;
            
            case 'AC8':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : Specific area narrative inherent risk management',1,1);
                $html      .= $style;
                $fl         = $rp->getfileinfo('c2',$wpID,$cID,$c['mtID']);
                $databac    = $rp->getvalues_s('c2','bacdata',$c['code'],$c['mtID'],$cID,$wpID);
                $bacdata    = json_decode($databac['field1'], true);
                $datatr     = $rp->getvalues_s('c2','trdata',$c['code'],$c['mtID'],$cID,$wpID);
                $trdata     = json_decode($datatr['field1'], true);
                $dataor     = $rp->getvalues_s('c2','ordata',$c['code'],$c['mtID'],$cID,$wpID);
                $ordata     = json_decode($dataor['field1'], true);
                $datainvtr  = $rp->getvalues_s('c2','invtrdata',$c['code'],$c['mtID'],$cID,$wpID);
                $invtrdata  = json_decode($datainvtr['field1'], true);
                $datainvmt  = $rp->getvalues_s('c2','invmtdata',$c['code'],$c['mtID'],$cID,$wpID);
                $invmtdata  = json_decode($datainvmt['field1'], true);
                $datappe    = $rp->getvalues_s('c2','ppedata',$c['code'],$c['mtID'],$cID,$wpID);
                $ppedata    = json_decode($datappe['field1'], true);
                $datainca   = $rp->getvalues_s('c2','incadata',$c['code'],$c['mtID'],$cID,$wpID);
                $incadata   = json_decode($datainca['field1'], true);
                $datatp     = $rp->getvalues_s('c2','tpdata',$c['code'],$c['mtID'],$cID,$wpID);
                $tpdata     = json_decode($datatp['field1'], true);
                $dataop     = $rp->getvalues_s('c2','opdata',$c['code'],$c['mtID'],$cID,$wpID);
                $opdata     = json_decode($dataop['field1'], true);
                $datatax    = $rp->getvalues_s('c2','taxdata',$c['code'],$c['mtID'],$cID,$wpID);
                $taxdata    = json_decode($datatax['field1'], true);
                $dataprov   = $rp->getvalues_s('c2','provdata',$c['code'],$c['mtID'],$cID,$wpID);
                $provdata   = json_decode($dataprov['field1'], true);
                $dataroi    = $rp->getvalues_s('c2','roidata',$c['code'],$c['mtID'],$cID,$wpID);
                $roidata    = json_decode($dataroi['field1'], true);
                $datadco    = $rp->getvalues_s('c2','dcodata',$c['code'],$c['mtID'],$cID,$wpID);
                $dcodata    = json_decode($datadco['field1'], true);
                $datapr     = $rp->getvalues_s('c2','prdata',$c['code'],$c['mtID'],$cID,$wpID);
                $prdata     = json_decode($datapr['field1'], true);
                $dataoa     = $rp->getvalues_s('c2','oadata',$c['code'],$c['mtID'],$cID,$wpID);
                $oadata     = json_decode($dataoa['field1'], true);
                $html      .= '
                    <table>
                        <tr>
                            <td style="width: 55%;">
                                <table>
                                    <tr><td class="bb">Client: <b>'.$cl['clientname'].'</b></td></tr>
                                    <tr><td></td></tr>
                                    <tr><td class="bb">Period: <b>FY-'.$cl['financial_year'].'</b></td></tr>
                                </table>
                            </td>
                            <td style="width: 45%;">
                                <table border="1">
                                    <tr>
                                        <td>Prepared by: <br><b>'.$cl['aud'].'</b></td>
                                        <td>Date: <br><b>'; if(!empty($fl['prepared_on'])){$html .= dtformat($fl['prepared_on']);}else{$html .= '';} $html .='</b></td>
                                    </tr>
                                    <tr>
                                        <td>Reviewed by: <br><b>'.$cl['sup'].'</b></td>
                                        <td>Date: <br><b>'; if(!empty($fl['reviewed_on'])){$html .= dtformat($fl['reviewed_on']);}else{$html .= '';} $html .='</b></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <h3>SPECIFIC AREA NARRATIVE INHERENT RISK ASSESSMENT</h3>
                    <p><b>Objective:</b> This form is designed to assess the risk for each audit assertion relevant to each audit area.  PSA 315 implies that all areas and all assertions are high risk unless this can be rebutted.  Completion of this form will help to justify a departure from high risk.</p>
                    <p>The risk forms should not be completed until –</p>
                    <ul>
                        <li>Appropriate enquiries have been made of management;</li>
                        <li>Points forward from last year have been considered;</li>
                        <li>The permanent audit file has been reviewed; and</li>
                        <li>Preliminary analytical procedures have been carried out.</li>
                    </ul>
                    <p>Notes on completion of this document –</p>
                    <ul>
                        <li>A list of possible risk factors has been collated (Appendix 1.14.1) can be used as an aide memoire;</li>
                        <li>An answer of “Yes” to one of the preliminary questions on each audit area will mean that there are potential risks associated with that area, and therefore a full commentary for that audit area will be required; and</li>
                        <li>Sections which are less than expected performance materiality or are not applicable should be deleted.</li>
                    </ul>
                    <p><b>Specific Considerations relating to Revenue</b></p>
                    <p>Per PSA 240, paragraph 26 <i>“the auditor shall, based on a presumption that there are risks of fraud in revenue recognition, evaluate which types of revenue, revenue transactions or assertions give rise to such risks”.  Paragraph 47 states “if the auditor has concluded that the presumption that there is a risk of material misstatement due to fraud related to revenue recognition is not applicable in the circumstances of the engagement, the auditor shall include in the audit documentation the reasons for that conclusion”. </i></p>
                    <p>It is therefore expected that the risk attributed to Revenue will be high unless there is sufficient justification given to rebut the presumption of high risk. Paragraphs A28 to A30 of the Application and Other Explanatory Material of PSA 240 should be referred to for additional guidance.</p>
                    <p>If the risk of fraud in revenue recognition cannot be rebutted, it is a significant risk (see below).</p>
                    <p><b>Significant risks: </b><br> All risks which are deemed to be significant should be specifically highlighted.  A significant risk is one which would be a “blockbuster”.  A risk may be deemed to be significant for the following reasons:</p>
                    <ul>
                        <li>The risk is a risk of fraud;</li>
                        <li>The risk is related to significant economic, accounting or other developments, and therefore, requiring specific attention;</li>
                        <li>The complexity of transactions;</li>
                        <li>Whether the risk involves significant transactions with related parties;</li>
                        <li>The degree of subjectivity in the measurement of the financial information related to the risk; </li>
                        <li>Whether the risk involves significant transactions (including those with related parties) that are outside the normal course of business; and</li>
                    </ul>
                    <p>Where significant risks have been identified:</p>
                    <ul>
                        <li>At the assertion level, substantive procedures specific to that risk need to be performed;</li>
                        <li>The entity\'s controls relevant to those risks should be understood; </li>
                        <li>They will automatically be deemed to be “high risk”, and other risks will be deemed to be “low risk”.  The “default” risk can (and should) be over-ridden if it is deemed to be appropriate.  Reasons should be fully documented;</li>
                        <li>They will be communicated to the client at the planning stage in the Planning Letter; and</li>
                        <li>How the risk has been addressed during the assignment should be summarized on the PSA Compliance Critical Issues Memorandum.</li>
                    </ul>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('L');
                $html .= $style;
                $html .= '
                    <h3>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – BANK AND CASH:</h3>
                    <table>
                        <tbody>
                            <tr>
                                <td style="width: 90%;">1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                                <td style="width: 10%;">'.$bacdata['y1'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                                <td style="width: 10%;">'.$bacdata['y2'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                                <td style="width: 10%;">'.$bacdata['y3'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                                <td style="width: 10%;">'.$bacdata['y4'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                                <td style="width: 10%;">'.$bacdata['y5'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                                <td style="width: 10%;">'.$bacdata['y6'].'</td>
                            </tr>
                        </tbody>
                    </table>
                    <p># - The use of a regulated clearing bank would not be deemed to be a service organisation for this purpose.</p>
                    <p>An answer of “Yes” to one of questions above will mean that there are potential risks associated with this area.  Other risks may also exist, and should be fully explained.</p>
                    <table border="1">
                        <thead>
                            <tr>
                                <th>General inherent risks relevant to the area / Conclusion (Low / Med. / High) </th>
                                <th>Assertion</th>
                                <th>Specific inherent risks relevant to audit assertions / Conclusion (Low / Med. / High)</th>
                                <th>Impact on the audit including how risk has been addressed</th>
                                <th>Audit test reference</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td rowspan="5">'.$bacdata['gen'].'</td>
                                <td>Existence</td>
                                <td>'.$bacdata['e1'].'</td>
                                <td>'.$bacdata['e2'].'</td>
                                <td>'.$bacdata['e3'].'</td>
                            </tr>
                            <tr>
                                <td>Rights / Obligations</td>
                                <td>'.$bacdata['ro1'].'</td>
                                <td>'.$bacdata['ro2'].'</td>
                                <td>'.$bacdata['ro3'].'</td>
                            </tr>
                            <tr>
                                <td>Completeness</td>
                                <td>'.$bacdata['c1'].'</td>
                                <td>'.$bacdata['c2'].'</td>
                                <td>'.$bacdata['c3'].'</td>
                            </tr>
                            <tr>
                                <td>Valuation / Allocation</td>
                                <td>'.$bacdata['va1'].'</td>
                                <td>'.$bacdata['va2'].'</td>
                                <td>'.$bacdata['va3'].'</td>
                            </tr>
                            <tr>
                                <td>Presentation and Disclosure</td>
                                <td>'.$bacdata['pd1'].'</td>
                                <td>'.$bacdata['pd2'].'</td>
                                <td>'.$bacdata['pd3'].'</td>
                            </tr>
                        </tbody>
                    </table>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('L');
                $html .= $style;
                $html .= '
                    <h3>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – TRADE RECEIVABLES:</h3>
                    <table>
                        <tbody>
                            <tr>
                                <td style="width: 90%;">1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                                <td style="width: 10%;">'.$trdata['y1'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                                <td style="width: 10%;">'.$trdata['y2'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                                <td style="width: 10%;">'.$trdata['y3'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                                <td style="width: 10%;">'.$trdata['y4'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                                <td style="width: 10%;">'.$trdata['y5'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                                <td style="width: 10%;">'.$trdata['y6'].'</td>
                            </tr>
                        </tbody>
                    </table>
                    <p># - The use of a regulated clearing bank would not be deemed to be a service organisation for this purpose.</p>
                    <p>An answer of “Yes” to one of questions above will mean that there are potential risks associated with this area.  Other risks may also exist, and should be fully explained.</p>
                    <table border="1">
                        <thead>
                            <tr>
                                <th>General inherent risks relevant to the area / Conclusion (Low / Med. / High) </th>
                                <th>Assertion</th>
                                <th>Specific inherent risks relevant to audit assertions / Conclusion (Low / Med. / High)</th>
                                <th>Impact on the audit including how risk has been addressed</th>
                                <th>Audit test reference</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td rowspan="5">'.$trdata['gen'].'</td>
                                <td>Existence</td>
                                <td>'.$trdata['e1'].'</td>
                                <td>'.$trdata['e2'].'</td>
                                <td>'.$trdata['e3'].'</td>
                            </tr>
                            <tr>
                                <td>Rights / Obligations</td>
                                <td>'.$trdata['ro1'].'</td>
                                <td>'.$trdata['ro2'].'</td>
                                <td>'.$trdata['ro3'].'</td>
                            </tr>
                            <tr>
                                <td>Completeness</td>
                                <td>'.$trdata['c1'].'</td>
                                <td>'.$trdata['c2'].'</td>
                                <td>'.$trdata['c3'].'</td>
                            </tr>
                            <tr>
                                <td>Valuation / Allocation</td>
                                <td>'.$trdata['va1'].'</td>
                                <td>'.$trdata['va2'].'</td>
                                <td>'.$trdata['va3'].'</td>
                            </tr>
                            <tr>
                                <td>Presentation and Disclosure</td>
                                <td>'.$trdata['pd1'].'</td>
                                <td>'.$trdata['pd2'].'</td>
                                <td>'.$trdata['pd3'].'</td>
                            </tr>
                        </tbody>
                    </table>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('L');
                $html .= $style;
                $html .= '
                    <h3>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – OTHER RECEIVABLES (INCLUDING PREPAYMENTS):</h3>
                    <table>
                        <tbody>
                            <tr>
                                <td style="width: 90%;">1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                                <td style="width: 10%;">'.$ordata['y1'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                                <td style="width: 10%;">'.$ordata['y2'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                                <td style="width: 10%;">'.$ordata['y3'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                                <td style="width: 10%;">'.$ordata['y4'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                                <td style="width: 10%;">'.$ordata['y5'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                                <td style="width: 10%;">'.$ordata['y6'].'</td>
                            </tr>
                        </tbody>
                    </table>
                    <p># - The use of a regulated clearing bank would not be deemed to be a service organisation for this purpose.</p>
                    <p>An answer of “Yes” to one of questions above will mean that there are potential risks associated with this area.  Other risks may also exist, and should be fully explained.</p>
                    <table border="1">
                        <thead>
                            <tr>
                                <th>General inherent risks relevant to the area / Conclusion (Low / Med. / High) </th>
                                <th>Assertion</th>
                                <th>Specific inherent risks relevant to audit assertions / Conclusion (Low / Med. / High)</th>
                                <th>Impact on the audit including how risk has been addressed</th>
                                <th>Audit test reference</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td rowspan="5">'.$ordata['gen'].'</td>
                                <td>Existence</td>
                                <td>'.$ordata['e1'].'</td>
                                <td>'.$ordata['e2'].'</td>
                                <td>'.$ordata['e3'].'</td>
                            </tr>
                            <tr>
                                <td>Rights / Obligations</td>
                                <td>'.$ordata['ro1'].'</td>
                                <td>'.$ordata['ro2'].'</td>
                                <td>'.$ordata['ro3'].'</td>
                            </tr>
                            <tr>
                                <td>Completeness</td>
                                <td>'.$ordata['c1'].'</td>
                                <td>'.$ordata['c2'].'</td>
                                <td>'.$ordata['c3'].'</td>
                            </tr>
                            <tr>
                                <td>Valuation / Allocation</td>
                                <td>'.$ordata['va1'].'</td>
                                <td>'.$ordata['va2'].'</td>
                                <td>'.$ordata['va3'].'</td>
                            </tr>
                            <tr>
                                <td>Presentation and Disclosure</td>
                                <td>'.$ordata['pd1'].'</td>
                                <td>'.$ordata['pd2'].'</td>
                                <td>'.$ordata['pd3'].'</td>
                            </tr>
                        </tbody>
                    </table>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('L');
                $html .= $style;
                $html .= '
                    <h3>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – INVENTORIES:</h3>
                    <table>
                        <tbody>
                            <tr>
                                <td style="width: 90%;">1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                                <td style="width: 10%;">'.$invtrdata['y1'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                                <td style="width: 10%;">'.$invtrdata['y2'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                                <td style="width: 10%;">'.$invtrdata['y3'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                                <td style="width: 10%;">'.$invtrdata['y4'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                                <td style="width: 10%;">'.$invtrdata['y5'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                                <td style="width: 10%;">'.$invtrdata['y6'].'</td>
                            </tr>
                        </tbody>
                    </table>
                    <p># - The use of a regulated clearing bank would not be deemed to be a service organisation for this purpose.</p>
                    <p>An answer of “Yes” to one of questions above will mean that there are potential risks associated with this area.  Other risks may also exist, and should be fully explained.</p>
                    <table border="1">
                        <thead>
                            <tr>
                                <th>General inherent risks relevant to the area / Conclusion (Low / Med. / High) </th>
                                <th>Assertion</th>
                                <th>Specific inherent risks relevant to audit assertions / Conclusion (Low / Med. / High)</th>
                                <th>Impact on the audit including how risk has been addressed</th>
                                <th>Audit test reference</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td rowspan="5">'.$invtrdata['gen'].'</td>
                                <td>Existence</td>
                                <td>'.$invtrdata['e1'].'</td>
                                <td>'.$invtrdata['e2'].'</td>
                                <td>'.$invtrdata['e3'].'</td>
                            </tr>
                            <tr>
                                <td>Rights / Obligations</td>
                                <td>'.$invtrdata['ro1'].'</td>
                                <td>'.$invtrdata['ro2'].'</td>
                                <td>'.$invtrdata['ro3'].'</td>
                            </tr>
                            <tr>
                                <td>Completeness</td>
                                <td>'.$invtrdata['c1'].'</td>
                                <td>'.$invtrdata['c2'].'</td>
                                <td>'.$invtrdata['c3'].'</td>
                            </tr>
                            <tr>
                                <td>Valuation / Allocation</td>
                                <td>'.$invtrdata['va1'].'</td>
                                <td>'.$invtrdata['va2'].'</td>
                                <td>'.$invtrdata['va3'].'</td>
                            </tr>
                            <tr>
                                <td>Presentation and Disclosure</td>
                                <td>'.$invtrdata['pd1'].'</td>
                                <td>'.$invtrdata['pd2'].'</td>
                                <td>'.$invtrdata['pd3'].'</td>
                            </tr>
                        </tbody>
                    </table>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('L');
                $html .= $style;
                $html .= '
                    <h3>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – INVESTMENTS:</h3>
                    <table>
                        <tbody>
                            <tr>
                                <td style="width: 90%;">1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                                <td style="width: 10%;">'.$invmtdata['y1'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                                <td style="width: 10%;">'.$invmtdata['y2'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                                <td style="width: 10%;">'.$invmtdata['y3'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                                <td style="width: 10%;">'.$invmtdata['y4'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                                <td style="width: 10%;">'.$invmtdata['y5'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                                <td style="width: 10%;">'.$invmtdata['y6'].'</td>
                            </tr>
                        </tbody>
                    </table>
                    <p># - The use of a regulated clearing bank would not be deemed to be a service organisation for this purpose.</p>
                    <p>An answer of “Yes” to one of questions above will mean that there are potential risks associated with this area.  Other risks may also exist, and should be fully explained.</p>
                    <table border="1">
                        <thead>
                            <tr>
                                <th>General inherent risks relevant to the area / Conclusion (Low / Med. / High) </th>
                                <th>Assertion</th>
                                <th>Specific inherent risks relevant to audit assertions / Conclusion (Low / Med. / High)</th>
                                <th>Impact on the audit including how risk has been addressed</th>
                                <th>Audit test reference</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td rowspan="5">'.$invmtdata['gen'].'</td>
                                <td>Existence</td>
                                <td>'.$invmtdata['e1'].'</td>
                                <td>'.$invmtdata['e2'].'</td>
                                <td>'.$invmtdata['e3'].'</td>
                            </tr>
                            <tr>
                                <td>Rights / Obligations</td>
                                <td>'.$invmtdata['ro1'].'</td>
                                <td>'.$invmtdata['ro2'].'</td>
                                <td>'.$invmtdata['ro3'].'</td>
                            </tr>
                            <tr>
                                <td>Completeness</td>
                                <td>'.$invmtdata['c1'].'</td>
                                <td>'.$invmtdata['c2'].'</td>
                                <td>'.$invmtdata['c3'].'</td>
                            </tr>
                            <tr>
                                <td>Valuation / Allocation</td>
                                <td>'.$invmtdata['va1'].'</td>
                                <td>'.$invmtdata['va2'].'</td>
                                <td>'.$invmtdata['va3'].'</td>
                            </tr>
                            <tr>
                                <td>Presentation and Disclosure</td>
                                <td>'.$invmtdata['pd1'].'</td>
                                <td>'.$invmtdata['pd2'].'</td>
                                <td>'.$invmtdata['pd3'].'</td>
                            </tr>
                        </tbody>
                    </table>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('L');
                $html .= $style;
                $html .= '
                    <h3>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – PROPERTY, PLANT AND EQUIPMENT:</h3>
                    <table>
                        <tbody>
                            <tr>
                                <td style="width: 90%;">1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                                <td style="width: 10%;">'.$ppedata['y1'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                                <td style="width: 10%;">'.$ppedata['y2'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                                <td style="width: 10%;">'.$ppedata['y3'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                                <td style="width: 10%;">'.$ppedata['y4'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                                <td style="width: 10%;">'.$ppedata['y5'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                                <td style="width: 10%;">'.$ppedata['y6'].'</td>
                            </tr>
                        </tbody>
                    </table>
                    <p># - The use of a regulated clearing bank would not be deemed to be a service organisation for this purpose.</p>
                    <p>An answer of “Yes” to one of questions above will mean that there are potential risks associated with this area.  Other risks may also exist, and should be fully explained.</p>
                    <table border="1">
                        <thead>
                            <tr>
                                <th>General inherent risks relevant to the area / Conclusion (Low / Med. / High) </th>
                                <th>Assertion</th>
                                <th>Specific inherent risks relevant to audit assertions / Conclusion (Low / Med. / High)</th>
                                <th>Impact on the audit including how risk has been addressed</th>
                                <th>Audit test reference</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td rowspan="5">'.$ppedata['gen'].'</td>
                                <td>Existence</td>
                                <td>'.$ppedata['e1'].'</td>
                                <td>'.$ppedata['e2'].'</td>
                                <td>'.$ppedata['e3'].'</td>
                            </tr>
                            <tr>
                                <td>Rights / Obligations</td>
                                <td>'.$ppedata['ro1'].'</td>
                                <td>'.$ppedata['ro2'].'</td>
                                <td>'.$ppedata['ro3'].'</td>
                            </tr>
                            <tr>
                                <td>Completeness</td>
                                <td>'.$ppedata['c1'].'</td>
                                <td>'.$ppedata['c2'].'</td>
                                <td>'.$ppedata['c3'].'</td>
                            </tr>
                            <tr>
                                <td>Valuation / Allocation</td>
                                <td>'.$ppedata['va1'].'</td>
                                <td>'.$ppedata['va2'].'</td>
                                <td>'.$ppedata['va3'].'</td>
                            </tr>
                            <tr>
                                <td>Presentation and Disclosure</td>
                                <td>'.$ppedata['pd1'].'</td>
                                <td>'.$ppedata['pd2'].'</td>
                                <td>'.$ppedata['pd3'].'</td>
                            </tr>
                        </tbody>
                    </table>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('L');
                $html .= $style;
                $html .= '
                    <h3>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – INTANGIBLE NON-CURRENT ASSETS:</h3>
                    <table>
                        <tbody>
                            <tr>
                                <td style="width: 90%;">1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                                <td style="width: 10%;">'.$incadata['y1'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                                <td style="width: 10%;">'.$incadata['y2'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                                <td style="width: 10%;">'.$incadata['y3'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                                <td style="width: 10%;">'.$incadata['y4'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                                <td style="width: 10%;">'.$incadata['y5'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                                <td style="width: 10%;">'.$incadata['y6'].'</td>
                            </tr>
                        </tbody>
                    </table>
                    <p># - The use of a regulated clearing bank would not be deemed to be a service organisation for this purpose.</p>
                    <p>An answer of “Yes” to one of questions above will mean that there are potential risks associated with this area.  Other risks may also exist, and should be fully explained.</p>
                    <table border="1">
                        <thead>
                            <tr>
                                <th>General inherent risks relevant to the area / Conclusion (Low / Med. / High) </th>
                                <th>Assertion</th>
                                <th>Specific inherent risks relevant to audit assertions / Conclusion (Low / Med. / High)</th>
                                <th>Impact on the audit including how risk has been addressed</th>
                                <th>Audit test reference</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td rowspan="5">'.$incadata['gen'].'</td>
                                <td>Existence</td>
                                <td>'.$incadata['e1'].'</td>
                                <td>'.$incadata['e2'].'</td>
                                <td>'.$incadata['e3'].'</td>
                            </tr>
                            <tr>
                                <td>Rights / Obligations</td>
                                <td>'.$incadata['ro1'].'</td>
                                <td>'.$incadata['ro2'].'</td>
                                <td>'.$incadata['ro3'].'</td>
                            </tr>
                            <tr>
                                <td>Completeness</td>
                                <td>'.$incadata['c1'].'</td>
                                <td>'.$incadata['c2'].'</td>
                                <td>'.$incadata['c3'].'</td>
                            </tr>
                            <tr>
                                <td>Valuation / Allocation</td>
                                <td>'.$incadata['va1'].'</td>
                                <td>'.$incadata['va2'].'</td>
                                <td>'.$incadata['va3'].'</td>
                            </tr>
                            <tr>
                                <td>Presentation and Disclosure</td>
                                <td>'.$incadata['pd1'].'</td>
                                <td>'.$incadata['pd2'].'</td>
                                <td>'.$incadata['pd3'].'</td>
                            </tr>
                        </tbody>
                    </table>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('L');
                $html .= $style;
                $html .= '
                    <h3>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – TRADE PAYABLES:</h3>
                    <table>
                        <tbody>
                            <tr>
                                <td style="width: 90%;">1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                                <td style="width: 10%;">'.$tpdata['y1'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                                <td style="width: 10%;">'.$tpdata['y2'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                                <td style="width: 10%;">'.$tpdata['y3'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                                <td style="width: 10%;">'.$tpdata['y4'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                                <td style="width: 10%;">'.$tpdata['y5'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                                <td style="width: 10%;">'.$tpdata['y6'].'</td>
                            </tr>
                        </tbody>
                    </table>
                    <p># - The use of a regulated clearing bank would not be deemed to be a service organisation for this purpose.</p>
                    <p>An answer of “Yes” to one of questions above will mean that there are potential risks associated with this area.  Other risks may also exist, and should be fully explained.</p>
                    <table border="1">
                        <thead>
                            <tr>
                                <th>General inherent risks relevant to the area / Conclusion (Low / Med. / High) </th>
                                <th>Assertion</th>
                                <th>Specific inherent risks relevant to audit assertions / Conclusion (Low / Med. / High)</th>
                                <th>Impact on the audit including how risk has been addressed</th>
                                <th>Audit test reference</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td rowspan="5">'.$tpdata['gen'].'</td>
                                <td>Existence</td>
                                <td>'.$tpdata['e1'].'</td>
                                <td>'.$tpdata['e2'].'</td>
                                <td>'.$tpdata['e3'].'</td>
                            </tr>
                            <tr>
                                <td>Rights / Obligations</td>
                                <td>'.$tpdata['ro1'].'</td>
                                <td>'.$tpdata['ro2'].'</td>
                                <td>'.$tpdata['ro3'].'</td>
                            </tr>
                            <tr>
                                <td>Completeness</td>
                                <td>'.$tpdata['c1'].'</td>
                                <td>'.$tpdata['c2'].'</td>
                                <td>'.$tpdata['c3'].'</td>
                            </tr>
                            <tr>
                                <td>Valuation / Allocation</td>
                                <td>'.$tpdata['va1'].'</td>
                                <td>'.$tpdata['va2'].'</td>
                                <td>'.$tpdata['va3'].'</td>
                            </tr>
                            <tr>
                                <td>Presentation and Disclosure</td>
                                <td>'.$tpdata['pd1'].'</td>
                                <td>'.$tpdata['pd2'].'</td>
                                <td>'.$tpdata['pd3'].'</td>
                            </tr>
                        </tbody>
                    </table>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('L');
                $html .= $style;
                $html .= '
                    <h3>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – OTHER PAYABLES (INCLUDING ACCRUALS):</h3>
                    <table>
                        <tbody>
                            <tr>
                                <td style="width: 90%;">1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                                <td style="width: 10%;">'.$opdata['y1'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                                <td style="width: 10%;">'.$opdata['y2'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                                <td style="width: 10%;">'.$opdata['y3'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                                <td style="width: 10%;">'.$opdata['y4'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                                <td style="width: 10%;">'.$opdata['y5'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                                <td style="width: 10%;">'.$opdata['y6'].'</td>
                            </tr>
                        </tbody>
                    </table>
                    <p># - The use of a regulated clearing bank would not be deemed to be a service organisation for this purpose.</p>
                    <p>An answer of “Yes” to one of questions above will mean that there are potential risks associated with this area.  Other risks may also exist, and should be fully explained.</p>
                    <table border="1">
                        <thead>
                            <tr>
                                <th>General inherent risks relevant to the area / Conclusion (Low / Med. / High) </th>
                                <th>Assertion</th>
                                <th>Specific inherent risks relevant to audit assertions / Conclusion (Low / Med. / High)</th>
                                <th>Impact on the audit including how risk has been addressed</th>
                                <th>Audit test reference</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td rowspan="5">'.$opdata['gen'].'</td>
                                <td>Existence</td>
                                <td>'.$opdata['e1'].'</td>
                                <td>'.$opdata['e2'].'</td>
                                <td>'.$opdata['e3'].'</td>
                            </tr>
                            <tr>
                                <td>Rights / Obligations</td>
                                <td>'.$opdata['ro1'].'</td>
                                <td>'.$opdata['ro2'].'</td>
                                <td>'.$opdata['ro3'].'</td>
                            </tr>
                            <tr>
                                <td>Completeness</td>
                                <td>'.$opdata['c1'].'</td>
                                <td>'.$opdata['c2'].'</td>
                                <td>'.$opdata['c3'].'</td>
                            </tr>
                            <tr>
                                <td>Valuation / Allocation</td>
                                <td>'.$opdata['va1'].'</td>
                                <td>'.$opdata['va2'].'</td>
                                <td>'.$opdata['va3'].'</td>
                            </tr>
                            <tr>
                                <td>Presentation and Disclosure</td>
                                <td>'.$opdata['pd1'].'</td>
                                <td>'.$opdata['pd2'].'</td>
                                <td>'.$opdata['pd3'].'</td>
                            </tr>
                        </tbody>
                    </table>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('L');
                $html .= $style;
                $html .= '
                    <h3>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – TAXATION:</h3>
                    <table>
                        <tbody>
                            <tr>
                                <td style="width: 90%;">1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                                <td style="width: 10%;">'.$taxdata['y1'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                                <td style="width: 10%;">'.$taxdata['y2'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                                <td style="width: 10%;">'.$taxdata['y3'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                                <td style="width: 10%;">'.$taxdata['y4'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                                <td style="width: 10%;">'.$taxdata['y5'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                                <td style="width: 10%;">'.$taxdata['y6'].'</td>
                            </tr>
                        </tbody>
                    </table>
                    <p># - The use of a regulated clearing bank would not be deemed to be a service organisation for this purpose.</p>
                    <p>An answer of “Yes” to one of questions above will mean that there are potential risks associated with this area.  Other risks may also exist, and should be fully explained.</p>
                    <table border="1">
                        <thead>
                            <tr>
                                <th>General inherent risks relevant to the area / Conclusion (Low / Med. / High) </th>
                                <th>Assertion</th>
                                <th>Specific inherent risks relevant to audit assertions / Conclusion (Low / Med. / High)</th>
                                <th>Impact on the audit including how risk has been addressed</th>
                                <th>Audit test reference</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td rowspan="5">'.$taxdata['gen'].'</td>
                                <td>Existence</td>
                                <td>'.$taxdata['e1'].'</td>
                                <td>'.$taxdata['e2'].'</td>
                                <td>'.$taxdata['e3'].'</td>
                            </tr>
                            <tr>
                                <td>Rights / Obligations</td>
                                <td>'.$taxdata['ro1'].'</td>
                                <td>'.$taxdata['ro2'].'</td>
                                <td>'.$taxdata['ro3'].'</td>
                            </tr>
                            <tr>
                                <td>Completeness</td>
                                <td>'.$taxdata['c1'].'</td>
                                <td>'.$taxdata['c2'].'</td>
                                <td>'.$taxdata['c3'].'</td>
                            </tr>
                            <tr>
                                <td>Valuation / Allocation</td>
                                <td>'.$taxdata['va1'].'</td>
                                <td>'.$taxdata['va2'].'</td>
                                <td>'.$taxdata['va3'].'</td>
                            </tr>
                            <tr>
                                <td>Presentation and Disclosure</td>
                                <td>'.$taxdata['pd1'].'</td>
                                <td>'.$taxdata['pd2'].'</td>
                                <td>'.$taxdata['pd3'].'</td>
                            </tr>
                        </tbody>
                    </table>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('L');
                $html .= $style;
                $html .= '
                    <h3>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – PROVISIONS FOR LIABILITIES:</h3>
                    <table>
                        <tbody>
                            <tr>
                                <td style="width: 90%;">1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                                <td style="width: 10%;">'.$provdata['y1'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                                <td style="width: 10%;">'.$provdata['y2'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                                <td style="width: 10%;">'.$provdata['y3'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                                <td style="width: 10%;">'.$provdata['y4'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                                <td style="width: 10%;">'.$provdata['y5'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                                <td style="width: 10%;">'.$provdata['y6'].'</td>
                            </tr>
                        </tbody>
                    </table>
                    <p># - The use of a regulated clearing bank would not be deemed to be a service organisation for this purpose.</p>
                    <p>An answer of “Yes” to one of questions above will mean that there are potential risks associated with this area.  Other risks may also exist, and should be fully explained.</p>
                    <table border="1">
                        <thead>
                            <tr>
                                <th>General inherent risks relevant to the area / Conclusion (Low / Med. / High) </th>
                                <th>Assertion</th>
                                <th>Specific inherent risks relevant to audit assertions / Conclusion (Low / Med. / High)</th>
                                <th>Impact on the audit including how risk has been addressed</th>
                                <th>Audit test reference</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td rowspan="5">'.$provdata['gen'].'</td>
                                <td>Existence</td>
                                <td>'.$provdata['e1'].'</td>
                                <td>'.$provdata['e2'].'</td>
                                <td>'.$provdata['e3'].'</td>
                            </tr>
                            <tr>
                                <td>Rights / Obligations</td>
                                <td>'.$provdata['ro1'].'</td>
                                <td>'.$provdata['ro2'].'</td>
                                <td>'.$provdata['ro3'].'</td>
                            </tr>
                            <tr>
                                <td>Completeness</td>
                                <td>'.$provdata['c1'].'</td>
                                <td>'.$provdata['c2'].'</td>
                                <td>'.$provdata['c3'].'</td>
                            </tr>
                            <tr>
                                <td>Valuation / Allocation</td>
                                <td>'.$provdata['va1'].'</td>
                                <td>'.$provdata['va2'].'</td>
                                <td>'.$provdata['va3'].'</td>
                            </tr>
                            <tr>
                                <td>Presentation and Disclosure</td>
                                <td>'.$provdata['pd1'].'</td>
                                <td>'.$provdata['pd2'].'</td>
                                <td>'.$provdata['pd3'].'</td>
                            </tr>
                        </tbody>
                    </table>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('L');
                $html .= $style;
                $html .= '
                    <h3>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – REVENUE / OTHER INCOME:</h3>
                    <table>
                        <tbody>
                            <tr>
                                <td style="width: 90%;">1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                                <td style="width: 10%;">'.$roidata['y1'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                                <td style="width: 10%;">'.$roidata['y2'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                                <td style="width: 10%;">'.$roidata['y3'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                                <td style="width: 10%;">'.$roidata['y4'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                                <td style="width: 10%;">'.$roidata['y5'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                                <td style="width: 10%;">'.$roidata['y6'].'</td>
                            </tr>
                        </tbody>
                    </table>
                    <p># - The use of a regulated clearing bank would not be deemed to be a service organisation for this purpose.</p>
                    <p>An answer of “Yes” to one of questions above will mean that there are potential risks associated with this area.  Other risks may also exist, and should be fully explained.</p>
                    <table border="1">
                        <thead>
                            <tr>
                                <th>General inherent risks relevant to the area / Conclusion (Low / Med. / High) </th>
                                <th>Assertion</th>
                                <th>Specific inherent risks relevant to audit assertions / Conclusion (Low / Med. / High)</th>
                                <th>Impact on the audit including how risk has been addressed</th>
                                <th>Audit test reference</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td rowspan="5">'.$roidata['gen'].'</td>
                                <td>Existence</td>
                                <td>'.$roidata['e1'].'</td>
                                <td>'.$roidata['e2'].'</td>
                                <td>'.$roidata['e3'].'</td>
                            </tr>
                            <tr>
                                <td>Rights / Obligations</td>
                                <td>'.$roidata['ro1'].'</td>
                                <td>'.$roidata['ro2'].'</td>
                                <td>'.$roidata['ro3'].'</td>
                            </tr>
                            <tr>
                                <td>Completeness</td>
                                <td>'.$roidata['c1'].'</td>
                                <td>'.$roidata['c2'].'</td>
                                <td>'.$roidata['c3'].'</td>
                            </tr>
                            <tr>
                                <td>Valuation / Allocation</td>
                                <td>'.$roidata['va1'].'</td>
                                <td>'.$roidata['va2'].'</td>
                                <td>'.$roidata['va3'].'</td>
                            </tr>
                            <tr>
                                <td>Presentation and Disclosure</td>
                                <td>'.$roidata['pd1'].'</td>
                                <td>'.$roidata['pd2'].'</td>
                                <td>'.$roidata['pd3'].'</td>
                            </tr>
                        </tbody>
                    </table>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('L');
                $html .= $style;
                $html .= '
                    <h3>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – DIRECT COSTS / OTHER EXPENSES:</h3>
                    <table>
                        <tbody>
                            <tr>
                                <td style="width: 90%;">1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                                <td style="width: 10%;">'.$dcodata['y1'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                                <td style="width: 10%;">'.$dcodata['y2'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                                <td style="width: 10%;">'.$dcodata['y3'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                                <td style="width: 10%;">'.$dcodata['y4'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                                <td style="width: 10%;">'.$dcodata['y5'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                                <td style="width: 10%;">'.$dcodata['y6'].'</td>
                            </tr>
                        </tbody>
                    </table>
                    <p># - The use of a regulated clearing bank would not be deemed to be a service organisation for this purpose.</p>
                    <p>An answer of “Yes” to one of questions above will mean that there are potential risks associated with this area.  Other risks may also exist, and should be fully explained.</p>
                    <table border="1">
                        <thead>
                            <tr>
                                <th>General inherent risks relevant to the area / Conclusion (Low / Med. / High) </th>
                                <th>Assertion</th>
                                <th>Specific inherent risks relevant to audit assertions / Conclusion (Low / Med. / High)</th>
                                <th>Impact on the audit including how risk has been addressed</th>
                                <th>Audit test reference</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td rowspan="5">'.$dcodata['gen'].'</td>
                                <td>Existence</td>
                                <td>'.$dcodata['e1'].'</td>
                                <td>'.$dcodata['e2'].'</td>
                                <td>'.$dcodata['e3'].'</td>
                            </tr>
                            <tr>
                                <td>Rights / Obligations</td>
                                <td>'.$dcodata['ro1'].'</td>
                                <td>'.$dcodata['ro2'].'</td>
                                <td>'.$dcodata['ro3'].'</td>
                            </tr>
                            <tr>
                                <td>Completeness</td>
                                <td>'.$dcodata['c1'].'</td>
                                <td>'.$dcodata['c2'].'</td>
                                <td>'.$dcodata['c3'].'</td>
                            </tr>
                            <tr>
                                <td>Valuation / Allocation</td>
                                <td>'.$dcodata['va1'].'</td>
                                <td>'.$dcodata['va2'].'</td>
                                <td>'.$dcodata['va3'].'</td>
                            </tr>
                            <tr>
                                <td>Presentation and Disclosure</td>
                                <td>'.$dcodata['pd1'].'</td>
                                <td>'.$dcodata['pd2'].'</td>
                                <td>'.$dcodata['pd3'].'</td>
                            </tr>
                        </tbody>
                    </table>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('L');
                $html .= $style;
                $html .= '
                    <h3>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – PAYROLL:</h3>
                    <table>
                        <tbody>
                            <tr>
                                <td style="width: 90%;">1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                                <td style="width: 10%;">'.$prdata['y1'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                                <td style="width: 10%;">'.$prdata['y2'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                                <td style="width: 10%;">'.$prdata['y3'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                                <td style="width: 10%;">'.$prdata['y4'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                                <td style="width: 10%;">'.$prdata['y5'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                                <td style="width: 10%;">'.$prdata['y6'].'</td>
                            </tr>
                        </tbody>
                    </table>
                    <p># - The use of a regulated clearing bank would not be deemed to be a service organisation for this purpose.</p>
                    <p>An answer of “Yes” to one of questions above will mean that there are potential risks associated with this area.  Other risks may also exist, and should be fully explained.</p>
                    <table border="1">
                        <thead>
                            <tr>
                                <th>General inherent risks relevant to the area / Conclusion (Low / Med. / High) </th>
                                <th>Assertion</th>
                                <th>Specific inherent risks relevant to audit assertions / Conclusion (Low / Med. / High)</th>
                                <th>Impact on the audit including how risk has been addressed</th>
                                <th>Audit test reference</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td rowspan="5">'.$prdata['gen'].'</td>
                                <td>Existence</td>
                                <td>'.$prdata['e1'].'</td>
                                <td>'.$prdata['e2'].'</td>
                                <td>'.$prdata['e3'].'</td>
                            </tr>
                            <tr>
                                <td>Rights / Obligations</td>
                                <td>'.$prdata['ro1'].'</td>
                                <td>'.$prdata['ro2'].'</td>
                                <td>'.$prdata['ro3'].'</td>
                            </tr>
                            <tr>
                                <td>Completeness</td>
                                <td>'.$prdata['c1'].'</td>
                                <td>'.$prdata['c2'].'</td>
                                <td>'.$prdata['c3'].'</td>
                            </tr>
                            <tr>
                                <td>Valuation / Allocation</td>
                                <td>'.$prdata['va1'].'</td>
                                <td>'.$prdata['va2'].'</td>
                                <td>'.$prdata['va3'].'</td>
                            </tr>
                            <tr>
                                <td>Presentation and Disclosure</td>
                                <td>'.$prdata['pd1'].'</td>
                                <td>'.$prdata['pd2'].'</td>
                                <td>'.$prdata['pd3'].'</td>
                            </tr>
                        </tbody>
                    </table>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('L');
                $html .= $style;
                $html .= '
                    <h3>ASSERTION LEVEL RISK ASSESSMENT FOR INHERENT RISK – OTHER AREA:</h3>
                    <table>
                        <tbody>
                            <tr>
                                <td style="width: 90%;">1.	Have there been audit adjustments, unadjusted errors or qualifications of the audit report in this area in prior periods?</td>
                                <td style="width: 10%;">'.$oadata['y1'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">2.	Are any figures in the financial statements in this area derived from related party transactions or accounting estimates?</td>
                                <td style="width: 10%;">'.$oadata['y2'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">3.	Do any figures in the financial statements in this area require reliance on a service organisation# or expert?</td>
                                <td style="width: 10%;">'.$oadata['y3'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">4.	Have discussions with the client or preliminary analytical procedures highlighted any cause for concern in this area?</td>
                                <td style="width: 10%;">'.$oadata['y4'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">5.	Are there any concerns regarding the credit-worthiness of institutions at which accounts are held?</td>
                                <td style="width: 10%;">'.$oadata['y5'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 90%;">6.	Are there any indications that accounting policies in this area may not comply with the financial reporting framework?</td>
                                <td style="width: 10%;">'.$oadata['y6'].'</td>
                            </tr>
                        </tbody>
                    </table>
                    <p># - The use of a regulated clearing bank would not be deemed to be a service organisation for this purpose.</p>
                    <p>An answer of “Yes” to one of questions above will mean that there are potential risks associated with this area.  Other risks may also exist, and should be fully explained.</p>
                    <table border="1">
                        <thead>
                            <tr>
                                <th>General inherent risks relevant to the area / Conclusion (Low / Med. / High) </th>
                                <th>Assertion</th>
                                <th>Specific inherent risks relevant to audit assertions / Conclusion (Low / Med. / High)</th>
                                <th>Impact on the audit including how risk has been addressed</th>
                                <th>Audit test reference</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td rowspan="5">'.$oadata['gen'].'</td>
                                <td>Existence</td>
                                <td>'.$oadata['e1'].'</td>
                                <td>'.$oadata['e2'].'</td>
                                <td>'.$oadata['e3'].'</td>
                            </tr>
                            <tr>
                                <td>Rights / Obligations</td>
                                <td>'.$oadata['ro1'].'</td>
                                <td>'.$oadata['ro2'].'</td>
                                <td>'.$oadata['ro3'].'</td>
                            </tr>
                            <tr>
                                <td>Completeness</td>
                                <td>'.$oadata['c1'].'</td>
                                <td>'.$oadata['c2'].'</td>
                                <td>'.$oadata['c3'].'</td>
                            </tr>
                            <tr>
                                <td>Valuation / Allocation</td>
                                <td>'.$oadata['va1'].'</td>
                                <td>'.$oadata['va2'].'</td>
                                <td>'.$oadata['va3'].'</td>
                            </tr>
                            <tr>
                                <td>Presentation and Disclosure</td>
                                <td>'.$oadata['pd1'].'</td>
                                <td>'.$oadata['pd2'].'</td>
                                <td>'.$oadata['pd3'].'</td>
                            </tr>
                        </tbody>
                    </table>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;


            case 'AC9':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : Approval of planning',1,1);
                $html .= $style;
                $fl    = $rp->getfileinfo('c2',$wpID,$cID,$c['mtID']);
                $rdata = $rp->getvalues_s('c2','ac9data',$c['code'],$c['mtID'],$cID,$wpID);
                $ac9   = json_decode($rdata['field1'], true);
                $html .= '
                    <table>
                        <tr>
                            <td style="width: 55%;">
                                <table>
                                    <tr><td class="bb">Client: <b>'.$cl['clientname'].'</b></td></tr>
                                    <tr><td></td></tr>
                                    <tr><td class="bb">Period: <b>FY-'.$cl['financial_year'].'</b></td></tr>
                                </table>
                            </td>
                            <td style="width: 45%;">
                                <table border="1">
                                    <tr>
                                        <td>Prepared by: <br><b>'.$cl['aud'].'</b></td>
                                        <td>Date: <br><b>'; if(!empty($fl['prepared_on'])){$html .= dtformat($fl['prepared_on']);}else{$html .= '';} $html .='</b></td>
                                    </tr>
                                    <tr>
                                        <td>Reviewed by: <br><b>'.$cl['sup'].'</b></td>
                                        <td>Date: <br><b>'; if(!empty($fl['reviewed_on'])){$html .= dtformat($fl['reviewed_on']);}else{$html .= '';} $html .='</b></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <table border="1">
                        <tbody>
                            <tr>
                                <td>
                                    <b><p>CONSIDERATION OF SPECIFIC SKILLS REQUIRED FOR THIS ASSIGNMENT</p>
                                    <p>(SHOULD COVER ALL MEMBERS OF THE TEAM OTHER THAN JUNIORS, INCLUDING THE EQR)</p></b>
                                    <br><br><br><br>
                                    <p>'.$ac9['coss'].'</p>
                                    <br><br><br><br><br>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <h3>APPROVAL OF PLANNING</h3>
                    <p>The following have all been reviewed prior to the team discussions being held and the detailed audit fieldwork commencing, and this has been documented by myself as A.E.P.:</p>
                    <ul>
                        <li>Acceptance or Continuance;</li>
                        <li>Consideration of Non-Audit Services (where applicable);</li>
                        <li>Assessment of Overall Inherent Risk and the Control Environment;</li>
                        <li>Assessment of Risk in Individual Audit Areas; and</li>
                        <li>Determination of Materiality and Performance Materiality levels.</li>
                    </ul>
                    <p>Additionally, audit programmes of the working papers file have been reviewed, and I am satisfied that tailoring of these audit programmes is appropriate for the purpose of this audit.</p>
                    <table>
                        <tr>
                            <td>Planning approved by:</td>
                            <td>(A.E.P.) on </td>
                        </tr>
                    </table>
                    <h3>APPROVAL OF PLANNING BY INTERNAL EQR (IF APPLICABLE)</h3>
                    <p>I have reviewed, and this has been documented by myself as E.Q.R., the Acceptance or Continuance Form.  I have also reviewed the remaining documents set out in the bullet points above, along with this Assignment Plan, and additionally, the following:</p>
                    <ul>
                        <li>'.$ac9['aop1'].'</li>
                        <li>'.$ac9['aop2'].'</li>
                    </ul>
                    <p>I am satisfied that the proposed audit approach is appropriate for the purpose of this audit.</p>
                    <table>
                        <tr>
                            <td>Planning approved by:</td>
                            <td>(A.E.P.) on </td>
                        </tr>
                    </table>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('P');
                $html .= $style;
                $html .= '
                    <table border="1">
                        <tbody>
                            <tr>
                                <td>
                                    <p><b>BACKGROUND INFORMATION</b></p>
                                    <p>Detailed background information is included in the permanent file, the below information is just a short executive summary.</p>
                                    <p>The entity is a company [other: insert details].</p>
                                    <p>The principal activities of the entity are ['.$ac9['bipa'].'].  </p>
                                    <p>The business objectives and strategies of the entity are ['.$ac9['bibo'].'].</p>
                                    <br><br><br><br><br><br><br><br>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <br><br>
                    <table border="1">
                        <tbody>
                            <tr>
                                <td>
                                    <p><b>SIGNIFICANT FACTORS FROM PREVIOUS AUDIT AND IMPACT ON THIS PERIOD’S AUDIT</b></p>
                                    <ul>
                                        <li>Last period’s financial statements have been compared to this period’s, as part of the preliminary analytical procedures;</li>
                                        <li>If applicable, the findings of recent cold file reviews have been addressed by the planning documentation; and</li>
                                        <li>If applicable, last period’s management letter points have been reviewed and any points have been considered during this period’s risk assessment and audit approach.</li>
                                    </ul>
                                    <br><br><br>
                                    '.$ac9['sffpa'].'
                                    <br><br><br><br><br>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('P');
                $html .= $style;
                $html .= '
                    <table border="1">
                        <tbody>
                            <tr>
                                <td>
                                    <p><b>SUMMARY OF SIGNIFICANT DEVELOPMENTS DURING THE PERIOD (consideration should be given to any changes in the financial reporting framework used, as well as client specific developments.  The findings from the review of the previous audit file, PAF and other internal files such as the correspondence file, management accounts files, payroll files etc. should all be summarised)</b></p>
                                    <p><i>This should not repeat information included elsewhere.</i></p>
                                    <br><br><br>
                                    '.$ac9['sosdd'].'
                                    <br><br><br><br>
                                </td>
                            </tr>
                            <tr>
                                <td><p><b>KEY LAW AND REGULATIONS</b></p>
                                    <p><i>This should be an “Executive Summary”</i></p>
                                    <br><br><br>
                                    '.$ac9['klar'].'
                                    <br><br><br><br>
                                </td>
                            </tr>
                            <tr>
                                <td><p><b>RELATED PARTY ISSUES (Consideration should be given to any new related parties which have been identified, significant related party transactions and transfer pricing issues)</b></p>
                                    <p><i>This should be an “Executive Summary”</i></p>
                                    <br><br><br>
                                    '.$ac9['rpi'].'
                                    <br><br><br><br>
                                </td>
                            </tr>
                            <tr>
                                <td><p><b>SERVICE ORGANISATION AND EXPERTS (Consideration should be given to whether any of the figures in the financial statements are derived from the records of a service organisation or from an expert (such as a valuation service).  Where this is a case, document the audit team’s approach to these areas)</b></p>
                                    <br><br><br>
                                    '.$ac9['soae'].'
                                    <br><br><br><br>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('P');
                $html .= $style;
                $html .= '
                    <table border="1">
                        <tbody>
                            <tr>
                                <td>
                                    <p><b>AUDIT APPROACH</b></p>
                                    <p>This section should fully document the approach to be undertaken based on preliminary analytical procedures, client discussions and the risk and control environment assessments.  </p>
                                    <p>Adequate consideration has been given to experts and service organisations.</p>
                                    <p>The audit programmes to be used and key points arising during the planning are summarised below, as are the responsibilities of each team member regarding which work they are going to undertake.</p>
                                    <br><br><br>
                                    '.$ac9['aa1'].'
                                    <br><br><br><br>
                                    <p>Have the points raised above (and the risks identified in the risk assessment) been duly considered and the audit programmes sufficiently tailored to reflect these issues?</p>
                                    <br><br><br><br>
                                    '.$ac9['aa2'].'
                                    <br><br><br><br>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('P');
                $html .= $style;
                $html .= '
                    <table border="1">
                        <thead>
                            <tr>
                                <th style="width: 80%;"><b>IS THE FINANCIAL REPORTING FRAMEWORK APPROPRIATE FOR THE ENTITY, BASED ON IT’S CIRCUMSTANCES</b></th>
                                <th class="cent" style="width: 20%;"><b>YES / NO</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="1" style="width: 100%;">
                                    <p>If “no”, or the entity has changed its financial reporting framework, explain why the entity will be preparing financial statements on the basis indicated above:</p>
                                    <br><br><br>
                                    '.$ac9['frfa'].'
                                    <br><br><br>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table border="1">
                        <thead>
                            <tr>
                                <th style="width: 80%;"><b>ARE THERE ANY OTHER REPORTING REQUIREMENTS (SUCH AS TO A PARENT AUDITOR OR REGULATOR)</b></th>
                                <th class="cent" style="width: 20%;"><b>YES / NO</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="1" style="width: 100%;">
                                    <p>If “yes”, explain what these are, and the impact this will have on the scope / timing of audit work on the statutory financial statements:</p>
                                    <br><br><br>
                                    '.$ac9['orr'].'
                                    <br><br><br>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <br><br>
                    <table border="1">
                        <thead>
                            <tr>
                                <th><b>TAX SCHEDULES REQUIRED (THESE SHOULD ONLY BE PREPARED WHERE IT HAS BEEN AGREED THAT A NON-AUDIT SERVICE IS BEING PROVIDED)</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <br><br><br>
                                    '.$ac9['tsr'].'
                                    <br><br><br>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('P');
                $html .= $style;
                $html .= '
                    <table border="1">
                        <thead>
                            <tr>
                                <th style="width: 70%;"><b>ASSIGNMENT TIMETABLE</b></th>
                                <th class="cent" style="width: 30%;"><b>DATES</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="width: 70%;">Client Pre-Planning Meeting</td>
                                <td class="cent" style="width: 30%;">'.dtformat($ac9['cppm']).'</td>
                            </tr>
                            <tr>
                                <td style="width: 70%;">Inventory Count (irrespective of whether undertaken by client or 3rd party professional)</td>
                                <td class="cent" style="width: 30%;">'.dtformat($ac9['ic']).'</td>
                            </tr>
                            <tr>
                                <td style="width: 70%;">Audit Fieldwork</td>
                                <td class="cent" style="width: 30%;">'.dtformat($ac9['af']).'</td>
                            </tr>
                            <tr>
                                <td style="width: 70%;">Client Closing Meeting</td>
                                <td class="cent" style="width: 30%;">'.dtformat($ac9['ccm']).'</td>
                            </tr>
                            <tr>
                                <td style="width: 70%;">Annual General Meeting / Date of Distribution of Financial Statements to Members</td>
                                <td class="cent" style="width: 30%;">'.dtformat($ac9['agm']).'</td>
                            </tr>
                        </tbody>
                    </table>
                    <br><br>
                    <table border="1">
                        <thead>
                            <tr>
                                <th style="width: 60%;"><b>THIRD PARTY AND COUNTER PARTY CONFIRMATIONS</b></th>
                                <th class="cent" style="width: 20%;"><b>REQUIRED</b></th>
                                <th class="cent" style="width: 20%;"><b>DATE REQUESTED</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="width: 60%;">Bank Confirmation Letter</td>
                                <td class="cent" style="width: 20%;">'.$ac9['bcl1'].'</td>
                                <td class="cent" style="width: 20%;">'.dtformat($ac9['bcl2']).'</td>
                            </tr>
                            <tr>
                                <td style="width: 60%;">Independent Inventory Counter’s Report</td>
                                <td class="cent" style="width: 20%;">'.$ac9['iic1'].'</td>
                                <td class="cent" style="width: 20%;">'.dtformat($ac9['iic2']).'</td>
                            </tr>
                            <tr>
                                <td style="width: 60%;">Receivables’ Circularisation</td>
                                <td class="cent" style="width: 20%;">'.$ac9['rc1'].'</td>
                                <td class="cent" style="width: 20%;">'.dtformat($ac9['rc2']).'</td>
                            </tr>
                            <tr>
                                <td style="width: 60%;">Type 2 Report</td>
                                <td class="cent" style="width: 20%;">'.$ac9['t2r1'].'</td>
                                <td class="cent" style="width: 20%;">'.dtformat($ac9['t2r2']).'</td>
                            </tr>
                            <tr>
                                <td style="width: 60%;">Property Valuations</td>
                                <td class="cent" style="width: 20%;">'.$ac9['pv1'].'</td>
                                <td class="cent" style="width: 20%;">'.dtformat($ac9['pv2']).'</td>
                            </tr>
                            <tr>
                                <td style="width: 60%;">Valuations of Financial Instruments</td>
                                <td class="cent" style="width: 20%;">'.$ac9['vfi1'].'</td>
                                <td class="cent" style="width: 20%;">'.dtformat($ac9['vfi2']).'</td>
                            </tr>
                            <tr>
                                <td style="width: 60%;">Actuarial Valuations</td>
                                <td class="cent" style="width: 20%;">'.$ac9['av1'].'</td>
                                <td class="cent" style="width: 20%;">'.dtformat($ac9['av2']).'</td>
                            </tr>
                            <tr>
                                <td style="width: 60%;">Legal Opinions</td>
                                <td class="cent" style="width: 20%;">'.$ac9['lo1'].'</td>
                                <td class="cent" style="width: 20%;">'.dtformat($ac9['lo2']).'</td>
                            </tr>
                        </tbody>
                    </table>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;

            case 'AC10':
                $pdf->AddPage('L');
                $pdf->Bookmark($c['code'].' : Audit Approach and Sample Size Calculation',1,1);
                $html .=  "
                    <style>
                        *{
                            font-family: 'Times New Roman', Times, serif;
                            font-size: 11px;
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
                $fl    = $rp->getfileinfo('c1',$wpID,$cID,$c['mtID']);
                $html .= '
                    <table>
                        <tr>
                            <td style="width: 55%;">
                                <table>
                                    <tr><td class="bb">Client: <b>'.$cl['clientname'].'</b></td></tr>
                                    <tr><td></td></tr>
                                    <tr><td class="bb">Period: <b>FY-'.$cl['financial_year'].'</b></td></tr>
                                </table>
                            </td>
                            <td style="width: 45%;">
                                <table border="1">
                                    <tr>
                                        <td>Prepared by: <br><b>'.$cl['aud'].'</b></td>
                                        <td>Date: <br><b>'; if(!empty($fl['prepared_on'])){$html .= dtformat($fl['prepared_on']);}else{$html .= '';} $html .='</b></td>
                                    </tr>
                                    <tr>
                                        <td>Reviewed by: <br><b>'.$cl['sup'].'</b></td>
                                        <td>Date: <br><b>'; if(!empty($fl['reviewed_on'])){$html .= dtformat($fl['reviewed_on']);}else{$html .= '';} $html .='</b></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <p><b>AUDIT APPROACH AND SAMPLE SIZE CALCULATION</b></p>
                    <p><i>To complete the table below enter the risk level as per Ac6 and the materiality level as documented at Ac8. Where a different risk level is relevant for different assertions the table can be expanded as indicated on the lefthand margin. The audit approach should be selected by entering \'Y\' or \'N\' as appropriate. Where sampling is not required under the approach selected the remainder of the row will be greyed out. 
                    <br>Where substantive testing is to be undertaken document whether this will be supported by controls testing or supportive analytical procedures. For each area, enter the population and any large or key items on the appropriate supporting schedule. The residual sample size will then be automatically calculated by dividing the residual population (after large and key items) by materiality and multiplying this by the risk factor which is determined by the audit approach as documented on the reference table below.
                    <br>Where transaction testing is to be undertaken select the approximate number of transactions from the drop down. This together with the risk level entered will calculate the appropriate sample size, again based on the information on the reference table below.</i></p>
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
                        <tbody id="tbody">
                ';
                $nmk_tgb    = $rp->getdatacount($c['mtID'],'Tangibles',$cID,$wpID);
                $nmk_ppe    = $rp->getdatacount($c['mtID'],'PPE',$cID,$wpID);
                $nmk_invmt  = $rp->getdatacount($c['mtID'],'Investments',$cID,$wpID);
                $nmk_invtr  = $rp->getdatacount($c['mtID'],'Inventory',$cID,$wpID);
                $nmk_tr     = $rp->getdatacount($c['mtID'],'Trade Receivables',$cID,$wpID);
                $nmk_or     = $rp->getdatacount($c['mtID'],'Other Receivables',$cID,$wpID);
                $nmk_bac    = $rp->getdatacount($c['mtID'],'Bank and Cash',$cID,$wpID);
                $nmk_tp     = $rp->getdatacount($c['mtID'],'Trade Payables',$cID,$wpID);
                $nmk_op     = $rp->getdatacount($c['mtID'],'Other Payables',$cID,$wpID);
                $nmk_prov   = $rp->getdatacount($c['mtID'],'Provisions',$cID,$wpID);
                $nmk_rev    = $rp->getdatacount($c['mtID'],'Revenue',$cID,$wpID);
                $nmk_cst    = $rp->getdatacount($c['mtID'],'Costs',$cID,$wpID);
                $nmk_pr     = $rp->getdatacount($c['mtID'],'Payroll',$cID,$wpID);
                $vop_tgb    = $rp->getsumation($c['mtID'],'Tangibles',$cID,$wpID);
                $vop_ppe    = $rp->getsumation($c['mtID'],'PPE',$cID,$wpID);
                $vop_invmt  = $rp->getsumation($c['mtID'],'Investments',$cID,$wpID);
                $vop_invtr  = $rp->getsumation($c['mtID'],'Inventory',$cID,$wpID);
                $vop_tr     = $rp->getsumation($c['mtID'],'Trade Receivables',$cID,$wpID);
                $vop_or     = $rp->getsumation($c['mtID'],'Other Receivables',$cID,$wpID);
                $vop_bac    = $rp->getsumation($c['mtID'],'Bank and Cash',$cID,$wpID);
                $vop_tp     = $rp->getsumation($c['mtID'],'Trade Payables',$cID,$wpID);
                $vop_op     = $rp->getsumation($c['mtID'],'Other Payables',$cID,$wpID);
                $vop_prov   = $rp->getsumation($c['mtID'],'Provisions',$cID,$wpID);
                $vop_rev    = $rp->getsumation($c['mtID'],'Revenue',$cID,$wpID);
                $vop_cst    = $rp->getsumation($c['mtID'],'Costs',$cID,$wpID);
                $vop_pr     = $rp->getsumation($c['mtID'],'Payroll',$cID,$wpID);
                $mat        = $rp->getsummarydata($c['mtID'],'material',$cID,$wpID);
                $rowdata            = ['tgb','ppe','invmt','invtr','tr','or','bac','tp','op','prov','rev','cst','pr'];
                foreach($rowdata as $row){
                    $rdata          = $rp->getsummarydata($c['mtID'], $row,$cID,$wpID);
                    $data[$row]     = json_decode($rdata['field1'], true);
                }
                    $html .='
                            <tr>
                                <td style="width: 10%;">Intangible Assets</td>
                                <td style="width: 10%;">All</td>
                                <td style="width: 7%;">';
                                switch ($data['tgb']['tgb_rpac10']) {
                                    case '1.2':$html .= 'Low';break;
                                    case '1.8':$html .= 'Medium';break;
                                    case '2.5':$html .= 'High';break;
                                    default:break;
                                }
                    $html .= '
                                </td>
                                <td style="width: 5%;">'.$data['tgb']['tgb_i'].'</td>
                                <td style="width: 5%;">'.$data['tgb']['tgb_p'].'</td>
                                <td style="width: 5%;">'.$data['tgb']['tgb_pcnt'].'</td>
                                <td style="width: 5%;">'.$data['tgb']['tgb_s'].'</td>
                                <td style="width: 5%;">'.$data['tgb']['tgb_t'].'</td>
                                <td style="width: 5%;">';
                                    switch ($data['tgb']['tgb_ctrf']) {
                                        case '0.5':$html .= 'Yes';break;
                                        case '1':$html .= 'No';break;
                                        default:break;
                                    }
                    $html .='   </td>
                                <td style="width: 5%;">';
                                    switch ($data['tgb']['tgb_arf']) {
                                        case '0.67':$html .='Yes';break;
                                        case '1':$html .='No';break;
                                        default:break;
                                    }
                    $html .='   </td>
                                <td style="width: 5%;">'.$data['tgb']['tgb_rf'].'</td>
                                <td style="width: 5%;">'.$vop_tgb.'</td>
                                <td style="width: 5%;">'.$data['tgb']['tgb_secref'].'</td>
                                <td style="width: 5%;">'.$data['tgb']['tgb_rss'].'</td>
                                <td style="width: 5%;">'.$nmk_tgb.'</td>
                                <td style="width: 5%;">'.$data['tgb']['tgb_ant'].'</td>
                                <td style="width: 5%;">'.$data['tgb']['tgb_tss'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 10%;">PPE</td>
                                <td style="width: 10%;">All</td>
                                <td style="width: 7%;">';
                                switch ($data['ppe']['ppe_rpac10']) {
                                    case '1.2':$html .= 'Low';break;
                                    case '1.8':$html .= 'Medium';break;
                                    case '2.5':$html .= 'High';break;
                                    default:break;
                                }
                    $html .= '
                                </td>
                                <td style="width: 5%;">'.$data['ppe']['ppe_i'].'</td>
                                <td style="width: 5%;">'.$data['ppe']['ppe_p'].'</td>
                                <td style="width: 5%;">'.$data['ppe']['ppe_pcnt'].'</td>
                                <td style="width: 5%;">'.$data['ppe']['ppe_s'].'</td>
                                <td style="width: 5%;">'.$data['ppe']['ppe_t'].'</td>
                                <td style="width: 5%;">';
                                    switch ($data['ppe']['ppe_ctrf']) {
                                        case '0.5':$html .= 'Yes';break;
                                        case '1':$html .= 'No';break;
                                        default:break;
                                    }
                    $html .='   </td>
                                <td style="width: 5%;">';
                                    switch ($data['ppe']['ppe_arf']) {
                                        case '0.67':$html .='Yes';break;
                                        case '1':$html .='No';break;
                                        default:break;
                                    }
                    $html .='   </td>
                                <td style="width: 5%;">'.$data['ppe']['ppe_rf'].'</td>
                                <td style="width: 5%;">'.$vop_ppe.'</td>
                                <td style="width: 5%;">'.$data['ppe']['ppe_secref'].'</td>
                                <td style="width: 5%;">'.$data['ppe']['ppe_rss'].'</td>
                                <td style="width: 5%;">'.$nmk_ppe.'</td>
                                <td style="width: 5%;">'.$data['ppe']['ppe_ant'].'</td>
                                <td style="width: 5%;">'.$data['ppe']['ppe_tss'].'</td>
                            </tr> 
                            <tr>
                                <td style="width: 10%;">Investments</td>
                                <td style="width: 10%;">All</td>
                                <td style="width: 7%;">';
                                switch ($data['invmt']['invmt_rpac10']) {
                                    case '1.2':$html .= 'Low';break;
                                    case '1.8':$html .= 'Medium';break;
                                    case '2.5':$html .= 'High';break;
                                    default:break;
                                }
                    $html .= '
                                </td>
                                <td style="width: 5%;">'.$data['invmt']['invmt_i'].'</td>
                                <td style="width: 5%;">'.$data['invmt']['invmt_p'].'</td>
                                <td style="width: 5%;">'.$data['invmt']['invmt_pcnt'].'</td>
                                <td style="width: 5%;">'.$data['invmt']['invmt_s'].'</td>
                                <td style="width: 5%;">'.$data['invmt']['invmt_t'].'</td>
                                <td style="width: 5%;">';
                                    switch ($data['invmt']['invmt_ctrf']) {
                                        case '0.5':$html .= 'Yes';break;
                                        case '1':$html .= 'No';break;
                                        default:break;
                                    }
                    $html .='   
                                </td>
                                <td style="width: 5%;">';
                                    switch ($data['invmt']['invmt_arf']) {
                                        case '0.67':$html .='Yes';break;
                                        case '1':$html .='No';break;
                                        default:break;
                                    }
                    $html .='   
                                </td>
                                <td style="width: 5%;">'.$data['invmt']['invmt_rf'].'</td>
                                <td style="width: 5%;">'.$vop_invmt.'</td>
                                <td style="width: 5%;">'.$data['invmt']['invmt_secref'].'</td>
                                <td style="width: 5%;">'.$data['invmt']['invmt_rss'].'</td>
                                <td style="width: 5%;">'.$nmk_invmt.'</td>
                                <td style="width: 5%;">'.$data['invmt']['invmt_ant'].'</td>
                                <td style="width: 5%;">'.$data['invmt']['invmt_tss'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 10%;">Inventories</td>
                                <td style="width: 10%;">All</td>
                                <td style="width: 7%;">';
                                switch ($data['invtr']['invtr_rpac10']) {
                                    case '1.2':$html .= 'Low';break;
                                    case '1.8':$html .= 'Medium';break;
                                    case '2.5':$html .= 'High';break;
                                    default:break;
                                }
                    $html .= '
                                </td>
                                <td style="width: 5%;">'.$data['invtr']['invtr_i'].'</td>
                                <td style="width: 5%;">'.$data['invtr']['invtr_p'].'</td>
                                <td style="width: 5%;">'.$data['invtr']['invtr_pcnt'].'</td>
                                <td style="width: 5%;">'.$data['invtr']['invtr_s'].'</td>
                                <td style="width: 5%;">'.$data['invtr']['invtr_t'].'</td>
                                <td style="width: 5%;">';
                                    switch ($data['invtr']['invtr_ctrf']) {
                                        case '0.5':$html .= 'Yes';break;
                                        case '1':$html .= 'No';break;
                                        default:break;
                                    }
                    $html .='   
                                </td>
                                <td style="width: 5%;">';
                                    switch ($data['invtr']['invtr_arf']) {
                                        case '0.67':$html .='Yes';break;
                                        case '1':$html .='No';break;
                                        default:break;
                                    }
                    $html .='   
                                </td>
                                <td style="width: 5%;">'.$data['invtr']['invtr_rf'].'</td>
                                <td style="width: 5%;">'.$vop_invtr.'</td>
                                <td style="width: 5%;">'.$data['invtr']['invtr_secref'].'</td>
                                <td style="width: 5%;">'.$data['invtr']['invtr_rss'].'</td>
                                <td style="width: 5%;">'.$nmk_invtr.'</td>
                                <td style="width: 5%;">'.$data['invtr']['invtr_ant'].'</td>
                                <td style="width: 5%;">'.$data['invtr']['invtr_tss'].'</td>
                            </tr>
                            <tr>
                                <td style="width: 10%;">Trade Receivables</td>
                                <td style="width: 10%;">All</td>
                                <td style="width: 7%;">';
                                switch ($data['tr']['tr_rpac10']) {
                                    case '1.2':$html .= 'Low';break;
                                    case '1.8':$html .= 'Medium';break;
                                    case '2.5':$html .= 'High';break;
                                    default:break;
                                }
                    $html .= '
                                </td>
                                <td style="width: 5%;">'.$data['tr']['tr_i'].'</td>
                                <td style="width: 5%;">'.$data['tr']['tr_p'].'</td>
                                <td style="width: 5%;">'.$data['tr']['tr_pcnt'].'</td>
                                <td style="width: 5%;">'.$data['tr']['tr_s'].'</td>
                                <td style="width: 5%;">'.$data['tr']['tr_t'].'</td>
                                <td style="width: 5%;">';
                                    switch ($data['tr']['tr_ctrf']) {
                                        case '0.5':$html .= 'Yes';break;
                                        case '1':$html .= 'No';break;
                                        default:break;
                                    }
                    $html .='   
                                </td>
                                <td style="width: 5%;">';
                                    switch ($data['tr']['tr_arf']) {
                                        case '0.67':$html .='Yes';break;
                                        case '1':$html .='No';break;
                                        default:break;
                                    }
                    $html .='   
                            </td>
                            <td style="width: 5%;">'.$data['tr']['tr_rf'].'</td>
                            <td style="width: 5%;">'.$vop_tr.'</td>
                            <td style="width: 5%;">'.$data['tr']['tr_secref'].'</td>
                            <td style="width: 5%;">'.$data['tr']['tr_rss'].'</td>
                            <td style="width: 5%;">'.$nmk_tr.'</td>
                            <td style="width: 5%;">'.$data['tr']['tr_ant'].'</td>
                            <td style="width: 5%;">'.$data['tr']['tr_tss'].'</td>
                        </tr>
                        <tr>
                            <td style="width: 10%;">All Other Receivables</td>
                            <td style="width: 10%;">All</td>
                            <td style="width: 7%;">';
                            switch ($data['or']['or_rpac10']) {
                                case '1.2':$html .= 'Low';break;
                                case '1.8':$html .= 'Medium';break;
                                case '2.5':$html .= 'High';break;
                                default:break;
                            }
                    $html .= '  
                            </td>
                            <td style="width: 5%;">'.$data['or']['or_i'].'</td>
                            <td style="width: 5%;">'.$data['or']['or_p'].'</td>
                            <td style="width: 5%;">'.$data['or']['or_pcnt'].'</td>
                            <td style="width: 5%;">'.$data['or']['or_s'].'</td>
                            <td style="width: 5%;">'.$data['or']['or_t'].'</td>
                            <td style="width: 5%;">';
                                switch ($data['or']['or_ctrf']) {
                                    case '0.5':$html .= 'Yes';break;
                                    case '1':$html .= 'No';break;
                                    default:break;
                                }
                    $html .='   
                            </td>
                            <td style="width: 5%;">';
                                switch ($data['or']['or_arf']) {
                                    case '0.67':$html .='Yes';break;
                                    case '1':$html .='No';break;
                                    default:break;
                                }
                    $html .='   
                            </td>
                            <td style="width: 5%;">'.$data['or']['or_rf'].'</td>
                            <td style="width: 5%;">'.$vop_or.'</td>
                            <td style="width: 5%;">'.$data['or']['or_secref'].'</td>
                            <td style="width: 5%;">'.$data['or']['or_rss'].'</td>
                            <td style="width: 5%;">'.$nmk_or.'</td>
                            <td style="width: 5%;">'.$data['or']['or_ant'].'</td>
                            <td style="width: 5%;">'.$data['or']['or_tss'].'</td>
                        </tr>
                        <tr>
                            <td style="width: 10%;">Bank and Cash</td>
                            <td style="width: 10%;">All</td>
                            <td style="width: 7%;">';
                            switch ($data['bac']['bac_rpac10']) {
                                case '1.2':$html .= 'Low';break;
                                case '1.8':$html .= 'Medium';break;
                                case '2.5':$html .= 'High';break;
                                default:break;
                            }
                    $html .= '  
                            </td>
                            <td style="width: 5%;">'.$data['bac']['bac_i'].'</td>
                            <td style="width: 5%;">'.$data['bac']['bac_p'].'</td>
                            <td style="width: 5%;">'.$data['bac']['bac_pcnt'].'</td>
                            <td style="width: 5%;">'.$data['bac']['bac_s'].'</td>
                            <td style="width: 5%;">'.$data['bac']['bac_t'].'</td>
                            <td style="width: 5%;">';
                                switch ($data['bac']['bac_ctrf']) {
                                    case '0.5':$html .= 'Yes';break;
                                    case '1':$html .= 'No';break;
                                    default:break;
                                }
                    $html .='   
                            </td>
                            <td style="width: 5%;">';
                                switch ($data['bac']['bac_arf']) {
                                    case '0.67':$html .='Yes';break;
                                    case '1':$html .='No';break;
                                    default:break;
                                }
                    $html .='   
                            </td>
                            <td style="width: 5%;">'.$data['bac']['bac_rf'].'</td>
                            <td style="width: 5%;">'.$vop_bac.'</td>
                            <td style="width: 5%;">'.$data['bac']['bac_secref'].'</td>
                            <td style="width: 5%;">'.$data['bac']['bac_rss'].'</td>
                            <td style="width: 5%;">'.$nmk_bac.'</td>
                            <td style="width: 5%;">'.$data['bac']['bac_ant'].'</td>
                            <td style="width: 5%;">'.$data['bac']['bac_tss'].'</td>
                        </tr>
                        <tr>
                            <td style="width: 10%;">Trade Payables</td>
                            <td style="width: 10%;">All</td>
                            <td style="width: 7%;">';
                            switch ($data['tp']['tp_rpac10']) {
                                case '1.2':$html .= 'Low';break;
                                case '1.8':$html .= 'Medium';break;
                                case '2.5':$html .= 'High';break;
                                default:break;
                            }
                    $html .= '
                            </td>
                            <td style="width: 5%;">'.$data['tp']['tp_i'].'</td>
                            <td style="width: 5%;">'.$data['tp']['tp_p'].'</td>
                            <td style="width: 5%;">'.$data['tp']['tp_pcnt'].'</td>
                            <td style="width: 5%;">'.$data['tp']['tp_s'].'</td>
                            <td style="width: 5%;">'.$data['tp']['tp_t'].'</td>
                            <td style="width: 5%;">';
                                switch ($data['tp']['tp_ctrf']) {
                                    case '0.5':$html .= 'Yes';break;
                                    case '1':$html .= 'No';break;
                                    default:break;
                                }
                    $html .='   
                            </td>
                            <td style="width: 5%;">';
                                switch ($data['tp']['tp_arf']) {
                                    case '0.67':$html .='Yes';break;
                                    case '1':$html .='No';break;
                                    default:break;
                                }
                    $html .='   
                            </td>
                            <td style="width: 5%;">'.$data['tp']['tp_rf'].'</td>
                            <td style="width: 5%;">'.$vop_tp.'</td>
                            <td style="width: 5%;">'.$data['tp']['tp_secref'].'</td>
                            <td style="width: 5%;">'.$data['tp']['tp_rss'].'</td>
                            <td style="width: 5%;">'.$nmk_tp.'</td>
                            <td style="width: 5%;">'.$data['tp']['tp_ant'].'</td>
                            <td style="width: 5%;">'.$data['tp']['tp_tss'].'</td>
                        </tr>
                        <tr>
                            <td style="width: 10%;">All Other Payables</td>
                            <td style="width: 10%;">All</td>
                            <td style="width: 7%;">';
                            switch ($data['op']['op_rpac10']) {
                                case '1.2':$html .= 'Low';break;
                                case '1.8':$html .= 'Medium';break;
                                case '2.5':$html .= 'High';break;
                                default:break;
                            }
                    $html .= '
                            </td>
                            <td style="width: 5%;">'.$data['op']['op_i'].'</td>
                            <td style="width: 5%;">'.$data['op']['op_p'].'</td>
                            <td style="width: 5%;">'.$data['op']['op_pcnt'].'</td>
                            <td style="width: 5%;">'.$data['op']['op_s'].'</td>
                            <td style="width: 5%;">'.$data['op']['op_t'].'</td>
                            <td style="width: 5%;">';
                                switch ($data['op']['op_ctrf']) {
                                    case '0.5':$html .= 'Yes';break;
                                    case '1':$html .= 'No';break;
                                    default:break;
                                }
                    $html .='   
                            </td>
                            <td style="width: 5%;">';
                                switch ($data['op']['op_arf']) {
                                    case '0.67':$html .='Yes';break;
                                    case '1':$html .='No';break;
                                    default:break;
                                }
                    $html .='   
                            </td>
                            <td style="width: 5%;">'.$data['op']['op_rf'].'</td>
                            <td style="width: 5%;">'.$vop_op.'</td>
                            <td style="width: 5%;">'.$data['op']['op_secref'].'</td>
                            <td style="width: 5%;">'.$data['op']['op_rss'].'</td>
                            <td style="width: 5%;">'.$nmk_op.'</td>
                            <td style="width: 5%;">'.$data['op']['op_ant'].'</td>
                            <td style="width: 5%;">'.$data['op']['op_tss'].'</td>
                        </tr>
                        <tr>
                            <td style="width: 10%;">Provisions</td>
                            <td style="width: 10%;">All</td>
                            <td style="width: 7%;">';
                            switch ($data['prov']['prov_rpac10']) {
                                case '1.2':$html .= 'Low';break;
                                case '1.8':$html .= 'Medium';break;
                                case '2.5':$html .= 'High';break;
                                default:break;
                            }
                    $html .= '
                            </td>
                            <td style="width: 5%;">'.$data['prov']['prov_i'].'</td>
                            <td style="width: 5%;">'.$data['prov']['prov_p'].'</td>
                            <td style="width: 5%;">'.$data['prov']['prov_pcnt'].'</td>
                            <td style="width: 5%;">'.$data['prov']['prov_s'].'</td>
                            <td style="width: 5%;">'.$data['prov']['prov_t'].'</td>
                            <td style="width: 5%;">';
                                switch ($data['prov']['prov_ctrf']) {
                                    case '0.5':$html .= 'Yes';break;
                                    case '1':$html .= 'No';break;
                                    default:break;
                                }
                    $html .='   
                            </td>
                            <td style="width: 5%;">';
                                switch ($data['prov']['prov_arf']) {
                                    case '0.67':$html .='Yes';break;
                                    case '1':$html .='No';break;
                                    default:break;
                                }
                    $html .='   
                            </td>
                            <td style="width: 5%;">'.$data['prov']['prov_rf'].'</td>
                            <td style="width: 5%;">'.$vop_prov.'</td>
                            <td style="width: 5%;">'.$data['prov']['prov_secref'].'</td>
                            <td style="width: 5%;">'.$data['prov']['prov_rss'].'</td>
                            <td style="width: 5%;">'.$nmk_prov.'</td>
                            <td style="width: 5%;">'.$data['prov']['prov_ant'].'</td>
                            <td style="width: 5%;">'.$data['prov']['prov_tss'].'</td>
                        </tr>
                        <tr>
                            <td colspan="17"></td>
                        </tr>
                        <tr>
                            <td style="width: 10%;">Revenue</td>
                            <td style="width: 10%;">All</td>
                            <td style="width: 7%;">';
                            switch ($data['rev']['rev_rpac10']) {
                                case '1.2':$html .= 'Low';break;
                                case '1.8':$html .= 'Medium';break;
                                case '2.5':$html .= 'High';break;
                                default:break;
                            }
                    $html .= '
                            </td>
                            <td style="width: 5%;">'.$data['rev']['rev_i'].'</td>
                            <td style="width: 5%;">'.$data['rev']['rev_p'].'</td>
                            <td style="width: 5%;">'.$data['rev']['rev_pcnt'].'</td>
                            <td style="width: 5%;">'.$data['rev']['rev_s'].'</td>
                            <td style="width: 5%;">'.$data['rev']['rev_t'].'</td>
                            <td style="width: 5%;">';
                                switch ($data['rev']['rev_ctrf']) {
                                    case '0.5':$html .= 'Yes';break;
                                    case '1':$html .= 'No';break;
                                    default:break;
                                }
                    $html .='   
                            </td>
                            <td style="width: 5%;">';
                                switch ($data['rev']['rev_arf']) {
                                    case '0.67':$html .='Yes';break;
                                    case '1':$html .='No';break;
                                    default:break;
                                }
                    $html .='   
                            </td>
                            <td style="width: 5%;">'.$data['rev']['rev_rf'].'</td>
                            <td style="width: 5%;">'.$vop_rev.'</td>
                            <td style="width: 5%;">'.$data['rev']['rev_secref'].'</td>
                            <td style="width: 5%;">'.$data['rev']['rev_rss'].'</td>
                            <td style="width: 5%;">'.$nmk_rev.'</td>
                            <td style="width: 5%;">'.$data['rev']['rev_ant'].'</td>
                            <td style="width: 5%;">'.$data['rev']['rev_tss'].'</td>
                        </tr>
                        <tr>
                            <td style="width: 10%;">Costs</td>
                            <td style="width: 10%;">All</td>
                            <td style="width: 7%;">';
                            switch ($data['cst']['cst_rpac10']) {
                                case '1.2':$html .= 'Low';break;
                                case '1.8':$html .= 'Medium';break;
                                case '2.5':$html .= 'High';break;
                                default:break;
                            }
                    $html .= '
                            </td>
                            <td style="width: 5%;">'.$data['cst']['cst_i'].'</td>
                            <td style="width: 5%;">'.$data['cst']['cst_p'].'</td>
                            <td style="width: 5%;">'.$data['cst']['cst_pcnt'].'</td>
                            <td style="width: 5%;">'.$data['cst']['cst_s'].'</td>
                            <td style="width: 5%;">'.$data['cst']['cst_t'].'</td>
                            <td style="width: 5%;">';
                                switch ($data['cst']['cst_ctrf']) {
                                    case '0.5':$html .= 'Yes';break;
                                    case '1':$html .= 'No';break;
                                    default:break;
                                }
                    $html .='   
                            </td>
                            <td style="width: 5%;">';
                                switch ($data['cst']['cst_arf']) {
                                    case '0.67':$html .='Yes';break;
                                    case '1':$html .='No';break;
                                    default:break;
                                }
                    $html .='   
                            </td>
                            <td style="width: 5%;">'.$data['cst']['cst_rf'].'</td>
                            <td style="width: 5%;">'.$vop_cst.'</td>
                            <td style="width: 5%;">'.$data['cst']['cst_secref'].'</td>
                            <td style="width: 5%;">'.$data['cst']['cst_rss'].'</td>
                            <td style="width: 5%;">'.$nmk_cst.'</td>
                            <td style="width: 5%;">'.$data['cst']['cst_ant'].'</td>
                            <td style="width: 5%;">'.$data['cst']['cst_tss'].'</td>
                        </tr>
                        <tr>
                            <td style="width: 10%;">Payroll</td>
                            <td style="width: 10%;">All</td>
                            <td style="width: 7%;">';
                            switch ($data['pr']['pr_rpac10']) {
                                case '1.2':$html .= 'Low';break;
                                case '1.8':$html .= 'Medium';break;
                                case '2.5':$html .= 'High';break;
                                default:break;
                            }
                    $html .= '
                            </td>
                            <td style="width: 5%;">'.$data['pr']['pr_i'].'</td>
                            <td style="width: 5%;">'.$data['pr']['pr_p'].'</td>
                            <td style="width: 5%;">'.$data['pr']['pr_pcnt'].'</td>
                            <td style="width: 5%;">'.$data['pr']['pr_s'].'</td>
                            <td style="width: 5%;">'.$data['pr']['pr_t'].'</td>
                            <td style="width: 5%;">';
                                switch ($data['pr']['pr_ctrf']) {
                                    case '0.5':$html .= 'Yes';break;
                                    case '1':$html .= 'No';break;
                                    default:break;
                                }
                    $html .='   
                            </td>
                            <td style="width: 5%;">';
                                switch ($data['pr']['pr_arf']) {
                                    case '0.67':$html .='Yes';break;
                                    case '1':$html .='No';break;
                                    default:break;
                                }
                    $html .='   
                            </td>
                            <td style="width: 5%;">'.$data['pr']['pr_rf'].'</td>
                            <td style="width: 5%;">'.$vop_pr.'</td>
                            <td style="width: 5%;">'.$data['pr']['pr_secref'].'</td>
                            <td style="width: 5%;">'.$data['pr']['pr_rss'].'</td>
                            <td style="width: 5%;">'.$nmk_pr.'</td>
                            <td style="width: 5%;">'.$data['pr']['pr_ant'].'</td>
                            <td style="width: 5%;">'.$data['pr']['pr_tss'].'</td>
                        </tr>
                    </tbody>   
                </table>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('L');
                $html .= $style;
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

                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;

            case 'AC11':
                $pdf->AddPage('P');
                $pdf->Bookmark($c['code'].' : Team discussions and briefing meeting',1,1);
                $html  .= $style;
                $rdata  = $rp->getvalues_s('c1','ac11data',$c['code'],$c['mtID'],$cID,$wpID);
                $ac11   = json_decode($rdata['question'], true);
                $html  .= '
                    <table>
                        <tr>
                            <td style="width: 60%;">
                                <table>
                                    <tr><td class="bb">Client: <b>'.$cl['clientname'].'</b></td></tr>
                                    <tr><td></td></tr>
                                    <tr><td class="bb">Period: <b>FY-'.$cl['financial_year'].'</b></td></tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                ';
                $space = $pdf->Ln(10);
                $html .= '
                    <h3>TEAM DISCUSSIONS AND BRIEFING MEETING</h3>
                    <p><b>Objective:</b> <br>To document a team discussion covering fraud and risk as required by PSA 240, 315 and 550 and to demonstrate that an adequate staff briefing has occurred.</p>
                    <table>
                        <tr>
                            <td style="width: 20%;">
                                <b>Date of meeting:</b>
                            </td>
                            <td class="bo" style="width: 80%;">
                                '.dtformat($ac11['datem']).'
                            </td>
                        </tr>
                    </table>
                    <p><b>Details of the assignment team:</b></p>
                    <table border="1">
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
                                <td><br>A.E.P.<br></td>
                                <td><br>'.$ac11['ape1'].'<br></td>
                                <td><br>'.$ac11['ape2'].'<br></td>
                                <td><br>'.$ac11['ape3'].'<br></td>
                            </tr>
                            <tr>
                                <td><br>Internal EQR<br></td>
                                <td><br>'.$ac11['ieqr1'].'<br></td>
                                <td><br>'.$ac11['ieqr2'].'<br></td>
                                <td><br>'.$ac11['ieqr3'].'<br></td>
                            </tr>
                            <tr>
                                <td><br>Manager<br></td>
                                <td><br>'.$ac11['mngr1'].'<br></td>
                                <td><br>'.$ac11['mngr2'].'<br></td>
                                <td><br>'.$ac11['mngr3'].'<br></td>
                            </tr>
                            <tr>
                                <td><br>Supervisor<br></td>
                                <td><br>'.$ac11['sup1'].'<br></td>
                                <td><br>'.$ac11['sup2'].'<br></td>
                                <td><br>'.$ac11['sup3'].'<br></td>
                            </tr>
                            <tr>
                                <td><br>Senior<br></td>
                                <td><br>'.$ac11['sr1'].'<br></td>
                                <td><br>'.$ac11['sr2'].'<br></td>
                                <td><br>'.$ac11['sr3'].'<br></td>
                            </tr>
                            <tr>
                                <td><br>Junior<br></td>
                                <td><br>'.$ac11['jra1'].'<br></td>
                                <td><br>'.$ac11['jra2'].'<br></td>
                                <td><br>'.$ac11['jra3'].'<br></td>
                            </tr>
                            <tr>
                                <td><br>Junior<br></td>
                                <td><br>'.$ac11['jrb1'].'<br></td>
                                <td><br>'.$ac11['jrb2'].'<br></td>
                                <td><br>'.$ac11['jrb3'].'<br></td>
                            </tr>
                        </tbody>
                    </table>
                    <p><i>* Prior to initialling this column all staff should review the assignment plan, assessment of materiality & risk and systems notes.</i></p>
                    <p><i>The team discussions on fraud, risk and related party transactions should be chaired by the A.E.P. (although the general briefing can be performed by another team member, i.e. the manager) and it should be undertaken ensuring that, when considering fraud, professional scepticism is applied. <u><b>Team members should set aside the belief that the client is honest and acts with integrity.</b></u></i></p>
                    <p><i>Where junior staff are briefed separately, this should be clearly documented.</i></p>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
                $pdf->AddPage('L');
                $html .= $style;
                $html .= '
                    <table border="1">
                    <thead>
                        <tr>
                            <th colspan="2"><b>Detailed consideration of fraud, risk and related party transactions</b></th>
                        </tr>
                    </thead>
                        <tbody>
                            <tr>
                                <td colspan="2">Scope of discussion (add additional points as appropriate) ~ note that all points should be discussed, and key issues highlighted below:</td>
                            </tr>
                            <tr>
                                <td style="width: 50%;">1.	The areas within the accounting system where error or fraud are most likely to occur (consideration must specifically be given to earnings management);</td>
                                <td>'.$ac11['dcfrrt1'].'</td>
                            </tr>
                            <tr>
                                <td>2.	How a fraud could be carried out by either management or employees (special consideration should be given to accounting estimates);</td>
                                <td>'.$ac11['dcfrrt2'].'</td>
                            </tr>
                            <tr>
                                <td>3.	How a fraud could be carried out by, or in conjunction with the entity’s related parties (including where transactions are not undertaken on an arm’s length basis);</td>
                                <td>'.$ac11['dcfrrt3'].'</td>
                            </tr>
                            <tr>
                                <td>4.	How a fraud could be carried out by customers or suppliers;</td>
                                <td>'.$ac11['dcfrrt4'].'</td>
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
                                <td>'.$ac11['dcfrrt5'].'</td>
                            </tr>
                            <tr>
                                <td colspan="2">Scope of discussion (add additional points as appropriate) ~ note that all points should be discussed, and key issues highlighted below:</td>
                            </tr>
                            <tr>
                                <td>6.	What controls are in place in relation to cash (or assets that can be easily converted to cash) and the employees involved in this area;</td>
                                <td>'.$ac11['dcfrrt6'].'</td>
                            </tr>
                            <tr>
                                <td>7.	Where consolidated financial statements are prepared the risk of fraud in subsidiaries, associates, joint ventures and during the consolidation process;</td>
                                <td>'.$ac11['dcfrrt7'].'</td>
                            </tr>
                            <tr>
                                <td>8.	How any changes in senior management or shareholders during, or since the end of the period could cause a potential risk factor which needs to be approached with “professional scepticism”.</td>
                                <td>'.$ac11['dcfrrt8'].'</td>
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
                                <td>'.$ac11['dcfrrt9'].'</td>
                            </tr>
                        </tbody>
                    </table>
                    <br><br><br>
                    <table border="1">
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
                                <td>1.	All staff are aware of: </td>
                            </tr>
                            <tr>
                                <td>- The need to report suspicions of money laundering internally, where required by legislation;</td>
                                <td>'.$ac11['sacb1'].'</td>
                            </tr>
                            <tr>
                                <td>- That any issues (actual or possible), including matters relating to independence which, had they been known earlier, would have caused the firm to decline the appointment should be notified to the A.E.P. immediately;</td>
                                <td>'.$ac11['sacb2'].'</td>
                            </tr>
                            <tr>
                                <td>- The main indicators for this client that the going concern assumption could be in doubt and if such issues are identified, these should be highlighted to the A.E.P. promptly;</td>
                                <td>'.$ac11['sacb3'].'</td>
                            </tr>
                            <tr>
                                <td>- That if new related parties are identified, these must be communicated immediately to all members of the audit team;</td>
                                <td>'.$ac11['sacb4'].'</td>
                            </tr>
                            <tr>
                                <td>2.	The responsibilities of team members have been clarified and documented at Ac14;</td>
                                <td>'.$ac11['sacb5'].'</td>
                            </tr>
                            <tr>
                                <td>3.	A detailed briefing regarding the client (including; objectives, structure and activities);</td>
                                <td>'.$ac11['sacb6'].'</td>
                            </tr>
                            <tr>
                                <td>4.	The risk areas as identified from the risk assessment and how additional work on these areas are incorporated into the audit approach;</td>
                                <td>'.$ac11['sacb7'].'</td>
                            </tr>
                            <tr>
                                <td>5.	How can unpredictability be incorporated into the audit approach to maximise the chance of fraudulent transactions being identified (e.g. which procedure will involve random / haphazard testing etc.);</td>
                                <td>'.$ac11['sacb8'].'</td>
                            </tr>
                            <tr>
                                <td>6.	Timing of review procedures have been discussed and it has been documented who has responsibility to review which areas.</td>
                                <td>'.$ac11['sacb9'].'</td>
                            </tr>
                        </tbody>
                    </table>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;
        }
    }


    /**
        ----------------------------------------------------------
        WORKPAPER PDF GENERATOR
        ---------------------------------------------------------- 
    */
    $pdf->AddPage('P');
    $pdf->Bookmark('Work Paper',0,0);
    $html .= '<br><br><br><br><br><br><br><hr style="color:blue;">';
    $html .= '<h1 style="color:#7752FE;text-align:center;">WORK PAPER</h1>';
    $html .= '<hr style="color:blue;">';
    $pdf->writeHTML($html, true, false,false, false, '');
    $html = '';
    foreach($fi as $f){
        switch ($f['section']) {

            case 'FSTR':
                $pdf->AddPage('P');
                $pdf->Bookmark($f['section'].' : '.$f['desc'],1,1);
                $html .= $style2;
                $html .= '<hr style="color:blue;">';
                $html .= '<h2 style="color:#7752FE;">'.$f['section'].': '.$f['desc'].'</h2><br><br>';
                $html .= '<br><h5 style="color:white; background-color:#8E8FFA">Documents</h5><br><br>';
                $html .= '
                    <br> 
                    <table>
                        <tr>
                            <td>
                                <br>
                                <ul><b>1st Quarter</b>
                                    <li>EWT: <b>'.$q1e.'</b></li>
                                    <li>VAT: <b>'.$q1v.'</b></li>
                                    <li>1601C: <b>'.$q16.'</b></li>
                                    <li>1701/2: <b>'.$q17.'</b></li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <br>
                                <ul><b>2nd Quarter</b>
                                    <li>EWT: <b>'.$q2e.'</b></li>
                                    <li>VAT: <b>'.$q2v.'</b></li>
                                    <li>1601C: <b>'.$q26.'</b></li>
                                    <li>1701/2: <b>'.$q27.'</b></li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <br>
                                <ul><b>3rd Quarter</b>
                                    <li>EWT: <b>'.$q3e.'</b></li>
                                    <li>VAT: <b>'.$q3v.'</b></li>
                                    <li>1601C: <b>'.$q36.'</b></li>
                                    <li>1701/2: <b>'.$q37.'</b></li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <br>
                                <ul><b>4th Quarter</b>
                                    <li>EWT: <b>'.$q4e.'</b></li>
                                    <li>VAT: <b>'.$q4v.'</b></li>
                                    <li>1601C: <b>'.$q46.'</b></li>
                                    <li>1701/2: <b>'.$q47.'</b></li>
                                </ul>
                            </td>
                        </tr>
                    </table>
                ';
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;

            case 'EXP': case 'PPE': case 'INV': case 'AR': case 'CB': case 'REV':
                $pdf->AddPage('P');
                $pdf->Bookmark($f['section'].' : '.$f['desc'],1,1);
                $html .= $style2;
                $html .= '<hr style="color:blue;">';
                $html .= '<h2 style="color:#7752FE;">'.$f['section'].': '.$f['desc'].'</h2><br><br>';
                $b = 0;
                $va = 0;
                $sv = 0;
                $ind = $rp->gettbindex($cID,$wpID,$f['index']);
                $html .= '
                    <table border="1">
                        <thead>
                           <tr style="background-color: #C2D9FF;">
                                <th style="width: 30%;"><b>Account</b></th>
                                <th style="width: 20%;"><b>Balance</b></th>
                                <th style="width: 20%;"><b>Supp Balance</b></th>
                                <th style="width: 20%;"><b>Diff Amount</b></th>
                                <th style="width: 10%;"><b>Diff %</b></th>
                            </tr>
                        </thead>
                        <tbody>
                ';
                    foreach($ind as $r){
                        $b += $r['ytd'];
                        $va += $r['ytd'] - $r['supp_bal'];
                        $sv += $r['supp_bal'];
                        $html .= '  
                            <tr>
                                <td style="width: 30%;">'.$r['account_code'].' - '.$r['account'].'</td>
                                <td style="width: 20%;">₱ '.number_format($r['ytd'],2).'</td>
                                <td style="width: 20%;">₱ '.$r['supp_bal'].'</td>
                                <td style="width: 20%;">₱ '.number_format($r['ytd'] - $r['supp_bal'], 2).'</td>
                                <td style="width: 10%;">%'.round(($r['ytd']  - $r['supp_bal']) / ($r['ytd']) * 100).'</td>
                            </tr>
                        ';
                    }
                $html .= '             
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th><b>Total</b></th>
                                <th><b>₱ '.number_format($b,2).'</b></th>
                                <th><b>₱ '.number_format($sv,2).'</b></th>
                                <th><b>₱ '.number_format($va,2).'</b></th>
                                <th><b>%'; if($b == 0 or $va == 0 ){$html .= 0;}else{$html .= round(($va / $b) * 100);} $html .='</b></th>
                            </tr>
                        </tfoot>
                    </table>
                ';
                if($f['file'] != ''){
                    $html .= '<br><h5 style="color:white; background-color:#8E8FFA">Documents</h5><br><br>';
                    $html .= '<b>'.$f['file'].'</b><br><br>';
                }
                $pdf->writeHTML($html, true, false,false, false, '');
                $html = '';
            break;

        }
    }
    


    /**
        ----------------------------------------------------------
        DOCUMENT ATTACHMENTS
        ---------------------------------------------------------- 
    */
    $pdf->AddPage('P');
    $pdf->Bookmark('Document Attachments',0,0);
    $html .= '<hr style="color:blue;">';
    $html .= '<h1 style="color:#7752FE;text-align:center;">DOCUMENT ATTACHMENTS</h1>';
    $html .= '<hr style="color:blue;">';
    $pdf->writeHTML($html, true, false,false, false, '');
    $html = '';

    foreach($fi as $f){
        switch ($f['section']) {
            case 'FSTR':
                $pdf->Bookmark($f['section'].' : '.$f['desc'],1,1);
                $html .= $style2;
                $html .= '<hr style="color:blue;">';
                $html .= '<h2 style="color:#7752FE;">'.$f['section'].': '.$f['desc'].'</h2>';
                foreach($fst as $r){
                    if($r['file'] != ''){
                        // Set the source PDF file 
                        $pageCount = $pdf->setSourceFile(ROOTPATH.'public/uploads/pdf/fstax/'.$fID.'/'.$wpID.'/'.$r['file']);
                        // Iterate through all pages and import them
                        for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
                            $templateId = $pdf->importPage($pageNo);
                            $size = $pdf->getTemplateSize($templateId);
                            // Create a new page in TCPDF with the same size as the imported page
                            $pdf->AddPage($size['orientation'], array($size['width'], $size['height']));
                            // Use the imported page as a template
                            $html .= '<b style="color:#7752FE;">Quarter: '.$r['quarter'].'</b><br>';
                            $html .= '<b style="color:#7752FE;">File: '.$r['type'].'</b><br>';
                            $html .= '<b style="color:#7752FE;">File Name: '.$r['file'].'</b><br>';
                            $pdf->writeHTMLCell(0, 0, 10, 10, $html, 0, 1, 0, true, '', true);
                            $pdf->useTemplate($templateId, 0, 20);
                            $html = '';
                        }
                    }
                }
            break;

            case 'EXP': case 'PPE': case 'INV': case 'AR': case 'CB': case 'REV':
                if($f['file'] != ''){
                    $pdf->Bookmark($f['section'].' : '.$f['desc'],1,1);
                    $html .= $style2;
                    $html .= '<hr style="color:blue;">';
                    $html .= '<h2 style="color:#7752FE;">'.$f['section'].': '.$f['desc'].'</h2>';
                    // Set the source PDF file 
                    $pageCount = $pdf->setSourceFile(ROOTPATH.'public/uploads/pdf/wp/'.$fID.'/'.$wpID.'/'.$f['file']);
                    // Iterate through all pages and import them
                    for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
                        $templateId = $pdf->importPage($pageNo);
                        $size = $pdf->getTemplateSize($templateId);
                        // Create a new page in TCPDF with the same size as the imported page
                        $pdf->AddPage($size['orientation'], array($size['width'], $size['height']));
                        // Use the imported page as a template
                        $html .= '<b style="color:#7752FE;">'.$f['file'].'</b><br><br>';
                        $pdf->writeHTMLCell(0, 0, 10, 10, $html, 0, 1, 0, true, '', true);
                        $pdf->useTemplate($templateId, 0, 30);
                        $html = '';
                    }
                }
               
            break;

        }

    }

    

    $pdf->addTOCPage('P');
    $toc = '
        <hr style="color:blue;">
        <h1 style="color:#7752FE; text-align:center;">TABLE OF CONTENTS</h1>
        <hr style="color:blue;">
    ';
    $pdf->writeHTML($toc, true, false,false, false, '');
    $pdf->addTOC(2, '', '-', 'Table of Contents', 'B', array(128,0,0));
    $pdf->endTOCPage();

//$pdf->writeHTML($html, true, false,false, false, '');
$pdf->Output('workpaper-'.$client.'.pdf','I');
exit();