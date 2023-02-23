<div class="white-box pad-5 mtop_10 pdf-wrapper ">
    <div class="jo_form organizationInfo" id="printrpt">
       <div class="list-table">
           <div class="pull-right text-right pad-btm-5 reportGeneration">
	            <a href="javascript:void(0)" class="btn btn_print"><i class="fa fa-print"></i></a>
	            <a href="javascript:void(0)" class="btn btn_excel btn_gen_report" data-exporturl="purchase_receive/purchase_analysis/generate_purchase_analysis_by_supplier_excel" data-exporttype="excel"><i class="fa fa-file-excel-o"></i></a>
	            <a href="javascript:void(0)" class="btn btn_pdf2 btn_gen_report" data-exporturl="purchase_receive/purchase_analysis/generate_purchase_analysis_by_supplier_pdf" data-exporttype="pdf" target="_blank"><i class="fa fa-file-pdf-o"></i></a>
            </div>
            <div class="clearfix"></div>
        <div class="table-responsive" style="overflow-x: hidden;">
    <table class="organizationInfo" width="100%" style="font-size:12px; margin-bottom: 5px; ">
	<tbody>
        <!-- <tr>
  		<td width="20%"></td>
  		<td style="text-align: center;">
  			<h4 style="color:#101010;margin-bottom: 0px;padding-bottom:5px;">
  				<span style="font-size: 14px;font-weight:600;" class="preeti">Napolian Health Care Center Pvt. Ltd.</span>
  			</h4>
  		</td>
  		<td width="25%"></td>
	</tr> -->
	<tr>
		<td width="20%"></td>
		<td style="text-align: center;">
			<h4 style="color:#101010;margin-bottom: 0px;font-size: 16px;font-weight:600;padding-bottom:5px;">
				<span class="preeti">Napolian Health Care Center Pvt. Ltd.</span>
			</h4>
		</td>
		<td width="25%"></td>
	</tr>

	<tr class="title_sub">
		<td width="20%"></td>
		<td style="text-align: center;">
			<h4 style="color:black;font-size: 14px;margin:0px;padding-bottom:5px;" class="preeti">
				Kathmandu-29,Samakhusi</h4>
		</td> 
		<td width="25%" style="text-align:right; font-size:10px;">
			<strong>Date/Time: </strong> 
			 2019/08/26 AD 16:19:20		</td>
	</tr> 

	<tr class="title_sub">
		<td width="20%"></td>
		<!-- <td style="text-align: center;"><font color="black"><span style="font-size: 12px;" class="preeti">Kathmandu-29,Samakhusi </span></font>
		</td> -->
		<td width="25%" style="text-align:right; font-size:10px;"></td>
	</tr>
</tbody></table>
            <table class="table table-striped alt_table border-table">
                <thead>
                    <tr class="header-boarder">
                        <th width="5%">S.N.</th>
                        <th width="10%">Date</th>
                        <th width="20%">Bill No.</th>
                        <th width="5%">Dr Amt</th>
                        <th width="10%">Cr Amt</th>
                        <th width="10%">Dr/Cr</th>
                        <th width="10%">Balance</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if($data):
                            $grandpaid =0;
                            $granddue =0;
                            $grandtotal =0;
                            foreach ($data as $ksm => $catid):
                                $itemcat=\DB::table('expenditure_info as ei')
                                ->leftjoin('expenditure_setup as es','es.id','=','ei.expenditure_source_id')
                                ->select('ei.*','exse_name')
                                ->where('expenditure_source_id',$catid->expenditure_source_id)
                                ->get();
                                if($itemcat): 
                    ?>
                    <tr>
                        <td colspan="6"> <strong><?php echo $catid->exse_name;  ?></strong></td>
                    </tr>
                    <?php
                        if($itemcat): 
                            $i=1;
                            $newpaid=0;
                            $newdue=0;
                            $newtotal=0;
                            
                            foreach ($itemcat as $km => $mlist):
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php  echo $mlist->postdatead;?>
                        </td>
                        <td><?php echo $mlist->bill_no; ?></td>
                          <td>
                            <?php echo $mlist->paid_amount; ?>
                        </td>
                        <td>
                            <?php echo $mlist->total_bill; ?>
                        </td>
                         <td>
                           Cr
                        </td>
                         <td>
                            <?php echo $mlist->remaining_amount; ?>
                        </td>
                    </tr>
                        <?php
                            $newtotal +=$mlist->total_bill;
                            $newpaid +=$mlist->paid_amount;
                            $newdue +=$mlist->remaining_amount;
                            $i++;
                            endforeach;
                        endif;
                        ?>
                    <tr class="borderBottom">
                        <td  colspan="5" align="right" class="text-right">
                            <strong><?php  echo $newtotal; ?></strong>
                        </td>  
                        <td align="right" class="text-right">
                            <strong><?php echo $newpaid; ?></strong>
                        </td>
                        <td align="right" class="text-right">
                            <strong><?php echo $newtotal-$newpaid; ?></strong>
                        </td>
                    </tr>
                <?php  
                        endif; 
                        $grandpaid += $newpaid;
                        $granddue +=$newdue;
                        $grandtotal +=$newtotal;
                    endforeach;
                ?>
                    <tr class="header-boarder">
                        <td colspan="6" class="header text-right" align="right">Paid:</td>
                        <td colspan="1"  class="header text-right" align="right">
                            <?php echo $grandpaid; ?>
                        </td>
                    </tr>

                    <tr class="header-boarder">
                        <td colspan="6" class="header text-right" align="right">Due:</td>
                        <td colspan="1"  class="header text-right" align="right">
                            <?php echo $granddue; ?>
                        </td>
                    </tr>
                    <tr class="header-boarder">
                        <td colspan="6" class="header text-right" align="right">Total:</td>
                        <td colspan="1"  class="header text-right" align="right">
                            <?php echo $grandtotal; ?>
                        </td>
                    </tr>
                <tr class="borderBottom">
                        <td  colspan="7" class="text-center text-capitalize">
                            <?php if($granddue=='0'){?>
                            <strong >Your account is clear.</strong>
                            <?php }else{?>
                            <strong >Due amount : <?php echo convert_to_word($granddue); ?></strong>
                            <?php }?>
                        </td>  
                    </tr>
                    <?php
                        endif; 
                    ?> 
                </tbody>
            </table>
        </div>
    </div>
</div>   </div>