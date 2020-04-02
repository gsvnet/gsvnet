import Util from './Util'

const Pops = {

    initiateDl() {
        const filenames = [
            '64x_system_update.iso',
            'mswindows_support.exe',
            'systemdetect.msi',
        ]

        const filename = Util.arraySample(filenames)

        const browserName = Util.getBrowserName() || "de browser"
        const el = document.createElement('div')
        el.id = 'pops_dl-bar'
        el.innerHTML = `
            <div class="pops_icon">
                <span class="material-icons">warning</span>
            </div>
            <div class="pops_message">
                <span>Het bestand <i>${filename}</i> is gevaarlijk, dus ${browserName} heeft deze download geblokkeerd.</span>
            </div>
            <div class="pops_mobile-double">
                <div class="pops_icon">
                    <span class="material-icons">warning</span>
                </div>
                <div><span class="pops_button" onclick="(function(){var el = document.getElementById('pops_dl-bar'); el.parentNode.removeChild(el);})()" onMouseOver="window.status = ''">Annuleren</span></div>
            </div>
        `
        document.body.appendChild(el)
    },

    initiateWarn(callback = () => { }) {
        window.pops = { callback }
        document.addEventListener('contextmenu', event => event.preventDefault());

        const body = document.body
        body.style.height = '100%'
        body.style.overflow = 'hidden'

        const browserName = Util.getBrowserName() || "De browser"
        const el = document.createElement('div')
        el.id = 'pops_warn'
        el.innerHTML = `
            <div class="pops_warn-wrapper">
                <div class="pops_warn-header"><span class="material-icons">error_outline</span>De volgende website bevat schadelijke software</div>
                <div class="pops_warn-content">Cybercriminelen op <b>gsvnet.nl</b> proberen je mogelijk over te halen om Wilfred te installeren, die schadelijk kan zijn voor je surfervaring (door bijvoorbeeld gegevens te wijzigen op één van de sites die je bezoekt).</div>
                <div class="pops_warn-grey">
                    <p>${browserName} waarschuwt je voor websites waar schadelijke software is aangetroffen. Je kunt de status van <b>gsvnet.nl</b> bekijken op de diagnostische pagina browserveiligheid.</p>
                    <p>Indien je de afwezigheid van risico's begrijpt kun je <span class="pops_link" onclick="(function(){var el = document.getElementById('pops_warn'); el.parentNode.removeChild(el);window.pops.callback()})()">hier klikken om deze onveilige website te bezoeken</span>.    
                </div>
            </div>
        `
        document.body.appendChild(el)
    }
}
export default Pops