<?php

namespace App\Controllers;

use CodeIgniter\Config\Services;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Validation\Exceptions\ValidationException;
use Psr\Log\LoggerInterface;
use App\Libraries\CodeIgniterCORS\CodeIgniterCORS;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = [];

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();

        // Adicione as linhas abaixo e os métodos "cors ()" e "_cors ()"
		
		if (!is_cli())
		{
			$this->_cors();
		}
    }

    public function cors(): void
	{
		/**
        * Este método só é necessário para a rota "$ routes-> options ('(: any)', 'BaseController :: cors')".
        * Como a rota visa aqui, o método privado "_cors ()" já será chamado de "initController ()".
        */
	}

    private function _cors(): void
	{
		// Certifique-se de enviar o cabeçalho "X-Requested-With: XMLHttpRequest"
		
		if(empty($_SERVER['HTTP_X_REQUESTED_WITH']) || (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && (strtoupper($_SERVER['HTTP_X_REQUESTED_WITH']) === 'XMLHTTPREQUEST')))
		{
			// Use o gerenciamento de cabeçalhos CI e envie cabeçalhos
			
			$ciCORS = new CodeIgniterCORS(true);
			$ciCORS->handle($this->request, $this->response);
			
			// Use o gerenciamento de cabeçalhos CI, mas não envie cabeçalhos
            // Se você mesmo precisa enviar cabeçalhos, defina "false"
            // caso contrário, eles não serão enviados.
			
			/*
			$ciCORS = new CodeIgniterCORS();
			$ciCORS->handle($this->request, $this->response, false);
			*/
			
			// Use vanilla PHP to manage headers.
			
			/*
			$ciCORS = new CodeIgniterCORS(true);
			$ciCORS->handle($this->request, $this->response);
			*/
		}
	}

    public function getResponse(array $responseBody, int $code = ResponseInterface::HTTP_OK)
    {
        return $this
            ->response
            ->setStatusCode($code)
            ->setJSON($responseBody);
    }

    public function getRequestInput(IncomingRequest $request){
        $input = $request->getPost();
        if (empty($input)) {
            // converte o corpo da solicitação em array associativo
            $input = json_decode($request->getBody(), true);
        }
        return $input;
    }

    public function validateRequest($input, array $rules, array $messages =[]){
        $this->validator = Services::Validation()->setRules($rules);
        // Se você substituir o array $ rules pelo nome do grupo
        if (is_string($rules)) {
            $validation = config('Validation');
    
            // Se a regra não foi encontrada em \Config\Validation, nós
            // deve lançar uma exceção para que o desenvolvedor possa encontrá-la.
            if (!isset($validation->$rules)) {
                throw ValidationException::forRuleNotFound($rules);
            }
    
            // Se nenhuma mensagem de erro for definida, use a mensagem de erro no arquivo Config\Validation
            if (!$messages) {
                $errorName = $rules . '_errors';
                $messages = $validation->$errorName ?? [];
            }
    
            $rules = $validation->$rules;
        }
        return $this->validator->setRules($rules, $messages)->run($input);
    }
}
