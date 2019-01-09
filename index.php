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
        <link rel='shortcut icon' type='image/x-icon' href='favicon.ico' />
        <link rel="apple-touch-icon-precomposed" href="apple-touch-icon-precomposed.png">
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
        <link rel="stylesheet" href="css/normalize.min.css">
        <link rel="stylesheet" href="css/main.css"> 
        <link rel='stylesheet' href="jqueryUI/jquery-ui.css" />
        <script src="js/jquery2.1.3.min.js"></script>
        <script src='bootstrap/js/bootstrap.js'></script> 
        <script src="jqueryUI/jquery-ui.min.js"></script>



<!--        <script src="js/vendor/jquery.hashchange.min.js"></script>
        <script src="js/vendor/jquery.easytabs.min.js"></script>-->

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
        <div class="main-container">
            <div style="background: #fff;width: 100%">
                <div style="text-align: center;font-size: 2.125em;"><b>YCTCU - Data Capture</b></div><div style="text-align: center"><small><a href="save.php" style="position: relative; right: 0px;font-size: 0.725em;padding: 20px;">Add New</a></small></div>


            </div>
            <div class="main wrapper clearfix">


                <!-- End Tab Container -->

                <div style="margin-left: auto;margin-top: 50px;text-align: center; height: 400px;">           
                    <div class="title " style="padding: 5px; margin-top: 5px; text-align: center"><h4>Registered List(<?php echo memberCount(); ?>)</h4></div>
                    <div style="height: 350px;overflow-y: auto; overflow-x: auto">
                        <table id="draft" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>

                                <tr class="active" style="padding: 10px;font-size: 16px;">
                                  
                                    <th scope="row">S.N</th>
                                    <th>ID</th>
                                    <th>Surname</th>
                                    <th>other names</th>
                                    <th>Department</th>
                                    <th>Unit</th>
                                    <th>Quote</th>
                                    <th>View</th>
                                    <?php if (!isset($_GET['user'])) { ?><th>Edit</th><?php } ?> 
                                </tr>
                            </thead>
                            <tfoot>
                                <tr class="active" style="padding: 10px;font-size: 16px;">
                                    <th scope="row">S.N</th>
                                    <th>ID</th>
                                    <th>Surname</th>
                                    <th>other names</th>
                                    <th>Department</th>
                                    <th>Unit</th>
                                    <th>Quote</th>
                                    <th>View</th>
                                    <?php if (!isset($_GET['user'])) { ?><th>Edit</th><?php } ?> 
                                </tr>
                            </tfoot >
                            <tbody id='cont_val'>

                                <?php
                                $j = 0;
