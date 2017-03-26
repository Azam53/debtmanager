
//$('.message a').click(function(){
//   $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
//});

function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}

// function for getting select options of customer id and transaction id for payment form 
$(function(){
              $.getJSON("http://localhost/debtmanager/index.php/agent/get_loan_customer_id" ,
                  function(data){
                     var userHTML = "";
                      for(aUser in data){
                        var user = data[aUser];
                         
                            
			    userHTML += "<option value=" + user.customer_id + " >" + user.customer_id + "</option>";
			    
                       }
                        $("#customer_select").append(userHTML);
                       
                  });
            
              $.getJSON("http://localhost/debtmanager/index.php/agent/get_loan_transaction_id" ,
                  function(data){
                     var userHTML = "";
                      for(aUser in data){
                        var user = data[aUser];
                         
                            
			    userHTML += "<option value=" + user.transaction_id + " >" + user.transaction_id + "</option>";
			    
                       }
                        $("#transaction_select").append(userHTML);
                       
                  });
               
            $.getJSON("http://localhost/debtmanager/index.php/agent/get_loan_detail" ,
                  function(data){
                     var loanHTML = "";
                      for(aUser in data){
                        var user = data[aUser];
                         
                            loanHTML += "<tr>";
			    loanHTML += "<td>"+user.cus_name+"</td>";
                            loanHTML += "<td>"+user.loan_amount+"</td>";
                            loanHTML += "<td>"+user.balance+"</td>";
			    loanHTML += "<td>"+user.interest+"</td>";
                            loanHTML += "<td>"+user.years+"</td>";
                            loanHTML += "<td>"+user.emi+"</td>";
                            loanHTML += "</tr>";
                             
                       }
                        $("#loan_detail").append(loanHTML);
                       
                  });
         
        
});

// function for getting emi
function get_emi() {
    
   var transaction_id = $("#transaction_select").val();
   var customer_id = $("#customer_select").val();

   $.ajax({
                type: "POST",
                url: "get_emi" ,
                data: { customer_id: customer_id , transaction_id:transaction_id },
                dataType: 'json' ,
                success : function(data) { 
                  
                     var emiHTML = "";
                    
                     emiHTML += " <input type='number' placeholder='monthly emi' name ='emi' value="+  data[0].emi +">";
                     
                     $("#getemi").hide();  
                     $("#emi").append(emiHTML);
                  
                
                }
            });

}

// function to bring date
function get_date() {
    
   var transaction_id = $("#transaction_select").val();

   $.ajax({
                type: "POST",
                url: "get_date" ,
                data: { transaction_id:transaction_id },
                dataType: 'json' ,
                success : function(data) { 
                     console.log(data);
                     var dateHTML = "";
                  
                     for(aUser in data){
                        var user = data[aUser];
                         
                            
			    dateHTML += "<option value=" + user.payment_date + " >" + user.payment_date + "</option>";
			    
                       }
                     
                     $("#date_select").html(dateHTML);
                  
                
                }
            });

}
