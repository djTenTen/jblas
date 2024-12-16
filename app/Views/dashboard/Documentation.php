
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
                        <div class="page-header-subtitle">Product Documentation</div>
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
            <div class="card-header border-bottom">
                <!-- Wizard navigation-->
                <div class="nav nav-pills nav-justified flex-column flex-xl-row nav-wizard" id="cardTab" role="tablist">
                    <!-- Wizard navigation item 1-->
                    <a class="nav-item nav-link active" id="wizard1-tab" href="#wizard1" data-bs-toggle="tab" role="tab" aria-controls="wizard1" aria-selected="true">
                        <div class="wizard-step-icon">1</div>
                        <div class="wizard-step-text">
                            <div class="wizard-step-text-name">Getting Started</div>
                        </div>
                    </a>
                    <a class="nav-item nav-link" id="wizard1-tab" href="#wizard2" data-bs-toggle="tab" role="tab" aria-controls="wizard1" aria-selected="true">
                        <div class="wizard-step-icon">2</div>
                        <div class="wizard-step-text">
                            <div class="wizard-step-text-name">Key Features</div>
                        </div>
                    </a>
                    <!-- Wizard navigation item 2-->
                    <a class="nav-item nav-link" id="wizard2-tab" href="#wizard3" data-bs-toggle="tab" role="tab" aria-controls="wizard2" aria-selected="true">
                        <div class="wizard-step-icon">3</div>
                        <div class="wizard-step-text">
                            <div class="wizard-step-text-name">User Guide</div>
                        </div>
                    </a>
                    <!-- Wizard navigation item 3-->
                    <a class="nav-item nav-link" id="wizard3-tab" href="#wizard4" data-bs-toggle="tab" role="tab" aria-controls="wizard3" aria-selected="true">
                        <div class="wizard-step-icon">4</div>
                        <div class="wizard-step-text">
                            <div class="wizard-step-text-name">FAQs</div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content" id="cardTabContent">
                    <!-- Wizard tab pane item 1-->
                    <div class="tab-pane py-5 fade show active" id="wizard1" role="tabpanel" aria-labelledby="wizard1-tab">
                        <div class="row justify-content-center">
                            <div class="col-xxl-8 col-xl-10">
                                <h3 class="text-primary display-5">Getting Started</h3>
                                <h5 class="card-title mb-4">Welcome to the product documentation for Applaud.</h5>
                                <br>
                                <h3 class="text-secondary">About Applaud</h3>
                                <p>Applaud is a robust, web-based system specifically designed for auditing firms, offering a comprehensive solution for managing and reviewing QAR (Quality Audit Review) office files. By centralizing file storage and automating key review functions, Applaud simplifies the audit process, making it easier for teams to organize, assess, and monitor critical documents. The platform ensures streamlined workflows that enhance audit quality, promote compliance with regulatory standards, and reduce administrative burdens, allowing firms to focus more on audit performance and client service.</p>
                                <br>
                                <h3 class="text-secondary">Target Audience</h3>
                                <p>Auditing firms of various sizes, audit teams, compliance officers, and quality assurance personnel who manage or assess client files.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Wizard tab pane item 2-->
                    <div class="tab-pane py-5 fade" id="wizard2" role="tabpanel" aria-labelledby="wizard2-tab">
                        <div class="row justify-content-center">
                            <div class="col-xxl-8 col-xl-10">
                                <h3 class="text-primary display-5">Key Features</h3>
                                <br>
                                <h3 class="text-secondary">QAR files</h3>
                                <p>All files from Chapter 1: Planning, Chapter 2: Detailed Procedure, and Chapter 3: Conclusion have now been fully integrated into this application, based on the established references from the QAR Office. This consolidation ensures that every phase of the audit process, from initial planning to final conclusions, is easily accessible within the system. By incorporating these critical documents, the application streamlines workflow, enabling audit teams to efficiently navigate through the audit cycle while adhering to QAR guidelines and maintaining consistent documentation.</p>
                                <br>
                                <h3 class="text-secondary">Audit Trail & File Versioning</h3>
                                <p>Applaud enables detailed tracking of file revisions and maintains comprehensive audit trails to ensure full accountability and traceability throughout the review process. Every modification to a file is logged, including who made the change and when it occurred, providing a clear history of the document’s evolution. This feature helps audit teams maintain transparency, verify the integrity of the data, and quickly reference past versions when needed. By preserving a complete audit trail, Applaud ensures compliance with regulatory requirements and fosters a reliable, secure review environment.</p>
                                <br>
                                <h3 class="text-secondary">Automated File Checks</h3>
                                <p>Applaud automatically conducts thorough checks on files to ensure they meet criteria for completeness, regulatory compliance, and quality standards. These automated reviews help identify missing information, potential discrepancies, or non-compliance issues, allowing audit teams to address concerns proactively. By streamlining the quality assurance process, Applaud enhances accuracy and consistency, reducing the likelihood of errors and ensuring all audit documentation adheres to industry best practices.</p>
                                <br>
                                <h3 class="text-secondary">User Access Control</h3>
                                <p>The system offers highly customizable user roles and permissions, allowing administrators to define specific access levels for individuals or groups. This ensures precise control over who can view, edit, or review files, facilitating collaboration while maintaining security. Whether assigning roles for auditors, reviewers, or clients, the permissions framework is designed to provide flexibility and adaptability to meet the unique needs of each organization. Additionally, granular permission settings help streamline workflows and protect sensitive data by ensuring that only authorized personnel can access or modify critical information.</p>
                                <br>
                                <h3 class="text-secondary">Report Book</h3>
                                <p>All the files, along with the uploaded supporting documents related to the audit, can be seamlessly compiled into a comprehensive PDF format. This feature ensures that all critical audit information, including planning, procedures, and conclusions, is organized into a single, easily shareable and printable document for streamlined reporting and record-keeping. Additionally, the compiled PDF maintains the integrity of the original formatting and attachments, ensuring compliance with audit standards.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Wizard tab pane item 3-->
                    <div class="tab-pane py-5 fade" id="wizard3" role="tabpanel" aria-labelledby="wizard3-tab">
                        <div class="row justify-content-center">
                            <div class="col-xxl-8 col-xl-10">
                                <h3 class="text-primary display-5">User Guide</h3>
                                <h5 class="card-title mb-4">This guide provides step-by-step instructions for registering auditors and clients, setting files for clients, and configuring default values within the system.</h5>
                                <br>
                                <h3 class="text-secondary">Register Your Auditor(s) with Their Corresponding Roles</h3>
                                <h6>Step 1: Access the Registration Page</h6>
                                <ul>
                                    <li>Navigate to the Side Panel.</li>
                                    <li>Click on the <b>Auditor Management</b> section and click <b>Auditor</b></li>
                                </ul>
                                <h6>Step 2: Add a New Auditor</h6>
                                <ul>
                                    <li>Click on the <button class="btn btn-primary btn-sm">Add Auditor</button> button.</li>
                                    <li>Complete all required fields with the necessary information and select the appropriate role from the dropdown menu and upload the signature in PNG format. Ensure that the signature image is clear and legible, as it will be used for official documentation.</li>
                                </ul>
                                <h6>Step 3: Save the Auditor's Information</h6>
                                <ul>
                                    <li>Review the entered details for accuracy.</li>
                                    <li>Click the <button class="btn btn-success btn-sm">Register</button> button to register the auditor. You will see a confirmation message upon successful registration and the auditor will received an <b>email verification</b>.</li>
                                </ul>
                                <br>
                                <h3 class="text-secondary">Register Your Client</h3>
                                <h6>Step 1: Access the Registration Page</h6>
                                <ul>
                                    <li>Navigate to the Side Panel.</li>
                                    <li>Click on the <b>Client Management</b> section and click <b>Clients</b></li>
                                </ul>
                                <h6>Step 2: Add a New Client</h6>
                                <ul>
                                    <li>Click on the <button class="btn btn-primary btn-sm">Add Client</button> button.</li>
                                    <li>Complete all required fields with the necessary information</li>
                                </ul>
                                <h6>Step 3: Save the Auditor's Information</h6>
                                <ul>
                                    <li>Review the entered details for accuracy.</li>
                                    <li>Click the <button class="btn btn-success btn-sm">Register</button> button to register the auditor. You will see a confirmation message upon successful registration</li>
                                </ul>
                                <br>
                                <h3 class="text-secondary">Set Files for Client</h3>
                                <h6>Step 1: Access the Set-Default Page</h6>
                                <ul>
                                    <li>Navigate to the Side Panel.</li>
                                    <li>Click on the <b>Client Management</b> section and click <b>Set Defaults</b></li>
                                    <li>Find the client you wish to assign files to the client and click <button class="btn btn-primary btn-icon btn-sm"><i class="fas fa-stream"></i></button> on their profile.</li>
                                </ul>
                                <h6>Step 2: Assign Files</h6>
                                <ul>
                                    <li>Check the files you wanted to assign to client from chapter 1 to chapter 3.</li>
                                    <li>You can also view the files by clicking the <button class="btn btn-primary btn-icon btn-sm"><i class="fas fa-eye"></i></button> on file information.</li>
                                </ul>
                                <br>
                                <h3 class="text-secondary">Set Default Values for Client</h3>
                                <h6>Step 1: Access the Set-Default Page</h6>
                                <ul>
                                    <li>Navigate to the Side Panel.</li>
                                    <li>Click on the <b>Client Management</b> section and click <b>Set Defaults</b></li>
                                    <li>Find the client you wish to update the files and click <button class="btn btn-secondary btn-icon btn-sm"><i class="fas fa-highlighter"></i></button> on their profile.</li>
                                </ul>
                                <h6>Step 2: Setting Values</h6>
                                <ul>
                                    <li>All the selected files are only shown here</li>
                                    <li>Find the file you want to set values by clicking the <button class="btn btn-primary btn-icon btn-sm"><i class="fas fa-tools"></i></button> on file information.</li>
                                    <li>Each file features a unique design and layout tailored to its original file guide, ensuring that all necessary elements are included. To optimize your workflow, fill out all the fields that are typically consistent in auditing processes. This proactive approach will save you valuable time when preparing for subsequent audits for the same client. Additionally, all values can be easily edited within the Work Paper section, allowing for quick adjustments and updates as needed, thereby enhancing efficiency and accuracy in your audit preparations.</li>
                                </ul>
                                <h6>Step 3: Save the File's Information</h6>
                                <ul>
                                    <li>Review the entered details for accuracy.</li>
                                    <li>Click the <button class="btn btn-success btn-sm">Save</button> button to save your data files. You will see a confirmation message upon successful registration</li>
                                </ul>
                                <br>
                                <h3 class="text-secondary">Initiate Work Paper (Audit Manager/Firm Access)</h3>
                                <h6>Step 1: Access the Initiation Page</h6>
                                <ul>
                                    <li>Navigate to the Side Panel.</li>
                                    <li>Click on the <b>Audit Manager</b> section and click <b>Initiate</b></li>
                                    <li>Click on the <button class="btn btn-primary btn-sm">Add Work Paper</button> button.</li>
                                </ul>
                                <h6>Step 2: Initiate Work Paper</h6>
                                <ul>
                                    <li>Click on the <button class="btn btn-primary btn-sm">Add Client</button> button.</li>
                                    <li>Complete all required fields with the necessary audit information</li>
                                    <li>In the Job Duration section, you can specify a date range for completing the audit. This feature allows you to set clear start and end dates for the audit process, helping ensure timely execution and enabling better planning and resource allocation. By defining a target timeframe, you can track progress against deadlines and maintain accountability throughout the audit, promoting a structured and efficient workflow. This also helps in coordinating team efforts and meeting client expectations for timely delivery of audit results.</li>
                                    <li>Assign your auditor to their corresponding roles :
                                        <ul>
                                            <li><b>Auditor:</b> Also known as the preparer, this individual is responsible for managing the initial stages of document preparation. Their primary duties include gathering necessary information, organizing data, and ensuring that all relevant materials are ready for review. The preparer submits the finalized documents exclusively to the reviewer for further evaluation.</li>
                                            <li><b>Reviewer:</b>This individual is responsible for the comprehensive review of files and documents, ensuring that all materials meet the necessary standards before final submission. After conducting a thorough assessment, the reviewer has two primary actions:
                                                <ul>
                                                    <li><b>Approval:</b> If the documents are deemed accurate and complete, the reviewer will forward them to the audit manager for final approval. This step is essential for maintaining quality assurance and ensuring that all aspects of the audit process are aligned with organizational standards.</li>
                                                    <li><b>Feedback for Corrections:</b>If any discrepancies or issues are identified during the review, the reviewer will return the documents to the preparer for necessary corrections. This collaborative approach allows for open communication and facilitates the rectification of any errors before resubmission.</li>
                                                </ul>
                                            </li>
                                            <li><b>Audit Manager:</b> The Audit Manager oversees all aspects of the audit process, ensuring that files and documentation are managed effectively from start to finish. This role encompasses a range of critical responsibilities, including:
                                                <ul>
                                                    <li><b>Strategic Oversight:</b> The Audit Manager provides strategic direction for the audit team, ensuring that all audits align with organizational goals and compliance standards.</li>
                                                    <li><b>File Management:</b> They are responsible for the organization and maintenance of all audit files, ensuring that each document is properly categorized, stored, and easily accessible for review and reference.</li>
                                                    <li><b>Quality Control:</b> The Audit Manager conducts thorough reviews of completed audits to ensure accuracy and completeness. They verify that all findings are well-documented and that the audit meets the required quality standards.</li>
                                                    <li><b>Reporting:</b> They compile and present audit results to senior management, providing insights and recommendations based on the findings to drive organizational improvements.</li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                                <h6>Step 3: Save the Work Paper Information</h6>
                                <ul>
                                    <li>Review the entered details for accuracy.</li>
                                    <li>Click the <button class="btn btn-primary btn-sm">Create</button> button to Initiate the work paper. You will see a confirmation message upon successful registration</li>
                                </ul>
                                <br>
                                <h3 class="text-secondary">Auditing Proper</h3>
                                <h6>Step 1: Access the Initiation Page</h6>
                                <ul>
                                    <li><b>Note:</b> Make sure you properly assigned the files before initiating a Work paper</li>
                                    <li>Navigate to the Side Panel.</li>
                                    <li>Click on the <b>Audit Manager</b> section and click <b>Initiate</b></li>
                                    <li>Find the client work paper you wish to work on the files and click <button class="btn btn-secondary btn-icon btn-sm"><i class="fas fa-highlighter"></i></button> on their work paper information.</li>
                                </ul>
                                <h6>Step 2: Uploading Trial Balance</h6>
                                <ul>
                                    <li>Navigate to the Tab Panel</li>
                                    <li>Click on the <b>Import Trial Balance</b> </li>
                                    <li>You can Download the xls format for uploading the trial balance by clicking <button class="btn btn-primary btn-sm">Download xls format:</button> </li>
                                    <li>Click <b>Choose File</b> and browse for the Excel file you wish to upload. This step allows you to easily select and import the relevant trial balance data into the system, enabling smooth integration and immediate processing. Once imported, the system will analyze the file for any discrepancies, ensuring your financial data is accurate and ready for review.</li>
                                    <li>The system will automatically verify the trial balance you upload to ensure accuracy. It will flag any discrepancies, such as unbalanced entries or duplicate account codes, helping you quickly identify and resolve issues before proceeding. This automated validation reduces the risk of errors and ensures the integrity of your financial data, streamlining the audit process and maintaining compliance with accounting standards.</li>
                                    <li>Once you import the file, the system will automatically read the trial balance and display all the accounts. It will then assign the appropriate index to each account, ensuring accurate classification and organization of the financial data. This streamlined process simplifies account mapping, helping you quickly review and validate the trial balance for further analysis and reporting</li>
                                </ul>
                                <h6>Step 3: Save the trial balance</h6>
                                <ul>
                                    <li>Review the entered details for accuracy.</li>
                                    <li>Click the <button class="btn btn-primary btn-sm">Import</button> button to upload the trial balance. You will see a confirmation message upon successful registration</li>
                                    <li>Once saved, the system will automatically apply the selected index to the relevant fields in the Workpaper tab. This ensures that all account data is properly mapped and ready for further audit work, saving you time and reducing manual input. The automated indexing enhances accuracy and ensures a smooth transition from data import to detailed analysis within the Workpaper.</li>
                                </ul>
                                <h6>Step 4: Work Paper</h6>
                                <ul>
                                    <li>On the <b>Work Paper</b>  Tab:
                                        <ul>
                                            <li>Find the index you want to work with by clicking the <button class="btn btn-primary btn-icon btn-sm"><i class="fas fa-tools"></i></button> button</li>
                                            <li>Afterward, you will be able to view the trial balance you previously uploaded and begin the audit process. Additionally, you can upload supporting documents in PDF format to accompany the audit by clicking the <button class="btn btn-secondary btn-sm">Upload Documents</button> button and put a remarks to it. <b>Please note: All supporting documents must be combined into a single PDF file</b> for seamless submission and organization within the system. This ensures all relevant documentation is consolidated for easy reference during the audit.</b></li>
                                            <li>Save your progress on the index by clicking the <button class="btn btn-success btn-sm">Save</button> button.</li>
                                            <li>AfteOnce the indexing is complete, you can advance the file to the next stage based on its current status by clicking the <button class="btn btn-success btn-icon btn-sm"><i class="fas fa-paper-plane"></i></button> button. This action moves the audit process forward, ensuring a smooth workflow and proper progression through the designated review or approval stages.</li>
                                        </ul>
                                    </li>
                                    <li>On the <b>Planning, Detailed Procedure, and Conclusion</b> Tab:
                                        <ul>
                                            <li>Find the file you want to work with by clicking the <button class="btn btn-primary btn-icon btn-sm"><i class="fas fa-tools"></i></button> button</li>
                                            <li>Each file features a unique design and layout tailored to its original file guide, ensuring that all necessary elements are included. To optimize your workflow, fill out all the fields that are typically consistent in auditing processes. This proactive approach will save you valuable time when preparing for subsequent audits for the same client. Additionally, all values can be easily edited within the Work Paper section, allowing for quick adjustments and updates as needed, thereby enhancing efficiency and accuracy in your audit preparations.</li>
                                            <li>Save your progress on the file by clicking the <button class="btn btn-success btn-sm">Save</button> button.</li>
                                            <li>Once the file is complete, you can advance the file to the next stage based on its current status by clicking the <button class="btn btn-success btn-icon btn-sm"><i class="fas fa-paper-plane"></i></button> button. This action moves the audit process forward, ensuring a smooth workflow and proper progression through the designated review or approval stages.</li>
                                        </ul>
                                    </li>
                                    <li><b>File Stage</b>: The file progresses through the following corresponding stages:
                                        <ul>
                                            <li><span class="badge bg-danger">Preparing</span>: This stage is where the file is being actively prepared and worked on by the auditor.</li>
                                            <li><span class="badge bg-primary">Reviewing</span>: This stage is where the file is being actively reviewed by the reviewer or super visor.</li>
                                            <li><span class="badge bg-secondary">Checking</span>: This stage is where the file is being actively checking for approval by the Audit Manager/Firm.</li>
                                            <li><span class="badge bg-success">Approved</span>: This stage is where the file is been approved by the Audit Manager/Firm and ready for the report.</li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- Wizard tab pane item 4-->
                    <div class="tab-pane py-5 fade" id="wizard4" role="tabpanel" aria-labelledby="wizard4-tab">
                        <div class="row justify-content-center">
                            <div class="col-xxl-8 col-xl-10">
                                <h3 class="text-primary display-5">FAQs</h3>
                                <br>
                                <h3 class="text-secondary">Can I add a file to work paper when the work paper has been initiated?</h3>
                                <p><b>Answer:</b> No, once the Workpaper has been initiated, you cannot add additional files. This restriction ensures the integrity of the audit process and maintains the consistency of the documentation involved.</p>
                                <br>
                                <h3 class="text-secondary">Can I remove a file from the Workpaper after it has been initiated?</h3>
                                <p><b>Answer:</b> Yes, this function is available exclusively for the Audit Manager or designated firm personnel. To remove a file, simply click the <button class="btn btn-danger btn-icon btn-sm"><i class="fas fa-trash"></i></button> button. Please note that this action requires authentication to ensure proper authorization and maintain the security of the audit process.</p>
                                <br>
                                <h3 class="text-secondary">Is our Data Secured?</h3>
                                <p><b>Answer:</b> Yes, your data is secure. We implement robust security measures to protect your information, including encryption, secure access protocols, and regular security audits. Our commitment to data protection ensures that sensitive information is safeguarded against unauthorized access and potential breaches, giving you peace of mind while using our system.</p>
                                <br>
                                <h3 class="text-secondary">Can the Preparer perform the tasks of the Audit Manager?</h3>
                                <p>No, the system enforces strict role-based authentication. This mechanism verifies the user's permissions, ensuring that only individuals designated as Audit Managers can access and perform functions exclusive to that role. This approach helps maintain the integrity of the audit process and safeguards sensitive information.</p>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    
</main>
