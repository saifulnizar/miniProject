<!DOCTYPE html>
<html lang="en">

<head>

    <?php include('layout/head.php'); ?>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php include('layout/side.php') ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php include('layout/nav.php'); ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Data Vehicle</h1>
                    <p class="mb-4">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>

                    
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <!-- <h6 class="m-0 font-weight-bold text-primary">Data</h6> -->
                            <button href="#" class="btn btn-success btn-sm btn-icon-split"
                                style='float: right !important;'
                                id="tambah" 
                            >
                                <span class="icon text-white-50">
                                    <i class="fas fa-plus"></i>
                                </span>
                                <span class="text">Add</span>
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="show-data" >

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <?php include('layout/footer.php'); ?>

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form  Vehicle</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="store">
                <div class="modal-body">
                    <input type="hidden" name="id" id="id" value="">
                    <div class="form-group">
                        <label>Name Vehicle</label>
                        <input type="text" class="form-control form-control-user" name="name" id="name"
                            placeholder="Name..." required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" href="#">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>


    <?php include('layout/js.php'); ?>

    <script type="text/javascript">
        $(document).ready(function() {
            
            const getData = () => {

                $.get('<?= url("vehicle/getData")?>', function(data){

                    var html = '';
                    var no  = 1;
                        data.forEach((row) => {
                            
                            html +='<tr>'+
                                        '<td>'+no+'</td>'+
                                        '<td>'+row.name+'</td>'+
                                        '<td>'+
                                            '<a target="_blank" href="<?= url('history') ?>/'+row.id+'" class="btn btn-success btn-sm btn-icon-split  mr-2"><span class="icon text-white-50"><i class="fas fa-cogs"></i></span><span class="text">Detail</span></a>'+
                                            '<a href="#" data-id="'+row.id+'" class="btn btn-danger btn-sm btn-icon-split delete mr-2"><span class="icon text-white-50"><i class="fas fa-trash"></i></span><span class="text">Hapus</span></a>'+
                                            '<a href="#" data-id="'+row.id+'" class="btn btn-warning btn-sm btn-icon-split edit"><span class="icon text-white-50"><i class="fas fa-edit"></i></span><span class="text">Edit</span></a>'+
                                        '</td>'+
                                    '</tr>';
                            no++;
                        })

                    $('#show-data').html(html);

                });
            }
            
            $('#dataTable').DataTable();

            getData();

            var table = $('#dataTable').DataTable();

            $('#tambah').on('click', function(){
                $('#myModal #id').val('');
                $('#store')[0].reset();
                $('#myModal').modal('show');
            })

            $('#store').submit((e) => {

                e.preventDefault();
                $.ajax({
                    method : "POST",
                    url    : "<?= url('vehicle')?>",
                    data   : $('#store').serialize(),
                    dataType : 'json',
                    success: (data) => {
                       
                        $('#myModal').modal('hide');
                        $('#store')[0].reset();
                        alert('Success Insert Data...');
                        getData();
                    },
                    error : (data) => {
                        $('#myModal').modal('hide');
                        $('#store')[0].reset();
                        alert('Sorry Error System !!!');
                        getData();
                    }
                });

            });


            table.on('click', '.delete', function(){

                var id = $(this).data('id');
                if(confirm('Apakah anda yakin menghapus data ini !!!')){
                    $.get('<?= url("vehicle/delete")?>/'+id, (data) => {
                        alert('Data berhasil di hapus !!!');
                        getData();
                    });
                }
                    

            });

            table.on('click', '.edit', function(){

                var id = $(this).data('id');
                $.get('<?= url("vehicle")?>/'+id, (data) => {

                    $('#myModal #id').val(data.id);
                    $('#myModal #name').val(data.name);
                    $('#myModal').modal('show', {backdrop: 'static', keyboard: false});
                });


            });

        });
    </script>

</body>

</html>

