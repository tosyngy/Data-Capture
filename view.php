<?php
//ob_start();
session_start();
$ip = gethostbyname("");

if (isset($_GET['user'])) {
    require_once 'model/preview.php';
} else {
    if (!isset($_SESSION["username"])) {
        header("Location: index/index.php");
    }
    require_once 'model/dbcontent.php';
}
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>YCTCU Data Capture</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
        <link rel='shortcut icon' type='image/x-icon' href='favicon.ico' media="all"/>
        <link rel="apple-touch-icon-precomposed" href="apple-touch-icon-precomposed.png" media="all">
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="all">
        <link href="font-awesome/css/font-awesome.css" rel="stylesheet" media="all">
        <link rel="stylesheet" href="css/normalize.min.css" media="all">
        <link rel="stylesheet" href="css/main.css" media="all"> 
        <link rel='stylesheet' href="jqueryUI/jquery-ui.css"  media="all"/>
        <script src="js/jquery2.1.3.min.js"></script>
        <script src='bootstrap/js/bootstrap.js'></script> 
        <script src="jqueryUI/jquery-ui.min.js"></script>



        <script src="js/vendor/jquery.hashchange.min.js"></script>
        <script src="js/vendor/jquery.easytabs.min.js"></script>

        <script src="js/jquery.dataTables.js"></script>
        <script type="text/javascript" src="js/qrcode.js"></script>


        <script src="js/main.js"></script>
        <!--[if lt IE 9]>
            <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
            <script>window.html5 || document.write('<script src="js/vendor/html5shiv.js"><\/script>')</script>
            <![endif]-->
    </head>
    <body class="bg-fixed bg-1">
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
            <![endif]--> 
        <header style="background: #fff;width: 100%">
            <!--<div style="text-align: center;font-size: 2.125em;"><b>YCTCU - Data Capture</b></div>-->
            <div style="text-align: center"><small><a href="save.php" style="position: relative; right: 0px;font-size: 0.725em;padding: 20px;">Add New</a></small></div>


        </header>
        <div class="main-container">

            <div class="main wrapper clearfix" style="padding: 2px; width: 650px;margin: auto;">


                <!-- End Tab Container -->

                <div>

                    <?php
                    $i = 0;
                    foreach ($regiser as $key => $value) {
                        ?>
                        <?php if ($i % 9)  ?>
                        <div class="col-sm-2 col-xs-6" style=" width: 28%; height: 260px;padding: 1px; margin: 1.5%;background: url(image/yctcu2.jpg) no-repeat center center transparent  ; background-size: 100%;">

                            <div class="col-xs-12" style="padding: 0;height: 50%;border: #1c94c4 thin;border-radius:12.5px 12.5px 0 0;padding: 5%;padding-bottom: 0">
                                <img src="uploads/<?php echo $value["pix"]; ?>"
                                     onerror='this.src="uploads/usr_profile/default.png"'
                                     alt="<?php echo $value["surname"]; ?>" style="width: 100%;height: 100%;border-radius:12.5px 12.5px 0px 0px;"/>
                            </div>
                            <div class="col-xs-12 bg-fixed" style="border-radius:0 0 12.5px 12.5px ;height: 50%;border: #1c94c4 solid 2px;padding: 3px;font-family: sans-serif; font-size: 10px;text-align: left;">
                                <span>
                                    <div style=" background: url(image/yctcu.jpg) no-repeat center center transparent  ; background-size: 90%;position: absolute;opacity: .2; min-width: 100%;min-height: 100%" ></div>
                                    <b><span style="text-transform: uppercase; color: #000"><?php echo $value["surname"]; ?></span>  <span style="text-transform: capitalize;color: #000"><?php echo $value["othernames"]; ?></span> </b></span>
                                <br/><b> <span style="color: #000">
                                        <?php
                                        $date = str_replace("/", "-", $value['dob']);
                                        $date = str_replace("0001", "2016", $date);
                                        $date = strtotime($date);

                                        $mydate = date("F, jS", $date);
//                                    $age = $d - $mydate;
                                        echo $mydate;
                                        ?>
                                    </span></b> <br/>
                                <span>
                                    <?php
                                    $value['unit'] = trim($value['unit']);
                                    if ($value['unit'] == "" || !isset($value['unit']))
                                        echo "<b style='color:#000'>Member</b>";
                                    else
                                        $a = str_replace("Prayer", "Covenant Army", $value['unit']);
                                    echo "<b style='text-transform:capitalize;color:#000'>{$a}</b>";
                                    ?>
                                </span><br/>
                                <span>
                                    <?php
                                    echo "<b style='text-transform:capitalize;color:#000'>{$value['department']} {$value['level']}</b>";
                                    ?>
                                </span><br/>
                                <b><span style="color:#000"> 
                                        <?php
                                        echo "{$value['mobileno']}";
                                        ?>
                                    </span></b><br/>
                                <span>
                                    <?php
                                    echo "<span style='text-transform:capitalize;color:#000'><b>{$value['address']}</b></span>";
                                    ?>
                                </span ><br/>  
                                <div style="word-break: break-all;color: #000"><b>
                                        <?php
                                        echo "{$value['email']}";
                                        ?>

                                    </b></div>   <span style="color:#000"><b>
                                        <?php
                                        $small = substr($value['quote'], 1);
                                        $big = substr($value['quote'], 0, 1);

                                        echo "<span style='text-transform:capitalize'>$big</span>$small";
                                        ?>
                                    </b></span><br/>
    <!--                                <span>
                                <?php
                                echo "<b>{$value['id']}</b>";
                                ?>
                                    </span><br/>-->
                            </div>   

                        </div>    
                        <?php
                    }
                    ?>

                </div>




                <script>

                    $(document).ready(function () {
                        var table = $('table').DataTable();
                    });
                </script>
                <style>
                    table, td, th {
                        border: 1px solid #337ab7;
                    }

                    th {
                        background-color: #337ab7 !important;
                        color: white;
                        text-align: center
                    }
                    td {
                        padding: 5px;
                    }
                    td {

                        vertical-align: bottom;
                    }
                    tr:hover + td {
                        color: #eee;
                    }
                    .main-links.sidebar img{
                        margin: auto;
                    }
                </style>



                <!--                <footer>
                
                                    <div id="logout">Logout</div>
                
                                </footer>-->

            </div><!-- #main -->
        </div><!-- #main-container -->

    </body>



</html>
