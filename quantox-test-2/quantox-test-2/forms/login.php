<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Quantox Project</title>
    <meta name="description" content="Quantox Project">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" href="../resources/assets/css/normalize.css">
    <link rel="stylesheet" href="../resources/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../resources/assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="../resources/assets/css/themify-icons.css">
    <link rel="stylesheet" href="../resources/assets/css/flag-icon.min.css">
    <link rel="stylesheet" href="../resources/assets/css/cs-skin-elastic.css">
    <!-- <link rel="stylesheet" href="assets/css/bootstrap-select.less"> -->
    <link rel="stylesheet" href="../resources/assets/scss/style.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <script src="../resources/assets/js/vendor/jquery-2.1.4.min.js" type="text/javascript"></script>
    <script src="../resources/assets/js/popper.min.js"></script>
    <script src="../resources/assets/js/plugins.js"></script>
</head>
<body>
<div class="sufee-login d-flex align-content-center flex-wrap">
    <div class="container">
        <div class="login-content">
            <div class="login-form">
                <div id="failDiv" class="sufee-alert alert with-close alert-danger alert-dismissible fade show" style="display: none;">
                    <span class="badge badge-pill badge-danger">Fail</span>
                    <div id="failMessages">

                    </div>
                </div>
                <div id="successDiv" class="sufee-alert alert with-close alert-success alert-dismissible fade show" style="display: none;">
                    <span class="badge badge-pill badge-success">Success</span>
                    <div id="successMessages">

                    </div>
                </div>
                <form>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" id="password" class="form-control" placeholder="Password">
                    </div>
                    <button id="submit" type="button" class="btn btn-primary btn-flat m-b-30 m-t-30">Submit</button>
                </form>
            </div>
        </div>
    </div>
</body>
<script>
    $(document).ready(function(){
        function loginUser(){
            var email = $("#email").val();
            var password = $("#password").val();

            $.ajax({
                url: "../server/login.php",
                type: "get",
                data:{
                    email: email,
                    password: password
                },
                success: function(data){
                    var obj = JSON.parse(data);
                    if(obj.success){
                        $("#failDiv").hide();

                        var successMessagesDiv = $("#successMessages");
                        successMessagesDiv.empty();
                        successMessagesDiv.append(obj.message+"<br>");

                        $("#successDiv").show();
                        location.reload();
                    }else{
                        $("#successDiv").hide();

                        var errorMessagesDiv = $("#failMessages");
                        errorMessagesDiv.empty();
                        errorMessagesDiv.append(obj.message+"<br>");

                        $("#failDiv").show();
                    }
                    $("html, body").animate({ scrollTop: 0 }, "fast");
                },
                fail: function (data) {
                },
                complete: function (data) {

                }
            });
        }

        $("#submit").on("click", function(){
            loginUser();
        });
    });
</script>
</html>
