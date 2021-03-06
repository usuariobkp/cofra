<?php

namespace Magyp\RendicionDeCajaBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * RendicionRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class RendicionRepository extends EntityRepository
{
	public function buscar($idrendicion){
		
		$qb = $this->createQueryBuilder('ren')
				->select('ren', 'comp')
				->join("ren", "comp")
				//->join("ren.comprobante", "comp",'ON comp.borrado <> 1')
				//->join($join, $alias, $conditionType)
				->where("ren.id = :id")
				->setParameter("id", $idrendicion);
		


		return $qb->getQuery()->getResult();
		;
	}
	
	public function BuscarPorArea($area){
		$qb = $this->createQueryBuilder('ren')
				->select('ren')				
				->where("ren.area = :area_id")
				->andWhere("ren.borrado = 0")
				->setParameter("area_id", $area->getId());
				
		return $qb->getQuery()->getResult();
	}

	public function BuscarBorradasPorArea($area){
		$qb = $this->createQueryBuilder('ren')
				->select('ren')				
				->where("ren.area = :area_id")
				->andWhere("ren.borrado = 1")
				->setParameter("area_id", $area->getId());
				
		return $qb->getQuery()->getResult();
	}
	
	public function conEstado($estado ,$idarea = null){
		$qb = $this->createQueryBuilder('ren')
				->select('ren')				
				->where("ren.estado= :estado")				
				->setParameter("estado", $estado);
				if(!is_null($idarea)){
				    $qb->andWhere("ren.area = :idarea")
					->setParameter("idarea", $idarea) ;
				}
				
		return $qb->getQuery()->getResult();
	}

	public function conEstadoEnviado($idarea = null){
		return $this->conEstado(Estado::ENVIADO,$idarea);
	}
	
	public function conEstadoAceptado($idarea = null){
		return $this->conEstado(Estado::ACEPTADO,$idarea);
	}
        
        public function conEstadoAtesoreria($idarea = null){
		return $this->conEstado(Estado::ATESORERIA,$idarea);
	}
        
        public function conEstadoArchivada($idarea = null){
		return $this->conEstado(Estado::ARCHIVADA,$idarea);
	}
        
        public function conEstadoAapagar($idarea = null){
            return $this->conEstado(Estado::APAGAR,$idarea);
	}
        
        public function conEstadoApagado($idarea = null){
            return $this->conEstado(Estado::PAGADO,$idarea);
	}
	
        public function RendicionesDelArea($usuario, $texto = null){
            
		$qb = $this->createQueryBuilder('ren')
				->select('ren')
				->leftJoin("ren.comprobantes", "comp")
				->where("ren.area = :area")                                
				->setParameter("area", $usuario->getArea()->getId())
                                ->andWhere("ren.borrado = 0")
                                ->orderBy("ren.fecha", "DESC");
                                if(!is_null($texto)){
                                    $qb->andWhere("ren.expediente LIKE :texto")
                                    ->setParameter("texto", '%' . $texto . '%');                                        
                                }
                        ;
		return $qb->getQuery()->getResult();
		;
	}
        public function qb_Buscar($texto = null){
            
		$qb = $this->createQueryBuilder('ren')
				->select('ren')
				//->leftJoin("ren.comprobantes", "comp")
				->join("ren.responsable", "responsable")
				->join("ren.area", "area")
				
				->where("ren.expediente Like :expediente")                                
				->setParameter("expediente", '%'.$texto.'%')
				->andWhere("ren.borrado = 0")
				->orderBy("ren.fecha", "DESC");
  
                        ;
		return $qb;
		;
	}
	
        public function RendicionesBuscadorLiquidaciones( $texto = null){
            
		$qb = $this->createQueryBuilder('ren')
				->select('ren')
				->leftJoin("ren.comprobantes", "comp")
                                ->andWhere("ren.borrado = 0")
                                ->orderBy("ren.fecha", "DESC");
                                if(!is_null($texto)){
                                    $qb->andWhere("ren.expediente LIKE :texto")
                                    ->setParameter("texto", '%' . $texto . '%');                                        
                                }
                        ;
		return $qb;
		;
	}
	public function RendicionesConLiquidacion( $texto = null){
            
		$qb = $this->createQueryBuilder('ren')
				->select('ren')
				->leftJoin("ren.liquidaciones", "liq")
		//	->leftJoin("ren.liquidaciones", "liq" , \Doctrine\ORM\Query\Expr\Join::ON, 'ren.id')
				
				->andWhere("ren.borrado = 0")
				->andWhere("ren = liq.rendicion")
				->orderBy("ren.fecha", "DESC");
				if(!is_null($texto)){
					$qb->andWhere("ren.expediente LIKE :texto")
					->setParameter("texto", '%' . $texto . '%');                                        
				}
		;
		return $qb;
		;
	}
        
}
