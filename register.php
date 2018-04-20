<!DOCTYPE html>



<html lang="en">
<head>
  <title>회원가입</title>
    <meta charset="utf-8">
    <script type="text/javascript" src="http://code.jquery.com/jquery-2.1.0.min.js" ></script>
    <script type="text/javascript" src="js/mySignupForm.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">

</head><!--/head-->


<body>
  <script src="/js/jquery-1.7.1.min.js">  </script>
	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href=""><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
								<li><a href=""><i class="fa fa-envelope"></i> info@domain.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href=""><i class="fa fa-facebook"></i></a></li>
								<li><a href=""><i class="fa fa-twitter"></i></a></li>
								<li><a href=""><i class="fa fa-linkedin"></i></a></li>
								<li><a href=""><i class="fa fa-dribbble"></i></a></li>
								<li><a href=""><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->

    <div class="header-middle"><!--header-middle-->
      <div class="container">
        <div class="row">
          <div class="col-sm-4">
            <div class="logo pull-left">
              <a href="index.php"><img src="images/home/logo.png" alt="" /></a>
            </div>
            <div class="btn-group pull-right">
              <div class="btn-group">
                <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                  USA
                  <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                  <li><a href="">Canada</a></li>
                  <li><a href="">UK</a></li>
                </ul>
              </div>

              <div class="btn-group">
                <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                  DOLLAR
                  <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                  <li><a href="">Canadian Dollar</a></li>
                  <li><a href="">Pound</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-sm-8">
            <div class="shop-menu pull-right">
              <ul class="nav navbar-nav">
                <li><a href=""><i class="fa fa-user"></i> Account</a></li>
                <li><a href=""><i class="fa fa-star"></i> Wishlist</a></li>
                <li><a href="checkout.html"><i class="fa fa-crosshairs"></i> Checkout</a></li>
                <li><a href="cart.html"><i class="fa fa-shopping-cart"></i> Cart</a></li>
                <li><a href="login.php" class="active"><i class="fa fa-lock"></i> Login</a></li>
              </ul>
            </div>
          </div>
          </div>
          </div>
          </div><!--/header-middle-->


<div  class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>귀하의 계정을 등록해주세요.</h2>
						<form name="signUp" action="memberSave.php" method="post" onsubmit="return checkSubmit();">
							<input type="text" placeholder="아이디" name="memberId" class="memberId"/>
              <div class="memberIdCheck">
                <input type="button" value="중복 확인" /></div>
              <div class="memberIdComment comment"></div>
							<input type="password" placeholder="비밀번호" name="memberPw" class="memberPw"/>
              <input type="password" placeholder="비밀번호 확인" name="memberPw2" class="memberPw2" />
               <div class="memberPw2Comment comment"></div>
            	<input type="text" placeholder="이름" name="memberName" class="memberName"/>
            	<input type="email" placeholder="email" name="memberEmailAddress" class="memberEmailAddress" />
                <div class="memberEmailAddressComment comment"></div>

							<input type="submit" class="btn-danger" value="작성완료"></input>
						</form>
            <div class="formCheck">
                        <input type="hidden" name="idCheck" class="idCheck" />
                        <input type="hidden" name="pw2Check" class="pwCheck2" />
                        <input type="hidden" name="eMailCheck" class="eMailCheck" />
                    </div>

					</div><!--/login form-->
				</div>
				<div class="col-sm-1">

				</div>

			</div>
		</div>
