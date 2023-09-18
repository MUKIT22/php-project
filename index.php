<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Main page</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />    
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <table id="main" border="0" cellspacing="0">
    <tr>
      <td id="header">
        <h1>Employee</h1>
      </td>
    </tr>

<tr>

    <!-- Trigger the modal with a button -->
    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" id="main-but">Add Employee</button>
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
        
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Employee info</h4>
            </div>
            <div class="modal-body">
                <form action="ajax-insert.php" method="POST">
                 <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" />
                    </div>
                     <div class="form-group">
                 </div>
                 <div class="form-group">    
                    <label for="dob">DOB</label>
                    <input type="date" id="date" />
                 </div>
                 <div class="form-group">
                    <label for="ctc">Current CTC</label>
                    <input type="text" id="ctc" />
                 </div>
                 <div class="form-group">
                    <label for="Technlogies">Techonologies</label>
                        <select class="form-group" name="technologies" multiple="multiple" id="technologies" style="width: 50%">
                            <option value="html"> HTML </option>
                            <option value="css"> CSS </option>
                            <option value="jss"> JS </option>
                            <option value="php" >PHP </option>
                        </select>
                 </div>            
                    <button type="submit" class="btn btn-primary" id="save-button">Submit</button>
                </form>
               </div>
              </div>
             </div> 



</tr>

    <tr>
      <td id="table-data">
      </td>
    </tr>
  </table>
  <div id="error-message"></div>
  <div id="success-message"></div>
  <div id="modal">
    <div id="modal-form">
      <h2>Edit Form</h2>
      <table cellpadding="10px" width="100%">
      </table>
      <div id="close-btn">X</div>
    </div>
  </div>

<script type="text/javascript">

  $(document).ready(function(){
    $("#technologies").select2({
            multiple:true
        });
    // Load Table Records
    function loadTable(){
      $.ajax({
        url : "ajax-load.php",
        type : "POST",
        success : function(data){
          $("#table-data").html(data);
        }
      });
    }
    loadTable(); // Load Table Records on Page Load

    // Insert New Records
    $("#save-button").on("click",function(e){
      e.preventDefault();
            var name = $("#name").val();
            var date = $("#date").val();
            var ctc = $("#ctc").val();
            var technologies = $("#technologies").val();
            var tech= JSON.stringify(technologies);
      if(name == "" || date == ""){
        $("#error-message").html("All fields are required.").slideDown();
        $("#success-message").slideUp();
      }else{
        $.ajax({
          url: "ajax-insert.php",
          type : "POST",
          data : {name: name, date: date, ctc: ctc, tech: tech},
          success : function(data){
            if(data == 1){
              loadTable();
              $("#addForm").trigger("reset");
              $("#success-message").html("Data Inserted Successfully.").slideDown();
              $("#error-message").slideUp();
            }else{
              $("#error-message").html("Can't Save Record.").slideDown();
              $("#success-message").slideUp();
            }

          }
        });
      }

    });

    //Delete Records
    $(document).on("click",".delete-btn", function(){
      if(confirm("Do you really want to delete this record ?")){
        var studentId = $(this).data("id");
        var element = this;

        $.ajax({
          url: "ajax-delete.php",
          type : "POST",
          data : {id : studentId},
          success : function(data){
              if(data == 1){
                $(element).closest("tr").fadeOut();
              }else{
                $("#error-message").html("Can't Delete Record.").slideDown();
                $("#success-message").slideUp();
              }
          }
        });
      }
    });

    //Show Modal Box
    $(document).on("click",".edit-btn", function(){
      $("#modal").show();
      var id = $(this).data("eid");

      $.ajax({
        url: "load-update-form.php",
        type: "POST",
        data: {id: id },
        success: function(data) {
          $("#modal-form table").html(data);
        }
      })
    });

    //Hide Modal Box
    $("#close-btn").on("click",function(){
      $("#modal").hide();
    });

    //Save Update Form
      $(document).on("click","#edit-submit", function(){
        var id = $("#edit-id").val();
        var name = $("#edit-fname").val();
        var date = $("#edit-dob").val();
        var ctc = $("#edit-ctc").val();
        var technologies = $("#edit-tech").val();
        var tech= JSON.stringify(technologies);

        $.ajax({
          url: "ajax-update-form.php",
          type : "POST",
          data : {id: id, name: name, date: date, ctc: ctc, tech:tech},
          success: function(data) {
            if(data == 1){
              $("#modal").hide();
              loadTable();
            }
          }
        })
      });

  });
</script>
</body>





</html>
