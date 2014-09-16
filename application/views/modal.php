<div id="error_modal" class="modal" style="z-index: 1300; overflow: hidden;">
    <div class="modal-dialog">
        <div class="modal-content" style="padding: 14px;border-radius: 21px;">
            <div style="border: 2px solid red; border-radius: 25px;">
                <div class="modal-body" style="display: inline-flex;">
                    <img class="visible-lg" src="/static/images/error.png">
                    <p class="text-message"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="close_action btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="success_modal" class="modal" style="z-index: 1300; overflow: hidden;">
    <div class="modal-dialog">
        <div class="modal-content" style="padding: 14px;border-radius: 21px;">
            <div style="border: 2px solid red; border-radius: 25px;">
                <div class="modal-body" style="display: inline-flex;">
                    <img class="visible-lg" src="/static/images/success.png">
                    <p class="text-message"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="close_action btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="broad_message_modal" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Enter Message</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            </div>
            <form id="broadcast_form" role="form">
                <div class="modal-body">
                    <textarea id="" name="broadcast_message" class="form-control"row="3" type="text" style="resize: none;" placeholder="Enter your message here"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="broadcast_msg_btn" class="btn my_button">Broadcast</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="comment_modal" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Enter Comment</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            </div>
            <form id="comment_form" role="form">
                <div class="modal-body">
                    <textarea id="" name="broadcast_message" class="form-control"row="3" type="text" style="resize: none;" placeholder="Enter Your comment here"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="add_comment_btn" class="btn my_button">Comment</button>
                </div>
            </form>
        </div>
    </div>
</div>