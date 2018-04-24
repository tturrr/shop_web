<?php
include "session.php";
 include "dbConnect.php";
 $bNo = $_GET['bno'];



$sql = 'SELECT b_no, b_title, b_content, b_price, b_hit, b_brand, b_image from man_board where b_no = ' . $bNo;

$result = $dbConnect->query($sql);

$row = $result->fetch_assoc();

if(!empty($bNo) && empty($_COOKIE['man_board_' . $bNo])) {

		$sql = 'UPDATE man_board set b_hit = b_hit + 1 where b_no = ' . $bNo;

		$result = $dbConnect->query($sql);

		if(empty($result)) {

			?>

			<script>

				alert('오류가 발생했습니다.');

				history.back();

			</script>

			<?php

		} else {

			setcookie('man_board_' . $bNo, TRUE, time() + (60 * 60 * 24), '/');

		}

	}


 ?>


<!DOCTYPE html>





<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Product Details | E-Shopper</title>


    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
  <link href="css/modify_delete.css" rel="stylesheet">
  <link href="css/textarea_auto.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
    <script src="./js/jquery.js"></script>

    <style>
textarea.autosize { min-height: 50px; }
</style>


<script>
function resize(obj) {
  obj.style.height = "1px";
  obj.style.height = (12+obj.scrollHeight)+"px";
}
</script>

    <script>

    	$(document).ready(function () {
        var commentSet = '';
    		var action = '';
    		$('#commentView').delegate('.comt', 'click', function () {
    			//현재 위치에서 가장 가까운 commentSet 클래스를 변수에 넣는다.
      		var thisParent = $(this).parents('.commentSet');

    			//현재 작성 내용을 변수에 넣고, active 클래스 추가.
    			var commentSet = thisParent.html();
    			thisParent.addClass('active');

    			//취소 버튼
    			var commentBtn = '<a href="#" class="addComt cancel">취소</a>';

    			//버튼 삭제 & 추가
    			$('.comt').hide();
    			$(this).parents('.commentBtn').append(commentBtn);
    			//commentInfo의 ID를 가져온다.

    			var co_no = thisParent.attr('id');
    			//전체 길이에서 3("co_")를 뺀 나머지가 co_no

    			co_no = co_no.substr(3, co_no.length);

    			//변수 초기화
    			var comment = '';
    			var coId = '';
    			var coContent = '';
    			if($(this).hasClass('write')) {
    				//댓글 쓰기
    				action = 'w';
    				//ID 영역 출력
    				coId = '<input type="text" name="coId" id="coId">';
    			} else if($(this).hasClass('modify')) {
    				//댓글 수정
    				action = 'u';
    				coId = thisParent.find('.coId').text();
    				var coContent = thisParent.find('.commentContent').text();
    			} else if($(this).hasClass('delete')) {

    				//댓글 삭제
    				action = 'd';
    			}
    				comment += '<div class="writeComment">';
    				comment += '	<input type="hidden" name="w" value="' + action + '">';
    				comment += '	<input type="hidden" name="co_no" value="' + co_no + '">';
    				comment += '	<table>';
    				comment += '		<tbody>';
    				if(action !== 'd') {
    					comment += '			<tr>';
    					comment += '				<th scope="row"><label for="coId">아이디</label></th>';
    					comment += '				<td>' + coId + '</td>';
    					comment += '			</tr>';
    				}
    				comment += '			<tr>';
    				comment += '				<th scope="row">';
    				comment += '			<label for="coPassword">비밀번호</label></th>';
    				comment += '				<td><input type="password" name="coPassword" id="coPassword"></td>';
    				comment += '			</tr>';
    				if(action !== 'd') {
    					comment += '			<tr>';
    					comment += '				<th scope="row"><label for="coContent">내용</label></th>';
    					comment += '				<td><textarea name="coContent" id="coContent">' + coContent + '</textarea></td>';
    					comment += '			</tr>';
    				}
    				comment += '		</tbody>';
    				comment += '	</table>';
    				comment += '	<div class="btnSet">';
    				comment += '		<input type="submit" value="확인">';
    				comment += '	</div>';
    				comment += '</div>';
    				thisParent.after(comment);
    			return false;

    		});



    		$('#commentView').delegate(".cancel", "click", function () {
    				$('.writeComment').remove();
    				$('.commentSet.active').removeClass('active');
    				$('.addComt').remove();
    				$('.comt').show();
    			return false;
    		});
    	});

    </script>



</head><!--/head-->

