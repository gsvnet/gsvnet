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
    <p>De opmaak van je reactie gaat met behulp van Markdown. Dat heeft er vooral mee te maken dat de mede-oprichter van de site Mark heet, maar het is ook handig. Google maar even.</p>
</div>