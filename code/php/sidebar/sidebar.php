<?php
	include dirname(__FILE__,2) . '/config.php';;
	include $main_location . '/connection/conn.php';

	$assigned_menus = array();
	
	$query = "";
	
	if ($_SESSION["position"] == "Seller") {
		$query = " AND id = 1 ";
	}
	
	$header_sql = "SELECT * FROM eb_mainlink WHERE 1 $query AND is_active = 1 ORDER BY sort ASC;";
	
	$header_result     = mysqli_query($con,$header_sql);
	while ($row_header = mysqli_fetch_row($header_result)) {
		$header_id     = $row_header[0];
		$header_menu   = $row_header[1];
		$header_icon   = $row_header[2];
		
		if ($_SESSION["position"] == "Seller") {
			$query = " AND a.menuDetailsID IN (20,22,24,26,32) ";
		}
		
		if ($_SESSION["position"] == "Administrator") {
			$query = " AND a.menuDetailsID IN (1,27,26,29,30) ";
		}

		echo '<li class="mm-active">';
		echo '	<a href="javascript: void(0);" class="has-arrow">';
		echo '		<i data-feather="'.$header_icon.'"></i>';
		echo '		<span data-key="t-apps">'.$header_menu.'</span>';
		echo '	</a>';

		$detail_sql        = "
			
			SELECT
				b.detail_menu_name,
				b.detail_menu_icon,
				b.php_page,
				b.description
			FROM
				eb_connector a
			INNER JOIN
				eb_sublink b
			ON
				a.menuDetailsID = b.id
			WHERE
				a.menuHeaderID = $header_id $query
			GROUP BY
				a.menuHeaderID,
				a.menuDetailsID
		
		";
		$detail_result     = mysqli_query($con,$detail_sql);
		while ($row_detail = mysqli_fetch_row($detail_result)) {
			$detail_menu   = $row_detail[0];
			$detail_icon   = $row_detail[1];
			$detail_file   = $row_detail[2];
			$detail_desc   = $row_detail[3];
			$li_id_name    = strtolower(str_replace(array('_'),"",$detail_file));
			
			echo '<ul class="sub-menu" aria-expanded="false">';
			echo '	<li>';
			echo '		<a id="amenu-'.$li_id_name.'" href="'.$detail_file.'" data-header="'.$header_menu.'" data-details="'.$detail_menu.'" data-description="'.$detail_desc.'">';
			echo '			<span data-key="t-calendar">'.$detail_menu.'</span>';
			echo '		</a>';
			echo '	</li>';
			echo '</ul>';

			$assigned_menus[] = $detail_file;
		}
			
		echo '</li>';
	}

	/* add this also not default menus */
	$assigned_menus[] = 'not_found';
	$assigned_menus[] = 'profile';
	$assigned_menus[] = 'server_maintenance';
	$assigned_menus[] = 'message_counting';

	mysqli_free_result($header_result);
	mysqli_free_result($detail_result);
	mysqli_close($con);
?>
						