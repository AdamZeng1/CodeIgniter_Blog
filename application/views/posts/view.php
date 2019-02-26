<h2><?php echo $post['title']; ?></h2>
<div class="post-body">
    <small class="post-date">Posted on:<?php echo $post['created_at']?></small><br/>
    <?php echo $post['body']; ?>

</div>

<hr/>
<a class="btn btn-secondary pull-left" href="<?php echo base_url()."posts/edit/".$post['slug']; ?>">Edit</a>
<br/>
<br/>
<?php echo form_open('posts/delete/'.$post['id']); ?>
       <input type="submit" value="Delete" class="btn btn-danger pull-right">
</form>

