<html>
<head>
    <title>ciBlog</title>
    <link rel="stylesheet" href="https://bootswatch.com/4/cerulean/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/CSS/style.css">
    <script src="https://cdn.ckeditor.com/4.11.2/standard/ckeditor.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor01">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo base_url(); ?>">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url(); ?>posts">Posts</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url(); ?>categories">Categories</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url(); ?>about">About</a>
            </li>
        </ul>
        <ul class="navbar-nav navbar-right">
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url(); ?>users/register">Register</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url(); ?>posts/create">Create Post</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url(); ?>categories/create">Create Category</a>
            </li>
        </ul>
<!--        <form class="form-inline my-2 my-lg-0">-->
<!--            <input class="form-control mr-sm-2" type="text" placeholder="Search">-->
<!--            <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>-->
<!--        </form>-->
    </div>
</nav>

<div class="container">
    <!-- Flash Message-->
    <?php if ($this->session->flashdata('user_registered')): ?>

    <?php echo '<p class="alert alert-success">'.$this->session->flashdata('user_registered').'</p>'; ?>

    <?php endif; ?>

    <?php if ($this->session->flashdata('category_created')): ?>

        <?php echo '<p class="alert alert-success">'.$this->session->flashdata('category_created').'</p>'; ?>

    <?php endif; ?>

    <?php if ($this->session->flashdata('post_created')): ?>

        <?php echo '<p class="alert alert-success">'.$this->session->flashdata('post_created').'</p>'; ?>

    <?php endif; ?>

    <?php if ($this->session->flashdata('post_updated')): ?>

        <?php echo '<p class="alert alert-success">'.$this->session->flashdata('post_updated').'</p>'; ?>

    <?php endif; ?>

    <?php if ($this->session->flashdata('post_deleted')): ?>

        <?php echo '<p class="alert alert-success">'.$this->session->flashdata('post_deleted').'</p>'; ?>

    <?php endif; ?>

