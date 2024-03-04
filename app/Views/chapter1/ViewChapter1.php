<main>
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
        <div class="container-xl px-4">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="activity"></i></div>
                            <?= $title;?>
                        </h1>
                        <div class="page-header-subtitle">Example dashboard overview and content summary</div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container-xl px-4 mt-n10">
        <div class="card mb-4">
            
            <div class="card-header">Chapter 1 Files </div>
            
            <div class="card-body">

                <button class="btn btn-primary m-2" type="button" data-bs-toggle="modal" data-bs-target="#modaladdchapter">Add Chapter</button>
                <div class="modal fade " id="modaladdchapter" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add Chapter</h5>
                                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="save" method="post">
                                    <div class="mb-3">
                                        <label for="code">Code:</label>
                                        <input class="form-control" id="code" type="text" placeholder="AC1" name="code">
                                    </div>

                                    <div class="mb-3">
                                        <label for="title">Title</label>
                                        <input class="form-control" id="title" type="text" placeholder="Your File Title" name="title">
                                    </div>
                       
                                
                            </div>
                            
                            <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">Save</button>
                                </form>
                                <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>



                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Added on</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Code</th>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Added on</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach($chptr1 as $row){?>
                            <tr>
                                <td><?= $row['c1ID']?></td>
                                <td><?= $row['code']?></td>
                                <td><?= $row['title']?></td>
                                <td><?php if($row['status'] == 'active'){echo '<div class="badge bg-success text-white rounded-pill">'.ucfirst($row['status']).'</div>';}else{echo '<div class="badge bg-success text-white rounded-pill">'.ucfirst($row['status']).'</div>';} ?></td>
                                <td><?= $row['added_on']?></td>
                                <td>
                                    <a href="<?= base_url()?>auditsystem/chapter1/manage/<?= str_ireplace(['/','+'],['~','$'],$crypt->encrypt($row['c1ID']))?>" class="btn btn-primary btn-sm">Manage</a>
                                </td>
                            </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>
    
</main>
