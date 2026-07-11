<!-- Tombol -->
<button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambahuserModal">
  <i class="bi bi-plus-circle"></i> Tambah user
</button>

<!-- Modal -->
<div class="modal fade" id="tambahuserModal" tabindex="-1" aria-labelledby="tambahuserLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content border-0 shadow-lg rounded-4">
      <div class="modal-header bg-primary text-white rounded-top-4">
        <h5 class="modal-title fw-bold" id="tambahuserLabel"><i class="bi bi-box-seam"></i> Tambah Data user</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="<?= base_url('admin/users/simpan') ?>" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="row g-3">
            <div class="col-md-6">
              <label for="name" class="form-label">Nama</label>
              <input type="text" class="form-control rounded-pill shadow-sm" id="name" name="name"
                placeholder="Masukkan name user" required>
            </div>
        
            <div class="col-md-6">
              <label for="nik" class="form-label">NIK</label>
              <input type="text" class="form-control rounded-pill shadow-sm" id="nik" name="nik"
                placeholder="Masukkan nik user" required>
            </div>
            <div class="col-md-6">
              <label for="no_telp" class="form-label">No Telp</label>
              <input type="text" class="form-control rounded-pill shadow-sm" id="no_telp" name="no_telp"
                placeholder="" required>
            </div>
            <div class="col-md-6">
              <label for="password" class="form-label">Password</label>
              <input type="text" class="form-control rounded-pill shadow-sm" id="password" name="password"
                placeholder="" required>
            </div>
            <div class="form-group">
                <label for="role">Status</label>
                <select name="role" class="form-control" id="role" required>
                    <option value="">Pilih Status</option>
                    <option value="admin">Admin</option>
                    <option value="user">user</option>
                </select>
            </div>
            <div class="col-md-6">
              <label for="photo" class="form-label">photo</label>
              <input type="file" class="form-control shadow-sm" id="photo" name="photo" accept="image/*" enctype="multipart/form-data">
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="reset" class="btn btn-light rounded-pill px-4">Reset</button>
          <button type="submit" class="btn btn-primary rounded-pill px-4">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Table Modern -->
<div class="card shadow-sm border-0 rounded-4">
  <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
    <h5 class="mb-0 text-primary fw-bold"><i class="bi bi-table"></i> Data user</h5>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-hover align-middle mb-0">
        <thead class="table-light">
          <tr>
            <th>No</th>
            <th>Nama </th>
            <th>Password</th>
            <th>Nik</th>
            <th>No telp</th>
            <th>Role</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
                <?php $no = 1; foreach ($user as $aa) : ?>
                <tr>
                    <td style="font-size: 14px;"><?= $no++ ?></td>
                    <td style="font-size: 14px;"><?= $aa['name'] ?></td>
                    <td style="font-size: 14px;"><?= $aa['password'] ?></td>
                    <td style="font-size: 14px;"><?= $aa['nik'] ?></td>
                    <td style="font-size: 14px;"><?= $aa['no_telp'] ?></td>
                    <!-- <td style="font-size: 14px;"><?= $aa['role'] ?></td> -->
                    <td style="font-size: 14px; text-align: center;">
                        <?= ($aa['role'] == 'admin') ? 'admin' : 'user' ?>
                    </td>
                   
                    <td>
                        <a href="javascript:void(0)" onclick="konfirmasiHapus('<?= site_url('admin/users/delete_data/' . $aa['id_user']); ?>')" class="btn btn-sm btn-outline-danger rounded-pill">
                            <i class="bi bi-trash"></i> Hapus
                        </a>
                        <a href="<?= site_url('admin/users/edit/' . $aa['id_user']); ?>" class="btn btn-sm btn-outline-primary rounded-pill">
                            <i class="bi bi-pencil"></i> Edit
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Custom Style -->
<style>
  .modal-content {
    border-radius: 15px;
  }

  .form-control {
    font-size: 14px;
    padding: 10px 15px;
  }

  .table thead th {
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 0.05rem;
  }

  .table tbody td {
    font-size: 14px;
  }

  .btn {
    font-size: 13px;
  }
</style>


<!-- Tambahkan ini sebelum penutup </body> -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<!-- Script konfirmasi hapus -->
<script>
    function konfirmasiHapus(url) {
        Swal.fire({
            title: 'Yakin hapus data?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    }
</script>
