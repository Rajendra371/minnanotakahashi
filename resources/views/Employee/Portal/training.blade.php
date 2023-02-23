@extends('Layout.employee.app')
@section('content')
<div class="container">
    <div class="row">
        @include('Layout.employee.sidebar')

        <div class="col-lg-11 col-md-10 col-sm-9 col-xs-12">
            <div class="my-profile">
                <div class="resume-content">
                    <div class="career-objective section">
                        <div class="icons">
                            <i class="fa fa-list" aria-hidden="true"></i>
                        </div>
                        <div class="career-info">
                            <h3>Trainings</h3>
                            <div id="table">
                                <table class="table table-bordered table-responsive-md table-striped text-center">
                                  <thead>
                                    <tr>
                                      <th class="text-center">S No.</th>
                                      <th class="text-center">Trainings</th>
                                      <th class="text-center">Check All&nbsp; &nbsp;
                                          <input type="checkbox" id="checkAllTrainings" />
                                          <a href="javascript:;" class="btnRefresh" title="Refresh Training" data-id="trainingBody" data-url="{{route('refresh-training')}}"><i class="fa fa-refresh"></i></a>
                                      </th>
                                    </tr>
                                  </thead>
                                  <tbody id="trainingBody">
                                   @include('Employee.Portal.training_table_body')
                                  </tbody>
                                </table>
                                <div class="col-lg-12 col-md-12 col-12 form-messages"></div>
                                <button type="button" class="btn btn-primary" id="saveTrainings" style="display: none">Save</button>
                            </div>    
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    
    $(document).off('click','#checkAllTrainings');
    $(document).on('click','#checkAllTrainings',function () {
        if ($(this).is(":checked")) {
            $('.trainings').each(function(){
                this.checked = true;
                $("#saveTrainings").show();
                var id = this.getAttribute('data-id');
                $(`#file_${id}`).css('display','inline-block');
            });
        }else{
            $('.trainings').each(function(){
                this.checked = false;
                var id = this.getAttribute('data-id');
                $(`#file_${id}`).val('');
                $(`#file_${id}`).hide();
                $("#saveTrainings").hide();
            });
        }    
    });

    $(document).off("click", ".trainings");
    $(document).on("click", ".trainings", function(e) {
    var id = this.getAttribute('data-id');
    if (this.checked) {
        this.checked = true;
        $("#saveTrainings").show();
        $(`#file_${id}`).css('display','inline-block');
    } else {
        $(`#file_${id}`).val('');
        $(`#file_${id}`).hide();
        var check = $(".trainings:checkbox").filter(":checked");
        this.checked = false;
        if (check.length >= 1) {
        $("#saveTrainings").show();
        } else {
        $("#saveTrainings").hide();
        }
    }
    });

    $(document).off("click", "#saveTrainings");
    $(document).on("click", "#saveTrainings", function(e) {
    var conf = confirm("Save Selected Trainings ?");
    if (conf) {
    var data = new FormData();
    var ids = 0;
    $.each($("input[name='trainings[]']:checked"), function() {
        data.append('ids[]', $(this).val());
        ids++;
    });
    if(ids == 0){
        alert('Please Select At Least One Training');
        return false;
    }
    
    var filesLen = 0;  
    $.each($('input:file.attachments'),function (i, value) {
        if (value.files[0] !== undefined) {
            data.append('files[]', value.files[0]);
            filesLen++;
        }
    }) 
    // $.each($("input:file.attachments")[0].files, function(i, file) {
    //     data.append('files[]', file);
    //     filesLen++;
    // });
    console.log({ids, filesLen});
    // return false;
    if (filesLen != ids) {
        alert('Please Attach Files For The Selected Trainings');
        return false;
    }

    $(this).hide();
    var url = "save_trainings";
    axios.post(url, data).then((response) => {
        $('.form-messages').html(response.data.message);
        if (response.data.status == "success") {
            $('.form-messages').addClass('alert alert-success');
            setTimeout(() => {
                $('.btnRefresh').trigger('click');
            }, 2000);
        } else {
            $('.form-messages').addClass('alert alert-danger');
        }
        setTimeout(function() {
            $('.form-messages').html('');
            $(".form-messages").removeClass("alert alert-success alert-danger");
        }, 2000);
    });
    }
    });

</script>
@endsection