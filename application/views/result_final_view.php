
   <div class="section">
      <div class="containermenu">

        <!-- Barra que indica la posicion dentro de pagina-->
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url();?>main">Menu</a></li>
            <li><a href="<?php echo site_url();?>result">Mode Menu Results</a></li>
            <li class="active">Final Test Results</li>
        </ol>

        <h3><center>Final Test Results</center></h3>
      
        <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>

        <br/>
        <br/>

            <table id="table" class="table table-hover table-bordered colortablas" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>First name</th>
                        <th>Last Name</th>
                        <th>Date</th>
                        <th>Result</th>
                        <th>Likert</th>
                        <th>Test</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>

                <tfoot>
                <tr>
                    <th>First name</th>
                    <th>Last Name</th>
                    <th>Date</th>
                    <th>Result</th>
                    <th>Likert</th>
                    <th>Test</th>
                </tr>
                </tfoot>
            </table>
        </div> <!-- end containermenu -->
    </div> <!-- end section-->




<script type="text/javascript">

    var table;

    $(document).ready(function() {

        //datatables
        table = $('#table').DataTable({ 
             
            dom: 'Bfrtip',
            buttons: [
                'print'
            ],

            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.

            "columns": [ //Hace que las columnas se puedan o no ordenar
                {
                    "orderable": true,
                }, 
                {
                    "orderable": true,
                }, 
                {
                    "orderable": true,
                },
                {
                    "orderable": false,
                },
                {
                    "orderable": false,
                },
                {
                    "orderable": false,
                    "width": "25%"
                }
            ],
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('result/ajax_list_final')?>",
                "type": "POST"
            },

        });

        //set input/textarea/select event when change value, remove class error and remove text help block 
        $("input").change(function(){
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
        });
        $("textarea").change(function(){
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
        });
        $("select").change(function(){
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
        });

    });



    function reload_table()
    {
        table.ajax.reload(null,false); //reload datatable ajax 
    }

    function see_results(id)
    {
       window.location.href = "<?php echo site_url();?>result/display_results_final/"+id;
    }

    function repeat_exam(id)
    {
       window.location.href = "<?php echo site_url();?>chat/repeat_final_test/"+id;
    }

</script>


</body>
</html>