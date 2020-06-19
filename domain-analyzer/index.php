<!DOCTYPE html>
<html>
<head>
    <title>Awesome Search Box</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Roboto+Mono');
        p.console{font-family: 'Roboto Mono', monospace;}
        header.terminal{background:#E0E8F0;height:30px;border-radius:8px 8px 0 0;padding-left:10px;}
        .terminal-container header .button{width:12px;height:12px;margin:10px 4px 0 0;display:inline-block;border-radius:8px;}.green{background-color: #3BB662 !important;}.red{background-color: #E75448 !important;}
        .yellow{background-color: #E5C30F !important;}
        .terminal-container{text-align:left;width:100%;border-radius:10px;margin:auto;margin-bottom:14px;position:relative;}
        .terminal-fixed-top{margin-top: 30px;}
        .terminal-home{
            background-color: #30353A;
            padding: 1.5em 1em 1em 2em;
            border-bottom-left-radius: 6px;
            border-bottom-right-radius: 6px;
            color: #FAFAFA;
        }
        body,html{
            height: 100%;
            width: 100%;
            margin: 0;
            padding: 0;
            background: #e74c3c !important;
        }

        .searchbar{
            margin-bottom: auto;
            margin-top: auto;
            height: 60px;
            background-color: #353b48;
            border-radius: 30px;
            padding: 10px;
        }

        .search_input{
            color: white;
            border: 0;
            outline: 0;
            background: none;
            width: 0;
            caret-color:transparent;
            line-height: 40px;
            transition: width 0.4s linear;
        }

        .searchbar:hover > .search_input{
            padding: 0 10px;
            width: 450px;
            caret-color:red;
            transition: width 0.4s linear;
        }

        .searchbar:hover > .search_icon{
            background: white;
            color: #e74c3c;
        }

        .search_icon{
            height: 40px;
            width: 40px;
            float: right;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            color:white;
            text-decoration:none;
        }
    </style>
</head>
<!-- Coded with love by Mutiullah Samim-->
<body>
<div class="container h-100">
    <div class="d-flex justify-content-center h-100">
        <img id="preloader" src="/assets/preloader.gif" style="position: fixed; width: 150px; display: none">
        <div class="searchbar">
            <input class="search_input" type="text" name="" placeholder="Search...">
            <a href="#" class="search_icon"><i class="fas fa-search"></i></a>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="main" value="main" checked>
                <label class="form-check-label" for="inlineRadio2">Mac</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="table" value="table">
                <label class="form-check-label" for="inlineRadio1">Table</label>
            </div>
            <div id="output"></div>
        </div>
    </div>
</div>
<script>
    $('.search_input').on('keypress', function(e) {
        if (e.which == 13) {
            $('#preloader').show();
            $.ajax({
                url : '/ajax.php',
                method: 'post',
                data : {
                    search: $(this).val(),
                    type : $('input[name="inlineRadioOptions"]:checked').val()
                }
            }).done(function(data) {
                $('#output').html(data);
            }).fail(function(xhr, error) {
                console.log(arguments);
            }).always(function () {
                $('#preloader').hide();
            })
        }
    });
</script>
</body>
</html>