{{ Former::vertical_open()->id('reply-form') }}
    {{ Former::textarea('body')->placeholder('Tekst')->label('Reageer')->rows(10) }}
    
    <div class="control-group">
        <input type="submit" id="submit-reply" value="Reageer" class="button">
    </div>
{{ Former::close() }}
