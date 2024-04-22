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
                        <div class="page-header-subtitle">You can manage your users here</div>
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
            <?php if (session()->get('exist')) { ?>
                <div class="alert alert-danger alert-icon" role="alert">
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-icon-content">
                        <h6 class="alert-heading">Data already Exist</h6>
                        User already exist.
                    </div>
                </div>
            <?php  }?>
            <?php if (session()->get('added')) { ?>
                <div class="alert alert-success alert-icon" role="alert">
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-icon-content">
                        <h6 class="alert-heading">Success Registration</h6>
                        User has been successfully registered
                    </div>
                </div>
            <?php  }?>
            <?php if (session()->get('updated')) { ?>
                <div class="alert alert-success alert-icon" role="alert">
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-icon-content">
                        <h6 class="alert-heading">Update Success</h6>
                        User has been successfully updated
                    </div>
                </div>
            <?php  }?>

            <div class="card-body">
            <?php if(session()->get('allowed')->add == "Yes"){?>
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#adduser">Add User</button>
            <?php  }?>

            <table class="table table-hover" id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Firm</th>
                        <th>Position</th>
                        <th>Type</th>
                        <th>Verified</th>
                        <th>Status</th>
                        <th>Added On</th>
                        <th>Last Update</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($usr as $r){?>    
                        <tr>
                            <td><?= $r['name']?></td>
                            <td><?= $r['email']?></td>
                            <td><?= $r['firm']?></td>
                            <td><?= $r['position']?></td>
                            <td><?= $r['type']?></td>
                            <td><?php if($r['verified'] == 'Yes'){echo '<span class="badge bg-success">'.$r['verified'].'</span>';}else{echo '<span class="badge bg-danger">'.$r['verified'].'</span>';}?></td>
                            <td><?php if($r['status'] == 'Active'){echo '<span class="badge bg-success">'.$r['status'].'</span>';}else{echo '<span class="badge bg-danger">'.$r['status'].'</span>';}?></td>
                            <td><?= date('F d, Y h:i A', strtotime($r['added_on']))?></td>
                            <td><?= date('F d, Y h:i A', strtotime($r['updated_on']))?></td>    
                            <td>
                                <?php if(session()->get('allowed')->edit == "Yes"){?>
                                    <button class="btn btn-primary btn-icon btn-sm get-data" title="Edit" type="button" data-bs-toggle="modal" data-bs-target="#edit"  data-pos="<?= $crypt->encrypt($r['posID'])?>" data-name="<?= $r['name']?>" data-uid="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['userID']))?>"><i class="fas fa-edit"></i></button>
                                <?php }?>
                                <?php if(session()->get('allowed')->acin == "Yes"){?>
                                    <?php if($r['status'] == 'Active'){?>
                                        <button class="btn btn-danger btn-icon btn-sm active-data" type="button" data-bs-toggle="modal" data-bs-target="#modealactive" data-name="<?= $r['name']?>" data-uid="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['userID']))?>" data-status="<?= $r['status']?>" title="Disable" ><i class="fas fa-ban"></i></button>
                                    <?php }else{?>
                                        <button class="btn btn-success btn-icon btn-sm active-data" type="button" data-bs-toggle="modal" data-bs-target="#modealactive" data-name="<?= $r['name']?>" data-uid="<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($r['userID']))?>" data-status="<?= $r['status']?>" title="Enable" ><i class="fas fa-check-circle"></i></button>
                                    <?php }?>
                                <?php }?>
                            </td>
                        </tr>
                    <?php }?>
                </tbody>

            </table>
            

            </div>
        </div>
    </div>
    
</main>


