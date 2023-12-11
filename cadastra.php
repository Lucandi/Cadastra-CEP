<?php

$cep = $_POST['cepCliente'];

$url = "https://viacep.com.br/ws/{$cep}/json/";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

if ($response) {
	$endereco = json_decode($response, true);

	if (isset($endereco['erro'])) {
		echo "CEP não encontrado";
	}
	else {
		echo "CEP: " . $endereco['cep'] . "<br>";
		echo "Logradouro: " . $endereco['logradouro'] . "<br>";
		echo "Bairro: " . $endereco['bairro'] . "<br>";
		echo "Cidade: " . $endereco['localidade'] . "<br>";
		echo "Estado: " . $endereco['uf'] . "<br>";
		

		$cepCliente = $endereco['cep'];
		$logradouroCliente = $endereco['logradouro'];
		$bairroCliente = $endereco['bairro'];
		$cidadeCliente = $endereco['localidade'];

		echo "<strong>Cadastrado com Sucesso!</strong>";


	}
}else {
	echo "Erro ao buscar informações do CEP";
}
	include('conn.php');

	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		$nomeCliente = $_POST['nomeCliente'];
		$cepCliente = $endereco['cep'];
		$logradouroCliente = $endereco['logradouro'];
		$bairroCliente = $endereco['bairro'];
		$cidadeCliente = $endereco['localidade'];
		

		$stmt = $pdo-> prepare('INSERT INTO tbcliente(nomeCliente, cepCliente, logradouroCliente, bairroCliente, cidadeCliente) VALUES (?, ?, ?, ?, ?)');
		$stmt->execute([$nomeCliente, $cepCliente, $logradouroCliente, $bairroCliente, 
			$cidadeCliente]);

		#header('Location: cadastra.php');


	}
?>