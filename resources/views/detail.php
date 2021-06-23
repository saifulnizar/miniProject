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
                    <h1 class="h3 mb-2 text-gray-800">Detail <?= $vehicle->name; ?></h1>
                    <p class="mb-4">Table Replacement of spare parts.</p>

                    
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <!-- <h6 class="m-0 font-weight-bold text-primary">Data</h6> -->
                            <button href="#" class="btn btn-success  btn-icon-split"
                                style='float: right !important;'
                                data-toggle="modal" data-target="#myModal"
                            >
                                <span class="icon text-white-50">
                                    <i class="fas fa-plus"></i>
                                </span>
                                <span class="text">Add New Sparepart</span>
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name Sparepart</th>
                                            <th>Totals Stok</th>
                                            <th>Date</th>
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

    <?php include('layout/js.php'); ?>

    <script type="text/javascript">
        $(document).ready(function() {
            
            const getData = () => {

                $.get('<?= url('history/getData')?>/'+'<?= $vehicle->id;?>', function(data){

                    var html = '';
                    var no  = 1;
                        data.forEach((row) => {
                            
                            html +='<tr>'+
                                        '<td>'+no+'</td>'+
                                        '<td>'+row.name+'</td>'+
                                        '<td>'+row.stok+'</td>'+
                                        '<td>'+row.tgl+'</td>'+
                                        '<td>'+
                                            '<a href="#" data-id="'+row.id+'" class="btn btn-danger btn-sm btn-icon-split delete mr-2"><span class="icon text-white-50"><i class="fas fa-trash"></i></span><span class="text">Hapus</span></a>'+
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


            $('#store').submit((e) => {

                e.preventDefault();
                $.ajax({
                    method : "POST",
                    url    : "<?= url('history') ?>",
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
                    $.get('<?= url("history/delete")?>/'+id, (data) => {
                        alert('Data berhasil di hapus !!!');
                        getData();
                    });
                }
                    

            });

       

            $('select').on('change', function() {
                var id = this.value;

                if(id != ' ') {
                    $.get('<?= url("sparepart") ?>/'+id, (data) => {
                        
                        var input = '<label>Total Stok</label><input type="number" class="form-control form-control-user" name="stok" id="stok" min="1" max="'+data.stok+'" required>';

                        $('#inputNumber').html(input)
                    });
                }
            })

        });
    </script>

</body>

</html>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Maintenance</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="store">
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="id_vehicle" id="id_vehicle" value="<?= $vehicle->id ?>">
                    <div class="form-group">
                        <label>Name Sparepart</label>
                        <select class="form-control form-control-user" name="id_sparepart" id="id_sparepart" required>
                            <option value="">Choice One</option>

                            <?php foreach($sparepart as $value): ?>
                                <option value="<?= $value->id; ?>">
                                    <?= ucwords($value->name); ?>
                                </option>
                            <?php endforeach; ?>

                        </select>

                        <div class="form-group" id="inputNumber">
                            
                        </div>

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