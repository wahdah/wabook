  <div class="row">
        <div class="col-sm-9">
           <div class="big_box">
            
               <form name="payment_form" method="post" enctype="multipart/form-data">
                
                <div class="offline-pay">
                    <p><b>Please Bank-in cheque / cash to the following account :</br>
                    </br>Payment / Bank Account Information</br>
					<?php $ba = $bankapi['company_profile']['bank_id'] ?>
                    Name of Bank : <?= $bankapi['banks'][$ba] ?> </br>
                    Account Number : <?= $bankapi['company_profile']['account_no'] ?><span style="color:blue;font-weight:bold"></span></br>
                    Pay to : <?= $bankapi['company_profile']['account_name'] ?></br></br>
                    Once payment make, please screenshot or snap your receipt and fill up form below.</b></p>
                </div>
    
      
    <div class="row box summary-book">
        
        <div class="col-xs-8 col-sm-6">
            <div style="display:inline-block;">
                <p style="font-weight:bold;width:300px;margin:0;float:left">Pay Amount (RM) :<br/><input type="text" name="amountbox" size="20" style="width: 200px;" value="" required  /></p>
                <p style="font-weight:bold;width:250px;margin:0;float:left">Transaction Date : <br/>
				<input type="text" id="datepick" class="datepick" placeholder="Transcation Date" name="date_transaction" value="" required />
				</p>
            </div>
            
            <div style="display:inline-block;float:left;padding-right:20px;font-weight:bold">
                <p>From Bank :<br/> 
                <select name="bankname" style="width: 300px;" required >
                    <option value="Maybank">Maybank</option>
                    <option value="CIMB">CIMB</option>
                    <option value="PBB">PBB</option>
                    <option value="Hong Leong">Hong Leong</option>
                    <option value="HSBC">HSBC</option>
                </select>
                </p> 
                <p>Beneficiancy Name :<input type="text" name="benefbox" size="10" style="width: 300px;" value="<?= $bankapi['company_profile']['account_name'] ?>" disabled />
                <input type="hidden" name="benefbox" size="10" style="width: 500px;" value="Tuition Ace Sdn Bhd"  /></p>
            </div>
            
        </div>

        <div class="col-xs-4 col-sm-6">
            <div style="font-weight:bold">
                
                <div>
                <p>Transfer Type :<br/>
                <select name="transfer" style="width: 300px;" required >
                    <option value="ATM Transfer">ATM Transfer</option>
                    <option value="Cheque Deposit">Cheque Deposit</option>
                    <option value="Cash Deposit">Cash Deposit</option>
                </select></p>
                <p>Transaction No/Reference No :<input type="text" name="transaction" size="20" style="width: 300px;" required /></p>
                </div>
                
                <h3 class="h3" style="font-weight:bold;">Total Fee : RM <span style="font-weight:bold;color:green"><?= sprintf('%0.2f', round($sale_data['sale']['total_amount'], 2)) ?></span></h3>
                
                Proof of Payment :
                <input type="file" name="picture" accept=".jpg,.png,.pdf" required /></br>
            </div>
                <small>Allowed file type : jpg,png,pdf with maximum size of 1MB</small>

      
     </div>
   </div>
            <div class="btn_container">
                <input style="float:right" type="submit" id="ibutton" name="insert" value="Submit" />
            </div>
            
        </form>
     </div>
   </div>
 </div>