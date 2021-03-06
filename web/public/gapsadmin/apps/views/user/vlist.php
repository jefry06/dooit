<div class="row">
  <div id="breadcrumb" class="col-md-12">
    <ol class="breadcrumb">
      <li><a href="#">Dashboard</a></li>
      <li><a href="#"><?=$page_title?></a></li>
    </ol>
  </div>
</div>              
      <!-- DataTables Example -->
<!-- <h3 class="page-header"><?=$page_title?></h3> -->
<p><a href="add/" class="btn btn-default"><i class="fa fa-file"></i> Add New</a> </p>      
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
                  <th>Username</th>
                  <th>Nama</th>
                  <th>Email</th>
                  <th class="hidden-xs">Telepon</th>
                  <th class="hidden-xs">Status</th>                                    
                  <th >Action</th>
                </thead>
                  <tbody>
                    <tr>
                      <td>Username</td>
                      <td>Nama</td>
                      <td>Email</td>
                      <td class="hidden-xs">Telepon</td>
                      <td class="hidden-xs">Status</td>
                      <td class="actions">
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
        "ajax": {
                "url": "json",
                "type": "POST"
        },
        "columns": [
          { "data": "username"},
          { "data": "nama" },
          { "data": function ( data, type, full, meta ) {
                      var ret='<a href=\"mailto:'+data.email +'\">'+data.email+'</a>';                         
                      return ret;    
                    }
          },
          { "data": "telpon", "sClass": "hidden-xs"},
          { "data": function ( data, type, full, meta ) {
                        var ret; 
                        if(data.aktif=='1') 
                          { 
                            ret='<td class=\"actions\"><div class=\"action-buttons\">Aktif <a onclick=\"nonaktifkan('+ data.uid +');\" class=\"table-actions\" href=\"#\"><i class=\"fa fa-ban\"></i></a></div></td>';  
                          }else{ 
                            ret='<td class=\"actions\"><div class=\"action-buttons\">NonAktif <a onclick=\"aktifkan('+ data.uid +');\" class=\"table-actions\" href=\"#\"><i class=\"fa fa-check-circle-o\"></i></a></div></td>'; 
                          }
                        return ret;
                      },
            "sClass": "hidden-xs"
          },          
          { "data" : function ( data, type, full, meta ) {

var ret='<div class="btn-group"><a class="btn btn-primary" href="#"><i class="fa fa-user fa-fw"></i> Action</a><a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="fa fa-caret-down"></span></a><ul class="dropdown-menu"><li><a href="edit/'+data.uid+'"><i class="fa fa-pencil fa-fw"></i> Edit</a></li><li><a href="#" onclick="delete_id('+ data.uid +');"><i class="fa fa-trash-o fa-fw"></i> Delete</a></li><li><a href="access/'+data.uid+'"><i class="fa fa-eye fa-fw"></i> User Access</a></li></ul></div>';            
//                        var ret='<td class=\"actions\"><div class=\"action-buttons\"><a class=\"table-actions\" href="edit/'+data.uid+'\"><i class=\"fa fa-pencil\"></i></a><a onclick=\"delete_id('+ data.uid +');\" class=\"table-actions\" href=\"#\"><i class=\"fa fa-trash-o\"></i></a></div></td>';
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


  <script type="text/javascript">
  
  /*
  # ===============================================================================
  # Delete Confirmation
  # ===============================================================================
  */
    function delete_id(id)
    {
       var c= confirm("Anda yakin Hapus ?");
       if(c==true)
       {          
          window.location.replace("delete/"+id);          
       }
       return false;
    };

  /*
  # ===============================================================================
  # Nonaktifkan
  # ===============================================================================
  */
    function nonaktifkan(id)
    {
       var c= confirm("Nonaktifkan User ?");
       if(c==true)
       {          
          window.location.replace("nonaktifkan/"+id);          
       }
       return false;
    };    

  /*
  # ===============================================================================
  # Aktifkan
  # ===============================================================================
  */
    function aktifkan(id)
    {
       var c= confirm("Aktifkan User ?");
       if(c==true)
       {          
          window.location.replace("aktifkan/"+id);          
       }
       return false;
    };    
  </script>  
    