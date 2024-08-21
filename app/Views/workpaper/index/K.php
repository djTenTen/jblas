<?php  
    $crypt = \Config\Services::encrypter();
?>
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
                        <div class="page-header-subtitle"><?= $subt?></div>
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
            <?php if (session()->get('updated')) { ?>
                <div class="alert alert-success alert-icon" role="alert">
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-icon-content">
                        <h6 class="alert-heading">Files Updated</h6>
                        The file has successfully Updated.
                    </div>
                </div>
            <?php  }?>
            <?php if (session()->get('uploaded')) { ?>
                <div class="alert alert-success alert-icon" role="alert">
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-icon-content">
                        <h6 class="alert-heading">Files Uploaded</h6>
                        The file has successfully Uploaded.
                    </div>
                </div>
            <?php  }?>
            <?php if (session()->get('invalid_input')) { ?>
                <div class="alert alert-danger alert-icon" role="alert">
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-icon-content">
                        <h6 class="alert-heading">Invalid Input</h6>
                        Something wrong with your data inputed, please try again.
                    </div>
                </div>
            <?php  }?>
            <div class="card-body">
                <h3 class="p-3"><?= $subt?></h3>
                <form action="<?= base_url()?>auditsystem/wp/index/tb/update/<?= $code?>/<?= $cfiID?>/<?= $cID?>/<?= $wpID?>/<?= $index?>/<?= $desc?>/<?= $name?>" method="post">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>Account</th>
                                <th>Balance</th>
                                <th>Supporting Balance</th>
                                <th>Difference Amount</th>
                                <th>Difference %</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            <?php 
                                $b = 0;
                                $va = 0;
                                $sv = 0;
                                foreach($ind as $r){
                                    $b += ($r['debit'] - $r['credit']);
                                    $va += ($r['debit'] - $r['credit']) - $r['supp_bal'];
                                    $sv += $r['supp_bal'];
                            ?>
                                <tr>
                                    <td><input type="hidden" name="tbID[]" value="<?= $crypt->encrypt($r['tbID'])?>"> <?= $r['account_code'].' - '.$r['account']?></td>
                                    <td>₱ <span class="b" data-balance="<?= $r['debit'] - $r['credit']?>"><?= number_format($r['debit'] - $r['credit'], 2)?></span></td>
                                    <td><input type="number" name="sb[]" id="" class="form-control sb" value="<?= $r['supp_bal']?>"></td>
                                    <td>₱ <span class="va" data-variance="<?= $r['debit'] - $r['credit']?>"><?= number_format(($r['debit'] - $r['credit']) - $r['supp_bal'], 2)?></span></td>
                                    <td>% <span class="vp"><?= round(((($r['debit'] - $r['credit']) - $r['supp_bal']) / ($r['debit'] - $r['credit'])) * 100)?></span></td>
                                </tr>
                            <?php }?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="text-end">Total</th>
                                <th>₱ <span id="tb" data-totalb="<?= $b?>"><?= number_format($b,2)?></span></th>
                                <th>₱ <span id="tsb"><?= number_format($sv,2)?></span></th>
                                <th>₱ <span id="tva"><?= number_format($va,2)?></span></th>
                                <th>% <span id="tvp"><?php if($b == 0 or $va == 0 ){echo 0;}else{round(($va / $b) * 100);}?></span></th>
                            </tr>
                        </tfoot>
                    </table>
                    
                    <button type="submit" class="btn btn-success m-1 btn-sm float-end"><i class="fas fa-file-alt m-1"></i>Save</button>
                    <button type="button" id="uploadpdf" data-urlsubmit="<?= base_url()?>auditsystem/wp/index/tb/upload/<?= $code?>/<?= $cfiID?>/<?= $cID?>/<?= $wpID?>/<?= $index?>/<?= $desc?>/<?= $name?>" class="btn btn-secondary m-1 btn-sm float-end" data-bs-toggle="modal" data-bs-target="#tosend" title="Upload Supporting Documents" ><i class="fas fa-file-pdf m-1"></i>Upload Documents</button>

                </form>
                
            </div>
        </div>
    </div>
</main>

    <!-- Modal Send to Reviewer-->
    <div class="modal fade" id="tosend" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Upload PDF Document</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    
                    <form id="toupload" action="" method="post" enctype="multipart/form-data">
                        <div class="col-3">
                            <input type="file" name="pdffile" accept=".pdf" class="form form-control btn btn-secondary">
                        </div>
                        <label for="rem">
                            Remarks:
                            <textarea name="remarks" id="rem" class="form-control" cols="100" rows="10"></textarea>
                        </label>

                        <object data="<?= base_url()?>uploads/pdf/wp/<?= $crypt->decrypt(session()->get('firmID'))?>/<?= $crypt->decrypt(str_ireplace(['~','$'],['/','+'],$wpID))?>/<?= $crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cfiID))?><?= $crypt->decrypt(str_ireplace(['~','$'],['/','+'],$cID))?><?= $crypt->decrypt(str_ireplace(['~','$'],['/','+'],$wpID))?><?= $crypt->decrypt(str_ireplace(['~','$'],['/','+'],$index))?>.pdf" type="application/pdf" frameborder="0" width="100%" height="1000"> </object>
                        
                </div>
                <div class="modal-footer">
                        <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" type="submit"><i class="fas fa-cloud-upload-alt"></i> Upload</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

<script>
    $(document).ready(function () {

        $('#uploadpdf').on('click', function(){
            var file = $(this).data('file');
            var urlsubmit = $(this).data('urlsubmit');
            $('#toupload').attr('action',urlsubmit);
        });

        $('#tbody').on('keyup', '.sb', function() {
            var b = $(this).closest('tr').find('.b').data('balance');
            var sb = $(this).closest('tr').find('.sb').val();
            var nb = parseFloat(b) - parseFloat(sb);
            $(this).closest('tr').find('.va').html(nb.toLocaleString('en-PH' ,{minimumFractionDigits: 2,maximumFractionDigits: 2}));
            var tsb = 0;
            $('.sb').each(function() {
                var value = $(this).val();
                tsb += parseFloat(value);
            });
            $("#tsb").html(tsb.toLocaleString('en-PH' ,{minimumFractionDigits: 2,maximumFractionDigits: 2}));
            var tb = $("#tb").data("totalb");
            var tva = tb - tsb;
            $("#tva").html(tva.toLocaleString('en-PH' ,{minimumFractionDigits: 2,maximumFractionDigits: 2}));
            $(this).closest('tr').find('.vp').html(Math.round((nb / b) * 100));
            $("#tvp").html(Math.round((tva / tb) * 100));
        });
        
    });
    </script>

    
    
  