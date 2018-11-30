<div class="modal" tabindex="-1" role="dialog" id="reset">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Reset Confirmation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>{{ $info }}</p>
        <p>Are you sure want to do this?</p>
      </div>
      <div class="modal-footer">
        <button type="button" id="delete-btn" class="btn btn-warning" id="delete-btn">Reset</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
