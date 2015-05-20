<div class="row">
  <div id="breadcrumb" class="col-md-12">
    <ol class="breadcrumb">
      <li><a href="#">Dashboard</a></li>
      <li><a href="#"><?=$page_title?></a></li>
    </ol>
  </div>
</div>  
      <!-- DataTables Example -->

      <div class="row">
  <div class="col-xs-12 col-sm-12">
    <div class="box">
      <div class="box-header">
        <div class="box-name">
          <i class="fa fa-table"></i>
          <span><?=$page_title?></span>
        </div>
        <div class="box-icons">
          <a class="collapse-link">
            <i class="fa fa-chevron-up"></i>
          </a>
          <a class="expand-link">
            <i class="fa fa-expand"></i>
          </a>
          <a class="close-link">
            <i class="fa fa-times"></i>
          </a>
        </div>
        <div class="no-move"></div>
      </div>
      <div class="box-content">
              <table class="table table-bordered table-striped" width="100%" id="dataTable1">
                <thead>
                  <th>Order Date</th>
                  <th>Order ID</th>
                  <th>User ID</th>
                  <th class="hidden-xs">Order Total</th>
                  <th class="hidden-xs">Status</th>
                  <th >Action </th>
                </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>2</td>
                      <td>3</td>
                      <td class="hidden-xs">4</td>
                      <td class="hidden-xs">5</td>
                      <td class="actions">
                        <div class="action-buttons">
                          <a class="table-actions" href=""><i class="fa fa-eye"></i></a><a class="table-actions" href=""><i class="fa fa-pencil"></i></a><a class="table-actions" href=""><i class="fa fa-trash-o"></i></a>
                        </div>
                      </td>
                    </tr>
                  </tbody>                
                </table>
            </div>
          </div>
        </div>
      </div>
      <!-- end DataTables Example -->

  <script type="text/javascript" language="javascript" class="init">
  (function() {
    /*
    # =============================================================================
    #   DataTables
    # =============================================================================
    */

    var dataTable = $("#dataTable1").dataTable({
        "bProcessing" : true,
        "bServerSide" : true,
        "bStateSave"  : true,
        "sAjaxSource" : "json/",
        "columns": [
          { "data": "order_date"},
          { "data": "order_code" },
          { "data": "user_id" },
          { "data": "order_total", "sClass": "hidden-xs" },
          { "data": function ( data, type, full, meta ) {
            var ret="";
            if(data.order_status=='0'){
              ret="Pending";  
            }else if(data.order_status=='1'){
              ret="Dikirim";
            }else{
              ret="Dibatalkan";
            }

             return ret;

          }, "sClass": "hidden-xs" },
          { "data" : function ( data, type, full, meta ) {
            
                    var ret='<div class="btn-group"><a class="btn btn-primary" href="#"><i class="fa fa-user fa-fw"></i> Action</a><a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="fa fa-caret-down"></span></a><ul class="dropdown-menu"><li><a href="detail/'+data.order_code+'"><i class="fa fa-info fa-fw"></i> Detail</a></li><li><a href="addhistory/'+data.order_code+'" ><i class="fa fa-plus fa-fw"></i>Add History</a></li></ul></div>'; 
                        return ret;
                      }            
          }
        ],  
      
      "sPaginationType": "full_numbers",
          aoColumnDefs: [
            {
              bSortable: false,
              aTargets: [-1]
            }
          ]            
    });

    }).call(this);    
  </script>    
    