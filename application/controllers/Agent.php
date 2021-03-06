<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agent extends CI_Controller {

	
        public function __construct()	
        {
            parent::__construct();
           $this->load->database(); 
           $this->load->model('azam');
            $this->load->helper('url_helper');
             $this->load->library("session");
        }
	

  // function for safe landing if logged in then admin dashboard page or loginform
	public function index()
	{
            
          if ( empty($this->session->userdata("username")) )
            {
		$this->load->view('loginform');
            }
           else
            {
               $this->load->view('main');
            }   
	}
   // function for login 
        public function logincheck()
        {
             //$user = $this->input->post['user_name'];
             //$password = $this->input->post['password'];
          
               $username = $_POST['user_name'];
               $password = $_POST['password']; 
            
               
                     if($username == "admin" && $password == "12345" )
                    {
                       $this->session->set_userdata("username",$username);
                       $this->load->view('main.php');
                    }
                    else
                    {
                      echo "Invalid Login Credentials";
                    }
           
         
        }
  // function for logout      
        public function logout()
        {
              $this->session->sess_destroy();
              $this->load->view('loginform');
        } 

  // function for add debt form      
        public function adddebts()
        {
              
              if ( empty($this->session->userdata("username")) )
            {
		$this->load->view('loginform');
            }
           else
            {
               $this->load->view('add_debts');
            }   
        }

  // function for debt insertion and customer info insertion     
        public function insert_debt()
        {
              $cusname = $_POST['customer_name'];
              $email = $_POST['email'];
              $amount = $_POST['loan_amount'];
              $rate = $_POST['roi'];
              $term = $_POST['years'];
              $interest = $rate/100;
      
              $data['cus_name']  = $cusname;
              $data['email']  = $email;
              $data['address']  = $_POST['address'];
              $data['balance']  = $_POST['loan_amount'];
              $this->db->insert('customer', $data); 
             
              $date = date("Y-m-d",strtotime("now"));
              $query = $this->db->query("SELECT id from customer WHERE cus_name='$cusname' AND email='$email'");
              $cus_id = $query->result_array();
              $ldata['customer_id'] = $cus_id[0]['id'];
              $ldata['loan_amount'] = $_POST['loan_amount'];
              $ldata['interest'] = $_POST['roi'];
              $ldata['years'] = $_POST['years'];
              $ldata['given_date'] = $date;
              $ldata['due_date'] = date("Y-m-d",strtotime("+1 month", strtotime($date)));
               
              $emi = $amount * $interest * (pow(1 + $interest, $term) / (pow(1 + $interest, $term) - 1));
              $ldata['emi'] = $emi;
              $this->db->insert('debt', $ldata); 
              redirect('agent/index'); 
        } 

  // function for add payment form      
        public function addpayment()
        {
              
              if ( empty($this->session->userdata("username")) )
            {
		$this->load->view('loginform');
            }
           else
            {
               $this->load->view('add_payment');
            }   
        } 

  // EMI calculation function
        public function get_emi(){
            
             $transaction_id = $_POST['transaction_id'];
             $customer_id = $_POST['customer_id'];
              
             $query = $this->db->query("SELECT emi FROM debt WHERE customer_id='$customer_id' AND transaction_id='$transaction_id'");
             $loan = $query->result_array();
             $loan_data = json_encode($loan);
             echo $loan_data;
                         

         }
  
  // loan transaction_id function
        public function get_loan_transaction_id(){
            
             $this->db->select('transaction_id');
             $query = $this->db->get("debt");
             $loan = $query->result_array();
             $loan_data = json_encode($loan);
             echo $loan_data;
            
         }




 // loan customer_id function
        public function get_loan_customer_id(){
            
             $this->db->select('customer_id');
             $query = $this->db->get("debt");
             $loan = $query->result_array();
             $loan_data = json_encode($loan);
             echo $loan_data;
            
         }

// function for fetching dates based on transaction_id
        public function get_date(){
            
             $transaction_id = $_POST['transaction_id'];
             $query = $this->db->query("SELECT payment_date FROM payment WHERE loan_transaction_no='$transaction_id'");
             $loan = $query->result_array();
             $loan_data = json_encode($loan);
             echo $loan_data;
            
         }

// function for payment insertion.     
        public function insert_payment()
        {
               
              $customer_id = $_POST['customer_id'];
              $transaction_id = $_POST['transaction_id'];
              $amount = $_POST['emi'];
              $payment_month = $_POST['payment_month'];
              $current_date = date("Y-m-d",strtotime("now"));

              $debt_query = $this->db->query("SELECT * FROM debt WHERE customer_id='$customer_id' AND transaction_id='$transaction_id'");
              $debt = $debt_query->result_array();
              $due_date = $debt[0]['due_date'];
              $emi = $debt[0]['emi'];
              $rate = $debt[0]['interest'];

              $balance_query = $this->db->query("SELECT balance FROM customer WHERE id='$customer_id' ");
              $balance_data = $balance_query->result_array();
              $balance = $balance_data[0]['balance'];

              $payment_query = $this->db->query("SELECT * FROM payment WHERE  customer_id = '$customer_id' and loan_transaction_no ='$transaction_id' ORDER BY id DESC LIMIT 1 ");
              $payment_data = $payment_query->result_array();
              
              $count = $this->db->count_all_results('payment');
              
             // check for late payment
               if( $current_date < $due_date){
                   
                      if($count == 0){
		             $interest_paid = $emi * ($rate/100);
		             $capital_paid = $emi - $interest_paid;
		             
		             $data['customer_id'] = $customer_id;
		             $data['loan_transaction_no'] = $transaction_id;
		             $data['payment_amount'] = $amount;
		             $data['balance'] = $balance;
		             $data['payment_month'] = $payment_month;
		             $data['capital_paid'] = $capital_paid;
		             $data['interest_paid'] = $interest_paid;
		             $data['penalty'] = "No";
		             $data['payment_date'] = $current_date;
		             $this->db->insert('payment', $data);
		           
		          // updating the current outstanding
		             $current_balance = $balance - $emi; 
		             $balance_update_query = $this->db->query("UPDATE customer SET balance='$current_balance' WHERE id='$customer_id' ");
		             redirect('agent/index'); 
                       }
                      else{  
                             // updating the current outstanding
                             $newcurrent_balance = $payment_data[0]['balance'];
		             $current_balance = $newcurrent_balance - $emi; 
                             $currentcapital = $payment_data[0]['capital_paid'];
                             $currentinterest = $payment_data[0]['interest_paid'];
                          
                             $interest_paid = $currentinterest + ($emi * ($rate/100));
		             $capital_paid = $currentcapital + ($emi - $interest_paid);
		             
		             $data['customer_id'] = $customer_id;
		             $data['loan_transaction_no'] = $transaction_id;
		             $data['payment_amount'] = $amount;
		             $data['balance'] = $current_balance;
		             $data['payment_month'] = $payment_month;
		             $data['capital_paid'] = $capital_paid;
		             $data['interest_paid'] = $interest_paid;
		             $data['penalty'] = "No";
		             $data['payment_date'] = $current_date;
		             $this->db->insert('payment', $data);
		           
		          // updating the current outstanding
		          //   $current_balance = $balance - $emi; 
		             $balance_update_query = $this->db->query("UPDATE customer SET balance='$current_balance' WHERE id='$customer_id' ");
		             redirect('agent/index'); 
                             
                      }
              }
               else{
                     if($count == 0){
				     echo "Penalty has been charged";
				 // updating the current outstanding with penalty amount 700
				     $balance = $balance + 700;
				     $current_balance = $balance - $emi; 
				     $interest_paid = $emi * ($rate/100);
				     $capital_paid = $emi - $interest_paid;
				     
				     $data['customer_id'] = $customer_id;
				     $data['loan_transaction_no'] = $transaction_id;
				     $data['payment_amount'] = $amount;
				     $data['balance'] = $current_balance;
				     $data['payment_month'] = $payment_month;
				     $data['capital_paid'] = $capital_paid;
				     $data['interest_paid'] = $interest_paid;
				     $data['penalty'] = "Yes";
				     $data['payment_date'] = $current_date;
				     $this->db->insert('payment', $data);
				   
				 
				     $balance_update_query = $this->db->query("UPDATE customer SET balance='$current_balance' WHERE id='$customer_id' ");
				     redirect('agent/index'); 
                       }
                     else{
                                echo "Penalty has been charged";
                                 
				 // updating the current outstanding with penalty amount 700
				     $balance = $balance + 700;
				     $current_balance = $balance - $emi; 
				     $currentcapital = $payment_data[0]['capital_paid'];
                                     $currentinterest = $payment_data[0]['interest_paid'];
                          
                                     $interest_paid = $currentcapital + ($emi * ($rate/100));
		                     $capital_paid = $currentinterest + ($emi - $interest_paid);
				     
				     $data['customer_id'] = $customer_id;
				     $data['loan_transaction_no'] = $transaction_id;
				     $data['payment_amount'] = $amount;
				     $data['balance'] = $current_balance;
				     $data['payment_month'] = $payment_month;
				     $data['capital_paid'] = $capital_paid;
				     $data['interest_paid'] = $interest_paid;
				     $data['penalty'] = "Yes";
				     $data['payment_date'] = $current_date;
				     $this->db->insert('payment', $data);
				   
				 
				     $balance_update_query = $this->db->query("UPDATE customer SET balance='$current_balance' WHERE id='$customer_id' ");
				     redirect('agent/index'); 
                       }
           
                        
                }
         }  

        // dashboard loan detail  
        public function get_loan_detail(){
            
             
             $query = $this->db->query("SELECT c.cus_name,d.loan_amount,c.balance,d.interest,d.years,d.emi FROM customer c , debt d WHERE c.id = d.customer_id");
             $loan = $query->result_array();
             $loan_data = json_encode($loan);
             echo $loan_data;
            
         }      
    
        // get balance view 
        public function getbalance(){
           
             $this->load->view('get_balance');
            
         }   
        
       // get balance 
        public function get_balance(){

             $transaction_id = $_POST['transaction_id'];
             $date = $_POST['date'];
             $data['transaction_id'] = $transaction_id;
             $data['date'] = $date;
             $query = $this->db->query("SELECT balance,capital_paid,interest_paid FROM payment WHERE payment_date='$date' AND loan_transaction_no ='$transaction_id'");
             $loan = $query->result_array();
             $data['balance'] = json_encode($loan);
             $this->load->view('get_balance_view',$data);
         }  
    
       // get row adjustment
        public function getadjustment(){

            
             $query = $this->db->query("SELECT transaction_id FROM debt");
             $loan = $query->result_array();
             
               foreach($loan as $value){
                  
                   $id = $value['transaction_id'];
                   $inner_query  = $this->db->query("SELECT * FROM payment WHERE loan_transaction_no='$id' ORDER BY id DESC LIMIT 1 ");
                   $tmp[] = $inner_query->result_array();
                   
                   
               }
             
             $data['adjustment'] = json_encode($tmp);
             $this->load->view('get_adjustment_view',$data);
         }      

}
?>
