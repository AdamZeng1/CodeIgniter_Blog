<?php echo validation_errors(); ?>

<?php echo form_open('users/login'); ?>
<div class="row">
    <div class="col-md-4 offset-md-4">
        <h1 class="text-center"><?= $title; ?></h1>
        <div class="form-group">
            <label>Username</label>
            <input type="text" class="form-control" name="username" placeholder="Username">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" name="password" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-primary btn-block">Submit</button>
    </div>
</div>
<?php echo form_close(); ?>

