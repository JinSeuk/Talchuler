<html>
<link rel="stylesheet" type="text/css" href="../css/style.css"/>
<style>
body{
	margin:0;
	padding:0;
}
.Head{
	width:100%;
	height:68px;
	border:1px solid;
}
.Tab{
	float:left;
	width:220px;
	height:100%;
	border:1px solid;
}
.Main{
	border:1px solid;
	width:100%;
	height:100%;
}
./*body*/{
	width:100%;
	margin-top:-20px; /*기본 셋팅에 20px이 들어가있기때문에 빼준다*/
}
.tb{
	width:80%;
	margin-left:20%;
	margin-top:2%;
	border-bottom:1px;
}
</style>
<body>
	<div class="Head">
		헤드 부분입니다.
	</div>
	<div class="Tab">
		탭 부분입니다.
	</div>
	<!--*body*-->
	<div class="Main">
		<table class="tb">
			<tr>
			<td colspan="1.5">회원가입</td>
			<td colspan="1">약관동의</td>
			</tr>
		</table>
	</div>

<br><br>
	<div class="Footer">
		<?
		include("./include_footer.php");
		?>
	</div>
</body>
</html>