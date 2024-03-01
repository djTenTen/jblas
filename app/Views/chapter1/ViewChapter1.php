<div class="container">


    <h1>View Chapter 1</h1>


    <table>
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
        <tbody>
            <?php foreach($chptr1 as $row){?>
            <tr>
                <td><?= $row['c1ID']?></td>
                <td><?= $row['code']?></td>
                <td><?= $row['title']?></td>
                <td><?= $row['status']?></td>
                <td><?= $row['added_on']?></td>
                <td><button type="submit">action</button></td>
                <td><a href="manage/<?= $row['c1ID']?>">Manage</a></td>
            </tr>
            <?php }?>
        </tbody>
    </table>
    
</div>