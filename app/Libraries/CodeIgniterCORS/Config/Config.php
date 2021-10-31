<?php

/*
 * |--------------------------------------------------------------------------
 * | CodeIgniterCORS Config
 * |--------------------------------------------------------------------------
 * |
 * | As opções allowed_methods e allowed_headers não fazem distinção entre maiúsculas e minúsculas.
 * |
 */

return [
	// Você pode habilitar o CORS para um ou vários ou todos (*) caminhos.
	"*" => [
		"allowed_origins" => ["*"], // Corresponde à origem da solicitação. `["*"]` permite todas as origens.
		"allowed_methods" => ["*"], // Corresponde ao método de solicitação. `["*"]` permite todos os métodos.
		"allowed_headers" => ["*"], // Define o cabeçalho de resposta Access-Control-Allow-Headers. `["*"]` permite todos os cabeçalhos.
		"exposed_headers" => [], // Define o cabeçalho de resposta Access-Control-Expose-Headers com esses cabeçalhos.
		"max_age" => 0, // Define o cabeçalho de resposta Access-Control-Max-Age quando> 0.
		"supports_credentials" => true // Define o cabeçalho Access-Control-Allow-Credentials.
	],
	// Examples
	/*"api" => [
		"allowed_methods" => ["GET"],
		"allowed_origins" => ["*"],
		"allowed_headers" => ["*"],
		"exposed_headers" => [],
		"max_age" => 0,
		"supports_credentials" => false
	],
	"api/members" => [
		"allowed_methods" => ["GET", "POST", "PUT", "DELETE"],
		"allowed_origins" => ["http://localhost:8080"],
		"allowed_headers" => ["*"],
		"exposed_headers" => [],
		"max_age" => 0,
		"supports_credentials" => false
	]*/
];
