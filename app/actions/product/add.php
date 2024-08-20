<?php

// Cargar el JSON desde un archivo
$productos = file_get_contents('../../utils/product.json'); // Asegúrate de que la ruta sea correcta
$productosArray = json_decode($productos, true);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['img']) && $_FILES['img']['error'] == 0) {
        $allowedExts = array("jpg", "jpeg", "png", "webp");
        $extension = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
        if (in_array($extension, $allowedExts)) 
            $uploadDir = '../../public/img/';
            $fileName = uniqid() . '.' . $extension;
            $uploadFile = $uploadDir . $fileName;

            if (move_uploaded_file($_FILES['img']['tmp_name'], $uploadFile)) {
                $imgPath = '/app/public/img/' . $fileName; 
                $categoria = $_POST['categoria'];
                $nuevoProducto = array(
                    "id" => count($productosArray[$categoria]) + 1,
                    "title" => $_POST['title'],
                    "description" => $_POST['description'],
                    "precio" => $_POST['precio'],
                    "img" => $imgPath
                );
                $productosArray[$categoria][] = $nuevoProducto;
                $productos = json_encode($productosArray, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
                file_put_contents('../../utils/product.json', $productos);


                header("Location: ../../pages/administration.php"); 
                exit;
            } else {
                die("Error al mover el archivo cargado.");
            }
        } else {
            die("Formato de archivo no permitido.");
        }
    } else {
        die("Error al cargar la imagen.");
    }
?>