<body>
	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href=""><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
                <li><a href=""><?php echo $_SESSION['ses_userid'];
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
					<div class="col-sm-9">
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
								<li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="hot.php">Products</a></li>
										<li><a href="product-details.html" class="active">Product Details</a></li>
										<li><a href="checkout.html">Checkout</a></li>
										<li><a href="cart.html">Cart</a></li>
										<li><a href="login.html">Login</a></li>
                                    </ul>
                                </li>
								<li class="dropdown"><a href="#">Blog<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="blog.php">Blog List</a></li>
										<li><a href="blog-single.html">Blog Single</a></li>
                                    </ul>
                                </li>

								<li><a href="contact-us.html">Contact</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="search_box pull-right">
							<input type="text" placeholder="Search"/>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->

	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
					</div>
				</div>

        <!--모달 버튼을 생성해보는곳.-->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
              <div class="modal-content">
<div class="modal-header">
<div class="modal-body">
  <form action="product-details.php" method="post" enctype="multipart/form-data">
             <input type="file" name="profile" multiple accept='image/*'>
             <input type="submit">
         </form>
    <div class="modal-footer">
      </div>
        </div>
       </div>
    </div>
  </div>
</div>




				<div class="col-sm-9 padding-right">
					<div class="product-details"><!--product-details-->
						<div class="col-sm-5">
							<div class="view-product">



                  <img src="<?php echo $row["b_image"]?>" alt="" name="profile">




								<h3>ZOOM</h3>
							</div>
							<!-- <div id="similar-product" class="carousel slide" data-ride="carousel"> -->

								  <!-- Wrapper for slides -->
								    <!-- <div class="carousel-inner">
										<div class="item active">
										  <a href=""><img src="images/product-details/similar1.jpg" alt=""></a>
										  <a href=""><img src="images/product-details/similar2.jpg" alt=""></a>
										  <a href=""><img src="images/product-details/similar3.jpg" alt=""></a>
										</div>
										<div class="item">
										  <a href=""><img src="images/product-details/similar1.jpg" alt=""></a>
										  <a href=""><img src="images/product-details/similar2.jpg" alt=""></a>
										  <a href=""><img src="images/product-details/similar3.jpg" alt=""></a>
										</div>
										<div class="item">
										  <a href=""><img src="images/product-details/similar1.jpg" alt=""></a>
										  <a href=""><img src="images/product-details/similar2.jpg" alt=""></a>
										  <a href=""><img src="images/product-details/similar3.jpg" alt=""></a>
										</div>

									</div> -->

								  <!-- Controls -->
								  <!-- <a class="left item-control" href="#similar-product" data-slide="prev">
									<i class="fa fa-angle-left"></i>
								  </a>
								  <a class="right item-control" href="#similar-product" data-slide="next">
									<i class="fa fa-angle-right"></i>
								  </a>
							</div> -->

						</div>

						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->






              <!--아이템의 제목부분 입니다 -->

								<img src="images/product-details/new.jpg" class="newarrival" alt="" />

                  <h2> 	<?php echo $row["b_title"]      ?></h2>


								<span>
									<span>가격 </span>

                      <h2>	<?php echo $row["b_price"]?></h2>


								</span>

								<p><b>브랜드: </b> <?php echo $row["b_brand"]?> </p>
                <p><b>조회수: </b> <?php echo $row["b_hit"]?> </p>


                  <!--메인사진을 업로드하는 부분 입니다.-->




							</div><!--/product-information-->

						</div>
					</div><!--/product-details-->

          <?php

            if($_SESSION['ses_userid'] == "root"){
              ?>
                    <h3 style="margin-left : 730px;">상품</h3>
                    <?php
                  }?>
          <!-- 조건을 주어서 root 아이디로 들어왔을떄만 수정과 삭제가 가능하게 만든다.  -->

                      <?php

                        if($_SESSION['ses_userid'] == "root"){
                          ?>
                        <div style="margin-left : 670px;">

                      <div class="btn btn-default get" >
                        <a href="./men_details.php?bno=<?php echo $row['b_no'] ?>">수정</a>
                      </div>

                        <div class="btn btn-default get">
                             <a href="./men_delete_shop.php?bno=<?php echo $row['b_no'] ?>">삭제</a>
                        </div>

                        <div class="btn btn-default get">
                             <a href="./men_shop.php">목록</a>
                           </div>
                             </div>
                          <?php
                       }else {
                         ?>
                           <div style="margin-left : 755px;">
                             <div class="btn btn-default get">
                                  <a href="./men_shop.php">상품 목록</a>
                                </div>
                                  </div>
                                  <?php
                       }

                       ?>
                       <!--여기까지가 root 로 들어왔을때 수정삭제 가능하도록하는 부분. -->

					<div class="category-tab shop-details-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li><a href="#details" onclick="hi" data-toggle="tab">Details</a></li>

								<li class="active"><a href="#reviews" data-toggle="tab">Reviews (5)</a></li>
							</ul>

						</div>
						<div class="tab-content">
							<div class="tab-pane fade"  id="details" >




                <!--이곳에다가 세부정보를 적는다.-->


                <div >


              <textarea id="hi"  class="autosize" onkeyup="resize(this)" onkeydown="resize(this)" name="name" readonly="readonly" rows="8" cols="80"><?php echo $row["b_content"] ?></textarea>
            </div>




							</div>

              <!--게시글 작성 완료 버튼으로 완료누를시 정보를 shop.php로 옮긴다.-->







							<div class="tab-pane fade" id="companyprofile" >
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="imzages/home/gallery1.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>



							</div>

							<div class="tab-pane fade" id="tag" >
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery1.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery2.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery3.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery4.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
							</div>

              <!-- 댓글을 작성할 수 있다.-->
              <div class="tab-pane fade active in" id="reviews" >

                <div class="col-sm-12">
                  <ul>
                    <form action="comment_update.php" method="post">
                      <input type="hidden" name="bno" value="<?php echo $bNo?>">
                      <input type="hidden" name="coId" id="coId" value="<?php echo $_SESSION['ses_userid'];?>">
                      <input type="hidden" name="cdate" id="cdate" value="<?php echo date("Y-m-d H:i:s");?>">
                    <li><i class="fa fa-user"></i> <?php echo $_SESSION['ses_userid'];?></p></li>
                    <li><i class="fa fa-calendar-o"></i><?php echo date("Y-m-d H:i:s");?></li>
                  </ul>
                </div>



                    <textarea style="min-width:100%;height:100px;" placeholder="댓글을 작성하여 주세요." style="color:Black "name="coContent" id="coContent" > </textarea>

                    <button input type="submit" class="btn btn-default pull-right" style="background-color:#FE980F" >
                      작성완료
                       </button>


                  </form>





                  <!--댓글의 댓글을 달수 있도록 구현하는 부분-->

              <?php

	             $sql = 'SELECT * from comment where co_no=co_order and b_no ="'. $bNo .'" order by co_no desc';

	              $result = $dbConnect->query($sql);
                ?>
                <div id="commentView">
                <form action="comment_shop_update.php" method="post">

		              <input type="hidden" name="bno" value="<?php echo $bNo?>">
                  <?php

		                while($row = $result->fetch_assoc()) {
	                  ?>




  <div   class="tab-pane fade active in" id="reviews" >
    <div class="col-sm-12" >
      <ul>
        <li><i class="fa fa-user"></i> <?php echo $row['co_id'];?></p></li>
        <li><i class="fa fa-calendar-o"></i><?php echo $row['date']?></li>
      </ul>
      <div class="commentBtn">


    <?php


  $sql2 = 'SELECT * from comment where co_no!=co_order and co_order=' . $row['co_no'];

  					$result2 = $dbConnect->query($sql2);



  					while($row2 = $result2->fetch_assoc()) {

  				?>
          <ul class="twoDepth">

					<li>

            <div id="co_<?php echo $row2['co_no']?>" class="commentSet">

            							<div class="commentInfo">

            								<div class="commentId">작성자:  <span class="coId"><?php echo $row2['co_id']?></span></div>

            								<div class="commentBtn">

            									<a href="#" class="comt modify">수정</a>

            									<a href="#" class="comt delete">삭제</a>

            								</div>

            							</div>

            							<div class="commentContent"><?php echo $row2['co_content'] ?></div>

            						</div>

            					</li>

            				</ul>

                    <?php

					}

				?>



    </div>

      <textarea style="background-color:#EFFBFB; color:Black; min-width:100%;height:100px;" readonly="readonly"><?php echo $row['co_content'];?></textarea>





  </div>
</div>


<?php }
?></form>
</div>














						</div>
					</div><!--/category-tab-->



				</div>
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
							<div class="video-gallery -center">
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
							<div class="video-gallery -center">
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
							<div class="video-gallery -center">
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
							<div class="video-gallery -center">
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
								<input type="" placeholder="Your email address" />
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
