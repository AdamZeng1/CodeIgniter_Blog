<h2><?php echo $post['title']; ?></h2>
<div class="post-body">
    <small class="post-date">Posted on:<?php echo $post['created_at'] ?></small>
    <br/>
    <img class="img-control" src="<?php echo base_url() . 'assets/images/posts/' . $post['post_image']; ?>">
    <?php echo $post['body']; ?>

</div>

<?php if ($this->session->userdata('user_id') === $post['user_id']): ?>
    <hr/>
    <a class="btn btn-secondary pull-left" href="<?php echo base_url() . "posts/edit/" . $post['slug']; ?>">Edit</a>

    <?php echo form_open('posts/delete/' . $post['id']); ?>
    <input id="delete-button" type="submit" value="Delete" class="btn btn-danger">
    </form>

<?php endif; ?>

<hr>
<h3>Add Comment</h3>
<?php echo validation_errors(); ?>
<?php echo form_open('comments/create'); ?>
<div class="form-group shadow-textarea">
    <label for="name">Name</label>
    <input type="text" class="form-control" name="name" placeholder="Add Name">
    <label for="email">Email</label>
    <input type="text" class="form-control" name="email" placeholder="Add Email">
    <label for="body">Comment</label>
    <textarea class="form-control z-depth-1" name="body" id="exampleFormControlTextarea6" rows="3"
              placeholder="Write something here..."></textarea>
</div>
<input type="hidden" name="slug" value="<?php echo $post['slug'] ?>"> <!-- 当输入内容通不过重新加载页面时需要$post['slug']-->
<button type="submit" class="btn btn-primary">Submit</button>
</form>

<hr>
<h3>Comments</h3>

<?php if ($comments) : ?>

    <?php foreach ($comments as $comment): ?>
        <div class="well">
            <h8><?php echo $comment['body'] ?>[ by
                <strong><?php echo $comment['name'] . ' created at ' . $comment['created_at'] ?></strong>]
            </h8>
        </div>
    <?php endforeach; ?>

<?php else: ?>
    <p><?php echo 'no comment to display!' ?></p>
<?php endif; ?>
