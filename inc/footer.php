<?php require_once("notice.import.php");?> <!-- 코드 추가 부분-->

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- 이전의 head 부분 -->
    <style>
.table_row {
    display: flex;
    overflow:auto;
}

.table_title {
    flex: 70;
    padding: 10px;
}

.table_date {
    margin-left: auto;
    padding: 10px;
}
    </style>
</head>

<footer>
        <div class="footer_nav_wrapper">
            <div class="customer_center_wrapper">
                <span class="customer_center_title">Customer Center</span>
                <button class="return_fast"><a href="my-page_inquiry.php"> 고객 문의</a></button>
                <button class="question_kakao"><a href="http://pf.kakao.com/_FQkxjG">카카오톡 채팅 문의</a></button>
                <div class="haru_call_wrapper">
                    <i class="fas fa-phone-alt"></i>
                    <span>&nbsp;010-9362-6554</span>
                </div>
            </div>
            <div class="haru_operating_time_wrapper">
                <span class="haru_operating_time_title">Time</span>
                <span class="call_time_title">전화 상담</span>
                <p class="call_time">평일 : 10:00 ~ 18:00 <br />
                    토요일 : 10:00 ~ 15:00 </p>
                <span class="katalk_time_title">카톡 상담</span>
                <p class="katalk_time">평일 : 10:00 ~ 18:00 <br />
                    토요일 : 10:00 ~ 15:00</p>
            </div>
            <div class="notice_wrapper">
    <span class="notice_title">Notice</span>
    <div class="notice_container">
        <?php foreach ($result as $r): ?>
            <a href="notice_mainview.php?num=<?php echo $r['num']; ?>"> 
                <div class="table_row">
                    <!-- <div class="table_col class"><?php echo $r['num']; ?></div> -->
                    <div class="table_title"><?php echo $r['title']; ?></div>
                    <!-- <div class="table_col writer"><?php echo $r['writer']; ?></div> -->
                    <div class="table_date"><?php echo $r['regtime']; ?></div>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</div>
        </div>
        <div class="footer_nav_wrapper">
            <div class="guide_wrapper">
                <span class="guide_title">GUIDE</span>
                <a href="spotore.php" class="SPOTORE_info">SPOTORE 소개</a>
                <a href="terms_service.php" class="terms_service">이용약관</a>
                <a href="privacy_policy.php" class="privacy_policy">개인정보 처리방침</a>
            </div>
            <div class="about_us_wrapper">
                <span class="about_us_title">SOCIAL</span>
                <a href="https://www.instagram.com/spotore_official" class="membership_info">INSTAGRAM</a>
            </div>
        </div>
        <div class="footer_haru_info">
            <span class="about_haru_title">ABOUT SPOTORE</span>
            <ul>
                <li>상호 : SPOTORE</li>
                <li>
                    <address>&nbsp;&nbsp;사업장 소재지 : 경기도 수원시<br>&ensp;&ensp;&ensp;권선구 덕영대로 1217번길</address>
                </li>
                &nbsp;&nbsp;<li>사업자 등록 번호 : 210308-220907</li>
                &nbsp;&nbsp;<li>대표 이사 : 김승민</li>
                &nbsp;&nbsp;<li>대표 전화 : 010-9362-6554</li>
            </ul>
            <ul>
                <li>COPYRIGHT(c) 2023 SPOTORE ALL RIGHT RESERVED.</li>
            </ul>
        </div>
    </footer>