<h2><?= $title ?></h2>


<?php echo validation_errors(); ?>

<?php echo form_open("categories/create") ?>
    <div class="form-group">
        <label for="Title">Name</label>
        <input type="text" class="form-control" name="category_name" placeholder="Add Category">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>

</form>
