<?php
    require 'model/productModel.php';
    require 'model/product.php';
    require_once 'configs/config.php';

    session_status() === PHP_SESSION_ACTIVE ? TRUE : session_start();
    
	class productController 
	{

 		function __construct() 
		{          
			$this->objconfig = new config();
			$this->objsm =  new productModel($this->objconfig);
		}
        // mvc handler request
		public function mvcHandler() 
		{
			$act = isset($_GET['act']) ? $_GET['act'] : NULL;
			switch ($act) 
			{
                case 'add' :                    
					$this->insert();
					break;						
				case 'update':
					$this->update();
					break;				
				case 'delete' :					
					$this -> delete();
					break;								
				default:
                    $this->list();
			}
		}		
        // page redirection
		public function pageRedirect($url)
		{
			header('Location:'.$url);
		}	
        // check validation
		public function checkValidation($sporttb)
        {    $noerror=true;
            // Validate category        
            if(empty($sporttb->category)){
                $sporttb->category_msg = "Field is empty.";$noerror=false;
            } elseif(!filter_var($sporttb->category, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
                $sporttb->category_msg = "Invalid entry.";$noerror=false;
            }else{$sporttb->category_msg ="";}            
            // Validate name            
            if(empty($sporttb->name)){
                $sporttb->name_msg = "Field is empty.";$noerror=false;     
            } elseif(!filter_var($sporttb->name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
                $sporttb->name_msg = "Invalid entry.";$noerror=false;
            }else{$sporttb->name_msg ="";}
            return $noerror;
        }
        // add new record
		public function insert()
		{
            try{
                $producttb=new Product();
                if (isset($_POST['addbtn'])) 
                {   
                    // read form value
                    $producttb->id= trim($_POST['id']);
                    $producttb->name = trim($_POST['name']);
                    $producttb->price= trim($_POST['price']);
                    $producttb->details= trim($_POST['details']);
                    $producttb->image1= trim($_POST['image1']);
                    $producttb->image2= trim($_POST['image2']);
                    $producttb->image3= trim($_POST['image3']);
                    $producttb->producerID= trim($_POST['producer']);
                        //call insert record            
                        $pid = $this -> objsm ->insertRecord($producttb);
                        if($pid>0){			
                            $this->list();
                        }else{
                            echo "Somthing is wrong..., try again.";
                            $_SESSION['producttbl0']=serialize($producttb);//add session obj           
                            $this->pageRedirect("view/insert.php");                
                        }
                }
            }catch (Exception $e) 
            {
                $this->objsm->close_db();	
                throw $e;
            }
        }
        // update record
        public function update()
		{
            try
            {
                
                if (isset($_POST['updatebtn'])) 
                {
                    $producttb=unserialize($_SESSION['producttbl0']);
                    $producttb->id= trim($_POST['id']);
                    $producttb->name = trim($_POST['name']);
                    $producttb->price= trim($_POST['price']);
                    $producttb->details= trim($_POST['details']);
                    $producttb->image1= trim($_POST['image1']);
                    $producttb->producerID= trim($_POST['producer']);
                    // check validation  
                        $res = $this -> objsm ->updateRecord($producttb);	                        
                        if($res){			
                            $this->list();                           
                        }else{
                            echo "Somthing is wrong..., try again.";
                            $_SESSION['producttbl0']=serialize($producttb);      
                            $this->pageRedirect("view/update.php");                
                        }
                } elseif (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
                    $id = $_GET['id'];
                    $result = $this->objsm->selectRecord($id);
                    $row = mysqli_fetch_array($result);
                    $producttb= new Product();
                    $producttb->id = $row["productID"];
                    $producttb->name = $row["productName"];
                    $producttb->price= $row["productPrice"];
                    $producttb->details= $row["productDetails"];
                    $producttb->image1= $row["productImage1"];
                    $_SESSION['producttbl0'] = serialize($producttb);
                    $this->pageRedirect('view/update.php');
                } else {
                    echo "Invalid operation.";
                }
            }
            catch (Exception $e) 
            {
                $this->objsm->close_db();				
                throw $e;
            }
        }
        // delete record
        public function delete()
		{
            try
            {
                if (isset($_GET['id'])) 
                {
                    $id=$_GET['id'];
                    $res=$this->objsm->deleteRecord($id);                
                    if($res){
                        $this->pageRedirect('index.php');
                    }else{
                        echo "Somthing is wrong..., try again.";
                    }
                }else{
                    echo "Invalid operation.";
                }
            }
            catch (Exception $e) 
            {
                $this->objsm->close_db();				
                throw $e;
            }
        }
        public function list(){
            $result=$this->objsm->selectRecord(0);
            include "view/list.php";                                        
        }
    }
		
	
?>