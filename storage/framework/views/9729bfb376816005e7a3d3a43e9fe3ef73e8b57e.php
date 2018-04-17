<html>
<head>
    <link type="text/css" rel="stylesheet" href="<?php echo e(URL::asset('/css/activation_code.css')); ?>"/>
</head>
<body>
    <div class="bodyContent">
        <div class="content">
            <h1>input code to get in backend</h1>
            <form method="post" action="access">
                <?php echo e(csrf_field()); ?>

                <input class="putIn" type="password" name="access-code">
                <input class="submit" type="submit" value="submit">
            </form>
        </div>

    </div>
</body>
</html>
