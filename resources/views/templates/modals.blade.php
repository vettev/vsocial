        <div class="modal fade" tabindex="-1" role="dialog" id="edit-modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit post</h4>
                  </div>
                  <form method="post" action="#" id="post-edit-form">
                    <div class="modal-body">
                      <div class="form-group">
                        <label for="post-edit-input">Post content</label>
                        <textarea name="content" id="post-edit-input" class="form-control" rows="5" placeholder="Post content"></textarea>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                      <button type="submit" class="btn btn-primary" id="post-edit-submit">Edit</button>
                    </div>
                    {{ csrf_field() }}
                  </form>
                </div>
            </div>
        </div>
        <div class="modal fade" tabindex="-1" role="dialog" id="uni-modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Reactions</h4>
                  </div>
                  <div class="modal-body">
                  </div>
                </div>
            </div>
        </div>