<?php
			// Código referencia: http://www.media-division.com/the-right-way-to-handle-file-downloads-in-php/
			
			$path_parts = pathinfo($_POST["file"]);
			$file_name = $path_parts["basename"];
			// fornece o caminho completo do arquivo, incluindo a pasta
			$file_path = "media/sensor_" . $_POST["sensor_id"] . "/" . $file_name;
			
			set_time_limit(0);
			$file=@fopen($file_path, "rb");

			if (file_exists($file_path)){
						//Cabeçalho para informar o browser que sera transferido um arquivo para download
						//Se comentar todos os headers abaixo, os dados serão transferidos diretamente para o browser
						header('Content-Description: File Transfer');
						header('Content-Type: application/octet-stream');
						header('Content-Disposition: attachment; filename=' .basename($file_path));
						header('Expires: 0');
						header('Cache-control: must-revalidade');
						header('Content-length: ' .filesize($file_path));
						
						//Abre o arquivo e inicia o processo de transferência de arquivos
						while(!feof($file)){
									// output dos dados lidos em partes de tamanho 8.192
									print(@fread($file, 1024*8));
									ob_flush();
									flush();
						}
			}
			else{
						echo "Arquivo nao encontrado: " . $file_path;
			}
?>