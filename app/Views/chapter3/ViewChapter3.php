<div class="container">


    <h1>View Chapter 3</h1>


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
            <?php foreach($chptr3 as $row){?>
            <tr>
                <td><?= $row['c3ID']?></td>
                <td><?= $row['code']?></td>
                <td><?= $row['title']?></td>
                <td><?= $row['status']?></td>
                <td><?= $row['added_on']?></td>
                <td><button type="submit">action</button></td>
            </tr>
            <?php }?>
        </tbody>
    </table>
    
    </div>