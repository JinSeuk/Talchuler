<html>
<head>
<title>�ٳ� �޴��� ����</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
</head>
<body>
<?php
	/*
	 * Ư�� URL ����
	 */
	//$nextURL = "http://www.danal.co.kr";

	/*
	 * â �ݱ� Script
	 */
	$nextURL = "Javascript:self.close();";
?>
<form name="BackURL" action="<?=$nextURL?>" method="post">
</form>
<script Language="Javascript">
	document.BackURL.submit();
</script>
</body>
</html>
