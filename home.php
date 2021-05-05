<?php
  require_once "controllerUserData.php";

  $daftarBarang = tampil("SELECT * FROM barang");
  if( isset($_POST["insertData"]) ){
    header("location: home.php");
    if(inputBarang($_POST) > 0){
        echo "<script> alert('Barang baru berhasil ditambahkan');</script>";
    } else{
        echo mysqli_error($kon);
    }
}
$username = $_SESSION['username'];
$sql = "SELECT * FROM akun WHERE username = '$username'";
$run_Sql = mysqli_query($kon, $sql);
if($run_Sql){
  $fetch_info = mysqli_fetch_assoc($run_Sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME</title>
    <link rel="stylesheet" href="css/styleHome.css">
    <script src="js/kitFontAwesome.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/ajax.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="css/sweetalert2.min.css">
    <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script> -->

    <script type="text/javascript"> 
      function display_c(){
      var refresh=1000; // Refresh rate in milli seconds
      mytime=setTimeout('display_ct()',refresh)
      }

      function display_ct() {
        var x = new Date()
        var x1=new String();
      var namahari = ("Minggu Senin Selasa Rabu Kamis Jumat Sabtu");
      namahari = namahari.split(" ");
      var namabulan = ("Januari Februari Maret April Mei Juni Juli Agustus September Oktober November Desember");
      namabulan = namabulan.split(" ");
      var tgl = new Date();
      var hari = tgl.getDay();
      var tanggal = tgl.getDate();
      var bulan = tgl.getMonth();
      var tahun = tgl.getFullYear();
      x1 = namahari[hari] + ", " +tanggal + " " + namabulan[bulan] + " " + tahun; 
      x1 = x1 + " - " +  x.getHours( )+ ":" +  x.getMinutes() + ":" +  x.getSeconds();
        document.getElementById('ct').innerHTML = x1;
        display_c();}
      </script>

    <script>
      function logoutConfirm(){
        document.querySelector(".logout").addEventListener('click', function(){
          swal({
            title : '<p style="color : white; font-size:18px; text-shadow: 2px 2px #000000;">Are you sure to Logout?</p>',
            showCancelButton : true,
            confirmButtonText : '<a href="index.php" style="text-decoration:none; color:white;">Confirm</a>',
            confirmButtonColor : "#202f8a",
            background : "linear-gradient(to right, #192888, #4151c0)",
          });
        });
      }
    </script>
</head>
<body onload=display_ct();>

<div class="modal fade" id="insertBarang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"  style="height:1000px; 
  transition: all .5s ease;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Insert Barang</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" style="color:white;">&times;</span>
        </button>
      </div>
        <form action="" method="post">
          <div class="modal-body">
              <div class="form-group">
                  <label>Merk Barang</label>
                  <input type="text" name="mBarang" class="form-control" placeholder="Masukan Merk Barang" autocomplete="off" required>
              </div>
              <div class="form-group">
                  <label>Jenis Barang </label>
                  <input type="text" name="jBarang" class="form-control" placeholder="Masukan Jenis Barang" autocomplete="off" required>
              </div>
              <div class="form-group">
                  <label>Stock Barang </label>
                  <label style="margin-left : 40px;">Satuan</label>
                  <label style="margin-left : 25px;">/</label>
                  <label style="margin-left : 32px;">QTY</label>
                  <label style="margin-left : 60px;">Satuan</label>
                  <input type="number" name="stock" class="form-control" placeholder="Stock" autocomplete="off" required style="width : 100px; position : absolute;">
                  <select name="satuan" class="form-control" required style="margin-left : 110px; height:38px; width:100px;border-radius:3px; border:none; outline:none;color: #495057; position : absolute;">
                      <option selected disabled value="">Pilih Satuan :</option>
                      <option value="Pack">Pack</option>
                      <option value="Dus">Dus</option>
                      <option value="Krat">Krat</option>
                  </select>
                  <input type="number" name="qty" class="form-control" placeholder="@" autocomplete="off" required style="margin-left : 220px; height:38px; width:100px;border-radius:3px; border:none; outline:none;color: #495057; position:absolute;">
                  <select name="satuanQty" class="form-control" required style="margin-left : 330px; height:38px; width:100px;border-radius:3px; border:none; outline:none;color: #495057;">
                      <option selected disabled value="">Pilih Satuan :</option>
                      <option value="Renceng">Renceng</option>
                      <option value="Pcs">Pcs</option>
                      <option value="KG">Kilogram</option>
                  </select>
              </div>
              <input type="hidden" name="user" value="<?php echo $fetch_info['username'] ?>">
          </div>
          <div class="modal-footer">
            <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
            <button type="submit" name="insertData" class="btn btn-primary" 
            style=" background-image: linear-gradient(to right, #192888, #213092);">
            Insert Data
            </button>
          </div>
      
      </form>
    </div>
  </div>
</div>


<div class="modal fade" id="updateBarang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"  style="height:100%; width:100%; 
  transition: all .5s ease;">
  <div class="modal-dialog">
    <div class="modal-content" style="width:700px; margin-left:-100px;">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Stock</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" style="color:white;">&times;</span>
        </button>
      </div>
        <div class="daftarBar">
          <table style="width:100%; height:100%;text-align : center; overflow: visible; line-height : 40px;">
            <tr>
              <th>ID Barang</th>
              <th>Merk Barang</th>
              <th>Jenis Barang</th>
              <th>Stock</th>
              <th>Satuan</th>
              <th>QTY</th>
              <th>Satuan</th>
            </tr>
            

            <?php
              include 'dbUpdate.php';

              $sql = "SELECT * FROM barang";
              $query = $db->prepare($sql);
              $query->execute();

            ?>
            <script>

              function activate(element){
                // alert('klik');
              }
              function updateValue(element, column, id){
                  // console.log('hey its work');
                  var value = element.innerText
                  
                  $.ajax({
                    url :'prosesUpdate.php',
                    type : 'post',
                    data:{
                      value : value,
                      column: column,
                      id : id
                    },
                    success:function(php_result){
                      console.log(php_result);
                    }
                  })
              }
              function refresh() {
                // window.location = 'http://localhost/IMK/apkGudang/home.php';
                window.location.reload();
                // window.refresh();
              }

            </script>
            
            <?php
              
              while($row = $query->fetch()){
                  $idB = ($row['id']);
                  $id = md5($row['id']);
                  $mb = $row['mBarang'];
                  $jb = $row['jBarang'];
                  $sk = $row['stock'];
                  $sn = $row['satuan'];
                  $qty = $row['qty'];
                  $snQty = $row['satuanQty'];
                ?>
                <tr>
                  <td><div><?php echo $idB;?></div></td>
                  <td><div><?php echo $mb;?></div></td>
                  <td><div><?php echo $jb;?></div></td>
                  <td><div contenteditable="true" onBlur="updateValue(this,'stock','<?php echo $id ?>')" onClick="activate(this)" style="background : none; color:white; border-bottom : 2px solid gray"><?php echo $sk;?></div></td>
                  <td><div><?php echo $sn;?></div></td>
                  <td><div><?php echo $qty;?></div></td>
                  <td><div><?php echo $snQty;?></div></td>
                </tr>
                <?php
              }
            ?>
            
          </table>
        </div>
          <div class="modal-footer" style="margin-top:20px;">

            <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
            <button type="submit" name="updateData" class="btn btn-primary" 
            style=" background-image: linear-gradient(to right, #192888, #213092);" onclick="refresh()">
            Update Data
            </button>
          </div>
      
    </div>
  </div>
</div>


<div class="modal fade" id="deleteBarang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"  style="height:100%; width:100%;
  transition: all .5s ease;">
  <div class="modal-dialog">
    <div class="modal-content" style="width:700px; margin-left:-100px;">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Barang</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" style="color:white;">&times;</span>
        </button>
      </div>
        <div class="daftarBar">
          <table style="width:100%; height:100%;text-align : center; overflow: visible; line-height : 40px;">
            <tr>
              <th>ID Barang</th>
              <th>Merk Barang</th>
              <th>Jenis Barang</th>
              <th>Stock</th>
              <th>Satuan</th>
              <th>QTY</th>
              <th>Satuan</th>
            </tr>
            <?php
              $sql = mysqli_query($kon, "SELECT * FROM barang ORDER BY id ASC");
              $no=1;

              while($data = mysqli_fetch_array($sql)){
                ?>
                <tr style="border-bottom : 1px solid white;">
                  <td><?php echo $data['id']?></td>
                  <td><?php echo $data['mBarang']?></td>
                  <td><?php echo $data['jBarang']?></td>
                  <td><?php echo $data['stock']?></td>
                  <td><?php echo $data['satuan']?></td>
                  <td><?php echo $data['qty']?></td>
                  <td><?php echo $data['satuanQty']?></td>
                  <td><a onclick="return confirm('Are you sure to Delete this Product?')" href="prosesDelete.php?Del=<?php echo $data['id']; ?>"><i class="fas fa-trash" style="font-size:25px;color:red"></i></a></td>
                </tr>
                <?php
                $no++;
              }
            ?>
          </table>

        </div>
          <div class="modal-footer">
            <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
            <button type="submit" name="deleteData" class="btn btn-primary" 
            style=" background-image: linear-gradient(to right, #192888, #213092);" onclick="refresh()">
            DONE
            </button>
          </div>
    </div>
  </div>
</div>


<div class="modal fade" id="viewBarang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"  style="height:100%; width:100%;
  transition: all .5s ease;">
  <div class="modal-dialog">
    <div class="modal-content" style="width:700px;  margin-left:-100px;">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Daftar Barang</h5>
        <div class="info">
        <div id='ct'></div>
        <div id="user"><?php echo $fetch_info['username'] ?></div>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" style="color:white;">&times;</span>
        </button>
      </div>
        <div class="daftarBar">
          <table style="width:100%; height:100%;text-align : center; overflow: visible; line-height : 40px;">
            <tr>
              <th>ID Barang</th>
              <th>Merk Barang</th>
              <th>Jenis Barang</th>
              <th>Stock</th>
              <th>Satuan</th>
              <th>QTY</th>
              <th>Satuan</th>
              <th>Keterangan</th>
            </tr>
            <?php foreach($daftarBarang as $row) : ?>
              <tr>
                <td><?= $row["id"]; ?></td>
                <td><?= $row["mBarang"]; ?></td>
                <td><?= $row["jBarang"]; ?></td>
                <td><?= $row["stock"]; ?></td>
                <td><?= $row["satuan"]; ?></td>
                <td><?= $row["qty"]; ?></td>
                <td><?= $row["satuanQty"]; ?></td>
                <td><?= $row["user"]; ?></td>
              </tr>
            <?php endforeach; ?>
          </table>

        </div>
          <div class="modal-footer">
            <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
            <button type="submit" name="insertData" class="btn btn-primary" 
              style=" background-image: linear-gradient(to right, #192888, #213092);">
            <a href="laporan.php" style="text-decoration:none; color:white;" target="_blank"><i class="fas fa-print" style="margin-right : .5em;"></i>PDF</a>
            </button>
          </div>
      
    </div>
  </div>
</div>

      <input type="checkbox" id="check">
      <label for="check">
        <i class="fas fa-bars" id="btn"></i>
        <i class="fas fa-times" id="cancel"></i>
      </label>
      <div class="sidebar">
        <header>TOKOZ1</header>
        <ul>
          <li><a href="change-password.php"><i class="fas fa-tools"></i>Change Password</a></li>
          <li><button onclick="logoutConfirm()" class="logout"><i class="fas fa-power-off"></i>Logout</button></li>
          <!-- <li><a href="#" onclick="logoutConfirm()" class="logout"><i class="fas fa-power-off"></i>Logout</a></li> -->
        </ul>
      </div>

  <div class="bodi">
        <div class="title">
          <h1>Welcome, Hello <?php echo $fetch_info['username'] ?></h1>
        </div>
        <div class="kartu">
          <div class="card1" data-toggle="modal" data-target="#insertBarang">
            <img src="img/insert.svg" alt="">
            <h2>INSERT</h2>
            <p>Pilih Kartu ini jika anda akan memasukkan barang baru di Gudang TOKOZ1</p>
          </div>
          
          <div class="card2" data-toggle="modal" data-target="#updateBarang">
            <img src="img/update.svg" alt="">
            <h2>UPDATE</h2>
            <p>Pilih Kartu ini jika anda akan memperbaharui stock di gudang TOKOZ1</p>
          </div>
          
          <div class="card3"  data-toggle="modal" data-target="#deleteBarang">
            <img src="img/delete.svg">
            <h2>DELETE</h2>
            <p>Pilih Kartu ini jika anda akan menghapus barang di gudang TOKOZ1</p>
          </div>

          <div class="card4" data-toggle="modal" data-target="#viewBarang">
            <img src="img/view.svg" alt="">
            <h2>VIEW</h2>
            <p>Pilih Kartu ini jika anda akan melihat daftar barang dan stock di gudang TOKOZ1</p>
          </div>
        </div>
  </div>

</body>
</html>