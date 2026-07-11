<div class="container mt-5">
    <div class="card shadow-lg rounded-3 border-0">
        <div class="card-body p-4">
            <h4 class="mb-4 text-primary">Edit User</h4>
            <form method="post" action="<?= site_url('admin/users/update'); ?>" enctype="multipart/form-data">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label" style="font-size: 19px;">Name</label>
                        <input type="text" name="name" class="form-control" value="<?= $user->name; ?>" required>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label" style="font-size: 19px;">Password (Kosongkan jika tidak diganti)</label>
                    <input type="password" name="password" class="form-control">
                </div>
                
                <div class="mb-3">
                    <label class="form-label" style="font-size: 19px;">Nik</label>
                    <input type="text" name="nik" class="form-control" value="<?= $user->nik; ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label" style="font-size: 19px;">No Telp</label>
                    <input type="text" name="no_telp" class="form-control" value="<?= $user->no_telp; ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label" style="font-size: 19px;">Status</label>
                    <select name="role" class="form-select">
                        <option value="1" <?= ($user->role == '1') ? 'selected' : ''; ?>>Admin</option>
                        <option value="2" <?= ($user->role == '2') ? 'selected' : ''; ?>>User</option>
                    </select>
                </div>

            

                <input type="hidden" name="id_user" value="<?= $user->id_user; ?>">

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary px-4">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
