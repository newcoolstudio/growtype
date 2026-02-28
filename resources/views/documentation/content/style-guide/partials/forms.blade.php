{{-- Forms --}}
<div class="sg-section">
  <div class="sg-title">Forms</div>
  <div class="row">
    <div class="col-md-6 sg-item">
      <div class="sg-label">input[type=text] .form-control</div>
      <div class="form-group">
        <label for="input-text">Text Input</label>
        <input type="text" class="form-control" id="input-text" placeholder="Text input">
      </div>
    </div>
    <div class="col-md-6 sg-item">
      <div class="sg-label">input[type=email] .form-control</div>
      <div class="form-group">
        <label for="input-email">Email Address</label>
        <input type="email" class="form-control" id="input-email" placeholder="Email input">
      </div>
    </div>
    <div class="col-md-6 sg-item">
      <div class="sg-label">input[type=password] .form-control</div>
      <div class="form-group">
        <label for="input-password">Password</label>
        <input type="password" class="form-control" id="input-password" placeholder="Password input">
      </div>
    </div>
    <div class="col-md-6 sg-item">
      <div class="sg-label">select .form-control (Chosen)</div>
      <div class="form-group">
        <label for="input-select">Select Option</label>
        <select class="form-control" id="input-select" data-placeholder="Choose an option...">
          <option value=""></option>
          <option>Option 1</option>
          <option>Option 2</option>
          <option>Option 3</option>
        </select>
      </div>
    </div>
    <div class="col-md-12 sg-item">
      <div class="sg-label">textarea .form-control</div>
      <div class="form-group">
        <label for="input-textarea">Message</label>
        <textarea class="form-control" id="input-textarea" rows="3" placeholder="Textarea"></textarea>
      </div>
    </div>
    <div class="col-md-6 sg-item">
      <div class="sg-label">.form-check (checkbox)</div>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" id="check1">
        <label class="form-check-label" for="check1">Default checkbox</label>
      </div>
    </div>
    <div class="col-md-6 sg-item">
      <div class="sg-label">.form-check (radio)</div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="radio1" id="radio1">
        <label class="form-check-label" for="radio1">Radio option</label>
      </div>
    </div>
    <div class="col-md-6 sg-item">
      <div class="sg-label">input[type=submit]</div>
      <input type="submit" value="Submit Button">
    </div>
  </div>
</div>
