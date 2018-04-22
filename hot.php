  <!DOCTYPE html>
<?php

include "session.php";
 include "dbConnect.php";

      $_POST["details_id"];
      $_POST["brand_id"];


        if(isset($_GET['page'])) {

          $page = $_GET['page'];

        } else {

          $page = 1;

        }


          /* 검색 시작 */
        if(isset($_GET['searchColumn'])) {
        $searchColumn = $_GET['searchColumn'];
        $subString .= '&amp;searchColumn=' . $searchColumn;
        }
        if(isset($_GET['searchText'])) {
        $searchText = $_GET['searchText'];
        $subString .= '&amp;searchText=' . $searchText;
        }
        if(isset($searchColumn) && isset($searchText)) {
        $searchSql = ' where ' . $searchColumn . ' like "%' . $searchText . '%"';
        } else {
        $searchSql = '';
        }
        /* 검색 끝 */



         $sql = "SELECT count(*) FROM man_board " . $searchSql;
        $result = $dbConnect->query($sql);
         $row1 = $result->fetch_assoc();
        $sql2 =   "SELECT count(*)  FROM women_board " . $searchSql;
        $result2 = $dbConnect->query($sql2);
        $row2 =  $result2->fetch_assoc();

        // $row = $result->fetch_assoc();
        // $row = mysqli_num_rows($result);
       $sum_sql = $row1['count(*)'] + $row2['count(*)'];
        $allPost = $sum_sql; //전체 게시글의 수

        if(empty($allPost)) {

        		$emptyData = '<tr><td class="textCenter" colspan="5">글이 존재하지 않습니다.</td></tr>';

        	}

        $onePage = 6; // 한 페이지에 보여줄 게시글의 수.
        $allPage = ceil($allPost / $onePage); //전체 페이지의 수

        if($page < 1 || ($allPage && $page > $allPage)) {
          ?>

          <script>

            alert("존재하지 않는 페이지입니다.");

            history.back();

          </script>

        <?php

          exit;
        }
          $oneSection = 3; //한번에 보여줄 총 페이지 개수(1 ~ 10, 11 ~ 20 ...)

          $currentSection = ceil($page / $oneSection); //현재 섹션

          $allSection = ceil($allPage / $oneSection); //전체 섹션의 수

          $firstPage = ($currentSection * $oneSection) - ($oneSection - 1); //현재 섹션의 처음 페이지

          if($currentSection == $allSection) {

            $lastPage = $allPage; //현재 섹션이 마지막 섹션이라면 $allPage가 마지막 페이지가 된다.

          } else {

            $lastPage = $currentSection * $oneSection; //현재 섹션의 마지막 페이지

          }
          $prevPage = (($currentSection - 1) * $oneSection); //이전 페이지, 11~20일 때 이전을 누르면 10 페이지로 이동.

            $nextPage = (($currentSection + 1) * $oneSection) - ($oneSection - 1); //다음 페이지, 11~20일 때 다음을 누르면 21 페이지로 이동.



            $paging = '<ul style="pagination">'; // 페이징을 저장할 변수



            //첫 페이지가 아니라면 처음 버튼을 생성

            if($page != 1) {

              $paging .= '<li style="float:left" class="page page_start"><a href="./hot.php?page=1' . $subString . '">처음</a></li>';

            }

            //첫 섹션이 아니라면 이전 버튼을 생성

            if($currentSection != 1) {

            $paging .= '<li style="float:left" class="page page_prev"><a href="./hot.php?page=' . $prevPage . $subString . '">이전</a></li>';

            }



            for($i = $firstPage; $i <= $lastPage; $i++) {

              if($i == $page) {

                $paging .= '<li style="float:left" class="page current">' . $i . '</li>';

              } else {

            $paging .= '<li style="float:left" class="page"><a href="./hot.php?page=' . $i . $subString . '">' . $i . '</a></li>';

              }

            }



            //마지막 섹션이 아니라면 다음 버튼을 생성

            if($currentSection != $allSection) {

            $paging .= '<li style="float:left" class="page page_next"><a href="./hot.php?page=' . $nextPage . $subString . '">다음</a></li>';

            }



            //마지막 페이지가 아니라면 끝 버튼을 생성

            if($page != $allPage) {

            $paging .= '<li style="float:left" class="page page_end"><a href="./hot.php?page=' . $allPage . $subString . '">끝</a></li>';

            }

            $paging .= '</ul>';

            /* 페이징 끝 */

            //유니온 코드를 사용하여 테이블을 병합하여 데이터를 뽑아올 수 있다.
            $currentLimit = ($onePage * $page) - $onePage; //몇 번째의 글부터 가져오는지

             $sqlLimit = ' limit ' . $currentLimit . ', ' . $onePage; //limit sql 구문
             //sql 유니온을 사용하여 병합하여 데이터를 추출하고 각각의 서치를 통해서 데이터를 가져온다.
              $sql = "SELECT * FROM man_board $searchSql union all SELECT * FROM women_board $searchSql order by b_hit desc" . $sqlLimit; //원하는 개수만큼 가져온다. (0번째부터 20번째까지

             $result = $dbConnect->query($sql);


   ?>

 <script type="text/javascript">
  function mySubmit(index) {
    if (index == 1) {
      document.myForm.action='product-details_modify.php';
    }
    if (index == 2) {
      document.myForm.action='cart.php';
    }
    document.myForm.submit();
  }
