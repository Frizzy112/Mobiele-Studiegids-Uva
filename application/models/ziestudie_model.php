<?php

	class Ziestudie_model extends CI_Model {
		
		function __construct()
	    {
	        
	        // Call the Model constructor
	        parent::__construct();
	        
	    }
		
		/*
		 * 
		 * Function isStudie();
		 * 
		 * If the studie exists: this function returns the data, otherwise it returns false.
		 * 
		 */
		
		function getStudie( $studieId )
		{
			
			$result 	=   $this->db->query( "SELECT * FROM project1 WHERE id = '" . $studieId . "'" );
			
			$resultData	=   $result->result_array();
			
			if( count($resultData) == 0 )	
			{
				
				return false;
				
			}
			else
			{
				
				return $resultData;
				
			}
			
		}
		
		/*
		 * 
		 * Function getFacultyNameById( $facultyId )
		 * 
		 * Returns the name of a faculty which ID is given.
		 * 
		 */
		
		function getFacultyNameById( $facultyId )
		{
			
			$get	=   $this->db->query( "SELECT * FROM faculteiten WHERE id = '" . $facultyId . "'" );
			
			$result	=   $get->result_array();
			
			if( count( $result ) == 0 )
			{
				
				return false;
				
			}
			else
			{
				
				return $result;
				
			}
			
		}
		
		/*
		 * 
		 * Function getNeededVakkenByStydieId
		 * 
		 * Return false if there are no needed vakken for a studie, or returns an array with the needed vakken if it does.
		 * 
		 */
		
		function getNeededVakkenByStudieId( $studieId )
		{
			
			$get		=	$this->db->query( "SELECT * FROM needed_vakken WHERE studie_id = '" . $studieId . "'" );
			
			$result		=	$get->result_array();
			
			$returnAr	=	array();
			
			if( count( $result ) == 0 )
			{
				
				return false;
				
			}
			else
			{
				
				foreach( $result as $res )
				{
					
					$returnAr[]	= $this->getVakNaamByVakId( $res['vak_id'] );
					
				}
				
				return $returnAr;
				
			}
			
			
		}
		
		/*
		 * 
		 * Function getVakNaamByVakId( $vakId )
		 * 
		 * Function will return the name of the vak which's ID is given.
		 * 
		 */
		
		function getVakNaamByVakId( $vakId )
		{
			
			$get	=	$this->db->query( "SELECT vak_name FROM vakken WHERE vak_id = '" . $vakId . "'" );
			
			$result	=	$get->result_array();
			
			if( count($result) !== 0 )
			{
				
				return $result[0]['vak_name'];
				
			}
			else
			{
			
				return false;
				
			}
			
		}
		
	}

?>
