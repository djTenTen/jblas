
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

            <?php if (session()->get('invalid_input')) { ?>
                <div class="alert alert-danger alert-icon" role="alert">
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-icon-content">
                        <h6 class="alert-heading">Invalid Input</h6>
                        Invalid email or password, Please try again.
                    </div>
                </div>
            <?php  }?>
            <?php if (session()->get('success_registration')) { ?>
                <div class="alert alert-success alert-icon" role="alert">
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-icon-content">
                        <h6 class="alert-heading">Success Registration</h6>
                        Contents has been successfully saved.
                    </div>
                </div>
            <?php  }?>
            <?php if (session()->get('failed_registration')) { ?>
                <div class="alert alert-danger alert-icon" role="alert">
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-icon-content">
                        <h6 class="alert-heading">Failed Registration</h6>
                        Error registering contents.
                    </div>
                </div>
            <?php  }?>

            <div class="card-body">
               
                <h4>PERMANENT FILE CHECKLIST</h4>
                <p>Objective: This form is to be used to ensure the permanent file contains sufficient background information about the client. </p>
                <p>This is a mandatory form.  Any “no” answers indicate a deficiency on the permanent file and a comment should be made as to how this will be addressed.</p>
                <p>Per PSA 315, para A128c, “Disclosures in the financial statements of smaller entities may be less detailed or less complex (e.g., some financial reporting frameworks allow smaller entities to provide fewer disclosures in the financial statements). However, this does not relieve the auditor of the responsibility to obtain an understanding of the entity and its environment, including internal control, as it relates to disclosures.”</p>

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Question</th>
                            <th>Yes/No</th>
                            <th>Comments</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center">
                            <td colspan="5"><h3>General Matters</h3></td>
                        </tr>
                        <?php foreach($ac3genmat as $r1){?>
                            <tr>
                                <td><?= $r1['question']?></td>
                                <td><?= $r1['yesno']?></td>
                                <td><?= $r1['comment']?></td>
                                <td><?php if($r1['status'] == 'Active'){echo '<span class="badge bg-success">'.$r1['status'].'</span>';}else{echo '<span class="badge bg-danger">'.$r1['status'].'</span>';}?></td>>
                                <td></td>
                            </tr>
                        <?php }?>
                        <tr class="text-center">
                            <td colspan="5"><h3>Documents and Correspondence of a Permanent Nature</h3></td>
                        </tr>
                        <?php foreach($ac3doccors as $r2){?>
                            <tr>
                                <td><?= $r2['question']?></td>
                                <td><?= $r2['yesno']?></td>
                                <td><?= $r2['comment']?></td>
                                <td><?php if($r2['status'] == 'Active'){echo '<span class="badge bg-success">'.$r2['status'].'</span>';}else{echo '<span class="badge bg-danger">'.$r2['status'].'</span>';}?></td>
                                <td></td>
                            </tr>
                        <?php }?>
                        <tr class="text-center">
                            <td colspan="5"><h3>Statutory Matters</h3></td>
                        </tr>
                        <?php foreach($ac3statutory as $r3){?>
                            <tr>
                                <td><?= $r3['question']?></td>
                                <td><?= $r3['yesno']?></td>
                                <td><?= $r3['comment']?></td>
                                <td><?php if($r3['status'] == 'Active'){echo '<span class="badge bg-success">'.$r3['status'].'</span>';}else{echo '<span class="badge bg-danger">'.$r3['status'].'</span>';}?></td>
                                <td></td>
                            </tr>
                        <?php }?>

                        <tr class="text-center">
                            <td colspan="5"><h3>The Accounting System</h3></td>
                        </tr>
                        <?php foreach($ac3accsys as $r4){?>
                            <tr>
                                <td><?= $r4['question']?></td>
                                <td><?= $r4['yesno']?></td>
                                <td><?= $r4['comment']?></td>
                                <td><?php if($r4['status'] == 'Active'){echo '<span class="badge bg-success">'.$r4['status'].'</span>';}else{echo '<span class="badge bg-danger">'.$r4['status'].'</span>';}?></td>
                                <td></td>
                            </tr>
                        <?php }?>
                       
                    </tbody>
                </table>

                <br><br>


                <form action="<?= base_url()?>auditsystem/chapter1/manage/save/<?= $code?>/<?= $header?>/<?= $c1tID?>" method="post">
                    <h3>General Matters</h3>
                   <table class="table table-sm table-hover">
                       <thead>
                           <tr>
                               <th>Question</th>
                               <th>Yes/No</th>
                               <th>Comments</th>
                               <th>Action</th>
                           </tr>
                       </thead>
                       <tbody id="tbody">
                       </tbody>
                   </table>

                   <button class="btn btn-primary btn-sm float-right" type="button" data-action="add-field" id="add-field">Add Field</button>

                   <button type="submit" class="btn btn-sm btn-success">Save</button>

               </form>

                <hr>

               <form action="<?= base_url()?>auditsystem/chapter1/manage/save/<?= $code?>/<?= $header?>/<?= $c1tID?>" method="post">
                    <h3>Documents and Correspondence of a Permanent Nature</h3>
                   <table class="table table-sm table-hover">
                       <thead>
                           <tr>
                               <th>Question</th>
                               <th>Yes/No</th>
                               <th>Comments</th>
                               <th>Action</th>
                           </tr>
                       </thead>
                       <tbody id="tbody2">
                       </tbody>
                   </table>

                   <button class="btn btn-primary btn-sm float-right" type="button" data-action="add-field2" id="add-field2">Add Field</button>

                   <button type="submit" class="btn btn-sm btn-success">Save</button>

               </form>

                <hr>

                <form action="<?= base_url()?>auditsystem/chapter1/manage/save/<?= $code?>/<?= $header?>/<?= $c1tID?>" method="post">
                    <h3> Statutory Matters</h3>
                    <table class="table table-sm table-hover">
                        <thead>
                            <tr>
                                <th>Question</th>
                                <th>Yes/No</th>
                                <th>Comments</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="tbody3">
                        </tbody>
                    </table>

                    <button class="btn btn-primary btn-sm float-right" type="button" data-action="add-field3" id="add-field3">Add Field</button>

                    <button type="submit" class="btn btn-sm btn-success">Save</button>

                </form>

                <hr>

                <form action="<?= base_url()?>auditsystem/chapter1/manage/save/<?= $code?>/<?= $header?>/<?= $c1tID?>" method="post">
                    <h3>The Accounting System</h3>
                    <table class="table table-sm table-hover">
                        <thead>
                            <tr>
                                <th>Question</th>
                                <th>Yes/No</th>
                                <th>Comments</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="tbody4">
                        </tbody>
                    </table>

                    <button class="btn btn-primary btn-sm float-right" type="button" data-action="add-field4" id="add-field4">Add Field</button>

                    <button type="submit" class="btn btn-sm btn-success">Save</button>

                </form>


                <br><br>

                <h6>I have reviewed / updated the permanent file and consider that it is adequate.</h6>

                <h6>Signed:			Date:	</h6>
                <h6>I have reviewed the permanent file and consider that it is adequate.</h6>
                <h6>Signed:			Date:	</h6>








               






















                           



            </div>
        </div>
    </div>
    
