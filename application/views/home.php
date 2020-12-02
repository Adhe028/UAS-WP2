<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="<?= base_url("/assets/js/jquery-3.5.1.min.js")?>"></script>
    <title><?= $title ?></title>
  </head>
  <body>
    
   
  <?php $this->load->view("component/navbar.php") ?>
    <div class="container">
       
        <h1 class="text-center">Data Mobil</h1>
        <a href="#form" data-toggle="modal" class="btn btn-dark mb-3" onclick="submit('tambah')">Tambah Data</a>
        <table class="table table-striped table-bordered" >
            <thead class="bg-dark text-white">
                <tr class=" bg-secondary">
                <th class="text-center" scope="col" style="color:white;">No</th>
                    <th class="text-center" scope="col" style="color:white;">Merk</th>
                    <th class="text-center" scope="col" style="color:white;">Warna</th>
                    <th class="text-center" scope="col" style="color:white;">No. Polisi</th>
                    <th class="text-center" scope="col" style="color:white;" colspan="2">Opsi</th>
                </tr>
            </thead>
            <tbody id="targetData">
                
            </tbody>
        </table>

        <div class="modal fade" id="form" role="dialog">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header text-white bg-secondary">
                        <h1>Data Mobil</h1>
                    </div>    
                    <p id="pesan" class="text-danger text-center"></p>
                    <table class="table ">
                        <tr>
                            <td>Merk</td>
                            <td><input type="text" name="merk" placeholder="Isikan Merk" class="form-control">
                                <input type="hidden" name="id" value="">
                            </td>
                        </tr>
                        <tr>
                            <td>Warna</td>
                            <td><input type="text" name="warna" placeholder="Isikan warna" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>NO. Polisi</td>
                            <td><input type="text" name="nopol" placeholder="Isikan No. Polisi" class="form-control"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <button type="button" id="btn-tambah" onclick="tambahData()" class="btn float-right btn-primary">Simpan</button>
                                <button type="button" id="btn-ubah" onclick="ubahData()" class="btn float-right btn-primary">Simpan</button>
                                <button type="button" data-dismiss="modal" class="btn float-left btn-dark">Batal</button>
                            </td>
                        </tr>
                    </table>

                </div>
            </div>
        </div>


    </div>

    <script>
        ambilData();
        function ambilData(){
            $.ajax({
                type: 'POST',
                url: '<?= base_url()."index.php/home/ambildata"?>',
                dataType: 'json',
                success: function(data){
                    var baris='';
                    for(var i=0; i < data.length; i++){
                        baris += '<tr>'+
                                    '<td>'+(i+1)+'</td>' +
                                    '<td>'+data[i].merk+' </td>' +
                                    '<td>'+data[i].warna+'</td>' +
                                    '<td>'+data[i].nopol+'</td>' +
                                    '<td class="text-center"><a href="#form" data-toggle="modal" class="btn btn-warning" onclick="submit('+data[i].id+')">Ubah</a></td> <td class="text-center"><a onclick="hapusdata('+data[i].id+')" class="btn btn-danger">Hapus</a></td>' +
                                '</tr>';
                    }
                    $('#targetData').html(baris);
                }
            });    
        }

        function tambahData(){
            var merk=$("[name='merk']").val();
            var warna=$("[name='warna']").val();
            var nopol=$("[name='nopol']").val();

            $.ajax({
                type: 'POST',
                data: 'merk='+merk+'&warna='+warna+'&nopol='+nopol,
                url: '<?= base_url()."index.php/home/tambahdata"?>',
                dataType: 'json',
                success: function(hasil){
                    $("#pesan").html(hasil.pesan);

                    if(hasil.pesan==''){
                        $("#form").modal('hide');
                        ambilData();
                        $("[name='merk']").val('');
                        $("[name='warna']").val('');
                        $("[name='nopol']").val('');
                    }
                }
            });
        }

        function submit(x){
            if(x=='tambah'){
                $('#btn-ubah').hide();
                $('#btn-tambah').show();
                
            }else{
                $('#btn-ubah').show();
                $('#btn-tambah').hide();
         
                
                $.ajax({
                    type: 'POST',
                    data: 'id='+x,
                    url: '<?= base_url()."index.php/home/ambilId"?>',
                    dataType: 'json',
                    success: function(hasil){
                        $("[name='id']").val(hasil[0].id);
                        $("[name='merk']").val(hasil[0].merk);
                        $("[name='warna']").val(hasil[0].warna);
                        $("[name='nopol']").val(hasil[0].nopol);
                    }
                })
            }
        }

        function ubahData(){
            var id=$("[name='id']").val();
            var merk=$("[name='merk']").val();
            var warna=$("[name='warna']").val();
            var nopol=$("[name='nopol']").val();
            $.ajax({
                type: 'POST',
       
                data: 'id='+id+'&merk='+merk+'&warna='+warna+'&nopol='+nopol,
                url: '<?= base_url()."index.php/home/ubahdata"?>',
                dataType: 'json',
                success: function(hasil){
                    $("#pesan").html(hasil.pesan);

                    if(hasil.pesan==''){
                        $("#form").modal('hide');
                        ambilData();
                    }
                }
            });
        }

        function hapusdata(id){
            var tanya = confirm('Apakah Anda yakin akan menghapus data?');
            
            if(tanya){
                $.ajax({
                    type: 'POST',
                    data: 'id='+id,
                    url: '<?= base_url()."index.php/home/hapusdata"?>',
                    success: function(){
                        ambilData();
                    }
                });
            }
        }

    </script>

    <?php $this->load->view("component/footer.php") ?>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
   
  </body>
</html>