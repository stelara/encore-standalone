<?php declare(strict_types=1);
require "../src/bootstrap.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Encore-Webpack standalone integration</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="<?=$asset('static/images/favicon.ico')?>" type="image/x-icon"/>
        <?=$linkTags('app')?>
        <?=$linkTags('page')?>
    </head>
    <body>
    <div class="container">
        <div class="row justify-content-center align-items-center preview-content">
            <div class="col-10 text-center">
                <h1 class="display-5">It Works
                    <i class="em em-bird" aria-role="presentation" aria-label="BIRD"></i>
                </h1>
                    <img class="rounded-circle img-fluid"
                         src="<?=$asset('static/images/new_section/hallstatt-4579234_640.jpg')?>" alt="hallstatt">

            </div>
        </div>
    </div>
    <?=$scriptTags('app')?>
    <?=$scriptTags('page')?>
    </body>
</html>