<?php


// create new PDF document
$pageLayout = array(21, 29.7);
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A4', true, 'UTF-8', false);
$pdf->setPrintFooter(false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('ApplAud');
$pdf->SetTitle('System of Quality Management Manual');
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
$pdf->SetMargins(25,15,15);  
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

$style = '
    <style>
        p,li{
            text-align: justify;
        }
        *{
            font-family: "dejavusans";
            font-size: 12px;
        }
        h2{
            font-family: Arial, Helvetica, sans-serif;
            font-size: 15px;
        }
    </style>
';
$html = '';
$html .= $style;
$html .= '
    <hr style="color:blue;"> <br><br><br><br><br><br><br><br><br>
';
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
            <td><h1 style="color:#7752FE; text-align:center; font-size:40px;">SYSTEM OF QUALITY MANAGEMENT (SOQM) MANUAL </h1></td>
        </tr>
        <tr>
            <td><h1 style="color:#7752FE; text-align:center; font-size:30px;">OF</h1></td>
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
$html .= '
    
    <h2>'.$sd['prac'].'</h2>
    
    <h4>Background</h4>
    <p>'.$sd['bg'].'</p>
    
    <h4>The firm\'s core services are centered on:</h4>
    <p>'.$sd['cs'].'</p>
    
    <h4>Commitment to Quality</h4>
    <p>'.$sd['cq'].'</p>
    
    <h4>Core Principles</h4>
    <p>'.$sd['cp'].'</p>

    <h4>Firm’s Philosophy, Mission and Vision</h4>
    <h4>Philosophy</h4>
    <p>'.$sd['phil'].'</p>

    <h4>Mission</h4>
    <p>'.$sd['miss'].'</p>
    
    <h4>Vision</h4>
    <p>'.$sd['viss'].'</p>

    <h4>Firm\'s Goal!</h4>
    <p>'.$sd['fg'].'</p>

    <h4>Relationship with the Team</h4>
    <p>'.$sd['rwt'].'</p>

    <h4>Our approach includes:</h4>
    <p>'.$sd['appr'].'</p>

    <h4>Firm Size</h4>
    <p>'.$sd['fs'].'</p>

    <h4>Client Relationship</h4>
    <p>'.$sd['cr'].'</p>

    <h4>Client Service Approach</h4>
    <p>'.$sd['csa'].'</p>
    
    <h4>Geographic Details</h4>
    <p>'.$sd['gd'].'</p>
';
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

//$pdf->write1DBarcode($rdata['reservation_id'], 'S25+', '', '', '', 18, 0.4, $style, 'N');
//$pdf->Write(0, $html, '', 0, 'J', true);
$pdf->writeHTML($html, true, false,false, false, '');
$pdf->Output('stocktransfer.pdf','I');
exit();