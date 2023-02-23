<div>
<div class="animated fadeIn">
    <div class="card">
    <div class="card-header">
    </div>
    <div id="show_product_count" class="btn btn-sm btn-primary"></div>
    <input type="hidden" name="sales_product_id" id="fspi" value="">
    <table id="productListTable" class="table table-striped">
        <thead>
        <tr>
            <th width="5%"><input type="checkbox" name="product_sales" id="product_sales_checkbox"></th>
            <th width="10%">Product Title</th>
            <th width="10%">Price</th>
            <th width="10%">Image</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    </div>
</div>
</div>


<script>
function load_table_data() {
let category_id = <?php echo($category_id); ?>;
var dataurl = constvar.api_url + "sales_product/product_datatable_list";
var message = "";
message = "<p class='text-danger'>No Record Found!! </p>";
var dtablelist = $("#productListTable")
.dataTable({
    sPaginationType: "full_numbers",
    bSearchable: false,
    lengthMenu: [
    [15, 30, 45, 60, 100, 200, 500, -1],
    [15, 30, 45, 60, 100, 200, 500, "All"],
    ],

    iDisplayLength: 10,
    sDom: "ltipr",
    bAutoWidth: false,
    autoWidth: true,
    aaSorting: [[0, "desc"]],
    bProcessing: true,
    bServerSide: true,
    sAjaxSource: dataurl,

    fnServerData: function(sSource, aoData, fnCallback) {
    $.ajax({
        dataType: "json",
        type: "GET",
        headers: {
        Authorization: "Bearer" + localStorage.getItem("backend-jwt-token"),
        },
        url: sSource,
        data: aoData,
        success: fnCallback,
    });
    },
    oLanguage: {
    sEmptyTable: message,
    },
    aoColumnDefs: [
    {
        bSortable: false,
        aTargets: [0],
    },
    ],

    aoColumns: [
    { data: null },
    { data: "product_title" },
    { data: "price" },
    { data: "image" },
    ],

    fnServerParams: function(aoData) {
    aoData.push({ name: "category_id", value: category_id });
    // aoData.push({ name: "toDate", value: toDate });
    },

    fnRowCallback: function(nRow, aData, iDisplayIndex) {
    var oSettings = dtablelist.fnSettings();
    var id = aData.id;
    // $("td:first", nRow).html(oSettings._iDisplayStart + iDisplayIndex + 1);
    $("td:first", nRow).html(
    '<input type="checkbox" class="sales_product_id" name="product_id[]" value=' +
    id +
    ">"
    );
    return nRow;
    },

    fnCreatedRow: function(nRow, aData, iDisplayIndex) {
    var oSettings = dtablelist.fnSettings();
    var tblid = oSettings._iDisplayStart + iDisplayIndex + 1;
    $(nRow).attr("id", "listid_" + tblid);
    },
})

.columnFilter({
    sPlaceHolder: "head:after",
    aoColumns: [
    { type: null },
    { type: "text" },
    { type: "text" },
    { type: null },
    ],
});
}

setTimeout(() => {
    load_table_data();
}, 1000);

var sales_product_list = [];
 
function count_checked_product() {
    $.each($("input[name='product_id[]']:checked"), function() {
        sales_product_list.push($(this).val());
    });
    let new_array = new Set(sales_product_list);
    sales_product_list = [...new_array];
    $('#show_product_count').html(`${sales_product_list.length} Products Selected`);
    $('#fspi').val(sales_product_list);
  }

$(document).off("click", "#product_sales_checkbox");
$(document).on("click", "#product_sales_checkbox", function(e) {
  if (this.checked) {
    $(".sales_product_id").each(function() {
      this.checked = true;
    });
    count_checked_product();
  } else {
    $(".sales_product_id").each(function() {
        this.checked = false;
        let index = sales_product_list.indexOf($(this).val());
        // console.log(index);
        sales_product_list.splice(index,1);
        // console.log(sales_product_list);
    });
    count_checked_product();
  }
});

$(document).off("click", ".sales_product_id");
$(document).on("click", ".sales_product_id", function(e) {
  if (this.checked) {
    this.checked = true;
    count_checked_product()
  } else {
    this.checked = false;
    let index = sales_product_list.indexOf($(this).val());
    sales_product_list = sales_product_list.splice(index,1); 
    count_checked_product()
  }

  
});    

</script>

