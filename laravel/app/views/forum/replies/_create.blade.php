<div class="reply-form">
    <a name="reply_form"></a>
    {{ Former::open() }}
        {{ Former::textarea('body')->placeholder('Tekst')->label('Reactie')->rows(10) }}
        
        <div class="control-group">
            <input type="submit" id="edit-profile-submit" value="Reageer" class="button">
        </div>
    {{ Former::close() }}
</div>
