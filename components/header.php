<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo (isset($page_title)) ? $page_title : 'Set Title'; ?></title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.3.1/flatly/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="/phpassignment01/index.php">The Code Street Journal</a>
        <div class="ml-auto">
            <ul class="navbar-nav d-flex">
                <li class="nav-item">
                    <a class="nav-link" href="/phpassignment01/write_post.php">Write New Post</a>
                </li>
                <li class="nav-item ml-2">
                    <a class="nav-link" href="/phpassignment01/login.php">Log In</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container py-5">