<div class="wrapper">
          <!-- .page -->
          <div class="page">
            <!-- .page-inner -->
            <div class="page-inner">
              <!-- .page-title-bar -->
              <header class="page-title-bar">
                <p class="lead">
                  <span class="font-weight-bold">Hi, {{ strtoupper(Auth('degAdmin')->user()->username) }}.</span>
                  <span class="d-block text-muted">Welcome to Degree Admin Users dashboard. Here’s what’s happening with your business today.</span>
                </p>
              </header>