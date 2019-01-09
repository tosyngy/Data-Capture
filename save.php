<?php
//ob_start();
session_start();
$ip = gethostbyname("");

if (!isset($_SESSION["username"])) {
    header("Location: index/index.php");
}
require_once 'model/dbcontent.php';


$my_id = "";
if (!isset($_GET['user'])) {
    $conn = connection();
    $no = memberCount();
    $no++;
    $id = $_SESSION["id"];
    $sql = "INSERT INTO `yctcudatacapture`.`aboutyou` (`user_id`) VALUES ('$id');";
    $conn->query($sql);

    function membershipId() {
        $conn = connection();
        $sql = "SELECT id FROM aboutyou order by id desc limit 1";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $id = $row['id'];
            }
        }
        return $id;
    }

    $my_id = membershipId();
} else {
    $my_id = $_GET['user'];
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>YCTCU Data Capture <?php echo $_SESSION["username"]; ?></title>
        <meta charset="UTF-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
        <link rel='shortcut icon' type='image/x-icon' href='favicon.ico' />
        <link rel="apple-touch-icon-precomposed" href="apple-touch-icon-precomposed.png">
        <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
        <script src="js/jquery-1.10.1.min.js"></script>
        <script src='bootstrap/js/bootstrap.js'></script>

        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="file_upload/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="datetimepicker/build/css/bootstrap-datetimepicker.css">
        <link rel="stylesheet" href="input-tag/dist/bootstrap-tagsinput.css">

        <link rel='stylesheet' href="jqueryUI/jquery-ui.css" />
        <script src="jqueryUI/jquery-ui.min.js"></script>
        <script src="file_upload/js/fileinput.js" type="text/javascript"></script>
        <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="js/moment.js"></script>
        <script src="datetimepicker/src/js/bootstrap-datetimepicker.js"></script>

        <script type="text/javascript" src="js/qrcode.js"></script>

        <link rel="stylesheet" href="css/normalize.min.css">
        <link rel="stylesheet" href="css/main.css">
        <!--<script src="js/vendor/jquery.hashchange.min.js"></script>-->
        <script src="js/vendor/jquery.easytabs.min.js"></script>

        <script src="js/main.js"></script>
        <script src="input-tag/dist/bootstrap-tagsinput.min.js"></script>
      <!--<script src="input-tag/dist/bootstrap-tagsinput-angular.min.js"></script>-->
    </head>
    <body class="bg-fixed bg-1">

        <div id="tab-container" class="tab-container container-fluid" style=" margin: auto">
            <div class="kv-main">
                <div class="title bg-danger" style="padding: 5px; margin-top: 5px;text-align: center;font-family: roboto">

                    <h2><b>YCTCU - Data Capture</b></h2>
                    <h4><a href="index.php" class="text-danger">Registered List</a></h4>

                    <div id="qrcode" style="width:100px; position: absolute;top: 20px;"></div>
                    <div style="width:100px; position: absolute;top: 20px;">
                        <div style="padding: 5%;padding-bottom: 0">
                            <img src="uploads/<?php echo $aboutyou[0]["pix"]; ?>" alt="<?php echo $aboutyou[0]["surname"]; ?>" style="width: 100%;height: 100%;border-radius:12.5px 12.5px 0px 0px;"/>
                        </div>
                    </div>

                    ID No: <span id="my_id"><a href="?user=<?php echo $my_id; ?>"><?php echo $my_id; ?></a></span><br/>
                      <form method="get" action="" style="margin: auto" class="col-sm-offset-3 col-sm-6 col-xs-12">
                        <div class="col-xs-12" >
                            <input  name="user" class="form-control col-xs-6 " style="width: 70%" required="" placeholder="search by id"> 
                            <button type="submit" class="col-xs-6 btn"  style="width: 30%;height: 34px">GO</button></div>
                    </form><br />
                    <div style="clear: both"></div>
                    <div style="background: #fff;width: 100%">
                        <div style="text-align: center"><small><a href="save.php" style="position: relative; right: 0px;font-size: 0.725em;padding: 20px;">Add New</a></small></div>
                    </div>
                </div>
            </div>
            <!-- Tab List -->

            <!-- End Tab List -->
            <div id="tab-data-wrap">
                <!-- About Tab Data -->
                <div id="about">
                    <form enctype="multipart/form-data" id="post_form4">
                        <section class="clearfix">
                            <div class="form-group">
                                <label for="surname">Surname</label>
                                <input type="text" class="form-control" id="surname" style="text-transform: uppercase" placeholder="Surname" value="<?php echo $aboutyou[0]["surname"]; ?>">
                            </div>
                            <div class="form-group">
                                <label for="name">Other names</label>
                                <input type="text" class="form-control" id="othernames" style="text-transform: capitalize" placeholder="Other names" value="<?php echo $aboutyou[0]["othernames"]; ?>">
                            </div>
                            <div class="form-group">
                                <label for="DOB">Date of Birth</label>
                                <input type="date" class="form-control" id="dob" placeholder="DOB" value="<?php echo $aboutyou[0]["dob"]; ?>">
                            </div> 
                            <div class="form-group">
                                <label for="department">Department</label>
                                <input type="text" class="form-control" list="dept" id="department" placeholder="Department" value="<?php echo $aboutyou[0]["department"]; ?>" />
                            </div>
                            <div class="form-group">
                                <label for="level">Level</label>
                                <input type="text" class="form-control" list="lvl" id="level" placeholder="level" value="<?php echo $aboutyou[0]["level"]; ?>" />
                            </div>
                            <div class="form-group">
                                <label for="unit">Unit</label>
                                <input type="text" class="form-control" list="unitt" id="unit"  placeholder="Unit" value="<?php echo $aboutyou[0]["unit"]; ?>"  data-role="tagsinput"/>
                            </div>
                            <div class="form-group">
                                <label for="mobileno">Mobile No</label>
                                <input type="text" class="form-control" id="mobileno" placeholder="Mobile No"  value="<?php echo $aboutyou[0]["mobileno"]; ?>" data-role="tagsinput" />
                            </div>
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="text" class="form-control" id="email" placeholder="Email Address"  value="<?php echo $aboutyou[0]["email"]; ?>" data-role="tagsinput" />
                            </div>
                            <div class="form-group">
                                <label for="quote">Address</label>
                                <textarea class="form-control"  id="address"rows="3" placeholder="Address"><?php echo $aboutyou[0]["address"]; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="quote">Quote</label>
                                <textarea class="form-control"  id="quote"rows="3" placeholder="Quote"><?php echo $aboutyou[0]["quote"]; ?></textarea>
                            </div>

                            <div class="form-group">
                                <label for="test-upload">Your Picture</label>
                                <input id="file-1" type="file" multiple class="file" data-overwrite-initial="false" data-min-file-count="1" data-max-file-count="1">
                            </div>
                            <span id="imgsetter" class="hidden"><?php echo $aboutyou[0]["pix"]; ?></span>

                        </section><!-- content -->  
                        <button type="button" class="btn btn-default btn-lg  btn-success" id="save_about" style="width: 100%">Save</button>
                        <div class="col-xs-12 text-center"><span id="my_id"><a href="?user=<?php echo $my_id; ?>">Confirm Save</a></div>

                    </form>
                    <form method="get" action="" style="margin: auto" class="col-sm-offset-3 col-sm-6 col-xs-12">
                        <div class="col-xs-12" >
                            <input  name="user" class="form-control col-xs-6 " style="width: 70%" required="" placeholder="search by id"> 
                            <button type="submit" class="col-xs-6 btn"  style="width: 30%;height: 34px">GO</button></div>
                    </form><br />
                </div>

            </div>
        </div>
        <datalist id="unitt">
            <option value="Proclaimer">Proclaimer</option> 
            <option value="Chosen Vessel">Chosen Vessel</option> 
            <option value="Evangelism">Evangelism</option> 
            <option value="Waterer">Waterer</option> 
            <option value="Bible Study">Bible Study</option>  
            <option value="Member">Member</option> 
            <option value="Organizing">Organizing</option>   
            <option value="Librarian">Librarian</option>   
            <option value="Transport">Transport</option>   
            <option value="Publicity">Publicity</option>   
            <option value="Welfare">Welfare</option>   
            <option value="Covenant Army">Covenant Army</option>   
            <option value="All unit">All unit</option>   

        </datalist>
        <datalist id="dept">
            <option value="Computer Science">Computer Science</option> 
            <option value="Mechanical Engineering">Mechanical Engineering</option> 
            <option value="Electrical Engineering">Electrical Engineering</option> 
            <option value="Electrical Electronic">Electrical Electronic</option> 
            <option value="Civil Engineering">Civil Engineering</option> 
            <option value="Accountancy">Accountancy</option> 
            <option value="Physics with Electronics">Physics with Electronics</option> 
            <option value="Computer Engineering">Computer Engineering</option> 
            <option value="Science Laboratory Technology">Science Laboratory Technology</option> 
            <option value="Mass Communication">Mass Communication</option>   
            <option value="Hospitality Management Technology">Hospitality Management Technology</option>   
            <option value="Business Administration">Business Administration</option>   
            <option value="surveying and geoinformatic">Surveying and Geo-informatic</option>   
            <option value="Marketing">Marketing</option>   
            <option value="Statistics">Statistics</option>   
            <option value="Architecture">Architecture</option>   
            <option value="Biochemistry">Biochemistry</option>   
            <option value="Metallurgical Engineering">Metallurgical Engineering</option>   
            <option value="Marine Engineering">Marine Engineering</option>   
            <option value="Industrial Maintenance Engineering">Industrial Maintenance Engineering</option>   
            <option value="Agricultural Engineering">Agricultural Engineering</option>   
            <option value="Agricultural and Environmental Engineering">Agricultural and Environmental Engineering</option>   
            <option value="Estate Management">Estate Management</option>   
            <option value="Banking and Finance">Banking and Finance</option>   
            <option value="Building Technology">Building Technology</option>   
            <option value="Urban and Regional Planning">Urban and Regional Planning</option>   
            <option value="Food Technology">Food Technology</option>   
            <option value="Microbiology">Microbiology</option>   
            <option value="Bio Chemistry">Bio Chemistry</option>   
            <option value="Business Education">Business Education</option>   
            <option value="Science Education">Science Education</option>   
            <option value="Nutrition and Dietetics">Nutrition and Dietetics</option>   
            <option value="Computer Education">Computer Education</option>   
            <option value="Sculpture">Sculpture</option>   
            <option value="Office Technology Management">Office Technology Management</option>   
            <option value="General Arts">General Arts</option>   
            <option value="Polymer Technolgy">Polymer Technology</option>   
            <option value="Testier Technology">Textile Technology</option>   
            <option value="Welding and Fabrication">Welding and Fabrication</option>   
            <option value="Quatity Survey">Quality Survey</option>   
            <option value="Industrial Design Fashion">Industrial Design Fashion</option>   
        </datalist>
        <datalist id="lvl">  
            <option value="ND I">ND I</option> 
            <option value="ND II">ND II</option> 
            <option value="ND III">ND III</option> 
            <option value="HND I">HND I</option> 
            <option value="HND II">HND II</option> 
            <option value="HND III">HND III</option> 

            <option value="100L">100L</option> 
            <option value="200L">200L</option> 
            <option value="300L">300L</option> 
            <option value="400L">400L</option> 
            <option value="500L">500L</option> 
        </datalist>


    <ccc aaa="<?php echo $_SESSION["id"] ?>" ></ccc>
    <!--<input type="hidden"  id="code" value="http://inatia.org/mybiodata/index.php?user=<?php echo $_SESSION["id"] ?>">-->
    <input type="hidden"  id="code" value="http://<?php echo $ip; ?>/datacaptureyctcu/index.php?user=<?php echo $my_id ?>">
    <div style="background: #fff;width: 100%">
        <div style="text-align: center"><small><a href="save.php" style="position: relative; right: 0px;font-size: 0.725em;padding: 20px;">Add New</a></small></div>
        <a href="#top" class="top glyphicon glyphicon-chevron-up" style="position: relative; bottom: 0px; padding: 12px;background: rgba(0,0,0,0.2);float: right">
        </a>
    </div>
    <footer>

        <div id="logout">Logout</div>
    </footer>

    <script>
        $(function () {
            $("#save_about").click(function(e){
                e.preventDefault();
                var img=$("#post_form4 pre").text().replace("upload/","");
                var imgsetter=$("#imgsetter").text();
                if((img.length==0 || img=="") && (imgsetter.length==0 || imgsetter=="")){
                    alert("please upload and save pix to continue")
                    returnFalse();
                }
                $.post("model/main.php?save=biodata",
                {
                    id:$("#my_id").text(),
                    surname:$.trim($("#surname").val()),
                    othernames:$.trim($("#othernames").val()),
                    department:$.trim($("#department").val()),
                    level:$.trim($("#level").val()),
                    email:$.trim($("#email").val()),
                    mobileno:$("#mobileno").val(),
                    address:$("#address").val(),
                    quote:$("#quote").val(),
                    unit:$("#unit").val(),
                    dob:$("#dob").val(),
                    img:img
                },
                function(data){
                    alert("information updated successfully")
                })
            })
            $(document).on("keyup","#othernames, #surname",function(){
                if($.trim($("#surname").val()).length>0 && $.trim($("#othernames").val()).length>0){
                    $.get("?chk=true",
                    {
                        surname:$.trim($("#surname").val()),
                        othernames:$.trim($("#othernames").val())
                    },
                    function(data){
                        $.each(JSON.parse(data),function(id,res){
                            $("#my_id").text(res['id']);
                            $("#surname").val(res['surname']),
                            $("#othernames").val(res['othernames']);
                            $("#department").val(res['department']);
                            $("#level").val(res['level']);
                            $("#email").parent().find(".bootstrap-tagsinput").find("input").val(res['email']);
                            $("#mobileno").parent().find(".bootstrap-tagsinput").find("input").val(res['mobileno']);
                            $("#address").val(res['address']);
                            $("#quote").val(res['quote']);
                            $("#unit").parent().find(".bootstrap-tagsinput").find("input").val(res['unit']);
                            $("#dob").val(res['dob']);
                        })
                       
                    })    
                }
               
            })   
            
            
            $(document).on('focus',"input[placeholder=Unit]",function(){
                $(this).attr("list", "unitt");
            })
            $("#surname").select();
            $("#surname").focus();
            
            
        })
                    
  
    </script>

</body>
<style>
    .file-error-message, .kv-fileinput-caption{
        display: none !important;
    }
    input[type=file]{
        display: inline-flex !important;
        width: 100% !important;
    }
</style>
<script>
   
        
        
        
    ;
    $("#file-1").fileinput({
        uploadUrl: 'uploads/uploads.php?file_name='+ $("ccc").attr("aaa")+'&dir=1', 
        allowedFileExtensions: ['jpg', 'png', 'gif', 'jpeg'],
        overwriteInitial: false,
        maxFileSize: 6000,
        maxFilesNum: 10, 
        allowedFileTypes: ['image'],
        slugCallback: function (filename) {
            return filename.replace('(', '_').replace(']', '_');
        }
    });
    $("#file-2").fileinput({
        uploadUrl: 'uploads/uploads.php', 
        allowedFileExtensions: ['jpg', 'png', 'gif', 'jpeg'],
        overwriteInitial: false,
        maxFileSize: 6000,
        maxFilesNum: 10, 
        allowedFileTypes: ['image'],
        slugCallback: function (filename) {
            return filename.replace('(', '_').replace(']', '_');
        }
    });
    function alerty(id){
        $(id).after(' <div style="display: block; background:#dff0d8;color:#3c763d;font-size:30px" class="kv-fileinput-error text-center text-success"><span class="close kv-success-close small">×</span>Page setup successfully</div>');
           
    }
</script>

<script type="text/javascript">
    var qrcode = new QRCode(document.getElementById("qrcode"), {
        width : 100,
        height : 100
    });

    function makeCode () {		
        var elText = document.getElementById("code");
	
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
</script>
</html>