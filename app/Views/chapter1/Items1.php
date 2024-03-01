<div class="container">


  
    <h1>Chapter 1 Items</h1>
    
    <form action="./save/<?= $cID?>" method="post">

        <label for="">
            Chapter:
            <select name="" id="">
                <option value="">Select Chapter</option>
                <?php foreach($chptr1 as $row){?>
                    <option value=""><?= $row['code'].' - '.$row['title'];?></option>
                <?php }?>
            </select>

        </label>
        <br>

        <div id="questions">
            <button class="btn btn-primary btn-sm float-right" type="button" data-action="add-q" id="add-q">Add Questions</button>
            <label for="" id="qq">
                Questions:
                <textarea class="form-control" id="" cols="30" rows="3" name="questions[]"></textarea>
            </label>
        </div>
  

        <table class="table table-sm table-hover">
            <thead>
                <tr>
                    <th>Fields</th>
                    <th>Default Values</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="tbody">
                <tr>
                    <td><input class="form-control" type="text" name="fields[]"></td>
                    <td><input class="form-control" type="text" name="d-values[]"></td>
                </tr>
            </tbody>
        </table>

        <button class="btn btn-primary btn-sm float-right" type="button" data-action="add-field" id="add-field">Add Field</button>


        <button type="submit" class="btn btn-success">Save</button>

    </form>


    <script>
    $(document).ready(function () {

        // Denotes total number of rows
        var rowIdx = 0;
        // jQuery button click event to add a row$('#add-field').on('click', function () {
            // Adding a row inside the tbody.
         $('#add-q').on('click', function () {
            // Adding a row inside the tbody.
            $('#qq').append(`<textarea class="form-control" id="" cols="30" rows="3" name="questions[]"></textarea>`);
        });

        $('#add-field').on('click', function () {
            // Adding a row inside the tbody.
            $('#tbody').append(`<tr>
                <td><input class="form-control" type="text" name="fields[]"></td>
                <td><input class="form-control" type="text" name="d-values[]"></td>
                <td><button class="btn btn-icon btn-danger btn-xs remove" type="button" data-action="remove">remove</button></td>
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



</div>