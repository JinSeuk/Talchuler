<?
include('./include.php');

/*��ü����
���� �Ѿ���°� �ƴ϶�, ��ü������ üũ�ϸ�
�ٸ��༮�鵵 �� üũ�ǰ� �ض� */

//�κн���
//���ο�û�� 100������ ���ϼ��־�.
for($i=0; $i<100; $i++){
	if($_POST['check'.$i]=='on'){
		$sql="select al_idx,p_id, filename from album where al_idx=".$i.";";
		$q=mysql_query($sql);
		$data=mysql_fetch_array($q);
		/*���õǾ� �Ѿ���� �༮�� ����
		�����ε����� $data['al_idx']
		�����ø������ $data['p_id'], 
		��, al_idx�� partner�� albumAsk���Ͼȿ� ��Ģ�� ���ؼ� 1���� �����ϰԵȴ�.
		����, �Ѿ���� check���� 0���Ͱ� �ƴ϶� 1���� �����Ѵ�.
		�̶�, ���丮�� ����Ǵ� ������ 0�������� ����ض�*/

		//1.������ album�÷��� �������Ѷ�
			//partner�� album���� ������Ű������ ���� ������ �ľ��Ѵ�
				//album�� ��������, album_count�� ���ε��û����.
			$sql="select album, album_count from partner where p_id='".$data['p_id']."'";
			$q=mysql_query($sql);
			$album=mysql_fetch_array($q);

	//���		echo($album['album']." ".$album['album_count']."<br>");
  
			//�Ѿٹ��� 1����, �ٹ���û�� 1����
			$sql="update partner set album='".$album['album']."'+1 , album_count='".$album['album_count']."'-1 where p_id='".$data['p_id']."'";
			mysql_query($sql);
			

		//2.�������̵����Ѷ�		
		echo(rename("../partner/albumAsk/".$data['filename'].".jpg", "/home/hosting_users/talchuler6/www/partner/album/".$data['filename'].".jpg"));
		//3. album Į���� ���� ������̴� �༮�� filename�� path�� ���ҵ��� �ҷ��;� �ϹǷ� album_path���̺� ���������Ѵ�.
		$sql="insert into album_path (ap_idx, p_id, path) values ('','".$data['p_id']."','".$data['filename']."')";
		mysql_query($sql);

		//4. album Į���� ������̴� �༮�� ���ش�.
		$sql="delete from album where al_idx='".$data['al_idx']."'";
		mysql_query($sql);
		
		//5.������ album_count�� ���ҽ��Ѷ�
		$sql="update partner set album_count='".$album['album_count']."'-1 where p_id='".$data['p_id']."'";
		mysql_query($sql);

	}
}
?>
<script>
history.back();
</script>