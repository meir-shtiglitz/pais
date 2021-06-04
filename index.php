<?php
	include 'db_con.php';
	include 'head_blank.php';
	if(isset($_SESSION['id_login'])){
		header('location: luki_game.php');
	};
?>


    <style>
   body{
       direction: rtl;
	   margin: 0;
	   padding: 0;
   }
    .row{
		padding-top: 10%;
		margin:0;
	}
	
	.card-header{
		text-align: center;
	}
	.form-group.row {
		padding: 0;
		margin-bottom: 12px;
	}
	.step0 a{
		font-size: 13px;
		color: blue;
	}
	#to_reg, #to_log{
		cursor: pointer;
	}
    </style>
</head>

<body>
	<div class="row">
		<form class="step0 card m-auto" method="post">
			<input type="hidden" value="login" name="action" />
			<div class="">
				<div class="card-header">
					<h3 class="mb-1">התחברות</h3>
					<p>הזן את פרטי המשתמש שלך</p>
				</div>
				<div class="card-body">
					<div class="form-group">
						<input class="form-control form-control-lg" type="text" id="login_username"  required="" placeholder="שם משתמש או מייל" autocomplete="off">
					</div>
					<div class="form-group">
						<input class="form-control form-control-lg" type="text" id="login_pass"  required="" placeholder="סיסמה" autocomplete="off">
					</div>
					<div class="form-group pt-2">
						<button id="login_button" class="btn btn-block btn-primary" type="button">התחבר</button>
						<div class="status"></div>
					</div>
					<div class="card-footer">
						<a id="to_reg">הרשם עכשיו</a>
					</div>
				</div>
			</div>
		</form>
		<form class="step1 card m-auto" method="post" style="display:none;">
			<input type="hidden" value="register" name="action" />
			<div class="card">
				<div class="card-header">
					<h3 class="mb-1">הרשמה</h3>
					<p>אנא הזן את הפרטים הבאים</p>
				</div>
				<div class="card-body">
					<div class="form-group">
						<input class="form-control form-control-lg" type="text" id="username" name="nick" required="" placeholder="שם משתמש" autocomplete="off">
					</div>
					<div class="form-group">
						<input class="form-control form-control-lg" type="email" id="email" name="email" required="" placeholder="אימייל" autocomplete="off">
					</div>
					
					<div class="form-group">
						<input class="form-control form-control-lg" name="pass" id="pass1" type="password" required="" placeholder="סיסמה">
					</div>
					<div class="form-group pt-2">
						<button id="register1" class="btn btn-block btn-primary" type="button">שלח</button>
						<div class="status"></div>
						<a id="to_log">יש לי כבר חשבון </a>
					</div>
				</div>
			</div>
		</form>
		<form class="step2 splash-container" style="display: none;">
			<div class="card">
				<div class="card-header">
					<h3 class="mb-1">Step 2</h3>
					<p>אנא הזן קוד אימות.</p>
					<p>אם לא קיבלת את המיל בדוק את תיבת הספאם</p>
				</div>
				<div class="card-body">
					<div class="form-group">
						<input type="number" name="code_mail" id="confirm_input">
						<input type="button" id="confirm_code" value="אמת קוד">
						<div class="status"></div>
					</div>
				</div>
			</div>
		</form>
	</div>
	<script>
		$(document).ready(function(){
			$('#to_reg').on('click', function(){
				$('.step0').hide();
				$('.step1').show();

			});

			$('#to_log').on('click', function(){
				$('.step1').hide();
				$('.step0').show();

			});

			$('#login_button').on('click', function(){
				$.ajax({
					url: 'login_back_hend.php',
					type: 'post',
					data: {
						step: 0,
						username_mail: $('#login_username').val(),
						login_pass: $('#login_pass').val()
					},
					success: function (res) {
						console.log(res);
						if (res == 3) {
							$('.step0 .status').text('שם משתמש או סיסמא שגויים');
						} else {
							location = 'luki_game.php';
						};
					}
				});
			});


			var code;
			$('#register1').on('click', function(){
				$.ajax({
					url: 'login_back_hend.php',
					type: 'post',
					data: {
						step: 1,
						username: $('#username').val(),
						email: $('#email').val(),
						birth_date: $('#dob_year').val() + '-' + $('#dob_month').val() + '-' + $('#dob_day').val(),
						pass: $('#pass1').val()
					},
					success: function (res) {
						if (res == 3) {
							$('.step1 .status').text('מייל או שם משתמש כבר קיימים במערכת נסה אחרים או בצע כניסה');
						} else {
							location = 'luki_game.php';
						}
					}
				});
			});
			// $('#confirm_code').on('click', function(){
			// 	$.ajax({
			// 		url: 'login_back_hend.php',
			// 		type: 'post',
			// 		data: {
			// 			step: 2,
			// 			code_mem: $('#confirm_input').val(),
			// 			username: $('#username').val(),
			// 			email: $('#email').val(),
			// 			birth_date: $('#dob_year').val() + '-' + $('#dob_month').val() + '-' + $('#dob_day').val(),
			// 			pass: $('#pass1').val()
			// 		},
			// 		success: function (res) {
			// 			if (res == 3) {
			// 				alert('נרשמת בהצלחה למערכת');
			// 				location = 'http://w13.leomedia.co.il';
			// 			} else {
			// 				$('.step2 .status').text('קוד אימות לא תקין נסה שוב בבקשה');
							
			// 			};
			// 		}
			// 	});
			// });
		});
	</script>
</body>
 
</html>