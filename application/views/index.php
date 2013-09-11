<div class="content">
  <h2>Welcome Back, <?php echo $this->session->userdata('username'); ?>!</h2>
  <p>This section represents the area that only logged in members can access.</p>
  <h4><?php echo anchor('index/logout', 'Logout'); ?></h4>
  <p>DEGUB: <?php echo 'id: ' . $data['user']['id'] . ' | username: ' . $data['user']['username'] . ' | password: ' . $data['user']['password'];?></p>
</div><!--<div class="content">-->