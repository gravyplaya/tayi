<div class="card">
	<div class="card-header">
	<div class="card-title" style="color:red;font-weight:500;">Tokens Limit Reached</div>
		</div>
	<div class="card-body" id="text">
		<p class="btn btn-outline-danger">Your plan has been Expired on {{ date('d-M-Y', strtotime($html->plan_end)) }}, Please Upgrade your plan.</p>
        <a class="btn btn-primary rounded shadow-sm btn-sm flex" data-bs-toggle="modal" data-bs-target="#upgradeplan" align="center">Upgrade plan </a>
      
	</div>
</div>