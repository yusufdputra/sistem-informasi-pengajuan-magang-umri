

<?php $__env->startSection('content'); ?>

<div class="row">
  <div class="col-12">
    <div class="card-box table-responsive">

      <?php if(\Session::has('alert')): ?>
      <div class="alert alert-danger">
        <div><?php echo e(Session::get('alert')); ?></div>
      </div>
      <?php endif; ?>

      <?php if(\Session::has('success')): ?>
      <div class="alert alert-success">
        <div><?php echo e(Session::get('success')); ?></div>
      </div>
      <?php endif; ?>


      <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th>No</th>
            <th>
              NIM
            </th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Kelas</th>
            <th>Prodi</th>
            <th>Nomor HP</th>
            <th>Status Magang</th>
          </tr>
        </thead>

        <tbody>

          <?php $__currentLoopData = $magang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

          <tr>
            <td><?php echo e($key+1); ?></td>
            <td><?php echo e($value->mhs->user->nomor_induk); ?></td>
            <td><?php echo e($value->mhs->nama); ?></td>
            <td><?php echo e($value->mhs->alamat); ?></td>
            <td>Reguler <?php echo e(strtoupper($value->mhs->kelas)); ?></td>

            <td><?php echo e(strtoupper($value->mhs->prodi->nama)); ?></td>
            <td><?php echo e($value->mhs->nomor_hp); ?></td>
            <td>
              <?php
              $status = $value->status_pengajuan;
              ?>

              <?php if($status == 'proses'): ?>
              <span class="badge badge-info"><?php echo e(strtoupper($status)); ?></span>
              <?php elseif($status == 'ditolak'): ?>
              <span class="badge badge-warning"><?php echo e(strtoupper($status)); ?></span>
              <?php elseif($status == 'diterima'): ?>
              <span class="badge badge-primary"><?php echo e(strtoupper($status)); ?></span>
              <?php elseif($status == 'selesai'): ?>
              <span class="badge badge-success"><?php echo e(strtoupper($status)); ?></span>
              <?php elseif($status == 'gagal'): ?>
              <span class="badge badge-danger"><?php echo e(strtoupper($status)); ?></span>
              <?php endif; ?>
            </td>

          </tr>

          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </tbody>
      </table>
    </div>
  </div>
</div>
<!-- end row -->


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\SIMA UP2KT\resources\views/dekan/mahasiswa/index.blade.php ENDPATH**/ ?>