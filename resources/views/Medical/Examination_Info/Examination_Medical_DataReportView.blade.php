<a href="javascript:void(0)" id="btn_print_medical"><i class="fa fa-print"></i>Print</a>
<div class="displayReportDiv" style="border:1px solid; margin-top:5px">
<div class="form-group general_info white-box pad-5 printTable" style="margin: 10px">
        <?php
        $view = view("Medical/Examination_Info/Examination_Report_Generate")
        ->with('data', $data);
      // ->with('invoice',$invoice)
      // ->with('exam',$exam);
      echo $template = $view->render();

        ?>
</div>
</div>


<script>
$(document).off('click','#btn_print_medical');
$(document).on('click','#btn_print_medical',function(){
    // alert('test');
    $(".printTable").show()
    $(".printTable").printThis();
})
</script>