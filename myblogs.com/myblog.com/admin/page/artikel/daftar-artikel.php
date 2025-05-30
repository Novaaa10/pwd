<h2 class="mt-4 mb-4"><i class="fas fa-newspaper"></i>Daftar Artikel</h2>

<div class="row">
    <div class="col">
        <div class="mb-2">
            <a href="#" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i>Tambah Artikel</a>
        </div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>TANGGAL</th>
                    <th>JUDUL</th>
                    <th>PENULIS</th>
                    <th>DESKRIPSI</th>
                    <th>POSTING</th>
                    <th>AKSI</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    require_once('../model/Artikel.php');
                    $artikel = new Artikel();
                    $artikels = $artikel->getAll();
                    $nomor = 1;

                    foreach($artikels as $row){
                    ?>
                        <tr>
                            <td><?=$nomor++;?></td>
                            <td><?=$row['tanggal'];?></td>
                            <td><?=$row['penulis'];?></td>
                            <td><?=$row['judul'];?></td>
                            <td><?=$row['deskripsi'];?></td>
                            <td><?=$row['posting'];?></td>
                            <td class="text-center">
                                <a href="#" data-toggle="tooltip" data-placement="top" title="detail"><i class="fa fa-eye text-succes"></i></a>
                                <a href="#" data-toggle="tooltip" data-placement="top" title="edit"><i class="fa fa-edit text-warning"></i></a>
                                <a href="#" data-toggle="tooltip" data-placement="top" title="hapus"><i class="fa fa-trash text-danger"></i></a>
                            </td>
                        </tr>
                    <?php    
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>