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
                        <div class="page-header-subtitle">Chapter 1 - Planning Files</div>
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
            <div class="card-header">Chapter 1 Titles</div>
            <div class="card-body">

                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Title</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>AC1</td>
                            <td>Client Acceptance or Continuance</td>
                            <td>
                                    <a href="<?= base_url()?>auditsystem/chapter1/manage/ac1/Client Acceptance or Continuance" class="btn btn-primary btn-sm">Manage</a>
                            </td>
                        </tr>
                        <tr>
                            <td>AC2</td>
                            <td>Provision of Non-Audit Services</td>
                            <td>
                                <a href="<?= base_url()?>auditsystem/chapter1/manage/ac2/Provision of Non-Audit Services" class="btn btn-primary btn-sm">Manage</a>
                            </td>
                        </tr>
                        <tr>
                            <td>AC3</td>
                            <td>Permanent File Checklist</td>
                            <td>
                                <a href="<?= base_url()?>auditsystem/chapter1/manage/ac3/Permanent File Checklist" class="btn btn-primary btn-sm">Manage</a>
                            </td>
                        </tr>
                        <tr>
                            <td>AC4</td>
                            <td>Preliminary Planning Procedures - Client Involvement</td>
                            <td>
                                <a href="<?= base_url()?>auditsystem/chapter1/manage/ac4/Preliminary Planning Procedures - Client Involvement" class="btn btn-primary btn-sm">Manage</a>
                            </td>
                        </tr>
                        <tr>
                            <td>AC5</td>
                            <td>Preliminary Analytical Procedures</td>
                            <td>
                                <a href="<?= base_url()?>auditsystem/chapter1/manage/ac5/Preliminary Analytical Procedures" class="btn btn-primary btn-sm">Manage</a>
                            </td>
                        </tr>
                        <tr>
                            <td>AC6</td>
                            <td>Narrative Inherent Risk and Control Environment</td>
                            <td>
                                <a href="<?= base_url()?>auditsystem/chapter1/manage/ac6/Narrative Inherent Risk and Control Environment" class="btn btn-primary btn-sm">Manage</a>
                            </td>
                        </tr>

                        <tr>
                            <td>AC7</td>
                            <td>Narrative Inherent Risk Assessment</td>
                            <td>
                                <a href="<?= base_url()?>auditsystem/chapter1/manage/ac7/Narrative Inherent Risk Assessment" class="btn btn-primary btn-sm">Manage</a>
                            </td>
                        </tr>
                        <tr>
                            <td>AC8</td>
                            <td>Assessment of Materiality</td>
                            <td>
                                <a href="<?= base_url()?>auditsystem/chapter1/manage/ac8/Narrative Inherent Risk Assessment" class="btn btn-primary btn-sm">Manage</a>
                            </td>
                        </tr>
                        <tr>
                            <td>AC9</td>
                            <td>Assignment Plan</td>
                            <td>
                                <a href="<?= base_url()?>auditsystem/chapter1/manage/ac9/Narrative Inherent Risk Assessment" class="btn btn-primary btn-sm">Manage</a>
                            </td>
                        </tr>
                        <tr>
                            <td>AC10</td>
                            <td>Sample Size table</td>
                            <td>
                                <a href="<?= base_url()?>auditsystem/chapter1/manage/ac10/Sample Size table" class="btn btn-primary btn-sm">Manage</a>
                            </td>
                        </tr>
                        <tr>
                            <td>AC11</td>
                            <td>Team Discussions and Briefing</td>
                            <td>
                                <a href="<?= base_url()?>auditsystem/chapter1/manage/ac11/Team Discussions and Briefing" class="btn btn-primary btn-sm">Manage</a>
                            </td>
                        </tr>

                        <tr>
                            <td>GPBR</td>
                            <td>Guide Potential Business Risks and Possible Accounting Controls</td>
                            <td>
                                <a href="<?= base_url()?>auditsystem/chapter1/manage/gpbr/Guide Potential Business Risks and Possible Accounting Controls" class="btn btn-primary btn-sm">Manage</a>
                            </td>
                        </tr>
                        <tr>
                            <td>GRA</td>
                            <td>Guide Risk Assessment - Specific Areas</td>
                            <td>
                                <a href="<?= base_url()?>auditsystem/chapter1/manage/gra/Guide Risk Assessment - Specific Areas" class="btn btn-primary btn-sm">Manage</a>
                            </td>
                        </tr>


                        
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>
    
</main>
