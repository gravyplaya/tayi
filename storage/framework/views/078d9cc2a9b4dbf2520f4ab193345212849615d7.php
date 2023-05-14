


<?php $__env->startSection('content'); ?>

<style>
	#example2_filter {
  float: right;
  margin-bottom: 10px;
}
</style>
<?php ($currency=\App\Models\Setting::where('name','currency_symbol')->first()->value); ?>
				<div class="card">
                      <div class="card-header">
                                 <h6 class="mb-0 text-uppercase">Words Top-Up Plans List</h6>
                            </div>
					<div class="card-body">
						 <?php if(session()->has('success')): ?>
                        <div class="alert alert-success">
                        <?php if(is_array(session()->get('success'))): ?>
                                <ul>
                                    <?php $__currentLoopData = session()->get('success'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($message); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                                <?php else: ?>
                                    <?php echo e(session()->get('success')); ?>

                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                         <?php if(count($errors) > 0): ?>
                          <?php if($errors->any()): ?>
                            <div class="alert alert-danger" role="alert">
                              <?php echo e($errors->first()); ?>

                              
                            </div>
                          <?php endif; ?>
                        <?php endif; ?>
						<div class="table-responsive">
							<table id="example2" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>#</th>
										<th>words</th>
										<th>Price($currency)</th>
										 <th>Actions</th>
									</tr>
								</thead>
								<tbody>
									<?php $i=1; ?>
									<?php $__currentLoopData = $plan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<tr>
										<td><?php echo e($i); ?></td>
										<td><?php echo e($cat->tokens); ?></td>
										<td><?php echo e($cat->price); ?></td>	
										<td><div class="col">
										<div class="dropdown">
											<button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Actions</button>
											<ul class="dropdown-menu">
												<li><a class="dropdown-item" href="<?php echo e(route('admin.plan.edit',$cat->id)); ?>">Edit</a>
												</li>
												<li><a class="dropdown-item" href="<?php echo e(route('admin.plan.delete',$cat->id)); ?>">Delete</a>
												</li>
												
											</ul>
										</div>
									</div></td>
									</tr>
									<?php $i++; ?>
									 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</tbody>
								<tfoot>
									
								</tfoot>
							</table>
						</div>
					</div>
				</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tayiwithoutinstaller\resources\views/admin/plan/list.blade.php ENDPATH**/ ?>