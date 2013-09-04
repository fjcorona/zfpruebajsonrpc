<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      https://github.com/CookieShop for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://www.gnu.org/licenses/gpl.html GNU GENERAL PUBLIC LICENSE
 */
namespace Services\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Json\Server\Server as Server;
use Zend\Json\Server\Smd as Smd;
use Zend\Json\Server\Client as ClientJson;
use Zend\Http\Response as Response;
use Zend\Http\Client as ClientHttp;
use Services\Api\Service as Service;

class IndexController extends AbstractActionController{
    
    /**
     * @return \Zend\View\Model\ViewModel
     */
    
    public function indexAction(){
        return $this->response;
    }
    
    public function rpcAction(){
        $response = new Response();
        $response->setStatusCode(Response::STATUS_CODE_200);
        $response->getHeaders()->addHeaders(
                array(
                    'Content-Type' => 'application/json',
                )
        );
        
        $server = new Server();
        $server->setClass(new \Services\Api\Service($this->getServiceLocator()));
        $server->setObject(new Service($this->getServiceLocator()));
        $server->registerFaultException('Services\Api\Exception');
        $server->getRequest()->setVersion(Server::VERSION_2);
        
        if($this->getRequest()->isGet()){
            $smd = $server->getServiceMap()->setEnvelope(Smd::ENV_JSONRPC_2);
            $response->setContent($smd);
        } else {
            $server->handle();
        }
        return $response;        
    }
    
    public function clientjsonAction(){
        $url = 'http://localjcorona/jsonrpc/public/jsonserver/rpc';
        
        $client = new ClientHttp();
        $client->setUri($url);
        
        $jsonrpcclient = new ClientJson($url,$client);        
        $result = $jsonrpcclient->call('getByLimit',array());
        
        var_dump($result);
        
        return $this->response;
    }
       
            
}