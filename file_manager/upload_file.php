<?php
			// código baseado no W3schools. http://www.w3schools.com/php/php_file_upload.asp
			
			//vetor contendo as extensões aceitas
			$extPermitidas = array("jpg","jpeg", "png", "gif", "mov", "mpg", "mp4", "3gp", "mp3", "aac");
			// separa a extensão do resto do nome do arquivo
			$temp = explode(".", $_FILES["file"]["name"]);
			$extensoes = end($temp);
			
			/*
					A organização das pastas onde ficam armazenadas as midias
					segue a ordem: /media/sensor_<numero>/
			*/
			$sensor_id_folder = "media/sensor_" . $_POST["sensor_id"];
			// Verifica se existe a pasta onde serão armazenadas as mídia. Cria uma nova caso seja necessário.
			if(!file_exists($sensor_id_folder)){
						mkdir($sensor_id_folder,0777, true);
			}
			
			//verifica se o arquivo e válido e se a extensão é aceita
			if ((($_FILES["file"]["type"] == "audio/x-aac")
						|| ($_FILES["file"]["type"] == "audio/mpeg3")
						|| ($_FILES["file"]["type"] == "audio/x-mpeg-3")
						|| ($_FILES["file"]["type"] == "video/3gpp")
						|| ($_FILES["file"]["type"] == "video/mp4")
						|| ($_FILES["file"]["type"] == "video/mpeg")
						|| ($_FILES["file"]["type"] == "video/quicktime")
						|| ($_FILES["file"]["type"] == "image/png")
						|| ($_FILES["file"]["type"] == "image/jpg")
						|| ($_FILES["file"]["type"] == "image/jpeg")
						|| ($_FILES["file"]["type"] == "audio/pjpeg")
						|| ($_FILES["file"]["type"] == "audio/x-png"))
						&& ($_FILES["file"]["size"] < 3000000)
						&& in_array($extensoes, $extPermitidas)){
						
						// caso ocorra algum erro ao abrir o arquivo, retorna o erro e encerra	
						if ($_FILES["file"]["error"] > 0){
									echo "Erro: " . $_FILES["file"]["error"] . "<br>";
						}
						else {
									// o codigo comentado abaixo serve para debug 
									//echo "Upload: " . $_FILES["file"]["name"] . "<br>";
									//echo "Type: " . $_FILES["file"]["type"] . "<br>";
									//echo "Size: " . $_FILES["file"]["size"] . "<br>";
									//echo "Stored in: " . $_FILES["file"]["tmp_name"] . "<br>";
									
									
									//Quando o usuario envia um arquivo, por padrao o PHP o coloca em uma pasta
									//Temporaria. O codigo abaixo move o arquivo para a pasta correta. 
									move_uploaded_file($_FILES["file"]["tmp_name"], $sensor_id_folder . "/" . $_FILES["file"]["name"]);
									//echo "Stored in: " . $sensor_id_folder . $_FILES["file"]["name"];
									echo "success";
						}
			}
			else {
						echo "Arquivo invalido!";
			}
?>