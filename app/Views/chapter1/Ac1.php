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
                        <div class="page-header-subtitle">Example dashboard overview and content summary</div>
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
            <div class="card-header"><?= $header?></div>
            <div class="card-body">
               <!-- Contents Here -->

                <h4>Client Acceptance or Continuance Form</h4>
                <h6">This form must be completed by the A.E.P. before any work is undertaken on the file.</p>
                <p>While answering these questions the following matters should be fully considered for the audit firm and any network firm: independence, integrity, conflicts of interest with other clients, economic dependence, trusts, matters arising with regulatory authorities, ability to service the client, other services provided to the client and hospitality. Additional guidance is available in legislation and the Code of Ethics issued by the International Ethics Standards Board for Accountants.  </h6>

                <h6>Any YES answers should be fully explained along with the safeguards, which will enable us to accept / continue with the appointment. </h6>

                <h6>Significant issues must be discussed with the <span class="text-danger">Ethics Partner</span> and details of the discussion documented on file.</h6>

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Question</th>
                            <th>Yes/No</th>
                            <th>Comment</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($ac1 as $r){?>
                            <tr>
                                <td><textarea class="form-control" cols="30" rows="3" name="question[]" required><?= $r['question']?></textarea></td>
                                <td><input class="form-control" type="text" name="yesno[]" value="<?= $r['yesno']?>"></td>
                                <td><textarea class="form-control" cols="30" rows="3" name="comment[]"><?= $r['comment']?></textarea></td>
                                <td><?php if($r['status'] == 'Active'){echo '<span class="badge badge-success">'.$r['status'].'</span>';}else{echo '<span class="badge badge-success">'.$r['status'].'</span>';}?></td>
                                <td><?= $r['status']?></td>
                            </tr>
                        <?php }?>
                    </tbody>
                </table>
                <form action="<?= base_url()?>auditsystem/chapter1/manage/ac1/save/<?= $header?>" method="post">
                   
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
                            <tr>    
                                <td><textarea class="form-control" cols="30" rows="3" name="question[]" required></textarea></td>
                                <td><input class="form-control" type="text" name="yesno[]" value="YES"></td>
                                <td><textarea class="form-control" cols="30" rows="3" name="comment[]">None</textarea></td>
                                <td><button class="btn btn-danger remove" type="button" data-action="remove">remove</button></td>
                            </tr>
                        </tbody>
                    </table>

                    <button class="btn btn-primary btn-sm float-right" type="button" data-action="add-field" id="add-field">Add Field</button>

                    <button type="submit" class="btn btn-success">Save</button>

                </form>
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
                <td><textarea class="form-control" cols="30" rows="3" name="question[]"></textarea></td>
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
    });
</script>
