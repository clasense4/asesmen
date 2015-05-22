<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title><?$h2_title?></title>

<link href="<?php echo base_url(); ?>" rel="stylesheet" type="text/css" />

</head>
<script type="text/javascript">
 function doSearch() {
	var searchName = document.getElementById('search').value;
    var targetTable = document.getElementById('tableKegiatan');
    var targetTableColCount;
    for (var rowIndex = 0; rowIndex < targetTable.rows.length; rowIndex++) {
        var rowData = '';

        if (rowIndex == 0) {
           targetTableColCount = targetTable.rows.item(rowIndex).cells.length;
           continue;
        }
              
	 //if (searchName != ""){
       //     rowData += targetTable.rows.item(rowIndex).cells.item().textContent;
		//	if (rowData.indexOf(searchName) == -1)
			//	targetTable.rows.item(rowIndex).style.display = 'none';
			//else
				//targetTable.rows.item(rowIndex).style.display = 'table-row';
       //}else{
		//	for (var defaultRow = 0; defaultRow < 10; defaultRow++) {
			//	targetTable.rows.item(defaultRow).style.display = 'table-row';
			//}
		
		//}
		
		//Process data rows. (rowIndex >= 1)
        for (var colIndex = 0; colIndex < targetTableColCount; colIndex++) {
            rowData += targetTable.rows.item(rowIndex).cells.item(colIndex).textContent;
        }

        //If search term (upper case) is not found in row data
        //then hide the row, else show
        if (rowData.toUpperCase().indexOf(searchName) == -1)
            targetTable.rows.item(rowIndex).style.display = 'none';
        else
            targetTable.rows.item(rowIndex).style.display = 'table-row';
       
    }
}
</script>
<body>
	<div class="content">
		<?php echo ! empty($h2_title) ? '<h2>' . $h2_title . '</h2>': ''; ?>
		<p><?php
			echo ! empty($message) ? '<p class="message">' . $message . '</p>': '';
			echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>': '';
	
			echo anchor('kegiatan/kegiatanxls/', 'Download Excel', array('class' => 'excel')).' | '.
			anchor('kegiatan/kegiatanpdf/', 'Download Pdf', array('class' => 'pdf'));
			echo "<br> <br>";
		?></p>
		<div>
			<a href="#" onclick="doSearch();"  onmouseover="this.style.cursor='pointer'" style="cursor: pointer;"><img src="<?php echo base_url()?>images/11.png" charset="UTF-8"></a>
			<input size="28" maxlength="40" id="search" type="text" name="search" placeholder="search" class="search"/>
			<br><br>
		</div>
		<div id="pagination"><?php echo ! empty($pagination) ? '<p id="pagination">' . $pagination . '</p>' : ''; ?></div>
		<div class="data"><?php echo ! empty($table) ? $table : ''; ?></div>
		<br />
		<?php echo anchor('kegiatan/add/','tambah data',array('class'=>'add')); ?>
	</div>
</body>
</html>