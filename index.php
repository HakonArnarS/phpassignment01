<?php
$file_str = @file_get_contents('blogs.json');
if (!$file_str) {
    $blogs = [];
} else {
    $blogs = json_decode($file_str, true);
}

$page_title = 'The Code Street Journal ';
include('components/header.php');
?>

<div class=" col col-md-8 mx-auto">
    <!-- Message displayed if no stories exist -->
    <?php if (empty($blogs)) : ?>
        <div class="alert alert-warning" role="alert">
            Time to write some stories.
        </div>
    <?php endif; ?>

    <!-- Main content of the page // The stories -->
    <?php if (!empty($blogs)) : ?>
        <div class="blogsContainer">
            <?php foreach ($blogs as $ablog) : ?>
                <div class="card article mb-3">
                    <div class="card-body d-flex flex-column">
                        <h4 class="card-title"><?php echo $ablog['post_title']; ?></h4>
                        <p class="card-text"><?php echo $ablog['post_text']; ?></p>
                        <span class="card-text ml-auto"><?php echo 'Author:  &nbsp;', $ablog['post_author']; ?></span>
                        <div class="cats">
                            <span><?php echo '<span>Categories: &nbsp;</span>', join(', ', $ablog['post_categories']); ?></span>
                        </div>
                        <div class="col-3 ml-auto">
                            <button class="btn btn-info col mb-1">Edit Post</button>
                            <button class="btn btn-danger col">Delete Post</button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

</div>




<?php include('components/footer.php'); ?>