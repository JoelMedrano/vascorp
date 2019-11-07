<?php
	$formatos   = array('.gz');
	$directorio = 'E:/backup'; 
	if (isset($_POST['boton'])){
		$nombreArchivo    = $_FILES['archivo']['name'];
		$nombreTmpArchivo = $_FILES['archivo']['tmp_name'];
		$ext              = substr($nombreArchivo, strrpos($nombreArchivo, '.'));
		if (in_array($ext, $formatos)){
			if (move_uploaded_file($nombreTmpArchivo, "$directorio/$nombreArchivo")){
				echo "Felicitaciones, archivo $nombreArchivo subido exitosamente";
			}else{
				echo 'Ocurrió un error subiendo el archivo, valida los permisos de la carpeta "archivos"';
			}
		}else{
			echo 'Aquí va el mensaje que quieres mostrar cuando un usuario suba un archivo con una extensión diferente';
		}
	}
?>

<div class="content-wrapper">

    <section class="content-header">

        <h1>

            Backup Disponibles

        </h1>

    </section>
    <section class="content">

        <div class="box">

            <div class="box-header with-border">

            <label>Selecciona tu archivo</label>

            <form method="post" action="" enctype="multipart/form-data">

                <div class="form-group">

                    <label for="archvio">Archivo</label>

                    <input type="file" class="form-control-file" id="archvio" name="archivo">

                    <small id="fileHelp" class="form-text text-muted">Archivos permitidos (.sql .gz)</small>

                </div>

                <button type="submit" class="btn btn-primary" name="boton"><i class="fa fa-upload"></i> Subir archivo</button>
                <a href="backupDB" id="bkp" name="bkp" class="btn btn-success"><i class="fa fa-database"></i> Hacer BackUp</a>

            </form>
        
            </div>

            <div class="box-body">

            <?php

            if ($dir = opendir($directorio)){
                while ($archivo = readdir($dir)) {
                    if ($archivo != '.' && $archivo != '..'){
                        //este div es para darle caché y que se vea bien en todos los dispositivos. son clases del nuevo bootstrap -> framewrok css
                        echo '<div>';
                            echo "Archivo: <span style='font-size:100%' class='label label-primary'>$archivo</span><br />";
                            
                        echo '</div>';
                    }
                }
            }

            ?>

            </div>

        </div>

    </section>
</div>