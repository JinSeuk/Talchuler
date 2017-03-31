<html>
<script src="http://code.jquery.com/jquery-latest.min.js"></script>

<style>
body{
	margin:0;
	padding:0;
}
.Main{
	width:100%;
	height:740px;
}
#Head{
	width:100%;
	height:68px;
	background-color: #56dcfc
}
#Head .hdmenu{
    position: absolute;
    top: 1%;
	margin-left: 40px;
	display:table;
}
#Head .hdmenu > li {
	width:20%;
    margin-left:20%;
	display:table-cell;
}
.main_logo{
	position:absolute;
	height:50px;
	width:200px;
	
	left:-30px;
	top:-10px;
}
#Tab{
	float:left;
	width:220px;
	height:740px;
	background-color:#cccccc;
}
#Tab .tbmenu > li{
	float: center;
	margin-top:20px;
	font-size:17px;
}
ul{
    list-style:none;
}
.tbmenu li{cursor:pointer;}
.tbmenu .hide{display:none;}
</style>
<body>
	<div id="Head">
		<ul class='hdmenu'>
		<li>
			<h1>
			<a href="../index.php">
			<img class='main_logo' src="./images/common/bg_gnbtop.png" >
			</a>
			</h1>
		</li>
		<li>ESC홍대지점</li>
		<li>2017.02.02(월) 22:25</li>
		<li>4/11후기관리 업데이트 안내</li>
		</ul>
	</div>
	
	<div id="Tab">
	<ul class='tbmenu'>
	<li>내 카페관리</li>
		<ul class="hide">
			<a href=""><li>오늘의 게임</li></a>
			<a href=""><li>예약 관리</li></a>
			<a href=""><li>후기 관리</li></a>
			<a href=""><li>카페정보관리/앨범</li></a>
			<a href=""><li>게임정보관리</li></a>
		</ul>
	<li>서비스이용</li>
		<ul class="hide">
			<a href=""><li>타임핫딜</li></a>
			<a href=""><li>인사이트</li></a>
			<a href=""><li>예약 통계</li></a>
			<a href=""><li>후기 통계</li></a>
		</ul>
	<li>서비스소개</li>
		<ul class="hide">
			<a href=""><li>타임커머스</li></a>
			<a href=""><li>메인추천광고</li></a>
			<a href=""><li>상위노출광고</li></a>
			<a href=""><li>패키지광고</li></a>
		</ul>
	<li>고객센터</li>
		<ul class="hide">
			<a href=""><li>알림/실행</li></a>
			<a href=""><li>공지사항</li></a>
			<a href=""><li>1:1문의</li></a>
			<a href=""><li>FAQ</li></a>
			<a href=""><li>약관 및 정책</li></a>
		</ul>
	</div>
	<!--Content가 들어갈 중간 영역입니다-->