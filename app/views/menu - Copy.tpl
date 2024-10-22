            <div class="dontprint h5">You are logged in as: [::name::]<br></div>
            <div class="dontprint"> <span [::fullIn::]>
                <a href="newentry" class="btn btn-default"><i class="fas fa-plus"></i> New Entry</a>
      <div class="btn-group">
        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false"><i class="far fa-clock"></i> Log View <span class="caret"></span></button>

        <ul class="dropdown-menu">
          <li>
            <a onclick="[::ltype::]log(1)" class="btn btn-default">Last 24 Hours</a>
          </li>

          <li>
            <a onclick="[::ltype::]log(3)" class="btn btn-default">Last 3 Days</a>
          </li>

          <li>
            <a onclick="[::ltype::]log(7)" class="btn btn-default">Last 7 Days</a>
          </li>
          <li>
            <a onclick="[::ltype::]log(14)" class="btn btn-default">Last 14 Days</a>
          </li>
          <li>
            <a onclick="[::ltype::]log(21)" class="btn btn-default">Last 21 Days</a>
          </li>
          <li>
            <a onclick="[::ltype::]log(30)" class="btn btn-default">Last 30 Days</a>
          </li>

          <li>
            <a onclick="[::ltype::]log(60)" class="btn btn-default">Last 60 Days</a>
          </li>

          <li>
            <a onclick="[::ltype::]log(90)" class="btn btn-default">Last 90 Days</a>
          </li>
          [::flog::]
        </ul> </div>

      [::print::][::admin::] <a href="/search" class="btn btn-default"><i class="fas fa-search"></i>Search</a></span> <a href="Logoff.do" class="btn btn-default"><i class="fas fa-sign-out-alt"></i>Log Off</a> [::policy::]
            </div>
             [::errors::]
             [::messages::]
