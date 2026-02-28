{{-- Alerts --}}
<div class="sg-section">
  <div class="sg-title">Alerts</div>
  <div class="sg-item"><div class="sg-label">.alert .alert-success</div><div class="alert alert-success">Success Alert</div></div>
  <div class="sg-item"><div class="sg-label">.alert .alert-info</div><div class="alert alert-info">Info Alert</div></div>
  <div class="sg-item"><div class="sg-label">.alert .alert-warning</div><div class="alert alert-warning">Warning Alert</div></div>
  <div class="sg-item"><div class="sg-label">.alert .alert-danger</div><div class="alert alert-danger">Danger Alert</div></div>
  <div class="sg-item">
    <div class="sg-label">.alert .alert-info .alert-dismissible (Standard Bootstrap)</div>
    <div class="alert alert-info alert-dismissible fade show" role="alert">
      This is a standard <strong>dismissible alert</strong>.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  </div>
</div>

<script>
  document.querySelectorAll('.alert-dismissible [data-bs-dismiss="alert"]').forEach(function(btn) {
    btn.addEventListener('click', function() {
      this.closest('.alert').remove();
    });
  });
</script>
