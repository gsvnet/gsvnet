import Pops from './Pops'
import Util from './Util'
import startAnt from '../ant/ant.js'

let status = Util.getCookie('pops_status') || 0
console.log(status)

if(status <= 9000) {
    addOptOutButton()
    doPops(status)
}

function doPops(status) {
    if(status > 2 && status < 14 && Math.random() > .5) {
        function intercept(e) {    
            if(e.target && e.target.tagName == 'A') {
                e.preventDefault()
                Pops.initiateDl()
                document.removeEventListener('click', intercept, true)
            }
        }
        document.addEventListener('click', intercept, true);
    } else if(status == 14) {
        Pops.initiateWarn(() => {
            Util.setCookie('pops_status', ++status, 30)
        })
    } else if(status >= 15 && status <= 9000){
        startAnt()
    }

    if(status < 14) {
        Util.setCookie('pops_status', ++status, 30)
    }

    // The madness can be disabled by calling this function from console
    window.stopPops = function() {
        Util.setCookie('pops_status', 9001, 60)
    }
}

function addOptOutButton() {
    const col = document.querySelector('.secondary-column > .content-columns')
    console.log('col', col)
    if(!col) return
    const div = document.createElement('div')
    div.classList.add('content-column')
    const h2 = document.createElement('h2')
    h2.innerText = '1 april'
    const btn = document.createElement('a')
    btn.classList.add('button', 'pops_opt_out')
    btn.style.cursor = 'pointer'
    btn.innerText = 'Uit met de pret'
    div.appendChild(h2)
    div.appendChild(btn)
    col.appendChild(div)

    btn.onclick = () => {
        if(!confirm("Weg met Wilfred?")) return
        stopPops()
        alert('Even herladen en je bent klaar.')
    }
}

