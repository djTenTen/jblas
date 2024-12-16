
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
                        <div class="page-header-subtitle">Manage your Notification here.</div>
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
                        <h6 class="alert-heading">Success Update</h6>
                        Your information has been successfully updated
                    </div>
                </div>
            <?php  }?>
            <div class="card-body">
                <hr>
        
                <?php foreach($not as $ntf){?>
                    <div class="alert alert-<?= $ntf['intensity']?> alert-icon" role="alert">
                        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" data-url="<?= base_url()?>auditsystem/notif/rem/<?= encr($ntf['notifID'])?>" title="remove"></button>
                        <div class="alert-icon-content">
                            <h6 class="alert-heading"><?= date('F d, Y ', strtotime($ntf['added_on']))?></h6>
                            <?= $ntf['msg']?>
                        </div>
                    </div>
                <?php }?>
                    
            </div>
        </div>
    </div>
</main>

<script>
    
    $(document).ready(function(){

        $('.btn-close').on('click', function(){
            let url = $(this).data('url');
            $.ajax({
                url: url, 
                type: 'POST',
                data: { checked: 'no' },
                success: function(response) {
                    console.log(response.message);
                },
                error: function(xhr, status, error) {
                    
                }
            });
        });
        
    });

</script>
