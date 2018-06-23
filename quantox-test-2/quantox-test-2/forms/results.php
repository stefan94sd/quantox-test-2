<?php
session_start();
?>
<?php if(isset($_SESSION['id']) && $_SESSION['id'] !== null){ ?>
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

        <script src="../resources/assets/js/lib/data-table/datatables.min.js"></script>
        <script src="../resources/assets/js/lib/data-table/dataTables.bootstrap.min.js"></script>
        <script src="../resources/assets/js/lib/data-table/dataTables.buttons.min.js"></script>
        <script src="../resources/assets/js/lib/data-table/buttons.bootstrap.min.js"></script>
        <script src="../resources/assets/js/lib/data-table/jszip.min.js"></script>
        <script src="../resources/assets/js/lib/data-table/pdfmake.min.js"></script>
        <script src="../resources/assets/js/lib/data-table/vfs_fonts.js"></script>
        <script src="../resources/assets/js/lib/data-table/buttons.html5.min.js"></script>
        <script src="../resources/assets/js/lib/data-table/buttons.print.min.js"></script>
        <script src="../resources/assets/js/lib/data-table/buttons.colVis.min.js"></script>
        <script src="../resources/assets/js/lib/data-table/datatables-init.js"></script>
    </head>
    <body>
    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="">
                <table id="result" class="table table-striped table-bordered dataTable" style="width:1000px">
                    <thead>
                    <tr>
                        <td>Name</td>
                        <td>Email</td>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </body>
    <script>
        $(document).ready(function(){
            var table = $('#result').DataTable({
                ordering: true,
                searching: true,
                autoWith: true,
                "scrollY":"50vh",
                "scrollX": true,
                "scrollCollapse": true,
                paging: true,
                fixedColumns: true,
                "iDisplayLength": 10,
                "pagingType": "full_numbers",
                ajax: {
                    "url": "../server/search.php",
                    "type": "GET",
                    data: {
                        search: sessionStorage.getItem("search")
                    },
                    "dataSrc": "result"
                },
                columns:[
                    {
                        data: "name",
                        width: 100,
                        searchable: true,
                        sortable: true
                    },
                    {
                        data: "email",
                        width: 100,
                        searchable: true,
                        sortable: true
                    }
                ]
            });
        });
    </script>
    </html>

<?php
}else{
    echo "<br><div class='sufee-alert alert with-close alert-danger alert-dismissible fade show' align='center'>Please login</div>"."<br>";
    include("login.php");
}
?>
