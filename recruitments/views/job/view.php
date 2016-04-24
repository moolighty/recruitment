<div>
<?php       
    $this->title = '数据查看';
    echo "<div>";
    echo "<b>".$record['name']."</b>";
    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "</b><i><a hrmZf=".$record['url'].">".$record['company']."</a></i>";
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "<b>".$record['publish_time']."</b>";
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "<b>".$record['city']."</b>";
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "<b>月薪：".($record['min_salary']/1000)."K---".($record['max_salary']/1000)."K"."</b>";
	echo "<br><br>";
    echo  $record['technology_comment'];
?>
</div>
