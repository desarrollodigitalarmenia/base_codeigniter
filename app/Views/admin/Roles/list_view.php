
<div class="content-wrapper">
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0">Rol Page</h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="<?php echo site_url('./') ?>">Home</a></li>
                  <li class="breadcrumb-item active">Roles</li>
               </ol>
            </div>
         </div>
      </div>
   </div>
   <div class="content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-lg-12">
               <div class="card">
                  <div class="card-body">
                     <div class="container mt-4">
                        <div class="d-flex justify-content-end">
                           <a href="<?php echo site_url('admin/rol/create') ?>" class="btn btn-success mb-2">Add Rol</a>
                        </div>
                        <?php
                        if(isset($_SESSION['msg'])){
                           echo $_SESSION['msg'];
                        }
                        ?>
                        <div class="mt-3">
                           <table class="table table-bordered" id="users-list">
                              <thead>
                                 <tr>
                                    <th>User Id</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php if($roles): ?>
                                 <?php foreach($roles as $rol): ?>
                                 <tr>
                                    <td><?php echo $rol['id']; ?></td>
                                    <td><?php echo $rol['name']; ?></td>
                                    <td>
                                       <a href="<?php echo base_url('admin/rol/edit/'.$rol['id']);?>" class="btn btn-primary btn-sm">Edit</a>
                                       <button onclick="modalDelete('<?php echo base_url('admin/rol/delete/'.$rol['id']);?>')" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-danger">Delete</button> 
                                    </td>
                                    <!--<a href="<?php echo base_url('admin/rol/delete/'.$rol['id']);?>" class="btn btn-danger btn-sm">Delete</a>-->
                                 </tr>
                                 <?php endforeach; ?>
                                 <?php endif; ?>
                              </tbody>
                           </table>
                           <div class="modal fade" id="modal-danger">
                              <div class="modal-dialog">
                                 <div class="modal-content bg-danger">
                                    <div class="modal-header">
                                       <h4 class="modal-title">Eliminar item</h4>
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                       </button>
                                    </div>
                                    <div class="modal-body">
                                       <p>¿Desea eliminar el siguiente item?</p>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                       <button type="button" class="btn btn-outline-light" data-dismiss="modal">Cancelar</button>
                                       <a id="btn-delete-item" href="#" class="btn btn-outline-light">Eliminar</a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script>
   $(document).ready( function () {
      $('#users-list').DataTable();
   } );

   function modalDelete(url){
      $('#btn-delete-item').prop('href',url);
   }
</script>