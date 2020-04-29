<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        .desk{
            width:800px;
            height: 800px;
            background-color: #aaa;
        }
        .cell{
            width: 100px;
            height: 100px;
            border: 1px solid black;
            float: left;
            text-align: center;
            font-size: 2rem;
        }
        .cell_black{
            background: black;
            color: white;
        }
        .cell_white{
            background: white;
            color: black;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="desk">
        <?php
        for ($i = 1; $i <= 64; $i++):
            $color = 'white'; ?>
            <?php if(( ceil($i / 8)  % 2 === 0) &&  $i % 2 !== 0) :
            $color = 'black'; ?>
        <?php endif; ?>
            <?php if(( ceil($i / 8)  % 2 !== 0) &&  $i % 2 === 0) :
            $color = 'black'; ?>
        <?php endif; ?>
            <div class="cell <?php echo "cell_$color" ?>">
                <?php if( ceil($i / 8)  == 2 ): ?>
                    ♟
                <?php endif; ?>

                <?php if( ceil($i / 8)  == 7 )  : ?>
                    ♙
                <?php endif; ?>
                <?php if( ceil($i / 8)  == 1): ?>
                    <?php if ($i == 1 || $i == 8): ?>
                        ♜
                    <?php endif; ?>
                    <?php if ($i == 2 || $i == 7): ?>
                        ♞
                    <?php endif; ?>
                    <?php if ($i == 3 || $i == 6): ?>
                        ♝
                    <?php endif; ?>
                    <?php if ($i == 4): ?>
                        ♛
                    <?php endif; ?>
                    <?php if ($i == 5): ?>
                        ♚
                    <?php endif; ?>
                <?php endif; ?>
                <?php if( ceil($i / 8)  == 8)  : ?>
                    <?php if ($i == 57 || $i == 64): ?>
                        ♖
                    <?php endif; ?>
                    <?php if ($i == 58 || $i == 63): ?>
                        ♘
                    <?php endif; ?>
                    <?php if ($i == 59 || $i == 62): ?>
                        ♗
                    <?php endif; ?>
                    <?php if ($i == 60): ?>
                        ♕
                    <?php endif; ?>
                    <?php if ($i == 61): ?>
                        ♔
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        <?php endfor; ?>
    </div>
</div>
</div>
</body>
</html>