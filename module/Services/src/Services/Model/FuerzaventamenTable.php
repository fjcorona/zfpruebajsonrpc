<?php
namespace Services\Model;

/**
 * Componentes necesarios para el modelado
 */

use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Sql\Select as Select;

class FuerzaventamenTable extends AbstractTableGateway{
    
    /**
     * Nombre de la Tabla
     * @var type 
     */
    
    protected $table = 'fuerzaventamen';
    
    /**
     * Configura Adaptador de Base de Datos
     * @param \Zend\Db\Adapter\Adapter $adapter
     */
        
    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
    }
    
    /**
     * Realiza una consulta utilizandon left join
     * @return array
     */
    
    public function findByPosition($limit){      
      $resultSet = $this->select(
                function (Select $select) use ($limit) {
                    $select->join(
                        array(
                            'cp'=>'cat_puesto'
                        ),
                        'cp.id='.'fuerzaventamen'.'.puesto',
                        $select::SQL_STAR,
                        $select::JOIN_LEFT
                    )
                    ->where('cp.id=96')
                    ->order('nomina ASC')
                    ->limit($limit)
                    ;
                }
               );
                 
        $resultSet->buffer();
        $resultSet->next();
        
        return $this->getEntitiesJoin($resultSet);
    }
     
    /**
    * Selecciona columnas para vista
    * @param type $resultSet
    * @return type
    */
    
    private function getEntitiesJoin($resultSet){
        $entities = array();
        
        foreach ($resultSet as $row){
            $map= array(
                'nomina'        =>      $row->nomina,
                'division'      =>      $row->division,
                'ap_paterno'    =>      $row->ap_paterno,
                'ap_materno'    =>      $row->ap_materno,
                'nombres'       =>      $row->nombres,
                'puesto'        =>      $row->nombre,
                'fecha_nacim'   =>      $row->fecha_nacim,
            );
            
            $entities[] = $map;
        }
        
        return $entities;
    }
    
}
