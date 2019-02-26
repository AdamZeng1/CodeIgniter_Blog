<h2><?= $title ?></h2>
<br/>
<?php foreach ($posts as $post) :?>
   <h3><?php echo $post['title']?></h3>
        <small class="post-date">Posted on:<?php echo $post['created_at']?> in <strong><?php echo $post['name']?></strong></small><br/>
       <?php echo word_limiter($post['body'],50) ?>
       <p><a class="btn btn-success" href="<?php echo base_url().'posts/'.$post['slug'] ?>">Read more</a></p>
<?php endforeach;?>
