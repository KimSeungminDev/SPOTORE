<?php require_once("session.php");?>

<div id="header_wrapper">
        <header>
            <ul class="util_nav">
                <?php

                if (isset($_SESSION['member_id']) === false){
                ?>
                <li class="util_nav01">
                    <a href="sign_up.php"><span>회원가입</span></a>
                </li>
                <li class="util_nav02">
                <a href="#" onclick="return preventClick();"><span>고객문의</span></a>
                </li>
                <li class="util_nav03">
                    <a href="login.php"><span>로그인</span></a>
                </li>
                <?php
                }else{
                ?>
                <li class="util_nav01">
                    <a href="my-page_order.php"><span>마이페이지</span></a>
                </li>
                <li class="util_nav02">
                    <a href="my-page_inquiry.php"><span>고객문의</span></a>
                </li>
                <li class="util_nav03">
                    <a href="logout.php"><span>로그아웃</span></a>
                </li>
                <?php
                }
                ?>


                
            </ul>
            <div class="main_nav">
                <a href="index.php" class="logo_link_index">
                    <div class="logo_wrapper">
                        <!-- <img class="logo" src="" alt=""> -->
                        <img class="logo" src="img/spotore.png" alt="SPOTORE" herf="localhost/spotore/index.php">
                        <!-- <span class="logo" img src="img/logo.png">SPOTORE</span> -->
                    </div>
                </a>

                
                <!-- <div class="like_nav">
                    <i class="far fa-heart fa-1x"></i>
                    <span class="like_nav_title">찜한 상품</span>
                </div> -->
                <a href="my-page_order.php" <?php echo isset($_SESSION['member_id']) === false ? 'onclick="return preventClick();"' : ''; ?>>
                <div class="my_page_nav">
                    <i class="far fa-user fa-1x"></i>
                    <span class="my_page_nav_title">마이페이지</span>
                </div>
            </a>
            <a href="cart.php" <?php echo isset($_SESSION['member_id']) === false ? 'onclick="return preventClick();"' : ''; ?>>
                <div class="cart_nav">
                    <i class="fas fa-shopping-bag fa-1x"></i>
                    <span class="cart_nav_title">장바구니</span>
                </div>
            </a>
                <!--검색창-->
                <style>
  /* Chrome, Safari, Edge */
  input[type="search"]::-webkit-search-cancel-button,
  input[type="search"]::-webkit-search-clear-button {
    -webkit-appearance: none;
    appearance: none;
    display: none;
  }
</style>

<div class="search_wrapper">
  <form class="d-flex" method="get" action="search_list.php" onsubmit="return validateSearch()">
    <fieldset class="field-container">
      <input
        class="form-control me-2 field"
        type="search"
        placeholder="Search..."
        aria-label="Search"
        name="search"
        id="searchInput"
      />
      <div class="icons-container">
        <div class="icon-search" onclick="submitSearch()"></div>
      </div>
    </fieldset>
  </form>
</div>


<script>
    function validateSearch() {
        var searchValue = document.getElementById('searchInput').value;

        if (searchValue.trim() === '') {
            alert('입력된 값이 없습니다.');
            return false; // 이동을 멈춥니다.
        }

        return true; // 이동을 허용합니다.
    }

    function submitSearch() {
        if (validateSearch()) {
            document.forms[0].submit(); // 폼 제출
        }
    }

    function preventClick() {
        alert('로그인 후 이용 가능합니다.');
        return false;
        location.href = "paydirect.php";
    }
    
</script>

                
<!--                <div class="hot_issue_wrapper">
                    <div class="hot_issue_under_line">
                        <div class="hot_issue">
                            <ul id="ticker_01" class="ticker">
                                <li><span class="rank">1. </span><a href="#">가을신상</a></li>
                                <li><span class="rank">2. </span><a href="#">아우터</a></li>
                                <li><span class="rank">3. </span><a href="#">가방신상</a></li>
                                <li><span class="rank">4. </span><a href="#">코트</a></li>
                            </ul>
                        </div>
                        <i class="fas fa-caret-down"></i>
                    </div> 
-->

                </div>
            </div>
            <div class="main_menu_wrapper">
<!--                 <a href="view_more_menu.php">
                   <div class="main_menu_detail">
                    <i class="fas fa-bars fa-2x"></i>
					</div>
                </a>
-->                
                <ul class="main_menu_bar">
                    <!-- <li class="main_menu01"><a href="event.php">이벤트</a></li> -->
                    <li class="main_menu02"><a href="magazine.php">이벤트&기획전</a></li>
                    <li class="main_menu03"><a href="todaygo.php">오늘출발</a></li>
                    <li class="main_menu04"><a href="sale.php">BIG SALE</a></li>
                    <li class="main_menu05"><a href="soccer.php">축구</a></li>
                    <li class="main_menu06"><a href="base.php">야구</a></li>
                    <li class="main_menu07"><a href="basket.php">농구</a></li>
                    <li class="main_menu08"><a href="volley.php">배구</a></li>
                    <!-- <li class="main_menu09"><a href="nfl.php">미식축구</a></li>
                    <li class="main_menu10"><a href="f1.php">F1</a></li>
                    <li class="main_menu11"><a href="nhl.php">하키</a></li>
                    <li class="main_menu12"><a href="ufc.php">UFC</a></li> -->
                    <li class="main_menu09"><a href="esports.php">E스포츠</a></li>
                    <!-- <li class="main_menu14"><a href="goods.php">굿즈</a></li> -->
                    
                </ul>
                
               <!-- <div class="delivery_today"><span>오늘출발</span></div> -->
               
            </div>
            
        </header>
    </div>