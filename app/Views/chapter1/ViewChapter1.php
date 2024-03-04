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
        <div class="card mb-4">
            
            <div class="card-header">Chapter 1 Files </div>
            
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Code</th>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Added on</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
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
                                    <button type="submit">action</button>
                                    <a href="manage/<?= $row['c1ID']?>">Manage</a>
                                </td>
                            </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>
    
</main>
