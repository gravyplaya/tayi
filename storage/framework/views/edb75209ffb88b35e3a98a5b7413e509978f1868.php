


<?php $__env->startSection('content'); ?>


<?php 
       $storage= \DB::table('image_spaces')
                    ->first();

        if($storage->aws == 1){
            $storage_space = "s3.aws";
        }
        else if($storage->wasabi == 1){
            $storage_space = "s3.wasabi";
        }else{
            $storage_space ="same_server";
        }

         if($storage_space != "same_server"){
           $url_aws =  rtrim(\Storage::disk($storage_space)->url('/'));
        }          
        else{
            $url_aws=url('/storage/app/public/').'/';
        } 
       
    ?>
<style>
	#example2_filter {
  float: right;
  margin-bottom: 10px;
}
</style>
 <?php ($currency_symbol=\App\Models\Setting::where('name','currency_symbol')->first()->value); ?>
 <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
          <div>
            <h4 class="mb-3 mb-md-0">Welcome to Dashboard</h4>
          </div>
         
        </div>
       
       <div class="row">
          <div class="col-12 col-xl-12 stretch-card">
            <div class="row flex-grow-1">
              <div class="col-md-3 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline">
						<h6 class="card-title mb-0"><b>New Customers</b> <br><span class="text-secondary">(<?php echo e(__('Current Month')); ?>)</span></h6>
                     
                    </div>
                    <div class="row">
                      <div class="col-6 col-md-12 col-xl-5">
                        <h3 class="mb-2"><?php echo e(number_format($total_data_monthly['new_users_current_month'])); ?></h3>
                        <div class="d-flex align-items-baseline">
                          
                        </div>
                      </div>
                     <!--  <div class="col-6 col-md-12 col-xl-7">
                        <div id="customersChart" class="mt-md-3 mt-xl-0"></div>
                      </div> -->
                      <div class="card-footer"><p class="text-secondary">
                            <span><?php echo e(number_format($total_data_monthly['new_users_past_month'])); ?> last Month</span>
                            
                          </p></div> 
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-3 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline">
                      <h6 class="card-title mb-0"><b>Paid Customers</b> <br> <span class="text-secondary">(<?php echo e(__('Current Month')); ?>)</span></h6>
                     
                    </div>
                    <div class="row">
                      <div class="col-6 col-md-12 col-xl-5">
                        <h3 class="mb-2"><?php echo e(number_format($total_data_monthly['new_subscribers_current_month'])); ?></h3>
                        <div class="d-flex align-items-baseline">
                          
                        </div>
                      </div>
                      <!-- <div class="col-6 col-md-12 col-xl-7">
                        <div id="customersChart" class="mt-md-3 mt-xl-0"></div>
                      </div> -->
                      <div class="card-footer"><p class="text-secondary">
                            <span><?php echo e(number_format($total_data_monthly['new_subscribers_past_month'])); ?> last Month</span>
                            
                          </p></div> 
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-3 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline">
                      <h6 class="card-title mb-0"><b>Total Income </b> <br><span class="text-secondary">(<?php echo e(__('Current Month')); ?>)</span></h6>
                     
                    </div>
                    <div class="row">
                      <div class="col-6 col-md-12 col-xl-5">
                        <h3 class="mb-2"><?php echo $currency_symbol; ?> <?php echo e(number_format((int)$total_data_monthly['income_current_month'][0]['data'], 0)); ?></h3>
                        <div class="d-flex align-items-baseline">
                          
                        </div>
                      </div>
                      <!-- <div class="col-6 col-md-12 col-xl-7">
                        <div id="customersChart" class="mt-md-3 mt-xl-0"></div>
                      </div> -->
                      <div class="card-footer"><p class="text-secondary">
                            <span><?php echo $currency_symbol; ?> <?php echo e(number_format((int)$total_data_monthly['income_past_month'][0]['data'], 0)); ?> last Month</span>
                            
                          </p></div> 
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-3 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline">
                      <h6 class="card-title mb-0"><b>Total Estimated Spending </b> <br><span class="text-secondary">(<?php echo e(__('Current Month')); ?>)</span></h6>
                     
                    </div>
                    <div class="row">
                      <div class="col-6 col-md-12 col-xl-5">
                        <h3 class="mb-2">$<?php echo e(number_format((int)$total_data_monthly['spending_current_month'], 0, '.', '')); ?></h3>
                        <div class="d-flex align-items-baseline">
                          
                        </div>
                      </div>
                    <!--   <div class="col-6 col-md-12 col-xl-7">
                        <div id="customersChart" class="mt-md-3 mt-xl-0"></div>
                      </div> -->
                      <div class="card-footer"><p class="text-secondary">
                            <span><?php echo e(number_format((int)$total_data_monthly['spending_past_month'], 0, '.', '')); ?> last Month</span>
                            
                          </p></div> 
                    </div>
                  </div>
                </div>
              </div>
             
             
            
            </div>
          </div>
        </div> <!-- row -->


        <div class="row">
          <div class="col-12 col-xl-12 stretch-card">
            <div class="row flex-grow-1">
              <div class="col-md-3 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline">
                      <h6 class="card-title mb-0"><b>Total Words Generated </b> <br><span class="text-secondary">(<?php echo e(__('Current Month')); ?>)</span></h6>
                     
                    </div>
                    <div class="row">
                      <div class="col-6 col-md-12 col-xl-5">
                        <?php
                        $precision=1;
                      $n=$total_data_monthly['total_words_current_month'];
                       if ($n < 900) {
                        // 0 - 900
                        $n_format = number_format($n, $precision);
                        $suffix = '';
                    } else if ($n < 900000) {
                        // 0.9k-850k
                        $n_format = number_format($n / 1000, $precision);
                        $suffix = 'K';
                    } else if ($n < 900000000) {
                        // 0.9m-850m
                        $n_format = number_format($n / 1000000, $precision);
                        $suffix = 'M';
                    } else if ($n < 900000000000) {
                        // 0.9b-850b
                        $n_format = number_format($n / 1000000000, $precision);
                        $suffix = 'B';
                    } else {
                        // 0.9t+
                        $n_format = number_format($n / 1000000000000, $precision);
                        $suffix = 'T';
                    }
                  
                    if ( $precision > 0 ) {
                        $dotzero = '.' . str_repeat( '0', $precision );
                        $n_format = str_replace( $dotzero, '', $n_format );
                    }
                  $numberr=$n_format . $suffix;
                  ?>
                        <h3 class="mb-2"><?php echo e($numberr); ?></h3>
                        <div class="d-flex align-items-baseline">
                          
                        </div>
                      </div>
                     <!--  <div class="col-6 col-md-12 col-xl-7">
                        <div id="customersChart" class="mt-md-3 mt-xl-0"></div>
                      </div> -->
                      <div class="card-footer"><p class="text-secondary">
                            <span><?php echo e(number_format($total_data_monthly['total_words_past_month'])); ?> last Month</span>
                            
                          </p></div> 
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-3 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline">
                      <h6 class="card-title mb-0"><b>Total Images </b> <br><span class="text-secondary">(<?php echo e(__('Current Month')); ?>)</span></h6>
                     
                    </div>
                    <div class="row">
                      <div class="col-6 col-md-12 col-xl-5">
                        <h3 class="mb-2"><?php echo e($total_data_monthly['images_current_month']); ?></h3>
                        <div class="d-flex align-items-baseline">
                          
                        </div>
                      </div>
                      <!-- <div class="col-6 col-md-12 col-xl-7">
                        <div id="customersChart" class="mt-md-3 mt-xl-0"></div>
                      </div> -->
                      <div class="card-footer"><p class="text-secondary">
                            <span><?php echo e($total_data_monthly['images_past_month']); ?> last Month</span>
                            
                          </p></div> 
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-3 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline">
                      <h6 class="card-title mb-0"><b>Total Folders </b> <br><span class="text-secondary">(<?php echo e(__('Current Month')); ?>)</span></h6>
                     
                    </div>
                    <div class="row">
                      <div class="col-6 col-md-12 col-xl-5">
                        <h3 class="mb-2"><?php echo e($total_data_monthly['total_folders_current_month']); ?></h3>
                        <div class="d-flex align-items-baseline">
                          
                        </div>
                      </div>
                      <!-- <div class="col-6 col-md-12 col-xl-7">
                        <div id="customersChart" class="mt-md-3 mt-xl-0"></div>
                      </div> -->
                      <div class="card-footer"><p class="text-secondary">
                            <span><?php echo e($total_data_monthly['total_folders_past_month']); ?> last Month</span>
                            
                          </p></div> 
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-3 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline">
                      <h6 class="card-title mb-0"><b>Total Projects </b> <br><span class="text-secondary">(<?php echo e(__('Current Month')); ?>)</span>       </h6>
                     
                    </div>
                    <div class="row">
                      <div class="col-6 col-md-12 col-xl-5">
                        <h3 class="mb-2"><?php echo e($total_data_monthly['total_projects_current_month']); ?></h3>
                        <div class="d-flex align-items-baseline">
                          
                        </div>
                      </div>
                    <!--   <div class="col-6 col-md-12 col-xl-7">
                        <div id="customersChart" class="mt-md-3 mt-xl-0"></div>
                      </div> -->
                      <div class="card-footer"><p class="text-secondary">
                            <span><?php echo e($total_data_monthly['total_projects_past_month']); ?> last Month</span>
                            
                          </p></div> 
                    </div>
                  </div>
                </div>
              </div>
             
             
            
            </div>
          </div>
        </div> <!-- row -->

        <div class="row">
          <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12 col-xl-6 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline mb-2">
                  <h6 class="card-title mb-0">Daily Users</h6>
                  
                </div>
                <p class="text-muted">Last 7 days</p>
                <div id="chart-new-clients"></div>
              </div> 
            </div>
          </div>
           <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12 col-xl-6 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline mb-2">
                  <h6 class="card-title mb-0">Daily Sales</h6>
                  <div class="dropdown mb-2">
                    <a type="button" id="dropdownMenuButton4" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                    </a>
                   
                  </div>
                </div>
                <p class="text-muted">Last 7 days</p>
                <div id="chart-new-trans"></div>
              </div> 
            </div>
          </div>
        </div> <!-- row -->

        <div class="row">
          <div class="col-lg-5 col-xl-4 grid-margin grid-margin-xl-0 stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline mb-2">
                  <h6 class="card-title mb-0">Latest Users</h6>
                  
                </div>
                 <?php ($userss=\App\Models\User::limit(8)->orderBy('id','desc')->get()); ?>
                <div class="d-flex flex-column">
                  <?php $__currentLoopData = $userss; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="me-3">
                      <img src="<?php echo e($url_aws); ?>user/<?php echo e($usse->image); ?>" style="width:40px;height:40px;" class="rounded-circle wd-35" alt="user">
                      <div class="w-100">
                      <div class="d-flex justify-content-between">
                        <h6 class="text-body mb-2"><?php echo e($usse->name); ?></h6>
                        <p class="text-muted tx-12"><?php echo e(date('d-M-Y', strtotime($usse->created_at))); ?></p>
                      </div>
                      <p class="text-muted tx-13"><?php echo e($usse->email); ?></p>
                    </div>
                    </div>
                    <hr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                 
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-7 col-xl-8 stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline mb-2">
                  <h6 class="card-title mb-0">Recent Projects</h6>
                  
                </div>
                <?php ($projects=\App\Models\Project::limit(10)->orderBy('id','desc')->get()); ?>
                <div class="table-responsive">
                <table  class="table table-hover mb-0">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Project Name</th>
                    <th>Folder Name</th>
                    <th>Created By</th>
                    <th>Created On</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i=1; ?>
                  <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td><?php echo e($i); ?></td>
                    <td><?php echo e($cat->project_id); ?></td>
                    <td><?php if($cat->related_folder != NULL): ?><?php echo e($cat->related_folder->name); ?><?php else: ?> <span style="color:red">Folder Not Available </span><?php endif; ?></td>
                    <td><?php if($cat->user != NULL): ?><?php echo e($cat->user->name); ?><?php else: ?> <span style="color:red">User Deleted </span><?php endif; ?></td>
                    <td><?php echo e(date('d-M-Y', strtotime($cat->created_at))); ?></td> 
                    <td><a class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#viewproject<?php echo e($cat->id); ?>">View Project</a>

                      </td>
                  </tr>
                  <?php $i++; ?>
                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
                
              </table>
                </div>
              </div> 
            </div>
          </div>
        </div> 
        <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
         <!-- Modal -->
            <div class="modal fade" id="viewproject<?php echo e($cat->id); ?>" tabindex="-1" aria-labelledby="viewprojectLabel<?php echo e($cat->id); ?>" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="viewprojectLabel<?php echo e($cat->id); ?>">Project (<?php echo e($cat->project_id); ?>)</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                  </div>
              
                  <div class="modal-body">
                    
                       <div class="form-group">
                         <label id="folderLabel">Saved Text</label>
                         
                          <textarea class="form-control" rows="15" disabled readonly><?php echo $cat->project_text; ?></textarea>
                        
                       </div>
                        <br>

                    
                      
                    
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  </div>
                
                
                </div>
              </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



 <script>
      // @formatter:off
      document.addEventListener("DOMContentLoaded", function () {
        window.ApexCharts && (new ApexCharts(document.getElementById('chart-new-clients'), {
            chart: {
                type: "bar",
                fontFamily: 'inherit',
                 height: '318',
                  
                sparkline: {
                    enabled: true
                },
                animations: {
                    enabled: false
                },
            },
            fill: {
                opacity: 1,
            },
            stroke: {
                width: [2, 1],
                dashArray: [0, 3],
                lineCap: "round",
                curve: "smooth",
            },
            series: [{
                name: "this day",
                data: <?php echo json_encode($ncgv, 15, 512) ?>
            }],
            grid: {
                strokeDashArray: 4,
            },
            xaxis: {
                labels: {
                    padding: 0,
                },
                tooltip: {
                    enabled: false
                }
            },
            yaxis: {
                labels: {
                    padding: 4
                },
            },
            labels:<?php echo json_encode($ncgd, 15, 512) ?>,
            colors: ["#206bc4", "#a8aeb7"],
            legend: {
                show: false,
            },
        })).render();
      });
      // @formatter:on
    </script>

  <script>
      // @formatter:off
      document.addEventListener("DOMContentLoaded", function () {
        window.ApexCharts && (new ApexCharts(document.getElementById('chart-new-trans'), {
            chart: {
                type: "bar",
                fontFamily: 'inherit',
                 height: '318',
                  
                sparkline: {
                    enabled: true
                },
                animations: {
                    enabled: false
                },
            },
            fill: {
                opacity: 1,
            },
            stroke: {
                width: [2, 1],
                dashArray: [0, 3],
                lineCap: "round",
                curve: "smooth",
            },
            series: [{
                name: "this day",
                data: <?php echo json_encode($ncgt, 15, 512) ?>
            }],
            grid: {
                strokeDashArray: 4,
            },
            xaxis: {
                labels: {
                    padding: 0,
                },
                tooltip: {
                    enabled: false
                }
            },
            yaxis: {
                labels: {
                    padding: 4
                },
            },
            labels:<?php echo json_encode($ncgd, 15, 512) ?>,
            colors: ["#ff5e00", "#a8aeb7"],
            legend: {
                show: false,
            },
        })).render();
      });
      // @formatter:on
    </script>
  
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tayiwithoutinstaller\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>