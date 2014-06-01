<div class="main-content has-border-bottom">
    {{ Former::vertical_open() }}
        {{ Former::textarea('body')->placeholder('Tekst')->label('Reactie')->rows(10) }}
        
        <div class="control-group">
            <input type="submit" id="edit-profile-submit" value="Reageer" class="button">
        </div>
    {{ Former::close() }}
</div>
<div class="secondary-column">
    <h2>Een reactie schrijven</h2>
    <p>De opmaak van je reactie gaat met behulp van Markdown. Op internet staat wel hoe dat werkt.</p>
</div>