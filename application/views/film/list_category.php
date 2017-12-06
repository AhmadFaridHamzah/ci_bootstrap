<script type="text/javascript">
	$(document).ready(function () {

    $('#film_table').dataTable({
                stateSave: true,
                processing: true,
                serverSide: true,
                "order": [[ 0, "desc" ]],
                ajax: {
                    "url": "<?=site_url('admin/filmcategory/film_dataTable')?>",
                    "type": "POST",
                    data:{<?= $this->security->get_csrf_token_name()?>:'<?=$this->security->get_csrf_hash()?>'}
                    },
                    columns: [
                      {data : "f.title"},
                      {data : "f.description"},
                      {data : "f.release_year"},
                      {data : "c.name"},
                      {data:  "$.language" },
                      {data:  "$.action_btn" }

                    ]
      });

      $(document).on("click", ".btn_info", function() {

            $('#modal_infofilm').modal({
                keyboard: false
            });

            var dataid = $(this).attr('data-id');
            
            $.ajax({
                url : "<?php echo site_url('admin/filmcategory/info_film')?>/" +dataid,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                	$('#film_name').text(data.title);
                	$('#film_desc').text(data.description);
                	$('#film_release').text(data.release_year);
                	$('#film_language').text(data.name);
                	$('#film_length').text(data.length);
                    
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    console.log(jqXHR);

                    alert(errorThrown);
                }
            });
     });


      $(document).on("click", ".btn_edit", function() {

            $('#modal_editfilm').modal({
                keyboard: false
            });

            var dataid = $(this).attr('data-id');
            
            $.ajax({
                url : "<?php echo site_url('admin/filmcategory/info_film')?>/" +dataid,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                	$('#title').val(data.title);
                	$('#description').val(data.description);
                	$('#release_year').val(data.release_year);
                	$("#language_id").val(data.language_id).change();
                	$('#length').val(data.length);
                	$('#film_id').val(data.film_id);
                    
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    console.log(jqXHR);

                    alert(errorThrown);
                }
            });
     });


      $(document).on("click", ".btn_delete", function() {

            $('#modal_deletefilm').modal({
                keyboard: false
            });

            var dataid = $(this).attr('data-id');

            $("#delete_data").val(dataid);
        });

      	$(document).on("click", ".delete_data",function(event){

            var dataid = $(this).val();
            // var datacitizen = $(this).val();
//             alert(dataid);
			 event.preventDefault();
            $.ajax({
                url : "<?php echo site_url('admin/filmcategory/delete_film')?>/" +dataid,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                	$('#modal_deletefilm').modal('hide');
//                    console.log(data);
                    location.reload();
                    
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    console.log(jqXHR);

                    alert(errorThrown);
                }
            });

        });

        $("#btn_search").on("click",function(){
          filterColumn( $('input.column_filter').attr('data-column') );

          var data_category = $("#col3_filter").val();

          if (typeof(data_category) != "undefined" && data_category==	"") {
          	filterColumn(4);
          }

        });


  });

	function editfilmdata(){
        $("#editfilm").submit();
	}

	function filterColumn ( i ) {
        $('#film_table').DataTable().column( i ).search(
            $('#col'+i+'_filter').val(),
            false,
            true
            //console.log($('#col'+i+'_filter').val()),
        ).draw();
    }

    function resetFields(){
    	var table = $('#film_table').DataTable();
    	table
    	.search('')
    	.columns().search('')
    	.draw();
    }
</script>


		<div class="col-md-12">
          <!-- general form elements -->
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Categories</label>
                  <input type="text" class="form-control column_filter" id="col3_filter" data-column="3">
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">Language</label>
                  <input type="text" class="form-control column_filter" id="col4_filter" data-column="4">
                </div>
               
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="button" id="btn_search"class="btn btn-primary pull-right">Search</button>
                <button type="reset" onclick="resetFields()" id="btn_reset"class="btn btn-default pull-right">Reset</button>

              </div>
            </form>
          </div>

          <br><br>
<table id="film_table" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Release year</th>
            <th>Categories</th>
            <th>Language</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody></tbody>
    <tfoot>
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Release year</th>
            <th>Categories</th>
            <th>Language</th>
            <th>Action</th>
        </tr>
    </tfoot>
</table>

<div class="modal modal-info fade" id="modal_infofilm">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Info Film</h4>
              </div>
              <div class="modal-body">
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form">
              <div class="box-body">
                <div class="form-group">
                  <label for="name">Film Name :</label>
                  <label id="film_name"></label>
                </div>
                <div class="form-group">
                  <label for="desc">Description :</label>
                  <label id="film_desc"></label>
                </div>
                <div class="form-group">
                  <label for="release">Release :</label>
                  <label id="film_release"></label>
                </div>
                <div class="form-group">
                  <label for="language">Language :</label>
                  <label id="film_language"></label>
                </div>
                <div class="form-group">
                  <label for="length">Length Film :</label>
                  <label id="film_length"></label>
                </div>
              </div>
              <!-- /.box-body -->
            </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal_editfilm">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Film</h4>
              </div>
              <div class="modal-body">
               <div class="box box-primary">
            <!-- /.box-header -->
            <!-- form start -->
 			<?php echo form_open('admin/filmcategory/edit_filminfo', array('class' =>'modal-content','id'=>'editfilm','name'=>'editfilm'));  ?>
               <div class="box-body">
                <div class="form-group">
                  <label for="filmname">Film Name</label>
                  <input type="text" class="form-control" id="title" value="" name="title">
                </div>
                <div class="form-group">
                  <label for="filmdesc">Description</label>
                  <textarea class="form-control" rows="3" id="description" name="description" value=""></textarea>
                </div>
                <div class="form-group">
                  <label for="filmrelease">Film Release</label>
                  <input type="text" class="form-control" id="release_year" value="" name="release_year">
                </div>
                <div class="form-group">
                  <label for="filmrelease">Language</label>
				   <select name="language_id" id="language_id" class="form-control">
                    <option value="1">English</option>
                    <option value="2">Italian</option>
                    <option value="3">Japanese</option>
                    <option value="4">Mandarin</option>
                    <option value="5">French</option>
                    <option value="6">German</option>
                  </select>                
              </div>
              <div class="form-group">
                  <label for="filmlength">Film Length</label>
                  <input type="text" class="form-control" id="length" value="" name="length">
                  <input type="hidden" class="form-control" id="film_id" value="" name="film_id">

              </div>
              </div>
              <!-- /.box-body -->
            </form>
          </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button class="btn btn-primary" onclick="editfilmdata()">Save changes</button>
              </div>
             <?php echo form_close(); ?>

            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>

        <div class="modal modal-danger fade" id="modal_deletefilm">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Delete Film</h4>
              </div>

              <div class="modal-body">
                <p>Are you sure want to delete?</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-outline delete_data" id="delete_data">Delete</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