</main>


<script>
    $(document).ready(function () {

        var rowIdx = 0;

        $('#add-field').on('click', function () {
            // Adding a row inside the tbody.
            $('#tbody').append(`<tr>
                <td><input type="hidden" name="part[]" value="genmat"><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                <td><input class="form-control" type="text" name="yesno[]" value="YES"></td>
                <td><textarea class="form-control" cols="30" rows="3" name="comment[]">None</textarea></td>
                <td><button class="btn btn-danger remove" type="button" data-action="remove">remove</button></td>
            </tr>`);
        });

        $('#tbody').on('click', '.remove', function () {
            var child = $(this).closest('tr').nextAll();
            child.each(function () {
            var id = $(this).attr('id');
            var idx = $(this).children('.row-index').children('p');
            var dig = parseInt(id.substring(1));
            idx.html(`Row ${dig - 1}`);
            $(this).attr('id', `R${dig - 1}`);
            });
            $(this).closest('tr').remove();
            rowIdx--;
        });

        $('#add-field2').on('click', function () {
            // Adding a row inside the tbody.
            $('#tbody2').append(`<tr>
                <td><input type="hidden" name="part[]" value="doccors"><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                <td><input class="form-control" type="text" name="yesno[]" value="YES"></td>
                <td><textarea class="form-control" cols="30" rows="3" name="comment[]">None</textarea></td>
                <td><button class="btn btn-danger remove2" type="button" data-action="remove2">remove</button></td>
            </tr>`);
        });
        
        $('#tbody2').on('click', '.remove2', function () {
            var child = $(this).closest('tr').nextAll();
            child.each(function () {
            var id = $(this).attr('id');
            var idx = $(this).children('.row-index').children('p');
            var dig = parseInt(id.substring(1));
            idx.html(`Row ${dig - 1}`);
            $(this).attr('id', `R${dig - 1}`);
            });
            $(this).closest('tr').remove();
            rowIdx--;
        });




        
        $('#add-field3').on('click', function () {
            // Adding a row inside the tbody.
            $('#tbody3').append(`<tr>
                <td><input type="hidden" name="part[]" value="statutory"><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                <td><input class="form-control" type="text" name="yesno[]" value="YES"></td>
                <td><textarea class="form-control" cols="30" rows="3" name="comment[]">None</textarea></td>
                <td><button class="btn btn-danger remove3" type="button" data-action="remove3">remove</button></td>
            </tr>`);
        });

        $('#tbody3').on('click', '.remove3', function () {
            var child = $(this).closest('tr').nextAll();
            child.each(function () {
            var id = $(this).attr('id');
            var idx = $(this).children('.row-index').children('p');
            var dig = parseInt(id.substring(1));
            idx.html(`Row ${dig - 1}`);
            $(this).attr('id', `R${dig - 1}`);
            });
            $(this).closest('tr').remove();
            rowIdx--;
        });






        $('#add-field4').on('click', function () {
            // Adding a row inside the tbody.
            $('#tbody4').append(`<tr>
                <td><input type="hidden" name="part[]" value="accsys"><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
                <td><input class="form-control" type="text" name="yesno[]" value="YES"></td>
                <td><textarea class="form-control" cols="30" rows="3" name="comment[]">None</textarea></td>
                <td><button class="btn btn-danger remove4" type="button" data-action="remove4">remove</button></td>
            </tr>`);
        });

        $('#tbody4').on('click', '.remove4', function () {
            var child = $(this).closest('tr').nextAll();
            child.each(function () {
            var id = $(this).attr('id');
            var idx = $(this).children('.row-index').children('p');
            var dig = parseInt(id.substring(1));
            idx.html(`Row ${dig - 1}`);
            $(this).attr('id', `R${dig - 1}`);
            });
            $(this).closest('tr').remove();
            rowIdx--;
        });


    });
</script>
