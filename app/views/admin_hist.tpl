    <div class="inner cover embeded-responsive">
            You are logged in as: [::name::]<br>
            <div class="admin-actions">
                <a href="notes/new" class="btn btn-default">New Entry</a>
                <a href="notes/log" class="btn btn-default"><span class="glyphicon glyphicon-search"></span> View Full Log</a>
                [::admin::]
                <a href="Logoff.do" class="btn btn-default">Logoff</a>
            </div>
            <h1 class="cover-heading">Login History</h1>
            [::errors::][::messages::]
            <h4 class="modal-title">User: [::muser::]</h4>
            <a href="javascript:history.back()">Back</a>
            <div class="table-responsive">
            	[::history::]
            </div>
            <a href="javascript:history.back()">Back</a>
          </div>