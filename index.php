<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Envio de Código</title>
</head>
<body>
    <div class="container">
        <h1>Envio de Código</h1>
        <p>Digite seu email para receber um código de 5 dígitos:</p>
        <input type="email" id="emailInput" placeholder="Digite seu email">
        <button id="generateButton">Gerar Código</button>
        <p id="codeResult"></p>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const generateButton = document.getElementById("generateButton");
            const emailInput = document.getElementById("emailInput");
            const codeResult = document.getElementById("codeResult");

            generateButton.addEventListener("click", function () {
                const email = emailInput.value;
                const generatedCode = Math.floor(10000 + Math.random() * 90000);

                // Enviar os dados para o arquivo PHP usando AJAX
                const xhr = new XMLHttpRequest();
                xhr.open("POST", "send_code.php", true);
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        const response = JSON.parse(xhr.responseText);
                        if (response.success) {
                            codeResult.textContent = `Código gerado para ${email}: ${generatedCode}. ${response.message}`;
                        } else {
                            codeResult.textContent = response.message;
                        }
                    }
                };
                xhr.send("email=" + encodeURIComponent(email) + "&generatedCode=" + encodeURIComponent(generatedCode));
            });
        });
    </script>
</body>
</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $generatedCode = $_POST["generatedCode"];

    // Configurar o PHPMailer ou outra biblioteca de envio de emails aqui
    // Exemplo usando PHPMailer:
    // require 'vendor/autoload.php';
    // $mail = new PHPMailer\PHPMailer\PHPMailer();
    // ... Configurações de envio de email ...

    // Configurações de envio do email
    $mail->setFrom('seuemail@gmail.com', 'Seu Nome');
    $mail->addAddress($email);
    $mail->Subject = 'Código Gerado';
    $mail->Body = "Seu código gerado é: $generatedCode";

    // Tentar enviar o email
    if ($mail->send()) {
        echo json_encode(["success" => true, "message" => "Email enviado com sucesso!"]);
    } else {
        echo json_encode(["success" => false, "message" => "Erro ao enviar o email."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Método inválido."]);
}
?>
