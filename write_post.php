<?php

include('functions.php');

// Initialize field value variables
$post_title = $post_text = '';
$post_categories = array();
$post_author = 'Hákon Arnar';

// Initialize error variables
$title_error = $text_error = $categories_error = '';

// Initialize error count
$error_count = 0;

// Initialize success indicator
$success = false;

//Check if the form has been submitted
if (isset($_POST['publish'])) {
    $post_title = $_POST['post_title'];
    $post_text = $_POST['post_text'];
    if (isset($_POST['post_categories'])) {
        $post_categories = $_POST['post_categories'];
    } else {
        $post_categories = array();
    }
    $post_author = $_POST['post_author'];

    // Doing Some Validation Work
    //Check if title is set and within character length boundaries 
    $title_maxlength = 50;
    if (empty($_POST['post_title'])) {
        $title_error = 'The job title cannot be empty';
        $error_count++;
    } else if (strlen($_POST['post_title']) < 7) {
        $title_error = 'Title must be more then seven characters!';
        $error_count++;
    } else if (strlen($_POST['post_title']) > $title_maxlength) {
        $characters_over_limit = strlen($_POST['post_title']) - $title_maxlength;
        $title_error = "The title is $characters_over_limit characters too long.";
        $error_count++;
    }
    //Check if there's some content in the textarea
    if (empty($_POST['post_text'])) {
        $text_error = 'The post must contain some content silly';
        $error_count++;
    }
    //Check if there's at least one box checked
    if (!isset($_POST['post_categories'])) {
        $categories_error = 'Pick at least one category';
        $error_count++;
    }

    //If there are no errors: 
    //reset field values
    if ($error_count === 0) {
        $post_title = $post_text = '';
        $post_categories = array();

        //Get blog posts file
        //content inside    @ before prevents an error if file doesn't exist
        $blogs_content_str = @file_get_contents('blogs.json');
        if (!$blogs_content_str) {
            $blogs = [];
        } else {
            $blogs = json_decode($blogs_content_str, true);
        }
        // Add new job to jobs array. array_push takes in an array and content to push in
        array_push($blogs, $_POST);

        // Convert job to JSON format
        $blogs_content_str = json_encode($blogs, true);

        // Save the job JSON string to jobs.json
        file_put_contents('blogs.json', $blogs_content_str);

        // Indicate that the job got added successfully
        $success = true;
    }
}


$page_title = 'Write a post';
include('components/header.php');
?>

<h3 class="mb-5 ">Write your stories here</h3>
<div class=" col col-md-8 mx-auto">
    <?php if ($success) : ?>
        <div class="alert alert-success mt-2">Your story has been published :D</div>
    <?php endif; ?>
    <form action="" method="POST">
        <input type="hidden" name="id" value="<?php echo uniqid(); ?>">

        <div class="form-group mb-4">
            <label>Title</label>
            <input type="text" name="post_title" class="form-control" value="<?php echo $post_title; ?>">
            <?php if (!empty($title_error)) : ?>
                <div class="alert alert-danger mt-2"><?php echo $title_error; ?></div>
            <?php endif; ?>
        </div>

        <div class="form-group mb-4">
            <label>Article</label>
            <textarea name="post_text" class="form-control"><?php echo $post_text; ?></textarea>
            <?php if (!empty($text_error)) : ?>
                <div class="alert alert-danger mt-2"><?php echo $text_error; ?></div>
            <?php endif; ?>
        </div>

        <div class="form-group mb-4">
            <label>Categories</label>
            <div class="form-check">
                <input type="checkbox" name="post_categories[]" value="Design" class="form-check-input" <?php get_checked('Design'); ?>> Design <br>
                <input type="checkbox" name="post_categories[]" value="Programming" class="form-check-input" <?php get_checked('Programming'); ?>> Programming <br>
                <input type="checkbox" name="post_categories[]" value="Machine Learning" class="form-check-input" <?php get_checked('Machine Learning'); ?>> Machine Learning <br>
                <input type="checkbox" name="post_categories[]" value="Other" class="form-check-input" <?php get_checked('Other'); ?>> Other <br>
            </div>
            <?php if (!empty($categories_error)) : ?>
                <div class="alert alert-danger mt-2"><?php echo $categories_error; ?></div>
            <?php endif; ?>
        </div>
        <input type="hidden" name="post_author" value="Hákon Arnar">
        <div>
            <button type="submit" name="publish" class="btn btn-primary">Publish Story</button>
            <button type="submit" name="drafts" class="btn btn-info">Save to drafts</button>
        </div>
    </form>


</div>




<?php include('components/footer.php'); ?>