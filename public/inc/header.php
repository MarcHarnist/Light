<!doctype html>      <!-- www/inc/header  1.0 Hi!  --><html lang="fr">
    <head>
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
        <meta name="viewport" content="width=device-width"/>
        <meta http-equiv="Content-Type" Content="text/html; charset=UTF-8">
        
        <!-- Title of the page -->
        <title><?php echo WEBSITE_NAME . ' '; if(isset($page)) echo $page->getTitle();?></title>

        <!-- Awesome font -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
        <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/all.js"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/v4-shims.js"></script>        
        
        <!-- Bootstrap (look at the bootom too) -->
        <link rel="stylesheet" href="<?=PUBLIC_PATH?>/css/bootstrap.min.css">
        
        <link rel="stylesheet" href="<?=PUBLIC_PATH?>/css/style.css">
        <link rel="stylesheet" href="<?=PUBLIC_PATH?>/css/screen.css">
        <?php 
        $specialCssFilePath = PUBLIC_PATH."/css/".$page->getCssLink();
        if(isset($page) && is_file($specialCssFilePath)):?>
        <!-- A special css file exists for this page -->
        <link rel="stylesheet" href="<?=$specialCssFilePath?>">
        <?php
        endif;
        ?>
    </head>
    <body>
        <header class="row m-0 p-0 w-100">
            <div class="col-11 col-lg-6">
                <!-- Title with logo inside -->
                <?php
                if(defined('PUBLIC_PATH')&& defined('TITLE_DISPLAY'))
                    $file = PUBLIC_PATH."/inc/title.php";
                if(isset($file) && is_file($file) && TITLE_DISPLAY === "yes")
                    require_once($file); ?>
            </div>
            <div class="col-11 col-lg-6">
            <!-- Menu top -->
            <!-- If config says yes for menu_display and if menu top exists root/inc/ -->
            <?php $file = PUBLIC_PATH."/inc/menu-top.php"; if(is_file($file) && MENU_DISPLAY === "yes") require_once($file); ?>
            </div>
        </header>
        <main><!-- main with min-height -->