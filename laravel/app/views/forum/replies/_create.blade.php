<div class="reply-form">
    <a name="reply_form"></a>
    {{ Form::open(['data-persist' => 'garlic', 'data-expires' => '300']) }}
        <div class="form-row">
            <label class="field-title">Reply</label>
            {{ Form::textarea("body", null, ['class' => '_tab_indent _reply_form']) }}
            {{ $errors->first('body', '<small class="error">:message</small>') }}
        </div>

        <div class="form-row">
            {{ Form::button('Reply', ['type' => 'submit', 'class' => 'button']) }}
        </div>
    {{ Form::close() }}
</div>
