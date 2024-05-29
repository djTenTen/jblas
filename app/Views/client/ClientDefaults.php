<?php  $crypt = \Config\Services::encrypter();?>
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
                        <div class="page-header-subtitle">Set your client HAT audit files</div>
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
                        Something wrong with your data inputd, please try again.
                    </div>
                </div>
            <?php  }?>
            <?php if (session()->get('files_added')) { ?>
                <div class="alert alert-success alert-icon" role="alert">
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-icon-content">
                        <h6 class="alert-heading">Files Added</h6>
                        Files has been successfully added to user.
                    </div>
                </div>
            <?php  }?>

            <div class="card-body">
                
                <table class="table table-hover" id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Organization</th>
                            <th>Org. Type</th>
                            <th>Industry</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($client as $r){?>
                        <tr>
                            <td><?= $r['name']?></td>
                            <td><?= $r['org']?></td>
                            <td><?= $r['orgtype']?></td>
                            <td><?= $r['industry']?></td>
                            <td><?= $r['email']?></td>
                            <td><?php if($r['status'] == 'Active'){echo '<span class="badge bg-success">'.$r['status'].'</span>';}else{echo '<span class="badge bg-danger">'.$r['status'].'</span>';}?></td>                            
                            <td>
                                <a class="btn btn-primary btn-icon btn-sm get-data" title="Set files" type="button" href="<?= base_url('auditsystem/client/files/')?><?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['cID']))?>/<?= $r['name']?> - <?= $r['org']?>"><i class="fas fa-stream"></i></a>
                                <a class="btn btn-secondary btn-icon btn-sm get-data" title="Set values" type="button" href="<?= base_url('auditsystem/client/getfiles/')?><?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['cID']))?>/<?= $r['name']?> - <?= $r['org']?>"><i class="fas fa-highlighter"></i></a>
                                <a class="btn btn-success btn-icon btn-sm get-data" title="View files added" type="button" data-bs-toggle="modal" data-bs-target="#view"  data-name="<?= $r['name']?>" data-cid="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['cID']))?>"><i class="fas fa-eye"></i></a>
                            </td>
                        </tr>
                    <?php }?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    
</main>


<!-- Modal view-->
<div class="modal fade" id="view" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Client files Assigned</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            
                <h4>Chapter 1</h4>
                <table class="table table-hover table-sm">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Title</th>
                        </tr>
                    </thead>
                    <tbody id="filesdata">

                    </tbody>
                </table>
                <br>
                <h4>Chapter 2</h4>
                <table class="table table-hover table-sm">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Title</th>
                        </tr>
                    </thead>
                    <tbody id="filesdata2">

                    </tbody>
                </table>
                <br>
                <h4>Chapter 3</h4>
                <table class="table table-hover table-sm">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Title</th>
                        </tr>
                    </thead>
                    <tbody id="filesdata3">

                    </tbody>
                </table>
          
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Done</button>
            </div>
        </div>
    </div>
</div>


<script>
$(document).ready(function () {

    $(".get-data").on("click", function() {
        var cid = $(this).data('cid');
        $("#filesdata, #filesdata2, #filesdata3").html(`
        <tr>
            <td colspan="2">
                <div class="container mt-3">
                    <p>Loading...</p>
                    <div class="spinner-grow text-muted"></div>
                    <div class="spinner-grow text-primary"></div>
                    <div class="spinner-grow text-success"></div>
                    <div class="spinner-grow text-info"></div>
                    <div class="spinner-grow text-warning"></div>
                    <div class="spinner-grow text-danger"></div>
                    <div class="spinner-grow text-secondary"></div>
                    <div class="spinner-grow text-dark"></div>
                    <div class="spinner-grow text-light"></div>
                </div>
            </td>
        </tr>
        `);
        $.ajax({
            url: "<?= base_url('auditsystem/client/defaultfiles/')?>" + cid,  // Replace with your actual data endpoint URL
            method: "GET",
            dataType: 'json',
            success: function(data) {

                var c1 = JSON.parse(data.c1);
             
                var c1table = ``;
                $.each(c1, function(i, a) {
                    
                    c1table  +=  ` <tr>
                        <td>`+ a.code +`</td>
                        <td>`+ a.title +`</td>
                    </tr>`;
                });
                $("#filesdata").html(c1table);
        
                var c2 = JSON.parse(data.c2);
                var c2table = ``;
                $.each(c2, function(i, a) {
                    c2table  +=  ` <tr>
                        <td>`+ a.code +`</td>
                        <td>`+ a.title +`</td>
                    </tr>`;
                });
                $("#filesdata2").html(c2table);

                var c3 = JSON.parse(data.c3);
                var c3table = ``;
                $.each(c3, function(i, a) {
                    c3table  +=  ` <tr>
                        <td>`+ a.code +`</td>
                        <td>`+ a.title +`</td>
                    </tr>`;
                });
                $("#filesdata3").html(c3table);

                

            },
            error: function() {
                // Handle error if the data fetch fails
                $(".filesdata").html("No existing files Yet");
            }

        });



    });

});
</script>