//                                for ($k = 0; $k < 20; $k++)
                                foreach ($regiser as $key => $value) {
                                    $i = 0;
                                    $j++;
                                    echo "<tr class='success text-center'><td> $j</td>";

                                    foreach ($value as $key => $data) {
                                        echo "<td style='text-transform:uppercase'>$data</td>";
                                        if ($i++ == 5)
                                            break;
                                    }
                                    ?> 

                                <td class="file-edit-indicator shower"  title="View Information" data-toggle="modal" data-target="#myModal<?php echo $value["id"]; ?>"><i class="glyphicon glyphicon-file text-warning"></i></td>
                                <?php if (!isset($_GET['user'])) { ?>   <td class="file-edit-indicator" title="Edit Information"> <a href="save.php?user=<?php echo $value["id"]; ?>"><i class="glyphicon glyphicon-pencil text-warning"></i></a></td>
                                <?php } ?>                              
    <!--<div class="file-upload-indicator" title="Download Document"><a href="<?php echo URL . "public/.uploads/" . $data ?>" target="__blank" class="download"><i class="glyphicon glyphicon-hand-down text-warning"></i></a></div>-->


                                <div class="modal fade" id="myModal<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title"><?php echo $value["title"]; ?></h4>
                                            </div>
                                            <div class="modal-body">
                                                <div id="tab-container" class="tab-container">
                                                    <div id="tab-data-wrap">
                                                        <!-- About Tab Data -->
                                                        <div id="about">
                                                            <section class="clearfix">
                                                                <div class="g3" style="text-align: center">

                                                                    <div class="col-md-12 col-sm-12 ">
                                                                        <div class=" col-md-12 col-sm-12" style="float: left">
                                                                            <div class="main-links sidebar">
                                                                                <ul>
                                                                                    <div id="qrcode<?php echo $value['id']; ?>" style="width:100%; height:auto; margin-top:15px;margin: auto"></div>

                                                                                    <a href="" id="savecode<?php echo $value['id']; ?>" style="text-align: center">Download</a>

                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                        <div class="photo col-md-12 col-sm-12" style="float: left">
                                                                            <img src="uploads/<?php echo $value["pix"]; ?>" alt="<?php echo $value["name"]; ?>" />
                                                                        </div>

                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                    <div class="col-md-12 col-sm-12 ">
                                                                        <div class="info">
                                                                            <h2>
                                                                                <?php echo "<span style='text-transform:uppercase'>" . $value["surname"] . "</span><br /><span style='text-transform:capitalize'> " . $value["othernames"] . "</span>"; ?>
                                                                            </h2>
                                                                            <h4>
                                                                                <?php echo $value["unit"]; ?>
                                                                            </h4>
                                                                            <p>
                                                                                <?php echo $value["qoute"]; ?>
                                                                            </p>
                                                                        </div>
                                                                    </div>


                                                                </div>


                                                                <div class="break"></div>
                                                                <div class="contact-info">
                                                                    <div class="g1">
                                                                        <div class="item-box clearfix">
                                                                            <i class="icon-envelope"></i>
                                                                            <div class="item-data">
                                                                                <p>Date of Birth</p>
                                                                                <h3> <?php echo $value["dob"]; ?></h3>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="g1">
                                                                        <div class="item-box clearfix">
                                                                            <i class="icon-envelope"></i>
                                                                            <div class="item-data">
                                                                                <p>Phone No</p>
                                                                                <h3> <?php echo $value["mobileno"]; ?></h3>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="g1">
                                                                        <div class="item-box clearfix">
                                                                            <i class="icon-facebook"></i>
                                                                            <div class="item-data">
                                                                                <p>Email Address</p> 
                                                                                <h3><?php echo $value["email"]; ?></h3>

                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="g1">
                                                                        <div class="item-box clearfix">
                                                                            <i class="icon-envelope"></i>
                                                                            <div class="item-data">
                                                                                <p>Department</p>
                                                                                <h3> <?php echo $value["department"]; ?></h3>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="g1">
                                                                        <div class="item-box clearfix">
                                                                            <i class="icon-facebook"></i>
                                                                            <div class="item-data">
                                                                                <p>Level</p>
                                                                                <h3><?php echo $value["level"]; ?></h3>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="g1">
                                                                        <div class="item-box clearfix">
                                                                            <i class="icon-twitter"></i>
                                                                            <div class="item-data">
                                                                                <p>Unit</p> 
                                                                                <h3><?php echo $value["unit"]; ?></h3>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="g3">
                                                                        <div class="item-box clearfix">
                                                                            <i class="icon-twitter"></i>
                                                                            <div class="item-data">
                                                                                <p>Home Address</p>  
                                                                                <h3><?php echo $value["address"]; ?></h3>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="g3">
                                                                        <div class="item-box clearfix">
                                                                            <i class="icon-twitter"></i>
                                                                            <div class="item-data">
                                                                                <p>Quote</p> 
                                                                                <h3><?php echo $value["quote"]; ?></h3>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </section><!-- content -->
                                                        </div>
                                                        <!-- End About Tab Data -->

                                                    </div>
                                                </div>

                                                <aaa ccc="<?php echo $my_id ?>" ></aaa>
                                                 <!--<input type="hidden"  id="code" value="http://inatia.org/mybiodata/index.php?user=<?php echo $_SESSION["id"] ?>">-->
                                                <input type="hidden"  id="code<?php echo $value['id']; ?>" value="http://<?php echo $ip; ?>/datacaptureyctcu/index.php?user=<?php echo $value['id'] ?>">

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <!--<button type="button" class="btn btn-primary save_changes" sn="<?php echo $value['id']; ?>" >Save changes</button>-->
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
                                <script type="text/javascript">
                                    var qrcode = new QRCode(document.getElementById("qrcode<?php echo $value['id']; ?>"), {
                                        width : 200,
                                        height : 200
                                    });

                                    function makeCode () {		
                                        var elText = document.getElementById("code<?php echo $value['id']; ?>")
                                                                                            	
                                        if (!elText.value) {
                                            alert("Input a text");
                                            elText.focus();
                                            return;
                                        }
                                                                                            	
                                        qrcode.makeCode(elText.value);
                                    }

                                    makeCode();

                                    $("#text").
                                        on("blur", function () {
                                        makeCode();
                                    }).
                                        on("keydown", function (e) {
                                        if (e.keyCode == 13) {
                                            makeCode();
                                        }
                                    });
                                    $(function(){
                                        $("#savecode<?php echo $value['id']; ?>").click(function(e){
                                            var pix=$(".modal.fade.in #qrcode<?php echo $value['id']; ?> img").attr("src");
                                           // alert(pix)
                                            $(location).attr("href", pix);
                                          //  $(this).attr("href", pix)
                                            e.preventDefault();
                                        })
                                    })                                                    
                                                       
                                                                   
                                                                                           
                                </script>
                                <?php
                                echo '</tr>';
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>

                </div>


                <script>
//
                    $(function() {
                        var table = $('table').DataTable();
                    });
                </script>
                <style>
                    table, td, th {
                        border: 1px solid #337ab7;
                        font-size: 12px;
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
                    input[type="search"] {
                        font-size: 16px;
                        border-radius: 5px;
                        height: 35px;
                        width: 80%;
                    }
                    .main{
                        padding: 0;
                    }
                    select[name='draft_length'] {
                        height: 35px;
                        border-radius: 5px;
                    }
                    a.paginate_button:after {
                        content: " ";
                    }
                    
                </style>



                <footer>

                    <div id="logout">Logout</div>

                </footer>
                <script>
                   
                                                        
                    $(function(){
                        //                                        $(document).on("click","tr.success",function(){
                        //                                            $(this).find("td.shower").trigger("click")
                        //                                        })
                                                            
                        $("#logout").click(function(e){
                            e.preventDefault();
                            $.post("model/login.php?login=logout",
                            {
                            },
                            function(data){
                                $(location).attr("href","index/index.php");
                            })
                        })
                    })    
                </script>

            </div><!-- #main -->
        </div><!-- #main-container -->

    </body>



</html>
