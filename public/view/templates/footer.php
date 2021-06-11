	<div class="modal fade" id="modalDeleteNote" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-trash"></span> Xoá note</h4>
                </div>
                <div class="modal-body">
                    <p>Bạn chắc chắn muốn xoá note này không ?</p>
                    <div class="alert alert-danger hidden"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Không</button>
                    <button type="button" class="btn btn-primary" id="submit_delete_note">Đồng ý</button>
                </div>
            </div>
        </div>
    </div>

	<script src="public/jquery.min.js"></script>
    <script src="public/bootstrap/js/bootstrap.min.js"></script>
    <script src="public/js/note.js"></script>
    <script src="public/js/signin.js"></script>
    <script src="public/js/signup.js"></script>
    <script src="public/js/change-pass.js"></script>
</body>
</html>