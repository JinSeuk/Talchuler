<?
include('./include.php');
//�ٹ� ���ε� ��û�� �����
$sql="delete from album where al_idx='".$_GET['al_idx']."';";
mysql_query($sql);

//partner�� �ٹ� ��û ���� ���δ�
	//������ �ٹ� ��û �� ��ȸ
	$sql="select album_count from partner where p_id='".$_GET['p_id']."'";
	$q=mysql_query($sql);
	$data=mysql_fetch_array($q);

$sql="update partner set album_count='".$data[0]."'-1 where p_id='".$_GET['p_id']."'";
mysql_query($sql);

//�������丮�� ���ϵ� ��������	
echo(rename("../partner/albumAsk/".$_GET['filename'].".jpg", "/home/hosting_users/talchuler6/www/partner/albumTrash/".$_GET['filename'].".jpg"));

?>
<script>
history.back();
</script>
