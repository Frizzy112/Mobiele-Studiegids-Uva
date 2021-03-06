<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Zoeken extends CI_Controller {

	public function __Construct()
	{

	    parent::__Construct();  
	   
	}
	
	/*
	 * Public function allestudies()
	 *
	 * Display all studies in the database
	 *
	 */
	
	public function allestudies()
	{
	
	    $this->load->model('Studies_model');
	    
	    $data = $this->Studies_model->getAll();    
	    	
		$this->load->view( "header", array( "page" => "Alle Studies - Studies Zoeken", "pagetitle" => "Alle Studies" ) );
		$this->load->view( "allestudies", array("programName" => $data));
		$this->load->view( "footer" );
		
	}
	
	/*
	 * Private function facultyShortcodeToFacultyName( $shortcode )
	 *
	 * Transforms a facultyshortcode (f.a. NWI) to a full name (f.a. Natuurwetenschappen Wiskunde en Informatica)
	 *
	 */
	 
	private function facultyShortcodeToFacultyName( $shortcode )
	{
	
	    $omzetten  = array(
	                       "nwi" => "Faculteit der Natuurwetenschappen, Wiskunde en Informatica",
	                       "eb"  => "Faculteit der Economie en Bedrijfskunde",
	                       "gw"  => "Faculteit der Geesteswetenschappen",
	                       "mgw" => "Faculteit der Maatschappij- en Gedragswetenschappen",
	                       "rg"  => "Faculteit der Rechtsgeleerdheid",
	                       "amc" => "Faculteit der Geneeskunde",
	                       "thk" => "Faculteit der Tandheelkunde",
	                       "AUC" => "Amsterdam University College"
	                   );
	                   
	   return $omzetten[$shortcode];
	
	}
	
	/*
	 * Public function faculteit()
	 *
	 * If there is a faculty given it will display all studies in this faculty; otherwise it will display a list with all faculty's
	 *
	 */
	
    public function faculteit()
	{
	
	    $this->load->model('Faculteiten_model');
	
	    $facultyId = $this->uri->segment( 3 );
	
	    if( $facultyId !== false )     // trigger when there is GET data
	    {

	        $data = $this->Faculteiten_model->getResultaten( $facultyId );
	        
	        $this->load->view( "header", array( "page" => "Alle Studies - per Faculteit ", "pagetitle" => "Studies op Faculteit" ) );
		    $this->load->view( "allestudies", array("programName" => $data));
		    $this->load->view( "footer" );
	        
	    }
	    else
	    {
	   
		    $data = $this->Faculteiten_model->getFaculteiten();	
		
		    foreach( $data as $id => $value )
	        {
	        
	            $data[$id]["fullFaculty"]    = $this->facultyShortcodeToFacultyName( $value["faculty_name"] );
	        
	        }
		
		    $this->load->view( "header", array( "page" => "Alle Faculteiten ", "pagetitle" => "Studies op Faculteit" ) );
		    $this->load->view( "faculteiten", array("faculty_name" => $data));
		    $this->load->view( "footer" );
		  
	    }
		
	} 
	
	/*
	 * Public function toelatingseisen
	 *
	 * If vakken are given it will filter the studies to the given toelatingseisen, otherwise it will display a form with the different toelatingseisen
	 *
	 */
	
    public function toelatingseisen()
	{
	
	    if( $this->input->get("wiskunde") ) 
	    {
	    
	        $this->load->model('Studies_model');
	        
	        $data = $this->Studies_model->getFiltered( $this->input->get( NULL ) );
	    
	        $this->load->view( "header", array( "page" => "Alle Studies - op Toelatingseisen", "pagetitle" => "Studies op Toelatingseisen" ) );
		    $this->load->view( "allestudies", array("programName" => $data));
		    $this->load->view( "footer" );
	 
	        
	    
	  
	    }
	    else
	    {
	    
	        $this->load->model('Toelatingseisen_model');
	    
	        $data = $this->Toelatingseisen_model->getToelatingseisen(); 
		
		    $this->load->view( "header", array( "page" => "Alle Studies - op Toelatingseisen", "pagetitle" => "Studies op Toelatingseisen" ) );
		    $this->load->view( "toelatingseisen", array("vak_name" => $data));
		    $this->load->view( "footer" );
	    
	    }
		
	}
	
	/*
	 * Public function keyword
	 *
	 * If a query is given it will look for the given query in all studie descriptions. Otherwise it will display a simple search form.
	 *
	 */
	
	public function keyword()
	{
	
		$this->load->model("Fullsearch_model");
	
		if( $this->input->get("q") )
		{
			
			$data	=	$this->Fullsearch_model->search( $this->input->get("q") );
			
			$this->load->view( "header", array( "page" => "Studies Zoeken", "pagetitle" => "Studies Zoeken" ) );
			$this->load->view( "allestudies", array("programName" => $data));
			$this->load->view( "footer" );
			
		}
		else
		{
		
			$this->load->view( "header", array( "page" => "Studies Zoeken", "pagetitle" => "Studies Zoeken" ) );
			$this->load->view( "zoeken" );
			$this->load->view( "footer");
			
		}
		
	}
	
	/*
	 * Public function laatstbekeken
	 *
	 * 
	 *
	 */
	
    public function laatstbekeken()
	{
		
		$this->load->model('Laatstbekeken_model', 'fubar');
		
		$_SESSION['lastSeen']	=	array_reverse( $_SESSION['lastSeen'] );
		
		while( count( $_SESSION['lastSeen'] ) > 15  )
		{
			
			array_pop( $_SESSION['lastSeen'] );
			
		}
	
		$data = $this->fubar->getDataByIDs( $_SESSION['lastSeen'] );
		
		$this->load->view( "header", array( "page" => "Laatst bekeken Studies", "pagetitle" => "Laatst Bekeken" ) );
		$this->load->view( "allestudies", array("programName"=>$data));
		$this->load->view( "footer" );
		
	}
	
	/*
	 * Public function favorieten
	 *
	 *
	 */
	
	public function favorieten()
	{
		
		$this->load->model('Laatstbekeken_model','fubar');
		
		$data = $this->fubar->getDataByIDs( $_SESSION['favorieten'] );
		
		$this->load->view( "header", array( "page" => "Favoriete Studies", "pagetitle" => "Favoriete Studies" ) );
		$this->load->view( "favorieten", array("programName"=>$data));
		$this->load->view( "footer" );
		
	}
 
}