</script>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Shop | E-Shopper</title>
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
	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6 ">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href=""><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
								<li><a href=""></i> <?php echo $_SESSION['ses_userid'];
                    ?> </a></li>
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

                                <?php
                                if(isset($_SESSION['ses_userid'])){
                                  echo "<li><a href='logout.php'>logout</a></li> ";
                                }else {
                                  echo "<li><a href='login.php'>login</a></li> ";
                                }
                                  ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->

		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9" >
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="index.php">Home</a></li>
								<li class="dropdown"><a href="#" class="active">Shop<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="men_shop.php" class="active">Products</a></li>

										<li><a href="checkout.html">Checkout</a></li>
										<li><a href="cart.html">Cart</a></li>
										<li><a href="login.php">Login</a></li>
                                    </ul>
                                </li>
								<li class="dropdown"><a href="#">Blog<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="blog.html">블로그</a></li>
										<li><a href="Eshopper_chat.php">채팅</a></li>
                                    </ul>
                                </li>

								<li><a href="contact-us.html">Contact</a></li>
							</ul>
						</div>
					</div>
          <div style="margin-left:680px" class="col-sm-5">
            <div class="search_box pull-right">
                <form action="./hot.php" method="get">
                  <select style="width: 70px; "name="searchColumn">
                    <option  <?php echo $searchColumn=='b_title'?'selected="selected"':null?> value="b_title">제목</option>
                       <option <?php echo $searchColumn=='b_content'?'selected="selected"':null?> value="b_content">내용</option>
               </select>
              <input type="text"placeholder="Search" name="searchText" value="<?php echo isset($searchText)?$searchText:null?>"/>
              <button type="submit">검색</button>
            </form>
            </div>
          </div>
				</div>
				</div>
			</div>
	</header>

	<section id="advertisement">
		<div class="container">
			<img src="images/shop/advertisement.jpg" alt="" />
		</div>
	</section>

	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Category</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a  href="hot.php">

											HOT
										</a>
									</h4>
								</div>
								<div id="mens" class="panel-collapse collapse">
									<div class="panel-body">
										<ul>

											<li><a href="men_shop.php">Dolce and Gabbana</a></li>
											<li><a href="">Chanel</a></li>
											<li><a href="">Gucci</a></li>
										</ul>
									</div>
								</div>
							</div>

							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a  href="womens_shop.php">
									Womens
										</a>
									</h4>
								</div>

							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="men_shop.php">mens</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="#">Fashion</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="#">Households</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="#">Interiors</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="#">Clothing</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="#">Bags</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="#">Shoes</a></h4>
								</div>
							</div>
						</div><!--/category-productsr-->




					</div>
				</div>


				<div class='col-sm-9 padding-right'>
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">HOT items</h2>
          </div>




               <?php

               if(isset($emptyData)) {

               							echo $emptyData;

               						} else {

                while($row = $result->fetch_assoc()){


                ?>


                  <!--샵 첫번째 아이템 부분.-->
                  <?php  if($row['divi'] == 0 ) {?>
                    <form name="myForm" method="post" enctype="multipart/form-data" action="men_details_modify.php?bno=<?php echo $row['b_no'] ?>" >
                <?php  } else if($row['divi'] == 1) {?>
                    <form name="myForm" method="post" enctype="multipart/form-data" action="womens_details_modify.php?bno=<?php echo $row['b_no'] ?>" >
              <?php  }?>


            <div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
									<div class="productinfo text-center">
										<img src="<?php echo $row['b_image']?>"  style="height:300px"  alt="">
                    <input type="hidden" value="<?php echo $row['b_image']?>" name="b_image" />

                    <h2>	<?php echo $row["b_price"]?>원</h2>
                    <input type="hidden" name="b_price" value="<?php echo $row["b_price"]?>">

                    <p> 	<?php echo $row["b_title"]      ?></p>
                    <input type="hidden" name="b_title" value="<?php echo $row['b_title']?>" >
                    <input type="hidden" name="b_content" value="<?php echo $row["b_content"]?>" >
                    <input type="hidden" name="b_brand" value="<?php echo $row["b_brand"] ?>" >

									</div>
									<div class="product-overlay">
										<div class="overlay-content">
                      <img src="<?php echo $row['b_image']?>"  style="height:300px"  alt="">
                      <input type="hidden" value="<?php echo $row['b_image']?>" name="b_image" />
											<h2><?php echo $row["b_price"]      ?>원</h2>
											<p><?php echo $row["b_title"];      ?></p>
										<input type="submit" value="자세히 보기" />
										</div>
									</div>
								</div>
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
                    <!-- <form method="get" action="cart.php" enctype="multipart/form-data" id="cart_form"> -->
                        </form>

									    <!-- 여기바로수정해 -->

									  <!-- </form> -->
									</ul>
                  <form action="cart.php" method="post"enctype="multipart/form-data"  >


                    <i><input type="submit" value="장바구니" style="margin-left:93px" /> </i>



                  </form>
								</div>
							</div>


						</div>
            <?php
              }
            }
            ?>



              <!--샵 첫번째 아이템 부분 이곳에 추가버튼을 만들어 동적으로 아이템이 추가 되게 만든다..-->



					</div><!--features_ite`````ms-->
				</div>

              <!--이부분은 페이징 처리할떄 1,2,3, 이런식으로 페이지를 보여주는 부분-->
              <?php
               if(isset($emptyData))
               {
               }else{?>
              <div class="paging" >
                    <ul  style="margin-left:580px "class="pagination">
                    <li style="display:block">
                      <?php echo $paging ?>
                    </li>
                  </ul>

            </div>
          <?php }?>
			</div>
		</div>
	</section>

	<footer id="footer"><!--Footer-->
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="companyinfo">
							<h2><span>e</span>-shopper</h2>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,sed do eiusmod tempor</p>
						</div>
					</div>
					<div class="col-sm-7">
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="images/home/iframe1.png" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>

						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="images/home/iframe2.png" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>

						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="images/home/iframe3.png" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>

						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="images/home/iframe4.png" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="address">
							<img src="images/home/map.png" alt="" />
							<p>505 S Atlantic Ave Virginia Beach, VA(Virginia)</p>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="footer-widget">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Service</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="">Online Help</a></li>
								<li><a href="">Contact Us</a></li>
								<li><a href="">Order Status</a></li>
								<li><a href="">Change Location</a></li>
								<li><a href="">FAQ’s</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Quock Shop</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="">T-Shirt</a></li>
								<li><a href="">Mens</a></li>
								<li><a href="">Womens</a></li>
								<li><a href="">Gift Cards</a></li>
								<li><a href="">Shoes</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Policies</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="">Terms of Use</a></li>
								<li><a href="">Privecy Policy</a></li>
								<li><a href="">Refund Policy</a></li>
								<li><a href="">Billing System</a></li>
								<li><a href="">Ticket System</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>About Shopper</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="">Company Information</a></li>
								<li><a href="">Careers</a></li>
								<li><a href="">Store Location</a></li>
								<li><a href="">Affillate Program</a></li>
								<li><a href="">Copyright</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3 col-sm-offset-1">
						<div class="single-widget">
							<h2>About Shopper</h2>
							<form action="#" class="searchform">
								<input type="text" placeholder="Your email address" />
								<button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
								<p>Get the most recent updates from <br />our site and be updated your self...</p>
							</form>
						</div>
					</div>

				</div>
			</div>
		</div>

		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					Shared by <i class="fa fa-love"></i><a href="https://bootstrapthemes.co">BootstrapThemes</a></span></p>
				</div>
			</div>
		</div>

	</footer><!--/Footer-->



    <script src="js/jquery.js"></script>
	<script src="js/price-range.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
