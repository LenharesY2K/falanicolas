<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerador de QR Code com JavaScript</title>
    <script src="https://cdn.jsdelivr.net/npm/qrcode/build/qrcode.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            padding: 50px;
        }
        .form-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            margin: auto;
        }
        input[type="text"] {
            width: 80%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="button"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="button"]:hover {
            background-color: #45a049;
        }
        #qrcode {
            margin-top: 20px;
        }
        #download {
            margin-top: 20px;
            display: none;
        }
    </style>
</head>
<body>
 
<h1>Gerador de QR Code</h1>
<div class="form-container">
    <label for="data">Digite o texto ou URL para o QR Code:</label><br>
    <input type="text" id="data" placeholder="Digite aqui..."><br><br>
    <input type="button" value="Gerar QR Code" onclick="generateQRCode()">
   
    <!-- QR Code será gerado aqui dentro de um canvas -->
    <canvas id="qrcode"></canvas>
 
    <!-- Link para baixar o QR Code -->
    <div id="download">
        <a id="downloadLink" href="#" download="qrcode.png">
            <input type="button" value="Baixar QR Code">
        </a>
    </div>
</div>
 
<script>
    function generateQRCode() {
        // Obtemos o valor do campo de entrada
        const data = document.getElementById('data').value;
 
        // Se o campo de entrada não estiver vazio
        if (data.trim() !== '') {
            // Limpar o canvas caso haja algum QR Code anterior
            document.getElementById('qrcode').getContext('2d').clearRect(0, 0, 300, 300);
 
            // Geramos o QR Code e o exibimos no canvas
            QRCode.toCanvas(document.getElementById('qrcode'), data, function (error) {
                if (error) {
                    console.error(error);
                } else {
                    console.log('QR Code gerado com sucesso!');
                   
                    // Mostrar o botão de download
                    document.getElementById('download').style.display = 'block';
                   
                    // Obter a imagem do canvas em formato de URL
                    const qrCodeImage = document.getElementById('qrcode').toDataURL();
 
                    // Atualizar o link de download
                    document.getElementById('downloadLink').href = qrCodeImage;
                }
            });
        } else {
            alert('Por favor, insira algum texto ou URL.');
        }
    }
</script>
 
</body>
</html>