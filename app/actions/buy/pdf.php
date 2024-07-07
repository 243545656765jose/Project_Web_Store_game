<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/vendor/fpdf186/fpdf.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/models/products.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/models/users.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['order_number'])) {
    $order_number = $_POST['order_number'];
    $conn = require $_SERVER['DOCUMENT_ROOT'] . '/app/utils/database.php';

    $stmt = $conn->prepare('SELECT op.*, p.title, u.username FROM order_products op JOIN products p ON op.product_id = p.id JOIN users u ON op.user_id = u.id WHERE op.order_number = ?');
    $stmt->bind_param('i', $order_number);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $username = $row['username'];
        $order_date = $row['order_date'];
        
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 10, 'Detalle del Pedido', 0, 1, 'C');
        $pdf->Ln(10);
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 10, 'Usuario: ' . $username, 0, 1);
        $pdf->Cell(0, 10, 'Fecha: ' . $order_date, 0, 1);
        $pdf->Ln(10);

        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(60, 10, 'Producto', 1);
        $pdf->Cell(30, 10, 'Cantidad', 1);
        $pdf->Cell(30, 10, 'Precio', 1);
        $pdf->Cell(30, 10, 'Total', 1);
        $pdf->Ln();
        $result->data_seek(0);
        $total_general = 0;
        $pdf->SetFont('Arial', '', 12);
        while ($row = $result->fetch_assoc()) {
            $pdf->Cell(60, 10, $row['title'], 1);
            $pdf->Cell(30, 10, $row['amount'], 1);
            $pdf->Cell(30, 10, '$' . number_format($row['price'], 2), 1);
            $pdf->Cell(30, 10, '$' . number_format($row['price'] * $row['amount'], 2), 1);
            $pdf->Ln();
            $total_general += $row['price'] * $row['amount'];
        }
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(120, 10, 'Total General', 1);
        $pdf->Cell(30, 10, '$' . number_format($total_general, 2), 1);
        $pdf->Ln();
        $pdf->Output();
    } else {
        echo 'No se encontraron detalles para este pedido.';
    }
} else {
    echo 'No se proporcionó el número de pedido.';
}
