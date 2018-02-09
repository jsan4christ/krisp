<?php		
		$keyword = strval($_POST['query']);
		$search_param = "{$keyword}%";
		$conn =new mysqli('localhost', 'root', 'theReal@dmin85!' , 'krisp');
	
		$sql = $conn->prepare("SELECT * FROM `b_installed_sw` WHERE sw_name LIKE ?");
		$sql->bind_param("s",$search_param);			
		$sql->execute();
		$result = $sql->get_result();
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$countryResult["sw_id"][] = $row["sw_id"];
				$countryResult["sw_name"][] = $row["sw_name"];
			}
			echo json_encode($countryResult);
		}
		$conn->close();
?>

