<?php
    include 'db_con.php';
    include 'head_blank.php';
if (!isset($_SESSION['id_login'])){
   
    echo '<div style=" text-align:center; font-famely:ariel; color: red; background-color:skyblue;" ><h2>על מנת להתחיל במשחק יש לבצע קודם כניסה למערכת</h2></div>';
 
?>
   <meta http-equiv="refresh" content="3; url=index.php" />
<?php
} else{
   
?>

        <title>המרוץ למיליון</title>
        <style>
            a{
                text-decoration:none;
                color: black;
            }
            body{
                margin: 0;
                padding: 0;
            }
            div:not(.money_gif):not(.swal2-container):not(.swal2-container){
                position: relative;
                z-index: 9;
            }
            

            .money_gif{
                width:100%;
                height:0;
                padding-bottom:56%;
                position: absolute;
                opacity: 0.2;
                z-index: 1;
            }
            
            iframe{
                pointer-events: none;
            }
            .loader_parent{
            pointer-events: none;
            display: none;
            position: absolute;
            bottom: 0;
            left:50%;
            margin-left: -100px;
            }

            .loader_parent .play_again{
                z-index: 5;
                position: absolute;
                pointer-events: all;
                top: 90%;
                width: 50%;
                text-align: center;
                margin: auto;
            }

            .loader_parent .play_again a{
                text-decoration: none;
                padding: 5px 20px;
                display: block;
                border-radius: 30px;
                background-color: rgb(70, 5, 5);
                color: white;
                width: 100px;
                margin: auto;
                font-size: 20px;
            }
            
            .loader_parent h2{
                text-align: center;
                margin-bottom: -40px;
                margin-left: 30px;
                color: rgb(70, 5, 5);
                z-index: 6;
                position: relative;
            }

            #hige{
                z-index: 10;
            }

            .form-control{
                width: 35%;
                margin: auto;
            }

            #chalnge_form .form-control{
                width: 100%;
                margin-bottom: 0;
            }

            #chalnge_form .form-group{
                margin-bottom: 0;
                padding: 0;
            }
        </style>
    </head>
    <body style="font-size: 20px;">
        <div class="money_gif">
            <iframe 
                src="https://giphy.com/embed/sTUfUa7n0iILfEBNzy" 
                width="100%" 
                height="100%" 
                style="position:absolute" 
                frameBorder="0" 
                class="giphy-embed" 
                allowFullScreen>
            </iframe>
        </div>
            <div style="text-align: center;margin-top: 100px;  position: fixed; z-index:10;">
                <div style="text-align: center; width:10%;">
                    <button class="btn btn-primary" id="hige">שיאני הזוכים</button>
                </div>
                <div class="hige_score"> 
                </div>
            </div>
            <div style="padding-top: 100px; text-align: center" id="first">
                <h1 style="font-size: 50px; color: rgb(117, 38, 9);">"הטובים לפיס"</h1>
                <h3>מפעל הפיס חוגג מאה שנים ואתם יכולים להרויח מאה מיליון שקלים</h3>
                <p>חוקי המשחק: יש לנחש "מספר חזק" בין אחד למאה כשעל כל ניחוש יורד מיליון שקל מהפרס הגדול</p>
            </div>
        </div>
        <div id="yyy" style="text-align: center;">
            <div class="form-group">
                <input class="form-control" autofocus type="number" id="gest" style="font-size: 40px;">
            </div>
            <input class="btn btn-primary" autofocus type="button" onclick="clicker()" value="שגר ניחוש">
        </div>
        <div id="status" style="text-align: center;"></div>
        <div id="theend" style="text-align: center; display: none; margin-top: 30px;">
            
        
            <div id="total" style="text-align: center; color: orangered; font-size: 35px;">

            </div>
            <div id="bigmoney" style="text-align: center; color: orangered; font-size: 35px;">

            </div>
            <div>
                <h2>הכסף מופקד ברגעים אלה בחשבון הבנק שלך</h2>
                <div class="rap_frame">
                    <iframe src="https://giphy.com/embed/xTiTnqUxyWbsAXq7Ju" width="200" height="240" frameBorder="0" class="giphy-embed" allowFullScreen></iframe>
                </div>
                <a class="btn btn-primary" href="luki_game.php">התחל משחק חדש</a>
                <button class="btn btn-primary" id="chalnge">אתגר חבר <span></span></button>
                <p class="status"></p>
            </div>
            
        </div>
    <script>
        var random = Math.random();
        var totalgest = 0;
        var money = 100;

        $(document).keypress(function(e){
            if (e.which == 13){
                clicker();
            }
        });

        $('#hige').on('click', function(){
            $('table').toggle();
        })

        get_score();
        function get_score(){
            $.ajax({
                url: 'hige_score.php',
                type: 'post',
                data: {
                
                },
                success: function (res) {
                    console.log(res);
                    $('.hige_score').html(res);
                    
                }
            });
        }
        
        function clicker() {
            money = (money - 1);
            totalgest = (totalgest + 1);
            $('#bigmoney').html("סכום הזכיה שלך הוא " + money + " מיליון שקל");
            $('#total').html("אז " + totalgest + " ניחושים לקח לך לגלות את המספר החזק ");
            var x = $('#gest').val();
            $('#gest').val('');
            $('#gest').focus();
            console.log(x);
            if ( x > Math.floor(random*100)+1){
                $('#status').text('נסו מספר נמוך יותר מ - ' + x);
            }
            if ( x < Math.floor(random*100)+1){
                $('#status').text('נסו מספר גבוה יותר מ - ' + x);
            }
            if ( x == Math.floor(random*100)+1){
                $('#yyy').html('<h1 style="color:red; background-color:grey; font-size: 60px;">!!!בינגו </br>ניחשת את המספר החזק </h1>');
            }
            if ( x == Math.floor(random*100)+1){
                $('#first, #status').hide();
                $('#theend').show();
                $.ajax({
                        url: 'points.php',
                        type: 'post',
                        data: {
                            points: money
                        },
                        success: function (res) {
                            $('.won').show();
                            get_score();
                            // var title = '';
                            // if (res < money){
                            //     title = 'מזל טוב '+money+' מיליון זה שיא חדש שלך';
                            // } else if(res > money){
                            //     title = 'ברכות אבל השיא שלך הוא '+res+' מיליון';
                            // } else{
                            //     title = 'השוות את סכום הזכיה שלך  ';
                            // }
                            // swal.fire({
                            //     title: title,
                            //     icon: 'success',
                            //     confirmButtonText: 'אישור'
                            // })
                        }
                });
            }
        

        }
        function showme(){
            $('#total').show();
        };

        $('#chalnge').on('click', function(){
            var form = `<div id="chalnge_form">
                            <h3>הזן כתובת מייל</h3>
                            <div class="form-group">
                                <input autofocus class="form-control" id="email" type="email">
                            </div>
                           
                        </div>`;
            swal.fire({
                html: form,
                confirmButtonText: 'שלח',
                cancelButtonText: 'ביטול',
                showCancelButton: true,
            })
            .then((swal_back) => {
                console.log(swal_back);
                if(swal_back.isConfirmed){
                    $.ajax({
                        url: 'chalenge.php',
                        type: 'post',
                        data: {
                            email: $('#email').val(),
                            money: money
                        },
                        success: function (res) {
                            console.log(res);
                            $('#email').val('');
                            $('#chalnge span').text(' נוסף');
                            $('.status').text("האתגר נשלח בהצלחה");
                        }
                    });
                }
            })
        });
        $('#send_mail').on('click', function(){
            $.ajax({
                url: 'chalenge.php',
                type: 'post',
                data: {
                    email: $('#email').val(),
                    money: money
                },
                success: function (res) {
                    console.log(res);
                    $('#email').val('');
                    $('#chalnge_form').hide();
                    $('#chalnge').append(' נוסף');
                    alert("האתגר נשלח בהצלחה");
                }
            });
        });



    </script>
    </body>
</html>
<?php }; ?>