<!-- Modal add-->
<div class="modal fade" id="adduser" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Register a Auditor</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="" action="<?= base_url('auditsystem/user/save')?>" method="post">

                <div class="row gx-3">
                        <div class="col-md-12">
                            <!-- Form Group (first name)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="name">Name:</label>
                                <input class="form-control" id="name" type="text" placeholder="Enter full name" name="name" required/>
                            </div>
                        </div>
                    </div>
                    <div class="row gx-3">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="small mb-1" for="email">Email</label>
                                <input class="form-control" id="email" type="email" aria-describedby="emailHelp" placeholder="Enter email address" name="email" required/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="small mb-1" for="firm">Firm</label>
                                <select name="firm" id="typei" class="form-control form-select" required>
                                    <option value="" selected>Select Firm</option>
                                    <?php foreach($firm as $f){?>
                                        <option value="<?= $crypt->encrypt($f['firmID'])?>"><?= $f['firm']?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="small mb-1" for="typei">Type</label>
                                <select name="type" id="typei" class="form-control form-select" required>
                                    <option value="" selected>Select Type</option>
                                    <option value="Auditor">Auditor</option>
                                    <option value="Supervisor">Supervisor</option>
                                    <option value="Approver">Approver</option>
                                    <option value="Admin">Admin</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="small mb-1" for="posi">Position</label>
                                <select name="pos" id="posi" class="form-control form-select" required>
                                        <option value="" selected>Select Position</option>
                                    <?php foreach($pos as $p){?>
                                        <option value="<?= $crypt->encrypt($p['posID'])?>"><?= $p['position']?></option>
                                    <?php }?>
                                </select>
                            </div>  
                        </div>
                    </div>
                
            </div>
            <div class="modal-footer">
                    <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-success" type="submit">Register</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal edit-->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Edit a User</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editform" action="" method="post">
                    <div class="row gx-3">
                        <div class="col-md-12">
                            <!-- Form Group (first name)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="name">Name:</label>
                                <input class="form-control name" id="name" type="text" placeholder="Enter full name" name="name" required/>
                            </div>
                        </div>
                    </div>
                    <div class="row gx-3">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="small mb-1" for="email">Email</label>
                                <input class="form-control email" id="email" type="email" aria-describedby="emailHelp" placeholder="Enter email address" name="email" required/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="small mb-1" for="firm">Firm</label>
                                <input class="form-control firm" id="firm" type="firm" placeholder="Enter Firm" name="firm" readonly disabled/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="small mb-1" for="type">Type</label>
                                <select name="type" id="type" class="form-control form-select type" required>
                                    <option value="" selected></option>
                                    <option value="Auditor">Auditor</option>
                                    <option value="Supervisor">Supervisor</option>
                                    <option value="Approver">Approver</option>
                                    <option value="Admin">Admin</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="small mb-1" for="pos">Position</label>
                                <select name="pos" id="pos" class="form-control form-select pos" required>
                                        <option value="" selected></option>
                                    <?php foreach($pos as $p){?>
                                        <option value="<?= $crypt->encrypt($p['posID'])?>"><?= $p['position']?></option>
                                    <?php }?>
                                </select>
                            </div>  
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                    <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function () {


    // $('#firm').on('input', function() {
    //     var searchTerm = $(this).val();
    //     $.ajax({
    //         url: '',
    //         method: 'post',
    //         data: { term: searchTerm },
    //         dataType: 'json',
    //         success: function(response) {
    //             $('#searchResults').empty();
    //             $.each(response, function(index, item) {
    //                 $('#searchResults').append('<tr><td class="searchResult">' + item.firm + '</td></tr>');
    //             });

    //             if(searchTerm == ''){
    //                 $('#searchResults').empty();
    //             }
    //         },
    //         error: function(xhr, status, error) {
    //             console.error('Error:', error);
    //         }
    //     });
    // });

   
    // $(document).on('click', '.searchResult', function() {
    //     var selectedName = $(this).text();
    //     $('#firm').val(selectedName);
    //     $('#searchResults').empty();
    // });

    $(".active-data").on("click", function() {
        var name = $(this).data('name');
        var status = $(this).data('status');
        var uid = $(this).data('uid');
        $('#myactiveform').attr('action', "<?= base_url('auditsystem/user/acin/')?>" + uid);
        if (status == 'Active') {
            $('.msgconfirm').html(`<h3>Are you sure to Disable this auditor `+name+`?</h3>`);
        }else{
            $('.msgconfirm').html(`<h3>Are you sure to Enable this auditor `+name+`?</h3>`);
        }
    });

    $(".get-data").on("click", function() {
        var name = $(this).data('name');
        var uid = $(this).data('uid');
        var pos = $(this).data('pos');
        $('#editform').attr('action', "<?= base_url('auditsystem/user/update/')?>" + uid);

        var originalContent = $("#editform").html();
        var origpos = $("#pos").html();

        $("#editform").html(`
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
        </div>`);
        $.ajax({
            url: "<?= base_url('auditsystem/user/edit/')?>" + uid,  // Replace with your actual data endpoint URL
            method: "GET",
            dataType: 'json',
            success: function(data) {

                console.log(data.firm);
                $("#editform").html(originalContent);
                $("#pos").html(origpos);

                $('.name').attr('value', data.name);
                $('.email').attr('value', data.email);
                $('.firm').attr('value', data.firm);
                //$('#type').append(`<option value="`+data.type+`" selected>`+data.type+`</option>`);
                $('#type option[selected]').attr('value', data.type).text(data.type);
                $('#pos option[selected]').attr('value', pos).text(data.position);
                //$('#pos option[value=""]').html(data.position);
                //$('#pos').find('.ps').html(`<option value="` + pos + `" selected>` + data.position + `</option>`);
                //$('#pos').find(`<option value="` + pos + `" selected>` + data.position + `</option>`);
    
          
            },
            error: function() {
                // Handle error if the data fetch fails
                $(".tbitem").html("Error loading data");
            }

        });



    });

});
</script>